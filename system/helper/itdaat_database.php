<?php

/**
 * Class itdaat_database
 */
class itdaat_database
{
    /**
     * data of the database like assoc array
     * @var array
     */
    public array $dataBase;
    /**
     * @var string
     */
    protected string $hostName;
    /**
     * @var string
     */
    protected string $userPass;
    /**
     * @var string
     */
    protected string $userLogin;
    /**
     * @var string
     */
    protected string $dbPort;
    /**
     * @var string
     */
    protected string $dbName;

    /**
     * @var string
     */
    protected string $dbPrefix;
    /**
     * @var mysqli
     */
    protected mysqli $mysqli;
    /**
     * @var string
     */
    protected string $tableName;
    /**
     * @var array
     */
    protected array $fields;

    /**
     * itdaat_database constructor.
     */
    public function __construct()
    {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    /**
     * itdaat_database constructor with 6 params.
     * @param string $hostName
     * @param string $userPass
     * @param string $userLogin
     * @param string $dbPort
     * @param string $dbName
     * @param string $dbPrefix
     */
    public function __construct6(string $hostName, string $userPass, string $userLogin, string $dbPort, string $dbName, string $dbPrefix)
    {
        $this->hostName = $hostName;
        $this->userPass = $userPass;
        $this->userLogin = $userLogin;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbPrefix = $dbPrefix;
        $this->dataBase = [];
        $this->createTable();
    }

    /**
     * @return mysqli|string
     */
    public function connectDataBase(){
//        try to connect to the database
        $this->mysqli = new mysqli($this->hostName, $this->userLogin, $this->userPass, $this->dbName,$this->dbPort);
//        get some errors if they exists
        if($this->mysqli->connect_error){
//            die('error');
            return $this->mysqli->connect_error;
        }
        return $this->mysqli;
    }

    /**
     * @param string $query
     * @return bool
     */
    public function setRequest(string $query):bool{
        $this->connectDataBase();
        $this->mysqli->query($query);
        $this->mysqli->close();
        return $this->mysqli->query($query) != false;
    }

    /**
     * @param string $query
     * @return mysqli_result
     */
    public function getRequest(string $query):mysqli_result{
        $this->connectDataBase();
        $res = $this->mysqli->query($query);
        $this->mysqli->close();
        return $res;
    }

    /**
     * @param string $query
     * @return array
     */
    public function getAssocRequest(string $query):array{
        return ($this->getRequest())->fetch_assoc();
    }

    /**
     * @param string $query
     * @return array
     */
    public function getArrRequest(string $query):array{
        return ($this->getRequest())->fetch_fields();
    }

    /**
     * @return array|false
     */
    public function getPrimaryKey_Field(){
       return $this->getFieldByValue_Field('primary');
    }

    /**
     * @param array $field
     * @return array|false
     */
    public function add_Field(array $field){
        $arr = [];
        foreach ($field as $key => $value) {
            $arr[ strtolower($key)] = strtolower($value);
        }
        return $arr != [] ? $arr : false;
    }

    /**
     * @param $key_f
     * @return array|false
     */
    public function getFieldByKey_Field($key_f){
        $arr = [];
        foreach ($this->fields as $field){
            foreach ($field as $key => $value) {
                if ($key == $key_f) {
                    $arr[$key] = $value;
                }
            }
        }
        return $arr != [] ? $arr : false;
    }

    /**
     * @param $value_f
     * this function returns array of the all elements that has such value
     * @return array|false
     */
    public function getFieldByValue_Field($value_f){
        $arr = [];
        foreach($this->fields as $field){
            foreach ($field as $key => $value) {
                if ($value == $value_f) {
                    $arr[$key] = $value;
                }
            }
        }
        return $arr != [] ? $arr : false;

    }

    /**
     *
     */
    protected function createTable()
    {
        $this->setRequest("CREATE TABLE IF NOT EXISTS `{$this->tableName}` ( 
            `id` integer NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            `module_code` varchar (500),
            `key` varchar(500),
            `value` varchar(500),
            `date` date
        )");
    }

}