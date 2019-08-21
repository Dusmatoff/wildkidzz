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
                            <div><p><?php echo $address_text; ?></p></div>
                            <?php
                                    endwhile;
                                endif;
                            ?>
                            <?php
                                if( have_rows('phone', 'option') ):
                                    while ( have_rows('phone', 'option') ) : the_row();
                                $phone_number = get_sub_field('phone_number');
                            ?>
                            <div><a href="tel:<?php echo str_replace(array('(',')','-',' '), '', $phone_number); ?>" class="tel"><?php echo $phone_number; ?></a></div>
                            <?php
                                    endwhile;
                                endif;
                            ?>

                            <?php
                                if( have_rows('emails', 'option') ):
                                    while ( have_rows('emails', 'option') ) : the_row();
                                $email_text = get_sub_field('email_text');
                            ?>
                            <div><a href="mailto:<?php echo $email_text; ?>"><?php echo $email_text; ?></a></div>
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

<!-- POPUP -->
<div class="popup-wrapper">
    <div class="bg-popup-layer"></div>
    <div class="popup-content" data-rel="1">
        <div class="layer-close"></div>
        <div class="popup-container">
            <div class="popup-align">
                <div class="simple-item text-center">
                    <div class="popup-top">
                        <div class="h4 title">Thank you!</div>
                        <div class="simple-text size-2">
                            <p>We will call you back during the day.</p>
                        </div>
                    </div>
                    <div class="popup-bottom">
                        <div class="button size-2 popup-close"><span>Go Back</span></div>
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
                    <div class="h6 title">Editing Shopping cart</div>
                </div>
                <div class="popup-bottom">
                    <div class="cart-list-product-wrapp">
                        <div class="cart-list-product">
                            <div class="cart-product-item" data-price-product="399">
                                <div class="left-block">
                                    <a href="product-detail.html">
                                        <span class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);" data-bg="<?php echo get_template_directory_uri(); ?>/img/cart-product-1.jpg"></span>
                                    </a>
                                </div>
                                <div class="right-block">
                                    <div class="product-info">
                                        <h6 class="title h6 product-title"><a href="product-detail.html">Lattenbodem with back border</a></h6>
                                        <div class="product-col-price">
                                            <div class="color-wrapp blue"><i></i>Blue</div>
                                        </div>
                                        <div class="product-options">
                                            <div class="input-label with-icon">Options <b></b></div>
                                            <ul>
                                                <li>Size: <span>Small bed</span></li>
                                                <li>Bed kleur bolletjes: <span>goud</span></li>
                                                <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                                <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                                <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cost-amount">
                                        <div class="custom-input-number">
                                            <button type="button" class="decrement"><span></span></button>
                                            <input type="number" class="input-field" step="1" value="6" min="1" max="999" readonly="">
                                            <button type="button" class="increment"><span></span></button>
                                        </div>
                                    </div>
                                    <div class="cost-total"><i>€</i><span>2394</span></div>
                                    <div class="product-options only-mobile">
                                        <div class="input-label with-icon">Options <b></b></div>
                                        <ul>
                                            <li>Size: <span>Small bed</span></li>
                                            <li>Bed kleur bolletjes: <span>goud</span></li>
                                            <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                            <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                            <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="remove-product"></div>
                            </div>
                            <div class="cart-product-item product-promotion" data-price-product="1346">
                                <div class="left-block">
                                    <a href="product-detail.html">
                                        <span class="bg bg-lazy-load" style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);" data-bg="<?php echo get_template_directory_uri(); ?>/img/cart-product-2.jpg"></span>
                                    </a>
                                </div>
                                <div class="right-block">
                                    <div class="product-info">
                                        <h6 class="title h6 product-title"><a href="product-detail.html">Meisjesbed prinsessenbed - bank</a></h6>
                                        <div class="product-col-price">
                                            <div class="color-wrapp red"><i></i>Red</div>
                                        </div>
                                        <div class="product-options">
                                            <div class="input-label with-icon">Options <b></b></div>
                                            <ul>
                                                <li>Size: <span>Small bed</span></li>
                                                <li>Bed kleur bolletjes: <span>goud</span></li>
                                                <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                                <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                                <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="cost-amount">
                                        <div class="custom-input-number">
                                            <button type="button" class="decrement"><span></span></button>
                                            <input type="number" class="input-field" step="1" value="6" min="1" max="999" readonly="">
                                            <button type="button" class="increment"><span></span></button>
                                        </div>
                                    </div>
                                    <div class="cost-total"><i>€</i><span>2394</span></div>
                                    <div class="product-options only-mobile">
                                        <div class="input-label with-icon">Options <b></b></div>
                                        <ul>
                                            <li>Size: <span>Small bed</span></li>
                                            <li>Bed kleur bolletjes: <span>goud</span></li>
                                            <li>Bed lade: <span>met lade</span> <i>+ €109</i></li>
                                            <li>Bed lattenbodem: <span>met lattenbodem</span><i>+ €25,00</i></li>
                                            <li>Bed ledstrip: <span>ledstrip met gekleurd licht</span><i>+ €30</i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="remove-product"></div>
                            </div>
                        </div>
                        <div class="cart-product-total">
                            <div class="product-total-wrapp">
                                <div class="product-total-text">Subtotal</div>
                                <div class="order-amount"><i>€</i><span>6888</span></div>
                            </div>
                            <div class="button size-2 style-2 full-width popup-close"><span>Save Changes</span></div>
                        </div>
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

<?php wp_footer(); ?>
<?php if (is_page_template( 'page-contact.php' )): ?>
    <!-- MAP -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDco0U55FmAwh-agzHOdEirnnduhdy7Nyo"></script>
    <script src="<?php bloginfo("template_directory"); ?>/js/map.js"></script>
    <!-- MAP -->
<?php endif; ?>
</body>
</html>
