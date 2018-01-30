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

		$.ajax({
			type: 'POST',
			url: 'auth_role_siswa/',
			data: $('#login-form').serialize(),
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
		});
	});

	$('#register-form').submit(function(event){
		event.preventDefault();

		//hide the submit button
		$('input[type=submit]').hide();
		//show the loading gif
		$('#loadingGuru').show();

		$.ajax({
			type: 'POST',
			url: 'auth_role_guru/',
			data: $('#register-form').serialize(),
			success: function(response){
				console.log(response.redirect);
				window.location.href = response.redirect ;
			},
			error: function(response){
				//console.log(response.responseJSON.error);
				$('.alert-danger').html(response.responseJSON.error); //add response error
				$('.alert-danger').show().delay(5000).fadeOut(); //show the alert
				$('input[type=submit]').show(); // show the button submit
				$('#loadingGuru').hide(); //hide the loading gif

			}
		});
	});

});