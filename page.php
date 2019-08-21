<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wildkidzz
 */

get_header();
?>

		<?php
		while ( have_posts() ) :
			the_post();

            if(is_checkout()){
                get_template_part('template-parts/content', 'checkout');
            } else {
                get_template_part('template-parts/content', 'page');
            }

		endwhile; // End of the loop.
		?>


<?php
get_footer();
