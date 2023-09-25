<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
$module_id = "loc.orgstructureimport";
$bizprocPerms = $APPLICATION->GetGroupRight($module_id);
if ($bizprocPerms >= "R") :

    CModule::IncludeModule("loc.orgstructureimport");

    IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
    IncludeModuleLangFile(__FILE__);

    $aTabs = array(
        array("DIV" => "edit1", "TAB" => GetMessage("LOS_GENERAL"), "ICON" => "", "TITLE" => GetMessage("LOS_GENERAL")),
    );
    $tabControl = new CAdminTabControl("tabControl", $aTabs);
    $tabControl->Begin();
    ?>
    <div><?
        echo bitrix_sessid_post();
        $tabControl->BeginNextTab();
        ?>
        <tr>
            <td width="50%" valign="top" style="vertical-align: middle;"><?= GetMessage("LOS_IMPORT_ORGSTRUCTURE") ?>:</td>
            <td width="50%" valign="top">
                <div>
                    <form id="import_orgstructure" class="import-orgstructure-form">
                        <table>
                            <tbody>
                            <tr>
                                <td id="error_messages">

                                </td>
                            </tr>
                            <tr>
                                <td><input type="file" id="org_structure_imported_file" name="imported_file"></td>
                                <td><input type="button" id="import_org_structure" name="import_btn" value="<?= Loc::getMessage('LOS_IMPORT_BTN') ?>"></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </td>
        </tr>
    <?$tabControl->End();?>
    </div>
<?endif;?>

<script>
    BX.ready(function(){
        BX.bind(BX('import_org_structure'), 'click', BX.proxy(sendImportOrgStructure, this));
    });

    function sendImportOrgStructure(e){
        const orgStructureForm = BX('import_orgstructure');

        BX.addClass(orgStructureForm, 'loader');
        let data = new FormData(orgStructureForm);
        console.log(data);
        BX.ajax.runAction('loc:orgstructureimport.OrgStructure.import', {
            data: data
        }).then(function (response) {
            console.log(response);
        }, function (response) {
            //сюда будут приходить все ответы, у которых status !== 'success'
            console.log(response);
        });

        // BX.ajax({
        //     url: '/local/modules/rockwool.import/ajax.php',
        //     data: data,
        //     method: 'POST',
        //     dataType: 'json',
        //     processData: false,
        //     preparePost: false,
        //     onsuccess: function(data){
        //         BX.removeClass(BX('rw-import-org'), 'loader');
        //         BX.addClass(BX('rw-import-result'), 'success');
        //         BX.adjust(BX('rw-import-result'), {text: 'Import completed!'});
        //     },
        //     onfailure: function(){
        //         BX.addClass(BX('rw-import-result'), 'error');
        //         BX.adjust(BX('rw-import-result'), {text: 'Import error!'});
        //     }
        // });
        return BX.PreventDefault(e);
    }
</script>
