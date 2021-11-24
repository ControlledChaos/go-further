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
use  GoFurther\Classes\Core as Core;

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

		// Login title.
		add_filter( 'login_headertext', [ $this, 'login_title' ] );

		// Login URL.
		add_filter( 'login_headerurl', [ $this, 'login_url' ] );
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
}
