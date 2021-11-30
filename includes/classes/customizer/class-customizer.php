<?php
/**
 * Theme Customizer
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Customizer
 */

namespace GoFurther\Classes\Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Customizer {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Instance of the class
	 *
	 * This method can be used to call an instance
	 * of the class from outside the class.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns an instance of the class.
	 */
	public static function instance() {

		if ( is_null( self :: $class_object ) ) {
			self :: $class_object = new self();
		}

		// Return the instance.
		return self :: $class_object;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Modify existing Customizer elements.
		add_action( 'customize_register', [ $this, 'customize_modify' ], 20 );

		// Register new panels, sections, & fields.
		add_action( 'customize_register', [ $this, 'customize_register' ] );
	}

	/**
	 * Modify existing Customizer elements
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize The WP_Customizer class.
	 * @return void
	 */
	public function customize_modify( $wp_customize ) {

		// Refresh for page titles setting.
		$wp_customize->get_setting( 'page_titles' )->transport = 'refresh';

		// Move Site Settings section up in the list.
		$wp_customize->get_section( 'go_site_settings' )->priority = 41;

		// Add a description to the default logo field.
		$wp_customize->get_control( 'custom_logo' )->description = __( 'Displays in the header of posts & pages not assigned the Cover Image template and all other pages.', 'go-further' );

		// Move blog excerpt setting below other blog settings.
		$wp_customize->get_control( 'blog_excerpt_checkbox' )->priority = 9;

		// Put parent theme Social section into Menus panel.
		$wp_customize->get_section( 'go_social_media' )->panel    = 'nav_menus';
		$wp_customize->get_section( 'go_social_media' )->priority = 999;

		// Social icon color below social link display.
		$wp_customize->get_control( 'social_icon_color_alt' )->priority = 12;
	}

	/**
	 * Register fields
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_customize The WP_Customizer class.
	 * @return void
	 */
	public function customize_register( $wp_customize ) {

		// Cover image template logo.
		$wp_customize->add_setting( 'gft_cover_logo', [
			'default'           => '',
			'sanitize_callback' => 'absint'
		] );
		$wp_customize->add_control( new \WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'gft_cover_logo',
			[
				'section'       => 'title_tagline',
				'settings'      => 'gft_cover_logo',
				'label'         => __( 'Cover Image Logo', 'go-further' ),
				'description'   => __( 'Displays in the header of posts & pages assigned the Cover Image template, if the default logo is also set.', 'go-further' ),
				'priority'      => 8,
				'width'         => get_theme_support( 'custom-logo', 'width' ),
				'height'        => get_theme_support( 'custom-logo', 'height' ),
                'flex_width'    => get_theme_support( 'custom-logo', 'flex-width' ),
                'flex_height'   => get_theme_support( 'custom-logo', 'flex-height' ),
				'button_labels' => [
					'select' => __( 'Select logo', 'go-further' ),
					'remove' => __( 'Remove', 'go-further' ),
					'change' => __( 'Change logo', 'go-further' ),
				]
			]
		) );

		/**
		 * Blog featured image
		 *
		 * This theme provides an optional featured image for
		 * blog pages and corresponding display options.
		 *
		 * If a static front page and a blog page is set then
		 * the template & settings of the blog page may
		 * supersede some of these settings.
		 */

		// Blog image display options.
		$wp_customize->add_setting( 'gft_blog_image_display', [
			'default'	        => 'never',
			'sanitize_callback' => [ $this, 'contain_featured' ]
		] );
		$wp_customize->add_control( new \WP_Customize_Control(
			$wp_customize,
			'gft_blog_image_display',
			[
				'section'     => 'go_site_settings',
				'settings'    => 'gft_blog_image_display',
				'priority'    => 1,
				'label'       => __( 'Blog Image Display', 'go-further' ),
				'description' => __( 'Choose where to display a featured image on blog pages. If a static front page and a blog page is set then the template & settings of the blog page may supersede some of these settings.', 'go-further' ),
				'type'        => 'select',
				'choices'     => [
					'never'  => __( 'Do Not Display', 'go-further' ),
					'always' => __( 'Banner All Pages', 'go-further' ),
					'banner' => __( 'Banner First Page Only', 'go-further' ),
					'cover'  => __( 'Cover First Page Only', 'go-further' ),
					'mixed'  => __( 'Cover First Page, Banner Other Pages', 'go-further' )
				],
				'active_callback' => ''
			]
		) );

