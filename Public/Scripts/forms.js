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
	$("#newAdInfo").validate({
		// errorClass: "inputError",
		rules: {
			name: {required: true},
			email: {required: true, email: true},
			phonenumber: {required: false},
			city: {required: true},
			campus: {required: false},
			adType: {required: true},
			title: {required: true},
			info: {required: true},
			price: {required: true},
			adCategory: {required: true}
		},
		// messages: {
		// 	name: "Ange ditt namn",
		// 	email: "Ange din e-post",
		// 	city: "Ange din stad",
		// 	adType: "Välj annonskategori",
		// 	title: "Ange annonsens rubrik",
		// 	info: "Ange beskrivning av"
		// },
		highlight: function(element, errorClass) {
			$(element).addClass("error");
			$(element).closest(".form-group").children("label").addClass("errorText");
		},
		unhighlight: function(element, errorClass) {
			$(element).removeClass("error");
			$(element).closest(".form-group").children("label").removeClass("errorText");
		},
		errorPlacement: function(error, element) {
			return true;
		}
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
				$("#requestCampusModal").find(".modal-body-error").html("Fel kod angiven. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
			}
		});

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
				$("#adDeleteModal").find(".modal-body-error").html("Fel kod angiven. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
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
			data: {mail: "forgotCode", aid: $("#aid").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#adDeleteModal").find(".modal-body-error").html("Koden är nu skickad!").fadeIn("slow").delay(5000).fadeOut("slow");
			} else if(response == 2) {
				$("#adDeleteModal").find(".modal-body-error").html("Du har redan skickat efter koden. Om du inte har fått den kan du försöka igen senare.").fadeIn("slow");
			} else {
				$("#adDeleteModal").find(".modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
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
				$("#adReplyModal").find(".modal-body-error").html("Du måste fylla i alla fält.").fadeIn("slow").delay(5000).fadeOut("slow");
			} else {
				$("#adReplyModal").find(".modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
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
				$("#adReportModal").find(".modal-body-error").html("Du måste ange varför du anmäler annonsen.").fadeIn("slow").delay(5000).fadeOut("slow");
			} else {
				$("#adReportModal").find(".modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
			}
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
				$("#contactUsModal").find(".modal-body-error").html("Du måste fylla i alla fält.").fadeIn("slow").delay(5000).fadeOut("slow");
			} else {
				$("#contactUsModal").find(".modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
			}
		});
		
		event.preventDefault();
	});
});

function getURL(path) {
	var url;
	if (window.location.origin == "http://localhost") {
		url = "http://localhost/~johan/StudentTrade/Public/"+ path;
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