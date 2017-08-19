<?php

// Config
$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['razor']);

// Multiple local domains
if ($confArr['basedomain_local_additional']) {
    $domainsLocal = explode(',', $confArr['basedomain_local_additional']);

    $domainsLocalArr = array();
    foreach ($domainsLocal as $domainLocal) {
        $domainLocal = trim($domainLocal);
        $domainLocal = str_replace(array('https://', 'http://'), '', $domainLocal);

        $domainsLocalArr[] = $domainLocal;
    }
}

// Multiple live domains
if ($confArr['basedomain_live_additional']) {
    $domainsLive = explode(',', $confArr['basedomain_live_additional']);

    $domainsLiveArr = array();
    foreach ($domainsLive as $domainLive) {
        $domainLive = trim($domainLive);
        $domainLive = str_replace(array('https://', 'http://'), '', $domainLive);

        $domainsLiveArr[] = $domainLive;
    }
}

if ($_SERVER['SERVER_NAME'] == trim($confArr['basedomain_local']) || in_array($_SERVER['SERVER_NAME'], $domainsLocalArr) || getenv('APP_ENV') == 'local') {
    if (is_file(PATH_typo3conf . 'Local.php')) {
        @include PATH_typo3conf . 'Local.php';
    }
}

/* 1&1 fix BEGIN */

if (trim($confArr['staging_1and1fix'])) {
    $confArr['basedomain_staging'] = str_replace("www.", "", $confArr['basedomain_staging']);
}

if (trim($confArr['live_1and1fix'])) {
    $confArr['basedomain_live'] = str_replace("www.", "", $confArr['basedomain_live']);
}

if (trim($confArr['feature_1and1fix'])) {
    $confArr['basedomain_feature'] = str_replace("www.", "", $confArr['basedomain_feature']);
}

/* 1&1 fix END */

if ($_SERVER['SERVER_NAME'] == trim($confArr['basedomain_staging']) || getenv('APP_ENV') == 'staging') {
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 8005000) {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = trim($confArr['staging_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = trim($confArr['staging_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = trim($confArr['staging_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = trim($confArr['staging_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_colorspace'] = trim($confArr['staging_colorspace']);

        if (trim($confArr['staging_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = true;
        }

        if (trim($confArr['staging_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['staging_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www.", "", $confArr['basedomain_staging'])));
        }
    }
    else {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = trim($confArr['staging_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = trim($confArr['staging_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = trim($confArr['staging_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = trim($confArr['staging_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['colorspace'] = trim($confArr['staging_colorspace']);

        if (trim($confArr['staging_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '2';
        }

        if (trim($confArr['staging_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['staging_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www.", "", $confArr['basedomain_staging'])));
            $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = 65536;
        }
    }

    if (trim($confArr['staging_hefix'])) {
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'sendmail';
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_sendmail_command'] = '/usr/sbin/sendmail -t -f ' . $confArr['staging_hefix_mail'];
    }
} else if ($_SERVER['SERVER_NAME'] == trim($confArr['basedomain_live']) || in_array($_SERVER['SERVER_NAME'], $domainsLiveArr) || getenv('APP_ENV') == 'live') {
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 8005000) {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = trim($confArr['live_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = trim($confArr['live_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = trim($confArr['live_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = trim($confArr['live_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_colorspace'] = trim($confArr['live_colorspace']);

        if (trim($confArr['live_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = true;
        }

        if (trim($confArr['live_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['live_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www", "", $confArr['basedomain_live'])));
        }
    }
    else {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = trim($confArr['live_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = trim($confArr['live_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = trim($confArr['live_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = trim($confArr['live_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['colorspace'] = trim($confArr['live_colorspace']);

        if (trim($confArr['live_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '2';
        }

        if (trim($confArr['live_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['live_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www", "", $confArr['basedomain_live'])));
            $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = 65536;
        }
    }

    if (trim($confArr['live_hefix'])) {
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'sendmail';
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_sendmail_command'] = '/usr/sbin/sendmail -t -f ' . $confArr['live_hefix_mail'];
    }
} else if ($_SERVER['SERVER_NAME'] == trim($confArr['basedomain_feature']) || getenv('APP_ENV') == 'feature') {
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 8005000) {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['user'] = trim($confArr['feature_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['password'] = trim($confArr['feature_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['host'] = trim($confArr['feature_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['Connections']['Default']['dbname'] = trim($confArr['feature_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_colorspace'] = trim($confArr['feature_colorspace']);

        if (trim($confArr['feature_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = true;
        }

        if (trim($confArr['feature_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['processor_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['feature_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www", "", $confArr['basedomain_feature'])));
        }
    }
    else {
        $GLOBALS['TYPO3_CONF_VARS']['DB']['username'] = trim($confArr['feature_username']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['password'] = trim($confArr['feature_password']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['host'] = trim($confArr['feature_host']);
        $GLOBALS['TYPO3_CONF_VARS']['DB']['database'] = trim($confArr['feature_database']);

        $GLOBALS['TYPO3_CONF_VARS']['GFX']['colorspace'] = trim($confArr['feature_colorspace']);

        if (trim($confArr['feature_https']) == 1) {
            $GLOBALS['TYPO3_CONF_VARS']['BE']['lockSSL'] = '2';
        }

        if (trim($confArr['feature_mittfix'])) {
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path'] = '/usr/local/bin/';
            $GLOBALS['TYPO3_CONF_VARS']['GFX']['im_path_lzw'] = '/usr/local/bin/';
        }

        if (trim($confArr['feature_1and1fix'])) {
            putenv("MAGICK_THREAD_LIMIT=1");
            $GLOBALS['TYPO3_CONF_VARS']['SYS']['trustedHostsPattern'] = '.*\.' . preg_quote(trim(str_replace("www", "", $confArr['basedomain_feature'])));
            $GLOBALS['TYPO3_CONF_VARS']['BE']['maxFileSize'] = 65536;
        }
    }

    if (trim($confArr['feature_hefix'])) {
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport'] = 'sendmail';
        $GLOBALS['TYPO3_CONF_VARS']['MAIL']['transport_sendmail_command'] = '/usr/sbin/sendmail -t -f ' . $confArr['feature_hefix_mail'];
    }
}