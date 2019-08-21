<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package wildkidzz
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function wildkidzz_woocommerce_setup()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'wildkidzz_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function wildkidzz_woocommerce_scripts()
{
    wp_enqueue_style('wildkidzz-woocommerce-style', get_template_directory_uri() . '/woocommerce.css');
}

add_action('wp_enqueue_scripts', 'wildkidzz_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function wildkidzz_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}

add_filter('body_class', 'wildkidzz_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function wildkidzz_woocommerce_products_per_page()
{
    return 100;
}

add_filter('loop_shop_per_page', 'wildkidzz_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function wildkidzz_woocommerce_thumbnail_columns()
{
    return 6;
}

add_filter('woocommerce_product_thumbnails_columns', 'wildkidzz_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function wildkidzz_woocommerce_loop_columns()
{
    return 3;
}

add_filter('loop_shop_columns', 'wildkidzz_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function wildkidzz_woocommerce_related_products_args($args)
{
    $defaults = array(
        'posts_per_page' => 6,
        'columns' => 3,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}

add_filter('woocommerce_output_related_products_args', 'wildkidzz_woocommerce_related_products_args');

if (!function_exists('wildkidzz_woocommerce_product_columns_wrapper')) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function wildkidzz_woocommerce_product_columns_wrapper()
    {
        $columns = wildkidzz_woocommerce_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}
add_action('woocommerce_before_shop_loop', 'wildkidzz_woocommerce_product_columns_wrapper', 40);

if (!function_exists('wildkidzz_woocommerce_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function wildkidzz_woocommerce_product_columns_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop', 'wildkidzz_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('wildkidzz_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function wildkidzz_woocommerce_wrapper_before()
    {
        ?>
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
        <?php
    }
}
add_action('woocommerce_before_main_content', 'wildkidzz_woocommerce_wrapper_before');

if (!function_exists('wildkidzz_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function wildkidzz_woocommerce_wrapper_after()
    {
        ?>
        </main><!-- #main -->
        </div><!-- #primary -->
        <?php
    }
}
add_action('woocommerce_after_main_content', 'wildkidzz_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
 * <?php
 * if ( function_exists( 'wildkidzz_woocommerce_header_cart' ) ) {
 * wildkidzz_woocommerce_header_cart();
 * }
 * ?>
 */

if (!function_exists('wildkidzz_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function wildkidzz_woocommerce_cart_link_fragment($fragments)
    {
        ob_start();
        wildkidzz_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'wildkidzz_woocommerce_cart_link_fragment');

if (!function_exists('wildkidzz_woocommerce_cart_link')) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function wildkidzz_woocommerce_cart_link()
    {
        ?>
        <div class="header-cart-inner">
            <?php
            $item_count_text = sprintf(
            /* translators: number of items in the mini cart. */
                _n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'wildkidzz'),
                WC()->cart->get_cart_contents_count()
            );
            ?>
            <div class="cart-icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                     y="0px" width="24px" height="28px" viewBox="0 0 24 28" enable-background="new 0 0 24 28"
                     xml:space="preserve"><path
                            d="M23.994,24.204L22.277,6.15c-0.037-0.401-0.399-0.705-0.822-0.705h-3.532C17.874,2.434,15.238,0,12,0 C8.762,0,6.126,2.434,6.077,5.445H2.545c-0.429,0-0.785,0.304-0.822,0.705L0.006,24.204C0.006,24.227,0,24.25,0,24.273 C0,26.328,2.017,28,4.501,28h14.998C21.983,28,24,26.328,24,24.273C24,24.25,24,24.227,23.994,24.204z M12,1.546 c2.324,0,4.219,1.741,4.268,3.899H7.732C7.781,3.287,9.676,1.546,12,1.546z"/></svg>
                <div class="header-cart-amount-product"><?php echo esc_html($item_count_text); ?></div>
            </div>
            <div class="header-cart-price"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></div>
        </div>
        <?php
    }
}

if (!function_exists('wildkidzz_woocommerce_header_cart')) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function wildkidzz_woocommerce_header_cart()
    {
        if (is_cart()) {
            $class = 'current-menu-item';
        } else {
            $class = '';
        }
        ?>
        <ul id="site-header-cart" class="site-header-cart">
            <li class="<?php echo esc_attr($class); ?>">
                <?php wildkidzz_woocommerce_cart_link(); ?>
            </li>
            <li>
                <?php
                $instance = array(
                    'title' => '',
                );

                the_widget('WC_Widget_Cart', $instance);
                ?>
            </li>
        </ul>
        <?php
    }
}

/**
 * Remove default hooks
 */
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);//disable default thumbnail
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);//disable related products

/**
 * Link and image in content product
 */
add_action('woocommerce_before_shop_loop_item_title', 'wildkidzz_woocommerce_template_loop_product_thumbnail_open', 5);
function wildkidzz_woocommerce_template_loop_product_thumbnail_open(){
    ?>
    <a href="<?php echo get_permalink(); ?>" class="product-link"></a>
    <div class="product-item-top">
        <<div class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);" data-bg="<?php echo the_post_thumbnail_url(); ?>"></div>
    <?php
}

add_action('woocommerce_before_shop_loop_item_title', 'wildkidzz_woocommerce_template_loop_product_thumbnail_close', 30);
function wildkidzz_woocommerce_template_loop_product_thumbnail_close(){
    ?>
    </div>

    <?php
}


/**
 * Title in content product
 */
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10); // Remove default display title
add_action('woocommerce_shop_loop_item_title', 'wildkidzz_woocommerce_template_loop_product_title', 10);
function wildkidzz_woocommerce_template_loop_product_title(){
    echo '<div class="product-item-bottom"> <div class="title h6 sm">' . get_the_title() . '</div>';
}

/**
 * Add </div> for <div class="product-item-bottom">
 */
add_action('woocommerce_after_shop_loop_item', 'wildkidzz_add_product_item_bottom_div');
function wildkidzz_add_product_item_bottom_div(){
    echo '</div>';
}

/**
 * Remove add to cart from content product
 */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'wildkidzz_dropdown_variable', 10, 2 );
function wildkidzz_dropdown_variable( $html, $args ){
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' );
    $show_option_none_html = '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    $html = str_replace($show_option_none_html, '', $html);

    return $html;
}

// Remove unusing fileds in checkout
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['billing_last_name']);
    unset($fields['shipping']['billing_address_2']);

    return $fields;
}

//Add classes for checkout fields
add_filter( 'woocommerce_form_field_args', 'custom_classes_for_fields' );
function custom_classes_for_fields( $fields ) {
    $fields['label_class'] = array('input-label');
    $fields['input_class'] = array('input-field');

    return $fields;
}

//Custom ordering checkout fields
add_filter( 'woocommerce_checkout_fields', 'custom_order_checkout_fields' );
function custom_order_checkout_fields( $checkout_fields ) {
    $checkout_fields['billing']['billing_first_name']['priority'] = 10;
    $checkout_fields['billing']['billing_company']['priority'] = 20;
    $checkout_fields['billing']['billing_email']['priority'] = 30;
    $checkout_fields['billing']['billing_phone']['priority'] = 40;
    $checkout_fields['billing']['billing_country']['priority'] = 50;
    $checkout_fields['billing']['billing_postcode']['priority'] = 60;
    $checkout_fields['billing']['billing_city']['priority'] = 70;
    $checkout_fields['billing']['billing_address_1']['priority'] = 80;

    return $checkout_fields;
}

//Address fields
add_filter( 'woocommerce_default_address_fields', 'address_fields_classes' );
function address_fields_classes( $address_fields ) {
    $address_fields['first_name']['class'] = array('input-field-wrapp');
    $address_fields['first_name']['label'] = 'Your Name';
    $address_fields['first_name']['placeholder'] = 'Name*';

    $address_fields['company']['class'] = array('input-field-wrapp');
    $address_fields['company']['placeholder'] = 'Apple';

    $address_fields['address_1']['class'] = array('input-field-wrapp');
    $address_fields['address_1']['label'] = 'Address';
    $address_fields['address_1']['placeholder'] = 'e.g. 87 Jaden Mountain, apr.2';

    $address_fields['postcode']['class'] = array('input-field-wrapp');
    $address_fields['postcode']['label'] = 'Zip Code';
    $address_fields['postcode']['placeholder'] = 'e.g. 1111';

    $address_fields['city']['class'] = array('input-field-wrapp');
    $address_fields['city']['label'] = 'City';
    $address_fields['city']['placeholder'] = 'Enter City';

    $address_fields['email']['class'] = array('input-field-wrapp');
    $address_fields['email']['placeholder'] = 'Email';

    return $address_fields;
}

//Billing fields
add_filter( 'woocommerce_billing_fields', 'billing_fields_classes' );
function billing_fields_classes( $billing_fields ){
    $billing_fields['billing_phone']['class'] = array('input-field-wrapp');
    $billing_fields['billing_email']['class'] = array('input-field-wrapp');

    return $billing_fields;
}