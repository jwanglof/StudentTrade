<?php
include_once("PHPMailer/PHPMailerAutoload.php");

class Email {
	private $className;
	private $mail;

	private $noReplyName = "Flossie Giles";
	private $noReplyAddress = "noreply@studenttrade.se";

	public function __construct($to) {
		$this->className = "Email";

		$this->mail = new PHPMailer;
		
		$this->mail->IsSMTP();
		$this->mail->Host 		= "smtp.crystone.se";
		$this->mail->Port 		= 587;
		$this->mail->CharSet 	= "utf-8";
		$this->mail->WordWrap 	= 50;
		$this->mail->addAddress($to);
	}

	public function __destruct() {
		$this->mail = null;
	}

	public function sendContactEmail($name, $from, $message) {
		$this->mail->From 		= $from;
		$this->mail->FromName 	= $name;

		$this->mail->Subject 	= $name ." har något viktigt att säga!";
		$this->mail->Body 		= $message;
		
		return $this->mail->send();
	}

	public function sendNewAdEmail($password, $adID) {
		$message = "Tack för att du använder StudentTrade.se!
		<p>
			Du kan se din annons <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_show&city=linkoping&aid=". $adID ."\">här</a>
		</p>
		<p>
			Om din vara är såld, eller av någon annan anledning vill ta bort denna annons, använd denna kod: ". $password .", <br />
			eller tryck <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_delete&aid=". $adID ."&code=". $password ."\">här</a> för att ta bort annonsen direkt.
		</p>
		MVH StudentTrade.se";

		$this->mail->From 		= "noreply@studenttrade.se";
		$this->mail->FromName 	= "StudentTrade.se";

		$this->mail->Subject 	= "Din borttagningskod till din annons på StudentTrade.se";
		$this->mail->Body 		= $message;
		
		return $this->mail->send();
	}

	public function sendAdEmail($name, $from, $message) {
		$this->mail->From 		= $from;
		$this->mail->FromName 	= $name;

		$this->mail->Subject 		= $name ." är intresserad av din annons på StudentTrade.se";
		$this->mail->Body 		= $message;

		return $this->mail->send();
		// return False;
	}

	public function sendReportAdEmail($adID, $message) {
		$this->mail->From 		= $this->noReplyAddress;
		$this->mail->FromName 	= $this->noReplyName;

		$this->mail->Subject 	= "En anmälan mot en annons";
		$this->mail->Body 		= $message ."<br /> Annonsen det gäller har ID: ". $adID;
		
		return $this->mail->send();
	}

	public function sendRequestEmail($campusName, $cityName) {
		$message = "En användare vill lägga till följande campus: <br />
					<b>". $campusName ."</b> <br />
					Och i följande stad: <br />
					<b>". $cityName ."</b>";

		$this->mail->From 		= $this->noReplyAddress;
		$this->mail->FromName 	= $this->noReplyName;

		$this->mail->Subject 	= "Förfrågan om att lägga till campus";
		$this->mail->Body 		= $message;
		
		return $this->mail->send();
	}

	public function resendCode($adID, $password) {
		$message = "Hejsan!
		<p>
			Din borttagningskod är: ". $password ." <br />
			Du kan även trycka <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_delete&aid=". $adID ."&code=". $password ."\">här</a> för att ta bort annonsen direkt.
		</p>
		<p>
			Du kan se din annons <a href=\"http://www.studenttrade.se/beta/front.php?page=ad_show&city=linkoping&aid=". $adID ."\">här</a>
		</p>
		MVH StudentTrade.se";

		$this->mail->From 		= $this->noReplyAddress;
		$this->mail->FromName 	= $this->noReplyName;

		$this->mail->Subject 	= "Din borttagningskod till din annons på StudentTrade.se";
		$this->mail->Body 		= $message;
		
		return $this->mail->send();
	}
}
?>