# # Config [BEGIN]

config {
  concatenateJs = 1
  compressJs = 1
}

# # Config [END]

# # JS Includes [BEGIN]

page {
  # # Clear all scripts (possibly from extensions)
  includeJS >
  includeJSFooter >
  includeJSFooterlibs >
  includeJsLibs >
}

plugin.tx_vhs.settings.asset {
  razorVendorJs {
    name = razorVendorJs
    path = fileadmin/razor/Dist/Vendor.js
  }
}

plugin.tx_vhs.settings.asset {
  razorBootstrapJs {
    name = razorBootstrapJs
    path = {$razor.bootstrap.jsPath}
  }
  razorHelperJs {
    name = razorHelperJs
    path = EXT:razor/Resources/Public/JavaScript/Helper.js
    dependencies = razorBootstrapJs
  }
}

# # IE8 and below
[userFunc = rzBrowser(Internet Explorer)] AND [userFunc = rzVersion(9, <)]

plugin.tx_vhs.settings.asset {
  razorHtml5shiv {
    name = razorHtml5shiv
    path = EXT:razor/Resources/Public/Bower/html5shiv/dist/html5shiv.min.js
  }
  razorRespond {
    name = razorRespond
    path = EXT:razor/Resources/Public/Bower/respond/dest/respond.min.js
  }
}

[end]

# # WOW.js
[globalVar = LIT:1 = {$razor.misc.wow}]

plugin.tx_vhs.settings.asset {
  razorWowJs {
    name = razorWowJs
    path = EXT:razor/Resources/Public/Bower/wow/dist/wow.min.js
  }
  razorWowCustomJs {
    name = razorWowCustomJs
    path = fileadmin/razor/Scripts/Wow.js
  }
}

[global]

# # Hyphenator
[globalVar = LIT:1 = {$razor.misc.hyphenator}]

plugin.tx_vhs.settings.asset {
  razorHyphenatorJs {
    name = razorHyphenatorJs
    path = EXT:razor/Resources/Public/Bower/Hyphenator/Hyphenator.js
  }
  razorHyphenatorCustomJs {
    name = razorHyphenatorCustomJs
    path = fileadmin/razor/Scripts/Hyphenator.js
  }
}

[global]

# # Retina.js
[globalVar = LIT:1 = {$razor.misc.retinaJs}]

plugin.tx_vhs.settings.asset {
  razorRetinaJs {
    name = razorRetinaJs
    path = EXT:razor/Resources/Public/Bower/retinajs/dist/retina.min.js
  }
}

[global]

plugin.tx_vhs.settings.asset {
  razorMainJs {
    name = razorMainJs
    path = fileadmin/razor/Dist/Main.js
    dependencies = razorHelper
  }
}

# # Local
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}] AND [globalVar = LIT:1 = {$razor.misc.deactivateMainFilesMergeLocal}] OR [userFunc = basedomain(local)] AND [globalVar = LIT:1 = {$razor.misc.deactivateMainFilesMergeLocal}]

plugin.tx_vhs.settings.asset {
  razorMainJs >
}

[global]

# # JS Includes [END]