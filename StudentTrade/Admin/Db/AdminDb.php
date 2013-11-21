<?php
class AdminDb extends DbConfig {
	private $className;
	
	public function __construct() {
		$this->className = "AdminDb";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {}

	public function getAdmin($username, $password) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM `admin` WHERE `username`=:username AND `password`=:password");
			$stmt->bindValue(":username", $username, PDO::PARAM_STR);
			$stmt->bindValue(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}
}
?>