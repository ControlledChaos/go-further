<?php
/**
 * Admin functions
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Admin
 * @since      1.0.0
 */

namespace GoFurther\Admin;

use GoFurther\Core      as Core,
	GoFurther\Front     as Front,
	GoFurther\Customize as Customize,
	GoFurther\Styles    as Styles,
	GoFurther\Assets    as Assets;

use function \Go\Core\fonts_url;

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

	// Enqueue admin stylesheets.
	if ( ! is_customize_preview() ) {
		add_action( 'admin_enqueue_scripts', $n( 'admin_styles' ) );
	}

	/**
	 * Unregister core color schemes and color schemes from the
	 * Admin Color Schemes plugin. Then register theme color schemes.
	 */
	remove_action( 'admin_init', 'register_admin_color_schemes', 1 );
	remove_action( 'admin_init', 'ACS_Color_Schemes\add_colors' );
	add_action( 'admin_init', $n( 'register_admin_color_schemes' ), 1 );

	// Remove the default "Fresh" color scheme & add new stylesheet URIs.
	remove_filter( 'style_loader_src', 'wp_style_loader_src' );
	add_filter( 'style_loader_src', $n( 'style_loader_src' ), 11, 2 );

	// Disable the default color picker & enable a new one to match the customizer.
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
	add_action( 'admin_color_scheme_picker', $n( 'admin_color_scheme_picker' ) );
}

/**
 * Admin styles
 *
 * @since  1.0.0
 * @global $pagenow Access the current admin screen.
 * @return void
 */
function admin_styles() {

	global $pagenow;

	$suffix       = Assets\suffix();
	$fonts_url    = fonts_url();
	$get_design   = \Go\Core\get_design_style();
	$design_style = $get_design['slug'];

	// Enqueue Google fonts if available & customizer is set to use.
	if ( ! empty( $fonts_url && Core\use_google_fonts() ) ) {
		wp_enqueue_style( 'go-fonts', $fonts_url, [], GF_VERSION );
	}

	// Styles for the replacement color picker.
	if ( 'profile.php' == $pagenow || 'user-edit.php' == $pagenow ) {
		wp_enqueue_style( 'gf-color-picker', get_theme_file_uri( "/assets/css/admin/color-picker$suffix.css" ), [], GF_VERSION, 'all' );
	}

	// Global styles for all design styles & color schemes.
	wp_enqueue_style( 'gf-colors-shared', get_theme_file_uri( "/assets/css/admin/colors/shared$suffix.css" ), [], GF_VERSION, 'all' );
	wp_enqueue_style( 'gf-typography-shared', get_theme_file_uri( "/assets/css/admin/typography/shared$suffix.css" ), [], GF_VERSION, 'all' );

	// Typography stylesheet for the active design style.
	wp_enqueue_style( 'gf-typography', get_theme_file_uri( "/assets/css/admin/typography/design-styles/$design_style/typography$suffix.css" ), [], GF_VERSION, 'all' );
}

/**
 * Get active color schemes
 *
 * Returns an array of color scheme slugs/IDs
 * for the active design style.
 *
 * @since  1.0.0
 * @return array Returns an array of color scheme IDs/slugs
 */
function get_active_color_schemes() {

	$design_style  = \Go\Core\get_design_style();
	$style_schemes = $design_style['color_schemes'];
	$color_schemes = [];

	foreach ( $style_schemes as $scheme ) {
		$label = $scheme['label'];
		$color_schemes[] = strtolower( str_replace( ' ', '-', $label ) );
	}
	return $color_schemes;
}

/**
 * Default admin color scheme
 *
 * Provides a slug/ID for the first color scheme
 * of the active design style.
 *
 * Used when the current user has not yet selected
 * a color scheme as their preference.
 *
 * @since  1.0.0
 * @return string Returns an ID for the color scheme based on its name.
 */
function default_color_scheme() {
	return current( get_active_color_schemes() );
}

/**
 * Get admin color scheme file
 *
 * @since  1.0.0
 * @return string Returns a filtered directory.
 */
function get_color_scheme_url( $scheme ) {

	$suffix  = Assets\suffix();

	return apply_filters(
		'gf_get_color_scheme_url',
		get_stylesheet_directory_uri() . "/assets/css/admin/colors/$scheme/colors$suffix.css"
	);
}

/**
 * Administration Screen CSS for changing the styles.
 *
 * If installing the 'wp-admin/' directory will be replaced with './'.
 *
 * The $_wp_admin_css_colors global manages the Administration Screens CSS
 * stylesheet that is loaded. The option that is set is 'admin_color' and is the
 * color and key for the array. The value for the color key is an object with
 * a 'url' parameter that has the URL path to the CSS file.
 *
 * The query from $src parameter will be appended to the URL that is given from
 * the $_wp_admin_css_colors array value URL.
 *
 * @since  1.0.0
 * @global array $_wp_admin_css_colors
 * @param  string $src    Source URL.
 * @param  string $handle Either 'colors' or 'colors-rtl'.
 * @return string|false URL path to CSS stylesheet for Administration Screens.
 */
