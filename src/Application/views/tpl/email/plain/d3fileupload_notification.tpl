[{block name="fileupload_notification_mail"}]
[{oxmultilang ident="D3FILEUPLOAD_MAIL_FROM"}] [{$smarty.now|date_format:"%d.%m.%Y %H:%I"}]

[{if $aFixedOrderList && $aFixedOrderList|count}]
[{oxmultilang ident="D3FILEUPLOAD_MAIL_FIXEDORDERS"}]

[{foreach from=$aFixedOrderList item="oOrder"}]
- [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERNR"}] [{$oOrder->getFieldData('oxordernr')}], [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERFROM"}] [{$oOrder->getFieldData('oxorderdate')}] ([{$oOrder->getFieldData('oxbilllname')}], [{$oOrder->getFieldData('oxbillfname')}])
[{/foreach}]

[{/if}]
[{if $aUploadOrderList && $aUploadOrderList|count}]
[{oxmultilang ident="D3FILEUPLOAD_MAIL_UPLOADORDERS"}]

[{foreach from=$aUploadOrderList item="oOrder"}]
- [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERNR"}] [{$oOrder->getFieldData('oxordernr')}], [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERFROM"}] [{$oOrder->getFieldData('oxorderdate')}] ([{$oOrder->getFieldData('oxbilllname')}], [{$oOrder->getFieldData('oxbillfname')}])
[{/foreach}]
[{/if}]
[{/block}]