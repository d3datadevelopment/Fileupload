[{include file="headitem.tpl" title="D3_CFG_MOD"|oxmultilangassign}]

<script type="text/javascript">
<!--
[{if $updatelist == 1}]
    UpdateList('[{$oxid}]');
[{/if}]

function UpdateList( sID)
{
    var oSearch = parent.list.document.getElementById("search");
    oSearch.oxid.value=sID;
    oSearch.fnc.value='';
    oSearch.submit();
}

function EditThis( sID)
{
    var oTransfer = document.getElementById("transfer");
    oTransfer.oxid.value=sID;
    oTransfer.cl.value='';
    oTransfer.submit();

    var oSearch = parent.list.document.getElementById("search");
    oSearch.actedit.value = 0;
    oSearch.oxid.value=sID;
    oSearch.submit();
}

function _groupExp(el) {
    var _cur = el.parentNode;

    if (_cur.className == "exp") _cur.className = "";
      else _cur.className = "exp";
}

-->
</script>

<style type="text/css">
<!--
fieldset{
    border: 1px inset black;
    background-color: #F0F0F0;
}

legend{
    font-weight: bold;
}

.groupExp dl dt{
    font-weight: normal;
    width: 55%;
    padding-left: 10px;
}

.groupExp.highlighted {
   background-color: #CD0210;
}
.groupExp.highlighted a.rc b {
   color: white;
}
.groupExp.highlighted .exp a.rc b {
   color: black;
}
.groupExp.highlighted .exp {
   background-color: #F0F0F0;
}

.ext_edittext {
    padding: 2px;
}

td.edittext {
    white-space: normal;
}

