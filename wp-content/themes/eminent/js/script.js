/****/
jQuery(document).ready(function () {
    //MENU
    jQuery('.menu-button').on('click', function () {
        var overlay = jQuery('.overlay-nav');
        jQuery(this).toggleClass('active');
        jQuery('.header-navigation').toggleClass('nav-mobile');
        overlay.toggleClass('overlay-nav-active');
        overlay.addClass('overlay-fix');

        if (!overlay.hasClass('overlay-nav-active')) {
            setTimeout(function () {
                overlay.removeClass('overlay-fix');
            }, 1000);
        }

    });

    if (jQuery(window).width() <= 992) {
        jQuery(".overlay-nav").next().css({"padding-top": jQuery(".overlay-nav").height()});
    }
    else {

    }
    // search toggle
    jQuery('.theme_search_toggle').on("click", function () {
        jQuery('.theme_search_wrapper').slideToggle(200);
    });

// menu toggle
    jQuery('.theme_search_toggle a').on("click", function () {
        jQuery('.theme_search_menu').slideToggle(200);
    });

    headeranim();
});
function headeranim() {
    if (jQuery(window).width() > 992) {
	if (jQuery('body').hasClass('logged-in'))
	{

        	jQuery("header").css({"position": 'fixed',top: '32px'});
        	jQuery("header").parent().next().css({"padding-top": jQuery("header").height()});
	}
	else
	{
		jQuery("header").css({"position": 'fixed',top: '0px'});
        	jQuery("header").parent().next().css({"padding-top": jQuery("header").height()});
	}
	
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 200){jQuery('.top-header').slideUp();}else{jQuery('.top-header').slideDown();}
        });
	
    }
    else {jQuery("header").css({"position": 'relative'});}

}
jQuery(window).resize(function () {
    headeranim();
});

