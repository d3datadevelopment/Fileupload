[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3fileupload"}][{/d3modcfgcheck}]

[{if $mod_d3fileupload}]
    [{if $order->getD3CustomerBoughtUploadArticles()}]

         <div class="status error corners alert alert-info">
              <strong class="boxhead">[{oxmultilang ident="D3_THANKYOU_UPLOAD"}]</strong><br>
               [{oxmultilang ident="D3_THANKYOU_UPLOAD_INFOTEXT1"}]
               <br><br>
               <form action="[{$oViewConf->getSelfActionLink()}]" name="upload" method="post">
                    [{$oViewConf->getHiddenSid()}]
                    <input type="hidden" name="cl" value="d3uploadmanager">
                    <input type="hidden" name="oid" value="[{$order->getId()}]">
                    <input type="hidden" name="uid" value="[{$order->getFieldData('oxuserid')}]">
                    <input type="hidden" name="location" value="account">
                    <button class="submitButton largeButton btn btn-primary" type="submit">[{oxmultilang ident="D3_THANKYOU_UPLOAD_BTN"}]</button>
               </form>
               <br>
               [{oxmultilang ident="D3_THANKYOU_UPLOAD_INFOTEXT2"}]
              <br><br>
        </div>
    [{/if}]
[{/if}]

