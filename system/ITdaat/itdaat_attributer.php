<?php
require_once (dirname (__FILE__). '/Itdaat.php');
require_once (dirname(dirname(__FILE__)). '/helper/itdaat_database.php');
final class Attributer extends Parent_IT_daat{
    protected function moduleUniqueKey(): string
    {
        return 'Hijo8890JKojkd';
    }

    protected function moduleCode(): string
    {
        return 'attributer';
    }

    protected function moduleName(): string
    {
        return 'Attributer';
    }
    public function run (array $data):void{
        parent::run($data);
        $product_attribute = new itdaat_database('oc_product_attribute');
        $database = new itdaat_database();
        $this->settings->getDataFromDatabase($this->moduleCode());
        if($this->settings->getModuleStatus($this->moduleCode()) != 1) {

        } else {
            $database->createTable('');
        }
    }

}