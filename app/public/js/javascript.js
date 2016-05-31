$(document).on('ready', function(){
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
    var animateHomeSlider = function(){
        var tx = new TimelineLite({onComplete: function(){ this.restart(); }});
        tx.to('.avuno', .5, {opacity: 1, display: "block"});
        tx.to('.avuno', .5, {opacity: 0, display: "none", delay: 4.5});

        tx.to('.avdos', 1, {opacity: 1, display: "block"});
        tx.to('.avdos', .5, {opacity: 0, display: "none", delay: 4.5});

        tx.to('.avtres', 1, {opacity: 1, display: "block"});
        tx.to('.avtres', .5, {opacity: 0, display: "none", delay: 4.5});
    }

    var animateHomePhones = function(){
        var section = $('.simulador' ).offset().top;
        $(window).scroll(function(){
            console.log($(window).scrollTop());
            console.log($('.simulador' ).offset().top);
            var scroll = $(window).scrollTop();
            if(scroll > 550){
                TweenLite.to('.cel2', 2, { ease: Power2.easeOut, y: -300});
                TweenLite.to('.cel', 2, { ease: Power2.easeOut, y: -400});
            };
        });
    }

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
            var data = {
                
            }
            var usr = $('input[name="user_name"]').val();
            var pwd = $('input[name="user_password"]').val();
            console.log(usr,pwd);
        });
    }

    var usersList = function(){
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": host_url + "api/users",
            "method": "POST"
        }
        $.ajax(settings).done(function (response) {
            var users = response.data.users;
            var html = '';
            $.each(users, function (index, value) {
                html += '<tr>';
                html += '<td>'+value.name+'</td>';
                html += '<td>'+value.email+'</td>';
                html += '<td>'+value.created_at+'</td>';
                html += '<td class="editInput">editar</td>';
                html += '</tr>';
            });
            $('#usersList tbody').append(html);
            //console.log(users);
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

    var site = {
        "home": function(){
            animateHomeIntro();
            animateHomeSlider();
            animateHomePhones();
            menuBehaviors();
        },
        "asesores-login": function(){
            loginForm();
        },
        "admin-users": function(){
            usersList();
            adminUsersListeners();
        }
    }

    // -  Get the current page
    var currentPage = $('.page').attr('class').split(' ')[1];
    // - Do the behaviors that correspond to the current page
    if(site[currentPage]) site[currentPage]();
});












