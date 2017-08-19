# # News breadcrumb [BEGIN]

lib.newsBreadcrumb = RECORDS
lib.newsBreadcrumb {
  dontCheckPid = 1
  tables = tx_news_domain_model_news
  source {
    data = GP:tx_news_pi1|news
    intval = 1
  }
  conf {
    tx_news_domain_model_news = TEXT
    tx_news_domain_model_news {
      field = title
      htmlSpecialChars = 1
    }
  }
}

# # News breadcrumb [END]

# # Copyright [BEGIN]

lib.copyright = TEXT
lib.copyright {
  data = date:U
  strftime = %Y
}

# # Copyright [END]

# # Piwik code [BEGIN]

lib.piwikCode = FLUIDTEMPLATE
lib.piwikCode {
  file = EXT:razor/Resources/Private/Templates/Mixed/PiwikCode.html
}

# # Piwik code [END]

# # og:image [BEGIN]

lib.ogimage = IMG_RESOURCE
lib.ogimage {
  file {
    import.data = levelfield : -1, tx_razor_ogimage, slide
    treatIdAsReference = 1
    import.listNum = 0
    width = 1200c
    height = 630c
  }
}

# # og:image [END]