<?php
/**
 * Frontend template tags
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Frontend
 * @since      1.0.0
 */

namespace GoFurther\Front;

use GoFurther\Customize as Customize;

use function \Go\hex_to_hsl;

/**
 * Page title
 *
 * Displays the page title markup
 *
 * @since  1.0.0
 * @return mixed Returns the markup for the page title
 */
function page_title() {

	$show_titles = (bool) get_theme_mod( 'page_titles', true );
	$non_archive = ! is_404() && ! is_search() && ! is_archive();
	$is_shop     = function_exists( 'is_shop' ) && is_shop(); // WooCommerce shop.

	if ( ! is_customize_preview() && ! $show_titles && ( $non_archive || $is_shop ) ) {
		return;
	}

	if ( is_front_page() ) {
		$wrapper = 'h2';
	} else {
		$wrapper = 'h1';
	}

	$args = (array) apply_filters(
		'go_page_title_args',
		[
			'title'   => get_the_title(),
			'wrapper' => $wrapper,
			'atts'    => [
				'class' => 'post__title m-0 text-center',
			],
			'custom'  => false,
		]
	);

	/**
	 * When $args['custom'] is true, this function will short circuit and output
	 * the value of $args['title']
	 */
	if ( $args['custom'] ) {
		echo wp_kses_post( $args['title'] );
		return;
	}

	if ( empty( $args['title'] ) ) {
		return;
	}

	$args['atts'] = empty( $args['atts'] ) ? [] : (array) $args['atts'];

	foreach ( $args['atts'] as $key => $value ) {
		$args['classes'][] = sprintf( '%s="%s"', sanitize_key( $key ), esc_attr( $value ) );
	}

	$blog_title = get_blog_title();
	if ( is_home() ) {
		$title = esc_html( $blog_title );
	} else {
		$title = esc_html( $args['title'] );
	}

	if ( ! empty( $args['wrapper'] ) ) {

		$title = sprintf(
			'<%1$s %2$s>%3$s</%1$s>',
			sanitize_key( $args['wrapper'] ),
			implode( ' ', $args['classes'] ),
			$title
		);
	}

	foreach ( array_keys( $args['atts'] ) as $index => $attribute ) {
		$args['atts'][ $attribute ] = [];
	}

	printf(
		'<header class="page-header entry-header m-auto px %1$s">%2$s%3$s</header>',
		is_customize_preview() ? ( get_theme_mod( 'page_titles', true ) ? '' : 'display-none' ) : '',
		wp_kses(
			$title,
			[
				$args['wrapper'] => $args['atts'],
			]
		),
		page_subtitle( '<p class="post__subtitle m-0 text-center">', '</p>', false )
	);
}

/**
 * Get blog title
 *
 * @since  1.0.0
 * @return mixed Returns the text of the title or null.
 */
function get_blog_title() {

	$title      = __( 'Latest Blog Posts', 'go-further' );
	$blog_page  = (int) get_option( 'page_for_posts' );
	$blog_title = get_theme_mod( 'gf_blog_title' );

	if ( ! empty( $blog_page ) ) {
		$title = get_the_title( $blog_page );
	} elseif ( $blog_title ) {
		$title = $blog_title;
	}

	return apply_filters( 'gf_get_blog_title', $title );
}

/**
 * Get the subtitle
 *
 * @since  1.0.0
 * @return mixed Returns the text of the subtitle or null.
 */
function get_page_subtitle() {

	$subtitle      = '';
	$blog_page     = (int) get_option( 'page_for_posts' );
	$blog_subtitle = get_theme_mod( 'gf_blog_subtitle' );

	if (
		is_home() &&
		! empty( $blog_page ) &&
		has_excerpt( $blog_page )
	) {
		$subtitle = wp_strip_all_tags( get_the_excerpt( $blog_page ), true );

	} elseif (
			is_home() &&
			! empty( $blog_subtitle )
		) {
			$subtitle = esc_html( $blog_subtitle );

	} elseif (
		is_singular() &&
		post_type_supports( get_post_type( get_the_ID() ), 'excerpt' ) &&
		has_excerpt( get_the_ID() )
	) {
		$subtitle = wp_strip_all_tags( get_the_excerpt( get_the_ID() ), true );
	}

	return apply_filters( 'gf_get_page_subtitle', $subtitle );
}

