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
 * Display translated date in Fluid
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class DateViewHelper extends AbstractViewHelper
{

    /**
     * This function renders a value with TypoScript
     *
     * @param string $date The date
     * @param string $format The format
     * @return string
     */
    public function render($date, $format)
    {
        $conf = array(
            'value' => $date,
            'strftime' => $format,
        );

        return $GLOBALS['TSFE']->cObj->cObjGetSingle('TEXT', $conf);
    }

}
