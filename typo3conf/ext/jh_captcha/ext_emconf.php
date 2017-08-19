<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "jh_captcha".
 *
 * Auto generated 23-05-2017 13:43
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Google reCAPTCHA v2.0',
  'description' => 'With this extension you can use reCAPTCHA v2.0 from Google in your own TYPO3 extensions as spam protection. Moreover, this extension can be easily used in powermail and formhandler forms.',
  'category' => 'fe',
  'author' => 'Jan Haffner',
  'author_email' => 'info@jan-haffner.de',
  'state' => 'stable',
  'uploadfolder' => true,
  'createDirs' => '',
  'clearCacheOnLoad' => 0,
  'version' => '1.3.1',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '6.2.0-7.6.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
      'powermail' => '2.2.0-3.11.99',
      'formhandler' => '2.0.0-2.4.99',
    ),
  ),
  'clearcacheonload' => true,
  'author_company' => '',
);

