var host_url = "http://nueva.socasesores.com/";

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

    var animateHomeIntro = function(){
        //entrada iconos submenú
        TweenLite.to('.iconSubMenu', 2, { opacity: 1, display: 'block', ease: Power2.easeOut, y: -300});

        //imagenes home
        var section = $('.sub-menu' ).offset().top;
        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if(scroll > 550){
                TweenLite.to('.backDiv1', 1.5, { opacity: 1});
                TweenLite.to('.backDiv', .5, { opacity: 1, delay: .5});
            };
        });

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
        			$('.responses').text(response.data);
                    $('.responses').show();
                    //$('#login-form .login__button').text('Entrando...');
        			//window.location = host_url+'admin/users';
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
          console.log(nameS, phoneS, mailS, stateS, valueS, hitchS, paytypeS, paytimeS);
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
        $('.containerOffices').on('click', '.editInput' ,function (e){
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
                $('.editarUsuario .datosUsuario #e_user_company').val(user.company);
                $('.editarUsuario .datosUsuario #e_user_email').val(user.email);
                $('.editarUsuario .datosUsuario #e_user_id').val(user.id);
            });
        });
    }
    var deleteUserinfo = function(){
        $('.containerOffices').on('click', '.delete', function(e){
            e.preventDefault();
            var userID = $(this).data('user');
            var container = $(this).parent().parent().parent();
            var response = confirm('Esta acción borrará al usuario del sistema ¿Deseas continuar?');
            if(response){
                $.delete(host_url+"api/v1/users/"+userID, function(){
                    TweenLite.to(container, 0.5, {alpha: 0, onComplete: function(){
                        container.remove();
                    }});
                });
            }
        })
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
    var postsList_view = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/v1/post",
            "method": "POST"
        }
        $.ajax(settings).done(function (response) {
            var posts = response.data;
            var html = '';
            $.each(posts, function (index, value) {
                html += '<div>';
                html += '<img src="'+value.post_image+'">';
                html += '<h1>'+value.post_title+'</h1>';
                html += '<a href="'+host_url+'blog/nota?nota='+value.post_id+'" class="vnota">Ver nota</a>';
                html += '<p class="date">Posted on 17 mayo, 2016 by SOC Asesores Hipotecarios</p>';
                html += '</div>';
            });
            $('.container_blog .itemBlog').append(html);
        });
    }
    var postsList = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/v1/post",
            "method": "POST"
        }
        $.ajax(settings).done(function (response) {
            var blogpost = response.data;
            var html = '';
            $.each(blogpost, function (index, value) {
                html += '<tr>';
                html += '<td class="viewsite" data-post="'+value.post_title+'">'+value.post_title+'</td>';
                html += '<td class="editInput" data-post="'+value.post_id+'">editar</td>';
                html += '</tr>';
            });
            $('#postList tbody').append(html);
        });
    }
    var loadPostInfo = function(){
        var url = window.location.href;
        var postID = url.split("?nota=");
        postID = postID[1];
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/v1/post/" +postID,
            "method": "GET"
        }
        $.ajax(settings).done(function (response) {
            var postInfo = response.data[0];
            $('.contenido-nota h1').text(postInfo.post_title);
            $('.contenido-nota .post-image').attr('src',postInfo.post_image);
            $('.contenido-nota .post-content p').text(postInfo.post_content);
        });
    }
    var loadPostinfoEdit = function(){
        $('#postList').on('click', '.editInput' ,function (e){
            e.preventDefault ();
            var postID = $(this).data('post');
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": host_url + "api/v1/post/"+postID,
                "method": "GET",
            }
            $.ajax(settings).done(function (response) {
                var post = response.data;
                $('.editarUsuario .datosUsuario #e_post_id').val(post[0].post_id);
                $('.editarUsuario .datosUsuario #e_post_title').val(post[0].post_title);
                //$('.editarUsuario .datosUsuario #e_post_image').val(post[0].post_image);
                $('.editarUsuario .datosUsuario #e_post_content').val(post[0].post_content);
            });
        });
    }
    var updatePostinfo = function(){
        $('#editPostForm .updatePost').on('click', function(){
            var epost_id = $('#editPostForm #e_post_id').val();
            var epost_title = $('#editPostForm #e_post_title').val();
            console.log(epost_title);

            $('.close').trigger( "click" );
            $.put(host_url + 'api/v1/post/'+epost_id,
                {post_title: epost_title
                }, function(response){
                    if(response.status == 200){
                        $('.responses').text('El sitio se ha actualizado correctamente');
                        $('.responses').show();
                    }else if(response.status == 500) {
                        $('.responses').text(response.errors);
                        $('.responses').show();
                    }
                })
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
                $('.update-site #e_siteContent').val(site.content);
                $('.update-site #e_siteState').val(site.state_id);
                $('.update-site #e_siteCity').val(site.city);
                $('.update-site #e_siteSettlement').val(site.settlement);
                $('.update-site #e_siteAddress').val(site.address);
                $('.update-site #e_siteMails').val(site.emails);
                $('.update-site #e_siteTelephone').val(site.phones);
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
            var esiteState = $('.update-site #e_siteState').val();
            var esiteCity = $('.update-site #e_siteCity').val();
            var esiteSettlement = $('.update-site #e_siteSettlement').val();
            var esiteAddress = $('.update-site #e_siteAddress').val();
            var esiteMails = $('.update-site #e_siteMails').val();
            var esitePhones = $('.update-site #e_siteTelephone').val();

            $('.close').trigger( "click" );
            $.put(host_url + 'api/v1/sites/'+esiteUrl,
                {title: esiteName,
                content: esiteContent,
                state: esiteState,
                city: esiteCity,
                settlement: esiteSettlement,
                address: esiteAddress,
                emails: esiteMails,
                phones: esitePhones
                }, function(response){
                    if(response.status == 200){
                        $('.responses').text('El sitio se ha actualizado correctamente');
                        $('.responses').show();
                    }else if(response.status == 500) {
                        $('.responses').text(response.errors);
                        $('.responses').show();
                    }
                })
        });
    }
    var adminUserSitesListeners = function(){
        $('.container-sites').on('click', '.edit', function(e){
            e.preventDefault();
            TweenLite.to('.editarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.plusUser').on('click', function(e){
            e.preventDefault();
            TweenLite.to('.agregarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.close').on('click', function(e){
            e.preventDefault();
            TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
            }});
        });
    }
    var adminUsersListeners = function(){
        $('.containerOffices').on('click', '.editInput' , function (e){
            e.preventDefault();
            TweenLite.to('.editarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.plusUser').on('click', function(e){
            e.preventDefault();
            TweenLite.to('.agregarUsuario', .5, {opacity: 1, display: 'block', onComplete: function(){
                TweenLite.to('.datosUsuario', .5, { opacity: 1, display: 'block', ease: Power2.easeOut, y: 30});
            }});
        });
        $('.close').on('click', function(e){
            e.preventDefault();
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
    var adminBlogListeners = function(){
        $('#postList').on('click', '.editInput' ,function (e){
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
    var updateBrokerSite = function(){
        var prev = $('#siteUrl').val();
        console.log(prev);
        $('.addSite').on('click', function(){
            $.put(host_url  + "api/v1/sites/" + prev + "?" + $('#newSiteForm').serialize(), function(response){
                console.log(response);
            });
        });
    }
    var findBroker = function(){
        $('#ddlEstados').on('change', function(){
            var state_id = $(this).val();
            $.post(host_url + "api/v1/brokers", {state: state_id}, function(response){
                if(response.status == 500){
                    $('.responses').text(response.errors[0]);
                    TweenLite.set('.contenido', {display: 'none'});
                    TweenLite.set('.responses', {display: 'block', opacity: 0});
                    TweenLite.to('.responses', 0.3, {opacity: 1});
                    return;
                }
                var brokers = response.data;
                $('.contenido').empty();
                $.each(brokers, function(index, value){
                    var phones = value.phones.split(',');
                    var emails = value.emails.split(',');
                    var brokerDiv = $('<div>', {class: 'broker'});

                    brokerDiv.append($('<h1>', {text: value.title}));
                    brokerDiv.append($('<a>', {text: 'Micrositio', href: host_url + value.url}));
                    brokerDiv.append($('<p>', {text: value.city}));
                    brokerDiv.append($('<p>', {text: value.settlement}));

                    for (var i = value.phones.length - 1; i >= 0; i--) {
                        brokerDiv.append($('<a>', {text: phones[i], href: 'tel:'+phones[i]}));
                    }

                    for (var i = value.emails.length - 1; i >= 0; i--) {
                        brokerDiv.append($('<a>', {text: emails[i], href: 'mailto:'+emails[i]}));
                    }

                    brokerDiv.append($('<address>', {text: value.address}));
                    brokerDiv.append($('<a>', {text: 'Ver mapa', href: value.coordinates}));

                    brokerDiv.appendTo('.contenido');
                });
                TweenLite.set('.contenido', {display: 'flex'});
                TweenLite.set('.responses', {display: 'none'});
                TweenMax.staggerFrom('.broker', 0.3, {alpha: 0, y: -10, delay: .1}, .2);
            });
        });
    }
    var simulatorListeners = function(){

    }
    var site = {
        "p-home": function(){
            simulador();
            animateHomeIntro();
            //animateHomeSlider();
            //animateHomePhones();
            menuBehaviors();
        },
        /*"p-detalle": function(){
          loadTheSite();
        },*/
        "p-simulator": function(){
            simulatorListeners();
        },
        "p-offices": function(){
            findBroker();
        },
        "asesores": function(){
            loginForm();
        },
        "microsite": function(){
            updateBrokerSite();
        },
        "password-reset": function(){
            passwordResetForm();
        },
        "admin-users": function(){
            //usersList();
            loadUserinfo();
            adminUsersListeners();
            updateUserinfo();
            deleteUserinfo();
            registerUser();
        },
        "user-sites": function(){
            adminUserSitesListeners();
            loadSiteinfo();
            updateSiteinfo();
            //deleteSiteinfo();
            registerSite();
        },
        "admin-sites": function(){
            sitesList();
            adminSitesListeners();
            loadSiteInfo();
            updateSiteInfo();
            viewSite();
            registerSite();
        },
        "admin-blog":function(){
            postsList();
            adminBlogListeners();
            loadPostinfoEdit();
            updatePostinfo();
        },
        "p-blog":function(){
            postsList_view();
        },
        "p_blog_nota":function(){
            loadPostInfo();
        }
    }

    // -  Get the current page
    var currentPage = $('.page').attr('class').split(' ')[1];
    // - Do the behaviors that correspond to the current page
    if(site[currentPage]) site[currentPage]();
});
