<?php
/**
 * Editor stylesheets
 *
 * Forces reload of WordPress & ClassicPress rich text (classic) editor stylesheets.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace GoFurther\Classes\Admin;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Editor_Styles {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Add fresh editor styles.
		add_filter( 'mce_css', [ $this, 'fresh_editor_style' ] );
	}

	/**
	 * Fresh editor styles
	 *
	 * Add sa parameter of the last modified time to all editor stylesheets.
	 *
	 * Modified copy of `_WP_Editors::editor_settings()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $css Comma separated stylesheet URIs
	 * @return string
	 */
	public function fresh_editor_style( $css ) {

		global $editor_styles;

		if ( empty ( $css ) or empty ( $editor_styles ) ) {
			return $css;
		}

		$mce_css = [];

		// Load parent theme styles first, so the child theme can overwrite it.
		if ( is_child_theme() )	{
			$this->refill_editor_styles(
				$mce_css,
				get_template_directory(),
				get_template_directory_uri()
			);
		}

		$this->refill_editor_styles(
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
	 * @access public
	 * @param  array  $mce_css Passed by reference.
	 * @param  string $dir
	 * @param  string $uri
	 * @return void
	 */
	public function refill_editor_styles( &$mce_css, $dir, $uri ) {

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
}
