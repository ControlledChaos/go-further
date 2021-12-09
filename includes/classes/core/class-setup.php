<?php
/**
 * Theme setup
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Setup
 * @since      1.0.0
 */

namespace GoFurther\Classes\Core;

// Alias namespaces.
use GoFurther\Classes\Core as Core,
	GoFurther\Front     as Front,
	GoFurther\Customize as Customize,
	GoFurther\Assets    as Assets;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Setup {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Swap html 'no-js' class with 'js'.
		add_action( 'wp_head', [ $this, 'js_detect' ], 0 );

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Body classes for templates.
		add_filter( 'body_class', [ $this, 'body_classes' ] );

		// Conditional logos.
		add_filter( 'get_custom_logo',  [ $this, 'custom_logo' ] );

		// Register widget areas.
        add_action( 'widgets_init', [ $this, 'widgets' ] );

		// Add excerpts to pages for use in meta data.
		add_action( 'init', [ $this, 'add_page_excerpts' ] );

		// Sticky header.
		add_filter( 'body_class', [ $this, 'sticky_header' ] );

		// Add social links to the parent array.
		add_filter( 'go_avaliable_social_icons', [ $this, 'get_available_social_icons' ] );

		// Display the social media links below content.
		add_action( 'wp_head', [ $this, 'display_social' ] );

		// Login title.
		add_filter( 'login_headertext', [ $this, 'login_title' ] );

		// Login URL.
		add_filter( 'login_headerurl', [ $this, 'login_url' ] );

		// Add design styles to the parent theme customizer options.
		add_filter( 'go_design_styles', [ $this, 'add_design_styles' ] );

		// Add header variations to the parent theme customizer options.
		add_filter( 'go_header_variations', [ $this, 'add_header_variations' ] );

		// Default header variation.
		add_filter( 'go_default_header', [ $this, 'default_header_variation' ] );

		// Classic widgets.
		add_action( 'init', [ $this, 'classic_widgets' ] );
	}

	/**
	 * HTML JS class
	 *
	 * Adds a 'js' to the <html> element with JavaScript.
	 * Parent theme does not have a `no-js` class to replace
	 * so CSS works opposite a "no JS" method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function js_detect() {
		echo "<script>var root=document.getElementsByTagName('html')[0];root.setAttribute('class','js');</script>\n";
	}

	/**
	 * Theme setup
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function setup() {

		// Load domain for translation.
		load_theme_textdomain( 'go-further' );

		// Add stylesheet for the content editor.
		add_editor_style( 'assets/css/editor' . Assets\suffix() . '.css', [ 'gft-admin' ], '', 'screen' );
	}

	/**
	 * Body classes for templates
	 *
	 * Adds classes frontend body element.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
	 */
	public function body_classes( $classes ) {

		$add_classes = [];

		if ( Front\has_cover_image() ) {
			$add_classes[] .= 'template-cover-image';
		}
		return array_merge( $classes, $add_classes );
	}

	/**
	 * Conditional logos
	 *
	 * Get logos for specified templates.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $html
	 * @return string Returns the markup of the logo.
	 */
	public function custom_logo ( $html ) {

		// Get logos & logo link URL.
		$wrap_class  = [ 'custom-logo-wrap' ];
		$logo        = null;
		$logo_link   = site_url( '/' );
		$custom_logo = get_theme_mod( 'custom_logo' );
		$cover_logo  = get_theme_mod( 'gft_cover_logo' );
		$post_type   = get_post_type( get_the_ID() );

		// Stop here if no logo is found.
		if ( empty( $custom_logo ) ) {
			return;
		}

		// Default logo markup.
		$logo = wp_get_attachment_image(
			$custom_logo,
			'full',
			false,
			[
				'class' => 'custom-logo default-logo',
			]
		);

		// Cover logo markup, if image is available.
		if ( $cover_logo ) {

			/**
			 * If the Cover Image template is assigned and
			 * the cover image logo is set.
			 */
			if (
				is_singular( $post_type ) &&
				post_type_supports( $post_type, 'thumbnail' ) &&
				has_post_thumbnail( get_the_ID() ) &&
				Front\has_cover_image()
			) {
				$wrap_class[] .= 'has-cover-logo';

				$logo .= wp_get_attachment_image(
					$cover_logo,
					'full',
					false,
					[
						'class' => 'custom-logo cover-logo',
					]
				);

			/**
			 * If the blog page is assigned the cover image and
			 * the cover image logo is set.
			 */
			} elseif (
				! is_singular() &&
				Front\has_cover_image()
			) {
				$wrap_class[] .= 'has-cover-logo';

				$logo .= wp_get_attachment_image(
					$cover_logo,
					'full',
					false,
					[
						'class' => 'custom-logo cover-logo',
					]
				);
			}
		} // if ( $cover_logo )

		// Compile the wrapper classes.
		$wrap_class = implode( ' ', $wrap_class );

		// The markup of the linked logo.
		$html = sprintf(
			'<div class="%1$s"><a href="%2$s" class="custom-logo-link" rel="home" itemprop="url">%3$s</a></div>',
			$wrap_class,
			esc_url( $logo_link  ),
			$logo
		);

		// Return the markup of the logo with a filter applied.
		return apply_filters( 'gft_custom_logo', $html );
	}

	/**
	 * Register widgets
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function widgets() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = [
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		];

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
	 * @access public
	 * @return void
	 */
	public function add_page_excerpts() {
		add_post_type_support( 'page', 'excerpt' );
	}

	/**
	 * Sticky header
	 *
	 * Adds classes frontend body element.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
	 */
	public function sticky_header( $classes ) {

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
	 * @access public
	 * @return array Returns social links from parent and child themes.
	 */
	public function get_available_social_icons( $social_icons ) {

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
	 * @access public
	 * @param  $input
	 * @return string Returns a style block.
	 */
	public function display_social() {

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
	 * Login title
	 *
	 * Includes the logo if set in the customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the title markup.
	 */
	public function login_title() {

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
	 * @access public
	 * @return string Returns the URL.
	 */
	public function login_url() {
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
	public function add_design_styles( $supported_design_styles ) {

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

	/**
	 * Available header variations
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $default_header_variations
	 * @return array Returns the filtered array of headers.
	 */
	public function add_header_variations( $default_header_variations ) {

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
	 * @access public
	 * @return string Returns the default header variation.
	 */
	public function default_header_variation() {
		return (string) 'header-8';
	}

	/**
	 * Use classic widgets
	 *
	 * Use the classic widgets interfaces rather than block widgets.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function classic_widgets() {

		// Add filters if classic widgets are used.
		if ( Front\has_classic_widgets() ) {
			add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
			add_filter( 'use_widgets_block_editor', '__return_false' );
		}
	}
}
