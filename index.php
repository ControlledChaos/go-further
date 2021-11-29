<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Go
 */

// Get blog data.
$blog  = (int) get_option( 'page_for_posts' );
$paged = get_query_var( 'paged' );

get_header();

/**
 * Featured image on the first page of the blog if
 * an ID for the blog page is set.
 */
if (
	$blog && is_main_query() &&
	( ! is_paged() || ( is_paged() && 1 == $paged ) ) &&
	has_post_thumbnail( $blog )
) : ?>
	<figure class="post__thumbnail page-banner">
		<?php echo get_the_post_thumbnail( $blog ); ?>
	</figure>
<?php endif;

Go\page_title();

if ( have_posts() ) {

	// Start the Loop.
	while ( have_posts() ) :
		the_post();
		get_template_part( 'partials/content' );
	endwhile;

	// Previous/next page navigation.
	get_template_part( 'partials/pagination' );

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'partials/content', 'none' );
}

get_footer();
