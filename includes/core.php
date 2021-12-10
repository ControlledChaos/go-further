<?php
/**
 * Theme setup
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Setup
 * @since      1.0.0
 */

namespace GoFurther\Core;

// Alias namespaces.
use GoFurther\Classes\Core as Core,
	GoFurther\Front     as Front,
	GoFurther\Customize as Customize,
	GoFurther\Assets    as Assets;

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

	add_action( 'wp_head', $n( 'js_detect' ), 0 );
	add_action( 'after_setup_theme', $n( 'theme_setup' ) );
	add_filter( 'body_class', $n( 'body_classes' ) );
	// add_filter( 'get_custom_logo',  $n( 'custom_logo' ) );
	add_action( 'widgets_init', $n( 'widgets' ) );
	add_action( 'init', $n( 'add_page_excerpts' ) );
	add_filter( 'body_class', $n( 'sticky_header' ) );
	add_filter( 'go_avaliable_social_icons', $n( 'get_available_social_icons' ) );
	add_action( 'wp_head', $n( 'display_social' ) );
	add_filter( 'login_headertext', $n( 'login_title' ) );
	add_filter( 'login_headerurl', $n( 'login_url' ) );
	add_filter( 'go_design_styles', $n( 'add_design_styles' ) );
	add_filter( 'go_header_variations', $n( 'add_header_variations' ) );
	add_filter( 'go_default_header', $n( 'default_header_variation' ) );
	add_action( 'init', $n( 'classic_widgets' ) );
}

/**
 * HTML JS class
 *
 * Adds a 'js' to the <html> element with JavaScript.
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
 * Theme setup
 *
 * @since  1.0.0
 * @return void
 */
function theme_setup() {

	// Load domain for translation.
	load_theme_textdomain( 'go-further' );

	// Add stylesheet for the content editor.
	add_editor_style( 'assets/css/editor' . Assets\suffix() . '.css', [], '', 'screen' );
}

/**
 * Body classes for templates
 *
 * Adds classes frontend body element.
 *
 * @since  1.0.0
 * @return array Returns a modified array of body classes.
 */
function body_classes( $classes ) {

	$add_classes = [];

	if ( Front\has_cover_image() ) {
		$add_classes[] .= 'template-cover-image';
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
	$shared_args = apply_filters( 'gf_footer_widget_args', [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	] );

	if ( Front\has_classic_widgets() ) :

		// Footer #1.
		register_sidebar(
			array_merge(
				$shared_args,
				[
					'name'        => __( 'Footer #1', 'go-further' ),
					'id'          => 'footer-1',
					'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'go-further' ),
				]
			)
		);

		// Footer #2.
		register_sidebar(
			array_merge(
				$shared_args,
				[
					'name'        => __( 'Footer #2', 'go-further' ),
					'id'          => 'footer-2',
					'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'go-further' ),
				]
			)
		);

		// Footer #3.
		register_sidebar(
			array_merge(
				$shared_args,
				[
					'name'        => __( 'Footer #3', 'go-further' ),
					'id'          => 'footer-3',
					'description' => __( 'Widgets in this area will be displayed in the third column in the footer.', 'go-further' ),
				]
			)
		);

		// Footer #4.
		register_sidebar(
			array_merge(
				$shared_args,
				[
					'name'        => __( 'Footer #4', 'go-further' ),
					'id'          => 'footer-4',
					'description' => __( 'Widgets in this area will be displayed in the fourth column in the footer.', 'go-further' ),
				]
			)
		);

	else :

		// Register footer widget area.
		register_sidebar(
			array_merge(
				$shared_args,
				[
					'name'        => __( 'Footer Widgets', 'go-further' ),
					'id'          => 'footer',
					'description' => __( 'Displays below the main content.', 'go-further' ),
				]
			)
		);
	endif;
}

/**
 * Add excerpts to page post type
 *
 * @since  1.0.0
 * @return void
 */
function add_page_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}

/**
 * Sticky header
 *
 * Adds classes frontend body element.
 *
 * @since  1.0.0
 * @return array Returns a modified array of body classes.
 */
