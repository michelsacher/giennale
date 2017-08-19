# # Config [BEGIN]

config {
  concatenateCss = 1
  compressCss = 1
}

# # Config [END]

# # CSS Includes [BEGIN]

page {
  # # Clear all styles (possibly from extensions)
  includeCSS >
  includeCSSLibs >
}

plugin.tx_vhs.settings.asset {
  razorVendorCss {
    name = razorVendorCss
    path = fileadmin/razor/Dist/Vendor.css
  }
}

# # Normalize
[globalVar = LIT:1 = {$razor.misc.normalizeCss}]

plugin.tx_vhs.settings.asset {
  razorNormalize {
    name = razorNormalize
    path = EXT:razor/Resources/Public/Bower/normalize.css/normalize.css
  }
}

[global]

# # Main files
plugin.tx_vhs.settings.asset {
  razorBootstrapCss {
    name = razorBootstrapCss
    path = {$razor.bootstrap.cssPath}
  }
  razorDynamic {
    name = razorDynamic
    path = typo3temp/razor/razor.css
  }
}

# # Font Awesome
[globalVar = LIT:1 = {$razor.fontAwesome.activate}]

plugin.tx_vhs.settings.asset {
  razorFontawesome {
    name = razorFontawesome
    path = EXT:razor/Resources/Public/Bower/fontawesome/css/font-awesome.min.css
  }
}

[global]

# # Hover.css
[globalVar = LIT:1 = {$razor.misc.hoverCss}]

plugin.tx_vhs.settings.asset {
  razorHoverCss {
    name = razorHoverCss
    path = EXT:razor/Resources/Public/Bower/hover/css/hover-min.css
  }
}

[global]

# # Animate.css
[globalVar = LIT:1 = {$razor.misc.wow}] OR [globalVar = LIT:1 = {$razor.misc.animate}]

plugin.tx_vhs.settings.asset {
  razorAnimateCss {
    name = razorAnimateCss
    path = EXT:razor/Resources/Public/Bower/animate.css/animate.min.css
  }
}

[global]

[global]

# # Main
plugin.tx_vhs.settings.asset {
  razorMainCss {
    name = razorMainCss
    path = fileadmin/razor/Dist/Main.css
  }
}

# # Local
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}] AND [globalVar = LIT:1 = {$razor.misc.deactivateMainFilesMergeLocal}] OR [userFunc = basedomain(local)] AND [globalVar = LIT:1 = {$razor.misc.deactivateMainFilesMergeLocal}]

plugin.tx_vhs.settings.asset {
  razorMainCss >
}

[global]

# # CSS Includes [END]