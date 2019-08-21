<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wildkidzz
 */

?>

<!-- SIMPLE TEXT -->
<div class="section margin-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="simple-item text-center">
                    <div class="title-decor not-decor margin-2">
                        <div class="title-wrapp">
                            <h3 class="title h3"><?php the_title(); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                <div class="simple-item simple-page">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="section-space size-2"></div>
</div>


