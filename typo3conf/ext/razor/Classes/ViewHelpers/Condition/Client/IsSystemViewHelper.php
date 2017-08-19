<?php
namespace RZ\Razor\ViewHelpers\Condition\Client;

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
 *
 * ### Condition: Client's System
 *
 * A condition ViewHelper which renders the `then` child if client's
 * operating system matches the `system` argument.
 *
 * ### Example
 *
 *     <razor:condition.system system="mac">
 *         Thank you for using Mac!
 *     </razor:condition.system>
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 * @package Razor
 * @subpackage ViewHelpers\Condition\Client
 */
class IsSystemViewHelper extends AbstractClientInformationViewHelper
{

    /**
     * Render method
     *
     * @param string $system
     * @return string
     */
    public function render($system)
    {
        foreach ($this->getSystems() as $sys) {
            if ($sys === $system) {
                return $this->renderThenChild();
            }
        }

        return $this->renderElseChild();
    }

}
