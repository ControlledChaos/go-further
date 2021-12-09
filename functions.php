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
	GoFurther\Post_Options as Post_Options,
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
require_once get_theme_file_path( '/includes/autoloader.php' );
require_once get_theme_file_path( '/includes/customizer.php' );
require_once get_theme_file_path( '/includes/post-options.php' );
require_once get_theme_file_path( '/includes/template-tags.php' );
require_once get_theme_file_path( '/includes/media.php' );
require_once get_theme_file_path( '/includes/assets.php' );

// Theme setup.
new Core_Classes\Setup;

Customize\setup();
Media\setup();
Post_Options\setup();
Assets\setup();

// Frontend classes.
if ( ! is_admin() ) {
	new Front_Classes\Assets;
}

// Backend classes.
if ( is_admin() ) {
	new Admin_Classes\Editor_Styles;
}
