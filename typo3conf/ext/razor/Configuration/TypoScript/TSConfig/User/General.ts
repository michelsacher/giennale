admPanel {
  enable {
    edit = 1
  }

  module {
    edit {
      forceDisplayFieldIcons = 0
    }
  }

  hide = 0
}

setup {
  override {
    edit_docModuleUpload = 0
    edit_showFieldHelp =
  }
}

backendToolbarItem {
  tx_opendocs {
    disabled = 1
  }
}

options {
  enableBookmarks = 0
	createFoldersInEB = 1
	clipboardNumberPads = 1

	pageTree {
		showNavTitle = 1
	}

  saveDocNew {
    pages = 0
    tt_content = 0

    tx_powermail_domain_model_answer = 0
    tx_powermail_domain_model_mail = 0
    tx_dce_domain_model_dce = 0
    sys_template = 0
  }

  saveDocView = 0
}

mod {
  xMOD_alt_doc {
    disableDescriptioncheckbox = 1
  }
}