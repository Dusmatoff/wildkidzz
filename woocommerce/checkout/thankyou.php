<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
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

defined('ABSPATH') || exit;
$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );

?>

<!-- THANK YOU -->
<div class="section margin-section">
    <div class="container">
        <?php if ($order) :

            //do_action( 'woocommerce_before_thankyou', $order->get_id() ); ?>

            <?php if ($order->has_status('failed')) : ?>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce'); ?></p>

                <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                    <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                       class="button pay"><?php esc_html_e('Pay', 'woocommerce'); ?></a>
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                           class="button pay"><?php esc_html_e('My account', 'woocommerce'); ?></a>
                    <?php endif; ?>
                </p>

            <?php else : ?>
                <div class="row hide-print">
                    <div class="col-12">
                        <div class="simple-item text-center">
                            <div class="title-decor not-decor margin-2">
                                <div class="title-wrapp">
                                    <h3 class="title h3"><?php esc_html_e('Thank you for purchase', 'wildkidzz') ?></h3>
                                </div>
                            </div>
                            <h6 class="title h6"><?php esc_html_e('Your order has been successfully completed', 'wildkidzz') ?></h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                        <div class="order-details-block">
                            <div class="simple-item text-center">
                                <h6 class="title h6"><?php esc_html_e('Order details', 'wildkidzz') ?></h6>
                            </div>
                            <div class="order-detail-info">
                                <div class="table-wrapp">
                                    <table>
                                        <tr>
                                            <td><?php esc_html_e('Order Number', 'wildkidzz') ?></td>
                                            <td><?php echo $order->get_order_number(); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="order-list-product-wrapp">
                                <div class="order-list-product">
                                    <?php
                                    foreach ( $order_items as $item_id => $item ) {
                                        $product = $item->get_product();
                                        wc_get_template(
                                            'order/order-details-item.php',
                                            array(
                                                'order'              => $order,
                                                'item_id'            => $item_id,
                                                'item'               => $item,
                                                'show_purchase_note' => $show_purchase_note,
                                                'purchase_note'      => $product ? $product->get_purchase_note() : '',
                                                'product'            => $product,
                                            )
                                        );
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="table-wrapp">
                                <table>
                                    <tr>
                                        <td><?php esc_html_e('Name', 'wildkidzz') ?></td>
                                        <td><?php echo $order->get_billing_first_name(); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Address', 'wildkidzz') ?></td>
                                        <td><?php echo $order->get_billing_address_1(); ?><?php echo $order->get_billing_address_2(); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Shipping Cost', 'wildkidzz') ?></td>
                                        <td>€ <?php echo $order->get_shipping_total(); ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Subtotal', 'wildkidzz') ?></td>
                                        <td>€ <?php echo $order->get_subtotal(); ?></td>
                                    </tr>
                                    <?php
                                    if( $order->get_used_coupons() ) {
                                        $order_subtotal = $order->get_subtotal();
                                        $order_total = $order->get_total();
                                        $coupon_value = $order_subtotal - $order_total;
                                        echo '<tr>';
                                        $coupons_count = count( $order->get_used_coupons() );
                                        $i = 1;
                                        $coupons_list = '';
                                        foreach( $order->get_used_coupons() as $coupon) {
                                            $coupons_list .=  $coupon;
                                            if( $i < $coupons_count )
                                            $coupons_list .= ', ';
                                            $i++;
                                            //$coupon_value = $coupon->get_amount();
                                        }
                                        
                                        
                                        
                                        echo '<td>' . __('Coupons:') . ' (' . $coupons_count . ')<br>' . $coupons_list . '</td>';
                                        echo '<td>-€ ' . $coupon_value . '</td>';  
                                        echo '</tr>';
                                    }
                                    ?>
                                    <tr class="total-summ">
                                        <td><?php esc_html_e('Total', 'wildkidzz') ?></td>
                                        <td><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-center">
                                <div class="print-order"><img
                                            src="<?php echo get_template_directory_uri(); ?>/icon/printer.svg"
                                            alt=""><?php esc_html_e('Print Order', 'wildkidzz') ?></div>
                            </div>
                        </div>
                        <div class="text-center back-home">
                            <a href="/"
                               class="button size-2 style-2"><span><?php esc_html_e('Home', 'wildkidzz') ?></span></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="section-space size-2"></div>
</div>
