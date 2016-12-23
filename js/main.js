$(".slider").fullpage({
	navigation: false,
	keyboardScrolling: true,
	recordHistory: true,
	lockAnchors: false,
	animateAnchor: true,
	touchSensitivity: 200,
    verticalCentered: false,
    fadingEffect: "slides"
});

$(".btn-next").on("click", function(){
	$.fn.fullpage.moveSectionDown();
});

$(".btn-start").on("click", function(){
    $(".active").addClass("started hasback");
});

$(".btn-back").on("click", function(){
   $(".active").removeClass("started hasback"); 
});