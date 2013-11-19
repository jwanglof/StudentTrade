	// var currentCity;
	// $("#city").ready(function() {
	// 	// Select the correct city if a city is chosen in $_GET
	// 	if ($('#city').children(':selected').val() > 0) {
	// 		currentCity = $('#city').children(':selected').val(); 
	// 		showCampuses($('#city').children(':selected').val());
	// 	}
	// });
	// $("#city").click(function() {
	// 	if (currentCity != $(this).val()) {
	// 		currentCity = $(this).val();
	// 		showCampuses($(this).val());
	// 	}
	// });

	// var currentCategory;
	// $("#adCategory").ready(function() {
	// 	// Select the correct category if a category is chosen in $_GET
	// 	if ($('#adCategory').children(':selected').val() > 0) {
	// 		currentCategory = $('#adCategory').children(':selected').val();
	// 		showAdCategoryInputs($('#adCategory').children(':selected').val());
	// 	}
	// });
	// $("#adCategory").click(function() {
	// 	if (currentCategory != $(this).val()) {
	// 		currentCategory = $(this).val();
	// 		showAdCategoryInputs($(this).val());
	// 	}
	// });

	// $(document).on("submit", "#adDeleteForm", function(e) {
// 	alert(2);
// 	// request = $.ajax({
// 	// 	type: "post",
// 	// 	url: getAjaxURL("update"),
// 	// 	data: {update: "adActive", aid: gup("aid"), removeCode: result}
// 	// });
// 	// // console.log(result);

// 	// request.done(function(response, textStatus, jqXHR) {
// 	// 	// console.log(textStatus);
// 	// 	// console.log(response);
// 	// 	if (response == 1) {
// 	// 		bootbox.alert("Annonsen borttagen");
// 	// 		window.location.replace("front.php?page=latest");
// 	// 	}
// 	// 	else
// 	// 		bootbox.alert("Fel kod angiven");
// 	// });
// 	// request.fail(function(jqXHR, textStatus, errorThrown) {
// 	// 	// console.log(jqXHR);
// 	// 	bootbox.alert(errorThrown);
// 	// });
// });

	// $(document).on("click", "#adCategory", function(e) {
// 	showSubCategories($("#adCategory").val());
// });

// function showSubCategories(categoryID) {
// 	// $("#adInput").empty();
// 	console.log($("#adInput").find("."+ categoryID));
// 	$("#adInput").find("."+ categoryID).each(function() {
// 		$(this).show();
// 	});
// 	// $("#adInput").show();
// }

// function closeModal(modalID) {
// 	$(modalID).modal("hide");
// }


// $("#adInfo").ready(function() {
// 		// $.get("#adExtraInfo", function() {
// 		// $("#adInput").hide();
// 		// $("#adInput").each(function() {
// 		// 	$(this).hide();
// 		// });

// 		$("#adType").click(function() {
// 			var extraInfo = [1,2];
// 			if ($.inArray(parseInt($("#adType").val()), extraInfo) !== -1) {
// 				$("#adExtraInfo").show();
// 			} else {
// 				$("#adExtraInfo").hide();
// 			}
// 		});
// 		// });

// 		// $("#adCategory").click(function() {
// 		// 	showSubCategories($("#adCategory").val());
// 		// 	// var categoryID = $("#adCategory").val();
// 		// 	// $("#adInput").empty();

// 		// 	// // Check only the first div below #adInput
// 		// 	// // $("#adInput > div").each(function() {
// 		// 	// // $("#adInput").children().each(function() {
// 		// 	// $("#adInputHidden").find("."+ categoryID).each(function() {
// 		// 	// 	// alert($(this));
// 		// 	// 	// $("#adInput").append($(this));
// 		// 	// 	fucku($(this));
// 		// 	// 	$("#adInput").height($("#adInput").height + 1);
// 		// 	// 	$("#adInput").height($("#adInput").height - 1);
// 		// 	// });
// 		// 	// // console.log($("#adInput").find("."+ categoryID));
// 		// 	// // $("#adInput").find(".form-group").hasClass(categoryID).each(function() {
// 		// 	// 	// alert($(this));
// 		// 	// 	// $(this).show();
// 		// 	// 	// if ($(this).hasClass(categoryID)) {
// 		// 	// 	// 	$(this).show();
// 		// 	// 	// } else {
// 		// 	// 	// 	$(this).hide();
// 		// 	// 	// }
// 		// 	// // });

// 		// 	// // $("#adInput").show();
// 		// });
// 	});