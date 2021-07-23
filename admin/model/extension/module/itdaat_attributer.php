<?php
require_once (DIR_SYSTEM . '/engine/itdaat_model.php');

class ModelExtensionModuleItdaatAttributer extends ModelItDaat {
    public function __construct(){
        $this->moduleCode = 'attributer';
        $this->run($this->moduleCode);
    }


    public function addItdaatAttribute($itdaat_attributes_name){
        $this->database->setRequest("insert into oc_itdaat_attribute () values ();");
        $this->database->getAssocRequest("select max(id) as id from oc_itdaat_attribute;");
        $attr_id = ($this->database->getKeyToValue_Field())['id'];
        foreach($itdaat_attributes_name as $language_id =>$attribute_name){
            $this->database->setRequest("insert into oc_itdaat_attribute_name (itdaat_attribute_id, language_id, name) values ({$attr_id},{$language_id},'{$attribute_name}');");
        }
        return  $attr_id;
    }

    public function addItdaatAttributeValue($language_id, $itdaat_attribute_id, $value){
        $this->database->setRequest("insert into oc_itdaat_attribute_value (language_id, itdaat_attribute_id, value) values ({$language_id}, {$itdaat_attribute_id}, '{$value}');");
        $this->database->getAssocRequest("select max(id) as id from oc_itdaat_attribute_value;");
        $attr_value_id = ($this->database->getKeyToValue_Field())['id'];
        return $attr_value_id;
    }


    public function getItdaatAttributeName($attr_id, $language_id) {
        return ($this->database->getAssocRequest("
            select name from oc_itdaat_attribute_name
            where oc_itdaat_attribute_name.language_id = {$language_id} and oc_itdaat_attribute_name.itdaat_attribute_id = {$attr_id}
        "))[0]['name'];
    }

    public function deleteItdaatAttributeValue($attr_val_id, $language_id){
        $this->database->setRequest("
            delete from oc_itdaat_attribute_value where language_id = {$language_id} and id = {$attr_val_id};
        ");
        $this->database->setRequest("
            update oc_itdaat_dictionary set itdaat_attribute_value_id = null, itdaat_attribute_id = null where itdaat_attribute_value_id = {$attr_val_id}
        ");
    }

    public function deleteItdaatAttribute($attr_id){
        $this->database->setRequest("
            delete from oc_itdaat_attribute where id = {$attr_id};
        ");
        $this->database->setRequest("
            delete from oc_itdaat_attribute_name where itdaat_attribute_id = {$attr_id};
        ");
        $this->database->setRequest("
            delete from oc_itdaat_attribute_value where itdaat_attribute_id = {$attr_id};
        ");
        $this->database->setRequest("
            update oc_itdaat_dictionary set itdaat_attribute_id = null, itdaat_attribute_value_id = null where itdaat_attribute_id = {$attr_id}
        ");
    }

    public function searchItdaatAttributeByName($name,$language_id){
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
            where oc_itdaat_attribute_name.language_id = {$language_id} and oc_itdaat_attribute_name.name like '%{$name}%' and oc_itdaat_attribute.id = 
        "; 
        $itdaat_attributes = $db->getAssocRequest("SELECT id from oc_itdaat_attribute");
        $res = [];
        $rows = [];
        foreach ($itdaat_attributes as $key => $attr){
            $rows[$key] = $db->getAssocRequest($query . $attr['id']);
            $r = [];
            foreach ($rows[$key] as &$row){
                $r['name'] = $row['name']; 
                $r['id'] = $row['itdaat_attribute_id'];
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
        $this->log->log($res);
        return $res;
        // $this->log->log($res, "dbRes");
    }

    public function getItdaatAttributeByID($attr_id, $language_id){
        return $this->database->getAssocRequest("
            select oc_itdaat_attribute_value.value, oc_itdaat_attribute_value.id from oc_itdaat_attribute_name
                left join oc_itdaat_attribute_value
                    on oc_itdaat_attribute_name.language_id = oc_itdaat_attribute_value.language_id and oc_itdaat_attribute_name.itdaat_attribute_id = oc_itdaat_attribute_value.itdaat_attribute_id
            where oc_itdaat_attribute_name.language_id = {$language_id} and oc_itdaat_attribute_name.itdaat_attribute_id = {$attr_id}
         ");
    }

    public function setOcAttributeToDictionary($attr_id, $language_id, $attr_value, $itdaat_attribute_id, $itdaat_attribute_value_id){
        $this->database->setRequest("
            update oc_itdaat_dictionary set itdaat_attribute_id = {$itdaat_attribute_id}, itdaat_attribute_value_id = {$itdaat_attribute_value_id}
            where language_id = {$language_id} and oc_attribute_id = {$attr_id} and  oc_attribute_value = '{$attr_value}';
        ");
    }

    public function updateItdaatAttributeValue($attr_val_id, $attr_value){
        $this->database->setRequest("
            update oc_itdaat_attribute_value set value = '{$attr_value}' where id = {$attr_val_id};
        ");
    }

    public function syncDictionary(){
        $this->database->setRequest("
            delete from oc_product_attribute where attribute_id is null;
        ");
        $this->database->setRequest("
            if (select count(*) from oc_itdaat_product_attribute) > 0 then
                delete from oc_itdaat_product_attribute2;
                insert into oc_itdaat_product_attribute2 (attribute_id, language_id, product_id, text)
            select oc_itdaat_product_attribute.attribute_id, oc_itdaat_product_attribute.language_id, oc_itdaat_product_attribute.product_id, oc_itdaat_product_attribute.text from oc_itdaat_product_attribute;
    
            delete  from oc_itdaat_product_attribute;
            end if;
        ");
        $this->database->setRequest("
            insert into oc_product_attribute (attribute_id,language_id,product_id,text)
            select oc_itdaat_product_attribute2.attribute_id, oc_itdaat_product_attribute2.language_id, oc_itdaat_product_attribute2.product_id, oc_itdaat_product_attribute2.text from oc_itdaat_product_attribute2;
        ");
    }

    public function getAttributeToSet(){
        $languages = $this->settings->getValueByKey('languages');
        $language_id = $this->database->getAssocRequest("select language_id from oc_language where name = '{$languages}' ");
        $language_id = (($language_id)[0])['language_id'];
        $attributes_not_formatted = $this->database->getAssocRequest("
            select * from oc_itdaat_dictionary 
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
            $row['id'] = $attribute['language_id'] . '|' . $attribute['oc_attribute_id'] . '|' . $attribute['oc_attribute_value'];
            $attributes[] = $row;
        }
        return $attributes;
    }
    
    /**
     * connectItdaatAttributes
     * this function connects all attributes in the array
     * @return void
     */
    public function connectItdaatAttributes(){
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
                $r['id'] = $row['itdaat_attribute_id'];
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