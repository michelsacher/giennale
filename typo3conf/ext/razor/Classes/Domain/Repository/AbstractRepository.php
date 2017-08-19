<?php
namespace RZ\Razor\Domain\Repository;

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
 * Abstract repository
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class AbstractRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Find all records without pid restriction
     *
     * @return void
     */
    public function findAllWithoutPidRestriction()
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        return $query->execute();
    }

    /**
     * Find record by pid
     *
     * @param int $pid
     * @param int $limit
     * @return void
     */
    public function findByPid($pid, $limit = null)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->equals('pid', $pid));

        if ($limit) {
            $query->setLimit($limit);
        }

        return $query->execute();
    }

    /**
     * Find record by uid
     *
     * @param int $pid
     * @param int $uid
     * @return void
     */
    public function findByRecord($pid, $uid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching(
            $query->logicalAnd(
                $query->equals('pid', $pid),
                $query->equals('uid', $uid)
            )
        );

        return $query->execute()->getFirst();
    }

    /**
     * Find record by categories
     *
     * @param int $pid
     * @param array $categories
     * @param string $conjunction
     * @param int $limit
     * @return void
     */
    public function findByCategories($pid, $categories, $conjunction, $limit = null)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        // Constraints
        $constraints = array();
        foreach ($categories as $cat) {
            $constraints[] = $query->contains('categories', $cat);
        }

        // Conjunction
        if ($conjunction == 'or') {
            $query->matching(
                $query->logicalAnd(
                    $query->equals('pid', $pid),
                    $query->logicalOr($constraints)
                )
            );
        } else if ($conjunction == 'and') {
            $query->matching(
                $query->logicalAnd(
                    $query->equals('pid', $pid),
                    $query->logicalAnd($constraints)
                )
            );
        }

        if ($limit) {
            $query->setLimit($limit);
        }

        return $query->execute();
    }

    /**
     * Find previous item by sorting
     *
     * @param int $sorting
     * @param int $pid
     * @return boolean|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
     */
    public function findPrev($sorting, $pid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
            $query->logicalAnd(
                $query->equals('pid', $pid),
                $query->lessThan('sorting', $sorting)
            )
        );

        // Invert order to get highest sorting first
        $query->setOrderings(array('sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING));

        $result = $query->setLimit(1)->execute();

        if ($query->count()) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * Find next item by sorting
     *
     * @param int $sorting
     * @param int $pid
     * @return boolean|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
     */
    public function findNext($sorting, $pid)
    {
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
            $query->logicalAnd(
                $query->equals('pid', $pid),
                $query->greaterThan('sorting', $sorting)
            )
        );

        $result = $query->setLimit(1)->execute();

        if ($query->count()) {
            return $result;
        } else {
            return false;
        }
    }

}
