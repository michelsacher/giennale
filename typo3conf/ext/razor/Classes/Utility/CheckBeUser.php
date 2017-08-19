<?php
namespace RZ\Razor\Utility;

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
 * Check backend user
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class CheckBeUser
{

    /**
     * Check BE user
     *
     * @param int $pageType
     * @return void
     */
    public static function check($pageType)
    {
        global $GLOBALS;

        $pageTypes = '';
        foreach ($GLOBALS['BE_USER']->userGroups as $group) {
            $pageTypes .= $group['pagetypes_select'] . ',';
        }

        $pageTypes = substr($pageTypes, 0, -1);
        $pageTypesArr = explode(",", $pageTypes);

        // Check if page type is allowed
        if (in_array($pageType, $pageTypesArr) || $GLOBALS['BE_USER']->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }

}
