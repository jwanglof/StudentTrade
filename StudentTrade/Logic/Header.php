<?php
class Header extends DbSelect {
	private $rootDir;
	private $universities = array();
	private $universityCampuses = array();

	private $currentCity;
	private $currentType;
	private $currentCampus;

	public function __construct() {
		$this->rootDir = realpath(dirname(__DIR__));

		parent::__construct();
	}

	public function __destruct() {}

	/*
	 *
	 * GETTERS
	 */
	public function getUniversities() { return $this->universities; }
	public function getCampuses() { return $this->universityCampuses; }
	public function getCities() { return parent::getCityIDs(); }
	public function getCurrentCity() { return $this->currentCity; }
	public function getAddNewAdURL($category, $campus) {
		$addNewAdURL = "index.php/city/". $this->currentCity["short_name"];
		if (isset($campus))
			$addNewAdURL .= "/campus/". $campus;
		if (isset($category))
			$addNewAdURL .= "/type/". $category;
		$addNewAdURL .= "/addNew";
		return $addNewAdURL;
	}
	public function getCategories($_category) {
		$categories = array();
		foreach (parent::getAdCategories() as $category) {
			if (!empty($_category)) {
				if ($_category == $category["name"])
					$category["linkClass"] = "categoryActive";
				else
					$category["linkClass"] = "categoryInactive";
			} else
				$category["linkClass"] = "categoryActive";
			array_push($categories, $category);
		}
		
		return $categories;
	}

	public function getBreadcrumbs($category, $campus, $adID) {
		$breadcrumbs = array();
		
		if (!empty($adID)) {
			$breadcrumbs["ad"] = parent::getAdFromID($adID);
			$breadcrumbs["category"] = parent::getAdCategoryFromID($breadcrumbs["ad"]["fk_ad_adCategory"]);
			$breadcrumbs["campus"] = parent::getCampusFromID($breadcrumbs["ad"]["fk_ad_campus"]);
		} else {
			if (isset($category))
				$breadcrumbs["category"] = parent::getAdCategoryFromName($category);

			if (isset($campus))
				$breadcrumbs["campus"] = parent::getCampusFromName($campus);
		}

		return $breadcrumbs;
	}

	/*
	 *
	 * SETTERS
	 */
	public function setCurrentCity($currentCity) {		
		$this->currentCity = parent::getCity($currentCity);
		// array_push($this->universityCampuses, array("id" => 999, "campus_name" => "Alla campus", "short_name" => "alla_campus", "fk_campus_university" => 1 ));

		// Need this because there might be more than one school in $city["id"]
		// E.g. Stockholm has KTH and Stockholms University
		foreach (parent::getUniversitiesFromCityID($this->currentCity["id"]) as $university) {
			array_push($this->universities, $university);
			foreach (parent::getCampusFromUniversityID($university["id"]) as $campus)
				array_push($this->universityCampuses, $campus);
		}
	}

	public function setUniversities() {
		// There might be more than one university in a city
	}

	public function setCampuses() {
	}
}
?>