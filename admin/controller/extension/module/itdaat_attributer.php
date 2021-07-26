<?php

require_once(DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once(DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');

class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat
{
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index()
    {
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = DIR_SYSTEM . '/ITdaat/itdaat_attributer.php';
        $this->run(self::MODULE_LINK, 'extension/module');
        $this->load->model('extension/module/itdaat_attributer');
        $this->document->addScript('view/javascript/itdaat/attributer/conectAttribute.js');


        $this->database->getAssocRequest("select language_id, name from oc_language");
        $this->data['itdaat_languages'] = $this->database->getFields();

        $this->database->getAssocRequest("select name from oc_language");
        $languages = $this->database->getValueToValue_Field();
        $this->addFullInputSelect(
            'languages',
            $languages,
            $this->data,
            $this->language->get('Languages'),
            'languages',
        );

        $this->post_listener();
        $this->deleteItdaatAttribute();
        $this->connectItdaatAttributerDictionary();
        $this->connectedToItdaatAttribute();
        $this->syncDictionary();
        $findAttribute = $this->searchAttributeByName();
        if($_POST['action'] == 'search_attribute_by_name'){
            echo json_encode($findAttribute);
            return; 
        }
        $this->generateViewData();
        $this->module();
    }

    private function module()
    {
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run([]);
    }

    private function post_listener(){
        if(!isset($this->request->post)){return;}
        $this->data['back_url'] = $_SERVER['REQUEST_URI'];
        $action = $this->request->post['action'];
        switch($action){
            case 'new_itdaat_attribute':
                $this->addItdaatAttributePage();
                break;
            case '':
                break;
        }
    }

    private function getSelectedLanguage():int{
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        return $language_id;
    }

    private function addItdaatAttributePage(){
        if(!isset($this->request->post['itdaat_attributes_name'])){
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_add_itdaat_attribute';
        } else{
            $this->viewPath = self::MODULE_LINK;
            $this->addItdaatAttribute();
        }
    }

    private function addItdaatAttribute(){
        $oc_attributes = $this->request->post['itdaat_oc_attributes'];
        $itdaat_attributes_name = $this->request->post['itdaat_attributes_name'];
        $itdaat_attr_id = $this->model_extension_module_itdaat_attributer->addItdaatAttribute($itdaat_attributes_name, $oc_attributes);
        foreach ($oc_attributes as $key => $value) {
            $this->model_extension_module_itdaat_attributer->addItdaatAttributeValue($this->getSelectedLanguage(), $itdaat_attr_id, $value);
        }
    }

    private function connectItdaatAttributerDictionary()
    {
        if (!isset($_POST['action'])) {
            return;
        }
        $action = explode("|", $_POST['action']);
        if ($action[0] == 'connect_itdaat_attribute' || $action[0] == 'delete_itdaat_attribute_value') {
            $languages = $this->settings->getValueByKey('languages');
            $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
            $language_id = (($language_id)[0])['language_id'];

            if($action[0] == 'delete_itdaat_attribute_value'){
                if(isset($action[2])){
                    $attribute_value_id = $action[2];
                    $this->model_extension_module_itdaat_attributer->deleteItdaatAttributeValue($attribute_value_id,$language_id);
                }
            }


            $this->data['back_url'] = $_SERVER['REQUEST_URI'];
            $this->data['no'] = $this->language->get('select_none');
            $this->data['new'] = $this->language->get('select_new');
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute';


            $attribute_id = $action[1];
            $itdaat_attribute = $this->model_extension_module_itdaat_attributer->getItdaatAttributeByID($attribute_id, $language_id);
            $this->data['itdaat_attribute_id'] = $attribute_id;
            $this->data['itdaat_attribute_name'] = $this->model_extension_module_itdaat_attributer->getItdaatAttributeName($attribute_id, $language_id);
            $this->data['itdaat_attribute_values'] = $itdaat_attribute;
        }

        if($action[0] == 'change_itdaat_attribute'){
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute';

        }

    }

    private function connectedToItdaatAttribute()
    {
        if (!isset($_POST['action'])) {
            return;
        }
        $action = explode("|", $_POST['action']);
        if ($action[0] == 'connected_itdaat_attribute') {
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute';
            $this->data['back_url'] = $_SERVER['REQUEST_URI'];

            $itdaat_attribute_values = $_POST['itdaat_attribute_values'];
            foreach($itdaat_attribute_values as $key => $value){
                $languages = $this->settings->getValueByKey('languages');
                $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
                $language_id = (($language_id)[0])['language_id'];
                $this->model_extension_module_itdaat_attributer->updateItdaatAttributeValue($key,$value);
            }


            $attributes = $_POST['attribute_action'];
            $this->viewPath = self::MODULE_LINK;
            foreach ($attributes as $id => $value) {
                if ($value == 'no') continue;
                $itdaat_attr_id = $action[1];
                $attribute = explode("|", $id, 3);
                $language_id = $attribute[0];
                $oc_attribute_id = $attribute[1];
                $oc_attribute_value = $attribute[2];
                if ($value == 'new') {
                    $value = $this->model_extension_module_itdaat_attributer->addItdaatAttributeValue($language_id, $itdaat_attr_id, $oc_attribute_value);
                }
                $this->model_extension_module_itdaat_attributer->setOcAttributeToDictionary($oc_attribute_id, $language_id, $oc_attribute_value, $itdaat_attr_id, $value);
            }
        }
    }

    private function deleteItdaatAttribute()
    {
       if(!isset($_POST['action'])){
           return;
       }
       $action = explode('|', $_POST['action']);
        if($action[0] == 'delete_itdaat_attribute'){
            $this->viewPath = self::MODULE_LINK;
            $this->model_extension_module_itdaat_attributer->deleteItdaatAttribute($action[1]);
        }
    }

    public function syncDictionary(){
        if(!isset($_POST['action'])){
            return;
        }
        if($_POST['action'] == 'sync'){
            $this->viewPath = self::MODULE_LINK;
            $this->model_extension_module_itdaat_attributer->syncDictionary();
        }
    }

    public function searchAttributeByName(){
        if(!isset($_POST['action'])){
            return;
        }
        if($_POST['action'] == 'search_attribute_by_name'){
            $languages = $this->settings->getValueByKey('languages');
            $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
            $language_id = (($language_id)[0])['language_id'];
            $res =  $this->model_extension_module_itdaat_attributer->searchItdaatAttributeByName($_POST['attribute_name'],$language_id);
            return $res != null ? $res : false;
        }
    }

    private function generateViewData()
    {
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data, 'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->generateOC_Attributes();
        $this->data['itdaat_attributes'] = $this->model_extension_module_itdaat_attributer->connectItdaatAttributes($this->database->getFields());
        $this->data['current_url'] = $_SERVER['REQUEST_URI'];
        $this->data['add_attribute_placeholder'] = $this->language->get('add_attribute_placeholder');

        $this->setDefaultOutput($this->viewPath == null ? self::MODULE_LINK : $this->viewPath);
    }

    private function generateOC_Attributes()
    {
        $attributes = $this->model_extension_module_itdaat_attributer->getAttributeToSet();
        $this->data['itdaat_oc_attribute_name'] = $attributes['name'];
        unset($attributes['name']);
        $this->data['itdaat_oc_attribute_values'] = $attributes;
    }
}
