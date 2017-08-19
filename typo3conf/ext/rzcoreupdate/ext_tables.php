<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/**
 * Backend module
 */

$t = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['rzcoreupdate']);
if ($t['enableBackendModule']) {
    if (TYPO3_MODE === 'BE') {
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule('RZ.' . $_EXTKEY, 'tools', 'tx_rzcoreupdate_m1', '', array(
            'Update' => 'index,import,switch,delete',
        ), array(
            'access' => 'admin',
            'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/moduleicon.svg',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xlf',
        ));
    }
}

/**
 * Add to reports module
 */
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['reports']['tx_reports']['status']['providers']['typo3'][] = 'RZ\\Rzcoreupdate\\Hook\\Reports\\VersionStatusProvider';
