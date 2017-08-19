<?php
namespace RZ\Razor\Utility;

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

use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * A custom debug class
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Debug
{

    /**
     * Debug
     *
     * @param string $var
     * @return void
     */
    public static function debug($var)
    {
        DebugUtility::debug($var);
    }

    /**
     * Debug in popup
     *
     * @param string $var
     * @return void
     */
    public static function debugPopup($var)
    {
        DebugUtility::debugInPopUpWindow($var);
    }

    /**
     * Debug in pre
     *
     * @param string $var
     * @return void
     */
    public static function debugPre($var)
    {
        print_r('<pre>') . print_r($var) . print_r('</pre>');
    }

    /**
     * Debug in file
     *
     * @param string $var
     * @return void
     */
    public static function debugFile($var, $filename = 'razor_debug.txt', $append = 1)
    {
        ob_start();
        var_dump($var);

        if ($append = 1) {
            file_put_contents(PATH_site . $filename, ob_get_clean(), FILE_APPEND);
        } else {
            file_put_contents(PATH_site . $filename, ob_get_clean());
        }
    }

    /**
     * Debug fluid
     *
     * @param array $var
     * @return void
     */
    public static function debugFluid($var)
    {
        DebuggerUtility::var_dump($var);
    }

    /**
     * Debug query
     *
     * @param array $query
     * @return void
     */
    public static function debugQuery($query)
    {
        /** @var Typo3DbQueryParser $queryParser */
        $queryParser = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Storage\\Typo3DbQueryParser');

        DebuggerUtility::var_dump($queryParser->parseQuery($query));
    }

}