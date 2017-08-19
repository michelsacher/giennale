<?php
namespace RZ\Razor\Hooks\Save;

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

use RZ\Razor\Hooks\Backend\ClearCache;

/**
 * Class to add some save functionality
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Save
{

    /**
     * Hook action
     *
     * @param string $status
     * @param string $table
     * @param int $id
     * @param array $fieldArray
     * @param t3lib_TCEmain $pObj
     * @return void
     */
    public function processDatamap_afterDatabaseOperations($status, $table, $id, array $fieldArray, \TYPO3\CMS\Core\DataHandling\DataHandler &$pObj)
    {
        $tables = array(
            'tx_razor_domain_model_color',
            'tx_razor_domain_model_padding',
        );

        // Clear razor.css cache
        if (in_array($table, $tables)) {
            ClearCache::clearRazor();
        }
    }

}
