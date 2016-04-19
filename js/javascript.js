$(document).on('ready', function(){
    TweenLite.to('.welcome', 1.5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 150});
    var tl = new TimelineLite({onComplete: function(){
        this.restart();
    }});
//imagen 1
    tl.to('.img1', 1, {scale: 2, opacity: 1, display: "block"});
    tl.to('.uno', .5, {opacity: 1, display: "block", ease: Power2.easeOut, y: 150});
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

//slider commments
    var tx = new TimelineLite({onComplete: function(){
        this.restart();
    }});
    tx.to('.avuno', .5, {opacity: 1, display: "block"});
    tx.to('.avuno', .5, {opacity: 0, display: "none", delay: 4.5});

    tx.to('.avdos', 1, {opacity: 1, display: "block"});
    tx.to('.avdos', .5, {opacity: 0, display: "none", delay: 4.5});

    tx.to('.avtres', 1, {opacity: 1, display: "block"});
    tx.to('.avtres', .5, {opacity: 0, display: "none", delay: 4.5});

    $('.menu').on('click', function (e){
        e.preventDefault ();
        TweenLite.to('.contentMenu', 1, { opacity: 1, display: 'block', ease: Power2.easeOut, x: -300, onComplete: function(){
            TweenLite.to('.menu', .5, { opacity: 0, display: 'none', ease: Power2.easeOut, x: -200});
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
        }});
    });
//efecto celulares
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
});













