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

namespace D3\Fileupload\Setup;

use D3\Fileupload\Application\Model\d3fileupload_setting;
use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ParameterNotFoundException;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\ConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\UtilsObject;

class d3fileupload_update extends d3install_updatebase
{
    public $sModKey = 'd3fileupload';
    public $sModName = 'FileUpload';
    public $sModVersion = '5.0.0.0';
    public $sModRevision = '5000';
    public $sBaseConf = 'yPgv2==Nnl5c2l2cWRrcnhOTElJRjBnZXdiWTZGZU8zOUR2YS9YVTBPam9IVm9GVjRicWUvTTdmRGpQd
GtGNUFhOWpLbnBUK1gzbGZkNldTUE5BTTNoV0QzYVJKTkRrZEZMUHpqMHlOVXlSWUtrOUx4WDV2VGRPO
HllQ3M2bXZTWGdNQ3Rzejl4TTY2T3F0eUR0U0ZpRldnQkY0Ky82MStJY1RlRWF3YXJZTGNIYXFOYU1GZ
VhqTUUzSFp5UHl2eEIyMXZQTzgwQWJSTWlHcTYvNXRPYk5UN3l0bUM3VUhqbldSbHEyRytqL1hZZXBtZ
zBpT2xkWXZHTTVHT0hCZ01DbjN3TThNQXVOZWNSZHFVeGUwUmtLRS9xWng0ams4dXBVUGlFcGs1U0lGW
VRpbDIvUjk4MGdldVhzWkxwYlprNVB5dEhuR0ZHM1pjZVg0ZlhGTlVGbVlNbzB3PT0=';
    public $sRequirements = '';
    public $sBaseValue = 'TyUzQTglM0ElMjJzdGRDbGFzcyUyMiUzQTE1JTNBJTdCcyUzQTMyJTNBJTIyZDNfY2ZnX21vZF9fYUQzQWxsb3dlZFVwbGFkRmlsZXMlMjIlM0JhJTNBMTElM0ElN0JpJTNBMCUzQnMlM0EzJTNBJTIyemlwJTIyJTNCaSUzQTElM0JzJTNBMyUzQSUyMnJhciUyMiUzQmklM0EyJTNCcyUzQTMlM0ElMjJqcGclMjIlM0JpJTNBMyUzQnMlM0EzJTNBJTIyZ2lmJTIyJTNCaSUzQTQlM0JzJTNBMyUzQSUyMnBuZyUyMiUzQmklM0E1JTNCcyUzQTMlM0ElMjJwZGYlMjIlM0JpJTNBNiUzQnMlM0EzJTNBJTIycHNkJTIyJTNCaSUzQTclM0JzJTNBMyUzQSUyMmRvYyUyMiUzQmklM0E4JTNCcyUzQTQlM0ElMjJkb2N4JTIyJTNCaSUzQTklM0JzJTNBMyUzQSUyMnhscyUyMiUzQmklM0ExMCUzQnMlM0E0JTNBJTIyeGxzeCUyMiUzQiU3RHMlM0EyNCUzQSUyMmQzX2NmZ19tb2RfX3NEM1VwbG9hZERpciUyMiUzQnMlM0ExNyUzQSUyMi4uJTJGLi4lMkZ1cGxvYWRmaWxlcyUyMiUzQnMlM0EyNCUzQSUyMmQzX2NmZ19tb2RfX3NEM1VwbG9hZFVybCUyMiUzQnMlM0E1JTNBJTIyZmlsZXMlMjIlM0JzJTNBMjUlM0ElMjJkM19jZmdfbW9kX19zRDNVcGxvYWRQZXJtJTIyJTNCcyUzQTQlM0ElMjIwNjQ0JTIyJTNCcyUzQTI4JTNBJTIyZDNfY2ZnX21vZF9faUQzTWF4VXBsb2FkU2l6ZSUyMiUzQmklM0EyMDk3MTUyJTNCcyUzQTI5JTNBJTIyZDNfY2ZnX21vZF9faUQzTWF4VXBsb2FkRmlsZXMlMjIlM0JzJTNBMSUzQSUyMjUlMjIlM0JzJTNBMjglM0ElMjJkM19jZmdfbW9kX19hTGljZW5zZUluZm9NYWlsJTIyJTNCYSUzQTIlM0ElN0JzJTNBNDIlM0ElMjJOT0xJQ0tFWV9fNDc5MzYzODcwMmI2NzcxNWYxZGZiZmM4MzI0NjY5MTQlMjIlM0JzJTNBMTklM0ElMjIyMDEzLTAxLTEwJTIwMTIlM0ExNyUzQTM1JTIyJTNCcyUzQTQzJTNBJTIyTk9DT05GS0VZX19kNDFkOGNkOThmMDBiMjA0ZTk4MDA5OThlY2Y4NDI3ZSUyMiUzQnMlM0ExOSUzQSUyMjIwMTMtMDEtMTAlMjAwMSUzQTQyJTNBNTklMjIlM0IlN0RzJTNBNDQlM0ElMjJkM19jZmdfbW9kX19ibFVwZGF0ZUhhc0NoZWNrZWRGb3JPcnBoYW5GaWxlcyUyMiUzQmklM0ExJTNCcyUzQTQxJTNBJTIyZDNfY2ZnX21vZF9fYUQzQWxsb3dlZFVwbGFkRmlsZUV4dGVuc2lvbnMlMjIlM0JhJTNBOCUzQSU3QmklM0EwJTNCcyUzQTMlM0ElMjJwZGYlMjIlM0JpJTNBMSUzQnMlM0EzJTNBJTIyanBnJTIyJTNCaSUzQTIlM0JzJTNBMyUzQSUyMnBuZyUyMiUzQmklM0EzJTNCcyUzQTMlM0ElMjJwc2QlMjIlM0JpJTNBNCUzQnMlM0EzJTNBJTIyZG9jJTIyJTNCaSUzQTUlM0JzJTNBNCUzQSUyMmRvY3glMjIlM0JpJTNBNiUzQnMlM0EzJTNBJTIyeGxzJTIyJTNCaSUzQTclM0JzJTNBNCUzQSUyMnhsc3glMjIlM0IlN0RzJTNBMjglM0ElMjJkM19jZmdfbW9kX19zRDNVcGxvYWRQZXJtZGlyJTIyJTNCcyUzQTQlM0ElMjIwNzQ0JTIyJTNCcyUzQTI5JTNBJTIyZDNfY2ZnX21vZF9fc0QzVXBsb2FkUGVybWZpbGUlMjIlM0JzJTNBNCUzQSUyMjA2NjQlMjIlM0JzJTNBMzQlM0ElMjJkM19jZmdfbW9kX19ibFZhcmlhbnRJbmhlcml0VXBsb2FkJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI3JTNBJTIyZDNfY2ZnX21vZF9fYmxBbGxvd0ZpeGF0aW9uJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI0JTNBJTIyZDNfY2ZnX21vZF9fYmxDcm9uQWN0aXZlJTIyJTNCcyUzQTElM0ElMjIwJTIyJTNCcyUzQTI1JTNBJTIyZDNfY2ZnX21vZF9fc0Nyb25QYXNzd29yZCUyMiUzQnMlM0E4JTNBJTIyQjhnbjlNUmElMjIlM0IlN0Q=';

