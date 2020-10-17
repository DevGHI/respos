//  ====================================================================
//	Theme Name: Lumen - Multi-purpose Bootstrap Template
//	Theme URI: http://themeforest.net/user/responsiveexperts
//	Description: This javascript file is using as a settings file. This file includes the sub scripts for the javascripts used in this template.
//	Version: 1.0
//	Author: Responsive Experts
//	Author URI: http://themeforest.net/user/responsiveexperts
//	Tags:
//  ====================================================================

//	TABLE OF CONTENTS
//	---------------------------
//	 01. Preloader
//	 02. Flexslider
//   03. Adding fixed position to header
//	 04. Menu Toggle
//	 05. pop up
//	 06. Scroll To Top
//	 07. Scroll to Top

//  ====================================================================


(function() {
	"use strict";
	
	// -------------------- 01. Preloader ---------------------
	// --------------------------------------------------------

	$(window).load(function() {
		$("#loader").fadeOut();
		$("#mask").delay(1000).fadeOut("slow");
	});
	
	// ------------------- 02. Flexslider ------------------
	// --------------------------------------------------------
	
			$(window).load(function() {
		  $('#banner-slider').flexslider({
			animation: "fade",
			controlNav: true,
			slideshowSpeed:5000,
			animationSpeed:1000,
			directionNav: true
		  });
		  $('#testimonial-slider').flexslider({
			animation: "slide",
			controlNav: true,
			slideshowSpeed:6000,
			animationSpeed:2000,
			directionNav: true
		  });
		});
	
	
	
	
	// --------- 03. Adding fixed position to header ---------- 
	// --------------------------------------------------------
	
	$(document).scroll(function() {
		if ($(document).scrollTop() >= 1) {
		  $('.header-area').addClass('navbar-fixed-top');
		} else {
		  $('.header-area').removeClass('navbar-fixed-top');
		}
	});
	
	// -------------------- 04. Menu Toggle -------------------
	// --------------------------------------------------------
	
	$( ".togg-navi" ).click(function() {
		$( ".menu-main" ).toggle();
	});
	
	
	// -------------------- 05. pop up --------------------
	// --------------------------------------------------------

	      $(document).ready(function() {
        $('.yellow-solid').magnificPopup({
          delegate: '.srch',
          type: 'image',
          tLoading: 'Loading image',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          },
          image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
             // return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
            }
          }
        });
      });
	  // ------------------- 06. Scroll To Top ------------------
	// --------------------------------------------------------
	
	$(function() {
	$(document).on("scroll", onScroll);
		
		$('a[href*=#]:not([href=#])').click(function() {
			$('.menu-main li').removeClass('active');
			$(this).parent().addClass('active');
			if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
	
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 100);
					return false;
				}
			}
			
		});
	});
	function onScroll(event){
		var scrollPos = $(document).scrollTop();
		$('.menu-main li a[href*=#]:not([href=#])').each(function () {
			var currLink = $(this);
			var refElement = $(currLink.attr("href"));
			if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
				$('.menu-main li').removeClass("active");
				currLink.parent().addClass("active");
			}
			else{
				currLink.parent().removeClass("active");
			}
		});
	}

	  // ------------------- 07. arrow scrolling back to top ------------------
	// --------------------------------------------------------
	
	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
			$('#return-to-top').fadeIn(200);    // Fade in the arrow
		} else {
			$('#return-to-top').fadeOut(200);   // Else fade out the arrow
		}
	});
	$('#return-to-top').click(function() {      // When arrow is clicked
		$('body,html').animate({
			scrollTop : 0                       // Scroll to top of body
		}, 500);
	});


})(jQuery);


