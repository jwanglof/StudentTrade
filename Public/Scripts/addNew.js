$(document).ready(function() {
	var currentCategory;
	var currentCity;
	var pictureCounter = 2;

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

	$("#adCategory").ready(function() {
		// Select the correct category if a category is chosen in $_GET
		if ($('#adCategory').children(':selected').val() > 0) {
			currentCategory = $('#adCategory').children(':selected').val();
			showAdCategoryInputs($('#adCategory').children(':selected').val());
		}
	});

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

	$("#addPicture").on("click", function() {
		if ($("#pictureInputs").is(":visible")) {
			$("#addPicture").text("+ Lägg till bild");
			$("#pictureInputs").hide();
		}
		else {
			$("#addPicture").html("- Göm <i>Lägg till bild</i>");
			$("#pictureInputs").show();
		}
	});
	$("#addMorePictures").on("click", function() {
		if (pictureCounter <= 5) {
			$("#pictureInputs").append("<div class=\"form-group\"><label for=\"picture\" class=\"col-xs-1 control-label\">Bild #"+ pictureCounter +"</label><div class=\"col-xs-5\"><input type=\"file\" name=\"picture_"+ pictureCounter +"\" id=\"picture_"+ pictureCounter +"\" /></div></div>");
			pictureCounter += 1;
		}
	});
});

// xhr prevents the script from adding multiple values to the dynamic input-fields
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

function getAjaxURL(file) {
	var url;
	if (window.location.origin == "http://localhost") {
		url = "http://localhost/~johan/StudentTrade/StudentTrade/Ajax/"+ file +".php";
	} else {
		url = window.location.origin +"/StudentTrade/Ajax/"+ file +".php";
	};
	return url;
}

// document.querySelector("form input[type=file]").addEventListener("change", function(event) {
$("#pictureInputs").on("change", function(event) {
	var files = event.target.files;
	// Need to make it impossible to upload multiple images from the same input
	for (var i = 0; i < files.length; i++) {
		// Load image
		var reader = new FileReader();
		reader.onload = function (readerEvent) {
			var image = new Image();
			image.onload = function (imageEvent) {
				var imageElement = document.createElement("div");
				imageElement.classList.add("uploading");
				imageElement.innerHTML = "<span class=\"progress\"><span></span></span>";
				var progressElement = imageElement.querySelector("span.progress span");
				progressElement.style.width = 0;
				document.querySelector("form div.photos").appendChild(imageElement);

				var canvas = document.createElement("canvas");
				var max_size = 100;
				var width = image.width;
				var height = image.height;

				if (width > height) {
					if (width > max_size) {
						height *= max_size / width;
						width = max_size;
					}
				} else {
					if (height > max_size) {
						width *= max_size / height;
						height = max_size;
					}
				}

				canvas.width = width;
				canvas.height = height;
				canvas.getContext("2d").drawImage(image, 0, 0, width, height);

				// Upload image
				var xhr = new XMLHttpRequest();
				if (xhr.upload) {
					// Update progress
					xhr.upload.addEventListener("progress", function(event) {
						var percent = parseInt(event.loaded / event.total * 100);
						progressElement.style.width = percent +"%";
					}, false);

					// File uploaded / failed
					xhr.onreadystatechange = function(event) {
						if (xhr.readyState == 4) {
							if (xhr.status == 200) {
								imageElement.classList.remove("uploading");
								imageElement.classList.add("uploaded");
								imageElement.style.backgroundImage = "url("+ xhr.responseText +")";

								console.log("Image uploaded to: "+ xhr.responseText);
							} else {
								imageElement.parentNode.removeChild(imageElement);
							}
						}
					}

					xhr.open("post", "http://localhost/~johan/StudentTrade/StudentTrade/Logic/Process.php", true);
					xhr.send(canvas.toDataURL("image/jpeg"));
				}
			}
			image.src = readerEvent.target.result;
		}
		reader.readAsDataURL(files[i]);
	}

	// event.target.value = "";
});