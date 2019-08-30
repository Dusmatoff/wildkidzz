<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="input-field-wrapp" style="display: none;">
    <div class="checkout_coupon woocommerce-form-coupon" id="woocommerce-form-coupon-form">
        <div class="row">
            <div class="col-12 col-sm-6">
                <input class="input-field" type="text" placeholder="<?php esc_html_e( 'Enter promo code', 'wildkidzz' ) ?>" name="coupon_code" id="coupon_code" value="">
            </div>
            <div class="col-12 col-sm-6">
                <button type="submit" class="button size-2 js-submit-coupon" name="apply_coupon" form="woocommerce-form-coupon-form" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
            </div>
        </div>
    </div>
</div>
