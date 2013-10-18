<?php
class DbUpdate extends DbConfig {
	private $dbh;
	public $errors = array();
	private $className;

	public function __construct() {
		$this->className = "DbUpdate";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {}

	public function updateAdActiveWithAdID($adID) {
		try {
			$this->dbh->beginTransaction();

			$stmt = $this->dbh->prepare("UPDATE ad SET active=? WHERE id=?");
			$stmt->execute(array(0, $adID));

			$affectedRows = $stmt->rowCount();

			$this->dbh->commit();

			return $affectedRows;
		} catch (PDOException $e) {
			return $e;
		}
	}
}
?>