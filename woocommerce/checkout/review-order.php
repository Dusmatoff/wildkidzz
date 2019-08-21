<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

defined('ABSPATH') || exit;
?>
<div class="order-list-product">
    <?php
    do_action('woocommerce_review_order_before_cart_contents');

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
            ?>
            <div class="order-product-item">
                <div class="left-block">
                    <span class="bg bg-lazy-load"
                          style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                          data-bg="<?php echo get_template_directory_uri(); ?>/img/cart-product-1.jpg"></span>
                </div>
                <div class="right-block">
                    <div class="product-info">
                        <h6 class="title h6 product-title"><?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h6>
                        <div class="product-col-price">
                            <!--<div class="color-wrapp blue"><i></i>Blue</div>-->
                            <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <div class="current-price"><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo apply_filters('woocommerce_checkout_cart_item_quantity', ' <b>' . sprintf('&times; %s', $cart_item['quantity']) . '</b>', $cart_item, $cart_item_key); ?></div>
                        </div>
                    </div>
                    <div class="cost-total"><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
                    <div class="product-info-options">
                        <div class="product-options">
                            <div class="input-label with-icon">Options <b></b></div>
                            <ul>
                                <li><?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
                                <!--<li>Size: <span>Small bed</span></li>
                                <li>Bed kleur bolletjes: <span>goud</span></li>
                                <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    do_action('woocommerce_review_order_after_cart_contents');
    ?>
</div>

<div class="add-promo-code js-visible-input">
    <div class="input-label with-icon">Promo code <b></b></div>
    <div class="input-field-wrapp" style="display: none;">
        <input class="input-field" type="text" placeholder="Enter promo code" name="promo-code">
    </div>
</div>

<div class="add-comment js-visible-input">
    <div class="input-label with-icon">Order Notes <i>(Optional)</i> <b></b></div>
    <div class="input-field-wrapp" style="display: none;">
        <textarea class="input-field" placeholder="Notes about your order, special noter for delivery…"
                  name="message"></textarea>
    </div>
</div>

<div class="bottom-order-info">
    <div class="table-wrapp">
        <table>
            <tr>
                <td>
                    <div class="order-info-item-caption"><?php esc_html_e('Subtotal', 'wildkidzz') ?></div>
                </td>
                <td>
                    <div class="cost-total"><?php wc_cart_totals_subtotal_html(); ?></div>
                </td>
            </tr>

            <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
                    <th><?php wc_cart_totals_coupon_label($coupon); ?></th>
                    <td><?php wc_cart_totals_coupon_html($coupon); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

                <?php do_action('woocommerce_review_order_before_shipping'); ?>

                <?php wc_cart_totals_shipping_html(); ?>

                <?php do_action('woocommerce_review_order_after_shipping'); ?>

            <?php endif; ?>

            <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                <tr class="fee">
                    <th><?php echo esc_html($fee->name); ?></th>
                    <td><?php wc_cart_totals_fee_html($fee); ?></td>
                </tr>
            <?php endforeach; ?>

            <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                <?php if ('itemized' === get_option('woocommerce_tax_total_display')) : ?>
                    <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited ?>
                        <tr class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?>">
                            <th><?php echo esc_html($tax->label); ?></th>
                            <td><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr class="tax-total">
                        <th><?php echo esc_html(WC()->countries->tax_or_vat()); ?></th>
                        <td><?php wc_cart_totals_taxes_total_html(); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endif; ?>
        </table>

        <?php do_action('woocommerce_review_order_before_order_total'); ?>

        <div class="bottom-order-info total">
            <div class="table-wrapp">
                <table>
                    <tbody>
                    <tr>
                        <td>
                            <div class="order-info-item-caption"><?php esc_html_e('Total', 'wildkidzz') ?></div>
                        </td>
                        <td>
                            <div class="cost-total"><?php wc_cart_totals_order_total_html(); ?></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php do_action('woocommerce_review_order_after_order_total'); ?>
    </div>
</div>
