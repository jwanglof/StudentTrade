<?php
class Index extends DbSelect {
	private $rootDir;
	private $allCities;

	private $leftColumn = array();
	private $rightColumn = array();

	public function __construct() {
		$this->rootDir = realpath(dirname(__DIR__));

		parent::__construct();
		$this->allCities = parent::getCityIDs();

		$amoutOfCities = count($this->allCities);
		for ($i = 0; $i < $amoutOfCities; $i++) {
			if ($i < ($amoutOfCities/2))
				array_push($this->leftColumn, $this->allCities[$i]);
			else
				array_push($this->rightColumn, $this->allCities[$i]);
		}
	}

	public function __destruct() {}

	public function getLeftColumn() { return $this->leftColumn; }
	public function getRightColumn() { return $this->rightColumn; }
}
?>