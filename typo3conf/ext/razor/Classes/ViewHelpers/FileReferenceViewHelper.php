<?php
namespace RZ\Razor\ViewHelpers;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * File reference ViewHelper
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class FileReferenceViewHelper extends AbstractViewHelper
{

    /**
     * File references
     *
     * @param string $table
     * @param string $field
     * @param int $uid
     * @return array
     */
    public function render($table, $field, $uid)
    {
        $fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $fileObjects = $fileRepository->findByRelation($table, $field, $uid);

        $files = array();
        foreach ($fileObjects as $key => $value) {
            $files[$key]['reference'] = $value->getReferenceProperties();
            $files[$key]['original'] = $value->getOriginalFile()->getProperties();
        }

        return $files;
    }

}
