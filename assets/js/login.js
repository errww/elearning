$(function(){

	// $.ajaxSetup({
	// 	headers: {
	// 		'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	// 	}
	// })

	$('#login-form').submit(function(event){
		event.preventDefault();

		//hide the submit button
		$('input[type=submit]').hide();
		//show the loading gif
		$('#loadingAdmin').show();

		var postData = {
			'username': $('input[id=usernameAdmin]').val(),
			'password': $('input[id=passwordAdmin]').val(),
		}

		$.ajax({
			type: 'POST',
			url: 'cek/',
			data: postData,
			success: function(response){
				console.log(response.redirect);
				window.location.href = response.redirect ;
			},
			error: function(response){
				//console.log(response.responseJSON.error);
				$('.alert-danger').html(response.responseJSON.error); //add response error
				$('.alert-danger').show().delay(5000).fadeOut(); //show the alert
				$('input[type=submit]').show(); // show the button submit
				$('#loadingAdmin').hide(); //hide the loading gif

			}
		})
	})

})