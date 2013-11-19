<?php

/**
* http://www.developphp.com/view.php?tid=1349
*/
class Blaffs extends DbConfig {
	private $totalRows;
	private $itemsPerPage;
	private $lastPageNumber;

	private $currentPageNumber = 1;

	public function __construct($totalRows, $itemsPerPage) {
		$this->totalRows = $totalRows; 
		$this->itemsPerPage = $itemsPerPage;

		$this->lastPageNumber = ceil($totalRows / $itemsPerPage);

		// Make sure the last page is not lower than 1
		if ($this->lastPageNumber < 1)
			$this->lastPageNumber = 1;

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function setPageNumber($pageNumber) {
		if ($pageNumber < 1)
			$this->currentPageNumber = 1;
		else if ($pageNumber > $this->lastPageNumber)
			$this->currentPageNumber = $this->lastPageNumber;
		else
			$this->currentPageNumber = $pageNumber;
		return $this->currentPageNumber;
	}

	public function setLimit() {
		//$stmt = $this->dbh->prepare("SELECT * FROM ad ORDER BY id LIMIT :limit OFFSET :offset");
		$hej = ($this->currentPageNumber - 1) * $this->itemsPerPage;

		$stmt = $this->dbh->prepare("SELECT * FROM ad ORDER BY id LIMIT :limit, :offset");
		$stmt->bindParam(":limit", $hej, PDO::PARAM_INT);
		$stmt->bindParam(":offset", $this->itemsPerPage, PDO::PARAM_INT);

		$stmt->execute();
		$this->dbh = null;
	}

	public function getCurrentPage() {
		return $this->currentPageNumber;
	}

	public function getLastPage() {
		return $this->lastPageNumber;
	}

	public function getPages() {
		if ($this->lastPageNumber != 1) {
			
		}
	}
}
?>