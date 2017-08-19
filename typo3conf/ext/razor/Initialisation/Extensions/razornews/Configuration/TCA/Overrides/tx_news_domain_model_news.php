<?php
defined('TYPO3_MODE') or die();

$fields = array(
    'newscontent' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.newscontent',
        'config' => array(
            'type' => 'inline',
            'foreign_table' => 'tx_razornews_domain_model_newscontent',
            'foreign_field' => 'news',
            'maxitems' => 9999,
            'appearance' => array(
                'levelLinksPosition' => 'top',
                'showSynchronizationLink' => 1,
                'showPossibleLocalizationRecords' => 1,
                'useSortable' => 1,
                'showAllLocalizationLink' => 1,
            ),
        ),
    ),
    'ogimage' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.ogimage',
        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('ogimage', array(
            'maxitems' => 1,
            'appearance' => array(
                'createNewRelationLinkTitle' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.ogimage_add',
            ),
        ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
    ),
    'city' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.city',
        'config' => array(
            'type' => 'input',
            'size' => 30,
            'eval' => 'trim',
        ),
    ),
    'datetimeend' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.datetimeend',
        'config' => array(
            'type' => 'input',
            'size' => 12,
            'max' => 20,
            'eval' => 'datetime',
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', '--div--;LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_news.newscontent, newscontent', '', 'after:bodytext');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'ogimage', '', 'after:fal_media');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_news_domain_model_news', 'datetimeend, city', '', 'after:datetime');
