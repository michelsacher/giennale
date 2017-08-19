<?php
namespace RZ\Rzcoreupdate\Hook\Reports;

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
use TYPO3\CMS\Reports\Status;

class VersionStatusProvider implements \TYPO3\CMS\Reports\StatusProviderInterface
{

    public function getStatus()
    {
        return array(
            'Core Version' => $this->checkCoreVersion(),
        );
    }
    public function checkCoreVersion()
    {
        $GLOBALS['LANG']->includeLLFile('EXT:rzcoreupdate/locallang.xml');

        $helper = GeneralUtility::makeInstance('RZ\\Rzcoreupdate\\Lib\\Helper');
        $status = $helper->isUpToDate();

        switch ($status['systemState']) {
            case 'error':
                $versionState = Status::ERROR;
                break;
            case 'noUpdate':
                $versionState = Status::OK;
                break;
            case 'newMinorUpdate':
                $versionState = Status::WARNING;
                break;
            case 'newMajorUpdate':
                $versionState = Status::ERROR;
                break;
            case 'newSecurityUpdate':
                $versionState = Status::ERROR;
                break;
            default:
                $versionState = Status::ERROR;
                break;
        }

        $titleMessage = $GLOBALS['LANG']->getLL('rzcoreupdate_Hooks_Reports_VersionStatusProvider_' . $status['systemState'] . 'Title');
        $message = '<p>' . $GLOBALS['LANG']->getLL('rzcoreupdate_Hooks_Reports_VersionStatusProvider_' . $status['systemState']) . '</p>';
        $message .= $GLOBALS['LANG']->getLL('rzcoreupdate_Hooks_Reports_VersionStatusProvider_description');
        $message .= '<a href="http://http://typo3.org/download/" target="_blank">' . $GLOBALS['LANG']->getLL('download') . '</a> | <a href="http://wiki.typo3.org/TYPO3_CMS_' . $status['latest_installed_branch'] . '" target="_blank">' . $GLOBALS['LANG']->getLL('information') . '</a>';

        return GeneralUtility::makeInstance('TYPO3\\CMS\\Reports\\Status', '' . $GLOBALS['LANG']->getLL('latestCore') . '', $status['latest_installed_branch'] . ' - ' . $titleMessage, $message, $versionState);
    }

}
