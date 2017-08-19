<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TCA']['tx_razornews_domain_model_newscontent'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent',
        'label' => 'title',
        'label_alt' => 'type',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'hideTable' => true,
        'sortby' => 'sorting',
        'versioningWS' => 2,
        'versioning_followPages' => true,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'title,type,text,image,gallery,mp3,ogg,',
        'requestUpdate' => 'type,video_type,ratio',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('razornews') . 'Resources/Public/Icons/tx_razornews_domain_model_newscontent.svg',
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, title, text, image, ratio, width, height, crop, click_enlarge, gallery, video_type, video_id, video_file, poster, content, mp3, ogg',
    ),
    'types' => array(
        '1' => array(
            'showitem' => 'type, title, text;;;richtext:rte_transform[mode=ts_links], image, ratio, width, height, crop, click_enlarge, gallery, video_type, video_id, video_file, poster, content, mp3, ogg, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, starttime, endtime',
        ),
    ),
    'palettes' => array(
        '1' => array(
            'showitem' => '',
        ),
    ),
    'columns' => array(
        'sys_language_uid' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => array(
                    array(
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                    ),
                    array(
                        'LLL:EXT:lang/locallang_general.xlf:LGL.default_value',
                        0,
                    ),
                ),
            ),
        ),
        'l10n_parent' => array(
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => array(
                'type' => 'select',
                'items' => array(
                    array(
                        '',
                        0,
                    ),
                ),
                'foreign_table' => 'tx_razornews_domain_model_newscontent',
                'foreign_table_where' => 'AND tx_razornews_domain_model_newscontent.pid=###CURRENT_PID### AND tx_razornews_domain_model_newscontent.sys_language_uid IN (-1,0)',
            ),
        ),
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        't3ver_label' => array(
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ),
        ),
        'hidden' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ),
            ),
        ),
        'endtime' => array(
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')),
                ),
            ),
        ),
        'title' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.title',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ),
        ),
        'type' => array(
            'exclude' => 1,
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.text',
                        'Text',
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.image',
                        'Image',
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.gallery',
                        'Gallery',
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.video',
                        'Video',
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.audio',
                        'Audio',
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.type.content',
                        'Content',
                    ),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ),
        ),
        'text' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Text',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.text',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => array(
                    'RTE' => array(
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'module' => array(
                            'name' => 'wizard_rte',
                        ),
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                    ),
                ),
            ),
        ),
        'image' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Image',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.image',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('image', array(
                'maxitems' => 1,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                ),
                'foreign_types' => array(
                    '0' => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                    \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
                        'showitem' => '
                        --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                    ),
                ),
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'poster' => array(
            'exclude' => 1,
            'displayCond' => array(
                'AND' => array(
                    'FIELD:type:=:Video',
                    'FIELD:video_type:=:2',
                ),
            ),
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.poster',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('poster', array(
                'maxitems' => 1,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                ),
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'mp3' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Audio',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.mp3',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('mp3', array(
                'maxitems' => 1,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.addMp3File',
                ),
            ), 'mp3'),
        ),
        'ogg' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Audio',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.ogg',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('ogg', array(
                'maxitems' => 1,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.addOggFile',
                ),
            ), 'ogg'),
        ),
        'width' => array(
            'exclude' => 1,
            'displayCond' => array(
                'OR' => array(
                    'FIELD:type:=:Image',
                    'FIELD:type:=:Gallery',
                    'OR' => array(
                        'AND' => array(
                            'FIELD:type:=:Video',
                            'FIELD:ratio:=:3',
                        ),
                    ),
                ),
            ),
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.width',
            'config' => array(
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim',
            ),
        ),
        'height' => array(
            'exclude' => 1,
            'displayCond' => array(
                'OR' => array(
                    'FIELD:type:=:Image',
                    'FIELD:type:=:Gallery',
                    'OR' => array(
                        'AND' => array(
                            'FIELD:type:=:Video',
                            'FIELD:ratio:=:3',
                        ),
                    ),
                ),
            ), 'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.height',
            'config' => array(
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim',
            ),
        ),
        'crop' => array(
            'exclude' => 1,
            'displayCond' => array(
                'OR' => array(
                    'FIELD:type:=:Image',
                    'FIELD:type:=:Gallery',
                ),
            ), 'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.crop',
            'config' => array(
                'type' => 'check',
                'default' => 0,
            ),
        ),
        'click_enlarge' => array(
            'exclude' => 1,
            'displayCond' => array(
                'OR' => array(
                    'FIELD:type:=:Image',
                    'FIELD:type:=:Gallery',
                ),
            ), 'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.click_enlarge',
            'config' => array(
                'type' => 'check',
                'default' => 0,
            ),
        ),
        'gallery' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Gallery',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.gallery',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('gallery', array(
                'maxitems' => 99,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                ),
            ), $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ),
        'video_type' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Video',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_type',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_type.youtube',
                        0,
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_type.vimeo',
                        1,
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_type.html5Video',
                        2,
                    ),
                ),
                'size' => 1,
                'maxitems' => 1,
                'eval' => '',
            ),
        ),
        'video_id' => array(
            'exclude' => 1,
            'displayCond' => array(
                'AND' => array(
                    'FIELD:type:=:Video',
                    'OR' => array(
                        'FIELD:video_type:=:0',
                        'FIELD:video_type:=:1',
                    ),
                ),
            ),
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_id',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ),
        ),
        'video_file' => array(
            'exclude' => 1,
            'displayCond' => array(
                'AND' => array(
                    'FIELD:type:=:Video',
                    'FIELD:video_type:=:2',
                ),
            ),
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_file',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('video_file', array(
                'maxitems' => 3,
                'appearance' => array(
                    'createNewRelationLinkTitle' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.video_file.add',
                ),
            ), 'mp4, ogg, webm'),
        ),
        'ratio' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Video',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.ratio',
            'config' => array(
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => array(
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.ratio.1',
                        1,
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.ratio.2',
                        2,
                    ),
                    array(
                        'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.ratio.3',
                        3,
                    ),
                ),
                'size' => 1,
                'maxitems' => 1,
                'default' => 1,
            ),
        ),
        'content' => array(
            'exclude' => 1,
            'displayCond' => 'FIELD:type:=:Content',
            'label' => 'LLL:EXT:razornews/Resources/Private/Language/locallang_db.xlf:tx_razornews_domain_model_newscontent.content',
            'config' => array(
                'type' => 'group',
                'internal_type' => 'db',
                'allowed' => 'tt_content',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
                'wizards' => array(
                    'suggest' => array(
                        'type' => 'suggest',
                    ),
                ),
            ),
        ),
        'news' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
        'sorting' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),
    ),
);
