$(document).ready(function() {
	var code = window.location.href.match(/\/code\/([0-9]+)\/?/)[1];

	var ad = new Ad();
	// TODO: MOVE EVENT HANDLERS TO Ad()!
	// ad.validate($("#editAdInfo"));
	// $("#editAdInfo").on("focus", ad.validate($("#editAdInfo")));
	// ad.showAdCategoryInputs(selectedCategoryID);

	$("#city").ready(function() {
		var selectedCityID = $('#city').children(':selected').val();
		ad.showCampuses(selectedCityID);
	});
	$("#city").on("change", function() {
		var selectedCityID = $(this).val();
		ad.showCampuses(selectedCityID);
	});

	$("#adCategory").ready(function() {
		var selectedCategoryID = $('#adCategory').children(':selected').val();
		ad.showAdCategoryInputs(selectedCategoryID);
		addValuesToSubCategories(code);
	});
	$("#adCategory").on("change", function() {
		var selectedCategoryID = $(this).val();
		ad.showAdCategoryInputs(selectedCategoryID);
		// addValuesToSubCategories(code);
	});

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

	$("#editAdForm").on("submit", function(event) {
		event.preventDefault();
		
		$("#editAdButton").prop("disabled", true);

		request = $.ajax({
			type: "post",
			url: "/ajax/update",
			data: {update: "adUpdate", aid: $("#aid").val(), adCode: code, phonenumber: $("#phonenumber").val(), city: $("#city").val(), campus: $("#campus").val(), adType: $("#adType").val(), adCategory: $("#adCategory").val(), price: $("#price").val(), adTitle: $("#adTitle").val(), adInfo: $("#adInfo").val()}
		});

		request.done(function(response, textStatus, jqXHR) {
			if (response == -1) {
				$("#errorMsg").find(".col-xs-5").html("Du måste fylla i alla obligatoriska (*) fält!");
				$("#errorMsg").show();
				$("#editAdButton").prop("disabled", false);
			} else if (response == 2) {
				$("#errorMsg").find(".col-xs-5").html("Du har angett fel annonskod i adressfältet!");
				$("#errorMsg").show();
				$("#editAdButton").prop("disabled", false);
			} else if (response == 1) {
				window.location.href = "/index.php/city/"+ getCity() +"/ad/"+ $("#aid").val();
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	});
});

function addValuesToSubCategories(code) {
	// Ajax call to get the values for the category
	request = $.ajax({
		type: "post",
		url: "/ajax/get",
		data: {get: "adCategoryValues", aid: $("#aid").val(), adCode: code}
	});
	
	request.done(function(response, textStatus, jqXHR) {
		// console.log(response);
		var objs = JSON.parse(response);
		for (var value in objs) {
			$("#id_"+ objs[value]["fk_adInfo_adSubCategory"]).val(objs[value]["sub_category_value"]);
		}
	});

	request.fail(function(jqXHR, textStatus, errorThrown) {
		console.log(errorThrown);
	});
}