<?php
/**
 * Footer template
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace GoFurther;

// Alias namespaces.
use GoFurther\Classes\Front     as Front,
	GoFurther\Classes\Customize as Customize;

?>

	</main>

	<?php get_sidebar( 'footer' ); ?>

	<?php \Go\footer_variation(); ?>

	</div>

	<?php wp_footer(); ?>

	</body>
</html>