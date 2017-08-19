# # sourceopt [BEGIN]

sourceopt {
  formatHtml = 1
  formatHtml.tabSize = 2
  removeComments = 0
}

# # sourceopt [END]

# # powermail [BEGIN]

plugin.tx_powermail {
  settings {
    styles {
      framework {
        fieldAndLabelWrappingClasses = form-group
        fieldClasses = form-control
      }
    }
    misc {
      htmlField = 1
      addQueryString = 1
    }
    sender {
      attachment = 1
    }
  }
}

# # powermail [END]

# # fancybox [BEGIN]

plugin.tx_fancyboxcontent {
  settings {
    addJquery = 0
    addFancybox = 0
  }
}

# # fancybox [END]

# # Google Maps [BEGIN]

plugin.tx_medgooglemaps {
  settings {
    addJquery = 0
  }
}

# # Google Maps [END]

# # MailChimp [BEGIN]

plugin.tx_rzmailchimp {
  settings {
    addParsley = 0
  }
}

# # MailChimp [END]