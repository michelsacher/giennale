# # Creation Mask [BEGIN]

TCEMAIN {
  permissions {
    groupid = 2
    user = show,editcontent,edit,delete,new
    group = show,editcontent,edit,delete,new
    everybody = show,editcontent,edit,delete,new
  }
}

# # Creation Mask [END]

# # Storage PID [BEGIN]

TCEFORM {
  tt_content {
    pi_flexform {
      PAGE_TSCONFIG_ID = 2

      gridelements_pi1 {
        general {
          size {
            PAGE_TSCONFIG_ID = 2
          }
          color {
            PAGE_TSCONFIG_ID = 2
          }
          backgroundColor {
            PAGE_TSCONFIG_ID = 2
          }
        }
        options {
          padding {
            PAGE_TSCONFIG_ID = 2
          }
        }
      }
    }
  }
}

# # Storage PID [END]

# # Remove translate to and copy tags [BEGIN]

TCEMAIN {
  table {
    tt_content {
      disablePrependAtCopy = 1
      disableHideAtCopy = 1
    }
    pages {
      disablePrependAtCopy = 1
      disableHideAtCopy = 0
    }
  }
}

# # Remove translate to and copy tags [END]

# # Default Language [BEGIN]

mod {
  SHARED {
    defaultLanguageFlag = de
  }
}

# # Default Language [END]

# # Disable content elements [BEGIN]

TCEFORM {
  tt_content {
    CType {
      removeItems = bullets, uploads, div, mailform
    }
  }
}

# # Disable content elements [END]

# # Disable fields [BEGIN]

TCEFORM {
  tt_content {
    sectionIndex {
      disabled = 1
    }
    date {
      disabled = 1
    }
    header_link {
      disabled = 1
    }
    subheader {
      disabled = 1
    }
    layout {
      disabled = 1
    }
    section_frame {
      disabled = 1
    }
    sectionIndex {
      disabled = 1
    }
    linkToTop {
      disabled = 1
    }
    longdescURL {
      disabled = 1
    }
    image_compression {
      disabled = 1
    }
    image_effects {
      disabled = 1
    }
    image_noRows {
      disabled = 1
    }
    imageborder {
      disabled = 1
    }
    spaceBefore {
      disabled = 1
    }
    spaceAfter {
      disabled = 1
    }
    rowDescription {
      disabled = 1
    }
    assets {
      disabled = 1
    }
    image_zoom {
      disabled = 1
    }
    imagewidth {
      disabled = 1
    }
    imageheight {
      disabled = 1
    }
    imageorient {
      disabled = 1
    }
    imagecols {
      disabled = 1
    }
    media {
      disabled = 1
    }
    pi_flexform {
      news_pi1 {
        additional {
          settings\.tags.disabled = 1
        }
        template {
          settings\.media\.maxWidth.disabled = 1
          settings\.media\.maxHeight.disabled = 1
        }
      }
    }
    recursive {
      disabled = 1
    }
    select_key {
      disabled = 1
    }
  }
  pages {
    newUntil {
      disabled = 1
    }
    cache_timeout {
      disabled = 1
    }
    cache_tags {
      disabled = 1
    }
    keywords {
      disabled = 1
    }
    abstract {
      disabled = 1
    }
    author {
      disabled = 1
    }
    author_email {
      disabled = 1
    }
    lastUpdated {
      disabled = 1
    }
    tx_metaseo_geo_lat {
      disabled = 1
    }
    tx_metaseo_geo_long {
      disabled = 1
    }
    tx_metaseo_geo_place {
      disabled = 1
    }
    tx_metaseo_geo_region {
      disabled = 1
    }
    tx_metaseo_pagetitle_rel {
      disabled = 1
    }
    tx_metaseo_pagetitle {
      disabled = 1
    }
    tx_metaseo_pagetitle_prefix {
      disabled = 1
    }
    tx_metaseo_pagetitle_suffix {
      disabled = 1
    }
    tx_metaseo_inheritance {
      disabled = 1
    }
    tx_metaseo_priority {
      disabled = 1
    }
    tx_metaseo_change_frequency {
      disabled = 1
    }
    alias {
      disabled = 1
    }
    editlock {
      disabled = 1
    }
    php_tree_stop {
      disabled = 1
    }
    categories {
      disabled = 1
    }
    module {
      disabled = 1
    }
    content_from_pid {
      disabled = 1
    }
    extendToSubpages {
      disabled = 1
    }
    tsconfig_includes {
      disabled = 1
    }
  }
  pages_language_overlay {
    media {
      disabled = 1
    }
    keywords {
      disabled = 1
    }
    abstract {
      disabled = 1
    }
    author {
      disabled = 1
    }
    author_email {
      disabled = 1
    }
    tx_metaseo_pagetitle {
      disabled = 1
    }
    tx_metaseo_pagetitle_prefix {
      disabled = 1
    }
    tx_metaseo_pagetitle_suffix {
      disabled = 1
    }
    tx_metaseo_pagetitle_rel {
      disabled = 1
    }
  }
  tx_news_domain_model_news {
    author {
      disabled = 1
    }
    author_email {
      disabled = 1
    }
    archive {
      disabled = 1
    }
    rte_disabled {
      disabled = 1
    }
    editlock {
      disabled = 1
    }
    tags {
      disabled = 1
    }
    related {
      disabled = 1
    }
    related_from {
      disabled = 1
    }
    keywords {
      disabled = 1
    }
    istopnews {
      disabled = 1
    }
    alternative_title {
      disabled = 1
    }
  }
  be_users {
    description {
      disabled = 1
    }
  }
}

