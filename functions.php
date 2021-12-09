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
use
GoFurther\Classes            as General,
GoFurther\Classes\Activate   as Activate,
GoFurther\Classes\Core       as Core,
GoFurther\Classes\Front      as Front,
GoFurther\Classes\Navigation as Navigation,
GoFurther\Classes\Widgets    as Widgets,
GoFurther\Classes\Media      as Media,
GoFurther\Classes\Admin      as Admin,
GoFurther\Classes\Customize  as Customize,
GoFurther\Classes\Vendor     as Vendor;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get theme configuration file.
require get_theme_file_path( '/includes/config.php' );

// Autoload class files.
require_once GFT_PATH . 'includes/autoloader.php';

// Theme setup.
new Core\Setup;
new Core\Assets;
new Customize\Customizer;

// Media classes.
new Media\Images;

// Frontend classes.
if ( ! is_admin() ) {
	new Front\Assets;
}

// Backend classes.
if ( is_admin() ) {
	new Admin\Editor_Styles;
	new Admin\Post_Options;
}

require_once get_theme_file_path( '/includes/template-tags.php' );
