[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3fileupload"}][{/d3modcfgcheck}]

[{if $mod_d3fileupload}]
	[{if $order->getD3CustomerBoughtUploadArticles()}]
	    <br>
	    [{oxmultilang ident="D3_EMAIL_ORDER_CUST_HTML_UPLOADINFO"}]
	    <br>
	    <br>
	    <b><a href="[{$oViewConf->getBaseDir()}]index.php?shp=[{$shop->getId()}]&amp;cl=d3uploadmanager&amp;uid=[{$order->getFieldData('oxuserid')}]&amp;oid=[{$order->getId()}]"><b>[{oxmultilang ident="D3_EMAIL_ORDER_CUST_HTML_UPLOADBTN"}]</b></a>
	    <br>
	    <br>
	[{/if}]
[{/if}]