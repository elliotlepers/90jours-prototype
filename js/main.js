jQuery(".slider").fullpage({
	navigation: false,
	keyboardScrolling: true,
	recordHistory: true,
	lockAnchors: true,
	animateAnchor: false,
	touchSensitivity: 200,
    verticalCentered: false
});

jQuery(".btn").on("click", function(){
	jQuery.fn.fullpage.moveSectionDown();
});