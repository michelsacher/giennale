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

/**
 * Flexform xml to array
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FlexformToArrayViewHelper extends AbstractViewHelper
{

    /**
     * Flexform xml to array
     *
     * @param string $flexform
     * @return void
     */
    public function render($flexform)
    {
        $flexform = GeneralUtility::xml2array($flexform);

        return $flexform;
    }

}