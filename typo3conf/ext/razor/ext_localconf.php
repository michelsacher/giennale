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

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Default TsConfig
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TypoScript/TSConfig/Page.ts">');
ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TypoScript/TSConfig/Grid.ts">');

// Default User TSConfig
ExtensionManagementUtility::addUserTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TypoScript/TSConfig/User/General.ts">');

// Gridelements XCLASS
if (ExtensionManagementUtility::isLoaded('gridelements')) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['GridElementsTeam\\Gridelements\\Backend\\LayoutSetup'] = array(
        'className' => 'RZ\\Razor\\Hooks\\Gridelements\\LayoutSetup',
    );

    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['GridElementsTeam\\Gridelements\\Hooks\\WizardItems'] = array(
        'className' => 'RZ\\Razor\\Hooks\\Gridelements\\WizardItems',
    );
}

// vhs assets XCLASS
if (ExtensionManagementUtility::isLoaded('vhs')) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['FluidTYPO3\\Vhs\\Service\\AssetService'] = array(
        'className' => 'RZ\\Razor\\Service\\AssetService',
    );
}

// defValues
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Backend\\Controller\\ContentElement\\NewContentElementController']['className'] = 'RZ\\Razor\\Xclass\\Backend\\Content';

// Inject TypoScript
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tstemplate.php']['includeStaticTypoScriptSourcesAtEnd'][] = 'RZ\\Razor\\Hooks\\TypoScript->main';

$confArr = array();

/* razor */

// Config
$razor = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

// Update LocalConfiguration.php
if (strpos($razor['basedomain_local'], '###LOCAL###') !== false) {
    $razor['basedomain_local'] = str_replace('###LOCAL###', $_SERVER['SERVER_NAME'], $razor['basedomain_local']);

    $confArr['EXT/extConf/razor'] = serialize($razor);
}

/* pagenotfoundhandling */

if (ExtensionManagementUtility::isLoaded('pagenotfoundhandling')) {
    $pagenotfoundhandling = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['pagenotfoundhandling']);

    if ($pagenotfoundhandling['default404Page'] != $razor['default404Page']) {
        $pagenotfoundhandling['defaultLanguageKey'] = 'de';
        $pagenotfoundhandling['default403Header'] = 4;
        $pagenotfoundhandling['languageParam'] = 'L';
        $pagenotfoundhandling['default404Page'] = $razor['default404Page'];
        $pagenotfoundhandling['default403Page'] = 0;
        $pagenotfoundhandling['disableDomainConfig'] = 0;
        $pagenotfoundhandling['passthroughContentTypeHeader'] = 0;
        $pagenotfoundhandling['ignoreLanguage'] = 0;
        $pagenotfoundhandling['forceLanguage'] = 0;

        $confArr['EXT/extConf/pagenotfoundhandling'] = serialize($pagenotfoundhandling);
    }
}

/* me_extsearch */

if (ExtensionManagementUtility::isLoaded('me_extsearch')) {
    $meExtsearch = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['me_extsearch']);

    if ($meExtsearch['overwritePagebrowser'] === 0) {
        $meExtsearch['overwritePagebrowser'] = 1;

        $confArr['EXT/extConf/me_extsearch'] = serialize($meExtsearch);
    }
}

// Write Localconfiguration.php
if ($confArr) {
    GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager')->setLocalConfigurationValuesByPathValuePairs($confArr);
}

// realurl
@include_once PATH_typo3conf . 'RazorRealurlconf.php';

if (TYPO3_MODE === 'BE') {
    $signalSlotDispatcher = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
    $signalSlotDispatcher->connect('TYPO3\\CMS\\Extensionmanager\\Service\\ExtensionManagementService', 'hasInstalledExtensions', 'RZ\\Razor\\Service\\InstallService', 'razorInstaller');
}

$GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUC'] = array(
    'moduleData' => array(
        'xMOD_alt_doc.php' => array(
            'showPalettes' => '1',
        ),
    ),
);

// Check BE user
if (!function_exists('user_check_be_user_razor')) {
    function user_check_be_user_razor($pageType)
    {
        return \RZ\Razor\Utility\CheckBeUser::check($pageType);
    }
}

// Windows Phone
if (!function_exists('winphone')) {
    function winphone()
    {
        return \RZ\Razor\Utility\Devices::winPhone();
    }
}

// Browser
if (!function_exists('rzBrowser')) {
    function rzBrowser($browser)
    {
        return \RZ\Razor\Utility\Devices::rzBrowser($browser);
    }
}

// Version
if (!function_exists('rzVersion')) {
    function rzVersion($version, $operator = '==')
    {
        return \RZ\Razor\Utility\Devices::rzVersion($version, $operator);
    }
}

// System
if (!function_exists('rzSystem')) {
    function rzSystem($system, $operator = '==')
    {
        return \RZ\Razor\Utility\Devices::rzSystem($system, $operator);
    }
}

// Additional basedomains
if (!function_exists('basedomain')) {
    function basedomain($env)
    {
        return \RZ\Razor\Utility\Basedomain::check($env);
    }
}

// File upload hook
if ($razor['tinyPng']) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_extfilefunc.php']['processData'][] = 'RZ\Razor\Hooks\Backend\FileUploadHook';
}

// Page renderer hook
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_pagerenderer.php']['render-preProcess'][] = 'RZ\Razor\Hooks\Frontend\PageRenderer->execute';

// Clear cache
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['razor_clearcache'] = 'RZ\\Razor\\Hooks\\Backend\\ClearCache->clearCachePostProc';

// Hooks
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'RZ\\Razor\\Hooks\\Powermail\\Powermail';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'RZ\\Razor\\Hooks\\Save\\Save';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 'RZ\\Razor\\Hooks\\Frontend\\MainFiles->mainFiles';

// Custom eval function
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['RZ\\Razor\\Hooks\\Backend\\Evaluation\\Lc'] = '';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals']['RZ\\Razor\\Hooks\\Backend\\Evaluation\\FloatPoint'] = '';
