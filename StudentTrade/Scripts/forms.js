$(document).ready(function() {
	$("#requestCityForm").validate({
		rules: {
			city_name: {required: true}
		}
	});

	$('form[data-async]').on('submit', function(event) {
		var $form = $(this);

		$.ajax({
			type: $form.attr('method'),
			url: getAjaxURL("mail"),
			data: $form.serialize(),

			success: function(data, status) {
				console.log(data);
				if (data == 1)
					closeModal("#requestCampusModal");
				else
					alert("Noope");
			}
		});

		event.preventDefault();
	});
});