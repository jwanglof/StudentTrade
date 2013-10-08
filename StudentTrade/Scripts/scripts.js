$(document).ready(function() {
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
		// Select the correct category if a category is chosen
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
	$("#campus").append("<option value=\"22\">"+ cityID +"</option>");
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

/*
$('#school_program').ready(function() {show_school_class();});
	$('#school_program').change(function() {show_school_class();});

function show_school_class() {
	var chosen_school_program = $('#school_program').children(':selected').val();
	var select_objects = new Array();
	var selected;

	$('#school_class').children('option').each(function() {
		var school_class_program = $(this).val().split('|')[1];

		// if ($(this).is(':selected') && school_class_program == chosen_school_program) {
		// 	selected = $(this);
		// }

		// Hide all options
		$(this).hide();
		if (school_class_program == chosen_school_program) {
			// Show the correct school class option(s)
			$(this).show();
			
			// Add all HTML objects to the array
			// If there are more than one class for a program
			// the select-list will always choose the first one
			select_objects.push(this);
		}
	});

	// If the array has more than 1 element it will selected the correct option
	if (select_objects.length > 1) {
		for (var i = 0; i < select_objects.length; i++)
			if ($(select_objects[i]).val() == $('#default_class').val())
				$(select_objects[i]).prop('selected', true);
	}
	else {
		// Select the first HTML object in the array
		$(select_objects[0]).prop('selected', true);
	}
}

*/

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