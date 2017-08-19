<?php
namespace RZ\Razor\Hooks\Powermail;

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
 * Class to add some functionality to Powermail
 *
 * @author Raphael Zschorsch <rafu1987@gmail.com>
 */
class Powermail
{

    /**
     * Hook action
     *
     * @param t3lib_TCEmain $pObj
     * @return void
     */
    public function processDatamap_afterAllOperations(\TYPO3\CMS\Core\DataHandling\DataHandler &$pObj)
    {
        foreach ($pObj->datamap as $table => $data) {
            if ($table == 'tx_powermail_domain_model_form') {
                foreach ($data as $id => $fields) {
                    if (strpos($id, 'NEW') === false) {
                        // Get pages
                        $pagesUids = $this->getPages($id);

                        // Get fields
                        $fields = $this->getFields($pagesUids);

                        // Update fields
                        if ($fields) {
                            $this->updateFields($fields);
                        }
                    }
                }
            } elseif ($table == 'tx_powermail_domain_model_page') {
                foreach ($data as $id => $fields) {
                    if (strpos($id, 'NEW') === false) {
                        // Get fields
                        $fields = $this->getFields(array(
                            $id,
                        ));

                        // Update fields
                        if ($fields) {
                            $this->updateFields($fields);
                        }
                    }
                }
            } elseif ($table == 'tx_powermail_domain_model_field') {
                foreach ($data as $id => $fields) {
                    if (strpos($id, 'NEW') === false) {
                        // Get field
                        $field = $this->getField($id);

                        // Update field
                        if ($field) {
                            $this->updateFields($field);
                        }
                    }
                }
            }
        }
    }

    /**
     * Get pages
     *
     * @param int $id
     * @return array
     */
    private function getPages($id)
    {
        $ids = array();
        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid', 'tx_powermail_domain_model_page', 'forms=' . $id);
        while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
            $ids[] = $row['uid'];
        }

        return $ids;
    }

    /**
     * Get fields
     *
     * @param array $ids
     * @return array
     */
    private function getFields($ids)
    {
        $fields = array();
        foreach ($ids as $pUid) {
            $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,type,mandatory', 'tx_powermail_domain_model_field', 'pages=' . $pUid);
            while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
                // Check
                $check = $this->checkType($row['type']);

                if ($check) {
                    $fields[] = array(
                        'uid' => $row['uid'],
                        'mandatory' => $row['mandatory'],
                    );
                }
            }
        }

        return $fields;
    }

    /**
     * Get field
     *
     * @param string $field
     * @return array
     */
    private function getField($field)
    {
        $row = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow('uid,type,mandatory', 'tx_powermail_domain_model_field', 'uid=' . intval($field));

        // Check
        $check = $this->checkType($row['type']);

        if ($check) {
            $fieldArr[] = array(
                'uid' => $row['uid'],
                'mandatory' => $row['mandatory'],
            );

            return $fieldArr;
        }
    }

    /**
     * Check type
     *
     * @param string $type
     * @return bool TRUE if type is checked, FALSE otherwise
     */
    private function checkType($type)
    {
        $checkTypes = array(
            'submit',
            'captcha',
            'reset',
            'text',
            'content',
            'html',
            'hidden',
            'location',
            'typoscript',
        );

        if (in_array($type, $checkTypes)) {
            return true;
        }
    }

    /**
     * Update fields
     *
     * @param array $fields
     * @return void
     */
    private function updateFields($fields)
    {
        foreach ($fields as $field) {
            if ($field['mandatory']) {
                $GLOBALS['TYPO3_DB']->exec_UPDATEquery('tx_powermail_domain_model_field', 'uid=' . intval($field['uid']), array(
                    'mandatory' => 0,
                ));
            }
        }
    }

}
