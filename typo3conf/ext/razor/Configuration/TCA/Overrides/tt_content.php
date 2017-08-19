<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Config
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

$gridBackground = explode(',', $confArr['gridBackground']);
$gridFilter = array();
foreach ($gridBackground as $grid) {
    $gridFilter['OR'][] = 'FIELD:tx_gridelements_backend_layout:=:' . $grid;
}

$tempColumns = array(
    'tx_razor_visibility' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_visibility',
        'config' => array(
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'items' => array(
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:hiddenXS',
                    'hidden-xs',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:hiddenS',
                    'hidden-sm',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:hiddenN',
                    'hidden-md',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:hiddenL',
                    'hidden-lg',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:visibleXS',
                    'visible-xs-block',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:visibleS',
                    'visible-sm-block',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:visibleN',
                    'visible-md-block',
                ),
                array(
                    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:visibleL',
                    'visible-lg-block',
                ),
            ),
            'size' => 8,
            'maxitems' => 3,
        ),
    ),

    'tx_razor_wow' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_wow',
        'config' => array(
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => array(
                array(
                    '',
                    '',
                ),
            ),
            'foreign_table' => 'tx_razor_domain_model_effects',
            'foreign_table_where' => 'AND tx_razor_domain_model_effects.hidden=0 AND tx_razor_domain_model_effects.deleted=0 ORDER BY tx_razor_domain_model_effects.sorting',
            'size' => 1,
            'minitems' => 0,
            'maxitems' => 1,
        ),
    ),

    'tx_razor_classes' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_classes',
        'config' => array(
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
        ),
    ),

    'tx_razor_tablestyles' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_tablestyles',
        'config' => array(
            'type' => 'select',
            'renderType' => 'selectSingle',
            'foreign_table' => 'tx_razor_domain_model_tablestyles',
            'foreign_table_where' => 'AND tx_razor_domain_model_tablestyles.hidden=0 AND tx_razor_domain_model_tablestyles.deleted=0 ORDER BY tx_razor_domain_model_tablestyles.sorting',
            'size' => 1,
        ),
    ),

    'tx_razor_gridbackground' => array(
        'displayCond' => array(
            $gridFilter,
        ),
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:tx_razor_gridbackground',
        'config' => ExtensionManagementUtility::getFileFieldTCAConfig('tx_razor_gridbackground', array(
            'maxitems' => 1,
            'appearance' => array(
                'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
            ),
        ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
    ),

    'header_style' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_style',
        'config' => array(
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => array(
                array(
                    '',
                    '',
                ),
            ),
            'foreign_table' => 'tx_razor_domain_model_headerstyles',
            'foreign_table_where' => 'AND tx_razor_domain_model_headerstyles.hidden=0 AND tx_razor_domain_model_headerstyles.deleted=0 ORDER BY tx_razor_domain_model_headerstyles.sorting',
            'size' => 1,
            'minitems' => 0,
            'maxitems' => 1,
        ),
    ),

    'header_position' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_position',
        'config' => array(
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => array(
                array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_position.default', ''),
                array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_position.center', 'center'),
                array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_position.right', 'right'),
                array('LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:header_position.left', 'left'),
            ),
        ),
    ),
);

ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);

// New fields for DCEs
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'access',
    '--linebreak--,tx_razor_visibility,--linebreak--,tx_razor_wow,--linebreak--,tx_razor_classes',
    'after:hidden'
);

// Table styles
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'tableconfiguration',
    'tx_razor_tablestyles',
    'after:table_enclosure'
);

// Header layout
ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'header',
    'header_style,header_position',
    'after:header_layout'
);

ExtensionManagementUtility::addFieldsToPalette(
    'tt_content',
    'headers',
    'header_style,header_position',
    'after:header_layout'
);


if (ExtensionManagementUtility::isLoaded('gridelements')) {
    $GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['showitem'] = str_replace('pi_flexform', 'tx_razor_gridbackground,pi_flexform', $GLOBALS['TCA']['tt_content']['types']['gridelements_pi1']['showitem']);

    // Gridelements remove "add new content" button
    $GLOBALS['TCA']['tt_content']['columns']['tx_gridelements_children']['config']['appearance']['levelLinksPosition'] = 'none';
}

// Headline is required
if ($confArr['headline_required']) {
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['eval'] = 'required';
}

// Multiline headlines
if ($confArr['headline_multi']) {
    $GLOBALS['TCA']['tt_content']['columns']['header']['config']['type'] = 'text';
}

// Disable [Translate to:]
$GLOBALS['TCA']['tt_content']['columns']['header']['l10n_mode'] = '';
$GLOBALS['TCA']['tt_content']['columns']['bodytext']['l10n_mode'] = '';

/* Override labels and icons BEGIN */

$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'],
    [
        '1' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/header.svg',
        ),
        '2' => array(
            '0' => 'LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:textmedia',
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/text.svg',
        ),
        '5' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/table.svg',
        ),
        '8' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/menu.svg',
        ),
        '9' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/shortcut.svg',
        ),
        '10' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/plugin.svg',
        ),
        '12' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/html.svg',
        ),
        '15' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/login.svg',
        ),
    ]
);

$GLOBALS['TCA']['tt_content']['columns']['list_type']['config']['items'] = array_replace_recursive(
    $GLOBALS['TCA']['tt_content']['columns']['list_type']['config']['items'],
    [
        '3' => array(
            '2' => 'EXT:razor/Resources/Public/Images/Icons/Content/news.svg',
        ),
    ]
);

/* Override labels and icons END */
