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

use D3\ModCfg\Application\Model\d3utils;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Email;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id'           => 'd3fileupload',
    'title'        => 
        '<svg style="height:1em;width:1em"><image xlink:href="https://logos.oxidmodule.com/d3logo.svg" style="height:1em;width:1em" /></svg> '.
        'Fileupload',
    'description'  => array(
        'de'            => 'Dieses Modul stellt im OXID eShop einen Uploadmanager f&uuml;r den Kunden nach dem '.
            'Bestellvorgang bereit.',
        'en'            => '',
    ),
    'thumbnail'    => 'picture.png',
    'version'      => '5.0.1.0',
    'author'       => 'D&sup3; Data Development',
    'email'        => 'support@shopmodule.com',
    'url'          => 'http://www.oxidmodule.com/',
    
    'extend'       => array(
        Order::class            => \D3\Fileupload\Modules\Application\Model\d3_oxorder_fileupload::class,
        Article::class          => \D3\Fileupload\Modules\Application\Model\d3_oxarticle_fileupload::class,
        Email::class            => \D3\Fileupload\Modules\Application\Model\d3_oxemail_fileupload::class,
     ),

    'controllers'   => array(
        'd3fileupload_response'              => \D3\Fileupload\Application\Controller\d3fileupload_response::class,

        'd3fileupload_licence'               => \D3\Fileupload\Application\Controller\Admin\d3fileupload_licence::class,
        'd3fileupload_list'                  => \D3\Fileupload\Application\Controller\Admin\d3fileupload_list::class,
        'd3fileupload_main'                  => \D3\Fileupload\Application\Controller\Admin\d3fileupload_main::class,
        'd3fileupload_orderupload'           => \D3\Fileupload\Application\Controller\Admin\d3fileupload_orderupload::class,
        'd3fileupload_settings'              => \D3\Fileupload\Application\Controller\Admin\d3fileupload_settings::class,

        'd3_cfg_fileuploadlog'               => \D3\Fileupload\Application\Controller\Admin\d3_cfg_fileuploadlog::class,
        'd3_cfg_fileuploadlog_list'          => \D3\Fileupload\Application\Controller\Admin\d3_cfg_fileuploadlog_list::class,

        'd3uploadmanager'                    => \D3\Fileupload\Application\Controller\d3uploadmanager::class,
    ),

    'templates' => array(
        'd3fileupload_orderupload.tpl'       => 'd3/fileupload/Application/views/admin/tpl/d3fileupload_orderupload.tpl',
        'd3fileupload_settings.tpl'          => 'd3/fileupload/Application/views/admin/tpl/d3fileupload_settings.tpl',
        
        'd3uploadmanager.tpl'                => 'd3/fileupload/Application/views/tpl/d3uploadmanager.tpl',

        'd3fileupload_notification_html.tpl' => 'd3/fileupload/Application/views/tpl/email/html/d3fileupload_notification.tpl',
        'd3fileupload_notification_plain.tpl'=> 'd3/fileupload/Application/views/tpl/email/plain/d3fileupload_notification.tpl',
    ),
    
    'blocks'       => array(
        array(
            'template' => 'article_main.tpl',
            'block'=>'admin_article_main_form',
            'file'=>'Application/views/admin/blocks/admin_article_main_form.tpl'
        ),
        array(
            'template' => 'email/html/order_cust.tpl',
            'block'=>'email_html_order_cust_orderemail',
            'file'=>'Application/views/blocks/email/html/email_html_order_cust_orderemail.tpl'
        ),
        array(
            'template' => 'email/plain/order_cust.tpl',
            'block'=>'email_plain_order_cust_orderemail',
            'file'=>'Application/views/blocks/email/plain/email_plain_order_cust_orderemail.tpl'
        ),
        array(
            'template' => 'page/checkout/thankyou.tpl',
            'block'=>'checkout_thankyou_info',
            'file'=>'Application/views/blocks/page/checkout/checkout_thankyou_info.tpl'
        ),
        array(
            'template' => 'page/account/order.tpl',
            'block'=>'account_order_history_cart_items',
            'file'=>'Application/views/blocks/page/account/account_order_history_cart_items.tpl'
        ),
    ),

    'events'      => array(
        'onActivate'    => '\D3\ModCfg\setup\Events::onActivate',
        'onDeactivate'  => '\D3\ModCfg\setup\Events::onDeactivate',
    )
);
