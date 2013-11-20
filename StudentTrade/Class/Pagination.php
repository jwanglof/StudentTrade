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

	public function __construct($itemsPerPage, $URL) {
		$this->itemsPerPage = $itemsPerPage;
		$this->URL = $URL;
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

 	public function setDbQuery($queryType, $cityID=NULL, $campusID=NULL, $categoryID=NULL) {
 		$limit = ($this->currentPageNumber - 1) * $this->itemsPerPage;

 		parent::__construct();
		if ($queryType == "getAdsWithAdCategoryFromCampus")
			$this->dbQuery = parent::getAdsWithAdCategoryFromCampus($categoryID, $campusID, $cityID);
		else if ($queryType == "getAdsWithAdCategoryIDFromCity")
			$this->dbQuery = parent::getAdsWithAdCategoryIDFromCity($categoryID, $cityID);
		else if ($queryType == "getAdsFromCampus")
			$this->dbQuery = parent::getAdsFromCampus($campusID, $cityID);
		else if ($queryType == "getAds")
			$this->dbQuery = parent::getAds($cityID);
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