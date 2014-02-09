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
			$stmt = $this->dbh->prepare("UPDATE `ad` SET `active`=:active WHERE `id`=:adID");
			$stmt->bindValue(":active", 0, PDO::PARAM_INT);
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);

			$stmt->execute();

			$affectedRows = $stmt->rowCount();

			return $affectedRows;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			$this->errors = $e->getMessage();
		}
	}

	public function updateAdRequestCodeTime($adID, $setTime) {
		try {
			$stmt = $this->dbh->prepare("UPDATE `ad` SET `request_code`=:setTime WHERE `id`=:adID");
			$stmt->bindValue(":setTime", $setTime, PDO::PARAM_STR);
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);

			$stmt->execute();

			$affectedRows = $stmt->rowCount();

			return $affectedRows;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			$this->errors = $e->getMessage();
		}
	}

	public function updateAd($values) {
		try {
			$stmt = $this->dbh->prepare("UPDATE `ad` SET `title`=:title, `info`=:info, `price`=:price, `fk_ad_adCategory`=:fk_ad_adCategory, `fk_ad_campus`=:fk_ad_campus, `fk_ad_city`=:fk_ad_city, `fk_ad_adType`=:fk_ad_adType WHERE `id`=:adID");
			$stmt->bindValue(":title", $values["adTitle"], PDO::PARAM_STR);
			$stmt->bindValue(":info", nl2br($values["adInfo"]), PDO::PARAM_STR);
			$stmt->bindValue(":price", $values["price"], PDO::PARAM_INT);
			$stmt->bindValue(":fk_ad_adCategory", $values["adCategory"], PDO::PARAM_INT);
			$stmt->bindValue(":fk_ad_campus", $values["campus"], PDO::PARAM_INT);
			$stmt->bindValue(":fk_ad_city", $values["city"], PDO::PARAM_INT);
			$stmt->bindValue(":fk_ad_adType", $values["adType"], PDO::PARAM_INT);
			$stmt->bindValue(":adID", $values["aid"], PDO::PARAM_INT);

			$stmt->execute();

			$affectedRows = $stmt->rowCount();

			return $affectedRows;
		} catch (PDOException $e) {
			$this->dbh->rollback();
			$this->errors = $e->getMessage();
		}
	}

	public function updateAdUserInfo($values) {
		try {
			$stmt = $this->dbh->prepare("UPDATE `adUserInfo` SET `phonenumber`=:phonenumber WHERE `fk_adUserInfo_ad`=:adID");
			$stmt->bindValue(":phonenumber", $values["phonenumber"], PDO::PARAM_INT);
			$stmt->bindValue(":adID", $values["aid"], PDO::PARAM_INT);

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