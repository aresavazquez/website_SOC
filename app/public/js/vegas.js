$(document).on('ready', function(){
	TweenMax.to('.gif', 2, {opacity: 1});
	var logo = $('.gif').offset().top;
	$(window).scroll(function(){
		console.log($(window).scrollTop());
		console.log($('.gif' ).offset().top);
		var scroll = $(window).scrollTop();
		if(scroll = 50){
			TweenLite.to('.gif', 2, { opacity: 0 });
		};
	});
	var logo = $('.gif').offset().top;
	$(window).scroll(function(){
		console.log($(window).scrollTop());
		console.log($('.gif' ).offset().top);
		var scroll = $(window).scrollTop();
		if(scroll < 85){
			TweenLite.to('.gif', 3, { opacity: 1 });
		};
	});
	var logo = $('.gif').offset().top;
	$(window).scroll(function(){
		console.log($(window).scrollTop());
		console.log($('.gif' ).offset().top);
		var scroll = $(window).scrollTop();
		if(scroll > 300){
			TweenLite.to('.logo', 1, { opacity: 1 });
		};
	});
	var logo = $('.gif').offset().top;
	$(window).scroll(function(){
		console.log($(window).scrollTop());
		console.log($('.gif' ).offset().top);
		var scroll = $(window).scrollTop();
		if(scroll > 800){
			TweenLite.to('.tips', 4, { opacity: 1 });
		};
	});
	var logo = $('.logo').offset().top;
	$(window).scroll(function(){
		console.log($(window).scrollTop());
		console.log($('.logo' ).offset().top);
		var scroll = $(window).scrollTop();
		if(scroll > logo){
			TweenMax.to('.container', 1, {opacity: 1});
			$('.container').addClass("backGradient");
		};
	});
	$('.descarga').on('mouseover', function(){
		TweenMax.to('.descarga', .5, {borderRadius: "0px", background: "#126E94"});
	});
	$('.descarga').on('mouseleave', function(){
		TweenMax.to('.descarga', .5, {borderRadius:"25px", background: "#1dafec"});
	});

	$('.drop').on('mouseover', function(){
		TweenMax.to('.drop', .5, {borderRadius: "0px", background: "#126E94"});
	});
	$('.drop').on('mouseleave', function(){
		TweenMax.to('.drop', .5, {borderRadius:"25px", background: "#1dafec"});
	});
});