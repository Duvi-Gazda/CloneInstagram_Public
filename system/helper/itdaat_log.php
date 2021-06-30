<?php
/**
 * itdaat_log
 * helps to use log in any file and format. By default creates file like module name
 */
class itdaat_log{    
    /**
     * logFile
     * path to log file
     * @var mixed
     */
    private $logFile;    
    /**
     * logs
     * write logs or not (only logs)
     * @var bool
     */
    private bool $logs;
     /**
     * logs
     * write logs or not (only warn)
     * @var bool
     */
    private bool $warns;
     /**
     * logs
     * write logs or not (only warn)
     * @var bool
     */
    private bool $errors;
    static bool $LOGALL = true;
    const LOG = 'INFO';
    const ERROR = 'ERROR';
    const WARN = 'WARN';    
    /**
     * __construct
     *
     * @param  string $logFile
     * @param  bool $logs
     * @param  bool $warns
     * @param  bool $errors
     * @return void
     */
    public function __construct(string $logFile, bool $logs = false, bool $warns = false, bool $errors = true){
        $this->logFile = $logFile;
        $this->logs = $logs;
        $this->warns = $warns;
        $this->errors = $errors;
    }    
    /**
     * emptyLog
     * empty log file
     * @return void
     */
    public function empty(){
        file_put_contents($this->logFile, '');
    }
    /**
     * writeLog
     * writes data to the log file
     * @param  mixed $data
     * @param  mixed $type
     * @return void
     */
    private function writeLog($data, string $type = self::LOG,$heading = ''){
        $fileData = '';
        if($heading != ''){
            $fileData .= '/////////////////////////////////'.strtoupper($heading) . '/////////////////////////////////'."\n";
        }
        ob_start();
        var_dump($data);
        $fileData .= '['.date_create()->format('Y-m-d H:i:s') . '] ' . $type . ": " . ob_get_clean() . "\n";
        // if such file EXISTS
        if(file_exists($this->logFile)){
            //read it and get all data
            $fileData .= file_get_contents($this->logFile);
        }
        if (!file_exists($this->logFile)) {
            mkdir(dirname($this->logFile), 0777, true);
        }
        file_put_contents($this->logFile, $fileData);
        chmod($this->logFile, 0777);
        // add to file data out log
    }    
    /**
     * error
     * writes error message to log file
     * @param  mixed $data
     * @return void
     */
    public function error($data,$heading = ''):void{
        if($this->errors && self::$LOGALL){
            $this->writeLog($data, self::ERROR,$heading);
        }
    }    
    /**
     * log
     * write log data to log file
     * @param  mixed $data
     * @return void
     */
    public function log($data, $heading = ''): void{
        if($this->logs && self::$LOGALL){
            $this->writeLog($data, self::LOG,$heading);
        }
    } 
    /**
     * warn
     * write warn message to log
     * @param  mixed $data
     * @return void
     */
    public function warn($data,$heading = ''):void{
        if($this->warns && self::$LOGALL){
            $this->writeLog($data, self::WARN,$heading);
        }
    }
    private function createDir( $path=null, $perm=0644 ) {
        if( !file_exists( $path ) ) {
            $this->createDir( dirname( $path ) );
            mkdir( $path, $perm, true );
            clearstatcache();
        }
    }
    
    /* create an empty file ensuring that path is constructed */
    private function createFile( $path=false, $filename=false ){
        if( $path && $filename ){
            $this->createDir( $path );
            return true;
        }
        return false;
    }
    
}