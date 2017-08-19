<?php

$tempColumns = array(
    'tx_razor_powermail_maxlength' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:maxlength',
        'config' => array(
            'type' => 'input',
            'size' => '5',
        ),
    ),
    'tx_razor_powermail_readonly' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:readonly',
        'config' => array(
            'type' => 'check',
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_powermail_domain_model_field', $tempColumns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tx_powermail_domain_model_field', '--div--;LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:additionalOptions, tx_razor_powermail_maxlength, tx_razor_powermail_readonly', 'input,textarea', 'after:own_marker_select');

// Add some layouts to fields
$GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['css']['config']['items']['4'] = array(
    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:zip',
    'zip',
);

$GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['css']['config']['items']['5'] = array(
    'LLL:EXT:razor/Resources/Private/Language/locallang_db.xlf:city',
    'city',
);