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
 * Helper for Bootstrap cols
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ColImpExpViewHelper extends AbstractViewHelper
{

    /**
     * Render function
     *
     * @param string $content
     * @param bool $row
     * @return mixed
     */
    public function render($content, $row = 0)
    {
        if ($content) {
            // Check if content is array, if not, build array
            if (!is_array($content)) {
                $content = explode(",", $content);
            }

            $final = '';
            $content = array_filter($content);

            foreach ($content as $key => $c) {
                // Reset offset
                if ($c == 'noOffset') {
                    $c = 0;
                }

                if ($key == 'visibility') {
                    $final .= trim(str_replace(',', ' ', $c));
                } else {
                    $final .= 'col-' . $key . '-' . $c . ' ';
                }
            }

            if ($row == 1 && $final) {
                $final = ' ' . $final;
            }

            if ($row == 0) {
                $final = rtrim($final);
            }

            return $final;
        } else {
            return false;
        }
    }

}
