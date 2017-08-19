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

use TYPO3\CMS\Core\Utility\StringUtility;

/**
 * Class to add some functionality to Gridelemens
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class LayoutSetup extends \GridElementsTeam\Gridelements\Backend\LayoutSetup
{

    /**
     * Returns the item array for form field selection.
     *
     * @param int $colPos
     * @param string $excludeLayouts
     * @param array $allowedGridTypes
     *
     * @return  array
     */
    public function getLayoutWizardItems($colPos, $excludeLayouts = '', array $allowedGridTypes = array())
    {
        $wizardItems = array();
        $excludeLayouts = array_flip(explode(',', $excludeLayouts));
        foreach ($this->layoutSetup as $layoutId => $item) {
            if (!empty($allowedGridTypes) && !isset($allowedGridTypes[$layoutId])) {
                continue;
            }
            if (((int)$colPos === -1 && $item['top_level_layout']) || isset($excludeLayouts[$item['uid']])) {
                continue;
            }

            $wizardItems[] = array(
                'uid' => $layoutId,
                'title' => $GLOBALS['LANG']->sL($item['title']),
                'description' => $GLOBALS['LANG']->sL($item['description']),
                'icon' => $item['icon'],
                'iconIdentifier' => $item['iconIdentifier'],
                'tll' => $item['top_level_layout'],
                'tt_content_defValues' => $item['tt_content_defValues.'],
            );

        }

        return $wizardItems;
    }

    /**
     * Returns the item array for form field selection.
     *
     * @param int $colPos The selected content column position.
     *
     * @return array
     */
    public function getLayoutSelectItems($colPos)
    {
        $selectItems = array();
        foreach ($this->layoutSetup as $layoutId => $item) {
            if ((int) $colPos === -1 && $item['top_level_layout']) {
                continue;
            }
            $icon = 'gridelements-default';
            if ($item['iconIdentifier']) {
                $icon = $item['iconIdentifier'];
            } elseif (!empty($item['icon'])) {
                if (is_array($item['icon']) && !empty($item['icon'][0])) {
                    $icon = $item['icon'][0];
                } else {
                    $icon = $item['icon'];
                }
                if (!StringUtility::beginsWith($icon, '../')) {
                    $icon = '../' . $icon;
                }
            }
            $selectItems[] = array($this->languageService->sL($item['title']), $layoutId, $icon);
        }
        return $selectItems;
    }

}
