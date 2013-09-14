$(document).ready(function() {
	$(".footer li").hover(function() {
		$(this).css('cursor', 'pointer');
	});

	$("#about_us").avgrund({
		width: 500,
		height: 350,
		showClose: true,
		showCloseText: 'close',
		template: '<h1>Om oss</h1>' +
		'Three grabbz'
	});
	$("#how_it_works").avgrund({
		width: 500,
		height: 350,
		showClose: true,
		showCloseText: 'close',
		template: '<h1>Så fungerar det</h1>' +
		'Three grabbz <br />' +
		'Etccccc...'
	});
	$("#faq").avgrund({
		width: 500,
		height: 350,
		showClose: true,
		showCloseText: 'close',
		template: '<h1>Vanliga frågor</h1>' +
		'Three grabbz <br />' +
		'QUEEEESTIONS'
	});
	$("#contact_us").avgrund({
		width: 500,
		height: 350,
		showClose: true,
		showCloseText: 'close',
		template: '<h1>Kontakta oss</h1>' +
		'Three grabbz <br />' +
		'Etccccc...22222'
	});
});