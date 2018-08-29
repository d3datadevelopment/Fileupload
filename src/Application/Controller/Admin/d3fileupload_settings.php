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

namespace D3\Fileupload\Application\Controller\Admin;

use D3\Fileupload\Application\Model\d3fileupload;
use D3\Fileupload\Application\Model\d3fileupload_setting;
use D3\Fileupload\Application\Model\Exceptions\d3fileuploadException;
use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\d3str;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Filegenerator\d3filegeneratorcronsh;
use D3\ModCfg\Application\Model\Shopcompatibility\d3ShopCompatibilityAdapterHandler;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Model\Shop;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\ViewConfig;

class d3fileupload_settings extends d3_cfg_mod_main
{
    protected $_sThisTemplate = 'd3fileupload_settings.tpl';
    protected $_sModId = 'd3fileupload';

    protected $_sMenuItemTitle = 'd3mxfileupload';
    protected $_sMenuSubItemTitle = 'd3mxfileupload_settings';
    
    protected $_blUseModCfgStdObject = true;

    protected $_blHasDebugSwitch = false;

    /** @var  d3fileupload */
    public $oUpload;

    /**
     * @return string
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     */
    public function render()
    {
        $ret = parent::render();

        return $ret;
    }

    public function save()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);

        $iD3MaxUploadSize = $request->getRequestEscapedParameter('iD3MaxUploadSize');
        $iD3MaxUploadSizeMultiplier = $request->getRequestEscapedParameter('iD3MaxUploadSizeMultiplier');
        $_POST['value']['iD3MaxUploadSize'] = $iD3MaxUploadSize * $iD3MaxUploadSizeMultiplier;

        parent::save();
    }

    /**
     * @param string $sType
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getDefaultPermissions($sType = 'dir')
    {
        return $this->getUploadSettings()->getDefaultPermissions($sType);
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getModuleMaxUploadFileSize()
    {
        return $this->getUploadSettings()->getMaxUploadSize();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getFormattedModuleMaxUploadFileSize()
    {
        return $this->getUploadSettings()->getFormattedMaxUploadSize();
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3fileuploadException
     */
    public function getAllowedUploadFileExtensions()
    {
        $aExtensions = $this->getUploadSettings()->getAllowedUploadFileExtensions();
        $sExtensions = implode(chr(10), $aExtensions);

        return $sExtensions;
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getMaxUploadFileCount()
    {
        return $this->getUploadSettings()->getMaxUploadFileCount();
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getUploadDir()
    {
        return $this->getUploadSettings()->getUploadDir();
    }

	/**
	 * @return d3fileupload_setting
	 */
    public function getUploadSettings()
    {
        return oxnew(d3fileupload_setting::class);
    }

    /**
     * get basic cronjob access password; for cases only, if no password is set
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getCronPassword()
    {
        return $this->getUploadSettings()->getCronPassword();
    }

    /**
     * @param bool $blUsePw
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws \oxFileException
     */
    public function getCronLink($blUsePw)
    {
        /** @var $oViewConf ViewConfig */
        $oViewConf = oxNew(ViewConfig::class);

        $sBaseUrl = $oViewConf->getModuleUrl('d3fileupload').'public/d3_fileupload_cron.php';

        $aParameters = array(
            'shp' => $oViewConf->getActiveShopId(),
        );

        if ($blUsePw) {
            $aParameters['key'] = $this->getCronPassword();
        }

        /** @var $oD3Str d3str */
        $oD3Str = oxNew(d3str::class);
        $sURL   = $oD3Str->generateParameterUrl($sBaseUrl, $aParameters);

        return $sURL;
    }

// ToDo: use a list from d3filesystem::formatBytes

    /**
     * @return array
     */
    public function getFileSizeUnits()
    {
        return array(
            1           => 'B',
            1024        => 'KB',
            1048576     => 'MB',
            1073741824  => 'GB'
        );
    }

    /**
     * @return float
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getShorthandModuleMaxUploadFileSize()
    {
        return (double) $this->getUploadSettings()->getFormattedMaxUploadSize();
    }

    /**
     * @return float
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getShorthandModuleMaxUploadFileSizeUnit()
    {
        return strtoupper(
            trim(
                str_replace(
                    (double) $this->getUploadSettings()->getFormattedMaxUploadSize(),
                    '',
                    $this->getUploadSettings()->getFormattedMaxUploadSize()
                )
            )
        );
    }

	/**
	 * @return string
	 */
    public function getSystemUploadSizeRestrictions()
    {
        $iSystemUploadRestrictions = $this->getUploadSettings()->getSmallestSystemUploadRestrictions();

        /** @var d3filesystem $oFileSystem */
        $oFileSystem = oxNew(d3filesystem::class);
        return $oFileSystem->formatBytes($iSystemUploadRestrictions);
    }

	/**
	 * @return array
	 */
    public function getCronProviderList()
    {
        /** @var d3filegeneratorcronsh $oD3ShGenerator */
        $oD3ShGenerator = oxNew(d3filegeneratorcronsh::class);

        return $oD3ShGenerator->getContentList();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function generateCronShFile()
    {
        /** @var Module $oModule */
        $oModule = oxNew(Module::class);

        /** @var d3ShopCompatibilityAdapterHandler $oD3CompatibilityAdapterHandler */
        $oD3CompatibilityAdapterHandler = oxNew(d3ShopCompatibilityAdapterHandler::class);
        $sModulePath = $oD3CompatibilityAdapterHandler->call(
            'oxmodule__getModuleFullPath',
            array($oModule, d3_cfg_mod::get($this->_sModId)->getMetaModuleId())
        );

        $sScriptPath = $sModulePath . "/public/d3_fileupload_cron.php";

        /** @var Shop $oShop */
        $oShop = Registry::getConfig()->getActiveShop();
        $aParameters = array(
            0 => $oShop->getId()
        );

        /** @var d3filegeneratorcronsh $oD3ShGenerator */
        $oD3ShGenerator = oxNew(d3filegeneratorcronsh::class);

        /** @var Request $request */
        $request = Registry::get(Request::class);

        $oD3ShGenerator->setContentType($request->getRequestEscapedParameter('crontype'));
        $oD3ShGenerator->setScriptPath($sScriptPath);
        $oD3ShGenerator->setSortedParameterList($aParameters);
        $oD3ShGenerator->startDownload('d3fileupload_'.$oShop->getId().".sh");
    }
}
