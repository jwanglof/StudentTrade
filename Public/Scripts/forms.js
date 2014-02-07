$(document).ready(function() {
	$("#requestCityForm").validate({
		rules: {
			city_name: {required: true}
		}
	});
	$("#requestCampusForm").validate({
		rules: {
			city_name: {required: true},
			campus_name: {required: true}
		}
	});

	$("#requestCityModal").on("submit", function(event) {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "requestCity", city_name: $("#city_name").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#requestCityModal").find(".modal-body").html("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
				$("#requestCityModal").find(".modal-footer").empty();
				$("#requestCityModal").find(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\" id=\"okButton\">OK</button>");
			} else {
				errorMsg("#requestCityModal", "Servern kunde inte skicka ditt e-mail just nu. Var vänlig försök igen!");
			}
		});

		event.preventDefault();
	});

	$("#requestCampusModal").on("submit", function(event) {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "requestCampus", campus_name: $("#campus_name").val(), city_name: $("#city_name").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#requestCampusModal").find(".modal-body").html("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
				$("#requestCampusModal").find(".modal-footer").empty();
				$("#requestCampusModal").find(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\" id=\"okButton\">OK</button>");
			} else {
				errorMsg("#requestCampusModal", "Servern kunde inte skicka ditt e-mail just nu. Var vänlig försök igen!");
			}
		});

		event.preventDefault();
	});

	$("#adEditModal").on("submit", function(event) {
		$(".modal-footer").find(".ajaxLoader").show();

		request = $.ajax({
			type: "post",
			url: "/ajax/get",
			data: {get: "ad", aid: $("#aid").val(), adCode: $("#adCodez").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			console.log(response);
			if (response == 2) {
				errorMsg("#adEditModal", "Fel kod angiven.");
			} else {
				window.location.href = getURL("index.php/city/"+ getCity() +"/edit/"+ $("#aid").val() +"/code/"+ $("#adCodez").val());
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});

		$(".modal-footer").find(".ajaxLoader").hide();
		event.preventDefault();
	});

	$("#adDeleteForm").on("submit", function(event) {
		$(".modal-footer").find(".ajaxLoader").show();

		request = $.ajax({
			type: "post",
			url: "/ajax/update",
			data: {update: "adActive", aid: $("#aid").val(), removeCode: $("#removeCode").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			$(".modal-footer").find(".ajaxLoader").hide();

			if (response == 1) {
				$("#adDeleteModal").find(".modal-body").html("Annonsen är nu borttagen!");
				$("#adDeleteModal").find(".modal-footer").empty();
				$("#adDeleteModal").find(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\" id=\"okButton\">OK</button>");
				$("#okButton").on("click", function() {
					window.location.href = getURL("index.php/city/"+ getCity());
				});
			} else {
				errorMsg("#adDeleteModal", "Fel kod angiven. Var vänlig försök igen.");
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
		
		event.preventDefault();
	});

	$("#forgotCode").on("click", function() {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "forgotCode", aid: $("#aid").val(), city: $("#city").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				errorMsg("#adDeleteModal", "Koden är nu skickad!");
			} else if(response == 2) {
				errorMsg("#adDeleteModal", "Du har redan skickat efter koden. Om du inte har fått den kan du försöka igen senare.");
			} else {
				errorMsg("#adDeleteModal", "Något gick fel. Var vänlig försök igen.");
			}
		});
	});

	$("#adReplyForm").on("submit", function(event) {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "adReply", aid: $("#aid").val(), city: $("#city").val(), name: $("#name").val(), from_email: $("#from_email").val(), message: $("#message").val()}
		});


		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#adReplyModal").find(".modal-body").fadeIn("slow").html("Meddelande skickat!");
				$("#adReplyModal").find(".modal-footer").empty();
				$("#adReplyModal").find(".modal-footer").fadeIn("slow").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			}
			else if (response == 2) {
				errorMsg("#adReplyModal", "Du måste fylla i alla fält.");
			} else {
				errorMsg("#adReplyModal", "Något gick fel. Var vänlig försök igen.");
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
		
		event.preventDefault();
	});

	$("#adReportForm").on("submit", function(event) {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "adReport", aid: $("#aid").val(), message: $("#message").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#adReportModal").find(".modal-body").fadeIn("slow").html("Meddelande skickat!");
				$("#adReportModal").find(".modal-footer").empty();
				$("#adReportModal").find(".modal-footer").fadeIn("slow").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			}
			else if (response == 2) {
				errorMsg("#adReportModal", "Du måste ange varför du anmäler annonsen.");
			} else {
				errorMsg("#adReportModal", "Något gick fel. Var vänlig försök igen.");
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
		
		event.preventDefault();
	});

	$("#contactUsForm").on("submit", function(event) {
		request = $.ajax({
			type: "post",
			url: "/ajax/mail",
			data: {mail: "contactUs", name: $("#name").val(), from_email: $("#from_email").val(), message: $("#message").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#contactUsModal").find(".modal-body").fadeIn("slow").html("Meddelande skickat. Vi på StudentTrade svarar på det så fort som möjligt!");
				$("#contactUsModal").find(".modal-footer").empty();
				$("#contactUsModal").find(".modal-footer").fadeIn("slow").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			} else if (response == 2) {
				errorMsg("#contactUsModal", "Du måste fylla i alla fält.");
			} else {
				errorMsg("#contactUsModal", "Något gick fel. Var vänlig försök igen.");
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
		
		event.preventDefault();
	});

	$("#editAdForm").on("submit", function(event) {
		event.preventDefault();
		
		var code = window.location.href.match(/\/code\/([0-9]+)\/?/)[1];

		request = $.ajax({
			type: "post",
			url: "/ajax/update",
			data: {update: "adUpdate", aid: $("#aid").val(), code: code, phonenumber: $("#phonenumber").val(), city: $("#city").val(), campus: $("#campus").val(), adType: $("#adType").val(), adCategory: $("#adCategory").val(), price: $("#price").val(), adTitle: $("#adTitle").val(), adInfo: $("#adInfo").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			console.log(response);
			if (response == -1) {
				$("#errorMsg").find(".col-xs-5").html("Du måste fylla i alla obligatoriska (*) fält!");
				$("#errorMsg").show();
			} else if (response == 2) {
				$("#errorMsg").find(".col-xs-5").html("Du har angett fel annonskod i adressfältet!");
				$("#errorMsg").show();
			} else {
				window.location.href = "/index.php/city/"+ getCity() +"/ad/"+ $("#aid").val();
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	});
});

function getURL(path) {
	var url;
	if (window.location.origin == "http://localhost") {
		url = "http://localhost/"+ path;
	} else {
		url = window.location.origin +"/"+ path;
	};
	return url;
}

function getCity() {
	var city = window.location.href;
	var regexp = /\/city\/([a-z]+)\/?/;
	var result = city.match(regexp);
	return result[1];
}

function errorMsg(targetDivID, message) {
	$(targetDivID).find(".modal-body-error").html(message).fadeIn("slow").delay(5000).fadeOut("slow");
}