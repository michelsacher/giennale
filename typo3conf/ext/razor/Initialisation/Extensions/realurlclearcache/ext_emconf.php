<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "realurlclearcache".
 *
 * Auto generated 24-03-2014 21:35
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
    'title' => 'RealURL: Clear cache',
    'description' => 'Adds a clear cache button for RealURL in the back-end clear cache menu.',
    'category' => 'be',
    'shy' => 0,
    'version' => '0.0.2',
    'dependencies' => '',
    'conflicts' => '',
    'priority' => '',
    'loadOrder' => '',
    'module' => '',
    'state' => 'excludeFromUpdates',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearcacheonload' => 1,
    'lockType' => '',
    'author' => 'Raphael Zschorsch',
    'author_email' => 'rafu1987@gmail.com',
    'author_company' => '',
    'CGLcompliance' => null,
    'CGLcompliance_note' => null,
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
            'RZ\\Realurlclearcache\\' => 'Classes',
        ),
    ),
);
