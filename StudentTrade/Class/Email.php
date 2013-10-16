<?php
class Email {
	private $to;

	public function __construct($to) {
		$this->name = "Email";
		$this->to = $to;
	}

	public function __destruct() {
	}

	public function sendPassword($password) {
		$subject = "Ditt borttagningskod till din annons på StudentTrade.se";
		$message = "Tack för att du använder StudentTrade.se!\r\n\r\nDin borttagningskod är: ". $password .".\r\nDenna måste du ange för att kunna ta bort din annons på sajten.\r\n\r\n//StudentTrade.se";
		$headers = 'From: noreply@studenttrade.se' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion();

		mail($this->to, $subject, $message, $headers);
	}
}
?>