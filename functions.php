<?php
/**
 * wildkidzz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wildkidzz
 */

if ( ! function_exists( 'wildkidzz_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function wildkidzz_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on wildkidzz, use a find and replace
         * to change 'wildkidzz' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'wildkidzz', get_template_directory() . '/languages' );

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'wildkidzz' ),
            'menu-footer' => esc_html__( 'Footer', 'wildkidzz' ),
        ) );
    }
endif;
add_action( 'after_setup_theme', 'wildkidzz_setup' );

// Update CSS within in Admin
function admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/style-admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

/**
 * Enqueue scripts and styles.
 */
//Enqueue scripts.
function wildkidzz_scripts() {
    wp_enqueue_style('wildkidzz-style-top', get_template_directory_uri() . '/css/style-top.css');
    wp_enqueue_style('wildkidzz-style-cart-custom', get_template_directory_uri() . '/css/cart_custom.css');

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', '', '', true);
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js', '', '', true );
    wp_enqueue_script( 'inputmask', get_template_directory_uri() . '/js/jquery.inputmask.min.js', '', '', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', '', '', true );
    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', '', '', true );
    wp_enqueue_script( 'rellax', get_template_directory_uri() . '/js/rellax.min.js', '', '', true );
    wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', '', '', true );
    wp_enqueue_script( 'additional', get_template_directory_uri() . '/js/additional.js', '', '', true );

    if(is_page_template('page-contact.php') ){
        wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDco0U55FmAwh-agzHOdEirnnduhdy7Nyo', '', '', true );
        wp_enqueue_script( 'map', get_template_directory_uri() . '/js/map.js', '', '', true );
    }
}
add_action( 'wp_enqueue_scripts', 'wildkidzz_scripts', 99 );


//Enqueue styles.
function wlk_get_footer(){
    wp_enqueue_style('wildkidzz-style', get_template_directory_uri() . '/css/style-bottom.css');
    wp_enqueue_style('wildkidzz-additional-style',     get_stylesheet_uri());
}
add_action('get_footer','wlk_get_footer');


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/* Theme Options */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Settings',
        'menu_title'	=> 'Theme Settings',
        'menu_slug' 	=> 'theme-general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));
}

/* Add class 'active' to current page */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}

