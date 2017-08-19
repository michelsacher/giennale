<?php
namespace RZ\Razor\Hooks\Gridelements;

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

    /** Locallang path */
    protected $locallangPath = 'LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:';

    /** Options */
    private $options = array();

    /** Directory for temp files */
    protected $directory = 'typo3temp/razor/';

    /** Settings file */
    protected $settingsFile = 'cols.ini';

    /** Settings file with path */
    protected $settingsFileWithPath = '';

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
        $cols = $this->getColsFromTs(1, $PA['parameters']['checkCols']);
        if (!$cols) {
            $cols = 12;
        }

        // Get default viewport
        $viewports = explode(",", str_replace(' ', '', $this->getTs(1, 'defaultViewports')));
        $sizes = explode(",", str_replace(' ', '', $this->getTs(1, 'defaultSizes')));
        $offsets = explode(",", str_replace(' ', '', $this->getTs(1, 'defaultOffsets')));

        $configArr = array();
        foreach ($viewports as $key => $viewport) {
            $configArr[$viewport] = array(
                'viewport' => $viewport,
                'size' => $sizes[$key],
                'offset' => $offsets[$key],
            );
        }

        // Set options
        $this->options = array(
            'uid' => $PA['row']['uid'],
            'type' => $PA['parameters']['type'],
            'size' => $PA['parameters']['size'],
            'cols' => $cols,
        );

        if ($PA['parameters']['default']) {
            $this->options['default'] = $PA['parameters']['default'];
        } else if ($PA['parameters']['defaultTs']) {
            if ($PA['parameters']['type'] == 'col') {
                $defaultFromTs = $configArr[$this->options['size']]['size'];

                if ($defaultFromTs) {
                    if (in_array($this->options['size'], $viewports)) {
                        //$this->options['default'] = 'col-' . $this->options['size'] . '-' . $defaultFromTs;
                        $this->options['default'] = $defaultFromTs;
                    }
                } else {
                    if (in_array($this->options['size'], $viewports) && $configArr[$this->options['size']]['size']) {
                        $this->options['default'] = 'full';
                    }
                }
            } else if ($PA['parameters']['type'] == 'offset') {
                $defaultFromTs = $configArr[$this->options['size']]['offset'];

                if ($defaultFromTs) {
                    if (in_array($this->options['size'], $viewports)) {
                        //$this->options['default'] = 'col-' . $this->options['size'] . '-offset-' . $defaultFromTs;
                        $this->options['default'] = $defaultFromTs;
                    }
                } else {
                    if (in_array($this->options['size'], $viewports) && $configArr[$this->options['size']]['offset']) {
                        $this->options['default'] = '';
                    }
                }
            }
        }

        // Get default value / saved value
        $value = $this->getValue($PA);

        // Build items
        $items = $this->buildItems($this->options['type']);

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
            'itemFormElValue' => array($value),
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
     * Fluid setting
     *
     * @param array $PA
     * @param array $config
     * @return array
     */
    public function user_fluid($PA, $config)
    {
        // Get default value / saved value
        if ($this->getTs(1, 'defaultFluid') == 1 && strpos($PA['row']['uid'], 'NEW') !== false) {
            $value = 1;
        } else {
            $value = $PA['itemFormElValue'];
        }

        // Build select box
        $fieldConfig = array(
            'fieldConf' => array(
                'config' => array(
                    'type' => 'check',
                ),
            ),
            'onFocus' => '',
            'fieldChangeFunc' => array(
                'razor' => '',
            ),
            'label' => '',
            'itemFormElValue' => $value,
            'itemFormElName' => $PA['itemFormElName'],
            'itemFormElName_file' => $PA['itemFormElName_file'],
        );

        /** @var \TYPO3\CMS\Backend\Form\NodeFactory $nodeFactory */
        $nodeFactory = GeneralUtility::makeInstance('TYPO3\\CMS\\Backend\\Form\\NodeFactory');
        $options = array(
            'renderType' => 'check',
            'parameterArray' => $fieldConfig,
        );

        $checkboxResult = $nodeFactory->create($options)->render();

        return $checkboxResult['html'];
    }

    /**
     * Get value
     *
     * @param array $PA
     * @return string
     */
    private function getValue($PA)
    {
        if (isset($this->options['default']) && strpos($this->options['uid'], 'NEW') !== false) {

            // full, half, third, quarter
            $options = array("full", "half", "third", "quarter");

            if (in_array($this->options['default'], $options)) {
                switch ($this->options['default']) {
                    case "full":
                        $default = $this->getCol($this->options['cols']);
                        break;
                    case "half":
                        $default = $this->getCol(floor($this->options['cols'] / 2));
                        break;
                    case "third":
                        $default = $this->getCol(floor($this->options['cols'] / 3));
                        break;
                    case "quarter":
                        $default = $this->getCol(floor($this->options['cols'] / 4));
                        break;
                }
            } else {
                $default = $this->options['default'];
            }

            // Set default value
            if (strpos($this->options['uid'], 'NEW') === false) {
                $value = $PA['itemFormElValue'];
            } else {
                $value = $default;
            }
        } else {
            $value = $PA['itemFormElValue'];
        }

        return $value;
    }

    /**
     * Build select items
     *
     * @return array
     */
    private function buildItems()
    {
        $items[] = array(
            $GLOBALS['LANG']->sL($this->locallangPath . 'notDefined', true),
            '',
        );

        // Offset
        if ($this->options['type'] == 'offset') {
            $items[] = array(
                0 . '/' . $this->options['cols'],
                'noOffset',
            );
        }

        for ($i = 1; $i <= $this->options['cols']; $i++) {
            $items[] = array(
                $i . '/' . $this->options['cols'],
                //$this->getCol($i),
                $i,
            );
        }

        return $items;
    }

    /**
     * Get col
     *
     * @param string $cols
     * @return string
     */
    private function getCol($cols)
    {
/*        if ($this->options['type'] == 'col') {
$output = 'col-' . $this->options['size'] . '-' . $cols;
} else {
$output = 'col-' . $this->options['size'] . '-offset-' . $cols;
}*/

        $output = $cols;

        return $output;
    }

    /**
     * Get cols from TypoScript
     *
     * @param int $pageUid
     * @param bool $check
     * @return string
     */
    private function getColsFromTs($pageUid, $check = 0)
    {
        // Settings file with path
        $this->settingsFileWithPath = PATH_site . $this->directory . $this->settingsFile;

        if ($check) {
            $sysPageObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
            $rootLine = $sysPageObj->getRootLine($pageUid);
            $TSObj = GeneralUtility::makeInstance('TYPO3\CMS\Core\TypoScript\ExtendedTemplateService');
            $TSObj->tt_track = 0;
            $TSObj->init();
            $TSObj->runThroughTemplates($rootLine);
            $TSObj->generateConfig();

            $cols = $TSObj->setup['razor.']['bootstrap.']['cols'];

            // Create settings file
            $this->createSettingsFile();

            // Write to col.ini file
            $this->writeCols($cols);

            return $cols;
        } else {
            $cols = $this->getSettings($this->settingsFileWithPath);

            return $cols['cols'];
        }
    }

