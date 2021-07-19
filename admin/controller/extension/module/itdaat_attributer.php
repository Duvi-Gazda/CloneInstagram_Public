<?php

require_once (DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once (DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');

class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat {
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index(){
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = DIR_SYSTEM.'/ITdaat/itdaat_attributer.php';
        $this->run(self::MODULE_LINK,'extension/module');
        $this->load->model('extension/module/itdaat_attributer');
        $this->addItdaatAttribute();
        $this->editItdaatAttribute();
        // $this->connectItdaatAttributerDictionary();
        $this->generateViewData();
        $this->module();
    }
    
    private function module(){
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run([]);
    }


    private function getter(){
        if(isset($_POST['action'])){
            $this->data['back_url'] = $_SERVER['REQUEST_URI'];
            $this->data['itdaat_attributes_type'] = $_POST['action'];
            switch($this->data['itdaat_attributes_type']){
                case 'new_itdaat_attribute': 
                    $this->setDefaultOutput('extension/module/itdaat_attributer/itdaat_attributer_add_itdaat_attribute');
                    break;
            }
            $action = explode("|", $_POST['action']);
            if($action[0] == 'edit_itdaat_attribute'){
                $this->setDefaultOutput('extension/module/itdaat_attributer/itdaat_attributer_edit_attributer');
            }
            if($action[0] == 'connect_itdaat_attribute'){
                $this->setDefaultOutput('extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute');
            }
        } else{
            $this->setDefaultOutput(self::MODULE_LINK);
        }
    }

    private function addItdaatAttribute (){
        
        if(!isset($_POST['itdaat_attributes_name'])){
            return [];
        }

        if(isset($_POST['itdaat_oc_attributes'])){
            $itdaat_attributes = $_POST['itdaat_oc_attributes'];
        }else{
            $itdaat_attributes = null;
        } 
        
        $itdaat_attributes_name = $_POST['itdaat_attributes_name'];
        $itdaat_attr_id = $this->model_extension_module_itdaat_attributer->addItdaatAttribute($itdaat_attributes_name,$itdaat_attributes);
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        foreach ($itdaat_attributes as $key => $value) {
            $this->model_extension_module_itdaat_attributer->addItdaatAttributeValue($language_id,$itdaat_attr_id, $value);
        }

    }

    private function connectItdaatAttributerDictionary(){
        $attribute_id = null;
        if(!isset($_POST['action'])){
            $action = explode("|", $_POST['action']);
            if($action[0] == 'edit_itdaat_attribute'){
                $this->setDefaultOutput('extension/module/itdaat_attributer/itdaat_attributer_edit_attributer');
                $attribute_id = $action[1];
            }
        }
        if($attribute_id == null){  return;  }
    }

    private function editItdaatAttribute(){
        $attribute_id = null;
        if(!isset($_POST['action'])){
            $action = explode("|", $_POST['action']);
            if($action[0] == 'edit_itdaat_attribute'){
                $this->setDefaultOutput('extension/module/itdaat_attributer/itdaat_attributer_edit_attributer');
                $attribute_id = $action[1];
            }
        }
        if($attribute_id == null){  return;  }
        
    }

    private function generateViewData(){
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data,'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->generateOC_Attributes();

        $this->database->getAssocRequest("select language_id, name from oc_language");
        $this->data['itdaat_languages'] = $this->database->getFields();

        $this->database->getAssocRequest("select name from oc_language");
        $languages = $this->database->getValueToValue_Field();
        $this->addFullInputSelect(
            'languages',
            $languages
            ,
            $this->data,
            $this->language->get('Languages'),
            'languages',
        );
        $this->data['itdaat_attributes'] = $this->model_extension_module_itdaat_attributer->connectItdaatAttributes($this->database->getFields());
        $this->data['current_url'] = $_SERVER['REQUEST_URI'];
        $this->data['add_attribute_placeholder'] = $this->language->get('add_attribute_placeholder');
        $this->getter();
    }

    private function generateOC_Attributes(){
        $attributes = $this->model_extension_module_itdaat_attributer->getAttributeToSet();
        $this->data['itdaat_oc_attribute_name'] = $attributes['name'];
        unset($attributes['name']);
        $this->data['itdaat_oc_attribute_values'] = $attributes;
    }
}