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

class AcceptLanguage
{
    /**
     * @var string
     */
    private $acceptLanguageString;

    /**
     * @param string $acceptLanguageString
     */
    public function __construct($acceptLanguageString = null)
    {
        if (null !== $acceptLanguageString) {
            $this->setAcceptLanguageString($acceptLanguageString);
        }
    }

    /**
     * @param string $acceptLanguageString
     *
     * @return $this
     */
    public function setAcceptLanguageString($acceptLanguageString)
    {
        $this->acceptLanguageString = $acceptLanguageString;

        return $this;
    }

    /**
     * @return string
     */
    public function getAcceptLanguageString()
    {
        if (null === $this->acceptLanguageString) {
            $this->createAcceptLanguageString();
        }

        return $this->acceptLanguageString;
    }

    /**
     * @return string
     */
    public function createAcceptLanguageString()
    {
        $acceptLanguageString = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : null;
        $this->setAcceptLanguageString($acceptLanguageString);

        return $acceptLanguageString;
    }
}
