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
 * ### Condition: Client's Browser
 *
 * Condition ViewHelper which renders the `then` child if client's
 * browser matches the `browser` argument
 *
 * ### Examples
 *
 *     <!-- simple usage, content becomes then-child -->
 *     <razor:if.client.isBrowser browser="chrome">
 *         Thank you for using Google Chrome!
 *     </razor:if.client.isBrowser>
 *     <!-- display a nice warning if not using Chrome -->
 *     <razor:if.client.isBrowser browser="chrome">
 *         <f:else>
 *             <div class="alert alert-info">
 *                 <h2 class="alert-header">Please download Google Chrome</h2>
 *                 <p>
 *                     The particular system you are accessing uses features which
 *                     only work in Google Chrome. For the best experience, download
 *                     Chrome here:
 *                     <a href="http://chrome.google.com/">http://chrome.google.com/</a>
 *                 </p>
 *         </f:else>
 *     </razor:if.client.isBrowser>
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 * @package Razor
 * @subpackage ViewHelpers\Condition\Client
 */
class IsBrowserViewHelper extends AbstractClientInformationViewHelper
{

    /**
     * Render method
     *
     * @param string $browser
     * @param string $version
     * @return string
     */
    public function render($browser, $version)
    {
        if (array_key_exists($browser, $this->getBrowsers()) && $this->getVersion($browser) == $version) {
            $content = $this->renderThenChild();
        } else {
            $content = $this->renderElseChild();
        }

        return $content;
    }

}
