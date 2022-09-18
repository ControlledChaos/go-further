<?php
/**
 * Theme setup
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace GoFurther\Core;

use GoFurther\Front     as Front,
	GoFurther\Customize as Customize,
	GoFurther\Styles    as Styles;

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

	add_action( 'wp_head', $n( 'js_detect' ), 0 );
	add_action( 'after_setup_theme', $n( 'theme_textdomain' ) );
	add_filter( 'body_class', $n( 'body_classes' ) );
	add_action( 'widgets_init', $n( 'widgets' ) );
	add_action( 'init', $n( 'add_page_excerpts' ) );
	add_filter( 'go_avaliable_social_icons', $n( 'get_available_social_icons' ) );
	add_action( 'wp_head', $n( 'display_social' ) );
	add_action( 'init', $n( 'classic_widgets' ) );
	add_filter( 'login_headertext', $n( 'login_title' ) );
	add_filter( 'login_headerurl', $n( 'login_url' ) );
	add_filter( 'go_design_styles', $n( 'add_design_styles' ) );
	add_filter( 'go_default_design_style', $n( 'default_design_style' ) );
	add_filter( 'go_use_google_fonts', $n( 'use_google_fonts' ) );
}

/**
 * HTML JS class
 *
 * Adds a 'js' class to the <html> element with JavaScript.
 * Parent theme does not have a `no-js` class to replace
 * so CSS works opposite a "no JS" method.
 *
 * @since  1.0.0
 * @return string
 */
function js_detect() {
	echo "<script>var root=document.getElementsByTagName('html')[0];root.setAttribute('class','js');</script>\n";
}

/**
 * Load domain for translation
 *
 * @since  1.0.0
 * @return void
 */
function theme_textdomain() {
	load_theme_textdomain( 'go-further' );
}

/**
 * Body classes for templates
 *
 * Adds classes to frontend body element.
 *
 * @since  1.0.0
 * @return array Returns a modified array of body classes.
 */
function body_classes( $classes ) {

	$add_classes = [];

	if ( Front\has_cover_image() ) {
		$add_classes[] .= 'template-cover-image';
	}

	if ( Front\has_sticky_header() ) {
		$add_classes[] .= 'has-sticky-header';
	}

	if ( get_theme_mod( 'footer_widgets_background_color', false ) ) {
		$add_classes[] .= 'has-footer-widgets-background';
	}

	return array_merge( $classes, $add_classes );
}

/**
 * Register widgets
 *
 * @since  1.0.0
 * @return void
 */
function widgets() {

	// Arguments used in all register_sidebar() calls.
	$args = apply_filters( 'gf_footer_widget_args', [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	] );

	/**
	 * Number of sidebars to register
	 *
	 * By default, unless filtered, the `footer_sidebars_count`
	 * function returns `1` if block widgets are used and `4`
	 * if classic widgets are used.
	 */
	$count = Front\footer_sidebars_count();
	$areas = range( 1, $count );
	$id    = 0;

	if ( $count >= 1 ) {
		foreach ( $areas as $area ) {

			$id = $id + 1;

			register_sidebar(
				array_merge(
					$args,
					[
						'name'        => sprintf(
							'%s %s',
							__( 'Footer', 'go-further' ),
							$id
						),
						'id'          => 'footer-' . $id,
						'description' => sprintf(
							'%s %s',
							__( 'Widgets here will be displayed in footer widgets area', 'go-further' ),
							$id
						),
					]
				)
			);
		}
	}
}

/**
 * Page excerpts
 *
 * Adds excerpts to the `page` post type.
 * Excerpts are used as page subheadings.
 *
 * @since  1.0.0
 * @return void
 */
function add_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}

/**
 * Supported social icons
 *
 * @since  1.0.0
 * @return array Returns social links from parent and child themes.
 */
function get_available_social_icons( $social_icons ) {

	$added_icons = [
		'codepen' => [
			'label'       => esc_html__( 'CodePen', 'go-further' ),
			'icon'        => get_theme_file_path( 'assets/images/social/codepen.svg' ),
			'placeholder' => 'https://codepen.com/user'
		],
	];
	return array_merge( $social_icons, $added_icons );
}

/**
 * Display social media links
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns a style block.
 */
function display_social() {

	$display = Customize\display_social( get_theme_mod( 'gf_display_social' ) );

	if ( false == $display ) {
		$style = sprintf(
			'<style>%1$s</style>',
			'.site-footer .social-icons { display: none; }'
		);
	} else {
		$style = '';
	}
	echo $style . "\n";
}

/**
 * Use classic widgets
 *
 * Use the classic widgets interfaces rather than block widgets.
 *
 * @since  1.0.0
 * @return void
 */
function classic_widgets() {

	// Add filters if classic widgets are used.
	if ( Front\has_classic_widgets() ) {
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
		add_filter( 'use_widgets_block_editor', '__return_false' );
	}
}

/**
 * Login title
 *
 * Includes the logo if set in the customizer.
 *
 * @since  1.0.0
 * @return string Returns the title markup.
 */
function login_title() {

	// Get the custom logo URL.
	$logo   = get_theme_mod( 'custom_logo' );
	$src    = wp_get_attachment_image_src( $logo , 'full' );
	$output = '';

	// Title markup, inside the h1 > a elements.
	if ( has_custom_logo( get_current_blog_id() ) ) {
		$output .= sprintf(
			'<span class="login-title-logo site-logo"><img src="%s" /></span> ',
			$src[0]
		);
	}

	$output .= sprintf(
		'<span class="login-title-text site-title">%s</span> ',
		get_bloginfo( 'name' )
	);
	return $output;
}

/**
 * Login URL
 *
 * @since  1.0.0
 * @return string Returns the URL.
 */
function login_url() {
	return site_url( '/' );
}

/**
 * Available design styles
 *
 * @since  1.0.0
 * @access public
 * @param  array $supported_design_styles
 * @return array Returns the filtered array of styles.
 */
function add_design_styles( $supported_design_styles ) {

	// Get design style arrays.
	foreach ( glob( get_stylesheet_directory() . '/includes/design-styles/*.php' ) as $filename ) {
		require_once $filename;
	}

	// Return design style arrays as variables.
	$rising_sun  = Styles\rising_sun();
	$code_monkey = Styles\code_monkey();

	// Merge design style arrays.
	return array_merge(
		(array) $rising_sun,
		(array) $code_monkey,
		(array) $supported_design_styles
	);
}

/**
 * Default design style
 *
 * @since  1.0.0
 * @return string Returns the default design style.
 */
function default_design_style() {
	return (string) 'rising-sun';
}

/**
 * Use Google fonts
 *
 * Adds a filter to stop loading Google
 * fonts for design styles that have
 * local font files.
 *
 * Don't feed The Beast!
 *
 * @since  1.0.0
 * @return boolean Returns false or false conditionally.
 *                 Default is true.
 */
function use_google_fonts() {

	$setting = Customize\use_google_fonts( get_theme_mod( 'gf_use_google_fonts' ) );
	$style   = get_design_style();
	$slug    = $style['slug'];

	// Design styles with local fonts.
	$local = [
		'rising-sun',
		'code-monkey'
	];

	if ( 'never' == $setting ) {
		return false;
	} elseif ( 'use_local' == $setting && in_array( $slug, $local ) ) {
		return false;
	}
	return true;
}