/*  Create Review post type */
add_action( 'init', 'wlk_register_review_post_type' );
function wlk_register_review_post_type() {
    $labels = array(
        'name' => esc_html__( 'Reviews'),
        'singular_name' => esc_html__( 'Review' ),
        'add_new' => esc_html__( 'Add review' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports'  => array( 'title', 'thumbnail', 'editor' )
    );
    register_post_type( 'review', $args );
}
/*  Create Product style for filter */
add_action( 'init', 'product_style_taxonomy' );
function product_style_taxonomy()  {
    $labels = array(
        'name'                       => 'Product styles',
        'singular_name'              => 'Product style',
        'menu_name'                  => 'Product styles',
        'all_items'                  => 'All product styles',
        'new_item_name'              => 'New product style',
        'add_new_item'               => 'Add product style',
        'edit_item'                  => 'Edit product style',
        'update_item'                => 'Update product style',
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'product-style', 'product', $args );
    register_taxonomy_for_object_type( 'product-style', 'product' );
}

// allow html in category and taxonomy descriptions
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'pre_link_description', 'wp_filter_kses' );
remove_filter( 'pre_link_notes', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

// Remove p tags from category description
remove_filter('term_description','wpautop');


function disable_woo_commerce_sidebar() {
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'disable_woo_commerce_sidebar');

function get_color_params($sSlug){
    return array('class'=>'base', 'style'=>'background: #'.$sSlug);
}
function get_type_by_slug($sSlug){
    $aSlug = explode('__', $sSlug);
    if(count($aSlug) < 2 ) {
        return  'select';
    }
    switch ($aSlug[0]) {
        case 'pa_stag':
            return 'tag';
        case 'pa_scolor':
            return 'color';
    }
    return 'select';
}
/**
 * @param array $args
 */
function wc_dropdown_variation_attribute_options_by_attribute($args = array()) {
    $sType = get_type_by_slug($args['attribute']);
    switch ($sType){
        case 'color':
        case 'tag':
            return wc_dropdown_variation_attribute_options_radio($args, $sType );
        default:
            return wc_dropdown_variation_attribute_options($args);
    }
}

/**
 * @param array $args
 * @param $sClasses
 */
function wc_dropdown_variation_attribute_options_radio($args = array(), $sClasses){
    $args = wp_parse_args(
        apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
        array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => 'group--'.$sClasses,
            'show_option_none' => __( 'Choose an option', 'woocommerce' ),
        )
    );

    // Get selected value.
    if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
        $selected_key     = 'attribute_' . sanitize_title( $args['attribute'] );
        $args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] ); // WPCS: input var ok, CSRF ok, sanitization ok.
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
    $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
    $class                 = $args['class'];
    $show_option_none      = (bool) $args['show_option_none'];

    if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[ $attribute ];
    }

    $html  = '<div id="' . esc_attr( $id ) . '" class="'. esc_attr( $class ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';

    if ( ! empty( $options ) ) {
        if ( $product && taxonomy_exists( $attribute ) ) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ( $terms as $term ) {
                if ( in_array( $term->slug, $options, true ) ) {

                    $label = '<span>'.esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) .'</span>';
                    if($sClasses == 'color'){
                        $aMeta = get_color_params(esc_attr( $term->slug ));
                        $label = '<span class="site-base-bg site-base-'.$aMeta['class'].'" style="'.$aMeta['style'].'"></span>';
                    }
                    $html .= '<div class="custom-radio-filter custom-radio-filter--'.$sClasses.' custom-radio-filter--'.esc_attr( $term->slug ).'">
                                        <input type="radio" data-toggle="variation" data-type="radio" name="' . esc_attr( $name ) . '" value="' . esc_attr( $term->slug ) . '" id="' . esc_attr( $id ) . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' .
                        '<label for="' . esc_attr( $id ) . esc_attr( $term->slug ) . '">'.$label.'</label> </div>';
                }
            }
        } else {
            foreach ( $options as $option ) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                $html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
            }
        }
    }

    $html .= '</div>';

    echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); // WPCS: XSS ok.
}
/**
 * 
 * @param array $args
 */
function wc_dropdown_variation_attribute_options( $args = array() ) {
    $args = wp_parse_args(
        apply_filters( 'woocommerce_dropdown_variation_attribute_options_args', $args ),
        array(
            'options'          => false,
            'attribute'        => false,
            'product'          => false,
            'selected'         => false,
            'name'             => '',
            'id'               => '',
            'class'            => '',
            'show_option_none' => __( 'Choose an option', 'woocommerce' ),
        )
    );

    // Get selected value.
    if ( false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product ) {
        $selected_key     = 'attribute_' . sanitize_title( $args['attribute'] );
        $args['selected'] = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $args['product']->get_variation_default_attribute( $args['attribute'] ); // WPCS: input var ok, CSRF ok, sanitization ok.
    }

    $options               = $args['options'];
    $product               = $args['product'];
    $attribute             = $args['attribute'];
    $name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
    $id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
    $class                 = $args['class'];
    $show_option_none      = (bool) $args['show_option_none'];
    $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __( 'Choose an option', 'woocommerce' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

    if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
        $attributes = $product->get_variation_attributes();
        $options    = $attributes[ $attribute ];
    }

    $html  = '<select id="' . esc_attr( $id ) . '" class="custom-control-select' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-toggle="variation" data-type="select"  data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';
    $html .= '<option value="">' . esc_html( $show_option_none_text ) . '</option>';

    if ( ! empty( $options ) ) {
        if ( $product && taxonomy_exists( $attribute ) ) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ( $terms as $term ) {
                if ( in_array( $term->slug, $options, true ) ) {
                    $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $args['selected'] ), $term->slug, false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</option>';
                }
            }
        } else {
            foreach ( $options as $option ) {
                // This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
                $selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
                $html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</option>';
            }
        }
    }

    $html .= '</select>';

    echo apply_filters( 'woocommerce_dropdown_variation_attribute_options_html', $html, $args ); // WPCS: XSS ok.
}


