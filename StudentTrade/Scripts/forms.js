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

	$('form[data-async]').on('submit', function(event) {
		var $form = $(this);

		$.ajax({
			type: $form.attr('method'),
			url: getAjaxURL("mail"),
			data: $form.serialize(),

			success: function(data, status) {
				console.log(data);
				if (data == 1) {
					// closeModal("#requestCampusModal");
					// $(".modal-body").empty();
					$(".modal-body").html("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
					$(".modal-footer").empty();
					$(".modal-footer").html("<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">OK</button>");
				}
				else
					$(".modal-body").html("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
			}
		});

		event.preventDefault();
	});
});