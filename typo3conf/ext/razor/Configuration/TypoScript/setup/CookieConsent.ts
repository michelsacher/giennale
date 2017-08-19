# # Cookie Consent [BEGIN]

[globalVar = LIT:1 = {$razor.cookieConsent.activate}]

plugin.tx_vhs.settings.asset {
  cookieConsentCss {
    name = cookieConsentCss
    path = EXT:razor/Resources/Public/Bower/cookieconsent/build/cookieconsent.min.css
  }

  cookieConsentJs {
    name = cookieConsentJs
    path = EXT:razor/Resources/Public/Bower/cookieconsent/build/cookieconsent.min.js
  }

  cookieConsentJsCustom {
    name = cookieConsentJsCustom
    path = EXT:razor/Resources/Public/JavaScript/CookieConsent.js
    fluid = 1
    variables {
      revokable = {$razor.cookieConsent.revokable}

      palette {
        popup {
          background = {$razor.cookieConsent.popupBackgroundColor}
          text = {$razor.cookieConsent.popupTextColor}
        }

        button {
          background = {$razor.cookieConsent.buttonBackgroundColor}
          text = {$razor.cookieConsent.buttonTextColor}
        }
      }
    }
  }
}

[global]

# # Cookie Consent [END]