/**
 * The subtitle
 *
 * Display or retrieve the current post subtitle with optional markup.
 *
 * @since  1.0.0
 * @param  string $before Optional. Markup to prepend to the title. Default empty.
 * @param  string $after Optional. Markup to append to the title. Default empty.
 * @param  bool $echo Optional. Whether to echo or return the title. Default true for echo.
 * @return void|string Void if `$echo` argument is true, current post title if `$echo` is false.
 */
function page_subtitle( $before = '', $after = '', $echo = true ) {

	$subtitle = get_page_subtitle();

	if ( 0 == strlen( $subtitle ) ) {
		return;
	}

	$subtitle = $before . $subtitle . $after;

	if ( $echo ) {
		echo $subtitle;
	} else {
		return $subtitle;
	}
}

/**
 * Get palette color
 *
 * Returns the color selected by the user.
 *
 * @since  1.0.0
 * @param  string $color  Which color to return.
 * @param  string $format The format to return the color. Possible Values: RGB (default), HSL (returns an array) or HEX.
 * @return string|array|bool A string with the RGB value or an array containing the HSL values.
 */
function get_palette_color( $color, $format = 'RGB' ) {
	$default         = \Go\Core\get_default_color_scheme();
	$color_scheme    = get_theme_mod( 'color_scheme', $default );
	$override_colors = [
		'primary'                   => 'primary_color',
		'secondary'                 => 'secondary_color',
		'tertiary'                  => 'tertiary_color',
		'background'                => 'background_color',
		'header_background'         => 'header_background_color',
		'footer_widgets_background' => 'footer_widgets_background_color',
		'footer_background'         => 'footer_background_color'
	];

	$color_override = get_theme_mod( $override_colors[ $color ] );

	$avaliable_color_schemes = \Go\Core\get_available_color_schemes();

	$the_color = '';

	if ( $color_scheme && isset( $avaliable_color_schemes[ $color_scheme ] ) && isset( $avaliable_color_schemes[ $color_scheme ][ $color ] ) ) {
		$the_color = $avaliable_color_schemes[ $color_scheme ][ $color ];
	}

	if ( $color_override ) {
		$the_color = $color_override;
	}

	if ( ! empty( $the_color ) ) {

			// Ensure we have a hash mark at the beginning of the hex value.
		$the_color = '#' . ltrim( $the_color, '#' );

		if ( 'HSL' === $format ) {
			return \Go\hex_to_hsl( $the_color );
		}

		if ( 'RGB' === $format ) {
			return \Go\hex_to_rgb( $the_color );
		}

		if ( 'HEX' === $format ) {
			return $the_color;
		}
	}

	return $the_color;
}

/**
 * Has footer widgets background
 *
 * @since  1.0.0
 * @return boolean Returns whether there is a footer background or not.
 */
function has_footer_widgets_background() {

	$background_color = get_palette_color( 'footer_widgets_background' );

	if ( $background_color ) {
		return true;
	}
	return false;
}

/**
 * Has sticky header
 *
 * Determines whether the sticky header option
 * is enabled in the customizer.
 *
 * @since  1.0.0
 * @return boolean Returns true if the option is enabled.
 */
function has_sticky_header() {

	// Get the navigation location setting from the Customizer.
	$sticky = Customize\sticky_header( get_theme_mod( 'gf_sticky_header' ) );

	if ( $sticky ) {
		return true;
	}
	return false;
}

/**
 * Blog first page
 *
 * Determines whether on the first page of the blog,
 * paged or not.
 *
 * @since  1.0.0
 * @return boolean Returns true if on the first page.
 */
