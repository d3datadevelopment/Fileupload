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

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

class d3_oxarticle_fileupload extends d3_oxarticle_fileupload_parent
{
    private $_sModId = 'd3fileupload';

    /**
     * d3_oxarticle_fileupload constructor.
     *
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function __construct()
    {
        parent::__construct();

        if (d3_cfg_mod::get($this->_sModId)->getValue('blVariantInheritUpload')) {
            $this->_aCopyParentField[] = 'oxarticles__d3isupload';
        }
    }

    /**
     * @return bool
     */
    public function save()
    {
        /** @var Request $request */
        $request = Registry::get(Request::class);
        $aEditVal = $request->getRequestEscapedParameter('editval');

        $aUploads = array();
        foreach (explode(PHP_EOL, $aEditVal['oxarticles__d3fileuploads']) as $sUpload) {
            $sUpload = trim($sUpload);
            if (strlen($sUpload)) {
                $aUploads[] = trim($sUpload);
            }
        }

        $this->_setFieldData('d3fileuploads', implode('|', $aUploads));

        return parent::save();
    }

    /**
     * @return array
     */
    public function d3GetUploadsArray()
    {
        if ($this->getFieldData('d3fileuploads')) {
            return explode('|', $this->getFieldData('d3fileuploads'));
        }

        return array();
    }

    /**
     * @return string
     */
    public function d3GetEditUploadsArray()
    {
        return implode(PHP_EOL, $this->d3GetUploadsArray());
    }
}
