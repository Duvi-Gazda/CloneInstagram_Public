<?php
require_once (DIR_SYSTEM . "/engine/controller.php");
require_once (DIR_SYSTEM . "/helper/itdaat_settings.php");
require_once (DIR_SYSTEM . "/helper/itdaat_htmlGenerator.php");
require_once (DIR_SYSTEM . "/helper/itdaat_log.php");
require_once (DIR_SYSTEM . "/helper/itdaat_listeners.php");
require_once (DIR_SYSTEM . "/helper/itdaat_license.php");
require_once (DIR_SYSTEM . '/ITdaat/Itdaat.php');

abstract class ControllerItDaat extends Controller {
    // add license checking
    use itdaat_license;
    // add itdaat_listeners to save data to db
    use itdaat_listeners;
    // add html generator to generate buttons and other elements
    use itdaat_htmlGenerator;
    // settings functionality
    protected itdaat_settings $settings;
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
    protected Parent_IT_daat  $module;
//    /**
//     * runModule
//     * runs the module from the module file
//     * @return void
//     */
//    protected function runModule(){
//        $cmd = ('curl '. $this->moduleFilePath);
//        if(substr(php_uname(), 0, 7) == "Windows"){
//            pclose(popen("start /B ". $cmd, "r"));
//           }else {
//            exec($cmd . " > /dev/null &");
//           }
//    }
    /**
     * run
     *
     * @param  mixed $language - paht to language file
     * @param  mixed $moduleCode module Code to the database
     * @return void
     */
    protected function run (string $moduleLink,string $moduleFolder ) {
        $this->data = [];
        // get all settings from database
        $this->settings = new itdaat_settings(DB_HOSTNAME,DB_USERNAME, DB_PASSWORD,DB_DATABASE, DB_PORT,DB_PREFIX);
        // get all data from database
        $this->settings->getDataFromDatabase($this->moduleCode);
        // add logs
        $this->log = new itdaat_log(DIR_LOGS . "/log.log",true);
        // add setting model
        $this->load->model('setting/setting');
        // add language
		$this->load->language($moduleLink);
        // set headung title
		$this->document->setTitle($this->language->get('heading_title'));
        // if data is setted in the request like post and this user has all permissions to work with this module
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate($moduleLink)) {
            // get data from request
            $this->session->data['success'] = $this->language->get('text_success');
		}
        // if there are some errors
        if (isset($this->error['warning'])) {
            // set them to show in the view
            $this->data['error_warning'] = $this->error['warning'];
		} else {
            // or set nothing
            $this->data['error_warning'] = '';
		}
        // set all data inputs
        $this->data['itdaatInputs'] = '';
        // set user token
        $this->userToken = 'uesr_token=' . $this->session->data['user_token'];
        $this->addFullInputSelect(
            'enabled',
            [
                'disabled',
                'enabled'
            ],
            $this->data,
            $this->language->get('entry_status'),
            'enabled',
            false
        );
    }
    protected function includeModule(){
        include_once (self::MODULE_LINK);
    }
    /**
     * setDefaultOutput
     * sets the default output with default header footer left sidebar
     * @param  mixed $moduleLink
     * @return void
     */
    protected function setDefaultOutput($moduleLink):void{
        $this->data['header'] = $this->load->controller('common/header');
		$this->data['column_left'] = $this->load->controller('common/column_left');
		$this->data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view($moduleLink, $this->data));
    }
    /**
     * validate
     * function checks if user has permission to use this module
     * @return void
     */
    protected function validate($moduleLink){
        if(!$this->user->hasPermission('modify', $moduleLink)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }        
    /**
     * addFullInputSelect
     *
     * @param  mixed $name - name of the input
     * @param  mixed $values - array of values ['key' => 'value']
     * @param  mixed $selected - selected KEY (in array)
     * @param  mixed $data - link to opencarts data array in controller
     * @param  mixed $moduleCode - module code to db
     * @param  mixed $label - text label for the input
     * @param  mixed $id - id of the input (for HTML)
     * @param  mixed $keyLanguage - if in the values array are setted only keys of the language text will
     * - True if only keys.
     * - False if keys and values
     * - [ key(for the view) => value(for the database)]
    * @param  mixed $data_index - index in the data array
     * @return void
     */
    public function addFullInputSelect(string $name, array $values, &$data, string $label = '', string $id = '',bool $keyLanguage = true, $selected = null,string $data_index = 'itdaatInputs'){
        $this->addInputListener($name, $data,$this->moduleCode);
        if($selected == null){
            if($name == 'enabled'){
                $selected = $this->settings->getModuleStatus($this->moduleCode);
            }else{
                $selected= $this->settings->getVlaueByKey($name);
            }
        }
        
        $this->addInputSelect($name, $values, $selected, $data, $label, $id, $keyLanguage,$data_index);
    }
    /**
     * addFUllInputText
     *
     * @param  mixed $name - name of the input
     * @param  mixed $value - text value
     * @param  mixed $data - link to opencarts data array in controller
     * @param  mixed $moduleCode - module code to db
     * @param  mixed $label - text label for the input
     * @param  mixed $id - id of the input (for HTML)
    *  @param  mixed $data_index - index in the data array
     * @return void
     */
    public function addFullInputText ($name, &$data,$label = '', $id = '',$value = '', string $data_index = 'itdaatInputs'):void{
        $this->addInputListener($name, $data, $this->moduleCode);
        if($value == null){
            $value = $this->settings->getVlaueByKey($name);
        }
        $this->addInputText($name,$value, $data,$label,$id,$data_index);
    }
}