function style_loader_src( $src, $handle ) {

	$default = default_color_scheme();
	$user    = get_user_option( 'admin_color', get_current_user_id() );
	$active  = get_active_color_schemes();
	$suffix  = Assets\suffix();

	if ( $user && in_array( $user, $active ) ) {
		$slug = $user;
	} else {
		$slug = $default;
	}

	if ( 'colors' === $handle ) {
		return get_color_scheme_url( $slug );
	}
	return $src;
}

/**
 * Register color schemes
 *
 * Adds an admin color scheme for each option
 * in the active design style.
 *
 * @since  1.0.0
 * @return void
 */
function register_admin_color_schemes() {

	$get_design_style = \Go\Core\get_design_style();
	$color_schemes    = $get_design_style['color_schemes'];

	// Sort color scheme alphabetically.
	asort( $color_schemes );

	/**
	 * Add an admin color scheme for each option
	 * in the active design style.
	 */
	foreach ( $color_schemes as $scheme ) {

		$label = $scheme['label'];
		$slug  = strtolower( str_replace( ' ', '-', $label ) );

		wp_admin_css_color(
			$slug,
			_x( $label, 'admin color scheme' ),
			get_color_scheme_url( $slug ),
			[
				$scheme['primary'],
				$scheme['secondary'],
				$scheme['tertiary']
			],
			[
				'base'    => '',
				'focus'   => '',
				'current' => ''
			]
		);
	}
}

/**
 * Color scheme picker
 *
 * Replaces the default admin color scheme picker (used in
 * user-edit.php) with color schemes from the active
 * design style of the parent theme and this theme.
 *
 * If the active design style only has one option then
 * the picker will not be displayed.
 *
 * @since  1.0.0
 * @global array $_wp_admin_css_colors
 * @param  int $user_id User ID.
 * @return void
 */
function admin_color_scheme_picker( $user_id ) {

	global $_wp_admin_css_colors;

	$current_scheme   = get_user_option( 'admin_color', $user_id );
	$get_design_style = \Go\Core\get_design_style();

	if ( empty( $current_scheme ) || ! isset( $_wp_admin_css_colors[ $current_scheme ] ) ) {
		$current_scheme = default_color_scheme();
	}

	$legend = sprintf(
		'%1s %2s',
		$get_design_style['label'],
		__( 'Color Schemes', 'go-further' )
	);

	?>
	<fieldset id="color-picker" class="scheme-list">

		<legend class="screen-reader-text"><span><?php echo $legend; ?></span></legend>

		<div class="switcher__wrapper">
		<?php

		wp_nonce_field( 'save-color-scheme', 'color-nonce', false );

		foreach ( $_wp_admin_css_colors as $color => $color_info ) :

			// Set up an array of colors.
			$colors = [];
			foreach ( $color_info->colors as $html_color ) {
				$colors[] = $html_color;
			}

			// Shouldn't need to count the colors array but just in case...
			if ( 3 >= count( $colors ) ) {
				$background = sprintf(
					'linear-gradient( to right, %s 0&#37;, %s 33.33325&#37;, %s 33.33325&#37;, %s 66.66675&#37;, %s 66.66675&#37;, %s 100&#37; )',
					$colors[0],
					$colors[0],
					$colors[1],
					$colors[1],
					$colors[2],
					$colors[2]
				);

			// Some tolerable background if color count is less than three.
			} else {
				$background = 'linear-gradient( to bottom, #888888 0%, #000000 100% )';
			}
		?>
			<div style="background-image: <?php echo $background; ?>" class="switcher__choice color_scheme color-option <?php echo ( $color == $current_scheme ) ? 'selected' : ''; ?>">
				<input name="admin_color" id="admin_color_<?php echo esc_attr( $color ); ?>" type="radio" value="<?php echo esc_attr( $color ); ?>" class="tog" <?php checked( $color, $current_scheme ); ?> />
				<input type="hidden" class="css_url" value="<?php echo esc_url( $color_info->url ); ?>" />
				<input type="hidden" class="icon_colors" value="<?php echo esc_attr( wp_json_encode( array( 'icons' => $color_info->icon_colors ) ) ); ?>" />
				<label for="admin_color_<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $color_info->name ); ?><span class="color-scheme__check"></span></label>
			</div>
		<?php endforeach; ?>
		</div>
	</fieldset>
	<?php
}
