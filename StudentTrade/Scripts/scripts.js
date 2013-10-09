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

	$("#adCategory").ready(function() {
		// Select the correct category if a category is chosen
		if ($('#adCategory').children(':selected').val() > 0)
			showAdTypeInputs($('#adCategory').children(':selected').val());
	});
	$("#adCategory").click(function() {
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
		for (var key in objs) {
			// console.log(key +" -- "+ objs[key]);
			$("#campus").append("<option value="+ key +">"+ objs[key] +"</option>");
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

	switch(parseInt(adType, 10)) {
		case 0:
			break;
		case 1:
			$("#adInput").append("<label for=\"address\" class=\"col-lg-1 control-label\">Adress</label>");
			$("#adInput").append("<div class=\"col-lg-5\"><input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" placeholder=\"Adress\"></div>");
			break;
		case 2:
			$("#adInput").append("<h1>2</h1>");
			break;
		case 3:
			$("#adInput").append("<h1>3</h1>");
			break;
		case 4:
			$("#adInput").append("<h1>4</h1>");
			break;
		case 5:
			$("#adInput").append("<h1>5</h1>");
			break;
		case 6:
			$("#adInput").append("<h1>6</h1>");
			break;
		default:
			bootbox.alert("Inte en giltig kategori.");
			break;
	}
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
		message: "Juppjupp",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#how_it_works", function(e) {
	bootbox.dialog({
		title: "<h1>Så fungerar det</h1>",
		message: "Juppjupp",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#faq", function(e) {
	bootbox.dialog({
		title: "<h1>Vanliga frågor</h1>",
		message: "Juppjupp",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});
$(document).on("click", "#contact_us", function(e) {
	bootbox.dialog({
		title: "<h1>Kontakta oss</h1>",
		message: "Juppjupp",
		onEscape: function() {},
		backdrop: true,
		closeButton: true,
		animate: true
	});
});