<?php
class Email {
	private $className;
	private $to;

	public function __construct($to) {
		$this->className = "Email";
		$this->to = $to;
	}

	public function __destruct() {}

	public function sendPassword($password) {
		$subject = "Ditt borttagningskod till din annons på StudentTrade.se";
		$message = "Tack för att du använder StudentTrade.se!\r\n\r\nDin borttagningskod är: ". $password .".\r\nDenna måste du ange för att kunna ta bort din annons på sajten.\r\n\r\n//StudentTrade.se";
		$headers = 'From: StudenTrade <noreply@studenttrade.se>' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion();

		return mail($this->to, $subject, $message, $headers);
	}

	public function sendAdEmail($name, $from, $message) {
		$subject = "". $name ." är intresserad av din annons på StudentTrade.se";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: '. $name .' <'. $from .'>' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion();

		return mail($this->to, $subject, $message, $headers);
	}
}
?>