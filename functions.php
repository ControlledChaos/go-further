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

// Run setup functions.
Core\setup();
Customize\setup();
Media\setup();
Options\setup();
Assets\setup();

if ( is_admin() ) {
	Editor\setup();
}
