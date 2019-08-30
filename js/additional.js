//Ajax add to cart
(function($) {
    $(document).on('click', '.remove-product', function(e) {
        e.preventDefault();
        console.log('shot');
        var $thisbutton = $(this),
            id = $thisbutton.data('product_id'),
            cart_item_key = $thisbutton.data('cart_item_key');
        // product_sku = $thisbutton.data('product_sku');

        var data = {
            cart_item_key : $thisbutton.data( 'cart_item_key' )
        };

        $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'remove_from_cart' ),
            data: data,
            success: function(response) {
                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    $('.header-cart-inner').html(response.fragments['a.cart-contents']);
                    $( document.body ).trigger( 'removed_from_cart', [ response.fragments, response.cart_hash, $thisbutton ] );
                    $( document.body ).trigger( 'wc_update_cart');
                }
            },
        });
        return false;
    });
})(jQuery);

$(".grid-item:nth-child(n + 8)").each(function() {
    $(this).addClass("load-more-item");
});

//load more items
$('.show-more-products').on('click', function(){
	$('.grid-item').removeClass('load-more-item');
	$(this).addClass('remove-button');
});


//Show modals for success form
//Contact form
document.addEventListener('wpcf7mailsent', function(event) {
    if ('168' == event.detail.contactFormId || '166' == event.detail.contactFormId) {
        $('.popup-content').removeClass('active');
        $('.popup-wrapper, .popup-content[data-rel="1"]').addClass('active');
        $('html').addClass('overflow-hidden');
    }
}, false);
//Contact form validation
document.addEventListener('wpcf7submit', function(event) {
    if ('168' == event.detail.contactFormId) {
        if ($("#clientName").val().length === 0) {
            $(".name-wrap").addClass('fail');
        }
        if ($(".wpcf7-tel").hasClass('wpcf7-not-valid')) {
            $(".phone-wrap").addClass('fail');
        }
    }
}, false);
//Callout form validation
document.addEventListener('wpcf7submit', function(event) {
    if ('166' == event.detail.contactFormId) {
        if ($(".wpcf7-tel").hasClass('wpcf7-not-valid')) {
            $(".callout-phone-wrap").addClass('fail');
        }
    }
}, false);

//pagination classes
$('.prev').parent('li').addClass('pagination-arrow arrow-left');
$('.next').parent('li').addClass('pagination-arrow arrow-right');
$('.page-numbers .current').parent('li').addClass('active');

//Stop scroll to top, if checkout has error
jQuery( document.body ).on( 'checkout_error', function() {
    jQuery( 'html, body' ).stop();
} );


//Show alert if variation select needed
$('.single_add_to_cart_button').on('click', function (event) {
    if ($(this).is('.disabled')) {
        event.preventDefault();
        if ($(this).is('.wc-variation-is-unavailable')) {
            $('.popup-content').removeClass('active');
            $('.popup-wrapper, .popup-content[data-rel="4"]').addClass('active');
            $('html').addClass('overflow-hidden');
        } else if ($(this).is('.wc-variation-selection-needed')) {
            $('.popup-content').removeClass('active');
            $('.popup-wrapper, .popup-content[data-rel="3"]').addClass('active');
            $('html').addClass('overflow-hidden');
        }
        return false;
    }
    
});


