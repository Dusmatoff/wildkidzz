<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wildkidzz
 */

?>
</div>

<!-- FOOTER -->
<?php //Get ACF fields
    $copyright = get_field('copyright', 'option');
    $thank_you_title = get_field('thank_you_title', 'option');
    $thank_you_text = get_field('thank_you_text', 'option');
    if (!is_404()):
?>
<footer>
    <div class="footer-top">
        <div class="container">
            <div class="row footer-column">
                <div class="col-12 col-sm-4">
                    <div class="footer-item">
                        <div class="footer-title"><?php esc_html_e( 'Contact', 'wildkidzz' ) ?></div>
                        <div class="footer-info">
                            <?php
                                if( have_rows('addresses', 'option') ):
                                    while ( have_rows('addresses', 'option') ) : the_row();
                                $address_text = get_sub_field('address_text');
                            ?>
                            <?php if($address_text): ?><div><p><?php echo $address_text; ?></p></div><?php endif; ?>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                            <?php
                                if( have_rows('phone', 'option') ):
                                    while ( have_rows('phone', 'option') ) : the_row();
                                $phone_number = get_sub_field('phone_number');
                            ?>
                            <?php if($phone_number): ?><div><a href="tel:<?php echo str_replace(array('(',')','-',' '), '', $phone_number); ?>" class="tel"><?php echo $phone_number; ?></a></div><?php endif; ?>
                            <?php
                                    endwhile;
                                endif;
                            ?>

                            <?php
                                if( have_rows('emails', 'option') ):
                                    while ( have_rows('emails', 'option') ) : the_row();
                                $email_text = get_sub_field('email_text');
                            ?>
                            <?php if($email_text): ?><div><a href="mailto:<?php echo $email_text; ?>"><?php echo $email_text; ?></a></div><?php endif; ?>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="footer-item">
                        <div class="footer-title"><?php esc_html_e( 'Customer Info', 'wildkidzz' ) ?></div>
                        <div class="footer-link">
                            <?php
                                wp_nav_menu( [
                                    'theme_location'  => 'menu-footer'
                                ] );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="footer-item">
                        <div class="footer-title"><?php esc_html_e( 'Follow Us', 'wildkidzz' ) ?></div>
                        <?php get_template_part('template-parts/social'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-7">
                    <?php if($copyright): ?><div class="copyright">© <?php echo date('Y'). ' - ' .$copyright; ?></div><?php endif; ?>
                </div>
                <div class="col-12 col-sm-5">
                    <div class="develope">
                        <a href="https://redstone.media/en/"><span><?php esc_html_e( 'Site developed by', 'wildkidzz' ) ?> <img src="<?php echo get_template_directory_uri(); ?>/img/redstone.svg" alt="REDSTONE"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php endif; ?>
<?php wp_footer(); ?>
<!-- POPUP-->
<div class="popup-wrapper">
    <div class="bg-popup-layer"></div>
    <div class="popup-content" data-rel="1">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="popup-align">
                <div class="simple-item text-center">
                    <div class="popup-top">
                        <?php if($thank_you_title): ?><div class="h4 title"><?php echo $thank_you_title; ?></div><?php endif; ?>
                        <?php if($thank_you_text): ?><div class="simple-text size-2"><p><?php echo $thank_you_text; ?></p></div><?php endif; ?>
                    </div>
                    <div class="popup-bottom">
                        <div class="button size-2 popup-close"><span><?php esc_html_e( 'Go Back', 'wildkidzz' ) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="button-close"><span></span></div>
        </div>
    </div>
    <div class="popup-content" data-rel="2">
        <div class="layer-close"></div>
        <div class="popup-container size-2">
            <div class="popup-align">
                <div class="popup-top">
                    <div class="h6 title"><?php esc_html_e( 'Editing Shopping cart', 'wildkidzz' ) ?></div>
                </div>
                <div class="popup-bottom ">
                    <?php wc_get_template('cart/edit-cart.php'); //woocommerce_mini_cart(); ?>

                </div>
            </div>
            <div class="button-close"><span></span></div>
        </div>
    </div>
    <div class="popup-content" data-rel="3">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="popup-align">
                <div class="simple-item text-center">
                    <div class="popup-top">
                        <div class="h4 title"><?php esc_html_e( 'Select options', 'wildkidzz' ) ?></div>
                        <div class="simple-text size-2"><p><?php esc_html_e( 'Please select some product options before adding this product to your cart.', 'wildkidzz' ) ?></p></div>
                    </div>
                    <div class="popup-bottom">
                        <div class="button size-2 popup-close"><span><?php esc_html_e( 'Go Back', 'wildkidzz' ) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="button-close"><span></span></div>
        </div>
    </div>
    <div class="popup-content" data-rel="4">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="popup-align">
                <div class="simple-item text-center">
                    <div class="popup-top">
                        <div class="h4 title"><?php esc_html_e( 'Unavailable', 'wildkidzz' ) ?></div>
                        <div class="simple-text size-2"><p><?php esc_html_e( 'This variation of product is currently out of stock and unavailable.', 'wildkidzz' ) ?></p></div>
                    </div>
                    <div class="popup-bottom">
                        <div class="button size-2 popup-close"><span><?php esc_html_e( 'Go Back', 'wildkidzz' ) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="button-close"><span></span></div>
        </div>
    </div>
    <div class="popup-content" data-rel="5">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="popup-align">
                <div class="simple-item text-center">
                    <div class="popup-top">
                        <div class="h4 title"><?php esc_html_e( 'Coupon error', 'wildkidzz' ) ?></div>
                        <div class="simple-text size-2"><p><?php esc_html_e( 'Coupon code does not exists. Please try again.', 'wildkidzz' ) ?></p></div>
                    </div>
                    <div class="popup-bottom">
                        <div class="button size-2 popup-close"><span><?php esc_html_e( 'Go Back', 'wildkidzz' ) ?></span></div>
                    </div>
                </div>
            </div>
            <div class="button-close"><span></span></div>
        </div>
    </div>
</div>

<!-- VIDEO POPUP -->
<div class="video-popup">
    <div class="video-popup-overlay"></div>
    <div class="video-popup-content">
        <div class="video-popup-layer"></div>
        <div class="video-popup-container">
            <div class="video-popup-align">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="about:blank"></iframe>
                </div>
            </div>
            <div class="video-popup-close button-close"><span></span></div>
        </div>
    </div>
</div>

</body>
</html>
