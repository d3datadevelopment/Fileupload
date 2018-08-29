[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3fileupload"}][{/d3modcfgcheck}]

[{if $mod_d3fileupload}]
	[{if $order->getD3CustomerBoughtUploadArticles()}]
	
	    [{oxmultilang ident="D3_EMAIL_ORDER_CUST_PLAIN_UPLOADINFO"}]
	    
	    [{$oViewConf->getBaseDir()}]index.php?shp=[{$shop->getId()}]&cl=d3uploadmanager&uid=[{$order->getFieldData('oxuserid')}]&oid=[{$order->getId()}]
	
	[{/if}]
[{/if}]