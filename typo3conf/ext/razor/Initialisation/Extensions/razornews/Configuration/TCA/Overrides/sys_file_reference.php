<?php
defined('TYPO3_MODE') or die();

/**
 * Add extra field hideindetail and some special news controls to sys_file_reference record
 */
$newSysFileReferenceColumns = array(
    'hideindetail' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_news_domain_model_media.hideindetail',
        'config' => array(
            'type' => 'check',
            'default' => 0,
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference', $newSysFileReferenceColumns);

// add special news palette
$GLOBALS['TCA']['sys_file_reference']['palettes']['newsPalette'] = array(
    'showitem' => 'showinpreview, hideindetail',
    'canNotCollapse' => true,
);
