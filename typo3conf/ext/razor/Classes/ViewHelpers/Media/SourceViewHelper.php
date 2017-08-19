<?php
namespace RZ\Razor\ViewHelpers\Media;

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

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Source
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class SourceViewHelper extends AbstractTagBasedViewHelper
{
    const SCOPE = 'RZ\Razor\ViewHelpers\Media\PictureViewHelper';
    const SCOPE_VARIABLE_SRC = 'src';
    const SCOPE_VARIABLE_RATIOS = 'additionalRatios';

    /**
     * @var ContentObjectRenderer
     */
    protected $contentObject;

    /**
     * @var ConfigurationManagerInterface
     */
    protected $configurationManager;

    /**
     * name of the tag to be created by this view helper
     *
     * @var string
     * @api
     */
    protected $tagName = 'source';

    /**
     * @param ConfigurationManagerInterface $configurationManager
     * @return void
     */
    public function injectConfigurationManager(ConfigurationManagerInterface $configurationManager)
    {
        $this->configurationManager = $configurationManager;
        $this->contentObject = $this->configurationManager->getContentObject();
    }

    /**
     * Initialize arguments.
     *
     * @return void
     * @api
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('width', 'integer', 'Path to the image.');
        $this->registerArgument('height', 'integer', 'Text for the alt attribute.');
        $this->registerArgument('media', 'string', 'Text for the title attribute.');
    }

    /**
     * Render method
     * @return string
     */
    public function render()
    {
        $additionalRatios = $this->viewHelperVariableContainer->get(self::SCOPE, self::SCOPE_VARIABLE_RATIOS);

        // Default ratio 1x
        $srcSet[1] = $this->ratio(1);

        if ($additionalRatios) {
            $additionalRatios = explode(',', $additionalRatios);

            foreach ($additionalRatios as $ratio) {
                $srcSet[$ratio] = $this->ratio($ratio);
            }
        }

        $numItems = count($srcSet);
        $content = '';
        $i = 0;
        foreach ($srcSet as $rat => $set) {
            $content .= $set . ' ' . $rat . 'x';

            if (++$i !== $numItems) {
                $content .= ",\r\n";
            }
        }

        $this->tag->addAttribute('srcset', $content);

        if (false === empty($this->arguments['media'])) {
            $this->tag->addAttribute('media', $this->arguments['media']);
        }

        return $this->tag->render();
    }

    /**
     * Ratio method
     *
     * @var integer $ratio
     * @return string
     */
    private function ratio($ratio)
    {
        // Src
        $src = $this->viewHelperVariableContainer->get(self::SCOPE, self::SCOPE_VARIABLE_SRC);

        // Width / Height
        $dimensions = array(
            'width' => $this->arguments['width'],
            'height' => $this->arguments['height'],
        );

        $setup = array();
        foreach ($dimensions as $key => $d) {
            $crop = '';
            if (strpos($d, 'c') !== false) {
                $d = substr($d, 0, -1);
                $crop = 'c';
            }

            $setup[$key] = $d * $ratio . $crop;
        }

        // Build image
        $result = $this->contentObject->getImgResource($src, $setup);

        // Output image
        $srcSet = $result[3];

        return $srcSet;
    }
}
