<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
// Check if Flexible Content have blocks
if (have_rows('flexible_content')):
    while (have_rows('flexible_content')) : the_row();
        if (get_row_layout() == 'main_banner'):
            $main_banner_title = get_sub_field('main_banner_title');
            $main_banner_subtitle = get_sub_field('main_banner_subtitle');
            ?>
            <!-- MAIN BANNER -->
            <div class="section banner <?php echo !is_front_page() ? 'bottom-size-2' : 'main-banner'; ?> parallax-bg">
                <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
                     style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                     data-bg="<?php the_sub_field('main_banner_bg'); ?>"></div>
                <div class="opacity"></div>
                <div class="container">
                    <div class="banner-inner">
                        <div class="banner-align <?php echo !is_front_page() ? 'size-2' : ''; ?>">
                            <div class="row">
                                <div class="col-12 col-lg-10 <?php echo !is_front_page() ? 'col-xl-7' : 'col-xl-6'; ?>">
                                    <div class="simple-item banner-info">
                                        <?php if ($main_banner_title): ?><h1
                                                class="h1 title color-2"><?php echo $main_banner_title; ?></h1><?php endif; ?>
                                        <?php if ($main_banner_subtitle): ?>
                                            <div
                                            class="sub-title <?php echo !is_front_page() ? 'size-2' : ''; ?> "><?php echo $main_banner_subtitle; ?></div><?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (get_row_layout() == 'left_text'):
            $left_text_image = get_sub_field('left_text_image');
            $left_text_title = get_sub_field('left_text_title');
            $left_text_subtitle = get_sub_field('left_text_subtitle');
            $left_text_text = get_sub_field('left_text_text');
            $left_text_button_link = get_sub_field('left_text_button_link');
            $left_text_button_text = get_sub_field('left_text_button_text');
            ?>
            <!-- BLOCK LEFT RIGHT -->
            <div class="section">
                <div class="container-fluid">
                    <div class="row align-items-lg-center about-item decor-left">
                        <div class="col-12 col-lg-5 order-lg-2">
                            <div class="decor-about-block-img">
                                <div class="about-block-img parallax-bg">
                                    <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
                                         style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                         data-bg="<?php echo $left_text_image; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-5 offset-xl-1 order-lg-1">
                            <div class="simple-item about-info info-left">
                                <?php if ($left_text_title): ?>
                                    <div class="title-decor">
                                        <div class="title-wrapp">
                                            <h3 class="title h3"><?php echo $left_text_title; ?></h3>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($left_text_subtitle): ?>
                                    <div class="h6 title font-w-2"><?php echo $left_text_subtitle; ?></div><?php endif; ?>
                                <?php if ($left_text_text): ?>
                                    <div class="simple-text size-2">
                                        <?php echo $left_text_text; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($left_text_button_link && $left_text_button_text): ?><a
                                    href="<?php echo $left_text_button_link; ?>" class="button">
                                    <span><?php echo $left_text_button_text; ?></span></a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-space size-2"></div>
            </div>
        <?php elseif (get_row_layout() == 'right_text'):
            $right_text_image = get_sub_field('right_text_image');
            $right_text_title = get_sub_field('right_text_title');
            $right_text_subtitle = get_sub_field('right_text_subtitle');
            $right_text_text = get_sub_field('right_text_text');
            $right_text_button_link = get_sub_field('right_text_button_link');
            $right_text_button_text = get_sub_field('right_text_button_text');
            ?>
            <!-- BLOCK LEFT RIGHT -->
            <div class="section">
                <div class="container-fluid">
                    <div class="row align-items-lg-center about-item decor-right">
                        <div class="col-12 col-lg-5 col-xl-6">
                            <div class="decor-about-block-img">
                                <div class="about-block-img size-2 parallax-bg">
                                    <div class="bg bg-lazy-load rellax" data-rellax-speed="-2"
                                         style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                         data-bg="<?php echo $right_text_image; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-5">
                            <div class="simple-item about-info">
                                <?php if ($right_text_title): ?>
                                    <div class="title-decor">
                                        <div class="title-wrapp">
                                            <h3 class="title h3"><?php echo $right_text_title; ?></h3>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($right_text_subtitle): ?>
                                    <div class="h6 title font-w-2"><?php echo $right_text_subtitle; ?></div><?php endif; ?>
                                <?php if ($right_text_text): ?>
                                    <div class="simple-text size-2">
                                        <?php echo $right_text_text; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($right_text_button_link && $right_text_button_text): ?><a
                                    href="<?php echo $right_text_button_link; ?>" class="button">
                                    <span><?php echo $right_text_button_text; ?></span></a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-space size-2"></div>
            </div>
        <?php elseif (get_row_layout() == 'left_text_small'):
            $left_text_image_small = get_sub_field('left_text_image_small');
            $left_text_title_small = get_sub_field('left_text_title_small');
            $left_text_subtitle_small = get_sub_field('left_text_subtitle_small');
            $left_text_text_small = get_sub_field('left_text_text_small');
            $left_text_button_link_small = get_sub_field('left_text_button_link_small');
            $left_text_button_text_small = get_sub_field('left_text_button_text_small');
            ?>
            <!-- BLOCK LEFT RIGHT -->
            <div class="section">
                <div class="container">
                    <div class="row align-items-lg-center about-item decor-right">
                        <div class="col-12 col-lg-5 order-lg-2">
                            <div class="decor-about-block-img decor-color-2">
                                <div class="about-block-img parallax-bg">
                                    <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
                                         style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                         data-bg="<?php echo $left_text_image_small; ?>"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 col-xl-5 offset-xl-1 order-lg-1">
                            <div class="simple-item about-info info-left">
                                <?php if ($left_text_title_small): ?>
                                    <div class="title-decor">
                                        <div class="title-wrapp">
                                            <h3 class="title h3"><?php echo $left_text_title_small; ?></h3>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($left_text_subtitle_small): ?>
                                    <div class="h6 title font-w-2"><?php echo $left_text_subtitle_small; ?></div><?php endif; ?>
                                <?php if ($left_text_subtitle_small) {
                                    echo $left_text_text_small;
                                } ?>
                                <?php if ($left_text_button_link_small && $left_text_button_text_small): ?><a
                                    href="<?php echo $left_text_button_link_small; ?>" class="button">
                                    <span><?php echo $left_text_button_text_small; ?></span></a><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section-space size-2"></div>
            </div>
        <?php elseif (get_row_layout() == 'block_with_bg'):
            $block_with_bg_image = get_sub_field('block_with_bg_image');
            $block_with_bg_title = get_sub_field('block_with_bg_title');
            $block_with_bg_text = get_sub_field('block_with_bg_text');
            $block_with_bg_button_text = get_sub_field('block_with_bg_button_text');
            $block_with_bg_button_link = get_sub_field('block_with_bg_button_link');
            ?>
            <!-- BLOCK WITH BG -->
            <div class="section ">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="block-with-bg parallax-bg">
                                <div class="bg bg-lazy-load rellax" data-rellax-speed="2"
                                     style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                     data-bg="<?php echo $block_with_bg_image; ?>"></div>
                                <div class="opacity"></div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                                        <div class="simple-item text-center content-block">
                                            <?php if ($block_with_bg_title): ?>
                                                <div class="h3 sm title color-2"><?php echo $block_with_bg_title; ?></div><?php endif; ?>
                                            <?php if ($block_with_bg_text): ?>
                                                <div class="simple-text color-2"><?php echo $block_with_bg_text; ?></div><?php endif; ?>
                                            <?php if ($block_with_bg_button_text && $block_with_bg_button_link): ?><a
                                                href="<?php echo $block_with_bg_button_link; ?>" class="button">
                                                <span><?php echo $block_with_bg_button_text; ?></span>
                                                </a><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (get_row_layout() == 'reviews'):
            $reviews_title = get_sub_field('reviews_title');
            $reviews_button_link = get_sub_field('reviews_button_link');
            $reviews_button_text = get_sub_field('reviews_button_text');
            ?>
            <!-- REVIEWS -->
            <div class="section">
                <div class="container">
                    <?php if ($reviews_title): ?>
                        <div class="row">
                            <div class="col-12 col-xl-6 offset-xl-3">
                                <div class="simple-item text-center">
                                    <div class="title-decor">
                                        <div class="title-wrapp">
                                            <h3 class="title h3 sm"><?php echo $reviews_title; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="reviews-block">
                        <div class="row">
                            <?php
                            $args = array(
                                'post_type' => 'review',
                                'post_status' => 'publish',
                                'posts_per_page' => 3
                            );

                            $the_query = new WP_Query($args);
                            ?>
                            <?php
                            if ($the_query->have_posts()) :
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    ?>
                                    <div class="col-12 col-md-4">
                                        <div class="review-block-item">
                                            <div class="review-block-top">
                                                <div class="review-title"><?php the_title(); ?></div>
                                                <div class="rewiew-text">
                                                    <div class="simple-text size-3"><?php the_content(); ?></div>
                                                </div>
                                            </div>
                                            <?php if (get_field('review_author')): ?>
                                                <div class="review-author"><?php the_field('review_author') ?></div><?php endif; ?>
                                        </div>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            wp_reset_query();
                            ?>
                        </div>
                    </div>
                    <?php if ($reviews_button_link && $reviews_button_text): ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="separator style-2"></div>
                                <div class="section-space size-5"></div>
                                <div class="simple-item text-center">
                                    <a href="<?php echo $reviews_button_link; ?>"
                                       class="button"><span><?php echo $reviews_button_text; ?></span></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="section-space"></div>
            </div>
        <?php elseif (get_row_layout() == 'any_questions'):
            $any_questions_title = get_sub_field('any_questions_title');
            $any_questions_text = get_sub_field('any_questions_text');
            $any_questions_phone = get_sub_field('any_questions_phone');
            $any_questions_date = get_sub_field('any_questions_date');
            $any_questions_image = get_sub_field('any_questions_image');
            ?>
            <!-- ANY QUESTIONS -->
            <div class="section ">
                <div class="container-fluid container-no-padd">
                    <div class="row">
                        <div class="col-12">
                            <div class="block-with-bg style-2 parallax-bg">
                                <div class="bg bg-lazy-load rellax" data-rellax-speed="-2"
                                     style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                     data-bg="<?php echo $any_questions_image; ?>"></div>
                                <div class="opacity"></div>
                                <div class="row">
                                    <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                                        <div class="simple-item text-center any-questions-block">
                                            <?php if ($any_questions_title): ?>
                                                <div class="h3 sm title color-2"><?php echo $any_questions_title; ?></div><?php endif; ?>
                                            <?php if ($any_questions_text): ?>
                                                <div class="simple-text color-3">
                                                    <?php echo $any_questions_text; ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="separator"></div>
                                            <?php if ($any_questions_phone || $any_questions_date): ?>
                                                <div class="tel-and-date">
                                                    <?php if($any_questions_phone): ?><a href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', $any_questions_phone); ?>"><?php echo $any_questions_phone; ?></a><?php endif; ?>
                                                    <?php if($any_questions_date): ?><div class="date"><?php echo $any_questions_date; ?></div><?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (get_row_layout() == 'simple_text'):
            $simple_text_textarea = get_sub_field('simple_text_textarea');
            if ($simple_text_textarea):
                ?>
                <!-- SIMPLE TEXT -->
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                                <div class="simple-item simple-page">
                                    <?php echo $simple_text_textarea; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php elseif (get_row_layout() == 'simple_slider'): ?>
            <!-- SIMPLE SLIDER -->
            <div class="section ">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                            <div class="simple-item simple-page">
                                <div class="swiper-entry simple-slider">
                                    <div class="swiper-button-prev"><i></i></div>
                                    <div class="swiper-button-next"><i></i></div>
                                    <div class="swiper-container"
                                         data-options='{"loop":1, "autoplay": { "delay": 7000 }}'>
                                        <div class="swiper-wrapper">
                                            <?php $simple_slider_images = get_sub_field('simple_slider_images');
                                            if ($simple_slider_images):
                                                foreach ($simple_slider_images as $simple_slider_img): ?>
                                                    <div class="swiper-slide parallax-bg">
                                                        <div class="bg bg-lazy-load rellax" data-rellax-speed="1.4"
                                                             style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                                             data-bg="<?php echo $simple_slider_img['url']; ?>"></div>
                                                    </div>
                                                <?php
                                                endforeach;
                                            endif; ?>
                                        </div>
                                        <div class="swiper-pagination swiper-pagination-relative"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif (get_row_layout() == 'video'):
            $video_bg = get_sub_field('video_bg');
            $video_id = get_sub_field('video_id');
            if ($video_bg && $video_id):
                ?>
                <!-- VIDEO -->
                <div class="section ">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                                <div class="simple-item simple-page">
                                    <div class="simple-video">
                                        <div class="bg bg-lazy-load"
                                             style="background-image: url(<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg);"
                                             data-bg="<?php echo $video_bg; ?>"></div>
                                        <a class="play-button video-open"
                                           href="https://www.youtube.com/embed/<?php echo $video_id ?>?autoplay=1">
                                            <div class="bg"
                                                 style="background-image: url(<?php echo get_template_directory_uri(); ?>/icon/youtube.svg);"></div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php
        endif;
    endwhile;
else :
    // Not found block
endif;
?>