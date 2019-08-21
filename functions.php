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



/**
 * Enqueue scripts and styles.
 */
function wildkidzz_scripts() {
    wp_enqueue_style( 'wildkidzz-style', get_template_directory_uri() . '/css/style-bottom.css' );
    wp_enqueue_style( 'wildkidzz-additional-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_script( 'healthity-jquery', 'https://code.jquery.com/jquery-3.4.1.min.js', '', '', true );
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js', '', '', true );
    wp_enqueue_script( 'inputmask', get_template_directory_uri() . '/js/jquery.inputmask.min.js', '', '', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', '', '', true );
    wp_enqueue_script( 'SmoothScroll', get_template_directory_uri() . '/js/SmoothScroll.js', '', '', true );
    wp_enqueue_script( 'rellax', get_template_directory_uri() . '/js/rellax.min.js', '', '', true );
    wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', '', '', true );
    //wp_enqueue_script( 'additional', get_template_directory_uri() . '/js/additional.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'wildkidzz_scripts' );

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


// The custom function MUST be hooked to the init action hook
add_action( 'init', 'wlk_register_review_post_type' );
// A custom function that calls register_post_type
function wlk_register_review_post_type() {
    // Set various pieces of text, $labels is used inside the $args array
    $labels = array(
        'name' => esc_html__( 'Reviews'),
        'singular_name' => esc_html__( 'Review' ),
        'add_new' => esc_html__( 'Add review' ),
  );
  // Set various pieces of information about the post type
  $args = array(
      'labels' => $labels,
      'public' => true,
      'menu_icon' => 'dashicons-format-quote',
      'supports'  => array( 'title', 'thumbnail', 'editor' )
  );
  // Register the movie post type with all the information contained in the $arguments array
  register_post_type( 'review', $args );
}

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