function sticky_header( $classes ) {

	// Get the navigation location setting from the Customizer.
	$sticky = Customize\sticky_header( get_theme_mod( 'gft_sticky_header' ) );

	if ( $sticky ) {
		return array_merge( $classes, [ 'has-sticky-header' ] );
	}
	return $classes;
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
			'placeholder' => 'https://codepen.com/user',
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

	// Get the navigation location setting from the Customizer.
	$display = Customize\display_social( get_theme_mod( 'gft_display_social' ) );

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
 * Available header variations
 *
 * @since  1.0.0
 * @param  array $default_header_variations
 * @return array Returns the filtered array of headers.
 */
function add_header_variations( $default_header_variations ) {

	$add_header_variations = [
		'header-8' => [
			'label'         => esc_html_x( 'Header 8', 'name of the eighth header variation option', 'go-further' ),
			'preview_image' => get_theme_file_uri( 'assets/images/admin/header-8.svg' ),
		],
		'header-9' => [
			'label'         => esc_html_x( 'Header 9', 'name of the ninth header variation option', 'go-further' ),
			'preview_image' => get_theme_file_uri( 'assets/images/admin/header-9.svg' ),
		]
	];
	return array_merge( $add_header_variations, $default_header_variations );
}

/**
 * Default header variation
 *
 * @since  1.0.0
 * @return string Returns the default header variation.
 */
function default_header_variation() {
	return (string) 'header-8';
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

	$suffix = ( SCRIPT_DEBUG || WP_DEBUG ) ? '' : '.min';
	$rtl    = ! is_rtl() ? '' : '-rtl';

	$add_design_styles = [
		'rising-sun' => [
			'slug'          => 'rising-sun',
			'label'         => _x( 'Rising Sun', 'design style name', 'go-further' ),
			'url'           => get_theme_file_uri( "assets/css/design-styles/rising-sun/style{$rtl}{$suffix}.css" ),
			'editor_style'  => "assets/css/design-styles/rising-sun/style-editor{$rtl}{$suffix}.css",
			'color_schemes' => [
				'one' => [
					'label'      => _x( 'Zen Garden', 'color palette name', 'go-further' ),
					'primary'    => '#687530',
					'secondary'  => '#433d47',
					'tertiary'   => '#ededed',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '#433d47',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#687530'
				],
				'two' => [
					'label'      => _x( 'Cherry Blossom', 'color palette name', 'go-further' ),
					'primary'    => '#c43b71',
					'secondary'  => '#396816',
					'tertiary'   => '#f9edf1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#c43b71'
				],
				'three' => [
					'label'      => _x( 'Chrysanthemum', 'color palette name', 'go-further' ),
					'primary'    => '#efa700',
					'secondary'  => '#225400',
					'tertiary'   => '#fffae0',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#efa700'
				],
				'four' => [
					'label'      => _x( 'Koi Pond', 'color palette name', 'go-further' ),
					'primary'    => '#d46408',
					'secondary'  => '#253555',
					'tertiary'   => '#edf2fb',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#d46408'
				],
				'five' => [
					'label'      => _x( 'Wisteria', 'color palette name', 'go-further' ),
					'primary'    => '#7f6032',
					'secondary'  => '#764fb6',
					'tertiary'   => '#eee9e2',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'six' => [
					'label'      => _x( 'Maple', 'color palette name', 'go-further' ),
					'primary'    => '#7f6032',
					'secondary'  => '#764fb6',
					'tertiary'   => '#eee9e2',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'seven' => [
					'label'      => _x( 'Tea House', 'color palette name', 'go-further' ),
					'primary'    => '#7f6032',
					'secondary'  => '#764fb6',
					'tertiary'   => '#eee9e2',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'eight' => [
					'label'      => _x( 'Volcano', 'color palette name', 'go-further' ),
					'primary'    => '#63738d',
					'secondary'  => '#393e51',
					'tertiary'   => '#eceef1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '#ffffff',
					'header_text'          => '',
					'footer_background'    => '#ffffff',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#393e51'
				],
			],
			'fonts'=> [
				'Crimson Pro' => [
					'300',
					'300i',
					'400',
					'400i',
					'500',
					'500i',
					'600',
					'600i',
					'700',
					'700i'
				],
				'Red Hat Display' => [
					'300',
					'300i',
					'400',
					'400i',
					'500',
					'500i',
					'600',
					'600i',
					'700',
					'700i'
				],
			],
			'font_size'      => '1.125rem',
			'type_ratio'     => '1.275',
			'viewport_basis' => '1600'
		]
	];
	return array_merge( $add_design_styles, $supported_design_styles );
}
