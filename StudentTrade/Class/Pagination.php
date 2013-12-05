<?php

/**
* http://www.developphp.com/view.php?tid=1349
*/
class Pagination extends DbSelect {
	private $totalRows;
	private $itemsPerPage;
	private $lastPageNumber;

	private $currentPageNumber;

	private $previousPage;

	public $links = "";

	private $URL;

	private $dbQuery;

	public function __construct($itemsPerPage) {
		$this->itemsPerPage = $itemsPerPage;
	}

	private function mempty() {
		foreach(func_get_args() as $arg)
			if(empty($arg))
				continue;
			else
				return false;
		return true;
	}

	public function setURL($URL) {
		$this->URL = $URL ."&pageNo=";
	}

	public function setLastPage() {
		$this->lastPageNumber = ceil(count($this->dbQuery) / $this->itemsPerPage);

		// Make sure the last page is not lower than 1
		if ($this->lastPageNumber < 1)
			$this->lastPageNumber = 1;
 	}

	public function setCurrentPage($pageNumber) {
		if ($pageNumber < 1)
			$this->currentPageNumber = 1;
		else if ($pageNumber > $this->lastPageNumber)
			$this->currentPageNumber = $this->lastPageNumber;
		else
			$this->currentPageNumber = $pageNumber;
	}

 	public function setDbQuery($cityID, $campusID, $categoryID, $searchString=NULL) {
 		$limit = ($this->currentPageNumber - 1) * $this->itemsPerPage;

 		parent::__construct();
		if (!$this->mempty($cityID, $campusID, $categoryID))
			$this->dbQuery = parent::getAdsWithAdCategoryFromCampus($categoryID, $campusID, $cityID);
		else if (!$this->mempty($categoryID, $cityID))
			$this->dbQuery = parent::getAdsWithAdCategoryIDFromCity($categoryID, $cityID);
		else if ($this->mempty($campusID, $cityID))
			$this->dbQuery = parent::getAdsFromCampus($campusID, $cityID);
		else if ($this->mempty($searchString, $cityID))
			$this->dbQuery = parent::searchAdsWithName($searchString, $cityID);
		else
			$this->dbQuery = parent::getAds($cityID);
		parent::__destruct();
 	}

	public function getCurrentAds() {
		$limit = ($this->currentPageNumber - 1) * $this->itemsPerPage;

		return array_slice($this->dbQuery, $limit, $this->itemsPerPage);
	}

	public function getCurrentPage() {
		return $this->currentPageNumber;
	}

	public function getLastPage() {
		return $this->lastPageNumber;
	}

	public function getNextPage() {
		// Next page
		if ($this->currentPageNumber != $this->lastPageNumber)
			// return $this->URL ."&pageNo=". ($this->currentPageNumber + 1);
			return ($this->currentPageNumber + 1);
	}

	public function getPreviousPage() {
		if ($this->currentPageNumber > 1)
			// return $this->URL ."&pageNo=". ($this->currentPageNumber - 1);
			return ($this->currentPageNumber - 1);
	}

	public function getURL() {
		return $this->URL;
	}

	public function getPages() {
		$pages = array();

		// Check that there is more then one page, else do nothing
		if ($this->lastPageNumber != 1) {
			for ($i = 1; $i <= $this->lastPageNumber; $i++)
				array_push($pages, $i);
		}

		return $pages;
	}
}
?>