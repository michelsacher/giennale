# # SEO [BEGIN]

metaSeoSitemapXml {
  config {
    no_cache = 1
  }
}

# # Deactivate robots for local, staging and feature server
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}] OR [userFunc = basedomain(local)] OR [globalVar = IENV:HTTP_HOST = {$razor.basedomain.staging}] OR [globalVar = IENV:HTTP_HOST = {$razor.basedomain.feature}]

plugin {
	metaseo {
		metaTags {
			robotsIndex = 0
			robotsFollow = 0
		}

        robotsTxt >
        robotsTxt {
            default = COA
            default {
                10 = TEXT
                10 {
                    value (
User-agent: *
Disallow: /
                    )
                }
            }
        }
	}
}

page {
  headerData {
    1 = COA
    1 {
      40 = TEXT
      40 {
        value = <meta name="googlebot" content="noindex">
      }
    }
  }
}

[global]

# # SEO [END]

# # Page title [BEGIN]

[globalVar = TSFE:id != 1]

config.noPageTitle = 2
page.config.noPageTitle = 2

page {
	headerData {
		1 = COA
		1 {
			30 = TEXT
			30 {
				value = {page:title} | {$razor.site.projectName}
				stdWrap {
					insertData = 1
					wrap = <title>|</title>
				}
			}
		}
	}
}

[global]

# # Page title [END]

# # News [BEGIN]

# # Clear page title for news detail page
[globalVar = TSFE:page|doktype = 115]

page.headerData.1.30 >

page {
  headerData {
    1 {
      30 = COA
      30 {
        10 = RECORDS
        10 {
          source = {GP:tx_news_pi1|news}
          source.insertData = 1
          tables = tx_news_domain_model_news
          conf.tx_news_domain_model_news >
          conf.tx_news_domain_model_news = TEXT
          conf.tx_news_domain_model_news.field = title
        }
        20 = TEXT
        20 {
          value = |
          noTrimWrap = | | {$razor.site.projectName}|
        }
        stdWrap {
          wrap = <title>|</title>
        }
      }
    }
  }
}

[global]

# # News [END]

# # Google Analytics [BEGIN]

# # Live
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.live}] OR [userFunc = basedomain(live)]

plugin.tx_vhs.settings.asset {
  razorGoogleAnalytics {
    name = razorGoogleAnalytics
    path = EXT:razor/Resources/Public/JavaScript/GoogleAnalytics.js
    fluid = 1
    standalone = 1
    movable = 0
    variables {
      gaCodeLive = {$razor.seo.gaCodeLive}
    }
  }
}

[global]

# # Google Analytics [END]

# # Piwik [BEGIN]

# # Live
[globalVar = LIT:1 = {$razor.seo.piwik}] AND [globalVar = IENV:HTTP_HOST = {$razor.basedomain.live}] OR [globalVar = LIT:1 = {$razor.seo.piwik}] AND [userFunc = basedomain(live)]

plugin.tx_vhs.settings.asset {
  razorPiwik {
    name = razorPiwik
    path = EXT:razor/Resources/Public/JavaScript/Piwik.js
    fluid = 1
    standalone = 1
    movable = 0
    variables {
      piwikUrl = {$razor.seo.piwikUrl}
      piwikSite = {$razor.seo.piwikSite}
      piwikSiteId = {$razor.seo.piwikSiteId}
    }
  }
}

[global]

# # Piwik [END]