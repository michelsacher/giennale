<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'realurl_cache',
    \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
    array(
        'source' => 'EXT:realurlclearcache/Resources/Public/Images/be_icon.svg',
    )
);

// Register additional clear cache menu item
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions']['flushRealurlCache'] = 'RZ\\Realurlclearcache\\Toolbar\\ToolbarItem';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerAjaxHandler(
    'realurl_cache::flushCache',
    'RZ\\Realurlclearcache\\Toolbar\\ToolbarItem->flushCache'
);