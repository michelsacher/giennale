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

/**
 * Basedomain
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Basedomain
{

    /**
     * Get TYPO3 version
     *
     * @param string $env
     * @return void
     */
    public static function check($env)
    {
        // Get extension configuration
        $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

        // Multiple live domains
        if ($extConf['basedomain_' . $env . '_additional']) {
            $domains = explode(",", $extConf['basedomain_' . $env . '_additional']);

            $check = false;
            foreach ($domains as $domain) {
                $domain = trim($domain);
                $domain = rtrim($domain, '/');
                $domain = str_replace(array('http://', 'https://'), '', $domain);

                if ($_SERVER['HTTP_HOST'] == $domain) {
                    $check = true;
                    break;
                }
            }

            return $check;
        }
    }

}
