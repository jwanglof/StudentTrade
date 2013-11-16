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
	$("#addNewAd").validate({
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

	$("form[data-async]").on("submit", function(event) {
		request = sendWithAjax($(this), "mail");

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$(".modal-body").html("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
				$(".modal-footer").empty();
				$(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			}
			else
				$(".modal-body").html("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
		});
		
		event.preventDefault();
	});

	$("#adDeleteForm").on("submit", function(event) {
		$(".modal-footer").find(".ajaxLoader").show();

		request = sendWithAjax($(this), "update");

		request.done(function(response, textStatus, jqXHR) {
			$(".modal-footer").find(".ajaxLoader").hide();

			if (response == 1) {
				$("#adDeleteModal").find(".modal-body").html("Annonsen är nu borttagen!");
				$("#adDeleteModal").find(".modal-footer").empty();
				$("#adDeleteModal").find(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			}
			else {
				$("#adDeleteModal").find("#modal-body-error").html("Fel kod angiven. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
			}
		});
		
		event.preventDefault();
	});

	$("#forgotCode").on("click", function() {
		$.ajax({
			type: "post",
			url: getAjaxURL("mail"),
			data: {mail: "forgotCode", aid: $("#aid").val()},

			success: function(data, status) {
				if (data == 1) {
					$("#adDeleteModal").find("#modal-body-error").html("Koden är nu skickad!").fadeIn("slow").delay(5000).fadeOut("slow");
				} else {
					$("#adDeleteModal").find("#modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
				}
			}
		});
	});

	$("#adReplyForm").on("submit", function(event) {
		request = sendWithAjax($(this), "mail");

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
		
		event.preventDefault();
	});

	$("#adReportForm").on("submit", function(event) {
		request = sendWithAjax($(this), "mail");

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
		request = sendWithAjax($(this), "mail");

		request.done(function(response, textStatus, jqXHR) {
			if (response == 1) {
				$("#contactUsModal").find(".modal-body").fadeIn("slow").html("Meddelande skickat. Vi på StudentTrade svarar på det så fort som möjligt!");
				$("#contactUsModal").find(".modal-footer").empty();
				$("#contactUsModal").find(".modal-footer").fadeIn("slow").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
			}
			else if (response == 2) {
				$("#contactUsModal").find(".modal-body-error").html("Du måste fylla i alla fält.").fadeIn("slow").delay(5000).fadeOut("slow");
			} else {
				$("#contactUsModal").find(".modal-body-error").html("Något gick fel. Var vänlig försök igen.").fadeIn("slow").delay(5000).fadeOut("slow");
			}
		});
		
		event.preventDefault();
	});

	$("#addNewAd").on("submit", function(event) {
		request = sendWithAjax($(this), "mail");

		request.done(function(response, textStatus, jqXHR) {
			if (!response) {
				$("#errorMsg").show();
				$("#errorMsg").find(".col-xs-5").html("Något gick fel. Var vänlig försök igen.")
			} else if (response == 2) {
				$("#errorMsg").show();
				$("#errorMsg").find(".col-xs-5").html("Du måste fylla i alla obligatoriska (*) fält!")
			} else {
				window.location.href = "http://localhost/~johan/StudentTrade/front.php?page=ad_show&city="+ gup("city") +"&aid="+ response;
			}
		});

		event.preventDefault();
	});
});

function sendWithAjax(_form, _url) {
	var $form = _form;

	return $.ajax({
		type: $form.attr("method"),
		url: getAjaxURL(_url),
		data: $form.serialize()
	});
}