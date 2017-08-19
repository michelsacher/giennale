# # RealURL [BEGIN]

config {
  simulateStaticDocuments = 0
  simulateStaticDocuments_pEnc= md5
  simulateStaticDocuments_pEnc_onlyP = L
  tx_realurl_enable = 1
}

# # RealURL [END]

# # min [BEGIN]

plugin.tx_min.tinysource {
  enable = 0
}

# # min [END]

# # Gridelements [BEGIN]

tt_content.stdWrap.innerWrap.cObject.default.if {
  equals.field = CType
  value = gridelements_pi1
  negate = 1
}

# # Gridelements [END]

# # powermail [BEGIN]

config.tx_extbase {
  persistence {
    classes {
      In2code\Powermail\Domain\Model\Field {
        subclasses {
          0 = RZ\Razor\Domain\Model\Field
        }
      }
      RZ\Razor\Domain\Model\Field {
        mapping {
          tableName = tx_powermail_domain_model_field
        }
      }
    }
  }
}

plugin.tx_powermail {
  view {
    templateRootPaths {
      1 = fileadmin/razor/Templates/Powermail/Templates/
    }
    partialRootPaths {
      1 = fileadmin/razor/Templates/Powermail/Partials/
    }
    layoutRootPaths {
      1 = fileadmin/razor/Templates/Powermail/Layouts/
    }
  }

  settings {
    setup {
      sender {
        overwrite {
          senderEmail {
            value = {$razor.powermail.powermailEmail}
          }
        }
      }
      receiver {
        default {
          senderEmail {
            value = {$razor.powermail.powermailEmail}
          }
        }
        overwrite {
          senderEmail {
            value = {$razor.powermail.powermailEmail}
          }
        }
      }
    }
  }
  _LOCAL_LANG {
    de {
      validationerror_validation.1 = Keine gültige E-Mail Adresse!
      validationerror_mandatory_multi = Eines dieser Felder muss ausgefüllt werden!
    }
  }
}

page {
  includeJSFooter {
    powermailJQueryDatepicker >
    powermailJQueryFormValidation >
    powermailJQueryTabs >
    powermailForm >
  }
}

[globalVar = LIT:0 < {$plugin.tx_powermail.settings.javascript.addAdditionalJavaScript}]

plugin.tx_vhs.settings.asset {
  powermailJQueryDatepicker {
    name = powermailJQueryDatepicker
    path = EXT:powermail/Resources/Public/JavaScripts/Libraries/jquery.datetimepicker.min.js
  }
  powermailJQueryFormValidation {
    name = powermailJQueryFormValidation
    path = EXT:powermail/Resources/Public/JavaScripts/Libraries/parsley.min.js
  }
  powermailForm {
    name = powermailForm
    path = EXT:powermail/Resources/Public/JavaScripts/Powermail/Form.min.js
  }
}

[end]

# # powermail [END]

# # News [BEGIN]

plugin.tx_news {
  _LOCAL_LANG {
    de {
      more-link = weiterlesen
      back-link = zurück
    }
  }
  view {
    widget.GeorgRinger\News\ViewHelpers\Widget\PaginateViewHelper.templateRootPath = fileadmin/razor/Templates/News/Templates/

    templateRootPaths {
      0 = EXT:news/Resources/Private/Templates/
      1 = fileadmin/razor/Templates/News/Templates/
    }
    partialRootPaths {
      0 = EXT:news/Resources/Private/Partials/
      1 = fileadmin/razor/Templates/News/Partials/
      2 >
    }
    layoutRootPaths {
      0 = EXT:news/Resources/Private/Layouts/
      1 = fileadmin/razor/Templates/News/Layouts/
    }
  }

  settings {
    cssFile >
    cropMaxCharacters = {$razor.news.cropMaxCharacters}
    list {
      paginate {
        insertAbove = 0
      }

      rss {
        channel < razor.rss
      }
    }

    detail {
      media {
        image {
          lightbox {
            enabled = {$razor.news.lightbox}
          }
        }
      }
    }
  }
}

# # English
[globalVar = GP:L = 1]

plugin.tx_news {
  settings {
    list {
      rss {
        channel {
          language = en-gb
        }
      }
    }
  }
}

[global]

# # News [END]

# # Captcha [BEGIN]

plugin.tx_jhcaptcha {
  settings {
    reCaptcha {
      siteKey = {$razor.powermail.siteKey}
      secretKey = {$razor.powermail.secretKey}
    }
  }
}

# # Captcha [END]

# # Google Maps [BEGIN]

[userFunc = TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('medgooglemaps')]]

plugin.tx_vhs.settings.asset {
  medgooglemaps {
    dependencies = razorBootstrapJs
  }
}

[global]

# # Google Maps [END]

# # Slick [BEGIN]

[userFunc = TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('rzslick')]]

plugin.tx_vhs.settings.asset {
  rzslick_slick {
    dependencies = razorBootstrapJs
  }
}

[global]

# # Slick [END]

# # vhs [BEGIN]

plugin.tx_vhs {
  assets {
    mergedAssetsUseHashedFilename = 1
    compressCss = 1
    compressJs = 1
  }
}

# # vhs [END]

# # Remove default styles [BEGIN]

plugin.tx_felogin_pi1._CSS_DEFAULT_STYLE >
plugin.tx_indexedsearch._CSS_DEFAULT_STYLE >
plugin.tx_cssstyledcontent._CSS_DEFAULT_STYLE >

# # Remove default styles [END]