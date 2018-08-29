[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3fileupload"}][{/d3modcfgcheck}]
[{if $mod_d3fileupload && $order->getD3CustomerBoughtUploadArticles()}]
    <div>
        <form action="[{$oViewConf->getSelfActionLink()}]" name="upload" method="post">
            [{$oViewConf->getHiddenSid() }]
            <input type="hidden" name="cl" value="d3uploadmanager">
            <input type="hidden" name="oid" value="[{$order->oxorder__oxid->value}]">
            <input type="hidden" name="uid" value="[{$order->oxorder__oxuserid->value}]">
            <input type="hidden" name="location" value="account">
            <span class="btn"><button class="submitButton largeButton btn btn-primary" type="submit">[{ oxmultilang ident="D3_ACCOUNT_ORDER_START_UPLOAD" }]</button></span>
        </form>
    </div>
[{/if}]