function blog_first_page() {

	// Check if the blog is paged.
	$paged = get_query_var( 'paged' );

	// Return true if on the first page.
	if (
		is_home() &&
		is_main_query() &&
		( ! is_paged() || ( is_paged() && 1 == $paged ) )
	) {
		return true;
	}

	// Return false by default.
	return false;
}

/**
 * Has cover image
 *
 * Determines whether the page should display
 * the full, cover-image intro.
 *
 * @since  1.0.0
 * @return boolean Returns true if the cover image should be used.
 */
function has_cover_image() {

	// Default to false.
	$cover = false;

	// Get blog data.
	$blog  = (int) get_option( 'page_for_posts' );

	// Get blog settings from the customizer.
	$blog_image = Customize\blog_image_display( get_theme_mod( 'gf_blog_image_display' ) );

	// If the blog is set to use the cover image on the first page.
	if (
		blog_first_page() &&
		blog_has_image() &&
		( 'cover' == $blog_image || 'mixed' == $blog_image )
	) {
		$cover = true;
	}

	// If the 'Cover Image' template is used (page & post).
	if (
		is_singular( get_post_type( get_the_ID() ) ) &&
		is_page_template( 'templates/cover-image.php' ) &&
		has_post_thumbnail( get_the_ID() )
	) {
		$cover = true;
	}

	return apply_filters( 'gf_has_cover_image', $cover );
}

/**
 * Featured image class
 *
 * Adds a `contained` class to the featured image figure element
 * if the post option is enabled.
 *
 * @since  1.0.0
 * @return array Returns a modified array of body classes.
 */
function featured_class() {

	// Get the author section display setting from the Customizer.
	$contain_featured = Customize\contain_featured( get_theme_mod( 'gf_contain_featured' ) );

	$classes = [];
	$options = get_post_meta( get_the_ID(), 'gf_post_options', true );
	$enable  = $options ? in_array( 'enable_contain_featured', $options, true ) : false;
	$disable = $options ? in_array( 'disable_contain_featured', $options, true ) : false;

	if ( 'never' != $contain_featured ) {
		if (
			'always' == $contain_featured ||
			( 'enable_per'  == $contain_featured && true == $enable ) ||
			( 'disable_per' == $contain_featured && true != $disable )
		) {
			$classes[] .= 'contained';
		}
	}

	if ( has_cover_image() ) {
		$classes[] .= 'cover-image';
	} else {
		$classes[] .= 'page-banner';
	}

	return implode( ' ', $classes );
}

/**
 * Display the blog image
 *
 * Whether and when to display the blog image.
 *
 * @since  1.0.0
 * @return boolean
 */
function display_blog_image() {

	// Get blog data.
	$blog  = (int) get_option( 'page_for_posts' );
	$paged = get_query_var( 'paged' );

	// Get blog settings from the customizer.
	$image_display = Customize\blog_image_display( get_theme_mod( 'gf_blog_image_display' ) );

	// Default customizer setting is `never`.
	$display = false;

	if ( 'always' == $image_display || 'mixed' == $image_display ) {
		$display = true;
	} elseif (
		( 'banner' == $image_display || 'cover' == $image_display ) &&
		is_main_query() &&
		( ! is_paged() || ( is_paged() && 1 == $paged ) )
	) {
		$display = true;
	}

	return $display;
}

/**
 * Blog has image
 *
 * Determines whether the blog has a featured
 * image available. This is crucial for the
 * cover image options and header display.
 *
 * @since  1.0.0
 * @return boolean Returns true if an image is available.
 */
function blog_has_image() {

	// Get blog display settings.
	$blog  = (int) get_option( 'page_for_posts' );

	// Get blog settings from the customizer.
	$blog_image    = get_theme_mod( 'gf_blog_image' );
	$display_image = display_blog_image();

	// Default to false.
	$image = false;

	// If a blog page is set and it has a featured image.
	if ( $blog && has_post_thumbnail( $blog ) ) {
		$image = true;

	// If a blog image is set in the customizer.
	} elseif ( $blog_image ) {
		$image = true;
	}

	// Apply a filter for unforeseen conditions.
	return apply_filters( 'gf_blog_has_image', $image );
}

