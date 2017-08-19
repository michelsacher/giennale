<?php
namespace RZ\Razor\Hooks\Backend\Evaluation;

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
 * Custom eval function to convert comma to dot
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FloatPoint
{

    /**
     * JS
     *
     * @return string
     */
    public function returnFieldJS()
    {
        return "
			function str_replace(string, search, replace) {
				return string.split(search).join(replace);
			}

	  return str_replace(value, ',', '.');
  ";
    }

    /**
     * PHP
     *
     * @param string $value
     * @param array $is_in
     * @param $array $set
     * @return void
     */
    public function evaluateFieldValue($value, $is_in, &$set)
    {
        return str_replace(",", ".", $value);
    }

}