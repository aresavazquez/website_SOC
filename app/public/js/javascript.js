var host_url = location.protocol + "//" + location.host + "/" || "http://nueva.socasesores.com/";

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

$.fn.simulator = function() {
  var name = this.find('#name');
  var phone = this.find('#number');
  var mail = this.find('#mail');
  var state = this.find('#state');
  var value = this.find('#value');
  var hitch = this.find('#hitch');
  var paytype = this.find('#paytype');
  var paytime = this.find('#paytime');
  var self = this;

  var inputs = [
    {input: name, valid: true, rules: 'exist,hasValue'},
    {input: phone, valid: true, rules: 'exist,isNumber,minLength:7,maxLength:10'},
    {input: mail, valid: true, rules: 'exist,validEmail'},
    {input: state, valid: true, rules: 'notEqual:-1'},
    {input: value, valid: true, rules: 'exist,hasValue,isNumber'},
    {input: hitch, valid: true, rules: 'exist,hasValue,isNumber'},
    {input: paytype, valid: true, rules: 'notEqual:-1'},
    {input: paytime, valid: true, rules: 'notEqual:-1'}
  ];

  self.exist = function(value){
    return value != null;
  }

  self.hasValue = function(value){
    return value != '';
  }

  self.isNumber = function(value){
    return !isNaN(value);
  }

  self.hasLength = function(value, params){
    return value.length == params;
  }

  self.minLength = function(value, params){
    return value.length >= params;
  }

  self.maxLength = function(value, params){
    return value.length <= params;
  }  

  self.validEmail = function(value){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(value);
  }

  self.notEqual = function(value, params){
    return value != params;
  }

  self.biggerThan = function(value, params){
    return value > params;
  }

  self.validate = function(value,rules, cb){
    var success = true;
    var methodI = 0;
    var methods = rules.split(',');
    $.each(methods, function(index, item){
        var method = item.split(':')[0];
        var params = item.split(':')[1];
        var eval = self[method].call(this, value, params);
        if(!eval) success = false;
        methodI++;
        if(methodI == methods.length) cb(success);
    });
  }

  self.find('button[type="submit"]').on('click', function(e){
    e.preventDefault();
    var success = true;

    $.each(inputs, function(index, item){
        item.valid = true;
        item.input.css({'border-color':'#4fa753'});
        self.validate(item.input.val(), item.rules, function(valid){
            if(!valid){
                item.input.css({'border-color': 'red'});
                item.valid = false;
                success = false;
            }
        });
        if(index == inputs.length - 1){
            console.log(success, self);
            if(success) self.find('form').submit();
        };
    });
  });
};

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

    $('.iconMenu').on('click', function (e){
        e.preventDefault ();
        TweenLite.to('.contentMenuCel', .5, { opacity: 1, display: 'block', onComplete: function(){
            TweenLite.to('.iconMenu', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, x: 50});
            TweenLite.to('.iconMenuClose', 1, { opacity: 1, display: 'block', ease: Power2.easeOut, x: 0});
        }});
    });

    $('.iconMenuClose').on('click', function (e){
        e.preventDefault ();
        TweenLite.to('.contentMenuCel', .5, { opacity: 0, display: 'none', onComplete: function(){
            TweenLite.to('.iconMenuClose', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, x: 50});
            TweenLite.to('.iconMenu', 1, { opacity: 1, display: 'block', ease: Power2.easeOut, x: 0});
        }});
    });

    $('.opcionesPro').on('click', function (e){
        e.preventDefault ();
        TweenLite.to('.hiem', .5, { opacity: 1, display: 'block'});
    });

    $('.submenuCel').on('click', function (e){
        e.preventDefault ();
        TweenLite.to('.contenidoSubmenu', 1, { opacity: 1, display: 'block'});
    });

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
            var userID = $('.editarUsuario .datosUsuario #e_user_id').val();
            var data = $('.editarUsuario .datosUsuario').serialize();
            $.put(host_url + "api/v1/users/"+userID, data, function(response){
                if(response.status == 200){
                    $('.responses').text('El usuario se ha actualizado correctamente');
                    $('.responses').show();
                    TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                        TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                        TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
                        location.reload();
                    }});
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
        $('.container-sites').on('click', '.edit' ,function (e){
            e.preventDefault ();
            var siteID = $(this).data('site');
            $.get(host_url + "api/v1/sites/"+siteID, function(response){
                var site = response.data;
                $('#e_siteID').val(site.id);
                $('#e_siteName').val(site.title);
                $('#e_siteUrl').val(site.url);
                $('#e_siteContent').val(site.content);
                $('#e_siteState').val(site.state_id);
                $('#e_siteCity').val(site.city);
                $('#e_siteSettlement').val(site.settlement);
                $('#e_siteAddress').val(site.address);
                $('#e_siteLatlon').val(site.latlon);
                $('#e_siteMails').val(site.emails);
                $('#e_siteTelephone').val(site.phones);
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
            var siteID = $('.update-site #e_siteID').val();
            $.put(host_url + 'api/v1/sites/'+siteID, $('.update-site').serialize(), function(response){
                $('.responses').text('El sitio se ha actualizado correctamente');
                $('.responses').show();
                TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                    TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                    TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
                    location.reload();
                }});
            });
        });
    }
    var deleteSiteinfo = function(){
        $('.container-sites').on('click', '.delete', function(e){
            e.preventDefault();
            var siteID = $(this).data('site');
            var container = $(this).parent().parent().parent().parent();
            var response = confirm('Esta acción borrará el sitio del sistema permanentemente ¿Deseas continuar?');
            if(response){
                $.delete(host_url+"api/v1/sites/"+siteID, function(){
                    TweenLite.to(container, 0.5, {alpha: 0, onComplete: function(){
                        container.remove();
                    }});
                });
            }
        })
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
            $.post(host_url + "api/v1/register", $('.agregarUsuario .datosUsuario').serialize(), function(response){
                TweenLite.to('.datosUsuario', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, y: 0, onComplete: function(){
                    TweenLite.to('.agregarUsuario', .5, {opacity: 0, display: 'none'});
                    TweenLite.to('.editarUsuario', .5, {opacity:0, display: 'none'});
                    location.reload();
                }});
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
            $.post(host_url + "api/v1/sites", $('#newSiteForm').serialize(), function(response){
                $('.close').trigger( "click" );
                location.reload();
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
        $('.printSimulator').on('click', function(e){
            e.preventDefault();
            print();
        });
    }
    var site = {
        "p-home": function(){
            animateHomeIntro();
            //animateHomeSlider();
            //animateHomePhones();
            $('.simulador .form').simulator();
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
            //$('#gmaps').locationpicker();
            adminUserSitesListeners();
            loadSiteinfo();
            updateSiteinfo();
            deleteSiteinfo();
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
            $('.post_content').trumbowyg();
            //postsList();
            //adminBlogListeners();
            //loadPostinfoEdit();
            //updatePostinfo();
        },
        "p-blog":function(){
            //postsList_view();
        },
        "p_blog_nota":function(){
            //loadPostInfo();
        },
        "upload":function(){
            console.log('Upload script');
        }
    }

    // -  Get the current page
    var currentPage = typeof $('.page').attr('class') != "undefined" ? $('.page').attr('class').split(' ')[1] : "";
    // - Do the behaviors that correspond to the current page
    if(site[currentPage]) site[currentPage]();
});