function wc_get_formatted_cart_item_attributes( $cart_item, $flat = false ) {
    $item_data = array();

    // Variation values are shown only if they are not found in the title as of 3.0.
    // This is because variation titles display the attributes.
    if ( $cart_item['data']->is_type( 'variation' ) && is_array( $cart_item['variation'] ) ) {
        foreach ( $cart_item['variation'] as $name => $value ) {
            $val_orgn = $value;
            $taxonomy = wc_attribute_taxonomy_name( str_replace( 'attribute_pa_', '', urldecode( $name ) ) );

            if ( taxonomy_exists( $taxonomy ) ) {
                // If this is a term slug, get the term's nice name.
                $term = get_term_by( 'slug', $value, $taxonomy );
                if ( ! is_wp_error( $term ) && $term && $term->name ) {
                    $value = $term->name;
                }
                $label = wc_attribute_label( $taxonomy );
            } else {
                // If this is a custom option slug, get the options name.
                $value = apply_filters( 'woocommerce_variation_option_name', $value, null, $taxonomy, $cart_item['data'] );
                $label = wc_attribute_label( str_replace( 'attribute_', '', $name ), $cart_item['data'] );
            }

            // Check the nicename against the title.
            if ( '' === $value || wc_is_attribute_in_product_name( $value, $cart_item['data']->get_name() ) ) {
                continue;
            }

            $item_data[] = array(
                'key'   => $label,
                'name'   => $name,
                'value' => $value,
                'value_orign' => $val_orgn,
            );
        }
    }

    // Filter item data to allow 3rd parties to add more to the array.
    $item_data = apply_filters( 'woocommerce_get_item_data', $item_data, $cart_item );

    // Format item data ready to display.
    foreach ( $item_data as $key => $data ) {
        // Set hidden to true to not display meta on cart.
        if ( ! empty( $data['hidden'] ) ) {
            unset( $item_data[ $key ] );
            continue;
        }
        $item_data[ $key ]['key']     = ! empty( $data['key'] ) ? $data['key'] : $data['name'];
        $item_data[ $key ]['display'] = ! empty( $data['display'] ) ? $data['display'] : $data['value'];
    }


    return $item_data;
}

function wc_get_formatted_cart_item_attributes_color($cart_item){
    $_attributes = wc_get_formatted_cart_item_attributes($cart_item);

    foreach ($_attributes as $attribute){
        if(in_array($attribute['name'], array('attribute_pa_actual-color')) || in_array($attribute['key'], array('Actual Color'))){
            return $attribute;
        }
    }
    return false;
}


/************************************************/
/**
 * Outputs a checkout/address form field.
 *
 * @param string $key Key.
 * @param mixed  $args Arguments.
 * @param string $value (default: null).
 * @return string
 */
