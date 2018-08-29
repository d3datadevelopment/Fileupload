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
use D3\Fileupload\Application\Model\Exceptions\d3fileupload_cronUnavailableException;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Log\d3log;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3fileupload_response extends Base
{
    private $_sModId = 'd3fileupload';

    /**
     * @return void
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function init()
    {
        startProfile(__METHOD__);

        $blExceptionThrown = $this->_startExecution();

        if ($this->isBrowserCall() && false == $blExceptionThrown) {
            echo "script successfully finished".PHP_EOL;
        }

        Registry::getSession()->freeze();

        stopProfile(__METHOD__);

        $this->_getSet()->d3getLog()->d3GetProfiling();
    }

    /**
     * @return bool
     */
    protected function _startExecution()
    {
        startProfile(__METHOD__);

        $blExc = false;

        try {
            $this->_getSet()->d3getLog()->log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "start", "");

            $this->_checkUnavailableCronjob();
            $this->_startJob();
            $this->_getSet()->setValue('sCronExecTimestamp', date('Y-m-d H:i:s'));
            $this->_getSet()->saveNoLicenseRefresh();
            $this->_getSet()->d3getLog()->log(d3log::INFO, __CLASS__, __FUNCTION__, __LINE__, "end");

        } catch (d3fileupload_cronUnavailableException $oEx) {
            /** @var d3fileupload_cronunavailableexception $oEx */
            $oEx->d3showMessage();
            $blExc = true;
        } catch (Exception $oEx) {
            /** @var Exception $oEx */
            $oEx->debugOut();
            $blExc = true;
        }

        stopProfile(__METHOD__);

        return $blExc;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _startJob()
    {
        startProfile(__METHOD__);

        /** @var d3fileupload $oFileUpload */
        $oFileUpload = oxNew(d3fileupload::class, oxNew(Order::class));
        $oFileUpload->sendNotificationMail();

        stopProfile(__METHOD__);
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _checkAccessKey()
    {
        /** @var d3fileupload_setting $oModuleSettings */
        $oModuleSettings = oxNew(d3fileupload_setting::class);

        /** @var Request $request */
        $request = Registry::get(Request::class);

        $sGetAccessKey  = $request->getRequestEscapedParameter("key");
        $sRegisteredAccessKey = $oModuleSettings->getCronPassword();

        if ($this->hasValidAccessKey($sRegisteredAccessKey, $sGetAccessKey)) {
            return false;
        }

        return true;
    }

    /**
     * @return d3_cfg_mod
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    protected function _getSet()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function showDisabledMessage()
    {
        return false == $this->_getSet()->getValue('blCronActive') &&
        ($this->_getSet()->hasDebugMode() || $this->isBrowserCall());
    }

    /**
     * @return bool
     */
    public function isBrowserCall()
    {
        return $_SERVER['REMOTE_ADDR'] || $_SERVER['HTTP_USER_AGENT'];
    }

    /**
     * @param $sRegisteredAccessKey
     * @param $sGetAccessKey
     *
     * @return bool
     */
    protected function hasValidAccessKey($sRegisteredAccessKey, $sGetAccessKey)
    {
        return (
            $_SERVER['REMOTE_ADDR'] ||
            $_SERVER['HTTP_USER_AGENT']
        ) && $sRegisteredAccessKey != $sGetAccessKey;
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     * @throws d3fileupload_cronUnavailableException
     */
    protected function _checkUnavailableCronjob()
    {
        if (false == $this->_getSet()->isActive()) {
            /** @var d3fileupload_cronunavailableexception $oEx */
            $oEx = oxNew(d3fileupload_cronunavailableexception::class, $this->_getSet()->d3getLog(), d3log::INFO);
            $oEx->setMessage(Registry::getLang()->translateString('D3FILEUPLOAD_EXC_NOTACTIVE', 1));
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } elseif (false == $this->_checkAccessKey()) {
            /** @var d3fileupload_cronunavailableexception $oEx */
            $oEx = oxNew(d3fileupload_cronunavailableexception::class, $this->_getSet()->d3getLog(), d3log::INFO);
            $oEx->setMessage('cron via browser: missing or wrong identification');
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } else {
            $this->_checkDisabledCronjob();
        }
    }

    /**
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws d3fileupload_cronUnavailableException
     */
    public function _checkDisabledCronjob()
    {
        if ($this->showDisabledMessage()) {
            /** @var d3fileupload_cronunavailableexception $oEx */
            $oEx = oxNew(d3fileupload_cronunavailableexception::class, $this->_getSet()->d3getLog(), d3log::ERROR);
            $oEx->setMessage('cronjob script is disabled');
            $oEx->d3enableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        } elseif (false == $this->_getSet()->getValue('blCronActive')) {
            /** @var d3fileupload_cronunavailableexception $oEx */
            $oEx = oxNew(d3fileupload_cronunavailableexception::class, $this->_getSet()->d3getLog(), d3log::ERROR);
            $oEx->setMessage('cronjob script is disabled');
            $oEx->d3disableScreenMessage();
            $oEx->debugOut();
            throw $oEx;
        }
    }
}
