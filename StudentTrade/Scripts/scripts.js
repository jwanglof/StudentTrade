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
});
// $(document).on("mouseenter", ".box1_img", function(e) {
// 	bootbox.dialog({
// 		title: "<h1>Om oss</h1>",
// 		message: "Juppjupp",
// 		onEscape: function() {},
// 		backdrop: true,
// 		closeButton: true,
// 		animate: true
// 	});
// });
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