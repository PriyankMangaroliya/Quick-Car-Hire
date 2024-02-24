 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

(function($) {

	"use strict";

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
    responsive: true,
    parallaxBackgrounds: true,
    parallaxElements: true,
    horizontalScrolling: false,
    hideDistantElements: false,
    scrollProperty: 'scroll'
  });


	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function() {
		setTimeout(function() { 
			if($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
   $.Scrollax();

	var carousel = function() {
		$('.carousel-car').owlCarousel({
			center: true,
			loop: true,
			autoplay: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items:1,
			margin: 30,
			stagePadding: 0,
			nav: false,
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive:{
				0:{
					items: 1
				},
				600:{
					items: 2
				},
				1000:{
					items: 3
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function(){
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function(){
		var $this = $(this);
			// timer;
		// timer = setTimeout(function(){
			$this.removeClass('show');
			$this.find('> a').attr('aria-expanded', false);
			// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
			$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
	  console.log('show');
	});

	// scroll
	var scrollWindow = function() {
		$(window).scroll(function(){
			var $w = $(this),
					st = $w.scrollTop(),
					navbar = $('.ftco_navbar'),
					sd = $('.js-scroll-wrap');

			if (st > 150) {
				if ( !navbar.hasClass('scrolled') ) {
					navbar.addClass('scrolled');	
				}
			} 
			if (st < 150) {
				if ( navbar.hasClass('scrolled') ) {
					navbar.removeClass('scrolled sleep');
				}
			} 
			if ( st > 350 ) {
				if ( !navbar.hasClass('awake') ) {
					navbar.addClass('awake');	
				}
				
				if(sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if ( st < 350 ) {
				if ( navbar.hasClass('awake') ) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if(sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
			BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
			iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
			Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
			Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
			any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var counter = function() {
		
		$('#section-counter, .hero-wrap, .ftco-counter').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function(){
					var $this = $(this),
						num = $this.data('number');
						console.log(num);
					$this.animateNumber(
					  {
					    number: num,
					    numberStep: comma_separator_number_step
					  }, 7000
					);
				});
				
			}

		} , { offset: '95%' } );

	}
	counter();


	var contentWayPoint = function() {
		var i = 0;
		$('.ftco-animate').waypoint( function( direction ) {

			if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {
				
				i++;

				$(this.element).addClass('item-animate');
				setTimeout(function(){

					$('body .ftco-animate.item-animate').each(function(k){
						var el = $(this);
						setTimeout( function () {
							var effect = el.data('animate-effect');
							if ( effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if ( effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if ( effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						},  k * 50, 'easeInOutExpo' );
					});
					
				}, 100);
				
			}

		} , { offset: '95%' } );
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function() {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function(e) {
		 	e.preventDefault();

		 	var hash = this.hash,
		 			navToggler = $('.navbar-toggler');
		 	$('html, body').animate({
		    scrollTop: $(hash).offset().top
		  }, 700, 'easeInOutExpo', function(){
		    window.location.hash = hash;
		  });


		  if ( navToggler.is(':visible') ) {
		  	navToggler.click();
		  }
		});
		$('body').on('activate.bs.scrollspy', function () {
		  console.log('nice');
		})
	};
	OnePageNav();


	// magnific popup
	$('.image-popup').magnificPopup({
    type: 'image',
    closeOnContentClick: true,
    closeBtnInside: false,
    fixedContentPos: true,
    mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
     gallery: {
      enabled: true,
      navigateByImgClick: true,
      preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    },
    image: {
      verticalFit: true
    },
    zoom: {
      enabled: true,
      duration: 300 // don't foget to change the duration also in CSS
    }
  });

  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });


	$('#book_pick_date,#book_off_date').datepicker({
	  'format': 'm/d/yyyy',
	  'autoclose': true
	});
	$('#time_pick').timepicker();



})(jQuery);

 $(document).ready(function () {
	 "use strict"; // start of use strict

	 /*==============================
     Header
     ==============================*/
	 $(window).on('scroll', function () {
		 if ( $(window).scrollTop() > 0 ) {
			 $('.header').addClass('header--active');
		 } else {
			 $('.header').removeClass('header--active');
		 }
	 });
	 $(window).trigger('scroll');

	 /*==============================
     Menu
     ==============================*/
	 $('.header__btn').on('click', function() {
		 $(this).toggleClass('header__btn--active');
		 $('.header__menu').toggleClass('header__menu--active');
	 });

	 /*==============================
     Multi level dropdowns
     ==============================*/
	 $('ul.dropdown-menu [data-toggle="dropdown"]').on('click', function(event) {
		 event.preventDefault();
		 event.stopPropagation();

		 $(this).siblings().toggleClass('show');
	 });

	 $(document).on('click', function (e) {
		 $('.dropdown-menu').removeClass('show');
	 });

	 /*==============================
     Favorite
     ==============================*/
	 $('.offer__favorite').on('click', function() {
		 $(this).toggleClass('offer__favorite--active');
	 });

	 $('.car__favorite').on('click', function() {
		 $(this).toggleClass('car__favorite--active');
	 });

	 /*==============================
     Carousel
     ==============================*/
	 if ($('.main__carousel').length) {
		 var elms = document.getElementsByClassName('main__carousel');

		 for ( var i = 0; i < elms.length; i++ ) {
			 new Splide(elms[ i ], {
				 type: 'loop',
				 perPage: 1,
				 drag: true,
				 pagination: false,
				 autoWidth: true,
				 autoHeight: false,
				 speed: 800,
				 gap: 30,
				 focus: 'center',
				 arrows: false,
				 breakpoints: {
					 767: {
						 gap: 20,
						 focus: 1,
						 autoHeight: true,
						 pagination: true,
						 arrows: false,
					 },
					 1199: {
						 focus: 1,
						 autoHeight: true,
						 pagination: true,
						 arrows: false,
					 },
				 }
			 }).mount();
		 }
	 }

	 /*==============================
     Car carousel
     ==============================*/
	 if ($('.car__slider').length) {
		 var elms = document.getElementsByClassName('car__slider');

		 for ( var i = 0; i < elms.length; i++ ) {
			 new Splide(elms[ i ], {
				 type: 'loop',
				 drag: true,
				 pagination: true,
				 speed: 800,
				 gap: 10,
				 arrows: false,
				 focus: 0,
			 }).mount();
		 }
	 }

	 /*==============================
     Details
     ==============================*/
	 if ($('.details__slider').length) {
		 var details = new Splide('.details__slider', {
			 type: 'loop',
			 drag: true,
			 pagination: false,
			 speed: 800,
			 gap: 15,
			 arrows: false,
			 focus: 0,
		 });

		 var thumbnails = document.getElementsByClassName("thumbnail");
		 var current;

		 for (var i = 0; i < thumbnails.length; i++) {
			 initThumbnail(thumbnails[i], i);
		 }

		 function initThumbnail(thumbnail, index) {
			 thumbnail.addEventListener("click", function () {
				 details.go(index);
			 });
		 }

		 details.on("mounted move", function () {
			 var thumbnail = thumbnails[details.index];

			 if (thumbnail) {
				 if (current) {
					 current.classList.remove("is-active");
				 }

				 thumbnail.classList.add("is-active");
				 current = thumbnail;
			 }
		 });

		 details.mount();
	 }

	 /*==============================
     Partners
     ==============================*/
	 if ($('#partners-slider').length) {
		 var partners = new Splide('#partners-slider', {
			 type: 'loop',
			 perPage: 6,
			 drag: true,
			 pagination: false,
			 speed: 800,
			 gap: 30,
			 focus: 1,
			 arrows: false,
			 autoplay: true,
			 interval: 4000,
			 breakpoints: {
				 575: {
					 gap: 20,
					 perPage: 2,
				 },
				 767: {
					 gap: 20,
					 perPage: 3,
				 },
				 991: {
					 perPage: 4,
				 },
				 1199: {
					 perPage: 5,
				 },
			 }
		 });
		 partners.mount();
	 }

	 /*==============================
     Modal
     ==============================*/
	 $('.open-video, .open-map').magnificPopup({
		 disableOn: 0,
		 fixedContentPos: true,
		 type: 'iframe',
		 preloader: false,
		 removalDelay: 300,
		 mainClass: 'mfp-fade',
		 callbacks: {
			 open: function() {
				 if ($(window).width() > 1200) {
					 $('.header').css('margin-left', "-" + getScrollBarWidth() + "px");
				 }
			 },
			 close: function() {
				 if ($(window).width() > 1200) {
					 $('.header').css('margin-left', 0);
				 }
			 }
		 }
	 });

	 $('.open-modal').magnificPopup({
		 fixedContentPos: true,
		 fixedBgPos: true,
		 overflowY: 'auto',
		 type: 'inline',
		 preloader: false,
		 focus: '#username',
		 modal: false,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in',
		 callbacks: {
			 open: function() {
				 if ($(window).width() > 1200) {
					 $('.header').css('margin-left', "-" + getScrollBarWidth() + "px");
				 }
			 },
			 close: function() {
				 if ($(window).width() > 1200) {
					 $('.header').css('margin-left', 0);
				 }
			 }
		 }
	 });

	 $('.modal__close').on('click', function (e) {
		 e.preventDefault();
		 $.magnificPopup.close();
	 });

	 function getScrollBarWidth () {
		 var $outer = $('<div>').css({visibility: 'hidden', width: 100, overflow: 'scroll'}).appendTo('body'),
			 widthWithScroll = $('<div>').css({width: '100%'}).appendTo($outer).outerWidth();
		 $outer.remove();
		 return 100 - widthWithScroll;
	 };

	 /*==============================
     Select
     ==============================*/
	 $('.main__select').select2({
		 minimumResultsForSearch: Infinity
	 });

	 /*==============================
     Scrollbar
     ==============================*/
	 var Scrollbar = window.Scrollbar;

	 if ($('.cart__table-scroll').length) {
		 Scrollbar.init(document.querySelector('.cart__table-scroll'), {
			 damping: 0.1,
			 renderByPixels: true,
			 alwaysShowTracks: true,
			 continuousScrolling: true
		 });
	 }

	 /*==============================
     Section bg
     ==============================*/
	 $('.main--sign').each(function(){
		 if ($(this).attr('data-bg')){
			 $(this).css({
				 'background': 'url(' + $(this).data('bg') + ')',
				 'background-position': 'center center',
				 'background-repeat': 'no-repeat',
				 'background-size': 'cover'
			 });
		 }
	 });

 });

