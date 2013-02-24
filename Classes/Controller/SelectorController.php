<?php
namespace T3B\FluidLanguageSelector\Controller;

    /***************************************************************
     *  Copyright notice
     *
     *  (c) 2013 Anno v. Heimburg <anno@vonheimburg.de>
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

/**
 * Displays the language selector
 *
 * @package fluid_language_selector
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class SelectorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \T3B\FluidLanguageSelector\LanguageMenuBuilder
     */
    protected $menuBuilder;

    public function injectMenuBuilder(\T3B\FluidLanguageSelector\LanguageMenuBuilder $builder) {
        $this->menuBuilder = $builder;
    }

    public function showAction() {

        $menuItems = $this->menuBuilder->buildMenuItems($this->settings['defaultLanguageIsoCode']);

        $currentItem = NULL;
        $otherItems = array();
        foreach($menuItems as $item) {
            /** @var $item \T3B\FluidLanguageSelector\LanguageMenuItem */
            if($item->getIsCurrentLanguage()) {
                $currentItem = $item;
            } else {
                $otherItems[] = $item;
            }
        }

        $this->view->assign('all', $menuItems);
        $this->view->assign('current', $currentItem);
        $this->view->assign('other', $otherItems);

    }
}
