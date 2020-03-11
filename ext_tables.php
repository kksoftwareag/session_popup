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

// Add flexforms for frontend plugin
$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

$pluginSignature = strtolower($extensionName) . '_sessionpopup';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/SessionpopupPlugin.xml');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]='layout,select_key,recursive';