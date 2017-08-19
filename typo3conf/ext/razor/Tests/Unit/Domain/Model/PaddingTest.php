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
 * Test case for class \RZ\Razor\Domain\Model\Padding.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class PaddingTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

    /**
     * @var \RZ\Razor\Domain\Model\Padding
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new \RZ\Razor\Domain\Model\Padding();
    }

    protected function tearDown()
    {
        unset($this->subject);
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString()
    {
        $this->assertSame('', $this->subject->getTitle());
    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle()
    {
        $this->subject->setTitle('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'title', $this->subject);
    }

    /**
     * @test
     */
    public function getTopReturnsInitialValueForString()
    {
        $this->assertSame('', $this->subject->getTop());
    }

    /**
     * @test
     */
    public function setTopForStringSetsTop()
    {
        $this->subject->setTop('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'top', $this->subject);
    }

    /**
     * @test
     */
    public function getBottomReturnsInitialValueForString()
    {
        $this->assertSame('', $this->subject->getBottom());
    }

    /**
     * @test
     */
    public function setBottomForStringSetsBottom()
    {
        $this->subject->setBottom('Conceived at T3CON10');

        $this->assertAttributeEquals('Conceived at T3CON10', 'bottom', $this->subject);
    }

}
