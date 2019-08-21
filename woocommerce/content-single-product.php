<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
//do_action( 'woocommerce_before_single_product' );

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <div class="section">
        <div class="container">
            <div class="row xs-hide">
                <div class="col-12">
                    <div class="product-top-navigation">
                        <div class="filter-list">
                            <div class="select-izotop-category"><?php esc_html_e('All', 'wildkidzz') ?></div>
                            <ul>
                                <li data-filter="*" class="active all">
                                    <span><?php esc_html_e('All', 'wildkidzz') ?></span></li>
                                <?php
                                $taxonomy = 'product-style';
                                $orderby = 'name';
                                $show_count = 0;      // 1 for yes, 0 for no
                                $pad_counts = 0;      // 1 for yes, 0 for no
                                $hierarchical = 0;      // 1 for yes, 0 for no
                                $title = '';
                                $empty = 1;

                                $args = array(
                                    'taxonomy' => $taxonomy,
                                    'orderby' => $orderby,
                                    'show_count' => $show_count,
                                    'pad_counts' => $pad_counts,
                                    'hierarchical' => $hierarchical,
                                    'title_li' => $title,
                                    'hide_empty' => $empty
                                );
                                $all_product_styles = get_categories($args);
                                foreach ($all_product_styles as $cat) {
                                    $product_style_id = $cat->term_id;
                                    //$svg_code = get_field('svg_code');
                                    $svg_code = term_description($product_style_id, 'product-style');
                                    //<img src="'. wp_get_attachment_url(get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true )) .'"> Get cat thumbnail url
                                    echo '<li data-filter=".product-style-' . $cat->slug . '"><span>' . $svg_code . $cat->name . '</span></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                        $breadcrumbs_args = array(
                            'delimiter' => '/',
                            'wrap_before' => '<ul class="breadcrumbs xs-hide">',
                            'wrap_after' => '</ul>',
                            'before' => '<li>',
                            'after' => '</li>',
                            'home' => __('Home', 'wildkidzz')
                        );
                        woocommerce_breadcrumb($breadcrumbs_args);
                        ?>
                    </div>
                </div>
            </div>
            <div class="product-detail-wrapp" data-price-product="<?php echo $product->get_price(); ?>">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-0">
                        <div class="swiper-thumbs-wrapper">
                            <div class="product-detail-top-wrapp">
                                <div class="swiper-entry hide-arrow">
                                    <div class="swiper-button-prev"><i></i></div>
                                    <div class="swiper-button-next"><i></i></div>
                                    <div class="swiper-container swiper-thumbs-top"
                                         data-options='{"watchSlidesVisibility":true, "spaceBetween": 0, "autoHeight": true}'>
                                        <div class="swiper-wrapper">
                                            <?php
                                            $attachment_ids = $product->get_gallery_image_ids();
                                            if (is_array($attachment_ids) && !empty($attachment_ids)) {
                                                foreach ($attachment_ids as $item) {
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="product-top-img img-lazy-load">
                                                            <img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                                                                 data-src="<?= wp_get_attachment_url($item); ?>" alt="">
                                                        </div>
                                                    </div>
                                                <?php }
                                            } // No images found
                                            else {
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-entry hide-arrow">
                                <div class="swiper-button-prev"><i></i></div>
                                <div class="swiper-button-next"><i></i></div>
                                <div class="swiper-container swiper-thumbs-bottom"
                                     data-options='{"slidesPerView": 6, "spaceBetween": 10,"breakpoints":{"767":{"slidesPerView": 4}, "1399":{"slidesPerView": 5}, "1799":{"slidesPerView": 6} }, "watchSlidesVisibility": true, "watchSlidesProgress": true}'>
                                    <div class="swiper-wrapper">
                                        <?php
                                        foreach ($attachment_ids as $item) {
                                            ?>
                                            <div class="swiper-slide">
                                                <div class="product-bottom-preview">
                                                    <div class="bg bg-lazy-load"
                                                         style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                                         data-bg="<?= wp_get_attachment_url($item); ?>"></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        /**
                         * Hook: woocommerce_before_single_product_summary.
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        //do_action( 'woocommerce_before_single_product_summary' );
                        ?>
                    </div>
                    <div class="summary entry-summary col-12 col-lg-6 col-xl-5 offset-xl-1">
                        <div class="product-detail-info">
                            <?php
                            /**
                             * Hook: woocommerce_single_product_summary.
                             *
                             * @hooked woocommerce_template_single_title - 5
                             * @hooked woocommerce_template_single_rating - 10
                             * @hooked woocommerce_template_single_price - 10
                             * @hooked woocommerce_template_single_excerpt - 20
                             * @hooked woocommerce_template_single_add_to_cart - 30
                             * @hooked woocommerce_template_single_meta - 40
                             * @hooked woocommerce_template_single_sharing - 50
                             * @hooked WC_Structured_Data::generate_product_data() - 60
                             */
                            do_action('woocommerce_single_product_summary');
                            ?>

                            <?php
                            $enable_free_shipping_info = get_field('enable_free_shipping_info', 'option');
                            $enable_fast_delivery_info = get_field('enable_fast_delivery_info', 'option');
                            if ($enable_free_shipping_info || $enable_fast_delivery_info):
                                ?>
                                <div class="product-delivery-info">
                                    <?php if ($enable_free_shipping_info): ?>
                                        <div class="delivery-info-item">
                                            <img src="<?php echo get_template_directory_uri(); ?>/icon/delivery-truck-silhouette.svg"
                                                 alt="">
                                            <span><?php esc_html_e('Temporary free shipping throughout the Netherlands (Belgium € 20)', 'wildkidzz') ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($enable_fast_delivery_info): ?>
                                        <div class="delivery-info-item">
                                            <img src="<?php echo get_template_directory_uri(); ?>/icon/clock.svg"
                                                 alt="">
                                            <span><?php esc_html_e('Fast delivery', 'wildkidzz') ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-space size-2"></div>
    </div>
</div>


<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
do_action('woocommerce_after_single_product_summary');
?>
<?php do_action('woocommerce_after_single_product'); ?>

<!-- SIMILAR PRODUCTS -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="simple-item">
                    <div class="title-decor not-decor">
                        <div class="title-wrapp">
                            <h4 class="title h4"><?php esc_html_e('Similar Products', 'wildkidzz') ?></h4>
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
                         data-options='{"speed":700, "autoHeight": true, "slidesPerView": 3, "spaceBetween":30, "breakpoints":{"767":{"slidesPerView": 1}, "1199":{"slidesPerView": 2}, "1399":{"slidesPerView": 3}, "1799":{"slidesPerView": 3} } }'>
                        <div class="swiper-wrapper">
                            <?php
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => 12
                            );
                            $loop = new WP_Query($args);
                            if ($loop->have_posts()) {
                                while ($loop->have_posts()) : $loop->the_post(); ?>
                                    <div class="swiper-slide">
                                        <?php wc_get_template_part('content', 'product'); ?>
                                    </div>
                                <?php endwhile;
                            } else {
                                echo __('No products found');
                            }
                            wp_reset_postdata(); ?>
                        </div>
                        <div class="swiper-pagination swiper-pagination-relative d-xl-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-space size-2"></div>
</div>