//Coupon 
	var wc_checkout_coupons = {
		init: function() {

			$( document.body ).on( 'click', 'a.showcoupon', this.show_coupon_form );
			$( document.body ).on( 'click', '.woocommerce-remove-coupon', this.remove_coupon );
			// $( 'form.checkout_coupon' ).hide().submit(  );

            $(document).on('click', '.js-submit-coupon', function (e) {
                e.preventDefault();
                this.submit(e);
             }.bind(this));

		},
		show_coupon_form: function() {
			$( '.checkout_coupon' ).slideToggle( 400, function() {
				$( '.checkout_coupon' ).find( ':input:eq(0)' ).focus();
			});
			return false;
		},
		submit: function(e) {
            console.log('wc_checkout_coupons submit ');

			var $form = $('#woocommerce-form-coupon-form');

			console.log($form);
			if ( $form.is( '.processing' ) ) {
				return false;
			}

			$form.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

			var data = {
				security:		wc_checkout_params.apply_coupon_nonce,
				coupon_code:	$form.find( 'input[name="coupon_code"]' ).val()
			};

			$.ajax({
				type:		'POST',
				url:		wc_checkout_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'apply_coupon' ),
				data:		data,
				success:	function( code ) {
					$( '.woocommerce-error, .woocommerce-message' ).remove();
					$form.removeClass( 'processing' ).unblock();


					if ( code ) {
						$form.before( code );


                        var $code = $('<div class="js-errors-coupon">'+code+'</div>');

                        if($code.find('.woocommerce-error').length){
							console.log("Error");
							$('.popup-content').removeClass('active');
                            $('.popup-wrapper, .popup-content[data-rel="5"]').addClass('active');
                            $('html').addClass('overflow-hidden');
                        } else {
                            $form.slideUp();

                        }


						$( document.body ).trigger( 'update_checkout', { update_shipping_method: false } );
					}
				},
				dataType: 'html'
			});

			return false;
		},
		remove_coupon: function( e ) {
			e.preventDefault();

			var container = $( this ).parents( '.woocommerce-checkout-review-order' ),
				coupon    = $( this ).data( 'coupon' );

			container.addClass( 'processing' ).block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			});

			var data = {
				security: wc_checkout_params.remove_coupon_nonce,
				coupon:   coupon
			};

			$.ajax({
				type:    'POST',
				url:     wc_checkout_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'remove_coupon' ),
				data:    data,
				success: function( code ) {
					$( '.woocommerce-error, .woocommerce-message' ).remove();
					container.removeClass( 'processing' ).unblock();

					if ( code ) {
						$( 'form.woocommerce-checkout' ).before( code );

						$( document.body ).trigger( 'update_checkout', { update_shipping_method: false } );

						// Remove coupon code from coupon field
						$( 'form.checkout_coupon' ).find( 'input[name="coupon_code"]' ).val( '' );
					}
				},
				error: function ( jqXHR ) {
					if ( wc_checkout_params.debug_mode ) {
						/* jshint devel: true */
						console.log( jqXHR.responseText );
					}
				},
				dataType: 'html'
			});
		}
	};
wc_checkout_coupons.init();




/*==============================*/
/* 15 - copy img src from data-src to src */
/*==============================*/
var  copySrcImage = function(){
    $('.img-lazy-load img').each(function(){
        var data_src = $(this).attr('data-src');
        $(this).attr('src',data_src);
    });
};

var copyBgImage = function(){
    if($('.bg-lazy-load').length){
        $('.bg-lazy-load').each(function(){
            var data_bg = $(this).data('bg');
            $(this).css({'background-image':'url('+ data_bg +')'});
        });
    }
};

var copyBgImageMobile= function(){
    if($('.mobile-load').length && $(document).width() < 1200){
        $('.mobile-load').each(function(){
            var data_bg = $(this).data('bg');
            $(this).css({'background-image':'url('+ data_bg +')'});
        });
    }
};

var update_mc_wc_div = function( html_str, preserve_notices ) {
    var $html       = $.parseHTML( html_str );
    var $new_form   = $( '.woocommerce-cart-form', $html );
    var $new_totals = $( '.cart_totals', $html );
    var $notices    = $( '.woocommerce-error, .woocommerce-message, .woocommerce-info', $html );

    // No form, cannot do this.
    if ( $( '.woocommerce-cart-form' ).length === 0 ) {
        window.location.reload();
        return;
    }

    // Remove errors
    if ( ! preserve_notices ) {
        $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
    }

    if ( $new_form.length === 0 ) {
        // If the checkout is also displayed on this page, trigger reload instead.
        if ( $( '.woocommerce-checkout' ).length ) {
            window.location.reload();
            return;
        }

        // No items to display now! Replace all cart content.
        var $cart_html = $( '.cart-empty', $html ).closest( '.woocommerce' );
       // $( '.woocommerce-cart-form__contents' ).closest( '.woocommerce' ).replaceWith( $cart_html );

        // Display errors
        if ( $notices.length > 0 ) {
            // show_notice( $notices );
        }

        // Notify plugins that the cart was emptied.
        $( document.body ).trigger( 'wc_cart_emptied' );
    } else {
        // If the checkout is also displayed on this page, trigger update event.
        if ( $( '.woocommerce-checkout' ).length ) {
            $( document.body ).trigger( 'update_checkout' );
        }

        //$( '.woocommerce-cart-form' ).replaceWith( $new_form );
       // $( '.woocommerce-cart-form' ).find( ':input[name="update_cart"]' ).prop( 'disabled', true );

        if ( $notices.length > 0 ) {
       //     show_notice( $notices );
        }

        update_mc_cart_totals_div( $new_totals );
    }

    $( document.body ).trigger( 'updated_wc_div' );
};

