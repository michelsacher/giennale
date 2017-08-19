# # SEO [BEGIN]

plugin {
  metaseo {
    metaTags {
      enableDC = 0
      revisit = 0
      useLastUpdate = 0
      useDetectLanguage = 0
      linkGeneration = 0
      opengraph = 0
      description = {$razor.seo.description}
    }
    pageTitle {
      applySitetitleToPrefixSuffix = 0
      sitetitleGlue = 
      sitetitleGlueSpaceAfter = 0
    }
  }
}

# # SEO [END]