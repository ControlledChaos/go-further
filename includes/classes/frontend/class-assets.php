<?php
/**
 * Frontend assets
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace GoFurther\Classes\Front;

// Alias namespaces.
use GoFurther\Classes\Core as Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Assets {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Frontend scripts.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_scripts' ] );

		// Frontend styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'frontend_styles' ] );

		// Print footer scripts.
		add_action( 'wp_footer', [ $this, 'print_scripts' ] );
	}

	/**
	 * Frontend scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {}

	/**
	 * Frontend styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function frontend_styles() {

		/**
		 * Theme stylesheet
		 *
		 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
		 * The main stylesheet, in the root directory, only contains the theme header but
		 * it is necessary for theme activation. DO NOT delete the main stylesheet!
		 */
		wp_enqueue_style( 'go-further', get_theme_file_uri( '/assets/css/style' . $this->suffix() . '.css' ), [ 'go-style' ], GFT_VERSION, 'all' );

		// Right-to-left languages.
		if ( is_rtl() ) {
			wp_enqueue_style( 'go-further-rtl', get_theme_file_uri( 'assets/css/style-rtl' . $this->suffix() . '.css' ), [ 'go-further' ], GFT_VERSION, 'all' );
		}

		// Block styles.
		if ( function_exists( 'has_blocks' ) ) {
			wp_enqueue_style( 'go-further-blocks', get_theme_file_uri( '/assets/css/blocks' . $this->suffix() . '.css' ), [ 'wp-block-library', 'go-further' ], GFT_VERSION, 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'go-further-blocks-rtl', get_theme_file_uri( '/assets/css/blocks-rtl' . $this->suffix() . '.css' ), [ 'go-further-blocks' ], GFT_VERSION, 'all' );
			}
		}

		// Print styles.
		wp_enqueue_style( 'go-further-print', get_theme_file_uri( '/assets/css/print' . $this->suffix() . '.css' ), [], GFT_VERSION, 'print' );
	}

	/**
	 * Print footer scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function print_scripts() {}

	/**
	 * File suffix
	 *
	 * Adds the `.min` filename suffix if
	 * the system is not in debug mode.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $suffix The string returned
	 * @return string Returns the `.min` suffix or
	 *                an empty string.
	 */
	public function suffix() {

		// If in one of the debug modes do not minify.
		if (
			( defined( 'WP_DEBUG' ) && WP_DEBUG ) ||
			( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
		) {
			$suffix = '';
		} else {
			$suffix = '.min';
		}

		// Return the suffix or not.
		return $suffix;
	}
}
