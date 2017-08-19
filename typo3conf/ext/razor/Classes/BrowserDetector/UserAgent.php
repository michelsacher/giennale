<?php
namespace RZ\Razor\BrowserDetector;

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

class UserAgent
{
    /**
     * @var string
     */
    private $userAgentString;

    /**
     * @param string $userAgentString
     */
    public function __construct($userAgentString = null)
    {
        if (null !== $userAgentString) {
            $this->setUserAgentString($userAgentString);
        }
    }

    /**
     * @param string $userAgentString
     *
     * @return $this
     */
    public function setUserAgentString($userAgentString)
    {
        $this->userAgentString = (string) $userAgentString;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgentString()
    {
        if (null === $this->userAgentString) {
            $this->createUserAgentString();
        }

        return $this->userAgentString;
    }

    /**
     * @return string
     */
    public function createUserAgentString()
    {
        $userAgentString = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null;
        $this->setUserAgentString($userAgentString);

        return $userAgentString;
    }
}
