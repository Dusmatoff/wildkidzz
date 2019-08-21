<?php
/**
 * Order Item Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-item.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
	return;
}
?>

<div class="order-product-item">
    <div class="left-block">
        <span class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/cart-product-1.jpg);" data-bg="<?php echo get_template_directory_uri(); ?>/img/cart-product-1.jpg"></span>
    </div>
    <div class="right-block">
        <div class="product-info">
            <h6 class="title h6 product-title"><?php echo $item->get_name(); ?></h6>
            <div class="product-col-price">
                <div class="color-wrapp blue"><i></i>Blue</div>
                <div class="current-price"><span class="woocommerce-Price-currencySymbol">€</span> <?php echo $order->get_item_total($item); ?><?php ?> x <b><?php echo $item->get_quantity(); ?></b></div>
            </div>
        </div>
        <div class="cost-total"><?php echo $order->get_formatted_line_subtotal( $item ); ?></div>
        <div class="product-info-options">
            <div class="product-options">
                <div class="input-label with-icon">Options <b></b></div>
                <?php
                do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, false );

                wc_display_item_meta( $item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, false );
                ?>
                <!--<ul>
                    <li>Size: <span>Small bed</span></li>
                    <li>Bed kleur bolletjes: <span>goud</span></li>
                    <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                    <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                    <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                </ul>-->
            </div>
        </div>
    </div>
</div>

