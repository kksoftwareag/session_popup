<?php
namespace Webschmiede\SessionPopup\Controller;

/***
 *
 * This file is part of the "session_popup" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2020 Karina Kern <karina@webschmiede.at>, Webschmiede GmbH
 *
 ***/

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class PopupController extends ActionController
{
    /**
     * Show Session Popup
     *
     * @return void
     */
    public function showAction()
    {
        $viewAssign = array();

        // image
        if ($this->settings['input'] == 'image') {
            $resourceFactory = \TYPO3\CMS\Core\Resource\ResourceFactory::getInstance();
            $fileReference = $resourceFactory->getFileReferenceObject($this->settings['image']);
            $viewAssign['image'] = $fileReference;
        }

        // content element
        if ($this->settings['input'] == 'ce') {
            $cObj = $this->configurationManager->getContentObject();
            $cObjConf = array(
                'tables' => 'tt_content',
                'source' => $this->settings['ce'],
                'dontCheckPid' => 1
            );
            $contentObject = $cObj->cObjGetSingle('RECORDS', $cObjConf);
            $viewAssign['ce'] = $contentObject;
        }

        // show only once per session (if activated in FlexForm)
        if (!$this->settings['session'] || !$this->alreadyShown()) {
            $showPopup = true;
            $viewAssign['show-popup'] = $showPopup;
            // store in session
            if ($this->settings['session']) {
                $sessionVars = $this->generateSessionData();
            }
        }

        $this->view->assignMultiple($viewAssign);
    }

    /**
     * @return void
     */
    protected function generateSessionData() {

        $sessionVars = $GLOBALS['TSFE']->fe_user->getKey('ses','session_popup');
        $sessionVars['shown'] = 1;
        $GLOBALS['TSFE']->fe_user->setKey('ses', 'session_popup', $sessionVars);
        $GLOBALS['TSFE']->storeSessionData();
    }

    /**
     * @return boolean
     */
    protected function alreadyShown() {
        // do not check if session storage is disabled in FlexForm
        if (!$this->settings['session']) return false;

        // get session data
        $sessionData = $GLOBALS['TSFE']->fe_user->getKey('ses','session_popup');

        // already shown?
        if ($sessionData['shown'] == 1) return true;

    }

}

