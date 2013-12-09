<?php
class City extends DbSelect {
	private $rootDir;

	public function __construct($city, $campus, $type) {
		$this->rootDir = realpath(dirname(__DIR__));

		parent::__construct();
	}

	public function __destruct() {}
}
?>