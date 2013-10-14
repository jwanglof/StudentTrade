<?php
class DbConfig {
	private $dsn;
	private $username;
	private $password;
	private $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
	
	private $getLocalConfig = True;

	public function __construct() {
		if ($this->getLocalConfig) {
			$this->dsn = "mysql:host=localhost;dbname=db1162056_st;charset=utf8";
			$this->username = "jwanglof";
			$this->password = "testtest";
		} else {
			$this->dsn = "mysql:host=localhost;dbname=db1162056_st;charset=utf8";
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