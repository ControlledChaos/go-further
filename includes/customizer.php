<?php
/**
 * Theme Customizer
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Customizer
 */

namespace GoFurther\Customize;

use \Go\Customizer   as Go,
	GoFurther\Front  as Front,
	GoFurther\Assets as Assets;

use function \Go\hex_to_hsl;

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

	add_action( 'customize_register', $n( 'customize' ), 11 );
	add_action( 'customize_preview_init', $n( 'customize_preview_init' ), 11 );
	add_action( 'customize_controls_enqueue_scripts', $n( 'customize_preview_init' ), 11 );
	add_action( 'wp_head', $n( 'inline_css' ), 11 );
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


	/**
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

	/**
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

	/**
	 * Admin Settings section
	 *
	 * Displays in the Site Settings panel.
	 */
	$wp_customize->add_section( 'gf_admin', [
		'panel'          => 'gf_settings',
		'priority'       => 60,
		'capability'     => 'edit_theme_options',
		'type'           => 'admin-settings',
		'title'          => __( 'Admin Settings', 'go-further' ),
		'description'    => __( '', 'go-further' )
	] );



	/* --------------------------- Add Theme Settings --------------------------- */


	/**
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

	/**
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
			'description' => __( 'If a static front page and a blog page are set then the title of the blog page will supersede this setting.', 'go-further' ),
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
			'description' => __( 'If a static front page and a blog page are set then the manual excerpt of the blog page will supersede this text.', 'go-further' ),
			'type'        => 'textarea'
		]
	) );

	/**
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
			'description'   => __( 'Displays in the header of blog pages according to display settings. If a static front page and a blog page are set then the featured image of the blog page will supersede this image.', 'go-further' ),
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
			'description' => __( 'Choose where to display a featured image on blog pages. If a static front page and a blog page are set then the template & settings of the blog page will supersede this text.', 'go-further' ),
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

	/**
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
			]
		]
	) );

	/**
	 * Social media menu
	 *
	 * Determines whether to display the social media links
	 * at the bottom of the main content.
	 */
	$wp_customize->add_setting( 'gf_display_social', [
		'default'	        => true,
		'transport'         => 'postMessage',
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

	/**
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
				'description' => __( 'Check to use the classic widgets interfaces rather than block widgets. Requires this Customizer screen to be refreshed if adding widgets here.', 'go-further' ),
				'type'        => 'checkbox',
			]
		) );
	endif;

	// Title control for the core color scheme settings.
	$wp_customize->add_setting(
		'title_color_scheme',
		[
			'sanitize_callback' => 'esc_html',
		]
	);

	$wp_customize->add_control(
		new Go\Title_Control(
			$wp_customize,
			'title_color_scheme',
			[
				'section'     => 'colors',
				'type'        => 'go_title',
				'label'       => esc_html__( 'Override Base Colors', 'go-further' ),
				'description' => __( 'Change the core colors of this color scheme.', 'go-further' )
			]
		)
	);

	// Footer widgets colors.
	$wp_customize->add_setting(
		'title_footer_widgets_colors',
		[
			'sanitize_callback' => 'esc_html',
		]
	);

	$wp_customize->add_control(
		new Go\Title_Control(
			$wp_customize,
			'title_footer_widgets_colors',
			[
				'section'     => 'colors',
				'priority'    => 10,
				'type'        => 'go_title',
				'label'       => esc_html__( 'Widget Area Colors', 'go-further' ),
				'description' => __( 'Customize colors within the footer widgets area.', 'go-further' )
			]
		)
	);

	$wp_customize->add_setting(
		'footer_widgets_background_color',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
			'default'           => ''
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_widgets_background_color',
			[
				'section'  => 'colors',
				'settings' => 'footer_widgets_background_color',
				'priority'    => 10,
				'label'    => esc_html__( 'Background', 'go-further' )
			]
		)
	);

	$wp_customize->add_setting(
		'footer_widgets_text_color',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_widgets_text_color',
			[
				'label'    => esc_html__( 'Foreground', 'go-further' ),
				'section'  => 'colors',
				'settings' => 'footer_widgets_text_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_widgets_heading_color',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_widgets_heading_color',
			[
				'label'    => esc_html__( 'Heading', 'go-further' ),
				'section'  => 'colors',
				'settings' => 'footer_widgets_heading_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_widgets_link_form_color',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_widgets_link_form_color',
			[
				'label'    => esc_html__( 'Links & Forms', 'go-further' ),
				'section'  => 'colors',
				'settings' => 'footer_widgets_link_form_color',
			]
		)
	);

	$wp_customize->add_setting(
		'footer_widgets_interactive_color',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		]
	);

	$wp_customize->add_control(
		new \WP_Customize_Color_Control(
			$wp_customize,
			'footer_widgets_interactive_color',
			[
				'label'    => esc_html__( 'Interactive', 'go-further' ),
				'section'  => 'colors',
				'settings' => 'footer_widgets_interactive_color',
			]
		)
	);

	// Title control for the title display setting.
	$wp_customize->add_setting(
		'title_site_titles',
		[
			'sanitize_callback' => 'esc_html',
		]
	);

	$wp_customize->add_control(
		new Go\Title_Control(
			$wp_customize,
			'title_site_titles',
			[
				'section'     => 'colors',
				'type'        => 'go_title',
				'label'       => esc_html__( 'Page Titles', 'go-further' ),
				'description' => __( 'Page titles may be hidden in deference to titles from page builders or the block editor.', 'go-further' )
			]
		)
	);

	/**
	 * Use Google fonts
	 *
	 * Choose when to load fonts from Google.
	 * Allows to load only web fonts included
	 * with this child theme.
	 *
	 * Don't feed The Beast!
	 */
	$wp_customize->add_setting( 'gf_use_google_fonts', [
		'default'	        => 'always',
		'sanitize_callback' => __NAMESPACE__ . '\use_google_fonts'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_use_google_fonts',
		[
			'section'     => 'colors',
			'settings'    => 'gf_use_google_fonts',
			'label'       => __( 'Use Google Fonts', 'go-further' ),
			'description' => __( 'Choose when to load Google fonts.', 'go-further' ),
			'type'        => 'select',
			'choices'     => [
				'always'     => __( 'Always Load Fonts', 'go-further' ),
				'use_local'  => __( 'Only if Not Included', 'go-further' ),
				'never'      => __( 'Never Load Fonts', 'go-further' ),
			]
		]
	) );

	/**
	 * Admin settings
	 *
	 * Choose to use admin theme & color schemes.
	 */
	$wp_customize->add_setting( 'gf_use_admin_theme', [
		'default'	        => false,
		'transport'         => false,
		'sanitize_callback' => __NAMESPACE__ . '\use_admin_theme'
	] );
	$wp_customize->add_control( new \WP_Customize_Control(
		$wp_customize,
		'gf_use_admin_theme',
		[
			'section'     => 'gf_admin',
			'settings'    => 'gf_use_admin_theme',
			'label'       => __( 'Use Admin Theme', 'go-further' ),
			'description' => __( 'Check to apply the active design style to the system\'s administration screens, including user color scheme options.', 'go-further' ),
			'type'        => 'checkbox',
		]
	) );



	/* ------------------- Modify Existing Sections & Controls ------------------ */


	/**
	 * The following rearranges sections and controls from both
	 * the system core and the parent theme. Also change the text
	 * of titles, labels and descriptions.
	 */

	// Move the core Site Identity section to the Site Settings panel.
	$wp_customize->get_section( 'title_tagline' )->panel = 'gf_settings';

	/**
	 * Move the core Colors section to the Design & Layout panel.
	 * The Colors section is renamed Site Design by the parent theme.
	 */
	$wp_customize->get_section( 'colors' )->panel = 'gf_design';

	/**
	 * Move the core Homepage Settings section to the Site Settings panel.
	 * Rename the section and change the description.
	 */
	$wp_customize->get_section( 'static_front_page' )->panel       = 'gf_settings';
	$wp_customize->get_section( 'static_front_page' )->priority    = 30;
	$wp_customize->get_section( 'static_front_page' )->title       = __( 'Front Page & Blog', 'go-further' );
	$wp_customize->get_section( 'static_front_page' )->description = __( 'Customize the front page of the site and how the blog is displayed.', 'go-further' );

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

	/**
	 * Move the parent theme's logo width settings below the cover image logo.
	 * Relabel the settings.
	 */
	$wp_customize->get_control( 'logo_width' )->priority = 20;
	$wp_customize->get_control( 'logo_width_mobile' )->priority = 21;
	$wp_customize->get_control( 'logo_width' )->label = __( 'Logo Width Large Screens', 'go-further' );
	$wp_customize->get_control( 'logo_width_mobile' )->label = __( 'Logo Width Small Screens', 'go-further' );

	// Move blog excerpt setting below other blog settings.
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->priority = 9;

	/**
	 * Move the parent theme's blog excerpt setting to the Front Page & Blog section.
	 * Relabel the setting and change the description.
	 */
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->section = 'static_front_page';
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->priority = 15;
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->label = __( 'Summarize Blog Index', 'go-further' );
	$wp_customize->get_control( 'blog_excerpt_checkbox' )->description = __( 'Check to use post excerpts on the blog index pages.', 'go-further' );

	// Design style color schemes label.
	$wp_customize->get_control( 'color_scheme_control' )->label = __( 'Color Scheme', 'go-further' );

	// Put the parent theme's copyright field into the Site Identity section.
	$wp_customize->get_control( 'copyright_control' )->section = 'title_tagline';
	$wp_customize->get_control( 'copyright_control' )->priority = 25;

	// Background color label.
	$wp_customize->get_control( 'background_color' )->label = __( 'Background', 'go-further' );

	// Put the parent theme's page titles field into the Site Identity section.
	$wp_customize->get_control( 'show_page_title_checkbox' )->section = 'colors';
	$wp_customize->get_control( 'show_page_title_checkbox' )->label = __( 'Display Page Titles', 'go-further' );

	// Put the parent theme's Social section into the core Menus panel.
	$wp_customize->get_section( 'go_social_media' )->panel = 'nav_menus';
	$wp_customize->get_section( 'go_social_media' )->priority = 999;

	// Rename social icons section & color control.
	$wp_customize->get_section( 'go_social_media' )->title = __( 'Social Icons', 'go-further' );
	$wp_customize->get_control( 'social_icon_color_alt' )->label = __( 'Social Icons Color', 'go-further' );

	// Put the social icon color below social link display.
	$wp_customize->get_control( 'social_icon_color_alt' )->priority = 12;

	// Refresh the parent theme's page titles setting.
	$wp_customize->get_setting( 'page_titles' )->transport = 'refresh';

	/**
	 * Priorities of the Site Design/Colors section
	 *
	 * Defined the order (priority) of the controls in the section,
	 * including parent theme controls, to keep the grouped logically.
	 */
	$wp_customize->get_control( 'design_style_control'    )->priority = 0;
	$wp_customize->get_control( 'title_color_scheme'      )->priority = 2;
	$wp_customize->get_control( 'primary_color_control'   )->priority = 4;
	$wp_customize->get_control( 'secondary_color_control' )->priority = 6;
	$wp_customize->get_control( 'tertiary_color_control'  )->priority = 8;
	$wp_customize->get_control( 'background_color'        )->priority = 10;

	$wp_customize->get_control( 'title_header_colors'     )->priority = 20;
	$wp_customize->get_control( 'header_background_color' )->priority = 22;
	$wp_customize->get_control( 'header_text_color'       )->priority = 24;

	$wp_customize->get_control( 'title_footer_widgets_colors'      )->priority = 30;
	$wp_customize->get_control( 'footer_widgets_background_color'  )->priority = 32;
	$wp_customize->get_control( 'footer_widgets_text_color'        )->priority = 34;
	$wp_customize->get_control( 'footer_widgets_heading_color'     )->priority = 36;
	$wp_customize->get_control( 'footer_widgets_link_form_color'   )->priority = 38;
	$wp_customize->get_control( 'footer_widgets_interactive_color' )->priority = 38;

	$wp_customize->get_control( 'title_footer_colors'     )->priority = 40;
	$wp_customize->get_control( 'footer_background_color' )->priority = 42;
	$wp_customize->get_control( 'footer_text_color'       )->priority = 44;
	$wp_customize->get_control( 'footer_heading_color'    )->priority = 46;
	$wp_customize->get_control( 'social_icon_color'       )->priority = 48;

	$wp_customize->get_control( 'title_site_styles' )->priority = 50;
	$wp_customize->get_control( 'viewport_basis'    )->priority = 52;

	$wp_customize->get_control( 'title_site_titles'        )->priority = 60;
	$wp_customize->get_control( 'show_page_title_checkbox' )->priority = 62;
	$wp_customize->get_control( 'gf_use_google_fonts'      )->priority = 70;

	$wp_customize->get_control( 'gf_use_admin_theme' )->priority = 10;
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
		'webp'         => 'image/webp',
		'svg'          => 'image/svg'
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

	// Array of valid inputs.
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

	// Array of valid inputs.
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

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Enqueues the preview js for the customizer.
 *
 * @return void
 */
function customize_preview_init() {

	$suffix = Assets\suffix();

	wp_dequeue_script( 'go-customize-preview' );

	wp_enqueue_script(
		'gf-customize-preview',
		get_theme_file_uri( "assets/js/customize-preview{$suffix}.js" ),
		[ 'jquery', 'wp-autop' ],
		GF_VERSION,
		true
	);

	wp_localize_script(
		'gf-customize-preview',
		'GoPreviewData',
		array(
			'design_styles'       => \Go\Core\get_available_design_styles(),
			'selectedDesignStyle' => get_theme_mod( 'design_style', \Go\Core\get_default_design_style() ),
		)
	);
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

/**
 * Use Google fonts
 *
 * Don't feed The Beast!
 *
 * @since  1.0.0
 * @param  $input
 * @return string Returns the theme mod.
 */
function use_google_fonts( $input ) {

	// Array of valid inputs.
	$valid = [ 'always', 'never', 'use_local' ];

	if ( in_array( $input, $valid ) ) {
		return $input;
	}
	return 'always';
}

/**
 * Use admin theme
 *
 * @since  1.0.0
 * @param  $input
 * @return boolean Returns false by default.
 */
function use_admin_theme( $input ) {

	if ( true == $input ) {
		return true;
	}
	return false;
}

/**
 * Inline CSS
 *
 * Generates the inline CSS from the Customizer settings.
 *
 * @since  1.0.0
 * @return void
 */
function inline_css() {

	// Get theme mods.
	$footer_widgets_background_color  = hex_to_hsl( get_theme_mod( 'footer_widgets_background_color', false ), true );
	$footer_widgets_heading_color     = hex_to_hsl( get_theme_mod( 'footer_widgets_heading_color', false ), true );
	$footer_widgets_text_color        = hex_to_hsl( get_theme_mod( 'footer_widgets_text_color', false ), true );
	$footer_widgets_link_form_color   = hex_to_hsl( get_theme_mod( 'footer_widgets_link_form_color', false ), true );
	$footer_widgets_interactive_color = hex_to_hsl( get_theme_mod( 'footer_widgets_interactive_color', false ), true );

	// Footer widgets background color.
	if ( ! empty( $footer_widgets_background_color ) ) {
		$gf_footer_widgets_background_color = sprintf(
			'hsl(%s)',
			esc_attr( $footer_widgets_background_color )
		);
	} else {
		$gf_footer_widgets_background_color = 'var( --go--color--tertiary )';
	}

	?>
	<style>
		:root {
			--gf-footer-widgets--background-color: <?php echo $gf_footer_widgets_background_color; ?>;

			<?php if ( $footer_widgets_heading_color ) : ?>
				--gf-footer-widgets--heading--color--text: hsl(<?php echo esc_attr( $footer_widgets_heading_color ); ?>);
			<?php endif; ?>
			<?php if ( $footer_widgets_text_color ) : ?>
				--gf-footer-widgets--color--text: hsl(<?php echo esc_attr( $footer_widgets_text_color ); ?>);
				--gf-footer-widgets--input--border-color: hsl(<?php echo esc_attr( $footer_widgets_text_color ); ?>);
			<?php endif; ?>
			<?php if ( $footer_widgets_link_form_color ) : ?>
				--gf-footer-widgets--hyperlink--color--text: hsl(<?php echo esc_attr( $footer_widgets_link_form_color ); ?>);
				--gf-footer-widgets--button--color--background: hsl(<?php echo esc_attr( $footer_widgets_link_form_color ); ?>);
			<?php endif; ?>
			<?php if ( $footer_widgets_interactive_color ) : ?>
				--gf-footer-widgets--hyperlink-interactive--color--text: hsl(<?php echo esc_attr( $footer_widgets_interactive_color ); ?>);
				--gf-footer-widgets--button-interactive--color--background: hsl(<?php echo esc_attr( $footer_widgets_interactive_color ); ?>);
				--gf-footer-widgets--input-interactive--color--border-color: hsl(<?php echo esc_attr( $footer_widgets_interactive_color ); ?>);
			<?php endif; ?>
		}
	</style>
	<?php
}
