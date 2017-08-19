<?php
namespace RZ\Razor\Service;

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

class AssetService extends \FluidTYPO3\Vhs\Service\AssetService
{

    /**
     * @param string $file
     * @param string $contents
     */
    protected function writeFile($file, $contents)
    {
        // Get file type
        $type = pathinfo($file, PATHINFO_EXTENSION);
        $type = strtoupper($type);

        if (($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_vhs.']['assets.']['compressCss'] == 1 && $type == 'CSS')
            || ($GLOBALS['TSFE']->tmpl->setup['plugin.']['tx_vhs.']['assets.']['compressJs'] == 1 && $type == 'JS')) {

            $minifierClassName = '\\MatthiasMullie\\Minify\\' . $type;

            if (!class_exists('\MatthiasMullie\Minify\Minify')) {
                require_once(__DIR__ . '/../../vendor/autoload.php');
            }

            $minifier = new $minifierClassName();
            $minifier->add($contents);

            $contents = $minifier->minify();
        }

        file_put_contents($file, $contents);
    }
}
