<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($tabs)) : ?>
    <!-- MORE INFORMATION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-10 offset-xl-1">
                    <div class="simple-item simple-page">
                        <h5><?php esc_html_e( 'More Information', 'wildkidzz' ) ?></h5>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-space size-3"></div>
    </div>
    <!-- SEPARATOR SECTION -->
    <div class="section">
        <div class="separator color-2"></div>
        <div class="section-space size-3"></div>
    </div>
<?php endif; ?>