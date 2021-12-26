<?php
/**
 * Admin functions
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace GoFurther\Admin;

// Alias namespaces.
use GoFurther\Front     as Front,
	GoFurther\Customize as Customize,
	GoFurther\Styles    as Styles,
	GoFurther\Assets    as Assets;

/**
 * Apply functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	// add_action( 'hook', $n( 'function' ) );
}
