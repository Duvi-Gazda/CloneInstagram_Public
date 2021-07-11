<?php
require_once (dirname (__FILE__). '/Itdaat.php');
class Test extends Parent_IT_daat {
    protected function moduleCode(): string {
        return 'photo_for_categories';
    }
    protected function moduleName(): string {
        return 'Test';
    }
    protected function moduleUniqueKey(): string
    {
        return 'jjdiaJIJdfl';
    }
    public function run(array $data): void {
        parent::run($data);
        $this->settings->getDataFromDatabase($this->moduleCode());
        $license = $this->settings->getValueByKey('license');
        echo $license;
        $this->log->log($this->generateLicense('llorry.shop',$this->moduleCode(),date("Y-m-d"),$this->moduleUniqueKey()));
        if($this->decodeLicenseToArray((string)$license,$this->moduleUniqueKey()) != null){
            $this->log->log('test is opened', 'Test.php');
        }
    }
}
$test = new Test();
$test->run([]);