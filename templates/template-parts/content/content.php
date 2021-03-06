<?php
/**
 * Template part for displaying posts
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace GoFurther;

use GoFurther\Front as Front;

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if ( is_singular() && has_post_thumbnail() ) : ?>
		<figure class="post__thumbnail page-banner <?php echo Front\featured_class(); ?>">
			<?php the_post_thumbnail( 'post-thumbnail' ); ?>
		</figure>
	<?php endif; ?>

	<header class="entry-header m-auto px">

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="post__title entry-title m-0">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="post__title entry-title m-0"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>

		<?php \Go\post_meta( get_the_ID(), 'top' ); ?>

	</header>

	<?php if ( ! is_singular() && has_post_thumbnail() ) : ?>
		<figure class="post__thumbnail archive-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</figure>
	<?php endif; ?>

	<div class="<?php \Go\content_wrapper_class( 'content-area__wrapper' ); ?>">

		<div class="content-area entry-content">
			<?php
			if ( is_search() || is_archive() || ( get_theme_mod( 'blog_excerpt', false ) && is_home() ) ) {
				the_excerpt();
			} else {
				the_content();
			}
			wp_link_pages(
				[
					'before' => '<nav class="post-nav-links" aria-label="' . esc_attr__( 'Page', 'go' ) . '"><span class="label">' . __( 'Pages:', 'go' ) . '</span>',
					'after'  => '</nav>',
				]
			);
			?>
		</div>

		<?php
		if ( is_singular() ) {
			\Go\post_meta( get_the_ID(), 'single-bottom' );
		}
		?>

	</div>

</article>
