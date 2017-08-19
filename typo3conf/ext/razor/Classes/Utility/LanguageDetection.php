<?php
namespace RZ\Razor\Utility;

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
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\Plugin\AbstractPlugin;

class LanguageDetection extends AbstractPlugin
{

    /**
     * @var boolean
     */
    private $debug = false;

    /**
     * @var string
     */
    public $extKey = 'razor';

    /**
     * @var array
     */
    public $conf = array();

    public function main($content, $conf)
    {
        $this->conf = $conf;

        // If user has already been redirected once, don't redirect again
        if ($GLOBALS["TSFE"]->fe_user->getKey("ses", "redirectCookie") === true) {
            return false;
        }

        $sysLanguageUidToSysLanguageCode = $this->conf['sysLanguageUidToSysLanguageCode.']; // array
        if ($this->debug) {
            DebuggerUtility::var_dump($sysLanguageUidToSysLanguageCode, '$sysLanguageUidToSysLanguageCode');
        }
        $defaultRedirectLanguage = $this->conf['defaultRedirectLanguage']; // language uid
        if ($this->debug) {
            DebuggerUtility::var_dump($defaultRedirectLanguage, '$defaultRedirectLanguage');
        }
        $languageCodeToLanguageUid = $this->conf['languageCodeToLanguageUid.']; // array
        if ($this->debug) {
            DebuggerUtility::var_dump($languageCodeToLanguageUid, '$languageCodeToLanguageUid');
        }

        $referrer = (string) GeneralUtility::getIndpEnv('HTTP_REFERER');
        $t3Url = GeneralUtility::getIndpEnv('TYPO3_SITE_URL');

        $actualLanguageUid = $GLOBALS['TSFE']->sys_language_uid;

        $actualLanguageCode = $sysLanguageUidToSysLanguageCode[$actualLanguageUid];
        $actualPageUid = $GLOBALS['TSFE']->id;

        $userLanguageUid = -1;
        $userLanguageCode = $this->getUserLanguage();

        // fix $userLanguageUid
        if (empty($userLanguageCode)) {
            $userLanguageUid = $defaultRedirectLanguage;
        } else if (isset($languageCodeToLanguageUid[$userLanguageCode])) {
            $userLanguageUid = $languageCodeToLanguageUid[$userLanguageCode];
        } else if (!in_array($userLanguageCode, $sysLanguageUidToSysLanguageCode)) {
            $userLanguageUid = $defaultRedirectLanguage;
        } else {
            $userLanguageUid = array_search($userLanguageCode, $sysLanguageUidToSysLanguageCode);
        }
        // fix end

        $userLanguageCode = $sysLanguageUidToSysLanguageCode[$userLanguageUid];

        if ($this->debug) {
            DebuggerUtility::var_dump($actualLanguageUid, '$actualLanguageUid');
            DebuggerUtility::var_dump($actualLanguageCode, '$actualLanguageCode');
            DebuggerUtility::var_dump($userLanguageCode, '$userLanguageCode');
            DebuggerUtility::var_dump($userLanguageUid, '$userLanguageUid');
            DebuggerUtility::var_dump($referrer, '$referrer');
        }

        // no redirect
        if (stripos($referrer, $t3Url) !== false || $actualLanguageCode == $userLanguageCode || $this->isBot()) {
            return $content;
        }
        // redirect
        else {
            if (isset($sysLanguageUidToSysLanguageCode[$defaultRedirectLanguage])) {
                $queryString = GeneralUtility::trimExplode('&', GeneralUtility::getIndpEnv('QUERY_STRING'));
                $queryStringCleaned = array();

                foreach ($queryString as $part) {
                    if (strpos($part, 'L=') === false) {
                        $queryStringCleaned[] = $part;
                    }
                }

                $queryStringCleaned = implode('&', $queryStringCleaned);

                $link = $GLOBALS['TSFE']->tmpl->linkData($GLOBALS['TSFE']->page, '', 0, '', array(), '&L=' . $userLanguageUid . '&' . $queryStringCleaned);
                //$totalUrl = (strlen($GLOBALS['TSFE']->baseUrl) > 1 ? $GLOBALS['TSFE']->baseURLWrap(substr($link['totalURL'], 1)) : GeneralUtility::locationHeaderUrl($link['totalURL']));
                $totalUrl = GeneralUtility::locationHeaderUrl($link['totalURL']);

                if ($this->debug) {
                    DebuggerUtility::var_dump($link, 'redirect link');
                    DebuggerUtility::var_dump($totalUrl, 'redirect totalURL');
                } else {
                    // Write session cookie after first redirect
                    $GLOBALS["TSFE"]->fe_user->setKey("ses", "redirectCookie", true);

                    header('Location: ' . $totalUrl);
                    header('Connection: close');
                    header('X-Note: Redirected by razor (' . $referrer . ')');
                }
            } else {
                if (TYPO3_DLOG) {
                    GeneralUtility::devLog('Default redirect language is not available in system languages.', $this->extKey);
                }
            }
        }
    }

