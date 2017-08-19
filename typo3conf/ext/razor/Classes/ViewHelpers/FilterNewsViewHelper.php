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
 * Filter news records to match the given language
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FilterNewsViewHelper extends AbstractViewHelper
{

    /**
     * Filter news
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $news
     * @return QueryResult
     */
    public function render(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $news)
    {
        // Get language
        $lang = $GLOBALS['TSFE']->sys_language_uid;

        // Match only correct language
        $query = $news->getQuery();

        // Get constraints
        $constraints = array();
        $init = $query->getConstraint();

        if ($init) {
            $constraints[] = $init;
        }

        $constraints[] = $query->logicalOr($query->equals('sys_language_uid', $lang), $query->equals('sys_language_uid', -1));

        $query->matching($query->logicalAnd($constraints));

        return $query->execute();
    }

}
