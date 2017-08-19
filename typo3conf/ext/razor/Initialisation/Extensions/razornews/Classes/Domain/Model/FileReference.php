<?php
namespace RZ\Razornews\Domain\Model;

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
 * File Reference
 *
 * @package TYPO3
 * @subpackage tx_razornews
 */
class FileReference extends \GeorgRinger\News\Domain\Model\FileReference
{

    /**
     * @var boolean
     */
    protected $hideindetail;

    /**
     * Set hideindetail
     *
     * @param boolean $hideindetail
     * @return void
     */
    public function setHideindetail($hideindetail)
    {
        $this->hideindetail = $hideindetail;
    }

    /**
     * Get hideindetail
     *
     * @return boolean
     */
    public function getHideindetail()
    {
        return $this->hideindetail;
    }

}
