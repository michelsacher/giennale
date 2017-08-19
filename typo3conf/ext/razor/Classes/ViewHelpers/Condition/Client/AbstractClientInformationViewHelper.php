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

use TYPO3\CMS\Core\Utility\ClientUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/**
 * Abstract ViewHelper around \TYPO3\CMS\Core\Utility\ClientUtility::getBrowserInfo().
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 * @package Razor
 * @subpackage ViewHelpers\Condition\Client
 */
abstract class AbstractClientInformationViewHelper extends AbstractConditionViewHelper
{

    /**
     * @var string
     */
    protected $userAgent = '';

    /**
     * Set the user-agent
     *
     * @param string $userAgent
     * @return \AbstractClientInformationViewHelper
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * Return the user-agent
     *
     * @return string
     */
    public function getUserAgent()
    {
        if ($this->userAgent !== '') {
            $userAgent = $this->userAgent;
        } else {
            $userAgent = GeneralUtility::getIndpEnv('HTTP_USER_AGENT');
        }

        return $userAgent;
    }

    /**
     * Return all browsers
     *
     * @return array
     */
    public function getBrowsers()
    {
        $clientInfo = ClientUtility::getBrowserInfo($this->getUserAgent());

        return $clientInfo['all'];
    }

    /**
     * Return browser version
     *
     * @return array
     */
    public function getVersion($browser)
    {
        $clientInfo = ClientUtility::getBrowserInfo($this->getUserAgent());

        $version = $clientInfo['all'][$browser];

        return $version;
    }

    /**
     * Return all systems
     *
     * @return array
     */
    public function getSystems()
    {
        $clientInfo = ClientUtility::getBrowserInfo($this->getUserAgent());

        return $clientInfo['all_systems'];
    }

}
