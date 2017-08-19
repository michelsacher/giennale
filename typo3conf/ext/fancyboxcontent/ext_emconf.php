<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "fancyboxcontent".
 *
 * Auto generated 23-05-2017 13:43
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'fancyBox content',
  'description' => 'Inserts a fancybox plugin for content',
  'category' => 'plugin',
  'author' => 'Raphael Zschorsch',
  'author_email' => 'rafu1987@gmail.com',
  'state' => 'alpha',
  'uploadfolder' => false,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '2.0.6',
  'constraints' => 
  array (
    'depends' => 
    array (
      'extbase' => '7.6.0-7.6.99',
      'fluid' => '7.6.0-7.6.99',
      'typo3' => '7.6.0-7.6.99',
      'php' => '5.6.0-7.0.99',
      'vhs' => '',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'RZ\\Fancyboxcontent\\' => 'Classes',
    ),
  ),
  'clearcacheonload' => false,
  'author_company' => NULL,
);

