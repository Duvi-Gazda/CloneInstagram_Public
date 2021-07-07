<?php
require_once (dirname (__FILE__). '/Itdaat.php');
class Attributer extends Parent_IT_daat{
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
        $this->settings->getDataFromDatabase($this->moduleCode());
        if($this->settings->getModuleStatus($this->moduleCode()) != 1) {

        } else {

        }
    }
}