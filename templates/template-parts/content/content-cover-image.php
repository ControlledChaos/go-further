<?php
/**
 * Content template for post type: page
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace GoFurther;

// Alias namespaces.
use GoFurther\Classes\Front as Front;

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="post__thumbnail <?php echo Front\tags()->featured_class(); ?>">
			<?php the_post_thumbnail(); ?>

			<?php Front\tags()->page_title(); ?>
		</figure>
	<?php endif; ?>

	<div class="<?php \Go\content_wrapper_class( 'content-area__wrapper' ); ?>">
		<div class="content-area entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
	</div>

</article>
