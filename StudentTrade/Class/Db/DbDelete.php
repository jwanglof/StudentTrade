<?php
class DbDelete extends DbConfig {
	private $dbh;
	public $errors = array();
	private $className;

	public function __construct() {
		$this->className = "DbDelete";

		parent::__construct();

		try {
			$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
			$this->dbh->beginTransaction();
		} catch (PDOException $e) {
			$this->errors = $e->getMessage();
		}
	}

	public function __destruct() {
		$this->dbh->commit();
	}

	public function deleteAdWithinDate($days) {
		echo $days;
		try {
			$stmt = $this->dbh->prepare("DELETE FROM ad WHERE date_created < DATE_SUB(NOW(), INTERVAL :days DAY)");
			$stmt->bindValue(":days", $days, PDO::PARAM_STR);
			
			$stmt->execute();

			$affectedRows = $stmt->rowCount();

			return $affectedRows;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			$this->errors = $e->getMessage();
		}
	}
}
?>