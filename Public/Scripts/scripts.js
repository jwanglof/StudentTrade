$(document).ready(function() {
	// Change the text in "Välj campus" chooser
	if (window.location.href.indexOf("campus/") > -1) {
		var campus = window.location.href;
		var regexp = /\/campus\/([a-z]+)\/?/;
		var result = campus.match(regexp);

		$("#campusChooser .campus").html($("#"+ result[1]).text() +"<span class=\"caret\"></span>");
	} else {
		$("#campusChooser .campus").html("Välj campus<span class=\"caret\"></span>");
	}

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

	$("#requestCity").click(function() {
		$("#requestCityModal").modal('show');
	});
	$("#requestCampus").click(function() {
		$("#requestCampusModal").modal('show');
	});
});