		// Blog image if no blog page is set.
		$image_sizes = wp_get_additional_image_sizes();
		$wp_customize->add_setting( 'gft_blog_image', [
			'default'           => '',
			'sanitize_callback' => [ $this, 'sanitize_image' ]
		] );
		$wp_customize->add_control( new \WP_Customize_Image_Control(
			$wp_customize,
			'gft_blog_image',
			[
				'section'       => 'go_site_settings',
				'settings'      => 'gft_blog_image',
				'label'         => __( 'Blog Image', 'go-further' ),
				'description'   => __( 'Displays in the header of blog pages according to display settings.', 'go-further' ),
				'priority'      => 8,
				'width'         => $image_sizes['post-thumbnail']['width'],
				'height'        => $image_sizes['post-thumbnail']['height'],
				'button_labels' => [
					'select' => __( 'Select image', 'go-further' ),
					'remove' => __( 'Remove', 'go-further' ),
					'change' => __( 'Change image', 'go-further' ),
				]
			]
		) );

		// Featured image banner options.
		$wp_customize->add_setting( 'gft_contain_featured', [
			'default'	        => 'never',
			'sanitize_callback' => [ $this, 'contain_featured' ]
		] );
		$wp_customize->add_control( new \WP_Customize_Control(
			$wp_customize,
			'gft_contain_featured',
			[	// The core "Colors" section is renamed "Site Design" by the parent theme.
				'section'     => 'colors',
				'settings'    => 'gft_contain_featured',
				'priority'    => 1,
				'label'       => __( 'Featured Image Containment', 'go-further' ),
				'description' => __( 'Choose when to contain the featured image with left & right padding. Does not apply to the Cover Image template.', 'go-further' ),
				'type'        => 'select',
				'choices'     => [
					'never'       => __( 'Never Contain', 'go-further' ),
					'always'      => __( 'Always Contain', 'go-further' ),
					'enable_per'  => __( 'Contain per Post/Page', 'go-further' ),
					'disable_per' => __( 'Remove per Post/Page', 'go-further' )
				],
			]
		) );

		// Featured image archive options.

		// Sticky header.
		$wp_customize->add_setting( 'gft_sticky_header', [
			'default'	        => false,
			'sanitize_callback' => [ $this, 'sticky_header' ]
		] );
		$wp_customize->add_control( new \WP_Customize_Control(
			$wp_customize,
			'gft_sticky_header',
			[
				'section'     => 'go_header_settings',
				'settings'    => 'gft_sticky_header',
				'label'       => __( 'Sticky Header', 'go-further' ),
				'description' => __( 'Check to make the header stick to the top of the page.', 'go-further' ),
				'type'        => 'checkbox',
				'priority'    => 100
			]
		) );

		// Display the social media links below content.
		$wp_customize->add_setting( 'gft_display_social', [
			'default'	        => true,
			'sanitize_callback' => [ $this, 'display_social' ]
		] );
		$wp_customize->add_control( new \WP_Customize_Control(
			$wp_customize,
			'gft_display_social',
			[
				'section'     => 'go_social_media',
				'settings'    => 'gft_display_social',
				'label'       => __( 'Links Below Content', 'go-further' ),
				'description' => __( 'Check to display the social media links below the content.', 'go-further' ),
				'type'        => 'checkbox',
				'priority'    => 11
			]
		) );
	}

	/**
	 * Sanitize image
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @param  $setting
	 * @return string Returns the URL of the image.
	 */
	public function sanitize_image( $input, $setting ) {
		return esc_url_raw( $this->validate_image( $input, $setting->default ) );
	}

	/**
	 * Validate image
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @param  $default
	 * @return array Returns an array with file extension and mime_type.
	 */
	public function validate_image( $input, $default = '' ) {

		$mimes = [
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tif|tiff'     => 'image/tiff',
			'ico'          => 'image/x-icon'
		];

		$file = wp_check_filetype( $input, $mimes );

		if ( $file['ext'] ) {
			return $input;
		} else {
			return $default;
		}
	}

	/**
	 * Featured image
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function contain_featured( $input ) {

		$valid = [ 'never', 'always', 'enable_per', 'disable_per' ];

		if ( in_array( $input, $valid ) ) {
			return $input;
		}
		return 'never';
	}

	/**
	 * Sticky header
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function sticky_header( $input ) {

		if ( ! isset( $input ) || true == $input ) {
			return true;
		}
		return false;
	}

	/**
	 * Display social media links
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  $input
	 * @return string Returns the theme mod.
	 */
	public function display_social( $input ) {

		if ( ! isset( $input ) || true == $input ) {
			return true;
		}
		return false;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Customizer Returns an instance of the class.
 */
function mods() {
	return Customizer :: instance();
}
