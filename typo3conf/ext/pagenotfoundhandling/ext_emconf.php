<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "pagenotfoundhandling".
 *
 * Auto generated 23-05-2017 13:43
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => '404 Page not found handling',
  'description' => 'Highly configurable 404 page handling. Supports multi domain systems with multiple languages.',
  'category' => 'fe',
  'author' => 'Agentur am Wasser | Maeder & Partner AG',
  'author_email' => 'development@agenturamwasser.ch',
  'state' => 'stable',
  'clearCacheOnLoad' => 1,
  'version' => '2.4.1',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '6.2.1-8.7.999',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
      'realurl' => '1.12.8',
    ),
  ),
  'uploadfolder' => false,
  'createDirs' => NULL,
  'clearcacheonload' => true,
  'author_company' => NULL,
);