    private function getUserLanguage()
    {
        $httpAcceptLanguages = GeneralUtility::trimExplode(',', GeneralUtility::getIndpEnv('HTTP_ACCEPT_LANGUAGE'));
        $acceptedLanguages = array();

        foreach ($httpAcceptLanguages as $httpAcceptLanguage) {
            list($languageCode, $languageQuality) = GeneralUtility::trimExplode(';', $httpAcceptLanguage);
            $acceptedLanguages[$languageCode] = ($languageQuality ? (float) substr($languageQuality, 2) : (float) 1);
        }

        if (count($acceptedLanguages)) {
            arsort($acceptedLanguages);

            if ($this->debug) {
                DebuggerUtility::var_dump($acceptedLanguages, '$acceptedLanguages');
            }

            // return language code with highest quality
            return substr(current(array_keys($acceptedLanguages)), 0, 2);
        } else {
            if (TYPO3_DLOG) {
                GeneralUtility::devLog('No user language available.', $this->extKey);
            }

            return '';
        }
    }

    protected function isBot()
    {
        // Define bots
        $bots = array(
            "facebookexternalhit/",
            "facebot",
            "xing-feedintegration",
            "xing-contenttabreceiver",
            "linkedinbot/",
            "twitterbot",
            "archiver",
            "exabot",
            "fast",
            "firefly",
            "googlebot",
            "msnbot",
            "architextspider",
            "scooter",
            "lycos_spider",
            "slurp",
            "nagios",
            "robot",
            "crawl",
            "gigabot",
            "echo!",
            "baiduspider",
            "askjeeves",
            "turnitin",
            "speedyspider",
            "bot/",
            "bot-",
            "psbot",
            "thepythonrobot",
            "voila",
            "bspider",
            "surveybot",
            "grub.org",
            "alexa",
            "arks",
            "spider",
            "yandex",
            "holmes",
            "007ac9 crawler",
            "008\/",
            "360spider",
            "a6-indexer",
            "abachobot",
            "abilogicbot",
            "aboundex",
            "accoona-ai-agent",
            "acoon",
            "addsugarspiderbot",
            "addthis",
            "adidxbot",
            "admantx",
            "advbot",
            "ahrefsbot",
            "aihitbot",
            "airmail",
            "aisearchbot",
            "anemone",
            "antibot",
            "anyapexbot",
            "applebot",
            "arabot",
            "arachmo",
            "archive-com",
            "archive.org_bot",
            "b-l-i-t-z-b-o-t",
            "backlinkcrawler",
            "becomebot",
            "beslistbot",
            "bibnum\.bnf",
            "biglotron",
            "billybobbot",
            "bimbot",
            "bingbot",
            "binlar",
            "blekkobot",
            "blexbot",
            "blitzbot",
            "bl\.uk_lddc_bot",
            "bnf\.fr_bot",
            "boitho\.com-dc",
            "boitho\.com-robot",
            "brainobot",
            "btbot",
            "bubing",
            "butterfly\/",
            "buzzbot",
            "careerbot",
            "catchbot",
            "cc metadata scaper",
            "ccbot",
            "cerberian drtrs",
            "changedetection",
            "charlotte",
            "cloudflare-alwaysonline",
            "citeseerxbot",
            "coccoc",
            "classbot",
            "commons-httpclient",
            "content crawler spider",
            "content crawler",
            "convera",
            "converacrawler",
            "copubbot",
            "cosmos",
            "covario-ids",
            "crawlbot",
            "crawler4j",
            "crystalsemanticsbot",
            "curl",
            "cxensebot",
            "cyberpatrol",
            "dataparksearch",
            "dataprovider",
            "diamondbot",
            "digg",
            "discobot",
            "domainappender",
            "domaincrawler",
            "domain re-animator bot",
            "dotbot",
            "drupact",
            "duckduckbot",
            "earthcom",
            "easouspider",
            "ec2linkfinder",
            "edisterbot",
            "electricmonk",
            "elisabot",
            "emailmarketingrobot",
            "emeraldshield\.com webbot",
            "envolk\[its\]spider",
            "esperanzabot",
            "europarchive\.org",
            "ezooms",
            "facebookexternalhit",
            "fast enteprise crawler",
            "fast enterprise crawler",
            "fast-webcrawler",
            "fdse robot",
            "feedfetcher-google",
            "findlinks",
            "findlink",
            "findthatfile",
            "findxbot",
            "flamingo_searchengine",
            "fluffy",
            "fr-crawler",
            "frcrawler",
            "furlbot",
            "fyberspider",
            "g00g1e\.net",
            "gigablastopensource",
            "grub-client",
            "g2crawler",
            "gaisbot",
            "galaxybot",
            "geniebot",
            "genieo",
            "germcrawler",
            "gingercrawler",
            "girafabot",
            "gluten free crawler",
            "gnam gnam spider",
            "googlebot-image",
            "googlebot-mobile",
            "grapeshotcrawler",
            "gslfbot",
            "gurujibot",
            "happyfunbot",
            "healthbot",
            "heritrix",
            "hl_ftien_spider",
            "htdig",
            "httpunit",
            "httrack",
            "ia_archiver",
            "iaskspider",
            "iccrawler",
            "ichiro",
            "igdespyder",
            "iisbot",
            "inagist",
            "infowizards reciprocal link system pro",
            "insitesbot",
            "integromedb",
            "intelium_bot",
            "interfaxscanbot",
            "iodc",
            "ioi",
            "ip-web-crawler\.com",
            "ips-agent",
            "irlbot",
            "issuecrawler",
            "istellabot",
            "it2media-domain-crawler",
            "izsearch",
            "jaxified bot",
            "joc web spider",
            "jyxobot",
            "koepabot",
            "l\.webis",
            "lapozzbot",
            "larbin",
            "lb-spider",
            "ldspider",
            "lexxebot",
            "libwww",
            "linguee bot",
            "link valet",
            "linkdex",
            "linkexaminer",
            "linksmanager\.com_bot",
            "linkpadbot",
            "linkscrawler",
            "linkwalker",
            "lipperhey link explorer",
            "lipperhey seo service",
            "livelapbot",
            "lmspider",
            "lssbot",
            "lssrocketcrawler",
            "ltx71",
            "lufsbot",
            "lwp-trivial",
            "mail\.ru_bot",
            "megaindex\.ru",
            "mabontland",
            "magpie-crawler",
            "mediapartners-google",
            "memorybot",
            "metauri",
            "mj12bot",
            "mlbot",
            "mnogosearch",
            "mogimogi",
            "mojeekbot",
            "moreoverbot",
            "morning paper",
            "mrcgiguy",
            "msiecrawler",
            "msrbot",
            "mvaclient",
            "mxbot",
            "nerdbynature\.bot",
            "nerdybot",
            "netestate ne crawler",
            "netresearchserver",
            "netseer crawler",
            "newsgator",
            "nextgensearchbot",
            "ng-search",
            "ngbot",
            "nicebot",
            "niki-bot",
            "notifixious",
            "noxtrumbot",
            "nusearch spider",
            "nutch",
            "nutchcvs",
            "nymesis",
            "obot",
            "oegp",
            "ocrawler",
            "omgilibot",
            "omniexplorer_bot",
            "online link validator",
            "online website link checker",
            "oozbot",
            "openindexspider",
            "openwebspider",
            "orangebot",
            "orbiter",
            "ow\.ly",
            "paperlibot",
            "pingdom\.com_bot",
            "ploetz \+ zeller",
            "page2rss",
            "pagebiteshyperbot",
            "panscient",
            "peew",
            "percolatecrawler",
            "phpcrawl",
            "pizilla",
            "plukkie",
            "polybot",
            "pompos",
            "postpost",
            "postrank",
            "proximic",
            "purebot",
            "pycurl",
            "python-requests",
            "python-urllib",
            "qseero",
            "queryseekerspider",
            "qwantify",
            "radian6",
            "rampybot",
            "rel link checker",
            "retrevopageanalyzer",
            "riddler",
            "robosourcer",
            "rogerbot",
            "rufusbot",
            "sandcrawler",
            "sbider",
            "scoutjet",
            "scrapy",
            "screenerbot",
            "scribdbot",
            "scrubby",
            "searchmetricsbot",
            "searchsight",
            "seekbot",
            "semanticdiscovery",
            "semrushbot",
            "sensis web crawler",
            "seochat::bot",
            "seokicks-robot",
            "seostats",
            "seznam screenshot-generator",
            "seznambot",
            "shim-crawler",
            "shopwiki",
            "shoula robot",
            "showyoubot",
            "simplecrawler",
            "sistrix crawler",
            "sitebar",
            "sitebot",
            "siteexplorer\.info",
            "sklikbot",
            "slider\.com",
            "smtbot",
            "snappy",
            "sogou spider",
            "sogou",
            "sosospider",
            "spbot",
            "speedy spider",
            "speedy",
            "spiderman",
            "sqworm",
            "ssl-crawler",
            "stackrambler",
            "suggybot",
            "summify",
            "surdotlybot",
            "synoobot",
            "tagoobot",
            "teoma",
            "terrawizbot",
            "thesubot",
            "thumbnail\.cz robot",
            "tineye",
            "toplistbot",
            "trendictionbot",
            "truebot",
            "truwogps",
            "turnitinbot",
            "tweetedtimes bot",
            "tweetmemebot",
            "twengabot",
            "umbot",
            "unisterbot",
            "unwindfetchor",
            "updated",
            "urlappendbot",
            "urlfilebot",
            "urlresolver",
            "usinenouvellecrawler",
            "vagabondo",
            "vivante link checker",
            "voilabot",
            "vortex",
            "voyager\/",
            "vyu2",
            "web-archive-net\.com\.bot",
            "websquash\.com",
            "wesee:ads\/pagebot",
            "wbsearchbot",
            "webcollage",
            "webcompanycrawler",
            "webcrawler",
            "webmon ",
            "wesee:search",
            "wf84",
            "wget",
            "wocbot",
            "wofindeich robot",
            "womlpefactory",
            "woriobot",
            "wotbox",
            "xaldon_webspider",
            "xenu link sleuth",
            "xintellibot",
            "xml sitemaps generator",
            "xovibot",
            "y!j-asr",
            "yacy",
            "yacybot",
            "yahoo link preview",
            "yahoo! slurp china",
            "yahoo! slurp",
            "yahooseeker",
            "yahooseeker-testing",
            "yandexbot",
            "yandeximages",
            "yandexmetrika",
            "yanga",
            "yasaklibot",
            "yeti",
            "yioopbot",
            "yisouspider",
            "yodaobot",
            "yooglifetchagent",
            "yoozbot",
            "youdaobot",
            "zao",
            "zealbot",
            "zspider",
            "zyborg",
        );

        foreach ($bots as $bot) {
            if (strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), $bot) !== false) {
                return true;
            }
        }

        return false;
    }

}
