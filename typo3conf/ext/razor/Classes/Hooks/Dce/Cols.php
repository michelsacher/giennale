<?php
namespace RZ\Razor\Hooks\Dce;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Bootstrap col handling
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Cols
{

    /**
     * Col handling
     *
     * @param array $PA
     * @param array $config
     * @return array
     */
    public function user_cols($PA, $config)
    {
        // Get cols
        $cols = $this->getColsFromTs(1);
        if (!$cols) {
            $cols = 12;
        }

        $items = $this->getIntCols($cols);

        // Build select box
        $fieldConfig = array(
            'fieldConf' => array(
                'config' => array(
                    'type' => 'select',
                    'items' => $items,
                    'size' => 1,
                    'minitems' => 0,
                    'maxitems' => 1,
                ),
            ),
            'onFocus' => '',
            'fieldChangeFunc' => array(
                'razor' => '',
            ),
            'label' => '',
            'itemFormElValue' => array($PA['itemFormElValue']),
            'itemFormElName' => $PA['itemFormElName'],
            'itemFormElName_file' => $PA['itemFormElName_file'],
        );

        /** @var \TYPO3\CMS\Backend\Form\NodeFactory $nodeFactory */
        $nodeFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Form\\NodeFactory');
        $options = array(
            'renderType' => 'selectSingle',
            'inlineStructure' => array(),
            'parameterArray' => $fieldConfig,
        );

        $selectSingleResult = $nodeFactory->create($options)->render();

        return $selectSingleResult['html'];
    }

    /**
     * Filter cols
     *
     * @param int $cols
     * @return array
     */
    private function getIntCols($cols)
    {
        $arr = array();
        for ($i = 2; $i <= $cols - 1; $i++) {
            $result = $cols / $i;

            $arr[] = $result;
        }

        // Filter array
        $filtered = array_filter($arr, 'is_int');

        // Build for select box
        $items = array(
            0 => array(
                1, 1,
            ),
        );
        foreach ($filtered as $item) {
            $items[] = array(
                $item,
                $item,
            );
        }

        return $items;
    }

    /**
     * Get cols from TypoScript
     *
     * @param int $pageUid
     * @return string
     */
    private function getColsFromTs($pageUid)
    {
        $sysPageObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
        $rootLine = $sysPageObj->getRootLine($pageUid);
        $TSObj = GeneralUtility::makeInstance('TYPO3\CMS\Core\TypoScript\ExtendedTemplateService');
        $TSObj->tt_track = 0;
        $TSObj->init();
        $TSObj->runThroughTemplates($rootLine);
        $TSObj->generateConfig();

        $cols = $TSObj->setup['razor.']['bootstrap.']['cols'];

        return $cols;
    }

}
