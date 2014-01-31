<?php
class EditAd extends DbSelect {
	private $ad;

	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {}

	public function setAd($adID) {
		$this->ad 				= parent::getAdFromID($adID);
		// $this->adInfo 			= parent::getAdInfoFromAdID($this->ad["id"]);
		// $this->adUserInfo 		= parent::getAdUserInfoFromAdUserInfoID($this->ad["id"]);
		// $this->adCategory 		= parent::getAdCategoryFromID($this->ad["fk_ad_adCategory"]);
		// $this->adSubCategory 	= parent::getAdSubCategoryFromAdCategoryID($this->ad["fk_ad_adCategory"]);
		// $this->adType 			= parent::getAdTypeFromAdTypeID($this->ad["fk_ad_adType"]);
		// $this->pictures 		= parent::getPicturesFromAdID($this->ad["id"]);
	}

	public function getAd() 			{ return $this->ad; }
	// public function getAdInfo() 		{ return $this->adInfo; }
	// public function getUserInfo() 		{ return $this->adUserInfo; }
	// public function getAdCategory() 	{ return $this->adCategory; }
	// public function getAdSubCategory() 	{ return $this->adSubCategory; }
	// public function getAdType() 		{ return $this->adType; }
	// public function getPictures()		{ return $this->pictures; }
}
?>