[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<style type="text/css">
    td.listitem,
    td.listitem2 {
        padding: 2px 3px;
    }
    td.filecell {
        border-bottom: 1px solid white;
    }
    td.listitem.filecell {
        border-color: #F0F0F0;
    }
    button {
        font-size: 12px;
    }
</style>

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
</form>

[{block name="d3fileupload_orderupload_main"}]
    [{block name="d3fileupload_orderupload_fixation"}]
        [{if $oView->hasFixation()}]
            [{if $oView->orderIsFixed()}]
                <div style="background-color: lightgreen; border: 1px solid green; padding: 3px; margin: 5px 0; height: 22px;">
                    <div style="width: 50%; margin: 4px 0 0 10px; float: left;">
                        [{oxmultilang ident="D3FILEUPLOAD_FIXEDORDER_OK"}]
                    </div>
                    <div style="width: 20%; float: right; text-align: right;">
                        <form name="download" action="[{$oViewConf->getSelfLink()}]" method="POST" target="edit">
                            [{$oViewConf->getHiddenSid()}]
                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                            <input type="hidden" name="fnc" value="d3unfixupload">
                            <input type="hidden" name="oxid" value="[{$edit->getId()}]">
                            <button type="submit">[{oxmultilang ident="D3FILEUPLOAD_UNFIXORDER_BTN"}]</button>
                        </form>
                    </div>
                </div>
            [{else}]
                <div style="background-color: lightpink; border: 1px solid red; padding: 3px; margin: 5px 0; height: 22px;">
                    <div style="width: 50%; margin: 4px 0 0 10px; float: left;">
                        [{oxmultilang ident="D3FILEUPLOAD_FIXEDORDER_NOK"}]
                    </div>
                    <div style="width: 20%; float: right; text-align: right;">
                        <form name="download" action="[{$oViewConf->getSelfLink()}]" method="POST" target="edit">
                            [{$oViewConf->getHiddenSid()}]
                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                            <input type="hidden" name="fnc" value="d3fixupload">
                            <input type="hidden" name="oxid" value="[{$edit->getId()}]">
                            <button type="submit">[{oxmultilang ident="D3FILEUPLOAD_FIXORDER_BTN"}]</button>
                        </form>
                    </div>
                </div>
            [{/if}]
        [{/if}]
    [{/block}]

    [{block name="d3fileupload_orderupload_filelist"}]
        <table cellspacing="0" cellpadding="0" border="0" width="98%">
            <colgroup>
                <col>
                <col>
                <col>
                <col style="width: 25%;">
                <col>
                <col style="width: 100px;">
                <col style="width: 100px;">
            </colgroup>
            <tr>
                <td class="listheader first" height="15" style="padding-left: 10px;">[{oxmultilang ident="GENERAL_ITEMNR"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="GENERAL_TITLE"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="D3_ORDER_UPLOAD_FILETITLE"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="D3_ORDER_UPLOAD_COMMENT"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="D3_ORDER_UPLOAD_FILESIZE"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="D3_ORDER_UPLOAD_DOWNLOAD"}]</td>
                <td class="listheader" style="padding-left: 10px;">[{oxmultilang ident="D3_ORDER_UPLOAD_DELETE"}]</td>
            </tr>

            [{assign var="blWhite" value=""}]
            [{foreach from=$edit->getOrderArticles() item="listitem" name="orderArticles"}]
                [{if $listitem->getFieldData('d3isupload') && $listitem->getFieldData('oxstorno') != 1}]
                    [{assign var="aUploadFiles" value=$oView->getUploadFiles($listitem->getId())}]
                    [{assign var="listclass" value="listitem"|cat:$blWhite}]
                    [{if $aUploadFiles}]
                        [{foreach from=$aUploadFiles name="uploads" item="upload"}]
                            <tr id="art.[{$smarty.foreach.orderArticles.iteration}]">
                                [{if $smarty.foreach.uploads.first}]
                                    <td rowspan="[{$smarty.foreach.uploads.total}]" style="vertical-align: middle; text-align: center;" class="[{$listclass}]">[{$listitem->getFieldData('oxartnum')}]</td>
                                    <td rowspan="[{$smarty.foreach.uploads.total}]" style="vertical-align: middle;" class="[{$listclass}]">[{$listitem->getFieldData('oxtitle')|string_format:"%.20s"|strip_tags}]</td>
                                [{/if}]
                                <td valign="top" class="[{$listclass}] filecell">
                                    [{if $upload->sUploadId}]
                                        [{oxmultilang ident=$upload->sUploadId noerror=true}]:<br>
                                    [{/if}]
                                    [{$upload->sFilename}]
                                    <br><i>(vom [{$upload->sFileCTime|date_format:"%m.%d.%Y, %T"}])</i>
                                </td>
                                <td class="[{$listclass}] filecell" style="" >
                                    [{$upload->sComment}]
                                </td>
                                <td class="[{$listclass}] filecell" style="text-align: right; padding: 3px">
                                    [{$upload->sFilesize}]
                                </td>
                                <td class="[{$listclass}] filecell" style="text-align: right; padding: 3px">
                                    <form name="download" action="[{$oViewConf->getSelfLink()}]" method="POST" target="edit">
                                        [{$oViewConf->getHiddenSid()}]
                                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                        <input type="hidden" name="fnc" value="d3filedownload">
                                        <input type="hidden" name="oxid" value="[{$edit->getId()}]">
                                        <input type="hidden" name="oaid" value="[{$listitem->getId()}]">
                                        <input type="hidden" name="filename" value="[{$upload->sFilename}]">
                                        <span class="d3modcfg_btn icon d3color-blue">
                                            <button type="submit">
                                                <i class="fas fa-download"></i>[{oxmultilang ident="D3_ORDER_UPLOAD_DOWNLOAD"}]
                                            </button>
                                        </span>
                                    </form>
                                </td>
                                <td class="[{$listclass}] filecell" style="text-align: right; padding: 3px">
                                    <form onsubmit="if (confirm('[{oxmultilang ident="D3_ORDER_UPLOAD_DELETECONFIRM"}]')){return true;} else {return false;}" name="download" action="[{$oViewConf->getSelfLink()}]" method="POST" target="edit">
                                        [{$oViewConf->getHiddenSid()}]
                                        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                        <input type="hidden" name="fnc" value="d3filedelete">
                                        <input type="hidden" name="oxid" value="[{$edit->getId()}]">
                                        <input type="hidden" name="oid" value="[{$edit->getId()}]">
                                        <input type="hidden" name="aid" value="[{$listitem->getId()}]">
                                        <input type="hidden" name="sFileName" value="[{$upload->sFilename}]">
                                        <span class="d3modcfg_btn icon d3color-red">
                                            <button type="submit">
                                                <i class="fas fa-times-circle"></i>[{oxmultilang ident="D3_ORDER_UPLOAD_DELETE"}]
                                            </button>
                                        </span>
                                    </form>
                                </td>
                            </tr>
                        [{/foreach}]
                        <tr>
                            <td colspan="7" class="[{$listclass}]" style="padding: 10px 2px; text-align: center;">
                                <i>[{oxmultilang ident="D3_ORDER_UPLOAD_DIR"}] [{$oView->getUploadDir()}]/[{$edit->getId()}]/[{$listitem->getId()}]/</i>
                            </td>
                        </tr>
                    [{else}]
                        <tr>
                            <td style="vertical-align: middle; text-align: center;" class="[{$listclass}]">[{$listitem->getFieldData('oxartnum')}]</td>
                            <td style="vertical-align: middle;" class="[{$listclass}]">[{$listitem->getFieldData('oxtitle')|string_format:"%.20s"|strip_tags}]</td>
                            <td colspan="5" class="[{$listclass}]" style="text-align: center;">
                                <span style="color: red"><b>[{oxmultilang ident="D3_ORDER_UPLOAD_NOFILEUPLOADED"}]</b></span>
                            </td>
                        </tr>
                    [{/if}]
                    [{if $blWhite == "2"}]
                        [{assign var="blWhite" value=""}]
                    [{else}]
                        [{assign var="blWhite" value="2"}]
                    [{/if}]
                [{/if}]
            [{/foreach}]
        </table>
    [{/block}]
[{/block}]

[{include file="d3_cfg_mod_inc.tpl"}]