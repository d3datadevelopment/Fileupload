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

namespace D3\Fileupload\Application\Controller;

use D3\Fileupload\Application\Model\d3fileupload;
use D3\Fileupload\Application\Model\d3fileupload_setting;
use D3\Fileupload\Application\Model\Exceptions\d3fileuploadException;
use D3\Fileupload\Modules\Application\Model\d3_oxarticle_fileupload;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Application\Model\Parametercontainer\d3ParameterContainer;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Application\Controller\AccountController;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\OrderArticle;
use OxidEsales\Eshop\Application\Model\OrderArticleList;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use OxidEsales\Eshop\Core\SeoEncoder;
use OxidEsales\Eshop\Core\UtilsView;
use OxidEsales\Facts\Facts;

class d3uploadmanager extends AccountController
{
    private $_sModId = 'd3fileupload';
    public $blThrown = false;
        
    /**
     * Template, fuer basic und azure
     * @var string 
     */
    protected $_sTemplateD3Fileupload = 'd3uploadmanager.tpl';

    /** @var  d3ParameterContainer */
    public $oParameterContainer;

	/**
	 * d3uploadmanager constructor.
	 */
    public function __construct()
    {
        parent::__construct();

        $this->oParameterContainer = oxNew(d3ParameterContainer::class);
    }

