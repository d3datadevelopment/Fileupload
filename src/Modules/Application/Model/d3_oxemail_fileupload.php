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

namespace D3\Fileupload\Modules\Application\Model;

use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\Registry;

class d3_oxemail_fileupload extends d3_oxemail_fileupload_parent
{
    protected $_sFileUploadInfoTemplate = 'd3fileupload_notification_html.tpl';

    protected $_sFileUploadInfoPlainTemplate = 'd3fileupload_notification_plain.tpl';

	/**
	 * @param ListModel $aFixedOrderList
	 * @param ListModel $aUploadOrderList
	 *
	 * @return bool
	 */
    public function d3FileUploadSendNotification(ListModel $aFixedOrderList, ListModel $aUploadOrderList)
    {
        $oShop = $this->_getShop();
        $this->_setMailParams($oShop);

        $oSmarty = $this->_getSmarty();

        $this->setViewData("aFixedOrderList", $aFixedOrderList);
        $this->setViewData("aUploadOrderList", $aUploadOrderList);
        $this->setViewData("shopTemplateDir", Registry::getConfig()->getTemplateDir(false));
        $this->setViewData("oShop", $oShop);
        $oSmarty->template_dir = Registry::getConfig()->getTemplateDir(false);

        $this->_processViewArray();

        $this->setBody($oSmarty->fetch($this->_sFileUploadInfoTemplate));
        $this->setAltBody($oSmarty->fetch($this->_sFileUploadInfoPlainTemplate));

        $sSubject = Registry::getLang()->translateString('D3FILEUPLOAD_MAIL_SUBJECT', 0);
        $this->setSubject($sSubject);

        $sFullName = $oShop->__get('oxshops__oxname')->getRawValue();

        $this->setRecipient($oShop->getFieldData('oxinfoemail'), $sFullName);
        $this->setReplyTo($oShop->getFieldData('oxinfoemail'), $oShop->__get('oxshops__oxname')->getRawValue());

        $blSuccess = $this->send();

        return $blSuccess;
    }
}
