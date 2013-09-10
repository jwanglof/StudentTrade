$(document).ready(function() {
	$(".footer li").hover(function() {
		$(this).css('cursor', 'pointer');
	});

	$("#about_us").click(function () {
		$('div.modal').omniWindow().trigger('show');
		$('#overlay_text').html('\
			<h1>Om oss</h1>\
			Tre gubbz som vill lyxa runt i en jacht någonstans i medelhavet\
			');
	});
	$("#how_it_works").click(function () {
		$('div.modal').omniWindow().trigger('show');
		$('#overlay_text').html('\
			<h1>Så fungerar det</h1>\
			This is how it works!!\
			');
	});
	$("#faq").click(function () {
		$('div.modal').omniWindow().trigger('show');
		$('#overlay_text').html('\
			<h1>Vanliga frågor</h1>\
			Äru dum elle?\
			');
	});
	$("#contact_us").click(function () {
		$('div.modal').omniWindow().trigger('show');
		$('#overlay_text').html('\
			<h1>Kontakta oss</h1>\
			Vi finns på olika telefonnummer och olika e-mails. <br />\
			Funnybunny!\
			');
	});
});