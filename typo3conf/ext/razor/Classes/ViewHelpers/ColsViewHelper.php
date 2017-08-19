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
 * Calculate cols
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ColsViewHelper extends AbstractViewHelper
{

    /**
     * This function calculates cols
     *
     * @param int $cols The cols
     * @param int $divider The divider
     * @param int $subtrahend The subtrahend
     * @param int $offset The offset
     * @return int
     */
    public function render($cols, $divider = 0, $subtrahend = 0, $offset = 0)
    {
        if ($divider) {
            $result = floor($cols / $divider);
        } elseif ($subtrahend) {
            $result = $cols - $subtrahend;
        }

        if ($offset) {
            $result = $result - $offset;
        }

        return $result;
    }

}
