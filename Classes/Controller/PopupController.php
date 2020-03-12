<?php
namespace Webschmiede\SessionPopup\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2020 Karina Kern <karina@webschmiede.at>, Webschmiede GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * @package session_popup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class PopupController extends ActionController
{
    /**
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

        $this->view->assignMultiple($viewAssign);
    }
}
