<?php
/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      http://www.oxidmodule.com
 */
$aModule = [
    'd3FileRegister'    => [
        'd3/fileupload/IntelliSenseHelper.php',
        'd3/fileupload/metadata.php',
        'd3/fileupload/Application/translations/de/d3fileupload_lang.php',
        'd3/fileupload/Application/translations/en/d3fileupload_lang.php',
        'd3/fileupload/Application/views/admin/de/d3fileupload_lang.php',
        'd3/fileupload/Application/views/admin/en/d3fileupload_lang.php',
        'd3/fileupload/public/d3_fileupload_cron.php',

        'd3/fileupload/Application/Model/d3fileupload.php',
        'd3/fileupload/Application/Model/d3fileupload_db.php',
        'd3/fileupload/Application/Model/d3fileupload_file.php',
        'd3/fileupload/Application/Model/d3fileupload_setting.php',
        'd3/fileupload/Application/Model/exceptions/d3fileuploadexception.php',
        'd3/fileupload/Application/Model/exceptions/d3fileupload_cronunavailableexception.php',

        'd3/fileupload/Setup/Events.php',

        // ToDo: try to remove these items in later connector release, can determine from default chapters in metadata
        'd3/fileupload/Modules/Application/Model/d3_oxarticle_fileupload.php',
        'd3/fileupload/Modules/Application/Model/d3_oxorder_fileupload.php',
        'd3/fileupload/Modules/Application/Model/d3_oxemail_fileupload.php',
        'd3/fileupload/Application/Controller/d3uploadmanager.php',
        'd3/fileupload/Application/Controller/d3fileupload_response.php',
        'd3/fileupload/Application/Controller/Admin/d3fileupload_orderupload.php',
        'd3/fileupload/Application/Controller/Admin/d3fileupload_licence.php',
        'd3/fileupload/Application/Controller/Admin/d3fileupload_main.php',
        'd3/fileupload/Application/Controller/Admin/d3fileupload_settings.php',
        'd3/fileupload/Application/Controller/Admin/d3fileupload_list.php',
        'd3/fileupload/Setup/d3fileupload_update.php',
        'd3/fileupload/Application/Controller/Admin/d3_cfg_fileuploadlog.php',
        'd3/fileupload/Application/Controller/Admin/d3_cfg_fileuploadlog_list.php',
        'd3/fileupload/d3metadata.php',
    ],
    'd3SetupClasses'    => [
        \D3\Fileupload\Setup\d3fileupload_update::class
    ]
];