    protected $_aUpdateMethods = array
    (
        array('check' => 'checkModCfgItemExist',
              'do'    => 'updateModCfgItemExist'),
        array('check' => 'checkFileUploadTableExist',
              'do'    => 'updateFileUploadTableExist'),
        array('check' => 'checkFields',
              'do'    => 'fixFields'),
        array('check' => 'checkIndizes',
              'do'    => 'fixIndizes'),
        array('check' => 'hasNoUploadDir',
              'do'    => 'createUploadDir'),
        array('check' => 'hasNoTuples',
              'do'    => 'addFilesWithoutTuples'),
        array('check' => 'hasUnregisteredFiles',
              'do'    => 'showUnregisteredFiles'),
        array('check' => 'checkModCfgSameRevision',
              'do'    => 'updateModCfgSameRevision'),
    );

    // Standardwerte fuer checkMultiLangTables() und fixRegisterMultiLangTables()
    public $aMultiLangTables = array();

    public $aFields = array(
        'OOA_D3ISUPLOAD'        => array(
            'sTableName'  => 'oxorderarticles',
            'sFieldName'  => 'D3ISUPLOAD',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'd3FileUpload: article requires upload',
            'sExtra'      => '',
            'blMultilang' => false,
            'blAddBreak'  => true,
        ),
        'OO_D3UPLOADFIXED'        => array(
            'sTableName'  => 'oxorder',
            'sFieldName'  => 'D3UPLOADFIXED',
            'sType'       => 'DATETIME',
            'blNull'      => false,
            'sDefault'    => '0000-00-00 00:00:00',
            'sComment'    => 'd3FileUpload: uploads are fixed',
            'sExtra'      => '',
            'blMultilang' => false,
            'blAddBreak'  => true,
        ),
        'OA_D3ISUPLOAD'        => array(
            'sTableName'  => 'oxarticles',
            'sFieldName'  => 'D3ISUPLOAD',
            'sType'       => 'TINYINT(1)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'd3FileUpload: article requires upload',
            'sExtra'      => '',
            'blMultilang' => false,
            'blAddBreak'  => true,
        ),
        'OA_D3FILEUPLOADS' => array(
            'sTableName'  => 'oxarticles',
            'sFieldName'  => 'D3FILEUPLOADS',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'd3FileUpload: article dependend file uploads',
            'sExtra'      => '',
            'blMultilang' => false,
            'blAddBreak'  => true,
        ),
        'FU_OXID'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXORDERID'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXORDERID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXORDERARTICLEID'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXORDERARTICLEID',
            'sType'       => 'CHAR(32)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXUPLOADID'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXUPLOADID',
            'sType'       => 'CHAR(100)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXFILENAME'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXFILENAME',
            'sType'       => 'VARCHAR(255)',
            'blNull'      => false,
            'sDefault'    => false,
            'sComment'    => '',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXFILESIZE'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXFILESIZE',
            'sType'       => 'INT(9)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'filesize in bytes',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXFILECTIME'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXFILECTIME',
            'sType'       => 'INT(10)',
            'blNull'      => false,
            'sDefault'    => '0',
            'sComment'    => 'change time',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXUPLOADDATE'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXUPLOADDATE',
            'sType'       => 'DATETIME',
            'blNull'      => false,
            'sDefault'    => '0000-00-00 00:00:00',
            'sComment'    => 'upload time',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
        'FU_OXUPLOADNOTE'        => array(
            'sTableName'  => 'd3fileupload',
            'sFieldName'  => 'OXUPLOADNOTE',
            'sType'       => 'TEXT',
            'blNull'      => false,
            'sDefault'    => '',
            'sComment'    => 'note for upload file',
            'sExtra'      => '',
            'blMultilang' => false,
        ),
    );

