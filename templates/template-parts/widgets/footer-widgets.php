<?php
/**
 * Footer widgets area
 *
 * @package    Go_Further
 * @subpackage Templates
 * @category   Asides
 * @since      1.0.0
 */

namespace GoFurther;

// Alias namespaces.
use GoFurther\Classes\Front     as Front,
	GoFurther\Classes\Customize as Customize;

?>
<aside id="secondary" class="footer-widgets">
	<?php dynamic_sidebar( 'footer' ); ?>
</aside>
