<?php
require_once (DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once (DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');

class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat {
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index(){
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = DIR_SYSTEM.'/ITdaat/itdaat_attributer.php';
        $this->run(self::MODULE_LINK,'extension/module');
        $this->generateViewData();
        $this->module();
    }
    
    private function module(){
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run([]);
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
        $this->setDefaultOutput(self::MODULE_LINK);
    }

    private function generateOC_Attributes(){
        $attributes = $this->getAttributeToSet();
        $this->data['itdaat_oc_attribute_name'] = $attributes['name'];
        unset($attributes['name']);
        $this->data['itdaat_oc_attribute_values'] = $attributes;
    }

    private function getAttributeToSet(){
        $attributes_not_formatted = $this->database->getAssocRequest("
            select oc_attribute_description.name, oc_itdaat_dictionary.oc_attribute_value, oc_attribute_description.attribute_id from oc_itdaat_dictionary 
            inner join oc_attribute_description
            on oc_itdaat_dictionary.oc_attribute_id = oc_attribute_description.attribute_id and oc_attribute_description.language_id = oc_itdaat_dictionary.language_id
            where oc_itdaat_dictionary.itdaat_attribute_id is null and oc_itdaat_dictionary.itdaat_attribute_value_id is null and 
            oc_itdaat_dictionary.oc_attribute_id = (select MIN(oc_itdaat_dictionary.oc_attribute_id)  from oc_itdaat_dictionary where oc_itdaat_dictionary.itdaat_attribute_id is null and oc_itdaat_dictionary.itdaat_attribute_value_id is null)
            ORDER BY oc_itdaat_dictionary.oc_attribute_id ASC
        ");
        $row = [];
        $attributes = [];
        foreach ($attributes_not_formatted as $attribute){
            $attributes['name'] = $attribute['name'];
            $row['value'] = $attribute['oc_attribute_value'];
            $attributes[] = $row;
        }
        $this->log->log($attributes);
        return $attributes;
    }

    private function connectItdaatAttributes(){
        $db = new itdaat_database();
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        $query = "
        SELECT
        oc_itdaat_attribute_name.name,
        oc_itdaat_attribute_value.value
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