    public $aIndizes = array(
        'FU_OXID' => array(
            'sTableName' => 'd3fileupload',
            'sType'      => d3database::INDEX_TYPE_PRIMARY,
            'aFields'    => array(
                'OXID' => 'OXID',
            ),
        ),
        'FU_OXORDERID' => array(
            'sTableName' => 'd3fileupload',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'OXORDERID',
            'aFields'    => array(
                'OXORDERID' => 'OXORDERID',
            ),
        ),
        'FU_OXORDERARTICLEID' => array(
            'sTableName' => 'd3fileupload',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'OXORDERARTICLEID',
            'aFields'    => array(
                'OXORDERARTICLEID' => 'OXORDERARTICLEID',
            ),
        ),
        'FU_OXORDERARTICLEUPLOADID' => array(
            'sTableName' => 'd3fileupload',
            'sType'      => d3database::INDEX_TYPE_INDEX,
            'sName'      => 'OXORDERARTICLEUPLOADID',
            'aFields'    => array(
                'OXORDERARTICLEID' => 'OXORDERARTICLEID',
                'OXUPLOADID'       => 'OXUPLOADID',
            ),
        ),
    );

    protected $_aRefreshMetaModuleIds = array('d3fileupload');

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function checkFileUploadTableExist()
    {
        return $this->_checkTableNotExist('d3fileupload');
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ConnectionException
     */
    public function updateFileUploadTableExist()
    {
        $blRet = false;
        if ($this->checkFileUploadTableExist()) {
            $this->setInitialExecMethod(__METHOD__);
            $blRet  = $this->_addTable2(
                'd3fileupload',
                $this->aFields,
                $this->aIndizes,
                'file uploads for order articles',
                'MyISAM'
            );
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function hasNoUploadDir()
    {
        /** @var d3fileupload_setting $oFileUploadSettings */
        $oFileUploadSettings = oxNew(d3fileupload_setting::class);
        $sPath = $oFileUploadSettings->getFullUploadDir();

        /** @var d3filesystem $fileSystem */
        $fileSystem = oxNew(d3filesystem::class);
        return !$fileSystem->exists($sPath);
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function createUploadDir()
    {
        $blRet = true;
        /** @var d3fileupload_setting $oFileUploadSettings */
        $oFileUploadSettings = oxNew(d3fileupload_setting::class);
        $sPath = $oFileUploadSettings->getFullUploadDir();

        $this->setInitialExecMethod(__METHOD__);

        /** @var d3filesystem $fileSystem */
        $fileSystem = oxNew(d3filesystem::class);

        if ($this->hasExecute()) {
            $blRet = $fileSystem->create_dir_tree($sPath);
        } else {
            $this->setActionLog(
                'MSG',
                sprintf(
                    Registry::getLang()->translateString('D3FILEUPLOAD_UPDATE_UPLOADDIR'),
                    $sPath
                ),
                $this->getInitialExecMethod(__METHOD__)
            );
        }

        return $blRet;
    }

    /**
     * @return bool true, if update is required
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function hasNoTuples()
    {
        $blRet = false;

        /** @var d3_cfg_mod $oModCfg */
        $oModCfg = d3_cfg_mod::get($this->sModKey);
        if ($oModCfg->getValue('blUpdateHasCheckedForOrphanFiles')) {
            return $blRet;
        }

        // change this to your inividual check criterias
        $sSql  = "SELECT count(`oxid`) ";
        $sSql .= "FROM `d3fileupload` WHERE 1;";

        if ($this->getDb()->getOne($sSql) == 0) {
            $blRet = true;
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws StandardException
     */
    public function addFilesWithoutTuples()
    {
        $blRet = true;

        /** @var d3filesystem $oFileSystem */
        $oFileSystem = oxNew(d3filesystem::class);

        /** @var d3fileupload_setting $oFileUploadSettings */
        $oFileUploadSettings = oxNew(d3fileupload_setting::class);
        $sPath = $oFileUploadSettings->getFullUploadDir();
        $aOrderList = $oFileSystem->dirlist($sPath, false, true, true);

        $aQueries = array();

        foreach ($aOrderList as $aOrder) {
            $this->_handleOrderUploadFiles($aQueries, $aOrder);
        }

        $this->setInitialExecMethod(__METHOD__);

        if (count($aQueries)) {
            foreach ($aQueries as $sSql) {
                $this->sqlExecute($sSql);
            }
            $this->setActionLog('SQL', implode(PHP_EOL . PHP_EOL, $aQueries), $this->getInitialExecMethod(__METHOD__));
        }

        /** @var d3_cfg_mod $oModCfg */
        $oModCfg = d3_cfg_mod::get($this->sModKey);
        $oModCfg->setValue('blUpdateHasCheckedForOrphanFiles', 1);
        $oModCfg->saveNoLicenseRefresh();
        $this->setUpdateBreak(true);

        return $blRet;
    }

    /**
     * @param $aQueries
     * @param $aOrder
     *
     * @throws DatabaseConnectionException
     */
    public function _handleOrderUploadFiles(&$aQueries, $aOrder)
    {
        if ($aOrder['type'] == 'd') {
            $sOrderId = $aOrder['name'];
            if (is_array($aOrder['files'])) {
                foreach ($aOrder['files'] as $aOrderArticle) {
                    if ($aOrderArticle['type'] == 'd') {
                        $sOrderArticleId = $aOrderArticle['name'];
                        $this->_handleOrderArticleUploadFiles(
                            $aQueries,
                            $aOrderArticle,
                            $sOrderId,
                            $sOrderArticleId
                        );
                    }
                }
            }
        }
    }

    /**
     * @param $aQueries
     * @param $aOrderArticle
     * @param $sOrderId
     * @param $sOrderArticleId
     *
     * @throws DatabaseConnectionException
     */
    protected function _handleOrderArticleUploadFiles(&$aQueries, $aOrderArticle, $sOrderId, $sOrderArticleId)
    {
        if (is_array($aOrderArticle['files'])) {
            foreach ($aOrderArticle['files'] as $aOrderArticleUpload) {
                if ($aOrderArticleUpload['type'] == 'f') {
                    $aQueries[] = $this->_getUploadFileQuery (
                        $sOrderId,
                        $sOrderArticleId,
                        $aOrderArticleUpload
                    );
                }
            }
        }
    }

    /**
     * @param $sOrderId
     * @param $sOrderArticleId
     * @param $aFileData
     *
     * @return string
     * @throws DatabaseConnectionException
     */
    protected function _getUploadFileQuery($sOrderId, $sOrderArticleId, $aFileData)
    {
        $oDb = DatabaseProvider::getDb(DatabaseProvider::FETCH_MODE_ASSOC);
        $sQuery = "INSERT INTO d3fileupload (".
            "`oxid`, ".
            "`oxorderid`, ".
            "`oxorderarticleid`, ".
            "`oxfilename`, ".
            "`oxfilesize`, ".
            "`oxfilectime`, ".
            "`oxuploaddate`) VALUES (".
            $oDb->quote(UtilsObject::getInstance()->generateUId()).", ".
            $oDb->quote($sOrderId).", ".
            $oDb->quote($sOrderArticleId).", ".
            $oDb->quote($aFileData['name']).", ".
            $oDb->quote($aFileData['size']).", ".
            $oDb->quote($aFileData['lastmodunix']).", ".
            $oDb->quote(date("Y-m-d H:i:s")).");";

        return $sQuery;
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
    public function hasUnregisteredFiles()
    {
        return $this->_hasUnregisteredFiles('d3fileupload', array('blocks', 'd3FileRegister'));
    }

    /**
     * @return bool
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function showUnregisteredFiles()
    {
        return $this->_showUnregisteredFiles('d3fileupload', array('blocks', 'd3FileRegister'));
    }
}
