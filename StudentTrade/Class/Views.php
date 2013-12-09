<?php
class Views extends DbSelect {
	private $rootDir;
	private $leftColumn = array();
	private $rightColumn = array();
	
	private $allCities;
	

	public function __construct($rootDir) {
		$this->rootDir = $rootDir;

		parent::__construct();
		$this->allCities = parent::getCityIDs();
	}

	public function __destruct() {}
}
?>