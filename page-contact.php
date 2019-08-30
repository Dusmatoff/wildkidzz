<?php
/**
 * Template Name: Contact
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
get_header();
// Get ACF
$contact_title = get_field('contact_title');
$contact_text = get_field('contact_text');
$contact_phones = get_field('contact_phones');
$contact_emails = get_field('contact_emails');
$callout_title = get_field('callout_title');
$callout_subtitle = get_field('callout_subtitle');
$form_title = get_field('form_title');
$form_subtitle = get_field('form_subtitle');
$map_lat = get_field('map_lat');
$map_lng = get_field('map_lng');
$map_icon = get_field('map_icon');
$map_address = get_field('map_address');
$callout_form_shortcode = get_field('callout_form_shortcode');
$question_form_shortcode = get_field('question_form_shortcode');
?>

    <!-- CONTACT -->
    <div class="section margin-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-4 offset-xl-1">
                    <div class="contact-all-info">
                        <?php if ($contact_title): ?>
                            <div class="title-decor">
                                <div class="title-wrapp">
                                    <h3 class="title h3 sm"><?php echo $contact_title; ?></h3>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($contact_text): ?>
                            <div class="simple-text size-2">
                                <p><?php echo $contact_text; ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="contact-info-wrapp">
                            <?php
                            if (have_rows('contact_addresses')):
                                while (have_rows('contact_addresses')) : the_row();
                                    $contact_addresses_icon = get_sub_field('contact_addresses_icon');
                                    $contact_addresses_label = get_sub_field('contact_addresses_label');
                                    $contact_addresses_value = get_sub_field('contact_addresses_value');
                                    ?>
                                    <div class="contact-info-item">
                                        <?php if ($contact_addresses_icon): ?><span class="icon img-lazy-load"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                                                    data-src="<?php echo $contact_addresses_icon['url']; ?>"
                                                    alt="<?php echo $contact_addresses_icon['alt']; ?>">
                                            </span><?php endif; ?>
                                        <?php if ($contact_addresses_label): ?>
                                            <div class="contact-title"><?php echo $contact_addresses_label; ?></div><?php endif; ?>
                                        <?php if ($contact_addresses_value): ?>
                                            <div class="contact-info"><p><?php echo $contact_addresses_value; ?></p>
                                            </div><?php endif; ?>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            ?>

                            <?php
                            if (have_rows('contact_phones')):
                                while (have_rows('contact_phones')) : the_row();
                                    $contact_phones_icon = get_sub_field('contact_phones_icon');
                                    $contact_phones_label = get_sub_field('contact_phones_label');
                                    $contact_phones_value = get_sub_field('contact_phones_value');
                                    ?>
                                    <div class="contact-info-item">
                                        <?php if ($contact_phones_icon): ?><span class="icon img-lazy-load"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                                                    data-src="<?php echo $contact_phones_icon['url']; ?>"
                                                    alt="<?php echo $contact_phones_icon['alt']; ?>">
                                            </span><?php endif; ?>
                                        <?php if ($contact_phones_label): ?>
                                            <div class="contact-title"><?php echo $contact_phones_label; ?></div><?php endif; ?>
                                        <?php if ($contact_phones_value): ?>
                                            <div class="contact-info"><a
                                                    href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', $contact_phones_value); ?>"><?php echo $contact_phones_value; ?></a>
                                            </div><?php endif; ?>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            ?>

                            <?php
                            if (have_rows('contact_emails')):
                                while (have_rows('contact_emails')) : the_row();
                                    $contact_emails_icon = get_sub_field('contact_emails_icon');
                                    $contact_emails_label = get_sub_field('contact_emails_label');
                                    $contact_emails_value = get_sub_field('contact_emails_value');
                                    ?>
                                    <div class="contact-info-item">
                                        <?php if ($contact_emails_icon): ?><span class="icon img-lazy-load"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                                                    data-src="<?php echo $contact_emails_icon['url']; ?>"
                                                    alt="<?php echo $contact_emails_icon['alt']; ?>">
                                            </span><?php endif; ?>
                                        <?php if ($contact_emails_label): ?>
                                            <div class="contact-title"><?php echo $contact_emails_label; ?></div><?php endif; ?>
                                        <?php if ($contact_emails_value): ?>
                                            <div class="contact-info"><a
                                                    href="mailto:<?php echo $contact_emails_value; ?>"><?php echo $contact_emails_value; ?></a>
                                            </div><?php endif; ?>
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                        <?php get_template_part('template-parts/social'); ?>
                        <div class="back-call">
                            <div class="simple-item">
                                <?php if ($callout_title): ?>
                                    <div class="h6 title"><?php echo $callout_title; ?></div><?php endif; ?>
                                <?php if ($callout_subtitle): ?>
                                    <div class="simple-text size-3"><p><?php echo $callout_subtitle; ?></p>
                                    </div><?php endif; ?>
                            </div>
                            <?php echo $callout_form_shortcode ? do_shortcode($callout_form_shortcode) : '';  ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="contact-form">
                        <div class="simple-item">
                            <?php if ($form_title): ?>
                                <div class="h5 title"><?php echo $form_title; ?></div><?php endif; ?>
                            <?php if ($form_subtitle): ?>
                                <div class="simple-text size-3"><p><?php echo $form_subtitle; ?></p>
                                </div><?php endif; ?>
                        </div>
                        <?php echo $question_form_shortcode ? do_shortcode($question_form_shortcode) : '';  ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-space size-3"></div>
    </div>

<?php if ($map_lat && $map_lng): ?>
    <!-- MAP -->
    <div class="section">
        <div class="map-block" id="map" data-lat="<?php echo $map_lat; ?>" data-lng="<?php echo $map_lng; ?>"
             data-zoom="13"></div>
        <?php if ($map_icon && $map_address): ?>
            <div class="addresses-block">
                <a data-lat="<?php echo $map_lat; ?>" data-lng="<?php echo $map_lng; ?>"
                   data-marker="<?php echo $map_icon; ?>" data-string="
					<div class='map-content-wrapp'>
			    	<div class='map-content'>
			    		<div class='marker-title'><?php echo $map_address; ?></div>
			    	</div>
			    </div>">
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php get_footer(); ?>