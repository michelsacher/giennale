<?php

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl'] = array(
    '_DEFAULT' => array(
        'init' => array(
            'enableCHashCache' => true,
            'appendMissingSlash' => 'ifNotFile,redirect[301]',
            'enableUrlDecodeCache' => true,
            'enableUrlEncodeCache' => true,
            'emptyUrlReturnValue' => \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_SITE_URL'),
            'postVarSet_failureMode' => '',
            'doNotRawUrlEncodeParameterNames' => true,
        ),
        'pagePath' => array(
            'type' => 'user',
            'userFunc' => 'EXT:realurl/class.tx_realurl_advanced.php:&tx_realurl_advanced->main',
            'spaceCharacter' => '-',
            'languageGetVar' => 'L',
            'expireDays' => 365,
        ),
        'redirects' => array(),
        'preVars' => array(
            '0' => array(
                'GETvar' => 'no_cache',
                'valueMap' => array(
                    'nc' => '1',
                ),
                'noMatch' => 'bypass',
            ),
            '1' => array(
                'GETvar' => 'L',
                'valueMap' => array(
                    //'en' => '1'
                ),
                'noMatch' => 'bypass',
            ),
        ),

        'fixedPostVars' => array(
            '_DEFAULT' => array(
                array(
                    'GETvar' => 'tx_indexedsearch_pi2[action]',
                    'valueMap' => array(
                        's' => 'search',
                    ),
                    'noMatch' => 'bypass',
                ),
                array(
                    'GETvar' => 'tx_indexedsearch_pi2[controller]',
                    'valueMap' => array(
                        's' => 'search',
                    ),
                    'noMatch' => 'bypass',
                ),
            ),
        ),
        'postVarSets' => array(
            '_DEFAULT' => array(
                'page' => array(
                    0 => array(
                        'GETvar' => 'page',
                    ),
                ),

                // EXT:rzmailchimp start
                'mailchimp' => array(
                    array(
                        'GETvar' => 'tx_rzmailchimp_mailchimp[action]',
                        'noMatch' => 'bypass',
                    ),
                    array(
                        'GETvar' => 'tx_rzmailchimp_mailchimp[controller]',
                        'noMatch' => 'bypass',
                    ),
                ),
                // EXT:rzmailchimp end

                // EXT:news start
                's' => array(
                    array(
                        'GETvar' => 'tx_news_pi1[@widget_0][currentPage]',
                        //'noMatch' => 'bypass'
                    ),
                ),
                'd' => array(
                    array(
                        'GETvar' => 'tx_news_pi1[overwriteDemand][year]',
                    ),
                    array(
                        'GETvar' => 'tx_news_pi1[overwriteDemand][month]',
                    ),
                ),
                'news' => array(
                    array(
                        'GETvar' => 'tx_news_pi1[action]',
                        'noMatch' => 'bypass',
                    ),
                    array(
                        'GETvar' => 'tx_news_pi1[controller]',
                        'noMatch' => 'bypass',
                    ),
                    array(
                        'GETvar' => 'tx_news_pi1[news]',
                        'lookUpTable' => array(
                            'table' => 'tx_news_domain_model_news',
                            'id_field' => 'uid',
                            'alias_field' => 'IF(path_segment!="",path_segment,title)',
                            'addWhereClause' => ' AND NOT deleted',
                            'useUniqueCache' => 1,
                            'useUniqueCache_conf' => array(
                                'strtolower' => 1,
                                'spaceCharacter' => '-',
                            ),
                            'enable404forInvalidAlias' => '1',
                            'languageGetVar' => 'L',
                            'languageExceptionUids' => '',
                            'languageField' => 'sys_language_uid',
                            'transOrigPointerField' => 'l10n_parent',
                            'autoUpdate' => 1,
                            'expireDays' => 365,
                        ),
                    ),
                ),
                // EXT:news end
            ),
        ),
        'fileName' => array(
            'defaultToHTMLsuffixOnPrev' => false,
            'index' => array(
                'feed.rss' => array(
                    'keyValues' => array(
                        'type' => 9818,
                    ),
                ),
                'sitemap.xml' => array(
                    'keyValues' => array(
                        'type' => 841132,
                        'page' => 1,
                    ),
                ),
                'sitemap.txt' => array(
                    'keyValues' => array(
                        'type' => 841131,
                    ),
                ),
                'robots.txt' => array(
                    'keyValues' => array(
                        'type' => 841133,
                    ),
                ),
            ),
        ),
    ),
);
