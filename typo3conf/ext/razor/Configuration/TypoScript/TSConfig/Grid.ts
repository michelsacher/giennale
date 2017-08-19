# # Backend layouts
<INCLUDE_TYPOSCRIPT: source="FILE:fileadmin/razor/TypoScript/TSConfig/BackendLayouts.ts">

# # Wrap
tx_gridelements.setup.razor_wrap {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:wrap
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:wrapDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/Wrap.xml
  icon = fileadmin/razor/Images/Icons/Grid/wrap.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:wrap
		header_layout = 101
	}

	topLevelLayout = 1

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:wrapContent
						colPos = 1
						allowed = gridelements_pi1
            allowedGridTypes = razor_container
					}
				}
			}
		}
	}
}

# # Container
tx_gridelements.setup.razor_container {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:container
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:containerDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/Container.xml
  icon = fileadmin/razor/Images/Icons/Grid/container.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:container
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:containerContent
						colPos = 1
					}
				}
			}
		}
	}
}

# # 2 columns
tx_gridelements.setup.razor_2cols {
  title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:2cols
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:2colsDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/2cols.xml
  icon = fileadmin/razor/Images/Icons/Grid/2cols.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:2cols
		header_layout = 101
	}

	config {
		colCount = 2
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentLeft
						colPos = 0
					}
					2 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentRight
						colPos = 1
					}
				}
			}
		}
	}
}

# # 3 columns
tx_gridelements.setup.razor_3cols {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:3cols
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:3colsDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/3cols.xml
  icon = fileadmin/razor/Images/Icons/Grid/3cols.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:3cols
		header_layout = 101
	}

	config {
		colCount = 3
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentLeft
						colPos = 0
					}
					2 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentMiddle
						colPos = 1
					}
					3 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentRight
						colPos = 2
					}
				}
			}
		}
	}
}

# # 4 columns
tx_gridelements.setup.razor_4cols {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:4cols
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:4colsDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/4cols.xml
  icon = fileadmin/razor/Images/Icons/Grid/4cols.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:4cols
		header_layout = 101
	}

	config {
		colCount = 4
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentLeft
						colPos = 0
					}
					2 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentMiddleLeft
						colPos = 1
					}
					3 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentMiddleRight
						colPos = 2
					}
					4 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:contentRight
						colPos = 3
					}
				}
			}
		}
	}
}

# # Backend Container
tx_gridelements.setup.razor_backendContainer {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:backendContainer
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:backendContainerDesc
  icon = fileadmin/razor/Images/Icons/Grid/container.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:backendContainer
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:backendContainerContent
						colPos = 2
					}
				}
			}
		}
	}
}


# # Infobox
tx_gridelements.setup.razor_infobox {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:infobox
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:infoboxDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/Infobox.xml
  icon = fileadmin/razor/Images/Icons/Grid/infobox.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:infobox
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:infoboxContent
						colPos = 1
					}
				}
			}
		}
	}
}

# # Tabs container
tx_gridelements.setup.razor_tabs_container {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tabsContainer
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tabsContainerDesc
	flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/TabsContainer.xml
  icon = fileadmin/razor/Images/Icons/Grid/tabs.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tabsContainer
		header_layout = 101
	}

	horizontal = 1

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:content
						colPos = 1
						allowed = gridelements_pi1
					}
				}
			}
		}
	}
}

# # Tab item
tx_gridelements.setup.razor_tabs_item {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tab
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tabDesc
  icon = fileadmin/razor/Images/Icons/Grid/tab.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:tab
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:content
						colPos = 1
					}
				}
			}
		}
	}
}

# # Accordion container
tx_gridelements.setup.razor_accordion_container {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordionContainer
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordionContainerDesc
  icon = fileadmin/razor/Images/Icons/Grid/accordion.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordionContainer
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:content
						colPos = 1
						allowed = gridelements_pi1
					}
				}
			}
		}
	}
}

# # Accordion item
tx_gridelements.setup.razor_accordion_item {
	title = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordion
	description = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordionDesc
  flexformDS = FILE:EXT:razor/Resources/Private/Templates/Grid/AccordionItem.xml
  icon = fileadmin/razor/Images/Icons/Grid/accordion_item.svg

	tt_content_defValues {
		header = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:accordion
		header_layout = 101
	}

	config {
		colCount = 1
		rowCount = 1

		rows {
			1 {
				columns {
					1 {
						name = LLL:EXT:razor/Resources/Private/Language/Grid/locallang.xlf:content
						colPos = 1
					}
				}
			}
		}
	}
}

# # Custom [BEGIN]

<INCLUDE_TYPOSCRIPT: source="FILE:fileadmin/razor/TypoScript/TSConfig/Grid.ts">

# # Custom [END]
