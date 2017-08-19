<?php
namespace RZ\Razor\Hooks\Frontend;

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
 * Class to render some page related things
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class PageRenderer
{
    /** Contains the temporary directories of this extension. */
    protected $tempDirectories = array();

    /** Initializes some class variables... */
    public function __construct()
    {
        $this->tempDirectories = array(
            'main' => PATH_site . 'typo3temp/razor/',
            'cache' => PATH_site . 'typo3temp/razor/Temp/',
        );
    }

    /**
     * This function iterates over the arrays and rebuild them to keep the order, as keynames may change.
     *
     * @param array $params
     * @param \TYPO3\CMS\Core\Page\PageRenderer $pagerenderer
     * @return void
     */
    public function execute(&$params, &$pagerenderer)
    {
        $this->start();
    }

    public function start()
    {
        // Create temp dirs
        $this->createTempDirs();

        // Padding
        $this->padding();

        // Color
        $this->color();

        // Merge temp files
        $this->mergeFiles();
    }

    /**
     * Create temp directories
     *
     * @return void
     */
    private function createTempDirs()
    {
        foreach ($this->tempDirectories as $directory) {
            if (!is_dir($directory)) {
                GeneralUtility::mkdir($directory);
            }
        }
    }

    /**
     * Padding
     *
     * @param int $compress
     * @return void
     */
    private function padding($compress = 1)
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $paddingRepository = $this->objectManager->get('RZ\\Razor\\Domain\\Repository\\PaddingRepository');

        $resPadding = $paddingRepository->findAllWithoutPidRestriction();

        foreach ($resPadding as $paddingObj) {
            $size = trim($paddingObj->getSize());

            $css .= '
      ' . $this->sanitizeClassName($paddingObj->getTitle(), 'razor--padding-top-') . ' {
        padding-top: ' . $size . 'rem;
      }

      ' . $this->sanitizeClassName($paddingObj->getTitle(), 'razor--padding-bottom-') . ' {
        padding-bottom: ' . $size . 'rem;
      }

      ' . $this->sanitizeClassName($paddingObj->getTitle(), 'razor--margin-top-') . ' {
        margin-top: ' . $size . 'rem;
      }

      ' . $this->sanitizeClassName($paddingObj->getTitle(), 'razor--margin-bottom-') . ' {
        margin-bottom: ' . $size . 'rem;
      }
      ';
        }

        // Compress CSS
        if ($compress == 1) {
            $css = $this->compress($css);
        }

        $this->buildCacheFile('padding', $css);
    }

    /**
     * Color
     *
     * @param int $compress
     * @return void
     */
    private function color($compress = 1)
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        $colorRepository = $this->objectManager->get('RZ\\Razor\\Domain\\Repository\\ColorRepository');

        $resColor = $colorRepository->findAllWithoutPidRestriction();

        foreach ($resColor as $colorObj) {
            // Get color
            $color = $colorObj->getColor();
            if (!$color) {
                $color = 'inherit';
            }

            // Get additional CSS
            $additionalCssFinal = '';
            $additionalCss = $colorObj->getCss();
            if ($additionalCss) {
                $additionalCssFinal = $additionalCss;
            }

            $css .= '
      ' . $this->sanitizeClassName($colorObj->getValue(), 'razor--wrap-') . ' {
        background: ' . $color . ';
        ' . $additionalCssFinal . '
      }

      ' . $this->sanitizeClassName($colorObj->getValue(), 'razor--section-') . ' {
        background: ' . $color . ';
        ' . $additionalCssFinal . '
      }

      ' . $this->sanitizeClassName($colorObj->getValue(), 'well--razor-') . ' {
        background: ' . $color . ';
        ' . $additionalCssFinal . '
      }

      ' . $this->sanitizeClassName($colorObj->getValue(), 'razor--icon-') . ' {
        color: ' . $color . ';
      }

      ' . $this->sanitizeClassName($colorObj->getValue(), 'razor--hr-color--') . ' {
        border-top: .1rem solid ' . $color . ';
      }
      ';
        }

        // Compress CSS
        if ($compress == 1) {
            $css = $this->compress($css);
        }

        $this->buildCacheFile('color', $css);
    }

    /**
     * Build cache file
     *
     * @param string $prefix
     * @param string $css
     * @return void
     */
    private function buildCacheFile($prefix, $css)
    {
        // Write temp file
        $cacheFile = $this->tempDirectories['cache'] . $prefix . '.razor';

        if (!file_exists($cacheFile)) {
            GeneralUtility::writeFile($cacheFile, $css);
        }
    }

    /**
     * Compress
     *
     * @param string $css
     * @return string
     */
    private function compress($css)
    {
        $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(array(
            "\r\n",
            "\r",
            "\n",
            "\t",
            '  ',
            '    ',
            '    ',
        ), '', $css);

        return $css;
    }

    /**
     * Sanitize class name
     *
     * @param string $name
     * @param string $prefix
     * @return string
     */
    private function sanitizeClassName($name, $prefix)
    {
        // Trim values
        $name = trim(strtolower($name));
        $name = str_replace(array(".", "#"), "-", $name);
        $prefix = trim($prefix);

        return '.' . $prefix . $name;
    }

    /**
     * Merge files
     *
     * @return void
     */
    private function mergeFiles()
    {
        $path = PATH_site . 'typo3temp/razor/';
        $filename = 'razor.css';

        // Check if file exists
        if (file_exists($path . $file)) {
            $fileSize = filesize($path . $filename);
        }

        if (!file_exists($path . $file) || $fileSize == 0) {
            $filepathsArray = glob($path . 'Temp/*.razor');
            $filepath = $path . $filename;

            $out = fopen($filepath, "w");

            foreach ($filepathsArray as $file) {
                $in = fopen($file, "r");
                while ($line = fgets($in)) {
                    fwrite($out, $line);
                }
                fclose($in);
            }

            fclose($out);
        }
    }

}
