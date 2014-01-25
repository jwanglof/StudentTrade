<?php
class RemoveAd extends DbUpdate {
	private $adID;
	private $code;

	public function __construct($adID, $code) {
		parent::__construct();

		$this->adID = $adID;
		$this->code = $code;
	}

	public function __destruct() {
		parent::__destruct();
	}

	public function removeAd() {
		$dbSelect = new DbSelect();
		$cipher = new Cipher("JFKs3ef03J");

		$ad = $dbSelect->getAdFromID($this->adID);

		if ($ad["password"] == $cipher->encrypt($this->code)) {
			if (parent::updateAdActiveWithAdID($this->adID) > 0)
				return true;
			else
				return false;
		} else
			return 2;
	}
}
?>