/**
 * Update the .cart_totals div with a string of html.
 *
 * @param {String} html_str The HTML string with which to replace the div.
 */
var update_mc_cart_totals_div = function( html_str ) {
    $( '.cart_totals' ).replaceWith( html_str );
    $( document.body ).trigger( 'updated_cart_totals' );
};

/**
/**
 * Check if a node is blocked for processing.
 *
 * @param {JQuery Object} $node
 * @return {bool} True if the DOM Element is UI Blocked, false if not.
 */
var is_blocked = function( $node ) {
    return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
};

/**
 * Block a node visually for processing.
 *
 * @param {JQuery Object} $node
 */
var block = function( $node ) {
    if ( ! is_blocked( $node ) ) {
        $node.addClass( 'processing' ).block( {
            message: null,
            overlayCSS: {
                background: '#fff',
                opacity: 0.6
            }
        } );
    }
};


/**
 * Unblock a node after processing is complete.
 *
 * @param {JQuery Object} $node
 */
var unblock = function( $node ) {
    $node.removeClass( 'processing' ).unblock();
};

/**
 *
 * @type {{init: minicart.init, update_cart: minicart.update_cart, update_cart_totals: minicart.update_cart_totals, input_change: minicart.input_change, cart_submit: minicart.cart_submit, submit_click: minicart.submit_click, apply_coupon: minicart.apply_coupon, remove_coupon_clicked: minicart.remove_coupon_clicked, quantity_update: minicart.quantity_update, item_remove_clicked: minicart.item_remove_clicked, item_restore_clicked: minicart.item_restore_clicked}}
 */
