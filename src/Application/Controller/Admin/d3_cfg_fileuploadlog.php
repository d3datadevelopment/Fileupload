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

use D3\ModCfg\Application\Controller\Admin\Log\d3_cfg_log;

class d3_cfg_fileuploadlog extends d3_cfg_log
{
    protected $_sModId = 'd3fileupload';

    /**
     * @return string
     */
    public function d3getAdditionalUrlParams()
    {
        $sRet = parent::d3getAdditionalUrlParams();

        if ($this->_sModId) {
            $sRet .= '&sD3ModId='.$this->_sModId;
        }

        return $sRet;
    }
}