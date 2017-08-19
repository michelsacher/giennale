# # Settings [BEGIN]

razor {
  basedomain {
    local = giennale.localhost
    staging = testproject.staging
    live = www.giennale.de
    feature = testproject.feature
  }

  protocol {
    local = http
    staging = http
    live = http
    feature = http
  }

  site {
    projectName = GIENNALE
    breadcrumb = 0
    breadcrumbOnHomepage = 0
  }

  colors {
    tile = #000000
    theme = #ffffff
  }

  bootstrap {
    cols = 24
    defaultSizes = 24
    defaultOffsets =
    defaultViewports = md
    defaultFluid = 0
    cssPath = fileadmin/razor/Assets/Bootstrap/css/bootstrap.min.css
    jsPath = fileadmin/razor/Assets/Bootstrap/js/bootstrap.min.js
  }

  fontAwesome {
    activate = 1
  }

  search {
    activate = 0
    pid = 13
    results = 10
  }

  spam {
    protectEmail = 0
  }

  seo {
    gaCodeLive = UA-XXXXXXXX-Y
    googlePlus =
    description =
    piwik = 0
    piwikUrl =
    piwikSite =
    piwikSiteId =
  }

  image {
    galleryEffect = fade
    srcSet = 320,697,970,1200
    tinyPngApiKey = G4a62COu_asTIa-9sUsNn_oN-SpqOspP
  }

  powermail {
    powermailEmail = no-reply@giennale.de
    siteKey =
    secretKey =
  }

  cookieConsent {
    activate = 0
    revokable = true
    popupBackgroundColor = #edeff5
    popupTextColor = #838391
    buttonBackgroundColor = #4b81e8
    buttonTextColor = #ffffff
  }

  news {
    activateDisqus = 0
    disqusShortname =
    lightbox = 1
    cropMaxCharacters = 350
  }

  rss {
    activate = 1
    title = GIENNALE
    description = GIENNALE
    link = http://www.giennale.de
    language = de-de
    copyright = Testproject
    category =
    generator =
    maxItems = 30
    categories = 2
    categoryConjunction = and
    detailPid = 16
    startingPoint = 14
  }

  misc {
    wow = 0
    animate = 1
    responsiveTables = 1
    hyphenator = 0
    retinaJs = 0
    hoverCss = 0
    normalizeCss = 1
    showWrap = 1
    fileIcons = fileadmin/razor/Images/Icons/Filetypes/
    copyright = TYPO3 implementation by @razor
    languageDetection = 0
    deactivateMainFilesMergeLocal = 0
    mainCss = fileadmin/razor/Dist/Main.css
    mainJs = fileadmin/razor/Dist/Main.js
  }
}

# # Set https, if set in page options
[globalString = IENV:TYPO3_SSL=1]

razor {
  protocol {
    local = https
    staging = https
    live = https
    feature = https
  }
}

[global]

# # Settings [END]
