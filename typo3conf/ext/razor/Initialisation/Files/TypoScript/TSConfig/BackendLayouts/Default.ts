# # Default

mod {
  web_layout {
    BackendLayouts {
      default {
        title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:mainTemplate
        config {
          backend_layout {
            colCount = 1
            rowCount = 2
            rows {
              1 {
                columns {
                  1 {
                    name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:head
                    colPos = 1
                  }
                }
              }
              2 {
                columns {
                  1 {
                    name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:content
                    colPos = 0
                  }
                }
              }
            }
          }

        }
        icon = ../fileadmin/razor/Images/Icons/Backend/default.png
      }
    }
  }
}
