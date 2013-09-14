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
    	echo "Destroying ". $this->name;
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

    /*
		SELECT 
    			city.id as c_id,
    			city.name as c_name,
    			uni.id as u_id,
    			uni.name as u_name,
    			cam.id = cam_id,
    			cam.name = cam_name 
    			FROM city 
    			INNER JOIN university as uni 
    			INNER JOIN campus as cam

    			SELECT * FROM city
    			UNION ALL
    			SELECT * FROM university WHERE fk_city_id = city.id
    			UNION ALL
    			SELECT * FROM campus WHERE fk_university_id = university.id
    */

    public function getCities() {
    	try {
    		$stmt = $this->dbh->prepare("
    			SELECT * FROM city c, university u, campus cam
    			WHERE u.fk_city_id = c.id
    			AND cam.fk_university_id = u.id
    		");
    		$stmt->execute();

    		return $stmt->fetchAll(PDO::FETCH_ASSOC);
    	} catch (PDOException $e) {
    		return $e;
    	}
    }
}
?>