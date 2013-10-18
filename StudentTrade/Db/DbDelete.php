<?php
class DbDelete extends DbConfig {
	private $dbh;
	public $errors = array();
	private $className;

	public function __construct() {
		$this->className = "DbDelete";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {}

	public function deleteFromAdWithAdID($adID) {
		try {
			$this->dbh->beginTransaction();

			$stmt = $this->dbh->prepare("DELETE FROM ad WHERE id=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute()

			$affectedRows = $stmt->rowCount();

			$this->dbh->commit();

			return $affectedRows;
		} catch (PDOException $e) {
			return $e;
		}
	}
?>