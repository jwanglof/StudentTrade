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

	public function insertIntoAd($title, $info, $price, $fk_adType, $fk_campus, $fk_city, $fk_adUserInfo) {
		try {
			// date("Y-m-d H:i:s")
			// generatePin()
			$now = date("Y-m-d H:i:s");
			$monthFromNow = date("Y-m-d H:i:s", strtotime("+1 month"));
			$password = 1234;

			$stmt = $this->dbh->prepare("INSERT INTO ad(`title`, `info`, `password`, `price`, `date_created`, `date_expired`, `fk_ad_adType`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`) 
				VALUES(:title, :info, :password, :price, :date_created, :date_expired, :fk_adType, :fk_campus, :fk_city, :fk_adUserInfo)");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":info", $info, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_INT);
			$stmt->bindParam(":price", $price, PDO::PARAM_INT);
			$stmt->bindParam(":date_created", $now, PDO::PARAM_STR);
			$stmt->bindParam(":date_expired", $monthFromNow, PDO::PARAM_STR);
			$stmt->bindParam(":fk_adType", $fk_adType, PDO::PARAM_INT);
			$stmt->bindParam(":fk_campus", $fk_campus, PDO::PARAM_INT);
			$stmt->bindParam(":fk_city", $fk_city, PDO::PARAM_INT);
			$stmt->bindParam(":fk_adUserInfo", $fk_adUserInfo, PDO::PARAM_INT);
			$stmt->execute();

			return $this->dbh->lastInsertId();
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function insertIntoAdInfo($value, $fk_adTypeInfo, $fk_ad) {
		try {
			$stmt = $this->dbh->prepare("INSERT INTO adInfo(`value`, `fk_adInfo_adTypeInfo`, `fk_adInfo_ad`) VALUES(:value, :fk_adTypeInfo, :fk_ad)");
			$stmt->bindParam(":value", $value, PDO::PARAM_STR);
			$stmt->bindParam(":fk_adTypeInfo", $fk_adTypeInfo, PDO::PARAM_STR);
			$stmt->bindParam(":fk_ad", $fk_ad, PDO::PARAM_INT);
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