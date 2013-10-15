<?php
class DbInsert extends DbConfig {
	private $dbh;
	public $errors = array();
	private $name;

	public function __construct() {
		$this->name = "DbInsert";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {
	}

	public function insertIntoAdUserInfo($name, $email, $phonenumber) {
		try {
			$stmt = $this->dbh->prepare("INSERT INTO adUserInfo(`name`, `email`, `phonenumber`) VALUES(:name, :email, :phonenumber)");
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_INT);
			$stmt->execute();

			return $this->dbh->lastInsertId();
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function insertIntoAd($title, $info, $price, $adType, $campus, $city, $adUserInfo) {
		try {
			$stmt = $this->dbh->prepare("INSERT INTO adUserInfo(`title`, `info`, `price`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) VALUES(:title, :info, :price, :adType, :campus, :city, :adUserInfo)");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":info", $info, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_INT);
			$stmt->bindParam(":adType", $adType, PDO::PARAM_INT);
			$stmt->bindParam(":campus", $campus, PDO::PARAM_INT);
			$stmt->bindParam(":city", $city, PDO::PARAM_INT);
			$stmt->bindParam(":adUserInfo", $adUserInfo, PDO::PARAM_INT);
			$stmt->execute();

			return $this->dbh->lastInsertId();
		} catch (PDOException $e) {
			return $e;
		}
	}

	/*
	public function login($username, $password) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
			$stmt->bindValue(":username", $username, PDO::PARAM_STR);
			$stmt->bindValue(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}
	*/
}
?>