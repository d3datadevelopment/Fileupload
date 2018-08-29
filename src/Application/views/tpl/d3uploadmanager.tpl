[{capture append="oxidBlock_content"}]
    [{assign var="template_title" value="D3_UPLOADMANAGER_HEAD_TITLE"|oxmultilangassign}]

    [{oxstyle include=$oViewConf->getModuleUrl('d3fileupload','out/src/css/d3fileupload.css')}]

    [{block name="d3fileupload_uploadmanager_main"}]
        <h1 class="pageHead page-header">[{oxmultilang ident="D3_UPLOADMANAGER_HEAD_TITLE"}]</h1>

        [{if $order}]
            [{if count($Errors)>0 && count($Errors.d3fileupload) > 0}]
                [{block name="d3fileupload_uploadmanager_errors"}]
                    <div class="status error corners">
                        [{foreach from=$Errors.d3fileupload item=oEr key=key}]
                            <p>[{$oEr->getOxMessage()}] [{oxmultilang ident="D3FILESUPLOAD_ERROR_MESSAGE_CONTACTOWNER"}]</p>
                        [{/foreach}]
                    </div>
                [{/block}]
            [{elseif !$oView->hasUploadArticles()}]
                [{block name="d3fileupload_uploadmanager_errors_noarticles"}]
                    <div class="status error corners">
                        <div>
                            [{$oView->getNoUploadArticlesMessage()}]<br>
                            <br>
                            [{assign var="oCont" value=$oView->getContentByIdent("oximpressum")}]
                            <div>
                                <a href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=contact"}]">
                                    <b>[{oxmultilang ident="CONTACT"}]</b>
                                </a>
                                &nbsp;&nbsp;-&nbsp;&nbsp;
                                <a href="[{$oCont->getLink()}]">
                                    <b>[{$oCont->getFieldData('oxtitle')}]</b>
                                </a>
                            </div>
                        </div>
                    </div>
                [{/block}]
            [{else}]
                [{block name="d3fileupload_uploadmanager_overview"}]
                    [{if $oView->orderIsFixed()}]
                        [{assign var="orderIsFixed" value="disabled"}]
                    [{else}]
                        [{assign var="orderIsFixed" value=""}]
                    [{/if}]
                    [{block name="d3fileupload_uploadmanager_statustable"}]
                        <h3 class="blockHead">
                            [{oxmultilang ident="D3_UPLOADMANAGER_ORDER_TITLE"}] [{$order->getFieldData('oxordernr')}]
                        </h3>
                        <table class="tableclear"  style="width:100%;">
                            <tr>
                                <td>
                                    <span class="note"><strong>[{oxmultilang ident="D3_UPLOADMANAGER_ORDER_DATE"}]</strong></span>
                                </td>
                                <td>
                                    <span class="note">[{$order->getFieldData('oxorderdate')|date_format:"%d.%m.%Y, %T"}]
                                </td>
                            </tr>
                            [{if !$oView->orderIsFixed()}]
                                <tr>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align:top;">
                                        <span class="note"><strong>[{oxmultilang ident="D3_UPLOADMANAGER_UPLOAD_PERM"}]</strong></span>
                                    </td>
                                    <td>
                                        <div class="note">
                                            <ul style="margin: 0 0 0 10px;">
                                                <li>
                                                    <strong>[{$oView->getFormattedMaxUploadSize()}]</strong> [{oxmultilang ident="D3_UPLOADMANAGER_UPLOAD_MAXFILESIZE"}]
                                                </li>
                                                <li>
                                                    <strong>[{oxmultilang ident="D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT_MAX"}] [{$oView->getMaxUploadFileCount()}]</strong> [{oxmultilang ident="D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT"}]
                                                </li>
                                                <li>
                                                    [{oxmultilang ident="D3_UPLOADMANAGER_UPLOAD_ALLOWEDFILES"}] <strong>[{$oView->getAllowUploadFileTypeListing()}]</strong>
                                                </li>
                                            </ul>
                                      </div>
                                    </td>
                                </tr>
                            [{/if}]
                        </table>
                    [{/block}]

                    [{block name="d3fileupload_uploadmanager_articlelist"}]
                        <h3 class="blockHead">[{oxmultilang ident="D3_UPLOADMANAGER_ARTICLELIST"}]</h3>

                        <table class="tableclear"  style="width:100%;">
                            <colgroup>
                                <col width="27%" />
                                <col width="25%" />
                                <col width="3%" />
                                <col width="10%" />
                                <col style="width: 18%;" />
                                <col style="width: 15%; text-align: center;" />
                            </colgroup>
                            [{assign var="blWhite" value="1"}]
                            [{foreach name="articles" from=$oView->getUploadArticles() item="oOrderitem"}]
                                [{assign var="oArticle" value=$oView->getArticleFromOrderArticle($oOrderitem)}]
                                [{assign var="listclass" value="listitem"|cat:$blWhite}]
                                [{if $oView->getUploadFiles($oOrderitem->getId())}]
                                    [{block name="d3fileupload_uploadmanager_uploadfiles_tablehead"}]
                                        <tr class="[{$listclass}]">
                                            <th>&nbsp;</th>
                                            <th><span class="note">[{oxmultilang ident="D3_UPLOADMANAGER_LIST_FILES"}]</span></th>
                                            <th><span class="note">[{oxmultilang ident="D3_UPLOADMANAGER_LIST_INFO"}]</span></th>
                                            <th><span class="note">[{oxmultilang ident="D3_UPLOADMANAGER_LIST_SIZE"}]</span></th>
                                            <th><span class="note">[{oxmultilang ident="D3_UPLOADMANAGER_LIST_DATE"}]</span></th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    [{/block}]

                                    [{if $oArticle->d3GetUploadsArray()|@count}]
                                        [{foreach name="uploads" from=$oView->getUploadFiles($oOrderitem->getId()) item="oUpload"}]
                                            [{block name="d3fileupload_uploadmanager_uploadfilesarray_table"}]
                                                <tr class="[{$listclass}]">
                                                    [{if $smarty.foreach.uploads.first}]
                                                        <td rowspan="[{$smarty.foreach.uploads.total}]" style="vertical-align: middle;">
                                                            <div class="note"><strong>[{$oOrderitem->getFieldData('oxtitle')}]</strong></div>
                                                            <div class="note">([{oxmultilang ident="D3_UPLOADMANAGER_LIST_ARTNUM"}] [{$oOrderitem->getFieldData('oxartnum')}])</div>
                                                        </td>
                                                    [{/if}]
                                                    <td class="filecell" style="padding: 3px;">
                                                        <span title="[{$oUpload->sFilename}]">
                                                            <b>[{oxmultilang ident=$oUpload->sUploadId noerror=true}]:</b><br>
                                                            [{$oUpload->sFilename|truncate:30:"..."}]
                                                        </span>
                                                    </td>
                                                    <td class="filecell" style="padding: 3px;">
                                                        [{if $oUpload->sComment}]
                                                            <span title="[{oxmultilang ident="D3_UPLOADMANAGER_ITEM_YOURCOMMENT"}] [{$oUpload->sComment}]">
                                                                <button style="cursor: help;" class="submitButton largeButton btn btn-primary" name="CommentInfo">[{oxmultilang ident="D3_UPLOADMANAGER_ITEM_COMMENTBTN"}]</button>
                                                            </span>
                                                        [{/if}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{$oUpload->sFilesize}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{$oUpload->sFileCTime|date_format:"%d.%m.%Y, %T"}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{block name="D3_FILEUPLOAD_DELETEFORM"}]
                                                            <form name="delete[{$smarty.foreach.articles.iteration}]" id="delete[{$smarty.foreach.articles.iteration}]" action="[{$oViewConf->getSelfActionLink()}]" method="post">
                                                                [{$oViewConf->getHiddenSid()}]
                                                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                                                <input type="hidden" name="fnc" value="doDelete">
                                                                <input type="hidden" name="uid" value="[{$user->getId()}]">
                                                                <input type="hidden" name="oid" value="[{$order->getId()}]">
                                                                <input type="hidden" name="aid" value="[{$oOrderitem->getId()}]">
                                                                <input type="hidden" name="file" value="[{$oUpload->sFilename}]">
                                                                <button [{$orderIsFixed}] class="submitButton largeButton btn btn-primary" type="submit" name="removeBtn">[{oxmultilang ident="D3_UPLOADMANAGER_BTN_REMOVE"}]</button>
                                                            </form>
                                                        [{/block}]
                                                    </td>
                                                </tr>
                                            [{/block}]
                                        [{/foreach}]
                                    [{else}]
                                        [{foreach name="uploads" from=$oView->getUploadFiles($oOrderitem->getId()) item="oUpload"}]
                                            [{block name="d3fileupload_uploadmanager_uploadfiles_table"}]
                                                <tr class="[{$listclass}]">
                                                    [{if $smarty.foreach.uploads.first}]
                                                        <td rowspan="[{$smarty.foreach.uploads.total}]" style="vertical-align: middle;">
                                                            <div class="note"><strong>[{$oOrderitem->getFieldData('oxtitle')}]</strong></div>
                                                            <div class="note">([{oxmultilang ident="D3_UPLOADMANAGER_LIST_ARTNUM"}] [{$oOrderitem->getFieldData('oxartnum')}])</div>
                                                        </td>
                                                    [{/if}]
                                                    <td class="filecell" style="padding: 3px;">
                                                        <span title="[{$oUpload->sFilename}]">
                                                            [{$oUpload->sFilename|truncate:30:"..."}]
                                                        </span>
                                                    </td>
                                                    <td class="filecell" style="padding: 3px;">
                                                        [{if $oUpload->sComment}]
                                                            <span title="[{oxmultilang ident="D3_UPLOADMANAGER_ITEM_YOURCOMMENT"}] [{$oUpload->sComment}]">
                                                                <button style="cursor: help;" class="submitButton largeButton btn btn-primary" name="CommentInfo">[{oxmultilang ident="D3_UPLOADMANAGER_ITEM_COMMENTBTN"}]</button>
                                                            </span>
                                                        [{/if}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{$oUpload->sFilesize}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{$oUpload->sFileCTime|date_format:"%d.%m.%Y, %T"}]
                                                    </td>
                                                    <td class="filecell" style="padding: 3px; text-align: right;">
                                                        [{block name="d3fileupload_uploadmanager_articlelist_remove_form"}]
                                                            <form name="delete[{$smarty.foreach.articles.iteration}]" id="delete[{$smarty.foreach.articles.iteration}]" action="[{$oViewConf->getSelfActionLink()}]" method="post">
                                                                [{$oViewConf->getHiddenSid()}]
                                                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                                                <input type="hidden" name="fnc" value="doDelete">
                                                                <input type="hidden" name="uid" value="[{$user->getId()}]">
                                                                <input type="hidden" name="oid" value="[{$order->getId()}]">
                                                                <input type="hidden" name="aid" value="[{$oOrderitem->getId()}]">
                                                                <input type="hidden" name="file" value="[{$oUpload->sFilename}]">
                                                                <button [{$orderIsFixed}] class="submitButton largeButton btn btn-primary" type="submit" name="removeBtn">[{oxmultilang ident="D3_UPLOADMANAGER_BTN_REMOVE"}]</button>
                                                            </form>
                                                        [{/block}]
                                                    </td>
                                                </tr>
                                            [{/block}]
                                        [{/foreach}]
                                    [{/if}]
                                [{else}]
                                    <tr class="[{$listclass}]">
                                        <td rowspan="[{$smarty.foreach.uploads.total}]">
                                            <div class="note"><strong>[{$oOrderitem->getFieldData('oxtitle')}]</strong></div>
                                            <div class="note">([{oxmultilang ident="D3_UPLOADMANAGER_LIST_ARTNUM"}] [{$oOrderitem->getFieldData('oxartnum')}])</div>
                                        </td>
                                        <td style="padding: 3px; text-align: center;" colspan="5">
                                            <span class="note" style="color: red"><strong>[{oxmultilang ident="D3_UPLOADMANAGER_LIST_NOFILES"}]</strong></span>
                                        </td>
                                    </tr>
                                [{/if}]
                                <tr class="[{$listclass}]">
                                    <td colspan="6">&nbsp;</td>
                                </tr>

                                [{if false == $oView->orderIsFixed()}]
                                    [{if $oArticle->d3GetUploadsArray()|@count}]
                                        [{foreach name="uploads" from=$oArticle->d3GetUploadsArray() item="sUpload"}]
                                            [{if $oView->isUploadSlotEmpty($oOrderitem->getId(), $sUpload)}]
                                                <tr class="[{$listclass}]">
                                                    <td colspan="6" style="text-align: center;">
                                                        [{block name="d3fileupload_uploadmanager_articlelist_uploadarray_form"}]
                                                            <form action="[{$oViewConf->getSelfActionLink()}]"  enctype="multipart/form-data" method="post" name="uploadform[{$smarty.foreach.articles.iteration}]" id="uploadform[{$smarty.foreach.articles.iteration}]">
                                                                [{$oViewConf->getHiddenSid()}]
                                                                <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                                                <input type="hidden" name="fnc" value="doUpload">
                                                                <input type="hidden" name="uid" value="[{$user->getId()}]">
                                                                <input type="hidden" name="oid" value="[{$order->getId()}]">
                                                                <input type="hidden" name="aid" value="[{$oOrderitem->getId()}]">
                                                                <input type="hidden" name="uploadid" value="[{$sUpload}]">
                                                                <span class="note"><b>[{oxmultilang ident=$sUpload noerror=true}]:</b> [{oxmultilang ident="D3_UPLOADMANAGER_LIST_FILEUPLOAD"}]</span>&nbsp;
                                                                <input size="40" name="uploadfile" type="file">
                                                                <button class="submitButton largeButton btn btn-primary" id="commentbtn[{$smarty.foreach.articles.iteration}]__[{$smarty.foreach.uploads.iteration}]" onclick="document.getElementById('comment[{$smarty.foreach.articles.iteration}]__[{$smarty.foreach.uploads.iteration}]').style.display='block'; document.getElementById('commentbtn[{$smarty.foreach.articles.iteration}]__[{$smarty.foreach.uploads.iteration}]').style.display='none'; return false;">[{oxmultilang ident="D3_UPLOADMANAGER_ADDCOMMENT_BTN"}]</button>
                                                                <div class="uploadcomment" id="comment[{$smarty.foreach.articles.iteration}]__[{$smarty.foreach.uploads.iteration}]">
                                                                    <textarea class="uploadcomment edittext" name="comment"></textarea>
                                                                </div>
                                                                &nbsp;<button [{$orderIsFixed}] class="submitButton largeButton btn btn-primary" name="submit">[{oxmultilang ident="D3_UPLOADMANAGER_BTN_FILEUPLOAD"}]</button>
                                                            </form>
                                                        [{/block}]
                                                    </td>
                                                </tr>
                                            [{/if}]
                                        [{/foreach}]
                                    [{else}]
                                        [{if !$oView->hasFileCountReached($oOrderitem->getId())}]
                                            <tr class="[{$listclass}]">
                                                <td colspan="6" style="text-align: center;">
                                                    [{block name="d3fileupload_uploadmanager_articlelist_upload_form"}]
                                                        <form action="[{$oViewConf->getSelfActionLink()}]"  enctype="multipart/form-data" method="post" name="uploadform[{$smarty.foreach.articles.iteration}]" id="uploadform[{$smarty.foreach.articles.iteration}]">
                                                            [{$oViewConf->getHiddenSid()}]
                                                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                                            <input type="hidden" name="fnc" value="doUpload">
                                                            <input type="hidden" name="uid" value="[{$user->getId()}]">
                                                            <input type="hidden" name="oid" value="[{$order->getId()}]">
                                                            <input type="hidden" name="aid" value="[{$oOrderitem->getId()}]">
                                                            <span class="note">[{oxmultilang ident="D3_UPLOADMANAGER_LIST_FILEUPLOAD"}]</span>&nbsp;
                                                            <input size="40" name="uploadfile" type="file">
                                                            <button class="submitButton largeButton btn btn-primary" id="commentbtn[{$smarty.foreach.articles.iteration}]" onclick="document.getElementById('comment[{$smarty.foreach.articles.iteration}]').style.display='block'; document.getElementById('commentbtn[{$smarty.foreach.articles.iteration}]').style.display='none'; return false;">[{oxmultilang ident="D3_UPLOADMANAGER_ADDCOMMENT_BTN"}]</button>
                                                            <div class="uploadcomment" id="comment[{$smarty.foreach.articles.iteration}]">
                                                                <textarea class="uploadcomment edittext" name="comment"></textarea>
                                                            </div>
                                                            &nbsp;<button [{$orderIsFixed}] class="submitButton largeButton btn btn-primary" name="submit">[{oxmultilang ident="D3_UPLOADMANAGER_BTN_FILEUPLOAD"}]</button>
                                                        </form>
                                                    [{/block}]
                                                </td>
                                            </tr>
                                        [{/if}]
                                    [{/if}]
                                [{/if}]

                                <tr class="[{$listclass}] sep">
                                    <td colspan="6" class="line" style="height: 20px;">&nbsp;</td>
                                </tr>

                                [{if $blWhite == "2"}]
                                    [{assign var="blWhite" value="1"}]
                                [{else}]
                                    [{assign var="blWhite" value="2"}]
                                [{/if}]
                            [{/foreach}]
                        </table>
                    [{/block}]

                    [{block name="d3fileupload_uploadmanager_fixation"}]
                        [{if $oView->hasFixation()}]
                            [{if !$oView->orderIsFixed()}]
                                <div class="lineBox clear" style="margin-bottom: 0;">
                                    <div style="margin-bottom: 5px;">
                                        [{oxmultilang ident="D3_UPLOADMANAGER_FIX_MSG"}]
                                    </div>
                                    [{block name="d3fileupload_uploadmanager_fixation_form"}]
                                        <form method="post" onsubmit="if (confirm('[{oxmultilang ident="D3_UPLOADMANAGER_FIX_CONFIRM"}]')){return true;} else {return false;}" action="[{$oViewConf->getSelfActionLink()}]">
                                            [{$oViewConf->getHiddenSid()}]
                                            <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
                                            <input type="hidden" name="fnc" value="d3fixorder">
                                            <input type="hidden" name="oid" value="[{$order->getId()}]">
                                            <input type="hidden" name="uid" value="[{$user->getId()}]">
                                            <button type="submit" class="submitButton largeButton nextStep btn btn-primary">[{oxmultilang ident="D3_UPLOADMANAGER_FIX_BTN"}]</button>
                                        </form>
                                    [{/block}]
                                </div>
                            [{else}]
                                <div class="lineBox clear alert alert-success" style="margin-bottom: 0;">
                                    [{oxmultilang ident="D3_UPLOADMANAGER_ISFIXED_MSG"}]
                                </div>
                            [{/if}]
                        [{/if}]
                    [{/block}]
                [{/block}]
            [{/if}]
        [{else}]
            [{oxmultilang ident="D3_UPLOADMANAGER_ERROR_NO_ORDER"}]
        [{/if}]

        [{insert name="oxid_tracker" title=$template_title}]
    [{/block}]
[{/capture}]


[{assign var="sidebar" value=""}]
[{capture append="oxidBlock_sidebar"}]
    [{if $oView->isValidAccount() && $oxcmp_user}]
        [{include file="page/account/inc/account_menu.tpl" active_link="orderhistory"}]
        [{assign var="sidebar" value="Left"}]
    [{/if}]
[{/capture}]

[{include file="layout/page.tpl" sidebar=$sidebar}]