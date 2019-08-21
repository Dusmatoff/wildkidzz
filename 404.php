<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wildkidzz
 */

get_header();
?>
    <!-- 404 -->
    <div class="section">
        <div class="banner-align full size-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                        <div class="simple-item not-found">
                            <div class="not-found-title">404</div>
                            <div class="title h3"><?php esc_html_e( 'Page not found', 'wildkidzz' ) ?></div>
                            <div class="simple-text size-2">
                                <p><?php esc_html_e( 'Sorry, but we have trouble finding the page you are requesting', 'wildkidzz' ) ?></p>
                            </div>
                            <a href="<?php echo site_url(); ?>" class="button"><?php esc_html_e( 'Back to main page', 'wildkidzz' ) ?><span></span><i></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
