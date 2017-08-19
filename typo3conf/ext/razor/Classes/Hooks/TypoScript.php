<?php
namespace RZ\Razor\Hooks;

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
 * Inject TypoScript based on extension configuration
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class TypoScript
{

    /**
     * Inject TypoScript
     *
     * @param array $params
     * @param \TYPO3\CMS\Core\TypoScript\ExtendedTemplateService $parentObject
     * @return void
     */
    public function main(array $params, \TYPO3\CMS\Core\TypoScript\TemplateService $parentObject)
    {
        if ($params['templateId'] == 'ext_razor') {
            // Define template
            $templateRecord = array(
                'constants' => '',
                'config' => '',
                'editorcfg' => '',
                'include_static' => '',
                'include_static_file' => '',
                'title' => '',
                'uid' => '',
            );

            // Get extension configuration
            $extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

            // Multiple local domains
            if ($extConf['basedomain_local_additional']) {
                $templateRecord['config'] .= $this->buildDomainTs($extConf['basedomain_local_additional']);
            }

            // Multiple live domains
            if ($extConf['basedomain_live_additional']) {
                $templateRecord['config'] .= $this->buildDomainTs($extConf['basedomain_live_additional']);
            }

            // Inject TypoScript
            $parentObject->processTemplate($templateRecord, $params['idList'], $params['pid'], $params['idList'], $params['templateId']);
        }
    }

    private function buildDomainTs($domains) {
        $domains = explode(",", $domains);

        $ts = '';
        foreach ($domains as $domain) {
            $domain = trim($domain);
            $domain = rtrim($domain, '/');
            $domain = $domain . '/';
            if (strrpos($domain, 'http') === false) {
                $domain = 'http://' . $domain;
            }

            $domainWww = str_replace(array('http://', 'https://'), '', $domain);
            $domainWww = rtrim($domainWww, '/');

            $ts .= '
                [globalVar = IENV:HTTP_HOST = ' . $domainWww . ']

                config.baseURL = ' . $domain . '

                [global]

                [globalVar = IENV:HTTP_HOST = ' . $domainWww . '] AND [globalVar = TSFE:type = 9818]

                config.absRefPrefix = ' . $domain . '

                [global]
            ';
        }

        return $ts;
    }

}
