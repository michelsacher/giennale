<?php
namespace RZ\Razor\Tests\Unit\Domain\Model;

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
 * Test case for class \RZ\Razor\Domain\Model\Field.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FieldTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var \RZ\Razor\Domain\Model\Field
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \RZ\Razor\Domain\Model\Field();
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getTxRazorPowermailMaxlengthReturnsInitialValueForString()
    {
        $this->assertSame(null, $this->subject->getTxRazorPowermailMaxlength());
    }

    /**
     * @test
     */
    public function setTxRazorPowermailMaxlengthForStringSetsTxRazorPowermailMaxlength()
    {
        $this->subject->setTxRazorPowermailMaxlength('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'txRazorPowermailMaxlength', $this->subject);
    }

    /**
     * @test
     */
    public function getTxRazorPowermailReadonlyReturnsInitialValueForString()
    {
        $this->assertSame(null, $this->subject->getTxRazorPowermailReadonly());
    }

    /**
     * @test
     */
    public function setTxRazorPowermailReadonlyForStringSetsTxRazorPowermailReadonly()
    {
        $this->subject->setTxRazorPowermailReadonly('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'txRazorPowermailReadonly', $this->subject);
    }

}
