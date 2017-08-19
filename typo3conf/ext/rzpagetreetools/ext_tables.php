<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (TYPO3_MODE == 'BE') {
    // TYPO3 6.2.x
    if (\TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version) >= 6002000) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerExtDirectComponent(
            'TYPO3.hideShow.Menue',
            'RZ\\Rzpagetreetools\\Tree\\Tools'
        );
    } else {
        $extPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY);
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerExtDirectComponent(
            'TYPO3.hideShow.Menue',
            $extPath . 'lib/class.tx_rzpagetreetools_tools_old.php:tx_rzpagetreetools_tools'
        );
    }

    $GLOBALS['TYPO3_CONF_VARS']['typo3/backend.php']['additionalBackendItems'][] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('rzpagetreetools', 'backend_ext.php');

    // Hide/Show in menu
    $GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= '
        options.contextMenu {
            table.pages.items {
                410 = ITEM
                410 {
                    name = hideInMenu
                    label = LLL:EXT:rzpagetreetools/locallang.xml:hideInMenu
                    iconName = apps-pagetree-page-not-in-menu
                    spriteIcon = apps-pagetree-page-not-in-menu
                    displayCondition = getRecord|nav_hide = 0 && canBeDisabledAndEnabled != 0
                    callbackAction = hideInMenu
                }
                420 = ITEM
                420 {
                    name = showInMenu
                    label = LLL:EXT:rzpagetreetools/locallang.xml:showInMenu
                    iconName = apps-pagetree-page-default
                    spriteIcon = apps-pagetree-page-default
                    displayCondition = getRecord|nav_hide = 1 && canBeDisabledAndEnabled != 0
                    callbackAction = showInMenu
                }
                950 = SUBMENU
                950 {
                    label = LLL:EXT:rzpagetreetools/locallang.xml:subMenu
                }
            }
        }
    ';

    // Standard
    $additionalOptions .= '
        [userFunc = user_check_be_user(1)]

        options.contextMenu {
            table.pages.items {
                950 {
                    100 = ITEM
                    100 {
                        name = standardPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:standardPage
                        iconName = apps-pagetree-page-default
                        spriteIcon = apps-pagetree-page-default
                        displayCondition =
                        callbackAction = standardPage
                    }
                }
            }
        }

        [global]
    ';

    // Backend page
    $additionalOptions .= '
        [userFunc = user_check_be_user(6)]

        options.contextMenu {
            table.pages.items {
                950 {
                    200 = ITEM
                    200 {
                        name = backendPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:backendPage
                        iconName = apps-pagetree-page-backend-users
                        spriteIcon = apps-pagetree-page-backend-users
                        displayCondition =
                        callbackAction = backendPage
                    }
                }
            }
        }

        [global]
    ';

    // Shortcut page
    $additionalOptions .= '
        [userFunc = user_check_be_user(4)]

        options.contextMenu {
            table.pages.items {
                950 {
                    300 = ITEM
                    300 {
                        name = shortcutPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:shortcutPage
                        iconName = apps-pagetree-page-shortcut
                        spriteIcon = apps-pagetree-page-shortcut
                        displayCondition =
                        callbackAction = shortcutPage
                    }
                }
            }
        }

        [global]
    ';

    // Mount page
    $additionalOptions .= '
        [userFunc = user_check_be_user(7)]

        options.contextMenu {
            table.pages.items {
                950 {
                    400 = ITEM
                    400 {
                        name = mountPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:mountPage
                        iconName = apps-pagetree-page-mountpoint
                        spriteIcon = apps-pagetree-page-mountpoint
                        displayCondition =
                        callbackAction = mountPage
                    }
                }
            }
        }

        [global]
    ';

    // URL page
    $additionalOptions .= '
        [userFunc = user_check_be_user(3)]

        options.contextMenu {
            table.pages.items {
                950 {
                    500 = ITEM
                    500 {
                        name = urlPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:urlPage
                        iconName = apps-pagetree-page-shortcut-external
                        spriteIcon = apps-pagetree-page-shortcut-external
                        displayCondition =
                        callbackAction = urlPage
                    }
                }
            }
        }

        [global]
    ';

    // Storage Folder
    $additionalOptions .= '
        [userFunc = user_check_be_user(254)]

        options.contextMenu {
            table.pages.items {
                950 {
                    600 = ITEM
                    600 {
                        name = storageFolder
                        label = LLL:EXT:rzpagetreetools/locallang.xml:storageFolder
                        iconName = apps-filetree-folder-default
                        spriteIcon = apps-filetree-folder-default
                        displayCondition =
                        callbackAction = storageFolder
                    }
                }
            }
        }

        [global]
    ';

    // Trash page
    $additionalOptions .= '
        [userFunc = user_check_be_user(255)]

        options.contextMenu {
            table.pages.items {
                950 {
                    700 = ITEM
                    700 {
                        name = trashPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:trashPage
                        iconName = apps-pagetree-page-recycler
                        spriteIcon = apps-pagetree-page-recycler
                        displayCondition =
                        callbackAction = trashPage
                    }
                }
            }
        }

        [global]
    ';

    // Menu page
    $additionalOptions .= '
        [userFunc = user_check_be_user(199)]

        options.contextMenu {
            table.pages.items {
                950 {
                    800 = ITEM
                    800 {
                        name = menuPage
                        label = LLL:EXT:rzpagetreetools/locallang.xml:menuPage
                        iconName = apps-pagetree-spacer
                        spriteIcon = apps-pagetree-spacer
                        displayCondition =
                        callbackAction = menuPage
                    }
                }
            }
        }

        [global]
    ';

    if ($additionalOptions != "") {
        $additionalOptions .= '
            options.contextMenu {
                table.pages.items {
                    949 = DIVIDER
                }
            }
        ';

        $GLOBALS['TYPO3_CONF_VARS']['BE']['defaultUserTSconfig'] .= $additionalOptions;
    }
}
