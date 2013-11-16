<?php
include_once("PHPMailer/PHPMailerAutoload.php");

class Email {
	// Random names:
	// http://fantasynamegenerators.com/dwarf_wow_names.php#.UodGCHX4bMU
	private $className;
	private $mail;

	private $noReplyName = "Flossie Giles";
	private $noReplyEmail = "noreply@studenttrade.se";

	private $requestName = "Belkam Battlebrew";
	private $requestEmail = "request@studenttrade.se";

	private $abuseName = "Nhaerian Dawnflower";
	private $abuseEmail = "abuse@studenttrade.se";

	public function __construct($to) {
		$this->className = "Email";

		$this->mail = new PHPMailer;
		
		$this->mail->IsSMTP();
		// $this->mail->Host 		= "smtp.crystone.se";
		$this->mail->Host 		= "localhost";
		// $this->mail->Port 		= 587;
		$this->mail->SMTPAuth   = false;
		
		$this->mail->CharSet 	= "utf-8";
		$this->mail->WordWrap 	= 50;

		$this->mail->addAddress($to);

		// Set to 2 for debugging information
		$this->mail->SMTPDebug  = 0;
	}

	public function __destruct() {
		$this->mail = null;
	}

	public function sendContactEmail($name, $from, $message) {
		$this->mail->From 		= $from;
		$this->mail->FromName 	= $name;

		$this->mail->Subject 	= $name ." har något viktigt att säga!";
		$this->mail->Body 		= $message;
		
		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
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

		$this->mail->From 		= $this->noReplyEmail;;
		$this->mail->FromName 	= $this->noReplyName;;

		$this->mail->Subject 	= "Din borttagningskod till din annons på StudentTrade.se";
		$this->mail->Body 		= $message;
		
		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
	}

	public function sendAdEmail($name, $from, $message) {
		$this->mail->From 		= $from;
		$this->mail->FromName 	= $name;

		$this->mail->Subject 	= $name ." är intresserad av din annons på StudentTrade.se";
		$this->mail->Body 		= $message;

		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
	}

	public function sendReportAdEmail($adID, $message) {
		$this->mail->From 		= $this->abuseEmail;
		$this->mail->FromName 	= $this->abuseName;

		$this->mail->Subject 	= "En anmälan mot en annons";
		$this->mail->Body 		= $message ."<br /> Annonsen det gäller har ID: ". $adID;
		
		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
	}

	public function sendRequestEmail($campusName, $cityName) {
		$message = "En användare vill lägga till följande campus: <br />
					<b>". $campusName ."</b> <br />
					Och i följande stad: <br />
					<b>". $cityName ."</b>";

		$this->mail->From 		= $this->requestEmail;
		$this->mail->FromName 	= $this->requestName;

		$this->mail->Subject 	= "Förfrågan om att lägga till campus";
		$this->mail->Body 		= $message;
		
		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
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

		$this->mail->From 		= $this->noReplyEmail;
		$this->mail->FromName 	= $this->noReplyName;

		$this->mail->Subject 	= "Din borttagningskod till din annons på StudentTrade.se";
		$this->mail->Body 		= $message;
		
		if(!$this->mail->Send())
			return $this->mail->ErrorInfo;
		else
			return True;
	}
}
?>