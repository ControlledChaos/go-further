<?php
/**
 * Blog redirect template
 *
 * Redirects to site URL. Use for blog page when
 * reading settings are set to latest posts.
 *
 * Template Name: Blog Redirect
 * Template Post Type: page
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Page Templates
 * @since      1.0.0
 */

if ( ! is_user_logged_in() && ! current_user_can( 'edit_pages' ) ) :
	wp_safe_redirect( site_url( '/' ), '302', get_bloginfo( 'name' ) );
else :

get_header();

// Start the Loop.
while ( have_posts() ) :
	the_post();
	get_template_part( 'partials/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile;

get_footer();

endif;
