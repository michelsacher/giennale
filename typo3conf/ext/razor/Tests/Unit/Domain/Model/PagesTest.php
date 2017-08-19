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
 * Test case for class \RZ\Razor\Domain\Model\Pages.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class PagesTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var \RZ\Razor\Domain\Model\Pages
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \RZ\Razor\Domain\Model\Pages();
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getTxRazorMenulinkReturnsInitialValueForBoolean()
    {
        $this->assertSame(false, $this->subject->getTxRazorMenulink());
    }

    /**
     * @test
     */
    public function setTxRazorMenulinkForBooleanSetsTxRazorMenulink()
    {
        $this->subject->setTxRazorMenulink(true);

        $this->assertAttributeEquals(true, 'txRazorMenulink', $this->subject);
    }

    /**
     * @test
     */
    public function getTxRazorOgimageReturnsInitialValueForString()
    {
        $this->assertSame('', $this->subject->getTxRazorOgimage());
    }

    /**
     * @test
     */
    public function setTxRazorOgimageForStringSetsTxRazorOgimage()
    {
        $this->subject->setTxRazorOgimage('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'txRazorOgimage', $this->subject);
    }

}
