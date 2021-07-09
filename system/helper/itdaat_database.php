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
     * @var string name of the table with the prefix
     */
    protected string $tableName;
    /**
     * @var array rows from database
     */
    protected array $fields;
    /**
     * @var array assoc array of the columns of the using table
     */
    protected array $columns;
    /**
     * @var array this array contains all queries for generating
     */
    protected array $queries;
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
        if($number_of_arguments == 0){
            $this->__construct7(DB_HOSTNAME, DB_PASSWORD, DB_USERNAME,DB_PORT,DB_DATABASE, DB_PREFIX , '');
        }
    }

    /**
     * constructor that has only table name
     * @param $tableName
     */
    public function __construct1($tableName){
        $this->__construct7(DB_HOSTNAME, DB_PASSWORD, DB_USERNAME,DB_PORT,DB_DATABASE, DB_PREFIX , $tableName);
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
    public function __construct7(string $hostName, string $userPass, string $userLogin, string $dbPort, string $dbName, string $dbPrefix, string $table_name)
    {
        $this->hostName = $hostName;
        $this->userPass = $userPass;
        $this->userLogin = $userLogin;
        $this->dbPort = $dbPort;
        $this->dbName = $dbName;
        $this->dbPrefix = $dbPrefix;
        $this->dataBase = [];
        $this->columns = [];
        $this->fields = [];
        $this->queries = [];
        $this->tableName = $this->dbPrefix . $table_name;
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
        $res = $this->mysqli->query($query);
        $this->mysqli->close();
        return $res != false;
    }

    /**
     * this function sets to the database array that is set like param
     * @param array $arr assoc array of the values format [["columns" => []], ["values" => []]] if columns element is not set
     *                  will be taken tables by default from the $this->columns
     */
//    public function setArrToRequest(array $arr){
////        check if there is no columns element
//        if(!isset($arr['columns'])){
////             if there is no such element get it from default
//            $columns = $this->columns;
//        }
////        check if there is no values
//        if(!isset($arr['values'])){
////            if there isn't stop setting
//            return false;
//        }
////        generate query
//    }

    /**
     * @param string $query
     * @return mysqli_result
     */
    public function getRequest(string $query):?mysqli_result{
        $this->connectDataBase();
        $res = $this->mysqli->query($query);
        $this->mysqli->close();
        return $res ? $res : null;
    }

    /**
     * @param string $query
     * @return array
     */
    public function getAssocRequest(string $query):?array{
        $res = $this->getRequest($query);
        $this->fields = $res != null ? $res->fetch_all(MYSQLI_ASSOC) : [];
        return $this->fields;
    }

    /**
     * @param string $query
     * @return array
     */
    public function getArrRequest(string $query):?array{
        $res = $this->getRequest($query);
        $this->fields = $res != null ? $res->fetch_all(MYSQLI_NUM): [];
        return $this->fields;
    }  

    /**
     * @param  mixed $index
     * @return array
     */
    public function deleteByKey_Field(?string $index):?array{
        $arr = $this->getFieldByKey_Field($index);
        if(is_array($arr)){
            foreach($this->fields as $key_f => &$field){
                foreach($field as $key => $value){
                    if(array_key_exists($key,$arr)){
                        unset($this->fields[$key_f]);
                    }
                }
            }
        }
        return $this->fields;
    }  

    /**
     * @param  mixed $index
     * @return array
     */
    public function deleteByValue_Field(?string $index):?array{
        $arr = $this->getFieldByValue_Field($index);
        if(is_array($arr)){
            foreach($this->fields as $key_f => &$field){
                foreach($field as $key => $value){
                    if(in_array($value,$arr)){
                        unset($this->fields[$key_f]);
                    }
                }
            }
        }
        return $this->fields;
    }
    
    /**
     * @return array|false
     */
    public function getPrimaryKey_Field(){
       return $this->getFieldByValue_Field('primary');
    }
    
    /**
     * set_Field
     *
     * @param  mixed $field
     * @param  mixed $index
     * @return void
     */
    public function set_Field(array $field, string $index){
        $arr = [];
        foreach ($field as $key => $value) {
            $arr[strtolower($key)] = strtolower($value);
        }
        $this->fields[$index] = $arr;
        return $arr != [] ? $arr : false;
    }

    /**
     * @param array $field
     * @return array|false
     */
    public function add_Field(array $field){
        $arr = [];
        foreach ($field as $key => $value) {
            $arr[strtolower($key)] = strtolower($value);
        }
        $this->fields[] = $arr;
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
     * @return array
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }
    /**
     * @return string
     */
    public function getTableName(): string
    {
        return $this->tableName;
    }

    /**
     * @param string $tableName
     */
    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    /**
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param array $fields
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }
    /**
     * creates table if not exists. Table name from $this->tableName
     */
    public function createTable($tableName = '')
    {
        $tableName = $tableName != ''? $tableName : $this->tableName;
        $this->setRequest("CREATE TABLE IF NOT EXISTS `{$tableName}` ( 
            `id` integer NOT NULL PRIMARY KEY AUTO_INCREMENT, 
            `module_code` varchar (500),
            `key` varchar(500),
            `value` varchar(500),
            `date` date
        )");
    }
    protected function generateColumnList_Query($columns, $queryName = 'default'){
        $query = $this->queries[$queryName];
        $res= '';

    }
    protected function generate_Query($queryName):string{
        if(!isset($this->queries[$queryName])){
            return '';
        }
        $query = $this->queries[$queryName];
        $res_query = '';
        $table = $query['table'] != null ? $query['table']: $this->tableName;
        $conditions = $query['conditions'] != null ? $query['conditions']: '';
        switch ($query['type']){
            case 'insert':
                $res_query = "INSERT INTO {$table} {$query['columns']} VALUES {$query['values']}";
                break;
            case 'delete':
                $res_query = "DELETE FROM {$table} WHERE {$conditions}";
                break;
        }
        return $res_query;
    }


}