    /**
     * @return null|void
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     * @throws d3fileuploadException
     */
    public function init()
    {
        parent::init();

        if (!$this->getSet()->isActive()) {
            /** @var d3fileuploadException $oEx */
            $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
            $oEx->d3disableScreenMessage();
            $oEx->setMessage(Registry::getLang()->translateString('D3FILEUPLOAD_EXC_NOTACTIVE', null, true));
            throw $oEx;
        }

        $this->getSet()->d3getLog()->log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "starting");
    }

    /**
     * @return User
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws \Exception
     */
    public function getUser()
    {
        if (false == $this->oParameterContainer->has('oUser')) {
            /** @var \OxidEsales\Eshop\Core\Request $request */
            $request = Registry::get(Request::class);
            $sUserID	= $request->getRequestEscapedParameter("uid");
            $oUser = oxNew(User::class);

            $facts = oxNew(Facts::class);
            if (in_array(strtolower($facts->getEdition()), array('ee', 'b2b')) &&
                false == Registry::getConfig()->getConfigParam('blMallUsers')
            ) {
                $oUser->setDisableShopCheck(false);
            }

            // check user
            if (false == $sUserID ||
                false == $oUser->Load($sUserID)
            ) {
                /** @var d3fileuploadException $oEx */
                $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
                $oEx->d3enableScreenMessage();
                $oEx->setMessage('D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_UID');
                $oEx->setLogText("Can't load user, UserId is '".$sUserID."'");
                if (false == $this->blThrown) {
                    $oEx->debugOut();
                    $this->blThrown = true;
                }
                // throw $oEx;
                Registry::getUtils()->redirect(Registry::getConfig()->getShopCurrentURL().'&cl=account');
            } else {
                $this->oParameterContainer->set('oUser', $oUser);
            }
        }

        return $this->oParameterContainer->get('oUser');
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function checkHasArticle()
    {
        $sArticleID = $this->getOrderArticleId();

        $blFound = false;
        /** @var OrderArticleList $oOrderArticleList */
        $oOrderArticleList = $this->getOrder()->getOrderArticles(true);
        /** @var OrderArticle $oOrderArticle */
        foreach ($oOrderArticleList as $oOrderArticle) {
            if ($oOrderArticle->getId() == $sArticleID) {
                $blFound = true;
            }
        }

        if (!$blFound) {
            /** @var d3fileuploadException $oEx */
            $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
            $oEx->d3disableScreenMessage();
            $oEx->setMessage('D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_AID');
            $oEx->setLogText("Can't load article, ArticleId is '" . $sArticleID . "'");
            throw $oEx;
        }
    }

    /**
     * @return Order
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     * @throws \Exception
     */
    public function getOrder()
    {
        if (false == $this->oParameterContainer->has('oOrder')) {
            $sOrderID	= $this->getOrderId();
            /** @var Order $oOrder */
            $oOrder = oxNew(Order::class);

            /** @var Facts $facts */
            $facts = oxNew(Facts::class);
	        if (in_array(strtolower($facts->getEdition()), array('ee', 'b2b'))) {
	        	$oOrder->setDisableShopCheck( false );
            }

            //check order
            if (false == $oOrder->Load($sOrderID) ||
                $oOrder->getFieldData("oxuserid") != $this->getUser()->getId()
            ) {
                /** @var d3fileuploadException $oEx */
                $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
                $oEx->d3disableScreenMessage();
                $oEx->setMessage('D3FILESUPLOAD_ERROR_MESSAGE_WRONG_PARAMS_OID');
                $oEx->setLogText("Can't load order, OrderId is '".$sOrderID."'");
                throw $oEx;
            } else {
                $this->oParameterContainer->set('oOrder', $oOrder);
            }
        }

        return $this->oParameterContainer->get('oOrder');
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {

        try {
            parent::render();

            if (false == $this->getUser()) {
                return $this->_sThisTemplate = $this->_sThisLoginTemplate;
            }

            $this->addTplParam('user', $this->getUser());
            $this->addTplParam('order', $this->getOrder());
        } catch (d3fileuploadException $oEx) {
            Registry::get(UtilsView::class)->addErrorToDisplay($oEx);
        }

        return $this->_sTemplateD3Fileupload;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getSet()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3fileupload
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    protected function _getFileUpload()
    {
        if (false == $this->oParameterContainer->has('oUpload')) {
            $oUpload = oxnew(d3fileupload::class, $this->getOrder());
            $this->oParameterContainer->set('oUpload', $oUpload);
        }

        return $this->oParameterContainer->get('oUpload');
    }

	/**
	 * @return d3fileupload_setting
	 */
    public function getUploadSettings()
    {
        return oxNew(d3fileupload_setting::class);
    }

    /**
     * @return null
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function doUpload()
    {
        if ($this->orderIsFixed()) {
            return;
        }

        try {
            $this->checkHasArticle();
            $sOrderArticleID = $this->getOrderArticleId();
            $sUploadID = $this->getUploadSlotId();

            $this->getSet()->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "starting",
                "article id is '$sOrderArticleID', upload id is '$sUploadID'"
            );

            $this->_getFileUpload()->setOrderArticleId($sOrderArticleID);
            $this->_getFileUpload()->setUploadId($sUploadID);
            $blRet = $this->_getFileUpload()->doUpload();

            $this->getSet()->d3getLog()->log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "doUpload",
                "return is '$blRet'"
            );
        } catch (d3fileuploadException $oEx) {
            $oEx->debugOut();
        }

        Registry::getUtils()->redirect($this->getPageLink());

        return;
    }

    /**
     * @param $sOrderArticleId
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function hasFileCountReached($sOrderArticleId)
    {
        return $this->_getFileUpload()->hasFileCountReached($sOrderArticleId);
    }

    /**
     * loescht jeweils eine Datei
     *
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function doDelete()
    {
        if ($this->orderIsFixed()) {
            return;
        }

        try {
            $this->checkHasArticle();
            $sOrderArticleID = $this->getOrderArticleId();
            /** @var Request $request */
            $request = Registry::get(Request::class);
            $sFilename = $request->getRequestEscapedParameter("file");

            $this->getSet()->d3getLog()->log(
                d3log::NOTICE,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "starting",
                "aid is '$sOrderArticleID', file is '$sFilename'"
            );

            $oFileUpload = $this->_getFileUpload();
            $oFileUpload->setOrderArticleId($sOrderArticleID);
            $oFileUpload->setFilename($sFilename);

            $blRet = $oFileUpload->doDelete();

            $this->getSet()->d3getLog()->log(
                d3log::NOTICE,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "doDelete",
                "return is '$blRet'"
            );
        } catch (d3fileuploadException $oEx) {
            $oEx->debugOut();
        }

        Registry::getUtils()->redirect($this->getPageLink());
    }

    /**
     * @return int
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function getOrderCnt()
    {
        if (false == $this->oParameterContainer->has('iOrderCnt')) {
            $iOrderCnt = $this->getUser()->getOrderCount();
            $this->oParameterContainer->set('iOrderCnt', $iOrderCnt);
        }

        return $this->oParameterContainer->get('iOrderCnt');
    }

    /**
     * pr�ft, ob Bestellung entsprechende Artikel enth�lt
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function hasUploadArticles()
    {
        return $this->_getFileUpload()->hasUploadArticles();
    }

    /**
     * Artikel fuer die Dateien hochgeladen werden k�nnen
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function getUploadArticles()
    {
        return $this->_getFileUpload()->getUploadArticles();
    }

    /**
     * @param OrderArticle $oOrderArticle
     * @return mixed
     */
    public function getArticleFromOrderArticle($oOrderArticle)
    {
        return $oOrderArticle->getArticle();
    }

    /**
     * maximale Dateigroesse
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getMaxUploadFileCount()
    {
        return $this->getUploadSettings()->getMaxUploadFileCount();
    }

    /**
     * maximale Dateigroesse
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getFormattedMaxUploadSize()
    {
        return $this->getUploadSettings()->getFormattedMaxUploadSize();
    }

    /**
     * Gibt die erlaubten Dateitypen zurueck
     *
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3fileuploadException
     */
    public function getAllowUploadFileTypeListing()
    {
        return $this->getUploadSettings()->getAllowUploadFileTypeListing();
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function isValidAccount()
    {
        if ($this->getUser()) {
            return true;
        } else {
            /** @var Request $request */
            $request = Registry::get(Request::class);
            $sUserID = $request->getRequestEscapedParameter('uid');
            /** @var $oUser User */
            $oUser = oxnew(User::class);
            if ($oUser->load($sUserID) && $oUser->getFieldData("oxpassword")) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gibt die Dateien zurueck
     *
     * @param string $sArticleId
     *
     * @return array
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function getUploadFiles($sArticleId)
    {
        return $this->_getFileUpload()->getUploadItems($sArticleId);
    }

    /**
     * @param $sOrderArticleId
     * @param $sSlotId
     *
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function isUploadSlotEmpty($sOrderArticleId, $sSlotId)
    {
        return $this->_getFileUpload()->isUploadSlotEmpty($sOrderArticleId, $sSlotId);
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3fileuploadException
     */
    public function getOrderArticleId()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);
        $sArticleId = $request->getRequestEscapedParameter("aid");

        if (false == $sArticleId) {
            /** @var d3fileuploadException $oEx */
            $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
            $oEx->d3disableScreenMessage();
            $oEx->setMessage('D3FILEUPLOAD_ERROR_MESSAGE_ARTICLEIDNOTSET');
            throw $oEx;
        }

        return $sArticleId;
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3fileuploadException
     */
    public function getUploadSlotId()
    {
        $sSlotId = null;

        /** @var OrderArticle $oOrderArticle */
        $oOrderArticle = oxNew(OrderArticle::class);
        $oOrderArticle->load($this->getOrderArticleId());
        /** @var d3_oxarticle_fileupload $oArticle */
        $oArticle = $oOrderArticle->getArticle();

        if (count($oArticle->d3GetUploadsArray())) {
            /** @var Request $request */
            $request = Registry::get(Request::class);
            $sSlotId = $request->getRequestEscapedParameter("uploadid");

            if (false == $sSlotId || false == in_array($sSlotId, $oArticle->d3GetUploadsArray())) {
                /** @var d3fileuploadException $oEx */
                $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
                $oEx->d3disableScreenMessage();
                $oEx->setMessage('D3FILEUPLOAD_ERROR_MESSAGE_UPLOADIDNOTSET');
                throw $oEx;
            }
        }

        return $sSlotId;
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3fileuploadException
     */
    public function getOrderId()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);
        $sOrderId = $request->getRequestEscapedParameter("oid");

        if (false == $sOrderId) {
            /** @var d3fileuploadException $oEx */
            $oEx = oxNew(d3fileuploadException::class, $this->getSet()->d3getLog(), d3log::ERROR);
            $oEx->d3disableScreenMessage();
            $oEx->setMessage('D3FILEUPLOAD_ERROR_MESSAGE_ORDERIDNOTSET');
            throw $oEx;
        }

        return $sOrderId;
    }

    /**
     * @return string
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function getNoUploadArticlesMessage()
    {
        return sprintf(
            Registry::getLang()->translateString('D3_UPLOADMANAGER_NO_UPLOAD'),
            $this->getOrder()->getFieldData('oxordernr')
        );
    }

	/**
	 * @return array
	 */
    public function getBreadCrumb()
    {
        $aPaths = array();
        $aPath  = array();

        $language = Registry::getLang();

        $aPath['title'] = $language->translateString(
            'MY_ACCOUNT',
            $language->getBaseLanguage(),
            false
        );
        $aPath['link']  =  Registry::get(SeoEncoder::class)->getStaticUrl(
            $this->getViewConfig()->getSelfLink() . "cl=account"
        );
        $aPaths[] = $aPath;

        $aPath['title'] = $language->translateString(
            'ORDER_HISTORY',
            $language->getBaseLanguage(),
            false
        );
        $aPath['link']  =  Registry::get(SeoEncoder::class)->getStaticUrl(
            $this->getViewConfig()->getSelfLink() . "cl=account_order"
        );
        $aPaths[] = $aPath;

        $aPath['title'] = $language->translateString(
            'D3_UPLOADMANAGER_HEAD_TITLE',
            $language->getBaseLanguage(),
            false
        );
        $aPath['link']  = $this->getPageLink();
        $aPaths[] = $aPath;

        return $aPaths;
    }

    /**
     * @return string
     */
    public function getPageLink()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);

        return $this->getViewConfig()->getSelfLink() . "cl=d3uploadmanager".
        "&amp;oid=".$request->getRequestEscapedParameter('oid').
        "&amp;uid=".$request->getRequestEscapedParameter('uid');
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function d3fixorder()
    {
        $oOrder = $this->getOrder();

        if ($oOrder) {
            $oOrder->assign(
                array(
                    'd3uploadfixed'   => date('Y-m-d H:i:s'),
                )
            );
            $oOrder->save();
        }

        Registry::getUtils()->redirect($this->getPageLink());
    }

    /**
     * @return mixed
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function hasFixation()
    {
        return $this->getSet()->getValue('blAllowFixation');
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ParameterNotFoundException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileuploadException
     */
    public function orderIsFixed()
    {
        if (false == $this->hasFixation()) {
            return false;
        }

        $oOrder = $this->getOrder();
        return $oOrder->getFieldData('d3uploadfixed') == '0000-00-00 00:00:00' ? false : true;
    }
}
