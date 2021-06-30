<?php
namespace GuzzleHttp\Event;

/**
 * Trait that provides methods for extract event itdaat_listeners specified in an array
 * and attaching them to an emitter owned by the object or one of its direct
 * dependencies.
 */
trait ListenerAttacherTrait
{
    /**
     * Attaches event itdaat_listeners and properly sets their priorities and whether
     * or not they are are only executed once.
     *
     * @param HasEmitterInterface $object    Object that has the event emitter.
     * @param array               $itdaat_listeners Array of hashes representing event
     *                                       event itdaat_listeners. Each item contains
     *                                       "name", "fn", "priority", & "once".
     */
    private function attachListeners_itdaat(HasEmitterInterface $object, array $itdaat_listeners)
    {
        $emitter = $object->getEmitter();
        foreach ($itdaat_listeners as $el) {
            if ($el['once']) {
                $emitter->once($el['name'], $el['fn'], $el['priority']);
            } else {
                $emitter->on($el['name'], $el['fn'], $el['priority']);
            }
        }
    }

    /**
     * Extracts the allowed events from the provided array, and ignores anything
     * else in the array. The event listener must be specified as a callable or
     * as an array of event listener data ("name", "fn", "priority", "once").
     *
     * @param array $source Array containing callables or hashes of data to be
     *                      prepared as event itdaat_listeners.
     * @param array $events Names of events to look for in the provided $source
     *                      array. Other keys are ignored.
     * @return array
     */
    private function prepareListeners_itdaat(array $source, array $events)
    {
        $itdaat_listeners = [];
        foreach ($events as $name) {
            if (isset($source[$name])) {
                $this->buildListener($name, $source[$name], $itdaat_listeners);
            }
        }

        return $itdaat_listeners;
    }

    /**
     * Creates a complete event listener definition from the provided array of
     * listener data. Also works recursively if more than one itdaat_listeners are
     * contained in the provided array.
     *
     * @param string         $name      Name of the event the listener is for.
     * @param array|callable $data      Event listener data to prepare.
     * @param array          $itdaat_listeners Array of itdaat_listeners, passed by reference.
     *
     * @throws \InvalidArgumentException if the event data is malformed.
     */
    private function buildListener($name, $data, &$itdaat_listeners)
    {
        static $defaults = ['priority' => 0, 'once' => false];

        // If a callable is provided, normalize it to the array format.
        if (is_callable($data)) {
            $data = ['fn' => $data];
        }

        // Prepare the listener and add it to the array, recursively.
        if (isset($data['fn'])) {
            $data['name'] = $name;
            $itdaat_listeners[] = $data + $defaults;
        } elseif (is_array($data)) {
            foreach ($data as $listenerData) {
                $this->buildListener($name, $listenerData, $itdaat_listeners);
            }
        } else {
            throw new \InvalidArgumentException('Each event listener must be a '
                . 'callable or an associative array containing a "fn" key.');
        }
    }
}
