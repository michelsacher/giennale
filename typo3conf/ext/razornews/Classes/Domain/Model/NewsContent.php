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
 * NewsContent
 */
class NewsContent extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Video ID
     *
     * @var string
     */
    protected $videoId = '';

    /**
     * Video file
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @cascade remove
     */
    protected $videoFile = '';

    /**
     * Type
     *
     * @var string
     */
    protected $type = '';

    /**
     * Video type
     *
     * @var integer
     */
    protected $videoType = null;

    /**
     * Ratio
     *
     * @var integer
     */
    protected $ratio = null;

    /**
     * Text
     *
     * @var string
     */
    protected $text = '';

    /**
     * Sorting
     *
     * @var integer
     */
    protected $sorting = null;

    /**
     * Image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;

    /**
     * Poster
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $poster = null;

    /**
     * MP3
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $mp3 = null;

    /**
     * Ogg
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $ogg = null;

    /**
     * Width
     *
     * @var string
     */
    protected $width = '';

    /**
     * Height
     *
     * @var string
     */
    protected $height = '';

    /**
     * Crop
     *
     * @var integer
     */
    protected $crop = null;

    /**
     * Click enlarge
     *
     * @var integer
     */
    protected $clickEnlarge = null;

    /**
     * Gallery
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     * @cascade remove
     */
    protected $gallery = null;

    /**
     * Content
     *
     * @var integer
     */
    protected $content;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->gallery = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the videoId
     *
     * @return string $videoId
     */
    public function getVideoId()
    {
        return $this->videoId;
    }

    /**
     * Sets the videoId
     *
     * @param string $videoId
     * @return void
     */
    public function setVideoId($videoId)
    {
        $this->videoId = $videoId;
    }

    /**
     * Adds a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $videoFile
     * @return void
     */
    public function addVideoFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $videoFile)
    {
        $this->videoFile->attach($videoFile);
    }

    /**
     * Removes a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $videoFileToRemove The FileReference to be removed
     * @return void
     */
    public function removeVideoFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $videoFileToRemove)
    {
        $this->videoFile->detach($videoFileToRemove);
    }

    /**
     * Returns the videoFile
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $videoFile
     */
    public function getVideoFile()
    {
        return $this->videoFile;
    }

    /**
     * Sets the videoFile
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $videoFile
     * @return void
     */
    public function setVideoFile(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $videoFile)
    {
        $this->videoFile = $videoFile;
    }

    /**
     * Returns the type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param string $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the video type
     *
     * @return string $videoType
     */
    public function getVideoType()
    {
        return $this->videoType;
    }

    /**
     * Sets the video type
     *
     * @param string $videoType
     * @return void
     */
    public function setVideoType($videoType)
    {
        $this->videoType = $videoType;
    }

    /**
     * Returns the ratio
     *
     * @return string $ratio
     */
    public function getRatio()
    {
        return $this->ratio;
    }

    /**
     * Sets the ratio
     *
     * @param string $ratio
     * @return void
     */
    public function setRatio($ratio)
    {
        $this->ratio = $ratio;
    }

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the sorting
     *
     * @return integer $sorting
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Sets the sorting
     *
     * @param integer $sorting
     * @return void
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the poster
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $poster
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * Sets the poster
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $poster
     * @return void
     */
    public function setPoster(\TYPO3\CMS\Extbase\Domain\Model\FileReference $poster)
    {
        $this->poster = $poster;
    }

    /**
     * Returns the mp3
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $mp3
     */
    public function getMp3()
    {
        return $this->mp3;
    }

    /**
     * Sets the mp3
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mp3
     * @return void
     */
    public function setMp3(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mp3)
    {
        $this->mp3 = $mp3;
    }

    /**
     * Returns the ogg
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $ogg
     */
    public function getOgg()
    {
        return $this->ogg;
    }

    /**
     * Sets the ogg
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $ogg
     * @return void
     */
    public function setOgg(\TYPO3\CMS\Extbase\Domain\Model\FileReference $ogg)
    {
        $this->ogg = $ogg;
    }

    /**
     * Returns the width
     *
     * @return string $width
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Sets the width
     *
     * @param string $width
     * @return void
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * Returns the height
     *
     * @return string $height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height
     *
     * @param string $height
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the crop
     *
     * @return integer $crop
     */
    public function getCrop()
    {
        return $this->crop;
    }

    /**
     * Sets the crop
     *
     * @param integer $crop
     * @return void
     */
    public function setCrop($crop)
    {
        $this->crop = $crop;
    }

    /**
     * Returns the clickEnlarge
     *
     * @return integer $clickEnlarge
     */
    public function getClickEnlarge()
    {
        return $this->clickEnlarge;
    }

    /**
     * Sets the clickEnlarge
     *
     * @param integer $clickEnlarge
     * @return void
     */
    public function setClickEnlarge($clickEnlarge)
    {
        $this->clickEnlarge = $clickEnlarge;
    }

    /**
     * Adds a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $gallery
     * @return void
     */
    public function addGallery(\TYPO3\CMS\Extbase\Domain\Model\FileReference $gallery)
    {
        $this->gallery->attach($gallery);
    }

    /**
     * Removes a FileReference
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $galleryToRemove The FileReference to be removed
     * @return void
     */
    public function removeGallery(\TYPO3\CMS\Extbase\Domain\Model\FileReference $galleryToRemove)
    {
        $this->gallery->detach($galleryToRemove);
    }

    /**
     * Returns the gallery
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Sets the gallery
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $gallery
     * @return void
     */
    public function setGallery(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Gets content
     * @return integer $content
     */
    public function getContent()
    {
        return $this->content;
    }

}
