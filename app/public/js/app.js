var host_url = "http://localhost:8000/";


$(document).ready(function(){

	registerSite();
});

// The Magic
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
