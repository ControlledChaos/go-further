<?php
/**
 * Editor stylesheets
 *
 * Forces reload of WordPress & ClassicPress rich text (classic) editor stylesheets.
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Editor
 * @since      1.0.0
 */

namespace GoFurther\Editor;

use GoFurther\Assets as Assets;

/**
 * Execute functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'after_setup_theme', $n( 'tinymce_editor_style' ) );
	add_filter( 'mce_css', $n( 'fresh_editor_style' ) );
}

/**
 * TinyMCE editor styles
 *
 * @since  1.0.0
 * @return void
 */
function tinymce_editor_style() {
	$suffix = Assets\suffix();
	add_editor_style( "assets/css/editor$suffix.css", [], GF_VERSION, 'screen' );
}

/**
 * Fresh editor styles
 *
 * Add sa parameter of the last modified time to all editor stylesheets.
 *
 * Modified copy of `_WP_Editors::editor_settings()`.
 *
 * @since  1.0.0
 * @param  string $css Comma separated stylesheet URIs
 * @return string
 */
function fresh_editor_style( $css ) {

	global $editor_styles;

	if ( empty ( $css ) or empty ( $editor_styles ) ) {
		return $css;
	}

	$mce_css = [];

	// Load parent theme styles first, so the child theme can overwrite it.
	if ( is_child_theme() )	{
		refill_editor_styles(
			$mce_css,
			get_template_directory(),
			get_template_directory_uri()
		);
	}

	refill_editor_styles(
		$mce_css,
		get_stylesheet_directory(),
		get_stylesheet_directory_uri()
	);

	return implode( ',', $mce_css );
}

/**
 * Refill editor styles
 *
 * Adds version parameter to each stylesheet URI.
 *
 * @since  1.0.0
 * @param  array  $mce_css Passed by reference.
 * @param  string $dir
 * @param  string $uri
 * @return void
 */
function refill_editor_styles( &$mce_css, $dir, $uri ) {

	global $editor_styles;

	foreach ( $editor_styles as $file )	{

		if ( ! $file or ! file_exists( "$dir/$file" ) )	{
			continue;
		}

		$mce_css[] = add_query_arg(
			'version',
			filemtime( "$dir/$file" ),
			"$uri/$file"
		);
	}
}
