<?php
/**
 * itdaat_settings
 * helps to use all settings in the module (set to dataBase get ...)
 */
require_once ("itdaat_log.php");
class itdaat_settings{
    // name of the host
    private string $hostName;
    // user password
    private string $userPass;
    // user login
    private string $userLogin;
    // db port
    private string $dbPort;
    // name of the database
    private string $dbName;
    // prefix that is added to the table name
    private string $dbPrefix;
    // mysql functionality
    private mysqli $mysqli;
    // table name with dbPrefix
    private string $tableName;
    // data of the database like assoc array
    public array $dataBase; 
    // log functionality
    private itdaat_log $log;   
    /**
     * __construct
     *
     * @param  mixed $hostName
     * @param  mixed $userLogin
     * @param  mixed $userPass
     * @param  mixed $dbName
     * @param  mixed $dbPort
     * @param  mixed $dbPrefix
     */
    public function __construct (string $hostName,string $userLogin,string $userPass, string $dbName,string $dbPort,string $dbPrefix, string $tableName = 'itdaat_settings'){
        // set all data
        $this->hostName = $hostName;
        $this->userPass = $userPass;
        $this->userLogin = $userLogin;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbPrefix = $dbPrefix;
        $this->tableName = $this->dbPrefix . $tableName;
        $this->dataBase = array();
        // add log functionality
        $this->log = new itdaat_log('settings.log', true);
        // and create table if it does not exist
        $this->createTable();
    }    
    /**
     * connectDataBase
     *
     * @return void
     */
    private function connectDataBase(){
        // try to connect to database
        $this->mysqli = new mysqli($this->hostName,$this->userLogin,$this->userPass,$this->dbName,$this->dbPort); 
        // get some errors if they exists
        if($this->mysqli->connect_error){
            die('error');
            return [];
        }
    }  

