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

if ( is_active_sidebar( 'footer' ) ) {
	get_template_part( 'templates/template-parts/widgets/footer-widgets' );
}
