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

    'charset'                                           => 'UTF-8',

    'd3fileupload_TRANSL'                               => 'Fileupload',
    'd3fileupload_HELPLINK'                             => 'Fileupload/',

    //ModCfg
    'd3mxfileupload'                                    => '<i class="fa fa-upload"></i> FileUpload',
    'd3cfgfileupload'                                   => 'Settings',

    'd3tbclfileupload_settings_main'                    => 'Settings',
    'd3mxfileupload_settings'                           => 'Settings',
    'd3mxfileupload_support'                            => 'Support',

    'D3_CFG_MOD_d3fileupload_MODULEACTIVE'              => 'module active',
    'D3_CFG_d3fileupload_GENERAL_DEBUGACTIVE'           => 'Debug-Modus',
    'D3_CFG_d3fileupload_TEST_MODUS'                    => 'Test-Modus',

    'D3_CFG_MOD_d3fileupload_SETTINGS'                  => 'Settings',
    'D3_CFG_MOD_d3fileupload_sD3UploadDir'              => 'storage location',
    'D3_CFG_MOD_d3fileupload_sD3UploadDir_HELP'         => 'Relative path within the shop directory to the directory in which the upload files are to be stored. (Must have read and write permissions for PHP!) <br> <br> After changing this, make sure the directory exists.',

    'D3_CFG_MOD_d3fileupload_sD3UploadPermDir'          => 'directory permissions',
    'D3_CFG_MOD_d3fileupload_sD3UploadPermFile'         => 'file permissions',
    'D3_CFG_MOD_d3fileupload_sD3UploadPerm_HELP'        => 'Which permissions should be set to created directories and files?<br>Specification octal -> e.g. "0644"',

    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize'          => 'file size',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_HELP'     => 'Maximum allowed size of an upload file '.
        '<br>Note that the maximum size is generally limited by the server setting "max_upload_file".<br>For details, please contact your provider.',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_SERVER'   => 'server limitation: ',

    'D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles'         => 'Number of files',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles_HELP'    => 'Maximum number of files that a customer can upload per ordered item.',

    'D3_CFG_MOD_d3fileupload_blVariantInheritUpload'    => 'Variants inherit upload status',
    'D3_CFG_MOD_d3fileupload_blVariantInheritUpload_HELP'           => 'If the parent article allows uploads, this setting will be inherited by all its variants. If this checkbox is not set, each variant requires its own setting.',
    'D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions'         => 'allowed file types',
    'D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions_HELP'    => 'Uploaded file types allowed. Files with other file extensions will be rejected. <br> Attention! For security reasons, you should not allow the following file types: php, jsp, cgi, cmf, exe',

    'D3_CFG_MOD_d3fileupload_blAllowFixation'           => 'Offer fixation',
    'D3_CFG_MOD_d3fileupload_blAllowFixation_HELP'      => 'By fixing the uploads, your customers can inform you that they no longer want to make any changes to the uploads. The fixation can be set separately for each upload order. If this is activated, the customer no longer has the option of modifying or deleting the uploaded files. From then you can rely on the uploads. <br> <br> Whether orders are fixed, you can see in the admin area to the respective order. If necessary, you can also cancel the fixation there or set it yourself. If you have activated the regular mail information via cronjob, you will also be informed about the fixed purchase orders.',

    'D3FILEUPLOAD_ERROR_MESSAGE_NOTAVAILABLE'               => "The upload could not be done unfortunately. ".
        "Wenden Sie sich bitte an den Shopbetreiber.",
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
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR1'                       => 'File is too big (maximum file size: %1$s).',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR2'                       => 'Upload could not be completed.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR3'                       => 'The loaded file is empty.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR4'                       => 'The file type can not be used.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR5'                       => 'Internal error #%1$s.',
    'D3FILEUPLOAD_ERROR_MESSAGE_CONTACT'                    => ' Please contact us.',
    'D3FILEUPLOAD_ERROR_MESSAGE_FILECOUNTREACHED'           => "The number of possible upload files has been reached.",

    'D3_FILEUPLOAD_SET_CRON'                           => 'Cronjob',
    'D3_FILEUPLOAD_SET_CRON_DESC'                      => 'During the execution of the cronjob the shop operator is regularly sent informative mails about the status of the upload orders. In it you will find a list of all newly fixed orders as well as orders with changes of the uploads.',
    'D3_FILEUPLOAD_SET_CRON_ACTIVE'                    => 'Cronjob active',
    'D3_FILEUPLOAD_SET_CRON_MAXORDERCNT'               => 'max. number of orders per cron run',
    'D3_FILEUPLOAD_SET_CRON_PASSWORD'                  => 'Access password',
    'D3_FILEUPLOAD_SET_CRON_EXTLINK'                   => 'external link',
    'D3_FILEUPLOAD_SET_CRON_EXTLINK_DESC'              => 'If you would like to manually run the cronjob in the browser, use this link.',
    'D3_FILEUPLOAD_SET_CRON_CRONLINK'                  => 'URL for cron job setting',
    'D3_FILEUPLOAD_SET_CRON_CRONLINK_DESC'             => 'Put this link in the cron job. The additional parameters are not necessary here, since the cronjobscript can determine for itself whether the execution is justified. Set up the cron job at a time interval so that all incoming orders can be processed. You can also start its execution several times a day.',
    'D3_FILEUPLOAD_SET_CRON_LASTEXEC'                  => 'last execution',
    
    'D3_CFG_MOD_d3fileupload_MAIN_SAVE'                 => 'save',

    //Tab
    'd3tbclorder_upload'                                => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> FileUpload',

    //Templates
    'D3_ARTICLE_MAIN_ISUPLOAD'                          => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Upload to order is required',
    'D3_ARTICLE_MAIN_ISUPLOAD_DESC'                     => 'Check this box if your customer should be able to load files for this purchased item. The customer\'s upload section is located in the "My Account" section and will be mentioned separately on the order completion page. <br> <br> If this field is not editable, you may have activated inheritance from the parent article.',
    'D3_ARTICLE_MAIN_ARTICLEDEPENDEND'                  => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> article-dependent uploads',
    'D3_ARTICLE_MAIN_ARTICLEDEPENDEND_DESC'             => 'The basic upload settings are defined in the module settings. If you would like to specify a different number of uploads for this article or sort them by topic, activate this option and maintain the following settings. <br> <br> If this field is not editable, you may have activated inheritance from the parent article.',
    'D3_ARTICLE_MAIN_UPLOADS'                           => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Uploads',
    'D3_ARTICLE_MAIN_UPLOADS_DESC'                      => 'Enter the title for each upload you want. Put each title in a new line. The customer can load a file for each entry (each line). You can deposit the title in plain text. Alternatively, you can also use language module idents to multilingual the titles. Please do not use a pipe character "|" in your titles. <br> <br> If this field is not editable, you may have activated inheritance from the parent article.',
    'D3_ARTICLE_MAIN_DEACTIVATE_CONFIRM'                => 'Do you want to delete the upload settings?',

    'D3_ORDER_UPLOAD_FILETITLE'                         => 'file(s)',
    'D3_ORDER_UPLOAD_COMMENT'                           => 'comment',
    'D3_ORDER_UPLOAD_FILESIZE'                          => 'file size',
    'D3_ORDER_UPLOAD_DOWNLOAD'                          => 'download',
    'D3_ORDER_UPLOAD_DELETE'                            => 'delete',
    'D3_ORDER_UPLOAD_DIR'                               => 'location:',
    'D3_ORDER_UPLOAD_DELETECONFIRM'                     => 'Do you really want to delete the file?',
    'D3_ORDER_UPLOAD_NOFILEUPLOADED'                    => 'No file has been uploaded for this item yet.',

    'D3_FILEUPLOAD_METADATA_TITLE'                      => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Fileupload',
    'D3_FILEUPLOAD_METADATA_DESC'                       => 'This module provides the OXID eShop with an upload manager for the customer after the order process.',
    'D3_FILEUPLOAD_METADATA_AUTHOR'                     => 'D³ Data Development, owner: Thomas Dartsch',

    'D3FILEUPLOAD_ERROR_MESSAGE_NOUPLOADFILE'           => "No file was selected for upload.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTDOWNLOADFILE'       => "File download not possible.",
    'D3FILEUPLOAD_FIXEDORDER_OK'                        => "The order has been fixed. The customer can not change any files.",
    'D3FILEUPLOAD_FIXEDORDER_NOK'                       => "The order is not fixed. The customer can adapt the files at any time.",
    'D3FILEUPLOAD_FIXORDER_BTN'                         => "Fix order",
    'D3FILEUPLOAD_UNFIXORDER_BTN'                       => "Unfix order",

    'D3FILEUPLOAD_UPDATE_UPLOADDIR'                     => 'The upload files are stored centrally on your server. Please create the folder "%1$s" for it.',

    'D3FILEUPLOAD_EXC_NOTACTIVE'                        => "FileUpload module is disabled.",

    'D3_FILEUPLOAD_IDENT1'                              => 'File for page 1',
);
