<?php
/**
 * Theme Customizer
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Customizer
 */

namespace GoFurther\Customize;

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

	add_action( 'customize_register', $n( 'customize' ), 11 );
}

/**
 * Register panels, sections, and fields
 *
 * @since  1.0.0
 * @param  object $wp_customize The WP_Customizer class.
 * @return void
 */
function customize( $wp_customize ) {



	/* --------------------- Add Panels to Organize Sections -------------------- */


	/*
		* Design & Layout panel
		*
		* Sections include:
		* - Site Design
		* - Header
		* - Footer
		* - Additional CSS
		*/
	$wp_customize->add_panel( 'gf_design', [
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'type'           => 'site-display',
		'title'          => __( 'Design & Layout', 'go-further' ),
		'description'    => __( 'Choose color schemes, layout options, content display, images, etc.', 'go-further' )
	] );

	/*
		* Site Settings panel
		*
		* Sections include:
		* - Site Identity
		* - Site Settings
		* - Front Page & Blog
		* - Widgets
		*/
	$wp_customize->add_panel( 'gf_settings', [
		'priority'       => 2,
		'capability'     => 'edit_theme_options',
		'type'           => 'site-settings',
		'title'          => __( 'Site Settings', 'go-further' ),
		'description'    => __( 'Site identity & branding, user interface, and other site details.', 'go-further' )
	] );



	/* ------------------------------ Add Sections ------------------------------ */


	/**
	 * Widgets section
	 *
	 * Displays in the Site Settings panel.
	 */
	$wp_customize->add_section( 'gf_widgets', [
		'panel'          => 'gf_settings',
		'priority'       => 40,
		'capability'     => 'edit_theme_options',
		'type'           => 'widget-settings',
		'title'          => __( 'Widgets', 'go-further' ),
		'description'    => __( '', 'go-further' )
	] );



	/* ------------------- Modify Existing Sections & Controls ------------------ */


	/*
		* The following rearranges sections and controls from both
		* the system core and the parent theme. Also change the text
		* of titles, labels and descriptions.
		*/

	// Move the core Site Identity section to the Site Settings panel.
	$wp_customize->get_section( 'title_tagline' )->panel = 'gf_settings';

	/*
		* Move the core Colors section to the Design & Layout panel.
		* The Colors section is renamed Site Design by the parent theme.
		*/
	$wp_customize->get_section( 'colors' )->panel = 'gf_design';

	/*
		* Move the core Homepage Settings section to the Site Settings panel.
		* Rename the section and change the description.
		*/
	$wp_customize->get_section( 'static_front_page' )->panel       = 'gf_settings';
	$wp_customize->get_section( 'static_front_page' )->priority    = 30;
	$wp_customize->get_section( 'static_front_page' )->title       = __( 'Front Page & Blog', 'go-further' );
	$wp_customize->get_section( 'static_front_page' )->description = 'Customize the front page of the site and how the blog is displayed.';

	// Move core and parent theme sections to the Design & Layout panel.
	$wp_customize->get_section( 'go_header_settings' )->panel = 'gf_design';
	$wp_customize->get_section( 'go_footer_settings' )->panel = 'gf_design';
	$wp_customize->get_section( 'custom_css' )->panel         = 'gf_design';

	// Parent theme's Site Settings section.
	$wp_customize->get_section( 'go_site_settings' )->panel    = 'gf_settings';
	$wp_customize->get_section( 'go_site_settings' )->priority = 25;

	// Rename the core Homepage Settings section and change the description.
	$wp_customize->get_control( 'show_on_front' )->label = __( 'Front Page Display', 'go-further' );
	$wp_customize->get_control( 'show_on_front' )->description = __( 'Choose whether to display static content on the front page of the site or posts in reverse chronological order (classic blog). To set a static front page, two pages need to be available; one will become the front page and the other will be where blog posts are displayed.', 'go-further' );

	// Ensure the core logo field is below title & tagline.
	$wp_customize->get_control( 'custom_logo' )->priority = 15;

	// Relabel the core logo field and add a description.
	$wp_customize->get_control( 'custom_logo' )->label = __( 'Default Logo', 'go-further' );
	$wp_customize->get_control( 'custom_logo' )->description = __( 'Displays in the header of posts & pages not assigned the Cover Image template and all other pages. However, it will be used for the Cover Image template if no Cover Image Logo, and upon page scroll if the sticky header option is selected.', 'go-further' );

	/*
		* Move the parent theme's logo width settings below the cover image logo.
		* Relabel the settings.
		*/
	$wp_customize->get_control( 'logo_width' )->priority = 20;
	$wp_customize->get_control( 'logo_width_mobile' )->priority = 21;
	$wp_customize->get_control( 'logo_width' )->label = __( 'Logo Width Large Screens', 'go-further' );
	$wp_customize->get_control( 'logo_width_mobile' )->label = __( 'Logo Width Small Screens', 'go-further' );

	// Move blog excerpt setting below other blog settings.
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->priority = 9;

	/*
		* Move the parent theme's blog excerpt setting to the Front Page & Blog section.
		* Relabel the setting and change the description.
		*/
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->section = 'static_front_page';
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->priority = 15;
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->label = __( 'Summarize Blog Index', 'go-further' );
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->description = __( 'Check to use post excerpts on the blog index pages.', 'go-further' );

	// Put the parent theme's copyright field into the Site Identity section.
	$wp_customize->get_control( 'copyright_control' )->section = 'title_tagline';
	$wp_customize->get_control( 'copyright_control' )->priority = 25;

	// Put the parent theme's page titles field into the Site Identity section.
	$wp_customize->get_control( 'show_page_title_checkbox' )->section = 'colors';
	$wp_customize->get_control( 'show_page_title_checkbox' )->priority = 45;

	// Put the parent theme's Social section into the core Menus panel.
	$wp_customize->get_section( 'go_social_media' )->panel = 'nav_menus';
	$wp_customize->get_section( 'go_social_media' )->priority = 999;

	// Put the social icon color below social link display.
	$wp_customize->get_control( 'social_icon_color_alt' )->priority = 12;

	// Refresh the parent theme's page titles setting.
	$wp_customize->get_setting( 'page_titles' )->transport = 'refresh';



	/* --------------------------- Add Theme Settings --------------------------- */


	/*
		* Logo for the Cover Image template
		*
		* This essentially duplicates the core logo setting.
		* Uses the image dimension settings from the parent
		* theme's logo arguments.
		*
		* The priority puts the setting immediately below the
		* default logo field.
		*
		* @uses get_theme_support()
		*/
	$wp_customize->add_setting( 'gf_cover_logo', [
		'default'           => '',
		'sanitize_callback' => 'absint'
	] );
	$wp_customize->add_control( new \WP_Customize_Cropped_Image_Control(
		$wp_customize,
		'gf_cover_logo',
		[
			'section'       => 'title_tagline',
			'settings'      => 'gf_cover_logo',
			'priority'      => 16,
			'label'         => __( 'Cover Image Logo', 'go-further' ),
			'description'   => __( 'Displays in the header of posts & pages assigned the Cover Image template, if the default logo is also set.', 'go-further' ),
			'width'         => get_theme_support( 'custom-logo', 'width' ),
			'height'        => get_theme_support( 'custom-logo', 'height' ),
			'flex_width'    => get_theme_support( 'custom-logo', 'flex-width' ),
			'flex_height'   => get_theme_support( 'custom-logo', 'flex-height' ),
			'button_labels' => [
				'select' => __( 'Select logo', 'go-further' ),
				'remove' => __( 'Remove', 'go-further' ),
				'change' => __( 'Change logo', 'go-further' )
			]
		]
	) );

	/*
		* Blog Settings
		*
		* If a static front page and a blog page is set then
		* the template & settings of the blog page will
		* supersede some of these settings.
		*/

	// Blog title.
	$wp_customize->add_setting( 'gf_blog_title', [
		'default'           => '',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_blog_title', [
			'section'     => 'static_front_page',
			'settings'    => 'gf_blog_title',
			'priority'    => 20,
			'label'       => __( 'Blog Title', 'go-further' ),
			'description' => __( 'If a static front page and a blog page is set then the title of the blog page will supersede this setting.', 'go-further' ),
			'type'        => 'text'
		]
	) );

	// Blog subtitle/description.
	$wp_customize->add_setting( 'gf_blog_subtitle', [
		'default'           => '',
		'sanitize_callback' => 'wp_filter_nohtml_kses'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_blog_subtitle', [
			'section'     => 'static_front_page',
			'settings'    => 'gf_blog_subtitle',
			'priority'    => 25,
			'label'       => __( 'Blog Subtitle', 'go-further' ),
			'description' => __( 'If a static front page and a blog page is set then the manual excerpt of the blog page will supersede this text.', 'go-further' ),
			'type'        => 'textarea'
		]
	) );

	/*
		* Blog image
		*
		* When the front page is set to display the latest posts
		* then there is no page associated with the blog index
		* from which to pull a title, excerpt, & featured image.
		*
		* The following settings add elements to the blog index
		* that would otherwise not be available.
		*/

	// Blog image.
	$image_sizes = wp_get_additional_image_sizes();
	$wp_customize->add_setting( 'gf_blog_image', [
		'default'           => '',
		'sanitize_callback' => __NAMESPACE__ . '\sanitize_image'
	] );
	$wp_customize->add_control( new \WP_Customize_Image_Control(
		$wp_customize,
		'gf_blog_image',
		[
			'section'       => 'static_front_page',
			'settings'      => 'gf_blog_image',
			'label'         => __( 'Blog Image', 'go-further' ),
			'description'   => __( 'Displays in the header of blog pages according to display settings. If a static front page and a blog page is set then the featured image of the blog page will supersede this image.', 'go-further' ),
			'priority'      => 30,
			'width'         => $image_sizes['post-thumbnail']['width'],
			'height'        => $image_sizes['post-thumbnail']['height'],
			'button_labels' => [
				'select' => __( 'Select image', 'go-further' ),
				'remove' => __( 'Remove', 'go-further' ),
				'change' => __( 'Change image', 'go-further' ),
			]
		]
	) );

	// Blog image display.
	$wp_customize->add_setting( 'gf_blog_image_display', [
		'default'	        => 'never',
		'sanitize_callback' => __NAMESPACE__ . '\blog_image_display'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_blog_image_display',
		[
			'section'     => 'static_front_page',
			'settings'    => 'gf_blog_image_display',
			'priority'    => 35,
			'label'       => __( 'Blog Image Display', 'go-further' ),
			'description' => __( 'Choose where to display a featured image on blog pages. If a static front page and a blog page is set then the template & settings of the blog page will supersede this text.', 'go-further' ),
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

	/*
		* Featured images
		*
		* The following settings control how featured images are displayed.
		* Options for banner images do not apply to the featured image
		* of the Cover Image template.
		*/

	// Featured image banner containment.
	$wp_customize->add_setting( 'gf_contain_featured', [
		'default'	        => 'never',
		'sanitize_callback' => __NAMESPACE__ . '\contain_featured'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_contain_featured',
		[	// The core "Colors" section is renamed "Site Design" by the parent theme.
			'section'     => 'colors',
			'settings'    => 'gf_contain_featured',
			'priority'    => 55,
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

	/*
		* Sticky header
		*
		* Allow the page header to stick to the top of the viewport.
		*/
	$wp_customize->add_setting( 'gf_sticky_header', [
		'default'	        => false,
		'sanitize_callback' => __NAMESPACE__ . '\sticky_header'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_sticky_header',
		[
			'section'     => 'go_header_settings',
			'settings'    => 'gf_sticky_header',
			'priority'    => 100,
			'label'       => __( 'Sticky Header', 'go-further' ),
			'description' => __( 'Check to make the header stick to the top of the page.', 'go-further' ),
			'type'        => 'checkbox',
		]
	) );

	/*
		* Social media menu
		*
		* Determines whether to display the social media links
		* at the bottom of the main content.
		*/
	$wp_customize->add_setting( 'gf_display_social', [
		'default'	        => true,
		'sanitize_callback' => __NAMESPACE__ . '\display_social'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_display_social',
		[
			'section'     => 'go_social_media',
			'settings'    => 'gf_display_social',
			'priority'    => 11,
			'label'       => __( 'Links Below Content', 'go-further' ),
			'description' => __( 'Check to display the social media links below the content.', 'go-further' ),
			'type'        => 'checkbox',
		]
	) );

	/*
		* Classic widgets
		*
		* Use the classic widgets interfaces rather than block widgets.
		* Do not register if ClassicPress is running.
		*/
	if ( ! function_exists( 'classicpress_version' ) ) :
		$wp_customize->add_setting( 'gf_classic_widgets', [
			'default'	        => false,
			'sanitize_callback' => __NAMESPACE__ . '\classic_widgets'
		] );
		$wp_customize->add_control( new \WP_Customize_Control(
			$wp_customize,
			'gf_classic_widgets',
			[
				'section'     => 'gf_widgets',
				'settings'    => 'gf_classic_widgets',
				'priority'    => 11,
				'label'       => __( 'Classic Widgets', 'go-further' ),
				'description' => __( 'Check to use the classic widgets interfaces rather than block widgets.', 'go-further' ),
				'type'        => 'checkbox',
			]
		) );
	endif;
}

/**
 * Sanitize image
 *
 * @since  1.0.0
 * @param  $input
 * @param  $setting
 * @return string Returns the URL of the image.
 */
function sanitize_image( $input, $setting ) {
	return esc_url_raw( validate_image( $input, $setting->default ) );
}

/**
 * Validate image
 *
 * @since  1.0.0
 * @param  $input
 * @param  $default
 * @return array Returns an array with file extension and mime_type.
 */
function validate_image( $input, $default = '' ) {

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
 * Blog image display
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function blog_image_display( $input ) {

	$valid = [ 'never', 'always', 'banner', 'cover', 'mixed' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'never';
}

/**
 * Featured image
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function contain_featured( $input ) {

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
 * @param  $input
 * @return boolean Returns false by default.
 */
function sticky_header( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Display social media links
 *
 * Display the social media links at
 * the bottom of the main content.
 *
 * @since  1.0.0
 * @param  $input
 * @return boolean Returns true by default.
 */
function display_social( $input ) {

	if ( false == $input ) {
		return false;
	}
	return true;
}

/**
 * Classic widgets
 *
 * Use the classic widgets interfaces
 * rather than block widgets.
 *
 * @since  1.0.0
 * @param  $input
 * @return boolean Returns false by default.
 */
function classic_widgets( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}
