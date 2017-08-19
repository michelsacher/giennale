<?php

if (!function_exists('user_check_be_user')) {
    function user_check_be_user($pageType)
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
