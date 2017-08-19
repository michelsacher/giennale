# # Templates [BEGIN]

page = PAGE
page {
  20 = FLUIDTEMPLATE
  20 {
    partialRootPath = fileadmin/razor/Templates/Site/Partials/
    file {
      stdWrap {
        cObject = CASE
        cObject {
          key {
            data = levelfield:-1, backend_layout_next_level, slide
            override {
              field = backend_layout
            }
          }
          default = TEXT
          default {
            value = fileadmin/razor/Templates/Site/MainTemplate.html
          }

          pagets__sub = TEXT
          pagets__sub {
            value = fileadmin/razor/Templates/Site/SubTemplate.html
          }
        }
      }
    }
  }
}

# # Templates [END]

# # Fluid content [BEGIN]

lib.fluidContent {
  layoutRootPaths {
    20 = EXT:razor/Resources/Private/Templates/Fluidcontent/Layouts/
  }
  templateRootPaths {
    20 = EXT:razor/Resources/Private/Templates/Fluidcontent/Templates/
  }
  partialRootPaths {
    20 = EXT:razor/Resources/Private/Templates/Fluidcontent/Partials/
  }
}

# # Fluid content [END]

# # Grid Elements [BEGIN]

tt_content.gridelements_pi1.20.10.setup {
  # # 2 columns
  razor_2cols < lib.gridelements.defaultGridSetup
  razor_2cols {
    cObject = FLUIDTEMPLATE
    cObject {
      file = EXT:razor/Resources/Private/Templates/Grid/Fluid/2cols.html
    }
  }

  # # 3 columns
  razor_3cols < lib.gridelements.defaultGridSetup
  razor_3cols {
    cObject = FLUIDTEMPLATE
    cObject {
      file = EXT:razor/Resources/Private/Templates/Grid/Fluid/3cols.html
    }
  }

  # # 4 columns
  razor_4cols < lib.gridelements.defaultGridSetup
  razor_4cols {
    cObject = FLUIDTEMPLATE
    cObject {
      file = EXT:razor/Resources/Private/Templates/Grid/Fluid/4cols.html
    }
  }

  # # Container
  razor_container < lib.gridelements.defaultGridSetup
  razor_container {
    cObject = FLUIDTEMPLATE
    cObject {
      file = EXT:razor/Resources/Private/Templates/Grid/Fluid/Container.html
    }
  }

  # # Backend Container
  razor_backendContainer < lib.gridelements.defaultGridSetup
  razor_backendContainer {
    columns {
     1 >
     2 < .default
     2 {
      # # Nothing here
    }
  }
}

# # Wrap
razor_wrap < lib.gridelements.defaultGridSetup
razor_wrap {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/Wrap.html
  }
}

# # Infobox
razor_infobox < lib.gridelements.defaultGridSetup
razor_infobox {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/Infobox.html
  }
}

# # Tabs container
razor_tabs_container < lib.gridelements.defaultGridSetup
razor_tabs_container {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/TabsContainer.html
  }
}

# # Tab item
razor_tabs_item < lib.gridelements.defaultGridSetup
razor_tabs_item {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/TabItem.html
    variables {
      uid = TEXT
      uid {
        field = uid
      }
      active = TEXT
      active {
        value = active
        if {
          value = 1
          equals.data = cObj:parentRecordNumber
          equals.prioriCalc = 1
        }
      }
    }
  }
}

# # Accordion container
razor_accordion_container < lib.gridelements.defaultGridSetup
razor_accordion_container {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/AccordionContainer.html
    variables {
      uid = TEXT
      uid {
        field = uid
      }
    }
  }
}

# # Accordion item
razor_accordion_item < lib.gridelements.defaultGridSetup
razor_accordion_item {
  cObject = FLUIDTEMPLATE
  cObject {
    file = EXT:razor/Resources/Private/Templates/Grid/Fluid/AccordionItem.html
    variables {
      uid = TEXT
      uid {
        field = uid
      }
      parentUid = TEXT
      parentUid {
        field = parentgrid_uid
      }
      active = TEXT
      active {
        value = active
        if {
          value = 1
          equals.data = cObj:parentRecordNumber
          equals.prioriCalc = 1
        }
      }
    }
  }
}
}

# # Grid Elements [END]

# # Outer wrap [BEGIN]

tt_content.stdWrap.outerWrap >
tt_content.stdWrap.outerWrap.cObject = USER
tt_content.stdWrap.outerWrap.cObject {
  userFunc = RZ\Razor\Controller\ToolsController->outerWrap
  visibility.field = tx_razor_visibility
  effect.field = tx_razor_wow
  classes.field = tx_razor_classes
}

# tt_content.stdWrap.innerWrap >

# # Outer wrap [END]

# # Table [BEGIN]

tt_content.table.20.innerStdWrap.htmlSpecialChars = 0

# # Table [END]