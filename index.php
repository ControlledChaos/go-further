<?php
/**
 * The main template file
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
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
		get_template_part( 'partials/content', get_post_type() );
	endwhile;

	// Previous/next page navigation.
	get_template_part( 'partials/pagination' );

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'partials/content', 'none' );
}

get_footer();
