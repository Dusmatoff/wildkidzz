<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

$dot = ".";

$position = stripos ($short_description, $dot); //find first dot position

if($position) { //if there's a dot in our soruce text do
    $offset = $position + 1; //prepare offset
    $position2 = stripos ($short_description, $dot, $offset); //find second dot using offset
    $first_two = substr($short_description, 0, $position2); //put two first sentences under $first_two

    $position3 = stripos ($short_description, $dot, $offset); //find second dot using offset
    $other = substr($short_description, 0, $position3); //put two first sentences under $first_two
    //echo $first_two . '.'; //add a dot
}

?>
<div class="woocommerce-product-details__short-description product-description">
    <div class="simple-text">
        <?php echo $first_two . '.'; ?>
    </div>
    <div class="more-text">
        <div class="simple-text">
            <?php echo $other . '.'; ?>
        </div>
        <span class="read-more">show more</span>
    </div>
</div>
