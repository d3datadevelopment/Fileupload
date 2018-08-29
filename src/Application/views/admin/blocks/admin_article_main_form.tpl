[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3fileupload"}][{/d3modcfgcheck}]

[{block name="d3fileupload_admin_article_main_form"}]
    [{if $mod_d3fileupload}]
        <tr>
            [{if $edit->isVariant() && $oModCfg_d3fileupload->getValue('blVariantInheritUpload')}]
                [{assign var="d3ReadonlyInheritance" value="readonly disabled"}]
            [{else}]
                [{assign var="d3ReadonlyInheritance" value=""}]
            [{/if}]

            <td class="edittext" width="120">
                <label for="d3isupload">[{oxmultilang ident="D3_ARTICLE_MAIN_ISUPLOAD"}]</label>
            </td>
            <td class="edittext">
                <input type="hidden" name="editval[oxarticles__d3isupload]" value='0'>
                <input id="d3isupload" class="edittext" type="checkbox" name="editval[oxarticles__d3isupload]" value='1' [{if $edit->getFieldData('d3isupload') == 1}]checked[{/if}] [{$readonly}] [{$d3ReadonlyInheritance}]>
                [{oxinputhelp ident="D3_ARTICLE_MAIN_ISUPLOAD_DESC"}]
            </td>
        </tr>
        <tr>
            <td class="edittext" width="120">
                <label for="d3toggle">[{oxmultilang ident="D3_ARTICLE_MAIN_ARTICLEDEPENDEND"}]</label>
            </td>
            <td class="edittext">
                <input id="d3toggle" type="checkbox" onchange="ahowhideartdepupload(this.checked);" [{if $edit->getFieldData('d3fileuploads')}]checked="checked"[{/if}] [{$readonly}] [{$d3ReadonlyInheritance}]>
                [{oxinputhelp ident="D3_ARTICLE_MAIN_ARTICLEDEPENDEND_DESC"}]
            </td>
        </tr>
        <tr id="d3fileuploads_element" style="[{if false == $edit->getFieldData('d3fileuploads')}]display: none;[{/if}]">
            <td class="edittext" width="120" style="vertical-align: top;">
                <label for="d3fileuploads">[{oxmultilang ident="D3_ARTICLE_MAIN_UPLOADS"}]</label>
            </td>
            <td class="edittext">
                <textarea id="d3fileuploads" class="edittext" style="editinput" columns="50" rows="4" maxlength="[{$edit->oxarticles__d3fileuploads->fldmax_length}]" name="editval[oxarticles__d3fileuploads]" [{$readonly}] [{$d3ReadonlyInheritance}]>[{$edit->d3GetEditUploadsArray()}]</textarea>
                [{oxinputhelp ident="D3_ARTICLE_MAIN_UPLOADS_DESC"}]
            </td>
        </tr>
    [{/if}]
    [{assign var="sConfirmMessage" value="D3_ARTICLE_MAIN_DEACTIVATE_CONFIRM"|oxmultilangassign}]
    [{oxscript add="function ahowhideartdepupload(blchecked) {
        if (blchecked) {
            document.getElementById('d3fileuploads_element').style.display = 'table-row';
        } else {
            if (confirm('$sConfirmMessage')) {
                document.getElementById('d3fileuploads_element').style.display = 'none';
                document.getElementById('d3fileuploads').value = '';
            } else {
                document.getElementById('d3toggle').checked = 'checked';
            }
        }
    }"}]
[{/block}]