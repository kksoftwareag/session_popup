<?php
defined('TYPO3') || die('Access denied.');

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'SessionPopup',
        'Sessionpopup',
        [
            \Webschmiede\SessionPopup\Controller\PopupController::class => 'show'
        ],
        // non-cacheable actions
        [
            \Webschmiede\SessionPopup\Controller\PopupController::class => 'show'
        ],
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.ext-sessionpopup {
                header = Session Popup
                after = common
                elements {
                    sessionpopup {
                        iconIdentifier = session_popup-plugin-sessionpopup
                        title = LLL:EXT:session_popup/Resources/Private/Language/locallang_db.xlf:tx_session_popup_sessionpopup.name
                        description = LLL:EXT:session_popup/Resources/Private/Language/locallang_db.xlf:tx_session_popup_sessionpopup.description
                        tt_content_defValues {
                            CType = sessionpopup_sessionpopup
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

})();
