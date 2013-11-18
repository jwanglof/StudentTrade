<?php
class DbSelect extends DbConfig {
	private $dbh;
	public $errors = array();
	private $className;

	public function __construct() {
		$this->className = "DbSelect";

		parent::__construct();
		$this->dbh = new PDO(parent::getDsn(), parent::getUsername(), parent::getPassword(), parent::getOptions());
	}

	public function __destruct() {}

	public function login($username, $password) {
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

	public function getCityFromID($cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM city WHERE id=:cityID");
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampuses() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE id < 999");
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
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE fk_campus_university=:university_id AND id < 999");
			$stmt->bindValue(":university_id", $university_id, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampusFromName($campusName) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE campus_name=:campusName AND id < 999");
			$stmt->bindValue(":campusName", $campusName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getCampusFromID($campusID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE id=:campusID");
			$stmt->bindValue(":campusID", $campusID, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	/**************************************
	 *************				***********
	 *************  Ad-related	***********
	 *************				***********
	 **************************************/
	public function getAdCategories() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adCategory");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdCategoryFromID($adID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adCategory WHERE id=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdCategoryFromName($adName) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adCategory WHERE name=:adName");
			$stmt->bindValue(":adName", $adName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAds($cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_city=:cityID AND active=1 ORDER BY id DESC");
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsWithAdCategoryIDFromCity($adCategoryID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_adCategory=:adCategoryID AND fk_ad_city=:cityID AND active=1 ORDER BY id DESC");
			$stmt->bindValue(":adCategoryID", $adCategoryID, PDO::PARAM_INT);
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsFromCampus($campusID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_campus=:campusID AND fk_ad_city=:cityID AND active=1 ORDER BY id DESC");
			$stmt->bindValue(":campusID", $campusID, PDO::PARAM_INT);
			$stmt->bindValue(":cityID", $cityID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdsWithAdCategoryFromCampus($adCategoryID, $campusID, $cityID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_adCategory=:adCategoryID AND fk_ad_campus=:campusID AND fk_ad_city=:cityID AND active=1 ORDER BY id DESC");
			$stmt->bindValue(":adCategoryID", $adCategoryID, PDO::PARAM_INT);
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
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE id=:adID AND active=1");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdSubCategoryFromAdCategoryID($adCategoryID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adSubCategory WHERE fk_adTypeInfo_adCategory=:adCategoryID ORDER BY id DESC");
			$stmt->bindValue(":adCategoryID", $adCategoryID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdSubCategoryIDFromAdSubCategoryName($adSubCategoryName) {
		try {
			$stmt = $this->dbh->prepare("SELECT id FROM adSubCategory WHERE short_name=:adSubCategoryName");
			$stmt->bindValue(":adSubCategoryName", $adSubCategoryName, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdSubCategoryShortNames() {
		try {
			$stmt = $this->dbh->prepare("SELECT short_name FROM adSubCategory");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdTypes() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adType");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdTypeFromAdTypeID($adTypeID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adType WHERE id=:adTypeID");
			$stmt->bindValue(":adTypeID", $adTypeID, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdInfoFromAdID($adID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adInfo WHERE fk_adInfo_ad=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_STR);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdUserInfoFromAdUserInfoID($adID) {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adUserInfo WHERE fk_adUserInfo_ad=:adID");
			$stmt->bindValue(":adID", $adID, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAdSubCategories() {
		try {
			$stmt = $this->dbh->prepare("SELECT * FROM adSubCategory");
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}

	public function getAmountOfAds() {
		try {
			$stmt = $this->dbh->prepare("SELECT count(id) FROM ad");
			$stmt->execute();

			return $stmt->fetch(PDO::FETCH_COLUMN);
		} catch (PDOException $e) {
			return $e;
		}
	}

	/**************************************
	 *************				***********
	 *************  Search		***********
	 *************				***********
	 **************************************/
	public function searchAdsWithName($searchString, $city) {
		try {
			$stmt = $this->dbh->prepare("SELECT id,title,date_created,price,fk_ad_adCategory,fk_ad_adType,fk_ad_campus FROM ad WHERE title LIKE :searchString AND fk_ad_city=:city");
			$stmt->bindValue(":searchString", $searchString, PDO::PARAM_STR);
			$stmt->bindValue(":city", $city, PDO::PARAM_INT);
			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			return $e;
		}
	}
}
?>