function woocommerce_form_field( $key, $args, $value = null ) {
    $defaults = array(
        'type'              => 'text',
        'label'             => '',
        'description'       => '',
        'placeholder'       => '',
        'maxlength'         => false,
        'required'          => false,
        'autocomplete'      => false,
        'id'                => $key,
        'class'             => array(),
        'label_class'       => array(),
        'input_class'       => array(),
        'return'            => false,
        'options'           => array(),
        'custom_attributes' => array(),
        'validate'          => array(),
        'default'           => '',
        'autofocus'         => '',
        'priority'          => '',
    );

    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'woocommerce_form_field_args', $args, $key, $value );

    if ( $args['required'] ) {
        $args['class'][] = 'validate-required';
        $required        = '&nbsp;<abbr class="required" title="' . esc_attr__( 'required', 'woocommerce' ) . '">*</abbr>';
    } else {
        $required = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
    }

    if ( is_string( $args['label_class'] ) ) {
        $args['label_class'] = array( $args['label_class'] );
    }

    if ( is_null( $value ) ) {
        $value = $args['default'];
    }

    // Custom attribute handling.
    $custom_attributes         = array();
    $args['custom_attributes'] = array_filter( (array) $args['custom_attributes'], 'strlen' );

    if ( $args['maxlength'] ) {
        $args['custom_attributes']['maxlength'] = absint( $args['maxlength'] );
    }

    if ( ! empty( $args['autocomplete'] ) ) {
        $args['custom_attributes']['autocomplete'] = $args['autocomplete'];
    }

    if ( true === $args['autofocus'] ) {
        $args['custom_attributes']['autofocus'] = 'autofocus';
    }

    if ( $args['description'] ) {
        $args['custom_attributes']['aria-describedby'] = $args['id'] . '-description';
    }

    if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
        foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
            $custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
        }
    }

    if ( ! empty( $args['validate'] ) ) {
        foreach ( $args['validate'] as $validate ) {
            $args['class'][] = 'validate-' . $validate;
        }
    }

    $field           = '';
    $label_id        = $args['id'];
    $sort            = $args['priority'] ? $args['priority'] : '';
    $field_container = '<p class="form-row %1$s" id="%2$s" data-priority="' . esc_attr( $sort ) . '">%3$s</p>';

    switch ( $args['type'] ) {
        case 'country':
            $countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

            if ( 1 === count( $countries ) ) {

                $field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

                $field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys( $countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" readonly="readonly" />';

            } else {
                $field_container = '<div class="form-row input-field-wrapp update_totals_on_change %1$s" id="%2$s">%3$s</div>';

              //  $field .=  '<div class="form-row input-field-wrapp update_totals_on_change validate-required country_radio" id="'.$key.'_field" data-priority="'.$args['priority'].'" > ';

                $field .=  '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$value.'">';
              //  $field .= '<label for="'.$key.'_field" class="input-label">'.$args['label'].' '.($args['required'] ? '<abbr class="required" title="required">*</abbr>' : '').'</label>';

                $field .= '<div class="row row-16">';
                foreach (WC()->countries->get_allowed_countries() as $countryValue=>$country){

                    $field .=  '<div class="col-6"> <span class="custom-control custom-radio"> <input type="radio" id="customInput_'.$key.$countryValue.'" class="js-custom-change-checkout-country custom-control-input"  value="'.$countryValue.'" name="'.$key.'_dup"  data-target="#'.$key.'" '.($countryValue==$value ? 'checked' : '').'>   <label class="custom-control-label" for="customInput_'.$key.$countryValue.'">'.$country.($countryValue == "BE" ? ' <b class="choose-country-price">+€20</b>' : '').'</label></span></div>';
                }
                $field .= '</div>';

            }

            break;
        case 'state':
            /* Get country this state field is representing */
            $for_country = isset( $args['country'] ) ? $args['country'] : WC()->checkout->get_value( 'billing_state' === $key ? 'billing_country' : 'shipping_country' );
            $states      = WC()->countries->get_states( $for_country );

            if ( is_array( $states ) && empty( $states ) ) {

                $field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

                $field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" readonly="readonly" data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

            } elseif ( ! is_null( $for_country ) && is_array( $states ) ) {

                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ? $args['placeholder'] : esc_html__( 'Select an option&hellip;', 'woocommerce' ) ) . '"  data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '">
						<option value="">' . esc_html__( 'Select an option&hellip;', 'woocommerce' ) . '</option>';

                foreach ( $states as $ckey => $cvalue ) {
                    $field .= '<option value="' . esc_attr( $ckey ) . '" ' . selected( $value, $ckey, false ) . '>' . $cvalue . '</option>';
                }

                $field .= '</select>';

            } else {

                $field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' data-input-classes="' . esc_attr( implode( ' ', $args['input_class'] ) ) . '"/>';

            }

            break;
        case 'textarea':
            $field .= '<textarea name="' . esc_attr( $key ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" ' . ( empty( $args['custom_attributes']['rows'] ) ? ' rows="2"' : '' ) . ( empty( $args['custom_attributes']['cols'] ) ? ' cols="5"' : '' ) . implode( ' ', $custom_attributes ) . '>' . esc_textarea( $value ) . '</textarea>';

            break;
        case 'checkbox':
            $field = '<label class="checkbox ' . implode( ' ', $args['label_class'] ) . '" ' . implode( ' ', $custom_attributes ) . '>
						<input type="' . esc_attr( $args['type'] ) . '" class="input-checkbox ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="1" ' . checked( $value, 1, false ) . ' /> ' . $args['label'] . $required . '</label>';

            break;
        case 'text':
        case 'password':
        case 'datetime':
        case 'datetime-local':
        case 'date':
        case 'month':
        case 'time':
        case 'week':
        case 'number':
        case 'email':
        case 'url':
        case 'tel':
            $field .= '<input type="' . esc_attr( $args['type'] ) . '" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '"  value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

            break;
        case 'select':
            $field   = '';
            $options = '';

            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    if ( '' === $option_key ) {
                        // If we have a blank option, select2 needs a placeholder.
                        if ( empty( $args['placeholder'] ) ) {
                            $args['placeholder'] = $option_text ? $option_text : __( 'Choose an option', 'woocommerce' );
                        }
                        $custom_attributes[] = 'data-allow_clear="true"';
                    }
                    $options .= '<option value="' . esc_attr( $option_key ) . '" ' . selected( $value, $option_key, false ) . '>' . esc_attr( $option_text ) . '</option>';
                }

                $field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="select ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" ' . implode( ' ', $custom_attributes ) . ' data-placeholder="' . esc_attr( $args['placeholder'] ) . '">
							' . $options . '
						</select>';
            }

            break;
        case 'radio':
            $label_id .= '_' . current( array_keys( $args['options'] ) );

            if ( ! empty( $args['options'] ) ) {
                foreach ( $args['options'] as $option_key => $option_text ) {
                    $field .= '<input type="radio" class="input-radio ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" value="' . esc_attr( $option_key ) . '" name="' . esc_attr( $key ) . '" ' . implode( ' ', $custom_attributes ) . ' id="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '"' . checked( $value, $option_key, false ) . ' />';
                    $field .= '<label for="' . esc_attr( $args['id'] ) . '_' . esc_attr( $option_key ) . '" class="radio ' . implode( ' ', $args['label_class'] ) . '">' . $option_text . '</label>';
                }
            }

            break;
    }

    if ( ! empty( $field ) ) {
        $field_html = '';

        if ( $args['label'] && 'checkbox' !== $args['type'] ) {
            $field_html .= '<label for="' . esc_attr( $label_id ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) . '">' . $args['label'] . $required . '</label>';
        }

        $field_html .= '<span class="woocommerce-input-wrapper">' . $field;

        if ( $args['description'] ) {
            $field_html .= '<span class="description" id="' . esc_attr( $args['id'] ) . '-description" aria-hidden="true">' . wp_kses_post( $args['description'] ) . '</span>';
        }

        $field_html .= '</span>';

        $container_class = esc_attr( implode( ' ', $args['class'] ) );
        $container_id    = esc_attr( $args['id'] ) . '_field';
        $field           = sprintf( $field_container, $container_class, $container_id, $field_html );
    }

    /**
     * Filter by type.
     */
    $field = apply_filters( 'woocommerce_form_field_' . $args['type'], $field, $key, $args, $value );

    /**
     * General filter on form fields.
     *
     * @since 3.4.0
     */
    $field = apply_filters( 'woocommerce_form_field', $field, $key, $args, $value );

    if ( $args['return'] ) {
        return $field;
    } else {
        echo $field; // WPCS: XSS ok.
    }
}

/***/
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 6;
    return $cols;
}

//Remove translate for woocommerce attributes
if(!is_admin()) add_action( 'wpm_taxonomies_config', 'remove_multilang_actions', 99 );
function remove_multilang_actions() {
    remove_filter( 'wpm_taxonomies_config', array( 'WPM_WooCommerce', 'add_attribute_taxonomies' ) );
}

//Custom languages switcher
function wlk_multilang_switcher(){
    if(!function_exists('wpm_language_switcher')) return;
    $a = wpm_get_languages();
    $b = wpm_get_language();
    if($a <= 1) return;
        foreach($a as $c => $d){
            if($d['enable']){
                $e = wpm_translate_current_url($c);
                $e = strtok($e,'?');
                echo '<div class="lang-item"><a href="'.$e.'" '.($b == $c ? 'class="active"' : '').'>'.$d['name'].'</a></div>';
            }
        }
}