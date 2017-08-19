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
 * Class to merge two arrays
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class MergeViewHelper extends AbstractViewHelper
{

    /**
     * Get filesize
     *
     * @param array $a
     * @param array $b
     * @return array
     */
    public function render($a = array(), $b = array())
    {
        $merge = array_merge($a, $b);

        // Remove empty values from array
        $merge = array_filter($merge);

        return $merge;
    }

}
