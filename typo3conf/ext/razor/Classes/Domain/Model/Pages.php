<?php
namespace RZ\Razor\Domain\Model;

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
 * Pages model
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Pages extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * txRazorMenulink
     *
     * @var boolean
     */
    protected $txRazorMenulink = false;

    /**
     * txRazorOgimage
     *
     * @var string
     */
    protected $txRazorOgimage = '';

    /**
     * Returns the tx_razor_menulink
     *
     * @return string
     */
    public function getTxRazorMenulink()
    {
        return $this->txRazorMenulink;
    }

    /**
     * Sets the tx_razor_menulink
     *
     * @param boolean $txRazorMenulink
     * @return void
     */
    public function setTxRazorMenulink($txRazorMenulink)
    {
        $this->txRazorMenulink = $txRazorMenulink;
    }

    /**
     * Returns the txRazorOgimage
     *
     * @return string $txRazorOgimage
     */
    public function getTxRazorOgimage()
    {
        return $this->txRazorOgimage;
    }

    /**
     * Sets the txRazorOgimage
     *
     * @param string $txRazorOgimage
     * @return void
     */
    public function setTxRazorOgimage($txRazorOgimage)
    {
        $this->txRazorOgimage = $txRazorOgimage;
    }

}