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
 * Renders a row
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class RowViewHelper extends AbstractViewHelper
{

    /**
     * This function renders a row
     *
     * @param array $items
     * @param array $iteration
     * @param int $cols
     * @param int $maxCols
     * @param string $classes
     * @return string
     */
    public function render($items, $iteration, $cols, $maxCols = 12, $classes = '')
    {
        // Get count of all items
        $count = count($items);

        // Get cycle (start = 1)
        $cycle = $iteration['cycle'];

        // If row classes
        if ($classes) {
            $classes = ' ' . $classes;
        }

        // Build row
        $row = $cycle % $cols;

        // Open tag
        if ($cycle == 1 || $row == 1) {
            $open = '<div class="row' . $classes . '">';
        }

        // Close tag
        if ($cycle == $count || ($row == 0 && $cols != 1)) {
            $close = '</div>';
        }

        // Max columns
        $maxCols = (int) $maxCols;
        $colSize = floor($maxCols / $cols);

        $this->templateVariableContainer->add('colSize', $colSize);
        $output = $open . $this->renderChildren() . $close;
        $this->templateVariableContainer->remove('colSize');

        return $output;
    }

}