# # Disable fields [END]

# # Custom sitemaps [BEGIN]

TCEFORM {
  tt_content {
    menu_type {
      addItems {
        15 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:tabSitemap
      }
      removeItems = 4,7,3,5,6,categorized_pages,categorized_content
    }
  }
}

# # Custom sitemaps [END]

# # powermail [BEGIN]

tx_powermail {
  flexForm {
    type {
      addFieldOptions {
        jhcaptcharecaptcha = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:reCaptcha
      }
    }
  }
}

# # powermail [END]

# # Secondary options [BEGIN]

mod {
  web_list {
    enableClipBoard = activated
    enableLocalizationView = activated
    enableDisplayBigControlPanel = activated
  }
  file_list {
    enableDisplayBigControlPanel = activated
  }
}

# # Secondary options [END]

# # Backend header [BEGIN]

mod {
  wizards {
    newContentElement {
      wizardItems {
        common {
          elements {
            # # Images
            dce_dceuid8 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:imageDefValue
                header_layout = 101
              }
            }
          }
        }
        dce {
          elements {
            # # Buttons
            dce_dceuid2 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:buttons
                header_layout = 101
              }
            }

            # # Alert
            dce_dceuid5 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:alert
                header_layout = 101
              }
            }

            # # Video
            dce_dceuid6 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:video
                header_layout = 101
              }
            }

            # # Spacer
            dce_dceuid7 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:spacer
                header_layout = 101
              }
            }

            # # Icon
            dce_dceuid11 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:icon
                header_layout = 101
              }
            }

            # # Downloads
            dce_dceuid13 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:downloads
                header_layout = 101
              }
            }

            # # Gallery
            dce_dceuid14 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:gallery
                header_layout = 101
              }
            }

            # # Contact button
            dce_dceuid15 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:contactButton
                header_layout = 101
              }
            }

            # # Teaserbox
            dce_dceuid24 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:teaserbox
                header_layout = 101
              }
            }

            # # Blockquote
            dce_dceuid25 {
              tt_content_defValues {
                header = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:blockquote
                header_layout = 101
              }
            }
          }
        }
      }
    }
  }
}

# # Backend header [END]

# # News [BEGIN]

tx_news.templateLayouts {
  1 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:news.listFull
  2 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:news.list2Cols
  3 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:news.list3Cols
}

# # News [END]

# # tt_content icons [BEGIN]

mod.wizards.newContentElement.wizardItems {
  common.elements {
    header.icon = EXT:razor/Resources/Public/Images/Icons/Content/header.svg

    textmedia {
      title = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:textmedia
      description = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:textmediaDesc
      icon = EXT:razor/Resources/Public/Images/Icons/Content/text.svg
    }

    table.icon = EXT:razor/Resources/Public/Images/Icons/Content/table.svg
  }

  special.elements {
    menu.icon = EXT:razor/Resources/Public/Images/Icons/Content/menu.svg
    html.icon = EXT:razor/Resources/Public/Images/Icons/Content/html.svg
    shortcut.icon = EXT:razor/Resources/Public/Images/Icons/Content/shortcut.svg
    list.icon = EXT:razor/Resources/Public/Images/Icons/Content/login.svg
  }

  plugins.elements {
    general.icon = EXT:razor/Resources/Public/Images/Icons/Content/plugin.svg
    news.icon = EXT:razor/Resources/Public/Images/Icons/Content/news.svg
    powermail.icon = EXT:razor/Resources/Public/Images/Icons/Content/powermail.svg
  }

  forms.elements {
    login.icon = EXT:razor/Resources/Public/Images/Icons/Content/login.svg
  }
}

# # tt_content icons [END]

# # Header layouts [BEGIN]

TCEFORM.tt_content.header_layout {
  altLabels {
    0 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.0
    1 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.1
    2 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.2
    3 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.3
    4 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.4
    5 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.5
  }

  removeItems = 100

  addItems {
    6 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.6
    101 = LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:header_layout.101
  }
}

# # Header layouts [END]

# # Custom [BEGIN]

<INCLUDE_TYPOSCRIPT: source="FILE:fileadmin/razor/TypoScript/TSConfig/Page.ts">
<INCLUDE_TYPOSCRIPT: source="FILE:fileadmin/razor/TypoScript/TSConfig/Rte.ts">

# # Custom [END]