/**
 * Get cols from TypoScript
 *
 * @param int $pageUid
 * @param bool $check
 * @return string
 */
    private function getTs($pageUid, $var)
    {
        $sysPageObj = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
        $rootLine = $sysPageObj->getRootLine($pageUid);
        $TSObj = GeneralUtility::makeInstance('TYPO3\CMS\Core\TypoScript\ExtendedTemplateService');
        $TSObj->tt_track = 0;
        $TSObj->init();
        $TSObj->runThroughTemplates($rootLine);
        $TSObj->generateConfig();

        $out = $TSObj->setup['razor.']['bootstrap.'][$var];

        return $out;
    }

    /**
     * Create settings file
     *
     * @return void
     */
    private function createSettingsFile()
    {
        // Create folder if it doesn't exist
        if (!is_dir(PATH_site . $this->directory)) {
            GeneralUtility::mkdir(PATH_site . $this->directory);
        }

        // Create settings file if it doesn't exist
        if (!is_file($this->settingsFileWithPath)) {
            touch($this->settingsFileWithPath);
        }
    }

    /**
     * Set settings
     *
     * @param int $cols
     * @return void
     */
    private function writeCols($cols)
    {
        // Set settings
        $output = array(
            'cols' => $cols,
        );

        // Write file
        GeneralUtility::writeFile($this->settingsFileWithPath, serialize($output));
    }

    /**
     * Get settings
     *
     * @param string $settingsFileWithPath
     * @return array
     */
    public function getSettings($settingsFileWithPath)
    {
        // Get settings
        $settings = $this->getIncludeContents($settingsFileWithPath);

        return unserialize($settings);
    }

    /**
     * file_get_contents alternative
     *
     * @param string $filename
     * @return string if content, FALSE otherwise
     */
    public function getIncludeContents($filename)
    {
        if (is_file($filename)) {
            ob_start();
            include $filename;
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        return false;
    }

}
