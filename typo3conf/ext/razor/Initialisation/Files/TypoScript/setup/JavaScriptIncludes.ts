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