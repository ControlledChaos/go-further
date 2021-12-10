<?php
/**
 * The main template file
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace GoFurther;

// Alias namespaces.
use GoFurther\Front as Front;

// Get blog settings.
$blog          = (int) get_option( 'page_for_posts' );
$blog_image    = get_theme_mod( 'gf_blog_image' );
$display_image = Front\display_blog_image();
$has_image     = Front\blog_has_image();

$image = '';
if ( $blog && has_post_thumbnail( $blog ) ) {
	$image = get_the_post_thumbnail_url( $blog, 'full' );
} elseif ( $blog_image ) {
	$image = $blog_image;
}

get_header();

/**
 * Featured image on the first page of the blog if
 * an ID for the blog page is set.
 */
if ( $display_image && $has_image ) :

?>
	<figure class="post__thumbnail <?php echo Front\featured_class(); ?>">
		<img src="<?php echo $image; ?>" alt="">
		<?php Front\page_title(); ?>
	</figure>
<?php

endif;

if ( ! $display_image && Front\blog_first_page() ) {
	Front\page_title();
}

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
