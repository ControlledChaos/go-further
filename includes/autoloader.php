<?php
/**
 * Class autoloader
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace GoFurther;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'GFT_CLASS', [
	'core'       => GFT_PATH . 'includes/classes/core/class-',
	'settings'   => GFT_PATH . 'includes/classes/settings/class-',
	'tools'      => GFT_PATH . 'includes/classes/tools/class-',
	'media'      => GFT_PATH . 'includes/classes/media/class-',
	'users'      => GFT_PATH . 'includes/classes/users/class-',
	'navigation' => GFT_PATH . 'includes/classes/navigation/class-',
	'widgets'    => GFT_PATH . 'includes/classes/widgets/class-',
	'vendor'     => GFT_PATH . 'includes/classes/vendor/class-',
	'admin'      => GFT_PATH . 'includes/classes/backend/class-',
	'front'      => GFT_PATH . 'includes/classes/frontend/class-',
	'customize'  => GFT_PATH . 'includes/classes/customizer/class-',
	'general'    => GFT_PATH . 'includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'GFT_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this theme you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'GFT_CLASSES', [

	// Core classes.
	GFT_CLASS_NS . '\Core\Assets' => GFT_CLASS['core'] . 'assets.php',
	GFT_CLASS_NS . '\Core\Setup'  => GFT_CLASS['core'] . 'setup.php',

	// Frontend classes.
	GFT_CLASS_NS . '\Front\Template_Tags'   => GFT_CLASS['front'] . 'template-tags.php',
	GFT_CLASS_NS . '\Front\Theme_Templates' => GFT_CLASS['front'] . 'theme-templates.php',
	GFT_CLASS_NS . '\Front\Assets'          => GFT_CLASS['front'] . 'assets.php',
] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( GFT_CLASSES[ $class ] ) ) {
			require GFT_CLASSES[ $class ];
		}
	}
);
