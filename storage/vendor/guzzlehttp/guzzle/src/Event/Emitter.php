<?php
namespace GuzzleHttp\Event;

/**
 * Guzzle event emitter.
 *
 * Some of this class is based on the Symfony EventDispatcher component, which
 * ships with the following license:
 *
 *     This file is part of the Symfony package.
 *
 *     (c) Fabien Potencier <fabien@symfony.com>
 *
 *     For the full copyright and license information, please view the LICENSE
 *     file that was distributed with this source code.
 *
 * @link https://github.com/symfony/symfony/tree/master/src/Symfony/Component/EventDispatcher
 */
class Emitter implements EmitterInterface
{
    /** @var array */
    private $itdaat_listeners = [];

    /** @var array */
    private $sorted = [];

    public function on($eventName, callable $listener, $priority = 0)
    {
        if ($priority === 'first') {
            $priority = isset($this->itdaat_listeners[$eventName])
                ? max(array_keys($this->itdaat_listeners[$eventName])) + 1
                : 1;
        } elseif ($priority === 'last') {
            $priority = isset($this->itdaat_listeners[$eventName])
                ? min(array_keys($this->itdaat_listeners[$eventName])) - 1
                : -1;
        }

        $this->itdaat_listeners[$eventName][$priority][] = $listener;
        unset($this->sorted[$eventName]);
    }

    public function once($eventName, callable $listener, $priority = 0)
    {
        $onceListener = function (
            EventInterface $event
        ) use (&$onceListener, $eventName, $listener, $priority) {
            $this->removeListener($eventName, $onceListener);
            $listener($event, $eventName);
        };

        $this->on($eventName, $onceListener, $priority);
    }

    public function removeListener($eventName, callable $listener)
    {
        if (empty($this->itdaat_listeners[$eventName])) {
            return;
        }

        foreach ($this->itdaat_listeners[$eventName] as $priority => $itdaat_listeners) {
            if (false !== ($key = array_search($listener, $itdaat_listeners, true))) {
                unset(
                    $this->itdaat_listeners[$eventName][$priority][$key],
                    $this->sorted[$eventName]
                );
            }
        }
    }

    public function itdaat_listeners($eventName = null)
    {
        // Return all events in a sorted priority order
        if ($eventName === null) {
            foreach (array_keys($this->itdaat_listeners) as $eventName) {
                if (empty($this->sorted[$eventName])) {
                    $this->itdaat_listeners($eventName);
                }
            }
            return $this->sorted;
        }

        // Return the itdaat_listeners for a specific event, sorted in priority order
        if (empty($this->sorted[$eventName])) {
            $this->sorted[$eventName] = [];
            if (isset($this->itdaat_listeners[$eventName])) {
                krsort($this->itdaat_listeners[$eventName], SORT_NUMERIC);
                foreach ($this->itdaat_listeners[$eventName] as $itdaat_listeners) {
                    foreach ($itdaat_listeners as $listener) {
                        $this->sorted[$eventName][] = $listener;
                    }
                }
            }
        }

        return $this->sorted[$eventName];
    }

    public function hasListeners_itdaat($eventName)
    {
        return !empty($this->itdaat_listeners[$eventName]);
    }

    public function emit($eventName, EventInterface $event)
    {
        if (isset($this->itdaat_listeners[$eventName])) {
            foreach ($this->itdaat_listeners($eventName) as $listener) {
                $listener($event, $eventName);
                if ($event->isPropagationStopped()) {
                    break;
                }
            }
        }

        return $event;
    }

    public function attach(SubscriberInterface $subscriber)
    {
        foreach ($subscriber->getEvents() as $eventName => $itdaat_listeners) {
            if (is_array($itdaat_listeners[0])) {
                foreach ($itdaat_listeners as $listener) {
                    $this->on(
                        $eventName,
                        [$subscriber, $listener[0]],
                        isset($listener[1]) ? $listener[1] : 0
                    );
                }
            } else {
                $this->on(
                    $eventName,
                    [$subscriber, $itdaat_listeners[0]],
                    isset($itdaat_listeners[1]) ? $itdaat_listeners[1] : 0
                );
            }
        }
    }

    public function detach(SubscriberInterface $subscriber)
    {
        foreach ($subscriber->getEvents() as $eventName => $listener) {
            $this->removeListener($eventName, [$subscriber, $listener[0]]);
        }
    }
}
