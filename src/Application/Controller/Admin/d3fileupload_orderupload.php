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
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\UtilsView;

class d3fileupload_orderupload extends AdminDetailsController
{
    /** @var Order */
    protected $_oEditObject;
    protected $_sThisTemplate = "d3fileupload_orderupload.tpl";
    protected $_sHelpLinkMLAdd;
    protected $_sModId = 'd3fileupload';

    /**
     * @return string
     */
    public function render()
    {
        parent::render();

        $this->addTplParam("edit", $this->getEditObject());

        return $this->_sThisTemplate;
    }

	/**
	 * @return null|object
	 */
    public function getEditObject()
    {
        if (false == $this->_oEditObject) {
            $this->_oEditObject = oxNew(Order::class);

            $soxId = $this->getEditObjectId();
            if (isset($soxId) && $soxId != "-1") {
                $this->_oEditObject->load($soxId);
            }
        }

        return $this->_oEditObject;
    }

    /**
     * @param string $sArticleId
     *
     * @return array|null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ParameterNotFoundException
     * @throws d3fileuploadException
     */
    public function getUploadFiles($sArticleId)
    {
        if (!$sArticleId) {
            return array();
        }

        $oD3Upload = $this->getUpload();
        return $oD3Upload->getUploadItems($sArticleId);
    }

    /**
     * Get Upload Dir
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getUploadDir()
    {
        $oSettings = $this->getUploadSettings();
        return '../'.$oSettings->getUploadDir();
    }

	/**
	 * @return d3fileupload
	 */
    protected function getUpload()
    {
        return oxnew(d3fileupload::class, $this->getEditObject());
    }

	/**
	 * @return d3fileupload_setting
	 */
    protected function getUploadSettings()
    {
        return oxnew(d3fileupload_setting::class);
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws StandardException
     * @throws d3_cfg_mod_exception
     */
    public function d3filedownload()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);

        /** @var d3fileupload $oUpload */
        $oUpload = $this->getUpload();
        $oUpload->setOrderArticleId($request->getRequestEscapedParameter('oaid'));
        $sPath = $oUpload->getUploadFileHandler()->getOrderArticleFileDirectory().
            $request->getRequestEscapedParameter('filename');

        // ToDo: try to get contents by download method of refactored ModCfg
        $content = file_get_contents($sPath);

        /** @var d3filesystem $oFileSystem */
        $oFileSystem = oxNew(d3filesystem::class);
        $oFileSystem->startDirectDownload($sPath, $content);

        try {
            /** @var d3fileuploadException $oEx */
            $oEx = oxNew(d3fileuploadException::class, d3_cfg_mod::get($this->_sModId)->d3getLog(), d3log::ERROR);
            $oEx->setMessage("D3FILEUPLOAD_ERROR_MESSAGE_CANTDOWNLOADFILE");
            $oEx->setLogText("path '" . $sPath . "'");
            throw $oEx;
        } catch (Exception $oEx) {
            Registry::get(UtilsView::class)->addErrorToDisplay($oEx);
        }
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function d3filedelete()
    {
        try {
            /** @var Request $request */
            $request = Registry::get(Request::class);

            /** @var d3fileupload $oUpload */
            $oUpload = $this->getUpload();
            $oUpload->setFilename($request->getRequestEscapedParameter("sFileName"));
            $oUpload->setOrderArticleId($request->getRequestEscapedParameter("aid"));
            $oUpload->doDelete();
        } catch (d3fileuploadException $oEx) {
            Registry::get(UtilsView::class)->addErrorToDisplay($oEx);
        }
    }

    /**
     * @return array
     */
    public function getUserMessages()
    {
        return array();
    }

    /**
     * @deprecated
     * @return string
     */
    public function getBGLogoUrl()
    {
        return '';
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getHelpURL()
    {
        $sUrl = d3_cfg_mod::get($this->_sModId)->getHelpURL();
        /** @var $oFS d3filesystem */
        $oFS = oxNew(d3filesystem::class);

        if ($this->_sHelpLinkMLAdd) {
            $sUrl .= $oFS->unprefixedslashit(Registry::getLang()->TranslateString($this->_sHelpLinkMLAdd));
        }

        $aFileName = $oFS->splitFilename($sUrl);

        // has no extension
        if (false == $aFileName['ext']) {
            $sUrl = $oFS->trailingslashit($sUrl);
        }

        return $sUrl;
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function hasFixation()
    {
        return d3_cfg_mod::get($this->_sModId)->getValue('blAllowFixation');
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function orderIsFixed()
    {
        if (false == $this->hasFixation()) {
            return false;
        }

        $oOrder = $this->getEditObject();
        return $oOrder->getFieldData('d3uploadfixed') == '0000-00-00 00:00:00' ? false : true;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3fixupload()
    {
        if (false == $this->hasFixation()) {
            return;
        }

        $oOrder = $this->getEditObject();
        $oOrder->assign(
            array(
                'd3uploadfixed' => date('Y-m-d H:i:s'),
            )
        );
        $oOrder->save();
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function d3unfixupload()
    {
        if (false == $this->hasFixation()) {
            return;
        }

        $oOrder = $this->getEditObject();
        $oOrder->assign(
            array(
                'd3uploadfixed' => '0000-00-00 00:00:00',
            )
        );
        $oOrder->save();
    }
}
