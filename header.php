<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wildkidzz
 */

?>
<!DOCTYPE html>
<html lang="<?php echo wpm_get_language(); ?>">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- LOADER -->
<div id="loader-wrapper"></div>

<!-- CONTENT -->
<div id="content-hidden">
    <?php //Get ACF fields
        $logo = get_field('logo', 'option');
        $phone = get_field('phone', 'option');
        $contact_page_url = get_field('contact_page_url', 'option');
    ?>
    <!-- HEADER -->
    <header <?php echo is_404()? 'class="style-2"' : '' ?>>
        <div class="header-inner">
            <div class="layer-close"></div>
            <div class="top-mobile-menu">
                <?php if($logo): ?><div id="logo"><a href="<?php echo site_url(); ?>"><img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"></a></div><?php endif; ?>
                <div class="right-menu">
                    <div class="telephone-block">
                        <span class="tel-icon"><img src="<?php echo get_template_directory_uri(); ?>/icon/phone-call.svg" alt=""></span>
                        <?php
                            if( have_rows('phone', 'option') ):
                                while ( have_rows('phone', 'option') ) : the_row();
                            $phone_number = get_sub_field('phone_number');
                        ?>
                        <?php if($phone_number): ?><a href="tel:<?php echo str_replace(array('(',')','-',' '), '', $phone_number); ?>" class="tel"><?php echo $phone_number; ?></a><br><?php endif; ?>
                        <?php
                                endwhile;
                            endif;
                        ?>
                        <?php if($contact_page_url): ?><a href="<?php echo $contact_page_url; ?>" class="contact"><?php esc_html_e( 'Contact Us', 'wildkidzz' ) ?></a><?php endif; ?>
                    </div>
                    <div class="language-block">
                       <?php wlk_multilang_switcher(); ?>
                    </div>
                    <div class="header-cart-block contains-products ">
                            <?php wildkidzz_woocommerce_cart_link(); ?>
                    </div>
                </div>
                <div class="mobile-button"><span></span></div>
            </div>
            <div class="toggle-block">
                <div class="nav-wrapp">
                    <nav>
                        <?php
                            wp_nav_menu( [
                                'theme_location'  => 'menu-1'
                            ] );
                        ?>
                    </nav>
                </div>
            </div>

            <div class="header-cart">
                <div class="cart-list-product-wrapp">
                    <div class="widget_shopping_cart_content">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="margin-header"></div>
