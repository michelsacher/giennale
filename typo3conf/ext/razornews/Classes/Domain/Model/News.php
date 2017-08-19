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
 * News
 */
class News extends \GeorgRinger\News\Domain\Model\News {

    /**
     * News Content
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RZ\Razornews\Domain\Model\NewsContent>
     * @cascade remove
     */
    protected $newscontent = null;

    /**
     * ogimage
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $ogimage;

    /**
     * city
     *
     * @var string
     */
    protected $city;

    /**
     * datetimeend
     *
     * @var \DateTime
     */
    protected $datetimeend;

    /**
     * Adds a NewsContent
     *
     * @param \RZ\Razornews\Domain\Model\NewsContent $newscontent
     * @return void
     */
    public function addNewscontent(\RZ\Razornews\Domain\Model\NewsContent $newscontent)
    {
        $this->newscontent->attach($newscontent);
    }

    /**
     * Removes a NewsContent
     *
     * @param \RZ\Razornews\Domain\Model\NewsContent $newscontentToRemove The NewsContent to be removed
     * @return void
     */
    public function removeNewscontent(\RZ\Razornews\Domain\Model\NewsContent $newscontentToRemove)
    {
        $this->newscontent->detach($newscontentToRemove);
    }

    /**
     * Returns the newscontent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RZ\Razornews\Domain\Model\NewsContent> $newscontent
     */
    public function getNewscontent()
    {
        return $this->newscontent;
    }

    /**
     * Sets the newscontent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\RZ\Razornews\Domain\Model\NewsContent> $newscontent
     * @return void
     */
    public function setNewscontent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $newscontent)
    {
        $this->newscontent = $newscontent;
    }

    /**
     * Returns the ogimage
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $ogimage
     */
    public function getOgimage()
    {
        return $this->ogimage;
    }

    /**
     * Sets the ogimage
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $ogimage
     * @return void
     */
    public function setOgimage($ogimage)
    {
        $this->ogimage = $ogimage;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get datetimeend
     *
     * @return \DateTime
     */
    public function getDatetimeend()
    {
        return $this->datetimeend;
    }

    /**
     * Set timeend
     *
     * @param \DateTime $datetimeend
     */
    public function setDatetimeend($datetimeend)
    {
        $this->datetimeend = $datetimeend;
    }

}