    /**
     * getDataFromDatabase
     *
     * @param  mixed $moduleCode
     * @return array
     */
    public function getDataFromDatabase(string $moduleCode):array{
        $query = "SELECT * FROM `{$this->tableName}` WHERE `module_code` = '$moduleCode'";
        $this->connectDataBase();
        $this->mysqli->query('SELECT * FROM `{$this->tableName}');
        $res = $this->mysqli->query($query);
        $this->mysqli->close();
        $res = $res->fetch_all(MYSQLI_ASSOC);
        if($res != null){
            $array = null;
            foreach($res as $key => $value){
                $array[$key] = $value;
                $this->dataBase[$key] = $value;
            }
        }
        return $this->dataBase;
    }        
    /**
     * createtTable
     * careates table if not exists
     * @return void
     */
    private function createTable(){
        $this->connectDataBase();
        $query = "CREATE TABLE IF NOT EXISTS `{$this->tableName}` ( 
            `id` integer NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            `module_code` varchar (500),
            `key` varchar(500),
            `value` varchar(500),
            `date` date
        )";
        $this->mysqli->query($query);
        $this->mysqli->close();
    }
    /**
     * setDataToDatabase
     *
     * @param  array $datas Array of the data ["key"=>"value"]
     * @param  int $moduleCode
     * @return void
     */
    public function setDataToDatabase(array $datas, string $moduleCode){
        $num = 0;
        $values = ' VALUES ';
        $this->createTable();
        $lastID = $this->getLastID() + 1;
        foreach($datas as $data){
            if(!isset($data['id'])){
                $data['id'] = $lastID++;
            }
            $values .= ($num++ > 0 ? ',' : '') . "('{$data['id']}', '$moduleCode', '{$data['key']}', '{$data['value']}', '{$data['date']}')";
        }
        $query = "REPLACE INTO `{$this->tableName}` (`id`, `module_code`, `key`, `value`, `date`)" . $values;
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
    }    
    /**
     * get
     * returns value by key
     * @param  mixed $key
     * @return array
     */
    public function get($key):array{
        foreach($this->dataBase as $key_a => $value){
            if($key == $key_a){
                return $value;
            }
        }
        return [];
    }    
    /**
     * getKeyValueArray
     * returns all data like key and value in array
     * @return array
     */
    public function getKeyValueArray(): array{
        $res = [];
        foreach($this->dataBase as $data){
            $res[$data['key']] = $data['value'];
        }
        return $res;
    }    
    /**
     * getVlaueByKey
     * returns value by key if it exists
     * @param  mixed $key
     * @return void
     */
    public function getVlaueByKey($key){
        $res = $this->getKeyValueArray();
        return isset($res[$key]) ? $res[$key] : null;
    }
    /**
     * getLastID
     * returns last id if there is no last id returns 1
     * @return int
     */
    private function getLastID(): int{
        $query = "SELECT MAX(`id`) FROM `$this->tableName`";
        $this->connectDataBase();
        $res = $this->mysqli->query($query);
        $res = $res->fetch_assoc();
        $res = $res['MAX(`id`)'];
        $this->mysqli->close();
        return $res != null ? $res : 0;
    }
    /**
     * clearSetting
     * clears settings where keys are like in the array that is setted
     * @param  mixed $data
     * @param  mixed $moduleCode
     * @return void
     */
    public function clearSetting(array $data, string $moduleCode){
        // all conditions that are required
        $conditions = '';
        // takes all conditions from $data (all columns has to be the same)
        foreach($data as $key => $value){
            $conditions = $conditions  . "AND `key` = '$key' AND `value` = '$value'";
        }
        $query = "DElETE FROM `{$this->tableName}` WHERE `module_code` = $moduleCode " . $conditions;
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
    }    
    /**
     * clearAllSetting
     * clears all settings
     * @param  mixed $moduleCode
     * @return void
     */
    public function clearAllSetting(string $moduleCode){
        // delete all module settings
        $query = "DElETE FROM `{$this->tableName}` WHERE `module_code` = $moduleCode";
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
    }    
    /**
     * setModuleStatus
     * set module status to the main opencart 
     * @param  mixed $status - module status
     * @param  mixed $moduleCode - module code
     * @param  mixed $dbData - db data it is necessary only to check if module status was getted from db
     * @return void
     */
    public function setModuleStatus($status,$moduleCode, $dbData = null){
        $query = '';
        if($dbData == null){
            $query = "INSERT INTO {$this->dbPrefix}setting (`store_id`,`code`,`key`,`value`,`serialized`) VALUES (0,'{$moduleCode}','module_{$moduleCode}_status', '$status', 0)";
        } else{
            $query = "UPDATE `oc_setting` SET `value` = $status WHERE `key` = 'module_{$moduleCode}_status' AND `code` = '{$moduleCode}'";
        }
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
    }    
    /**
     * getModuleStatusArr
     * returns module status from the setting table
     * @param  mixed $moduleCode - module code
     * @return void
     */
    public function getModuleStatusArr($moduleCode){
        $query = "SELECT * FROM " . DB_PREFIX . "setting WHERE `key` = 'module_{$moduleCode}_status' AND `code` = '{$moduleCode}'";
        $this->connectDataBase();
        $res = $this->mysqli->query($query);
        $this->mysqli->close();
        return $res->fetch_assoc();
    }
      /**
     * getModuleStatus
     * returns module status from the setting table
     * @param  mixed $moduleCode - module code
     * @return void
     */
    public function getModuleStatus($moduleCode){
        return isset(($this->getModuleStatusArr($moduleCode))['value']) ? ($this->getModuleStatusArr($moduleCode))['value'] : null;
    }
    public function setQuery(string $query){
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
    }
}
/**Create table `oc_itdaat_settings`(
    `id` integer PRIMARY KEY AUTO_INCREMENT,
    `module_code` varchar (500),
    `key` varchar(500),
    `value` varchar(500),
    `date` date
)**/