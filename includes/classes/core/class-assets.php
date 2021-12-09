<?php
/**
 * Assets class
 *
 * Methods for enqueueing and printing assets
 * such as JavaScript and CSS files.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Core
 * @since      1.0.0
 */

namespace GoFurther\Classes\Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

final class Assets {

	/**
	 * Plugin version
	 *
	 * @since  1.0.0
	 * @access private
	 * @var    string The version number.
	 */
	private $version = GF_VERSION;

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Toolbar styles.
		add_action( 'wp_enqueue_scripts', [ $this, 'toolbar_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'toolbar_styles' ], 99 );

		// Login styles.
		add_action( 'login_enqueue_scripts', [ $this, 'login_styles' ] );

		// Embedded content styles.
		add_action( 'wp_head', [ $this, 'embed_styles' ] );
	}

	/**
	 * Toolbar styles
	 *
	 * Enqueues if user is logged in and user toolbar is showing.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function toolbar_styles() {

		if ( is_user_logged_in() && is_admin_bar_showing() ) {
			wp_enqueue_style( 'go-further-toolbar', get_theme_file_uri( '/assets/css/toolbar' . $this->suffix() . '.css' ), [], GF_VERSION, 'screen' );
		}
	}

	/**
	 * Login styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function login_styles() {
		wp_enqueue_style( 'go-further-login', get_theme_file_uri( '/assets/css/login' . $this->suffix() . '.css' ), [ 'login' ], GF_VERSION, 'screen' );
	}

	/**
	 * Embedded content styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function embed_styles() {
		wp_enqueue_style( 'go-further-embed', get_theme_file_uri( '/assets/css/embed' . $this->suffix() . '.css' ), [], GF_VERSION, 'screen' );
	}

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
