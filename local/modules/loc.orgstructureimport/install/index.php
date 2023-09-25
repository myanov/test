<?php
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class loc_orgstructureimport extends CModule
{
    var $MODULE_ID = "loc.orgstructureimport";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = array();

        include(__DIR__ . '/version.php');

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = GetMessage("LOS_MODULE_NAME");
        $this->MODULE_DESCRIPTION = GetMessage("LOS_MODULE_DESCRIPTION");
        $this->PARTNER_NAME = GetMessage("LOS_PARTNER");
        $this->PARTNER_URI = GetMessage("LOS_PARTNER_URI");
    }


    function InstallDB($install_wizard = true)
    {
        ModuleManager::registerModule("loc.orgstructureimport");
        return true;
    }

    function UnInstallDB($arParams = array())
    {
        ModuleManager::unRegisterModule("loc.orgstructureimport");
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function InstallFiles()
    {
        return true;
    }

    function InstallPublic()
    {
    }

    function UnInstallFiles()
    {
        return true;
    }

    function DoInstall()
    {
        global $APPLICATION, $step;

        $this->InstallFiles();
        $this->InstallDB(false);
        $this->InstallEvents();
        $this->InstallPublic();
    }

    function DoUninstall()
    {
        global $APPLICATION, $step;

        $this->UnInstallDB();
        $this->UnInstallFiles();
        $this->UnInstallEvents();
    }

    function GetModuleRightList()
    {
        $arr = array(
            "reference_id" => array("D", "R", "W"),
            "reference" => array(
                "[D] ".Loc::getMessage("LOS_PERM_D"),
                "[R] ".Loc::getMessage("LOS_PERM_R"),
                "[W] ".Loc::getMessage("LOS_PERM_W")
            )
        );
        return $arr;
    }
}
?>