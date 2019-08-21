<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) {

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo $delimiter;
		}
	}

	echo $wrap_after;

//    if( is_product() ) {
//        $permalinks = wc_get_permalink_structure();
//        $current_title = end($breadcrumb)[0];
//        if ( $_SERVER['HTTP_REFERER'] ) {
//            $url_parts = explode( '/', trim( wp_parse_url( $_SERVER['HTTP_REFERER'] )['path'], '/' ) );
//            $url = site_url() . '/' . $permalinks['category_base'];
//            $breadcrumb = array(
//                array( __( 'Homepage', 'woocommerce-multilingual' ), site_url(), ),
//                array( __( 'Catalog', 'woocommerce' ), site_url() . $permalinks['product_base'] . '/', ),
//            );
//            foreach( $url_parts as $url_part ) {
//                if( $term = get_term_by( 'slug', $url_part, 'product_cat' ) ) {
//                    $url .= '/' . $url_part;
//                    $breadcrumb[] = array( $term->name, $url );
//                }
//            }
//            $breadcrumb[] = array( $current_title );
//        } else {
//            $breadcrumb = array(
//                array( __( 'Homepage', 'woocommerce-multilingual' ), site_url(), ),
//                array( __( 'Products', 'woocommerce-multilingual' ), site_url() . $permalinks['product_base'] . '/', ),
//                array( $current_title ),
//            );
//        }
//    }

}
