<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function()
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Webschmiede.SessionPopup',
            'Sessionpopup',
            'Session Popup'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('session_popup', 'Configuration/TypoScript', 'Session Popup');

    }
);
