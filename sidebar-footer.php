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
use GoFurther\Front as Front;

if ( Front\has_active_footer_sidebars() ) :

do_action( 'GoFurther\before_footer_sidebar' );

?>
<aside id="footer-widgets" class="<?php echo Front\footer_widgets_class(); ?>" role="complementary">
	<div class="footer-widgets-wrapper">
		<?php
		do_action( 'GoFurther\before_footer_widgets' );
		Front\footer_widgets();
		do_action( 'GoFurther\after_footer_widgets' );
		?>
	</div>
</aside>
<?php

do_action( 'GoFurther\after_footer_sidebar' );

endif;
