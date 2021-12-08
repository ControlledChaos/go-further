<?php
/**
 * Footer sidebar template
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Content
 * @since      1.0.0
 */

namespace GoFurther;

// Alias namespaces.
use GoFurther\Classes\Front as Front;

if ( Front\tags()->has_active_footer_sidebars() ) :

do_action( 'GoFurther\before_footer_widgets' );

?>
<aside id="footer-widgets" class="<?php echo Front\tags()->footer_widgets_class(); ?>" role="complementary">
	<div class="footer-widgets-wrapper">
		<?php Front\tags()->footer_widgets(); ?>
	</div>
</aside>
<?php

do_action( 'GoFurther\after_footer_widgets' );

endif;
