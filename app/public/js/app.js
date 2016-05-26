$(document).ready(function(){
	login();
});

// The Magic

function login(){
	$('#login-form .login__button').on('click', function(){

		var username = $('#login-form #user-name').val();
		var password = $('#login-form #user-password').val();

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "http://soc.local/?url=api/login",
			"method": "POST",
			"data": {
				"user_email": username,
				"user_password": password
			}
		}
		$.ajax(settings).done(function (response) {
			if(response.status == 200){
				window.location = response.data.redirect_to;
			}else if(response.status == 500) {
				alert(response.errors);
			}
		});
	});
}