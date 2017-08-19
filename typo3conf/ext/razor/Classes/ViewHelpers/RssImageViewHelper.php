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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class RssImageViewHelper extends AbstractViewHelper
{

    /**
     * Get file from rss feed
     *
     * @param string $image The image
     * @return string
     */
    public function render($image)
    {
        // Create temp dir
        $directory = 'typo3temp/rssimages/';

        if (!is_dir($directory)) {
            GeneralUtility::mkdir($directory);
        }

        // Get image
        return $this->getImage($image, $directory);
    }

    protected function getImage($image, $targetDir)
    {
        if ($image) {
            // Check if image exists
            $path = pathinfo($image);

            if (file_exists($targetDir . $path['basename'])) {
                return $targetDir . $path['basename'];
            }

            // Download image
            $imageContents = GeneralUtility::getURL($image);
            GeneralUtility::writeFile($targetDir . $path['basename'], $imageContents);

            $finalImage = $targetDir . $path['basename'];

            return $finalImage;
        }
    }

}
