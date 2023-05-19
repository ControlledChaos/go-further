<?php
/**
 * Cover image template
 *
 * The template for displaying full intro cover images
 * on supported post types' singular pages.
 *
 * Template Name: Cover Image
 * Template Post Type: page, post, event, product
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Page Templates
 * @since      1.0.0
 */

get_header();

// Start the Loop.
while ( have_posts() ) :

	the_post();

	// Only get the cover image partial if the post has a featured image attached.
	if ( has_post_thumbnail() ) {
		get_template_part( 'templates/template-parts/content/content', 'cover-image' );
	} else {
		get_template_part( 'templates/template-parts/content/content', get_post_type() );
	}

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

endwhile;

get_footer();
