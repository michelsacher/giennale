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

use RZ\Razor\BrowserDetector\Browser;
use RZ\Razor\BrowserDetector\Os;

/**
 * Devices
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Devices
{

    /**
     * Get Windows Phone
     *
     * @return void
     */
    public static function winPhone()
    {
        $detect = new MobileDetect;

        $mobile = $detect->isMobile();
        $winMobile = $detect->isWindowsMobileOS();
        $winPhone = $detect->isWindowsPhoneOS();

        if ($mobile && ($winMobile || $winPhone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get browser
     *
     * @param string $browser
     * @return void
     */
    public static function rzBrowser($browser)
    {
        $b = new Browser();

        if ($b->getName() == $browser) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get version
     *
     * @param string $version
     * @param string $operator
     * @return void
     */
    public static function rzVersion($version, $operator)
    {
        $b = new Browser();

        $getVersion = (int) $b->getVersion();
        $operators = array("<", "<=", ">", ">=", "==", "!=");

        // Check if operator is allowed
        if (in_array($operator, $operators)) {
            eval('$check = ' . $getVersion . $operator . $version . ';');

            if ($check) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Get system
     *
     * @param string $version
     * @param string $operator
     * @return void
     */
    public static function rzSystem($system, $operator)
    {
        $os = new Os();

        $getOs = $os->getName();
        $operators = array("==", "!=");

        // Check if operator is allowed
        if (in_array($operator, $operators)) {
            eval('$check = $getOs ' . $operator . ' $system;');

            if ($check) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
