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
        $this->addItdaatAttribute();
        $this->editItdaatAttribute();
        $this->connectItdaatAttributerDictionary();
        $this->connectedToItdaatAttribute();
        $this->generateViewData();
        $this->module();
    }

    private function module()
    {
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run([]);
    }

    private function addItdaatAttribute()
    {
        if (!isset($_POST['action'])) {
            return;
        }
        if (!isset($_POST['itdaat_attributes_name'])) {
            $this->data['back_url'] = $_SERVER['REQUEST_URI'];
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_add_itdaat_attribute';
        } else {
            if($_POST['action'] == 'new_itdaat_attribute'){
                $this->viewPath = self::MODULE_LINK;
                $this->data['back_url'] = $_SERVER['REQUEST_URI'];
                
                
                if (isset($_POST['itdaat_oc_attributes'])) {
                    $itdaat_attributes = $_POST['itdaat_oc_attributes'];
                } else {
                    $itdaat_attributes = null;
                }    
                $itdaat_attributes_name = $_POST['itdaat_attributes_name'];
                $itdaat_attr_id = $this->model_extension_module_itdaat_attributer->addItdaatAttribute($itdaat_attributes_name, $itdaat_attributes);
                $languages = $this->settings->getValueByKey('languages');
                $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
                $language_id = (($language_id)[0])['language_id'];
                foreach ($itdaat_attributes as $key => $value) {
                    $this->model_extension_module_itdaat_attributer->addItdaatAttributeValue($language_id, $itdaat_attr_id, $value);
                }
            }
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
            $this->document->addScript('view/javascript/itdaat/attributer/conectAttribute.js');
            $this->data['no'] = $this->language->get('select_none');
            $this->data['new'] = $this->language->get('select_new');
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute';


            $attribute_id = $action[1];
            $itdaat_attribute = $this->model_extension_module_itdaat_attributer->getItdaatAttributeByID($attribute_id, $language_id);
            $this->data['itdaat_attribute_id'] = $attribute_id;
            $this->data['itdaat_attribute_name'] = $this->model_extension_module_itdaat_attributer->getItdaatAttributeName($attribute_id, $language_id);
            $this->data['itdaat_attribute_values'] = $itdaat_attribute;
        }

        // if($action[0] == '')

    }

    private function connectedToItdaatAttribute()
    {
        if (!isset($_POST['action'])) {
            return;
        }
        $action = explode("|", $_POST['action']);
        if ($action[0] == 'connected_itdaat_attribute') {
            $this->data['back_url'] = $_SERVER['REQUEST_URI'];
            $this->viewPath = 'extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute';



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

    private function editItdaatAttribute()
    {
        $attribute_id = null;
        if (isset($_POST['action'])) {
            $action = explode("|", $_POST['action']);
            if ($action[0] == 'edit_itdaat_attribute') {
                $attribute_id = $action[1];
                $languages = $this->settings->getValueByKey('languages');
                $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
                $language_id = (($language_id)[0])['language_id'];
                $itdaat_attribute = $this->model_extension_module_itdaat_attributer->getItdaatAttributeByID($attribute_id, $language_id);
                $this->log->log($itdaat_attribute);
            }
        }
        if ($attribute_id == null) {
            return;
        }
    }

    private function generateViewData()
    {
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data, 'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->generateOC_Attributes();

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
