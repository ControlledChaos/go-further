<?php
/**
 * Load theme assets
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Assets
 */

namespace GoFurther\Assets;

use GoFurther\Core      as Core,
	GoFurther\Front     as Front,
	GoFurther\Customize as Customize;

use function \Go\Core\fonts_url;
use function \Go\Core\get_design_style;

/**
 * Execute functions
 *
 * @since  1.0.0
 * @return void
 */
function setup() {

	$n = function( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'enqueue_block_editor_assets', $n( 'parent_block_editor_assets' ), 11 );
	add_action( 'wp_enqueue_scripts', $n( 'frontend_styles' ) );
	add_action( 'wp_footer', $n( 'frontend_print_scripts' ) );
	add_action( 'wp_enqueue_scripts', $n( 'toolbar_styles' ) );
	add_action( 'admin_enqueue_scripts', $n( 'toolbar_styles' ), 99 );
	if ( ! is_customize_preview() ) {
		add_action( 'admin_enqueue_scripts', $n( 'admin_styles' ) );
	}
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
 * Parent block editor assets
 *
 * Fix error PHP notice from parent theme.
 * Dequeue block editor scripts if on the widgets screen.
 * No regard is given to the classic widgets option because
 * they don't need the scripts, so dequeue for all.
 *
 * @since  1.0.0
 * @return void
 */
function parent_block_editor_assets() {

	global $pagenow;

	if ( $pagenow === 'widgets.php' ) {
		wp_dequeue_script( 'go-block-filters' );
    	wp_deregister_script( 'go-block-filters' );
	}
}

/**
 * Frontend styles
 *
 * @since  1.0.0
 * @return void
 */
function frontend_styles() {

	// Front end only.
	if ( is_admin() ) {
		return;
	}

	$suffix = suffix();

	/**
	 * Theme stylesheet
	 *
	 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
	 * The main stylesheet, in the root directory, only contains the theme header but
	 * it is necessary for theme activation. DO NOT delete the main stylesheet!
	 */
	wp_enqueue_style( 'go-further', get_theme_file_uri( "/assets/css/style$suffix.css" ), [ 'go-style' ], GF_VERSION, 'all' );

	// Right-to-left languages.
	if ( is_rtl() ) {
		wp_enqueue_style( 'go-further-rtl', get_theme_file_uri( "assets/css/style-rtl$suffix.css" ), [ 'go-further' ], GF_VERSION, 'all' );
	}
}

/**
 * Print footer scripts
 *
 * @since  1.0.0
 * @return void
 */
function frontend_print_scripts() {

	/**
	 * Add class to header on scroll
	 *
	 * Only run if the sticky header option
	 * is enabled.
	 */
	if ( Front\has_sticky_header() ) :
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
	endif;
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

	$admin_theme = Customize\use_admin_theme( get_theme_mod( 'gf_use_admin_theme' ) );
	$suffix      = suffix();

	if (
		true == $admin_theme &&
		is_user_logged_in() &&
		is_admin_bar_showing()
	) {
		wp_enqueue_style( 'gf-toolbar', get_theme_file_uri( "/assets/css/shared/toolbar$suffix.css" ), [], GF_VERSION, 'screen' );
	}
}

/**
 * Admin styles
 *
 * @since  1.0.0
 * @global $pagenow Access the current admin screen.
 * @return void
 */
function admin_styles() {

	global $pagenow;

	$suffix       = suffix();
	$fonts_url    = fonts_url();
	$get_design   = get_design_style();
	$design_style = $get_design['slug'];

	// Enqueue Google fonts if available & customizer is set to use.
	if ( ! empty( $fonts_url && Core\use_google_fonts() ) ) {
		wp_enqueue_style( 'go-fonts', $fonts_url, [], GF_VERSION );
	}

	// Styles for the replacement color picker.
	if ( 'profile.php' == $pagenow || 'user-edit.php' == $pagenow ) {
		wp_enqueue_style( 'gf-color-picker', get_theme_file_uri( "/assets/css/admin/color-picker$suffix.css" ), [], GF_VERSION, 'all' );
	}

	// Global styles for all design styles & color schemes.
	wp_enqueue_style( 'gf-colors-shared', get_theme_file_uri( "/assets/css/admin/colors/shared$suffix.css" ), [], GF_VERSION, 'all' );
	wp_enqueue_style( 'gf-typography-shared', get_theme_file_uri( "/assets/css/admin/typography/shared$suffix.css" ), [], GF_VERSION, 'all' );

	// Typography stylesheet for the active design style.
	wp_enqueue_style( 'gf-typography', get_theme_file_uri( "/assets/css/admin/typography/design-styles/$design_style/typography$suffix.css" ), [], GF_VERSION, 'all' );
}

/**
 * Login styles
 *
 * @since  1.0.0
 * @return void
 */
function login_styles() {

	$suffix = suffix();

	wp_enqueue_style( 'gf-login', get_theme_file_uri( "/assets/css/login$suffix.css" ), [ 'login' ], GF_VERSION, 'screen' );
}

/**
 * Embedded content styles
 *
 * @since  1.0.0
 * @return void
 */
function embed_styles() {

	$suffix = suffix();

	if ( ! is_admin() ) {
		wp_enqueue_style( 'gf-embed', get_theme_file_uri( "/assets/css/frontend/embed$suffix.css" ), [], GF_VERSION, 'screen' );
	}
}
