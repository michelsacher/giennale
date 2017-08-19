<?php
namespace RZ\Razor\Hooks\Backend;

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

use RZ\Razor\Api\TinyPNG;
use TYPO3\CMS\Core\Utility\File\ExtendedFileUtilityProcessDataHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class renders an image through TinyPNG service
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FileUploadHook implements ExtendedFileUtilityProcessDataHookInterface
{

    /** Locallang path */
    protected $llPath = 'LLL:EXT:razor/Resources/Private/Language/Hook/locallang.xlf';

/**
 * @param string $action The action
 * @param array $cmdArr The parameter sent to the action handler
 * @param array $result The results of all calls to the action handler
 * @param \TYPO3\CMS\Core\Utility\File\ExtendedFileUtility $pObj The parent object
 * @return void
 */
    public function processData_postProcessAction($action, array $cmdArr, array $result, \TYPO3\CMS\Core\Utility\File\ExtendedFileUtility $pObj)
    {
        if ($action === 'upload') {
            /** @var \TYPO3\CMS\Core\Resource\File[] $fileObjects */
            $fileObjects = array_pop($result);
            if (!is_array($fileObjects)) {
                return;
            }

            foreach ($fileObjects as $fileObject) {
                // Get storage
                $storageRecord = $fileObject->getStorage()->getStorageRecord();

                // Get file extension
                $extension = $fileObject->getExtension();
                $extensions = array('jpg', 'jpeg', 'png');

                if ($storageRecord['driver'] === 'Local' && in_array($extension, $extensions)) {
                    $this->runTinyPng($fileObject);
                }
            }
        }
    }

    /**
     * Run through TinyPng
     *
     * @param \TYPO3\CMS\Core\Resource\File $fileObject
     * @return void
     */
    protected function runTinyPng(\TYPO3\CMS\Core\Resource\File $fileObject)
    {
        // Get API key
        $apiKey = $this->getApiKey();

        if ($apiKey) {
            $api = new TinyPNG($apiKey);

            // Get file properties
            $properties = $fileObject->getProperties();

            // Get public url
            $url = $fileObject->getPublicUrl();

            // Get path to file
            $file = PATH_site . $url;

            // Get filename
            $filename = $properties['name'];

            // Shrink file
            $api->shrink($file);

            // Result
            $result = $api->getResultJson();

            // If there is an error (i.e. wrong API key)
            if ($result->error) {
                return;
            }

            // New file
            $newFile = GeneralUtility::getURL($result->output->url);

            // Overwrite old file
            GeneralUtility::writeFile($file, $newFile);

            // Get new size
            $newSize = $result->output->size;

            // Update file size
            $GLOBALS['TYPO3_DB']->exec_UPDATEquery('sys_file', 'uid=' . $fileObject->getUid(), array(
                'size' => $newSize,
            ));
        }
    }

    /**
     * Get API key from TypoScript
     *
     * @return string
     */
    private function getApiKey()
    {
        $pageUid = 1;

        $sysPageObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\Page\\PageRepository');
        $TSObj = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\TypoScript\\TemplateService');
        $TSObj->tt_track = 0;
        $TSObj->init();
        $TSObj->runThroughTemplates($sysPageObj->getRootLine($pageUid));
        $TSObj->generateConfig();

        // Get API key
        $apiKey = trim($TSObj->setup['razor.']['image.']['tinyPngApiKey']);

        return $apiKey;
    }

}
