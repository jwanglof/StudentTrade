<?php
class Pagination extends DbConfig {
	private $dbh;

	public function __construct() {
		$this->className = "Pagination";
	}

	public function __destruct() {}

	public function getPager($totalRecords, $limit, $currentPage) {
		$pages = ceil($totalRecords/$limit);

		$page = min($pages, filter_var($currentPage, FILTER_VALIDATE_INT, array("options" => array("default"=>1, "min_range"=>1))));

		$offset = ($page - 1) * $limit;

		$start = $offset + 1;
		$end = min(($offset + $limit), $totalRecords);

		$prevPage = ($page > 1) ? "JA" : "NEJ";
		$nextPage = ($page < $pages) ? "JA" : "NEJ";

		return ;
	}

	public function getNoPages($totalRecords, $limit) {
		return ceil($totalRecords/$limit);
	}

	public function getCurrentPageContent($limit, $offset) {
		try {
			parent::__construct();
			$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());

			$stmt = $this->dbh->prepare("SELECT * FROM ad ORDER BY id LIMIT :limit OFFSET :offset");
			$stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
			$stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

			$stmt->execute();
			$this->dbh = null;

			$asd = array();

			if ($stmt->rowCount() > 0) {
				$stmt->setFetchMode(PDO::FETCH_ASSOC);
				$iterator = new IteratorIterator($stmt);

				foreach ($iterator as $row) {
					array_push($asd, $row);
				}
			} else {
				array_push($asd, "NOOOOPE");
			}

			return $asd;
			// return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}
}
?>