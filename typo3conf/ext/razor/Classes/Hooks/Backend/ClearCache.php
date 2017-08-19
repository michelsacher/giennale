<?php
namespace RZ\Razor\Hooks\Backend;

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

use RZ\Razor\Hooks\Frontend\PageRenderer;
use TYPO3\CMS\Core\Service\OpcodeCacheService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Clear cache class
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ClearCache
{

    /**
     * Clear cache
     *
     * @param array $params
     * @return void
     */
    public function clearCachePostProc(array $params)
    {
        if ($params['cacheCmd'] === 'system') {
            $this->clear();
        }

        if ($params['cacheCmd'] === 'pages') {
            $this->clearRazor();
        }
    }

    /**
     * Clear cache functions
     *
     * @return void
     */
    public function clear()
    {
        // Clear tables
        $this->clearTables();

        // Clear vhs assets
        $this->clearVhs();

        // Clear opcode
        $this->clearOpcode();
    }

    /**
     * Clear razor cache
     *
     * @return void
     */
    public static function clearRazor()
    {
        $razorFile = PATH_site . 'typo3temp/razor/razor.css';

        // Remove temp razor files
        if (is_dir(PATH_site . 'typo3temp/razor')) {
            $files = glob(PATH_site . 'typo3temp/razor/Temp/*.razor');
            array_walk($files, function ($file) {
                unlink($file);
            });

            if (is_file($razorFile)) {
                // Delete file
                unlink($razorFile);

                // Create empty file again (needed for frontend so the file is available)
                fopen($razorFile, "w");
            }

            // Call PageRenderer to create css files after clearing cache
            $pageRenderer = new PageRenderer();
            $pageRenderer->start();
        }
    }

    /**
     * Clear cf_* tables
     *
     * @return void
     */
    public static function clearTables()
    {
        // Clear cf_* tables
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_hash;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_hash_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_pages;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_pagesection;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_pagesection_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_pages_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_rootline;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_cache_rootline_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_datamapfactory_datamap;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_datamapfactory_datamap_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_object;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_object_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_reflection;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_reflection_tags;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_typo3dbbackend_queries;');
        $GLOBALS['TYPO3_DB']->sql_query('TRUNCATE TABLE cf_extbase_typo3dbbackend_queries_tags;');
    }

    /**
     * Clear vhs temp files
     *
     * @return void
     */
    public static function clearVhs()
    {
        $razor = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

        $settings = array(
            'maxAge' => (int) $razor['maxAge'],
            'now' => $GLOBALS['EXEC_TIME'],
        );

        $files = glob(PATH_site . 'typo3temp/vhs-assets-*');
        array_walk($files, function ($file) use ($settings) {
            // Get last modification time
            $lastAccess = fileatime($file);
            $age = $settings['now'] - $lastAccess;

            if ($age >= $settings['maxAge']) {
                unlink($file);
            }
        });
    }

    /**
     * Clear opcode cache
     *
     * @return void
     */
    public static function clearOpcode()
    {
        GeneralUtility::makeInstance(OpcodeCacheService::class)->clearAllActive();
    }

}
