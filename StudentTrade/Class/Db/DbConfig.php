<?php
class DbConfig {
	private $dsn;
	private $username;
	private $password;
	private $options = array(
			PDO::ATTR_EMULATE_PREPARES => false, 
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
			PDO::MYSQL_ATTR_FOUND_ROWS => true);
	
	private $connectionConfig = "local";

	public function __construct() {
		if ($this->connectionConfig == "local") {
			$this->dsn = "mysql:host=localhost;dbname=studenttrade;charset=utf8";
			$this->username = "root";
			$this->password = "geanbe33";
		} else if ($this->connectionConfig == "jumpstarter") {
			$this->dsn = "mysql:host=127.0.0.1;port=3306;dbname=studenttrade;charset=utf8";
			$this->username = "root";
			$this->password = "";
		} else if ($this->connectionConfig == "crystone") {
			$this->dsn = "mysql:host=83.168.227.176;port=3306;dbname=db1162056_st;charset=utf8";
			$this->username = "u1162056_st";
			$this->password = "&fdpni50{g";
		}
	}

	public function getDsn() {
		return $this->dsn;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getOptions() {
		return $this->options;
	}
}
?>