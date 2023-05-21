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

use function \GoFurther\Assets\suffix;
use function \Go\Core\get_design_style;

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

	/**
	 * Unregister core color schemes and color schemes from the
	 * Admin Color Schemes plugin. Then register theme color schemes.
	 */
	add_action( 'admin_init', $n( 'remove_admin_color_scheme_picker' ), 9 );
	add_action( 'admin_init', $n( 'register_admin_color_schemes' ) );

	// Remove the default "Fresh" color scheme & add new stylesheet URIs.
	remove_filter( 'style_loader_src', 'wp_style_loader_src' );
	add_filter( 'style_loader_src', $n( 'style_loader_src' ), 11, 2 );

	// Enable a new color picker to match the customizer.
	add_action( 'admin_color_scheme_picker', $n( 'admin_color_scheme_picker' ) );

	if ( ! is_customize_preview() ) {
		add_action( 'admin_enqueue_scripts', 'GoFurther\Assets\admin_styles' );
	}
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

	$design_style  = get_design_style();
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
 * Used when the current user has not selected
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

	$suffix = suffix();
	$design = get_design_style();
	$style  = $design['slug'];

	return apply_filters(
		'gf_get_color_scheme_url',
		get_stylesheet_directory_uri() . "/assets/css/admin/design-styles/$style/colors/$scheme/colors$suffix.css"
	);
}

/**
 * Administration Screen CSS for changing the styles.
 *
 * If installing the 'wp-admin/' directory will be replaced with './'.
 *
 * @since  1.0.0
 * @param  string $src    Source URL.
 * @param  string $handle Either 'colors' or 'colors-rtl'.
 * @return string|false URL path to CSS stylesheet for Administration Screens.
 */
function style_loader_src( $src, $handle ) {

	$default = default_color_scheme();
	$user    = get_user_option( 'admin_color', get_current_user_id() );
	$active  = get_active_color_schemes();
	$suffix  = suffix();

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

	$get_design_style = get_design_style();
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
			_x( $label, 'admin color scheme', 'go-further' ),
			get_color_scheme_url( $slug ),
			[
				$scheme['primary'],
				$scheme['secondary'],
				$scheme['tertiary']
			]
		);
	}
}

/**
 * Remove admin color scheme picker
 *
 * @since  1.0.0
 * @return void
 */
function remove_admin_color_scheme_picker() {
	remove_action( 'admin_init', 'register_admin_color_schemes' );
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
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
 * @return void
 */
function admin_color_scheme_picker() {

	$get_design_style = get_design_style();
	$color_schemes    = $get_design_style['color_schemes'];

	// Sort color scheme alphabetically.
	asort( $color_schemes );

	$legend = sprintf(
		'%1s %2s',
		$get_design_style['label'],
		__( 'Color Schemes', 'go-further' )
	);

	$current = get_user_option( 'admin_color', get_current_user_id() );
	if ( ! in_array( $current, get_active_color_schemes() ) ) {
		$current = default_color_scheme();
	}

	?>
	<fieldset id="color-picker" class="scheme-list">

		<legend class="screen-reader-text"><span><?php echo $legend; ?></span></legend>

		<div class="switcher__wrapper">
		<?php

		wp_nonce_field( 'save-color-scheme', 'color-nonce', false );

		foreach ( $color_schemes as $scheme ) :

			$label   = $scheme['label'];
			$slug    = strtolower( str_replace( ' ', '-', $label ) );

			$background = sprintf(
				'linear-gradient( to right, %s 0&#37;, %s 33.33325&#37;, %s 33.33325&#37;, %s 66.66675&#37;, %s 66.66675&#37;, %s 100&#37; )',
				$scheme['primary'],
				$scheme['primary'],
				$scheme['secondary'],
				$scheme['secondary'],
				$scheme['tertiary'],
				$scheme['tertiary']
			);

		?>
			<div style="background-image: <?php echo $background; ?>" class="switcher__choice color_scheme color-option <?php echo ( $slug == $current ) ? 'selected' : ''; ?>">
				<input name="admin_color" id="admin_color_<?php echo esc_attr( $slug ); ?>" type="radio" value="<?php echo esc_attr( $slug ); ?>" class="tog" <?php checked( $slug, $current ); ?> />
				<input type="hidden" class="css_url" value="<?php echo esc_attr( esc_url( get_color_scheme_url( $slug ) ) ); ?>" />
				<input type="hidden" class="icon_colors" value="<?php echo esc_attr( $slug ); ?>" />
				<label for="admin_color_<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?><span class="color-scheme__check"></span></label>
			</div>
		<?php endforeach; ?>
		</div>
	</fieldset>
	<?php
}
