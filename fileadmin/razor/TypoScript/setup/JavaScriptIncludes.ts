# # Browsersync [BEGIN]

[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}] OR [userFunc = basedomain(local)]

page {
  footerData {
    9999 = TEXT
    9999 {
      value (
        <script type='text/javascript' id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://HOST:{$razor.browsersync.port}/browser-sync/browser-sync-client.js'><\/script>".replace("HOST", location.hostname));
        //]]></script>
      )
      insertData = 1
    }
  }
}

[global]

# # Browsersync [END]

# # Animation [BEGIN]

plugin.tx_vhs.settings.asset {
  razorThree {
    name = razorThree
    path = fileadmin/razor/Giennale/Three.js
  }
}

plugin.tx_vhs.settings.asset {
  razorDetector {
    name = razorDetector
    path = fileadmin/razor/Giennale/Detector.js
  }
}

plugin.tx_vhs.settings.asset {
  razorThreeX {
    name = razorThreeX
    path = fileadmin/razor/Giennale/THREEx.WindowResize.js
  }
}

plugin.tx_vhs.settings.asset {
  razorGiennale {
    name = razorGiennale
    path = fileadmin/razor/Giennale/giennale.js
  }
}

# # Animation [END]