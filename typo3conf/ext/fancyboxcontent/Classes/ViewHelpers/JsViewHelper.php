<?php
namespace RZ\Fancyboxcontent\ViewHelpers;

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
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 * @package Fancyboxcontent
 * @subpackage ViewHelpers
 */
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

class JsViewHelper extends AbstractViewHelper
{

    /**
     * Add JS
     *
     * @param string $uid The uid
     * @param string $settings The settings
     * @param string $addToFooter The addToFooter
     * @param string $labels The labels
     * @return string
     */
    public function render($uid, $settings, $addToFooter, $labels)
    {
        // Filter settings
        $settings = $this->filterSettings($settings);

        // Build JS
        $this->buildJs($uid, $addToFooter, $settings, $labels);
    }

    private function buildJs($uid, $addToFooter, $settings, $labels)
    {
        $fbSettings = '';
        foreach ($settings as $key => $val) {
            if ($key == 'loop' || $key == 'infobar' || $key == 'buttons' || $key == 'slideShow' || $key == 'fullScreen' || $key == 'thumbs' || $key == 'closeBtn' || $key == 'touch' || $key == 'keyboard' || $key == 'focus' || $key == 'closeClickOutside') {
                if ($val == 1) {
                    $val = 'true';
                } else {
                    $val = 'false';
                }
            }

            if ($key == 'opacity' || $key == 'smallBtn') {
                $val = "'".$val."'";
            }

            if ($val) {
                $fbSettings .= $key . ':' . $val . ',';
            }
        }

        // Remove last comma
        $fbSettings = substr($fbSettings, 0, -1);

        $template = "
            ,baseTpl : '<div class=\"fancybox-container\" role=\"dialog\" tabindex=\"-1\">' +
                '<div class=\"fancybox-bg\"></div>' +
                '<div class=\"fancybox-controls\">' +
                    '<div class=\"fancybox-infobar\">' +
                        '<button data-fancybox-previous class=\"fancybox-button fancybox-button--left\" title=\"Previous\"></button>' +
                        '<div class=\"fancybox-infobar__body\">' +
                            '<span class=\"js-fancybox-index\"></span>&nbsp;/&nbsp;<span class=\"js-fancybox-count\"></span>' +
                        '</div>' +
                        '<button data-fancybox-next class=\"fancybox-button fancybox-button--right\" title=\"Next\"></button>' +
                    '</div>' +
                    '<div class=\"fancybox-buttons\">' +
                        '<button data-fancybox-close class=\"fancybox-button fancybox-button--close\" title=\"Bra\"></button>' +
                    '</div>' +
                '</div>' +
                '<div class=\"fancybox-slider-wrap\">' +
                    '<div class=\"fancybox-slider\"></div>' +
                '</div>' +
                '<div class=\"fancybox-caption-wrap\"><div class=\"fancybox-caption\"></div></div>' +
            '</div>',
        ";

        $js = '
            <script type=\"text/javascript\">
                $(".fancyboxcontent-' . $uid . ').fancybox({
                    ' . $fbSettings . ', ' . $template . '
                });
            </script>
        ';

        // Output JS to footer
        if ($addToFooter) {
            //$GLOBALS['TSFE']->additionalFooterData['fancyboxcontent_' . $uid] = $js;

            // Dependency: fancyboxcontent - check if razor is installed

            \FluidTYPO3\Vhs\Asset::createFromSettings(array(
                'name' => 'fancyboxcontent-'.$uid,
                'path' => 'typo3conf/ext/fancyboxcontent/Resources/Public/Js/fancyboxcontent.js',
                'fluid' => 1,
                'dependencies' => 'razorMainJs',
                'variables' => array(
                    'uid' => $uid,
                    'settings' => $fbSettings,
                    'prev' => $labels['prev'],
                    'next' => $labels['next'],
                    'close' => $labels['close']
                )
            ));
        } else {
            $GLOBALS['TSFE']->additionalHeaderData['fancyboxcontent_' . $uid] = $js;
        }
    }

    private function filterSettings($settings)
    {
        unset($settings['addJquery']);
        unset($settings['addToFooter']);
        unset($settings['addFancybox']);
        unset($settings['link']);
        unset($settings['linkType']);
        unset($settings['linkClass']);
        unset($settings['ce']);
        unset($settings['linkTitle']);
        unset($settings['linkImage']);
        unset($settings['linkMedia']);
        unset($settings['html']);
        unset($settings['type']);

        return $settings;
    }

}
