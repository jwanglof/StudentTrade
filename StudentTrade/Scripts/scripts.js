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
	$("#adAnswer").hover(function() {
		$(this).css('cursor', 'pointer');
	});

	$("#hover-img .thumbnail").hover(
		function() {
			$(this).find('.caption').slideDown(250);
            $(this).find('.caption-btm').fadeOut("fast");
		}, function() {
			$(this).find('.caption').slideUp(250);
            $(this).find('.caption-btm').fadeIn("fast");
		}
	);

	$("#city").ready(function() {
		// Select the correct city if a city is chosen
		if ($('#city').children(':selected').val() > 0)
			showCampuses($('#city').children(':selected').val());
	});
	$("#city").click(function() {
		showCampuses($(this).val());
	});

	$("#adCategory").ready(function() {
		// Select the correct category if a category is chosen
		if ($('#adCategory').children(':selected').val() > 0)
			showAdCategoryInputs($('#adCategory').children(':selected').val());
	});
	$("#adCategory").click(function() {
		showAdCategoryInputs($(this).val());
	});
});

function getURL() {
	var url;
	if (window.location.origin == "http://localhost") {
		// console.log(window.location.origin);
		url = "http://localhost/~johan/StudentTrade/StudentTrade/Views/ajax.php";
	} else {
		// console.log(window.location.origin +"/beta/StudentTrade/Views/ajax.php");
		url = window.location.origin +"/beta/StudentTrade/Views/ajax.php";
	};
	return url;
}

function showCampuses(cityID) {
	$("#campus").empty();
	request = $.ajax({
		type: "post",
		url: getURL(),
		data: {get: "campuses", cityID: cityID}
	});

	request.done(function(response, textStatus, jqXHR) {
		// console.log(response);
		var objs = JSON.parse(response);
		$("#campus").append("<option value=\"999\">Inget campus</option>");
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

function showAdCategoryInputs(adType) {
	// Clear the div
	$("#adInput").empty();

	request = $.ajax({
		type: "post",
		url: getURL(),
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
		message: "<span style=\"color: #000;\"><p>Kostar det något att lägga upp en annons? <br /> Nej, tillskillnad från Blocket och andra sajter är det helt gratis att lägga upp en annons hos oss. Vi är också studenter och tycker inte man ska betala för att lägga upp en annons. </p> Hur tar jag bort min annons? <br /> När du lägger upp din annons får du en fyrsiffrig kod till den e-mail adress du angett. Om du vill ta bort din annons går du in på den, klickar på ”Ta bort annons” och anger din kod. Snabbt och enkelt! <p style=\"margin-top: 10px;\"> Vad gör jag om jag tycker att en annons är olämplig? <br /> Om du ser en annons som du inte tycker är olämplig kan du anmäla den till oss. Vi ser då om den bryter mot ”Regler kring annonsering” och beslutar med detta som grund om hurvida annonser ska bli borttagen eller inte. Om du vill veta vilka regler som gäller kring annonsering så hittar du det <a href=\"front.php?page=rules\" style=\"color: #565656;text-decoration: underline\">här</a></span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#contact_us", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Kontakta oss</h1>",
		message: "<span style=\"color: #000;\">Är det något du undrar över är det bara höra av sig till: kontakt@stundenttrade.se <br /><br /> Eller kontakta oss personligen:<p>Fredrik Palmér: 073-52 00 511 eller fredrik@studenttrade.se<br /> Erik Hidrup: 073-07 33 077 eller erik@studenttrade.se <br /> Johan Wänglöf: 070-86 01 911 eller johan@studenttrade.se</p></span>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});

$(document).on("click", "#adAnswer", function(e) {
	bootbox.dialog({
		title: "<h1 style=\"color: #000;\">Kontaktformulär</h1>",
		message: $("#adAnswerForm").html(),
		backdrop: true,
		closeButton: true,
		animate: true
	});
});

$(document).on("click", "#adDelete", function(e) {
	bootbox.prompt("Ange din borttagninskod som du fick via e-post", function(result) {
		if (result != null) {
			request = $.ajax({
				type: "post",
				url: getURL(),
				data: {remove: "ad", aid: gup("aid"), removeCode: result}
			});

			request.done(function(response, textStatus, jqXHR) {
				if (response == true) {
					bootbox.alert("Annonsen borttagen");
					window.location.replace("front.php?page=latest");
				}
				else
					bootbox.alert("Fel kod angiven");
			});
			request.fail(function(jqXHR, textStatus, errorThrown) {
				bootbox.alert(errorThrown);
			});
		}
	});
});