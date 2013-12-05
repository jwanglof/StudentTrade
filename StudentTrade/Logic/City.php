<?php
class City extends DbSelect {
	private $rootDir;

	private $category;
	private $campus;

	public function __construct() {
		$this->rootDir = realpath(dirname(__DIR__));

		parent::__construct();
	}

	public function __destruct() {}

	public function setCategory($category) {
		$this->category = $category;
	}

	public function getCategory() {
		// Check if the category is set
		// if it is then it will return the entire array from the DB
		// else it will set the default heading color
		if (isset($this->category))
			return parent::getAdCategoryFromName($this->category);
		else
			return array("color" => "#565656", "description" => "Senaste annonserna");
	}
}
?>