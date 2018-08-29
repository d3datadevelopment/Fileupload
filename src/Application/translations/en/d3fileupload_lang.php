<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */

$sLangName  = "English";

// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(

    'charset'                                               => 'UTF-8',

    //EMail Templates
    'D3_MAIL_ORDER_CUST_HTML_INFOTEXT'                      => "article",

    'D3_ACCOUNT_ORDER_START_UPLOAD'                         => "Upload files for this order",

    'D3_UPLOADMANAGER_HEAD_TITLE'                           => "Upload Manager",
    'D3_UPLOADMANAGER_NO_UPLOAD'                            => "For the order %d no articles were found, ".
        "for which additional files of you are necessary! <br><br>If you have questions about your order, please contact us by phone or e-mail.",

    'D3_UPLOADMANAGER_ERROR_TITLE'                          => "An error has occurred:",
    'D3_UPLOADMANAGER_ERROR_NO_ORDER'                       => "No order could be found for your request.",
    'D3_UPLOADMANAGER_ERROR_TEXT_BADFILE'                   => "You tried to upload an unauthorized file type.<br>The process was canceled.",
    'D3_UPLOADMANAGER_ERROR_TEXT_TOO_BIG'                   => "Your file exceeds the maximum allowed size.",
    'D3_UPLOADMANAGER_ERROR_TEXT_UPLOADDIR_NOT_FOUND'       => "Internal system error.<i>(upload dir not found)</i>".
        "<br>Bitte informieren Sie den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_NO_PERMISSION'             => "Internal system error. <i>(permission error)</i><br>".
        "Bitte informieren Sie den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_NOT_UPLOADED'              => "Your file could not be successfully loaded on the server.<br>Please try again or inform the shop owner.",
    'D3_UPLOADMANAGER_ERROR_TEXT_DIR_NOT_FOUND'             => "An error occurred while deleting the file. ".
        "<br>Please try again or inform the shop owner.",
    'D3_UPLOADMANAGER_ERROR_TEXT_FILE_NOT_DELETE'           => "An error occurred while deleting the file. ".
        "<br>Please try again or inform the shop owner.",

    'D3_UPLOADMANAGER_ORDER_TITLE'                          => "Upload files for order no.",
    'D3_UPLOADMANAGER_ORDER_DATE'                           => "Order from:",
    'D3_UPLOADMANAGER_UPLOAD_PERM'                          => "limitations:",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILESIZE'                   => "maximum file size",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT_MAX'              => "max.",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT'                  => "files per article (possibly article-dependent)",
    'D3_UPLOADMANAGER_UPLOAD_ALLOWEDFILES'                  => "only files of the type",
    'D3_UPLOADMANAGER_ARTICLELIST'                          => "Product list:",
    'D3_UPLOADMANAGER_LIST_FILES'                           => "files",
    'D3_UPLOADMANAGER_LIST_INFO'                            => "",
    'D3_UPLOADMANAGER_LIST_SIZE'                            => "size",
    'D3_UPLOADMANAGER_LIST_DATE'                            => "upload date",
    'D3_UPLOADMANAGER_LIST_ARTNUM'                          => "Item No.",
    'D3_UPLOADMANAGER_ITEM_COMMENTBTN'                      => "?",
    'D3_UPLOADMANAGER_ITEM_YOURCOMMENT'                     => "Your comment:",
    'D3_UPLOADMANAGER_LIST_NOFILES'                         => "no files loaded yet",
    'D3_UPLOADMANAGER_LIST_FILEUPLOAD'                      => "Upload file:",
    'D3_UPLOADMANAGER_BTN_FILEUPLOAD'                       => "upload",
    'D3_UPLOADMANAGER_ADDCOMMENT_BTN'                       => "add comment",
    'D3_UPLOADMANAGER_FIX_BTN'                              => "Fix order",
    'D3_UPLOADMANAGER_FIX_CONFIRM'                          => "Would you like to fix the order? Changes to the uploaded files are then no longer possible.",
    'D3_UPLOADMANAGER_ISFIXED_MSG'                          => "This order has been fixed. Therefore, you can not make any changes here. If you would like to adapt the upload files, please contact the shop owner.",
    'D3_UPLOADMANAGER_FIX_MSG'                              => "If you have loaded all the necessary files, please fix the order. They tell us that the uploaded files are not changed anymore. ".
        "If you freeze this order, you will not be able to make any changes to your uploaded files. If you would like to make changes after fixing, please contact us.",

    'D3_THANKYOU_UPLOAD'                                    => "Purchased upload items!",
    'D3_THANKYOU_UPLOAD_INFOTEXT1'                          => "You have ordered items that require additional files from you!<br>Click on the following link:",
    'D3_THANKYOU_UPLOAD_BTN'                                => "Upload files",
    'D3_THANKYOU_UPLOAD_INFOTEXT2'                          => "The link can be found again in the order confirmation email just sent and in your account in the order history.",

    'D3_EMAIL_ORDER_CUST_HTML_UPLOADINFO'                   => "<b>IMPORTANT!</b><br><br>You have ordered items that require additional files from you!<br>Use the following link, or log in to the shop and use under &quot;My account&quot; the page &quot;order history&quot;.",
    'D3_EMAIL_ORDER_CUST_HTML_UPLOADBTN'                    => "[ Upload files ]",

    'D3_EMAIL_ORDER_CUST_PLAIN_UPLOADINFO'                  => 'IMPORTANT!\n\nYou have ordered items that require additional files from you!\nUse the following link, or log in to the shop and use under "My account" the page "order history".',
    
    'D3_UPLOADMANAGER_BTN_REMOVE'                           => "remove",

    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_UID'          => "unknown or missing user ID (uid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_OID'          => "unknown or missing order ID (oid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_AID'          => "unknown or missing article ID (aid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_CONTACTOWNER'              => "Please contact the shop owner.",

    'D3FILEUPLOAD_ERROR_MESSAGE_NOTAVAILABLE'               => "The upload could not be done unfortunately. ".
        "Please contact the shop owner.",
    'D3FILEUPLOAD_ERROR_MESSAGE_ARTICLEIDNOTSET'            => "Article ID is not set.",
    'D3FILEUPLOAD_ERROR_MESSAGE_ORDERIDNOTSET'              => "Order ID is not set.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILENAMENOTSET'             => "File name is not set.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILEPOINTERNOTFOUND'        => "Upload file could not be found.",
    'D3FILEUPLOAD_ERROR_MESSAGE_BADFILETYPE'                => "This file type can not be loaded.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILETOBIG'                  => "The file is too big.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILEDIRNOTAVAILABLE'        => "The storage directory is not available",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTCREATEORDERUPLOADDIR'   => "The storage directory for the order can not be created.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTCREATEORDERARTICLEUPLOADDIR' => "The storage directory for the ordered items can not be created.",
    'D3FILEUPLOAD_ERROR_MESSAGE_NOALLOWEDEXTENSIONSSET'     => "No allowed file extensions set.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTMOVEUPLOADFILES'        => "Upload files can not be moved to destination folder.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTDELETEFILE'             => "File can not be deleted.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CONFIGNOTCOMPLETE'          => "Incomplete configuration",
    'D3FILEUPLOAD_ERROR_MESSAGE_NOUPLOADFILE'               => "Error while upload: ",
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR1'                       => 'File is too big (maximum file size %1$s).',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR2'                       => 'Upload could not be completed.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR3'                       => 'The loaded file is empty.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR4'                       => 'The file type can not be used.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR5'                       => 'Internal error #%1$s.',
    'D3FILEUPLOAD_ERROR_MESSAGE_CONTACT'                    => ' Please contact us.',
    'D3FILEUPLOAD_ERROR_MESSAGE_FILECOUNTREACHED'           => "The number of possible upload files has been reached.",

    'D3FILEUPLOAD_MAIL_SUBJECT'                             => 'File upload update notification',
    'D3FILEUPLOAD_MAIL_FROM'                                => 'File upload update notification from',
    'D3FILEUPLOAD_MAIL_FIXEDORDERS'                         => 'These order uploads have been fixed since the last notification:',
    'D3FILEUPLOAD_MAIL_UPLOADORDERS'                        => 'For these orders, new files have been loaded since the last notification:',
    'D3FILEUPLOAD_MAIL_ORDERNR'                             => 'Order no.:',
    'D3FILEUPLOAD_MAIL_ORDERFROM'                           => 'from',

    'D3_FILEUPLOAD_IDENT1'                                  => 'File for page 1',
);
