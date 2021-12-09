<?php
/**
 * Theme configuration
 *
 * The constants defined here do not override any default behavior
 * or default user interfaces. However, the corresponding behavior
 * can be overridden in the system config file (e.g. `wp-config`,
 * `app-config` ).
 *
 * The reason for using constants in the config file rather than
 * in a settings file is to prevent site administrators wrongly
 * or incorrectly configuring the site built by developers.
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Configuration
 * @since      1.0.0
 */

namespace GoFurther;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Constant: Theme version
 *
 * Keeping the version at 1.0.0 as this is a starter theme but
 * you may want to start counting as you develop for your use case.
 *
 * Remember to find and replace the `@version x.x.x` in docblocks.
 *
 * @since 1.0.0
 * @var   string The latest theme version.
 */
$theme_version = wp_get_theme()->get( 'Version' );
define( 'GFT_VERSION', $theme_version );

/**
 * Constant: Theme file path
 *
 * @since 1.0.0
 * @var   string File path with trailing slash.
 */
$theme_path = get_stylesheet_directory();
define( 'GFT_PATH', $theme_path . '/' );

/**
 * Constant: Templates directory
 *
 * @since 1.0.0
 * @var   string File path without trailing slash.
 */
$templates_dir = 'templates';
define( 'GFT_TMPL_DIR', $templates_dir );

/**
 * Constant: Template partials directory
 *
 * @since 1.0.0
 * @var   string File path without trailing slash.
 */
$parts_dir = GFT_TMPL_DIR . '/template-parts';
define( 'GFT_PARTS_DIR', $parts_dir );

/**
 * Constant: Theme file URL
 *
 * @since 1.0.0
 * @var   string
 */
$theme_url = get_template_directory_uri();
define( 'GFT_URL', $theme_url );

/**
 * Check for block editor
 *
 * @since  1.0.0
 * @access public
 * @global integer $wp_version
 * @return boolean Returns false if ClassicPress or
 *                 if WordPress is less than 5.0.
 *                 Default is true.
 */
function gft_has_blocks() {

	// Get WordPress version.
	global $wp_version;

	// Simple check for ClassicPress.
	if ( function_exists( 'classicpress_version' ) ) {
		return false;

	// Compare WordPress version to less than 5.0 (introduction of blocks).
	} elseif ( version_compare( $wp_version,'4.9.9' ) <= 0 ) {
		return false;
	}

	// Default is true.
	return true;
}
