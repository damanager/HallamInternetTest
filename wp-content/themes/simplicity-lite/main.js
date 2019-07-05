jQuery(document).ready(function ($) { // Replace $ with 'jQuery'.

	$.ajax({
		url: site_data.ajax_url,      // Replace 'url' with 'ajax_url'.
		type: 'post',
		data: {
			action: 'get_quote'
		},
		success: function (response) {
			alert(response);
		}
	});

});
