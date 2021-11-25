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
		add_action( 'customize_register', [ $this, 'customize_modify' ], 11 );

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

		// Social icon color below social link display.
		$wp_customize->get_control( 'social_icon_color_alt' )->priority = 12;

		// Add a description to the default logo field.
		$wp_customize->get_control( 'custom_logo' )->description = __( 'Displays in the header of posts & pages assigned the Default template.', 'go-further' );
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
