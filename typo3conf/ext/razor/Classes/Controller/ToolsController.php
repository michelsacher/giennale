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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * This class provides some tools
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ToolsController extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin
{

    /**
     * Powermail fields
     *
     * @param array $params
     * @return void
     */
    public function powermailFields($params)
    {
        $flexform = $params['flexParentDatabaseRow']['pi_flexform'];

        // Get flexform field "field_link"
        if ($flexform) {
            $flexFormContent = GeneralUtility::xml2array($params['row']['pi_flexform']);

            $flexFormContent = $flexform;

            $fieldLinkValue = trim($flexFormContent['data']['sheet.sheetGeneral']['lDEF']['settings.link']['vDEF']);

            // Get powermail fields
            $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
            $fieldRepository = $this->objectManager->get('RZ\\Razor\\Domain\\Repository\\FieldRepository');
            $fields = $fieldRepository->findByPid($fieldLinkValue);
            $numRows = $fields->count();

            // Display fields if there is a contact form on the selected page
            if ($numRows > 0) {
                foreach ($fields as $row) {
                    $params['items'][$row->getUid()] = array(
                        $row->getTitle(),
                        $row->getUid(),
                    );
                }
            }

            // If no contact form is on selected page, show nothing
            else {
                $params['items']['0'] = array(
                    "",
                    "",
                );
            }
        }
    }

    /**
     * Outer wrap
     *
     * @param string $content
     * @param array $conf
     * @return string if classes are set, FALSE otherwise
     */
    public function outerWrap($content, $conf)
    {
        $visibility = $this->cObj->stdWrap($content, $conf['visibility.']);
        $effect = $this->cObj->stdWrap($content, $conf['effect.']);
        $cssClasses = $this->cObj->stdWrap($content, $conf['classes.']);

        // Get visibility
        if ($visibility) {
            $visibilityArr = explode(",", $visibility);

            $classes = '';
            foreach ($visibilityArr as $class) {
                $classes .= $class . ' ';
            }
        }

        // Get effect
        if ($effect) {
            $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
            $effectsRepository = $this->objectManager->get('RZ\\Razor\\Domain\\Repository\\EffectsRepository');
            $row = $effectsRepository->findByUid($effect);

            if ($row) {
                $classes .= ' wow ' . $row->getValue();
                $duration = ' data-wow-duration="' . floatval($row->getDuration()) . 's"';
                $delay = ' data-wow-delay="' . floatval($row->getDelay()) . 's"';
            }
        }

        // Get custom classes
        if ($cssClasses) {
            $classes .= ' ' . $cssClasses;
        }

        $classes = trim($classes);

        if ($classes) {
            $output = '<div class="' . $classes . '"' . $duration . $delay . '>|</div>';

            return $output;
        } else {
            return false;
        }
    }

}