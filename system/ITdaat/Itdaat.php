<?php
// get all configs
require_once ( dirname(dirname(dirname(__FILE__))).'/admin/config.php');
require_once (DIR_SYSTEM . '/helper/itdaat_license.php');
require_once (DIR_SYSTEM . '/helper/itdaat_log.php');
require_once (DIR_SYSTEM . '/helper/itdaat_settings.php');
/**
 * Parent_IT_daat
 * this class is parent for all modules. It contains all neccessary configs and settings ...
 */
abstract class Parent_IT_daat implements I_IT_daat{
    //add itdaat_license functionality to parent class
    use itdaat_license;        
    /**
     * settings
     * all settings functional
     * @var itdaat_settings
     */
    protected itdaat_settings $settings;    
    /**
     * log
     * all log functional
     * @var itdaat_log
     */
    protected itdaat_log $log;    
    /**
     * moduleUniqueKey
     * key that is used in 
     * @return string
     */
    abstract protected function moduleUniqueKey():string;    
    /**
     * moduleCode
     * sets module code (module id)
     * @return string
     */
    abstract protected function moduleCode():string;    
    /**
     * moduleName
     * sets module name
     * @return string
     */
    abstract protected function moduleName():string;
    public function run(array $data){
        // get all settings from database
        $this->settings = new itdaat_settings(DB_HOSTNAME,DB_USERNAME, DB_PASSWORD,DB_DATABASE, DB_PORT,DB_PREFIX);
        // add logs file. If file is not setted generate it according to it's name
        if(!isset($data['logFile'])){
            $data['logFile'] =   "./logs/" . $this->moduleName() . '.log';
        }
        // set log file and get log functionality 
        $this->log = new itdaat_log($data['logFile'],true);
    }
    protected function getConfigs($configFile)
    {
        require_once($configFile);
    }
}
/**
 * I_IT_daat
 * Interface that provides all basic functionality
 */
interface I_IT_daat{
    /**
     * run
     * functions that run module
     * this function is called first
     * only that functoin could be public
     * @param  mixed $data data for module
     * @return void
     */
    public function run(array $data);
}