// For the search form
	$("#searchButton").click(function() {
		var searchString = $("#searchString").val();

		request = $.ajax({
			type: "post",
			url: getAjaxURL("get"),
			data: {get: "search", search: searchString}
		});

		request.done(function(response, textStatus, jqXHR) {
			console.log(response);
		});
		request.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});
	});