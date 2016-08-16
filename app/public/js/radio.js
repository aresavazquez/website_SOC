$(document).on("ready", function () {
	TweenMax.to(".pop-radio", 1, {opacity: 1, display: "block"});
	$(".close").on("click", function (e){
		e.preventDefault();
		TweenMax.to(".pop-radio", 1, {opacity: 0, display: "none"});
	});
});