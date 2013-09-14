<?php
class DbSelect {
    private $dbh;
    public $errors = [];
    private $name;

    private $config = [
        "dsn" => "mysql:host=localhost;dbname=StudentTrade;charset=utf8",
        "username" => "jwanglof",
        "password" => "testtest",
        "options" => [
        	PDO::ATTR_EMULATE_PREPARES => false,
        	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ];

    public function __construct() {
    	$this->name = "DbSelect";
        $this->dbh = new PDO($this->config["dsn"], $this->config["username"], $this->config["password"], $this->config["options"]);
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
			WHERE u.fk_city_id = c.id
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

    public function getCity($short_name) {
    	try {
    		$stmt = $this->dbh->prepare("SELECT * FROM city WHERE short_name=:short_name");
    		$stmt->bindValue(":short_name", $short_name, PDO::PARAM_STR);
    		$stmt->execute();

    		return $stmt->fetch(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getUniversitiesFromCityID($city_id) {
    	try {
    		$stmt = $this->dbh->prepare("SELECT * FROM university WHERE fk_city_id=:city_id");
    		$stmt->bindValue(":city_id", $city_id, PDO::PARAM_INT);
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getCampusFromUniversityID($university_id) {
    	try {
    		$stmt = $this->dbh->prepare("SELECT * FROM campus WHERE fk_university_id=:university_id");
    		$stmt->bindValue(":university_id", $university_id, PDO::PARAM_INT);
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    /*
	 * Ad-related
     */
    public function getAdTypes() {
    	try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad_type");
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getAdTypeFromID($ad_id) {
    	try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad_type WHERE id=:ad_id");
			$stmt->bindValue(":ad_id", $ad_id, PDO::PARAM_INT);
    		$stmt->execute();

    		return $stmt->fetch(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getAdTypeFromName($ad_name) {
    	try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad_type WHERE name=:ad_name");
			$stmt->bindValue(":ad_name", $ad_name, PDO::PARAM_INT);
    		$stmt->execute();

    		return $stmt->fetch(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getAds() {
    	try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad ORDER BY id DESC");
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }

    public function getAdsWithTypeID($ad_type_id) {
    	try {
			$stmt = $this->dbh->prepare("SELECT * FROM ad WHERE fk_ad_type_id=:ad_type_id ORDER BY id DESC");
			$stmt->bindValue(":ad_type_id", $ad_type_id, PDO::PARAM_INT);
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }
}
?>