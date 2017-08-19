options {
	clearCache {
		pages = 1
		all = 1
		razor = 1
		system = 1
		realurl = 1
	}

  contextMenu {
    pageTree {
      disableItems = history,exportT3d,importT3d,expandBranch,collapseBranch,mountAsTreeroot
    }

    pageList {
      disableItems = history,versioning,moreoptions,edit_access
    }
  }
}

admPanel {
	enable {
		preview = 1
	}
}

# # Preconfigured settings [BEGIN]

setup {
	override {
		thumbnailsByDefault = 0
		edit_RTE = 1
		showHiddenFilesAndFolders = 0
		resizeTextareas = 0
		resizeTextareas_Flexible = 1
		copyLevels = 99
		field_recursiveDelete = 0
		rteCleanPasteBehaviour = pasteStructure
	}
	fields {
		thumbnailsByDefault {
			disabled = 1
		}
		edit_RTE {
			disabled = 1
		}
		titleLen {
			disabled = 1
		}
		startModule {
			disabled = 1
		}
		edit_docModuleUpload {
			disabled = 1
		}
		showHiddenFilesAndFolders {
			disabled = 1
		}
		resizeTextareas {
			disabled = 1
		}
		resizeTextareas_Flexible {
			disabled = 1
		}
		resizeTextareas_MaxHeight {
			disabled = 1
		}
		copyLevels {
			disabled = 1
		}
		recursiveDelete {
			disabled = 1
		}
		resetConfiguration {
			disabled = 1
		}
		simulate {
			disabled = 1
		}
		dragAndDropHideNewElementWizardInfoOverlay {
			disabled = 1
		}
		hideColumnHeaders {
			disabled = 1
		}
		hideContentPreview {
			disabled = 1
		}
		rteWidth {
			disabled = 1
		}
		rteHeight {
			disabled = 1
		}
		rteResize {
			disabled = 1
		}
		rteMaxHeight {
			disabled = 1
		}
	    rteCleanPasteBehaviour {
 	        disabled = 1
 	    }
 	    emailMeAtLogin {
 	    	disabled = 1
 	    }
	}
}

# # Preconfigured settings [END]
