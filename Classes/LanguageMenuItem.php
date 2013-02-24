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
 * Data for a single language menu item
 *
 * @package fluid_language_selector
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LanguageMenuItem
{
    /**
     * language
     * @var \Tx_StaticInfoTablesExtbase_Domain_Model_StaticLanguage
     */
    protected $language;

    /**
     * page record translated to that language, if any
     * @var \T3B\ExtbaseCoreTables\Domain\Model\Page
     */
    protected $page;

    /**
     * sys language uid
     * @var integer
     */
    protected $sysLanguageUid;


    /**
     * Check whether this menu item is the current language
     * @return bool
     */
    public function getIsCurrentLanguage()
    {
        /**
         * @var $tsfe \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
         */
        $tsfe = $GLOBALS['TSFE'];
        $currentLanguageId = $tsfe->sys_language_uid;

        return $currentLanguageId == $this->getSysLanguageUid();
    }

    /**
     * @return \Tx_StaticInfoTablesExtbase_Domain_Model_StaticLanguage
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return \T3B\ExtbaseCoreTables\Domain\Model\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getSysLanguageUid()
    {
        return $this->sysLanguageUid;
    }

    /**
     * @param \Tx_StaticInfoTablesExtbase_Domain_Model_StaticLanguage $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param \T3B\ExtbaseCoreTables\Domain\Model\Page $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @param int $sysLanguageUid
     */
    public function setSysLanguageUid($sysLanguageUid)
    {
        $this->sysLanguageUid = $sysLanguageUid;
    }

    /**
     * @return bool whether a page exists for this language
     */
    public function getPageExists() {
        return ! empty($this->page);
    }



}
