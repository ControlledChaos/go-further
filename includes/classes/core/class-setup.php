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

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// Core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Background color & image support.
		add_theme_support( 'custom-background' );

		// Responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
			'style',
			'script'
		 ] );

		 // Refresh widgets.
		 add_theme_support( 'customize-selective-refresh-widgets' );

		// Featured image support.
		add_theme_support( 'post-thumbnails' );

		// Add logo support.
		add_theme_support( 'custom-logo', apply_filters( 'gft_custom_logo', [
			'width'       => 160,
			'height'      => 160,
			'flex-width'  => true,
			'flex-height' => true
		] ) );

		 // Set content width.
		if ( ! isset( $content_width ) ) {
			$content_width = apply_filters( 'gft_content_width', 1280 );
		}

		// Embed sizes.
		$embed = apply_filters( 'gft_embed_size', [
			'embed_size_w' => 1280,
			'embed_size_h' => 720
		] );
		update_option( 'embed_size_w', $embed['embed_size_w'] );
		update_option( 'embed_size_h', $embed['embed_size_h'] );

		// Add stylesheet for the content editor.
		$assets = new Assets;
		add_editor_style( 'assets/css/editor' . $assets->suffix() . '.css', [ 'gft-admin' ], '', 'screen' );
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
