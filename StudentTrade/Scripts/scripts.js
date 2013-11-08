$(document).ready(function() {
	if (gup("campus") != "") {		
		var campus = gup("campus");
		$(".dropdown-toggle").html($("#"+ campus).text() +"<span class=\"caret\"></span>");
	} else {
		$(".dropdown-toggle").html("Välj campus<span class=\"caret\"></span>");
	}
	// $(".campusChosen").click(function() {
	// 	// Need .text() since an x-character is added when the link is clicked on
	// 	// See code above
	// 	$(this).removeClass("campusChosen").text($(this).text().slice(0,-1));
	// });

	$(".footer li, #adAnswer, #adReport, #adDelete, #requestCampus").hover(
		function() {
			$(this).css('cursor', 'pointer');
			$(this).css('text-decoration', 'underline');
		}, function() {
			$(this).css('text-decoration', 'none');
		}
	);

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

	$(".latestAd").hover(
		function() {
			$(this).addClass("adHover");
		}, function() {
			$(this).removeClass("adHover");
		}
	);

	$("#adInfo").ready(function() {
		$.get("#adExtraInfo", function() {
			$("#adInput").hide();
			$("#adType").click(function() {
				var extraInfo = [1,2];
				if ($.inArray(parseInt($("#adType").val()), extraInfo) !== -1) {
					$("#adExtraInfo").show();
				} else {
					$("#adExtraInfo").hide();
				}
			});

			$("#adCategory").click(function() {
				var categoryID = $("#adCategory").val();
				// Check only the first div below #adInput
				$("#adInput > div").each(function() {
					if ($(this).hasClass(categoryID)) {
						$(this).show();
					} else {
						$(this).hide();
					}
				});

				$("#adInput").show();
			});
		});
	});

	$("#requestCity").click(function() {
		$("#rating-modal").modal('show');
	});
});
// $("#requestCampus").on("click", function() {
// 	bootbox.confirm($("#modal-body").html(), function(conf) {
// 		alert(conf);
// 	});
// });

// $("#requestCampus").click(function() {
// 	bootbox.dialog({
// 		title: "<h1>Förfråga att lägga till campus</h1>",
// 		message: $("#requestCampusForm").html(),
// 		onEscape: function() {},
// 		backdrop: true,
// 		closeButton: true,
// 		animate: true
// 	});
// });

$("#requestCampusForm").submit(function(e) {
	e.preventDefault();
	sendFormWithAjax(this);
});
// $("#requestCityForm").submit(function(e) {
// 	e.preventDefault();
// 	sendFormWithAjax(this);
// });

function sendFormWithAjax(form) {
	var postData = $(form).serializeArray();
	request = $.ajax({
		type: "post",
		url: getAjaxURL("mail"),
		data: postData
	});

	request.done(function(response, textStatus, jqXHR) {
		console.log(jqXHR);
		console.log(response);
		if (response == 1)
			bootbox.alert("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
		else
			bootbox.alert("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
	});
	request.fail(function(jqXHR, textStatus, errorThrown) {
		bootbox.alert("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
	});
}

function getAjaxURL(file) {
	var url;
	if (window.location.origin == "http://localhost") {
		// console.log(window.location.origin);
		url = "http://localhost/~johan/StudentTrade/StudentTrade/Ajax/"+ file +".php";
	} else {
		url = window.location.origin +"/beta/StudentTrade/Ajax/"+ file +".php";
	};
	return url;
}

function showCampuses(cityID) {
	$("#campus").empty();

	request = $.ajax({
		type: "post",
		url: getAjaxURL("get"),
		data: {get: "campuses", cityID: cityID}
	});

	request.done(function(response, textStatus, jqXHR) {
		// console.log(response);
		var objs = JSON.parse(response);
		$("#campus").append("<option value=\"999\">Alla campus</option>");
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
		title: "<h1>Om oss</h1>",
		message: "StudentTrade.se är en köp- och sälj sajt enbart för studenter. Hos oss kan du köpa och sälja saker som har studentlivet till. StudentTrade.se startades hösten 2013 av tre stundenter på Linköpings Universitet.",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#how_it_works", function(e) {
	bootbox.dialog({
		title: "<h1>Så fungerar det</h1>",
		message: "Hos oss är det lätt att både lägga upp annons och att hitta det du söker. Börja med att välja din studentstad på startsidan. Väl inne på sidan kan du sedan lätt sortera annonserna efter kategori och lägga upp annons genom att klicka på ”Lägg upp annons”. Annonsen kommer direkt upp i flödet och blir tillgänlig för andra studenter.",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#faq", function(e) {
	bootbox.dialog({
		title: "<h1>Vanliga frågor och svar</h1>",
		message: "<p>Kostar det något att lägga upp en annons? <br /> Nej, tillskillnad från Blocket och andra sajter är det helt gratis att lägga upp en annons hos oss. Vi är också studenter och tycker inte man ska betala för att lägga upp en annons. </p> Hur tar jag bort min annons? <br /> När du lägger upp din annons får du en fyrsiffrig kod till den e-mail adress du angett. Om du vill ta bort din annons går du in på den, klickar på ”Ta bort annons” och anger din kod. Snabbt och enkelt! <p style=\"margin-top: 10px;\"> Vad gör jag om jag tycker att en annons är olämplig? <br /> Om du ser en annons som du inte tycker är olämplig kan du anmäla den till oss. Vi ser då om den bryter mot ”Regler kring annonsering” och beslutar med detta som grund om hurvida annonser ska bli borttagen eller inte. Om du vill veta vilka regler som gäller kring annonsering så hittar du det <a href=\"front.php?page=rules\" style=\"color: #565656;text-decoration: underline\">här</a>",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$("#contact_us").on("click", function(e) {
	e.preventDefault();
	bootbox.dialog({
		title: "<h1>Kontakta oss</h1>",
		message: $("#contactUsDiv").html(),
		// buttons: {
		// 	send: {
		// 		label: "Skicka meddelande",
		// 		className: "btn btn-primary btn-sm",
		// 		callback: function() {
		// 			bootbox.alert("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!", function() {
		// 				$("#contactUsForm").submit();
		// 			});
		// 		}
		// 	}
		// },
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});

$(document).on("click", "#adAnswer", function(e) {
	bootbox.dialog({
		title: "<h1>Kontaktformulär</h1>",
		message: $("#adAnswerForm").html(),
		backdrop: true,
		closeButton: true,
		animate: true
	});
});

$(document).on("click", "#adReport", function(e) {
	bootbox.dialog({
		title: "<h1>Anmälformulär</h1>",
		message: $("#adReportForm").html(),
		backdrop: true,
		closeButton: true,
		animate: true
	});
});

$(document).on("click", "#adDelete", function(e) {
	bootbox.prompt("Ange den borttagninskod som du fått via e-post", function(result) {
		if (result != null) {
			request = $.ajax({
				type: "post",
				url: getAjaxURL("update"),
				data: {update: "adActive", aid: gup("aid"), removeCode: result}
			});
			console.log(result);

			request.done(function(response, textStatus, jqXHR) {
				console.log(textStatus);
				console.log(response);
				if (response == 1) {
					bootbox.alert("Annonsen borttagen");
					window.location.replace("front.php?page=latest");
				}
				else
					bootbox.alert("Fel kod angiven");
			});
			request.fail(function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				bootbox.alert(errorThrown);
			});
		}
	});
});