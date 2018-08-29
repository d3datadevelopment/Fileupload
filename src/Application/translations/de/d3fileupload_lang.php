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

    'charset'                                               => 'UTF-8',

    //EMail Templates
    'D3_MAIL_ORDER_CUST_HTML_INFOTEXT'                      => "Artikel",

    'D3_ACCOUNT_ORDER_START_UPLOAD'                         => "Dateien für diese Bestellung hochladen",

    'D3_UPLOADMANAGER_HEAD_TITLE'                           => "Uploadmanager",
    'D3_UPLOADMANAGER_NO_UPLOAD'                            => "Für die Bestellung %d wurden keine Artikel gefunden, ".
        "für die zusätzliche Dateien von Ihnen nötig sind! <br><br>Bitte wenden Sie bei Fragen zu Ihrer Bestellung ".
        "telefonisch oder per E-Mail an uns.",

    'D3_UPLOADMANAGER_ERROR_TITLE'                          => "Es ist ein Fehler aufgetreten:",
    'D3_UPLOADMANAGER_ERROR_NO_ORDER'                       => "Zu Ihrer Anfrage konnte keine Bestellung gefunden werden.",
    'D3_UPLOADMANAGER_ERROR_TEXT_BADFILE'                   => "Sie haben versucht, einen nicht erlaubten Dateityp ".
        "hochzuladen.<br>Der Vorgang wurde abgebrochen.",
    'D3_UPLOADMANAGER_ERROR_TEXT_TOO_BIG'                   => "Ihre Datei überschreitet die erlaubte Maximalgröße.",
    'D3_UPLOADMANAGER_ERROR_TEXT_UPLOADDIR_NOT_FOUND'       => "Interner Systemfehler.<i>(upload dir not found)</i>".
        "<br>Bitte informieren Sie den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_NO_PERMISSION'             => "Interner Systemfehler. <i>(permission error)</i><br>".
        "Bitte informieren Sie den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_NOT_UPLOADED'              => "Ihre Datei konnte nicht erfolgreich auf den Server ".
        "geladen werden.<br>Bitte versuchen Sie es erneut oder informieren den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_DIR_NOT_FOUND'             => "Beim Löschen der Datei ist ein Fehler aufgetreten. ".
        "<br>Bitte versuchen Sie es erneut oder wenden sich bitte an den Shopinhaber.",
    'D3_UPLOADMANAGER_ERROR_TEXT_FILE_NOT_DELETE'           => "Beim Löschen der Datei ist ein Fehler aufgetreten. ".
        "<br>Bitte versuchen Sie es erneut oder wenden sich bitte an den Shopinhaber.",

    'D3_UPLOADMANAGER_ORDER_TITLE'                          => "Dateien hochladen für Bestellung Nr.",
    'D3_UPLOADMANAGER_ORDER_DATE'                           => "Bestellung vom:",
    'D3_UPLOADMANAGER_UPLOAD_PERM'                          => "Einschränkungen:",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILESIZE'                   => "maximale Dateigröße",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT_MAX'              => "max.",
    'D3_UPLOADMANAGER_UPLOAD_MAXFILECOUNT'                  => "Dateien pro Artikel (möglicherweise artikelabhängig)",
    'D3_UPLOADMANAGER_UPLOAD_ALLOWEDFILES'                  => "nur Dateien vom Typ",
    'D3_UPLOADMANAGER_ARTICLELIST'                          => "Artikelliste:",
    'D3_UPLOADMANAGER_LIST_FILES'                           => "Dateien",
    'D3_UPLOADMANAGER_LIST_INFO'                            => "",
    'D3_UPLOADMANAGER_LIST_SIZE'                            => "Größe",
    'D3_UPLOADMANAGER_LIST_DATE'                            => "Aufladedatum",
    'D3_UPLOADMANAGER_LIST_ARTNUM'                          => "ArtNr.",
    'D3_UPLOADMANAGER_ITEM_COMMENTBTN'                      => "?",
    'D3_UPLOADMANAGER_ITEM_YOURCOMMENT'                     => "Ihre Anmerkung:",
    'D3_UPLOADMANAGER_LIST_NOFILES'                         => "noch keine Dateien aufgeladen",
    'D3_UPLOADMANAGER_LIST_FILEUPLOAD'                      => "Datei hochladen:",
    'D3_UPLOADMANAGER_BTN_FILEUPLOAD'                       => "hochladen",
    'D3_UPLOADMANAGER_ADDCOMMENT_BTN'                       => "Kommantar hinzufügen",
    'D3_UPLOADMANAGER_FIX_BTN'                              => "Bestellung fixieren",
    'D3_UPLOADMANAGER_FIX_CONFIRM'                          => "Möchten Sie die Bestellung fixieren? Änderungen an ".
        "den aufgeladenen Dateien sind dann nicht mehr möglich.",
    'D3_UPLOADMANAGER_ISFIXED_MSG'                          => "Diese Bestellung wurde fixiert. Daher können Sie hier ".
        "keine Veränderungen vornehmen. Möchten Sie die Uploaddateien anpassen, wenden Sie sich bitte an den ".
        "Shopbetreiber.",
    'D3_UPLOADMANAGER_FIX_MSG'                              => "Haben Sie alle nötigen Dateien aufgeladen, fixieren ".
        "Sie die Bestellung bitte. Sie teilen uns damit mit, dass die aufgeladenen Dateien für uns verbindlich sind. ".
        "Wenn Sie diese Bestellung fixieren, können Sie keine weiteren Änderungen an Ihren aufgeladenen Dateien ".
        "durchführen. Möchten Sie nach der Fixierung Änderungen vornehmen, kontaktieren Sie uns bitte.",

    'D3_THANKYOU_UPLOAD'                                    => "Uploadartikel gekauft!",
    'D3_THANKYOU_UPLOAD_INFOTEXT1'                          => "Sie haben Artikel bestellt, für die noch zusätzliche ".
        "Dateien von Ihnen benötigt werden!<br>Klicken Sie dazu auf den folgenden Link:",
    'D3_THANKYOU_UPLOAD_BTN'                                => "Dateien hochladen",
    'D3_THANKYOU_UPLOAD_INFOTEXT2'                          => "Den Link finden Sie auch noch einmal in der soeben ".
        "versendeten Bestellbestätigungsmail und in Ihrem Konto in der Bestellhistorie.",

    'D3_EMAIL_ORDER_CUST_HTML_UPLOADINFO'                   => "<b>WICHTIG!</b><br><br>Sie haben Artikel bestellt, ".
        "für die noch zusätzliche Dateien von Ihnen benötigt werden!<br>Benutzen Sie dazu den folgenden Link, oder ".
        "melden Sie sich im Shop an und nutzen unter &quot;Mein Konto&quot; den Punkt &quot;Bestellhistorie&quot;.",
    'D3_EMAIL_ORDER_CUST_HTML_UPLOADBTN'                    => "[ Dateien hochladen ]",

    'D3_EMAIL_ORDER_CUST_PLAIN_UPLOADINFO'                  => 'WICHTIG!\n\nSie haben Artikel bestellt, für die noch ".
        "zusätzliche Dateien von Ihnen benötigt werden!\nBenutzen Sie dazu den folgenden Link, oder melden Sie sich ".
        "im Shop an und nutzen unter "Mein Konto" den Punkt "Bestellhistorie".',
    
    'D3_UPLOADMANAGER_BTN_REMOVE'                           => "entfernen",

    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_UID'          => "unbekannte oder fehlende Benutzerkennung (uid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_OID'          => "unbekannte oder fehlende Bestellkennung (oid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_AID'          => "unbekannte oder fehlende Artikelkennung (aid)",
    'D3FILESUPLOAD_ERROR_MESSAGE_CONTACTOWNER'              => "Bitte wenden Sie sich an den Shopinhaber.",

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

    'D3FILEUPLOAD_MAIL_SUBJECT'                             => 'Datei-Upload Aktualisierungsbenachrichtigung',
    'D3FILEUPLOAD_MAIL_FROM'                                => 'Datei-Upload Aktualisierungsbenachrichtigung vom',
    'D3FILEUPLOAD_MAIL_FIXEDORDERS'                         => 'Diese Bestellungs-Uploads wurden seit der letzten '.
        'Benachrichtigung fixiert:',
    'D3FILEUPLOAD_MAIL_UPLOADORDERS'                        => 'Für diese Bestellungen wurden seit der letzten '.
        'Benachrichtigung neue Dateien aufgeladen:',
    'D3FILEUPLOAD_MAIL_ORDERNR'                             => 'Bestell-Nr.:',
    'D3FILEUPLOAD_MAIL_ORDERFROM'                           => 'vom',

    'D3_FILEUPLOAD_IDENT1'                                  => 'Datei für Seite 1',
);
