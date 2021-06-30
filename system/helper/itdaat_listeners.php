<?php
trait itdaat_listeners
{
    /**
     * addInputListener
     *
     * @param  mixed $name - name of the input
     * @param  mixed $data - link to opencarts data array in controller
     * @param  mixed $moduleCode - module code in the db
     * @return void
     */
    protected function addInputListener(string $name, &$data, string $moduleCode)
    {
        // get all saved data at first
        if($name != 'enabled'){
            $this->settings->getDataFromDatabase($moduleCode);
        }
        // check the post data
        if (isset($this->request->post[$name])) {
            // if there is data set it
            $data[$name] = $this->request->post[$name];
            // id
        } else {
            // else get data from config
            if($name == 'enabled'){
                $data[$name] = $this->settings->getModuleStatus($this->moduleCode);
            }else{
                $data[$name] = $this->settings->getVlaueByKey($name);
            }
        }
        $exists = false; // shows if the are data in the db or not
        // This variable is used to check if the data is in the db already. If not create, if it is update
        // in сicle to sort out each sended data and check if it is in the db already.
        foreach ($this->settings->dataBase as $key => &$data_e) {
            //  first condition is to protected
            if ((isset($data_e['key'])) && (!$exists)) {
                // check if name that is  taken data is the same as the key from db
                $exists = ($data_e['key'] == $name) && (!$exists);
                // if such data exists already, update it (will be created below)
                if ($exists) {
                    // update only value and date becouse are constants
                    $this->settings->dataBase[$key]['value'] = $data[$name];
                    $this->settings->dataBase[$key]['date'] = date('Y-m-d');
                }
            }
        }
        // here we check if data does not  exist yet.
        // In such case we have to create new row.
        if (!$exists) {
            $this->settings->dataBase[] = [
                'module_code' => $moduleCode,
                'key' => $name,
                'value' => $data[$name],
                'date' => date('Y-m-d')
            ];
        }
        if($name == 'enabled'){
            if(isset($data[$name]['value'])){
                $data[$name] = $data[$name]['value'];
            }
            $this->settings->setModuleStatus($data[$name],$this->moduleCode,$this->settings->getModuleStatusArr($this->moduleCode));
        }else{
            $this->settings->setDataToDatabase($this->settings->dataBase, $moduleCode); 
        }
        if(isset($_GET['updated']) && $_GET['updated'] == 'true'){
            $this->runModule();
        }
    }
    /**
     * addListeners_itdaat
     * adds all itdaat_listeners
     * @param  mixed $names - names of the input
     * @param  mixed $data - link to opencarts data array in controller
     * @param  mixed $moduleCode - name of the module code to db
     * @return void
     */
    protected function addListeners_itdaat(array $names, &$data, string $moduleCode)
    {
        // get data from database
        $this->settings->getDataFromDatabase($moduleCode);
        foreach ($names as $name) {
            // set listeners
            $this->addInputListener($name, $data, $moduleCode);
        }
    }
}
