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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Renders a link in an alert
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class ShareViewHelper extends AbstractViewHelper
{

    const FACEBOOK_URL = 'https://www.facebook.com/sharer/sharer.php?u=';

    const TWITTER_URL = 'https://twitter.com/intent/tweet/?url=';

    const GOOGLEPLUS_URL = 'https://plus.google.com/share?url=';

    const LINKEDIN_URL = 'https://www.linkedin.com/shareArticle?url=';

    const PINTEREST_URL = 'https://www.pinterest.com/pin/create/button/?url=';

    const XING_URL = 'https://www.xing.com/spi/shares/new?url=';

    const REDDIT_URL = 'http://www.reddit.com/submit/?url=';

    const DIGG_URL = 'http://www.digg.com/submit?url=';

    const TUMBLR_URL = 'http://www.tumblr.com/share/link?url=';

    const EVERNOTE_URL = 'http://www.evernote.com/clip.action?url=';

    const POCKET_URL = 'https://getpocket.com/save?url=';

    const BUFFER_URL = 'http://bufferapp.com/add?url=';

    const STUMBLEUPON_URL = 'http://www.stumbleupon.com/submit?url=';

    const EMAIL_URL = 'mailto:?subject=';

    /**
     * Initialize
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('all', 'boolean', '', false, false);
        $this->registerArgument('channels', 'array', '', false, false);
        $this->registerArgument('url', 'mixed', '', false, false);
        $this->registerArgument('as', 'string', '', true);
        $this->registerArgument('path', 'string', '', false, 'fileadmin/razor/Images/Icons/Social/');
        $this->registerArgument('type', 'string', '', false, 'png');
        $this->registerArgument('text', 'string', '', false);
        $this->registerArgument('subject', 'string', '', false);
        $this->registerArgument('body', 'string', '', false);
    }

    /**
     * This function renders a value with TypoScript
     *
     * @return string
     */
    public function render()
    {
        // Vars
        $all = $this->arguments['all'];
        $channels = $this->arguments['channels'];
        $url = $this->arguments['url'];
        $as = $this->arguments['as'];
        $path = $this->arguments['path'];
        $type = $this->arguments['type'];
        $text = $this->arguments['text'];
        $subject = $this->arguments['subject'];
        $body = $this->arguments['body'];

        // Define all available channels
        $allChannels = array(
            'facebook' => array(
                'url' => self::FACEBOOK_URL,
            ),
            'twitter' => array(
                'url' => self::TWITTER_URL,
                'params' => array(
                    'text' => $text,
                ),
            ),
            'google-plus' => array(
                'url' => self::GOOGLEPLUS_URL,
            ),
            'linkedin' => array(
                'url' => self::LINKEDIN_URL,
                'params' => array(
                    'title' => $text,
                ),
            ),
            'pinterest' => array(
                'url' => self::PINTEREST_URL,
                'params' => array(
                    'description' => $text,
                ),
            ),
            'xing' => array(
                'url' => self::XING_URL,
            ),
            'reddit' => array(
                'url' => self::REDDIT_URL,
                'params' => array(
                    'title' => $text,
                ),
            ),
            'digg' => array(
                'url' => self::DIGG_URL,
                'params' => array(
                    'title' => $text,
                ),
            ),
            'tumblr' => array(
                'url' => self::TUMBLR_URL,
                'params' => array(
                    'description' => $text,
                ),
            ),
            'evernote' => array(
                'url' => self::EVERNOTE_URL,
                'params' => array(
                    'title' => $text,
                ),
            ),
            'pocket' => array(
                'url' => self::POCKET_URL,
                'params' => array(
                    'title' => $text
                ),
            ),
            'buffer' => array(
                'url' => self::BUFFER_URL,
                'params' => array(
                    'text' => $text
                ),
            ),
            'stumble-upon' => array(
                'url' => self::STUMBLEUPON_URL,
                'params' => array(
                    'title' => $text
                ),
            ),
            'email' => array(
                'email' => true,
                'url' => self::EMAIL_URL,
                'subject' => $subject,
                'params' => array(
                    'body' => $body,
                )
            ),
        );

        // URL
        if (!$url) {
            $url = GeneralUtility::getIndpEnv('TYPO3_REQUEST_URL');
            if (0 !== strpos($url, GeneralUtility::getIndpEnv('TYPO3_SITE_URL'))) {
                $url = GeneralUtility::getIndpEnv('TYPO3_SITE_URL') . $url;
            }
        }

        // All channels
        if ($all) {
            $channels = array_keys($allChannels);
        }

        // Filter channels
        $filterChannels = array();
        foreach ($channels as $name) {
            if (array_key_exists($name, $allChannels)) {
                $channel = $allChannels[$name];

                // Traverse params
                $params = urlencode($url);
                $paramsEmail = $channel['subject'];
                if (is_array($channel['params'])) {
                    foreach ($channel['params'] as $paramKey => $paramVal) {
                        if ($paramVal) {
                            $params .= '&' . $paramKey . '=' . $paramVal;

                            if($channel['email']) {
                                $paramsEmail .= '&' . $paramKey . '=' . $paramVal;
                                $params = $paramsEmail;
                            }
                        }
                    }
                }

                // Build share url
                $shareUrl = trim($channel['url'] . $params);
                if($channel['email']) {
                    $target = '_top';
                }
                else {
                    $target = '_blank';
                }

                $filterChannels[] = array(
                    'name' => $name,
                    'url' => $shareUrl,
                    'path' => $path,
                    'type' => $type,
                    'target' => $target
                );
            }
        }

        // Assign template var
        $this->templateVariableContainer->add($as, $filterChannels);
        $output = $this->renderChildren();
        $this->templateVariableContainer->remove($as);

        return $output;
    }

}
