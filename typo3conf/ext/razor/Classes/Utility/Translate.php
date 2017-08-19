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

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * A custom translate class
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Translate
{

    /**
     * Translate
     *
     * @param string $key
     * @param array $vars
     * @return void
     */
    public static function translate($key, $vars = array(), $extName = 'razor')
    {
        if (empty($vars)) {
            return LocalizationUtility::translate($key, $extName);
        } else {
            return vsprintf(LocalizationUtility::translate($key, $extName), (array) $vars);
        }
    }

}
