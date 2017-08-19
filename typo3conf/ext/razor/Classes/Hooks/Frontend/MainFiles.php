<?php
namespace RZ\Razor\Hooks\Frontend;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class to render main files
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class MainFiles
{

    public function mainFiles()
    {
        // Get TypoScript
        $razor = $this->getTs();

        if ($_SERVER['HTTP_HOST'] == $razor['basedomain.']['local'] && $razor['misc.']['deactivateMainFilesMergeLocal']) {
            if (trim($razor['misc.']['mainCss'])) {
                $mainCss = '<link rel="stylesheet" type="text/css" href="' . $razor['misc.']['mainCss'] . '" media="all">';
            }

            if (trim($razor['misc.']['mainJs'])) {
                $mainJs = '<script src="' . $razor['misc.']['mainJs'] . '" type="text/javascript"></script>';
            }

            $GLOBALS['TSFE']->content = str_replace(array(
                '</head>',
                '</body>',
            ), array(
                $mainCss . '</head>',
                $mainJs . '</body>',
            ), $GLOBALS['TSFE']->content);
        }
    }

    /**
     * Get cols from TypoScript
     *
     * @param int $pageUid
     * @param bool $check
     * @return string
     */
    private function getTs($pageUid = 1)
    {
        $sysPageObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
        $rootLine = $sysPageObj->getRootLine($pageUid);
        $TSObj = GeneralUtility::makeInstance('TYPO3\CMS\Core\TypoScript\ExtendedTemplateService');
        $TSObj->tt_track = 0;
        $TSObj->init();
        $TSObj->runThroughTemplates($rootLine);
        $TSObj->generateConfig();

        $out = $TSObj->setup['razor.'];

        return $out;
    }

}