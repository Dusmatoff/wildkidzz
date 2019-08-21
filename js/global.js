var _functions = {};
jQuery(function($) {
	"use strict";

	/*================*/
	/* 01 - variables */
	/*=================*/
	var swipers = [], winW, winH, headerH, winScr, second, $container, footerTop, _isresponsive, 
		_ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i),
		is_Mac = navigator.platform.toUpperCase().indexOf('MAC') >= 0,
		is_IE = /MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent) || /MSIE 10/i.test(navigator.userAgent) || /Edge\/\d+/.test(navigator.userAgent),
		is_Chrome = navigator.userAgent.indexOf('Chrome') >= 0 && navigator.userAgent.indexOf('Edge') < 0;

  if ($(document).width() > 991){
  	$('.main-content').css({'margin-bottom':$('footer').outerHeight()});
  }
	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	_functions.pageCalculations = function(){
		winW = $(window).width();
		winH = $(window).height();
	};

	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	if(_ismobile){
		$('body').addClass('mobile');
		_functions.pageCalculations();
	}
	if(is_Mac){$('html').addClass('mac');}
  if(is_IE){$('html').addClass('ie');}
  if(is_Chrome){$('html').addClass('chrome');}

	pageScrolled();

	setTimeout( function(){
		$('#loader-wrapper').fadeOut();
		$('body').addClass('site-ready');
		calculateHeightPage();
		calculateAllProductPrice();
		if($('.select-box').length){
			$('.SelectBox').SumoSelect();
		}
		//parallax
		if(!is_IE && $('.rellax').length && $(window).width() > 991){
			var rellax = new Rellax('.rellax', {
				center: true
			});
		}
	},300);

	/*==============================*/
	/* 04 - function on page resize */
	/*==============================*/
	_functions.resizeCall = function(){
		_functions.pageCalculations();
		calculateHeightPage();
		//refresh parallax
		if (!is_IE && rellax !== undefined){
			setTimeout(function() {
				rellax.refresh();
			},200);
		}
	};
	if(!_ismobile){
		$(window).resize(function(){
			_functions.resizeCall();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			setTimeout(function() {
				_functions.resizeCall();
			});
		}, false);
	}

	/*==============================*/
	/* 05 - function on page scroll */
	/*==============================*/  
	$(window).scroll(function(){    
		_functions.scrollCall();
		customAnimation();
	});
	
	_functions.scrollCall = function(){
		winScr = $(window).scrollTop();
		pageScrolled();
	}

	function pageScrolled() {
		if ($(window).scrollTop() > 120){
			$("header").addClass("scroll");
		}else{
			$("header").removeClass("scroll");
		}
	};

	/*==============================*/
	/* 06 - swiper */
	/*==============================*/
  var swiperIni = 0;

  _functions.getSwOptions = function(swiper, i){
      var options = swiper.data('options');
      options = (!options || typeof options !=='object')?{}:options;
      if(!options.pagination) options.pagination = {};
      options.pagination.el = '.sw-p-'+i;
      options.pagination.clickable = true;
      if(!options.navigation) options.navigation = {};
      options.navigation.nextEl = '.sw-bn-'+i;
      options.navigation.prevEl = '.sw-bp-'+i;
      options.preloadImages = false;
      options.lazy = {loadPrevNext: true};
      if(!options.watchSlidesVisibility) options.watchSlidesVisibility = true;
      options.observer = true;
      options.observeParents = true;
      options.init = false;
      options.watchOverflow = true;
      options.centerInsufficientSlides = true;
      options.speed = 500;
      /*options.roundLengths = true;*/
      if(_ismobile) options.direction = "horizontal";

      return options;
  };

  _functions.initSwiper = function(){
      $('.swiper-container').not('.init').each(function(){    
          var $t = $(this),
              $p = $t.closest('.swiper-entry');

          var i = swiperIni;
          $t.addClass('sw-'+i+' init');
          $p.find('.swiper-pagination').addClass('sw-p-'+i);
          $p.find('.swiper-button-prev').addClass('sw-bp-'+i);
          $p.find('.swiper-button-next').addClass('sw-bn-'+i);

          var swiper = new Swiper('.sw-'+i, _functions.getSwOptions($t, i));

          swiper.on('transitionEnd', function(){ });
          
          swiper.on('init', function(){ });

          swiper.init();

          swiperIni++;
      });

      //control swiper with thumbs gallery
			/*$('.swiper-control-wrapper').each(function(){
      	var $sw = $(this).find('.swiper-container');
        if ($sw[1]) $sw[0].swiper.controller.control = $sw[1].swiper;
      	if ($sw[0]) $sw[1].swiper.controller.control = $sw[0].swiper;
      });*/

      //control swiper with thumbs gallery
      $('.swiper-thumbs-wrapper').each(function(){
				var top = $(this).find('.swiper-container.swiper-thumbs-top')[0],
						bottom = $(this).find('.swiper-container.swiper-thumbs-bottom')[0];
      	top.swiper.thumbs.swiper = bottom.swiper;
      	top.swiper.thumbs.init();
      });
  };
  _functions.initSwiper();

	/*==============================*/
	/* 07 - menu */
	/*==============================*/
	$('.mobile-button').on('click', function(){
		$(this).toggleClass('active');
		$('html').toggleClass('overflow-menu');
		$(this).parents('header').find('.toggle-block').toggleClass('open');
		$('.search-block').removeClass('active');
		$('.header-inner').removeClass('visible-cart-inner');
	});

	//visible next menu
	$('nav .next-menu').on('click', function(){
		$(this).parent().find('> ul').addClass('menu-open');
	});

	//back menu
	$('nav .back-menu').on('click', function(){
		$(this).parent('ul').removeClass('menu-open');
	});

	//banner scroll
  $('.banner-scroll').on('click', function(){
		$('body, html').animate({'scrollTop':$('.to-scroll').offset().top}, 1000);
		return false;
	});

	//open-search-form
  $('.open-search-form').on('click', function(){
		$(this).parents('.search-block').addClass('active');
		$('.mobile-button').removeClass('active');
		$('html').removeClass('overflow-menu');
		$('.toggle-block').removeClass('open');
	});

	//closed-search-form
  $('.search-block .close-search').on('click', function(){
		$(this).parents('.search-block').removeClass('active');
	});

  //visible cart block
	$('.layer-close').on('click', function(){
		$('html').removeClass('overflow-menu');
		$('header').removeClass('active-layer-close');
		$('.header-inner').removeClass('visible-cart-inner');
	});

	$('.top-mobile-menu .header-cart-block').on('click', function(){
		$(this).parents('.header-inner').toggleClass('visible-cart-inner');
		$('header').addClass('active-layer-close');
		$('html').removeClass('overflow-menu');
		$('.toggle-block').removeClass('open');
		$('header .mobile-button').removeClass('active');
	});

	//load more items
	$('.show-more-products').on('click', function(){
		$(this).parents('.section').find('.grid-item').removeClass('load-more-item');
		$(this).addClass('remove-button');
		izotopInit();
	});

	/*==============================*/
	/* 08 - pop-up */
	/*==============================*/
	$(document).on('click', '.open-popup', function(){
		$('.popup-content').removeClass('active');
		$('.popup-wrapper, .popup-content[data-rel="'+$(this).data('rel')+'"]').addClass('active');
		$('html').addClass('overflow-hidden');
		return false;
	});

	//close popup
	$(document).on('click', '.popup-wrapper .button-close, .popup-wrapper .layer-close, .popup-wrapper .popup-close', function(){
		$('.popup-wrapper, .popup-content').removeClass('active');
		$('html').removeClass('overflow-hidden');
		return false;
	});

	//close popup with ESCAPE key
	$(document).keyup(function(e){
		if (e.keyCode === 27 ) {
			$('.popup-wrapper, .popup-content').removeClass('active');
			$('html').removeClass('overflow-hidden');
		}
	});

	/*video pop-up*/
	$(document).on('click', '.video-open', function(e){
		e.preventDefault();
		var video = $(this).attr('href');
		$('.video-popup-container iframe').attr('src',video);
		$('.video-popup').addClass('active');
		$('html').addClass('overflow-hidden');
	});
	$('.video-popup-close, .video-popup-layer').on('click', function(e){
		$('html').removeClass('overflow-hidden');
		$('.video-popup').removeClass('active');
		$('.video-popup-container iframe').attr('src','about:blank');
		e.preventDefault();
	});

	/*==============================*/
	/* 09 - other clicks, hover, changes */
	/*==============================*/
	//visible main header category
	$('.main-header-category').on('click', function(){
		$(this).parents('.nav-wrapp').toggleClass('open-main-category');
	});
	$('.nav-wrapp li a').on('click', function(){
		$(this).parents('.nav-wrapp').removeClass('open-main-category');
	});

	$('.layer-close, .button-close').on('click', function(){
		$('html').removeClass('overflow-menu');
		$('header').removeClass('active-layer-close');
	});

	//increment
	$('.custom-input-number .increment').on('click',function(){
		var $input = $(this).siblings('.input-field'),
		val = parseInt($input.val()),
		max = parseInt($input.attr('max')),
		step = parseInt($input.attr('step'));
		var temp = val + step;
		$input.val(temp <= max ? temp : max);
	});

	//decrement
	$('.custom-input-number .decrement').on('click',function(){
		var $input = $(this).siblings('.input-field'),
		val = parseInt($input.val()),
		min = parseInt($input.attr('min')),
		step = parseInt($input.attr('step'));
		var temp = val - step;
		$input.val(temp >= min ? temp : min);
	});

	//telephone mask
	$('input.input-field[type="tel"]').on('focus', function(){
    $(this).inputmask({"mask": "+31-99-999-9999"});
	});

	/*button-scroll*/
	$('.button-scroll').on('click', function(){
		$('body, html').animate({'scrollTop':$(this).closest('.detail-banner').next().offset().top - 110}, 800);
		return false;
	});

	//visible more text
	$('.more-text .read-more').on('click', function(){
		$(this).parents('.more-text').toggleClass('open-more-text');
		$(this).parent().find('.simple-text').slideToggle(300);
	});

	//mobile select izotope filter
	if($('.select-izotop-category').length){
		$(this).html($(this).parents('.filter-list').find('ul li.active').text());
		$('.select-izotop-category').on('click', function(){
			$(this).parents('.filter-list').toggleClass('open-select');
		});
		$('.filter-list ul li').on('click', function(){
			var this_value = $(this).find(' > span').text();
			$(this).parents('.filter-list').removeClass('open-select');
			$(this).parents('.filter-list').find('.select-izotop-category').html(this_value);
		});
	}

  /*==============================*/
	/* 10 - tabs */
	/*==============================*/
	var tabFinish = 0;
	$('.nav-tab-item').on('click', function(){
    var $t = $(this);
    if(tabFinish || $t.hasClass('active')) return false;
    tabFinish = 1;
    $t.closest('.nav-tab').find('.nav-tab-item').removeClass('active');
    $t.addClass('active');
    var index = $t.parent().parent().find('.nav-tab-item').index(this);
    $t.parents('.tab-nav-wrapper').find('.tab-select select option:eq('+index+')').prop('selected', true);
    $t.closest('.tab-wrapper').find('.tabs-content').first().children('.tab-info:visible').fadeOut(300, function(){
    	var $tabActive  = $t.closest('.tab-wrapper').find('.tabs-content').first().children('.tab-info').eq(index);
    	$tabActive.css('display','block').css('opacity','0');
    	tabReinit($tabActive.parents('.tab-wrapper'));
    	$tabActive.animate({opacity:1});
    	tabFinish = 0;
    });
	});
	
	$('.tab-select select').on('change', function(){
    var $t = $(this);
    if(tabFinish) return false;
    tabFinish = 1;    
    var index = $t.find('option').index($(this).find('option:selected'));
    $t.closest('.tab-nav-wrapper').find('.nav-tab-item').removeClass('active');
    $t.closest('.tab-nav-wrapper').find('.nav-tab-item:eq('+index+')').addClass('active');
    $t.closest('.tab-wrapper').find('.tabs-content').first().children('.tab-info:visible').fadeOut(300, function(){
    	var $tabActive  = $t.closest('.tab-wrapper').find('.tabs-content').first().children('.tab-info').eq(index);
    	$tabActive.css('display','block').css('opacity','0');
    	tabReinit($tabActive.parents('.tab-wrapper'));
    	$tabActive.animate({opacity:1});
    	 tabFinish = 0;
    });
	});

	$('.tab-select').on('click', function(e){
		$(this).parent('.tab-nav-wrapper').find('.select-arrow').toggleClass('icon-change');
		e.preventDefault();
	});

	function tabReinit($tab){
		$tab.find('.swiper-container').each(function(){
			var thisSwiper = swipers['swiper-'+$(this).attr('id')];
			thisSwiper.update();
		});			
	}

	/*==============================*/
	/* 11 - smooth scroll */
	/*==============================*/
	$(function() {
		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				var header_height = $('header').height();
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length){
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 999);
					$('.mobile-button').removeClass('active');
					$('.toggle-block').removeClass('open-menu');
					$('html').removeClass('overflow-menu');
					return false;
				}
			}
		});
	});
	
	/*==============================*/
	/* 12 - upload file */
	/*==============================*/
	function removeFile(thisFile, data) {
    thisFile.closest('.upload-wrapper').find('.upload-file .file-name').text(data);
  }
  function uploadFile(){
    $('body').on('change', '.up-file', function(){
      var format = $(this).val();
      var fileName = format.substring(format.lastIndexOf("\\")+1);
      if (format === '') {
        $(this).closest('.upload-wrapper').find('.remove-file').click();
      }else {
        removeFile($(this), fileName);
        $(this).closest('.upload-wrapper').addClass('upload-file');
      }
    });
  }
  $('.remove-file').on('click', function(event) {
    var dataName = $(this).closest('.upload-wrapper').find('.upload-file').data('name');
    removeFile($(this), dataName);
    $(this).closest('.upload-wrapper').removeClass('upload-file');
  });
  uploadFile();

	/*==============================*/
	/* 13 - calculate inner height page */
	/*==============================*/
	function calculateHeightPage(){
    if(!$('.height-inner-page').length) return false;
    var header_height = $('header').outerHeight();
		var footer_height = $('footer').outerHeight();
		var real_height_inner_page = $('.height-inner-page').outerHeight();
		var calculate_inner_page = $(window).height() - header_height - footer_height;
		if(calculate_inner_page > real_height_inner_page){
			$('.height-inner-page').css('height', calculate_inner_page +'px');
		}
	};

	/*==============================*/
	/* 14 - custom animations */
	/*==============================*/
	function customAnimation() {
		if ($('.item-animation').length && (!_ismobile || $(window).width() >= 1200)) {
		$('.item-animation').not('.animation').each(function () {
			if ($(window).scrollTop() >= $(this).offset().top - ($(window).height() * 0.9)) {
				$(this).addClass('animation');
			}
		});
		}
	}
	customAnimation();

	/*==============================*/
	/* 15 - copy img src from data-src to src */
	/*==============================*/
	function copySrcImage(){
		$('.img-lazy-load img').each(function(){
			var data_src = $(this).attr('data-src');
			$(this).attr('src',data_src);
		});
	}
	function copyBgImage(){
		if($('.bg-lazy-load').length){
			$('.bg-lazy-load').each(function(){
				var data_bg = $(this).data('bg');
	      $(this).css({'background-image':'url('+ data_bg +')'});
			});
		}
	}

	function copyBgImageMobile(){
		if($('.mobile-load').length && $(document).width() < 1200){
			$('.mobile-load').each(function(){
				var data_bg = $(this).data('bg');
	      $(this).css({'background-image':'url('+ data_bg +')'});
			});
		}
	}
	setTimeout(function(){
		copySrcImage();
		copyBgImage();
		copyBgImageMobile();
	},100);

	/*============================*/
	/* 16 - open video on the same block */
	/*============================*/				
	$('.video-open-inner .play-button').on('click', function(){
		var video_source = $(this).attr('data-video'),
				this_append = $(this).parents('.video-open-inner').find('.video-iframe');
				var top_menu_height = 90;
	 			setTimeout( function() {
			 		$('html, body').animate({
				  	scrollTop: $('.video-open-inner').offset().top - top_menu_height
					},500);
				},300);
				$(this).parents('.video-open-inner').find('.video-item').addClass('active');
				$('.video-open-inner').addClass('played-video');
				$('<iframe>').attr('src', video_source).appendTo(this_append);
				return false
	});
			  
	$('.close-video').on('click', function(){
		var video_close = $(this).parent().find('.video-iframe');
				$(this).parents('.video-open-inner').find('.video-item').removeClass('active');
				$('.video-open-inner').removeClass('played-video');
				video_close.find('iframe').remove();
				return false
	}); 

  /*==============================*/
	/* 17 - accordion */
	/*==============================*/
	$('.accordion-title').on('click', function(){
		var header_height = $('header .top-header').height(),
				current = $(this);
		if($(this).hasClass('active')){
			$(this).removeClass('active').next().slideUp(function(){
				pageScroll(current,header_height);
			});
		}
		else{
			$(this).closest('.accordion').find('.accordion-title').not(this).removeClass('active').next().slideUp();
			$(this).addClass('active').next().slideDown(function(){
				pageScroll(current,header_height);
			});
		}
	});

	function pageScroll(current,header_height){
		$('html, body').animate({scrollTop: current.offset().top - header_height}, 700);
	}
	
  /*============================*/
	/* 18 - isotope */
	/*============================*/             
  function izotopInit(){
	  if ($('.izotope-container').length){
	    var $container = $('.izotope-container');
			$container.isotope({
			itemSelector: '.grid-item',
			layoutMode: 'masonry',
			masonry: {
			  columnWidth: '.grid-sizer'
			}
		  });
      $('.filter-list ul li').on('click', function() {
        $('.izotope-container').each(function(){
          $(this).find('.grid-item').removeClass('animated');
        });
        $('.filter-list ul li').removeClass('active');
        $(this).addClass('active');
        var filterValue = $(this).attr('data-filter');
        $container.isotope({filter: filterValue});
      }); 
	  }
	}
	setTimeout(function(){
		izotopInit();
	},100);
  
	/*==============================*/
	/* 20 - calculate price product in cart */
	/*==============================*/
	$('.cart-product-item .cost-amount .custom-input-number button').on('click',function(){
		var amount_product = $(this).closest('.custom-input-number').find('input').val(),
				price_product = +$(this).parents('.cart-product-item').data('price-product'),
				summ_product =  amount_product * price_product;
		$(this).parents('.cart-product-item').find('.cost-total span').html(summ_product);
		calculateAllProductPrice();
		calculateCheckoutPrice();
	});

	function calculateAllProductPrice(){
		var all_summ_product = 0;
		$('.cart-list-product .cart-product-item').each(function(){
			all_summ_product += +$(this).find('.cost-total span').html();
		});
		$('.cart-list-product-wrapp').find('.order-amount span').html(all_summ_product);
	}
	calculateAllProductPrice();

	function calculateCheckoutPrice(){
		var checkout_all_summ = 0;
		$('.pay-main-wrapper .cart-product-item').each(function(){
			checkout_all_summ += +$(this).find('.cost-total span').html();
		});
		$('.pay-main-wrapper .checkout-wrapper').find('.all-product-price span').html(checkout_all_summ);
	}

	//remove product with cart
	$('.cart-product-item .remove-product').on('click',function(){
		var all_sum = 0;
		$(this).parents('.cart-product-item').remove();
		if($('.pay-main-wrapper').find('.cart-list-product .cart-product-item').length == 0)
			$('.pay-main-wrapper').addClass('empty-basket');
			calculateAllProductPrice();
			calculateCheckoutPrice();
	});

	//choose-country-wrapp
	$('.choose-country-wrapp .choose-country').on('click',function(){
		if($(this).hasClass('active')){
			return false;
		}
		else{
			$(this).closest('.choose-country-wrapp').find('.choose-country').removeClass('active');
			$(this).addClass('active');
		}
	});

	//visible shipping fields
	$('.visible-shipping-fields .checkbox-item input').on('change', function(){
		var $input = $(this);
		if($input.is( ":checked")){
			$('.all-shipping-fields').slideDown(300);
			$input.prop("checked", true);
		}
		else{
			$('.all-shipping-fields').slideUp(300);
			$input.prop("checked", false);
		}
	});

	//visible-input
	$('.js-visible-input .input-label').on('click',function(){
		$(this).next().slideToggle();
		$(this).toggleClass('rotate');
	});

  //custom-select
	$('.custom-select .current-select').on('click', function(){
		$(this).parents('.custom-select').toggleClass('open-select');
	});
	$('.custom-select ul li').on('click', function(){
		var this_value = $(this).html();
		$(this).closest('ul').find('> .active').removeClass('active');
		$(this).addClass('active');
		$(this).parents('.custom-select').removeClass('open-select');
		$(this).parents('.custom-select').find('.current-select').html(this_value);
	});

	//visible product options
	$('.product-options .input-label').on('click',function(){
		$(this).next().slideToggle();
		$(this).toggleClass('rotate');
	});

	//choose product color
	$('.product-detail-color .color-wrapp span').on('click', function(){
		$(this).closest('.color-wrapp').find('> span').removeClass('active');
		$(this).addClass('active');
	});

	//choose-block-wrapp
	$('.choose-block-wrapp > span').on('click', function(){
		$(this).closest('.choose-block-wrapp').find('> span').removeClass('active');
		$(this).addClass('active');
	});

	//visible and hide cart informer
	$('.product-detail-wrapp .add-cart').on('click', function(){
		$('.add-cart-informer').slideDown(400);
	});
	$('.add-cart-informer .button-close').on('click', function(){
		$('.add-cart-informer').slideUp(400);
	});

	//print order
	$('.print-order').on('click', function(){
		window.print();
	});

});
