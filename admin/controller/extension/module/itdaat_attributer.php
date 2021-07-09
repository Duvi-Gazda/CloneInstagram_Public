<?php
require_once (DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once (DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');

class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat {
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index(){
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = DIR_SYSTEM.'/ITdaat/itdaat_attributer.php';
        $this->run(self::MODULE_LINK,'extension/module');
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data,'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->database->getAssocRequest("
            SELECT
                oc_itdaat_attribute_name.name,
                oc_itdaat_attribute_value.value
            from
                oc_itdaat_attribute
                left join oc_itdaat_attribute_name on oc_itdaat_attribute.id = oc_itdaat_attribute_name.itdaat_attribute_id
                left join oc_itdaat_attribute_value on oc_itdaat_attribute_value.itdaat_attribute_id = oc_itdaat_attribute.id;
        ");
        $this->database->deleteByValue_Field(null);
        $this->data['itdaat_attributes'] = $this->connectItdaatAttributes($this->database->getFields());
        $this->setDefaultOutput(self::MODULE_LINK);
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run([]);
    }
    private function connectItdaatAttributes(){
        $db = new itdaat_database();
        $query = "
        SELECT
        oc_itdaat_attribute_name.name,
        oc_itdaat_attribute_value.value
    from
        oc_itdaat_attribute
        left join oc_itdaat_attribute_name on oc_itdaat_attribute.id = oc_itdaat_attribute_name.itdaat_attribute_id
        left join oc_itdaat_attribute_value on oc_itdaat_attribute_value.itdaat_attribute_id = oc_itdaat_attribute.id and oc_itdaat_attribute_name.language_id = oc_itdaat_attribute_value.language_id
            where oc_itdaat_attribute.id = 
        ";
        $itdaat_attributes = $db->getAssocRequest("SELECT id from oc_itdaat_attribute");
        $res = [];
        $rows = [];
        foreach ($itdaat_attributes as $key => $attr){
            $rows[$key] = $db->getAssocRequest($query . $attr['id']);
            $r = [];
            foreach ($rows[$key] as &$row){
                $r['name'] = $row['name']; 
                if(isset($r['value'])){
                    $r['value'] = $r['value'] . ', ' . $row['value'];
                } else {
                    $r['value'] = $row['value'];
                }
            }
            $res[] = $r;
        }
        return $res;
    }
}