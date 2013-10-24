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
			$stmt->bindParam(":active", 0, PDO::PARAM_INT);
			$stmt->bindParam(":id", $adID, PDO::PARAM_INT);
			// $stmt->execute(array(0, $adID));
			// $stmt->execute();
			$this->dbh->commit();
			$affectedRows = $stmt->rowCount();

			return $affectedRows;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			return $e;
		}
	}
}
?>