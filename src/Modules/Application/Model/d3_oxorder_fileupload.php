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

use OxidEsales\Eshop\Application\Model\OrderArticle;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsFile;

class d3_oxorder_fileupload extends d3_oxorder_fileupload_parent
{
    /**
     * Gibt true zurueck, wenn der Kunde mindestens einen Uploadartikel gekauft hat
     * @return bool
     */
    public function getD3CustomerBoughtUploadArticles()
    {
        $oArticleList = $this->getOrderArticles();

        /** @var OrderArticle $oOrderArticle */
        foreach ($oArticleList as $oOrderArticle) {
            $blIsUpload= $oOrderArticle->getFieldData('d3isupload');
            if (false == empty($blIsUpload)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Gibt den Upload-Link der aktuellen Bestellung zurueck
     * @return string URL
     */
    public function getUploadLink()
    {
        if (!$this->getId() || !$this->getD3CustomerBoughtUploadArticles()) {
            return null;
        }

        return Registry::get(UtilsFile::class)->normalizeDir(
            Registry::getConfig()->getShopUrl()
        ) . "index.php?cl=d3uploadmanager&uid=" . $this->getFieldData('oxuserid') . "&oid=" . $this->getId();
    }
}
