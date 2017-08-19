<?php
namespace RZ\Razor\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class to get the current language
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class GetCurrentLangViewHelper extends AbstractViewHelper
{

    /**
     * Render function
     *
     * @param string $defaultLang
     * @param string $defaultLangIso
     * @return array
     */
    public function render($defaultLang = 'English', $defaultLangIso = 'gb')
    {
        // Get current lang
        $lang = $GLOBALS['TSFE']->sys_language_uid;

        // Get lang info
        $langInfo = array();
        $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('title,flag', 'sys_language', 'uid=' . $lang, '', '', '');

        if ($row) {
            $langInfo['title'] = $row['title'];
            $langInfo['iso'] = strtolower($row['flag']);
        } else {
            $langInfo['title'] = $defaultLang;
            $langInfo['iso'] = strtolower($defaultLangIso);
        }

        $langInfo['uid'] = $lang;

        return $langInfo;
    }

}
