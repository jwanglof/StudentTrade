function sendFormWithAjax(form) {
	var postData = $(form).serializeArray();
	request = $.ajax({
		type: "post",
		url: getAjaxURL("mail"),
		data: postData
	});

	request.done(function(response, textStatus, jqXHR) {
		// console.log(jqXHR);
		// console.log(response);
		if (response == 1)
			bootbox.alert("Tack för ditt mail. Vi på StudentTrade.se kollar på det så snabbt vi bara kan!");
		else
			bootbox.alert("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
	});
	request.fail(function(jqXHR, textStatus, errorThrown) {
		bootbox.alert("Något gick fel när servern försökte skicka ditt e-mail. Vi ber om ursäkt för detta, försök gärna igen.");
	});
}

	// $(".campusChosen").click(function() {
	// 	// Need .text() since an x-character is added when the link is clicked on
	// 	// See code above
	// 	$(this).removeClass("campusChosen").text($(this).text().slice(0,-1));
	// });