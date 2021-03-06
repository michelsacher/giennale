.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. include:: ../Includes.txt


.. _constants:

Constants
=========

MetaTags
--------
==============================   ==========================================================   =================
Constant                         Description                                                  Default
==============================   ==========================================================   =================
Last Update time                 Publish the update time of the current page                  *enabled*

Detect Language                  Publish the current TYPO3-FE-language as metatag             *enabled*

Canonical Tag                    Publish canonical link if possible                           *enabled*
                                 (TYPO3-cache is enabled and cHash is valid)
                                 or if user entered canonical tag into page options.          *disabled*

Canonical Protocol Fallback      If no protocol is set via TYPO3's page properties, use       *disabled*
                                 this as a fallback to set a unique protocol for both http
                                 and https requests. Can be set to `http`, `https` or left
                                 empty to disable the fallback.

Canonical Tag (Strict mode)      Enable strict mode (all wrong `GET` parameters will          *enabled*
                                 generate a canonical-tag to the self without `GET`
                                 parameters).

                                 e.g. `/index.php?id=123&foo=bar` would generate a
                                 Canonical-Tag pointing to `/index.php?id=123`
                                 if the `cHash` is wrong or caching is disabled

Canonical Tag (No MP mode)       Prevent canonical links to contain mountpoint information.   *disabled*
                                 Useful if some pages would count as duplicate content
                                 because of mountpoints.

Publish Page Expire Time         Publish expire date from the “End Date” of the page.         *enabled*
                                 Currently only used for Google.

Link generation                  Automatic generate index and up/next/prev-links.             *disabled*

Enable Dublin Core (DC.) tags    Enable/Disable output of dublin core (DC) metatags           *enabled*

Description                      Default description of your pages.

                                 Overwritten by description of page

Keywords                         Default list of keywords

                                 Overwritten by keywords of page

Copyright info                   Copyright information of your page

Reply-to email                   E-Mail address for contact

Author                           Default author

                                 Overwritten by author of page

Publisher                        Publisher of the website

Language                         Overwrite language detection

Rating                           Rating of the website

Distribution                     Distribution of your website

Revisit after                    Number of days between search engine visits

Geo Location                     Geo location of your web page with latitude,
                                 longitude, region and  placename

PICS-label                       Platform for Internet Content Selection

                                 - http://www.w3.org/PICS/labels.html

P3P Compact Policy               Your P3P Compact Policy.

                                 More information about P3P:

                                 - http://www.w3.org/P3P/
                                 - http://www.w3.org/TR/P3P/
                                 - https://en.wikipedia.org/wiki/P3P
                                 - http://www.p3pwriter.com

P3P Policy Url                   Link (full URL) to your P3P Policy File
==============================   ==========================================================   =================

Some metatags also have markers which could be build in, following metatags supports markers:

- Title
- Description
- Keywords
- Copyright
- Publisher

Following Markers are available:

==============================   ==========================================================   =================
Marker                           Description                                                  Example value
==============================   ==========================================================   =================
%YEAR%                           Replacement for the current year                             2017
==============================   ==========================================================   =================

UserAgent
---------
==============================   ==========================================================   =================
Constant                         Description                                                  Default
==============================   ==========================================================   =================
IE Compatibility Mode            Compatibility mode for Microsoft Internet Explorer
==============================   ==========================================================   =================


Crawler
-------
==============================   ==========================================================   =================
Constant                         Description                                                  Default
==============================   ==========================================================   =================
Crawler Robots-Tag               Enable crawler "robot"-tag (and all other settings below)    *enabled*

Index                            Should the crawler index your website?                       *enabled*

Follow                           Should the crawler follow  links on your website?            *enabled*

Archive                          Is the crawler allowed to archive the page                   *enabled*
                                 (e.g. Google cache)

Snippet                          Should the crawler use the snippet/description               *enabled*
                                 in search results

ODP                              Should the crawler use the OpenDirectoryProject to           *enabled*
                                 display the description in search results

YDir                             Should the crawler use the YahooDirectory to                 *enabled*
                                 display the description in search results
==============================   ==========================================================   =================


Services
--------
==============================   ===============================================================   =================
Constant                         Description                                                       Default
==============================   ===============================================================   =================
Crawler Verification             Verification code for Google, MSN and Yahoo
                                 webmaster tools and Web of trust

Google Analytics                 The google analytics code for using on your site
                                 Multiple GA Codes possible, comma separated
                                 (Will not be shown in frontend if BE-user is logged in,
                                 can be re-enabled in BE-Login-Mode:
                                 plugin.metaseo.services.googleAnalytics.showIfBeLogin = 1)

