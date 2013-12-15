<?php
class NewAd extends DbSelect {
	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {}

	public function getAdTypes() { return parent::getAdTypes(); }
	public function getAdCategories() { return parent::getAdCategories(); }
}
?>