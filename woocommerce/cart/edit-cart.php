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
    <form class="woocommerce-cart-form--popup" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

        <div class="woocommerce-mini-cart cart_list product_list_widget cart-list-product js-mc-cart-list-product">
            <?php
            do_action( 'woocommerce_before_mini_cart_contents' );

            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                $_attributes = wc_get_formatted_cart_item_attributes($cart_item);
                $_attribute_color = wc_get_formatted_cart_item_attributes_color($cart_item);

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    //$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    $thumbnail = wp_get_attachment_image_src($_product->get_image_id())[0];
                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                    ?>
                    <div class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> cart-product-item " data-price-product="<?php echo $_product->get_price(); ?>">
                        <div class="left-block">
                            <a href="<?php echo esc_url($product_permalink); ?>">
                                <span class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);" data-bg="<?php echo $thumbnail; ?>"></span>
                            </a>
                        </div>
                        <div class="right-block">
                            <div class="product-info">
                                <h6 class="title h6 product-title"><a href="<?php echo esc_url($product_permalink); ?>"><?php echo $product_name; ?></a></h6>
                                <div class="product-col-price">
                                    <?php if( $_attribute_color) { ?>
                                        <?php  $aMeta = get_color_params(esc_attr( $_attribute_color['value_orign'] )); ?>
                                        <div class="color-wrapp site-base-bg site-base-<?php echo $aMeta['class']?><?php ?>"><i style="<?php echo $aMeta['style'] ?>"></i> <?php echo $_attribute_color['display']?><?php ?></div>
                                    <?php } ?>
                                </div>

                                <?php if(count($_attributes) > 0) { ?>
                                    <div class="product-options">
                                        <div class="input-label with-icon"> <?php esc_html_e( 'Options', 'wildkidzz' ) ?><b></b></div>
                                        <ul>
                                            <?php foreach($_attributes as $attribute) { ?>
                                                <li><?php echo $attribute['key'] ?>:  <span><?php echo $attribute['value'] ?></span></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>

                            </div>
                            <div class="cost-amount">
                                <?php
                                if ( $_product->is_sold_individually() ) {
                                    echo sprintf( '1 ', $cart_item_key );
                                } else {
                                    ?>

                                    <div class="custom-input-number">
                                        <button type="button" class="decrement"><span></span></button>
                                        <input type="number" id="<?php echo $_product->get_name() ?>" name="<?php echo 'cart['.$cart_item_key.'][qty]' ?>" class="input-field js-cart-edit-quantity-input" step="1" value="<?php echo $cart_item['quantity']; ?>" min="1" max="<?php echo $_product->get_max_purchase_quantity(); ?>" readonly="">
                                        <button type="button" class="increment"><span></span></button>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>
                            <div class="cost-total">
                                <?php
                                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                ?>
                            </div>

                            <?php if(count($_attributes) > 0) { ?>
                                <div class="product-options only-mobile">
                                    <div class="input-label with-icon"> <?php esc_html_e( 'Options', 'wildkidzz' ) ?><b></b></div>
                                    <ul>
                                        <?php foreach($_attributes as $attribute) { ?>
                                            <li><?php echo $attribute['key'] ?>:  <span><?php echo $attribute['value'] ?></span>                           </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                        </div>
                        <?php
                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            'woocommerce_cart_item_remove_link',
                            sprintf(
                                '<a href="%s" class="remove remove-product " aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                esc_html__( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key ),
                                esc_attr( $_product->get_sku() )
                            ),
                            $cart_item_key
                        );
                        ?>
                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                    <?php
                }
            }
            do_action( 'woocommerce_mini_cart_contents' );
            ?>
        </div>

        <div class="cart-product-total">
            <div class="cart-product-total">
                <div class="product-total-wrapp">
                    <div class="product-total-text"><?php esc_html_e( 'Subtotal', 'wildkidzz' ) ?></div>
                    <div class="order-amount"><span><?php echo WC()->cart->get_cart_subtotal(); ?></span></div>
                </div>
            </div>

            <button type="submit" class="button size-2 style-2 full-width " name="update_cart" value="Update cart"><span><?php esc_html_e( 'Save Changes', 'wildkidzz' ) ?></span></button>
        </div>


        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

    </form>
<?php else : ?>

    <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>