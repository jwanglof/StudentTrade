<?php

class DbSelect {
	private $db;
	private $errors = array();

	public function __construct(PDO $db) {
		$this->db = $db;
	}

	public function login($username, $password) {
		$this->db->prepare();
		// http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
	}
}

?>