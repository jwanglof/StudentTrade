<?php
require_once(dirname(dirname(__FILE__)) ."/Class/Cipher.php");

class EditAd extends DbSelect {
	private $ad;
	private $adInfo;

	public function __construct() {
		parent::__construct();
	}

	public function __destruct() {}

	public function setAd($adID) {
		$this->ad 				= parent::getAdFromID($adID);
		$this->adInfo 			= parent::getAdInfoFromAdID($this->ad["id"]);
		$this->adUserInfo 		= parent::getAdUserInfoFromAdUserInfoID($this->ad["id"]);
		$this->adCategory 		= parent::getAdCategoryFromID($this->ad["fk_ad_adCategory"]);
		$this->adSubCategory 	= parent::getAdSubCategoryFromAdCategoryID($this->ad["fk_ad_adCategory"]);
		$this->adType 			= parent::getAdTypeFromAdTypeID($this->ad["fk_ad_adType"]);
		// $this->pictures 		= parent::getPicturesFromAdID($this->ad["id"]);
	}

	public function getAd() 				{ return $this->ad; }
	public function getAdInfo() 			{ return $this->adInfo; }
	public function getUserInfo() 		{ return $this->adUserInfo; }
	public function getAdCategory() 	{ return $this->adCategory; }
	public function getAdSubCategory() 	{ return $this->adSubCategory; }
	public function getAdType() 			{ return $this->adType; }
	// public function getPictures()		{ return $this->pictures; }
	public function getAdTypes() 		{ return parent::getAdTypes(); }
	public function getAdCategories() 	{ return parent::getAdCategories(); }

	public function convertPassword($password) {
		$cipher = new Cipher("JFKs3ef03J");
		$encryptedPassword = $cipher->decrypt($password);
		$cipher = null;

		return $encryptedPassword;
	}
}
?>