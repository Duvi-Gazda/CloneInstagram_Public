<?php
require_once (DIR_SYSTEM . '/engine/itdaat_controller.php');
require_once (DIR_SYSTEM . '/ITdaat/itdaat_attributer.php');
class ControllerExtensionModuleItdaatAttributer extends ControllerItdaat {
    const MODULE_LINK  = 'extension/module/itdaat_attributer';
    public function index(){
        $this->moduleCode = 'attributer';
        $this->moduleFilePath = $_SERVER['SERVER_NAME'].'/system/ITdaat/attributer.php';
        $this->run(self::MODULE_LINK,'extension/module');
        $this->generateBreadcrumbs($this->data, self::MODULE_LINK);
        $this->addCancelButton($this->data,'marketplace/extension');
        $this->addSaveSettingsButton($this->data, self::MODULE_LINK);
        $this->setDefaultOutput(self::MODULE_LINK);
        $this->includeModule();
        $this->module = new Attributer();
        $this->module->run();
        if(isset($_GET['updated']) && $_GET['updated'] == 'true'){
            $this->runModule();
        }
//        itdaat_attributes
    }
}