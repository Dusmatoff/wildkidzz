<?php
/**
 * Template Name: Reviews
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
get_header();
?>

    <!-- REVIEWS -->
    <div class="section margin-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-6 offset-xl-3">
                    <div class="simple-item text-center">
                        <div class="title-decor">
                            <div class="title-wrapp">
                                <h3 class="title h3 sm"><?php the_title(); ?></h3>
                            </div>
                        </div>
                        <?php $reviews_page_text = get_field('reviews_page_text'); if ($reviews_page_text): ?>
                            <div class="simple-text size-2">
                                <p><?php echo $reviews_page_text; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php
            // Protect against arbitrary paged values
            $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
            $reviews_count = get_field('reviews_count');
            $args = array(
                'post_type' => 'review',
                'post_status' => 'publish',
                'posts_per_page' => $reviews_count,
                'paged' => $paged,
            );

            $the_query = new WP_Query($args);
            ?>
            <div class="row">
                <div class="col-12 col-xl-10 offset-xl-1">
                    <div class="reviews-wrapps">
                        <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); $review_author = get_field('review_author'); ?>
                            <div class="reviews-item">
                                <div class="row align-items-lg-center">
                                    <div class="col-12 col-lg-5">
                                        <div class="review-img parallax-bg">
                                            <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
                                                 style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                                 data-bg="<?php echo get_the_post_thumbnail_url(); ?>"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="review-content">
                                            <div class="h5 title"><?php the_title(); ?></div>
                                            <div class="rewiew-text">
                                                <div class="simple-text size-2"><?php the_content(); ?></div>
                                            </div>
                                            <div class="review-author-date">
                                                <?php if ($review_author): ?><div class="review-author"><?php echo $review_author; ?></div><?php endif; ?>
                                                <div class="review-date"><?php echo get_the_date('M, Y'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="section-space size-4"></div>
                    <div class="custom-pagination">
                        <?php
                        echo paginate_links(array(
                            'format'  => 'page/%#%',
                            'type'    => 'list',
                            //'current' => $paged,
                            'total'   => $the_query->max_num_pages,
                            'end_size'  => 3,
                            'mid_size' => 1,
                            'prev_next' => true,
                            'prev_text' => '',
                            'next_text' => ''
                        ));
                        ?>
                    </div>
                    <?php else: ?>
                        <div class="simple-text size-2"><?php esc_html_e( 'Nothing found', 'wildkidzz' ) ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php wp_reset_query(); ?>
        </div>
        <div class="section-space size-2"></div>
    </div>

<?php
get_footer();
