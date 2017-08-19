<?php
namespace RZ\Realurlclearcache\Toolbar;

/**
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

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Prepares additional flush cache entry.
 *
 * @package RZ\Realurlclearcache\Toolbar
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ToolbarItem implements \TYPO3\CMS\Backend\Toolbar\ClearCacheActionsHookInterface
{
    static $itemKey = 'flushRealurlCache';

    /**
     * Adds the flush language cache menu item.
     *
     * @param array $cacheActions Array of CacheMenuItems
     * @param array $optionValues Array of AccessConfigurations-identifiers (typically used by userTS with options.clearCache.identifier)
     * @return void
     */
    public function manipulateCacheActions(&$cacheActions, &$optionValues)
    {
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
        $icon = $iconFactory->getIcon('realurl_cache', \TYPO3\CMS\Core\Imaging\Icon::SIZE_SMALL);

        if ($this->getBackendUser()->isAdmin() || $GLOBALS['BE_USER']->getTSConfigVal('options.clearCache.realurl')) {
            $cacheActions[] = array(
                'id' => self::$itemKey,
                'title' => $this->getLanguageService()->sL('LLL:EXT:realurlclearcache/Resources/Private/Language/locallang.xlf:rm.clearCacheMenu_realUrlClearCache'),
                'href' => BackendUtility::getAjaxUrl('realurl_cache::flushCache'),
                'icon' => $icon,
            );
            $optionValues[] = self::$itemKey;
        }
    }

    /**
     * Flushes the language cache (l10n).
     *
     * @return void
     */
    public function flushCache()
    {
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE tx_realurl_pathdata;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE tx_realurl_uniqalias;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE tx_realurl_uniqalias_cache_map;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE tx_realurl_urldata;');
    }

    /**
     * Wrapper around the global BE user object.
     *
     * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }

    /**
     * Wrapper around the global language object.
     *
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}