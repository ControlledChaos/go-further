<?php
/**
 * Go Further theme functions
 *
 * A child theme of GoDaddy's Go theme.
 *
 * @package    Go_Further
 * @subpackage Functions
 * @since      1.0.0
 *
 * @link https://github.com/ControlledChaos/go-further
 */

namespace GoFurther;

/**
 * Constant: Theme version
 *
 * @since 1.0.0
 * @var   string The latest theme version.
 */
$theme_version = wp_get_theme()->get( 'Version' );
define( 'GF_VERSION', $theme_version );

// Load required files.
foreach ( glob( get_stylesheet_directory() . '/includes/*.php' ) as $filename ) {
	require_once $filename;
}

// Theme setup.
new Classes\Core\Setup;

Customize\setup();
Media\setup();
Options\setup();
Assets\setup();

// Backend classes.
if ( is_admin() ) {
	new Classes\Admin\Editor_Styles;
}
