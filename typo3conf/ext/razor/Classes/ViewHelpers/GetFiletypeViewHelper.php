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
 * Class to get the file type of a file
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class GetFiletypeViewHelper extends AbstractViewHelper
{

    /**
     * Get filetype
     *
     * @param string $path
     * @param string $file
     * @param string $extension
     * @param string $default
     * @return string
     */
    public function render($path, $file, $extension = 'svg', $default = 'default')
    {
        $parts = pathinfo($file);
        $iconExtension = '.' . $extension;

        if (is_file($path . $parts['extension'] . $iconExtension)) {
            $icon = $parts['extension'] . $iconExtension;
        } else {
            $icon = $default . $iconExtension;
        }

        return $icon;
    }

}
