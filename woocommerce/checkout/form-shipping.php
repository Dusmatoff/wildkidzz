<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<div class="order-shipping-information">
    <div class="woocommerce-shipping-fields visible-shipping-fields">
        <?php if (true === WC()->cart->needs_shipping_address()) : ?>
            <div class="checkbox-item" id="ship-to-different-address">
                <label class="checkbox-entry size-2 checkbox"><input id="ship-to-different-address-checkbox" type="checkbox" name="ship_to_different_address" value="1"  <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?>><span><?php esc_html_e( 'Ship to a different address?', 'wildkidzz' ) ?></span></label>
            </div>

            <div class="all-shipping-fields">

                <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

                <div class="woocommerce-shipping-fields__field-wrapper">
                    <?php
                    $fields = $checkout->get_checkout_fields('shipping');

                    foreach ($fields as $key => $field) {
                        woocommerce_form_field($key, $field, $checkout->get_value($key));
                    }
                    ?>
                </div>

                <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

            </div>

        <?php endif; ?>
    </div>
</div>