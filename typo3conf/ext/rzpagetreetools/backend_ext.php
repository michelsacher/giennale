<?php
if (is_object($TYPO3backend)) {
    $pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();

    $path = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('rzpagetreetools');
    $pageRenderer->addJsFile($path . 'res/js/rzpagetreetools.js');
}