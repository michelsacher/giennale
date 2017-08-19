<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'DRCSYSTEMS.' . $_EXTKEY,
	'Drcinstagramfeed',
	'DRC Instagram Feed'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	/*\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'DRCSYSTEMS.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'drcinstagramfeed',	// Submodule key
		'',						// Position
		array(
			'Instagramfeed' => 'list, show',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_drcinstagramfeed.xlf',
		)
	);*/

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'DRC Instagram Feed');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_drcinstagramfeed_domain_model_instagramfeed', 'EXT:drc_instagramfeed/Resources/Private/Language/locallang_csh_tx_drcinstagramfeed_domain_model_instagramfeed.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_drcinstagramfeed_domain_model_instagramfeed');


//Flexform Configuration
$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Drcinstagramfeed');
$pluginSignature = $extensionName.'_'.$pluginName; 
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages'; 
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/flexformsetup.xml'); 




