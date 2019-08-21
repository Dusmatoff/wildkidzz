<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
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
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );
	?>
    <span class="quantity-label">Quantity</span>
    <div class="cost-amount">
	<div class="quantity custom-input-number size-2">
		<?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
		<!--<label class="screen-reader-text" for="<?php //echo esc_attr( $input_id ); ?>"><?php //echo esc_attr( $label ); ?></label>-->
        <button type="button" class="decrement"><span></span></button>
		<input
			type="number"
			id="<?php echo esc_attr( $input_id ); ?>"
			class="input-field <?php echo esc_attr( join( ' ', (array) $classes ) ); ?> "
			step="<?php echo esc_attr( $step ); ?>"
			min="<?php echo esc_attr( $min_value ); ?>"
			max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
            readonly=""
			inputmode="<?php echo esc_attr( $inputmode ); ?>" />
        <button type="button" class="increment"><span></span></button>
		<?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
	</div>
    </div>
	<?php
}
