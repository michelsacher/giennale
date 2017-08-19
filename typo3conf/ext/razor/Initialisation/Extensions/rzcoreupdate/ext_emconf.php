<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "rzcoreupdate".
 *
 * Auto generated 11-03-2013 19:34
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'TYPO3 Core Updater',
    'description' => 'Informs you for TYPO3 Updates',
    'category' => 'be',
    'shy' => 0,
    'version' => '0.0.1',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 0,
    'lockType' => '',
    'author' => 'Raphael Zschorsch',
    'author_email' => 'rafu1987@gmail.com',
    'author_company' => '',
    'CGLcompliance' => '',
    'CGLcompliance_note' => '',
    'constraints' => array(
        'depends' => array(
            'extbase' => '6.2.0-7.6.99',
            'fluid' => '6.2.0-7.6.99',
            'typo3' => '6.2.0-7.6.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
    'autoload' => array(
        'psr-4' => array(
            'RZ\\Rzcoreupdate\\' => 'Classes',
        ),
    ),
    '_md5_values_when_last_written' => 'a:3:{s:21:"ext_conf_template.txt";s:4:"b63d";s:12:"ext_icon.gif";s:4:"6759";s:17:"ext_localconf.php";s:4:"6eff";}',
    'suggests' => array(),
);
