<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$dimensions = wc_format_dimensions($product->get_dimensions(false));
?>
<?php if($dimensions): ?><div class="product-text-size simple-text size-3"><p><?php esc_html_e( 'Dimensions', 'wildkidzz' ) ?> <?php echo $dimensions; ?></p></div><?php endif; ?>
<div class="price-product-wrapp ">
    <span class="product-price js-ajax-price" data-product-id="<?php echo $product->get_id() ?>"><?php echo $product->get_price_html(); ?></span>
    <span class="product-price-desc"><?php esc_html_e( 'This amount is incl. VAT', 'wildkidzz' ) ?></span>
</div>
