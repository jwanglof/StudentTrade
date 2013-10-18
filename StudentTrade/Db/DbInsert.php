<?php
class DbInsert extends DbConfig {
	private $dbh;
	public $errors = array();
	private $className;

	public function __construct() {
		$this->className = "DbInsert";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {}

	public function insertIntoAdUserInfo($name, $email, $phonenumber) {
		try {
			$this->dbh->beginTransaction();

			$stmt = $this->dbh->prepare("INSERT INTO adUserInfo(`name`, `email`, `phonenumber`) VALUES(:name, :email, :phonenumber)");
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":email", $email, PDO::PARAM_STR);
			$stmt->bindParam(":phonenumber", $phonenumber, PDO::PARAM_INT);
			$stmt->execute();
	
			$newID = $this->dbh->lastInsertId();

			$this->dbh->commit();

			return $newID;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			return $e;
		}
	}

	public function insertIntoAd($title, $info, $password, $price, $date_created, $date_expired, $fk_adCategory, $fk_campus, $fk_city, $fk_adUserInfo, $fk_adType) {
		try {
			$this->dbh->beginTransaction();

			$stmt = $this->dbh->prepare("INSERT INTO ad(`title`, `info`, `password`, `price`, `date_created`, `date_expired`, `fk_ad_adCategory`, `fk_ad_campus`, `fk_ad_city`, `fk_ad_adUserInfo`, `fk_ad_adType`) 
				VALUES(:title, :info, :password, :price, :date_created, :date_expired, :fk_adCategory, :fk_campus, :fk_city, :fk_adUserInfo, :fk_adType)");
			$stmt->bindParam(":title", $title, PDO::PARAM_STR);
			$stmt->bindParam(":info", $info, PDO::PARAM_STR);
			$stmt->bindParam(":password", $password, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_INT);
			$stmt->bindParam(":date_created", $date_created, PDO::PARAM_STR);
			$stmt->bindParam(":date_expired", $date_expired, PDO::PARAM_STR);
			$stmt->bindParam(":fk_adCategory", $fk_adCategory, PDO::PARAM_INT);
			$stmt->bindParam(":fk_campus", $fk_campus, PDO::PARAM_INT);
			$stmt->bindParam(":fk_city", $fk_city, PDO::PARAM_INT);
			$stmt->bindParam(":fk_adUserInfo", $fk_adUserInfo, PDO::PARAM_INT);
			$stmt->bindParam(":fk_adType", $fk_adType, PDO::PARAM_INT);
			$stmt->execute();
	
			$newID = $this->dbh->lastInsertId();
			
			$this->dbh->commit();

			return $newID;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			return $e;
		}
	}

	public function insertIntoAdInfo($value, $fk_adSubCategory, $fk_ad) {
		try {
			$this->dbh->beginTransaction();

			$stmt = $this->dbh->prepare("INSERT INTO adInfo(`sub_category_value`, `fk_adInfo_adSubCategory`, `fk_adInfo_ad`) VALUES(:value, :fk_adSubCategory, :fk_ad)");
			$stmt->bindParam(":value", $value, PDO::PARAM_STR);
			$stmt->bindParam(":fk_adSubCategory", $fk_adSubCategory, PDO::PARAM_INT);
			$stmt->bindParam(":fk_ad", $fk_ad, PDO::PARAM_INT);
			$stmt->execute();
	
			$newID = $this->dbh->lastInsertId();
			
			$this->dbh->commit();

			return $newID;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			return $e;
		}
	}
}
?>