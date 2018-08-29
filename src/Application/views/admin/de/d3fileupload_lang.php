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

$sLangName  = "Deutsch";

// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(

    'charset'                                           => 'UTF-8',

    'd3fileupload_TRANSL'                               => 'Fileupload',
    'd3fileupload_HELPLINK'                             => 'Fileupload/',

    //ModCfg
    'd3mxfileupload'                                    => '<i class="fa fa-upload"></i> FileUpload',
    'd3cfgfileupload'                                   => 'Konfiguration',

    'd3tbclfileupload_settings_main'                    => 'Konfiguration',
    'd3mxfileupload_settings'                           => 'Konfiguration',
    'd3mxfileupload_support'                            => 'Support',

    'D3_CFG_MOD_d3fileupload_MODULEACTIVE'              => 'Modul aktiv',
    'D3_CFG_d3fileupload_GENERAL_DEBUGACTIVE'           => 'Debug-Modus',
    'D3_CFG_d3fileupload_TEST_MODUS'                    => 'Test-Modus',

    'D3_CFG_MOD_d3fileupload_SETTINGS'                  => 'Einstellungen',
    'D3_CFG_MOD_d3fileupload_sD3UploadDir'              => 'Speicherort',
    'D3_CFG_MOD_d3fileupload_sD3UploadDir_HELP'         => 'Relativer Pfad innerhalb des Shopverzeichnisses zum '.
        'Verzeichnis in dem die Uploaddateien gespeichert werden sollen. (Mu&szlig; Schreib- und Leserechte f&uuml;r '.
        'PHP haben!)<br><br>Stellen Sie nach Änderung dieser Angabe sicher, dass das Verzeichnis auch existiert.',

    'D3_CFG_MOD_d3fileupload_sD3UploadPermDir'          => 'Verzeichnisrechte',
    'D3_CFG_MOD_d3fileupload_sD3UploadPermFile'         => 'Dateirechte',
    'D3_CFG_MOD_d3fileupload_sD3UploadPerm_HELP'        => 'Welche Rechte (Permissions) sollen angelegten '.
        'Verzeichnissen und Dateien gegeben werden?<br>Angabe octal -> z.B. "0644"',

    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize'          => 'Dateigr&ouml;&szlig;e',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_HELP'     => 'Maximal erlaubte Groesse einer Upload-Datei '.
        '<br>Beachten Sie, das die max. Gr&ouml;&szlig;e generell durch die Servereinstellung '.
        '"max_upload_file" begrenzt wird<br>Details erfahren Sie von Ihrem Provider',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadSize_SERVER'   => 'Serverbeschr&auml;nkung: ',

    'D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles'         => 'Anzahl der Dateien',
    'D3_CFG_MOD_d3fileupload_iD3MaxUploadFiles_HELP'    => 'Maximale Anzahl an Dateien, die ein Kunde pro bestellten '.
        'Artikel hochladen darf.',

    'D3_CFG_MOD_d3fileupload_blVariantInheritUpload'    => 'Varianten erben Upload-Status',
    'D3_CFG_MOD_d3fileupload_blVariantInheritUpload_HELP'           => 'Wenn der Elternartikel Uploads '.
        'erm&ouml;glicht, wird diese Einstellung auch auf alle seine Varianten vererbt. Ist dieser Haken nicht '.
        'gesetzt, erfordert jede Variante eine eigene Einstellung.',
    'D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions'         => 'Dateitypen',
    'D3_CFG_MOD_d3fileupload_aD3AllowedUpladFileExtensions_HELP'    => 'F&uuml;r den Upload erlaubte Dateitypen. '.
        'Dateien mit anderen Dateiendungen werden abgewiesen.<br>Achtung! Sie sollten aus Sicherheitsgr&uuml;nden '.
        'folgende Dateitypen nicht erlauben: "php", "jsp", "cgi", "cmf", "exe"',

    'D3_CFG_MOD_d3fileupload_blAllowFixation'           => 'Fixierung anbieten',
    'D3_CFG_MOD_d3fileupload_blAllowFixation_HELP'      => 'Mit der Fixierung der Uploads k&ouml;nnen Ihnen Ihre '.
        'Kunden mitteilen, keine &Auml;nderungen mehr an den Uploads vornehmen zu wollen. Die Fixierung l&auml;sst '.
        'sich f&uuml;r jede Upload-Bestellung separat setzen. Ist diese aktiviert, hat der Kunde keine '.
        'M&ouml;glichkeit mehr, die aufgeladenen Dateien zu ver&auml;ndern oder zu l&ouml;schen. Ab dann k&ouml;nnen '.
        'Sie sich auf die Uploads verlassen.<br><br>Ob Bestellungen fixiert sind, sehen Sie im Adminbereich an der '.
        'jeweiligen Bestellung. Dort k&ouml;nnen Sie die Fixierung bei Bedarf auch wieder aufheben bzw. diese selbst '.
        'setzen. Sofern Sie die regelm&auml;&szlig;igen Mailinformationen per Cronjob aktiviert haben, werden Sie '.
        'darin auch &uuml;ber die fixierten Bestellungen informiert.',

    'D3FILEUPLOAD_ERROR_MESSAGE_NOTAVAILABLE'               => "Der Upload konnte leider nicht durchgeführt werden. ".
        "Wenden Sie sich bitte an den Shopbetreiber.",
    'D3FILEUPLOAD_ERROR_MESSAGE_ARTICLEIDNOTSET'            => "Artikel-ID ist nicht gesetzt.",
    'D3FILEUPLOAD_ERROR_MESSAGE_ORDERIDNOTSET'              => "Order-ID ist nicht gesetzt.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILENAMENOTSET'             => "Dateiname ist nicht gesetzt.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILEPOINTERNOTFOUND'        => "Upload-Datei konnte nicht gefunden werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_BADFILETYPE'                => "Dieser Dateityp kann nicht aufgeladen werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILETOBIG'                  => "Die Datei ist zu groß.",
    'D3FILEUPLOAD_ERROR_MESSAGE_FILEDIRNOTAVAILABLE'        => "Das Ablageverzeichnis ist nicht verfügbar",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTCREATEORDERUPLOADDIR'   => "Das Ablageverzeichnis für die Bestellung kann nicht ".
        "angelegt werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTCREATEORDERARTICLEUPLOADDIR' => "Das Ablageverzeichnis für die bestellten Artikel ".
        "kann nicht angelegt werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_NOALLOWEDEXTENSIONSSET'     => "Keine erlaubten Dateierweiterungen eingestellt.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTMOVEUPLOADFILES'        => "Upload-Dateien können nicht in Zielordner verschoben ".
        "werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTDELETEFILE'             => "Datei kann nicht gelöscht werden.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CONFIGNOTCOMPLETE'          => "Unvollständige Konfiguration",
    'D3FILEUPLOAD_ERROR_MESSAGE_NOUPLOADFILE'               => "Fehler beim Aufladen: ",
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR1'                       => 'Datei ist zu groß (maximale Dateigröße: %1$s).',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR2'                       => 'Upload konnte nicht abgeschlossen werden.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR3'                       => 'Die aufgeladenen Datei ist leer.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR4'                       => 'Der Dateityp kann nicht verwendet werden.',
    'D3FILEUPLOAD_ERROR_MESSAGE_ERR5'                       => 'Interner Fehler #%1$s.',
    'D3FILEUPLOAD_ERROR_MESSAGE_CONTACT'                    => ' Bitte kontaktieren Sie uns.',
    'D3FILEUPLOAD_ERROR_MESSAGE_FILECOUNTREACHED'           => "Die Anzahl der möglichen Uploaddateien ist erreicht.",

    'D3_FILEUPLOAD_SET_CRON'                           => 'Cronjob',
    'D3_FILEUPLOAD_SET_CRON_DESC'                      => 'Bei der Ausführung des Cronjobs werden dem Shopbetreiber regelmäßig informatorische Mails zum Status der Uploadbestellungen gesendet. Darin finden Sie eine Auflistung aller neu fixierten Bestellungen sowie Bestellungen, bei denen es Veränderungen der Uploads gab.',
    'D3_FILEUPLOAD_SET_CRON_ACTIVE'                    => 'Cronjob aktiv',
    'D3_FILEUPLOAD_SET_CRON_MAXORDERCNT'               => 'max. Anzahl an Bestellungen pro Cron-Durchlauf',
    'D3_FILEUPLOAD_SET_CRON_PASSWORD'                  => 'Zugriffspasswort',
    'D3_FILEUPLOAD_SET_CRON_EXTLINK'                   => 'externer Link',
    'D3_FILEUPLOAD_SET_CRON_EXTLINK_DESC'              => 'M&ouml;chten Sie den Cronjob manuell im Browser '.
        'ausf&uuml;hren, verwenden Sie diesen Link.',
    'D3_FILEUPLOAD_SET_CRON_CRONLINK'                  => 'URL f&uuml;r Cronjobeinstellung',
    'D3_FILEUPLOAD_SET_CRON_CRONLINK_DESC'             => 'Setzen Sie diesen Link im Cronjob. Die zus&auml;tzlichen '.
        'Parameter sind hier nicht n&ouml;tig, da das Cronjobscript selbst feststellen kann, ob die Ausf&uuml;hrung '.
        'berechtigt ist. Richten Sie den Cronjob in einem Zeitabstand ein, dass alle auflaufenden Bestellungen '.
        'abgearbeitet werden k&ouml;nnen. Sie k&ouml;nnen dessen Ausf&uuml;hrung auch mehrmals am Tag starten.',
    'D3_FILEUPLOAD_SET_CRON_LASTEXEC'                  => 'letzte Ausf&uuml;hrung',
    
    'D3_CFG_MOD_d3fileupload_MAIN_SAVE'                 => 'speichern',

    //Tab
    'd3tbclorder_upload'                                => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> FileUpload',

    //Templates
    'D3_ARTICLE_MAIN_ISUPLOAD'                          => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Upload nach Bestellung n&ouml;tig',
    'D3_ARTICLE_MAIN_ISUPLOAD_DESC'                     => 'Setzen Sie diesen Haken, wenn Ihr Kunde für diesen gekauften Artikel Dateien aufladen können soll. Der Upload-Bereich des Kunden befindet sich im "Mein Konto"-Bereich und wird auf der Bestellabschlussseite gesondert erwähnt.<br><br>Ist dieses Feld nicht editierbar, haben Sie eventuell die Vererbung vom Elternartikel aktiviert.',
    'D3_ARTICLE_MAIN_ARTICLEDEPENDEND'                  => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> artikelabhängige Uploads',
    'D3_ARTICLE_MAIN_ARTICLEDEPENDEND_DESC'             => 'Die grundsätzlichen Uploadeinstellungen legen Sie in den Moduleinstellungen fest. Möchten Sie für diesen Artikel eine abweichende Anzahl Uploads vorgeben oder diese thematisch sortieren, aktivieren Sie diese Option und pflegen die daraus folgenden Einstellungen.<br><br>Ist dieses Feld nicht editierbar, haben Sie eventuell die Vererbung vom Elternartikel aktiviert.',
    'D3_ARTICLE_MAIN_UPLOADS'                           => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Uploads',
    'D3_ARTICLE_MAIN_UPLOADS_DESC'                      => 'Tragen Sie hier den Titel für jeden gewünschten Upload ein. Setzen Sie jeden Titel in eine neue Zeile. Der Kunde kann für jeden Eintrag (jede Zeile) eine Datei aufladen. Sie können den Titel im Klartext hinterlegen. Alternativ können Sie ebenfalls Idents von Sprachbausteinen verwenden, um die Titel mehrsprachig zu nutzen. Nutzen Sie in Ihren Titeln bitte kein Pipe-Zeichen "|".<br><br>Ist dieses Feld nicht editierbar, haben Sie eventuell die Vererbung vom Elternartikel aktiviert.',
    'D3_ARTICLE_MAIN_DEACTIVATE_CONFIRM'                => 'Sollen die Uploadeinstellungen gelöscht werden?',

    'D3_ORDER_UPLOAD_FILETITLE'                         => 'Datei(en)',
    'D3_ORDER_UPLOAD_COMMENT'                           => 'Kommentar',
    'D3_ORDER_UPLOAD_FILESIZE'                          => 'Dateigr&ouml;&szlig;e',
    'D3_ORDER_UPLOAD_DOWNLOAD'                          => 'Download',
    'D3_ORDER_UPLOAD_DELETE'                            => 'L&ouml;schen',
    'D3_ORDER_UPLOAD_DIR'                               => 'Speicherort:',
    'D3_ORDER_UPLOAD_DELETECONFIRM'                     => 'Soll die Datei wirklich gel&ouml;scht werden?',
    'D3_ORDER_UPLOAD_NOFILEUPLOADED'                    => 'Für diesen Artikel wurde noch keine Datei aufgeladen.',

    'D3_FILEUPLOAD_METADATA_TITLE'                      => '<img title="D³ Data Development" alt="D³" src="../modules/d3/modcfg/public/d3logo.php"> Fileupload',
    'D3_FILEUPLOAD_METADATA_DESC'                       => 'Dieses Modul stellt f&uuml;r den OXID eShop einen '.
        'Uploadmanager f&uuml;r den Kunden nach dem Bestellvorgang bereit.',
    'D3_FILEUPLOAD_METADATA_AUTHOR'                     => 'D³ Data Development, Inh. Thomas Dartsch',

    'D3FILEUPLOAD_ERROR_MESSAGE_NOUPLOADFILE'           => "Es wurde keine Datei zum Upload ausgew&auml;hlt.",
    'D3FILEUPLOAD_ERROR_MESSAGE_CANTDOWNLOADFILE'       => "Dateidownload nicht m&ouml;glich.",
    'D3FILEUPLOAD_FIXEDORDER_OK'                        => "Die Bestellung wurde fixiert. Der Kunde kann keine ".
        "Dateien ver&auml;ndern.",
    'D3FILEUPLOAD_FIXEDORDER_NOK'                       => "Die Bestellung ist nicht fixiert. Der Kunde kann die ".
        "Dateien jederzeit anpassen.",
    'D3FILEUPLOAD_FIXORDER_BTN'                         => "Upload sperren",
    'D3FILEUPLOAD_UNFIXORDER_BTN'                       => "Upload entsperren",

    'D3FILEUPLOAD_UPDATE_UPLOADDIR'                     => 'Die Uploaddateien werden zentral auf Ihrem Server gespeichert. Bitte legen Sie den Ordner "%1$s" dafür an.',

    'D3FILEUPLOAD_EXC_NOTACTIVE'                        => "FileUpload-Modul ist deaktiviert.",

    'D3_FILEUPLOAD_IDENT1'                              => 'Datei für Seite 1',
);
