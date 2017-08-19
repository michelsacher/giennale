<?php
namespace RZ\Fancyboxcontent\Controller;

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

use RZ\Fancyboxcontent\Utility\T3jquery;

/**
 * FancyboxController
 */
class FancyboxController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        // t3jquery
        $t3jqueryCheck = T3jquery::check();

        // Get uid
        $cObj = $this->configurationManager->getContentObject();
        $uid = $cObj->data['uid'];

        // Add jQuery?
        if ($t3jqueryCheck === false) {
            if ($this->settings['addJquery']) {
                if ($this->settings['addToFooter']) {
                    $GLOBALS['TSFE']->additionalFooterData['fancyboxcontent_jquery'] = '<script type="text/javascript" src="typo3conf/ext/fancyboxcontent/Resources/Public/Js/jquery-3.1.1.min.js"></script>';
                } else {
                    $GLOBALS['TSFE']->additionalHeaderData['fancyboxcontent_jquery'] = '<script type="text/javascript" src="typo3conf/ext/fancyboxcontent/Resources/Public/Js/jquery-3.1.1.min.js"></script>';
                }
            }
        }

        // Add JS files
        if ($this->settings['addFancybox']) {
            if ($this->settings['addToFooter']) {
                $GLOBALS['TSFE']->additionalFooterData['fancyboxcontent_js'] = '<script type="text/javascript" src="typo3conf/ext/fancyboxcontent/Resources/Public/Js/fancybox3/dist/jquery.fancybox.min.js"></script>';
            } else {
                $GLOBALS['TSFE']->additionalHeaderData['fancyboxcontent_js'] = '<script type="text/javascript" src="typo3conf/ext/fancyboxcontent/Resources/Public/Js/fancybox3/dist/jquery.fancybox.min.js"></script>';
            }
        }

        // Content elements
        $contentElements = explode(",", $this->settings['ce']);

        // Set vars
        $this->view->assign('uid', $uid);
        $this->view->assign('addToFooter', $this->settings['addToFooter']);

        if ($this->settings['linkClass']) {
            $this->view->assign('linkClasses', ' ' . trim($this->settings['linkClass']));
        } else {
            $this->view->assign('linkClasses', '');
        }

        $this->view->assign('contentElements', $contentElements);
    }

}