.confinput {
    width: 300px;
    height: 70px;
}
-->
</style>

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="actshop" value="[{$shop->id}]">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
    <input type="hidden" name="fnc" value="save">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="crontype" value="">
    <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">

    <table border="0" width="98%">
        [{block name="d3fileupload_settings_main"}]
            <tr>
                <td valign="top" class="edittext">

                    [{include file="d3_cfg_mod_active.tpl"}]
                    
                    [{if $oView->getValueStatus() == 'error'}]
                        <b>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_DESC"}]</b>
                        <br>
                        <br>
                        <span class="d3modcfg_btn fixed icon d3color-orange">
                            <button type="submit">
                                <i class="fa fa-warning fa-inverse"></i>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_BTN"}]
                            </button>
                        </span>
                    [{else}]

                        <div class="groupExp">
                            <div class="">
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_CFG_MOD_d3fileupload_SETTINGS"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="sD3UploadDir">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_sD3UploadDir"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="sD3UploadDir" type="text" name="value[sD3UploadDir]" value="[{$oView->getUploadDir()}]" size="20" maxlength="50">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_sD3UploadDir_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="sD3UploadPermdir">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_sD3UploadPermDir"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="text" id="sD3UploadPermdir" name="value[sD3UploadPermdir]" value="[{$oView->getDefaultPermissions('dir')}]" size="6" maxlength="4">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_sD3UploadPerm_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="sD3UploadPermfile">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_sD3UploadPermFile"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="sD3UploadPermfile" type="text" name="value[sD3UploadPermfile]" value="[{$oView->getDefaultPermissions('file')}]" size="6" maxlength="4">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_sD3UploadPerm_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="iD3MaxUploadSize">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_iD3MaxUploadSize"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="iD3MaxUploadSize" class="edittext" type="text" name="iD3MaxUploadSize" value="[{$oView->getShorthandModuleMaxUploadFileSize()}]" size="6" maxlength="6">
                                        <select class="edittext" name="iD3MaxUploadSizeMultiplier" >
                                            [{foreach from=$oView->getFileSizeUnits() key="iMultiplier" item="sUnit"}]
                                                <option value="[{$iMultiplier}]" [{if $oView->getShorthandModuleMaxUploadFileSizeUnit() == $sUnit}]selected[{/if}]>[{$sUnit}]</option>
                                            [{/foreach}]
                                        </select>
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_HELP"}]
                                        ([{oxmultilang ident="D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_SERVER"}] [{$oView->getSystemUploadSizeRestrictions()}])
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="iD3MaxUploadFiles">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="iD3MaxUploadFiles" type="text" name="value[iD3MaxUploadFiles]" value="[{$oView->getMaxUploadFileCount()}]" size="2" maxlength="4">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="aD3AllowedUpladFileExtensions">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions"}]</label>
                                    </dt>
                                    <dd>
                                        <textarea id="aD3AllowedUpladFileExtensions" cols="35" rows="10" class="confinput" name="valuearr[aD3AllowedUpladFileExtensions]" id="d3_cfg_mod__d3fileupload_aD3AllowedUpladFileExtensions">[{$oView->getAllowedUploadFileExtensions()}]</textarea>
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="blVariantInheritUpload">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_blVariantInheritUpload"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blVariantInheritUpload]" value="0">
                                        <input id="blVariantInheritUpload" type="checkbox" name="value[blVariantInheritUpload]" value="1" [{if $edit->getEditValue('blVariantInheritUpload') == '1'}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_blVariantInheritUpload_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="blAllowFixation">[{oxmultilang ident="D3_CFG_MOD_d3fileupload_blAllowFixation"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blAllowFixation]" value="0">
                                        <input id="blAllowFixation" type="checkbox" name="value[blAllowFixation]" value="1" [{if $edit->getEditValue('blAllowFixation') == '1'}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_CFG_MOD_d3fileupload_blAllowFixation_HELP"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <div class="groupExp">
                            <div class="">
                                <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                    <b>
                                        [{oxmultilang ident="D3_FILEUPLOAD_SET_CRON"}] [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_DESC"}]
                                    </b>
                                </a>
                                <dl>
                                    <dt>
                                        <label for="SetCronActive">[{oxmultilang ident="D3_FILEUPLOAD_SET_CRON_ACTIVE"}]</label>
                                    </dt>
                                    <dd>
                                        <input type="hidden" name="value[blCronActive]" value="0">
                                        <input id="SetCronActive" class="edittext ext_edittext" type="checkbox" name="value[blCronActive]" value='1' [{if $edit->getValue('blCronActive') == 1}]checked[{/if}]>
                                        [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_ACTIVE_DESC"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        <label for="SetCronPW">[{oxmultilang ident="D3_FILEUPLOAD_SET_CRON_PASSWORD"}]</label>
                                    </dt>
                                    <dd>
                                        <input id="SetCronPW" class="edittext ext_edittext" type="text" size="20" maxlength="50" name="value[sCronPassword]" value="[{$oView->getCronPassword()}]">
                                        [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_PASSWORD_DESC"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        [{oxmultilang ident="D3_FILEUPLOAD_SET_CRON_EXTLINK"}]
                                    </dt>
                                    <dd>
                                        <a href="[{$oView->getCronLink(true)}]" target="_new" class="d3modcfg_btn icon d3color-blue" style="margin-right: 3px; padding-right: 0; background-image: none; width: 25px;">
                                            <i class="fa fa-mouse-pointer fa-inverse" style="padding: 5px 9px;"></i>
                                        </a>
                                        [{$oView->getCronLink(true)}]
                                        [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_EXTLINK_DESC"}]
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>
                                        [{oxmultilang ident="D3_FILEUPLOAD_SET_CRON_CRONLINK"}]
                                    </dt>
                                    <dd>
                                        [{$oView->getCronLink(false)}]
                                        [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_CRONLINK_DESC"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        <label for="shcrontype">[{oxmultilang ident="D3_SHGENERATOR_CRON_SHGENERATOR"}]</label>
                                    </dt>
                                    <dd>
                                        <select style="float: left; margin-right: 10px;" id="shcrontype">
                                            [{foreach from=$oView->getCronProviderList() item="sProviderName" key="sProviderId"}]
                                            <option value="[{$sProviderId}]">
                                                [{$sProviderName}]
                                            </option>
                                            [{/foreach}]
                                        </select>
                                        <span class="d3modcfg_btn icon d3color-blue">
                                            <button name="save" onclick="oForm = document.getElementById('myedit'); oForm.crontype.value = document.getElementById('shcrontype').value; oForm.fnc.value='generateCronShFile'; oForm.submit();">
                                                <i class="fas fa-download"></i>[{oxmultilang ident="D3_SHGENERATOR_CRON_SHGENERATOR_GENERATE"}]
                                            </button>
                                        </span>
                                        [{oxinputhelp ident="D3_SHGENERATOR_CRON_SHGENERATOR_DESC"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>

                                <dl>
                                    <dt>
                                        [{oxmultilang ident="D3_FILEUPLOAD_SET_CRON_LASTEXEC"}]
                                    </dt>
                                    <dd>
                                        [{$edit->getValue('sCronExecTimestamp')|oxformdate}]
                                        [{oxinputhelp ident="D3_FILEUPLOAD_SET_CRON_LASTEXEC_DESC"}]
                                        <div class="spacer"></div>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <table width="100%">
                            <tr>
                                <td class="edittext ext_edittext" align="left">
                                    <span class="d3modcfg_btn icon d3color-green">
                                        <button type="submit" name="save">
                                            <i class="fa fa-check-circle fa-inverse"></i>
                                            [{oxmultilang ident="D3_CFG_MOD_GENERAL_SAVE"}]
                                        </button>
                                    </span>
                                </td>
                            </tr>
                        </table>

                    [{/if}]
                </td>
            </tr>
        [{/block}]
    </table>
</form>

[{include file="d3_cfg_mod_inc.tpl"}]