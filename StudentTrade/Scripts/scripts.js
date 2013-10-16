$(document).ready(function() {
	if (gup("campus") != "") {		
		var campus = gup("campus");
		$("#"+ campus).addClass("campusChosen").append("<span class=\"exit\">x</span>");
	}
	$(".campusChosen").click(function() {
		// Need .text() since an x-character is added when the link is clicked on
		// See code above
		$(this).removeClass("campusChosen").text($(this).text().slice(0,-1));
	});

	$(".footer li").hover(function() {
		$(this).css('cursor', 'pointer');
	});

	$("img.box1_img")
		.mouseenter(function() {
			bootbox.dialog({
				message: "Juppjupp",
				onEscape: function() {},
				backdrop: true,
				closeButton: true,
				animate: true
			});
		})
		.mouseleave(function() {
			$(".bootbox").modal("hide");
		});

	$("#city").ready(function() {
		// Select the correct city if a city is chosen
		if ($('#city').children(':selected').val() > 0)
			showCampuses($('#city').children(':selected').val());
	});
	$("#city").click(function() {
		showCampuses($(this).val());
	});

	$("#adType").ready(function() {
		// Select the correct category if a category is chosen
		if ($('#adType').children(':selected').val() > 0)
			showAdTypeInputs($('#adType').children(':selected').val());
	});
	$("#adType").click(function() {
		showAdTypeInputs($(this).val());
	});
});

function showCampuses(cityID) {
	$("#campus").empty();
	request = $.ajax({
		type: "post",
		url: "http://localhost/~johan/StudentTrade/StudentTrade/Views/ajax.php",
		data: {get: "campuses", cityID: cityID}
	});

	request.done(function(response, textStatus, jqXHR) {
		console.log(response);
		var objs = JSON.parse(response);
		$("#campus").append("<option value=\"9999\">Inget campus</option>");
		for (var key in objs) {
			// console.log(key +" -- "+ objs[key]);
			$("#campus").append("<option value=\""+ key +"\">"+ objs[key] +"</option>");
		};
	});
	request.fail(function(jqXHR, textStatus, errorThrown) {
		console.log(errorThrown);
		// bootbox.alert("Something went wrong!");
	});
}

function showAdTypeInputs(adType) {
	// Clear the div
	$("#adInput").empty();

	request = $.ajax({
		type: "post",
		url: "http://localhost/~johan/StudentTrade/StudentTrade/Views/ajax.php",
		data: {get: "adTypeInfo", adType: adType}
	});

	request.done(function(response, textStatus, jqXHR) {
		console.log(response);

		var objs = JSON.parse(response);
		for (var value in objs) {
			// $("#adInput").append("<label for=\"adTypeInfo_"+ objs[value]["id"] +"\" class=\"col-lg-1 control-label\">"+ objs[value]["name"] +"</label>");
			// $("#adInput").append("<div class=\"col-lg-5\" style=\"\"><input type=\"text\" class=\"form-control\" id=\"adTypeInfo_"+ objs[value]["id"] +"\" name=\"adTypeInfo_"+ objs[value]["id"] +"\" placeholder=\""+ objs[value]["name"] +"\"></div>");
			$("#adInput").append("<label for=\""+ objs[value]["short_name"] +"\" class=\"col-lg-1 control-label\">"+ objs[value]["name"] +"</label>");
			$("#adInput").append("<div class=\"col-lg-5\" style=\"\"><input type=\"text\" class=\"form-control\" id=\""+ objs[value]["short_name"] +"\" name=\""+ objs[value]["short_name"] +"\" placeholder=\""+ objs[value]["name"] +"\"></div>");
			$("#adInput").append("<br /><br />");
		}
	});
	request.fail(function(jqXHR, textStatus, errorThrown) {
		console.log(errorThrown);
	});
	// $("#adInput").append("<label for=\"address\" class=\"col-lg-1 control-label\">Adress</label>");
	// $("#adInput").append("<div class=\"col-lg-5\"><input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" placeholder=\"Adress\"></div>");
}

function gup(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regexS = "[\\?&]" + name + "=([^&#]*)";
    var regex = new RegExp(regexS);
    var results = regex.exec(window.location.href);
    if (results == null)
        return "";
    else
        return results[1];
} 

$(document).on("click", "#about_us", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Om oss</h1>",
		message: "<span style=\"color: #000;\">StudentTrade.se är en köp- och sälj sajt enbart för studenter. Hos oss kan du köpa och sälja saker som har studentlivet till. StudentTrade.se startades hösten 2013 av tre stundenter på Linköpings Universitet.</span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#how_it_works", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Så fungerar det</h1>",
		message: "<span style=\"color: #000;\">Hos oss är det lätt att både lägga upp annons och att hitta det du söker. Börja med att välja din studentstad på startsidan. Väl inne på sidan kan du sedan lätt sortera annonserna efter kategori och lägga upp annons genom att klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och blir tillgänlig för andra studenter.</span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#faq", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Vanliga frågor och svar</h1>",
		message: "<span style=\"color: #000;\"><p>Kostar det något att lägga upp en annons? <br /> Nej, tillskillnad från Blocket och andra sajter är det helt gratis att lägga upp en annons hos oss. Vi är också studenter och tycker inte man ska betala för att lägga upp en annons. </p> Hur tar jag bort min annons? <br /> När du lägger upp din annons får du en fyrsiffrig kod till den e-mail adress du angett. Om du vill ta bort din annons går du in på den, klickar på ”Ta bort annons” och anger din kod. Snabbt och enkelt! <p style=\"margin-top: 10px;\"> Vad gör jag om jag tycker att en annons är olämplig? <br /> Om du ser en annons som du inte tycker är olämplig kan du anmäla den till oss. Vi ser då om den bryter mot ”Regler kring annonsering” och beslutar med detta som grund om hurvida annonser ska bli borttagen eller inte. Om du vill veta vilka regler som gäller kring annonsering så hittar du det här: www.studenttrade.se/regler_kring_annonsering</span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#contact_us", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Kontakta oss</h1>",
		message: "<span style=\"color: #000;\">Är det något du undrar över är det bara höra av sig till: kontakt@stundenttrade.se <br />	Eller kontakta:	<p>	Fredrik Palmér på 073-52 00 511, <br /> Erik Hidrup på 073-07 33 077, <br /> Johan Wänglöf på 070-86 01 911</p></span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});