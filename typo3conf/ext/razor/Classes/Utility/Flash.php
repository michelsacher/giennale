<?php
namespace RZ\Razor\Utility;

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

use TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A custom flashmessage class
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Flash
{

    /**
     * Flash message
     *
     * @param string $text
     * @param string $title
     * @param \TYPO3\CMS\Core\Messaging\AbstractMessage $severity
     * @param boolean $storeInSession
     * @return void
     */
    public function flash($text, $title, $severity, $storeInSession = true)
    {
        $message = GeneralUtility::makeInstance(
            'RZ\\Razor\\Messaging\\FlashMessage',
            $text,
            $title,
            $severity,
            $storeInSession
        );

        FlashMessageQueue::addMessage($message);

        return;
    }

}
