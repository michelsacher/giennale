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
use TYPO3\CMS\Fluid\Core\ViewHelper\TagBuilder;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Picture
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class PictureViewHelper extends AbstractTagBasedViewHelper
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
    protected $tagName = 'picture';

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
        $this->registerArgument('src', 'string', 'Path to the image.', true);
        $this->registerArgument('alt', 'string', 'Text for the alt attribute.');
        $this->registerArgument('title', 'string', 'Text for the title attribute.');
        $this->registerArgument('class', 'string', 'CSS classes');
        $this->registerArgument('imageClass', 'string', 'CSS classes for images');
        $this->registerArgument('additionalRatios', 'string', 'Additional ratios');
        $this->registerArgument('width', 'integer', 'Path to the image.');
        $this->registerArgument('height', 'integer', 'Text for the alt attribute.');
    }

    /**
     * Render method
     * @return string
     */
    public function render()
    {
        $src = $this->arguments['src'];
        $additionalRatios = $this->arguments['additionalRatios'];

        $this->viewHelperVariableContainer->addOrUpdate(self::SCOPE, self::SCOPE_VARIABLE_SRC, $src);
        $this->viewHelperVariableContainer->addOrUpdate(self::SCOPE, self::SCOPE_VARIABLE_RATIOS, $additionalRatios);
        $content = $this->renderChildren();
        $this->viewHelperVariableContainer->remove(self::SCOPE, self::SCOPE_VARIABLE_SRC);
        $this->viewHelperVariableContainer->remove(self::SCOPE, self::SCOPE_VARIABLE_RATIOS);

        // Default image
        $setup = [
            'width' => $this->arguments['width'],
            'height' => $this->arguments['height'],
        ];

        $result = $this->contentObject->getImgResource($src, $setup);

        $image = new TagBuilder('img');
        $image->addAttribute('src', $result[3]);

        if (false === empty($this->arguments['alt'])) {
            $image->addAttribute('alt', $this->arguments['alt']);
        }

        if (false === empty($this->arguments['title'])) {
            $image->addAttribute('title', $this->arguments['title']);
        }

        if (false === empty($this->arguments['imageClass'])) {
            $image->addAttribute('class', $this->arguments['imageClass']);
        }

        $content .= $image->render();

        if (false === empty($this->arguments['class'])) {
            $this->tag->addAttribute('class', $this->arguments['class']);
        }

        $this->tag->setContent($content);

        return $this->tag->render();
    }
}
