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

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'GFT_CLASS', [
	'general' => get_stylesheet_directory() . '/includes/classes/class-',
	'core'    => get_stylesheet_directory() . '/includes/classes/core/class-'
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
	GFT_CLASS_NS . '\Core\Setup'  => GFT_CLASS['core'] . 'setup.php',

	// Backend classes.
	GFT_CLASS_NS . '\Admin\Editor_Styles' => GFT_CLASS['general'] . 'editor-styles.php'
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
