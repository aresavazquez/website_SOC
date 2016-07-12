var host_url = "http://localhost:8000/";

function showModal(modalName){
    if( modalName == 'aviso' ){
        $('#siteModal .modal-header .modal-title').text('Aviso de Privacidad');
        $('#siteModal .modal-body').html('<h3>Texto prueba Aviso</h3><p>Aquí va el texto</p>');
    }else if( modalName == 'termino'){
        $('#siteModal .modal-header .modal-title').text('Términos y Condiciones');
        $('#siteModal .modal-body').html('<h3>1. INTRODUCCIÓN AL SERVICIO Y ACEPTACIÓN DE LAS CONDICIONES DE USO</h3><p>Aquí va el texto</p>');
    }
    $('#siteModal').modal();
}

$(document).on('ready', function(){
    //entrada iconos submenú
    TweenLite.to('.iconSubMenu', 2, { opacity: 1, display: 'block', ease: Power2.easeOut, y: -300});
    $.put = function(url, data, callback, type){
        if ( $.isFunction(data) ){
            type = type || callback,
            callback = data,
            data = {}
        }
        return $.ajax({
            url: url,
            type: 'PUT',
            success: callback,
            data: data,
            contentType: type
        });
    }
    $.delete = function(url, data, callback, type){
        if ( $.isFunction(data) ){
            type = type || callback,
            callback = data,
            data = {}
        }
        return $.ajax({
            url: url,
            type: 'DELETE',
            success: callback,
            data: data,
            contentType: type
        });
    }
    //imagenes home
    var section = $('.sub-menu' ).offset().top;
    $(window).scroll(function(){
        console.log($(window).scrollTop());
        var scroll = $(window).scrollTop();
        if(scroll > 550){
            TweenLite.to('.backDiv1', 1.5, { opacity: 1});
            TweenLite.to('.backDiv', .5, { opacity: 1, delay: .5});
        };
    });
    var animateHomeIntro = function(){
        //TweenLite.to('.welcome', 1.5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 150});
        var tl = new TimelineLite({onComplete: function(){ this.restart(); }});
        //imagen 1
        tl.to('.img1', 1, {scale: 2, opacity: 1, display: "block"});
        tl.to('.uno', .5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 120});
        tl.to('.uno', .5, {opacity: 0, display: "none", ease: Power2.easeOut, x: -200, delay: 5});
        tl.to('.img1', .5, {opacity: 0, display: "none", ease: Power2.easeOut, x: -200}, '-=0.5');
        //imagen 2
        tl.to('.img2', 1, {scale: 2, opacity: 1, display: "block"});
        tl.to('.dos', .5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 100});
        tl.to('.dos', .5, {opacity: 0, display: "none", ease: Power2.easeOut, x: -200, delay: 5});
        tl.to('.img2', .5, {opacity: 0, display: "none", ease: Power2.easeOut, x: -200}, '-=0.5');
        //imagen 3
        tl.to('.img3', 1, {scale: 2, opacity: 1, display: "block"});
        tl.to('.tres', .5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 100});
        tl.to('.tres', .5, {opacity: 0, display: "none", ease: Power2.easeOut, x: -200, delay: 5});
        tl.to('.img3', .5, {opacity: 0, display: "none", ease: Power2.easeOut}, '-=0.5');
    }
    //var animateHomeSlider = function(){
    //    var tx = new TimelineLite({onComplete: function(){ this.restart(); }});
    //    tx.to('.avuno', .5, {opacity: 1, display: "block"});
    //    tx.to('.avuno', .5, {opacity: 0, display: "none", delay: 4.5});

    //    tx.to('.avdos', 1, {opacity: 1, display: "block"});
    //    tx.to('.avdos', .5, {opacity: 0, display: "none", delay: 4.5});

    //    tx.to('.avtres', 1, {opacity: 1, display: "block"});
    //    tx.to('.avtres', .5, {opacity: 0, display: "none", delay: 4.5});
    //}
    var tx = new TimelineLite({onComplete: function(){
        this.restart();
    }});
    tx.to('.avuno', .5, {opacity: 1, display: "block"});
    tx.to('.avuno', .5, {opacity: 0, display: "none", delay: 4.5});

    tx.to('.avdos', 1, {opacity: 1, display: "block"});
    tx.to('.avdos', .5, {opacity: 0, display: "none", delay: 4.5});

    tx.to('.avtres', 1, {opacity: 1, display: "block"});
    tx.to('.avtres', .5, {opacity: 0, display: "none", delay: 4.5});
    $('.simular').on('click', function(e){
        e.preventDefault ();
        var top = $('.simulador').offset().top;
        TweenLite.to(window, 1, {scrollTo:{y: top}, ease:Power2.easeOut});
    });
    //var animateHomePhones = function(){
    //    var section = $('.simulador' ).offset().top;
    //    $(window).scroll(function(){
    //        console.log($(window).scrollTop());
    //        console.log($('.simulador' ).offset().top);
    //        var scroll = $(window).scrollTop();
    //        if(scroll > 550){
    //            TweenLite.to('.cel2', 2, { ease: Power2.easeOut, y: -300});
    //            TweenLite.to('.cel', 2, { ease: Power2.easeOut, y: -400});
    //        };
    //    });
    //}
    var menuBehaviors = function(){
        $('.menu').on('click', function (e){
            e.preventDefault ();
            TweenLite.to('.contentMenu', 1, { opacity: 1, display: 'block', ease: Power2.easeOut, x: -300, onComplete: function(){
                TweenLite.to('.menu', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, x: -200});
            }});
        });
    }
    var loginForm = function(){
      $('.login__button').on('click', function(e){
          e.preventDefault();
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
          $('#login-form .login__button').text('Entrando...');
      	  $.ajax(settings).done(function (response) {
      		    if(response.status == 200){
                  if(response.data.user_role >= 2){
                    window.location = host_url+'admin/microsite';
                  }else{
                    window.location = host_url+'admin/users';
                  }
      		    }else if(response.status == 500) {
      			      $('.responses').text(response.errors);
      			      $('.responses').show();
      		    }
      	  });
      });
    }
    var passwordResetForm = function(){
        $('.login__button').on('click', function(e){
            e.preventDefault();
            var email = $('input[name="user_email"]').val();

            $.post(host_url + "api/v1/password_reset", {email: email}, function(response){
                if(response.status == 200){
        				    $('#login-form .login__button').text('Entrando...');
        				    window.location = host_url+'admin/users';
        			  }else if(response.status == 500) {
        				    $('.responses').text(response.errors);
        				    $('.responses').show();
        			  }
            }).fail(function(){
                $('.responses').text('Falló la comunicación con el servidor, inténtalo nuevamente');
                $('.responses').show();
            });
        });
    }
    var simulador = function(){
        $('#simulador-form .send').on('click', function(){
          var nameS = $('#simulador-form #name').val();
          var phoneS = $('#simulador-form #number').val();
          var mailS = $('#simulador-form #mail').val();
          var stateS = $('#simulador-form #state').val();
          var valueS = $('#simulador-form #value').val();
          var hitchS = $('#simulador-form #hitch').val();
          var paytypeS = $('#simulador-form #paytype').val();
          var paytimeS = $('#simulador-form #paytime').val();
            /*var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/sites/"+esiteUrl+"?title="+esiteName+"&content="+esiteContent+"&address="+esiteAddress+"&contact="+esiteTelephone,
                "method": "PUT"
            }
            $.ajax(settings).done(function (response) {
               if(response.status == 200){

                }else if(response.status == 500) {
                }
            });*/
        });
    }
    var usersList = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/v1/users",
            "method": "POST"
        }
        $.ajax(settings).done(function (response) {
            var users = response.data;
            var html = '';
            $.each(users, function (index, value) {
                html += '<tr>';
                html += '<td>'+value.name+'</td>';
                html += '<td>'+value.email+'</td>';
                html += '<td>'+value.created_at+'</td>';
                html += '<td class="editInput" data-user="'+value.id+'">editar</td>';
                html += '</tr>';
            });
            $('#usersList tbody').append(html);
        });
    }
    var loadUserinfo = function(){
        $('#usersList').on('click', '.editInput' ,function (e){
            e.preventDefault ();
            var userID = $(this).data('user');
            var datauser = ''
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/users/"+userID,
                "method": "GET",
            }
            $.ajax(settings).done(function (response) {
                var user = response.data;
                $('.editarUsuario .datosUsuario #e_user_name').val(user.name);
                $('.editarUsuario .datosUsuario #e_user_email').val(user.email);
                $('.editarUsuario .datosUsuario #e_user_id').val(user.id);
            });
        });
    }
    var updateUserinfo = function(){
        $('.editarUsuario .datosUsuario .update-user').on('click', function(){
            var useridU = $('.editarUsuario .datosUsuario #e_user_id').val();
            var usernameU = $('.editarUsuario .datosUsuario #e_user_name').val();
            var mailU = $('.editarUsuario .datosUsuario #e_user_email').val();

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/users/"+useridU+'?name='+usernameU+'&email='+mailU,
                "method": "PUT"
            }
            $('.close').trigger( "click" );
            $.ajax(settings).done(function (response) {
               if(response.status == 200){
                    $('.responses').text('El usuario se ha actualizado correctamente');
                    $('.responses').show();
                }else if(response.status == 500) {
                    $('.responses').text(response.errors);
                    $('.responses').show();
                }
            });
        });
    }
    var sitesList = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/v1/sites",
            "method": "GET"
        }
        $.ajax(settings).done(function (response) {
            var sites = response.data;
            var html = '';
            $.each(sites, function (index, value) {
                html += '<tr>';
                html += '<td class="viewsite" data-site="'+value.url+'">'+value.title+'</td>';
                html += '<td class="editInput" data-site="'+value.url+'">editar</td>';
                html += '</tr>';
            });
            $('#sitesList tbody').append(html);
        });
    }
    var loadSiteinfo = function(){
        $('#sitesList').on('click', '.editInput' ,function (e){
            e.preventDefault ();
            var siteURL = $(this).data('site');
            var datauser = ''
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/sites/"+siteURL,
                "method": "GET",
            }
            $.ajax(settings).done(function (response) {
                var site = response.data;
                console.log(site);
                $('.update-site #e_siteName').val(site.title);
                $('.update-site #e_siteUrl').val(site.url);
                $('.update-site #siteState').val(site.state_id);
                $('.update-site #e_siteContent').val(site.content);
                $('.update-site #e_siteAddress').val(site.address);
                $('.update-site #e_siteTelephone').val(site.contact);
            });
        });
    }
    var viewSite = function(){
        $('#sitesList').on('click', '.viewsite' ,function (e){
            e.preventDefault ();
            var siteURL = $(this).data('site');
            var datauser = ''
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/sites/"+siteURL,
                "method": "GET",
            }
            $.ajax(settings).done(function (response) {
                var site = response.data;
                console.log(site);
            });
        });
    }
    var updateSiteinfo = function(){
        $('.update-site .updateSite').on('click', function(){
            var esiteName = $('.update-site #e_siteName').val();
            var esiteUrl = $('.update-site #e_siteUrl').val();
            var esiteContent = $('.update-site #e_siteContent').val();
            var esiteAddress = $('.update-site #e_siteAddress').val();
            var esiteTelephone = $('.update-site #e_siteTelephone').val();

            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/sites/"+esiteUrl+"?title="+esiteName+"&content="+esiteContent+"&address="+esiteAddress+"&contact="+esiteTelephone,
                "method": "PUT"
            }
            $('.close').trigger( "click" );
            $.ajax(settings).done(function (response) {
               if(response.status == 200){
                    $('.responses').text('El sitio se ha actualizado correctamente');
                    $('.responses').show();
                }else if(response.status == 500) {
                    $('.responses').text(response.errors);
                    $('.responses').show();
                }
            });
        });
    }
    var adminUsersListeners = function(){
        $('#usersList').on('click', '.editInput' ,function (e){
            e.preventDefault ();
            TweenLite.to('.editarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.plusUser').on('click', function (e){
            e.preventDefault ();
            TweenLite.to('.agregarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.close').on('click', function (e){
            e.preventDefault ();
            TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
            }});
        });
    }
    var adminSitesListeners = function(){
        $('#sitesList').on('click', '.editInput' ,function (e){
            e.preventDefault ();
            TweenLite.to('.editarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });

        $('.plusUser').on('click', function (e){
            e.preventDefault ();
            TweenLite.to('.agregarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.close').on('click', function (e){
            e.preventDefault ();
            TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
            }});
        });
    }
    var loadTheSite = function(){
        var thesite = window.location.href.split( 'site=' );
        $.get(host_url + "api/v1/sites/"+thesite[1], function(response){
            var site = response.data;
            $('.head_micrositio h1').text(site.title);
            $('.contenido_micrositio p.thecontent').text(site.content);
            console.log(site);
        });
    }
    var registerUser = function(){
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
            $('.close').trigger( "click" );
    	      $.ajax(settings).done(function (response) {
    		        if(response.status == 200){
    			          $('.responses').text('Se ha creado el usuario correctamente');
    			          $('.responses').show();
    		        }else if(response.status == 500) {
    			          $('.responses').text(response.errors);
    			          $('.responses').show();
    		        }
    	      });
        });
    }
    var registerSite = function(){
    	$('#newSiteForm .addSite').on('click', function(){
    		var userID = $('#newSiteForm #userID').val();
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
    				"user_id": userID,
    				"state_id": siteState,
    				"url": siteURL,
    				"title": siteName,
    				"content": siteContent,
    				"address": siteAddress,
    				"contact": siteTelephone
    			}
    		}
        $('.close').trigger( "click" );
    		$.ajax(settings).done(function (response) {
    			if(response.status == 200){
    				$('.responses').text('Se ha creado el sitio correctamente');
    				$('.responses').show();
    			}else if(response.status == 500) {
    				$('.responses').text(response.errors);
    				$('.responses').show();
    			}
    		});
    	});
    }
    var site = {
        "home": function(){
            animateHomeIntro();
            animateHomeSlider();
            animateHomePhones();
            menuBehaviors();
        },
        "p-home": function(){
            simulador();
        },
        "p-detalle": function(){
          loadTheSite();
        },
        "asesores": function(){
            loginForm();
        },
        "password-reset": function(){
            passwordResetForm();
        },
        "admin-users": function(){
            usersList();
            loadUserinfo();
            adminUsersListeners();
            updateUserinfo();
            registerUser();
        },
        "admin-sites": function(){
            sitesList();
            adminSitesListeners();
            loadSiteinfo();
            updateSiteinfo();
            viewSite();
            registerSite();
        }
    }

    // -  Get the current page
    var currentPage = $('.page').attr('class').split(' ')[1];
    // - Do the behaviors that correspond to the current page
    if(site[currentPage]) site[currentPage]();
});
