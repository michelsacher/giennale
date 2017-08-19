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
 * Field model
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Field extends \In2code\Powermail\Domain\Model\Field
{

    /**
     * maxlength
     *
     * @var string
     */
    protected $txRazorPowermailMaxlength;

    /**
     * readonly
     *
     * @var string
     */
    protected $txRazorPowermailReadonly;

    /**
     * Sets the readonly
     *
     * @param string $txRazorPowermailReadonly
     * @return void
     */
    public function setTxRazorPowermailReadonly($txRazorPowermailReadonly)
    {
        $this->txRazorPowermailReadonly = $txRazorPowermailReadonly;
    }

    /**
     * Gets the readonly
     *
     * @return string
     */
    public function getTxRazorPowermailReadonly()
    {
        return $this->txRazorPowermailReadonly;
    }

    /**
     * Sets the maxlength
     *
     * @param string $txRazorMaxlength
     * @return void
     */
    public function setTxRazorPowermailMaxlength($txRazorPowermailMaxlength)
    {
        $this->txRazorPowermailMaxlength = $txRazorPowermailMaxlength;
    }

    /**
     * Gets the maxlength
     *
     * @return string
     */
    public function getTxRazorPowermailMaxlength()
    {
        return $this->txRazorPowermailMaxlength;
    }

}