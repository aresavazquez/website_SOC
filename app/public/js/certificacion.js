$(document).on('ready', function(){
    $("#boton-asesor").on("click", function(e) {
        e.preventDefault()
        TweenMax.to('.formulario-asesor', 1, { ease: Expo.easeOut, y: 100, display: 'block', opacity: 1});
    });
    $(".close").on("click", function() {
        TweenMax.to(".formulario-asesor", 1, { ease: Expo.easeOut, y: 0, display: "none", opacity: 0});
    });
    $("#boton-oficina").on("click", function(e) {
    	 e.preventDefault()
    	 TweenMax.to(".formulario-oficinas", 1, { ease: Expo.easeOut, y: 100, display: 'block', opacity: 1});
    });
    $(".close").on("click", function() {
        TweenMax.to(".formulario-oficinas", 1, { ease: Expo.easeOut, y: 0, display: "none", opacity: 0});
    });
});