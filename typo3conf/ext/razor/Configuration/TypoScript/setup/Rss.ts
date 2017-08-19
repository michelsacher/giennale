# # Basedomain [BEGIN]

# # Live
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.live}] AND [globalVar = TSFE:type = 9818]

config.absRefPrefix = {$razor.protocol.live}://{$razor.basedomain.live}/

[global]

# # Staging
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.staging}] AND [globalVar = TSFE:type = 9818]

config.absRefPrefix = {$razor.protocol.staging}://{$razor.basedomain.staging}/

[global]

# # Local
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}] AND [globalVar = TSFE:type = 9818]

config.absRefPrefix = {$razor.protocol.local}://{$razor.basedomain.local}/

[global]

# # Feature
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.feature}] AND [globalVar = TSFE:type = 9818]

config.absRefPrefix = {$razor.protocol.feature}://{$razor.basedomain.feature}/

[global]

# # Basedomain [END]

# # RSS [BEGIN]

[globalVar = TSFE:type = 9818]

config {
  disableAllHeaderCode = 1
  xhtml_cleaning = none
  admPanel = 0
  metaCharset = utf-8
  additionalHeaders = Content-Type:application/xml;charset=utf-8
  disablePrefixComment = 1
}

pageNewsRSS = PAGE
pageNewsRSS {
  typeNum = 9818
  10 < tt_content.list.20.news_pi1
  10 {
    switchableControllerActions {
      News {
        1 = list
      }
    }

    settings < plugin.tx_news.settings
    settings {
      categories = {$razor.rss.categories}
      categoryConjunction = {$razor.rss.categoryConjunction}
      limit = {$razor.rss.maxItems}
      detailPid = {$razor.rss.detailPid}
      startingpoint = {$razor.rss.startingPoint}
      format = xml
    }
  }
}

[global]

# # RSS [END]