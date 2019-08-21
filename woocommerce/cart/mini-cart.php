<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?> cart-list-product">
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				//$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                $thumbnail = wp_get_attachment_image_src($_product->get_image_id())[0];
				$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> cart-product-item" data-price-product="<?php echo $product_price; ?>">
                    <div class="left-block">
                        <a href="<?php echo esc_url($product_permalink); ?>">
                            <span class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);" data-bg="<?php echo $thumbnail; ?>"></span>
                        </a>
                    </div>
                    <div class="right-block">
                        <div class="product-info">
                            <h6 class="title h6 product-title"><a href="<?php echo esc_url($product_permalink); ?>"><?php echo $product_name; ?></a></h6>
                            <div class="product-col-price">
                                <div class="color-wrapp blue"><i></i>Blue</div>
                            </div>
                            <div class="product-options">
                                <div class="input-label with-icon"><?php esc_html_e( 'Options', 'wildkidzz' ) ?> <b></b></div>
                                <ul>
                                    <li>Size: <span>Small bed</span></li>
                                    <li>Bed kleur bolletjes: <span>goud</span></li>
                                    <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                    <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                    <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="cost-amount">
                            <div class="custom-input-number">
                                <button type="button" class="decrement"><span></span></button>
                                <input type="number" class="input-field" step="1" value="<?php echo $cart_item['quantity']; ?>" min="1" max="999" readonly="">
                                <button type="button" class="increment"><span></span></button>
                            </div>
                        </div>
                        <div class="cost-total"><i>€</i><span><?= wc_get_price_excluding_tax($_product); ?></span></div>
                        <div class="product-options only-mobile">
                            <div class="input-label with-icon"><?php esc_html_e( 'Options', 'wildkidzz' ) ?> <b></b></div>
                            <ul>
                                <li>Size: <span>Small bed</span></li>
                                <li>Bed kleur bolletjes: <span>goud</span></li>
                                <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                            </ul>
                        </div>
                    </div>
                    <a
                            href="<?php esc_url(wc_get_cart_remove_url($cart_item_key)); ?>"
                            aria-label="<?php __('Remove this item', 'woocommerce'); ?>"
                            data-product_id="<?php esc_attr($product_id); ?>"
                            data-cart_item_key="<?php esc_attr($cart_item_key); ?>"
                            data-product_sku="<?php esc_attr($_product->get_sku()); ?>"
                            class="remove remove-product remove_from_cart_button">
                    </a>
					<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
				<?php
			}
		}
		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>

    <div class="bottom-popup-cart">
        <div class="cart-product-total">
            <div class="product-total-wrapp">
                <div class="product-total-text"><?php esc_html_e( 'Subtotal', 'wildkidzz' ) ?></div>
                <div class="order-amount"><i>€</i><span><?php echo WC()->cart->get_cart_total(); ?></span></div>
            </div>
        </div>

        <?php
        $enable_free_shipping_info = get_field('enable_free_shipping_info', 'option');
        $enable_fast_delivery_info = get_field('enable_fast_delivery_info', 'option');
        if($enable_free_shipping_info || $enable_fast_delivery_info):
            ?>
            <div class="product-delivery-info">
                <?php if($enable_free_shipping_info): ?>
                    <div class="delivery-info-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/icon/delivery-truck-silhouette.svg" alt="">
                        <span><?php esc_html_e( 'Temporary free shipping throughout the Netherlands (Belgium € 20)', 'wildkidzz' ) ?></span>
                    </div>
                <?php endif; ?>
                <?php if($enable_fast_delivery_info): ?>
                    <div class="delivery-info-item">
                        <img src="<?php echo get_template_directory_uri(); ?>/icon/clock.svg" alt="">
                        <span><?php esc_html_e( 'Fast delivery', 'wildkidzz' ) ?></span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <a href="<?php echo wc_get_checkout_url(); ?>" class="button size-2 style-2 full-width"><span><?php esc_html_e( 'Go to Checkout', 'wildkidzz' ) ?></span></a>
    </div>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>