GA Cookie Domain Name            If you want to limit the current google analytics to
                                 one domain (or subdomain) set the domain name here, eg.:

                                 - `auto` (default in google analytics)
                                 - `none`
                                 - single domain (eg. `example.com`)
                                 - subdomain (eg. `.example.com`)

GA Anonymize IP                  Anonymize the last part of the IP                                 *disabled*
                                 (may be required in some countries)

GA Track Downloads               Try to track downloads with google analytics.                     *disabled*

                                 See res/ga-track-download.js for more details

                                 Currently supported files:

                                 - `doc`,`docx`,`xls`,`ppt`,`odt`,`ods`,`pdf`,`zip`,
                                   `tar`,`gz`,`txt`,`vsd`,`vxd`,`rar`,`exe`,`wma`,`mov`,
                                   `avi`,`ogg`,`ogm`,`mkv`,`wmv`,`mp3`,`webm`

Piwik URL                        Url to your Piwik installation

                                 (without `http://` and `https://`)

Piwik ID                         Tracking id of your website in your piwik
                                 Multiple Piwik IDs possible, comma separated

Piwik Download & Click Domain    Specifies which domains are internal domains:

                                 - single domain (eg. `example.com`)
                                 - subdomain (eg. `.example.com`)

                                 For more information visit:

                                 - https://developer.piwik.org/api-reference/tracking-javascript

Piwik Cookie Domain Name         Specifies the domain name for the tracking cookie:

                                 - single domain (eg. `example.com`)
                                 - subdomain (eg. `.example.com`)

                                 For more information visit:

                                 - https://developer.piwik.org/api-reference/tracking-javascript

Piwik DoNotTrack                 Opt out users with Mozilla's DoNotTrack                           *enabled*
                                 browser setting
==============================   ===============================================================   =================


Social
------
==============================   ==========================================================   =================
Constant                         Description                                                  Default
==============================   ==========================================================   =================
Google+ Direct Connect           Your Google+ profile page ID

                                 see https://developers.google.com/+/web/badge/
==============================   ==========================================================   =================

PageTitle
---------
=========================================   ==========================================================   ======================
Constant                                    Description                                                  Default
=========================================   ==========================================================   ======================
Apply tmpl-sitetitle to absolute <title>    There is a prefix/suffix for your pagetitle defined          *disabled*
                                            in your root template settings.

                                            If you use the SEO-Absolute-Pagetitle settings you
                                            can disable this suffix/prefix here.

Apply tmpl-sitetitle to prefix/suffix       There is a prefix/suffix for your pagetitle defined          *enabled*
                                            in your root template settings.

                                            If you use the SEO-Pagetitle-Suffix/Prefix settings you
                                            can disable this suffix/prefix here.

Sitetitle glue                              Glue between Pagetitle (from Page) and                       :
                                            Sitetitle (from template)

Sitetitle glue spacer (before)              Add spacer before glue string                                *disabled*

Sitetitle glue spacer (after)               Add spacer after glue string                                 *enabled*

Sitetitle position                          Position of Sitetitle (from template)                        Sitetitle-Pagetitle
                                            Possible options:                                            (0)

                                            Sitetitle-Pagetitle (eg. `Example Company: About us`)
                                            Pagetitle-Sitetitle (eg. `About us: Example Company`)

Sitetitle                                   Overwrite the template sitetitle with a custom one

Caching                                     Enable or disable caching of page title (for debugging)      *enabled*
=========================================   ==========================================================   ======================

Sitemap
-------
=================================   ==========================================================   =================
Constant                            Description                                                  Default
=================================   ==========================================================   =================
Enable                              Enables output (if set on root-pid of tree) and              *enabled*
                                    indexing for the whole subtree

Page limit                          Limit pages on sitemap-xml-pages                             *10000*

Limit to current language           Limit output of the sitemap to the current language.         *disabled*
                                    This will enable multi-language-domain sitemaps. eg:

                                    - `www.example.com` (FE-Language is english) will output
                                      only english pages
                                    - `www.example.de` (FE-Language is german) will output
                                      only german pages

                                    This option was ported from the extension configuration
                                    and will replace this configuration.

Default change frequency            Default change frequency for sitemap cache
                                    (will be cached)

Page priority                       Default page priority if the page has no own                 1
                                    priority set

                                    Page priority will be calculated by:

                                    ( `[page priority] – [priority modificator] ) *`
                                    ( `1/[page depth] * [page multiplier] )`

Priority tag in sitemap             Include priority tag in sitemap                              1

Lastmod tag in sitemap              Include lastmod tag in sitemap                               1

Page priority depth multiplier      Page depth multiplier, see formula in page priority          1

Page priority depth modificator     Page depth modificator, see formula in page priority         1
=================================   ==========================================================   =================
