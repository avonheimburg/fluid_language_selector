<?php
namespace T3B\FluidLanguageSelector;

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
 * Creates appropriate language menu items for the current situation
 *
 * @package fluid_language_selector
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LanguageMenuBuilder implements \TYPO3\CMS\Core\SingletonInterface
{
    /**
     * @var \T3B\FluidLanguageSelector\Domain\Repository\PageRepository
     */
    protected $pageRepository;

    public function injectPageRepository(\T3B\FluidLanguageSelector\Domain\Repository\PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @var \T3B\ExtbaseCoreTables\Domain\Repository\SysLanguageRepository
     */
    protected $sysLanguageRepository;

    public function injectLanguageRepository(\T3B\ExtbaseCoreTables\Domain\Repository\SysLanguageRepository $languageRepository)
    {
        $this->sysLanguageRepository = $languageRepository;
    }

    /**
     * @var \Tx_StaticInfoTablesExtbase_Domain_Repository_StaticLanguageRepository
     */
    protected $staticLanguageRepository;

    public function injectStaticLanguageRepository(\Tx_StaticInfoTablesExtbase_Domain_Repository_StaticLanguageRepository $staticLangRepo)
    {
        $this->staticLanguageRepository = $staticLangRepo;
    }

    /**
     * Builds the menu items
     *
     * @param string $defaultLanguageIsoCode
     */
    public function buildMenuItems($defaultLanguageIsoCode) {
        $sysLanguages = $this->sysLanguageRepository->findAll();

        $defaultLanguage = $this->staticLanguageRepository->findOneByIsoCode($defaultLanguageIsoCode);

        $menuItems = array();

        $defaultMenuItem = new LanguageMenuItem();
        $defaultMenuItem->setSysLanguageUid(0);
        $defaultMenuItem->setLanguage($defaultLanguage);
        $defaultMenuItem->setPage($this->pageRepository->findCurrentPageTranslation(0));

        $menuItems[0] = $defaultMenuItem;


        foreach ($sysLanguages as $sysLanguage) {
            /** @var \T3B\ExtbaseCoreTables\Domain\Model\SysLanguage $sysLanguage */

            $sysLanguageUid = $sysLanguage->getUid();
            $menuItem = new LanguageMenuItem();


            $menuItem->setSysLanguageUid($sysLanguageUid);
            $menuItem->setPage($this->pageRepository->findCurrentPageTranslation($sysLanguageUid));
            $menuItem->setLanguage($sysLanguage->getStaticLanguage());

            $menuItems[] = $menuItem;
        }

        return $menuItems;
    }


}
