<?php
class DbUpdate extends DbConfig {
	private $dbh;
	private $errors;
	private $className;

	public function __construct() {
		$this->className = "DbUpdate";

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

	public function updateAdActiveWithAdID($adID) {
		try {
			$stmt = $this->dbh->prepare("UPDATE `ad` SET `active`=:active WHERE `id`=:id");
			$stmt->bindValue(":active", 0, PDO::PARAM_INT);
			$stmt->bindValue(":id", $adID, PDO::PARAM_INT);

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