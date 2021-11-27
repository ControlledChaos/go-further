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
	GoFurther\Classes\Customize  as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Setup {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'setup' ] );

		// Add excerpts to pages for use in meta data.
		add_action( 'init', [ $this, 'add_page_excerpts' ] );

		// Add social links to the parent array.
		add_filter( 'go_avaliable_social_icons', [ $this, 'get_available_social_icons' ] );

		// Display the social media links below content.
		add_action( 'wp_head', [ $this, 'display_social' ] );

		// Login title.
		add_filter( 'login_headertext', [ $this, 'login_title' ] );

		// Login URL.
		add_filter( 'login_headerurl', [ $this, 'login_url' ] );

		add_filter( 'go_design_styles', [ $this, 'add_design_styles' ] );
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
		$assets = new Assets;
		add_editor_style( 'assets/css/editor' . $assets->suffix() . '.css', [ 'gft-admin' ], '', 'screen' );
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

		new Customize\Customizer;

		// Get the navigation location setting from the Customizer.
		$display = Customize\mods()->display_social( get_theme_mod( 'gft_display_social' ) );

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
	 * Returns the available design styles.
	 *
	 * @return array
	 */
	function add_design_styles( $supported_design_styles ) {

		$suffix = ( SCRIPT_DEBUG || WP_DEBUG ) ? '' : '.min';
		$rtl    = ! is_rtl() ? '' : '-rtl';

		$add_design_styles = [
			'nippon' => array(
				'slug'          => 'rising-sun',
				'label'         => _x( 'Rising Sun', 'design style name', 'go-further' ),
				'url'           => get_theme_file_uri( "assets/css/design-styles/rising-sun/style{$rtl}{$suffix}.css" ),
				'editor_style'  => "assets/css/design-styles/rising-sun/style-editor{$rtl}{$suffix}.css",
				'color_schemes' => array(
					'zen' => array(
						'label'      => _x( 'Zen Garden', 'color palette name', 'go-further' ),
						'primary'    => '#4c454e',
						'secondary'  => '#687530',
						'tertiary'   => '#e7e2e8',
						'background' => '#ffffff'
					),
					'cherry' => array(
						'label'      => _x( 'Cherry Blossom', 'color palette name', 'go-further' ),
						'primary'    => '#c83771',
						'secondary'  => '#4d8622',
						'tertiary'   => '#f4e6eb',
						'background' => '#ffffff'
					),
					'koi' => array(
						'label'      => _x( 'Koi Pond', 'color palette name', 'go-further' ),
						'primary'    => '#e0661f',
						'secondary'  => '#2c5aa0',
						'tertiary'   => '#eaeff7',
						'background' => '#ffffff'
					),
					'mum' => array(
						'label'      => _x( 'Chrysanthemum', 'color palette name', 'go-further' ),
						'primary'    => '#f0ae00',
						'secondary'  => '#4d8622',
						'tertiary'   => '#fff6d5',
						'background' => '#ffffff'
					),
					'tea' => array(
						'label'      => _x( 'Tea House', 'color palette name', 'go-further' ),
						'primary'    => '#7f6032',
						'secondary'  => '#764fb6',
						'tertiary'   => '#eee9e2',
						'background' => '#ffffff'
					),
					'fuji' => array(
						'label'      => _x( 'Volcano', 'color palette name', 'go-further' ),
						'primary'    => '#6f7c91',
						'secondary'  => '#b7bec8',
						'tertiary'   => '#eceef1',
						'background' => '#ffffff'
					),
				),
				'fonts'=> array(
					'Crimson Pro' => array(
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
					),
					'Red Hat Display'  => array(
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
					),
				),
				'font_size'      => '1.125rem',
				'type_ratio'     => '1.275',
				'viewport_basis' => '1600'
			),
		];

		return array_merge( $add_design_styles, $supported_design_styles );
	}
}
