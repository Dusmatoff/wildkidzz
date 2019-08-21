<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>
<?php
$banner_img = get_field('banner_img', get_option('woocommerce_shop_page_id'));
$banner_title = get_field('banner_title', get_option('woocommerce_shop_page_id'));
$banner_subtitle = get_field('banner_subtitle', get_option('woocommerce_shop_page_id'));
if ($banner_img):
    ?>
    <!-- MAIN BANNER -->
    <div class="section banner bottom-size-2 parallax-bg">
        <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
             style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
             data-bg="<?php echo $banner_img; ?>"></div>
        <div class="opacity"></div>
        <div class="container">
            <div class="banner-inner">
                <div class="banner-align size-2">
                    <div class="row">
                        <div class="col-12 col-lg-10 col-xl-7">
                            <div class="simple-item banner-info">
                                <?php if ($banner_title): ?><h2
                                        class="h2 title color-2"><?php echo $banner_title; ?></h2><?php endif; ?>
                                <?php if ($banner_subtitle): ?>
                                    <div class="sub-title size-2"><?php echo $banner_subtitle; ?></div><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <!-- STORE -->
    <div class="section">
        <div class="container">
            <div class="product-wrapps izotope-block">
                <div class="filter-list">
                    <div class="select-izotop-category"><?php esc_html_e('All', 'wildkidzz') ?></div>
                    <ul>
                        <li data-filter="*" class="active all"><span><?php esc_html_e('All', 'wildkidzz') ?></span></li>
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
                                $svg_code = term_description( $product_style_id, 'product-style' );
                                //<img src="'. wp_get_attachment_url(get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true )) .'"> Get cat thumbnail url
                                echo '<li data-filter=".product-style-' . $cat->slug . '"><span>' . $svg_code . $cat->name . '</span></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="row d-block">
                    <div class="izotope-container">
                        <div class="grid-sizer"></div>
                <?php
                if (woocommerce_product_loop()) {

                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    //do_action( 'woocommerce_before_shop_loop' );

                    woocommerce_product_loop_start();

                    if (wc_get_loop_prop('total')) {
                        while (have_posts()) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             *
                             * @hooked WC_Structured_Data::generate_product_data() - 10
                             */
                            do_action('woocommerce_shop_loop');

                            wc_get_template_part('content', 'product');
                        }
                    }

                    woocommerce_product_loop_end();

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action('woocommerce_after_shop_loop');
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action('woocommerce_no_products_found');
                }

                /**
                 * Hook: woocommerce_after_main_content.
                 *
                 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                 */
                do_action('woocommerce_after_main_content'); ?>
                    </div>
                </div>
            </div>
            <div class="row show-more-products">
                <div class="col-12">
                    <div class="button"><span>Show more</span></div>
                </div>
            </div>
        </div>
        <div class="section-space size-3"></div>
    </div>
<?php
$seo_text_title = get_field('seo_text_title', get_option('woocommerce_shop_page_id'));
$seo_short_text = get_field('seo_short_text', get_option('woocommerce_shop_page_id'));
$seo_long_text = get_field('seo_long_text', get_option('woocommerce_shop_page_id'));
if ($seo_text_title && $seo_short_text):
    ?>
    <!-- SEO TEXT -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="separator style-2"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-10 offset-xl-1">
                    <div class="simple-item seo-text">
                        <h4 class="h4 title"><?php echo $seo_text_title; ?></h4>
                        <div class="simple-text size-2">
                            <?php echo $seo_short_text; ?>
                        </div>
                        <?php if ($seo_long_text): ?>
                            <div class="more-text">
                                <div class="simple-text size-2">
                                    <?php echo $seo_long_text; ?>
                                </div>
                                <div class="read-more"><?php esc_html_e('Show more', 'wildkidzz') ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-space size-2"></div>
    </div>
<?php endif; ?>
<?php
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
get_footer('shop');