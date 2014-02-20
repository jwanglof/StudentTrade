function Ad() {
	this.xhr;
	this.currentCity;
	this.currentCategory;
}

Ad.prototype.showCampuses = function(cityID) {
	if (cityID > 0 || this.currentCity != cityID) {
		this.currentCity = cityID;

		if (this.xhr && this.xhr.readystate != 4)
			this.xhr.abort();

		// Empty the div
		$("#campus").empty();

		$(".ajaxCity").show();

		xhr = $.ajax({
			type: "post",
			url: "/ajax/get",
			data: {get: "campuses", cityID: cityID}
		});

		xhr.done(function(response, textStatus, jqXHR) {
			var objs = JSON.parse(response);
			$("#campus").append("<option value=\"999\">Alla campus</option>");
			for (var key in objs) {
				$("#campus").append("<option value=\""+ key +"\">"+ objs[key] +"</option>");
			};
		});

		xhr.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});

		$(".ajaxCity").hide();
	} else {
		console.log(2);
	}
}


Ad.prototype.showAdCategoryInputs = function(adCategory) {
	if (adCategory > 0 || this.currentCategory != adCategory) {
		this.currentCategory = adCategory;

		if (this.xhr && this.xhr.readystate != 4)
			this.xhr.abort();

		// Empty the div
		$("#adInput").empty();

		$(".ajaxCategory").show();

		xhr = $.ajax({
			type: "post",
			url: "/ajax/get",
			data: {get: "adSubCategories", adCategory: adCategory}
		});

		xhr.done(function(response, textStatus, jqXHR) {
			var objs = JSON.parse(response);
			for (var value in objs) {
				$("#adInput").append("<label for=\"id_"+ objs[value]["id"] +"\" class=\"col-lg-1 control-label\">"+ objs[value]["name"] +"</label>");
				$("#adInput").append("<div class=\"col-lg-5\" style=\"\"><input type=\""+ objs[value]["type"] +"\" class=\"form-control\" id=\"id_"+ objs[value]["id"] +"\" name=\"id_"+ objs[value]["id"] +"\" placeholder=\""+ objs[value]["name"] +"\"></div>");
				$("#adInput").append("<br /><br />");
			}
		});

		xhr.fail(function(jqXHR, textStatus, errorThrown) {
			console.log(errorThrown);
		});

		$(".ajaxCategory").hide();
	}
}

//
// Not sure if this works
// 
Ad.prototype.validate = function(form) {
	console.log(2);
	form.validate({
		// errorClass: "inputError",
		rules: {
			name: {required: true},
			email: {required: true, email: true},
			phonenumber: {required: false, digits: true},
			city: {required: true},
			campus: {required: false},
			adType: {required: true},
			title: {required: true},
			info: {required: true},
			price: {required: true},
			adCategory: {required: true}
		},
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
}