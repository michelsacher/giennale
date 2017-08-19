<?php
namespace RZ\Rzcoreupdate\Lib;

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

class Helper
{

    public function getAllVersionInformation()
    {
        $versionInformation = json_decode(GeneralUtility::getURL('http://get.typo3.org/json'), true);

        return $versionInformation;
    }

    public function getAllVersionInformationByBranch($branch)
    {
        $versionInformation = $this->getAllVersionInformation();
        if (array_key_exists($branch, $versionInformation)) {
            //throw new Exception(json_encode($versionInformation[$branch]['releases']));
            return $versionInformation[$branch]['releases'];
        } else {
            return array();
        }
    }

    /**
     * @throws Exception
     */
    public function isUpToDate()
    {
        $versionInformation = $this->getAllVersionInformation();

        if ($versionInformation === null) {
            $return = array(
                'systemState' => 'error',
                'message' => 'Could not retrieve version information.',
                'installed' => TYPO3_version,
                'latest_installed_branch' => '?',
            );
        } else {
            if (($versionInformation['latest_lts'] === TYPO3_version) || ($versionInformation['latest_stable'] === TYPO3_version) || ($versionInformation['latest_old_stable'] === TYPO3_version)) {
                // system is uptodate - perfect
                $systemstate = 'noUpdate';
            } elseif (($this->getMinor($versionInformation['latest_lts']) === $this->getMinor(TYPO3_version)) || ($this->getMinor($versionInformation['latest_stable']) === $this->getMinor(TYPO3_version)) || ($this->getMinor($versionInformation['latest_old_stable']) === $this->getMinor(TYPO3_version)) || ($this->getMinor($versionInformation['latest_deprecated']) === $this->getMinor(TYPO3_version))) {
                // system is not uptodate, but the version is maintained, search for minor updates
                $minorVersion = $this->getMinor(TYPO3_version);
                $patchVersion = $this->getPatch(TYPO3_version);
                if (!array_key_exists($minorVersion . '.' . $patchVersion, $versionInformation[$this->getMinor(TYPO3_version)]['releases'])) {
                    $systemstate = 'error';
                    $message = 'installed TYPO3 version not found in version list';
                } else {
                    $systemstate = 'noUpdate';
                    $patchVersion++;

                    while (array_key_exists($minorVersion . '.' . $patchVersion, $versionInformation[$this->getMinor(TYPO3_version)]['releases'])) {
                        switch ($versionInformation[$this->getMinor(TYPO3_version)]['releases'][$minorVersion . '.' . $patchVersion]['type']) {
                            case 'regular':
                                if ($systemstate !== 'newSecurityUpdate') {
                                    $systemstate = 'newMinorUpdate';
                                }
                                break;
                            case 'security':
                                $systemstate = 'newSecurityUpdate';
                                break;
                            default:
                                throw new Exception('unknown update type');
                                break;
                        }
                        $patchVersion++;
                    }
                }
            } else {
                // system is not uptodate, version is not maintained anymore
                $systemstate = 'newMajorUpdate';
            }
            $return = array(
                'systemState' => $systemstate,
                'latest_lts' => $versionInformation['latest_lts'],
                'latest_stable' => $versionInformation['latest_stable'],
                'latest_old_stable' => $versionInformation['latest_old_stable'],
                'latest_deprecated' => $versionInformation['latest_deprecated'],
                'latest_installed_branch' => $versionInformation[$this->getMinor(TYPO3_version)]['latest'],
                'installed' => TYPO3_version,
            );
            if (!empty($message)) {
                $return['message'] = $message;
            }
        }
        return $return;
    }

    protected function getMinor($version)
    {
        list($major, $minor, $patch) = explode('.', TYPO3_version);
        $branch_version = intval($major) . '.' . intval($minor);
        return $branch_version;
    }
    protected function getPatch($version)
    {
        list($major, $minor, $patch) = explode('.', TYPO3_version);
        return intval($patch);
    }

}
