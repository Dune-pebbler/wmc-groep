jQuery(document).ready(function($){
    
/* HERO */
	$(document).on('click', '.c-scroller', function(){
        var nextSection = $(this).closest('section').next('section');
		if (nextSection.length) {
			$('html, body').animate({
				scrollTop: nextSection.offset().top -50
			}, 500);
		}
	});
/* MOBILE NAV */
	$("#mobile-nav ul").removeClass("uk-navbar-dropdown");
	
/* HAMBURGER */
	jQuery('.c-hamburger').click(function(){
		jQuery(this).toggleClass('active');
    });

});