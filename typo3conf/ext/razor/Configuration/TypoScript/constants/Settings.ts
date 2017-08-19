# # Settings [BEGIN]

# customsubcategory=100=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:domain
# customsubcategory=101=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protocol
# customsubcategory=102=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:site
# customsubcategory=103=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:colors
# customsubcategory=104=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:bootstrap
# customsubcategory=105=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:fontAwesome
# customsubcategory=106=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:search
# customsubcategory=107=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:spam
# customsubcategory=108=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:seo
# customsubcategory=109=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:image
# customsubcategory=110=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:powermail
# customsubcategory=111=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:cookieConsent
# customsubcategory=112=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:news
# customsubcategory=113=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rss
# customsubcategory=114=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:misc

razor {
	basedomain {
		# cat=razor/100/001; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:basedomainLocal
		local = testproject.localhost

		# cat=razor/100/002; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:basedomainStaging
		staging = testproject.staging

		# cat=razor/100/003; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:basedomainLive
		live = www.testproject.live

		# cat=razor/100/004; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:basedomainFeature
		feature = testproject.feature
	}

  protocol {
    # cat=razor/101/005; type=options [http,https]; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protocolLocal
    local = http

    # cat=razor/101/006; type=options [http,https]; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protocolStaging
    staging = http

    # cat=razor/101/007; type=options [http,https]; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protocolLive
    live = http

    # cat=razor/101/008; type=options [http,https]; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protocolFeature
    feature = http
  }

	site {
		# cat=razor/102/009; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:projectName
		projectName = Test Project

    # cat=razor/102/010; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:showProjectNameInMenu
    showProjectNameInMenu = 1

    # cat=razor/102/011; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:breadcrumb
    breadcrumb = 1

    # cat=razor/102/012; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:breadcrumbOnHomepage
    breadcrumbOnHomepage = 0
  }

  colors {
    # cat=razor/103/013; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:tile
    tile = #000000

    # cat=razor/103/014; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:theme
    theme = #ffffff
  }

  bootstrap {
    # cat=razor/104/015; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:cols
    cols = 12

    # cat=razor/104/016; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:defaultSizes
    defaultSizes = 12

    # cat=razor/104/017; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:defaultOffsets
    defaultOffsets =

    # cat=razor/104/018; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:defaultViewports
    defaultViewports = md

    # cat=razor/104/019; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:defaultFluid
    defaultFluid = 0

    # cat=razor/104/020; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:cssPath
    cssPath = EXT:razor/Resources/Public/Bower/bootstrap/dist/css/bootstrap.min.css

    # cat=razor/104/021; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:jsPath
    jsPath = EXT:razor/Resources/Public/Bower/bootstrap/dist/js/bootstrap.min.js
  }

  fontAwesome {
    # cat=razor/105/022; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:activate
    activate = 1
  }

  search {
    # cat=razor/106/023; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:searchActivate
    activate = 1

    # cat=razor/106/024; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:searchPid
    pid = 13

    # cat=razor/106/025; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:searchResults
    results = 10
  }

  spam {
    # cat=razor/107/026; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:protectEmail
    protectEmail = 0
  }

  seo {
    # cat=razor/108/027; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:gaCodeLive
    gaCodeLive = UA-XXXXXXXX-Y

    # cat=razor/108/028; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:googlePlus
    googlePlus =

    # cat=razor/108/029; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:description
    description =

    # cat=razor/108/030; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:piwik
    piwik = 0

    # cat=razor/108/031; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:piwikUrl
    piwikUrl =

    # cat=razor/108/032; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:piwikSite
    piwikSite =

    # cat=razor/108/033; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:piwikSiteId
    piwikSiteId =
  }

  image {
    # cat=razor/109/034; type=options [LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:fade=Fade,LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:zoom=Zoom,LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:bw=Bw,LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:none=none]; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:galleryEffect
    galleryEffect = fade

    # cat=razor/109/036; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:srcSet
    srcSet = 320,697,970,1200

    # cat=razor/109/037; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:tinyPngApiKey
    tinyPngApiKey = G4a62COu_asTIa-9sUsNn_oN-SpqOspP
  }

  powermail {
    # cat=razor/110/038; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:powermailEmail
    powermailEmail = no-reply@razor.de

    # cat=razor/110/039; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:siteKey
    siteKey =

    # cat=razor/110/040; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:secretKey
    secretKey =
  }

  cookieConsent {
    # cat=razor/111/041; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:cookieActivate
    activate = 0

    # cat=razor/111/042; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:popupBackgroundColor
    popupBackgroundColor = #edeff5

    # cat=razor/111/043; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:popupTextColor
    popupTextColor = #838391

    # cat=razor/111/044; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:buttonBackgroundColor
    buttonBackgroundColor = #4b81e8

    # cat=razor/111/045; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:buttonTextColor
    buttonTextColor = #ffffff
  }

  news {
    # cat=razor/112/046; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:activateDisqus
    activateDisqus = 0

    # cat=razor/112/047; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:disqusShortname
    disqusShortname =

    # cat=razor/112/048; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:lightbox
    lightbox = 1

    # cat=razor/112/049; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:cropMaxCharacters
    cropMaxCharacters = 350
  }

  rss {
    # cat=razor/113/050; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssActivate
    activate = 1

    # cat=razor/113/051; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssTitle
    title = Testproject

    # cat=razor/113/052; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssDescription
    description = This is a testproject

    # cat=razor/113/053; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssLink
    link = http://www.my-domain.com

    # cat=razor/113/054; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssLanguage
    language = de-de

    # cat=razor/113/055; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssCopyright
    copyright = Testproject

    # cat=razor/113/056; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssCategory
    category = Testproject

    # cat=razor/113/057; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssGenerator
    generator = Testproject

    # cat=razor/113/058; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssMaxItems
    maxItems = 30

    # cat=razor/113/059; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssCategories
    categories = 2

    # cat=razor/113/060; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssCategoryConjunction
    categoryConjunction = and

    # cat=razor/113/061; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssDetailPid
    detailPid = 16

    # cat=razor/113/062; type=int; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:rssStartingPoint
    startingPoint = 14
  }

  misc {
    # cat=razor/114/063; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:wow
    wow = 0

    # cat=razor/114/064; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:animate
    animate = 0

    # cat=razor/114/065; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:responsiveTables
    responsiveTables = 1

    # cat=razor/114/066; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:hyphenator
    hyphenator = 0

    # cat=razor/114/067; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:retinaJs
    retinaJs = 0

    # cat=razor/114/068; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:hoverCss
    hoverCss = 0

    # cat=razor/114/069; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:normalizeCss
    normalizeCss = 0

    # cat=razor/114/070; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:showWrap
    showWrap = 1

    # cat=razor/114/071; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:fileIcons
    fileIcons = fileadmin/razor/Images/Icons/Filetypes/

    # cat=razor/114/072; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:copyright
    copyright = TYPO3 implementation by @razor

    # cat=razor/114/073; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:languageDetection
    languageDetection = 0

    # cat=razor/114/074; type=boolean; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:deactivateMainFilesMergeLocal
    deactivateMainFilesMergeLocal = 0

    # cat=razor/114/075; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:mainCss
    mainCss = fileadmin/razor/Dist/Main.css

    # cat=razor/114/076; type=string; label=LLL:EXT:razor/Resources/Private/Language/TypoScript/locallang.xlf:mainJs
    mainJs = fileadmin/razor/Dist/Main.js
  }
}

# # Settings [END]