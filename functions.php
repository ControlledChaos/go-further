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

// Alias namespaces.
use GoFurther\Core as Core,
	GoFurther\Media as Media,
	GoFurther\Post_Options as Options,
	GoFurther\Customize    as Customize,
	GoFurther\Assets as Assets,
	GoFurther\Classes\Core       as Core_Classes,
	GoFurther\Classes\Front      as Front_Classes,
	GoFurther\Classes\Admin      as Admin_Classes,
	GoFurther\Classes\Customize  as Customize_Classes;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
new Core_Classes\Setup;

Customize\setup();
Media\setup();
Options\setup();
Assets\setup();

// Backend classes.
if ( is_admin() ) {
	new Admin_Classes\Editor_Styles;
}
