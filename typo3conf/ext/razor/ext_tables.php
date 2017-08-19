<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Config
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

/* 1&1 fix BEGIN */

if (trim($confArr['staging_1and1fix'])) {
    $confArr['basedomain_staging'] = str_replace("www.", "", $confArr['basedomain_staging']);
}

if (trim($confArr['live_1and1fix'])) {
    $confArr['basedomain_live'] = str_replace("www.", "", $confArr['basedomain_live']);
}

if (trim($confArr['feature_1and1fix'])) {
    $confArr['basedomain_feature'] = str_replace("www.", "", $confArr['basedomain_feature']);
}

/* 1&1 fix END */

if ($_SERVER['SERVER_NAME'] == $confArr['basedomain_staging'] || $_SERVER['SERVER_NAME'] == $confArr['basedomain_live'] || $_SERVER['SERVER_NAME'] == $confArr['basedomain_feature']) {
    $TBE_MODULES['tools'] = str_replace(array(
        'ExtensionmanagerExtensionmanager,',
        'LangLanguage,',
        'ExtensionBuilderExtensionbuilder,',
    ), '', $TBE_MODULES['tools']);

    $TBE_MODULES['system'] = str_replace(array(
        'InstallInstall,',
    ), '', $TBE_MODULES['system']);
}

// Backend module search/replace
if ($confArr['show_module']) {
    ExtensionUtility::registerModule('RZ.' . $_EXTKEY, 'tools', 'tx_razor_m1', '', array(
        'BackendSearchReplace' => 'replace',
    ), array(
        'access' => 'admin',
        'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/Modules/search_replace.svg',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/Modules/locallang_m1.xlf',
    ));
}

// Backend module tools
if ($confArr['show_tools_module']) {
    ExtensionUtility::registerModule('RZ.' . $_EXTKEY, 'tools', 'tx_razor_m2', '', array(
        'BackendTools' => 'tools, create',
    ), array(
        'access' => 'admin',
        'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Images/Modules/tools.svg',
        'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/Modules/locallang_m2.xlf',
    ));
}

// Show tables in page module
$tables = array(
    'tx_razor_domain_model_color' => 'title',
    'tx_razor_domain_model_padding' => 'title',
    'tx_razor_domain_model_icon' => 'title',
    'tx_razor_domain_model_size' => 'title',
    'tx_razor_domain_model_state' => 'title',
    'tx_razor_domain_model_tablestyles' => 'title',
    'tx_razor_domain_model_effects' => 'title',
    'tx_razor_domain_model_headerstyles' => 'title',
);

// Traverse tables
foreach ($tables as $table => $fields) {
    ExtensionManagementUtility::allowTableOnStandardPages($table);

    $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['cms']['db_layout']['addTables'][$table][] = array(
        'fList' => $fields,
        'icon' => true,
    );
}

// Define a new doktype
$customPageDoktype = 115;
$customPageIcon = ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Mixed/newsDetail.svg';
$customPageIconHide = ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Images/Mixed/newsDetail-hideinmenu.svg';

// Add the new doktype to the list of page types
$GLOBALS['PAGES_TYPES'][$customPageDoktype] = array(
    'type' => 'sys',
    'icon' => $customPageIcon,
    'allowedTables' => '*',
);

// Add the new doktype to the page type selector
$GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = array(
    'LLL:EXT:razor/Resources/Private/Language/locallang.xlf:newsDetail',
    $customPageDoktype,
    $customPageIcon,
);

// Add the new doktype to the list of types available from the new page menu at the top of the page tree
ExtensionManagementUtility::addUserTSConfig('options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $customPageDoktype . ')');

// Add new doktype to clickmenu
if (TYPO3_MODE == 'BE') {
    if (ExtensionManagementUtility::isLoaded('rzpagetreetools')) {
        ExtensionManagementUtility::registerExtDirectComponent('TYPO3.razor.Menue', 'RZ\\Razor\\Utility\\Clickmenu\\Doktype');
        $GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = ExtensionManagementUtility::extPath($_EXTKEY, 'Resources/Private/Php/Clickmenu.php');

        $GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= '
			[userFunc = user_check_be_user_razor(115)]

	  options.contextMenu {
	    table.pages.items {
	      950 {
	        900 = ITEM
	        900 {
	          name = newsPage
	          label = LLL:EXT:razor/Resources/Private/Language/locallang.xlf:newsDetail
	          icon = ' . $customPageIcon . '
	          iconName = razor-newspage
	          displayCondition =
	          callbackAction = newsPage
	        }
	      }
	    }
	  }

	  [global]
  ';
    }
}

// Register icons
$iconRegistry = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'razor-newspage',
    SvgIconProvider::class,
    array(
        'source' => 'EXT:razor/Resources/Public/Images/Mixed/newsDetail.svg',
    )
);
$iconRegistry->registerIcon(
    'razor-newspage-hideinmenu',
    SvgIconProvider::class,
    array(
        'source' => 'EXT:razor/Resources/Public/Images/Mixed/newsDetail-hideinmenu.svg',
    )
);
