<?php
namespace RZ\Razor\Hooks\Gridelements;

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

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Class to add some functionality to Gridelemens
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class WizardItems extends \GridElementsTeam\Gridelements\Hooks\WizardItems
{
    /**
     * add gridelements to wizard items
     *
     * @param array $gridItems
     * @param array $wizardItems
     */
    public function addGridItemsToWizard(array &$gridItems, array &$wizardItems)
    {
        if (empty($gridItems)) {
            return;
        }
        // create gridelements node
        $wizardItems['gridelements'] = array();
        // set header label
        $wizardItems['gridelements']['header'] = $this->getLanguageService()->sL(
            'LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xml:tx_gridelements_backend_layout_wizard_label'
        );
        $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
        // traverse the gridelements and create wizard item for each gridelement
        foreach ($gridItems as $key => $item) {
            $largeIcon = '';
            if (empty($item['iconIdentifierLarge'])) {
                if (is_array($item['icon']) && isset($item['icon'][1])) {
                    $item['iconIdentifierLarge'] = 'gridelements-large-' . $key;
                    $largeIcon = $item['icon'][1];
                    if (StringUtility::beginsWith($largeIcon, '../typo3conf/ext/')) {
                        $largeIcon = str_replace('../typo3conf/ext/', 'EXT:', $largeIcon);
                    }
                    if (StringUtility::beginsWith($largeIcon, '../uploads/tx_gridelements/')) {
                        $largeIcon = str_replace('../', '', $largeIcon);
                    } else if (!StringUtility::beginsWith($largeIcon, 'EXT:') && strpos($largeIcon,
                        '/') === false
                    ) {
                        $largeIcon = GeneralUtility::resolveBackPath($item['icon'][1]);
                    }
                    if (!empty($icon)) {
                        if (StringUtility::endsWith($largeIcon, '.svg')) {
                            $iconRegistry->registerIcon($item['iconIdentifierLarge'], SvgIconProvider::class, array(
                                'source' => $largeIcon,
                            ));
                        } else {
                            $iconRegistry->registerIcon($item['iconIdentifierLarge'], BitmapIconProvider::class,
                                array(
                                    'source' => $largeIcon,
                                ));
                        }
                    }
                } else {
                    $item['iconIdentifierLarge'] = 'gridelements-large-' . $key;
                    $iconRegistry->registerIcon($item['iconIdentifierLarge'], SvgIconProvider::class, array(
                        'source' => 'EXT:gridelements/Resources/Public/Icons/gridelements.svg',
                    ));
                }
            }

            // Traverse defVals
            $defVals = '';

            if ($item['tt_content_defValues']) {
                foreach ($item['tt_content_defValues'] as $field => $value) {
                    if ($field == 'header') {
                        $value = $GLOBALS['LANG']->sL($value);
                    }
                    $defVals .= '&defVals[tt_content][' . $field . ']=' . $value;
                }
            }

            $itemIdentifier = $item['alias'] ? $item['alias'] : $item['uid'];
            $wizardItems['gridelements_' . $itemIdentifier] = array(
                'title' => $item['title'],
                'description' => $item['description'],
                'params' => ($largeIcon ? '&largeIconImage=' . $largeIcon : '') . '&defVals[tt_content][CType]=gridelements_pi1' . $defVals . '&defVals[tt_content][tx_gridelements_backend_layout]=' . $item['uid'] . ($item['tll'] ? '&isTopLevelLayout' : ''),
                'tt_content_defValues' => array(
                    'CType' => 'gridelements_pi1',
                    'tx_gridelements_backend_layout' => $item['uid'],
                ),
            );

            $icon = '';
            if ($item['iconIdentifier']) {
                $wizardItems['gridelements_' . $itemIdentifier]['iconIdentifier'] = $item['iconIdentifier'];
            } elseif (is_array($item['icon']) && isset($item['icon'][0])) {
                $item['iconIdentifier'] = 'gridelements-' . $key;
                $icon = $item['icon'][0];
                if (StringUtility::beginsWith($icon, '../typo3conf/ext/')) {
                    $icon = str_replace('../typo3conf/ext/', 'EXT:', $icon);
                }
                if (StringUtility::beginsWith($icon, '../uploads/tx_gridelements/')) {
                    $icon = str_replace('../', '', $icon);
                } else if (!StringUtility::beginsWith($icon, 'EXT:') && strpos($icon, '/') !== false) {
                    $icon = GeneralUtility::resolveBackPath($item['icon'][0]);
                }
                if (StringUtility::endsWith($icon, '.svg')) {
                    $iconRegistry->registerIcon($item['iconIdentifier'], SvgIconProvider::class, array(
                        'source' => $icon,
                    ));
                } else {
                    $iconRegistry->registerIcon($item['iconIdentifier'], BitmapIconProvider::class, array(
                        'source' => $icon,
                    ));
                }
            } else {
                $item['iconIdentifier'] = 'gridelements-' . $key;
                $iconRegistry->registerIcon($item['iconIdentifier'], SvgIconProvider::class, array(
                    'source' => 'EXT:gridelements/Resources/Public/Icons/gridelements.svg',
                ));
            }
            if ($icon && !isset($wizardItems['gridelements_' . $itemIdentifier]['iconIdentifier'])) {
                $wizardItems['gridelements_' . $itemIdentifier]['iconIdentifier'] = 'gridelements-' . $key;
            } else if (!isset($wizardItems['gridelements_' . $itemIdentifier]['iconIdentifier'])) {
                $wizardItems['gridelements_' . $itemIdentifier]['iconIdentifier'] = 'gridelements-default';
            }
        }
    }

}
