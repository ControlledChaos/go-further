<?php
/**
 * Load theme assets
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Assets
 */

namespace GoFurther\Assets;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Apply functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'wp_enqueue_scripts', $n( 'toolbar_styles' ) );
	add_action( 'admin_enqueue_scripts', $n( 'toolbar_styles' ), 99 );
	add_action( 'login_enqueue_scripts', $n( 'login_styles' ) );
	add_action( 'wp_head', $n( 'embed_styles' ) );
}

/**
 * File suffix
 *
 * Adds the `.min` filename suffix if
 * the system is not in debug mode.
 *
 * @since  1.0.0
 * @return string Returns the `.min` suffix or
 *                an empty string.
 */
function suffix() {

	$suffix = '.min';
	if (
		( defined( 'WP_DEBUG' ) && WP_DEBUG ) ||
		( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG )
	) {
		$suffix = '';
	}
	return $suffix;
}

/**
 * Toolbar styles
 *
 * Enqueues if user is logged in and user toolbar is showing.
 *
 * @since  1.0.0
 * @return void
 */
function toolbar_styles() {

	if ( is_user_logged_in() && is_admin_bar_showing() ) {
		wp_enqueue_style( 'gf-toolbar', get_theme_file_uri( '/assets/css/toolbar' . suffix() . '.css' ), [], GF_VERSION, 'screen' );
	}
}

/**
 * Login styles
 *
 * @since  1.0.0
 * @return void
 */
function login_styles() {
	wp_enqueue_style( 'gf-login', get_theme_file_uri( '/assets/css/login' . suffix() . '.css' ), [ 'login' ], GF_VERSION, 'screen' );
}

/**
 * Embedded content styles
 *
 * @since  1.0.0
 * @return void
 */
function embed_styles() {

	if ( ! is_admin() ) {
		wp_enqueue_style( 'gf-embed', get_theme_file_uri( '/assets/css/embed' . suffix() . '.css' ), [], GF_VERSION, 'screen' );
	}
}
