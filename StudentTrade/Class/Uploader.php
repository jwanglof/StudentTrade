<?php
class Uploader extends DbUpdate {
	private $data;
	private $image;
	private $filename;

	public function __construct() {
		// Read RAW data
		$this->data = file_get_contents('php://input');
		// Read string as an image file
		$this->image = file_get_contents('data://'. substr($this->data, 5));
	}

	public function __destruct() {
		// Clean up memory
		unset($this->data);
		unset($this->image);
	}

	public function setFilename() {
		$this->filename = md5(mt_rand()). '.jpg';
	}

	public function getFilename() {
		return $this->filename;
	}

	public function saveToDisk($uploadDirConfig) {
		if ($uploadDirConfig == "local")
			$uploadDir = "/home/johan/Git/StudentTrade/Public/Upload/";
		else if ($uploadDirConfig == "jumpstarter")
			$uploadDir = "/home/http/Public/Upload/";

		if (!file_put_contents($uploadDir . $this->filename, $this->image)) {
		        header('HTTP/1.1 503 Service Unavailable');
		        exit();
		}

		array_push($_SESSION["newPictures"], $this->filename);
	}
}
?>