# # Standard Config [BEGIN]

page {
  config {
    disablePrefixComment = 1
  }
}

config {
  doctype = html5
  xmlprologue = none
  xhtml_cleaning = all
  disablePrefixComment = 1
  removeDefaultJS = 1
  removeDefaultCSS = 1
  admPanel = 0
  headerComment = {$razor.misc.copyright}
  typolinkLinkAccessRestrictedPages = 1
  spamProtectEmailAddresses = 0
  contentObjectExceptionHandler = 0
}

# # Spam protect eMail
[globalVar = LIT:1 = {$razor.spam.protectEmail}]

config {
  removeDefaultJS = 0
  spamProtectEmailAddresses = 1
}

[global]

# # Standard Config [END]

# # Basedomain [BEGIN]

# # Live
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.live}]

config.baseURL = {$razor.protocol.live}://{$razor.basedomain.live}/

[global]

# # Staging
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.staging}]

config.baseURL = {$razor.protocol.staging}://{$razor.basedomain.staging}/

[global]

# # Local
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.local}]

config.baseURL = {$razor.protocol.local}://{$razor.basedomain.local}/

[global]

# # Feature
[globalVar = IENV:HTTP_HOST = {$razor.basedomain.feature}]

config.baseURL = {$razor.protocol.feature}://{$razor.basedomain.feature}/

[global]

# # Basedomain [END]