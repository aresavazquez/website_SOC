$(document).on("ready", function () {
	TweenMax.to(".pop", 0.2, {opacity: 1, display: "block", onComplete: function () {
		TweenMax.to("", 0.5, {opacity: 1, display: "block",  ease: Power2.easeOut, y: 300, onComplete: function (){
			TweenMax.to(".pop", 0.5, {opacity: 0, display: "none", delay: 1, ease: Power2.easeOut, y: 0});
		}});
	}});
	$(".flecha").click(function(){
        $("#home1").slideToggle();
    });
    $("#boton-info").on("click", function(){
        TweenMax.to(".como-usar", 0.4, {opacity: 1, display: "block"});
        $(".close-cartel").on("click", function(){
            TweenMax.to(".como-usar", 0.4, {opacity: 0, display: "none"});
        });
    });

    $("#lazzer").on("click", function(){
    	TweenMax.to("#lazzer-anuncio", 0.8, {opacity: 1, display: "block"});
        $(".close").on("click", function(){
            TweenMax.to("#lazzer-anuncio", 0.8, {opacity: 0, display: "none"});
        });
    });
    $("#izzi").on("click", function(){
        TweenMax.to("#izzi-anuncio", 0.8, {opacity: 1, display: "block"});
        $(".close").on("click", function(){
            TweenMax.to("#izzi-anuncio", 0.8, {opacity: 0, display: "none"});
        });
    });
    $("#moving").on("click", function(){
        TweenMax.to("#moving-anuncio", 0.8, {opacity: 1, display: "block"});
        $(".close").on("click", function(){
            TweenMax.to("#moving-anuncio", 0.8, {opacity: 0, display: "none"});
        });
    });
    $("#att").on("click", function(){
        TweenMax.to("#att-anuncio", 0.8, {opacity: 1, display: "block"});
        $(".close").on("click", function(){
            TweenMax.to("#att-anuncio", 0.8, {opacity: 0, display: "none"});
        });
    });
    $("#viajes").on("click", function(){
        TweenMax.to("#agencia-viajes", 0.8, {opacity: 1, display: "block"});
        $(".close").on("click", function(){
            TweenMax.to("#agencia-viajes", 0.8, {opacity: 0, display: "none"});
        });
    });
});	