var minicart = {
    /**
     * Initialize cart UI events.
     */
    init: function() {
        console.log('init-form');
        this.update_cart_totals    = this.update_cart_totals.bind( this );
        this.input_change        = this.input_change.bind( this );
        this.cart_submit           = this.cart_submit.bind( this );
        this.submit_click          = this.submit_click.bind( this );
       // this.apply_coupon          = this.apply_coupon.bind( this );
        this.remove_coupon_clicked = this.remove_coupon_clicked.bind( this );
        this.quantity_update       = this.quantity_update.bind( this );
        this.item_remove_clicked   = this.item_remove_clicked.bind( this );
        this.item_restore_clicked  = this.item_restore_clicked.bind( this );
        this.update_cart           = this.update_cart.bind( this );

        $( document ).on(
            'wc_update_cart added_to_cart',
            function() { minicart.update_cart.apply( minicart, [].slice.call( arguments, 1 ) ); } );
        $( document ).on(
            'click',
            '.js-mc-edit-form :input[type=submit]',
            this.submit_click );
        $( document ).on('change', '.js-mc-quantity-input', this.input_change );
        $( document ).on(
            'submit',
            '.js-mc-edit-form',
            this.cart_submit );
        /*$( document ).on(
            'click',
            'a.woocommerce-remove-coupon',
            this.remove_coupon_clicked );*/
        $( document ).on(
            'click',
            '.js-mc-edit-form .product-remove > a',
            this.item_remove_clicked );
        $( document ).on(
            'click',
            '.woocommerce-cart .restore-item',
            this.item_restore_clicked );

      //  $( '.js-mc-edit-form :input[name="update_cart"]' ).prop( 'disabled', true );
    },

    /**
     * Update entire cart via ajax.
     */
    update_cart: function( preserve_notices ) {
        var $form = $( '.js-mc-edit-form' );

        block( $form );
        block( $( 'div.cart_totals' ) );

        // Make call to actual form post URL.
        $.ajax( {
            type:     $form.attr( 'method' ),
            url:      $form.attr( 'action' ),
            data:     $form.serialize(),
            dataType: 'html',
            success:  function( response ) {
                update_mc_wc_div( response, preserve_notices );

            },
            complete: function() {
                unblock( $form );
                unblock( $( 'div.cart_totals' ) );
                $.scroll_to_notices( $( '[role="alert"]' ) );
            }
        } );
    },

    /**
     * Update the cart after something has changed.
     */
    update_cart_totals: function() {
        block( $( 'div.cart_totals' ) );

        $.ajax( {
            url:      get_url( 'get_cart_totals' ),
            dataType: 'html',
            success:  function( response ) {
                update_mc_cart_totals_div( response );
            },
            complete: function() {
                unblock( $( 'div.cart_totals' ) );
            }
        } );
    },

    /**
     * Handle the <ENTER> key for quantity fields.
     *
     * @param {Object} evt The JQuery event
     *
     * For IE, if you hit enter on a quantity field, it makes the
     * document.activeElement the first submit button it finds.
     * For us, that is the Apply Coupon button. This is required
     * to catch the event before that happens.
     */
    input_change: function( evt ) {

        console.log('change test');

        var $form = $( evt.currentTarget ).closest( 'form' );

        try {
            // If there are no validation errors, handle the submit.
            console.log($form[0].checkValidity() );
            if ( $form[0].checkValidity() ) {
                evt.preventDefault();
                this.cart_submit( evt );
            }
        } catch( err ) {
            evt.preventDefault();
            this.cart_submit( evt );
        }
    },

    /**
     * Handle cart form submit and route to correct logic.
     *
     * @param {Object} evt The JQuery event
     */
    cart_submit: function( evt ) {
        var $submit  = $( document.activeElement ),
            $clicked = $( ':input[type=submit][clicked=true]' ),
            $form    = $( evt.currentTarget );


        // For submit events, currentTarget is form.
        // For keypress events, currentTarget is input.
        if ( ! $form.is( 'form' ) ) {
            $form = $( evt.currentTarget ).closest( 'form' );
        }

        if ( 0 === $form.find( '.js-mc-cart-list-product' ).length ) {
            return;
        }

        if ( is_blocked( $form ) ) {
            return false;
        }

        evt.preventDefault();
        this.quantity_update( $form );
    },

    /**
     * Special handling to identify which submit button was clicked.
     *
     * @param {Object} evt The JQuery event
     */
    submit_click: function( evt ) {
        $( ':input[type=submit]', $( evt.target ).parents( 'form' ) ).removeAttr( 'clicked' );
        $( evt.target ).attr( 'clicked', 'true' );
    },

    /**
     * Apply Coupon code
     *
     * @param {JQuery Object} $form The cart form.
     */
    apply_coupon: function( $form ) {
        block( $form );

        var cart = this;
        var $text_field = $( '#coupon_code' );
        var coupon_code = $text_field.val();

        var data = {
            security: wc_cart_params.apply_coupon_nonce,
            coupon_code: coupon_code
        };

        $.ajax( {
            type:     'POST',
            url:      get_url( 'apply_coupon' ),
            data:     data,
            dataType: 'html',
            success: function( response ) {
                $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
                // show_notice( response );
                $( document.body ).trigger( 'applied_coupon', [ coupon_code ] );
                console.log(response);

            },
            complete: function() {
                unblock( $form );
                $text_field.val( '' );
                minicart.update_cart( true );
            }
        } );
    },

    /**
     * Handle when a remove coupon link is clicked.
     *
     * @param {Object} evt The JQuery event
     */
    remove_coupon_clicked: function( evt ) {
        evt.preventDefault();

        var cart     = this;
        var $wrapper = $( evt.currentTarget ).closest( '.cart_totals' );
        var coupon   = $( evt.currentTarget ).attr( 'data-coupon' );

        block( $wrapper );

        var data = {
            security: wc_cart_params.remove_coupon_nonce,
            coupon: coupon
        };

        $.ajax( {
            type:    'POST',
            url:      get_url( 'remove_coupon' ),
            data:     data,
            dataType: 'html',
            success: function( response ) {
                $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
                show_notice( response );
                $( document.body ).trigger( 'removed_coupon', [ coupon ] );
                unblock( $wrapper );
            },
            complete: function() {
                minicart.update_cart( true );
            }
        } );
    },

    /**
     * Handle a cart Quantity Update
     *
     * @param {JQuery Object} $form The cart form.
     */
    quantity_update: function( $form ) {
        block( $form );
        block( $( 'div.cart_totals' ) );

        // Provide the submit button value because wc-form-handler expects it.
        $( '<input />' ).attr( 'type', 'hidden' )
            .attr( 'name', 'update_cart' )
            .attr( 'value', 'Update Cart' )
            .appendTo( $form );

        console.log([  $form.attr( 'action' ) ]);


        // Make call to actual form post URL.
        $.ajax( {
            type:     $form.attr( 'method' ),
            url:      $form.attr( 'action' ),
            data:     $form.serialize(),
            dataType: 'html',
            success:  function( response ) {
                console.log('!!!!');
                update_mc_wc_div( response );
            },
            complete: function() {
                unblock( $form );
                unblock( $( 'div.cart_totals' ) );
                $.scroll_to_notices( $( '[role="alert"]' ) );
            }
        } );
    },

    /**
     * Handle when a remove item link is clicked.
     *
     * @param {Object} evt The JQuery event
     */
    item_remove_clicked: function( evt ) {
        evt.preventDefault();

        var $a = $( evt.currentTarget );
        var $form = $a.parents( 'form' );

        block( $form );
        block( $( 'div.cart_totals' ) );

        $.ajax( {
            type:     'GET',
            url:      $a.attr( 'href' ),
            dataType: 'html',
            success:  function( response ) {
                update_mc_wc_div( response );
            },
            complete: function() {
                unblock( $form );
                unblock( $( 'div.cart_totals' ) );
                $.scroll_to_notices( $( '[role="alert"]' ) );
            }
        } );
    },

    /**
     * Handle when a restore item link is clicked.
     *
     * @param {Object} evt The JQuery event
     */
    item_restore_clicked: function( evt ) {
        evt.preventDefault();

        var $a = $( evt.currentTarget );
        var $form = $( 'form.js-mc-edit-form' );

        block( $form );
        block( $( 'div.cart_totals' ) );

        $.ajax( {
            type:     'GET',
            url:      $a.attr( 'href' ),
            dataType: 'html',
            success:  function( response ) {
                update_mc_wc_div( response );
            },
            complete: function() {
                unblock( $form );
                unblock( $( 'div.cart_totals' ) );
            }
        } );
    }
};
document.body.addEventListener('update_checkout', function () {
    console.log('save update_checkout');

});

