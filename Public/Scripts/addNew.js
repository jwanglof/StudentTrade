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
		if (!$("#uploadImagesButton").is(":disabled")) {
			$("#uploadImagesButton").text("Ladda upp bilder");

			if (pictureCounter <= 5) {
				$("#pictureInputs").append("<div class=\"form-group\"><label for=\"picture\" class=\"col-xs-1 control-label\">Bild #"+ pictureCounter +"</label><div class=\"col-xs-5\"><input type=\"file\" name=\"picture_"+ pictureCounter +"\" id=\"picture_"+ pictureCounter +"\" /></div></div>");
				pictureCounter += 1;
			// name=\"picture_"+ pictureCounter +"\" id=\"picture_"+ pictureCounter +"\"
			// name=\"pictures[]\" id=\"pictures[]\"
			}
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

// var target = new Array();
var canvas = new Array();
var uploadedFilenames = new Array();
$("#pictureInputs").on("change", function(event) {
	// target.push(event.target);

	// Check that there is a file in the input
	// and check that that file is an image
	// if (target[target.length-1].files[0] != undefined && target[target.length-1].files[0].type.match(/image.*/)) {
	if (event.target.files[0] != undefined && event.target.files[0].type.match(/image.*/)) {
		
		var fr = new FileReader();
		// console.log("new FileReader");
		fr.onload = function (frEvent) {
			// console.log("Inside frEvent");
			var image = new Image();
			image.onload = function (imageEvent) {
				// console.log("Inside imageEvent");

				// Create a canvas to resize the image
				var newCanvas = document.createElement("canvas");
				var maxSize = 400;
				var width = image.width;
				var height = image.height;

				if (width > height) {
					if (width > maxSize) {
						height *= maxSize / width;
						width = maxSize;
					}
				} else {
					if (height > maxSize) {
						width *= maxSize / height;
						height = maxSize;
					}
				}

				newCanvas.width = width;
				newCanvas.height = height;
				newCanvas.getContext("2d").drawImage(image, 0, 0, width, height);

				// Push the new canvas to the array
				canvas.push(newCanvas);
				// console.log(canvas[canvas.length-1]);
			}
			image.src = frEvent.target.result;
		} 
		// Git/StudentTrade/StudentTrade/Logic/images/
		fr.readAsDataURL(event.target.files[0]);

	}
});

function uploadProgress(evt) {
	if (evt.lengthComputable) {
		var percentComplete = Math.round(evt.loaded * 100 / evt.total);
		var percentCompleteString = percentComplete.toString() +"%";

		$("#bajs").css("background-color", "#a3a3a3");
		$("#bajs").text(percentCompleteString);
		$("#bajs").width(percentCompleteString);
	} else {
		console.log("NOPE");
	}
}

$("#uploadImagesButton").on("click", function(event) {
	if (event.target != undefined) {
		// console.log("CAAAANVAS: "+ canvas);
		// console.log("Ze other files: "+ target.length);

		// Disable the upload button
		// Disable upload by a session var as well?
		// Set a session with the ID of the new ad
		$(event.target).attr("disabled", "disabled");
		for (var o = 1; o <= 5; o++) {
			$("#picture_"+ o).attr("disabled", "disabled");
		}

		for (var i = 0; i < canvas.length; i++) {
			var xhr = new XMLHttpRequest();
			var filename;
			if (xhr.upload) {
				xhr.upload.addEventListener("progress", uploadProgress, false);

				xhr.addEventListener("load", function(event) {
					// Add the new filename to the array
					uploadedFilenames.push(event.target.responseText);
				});

				xhr.onreadystatechange = function(event) {
					if (xhr.readyState == 4) {
						if (xhr.status == 200) {
							alert("All pictures were uploaded!");
						} else {
							console.log("Image could not be uploaded.");
						}
					}
				}
				xhr.open("post", "http://localhost/~johan/StudentTrade/StudentTrade/Logic/Process.php", true);
				xhr.send(canvas[i].toDataURL("image/jpeg"));
			}
		}

		// target = "";
	} else {
		alert("You must choose at least one picture before uploading!");
	}
	event.preventDefault();
});