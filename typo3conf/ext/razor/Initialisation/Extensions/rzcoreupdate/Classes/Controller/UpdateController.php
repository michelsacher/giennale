<?php
namespace RZ\Rzcoreupdate\Controller;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class UpdateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var array
     */
    protected $linksToCheck = array('typo3', 't3lib', 'typo3_src');

    /**
     * @var null|array
     */
    protected $calculatedPaths = null;

    /**
     * @var array
     */
    protected $versionInformation = null;

    protected function initializeAction()
    {

    }

    /**
     * Base overview Action
     */
    public function indexAction()
    {
        try {
            $this->initializeEnvironment();
        } catch (Exception $e) {
            $this->flashMessageContainer->add($e->getMessage(), '');
        }
        $this->view->assign('versionInformation', $this->getVersionInformation());
        $this->view->assign('calculatedPaths', $this->calculatedPaths);
        $this->view->assign('availableVersionSources', $this->getLocallyAvailableVersions());
        $this->view->assign('branchDownloads', $this->getBranchDownloads());
    }

    /**
     * Action to switch the version
     *
     * @param string $version
     */
    public function switchAction($version)
    {
        $this->initializeEnvironment();
        $newSource = $this->calculatedPaths['realSourceLocation'] . 'typo3_src-' . $version;
        if (file_exists($newSource) && is_dir($newSource)) {
            //$tceMain = t3lib_div::makeInstance('t3lib_TCEmain');
            //$tceMain->clear_cacheCmd('all');
            unlink(PATH_site . 'typo3_src');
            symlink($this->calculatedPaths['realSourceLocationRel'] . 'typo3_src-' . $version, PATH_site . 'typo3_src');

            // Copy new index.php (Raphael Zschorsch / 16.10.2013)
            //copy(PATH_site . 'typo3_src/index.php', PATH_site . 'index.php');
        } else {
            $this->flashMessageContainer->add($this->__('problemSwitchingSource') . ' ' . htmlspecialchars($newSource) . ' ' . $this->__('doesNotExist'));
        }
        $this->redirect('index');
    }

    /**
     * Action to delete the version
     *
     * @param string $version
     */
    public function deleteAction($version)
    {
        $this->initializeEnvironment();
        $source = $this->calculatedPaths['realSourceLocation'] . 'typo3_src-' . $version;

        if (file_exists($source) && is_dir($source)) {
            $this->rrmdir($source);
            $this->redirect('index');
        } else {
            $this->flashMessageContainer->add($this->__('problemDeletingSource') . ' ' . htmlspecialchars($source) . ' ' . $this->__('doesNotExist'));
        }
    }

    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        $this->rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }

                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * Action to get a version from the provider
     *
     * @param string $version
     */
    public function importAction($version)
    {
        $this->initializeEnvironment();
        if (!is_dir($this->calculatedPaths['realSourceLocation'] . 'typo3_src-' . $version)) {
            if (!class_exists('ZipArchive')) {
                $this->flashMessageContainer->add($this->__('zipArchive'));
                return;
            }
            $zipFile = $this->calculatedPaths['realSourceLocation'] . 'typo3_src-' . $version . '.zip';
            $buffer = GeneralUtility::getUrl('http://get.typo3.org/' . $version . '/zip/');
            GeneralUtility::writeFile($zipFile, $buffer);
            $this->flashMessageContainer->add($this->__('downloaded') . ' ' . htmlspecialchars($version));
            unset($buffer);
            $zipArchive = new \ZipArchive();
            $zipArchive->open($zipFile);
            $zipArchive->extractTo($this->calculatedPaths['realSourceLocation']);
            $zipArchive->close();
            unset($zipArchive);
            unlink($zipFile);
        } else {
            $this->flashMessageContainer->add($this->__('alreadyExists') . ' ' . htmlspecialchars($version));
        }
        $this->redirect('index');
    }

    protected function initializeEnvironment()
    {
        // check if all links are real links

        // TYPO3 6.2.x compatibility
        if (VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 6002000) {
            unset($this->linksToCheck[1]);
        }

        foreach ($this->linksToCheck as $link) {
            if (!is_link(PATH_site . $link)) {
                throw new Exception('Atleast ' . $link . ' is not a symlink, this extension can only update symlinked installations!');
            }
        }

        //get paths
        $this->calculatedPaths = array(
            'PATH_site' => PATH_site,
            //'realSourceLocationRel' => readlink(PATH_site . '/typo3_src'),
            'realSourceLocationRel' => preg_replace("/typo3_src-(.*)/", "", readlink(PATH_site . '/typo3_src')),
            'realSourceLocation' => realpath(realpath(PATH_site . '/typo3') . '/../../') . '/',
        );

        //add available TYPO3 versions

        //check write permissions
        if (!is_writable(PATH_site)) {
            throw new Exception('Can´t write TYPO3 root directory! Needed to change the symlink ...');
        }
        if (!is_writable($this->calculatedPaths['realSourceLocation'])) {
            throw new Exception('Can´t write source location, this is needed to save the new source ...');
        }
    }

    protected function getBranchDownloads()
    {
        $this->getVersionInformation();
        $branchInstalled = substr($this->versionInformation['installed'], 0, strrpos($this->versionInformation['installed'], '.'));

        $helper = GeneralUtility::makeInstance('RZ\\Rzcoreupdate\\Lib\\Helper');
        return $helper->getAllVersionInformationByBranch($branchInstalled);
    }

    protected function getVersionInformation()
    {
        if ($this->versionInformation === null) {
            $helper = GeneralUtility::makeInstance('RZ\\Rzcoreupdate\\Lib\\Helper');
            return $this->versionInformation = $helper->isUpToDate();
        } else {
            return $this->versionInformation;
        }
    }

    protected function getLocallyAvailableVersions()
    {
        $files = scandir($this->calculatedPaths['realSourceLocation']);
        $this->availableVersionSources = array();

        $this->getVersionInformation();
        $branchInstalled = substr($this->versionInformation['installed'], 0, strrpos($this->versionInformation['installed'], '.'));

        foreach ($files as $file) {
            if (substr($file, 0, 10) === 'typo3_src-') {
                $version = substr($file, 10);
                $versionBranch = substr($version, 0, strrpos($version, '.'));
                if ($branchInstalled === $versionBranch) {
                    $this->availableVersionSources[] = $version;
                }
            }
        }

        return $this->availableVersionSources;
    }

    protected function __($key, $vars = array())
    {
        if (empty($vars)) {
            return LocalizationUtility::translate($key, $this->extensionName);
        } else {
            return vsprintf(LocalizationUtility::translate($key, $this->extensionName), (array) $vars);
        }
    }

}
