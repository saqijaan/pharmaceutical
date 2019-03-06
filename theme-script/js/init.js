jQuery(document).ready(function($) {
	"use strict";
	
	// Touch hover fix
	$('.gallery-item').on("touchstart", function (e) {
		var link = $(this); //preselect the link
		
		if (link.hasClass('touch-hover')) {
			return true;
		} else {
			link.addClass('touch-hover');
			$('.gallery-item').not(this).removeClass('touch-hover');
			e.preventDefault();
			return false; //extra, and to make sure the function has consistent return points
		}
	});
	
	
	$(window).scroll(function() {
		// Mobile sticky header
		if ($(this).scrollTop() > 0) {
				$('#mobile-site-header').css({ 'position' : 'fixed', 'top' : '0px', 'width' : 'calc(100% - 30px)',  'z-index' : '9999' });
			} else {
				$('#mobile-site-header').css({ 'position' : 'relative', 'width' : '100%' });
		}
		// Scroll to top button
		if ( $(this).scrollTop() > 150 ) {
			$('.scrollToTop').addClass('scrollactive');
		} else {
			$('.scrollToTop').removeClass('scrollactive');
		}
	});
	
	
	// Hamburger menu toggle
	$('.menu-toggle-wrapper').click(function () {
		$('#site-navigation-side, #wrapper').toggleClass('side-menu-active');
		$('#site-navigation-overlay, #wrapper').toggleClass('overlay-menu-active');
	});		
	
	$('#wrapper').mouseup(function(e) {
        var subject = $("#site-navigation-side"); 
        if(e.target.id != subject.attr('id') && !subject.has(e.target).length) {
            $('#site-navigation-side, #wrapper').removeClass('side-menu-active');
        }
    });

	
	// Mobile menu
	$('.toggle-mobile-menu').click(function () {
		$('#mobile-site-navigation, #wrapper, #mobile-menu-bg').toggleClass('mobile-menu-active');
	});		
	
	$('#mobile-menu-bg').click(function () {
		$('#mobile-site-navigation, #wrapper, #mobile-menu-bg').removeClass('mobile-menu-active');
	});
	
	$('#mobile-site-navigation ul li.menu-item-has-children span, #mobile-site-navigation ul li.menu-item-has-children a').click(function () {
		$(this).parent().toggleClass('submenu-open');
	});	
	
	
	// Scroll to top link
	$('a[href="#top"]').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});	
	
	
	// One page menu scroll
	$('.one-page-link a[href^="#"]').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
			|| location.hostname == this.hostname) {

			var header = $('#site-header').height() + 20;
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			   if (target.length) {
				 $('html,body').animate({
					 scrollTop: target.offset().top - header
				}, 1000);
				return false;
			}
		}
	});

	
	// Header search toggle
	$('.toggle-header-search').click(function () {
		$('body').toggleClass('header-search-active');
	});
	
	
	// Set top bar drop-down heigth
	var topBar = $('#top-bar-wrapper').innerHeight() + 'px';
	$('#top-bar .widget_nav_menu ul.menu > li > a').css('line-height', topBar);
	
	
	// Remove animation when viewing on mobile devices
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$('.wpb_animate_when_almost_visible').removeClass('wpb_animate_when_almost_visible');
	}
	
	// Visual Composer RTL fix
	$(window).load(function() {
		if( $('html').attr('dir') == 'rtl' ){
        $('[data-vc-full-width="true"]').each( function(i,v){
            $(this).css('right' , $(this).css('left') ).css( 'left' , 'auto');
        });
		}
	});
	
});