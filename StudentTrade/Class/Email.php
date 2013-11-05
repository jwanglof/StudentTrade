<?php
class Email {
	private $className;
	private $to;

	public function __construct($to) {
		$this->className = "Email";
		$this->to = $to;
	}

	public function __destruct() {}

	public function sendNewAdEmail($password, $adID) {
		$subject = "Din borttagningskod till din annons på StudentTrade.se";

		$message = "Tack för att du använder StudentTrade.se!
		<p>Du kan se din annons <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_show&city=linkoping&aid=". $adID ."\">här</a></p>
		<p>
			Om din vara är såld, eller av någon annan anledning vill ta bort denna annons, använd denna kod: ". $password .", <br />
			eller tryck <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_delete&aid=". $adID ."&code=". $password ."\">här</a> för att ta bort annonsen direkt.
		</p>
		//StudentTrade.se";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: StudentTrade.se <noreply@studenttrade.se>' . "\r\n";
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

	public function sendReportAdEmail($message) {
		$subject = "En anmälan mot en annons";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: Flossie Giles <noreply@studenttrade.se>' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion();

		return mail($this->to, $subject, $message, $headers);
	}

	public function sendRequestEmail($campusName, $cityName) {
		$subject = "Förfrågan om att lägga till campus";

		$message = "En användare vill lägga till följande campus: <br />
					<b>". $campusName ."</b> <br />
					Och i följande stad: <br />
					<b>". $cityName ."</b>";

		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: Flossie Giles <noreply@studenttrade.se>' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion();

		return mail($this->to, $subject, $message, $headers);
	}
}
?>