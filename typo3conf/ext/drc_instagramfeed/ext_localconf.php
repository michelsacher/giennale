<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DRCSYSTEMS.' . $_EXTKEY,
	'Drcinstagramfeed',
	array(
		'Instagramfeed' => 'list, show',
		
	),
	// non-cacheable actions
	array(
		'Instagramfeed' => '',
		
	)
);
