<?php
namespace RZ\Rzpagetreetools\Tree;

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

use TYPO3\CMS\Backend\Tree\Pagetree\Commands;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Tools extends \TYPO3\CMS\Backend\Tree\Pagetree\Commands
{

    public function hideShow($nodeData, $hideShow)
    {
        $node = GeneralUtility::makeInstance('TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode', (array) $nodeData);
        $dataProvider = GeneralUtility::makeInstance('TYPO3\CMS\Backend\Tree\Pagetree\DataProvider');

        try {
            $data['pages'][$node->getWorkspaceId()]['nav_hide'] = $hideShow;
            self::processTceCmdAndDataMap(array(), $data);

            $newNode = Commands::getNode($node->getId());
            $newNode->setLeaf($node->isLeafNode());
            $returnValue = $newNode->toArray();
        } catch (Exception $exception) {
            $returnValue = array(
                'success' => false,
                'message' => $exception->getMessage(),
            );
        }

        return $returnValue;
    }

    public function switchPage($nodeData, $doktype)
    {
        $node = GeneralUtility::makeInstance('TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode', (array) $nodeData);
        $dataProvider = GeneralUtility::makeInstance('TYPO3\CMS\Backend\Tree\Pagetree\DataProvider');

        try {
            $data['pages'][$node->getWorkspaceId()]['doktype'] = $doktype;
            self::processTceCmdAndDataMap(array(), $data);

            $newNode = Commands::getNode($node->getId());
            $newNode->setLeaf($node->isLeafNode());
            $returnValue = $newNode->toArray();
        } catch (Exception $exception) {
            $returnValue = array(
                'success' => false,
                'message' => $exception->getMessage(),
            );
        }

        return $returnValue;
    }

}
