<?php
require_once (DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once (DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');

class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat {
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index(){
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = DIR_SYSTEM.'/ITdaat/itdaat_attributer.php';
        $this->run(self::MODULE_LINK,'extension/module');
        $this->addItdaat_Attribute();
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
            $this->data['itdaat_attributes_type'] = $_POST['action'];
            switch($this->data['itdaat_attributes_type']){
                case 'new_itdaat_attribute': 
                    $this->setDefaultOutput('extension/module/itdaat_attributer_add_itdaat_attribute');
                    break;
                case 'add_new_attribute_add':
                    // todo get all itdaat attributes and check if they are not are checked. All checked have to be added in the array that will be set in the database
                    $this->setDefaultOutput('extension/module/itdaat_attributer_add_itdaat_attribute');
                    break;
            }
        } else{
            $this->setDefaultOutput(self::MODULE_LINK);
        }
    }

    private function addItdaat_Attribute (){

        if(!isset($_POST['itdaat_oc_attributes'] )|| !is_array($_POST['itdaat_oc_attributes'])){
            return [];
        }        

        if(isset($_POST['itdaat_oc_attributes']))
        
        $itdaat_attributes = $_POST['itdaat_oc_attributes'];

        $this->database->getAssocRequest("select language_id, name from oc_language");
        $languages = $this->database->getFields();
        $this->data['itdaat_languages'] = $languages;

    }

    private function generateViewData(){
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data,'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->generateOC_Attributes();

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
        $this->data['itdaat_attributes'] = $this->connectItdaatAttributes($this->database->getFields());
        $this->data['current_url'] = $_SERVER['REQUEST_URI'];
        $this->data['add_attribute_placeholder'] = $this->language->get('add_attribute_placeholder');
        $this->getter();
    }

    private function generateOC_Attributes(){
        $attributes = $this->getAttributeToSet();
        $this->data['itdaat_oc_attribute_name'] = $attributes['name'];
        unset($attributes['name']);
        $this->data['itdaat_oc_attribute_values'] = $attributes;
    }

    private function getAttributeToSet(){
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        $attributes_not_formatted = $this->database->getAssocRequest("
            select oc_attribute_description.name, oc_itdaat_dictionary.oc_attribute_value, oc_attribute_description.attribute_id from oc_itdaat_dictionary 
            inner join oc_attribute_description
            on oc_itdaat_dictionary.oc_attribute_id = oc_attribute_description.attribute_id and oc_attribute_description.language_id = oc_itdaat_dictionary.language_id
            where oc_itdaat_dictionary.itdaat_attribute_id is null and oc_itdaat_dictionary.itdaat_attribute_value_id is null and 
            oc_itdaat_dictionary.oc_attribute_id = (select MIN(oc_itdaat_dictionary.oc_attribute_id)  from oc_itdaat_dictionary where oc_itdaat_dictionary.itdaat_attribute_id is null and oc_itdaat_dictionary.itdaat_attribute_value_id is null and oc_itdaat_dictionary.language_id = {$language_id})
            and oc_itdaat_dictionary.language_id = {$language_id}
            ORDER BY oc_itdaat_dictionary.oc_attribute_id ASC
        ");
        $row = [];
        $attributes = [];
        foreach ($attributes_not_formatted as $attribute){
            $attributes['name'] = $attribute['name'];
            $row['value'] = $attribute['oc_attribute_value'];
            $attributes[] = $row;
        }
        return $attributes;
    }
    
    /**
     * connectItdaatAttributes
     * this function connects all attributes in the array
     * @return void
     */
    private function connectItdaatAttributes(){
        $db = new itdaat_database();
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        $query = "
            SELECT
            oc_itdaat_attribute_name.name,
            oc_itdaat_attribute_value.value,
            oc_itdaat_attribute_name.itdaat_attribute_id
            from
            oc_itdaat_attribute
            left join oc_itdaat_attribute_name on oc_itdaat_attribute.id = oc_itdaat_attribute_name.itdaat_attribute_id
            left join oc_itdaat_attribute_value on oc_itdaat_attribute_value.itdaat_attribute_id = oc_itdaat_attribute.id and oc_itdaat_attribute_name.language_id = oc_itdaat_attribute_value.language_id
            where oc_itdaat_attribute_name.language_id = '$language_id' and oc_itdaat_attribute.id = 
        "; 
        $itdaat_attributes = $db->getAssocRequest("SELECT id from oc_itdaat_attribute");
        $res = [];
        $rows = [];
        foreach ($itdaat_attributes as $key => $attr){
            $rows[$key] = $db->getAssocRequest($query . $attr['id'] . " limit 100");
            $r = [];
            foreach ($rows[$key] as &$row){
                $r['name'] = $row['name']; 
                $r['id'] = $row['id'];
                if(isset($r['value'])){
                    $r['value'] = $r['value'] . ', ' . $row['value'];
                } else {
                    $r['value'] = $row['value'];
                }
            }
            if($r != []){
                $res[] = $r;
            }
        }
        return $res;
    }
}