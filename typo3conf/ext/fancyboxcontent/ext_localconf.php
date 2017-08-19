<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'RZ.' . $_EXTKEY,
    'Fancybox',
    array(
        'Fancybox' => 'list',

    ),
    // non-cacheable actions
    array(
        'Fancybox' => '',

    )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:fancyboxcontent/Configuration/TSconfig/ContentElementWizard.txt">');