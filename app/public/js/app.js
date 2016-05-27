$(document).ready(function(){
	login();
	registerUser();
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
				//window.location = response.data.redirect_to;
				window.location = 'http://soc.local/?url=admin/consultant';
			}else if(response.status == 500) {
				alert(response.errors);
			}
		});
	});
}

function registerUser(){
	$('.datosUsuario .user').on('click', function(){

		var username = $('.datosUsuario #user_name').val();
		var useremail = $('.datosUsuario #user_email').val();
		var userpassword = $('.datosUsuario #user_password').val();

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "http://soc.local/?url=api/register",
			"method": "POST",
			"data": {
				"user_name": username,
				"user_email": useremail,
				"user_password": userpassword
			}
		}
		$.ajax(settings).done(function (response) {
			console.log(response);
			if(response.status == 200){
				console.log(response);
			}else if(response.status == 500) {
				alert(response.errors);
			}
		});
	});
}