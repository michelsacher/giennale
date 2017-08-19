<?php
namespace RZ\Razor\Service;

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

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class to perform some actions upon install
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class InstallService
{

    protected $extKey = 'razor';

    protected $settings = '';

    /**
     * @var string
     */
    protected $messageQueueByIdentifier = '';

    /**
     * Initializes the install service
     */
    public function __construct()
    {
        $this->messageQueueByIdentifier = 'extbase.flashmessages.tx_extensionmanager_tools_extensionmanagerextensionmanager';
    }

    /**
     * Installer
     *
     * @param string $extension
     * @return bool TRUE
     */
    public function razorInstaller($extension = null)
    {
        if ($extension == $this->extKey) {
            // Create additional config files
            $this->createAdditionalConfigFile();

            // Set local domain accordingly
            $this->localSettings();

            $this->createGitIgnore();

            $this->createInstallFiles();

            $this->copyAssets();

            $this->uninstallExt();

            $this->razorConfig();

            $this->localConf();

            if (substr($_SERVER['SERVER_SOFTWARE'], 0, 6) === 'Apache') {
                $this->createDefaultHtaccessFile();
            } else {
                /**
                 * Add Flashmessage that the system is not running on an apache webserver and the url rewritings must be handled manually
                 */
                $flashMessage = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage', 'The razor Package uses RealUrl to generate SEO friendly URLs by default, please take care of the URLs rewriting settings for your environment yourself.' . 'You can also deactivate RealUrl by changing your TypoScript setup to "config.tx_realurl_enable = 0".', 'TYPO3 is not running on an Apache-Webserver', FlashMessage::WARNING, true);

                $this->addFlashMessage($flashMessage);

                return;
            }
        }
    }

    /**
     * Settings
     *
     * @return void
     */
    public function localSettings()
    {
        // Get local domain
        $localDomain = $_SERVER['HTTP_HOST'];

        // Get project name from LocalConfiguration.php
        $siteName = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager')->getLocalConfigurationValueByPath('SYS/sitename');

        // Update domain record
        $GLOBALS['TYPO3_DB']->exec_UPDATEquery('sys_domain', 'uid=1', array(
            'domainName' => $localDomain,
        ));

        // Update page title main page
        $GLOBALS['TYPO3_DB']->exec_UPDATEquery('pages', 'uid=1', array(
            'title' => $siteName,
        ));

        // Update project name in powermail form
        $GLOBALS['TYPO3_DB']->sql_query('UPDATE tt_content set pi_flexform = REPLACE(pi_flexform, "razor project", ' . $sitename . ') WHERE uid=320');

        // Update TypoScript
        $this->substituteMarkers(
            'fileadmin/razor/TypoScript/constants/Settings.ts',
            array(
                '###LOCAL###',
                '###PROJECT_NAME###',
            ),
            array(
                $localDomain,
                $siteName,
            )
        );
    }

    /**
     * LocalConfiguration.php settings
     *
     * @return void
     */
    public function localConf()
    {
        /* razor */

        // Set default razor config - see: https://forge.typo3.org/issues/80191
        $razor = array(
            'basedomain_local' => '###LOCAL###',
            'basedomain_local_additional' => '',
            'local_name' => 'Local',
            'basedomain_staging' => 'testproject.staging',
            'staging_name' => 'Staging',
            'staging_username' => '',
            'staging_password' => '',
            'staging_host' => '',
            'staging_database' => '',
            'staging_colorspace' => 'RGB',
            'staging_https' => 0,
            'staging_hefix' => 0,
            'staging_hefix_mail' => '',
            'staging_1and1fix' => 0,
            'staging_mittfix' => 0,
            'basedomain_live' => 'testproject.live',
            'basedomain_live_additional' => '',
            'live_name' => 'Live',
            'live_username' => '',
            'live_password' => '',
            'live_host' => '',
            'live_database' => '',
            'live_colorspace' => 'RGB',
            'live_https' => 0,
            'live_hefix' => 0,
            'live_hefix_mail' => '',
            'live_1and1fix' => 0,
            'live_mittfix' => 0,
            'basedomain_feature' => 'testproject.feature',
            'feature_name' => 'Feature',
            'feature_username' => '',
            'feature_password' => '',
            'feature_host' => '',
            'feature_database' => '',
            'feature_colorspace' => 'RGB',
            'feature_https' => 0,
            'feature_hefix' => 0,
            'feature_hefix_mail' => '',
            'feature_1and1fix' => 0,
            'feature_mittfix' => 0,
            'show_module' => 1,
            'show_tools_module' => 1,
            'headline_required' => 1,
            'headline_multi' => 0,
            'default404Page' => 8,
            'tinyPng' => 0,
            'gridBackground' => 'razor_wrap',
            'maxAge' => 604800
        );

        $razor = serialize($razor);

        /* indexed_search */

        $indexedSearch = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['indexed_search']);

        $indexedSearch['pdftools'] = '/usr/bin/';
        $indexedSearch['pdf_mode'] = 20;
        $indexedSearch['unzip'] = '/usr/bin/';
        $indexedSearch['catdoc'] = '/usr/bin/';
        $indexedSearch['xlhtml'] = '/usr/bin/';
        $indexedSearch['ppthtml'] = '/usr/bin/';
        $indexedSearch['unrtf'] = '/usr/bin/';
        $indexedSearch['debugMode'] = 0;
        $indexedSearch['fullTextDataLength'] = 0;
        $indexedSearch['disableFrontendIndexing'] = 0;
        $indexedSearch['enableMetaphoneSearch'] = 1;
        $indexedSearch['minAge'] = 0;
        $indexedSearch['maxAge'] = 0;
        $indexedSearch['maxExternalFiles'] = 5;
        $indexedSearch['useCrawlerForExternalFiles'] = 0;
        $indexedSearch['flagBitMask'] = 192;
        $indexedSearch['ignoreExtensions'] = '';
        $indexedSearch['indexExternalURLs'] = 0;

        $indexedSearch = serialize($indexedSearch);

        /* news */

        $news = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['news']);

        $news['archiveDate'] = 'date';
        $news['rteForTeaser'] = 0;
        $news['tagPid'] = 1;
        $news['prependAtCopy'] = 1;
        $news['categoryRestriction'] = 'none';
        $news['categoryBeGroupTceFormsRestriction'] = 0;
        $news['contentElementRelation'] = 0;
        $news['manualSorting'] = 1;
        $news['dateTimeNotRequired'] = 0;
        $news['showAdministrationModule'] = 0;
        $news['hidePageTreeForAdministrationModule'] = 0;
        $news['showImporter'] = 0;
        $news['storageUidImporter'] = 1;
        $news['resourceFolderImporter'] = '/news_import';

        $news = serialize($news);

        /* dce */

        $dce = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['dce']);

        $dce['enableUpdateCheck'] = 0;
        $dce['disableAutoClearCache'] = 1;
        $dce['disableAutoClearFrontendCache'] = 0;
        $dce['disableCodemirror'] = 0;

        $dce = serialize($dce);

        /* realurl */

        $realurl = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['realurl']);

        $realurl['configFile'] = 'typo3conf/realurl_conf.php';
        $realurl['enableAutoConf'] = 0;
        $realurl['autoConfFormat'] = 0;
        $realurl['enableDevLog'] = 0;
        $realurl['moduleIcon'] = 1;

        $realurl = serialize($realurl);

        // Write Localconfiguration.php
        GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager')->setLocalConfigurationValuesByPathValuePairs(array(
            'GFX/jpg_quality' => 100,
            'GFX/gdlib_png' => 1,
            'GFX/imagefile_ext' => 'gif,jpg,jpeg,png,pdf,svg',
            'GFX/im_stripProfileCommand' => '-strip',
            'GFX/im_path' => '/usr/bin/',
            'GFX/im_path_lzw' => '/usr/bin/',
            'SYS/curlUse' => 1,
            'FE/compressionLevel' => 9,
            'SYS/displayErrors' => 1,
            'SYS/clearCacheSystem' => 1,
            'SYS/systemLocale' => 'en_US.utf-8',
            'SYS/caching/cacheConfigurations/extbase_object/backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
            'EXT/extConf/razor' => $razor,
            'EXT/extConf/indexed_search' => $indexedSearch,
            'EXT/extConf/news' => $news,
            'EXT/extConf/dce' => $dce,
            'EXT/extConf/realurl' => $realurl,
            'EXT/extConf/backend' => $this->settings,
        ));
    }

    /**
     * Creates AdditionalConfiguration.php and Settings.php files inside the typo3conf directory
     *
     * @return void
     */
    public function createAdditionalConfigFile()
    {
        $addtionalConfigFile = GeneralUtility::getFileAbsFileName(PATH_typo3conf . "AdditionalConfiguration.php");
        $settingsFile = GeneralUtility::getFileAbsFileName(PATH_typo3conf . "Settings.php");
        $realurlFile = GeneralUtility::getFileAbsFileName(PATH_typo3conf . "RazorRealurlconf.php");

        // Write AdditionalConfig.php
        $additionalConfigContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Database/AdditionalConfiguration.php');
        GeneralUtility::writeFile($addtionalConfigFile, $additionalConfigContent, true);

        // Write Settings.php
        $settingsContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Database/Settings.php');
        GeneralUtility::writeFile($settingsFile, $settingsContent, true);

        // Write RazorRealurlconf.php
        $realurlContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/RealURL/Default.php');
        GeneralUtility::writeFile($realurlFile, $realurlContent, true);
    }

    /**
     * Creates .htaccess file inside the root directory
     *
     * @return void
     */
    public function createDefaultHtaccessFile()
    {
        $htaccessFile = GeneralUtility::getFileAbsFileName(".htaccess");

        if (file_exists($htaccessFile)) {

            /**
             * Add Flashmessage that there is already an .htaccess file and we are not going to override this.
             */
            $flashMessage = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage', 'There is already an Apache .htaccess file in the root directory, please make sure that the url rewritings are set properly.' . 'An example configuration is located at: typo3conf/ext/razor/Configuration/Apache/.htaccess', 'Apache .htaccess file already exists', FlashMessage::NOTICE, true);

            $this->addFlashMessage($flashMessage);

            return;
        }

        $htaccessContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Apache/.htaccess');
        GeneralUtility::writeFile($htaccessFile, $htaccessContent, true);

        /**
         * Add Flashmessage that the example htaccess file was placed in the root directory
         */
        $flashMessage = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessage', 'For RealURL and optimization purposes an example .htaccess file was placed in your root directory.' . ' Please check if the RewriteBase correctly set for your environment. ', 'Apache example .htaccess was placed in the root directory.', FlashMessage::OK, true);

        $this->addFlashMessage($flashMessage);
    }

    /**
     * Create .gitignore
     *
     * @return void
     */
    public function createGitIgnore()
    {
        $file = GeneralUtility::getFileAbsFileName(".gitignore");

        $content = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Git/.gitignore');
        GeneralUtility::writeFile($file, $content, true);
    }

    /**
     * Create install files
     *
     * @return void
     */
    public function createInstallFiles()
    {
        // Define install files
        $installFiles = array(
            ".editorconfig",
            "bower.json",
            ".eslintrc.json",
            "deps.html",
            "gulpfile.js",
            "package.json",
            "README.md",
            "backup.sh",
            "razor.sh",
            "browser-support.html",
            ".sass-lint.yml",
        );

        // Get path and names of files
        $files = array();
        foreach ($installFiles as $file) {
            $files[$file] = array(
                "filename" => GeneralUtility::getFileAbsFileName($file),
                "content" => GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Install/razor_' . $file),
            );

            // Make backup script executable
            if ($file == "backup.sh" || $file == "razor.sh") {
                $files[$file]["chmod"] = 0755;
            }
        }

        // Write files
        foreach ($files as $file) {
            GeneralUtility::writeFile($file['filename'], $file['content'], false);

            if ($file['chmod']) {
                chmod($file['filename'], $file['chmod']);
            }
        }
    }

    /**
     * Copy assets
     *
     * @return void
     */
    public function copyAssets()
    {
        $assets = array(
            'bilder',
            'dokumente',
        );

        foreach ($assets as $asset) {
            if (!is_dir(PATH_site . 'fileadmin/user_upload/' . $asset)) {
                mkdir(PATH_site . 'fileadmin/user_upload/' . $asset);
                $this->cpy(ExtensionManagementUtility::extPath($this->extKey) . '/Initialisation/Assets/' . $asset, PATH_site . 'fileadmin/user_upload/' . $asset);
            }
        }

        // DCE icons
        $this->cpy(ExtensionManagementUtility::extPath($this->extKey) . '/Initialisation/Files/Images/Icons/Dce', PATH_site . 'uploads/tx_dce');
    }

    /**
     * Uninstall some extensions
     *
     * @return void
     */
    public function uninstallExt()
    {
        $this->objectManager = GeneralUtility::makeInstance('TYPO3\CMS\Extbase\Object\ObjectManager');
        /** @var $service \TYPO3\CMS\Extensionmanager\Utility\InstallUtility */
        $service = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Utility\\InstallUtility');
        $service->uninstall('context_help');
    }

    /**
     * Substitute markers
     *
     * @param string $file
     * @param array $markers
     * @param array $replace
     * @return void
     */
    public function substituteMarkers($file, $markers, $replace)
    {
        $fname = PATH_site . $file;
        $fhandle = fopen($fname, "r");
        $content = fread($fhandle, filesize($fname));

        // Substitute markers with domain name
        $i = 0;
        foreach ($markers as $marker) {
            $content = str_replace($marker, $replace[$i], $content);

            $i++;
        }

        $fhandle = fopen($fname, "w");
        fwrite($fhandle, $content);
        fclose($fhandle);
    }

    /**
     * Recursive delete function
     *
     * @param string $dir
     * @return void
     */
    public function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir . "/" . $object) == "dir") {
                        self::rrmdir($dir . "/" . $object);
                    } else {
                        unlink($dir . "/" . $object);
                    }

                }
            }
            reset($objects);
            rmdir($dir);
        }
    }

    /**
     * Recursive copy function
     *
     * @param string $source
     * @param string $dest
     * @return void
     */
    public function cpy($source, $dest)
    {
        if (is_dir($source)) {
            $dir_handle = opendir($source);
            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    if (is_dir($source . "/" . $file)) {
                        if (!is_dir($dest . "/" . $file)) {
                            mkdir($dest . "/" . $file);
                        }
                        $this->cpy($source . "/" . $file, $dest . "/" . $file);
                    } else {
                        copy($source . "/" . $file, $dest . "/" . $file);
                    }
                }
            }
            closedir($dir_handle);
        } else {
            copy($source, $dest);
        }
    }

    /**
     * Razor config from Yeoman
     *
     * @return int
     */
    public function razorConfig()
    {
        $configfile = PATH_site . 'razor.json';

        if (is_file($configfile)) {
            $fname = $configfile;
            $fhandle = fopen($fname, "r");
            $config = fread($fhandle, filesize($fname));
            fclose($fhandle);

            // Get config
            $config = json_decode($config);

            // English
            if ($config->english === true) {
                // Activate english in database
                $GLOBALS['TYPO3_DB']->sql_query('UPDATE sys_language set hidden = 0 WHERE uid=1');

                // Activate english in realurl configuration
                $this->substituteMarkers(
                    'typo3conf/RazorRealurlconf.php',
                    array(
                        "//'en'",
                    ),
                    array(
                        "'en'",
                    )
                );
            }

            // Copyright
            if ($config->copyright === false) {
                $handle = fopen(PATH_site . "fileadmin/razor/TypoScript/setup/Settings.ts", "w+");
                fclose($handle);
            } else {
                /* backend */

                $backend = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['backend']);

                $backend['loginLogo'] = 'fileadmin/razor/Images/Werdewelt/logo.svg';
                $backend['loginHighlightColor'] = '#000000';
                $backend['loginBackgroundImage'] = 'fileadmin/razor/Images/Werdewelt/background.jpg';

                $backend = serialize($backend);

                // Write Localconfiguration.php
                // GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Configuration\\ConfigurationManager')->setLocalConfigurationValuesByPathValuePairs(array(
                //     'EXT/extConf/backend' => $backend,
                // ));

                $this->settings = $backend;
            }

            // CSS files
            $files = array(
                'fileadmin/razor/Styles/Main.scss',
                'fileadmin/razor/Styles/Main-responsive.scss',
                'fileadmin/razor/Styles/Variables.scss',
                'fileadmin/razor/Styles/Fonts.scss',
                'fileadmin/razor/Styles/Helper.scss',
                'fileadmin/razor/Styles/Components/BorderRadius.scss',
                'fileadmin/razor/Styles/Components/Downloads.scss',
                'fileadmin/razor/Styles/Components/Gallery.scss',
                'fileadmin/razor/Styles/Components/News.scss',
                'fileadmin/razor/Styles/Components/Search.scss',
                'fileadmin/razor/Styles/Components/Pagination.scss',
            );

            foreach ($files as $file) {
                $this->substituteMarkers(
                    $file,
                    array(
                        '###DATE###',
                        '###AUTHOR###',
                        '###EMAIL###',
                        '###WEBSITE###',
                    ),
                    array(
                        date("d.m.Y"),
                        $config->author,
                        $config->email,
                        $config->website,
                    )
                );
            }

            // Update admin user
            $GLOBALS['TYPO3_DB']->exec_UPDATEquery('be_users', 'uid=1', array(
                'usergroup' => 1,
                'email' => $config->adminEmail,
                'realName' => $config->user,
            ));

            // .htaccess-dev
            if ($config->htaccess === true) {
                $htaccessFile = GeneralUtility::getFileAbsFileName(".htaccess-dev");

                $htaccessContent = GeneralUtility::getUrl(ExtensionManagementUtility::extPath($this->extKey) . '/Configuration/Apache/.htaccess-dev');
                GeneralUtility::writeFile($htaccessFile, $htaccessContent, true);
            }
        }
    }

    /**
     * Adds a Flash Message to the Flash Message Queue
     *
     * @param FlashMessage $flashMessage
     */
    public function addFlashMessage(FlashMessage $flashMessage)
    {
        if ($flashMessage) {
            /** @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
            $flashMessageService = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
            /** @var $flashMessageQueue \TYPO3\CMS\Core\Messaging\FlashMessageQueue */
            $flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier($this->messageQueueByIdentifier);
            $flashMessageQueue->enqueue($flashMessage);
        }
    }

}