/**
 * Has classic widgets
 *
 * Determines whether to use the classic widgets
 * interfaces rather than block widgets.
 *
 * @since  1.0.0
 * @return void
 */
function has_classic_widgets() {

	// Get the classic widgets setting from the Customizer.
	$classic = Customize\classic_widgets( get_theme_mod( 'gf_classic_widgets' ) );

	// Return true if ClassicPress is running.
	if ( $classic || function_exists( 'classicpress_version' ) ) {
		return true;
	}
	return false;
}

/**
 * Footer widgets active
 *
 * Check if any of the footer sidebars are active.
 *
 * @since  1.0.0
 * @access public
 * @return boolean Returns true if any of the footer sidebars are active.
 */
function has_active_footer_sidebars() {

	// Get the array footer sidebars.
	$get_sidebars = get_footer_sidebars();

	// Loop sidebars and return true if/when an active one is found.
	foreach ( (array) $get_sidebars as $sidebar ) {
		if ( is_active_sidebar( $sidebar ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Get registered footer sidebars
 *
 * Only returns sidebars with `footer` in the ID.
 *
 * @since  1.0.0
 * @global array $wp_registered_sidebars
 * @return array Returns an array of footer IDs.
 */
function get_footer_sidebars() {

	// Access global variables.
	global $wp_registered_sidebars;

	// Start with an empty array.
	$id = [];

	// For each registered sidebar.
	foreach ( (array) $wp_registered_sidebars as $sidebar ) {

		// Look for `footer` in the sidebar ID.
		$footer = strpos( $sidebar['id'], 'footer' );

		// ID is null if `footer` is not found in the ID.
		if ( false === $footer ) {
			$id[] = null;

		// ID with `footer`.
		} else {
			$id[] = $sidebar['id'];
		}
	}

	// Return an array of footer IDs.
	return $id;
}

/**
 * Footer widgets class
 *
 * Adds classes to the footer widgets area, if active.
 *
 * @since  1.0.0
 * @return string Returns various widget classes.
 */
function footer_widgets_class() {

	// Get the array footer sidebars.
	$get_sidebars = get_footer_sidebars();

	$class    = [];
	$class[] .= 'footer-widgets';
	$count    = 0;

	// For each registered sidebar.
	foreach ( (array) $get_sidebars as $sidebar ) {

		// Count active sidebars.
		if ( is_active_sidebar( $sidebar ) ) {
			$count = $count + 1;
		}
	}

	// Add widgets type class.
	if ( has_classic_widgets() ) {
		$class[] .= 'classic-widgets';
	} else {
		$class[] .= 'block-widgets';
	}

	// Add a background class.
	if ( has_footer_widgets_background() ) {
		$class[] .= 'has-background';
	}

	// Add sidebars active class.
	$class[] .= 'sidebars-active--' . $count;

	// Return a string of widget classes.
	return implode( ' ', $class );
}

/**
 * Print footer widget areas
 *
 * Only prints widgets for registered sidebars with
 * `footer` in the ID.
 *
 * @since  1.0.0
 * @return void
 */
function footer_widgets() {

	// Get the array footer sidebars.
	$get_sidebars = get_footer_sidebars();

	// Stop here if no footer sidebars.
	if ( empty( $get_sidebars ) ) {
		return;
	}

	// Set up sidebar counter.
	$sidebar_count = 0;

	// For each registered footer sidebar.
	foreach ( (array) $get_sidebars as $sidebar ) {

		// Count sidebars for id attribute.
		$sidebar_count = $sidebar_count + 1;

		// Don't allow more than four widget areas.
		if ( $sidebar_count > 4 ) {
			return;
		}

		// Print a widget area and widgets if the sidebar is active.
		if ( is_active_sidebar( $sidebar ) ) {
			printf(
				'<div id="widgets-grid-%s" class="widgets-grid-item">',
				$sidebar_count
			);
			dynamic_sidebar( $sidebar );
			echo '</div>';
		}
	}
}
