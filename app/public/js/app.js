var host_url = "http://localhost:8000/";


$(document).ready(function(){
	login();
	registerUser();
	registerSite();
});

// The Magic

function login(){
	$('#login-form .login__button').on('click', function(){

		var username = $('#login-form #user-name').val();
		var password = $('#login-form #user-password').val();

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": host_url + "api/v1/login",
			"method": "POST",
			"data": {
				"user_email": username,
				"user_password": password
			}
		}
		$.ajax(settings).done(function (response) {
			if(response.status == 200){
				$('#login-form .login__button').text('Entrando...');
				window.location = host_url+'admin/users';
			}else if(response.status == 500) {
				$('.responses').text(response.errors);
				$('.responses').show();
			}
		});
	});
}

function registerUser(){
	$('.agregarUsuario .datosUsuario .registerUserform').on('click', function(){

		var username = $('.datosUsuario #user_name').val();
		var useremail = $('.datosUsuario #user_email').val();
		var userpassword = $('.datosUsuario #user_password').val();

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": host_url + "api/v1/register",
			"method": "POST",
			"data": {
				"user_name": username,
				"user_email": useremail,
				"user_password": userpassword
			}
		}
		$.ajax(settings).done(function (response) {
			if(response.status == 200){
				$('.close').trigger( "click" );
				$('.responses').text('Se ha creado el usuario correctamente');
				$('.responses').show();
			}else if(response.status == 500) {
				$('.responses').text(response.errors);
				$('.responses').show();
			}
		});
	});
}

function registerSite(){
	$('#newSiteForm .addSite').on('click', function(){
		var siteUserEmail = $('#newSiteForm #siteUserEmail').val();
		var siteURL = $('#newSiteForm #siteUrl').val();
		var siteName = $('#newSiteForm #siteName').val();
		var siteState = $('#newSiteForm #siteState').val();
		var siteContent = $('#newSiteForm #siteContent').val();
		var siteAddress = $('#newSiteForm #siteAddress').val();
		var siteTelephone = $('#newSiteForm #siteTelephone').val();

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": host_url + "api/v1/sites",
			"method": "POST",
			"data": {
				"user_email": siteUserEmail,
				"state_id": siteState,
				"url": siteURL,
				"title": siteName,
				"content": siteContent,
				"address": siteAddress,
				"contact": siteTelephone
			}
		}
		$.ajax(settings).done(function (response) {
			if(response.status == 200){
				$('.close').trigger( "click" );
				$('.responses').text('Se ha creado el sitio correctamente');
				$('.responses').show();
			}else if(response.status == 500) {
				$('.responses').text(response.errors);
				$('.responses').show();
			}
		});
	});
}

function showModal(modalName){
	if( modalName == 'aviso' ){
		$('#siteModal .modal-header .modal-title').text('Aviso de Privacidad');
		$('#siteModal .modal-body').html('<h3>Texto prueba Aviso</h3><p>Aquí va el texto</p>');
	}else if( modalName == 'termino'){
		$('#siteModal .modal-header .modal-title').text('Términos y Condiciones');
		$('#siteModal .modal-body').html('<h3>Texto prueba Términos</h3><p>Aquí va el texto</p>');
	}

	$('#siteModal').modal();
}

function loadTheSite(){
	var thesite = window.location.href.split( 'site=' );
  var settings = {
      "async": true,
      "crossDomain": true,
      "url": host_url + "api/v1/sites/"+thesite[1],
      "method": "GET",
  }
  $.ajax(settings).done(function (response) {
      var site = response.data;
      $('.head_micrositio h1').text(site.title);
      console.log(site);
  });
}
