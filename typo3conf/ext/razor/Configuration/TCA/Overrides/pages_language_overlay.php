<?php

$tempColumns = array(
    'tx_razor_ogimage' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_ogimage',
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('tx_razor_ogimage', array(
            'maxitems' => 1,
            'appearance' => array(
                'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
            ),
        ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages_language_overlay', $tempColumns);
$GLOBALS['TCA']['pages_language_overlay']['palettes']['media']['showitem'] .= ',--linebreak--,tx_razor_ogimage';