# # powermail [BEGIN]

plugin.tx_powermail {
  settings.setup.receiver {
    overwrite {
      replyToEmail = TEXT
      replyToEmail {
        data = GP:tx_powermail_pi1|field|email
        ifEmpty.value = {$razor.powermail.powermailEmail}
      }

      replyToName = TEXT
      replyToName {
        data = GP:tx_powermail_pi1|field|name
        ifEmpty.value = Neue Kontaktanfrage
      }
    }
  }
}

# # powermail [END]
