<?php
namespace RZ\Razor\Controller;

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

use RZ\Razor\Utility\Translate;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class provides a tools backend module
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class BackendToolsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Tools action
     *
     * @return void
     */
    public function toolsAction()
    {
        // Get post values
        $arguments = $this->request->getArguments();

        // States
        $states = array(
            'alpha' => Translate::translate('alpha'),
            'beta' => Translate::translate('beta'),
            'stable' => Translate::translate('stable'),
            'experimental' => Translate::translate('experimental'),
            'test' => Translate::translate('test'),
            'obsolete' => Translate::translate('obsolete'),
            'excludeFromUpdates' => Translate::translate('excludeFromUpdates'),
        );

        $this->view->assign('states', $states);
        $this->view->assign('viewhelper', 1);

        // If extension already exists
        if ($arguments['already']) {
            // Set vars
            $this->view->assignMultiple(array(
                'extension' => $arguments['extension'],
                'vendor' => $arguments['vendor'],
                'author' => $arguments['author'],
                'email' => $arguments['email'],
                'desc' => $arguments['desc'],
                'version' => $arguments['version'],
                'state' => $arguments['state'],
                'viewhelper' => $arguments['viewhelper'],
            ));

            $this->addFlashMessage(Translate::translate('errorMessage'), $messageTitle = Translate::translate('error'), $severity = AbstractMessage::ERROR, $storeInSession = false);
        } elseif ($arguments['success']) {
            $this->addFlashMessage(Translate::translate('successMessage'), $messageTitle = Translate::translate('success'), $severity = AbstractMessage::OK, $storeInSession = false);
        }
    }

    /**
     * Create action
     *
     * @return void
     */
    public function createAction()
    {
        // Get post values
        $arguments = $this->request->getArguments();

        // Paths
        $t3confPath = PATH_site . 'typo3conf/ext/';
        $extPath = $t3confPath . 'razor/Configuration/Tools/Extension/';

        // Get extension name
        $extension = strtolower(trim($arguments['extension']));

        // Extension already exists = abort
        if (is_dir($t3confPath . $extension)) {
            $this->redirect('tools', 'BackendTools', 'razor', array(
                'already' => true,
                'extension' => $extension,
                'vendor' => strtoupper(trim($arguments['vendor'])),
                'author' => trim($arguments['author']),
                'email' => trim($arguments['email']),
                'desc' => trim($arguments['desc']),
                'version' => trim($arguments['version']),
                'state' => trim($arguments['state']),
                'viewhelper' => trim($arguments['viewhelper']),
            ));
        } else {
            // Create dir
            GeneralUtility::mkdir($t3confPath . $extension);

            // Copy files
            $this->recurseCopy($extPath, $t3confPath . $extension);

            // Define markers
            $markerArr = array(
                '###EXT###' => $extension,
                '###VENDOR###' => strtoupper(trim($arguments['vendor'])),
                '###AUTHOR###' => trim($arguments['author']),
                '###EMAIL###' => trim($arguments['email']),
                '###DESC###' => trim($arguments['desc']),
                '###DATE###' => date('Y-m-d'),
                '###EXT_UPPER###' => ucfirst($extension),
                '###VERSION###' => trim($arguments['version']),
                '###STATE###' => trim($arguments['state']),
            );

            // Change values
            $this->substituteMarker($t3confPath . $extension . '/ext_emconf.php', $markerArr);
            $this->substituteMarker($t3confPath . $extension . '/Classes/ViewHelpers/TestViewHelper.php', $markerArr);

            // No ViewHelper
            if (!$arguments['viewhelper']) {
                $this->delete($t3confPath . $extension . '/Classes');
            } else {
                $this->substituteMarker($t3confPath . $extension . '/Classes/ViewHelpers/TestViewHelper.php', $markerArr);
            }

            // Redirect
            $this->redirect('tools', 'BackendTools', 'razor', array(
                'success' => true,
            ));
        }
    }

    /**
     * Recursive copy
     *
     * @param string $src
     * @param string $dst
     * @return void
     */
    private function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Delete
     *
     * @param string $path
     * @return bool FALSE
     */
    private function delete($path)
    {
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array(
                '.',
                '..',
            ));

            foreach ($files as $file) {
                $this->delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } elseif (is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }

    /**
     * Substitute marker
     *
     * @param string $file
     * @param array $markerArr
     * @return void
     */
    private function substituteMarker($file, $markerArr)
    {
        $fname = $file;
        $fhandle = fopen($fname, 'r');
        $content = fread($fhandle, filesize($fname));

        // Substitute marker with domain name
        foreach ($markerArr as $marker => $value) {
            $content = str_replace($marker, $value, $content);
        }

        $fhandle = fopen($fname, 'w');
        fwrite($fhandle, $content);
        fclose($fhandle);
    }

}