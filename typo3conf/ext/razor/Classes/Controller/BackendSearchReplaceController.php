<?php
namespace RZ\Razor\Controller;

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

/**
 * This class provides a search/replace backend module
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class BackendSearchReplaceController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Add search/replace tool
     *
     * @return bool FALSE
     */
    public function replaceAction()
    {
        // Include script
        include_once PATH_site . 'typo3conf/ext/razor/Resources/Private/Php/Search-Replace-DB/index.php';

        return false;
    }

}