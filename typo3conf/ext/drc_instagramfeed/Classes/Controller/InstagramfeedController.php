<?php
namespace DRCSYSTEMS\DrcInstagramfeed\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 DRC Systems <info@drcsystems.com>, DRC SYSTEMS INDIA PVT. LTD.
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * InstagramfeedController
 */
class InstagramfeedController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * instagramfeedRepository
     *
     * @var \DRCSYSTEMS\DrcInstagramfeed\Domain\Repository\InstagramfeedRepository
     * @inject
     */
    protected $instagramfeedRepository = NULL;


     /**
     * Init
     *
     * @return void
     */
    public function initializeAction() {

         $javascriptPop =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility
::siteRelPath($this->request->getControllerExtensionKey()).'Resources/Public/Js/jquery.magnific-popup.min.js';
        $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($javascriptPop, 'text/javascript', FALSE, FALSE, '');
        $javascriptCustom =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility
::siteRelPath($this->request->getControllerExtensionKey()).'Resources/Public/Js/custom.js';
        $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($javascriptCustom, 'text/javascript', FALSE, FALSE, '');


        parent::initializeAction();
    }


    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {

        $json = file_get_contents('https://api.instagram.com/v1/users/' . $this->settings['clientId'] . '/media/recent/?access_token=' . $this->settings['token'] . '');
        $data = json_decode($json);
        $images = array();
        foreach ($data->data as $user_data) {
            //echo '<pre>';
            //print_r($user_data);
            $images[] = (array) $user_data;
        }

        //echo '<pre>';print_r($images);
        // to get the array with thumb resolutions
        $instagramfeeds = array_map(function ($item) {    
                return $item;
            },
            $images
        );
        //$instagramfeeds = $this->instagramfeedRepository->findAll();
        $this->view->assign('instagramfeeds', $instagramfeeds);
    
    }
    
    /**
     * action listb
     *
     * @return void
     */
    public function listbAction()
    {
        
        $json = file_get_contents('https://api.instagram.com/v1/users/' . $this->settings['clientId'] . '/media/recent/?access_token=' . $this->settings['token'] . '');
        $data = json_decode($json);
        // to get the array with all resolutions
        $images = array();
        foreach ($data->data as $user_data) {
            $images[] = (array) $user_data->images;
        }
        //print_r($images);
        // to get the array with thumb resolutions
        $instagramfeeds = array_map(function ($item) {    return $item['thumbnail']->url;
            },
            $images
        );
        //$instagramfeeds = $this->instagramfeedRepository->findAll();
        $this->view->assign('instagramfeeds', $instagramfeeds);
    }
    
    /**
     * action show
     *
     * @param \DRCSYSTEMS\DrcInstagramfeed\Domain\Model\Instagramfeed $instagramfeed
     * @return void
     */
    public function showAction(\DRCSYSTEMS\DrcInstagramfeed\Domain\Model\Instagramfeed $instagramfeed)
    {
        $this->view->assign('instagramfeed', $instagramfeed);
    }

}