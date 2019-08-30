<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @package    WooCommerce/Templates
 * @version     3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if ($upsells) : ?>
    <!-- ANDERE SUGGESTIES -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="simple-item">
                        <div class="title-decor not-decor">
                            <div class="title-wrapp">
                                <h4 class="title h4"><?php esc_html_e( 'Other suggestions', 'wildkidzz' ) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper-entry arrow-style-2 arrow-pos-2">
                        <div class="swiper-button-prev"><i></i></div>
                        <div class="swiper-button-next"><i></i></div>
                        <div class="swiper-container"
                             data-options='{"speed":700, "autoHeight": true, "slidesPerView": 4, "spaceBetween":30, "breakpoints":{"767":{"slidesPerView": 1}, "992":{"slidesPerView": 2}, "1199":{"slidesPerView": 3}, "1399":{"slidesPerView": 4}, "1799":{"slidesPerView": 4} } }'>
                            <div class="swiper-wrapper">

                                <?php woocommerce_product_loop_start(); ?>

                                <?php foreach ($upsells as $upsell) : ?>
                                    <div class="swiper-slide">
                                        <?php
                                        $post_object = get_post($upsell->get_id());

                                        setup_postdata($GLOBALS['post'] =& $post_object);

                                        wc_get_template_part('content', 'product'); ?>
                                    </div>
                                <?php endforeach; ?>
                                <?php woocommerce_product_loop_end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-space size-3"></div>
        </div>
    </div>
    <!-- SEPARATOR SECTION -->
    <div class="section">
        <div class="separator color-2"></div>
        <div class="section-space size-3"></div>
    </div>
<?php endif;
wp_reset_postdata();
