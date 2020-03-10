<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'Webschmiede.SessionPopup',
            'Sessionpopup',
            [
                'Popup' => 'show'
            ],
            // non-cacheable actions
            [
                
            ]
        );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    sessionpopup {
                        iconIdentifier = session_popup-plugin-sessionpopup
                        title = LLL:EXT:session_popup/Resources/Private/Language/locallang_db.xlf:tx_session_popup_sessionpopup.name
                        description = LLL:EXT:session_popup/Resources/Private/Language/locallang_db.xlf:tx_session_popup_sessionpopup.description
                        tt_content_defValues {
                            CType = list
                            list_type = sessionpopup_sessionpopup
                        }
                    }
                }
                show = *
            }
       }'
    );
		$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
		
			$iconRegistry->registerIcon(
				'session_popup-plugin-sessionpopup',
				\TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
				['source' => 'EXT:session_popup/Resources/Public/Icons/user_plugin_sessionpopup.svg']
			);
		
    }
);
