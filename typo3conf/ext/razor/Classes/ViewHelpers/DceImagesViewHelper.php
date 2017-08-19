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

use TYPO3\CMS\Core\Resource\ProcessedFile;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * DCE image ViewHelper
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class DceImagesViewHelper extends AbstractViewHelper
{

    /**
     * Get dce images
     *
     * @param int $uid
     * @return string
     */
    public function render($uid)
    {
        /** @var \TYPO3\CMS\Frontend\Page\PageRepository $pageRepository */
        $pageRepository = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
        $rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
            'uid',
            'sys_file_reference',
            'tablenames=' . $GLOBALS['TYPO3_DB']->fullQuoteStr('tt_content', 'sys_file_reference') .
            ' AND uid_foreign=' . $uid . ' AND fieldname=' . $GLOBALS['TYPO3_DB']->fullQuoteStr(
                'images',
                'sys_file_reference'
            ) . $pageRepository->enableFields('sys_file_reference', $pageRepository->showHiddenRecords),
            '',
            'sorting_foreign',
            '',
            'uid'
        );

        if ($rows) {
            $imageTags = [];
            foreach (array_keys($rows) as $fileReferenceUid) {
                $fileReference = ResourceFactory::getInstance()->getFileReferenceObject($fileReferenceUid, []);
                $fileObject = $fileReference->getOriginalFile();
                if ($fileObject->isMissing()) {
                    continue;
                }
                $image = $fileObject->process(ProcessedFile::CONTEXT_IMAGECROPSCALEMASK, [
                    'width' => '50c',
                    'height' => '50',
                ]);

                // File extension
                $ext = pathinfo($image->getPublicUrl(true), PATHINFO_EXTENSION);
                $width = '';
                if ($ext == 'svg') {
                    $width = '50';
                }

                $imageTags[] = '<img src="' . $image->getPublicUrl(true) . '" class="dceFieldImage" width="' . $width . '">';
            }

            return implode('', $imageTags);
        }
    }

}
