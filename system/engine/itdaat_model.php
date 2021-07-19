<?php
require_once (DIR_SYSTEM . "/engine/model.php");
require_once (DIR_SYSTEM . "/helper/itdaat_settings.php");
require_once (DIR_SYSTEM . "/helper/itdaat_log.php");
require_once (DIR_SYSTEM . '/helper/itdaat_database.php');
require_once (DIR_SYSTEM . '/ITdaat/Itdaat.php');

abstract class ModelItDaat extends Model {
    // setting from database (itdaat_settings) table
    protected itdaat_settings $settings;
    // database connection 
    protected itdaat_database $database;
    // log functionality
    protected itdaat_log $log;
    // code of the module for database (for the column code)
    protected string $moduleCode;
    // token of the user
    protected string $userToken;
    // path to the main module file
    protected string $moduleFilePath;
    // array of errors
    private $error = array();  
    // main data (like opencart)    
    protected $data;
    /**
     * run
     *
     * @param  mixed $language - path to language file
     * @param  mixed $moduleCode module Code to the database
     * @return void
     */
    protected function run ($moduleCode) {
        $this->data = [];
        // get all settings from database
        $this->settings = new itdaat_settings(DB_HOSTNAME,DB_USERNAME, DB_PASSWORD,DB_DATABASE, DB_PORT,DB_PREFIX);
        // get all data from database
        $this->settings->getDataFromDatabase($this->moduleCode);
        // add new itdaat database for work with database
        $this->database = new itdaat_database();
        // add logs
        $this->log = new itdaat_log(DIR_LOGS . "/log.log",true);
    }
}
