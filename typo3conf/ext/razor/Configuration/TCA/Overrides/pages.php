<?php

$tempColumns = array(
    'tx_razor_menulink' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_menulink',
        'config' => array(
            'items' => array(
                '1' => array(
                    '0' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_menulink.doNotLink',
                ),
            ),
            'type' => 'check',
        ),
    ),
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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $tempColumns);
$GLOBALS['TCA']['pages']['palettes']['visibility']['showitem'] .= ',tx_razor_menulink';
$GLOBALS['TCA']['pages']['palettes']['media']['showitem'] .= ',--linebreak--,tx_razor_ogimage';

// Add field to rootline
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',tx_razor_menulink,tx_razor_ogimage';

// Add the icon for the new doktype
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['115'] = 'razor-newspage';
$GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['115-hideinmenu'] = 'razor-newspage-hideinmenu';

// Change target to selectbox
$GLOBALS['TCA']['pages']['columns']['target']['config'] = array(
    'type' => 'select',
    'size' => 1,
    'maxitems' => 1,
    'items' => array(
        array('', ''),
        array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:target.1', '_top'),
        array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:target.2', '_blank'),
    ),
);

$GLOBALS['TCA']['pages_language_overlay']['columns']['media']['config']['appearance']['showPossibleLocalizationRecords'] = true;
$GLOBALS['TCA']['pages_language_overlay']['columns']['media']['config']['appearance']['showAllLocalizationLink'] = true;