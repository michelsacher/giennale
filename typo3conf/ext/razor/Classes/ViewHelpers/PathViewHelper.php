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
 * Renders a link in an alert
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class PathViewHelper extends AbstractViewHelper
{

    /**
     * Get file extension
     *
     * @param string $file
     * @return string
     */
    public function render($file)
    {
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        return $ext;
    }

}