$(function () {
    function calculateAllProductPriceByForm($form){
        var all_summ_product = 0;
        $form.find('.cart-list-product .cart-product-item').each(function(){

            all_summ_product += parseInt($(this).data('price-product')) *  $(this).find('.js-cart-edit-quantity-input').val();
        });
        $form.find('.order-amount span').html('€ '+all_summ_product);
    }
    $(document).on('change', '.js-cart-edit-quantity-input', function () {
        var amount_product = $(this).val(),
            price_product = +$(this).parents('.cart-product-item').data('price-product'),
            summ_product =  amount_product * price_product;
        $(this).parents('.cart-product-item').find('.cost-total span').html('€ '+summ_product);
        calculateAllProductPriceByForm($(this).closest('.woocommerce-cart-form--popup'));
    });
    $(document).on('change', '.js-custom-change-checkout-country', function (e) {
        $($(this).data('target')).val($(this).val()).trigger('change');
    });
    $(document).on('change', '.js-custom-change-building-country', function (e) {
        var val = $(this).val();

        $('#billing_country').val(val)
    });
    $(document).on('change', '.update_single_button', function (e) {
        var $form = $(this).closest('.cart'),
        $btn = $form.find('.ajax_add_to_cart');
        $btn.data('quantity', $(this).val());
    });


    function  updateimages() {
        copySrcImage();
        copyBgImage();
        copyBgImageMobile();

        setTimeout(function(){
            copySrcImage();
            copyBgImage();
            copyBgImageMobile();
        },1000);
    }updateimages();
    $(document.body).on('update_checkout init_checkout updated_wc_div',  updateimages);


    $(document).on('click', '.js-mc-save', function () {
        $(this).closest('.js-mc-edit-form').submit();
    });

    minicart.init();
});
