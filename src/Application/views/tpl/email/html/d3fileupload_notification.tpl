[{block name="fileupload_notification_mail"}]
    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
    <html>
        <head>
            <title>[{oxmultilang ident="D3FILEUPLOAD_MAIL_SUBJECT"}]</title>
            <meta http-equiv="Content-Type" content="text/html; charset=[{$oEmailView->getCharset()}]">
        </head>
        <body bgcolor="#FFFFFF" link="#355222" alink="#355222" vlink="#355222" style="font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px;">
            [{block name="fileupload_notification_mailcontent"}]
                [{oxmultilang ident="D3FILEUPLOAD_MAIL_FROM"}] [{$smarty.now|date_format:"%d.%m.%Y %H:%I"}]
          
                [{strip}]
                    [{if $aFixedOrderList && $aFixedOrderList|count}]
                        [{oxmultilang ident="D3FILEUPLOAD_MAIL_FIXEDORDERS"}]
                        <ul>
                            [{foreach from=$aFixedOrderList item="oOrder"}]
                                <li>
                                    [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERNR"}] [{$oOrder->getFieldData('oxordernr')}],&nbsp;
                                    [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERFROM"}] [{$oOrder->getFieldData('oxorderdate')}]&nbsp;
                                    ([{$oOrder->getFieldData('oxbilllname')}], [{$oOrder->getFieldData('oxbillfname')}])
                                </li>
                            [{/foreach}]
                        </ul><br><br>
                    [{/if}]

                    [{if $aUploadOrderList && $aUploadOrderList|count}]
                        [{oxmultilang ident="D3FILEUPLOAD_MAIL_UPLOADORDERS"}]
                        <ul>
                            [{foreach from=$aUploadOrderList item="oOrder"}]
                                <li>
                                    [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERNR"}] [{$oOrder->getFieldData('oxordernr')}],&nbsp;
                                    [{oxmultilang ident="D3FILEUPLOAD_MAIL_ORDERFROM"}] [{$oOrder->getFieldData('oxorderdate')}]&nbsp;
                                    ([{$oOrder->getFieldData('oxbilllname')}], [{$oOrder->getFieldData('oxbillfname')}])
                                </li>
                            [{/foreach}]
                        </ul>
                    [{/if}]
                [{/strip}]
            [{/block}]
        </body>
    </html>
[{/block}]