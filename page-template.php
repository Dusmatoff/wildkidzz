<?php
/**
 * Created by PhpStorm.
 * User: Dusmatoff
 * Date: 15.08.2019
 * Time: 16:49
 * Template Name: Template
 */
if (!defined('ABSPATH')) exit; // Exit if accessed directly
get_header();
get_template_part('template-parts/flexible'); ?>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8 offset-xl-2">
                    <div class="section-space size-5"></div>
                    <div class="separator color-2"></div>
                    <div class="section-space size-7"></div>
                    <?php get_template_part('template-parts/share'); ?>
                </div>
            </div>
        </div>
        <div class="section-space size-2"></div>
    </div>
<?php
get_footer();
?>