$(document).ready(function() {
	if (gup("campus") != "") {		
		var campus = gup("campus");
		$("#campusChooser .campus").html($("#"+ campus).text() +"<span class=\"caret\"></span>");
	} else {
		$("#campusChooser .campus").html("Välj campus<span class=\"caret\"></span>");
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
			$(this).find('.caption').stop(true, true).slideDown(250);
			$(this).find('.caption-btm').stop(true, true).fadeOut("fast");
		}, function() {
			$(this).find('.caption').stop(true, true).slideUp(250);
			$(this).find('.caption-btm').stop(true, true).fadeIn("fast");
		}
	);

	$(".latestAd").hover(
		function() {
			$(this).addClass("adHover");
		}, function() {
			$(this).removeClass("adHover");
		}
	);

	$("#adInfo").ready(function() {
		$("#adType").click(function() {
			var extraInfo = [1,2];
			if ($.inArray(parseInt($("#adType").val()), extraInfo) !== -1) {
				$("#adExtraInfo").show();
			} else {
				$("#adExtraInfo").hide();
			}
		});
	});

	$("#requestCity").click(function() {
		$("#requestCityModal").modal('show');
	});
	$("#requestCampus").click(function() {
		$("#requestCampusModal").modal('show');
	});

	var currentCategory;
	$("#adCategory").ready(function() {
		// Select the correct category if a category is chosen in $_GET
		if ($('#adCategory').children(':selected').val() > 0) {
			currentCategory = $('#adCategory').children(':selected').val();
			showAdCategoryInputs($('#adCategory').children(':selected').val());
		}
	});

	var currentCity;
	$("#city").ready(function() {
		// Select the correct city if a city is chosen in $_GET
		if ($('#city').children(':selected').val() > 0) {
			currentCity = $('#city').children(':selected').val(); 
			showCampuses($('#city').children(':selected').val());
		}
	});

	$("#adCategory").on("change", function() {
		// Select the correct category if a category is chosen in $_GET
		if (currentCategory != $(this).val()) {
			currentCategory = $(this).val();
			showAdCategoryInputs($(this).val());
		}
	});
	$("#city").on("change", function() {
		if (currentCity != $(this).val()) {
			currentCity = $(this).val();
			showCampuses($(this).val());
		}
	});
});

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

function getAjaxURL(file) {
	var url;
	if (window.location.origin == "http://localhost") {
		// console.log(window.location.origin);
		url = "http://localhost/~johan/StudentTrade/StudentTrade/Ajax/"+ file +".php";
	} else {
		url = window.location.origin +"/StudentTrade/Ajax/"+ file +".php";
	};
	return url;
}

function getURL(path) {
	var url;
	if (window.location.origin == "http://localhost") {
		// console.log(window.location.origin);
		url = "http://localhost/~johan/StudentTrade/StudentTrade/Logic/"+ path;
	} else {
		url = window.location.origin +"/StudentTrade/Logic/"+ path;
	};
	return url;
}

var xhr;

function showCampuses(cityID) {
	if (xhr && xhr.readystate != 4)
		xhr.abort();
	$("#campus").empty();

	$(".ajaxCity").show();

	xhr = $.ajax({
		type: "post",
		url: getAjaxURL("get"),
		data: {get: "campuses", cityID: cityID}
	});

	xhr.done(function(response, textStatus, jqXHR) {
		// console.log(response);
		$(".ajaxCity").hide();
		var objs = JSON.parse(response);
		$("#campus").append("<option value=\"999\">Alla campus</option>");
		for (var key in objs) {
			// console.log(key +" -- "+ objs[key]);
			$("#campus").append("<option value=\""+ key +"\">"+ objs[key] +"</option>");
		};
	});
	xhr.fail(function(jqXHR, textStatus, errorThrown) {
		console.log(errorThrown);
	});
}

function showAdCategoryInputs(adType) {
	if (xhr && xhr.readystate != 4)
		xhr.abort();
	
	// Clear the div
	$("#adInput").empty();

	$(".ajaxCategory").show();

	xhr = $.ajax({
			type: "post",
			url: getAjaxURL("get"),
			data: {get: "adTypeInfo", adType: adType}
	});

	xhr.done(function(response, textStatus, jqXHR) {
			$(".ajaxCategory").hide();
			// console.log(response);
			var objs = JSON.parse(response);
			for (var value in objs) {
					$("#adInput").append("<label for=\""+ objs[value]["short_name"] +"\" class=\"col-lg-1 control-label\">"+ objs[value]["name"] +"</label>");
					$("#adInput").append("<div class=\"col-lg-5\" style=\"\"><input type=\""+ objs[value]["type"] +"\" class=\"form-control\" id=\""+ objs[value]["short_name"] +"\" name=\""+ objs[value]["short_name"] +"\" placeholder=\""+ objs[value]["name"] +"\"></div>");
					$("#adInput").append("<br /><br />");
			}
	});
	xhr.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
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