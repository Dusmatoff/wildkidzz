<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

?>
<!-- CHECKOUT -->
<div class="section margin-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="simple-item">
                    <div class="title-decor not-decor margin-2">
                        <div class="title-wrapp">
                            <h4 class="title h4"><?php the_title(); ?></h4>
                        </div>
                    </div>
                    <div class="separator color-2"></div>
                </div>
            </div>
        </div>
        <form name="checkout" method="post" class="checkout woocommerce-checkout"
              action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="order-wrapp-left-column">
                        <?php if ($checkout->get_checkout_fields()) : ?>

                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                            <?php do_action('woocommerce_checkout_billing'); ?>

                            <?php do_action('woocommerce_checkout_shipping'); ?>

                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1">
                    <div class="order-wrapp-right-column">
                        <div class="order-top-caption">
                            <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                            <div class="h6 title">Your Order</div>
                            <div class="change-order open-popup" data-rel="2">Edit</div>
                        </div>
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>

                        <div id="order_review" class="order-list-product-wrapp">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>


                        <?php do_action('woocommerce_checkout_after_order_review'); ?>


                    </div>
                </div>
            </div>
        </form>
        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
        <div class="section-space size-2"></div>
    </div>
</div>
