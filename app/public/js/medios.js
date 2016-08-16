$(document).on("ready", function () {
	TweenMax.to(".pop", 0.5, {opacity: 1, display: "block", onComplete: function () {
		TweenMax.to(".tex-pop", 1, {opacity: 1, display: "block",  ease: Power2.easeOut, y: 300, onComplete: function (){
			TweenMax.to(".pop", 1.8, {opacity: 0, display: "none", delay: 2, ease: Power2.easeOut, y: 0});
		}});
	}});
});