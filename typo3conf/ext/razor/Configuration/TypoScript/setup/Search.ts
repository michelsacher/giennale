# # Search [BEGIN]

[globalVar = LIT:1 = {$razor.search.activate}]

page {
  config {
    index_enable = 1
  }
}

plugin.tx_indexedsearch {
  view {
    templateRootPaths {
      20 = fileadmin/razor/Templates/Search/Templates/
    }
    partialRootPaths {
      20 = fileadmin/razor/Templates/Search/Partials/
    }
    layoutRootPaths {
      20 = fileadmin/razor/Templates/Search/Layouts/
    }
  }

  settings {
    displayRules = 0
    displayAdvancedSearchLink = 0

    defaultOptions {
      numberOfResults = 2
    }

    dateFormat {
      created = %d.%m.%Y
      modified = %d.%m.%Y
    }
  }

  _LOCAL_LANG {
    de {
      displayResults{
        page =
        previous = «
        next = »
      }
    }
  }
}

[global]

# # English
[globalVar = GP:L = 1]

plugin.tx_indexedsearch {
  settings {
    dateFormat {
      created = %m/%d/%Y
      modified = %m/%d/%Y
    }
  }
}

[global]

# # Search [END]