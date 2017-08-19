<?php

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

// TYPO3 razor backup
// Version 1.0 (29.08.2015)

// Autor: Raphael Zschorsch / www.rafu1987.de

if (!$_SERVER['REQUEST_URI']) {
    $arr = include "typo3conf/LocalConfiguration.php";
    $razor = unserialize($arr['EXT']['extConf']['razor']);

    $user = $razor['live_username'];
    $pass = $razor['live_password'];
    $db = $razor['live_database'];
    $host = $razor['live_host'];

    if (isset($argv[1])) {
        switch ($argv[1]) {
            case "user":
                echo $user;
                break;
            case "pass":
                echo $pass;
                break;
            case "db":
                echo $db;
                break;
            case "host":
                echo $host;
                break;
        }
    }
} else {
    die();
}