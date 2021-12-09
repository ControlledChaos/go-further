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

	add_action( 'wp_enqueue_scripts', $n( 'frontend_styles' ) );
	add_action( 'wp_footer', $n( 'print_scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'toolbar_styles' ) );
	add_action( 'admin_enqueue_scripts', $n( 'toolbar_styles' ), 99 );
	add_action( 'login_enqueue_scripts', $n( 'login_styles' ) );
	add_action( 'wp_head', $n( 'embed_styles' ) );
}

/**
 * Frontend styles
 *
 * @since  1.0.0
 * @return void
 */
function frontend_styles() {

	/**
	 * Theme stylesheet
	 *
	 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
	 * The main stylesheet, in the root directory, only contains the theme header but
	 * it is necessary for theme activation. DO NOT delete the main stylesheet!
	 */
	wp_enqueue_style( 'go-further', get_theme_file_uri( '/assets/css/style' . suffix() . '.css' ), [ 'go-style' ], GF_VERSION, 'all' );

	// Right-to-left languages.
	if ( is_rtl() ) {
		wp_enqueue_style( 'go-further-rtl', get_theme_file_uri( 'assets/css/style-rtl' . suffix() . '.css' ), [ 'go-further' ], GF_VERSION, 'all' );
	}

	// Block styles.
	if ( function_exists( 'has_blocks' ) ) {
		wp_enqueue_style( 'go-further-blocks', get_theme_file_uri( '/assets/css/blocks' . suffix() . '.css' ), [ 'wp-block-library', 'go-further' ], GF_VERSION, 'all' );

		if ( is_rtl() ) {
			wp_enqueue_style( 'go-further-blocks-rtl', get_theme_file_uri( '/assets/css/blocks-rtl' . suffix() . '.css' ), [ 'go-further-blocks' ], GF_VERSION, 'all' );
		}
	}

	// Print styles.
	wp_enqueue_style( 'go-further-print', get_theme_file_uri( '/assets/css/print' . suffix() . '.css' ), [], GF_VERSION, 'print' );
}

/**
 * Print footer scripts
 *
 * @since  1.0.0
 * @return void
 */
function print_scripts() {

	?>
	<script>
	// Add class to header on scroll.
	( function($) {
		$(window).scroll( function() {

			if ( $(this).scrollTop() > 0 ) {
				$( '.header' ).addClass( 'header-scrolled' );
			} else {
				$( '.header' ).removeClass( 'header-scrolled' );
			}
		});
	})(jQuery);
	</script>
	<?php
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
