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

//do_action('woocommerce_before_checkout_form', $checkout);

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
        <div class="row">
            <div class="col-12 col-lg-5">
                <div class="order-wrapp-left-column">
                    <div class="order-contact-information">
                        <div class="h6 title"><?php esc_html_e('Contact Info', 'wildkidzz') ?></div>
                        <div class="contact-information-form">
                            <form>
                                <div class="input-field-wrapp">
                                    <div class="input-label">Your Name</div>
                                    <input class="input-field" type="text" placeholder="Name*" name="name" required="">
                                </div>
                                <div class="input-field-wrapp">
                                    <div class="input-label">Company Name <i>(Optional)</i></div>
                                    <input class="input-field" type="text" placeholder="Apple" name="company_name">
                                </div>
                                <div class="input-field-wrapp fail">
                                    <div class="input-label">Email</div>
                                    <input class="input-field" type="email" placeholder="Enter your email" name="email"
                                           required="">
                                </div>
                                <div class="row row-16">
                                    <div class="col-12 col-sm-7">
                                        <div class="input-field-wrapp">
                                            <div class="input-label">Phone Number</div>
                                            <input class="input-field" type="tel" placeholder="Phone number"
                                                   name="telephone">
                                        </div>
                                    </div>
                                </div>
                                <div class="choose-country-wrapp">
                                    <div class="input-label">Country</div>
                                    <div class="row row-16">
                                        <div class="col-6">
                                            <div class="choose-country">Netherlands</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="choose-country active">Belgium <b>+€20</b></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-16">
                                    <div class="col-12 col-sm-6">
                                        <div class="input-field-wrapp">
                                            <div class="input-label">Zip Code</div>
                                            <input class="input-field" type="text" placeholder="e.g. 1111"
                                                   name="zip_code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="input-field-wrapp">
                                            <div class="input-label">City</div>
                                            <input class="input-field" type="text" placeholder="Enter City" name="city">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-field-wrapp">
                                    <div class="input-label">Address</div>
                                    <input class="input-field" type="text" placeholder="e.g. 87 Jaden Mountain, apr.2"
                                           name="address">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="order-shipping-information">
                        <div class="visible-shipping-fields">
                            <div class="checkbox-item">
                                <label class="checkbox-entry size-2 checkbox"><input type="checkbox" name="1"><span>Ship to a different address?</span></label>
                            </div>
                            <div class="all-shipping-fields">
                                <form>
                                    <div class="input-field-wrapp">
                                        <div class="input-label">Your Name</div>
                                        <input class="input-field" type="text" placeholder="Name*" name="name"
                                               required="">
                                    </div>
                                    <div class="input-field-wrapp">
                                        <div class="input-label">Company Name <i>(Optional)</i></div>
                                        <input class="input-field" type="text" placeholder="Apple" name="company_name">
                                    </div>
                                    <div class="input-field-wrapp">
                                        <div class="input-label">Email</div>
                                        <input class="input-field" type="email" placeholder="Enter your email"
                                               name="email" required="">
                                    </div>
                                    <div class="row row-16">
                                        <div class="col-12 col-sm-7">
                                            <div class="input-field-wrapp">
                                                <div class="input-label">Phone Number</div>
                                                <input class="input-field" type="tel" placeholder="Phone number"
                                                       name="telephone">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose-country-wrapp">
                                        <div class="input-label">Country</div>
                                        <div class="row row-16">
                                            <div class="col-6">
                                                <div class="choose-country">Netherlands</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="choose-country">Belgium <b>+€20</b></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-16">
                                        <div class="col-12 col-sm-6">
                                            <div class="input-field-wrapp">
                                                <div class="input-label">Zip Code</div>
                                                <input class="input-field" type="text" placeholder="e.g. 1111"
                                                       name="zip_code">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="input-field-wrapp">
                                                <div class="input-label">City</div>
                                                <input class="input-field" type="text" placeholder="Enter City"
                                                       name="city">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-field-wrapp">
                                        <div class="input-label">Address</div>
                                        <input class="input-field" type="text"
                                               placeholder="e.g. 87 Jaden Mountain, apr.2" name="address">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-7 offset-lg-0 col-xl-6 offset-xl-1">
                <div class="order-wrapp-right-column">
                    <div class="order-top-caption">
                        <div class="h6 title">Your Order</div>
                        <div class="change-order open-popup" data-rel="2">Edit</div>
                    </div>
                    <div class="order-list-product-wrapp">
                        <div class="order-list-product">
                            <?php
                            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);

                                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                    $thumbnail = wp_get_attachment_image_src($_product->get_image_id())[0];
                                    ?>
                                    <div class="order-product-item">
                                        <div class="left-block">
                                            <span class="bg bg-lazy-load"
                                                  style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                                  data-bg="<?php echo $thumbnail; ?>"></span>
                                        </div>
                                        <div class="right-block">
                                            <div class="product-info">
                                                <h6 class="title h6 product-title"><?= $_product->get_name(); ?></h6>
                                                <div class="product-col-price">
                                                    <div class="color-wrapp blue"><i></i>Blue</div>
                                                    <div class="current-price"><?= $_product->get_price_html(); ?> x
                                                        <b><?= $cart_item['quantity']; ?></b></div>
                                                </div>
                                            </div>
                                            <div class="cost-total"><?= WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?></div>
                                            <div class="product-info-options">
                                                <div class="product-options">
                                                    <div class="input-label with-icon">Options <b></b></div>
                                                    <ul>
                                                        <li>Size: <span>Small bed</span></li>
                                                        <li>Bed kleur bolletjes: <span>goud</span></li>
                                                        <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                                        <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i>
                                                        </li>
                                                        <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+
                                                                €30</i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>
                        </div>
                        <?php if ( wc_coupons_enabled() ): ?>
                        <div class="add-promo-code js-visible-input">
                            <div class="input-label with-icon"><?php esc_html_e( 'Promo code', 'wildkidzz' ) ?> <b></b></div>
                            <form class="input-field-wrapp" method="post" style="display: none;">
                                <input class="input-field" type="text" name="coupon_code" placeholder="<?php esc_html_e( 'Enter promo code', 'wildkidzz' ) ?>" id="coupon_code" value="">
                            </form>
                        </div>
                        <?php endif; ?>
                        <div class="add-comment js-visible-input">
                            <div class="input-label with-icon">Order Notes <i>(Optional)</i> <b></b></div>
                            <div class="input-field-wrapp" style="display: none;">
                                <textarea class="input-field"
                                          placeholder="Notes about your order, special noter for delivery…"
                                          name="message"></textarea>
                            </div>
                        </div>
                        <div class="payment-options">
                            <div class="h6 title"><?php esc_html_e( 'Payment Option', 'wildkidzz' ) ?></div>
                            <div class="radiobox-wrapper check-payment-method">
                                <?php
                                $available_payment_methods = WC()->payment_gateways->get_available_payment_gateways();
                                foreach( $available_payment_methods as $method ) {
                                    //echo $method->title . '<br />';
                                    echo '<div class="radiobox-item liqpay-method">
                                            <label class="checkbox-entry type-2"><input type="radio" name="payment_method" value="'.esc_attr( $method->id ).'"><span>'. $method->title .'</span></label>
                                        </div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="bottom-order-info">
                            <div class="table-wrapp">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="order-info-item-caption"><?php esc_html_e( 'Subtotal', 'wildkidzz' ) ?></div>
                                        </td>
                                        <td>
                                            <div class="cost-total"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="order-info-item-caption style-2"><?php esc_html_e( 'Shipping Cost', 'wildkidzz' ) ?></div>
                                        </td>
                                        <td>
                                            <div class="cost-total style-2"><i>€</i><?php echo WC()->cart->get_shipping_total(); ?></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="bottom-order-info total">
                            <div class="table-wrapp">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="order-info-item-caption"><?php esc_html_e( 'Total', 'wildkidzz' ) ?></div>
                                        </td>
                                        <td>
                                            <div class="cost-total"><?php echo WC()->cart->get_cart_total(); ?></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="check-privacy">
                            <div class="checkbox-item">
                                <label class="checkbox-entry checkbox"><input type="checkbox" name="2" required="required"><?php echo wc_get_privacy_policy_text(); ?></label>
                            </div>
                        </div>
                        <div class="place-order">
                            <a href="#" class="button size-2 style-2 full-width"><span>Place Order</span></a>
                        </div>
                    </div>
                </div>
                <div class="pricacy-text">
                    <p>Je persoonlijke gegevens zullen worden gebruikt om je bestelling te verwerken, om je beleving op deze website te optimaliseren en voor andere doeleinden zoals beschreven in onze <a href="terms.html">privacybeleid</a>.</p>
                </div>
            </div>

        </div>
    </div>
    <div class="section-space size-2"></div>
</div>


<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()) : ?>

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <div class="col2-set" id="customer_details">
            <div class="col-1">
                <?php do_action('woocommerce_checkout_billing'); ?>
            </div>

            <div class="col-2">
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
        </div>

        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

    <h3 id="order_review_heading"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>

    <?php do_action('woocommerce_checkout_before_order_review'); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action('woocommerce_checkout_order_review'); ?>
    </div>

    <?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
