# # Language detection [BEGIN]

[globalVar = LIT:1 = {$razor.misc.languageDetection}]

plugin.tx_razorlanguagedetection = USER_INT
plugin.tx_razorlanguagedetection {
  userFunc = RZ\Razor\Utility\LanguageDetection->main

  sysLanguageUidToSysLanguageCode {
    0 = de
    1 = en 
  }

  defaultRedirectLanguage = 1

  languageCodeToLanguageUid {
    fr = 1
    it = 1
  }
}

page.29052015 < plugin.tx_razorlanguagedetection

[global]

# # Language detection [END]
