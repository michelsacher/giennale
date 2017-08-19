<?php
namespace RZ\Razor\Messaging;

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
 * A custom flashmessage class
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FlashMessage extends \TYPO3\CMS\Core\Messaging\FlashMessage
{

    /**
     * @var string The message severity class names
     */
    public $classes = array(
        self::NOTICE => 'notice alert alert-info alert-dismissable',
        self::INFO => 'info alert alert-info alert-dismissable',
        self::OK => 'ok alert alert-success alert-dismissable',
        self::WARNING => 'warning alert alert-warning alert-dismissable',
        self::ERROR => 'error alert alert-danger alert-dismissable',
    );

}