<?php
class DbSelect extends DbConfig {
	private $dbh;
	public $errors = array();
	private $name;

	public function __construct() {
		$this->name = "DbSelect";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {
	}

	public function login($username, $password) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
			$stmt->bindValue(":username", $username, PDO::PARAM_STR);
			$stmt->bindValue(":password", $password, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCityIDs() {
		/*
			SELECT * FROM city c, university u, campus cam
			WHERE u.fk_cityID = c.id
			AND cam.fk_university_id = u.id
		*/
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM city");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCity($shortName) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM city WHERE short_name=:shortName");
			$stmt->bindValue(":shortName", $shortName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampuses() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getUniversitiesFromCityID($cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM university WHERE fk_university_city=:cityID");
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampusFromUniversityID($university_id) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE fk_campus_university=:university_id");
			$stmt->bindValue(":university_id", $university_id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampusFromName($campusName) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE campus_name=:campusName");
			$stmt->bindValue(":campusName", $campusName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	/*
	 * Ad-related
	 */
	public function getAdTypes() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adType");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdTypeFromID($adID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adType WHERE id=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdTypeFromName($adName) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adType WHERE name=:adName");
			$stmt->bindValue(":adName", $adName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAds($cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_city=:cityID ORDER BY id DESC");
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsWithTypeIDFromCity($adTypeID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_adType=:adTypeID AND fk_ad_city=:cityID ORDER BY id DESC");
			$stmt->bindValue(":adTypeID", $adTypeID, PDO::PARAM_INT);
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsFromCampus($campusID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_campus=:campusID AND fk_ad_city=:cityID ORDER BY id DESC");
			$stmt->bindValue(":campusID", $campusID, PDO::PARAM_INT);
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsWithTypeFromCampus($adTypeID, $campusID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_adType=:adTypeID AND fk_ad_campus=:campusID AND fk_ad_city=:cityID ORDER BY id DESC");
			$stmt->bindValue(":adTypeID", $adTypeID, PDO::PARAM_INT);
			$stmt->bindValue(":campusID", $campusID, PDO::PARAM_INT);
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdFromID($adID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE id=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}
}
?>