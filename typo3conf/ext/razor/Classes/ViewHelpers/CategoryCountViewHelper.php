<?php
namespace RZ\Razor\ViewHelpers;

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

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Counts all news from a given category
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class CategoryCountViewHelper extends AbstractViewHelper
{

    /**
     *
     * @param int $category The category
     * @return string
     */
    public function render($category)
    {
        $query = $GLOBALS['TYPO3_DB']->sql_query('SELECT COUNT(*) as NewsCounted FROM sys_category_record_mm LEFT OUTER JOIN tx_news_domain_model_news ON uid=uid_foreign WHERE uid_local =' . $category . ' AND deleted=0 AND hidden=0');
        $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($query);

        $newsCount = $row['NewsCounted'];

        return $newsCount;
    }

}
