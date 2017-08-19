# # Settings [BEGIN]

razor {
  basedomain {
    local = {$razor.basedomain.local}
  }

  site {
    projectName = {$razor.site.projectName}
    showProjectNameInMenu = {$razor.site.showProjectNameInMenu}
    breadcrumb = {$razor.site.breadcrumb}
    breadcrumbOnHomepage = {$razor.site.breadcrumbOnHomepage}
  }

  colors {
    tile = {$razor.colors.tile}
    theme = {$razor.colors.theme}
  }

  bootstrap {
    cols = {$razor.bootstrap.cols}
    defaultSizes = {$razor.bootstrap.defaultSizes}
    defaultOffsets = {$razor.bootstrap.defaultOffsets}
    defaultViewports = {$razor.bootstrap.defaultViewports}
    defaultFluid = {$razor.bootstrap.defaultFluid}
  }

  fontAwesome {
    activate = {$razor.fontAwesome.activate}
  }

  search {
    activate = {$razor.search.activate}
    pid = {$razor.search.pid}
  }

  seo {
    googlePlus = {$razor.seo.googlePlus}
    piwik = {$razor.seo.piwik}
    piwikUrl = {$razor.seo.piwikUrl}
    piwikSiteId = {$razor.seo.piwikSiteId}
  }

  image {
    galleryEffect = {$razor.image.galleryEffect}
    srcSet = {$razor.image.srcSet}
    tinyPngApiKey = {$razor.image.tinyPngApiKey}
  }

  misc {
    showWrap = {$razor.misc.showWrap}
    defaultHeaderType = {$styles.content.defaultHeaderType}
    fileIcons = {$razor.misc.fileIcons}
    deactivateMainFilesMergeLocal = {$razor.misc.deactivateMainFilesMergeLocal}
    mainCss = {$razor.misc.mainCss}
    mainJs = {$razor.misc.mainJs}
    responsiveTables = {$razor.misc.responsiveTables}
  }

  news {
    activateDisqus = {$razor.news.activateDisqus}
    disqusShortname = {$razor.news.disqusShortname}
  }

  rss {
    activate = {$razor.rss.activate}
    title = {$razor.rss.title}
    description = {$razor.rss.description}
    link = {$razor.rss.link}
    language = {$razor.rss.language}
    copyright = {$razor.rss.copyright}
    category = {$razor.rss.category}
    generator = {$razor.rss.generator}
  }
}

# # Settings [END]