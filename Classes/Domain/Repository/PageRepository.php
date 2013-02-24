<?php

namespace T3B\FluidLanguageSelector\Domain\Repository;

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
class PageRepository extends \T3B\ExtbaseCoreTables\Domain\Repository\PageRepository
{
    protected $pageFieldMapping = array(
        'uid' => 'uid',
        'pid' => 'pid',
        'title' => 'title',
        'subtitle' => 'subtitle',
        'nav_tilte' => 'navTitle'
    );

    public function initializeObject() {
        $this->objectType = 'T3B\ExtbaseCoreTables\Domain\Model\Page';
        parent::initializeObject();
    }

    /**
     * Finds the page record of the current page, translated into the requested language
     * @param int $sysLanguageUid
     * @return \T3B\ExtbaseCoreTables\Domain\Model\Page
     */
    public function findCurrentPageTranslation($sysLanguageUid) {
        $query = $this->createQuery();
        $uid = $GLOBALS['TSFE']->id;

        $query->getQuerySettings()->setSysLanguageUid($sysLanguageUid);
        $query->getQuerySettings()->setReturnRawQueryResult(TRUE);
        $query->matching($query->equals('uid', $uid));

        // sigh... we need to work with arrays, else extbase mucks this up royally because it does no know how to
        // deal with a single object in two different translations

        $rows = $query->execute();

        $pageRow = $rows[0];

        $result = new \T3B\ExtbaseCoreTables\Domain\Model\Page();

        foreach($this->pageFieldMapping as $column => $propertyName) {
            $result->_setProperty($propertyName, $pageRow[$column]);
        }

        return $result;
    }


}
