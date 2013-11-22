$(document).ready(function() {
	$(".adminAd").on("click", function() {
		// Get the ID from the div
		var divID = $(this).attr("id");

		// console.log(divID);
		var divInfo = $("div."+ divID);
		if (divInfo.is(":visible")) {
			divInfo.hide();
		} else {
			divInfo.show();
		}
	});
});