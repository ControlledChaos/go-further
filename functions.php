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
 * @link       https://github.com/ControlledChaos/go-further
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
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

// Get the PHP version class.
require_once get_theme_file_path( '/includes/classes/core/class-php-version.php' );

/**
 * PHP version check
 *
 * Disables theme front end if the minimum PHP version is not met.
 * Prevents breaking sites running older PHP versions.
 *
 * @since  1.0.0
 * @return void
 */
if ( ! Core\php()->version() && ! is_admin() ) {

	// Get the conditional message.
	$die = Core\php()->frontend_message();

	// Print the die message.
	die( $die );
}

/**
 * Get plugins path
 *
 * Used to check for active plugins with the `is_plugin_active` function.
 * Namespace escaped in example ( \ ) as it sometimes causes an error.
 *
 * @link https://developer.wordpress.org/reference/functions/is_plugin_active/
 *
 * @example The following would check for the Advanced Custom Fields plugin:
 *          ```
 *          if ( \is_plugin_active( 'advanced-custom-fields/acf.php' ) ) {
 *          	// Execute code.
 *           }
 *          ```
 */
$get_plugin = ABSPATH . 'wp-admin/includes/plugin.php';
if ( file_exists( $get_plugin ) ) {
	include_once( $get_plugin );
}

// Get theme configuration file.
require get_theme_file_path( '/includes/config.php' );

// Autoload class files.
require_once GFT_PATH . 'includes/autoloader.php';

// Theme setup.
$gft_core_setup   = new Core\Setup;
$gft_core_assets  = new Core\Assets;

// Frontend classes.
if ( ! is_admin() ) {
	$gft_assets = new Front\Assets;
}
