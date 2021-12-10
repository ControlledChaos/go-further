<?php
/**
 * Images, galleries, and other media
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Media
 * @since      1.0.0
 */

namespace GoFurther\Media;

// Alias namespaces.
use GoFurther\Front as Front;

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

	add_action( 'after_setup_theme', $n( 'image_sizes' ) );
	add_filter( 'image_size_names_choose', $n( 'insert_image_sizes' ) );
	add_filter( 'get_custom_logo', $n( 'custom_logo' ) );
}

/**
 * Add image sizes
 *
 * @since  1.0.0
 * @return void
 */
function image_sizes() {

	// Center image crop.
	$center = [
		'center',
		'center'
	];

	/**
	 * Add image sizes
	 *
	 * Three sizes per aspect ratio so that srcset
	 * will be used for responsive images.
	 *
	 * @since 1.0.0
	 */

	// 1:1 square. Includes core thumbnail size.
	update_option( 'thumbnail_size_w', 160 );
	update_option( 'thumbnail_size_h', 160 );
	update_option( 'thumbnail_crop', 1 );
	add_image_size( 'large-thumbnail', 240, 240, $center );
	add_image_size( 'x-large-thumbnail', 320, 320, $center );

	// 16:9 for featured images.
	add_image_size( 'cover-image-full', 2048, 1152, $center );
	add_image_size( 'cover-image-medium', 1536, 864, $center );
	add_image_size( 'cover-image-small', 960, 540, $center );

	// 16:9 HD Video.
	add_image_size( 'large-video', 1280, 720, $center );
	add_image_size( 'medium-video', 960, 540, $center );
	add_image_size( 'small-video', 640, 360, $center );
	add_image_size( 'thumbnail-video', 320, 180, $center );

	// Set the post thumbnail size, 16:9.
	set_post_thumbnail_size( 1920, 1080, $center );
}

/**
 * Add image sizes to media UI
 *
 * Adds custom image sizes to "Insert Media" user interface
 * and adds custom class to the `<img>` tag.
 *
 * @since  1.0.0
 * @param  array $sizes Gets the array of image size names.
 * @global array $_wp_additional_image_sizes Gets the array of custom image size names.
 * @return array $sizes Returns an array of image size names.
 */
function insert_image_sizes( $sizes ) {

	// Access global variables.
	global $_wp_additional_image_sizes;

	// Return default sizes if no custom sizes.
	if ( empty( $_wp_additional_image_sizes ) ) {
		return $sizes;
	}

	// Capitalize custom image size names and remove hyphens.
	foreach ( $_wp_additional_image_sizes as $id => $data ) {

		if ( ! isset( $sizes[$id] ) ) {
			$sizes[$id] = ucwords( str_replace( '-', ' ', $id ) );
		}
	}

	// Return the modified array of sizes.
	return $sizes;
}

/**
 * Conditional logos
 *
 * Get logos for specified templates.
 *
 * @since  1.0.0
 * @access public
 * @param  string $html
 * @return string Returns the markup of the logo.
 */
function custom_logo ( $html ) {

	// Get logos & logo link URL.
	$wrap_class  = [ 'custom-logo-wrap' ];
	$logo        = null;
	$logo_link   = site_url( '/' );
	$custom_logo = get_theme_mod( 'custom_logo' );
	$cover_logo  = get_theme_mod( 'gf_cover_logo' );
	$post_type   = get_post_type( get_the_ID() );

	// Stop here if no logo is found.
	if ( empty( $custom_logo ) ) {
		return;
	}

	// Default logo markup.
	$logo = wp_get_attachment_image(
		$custom_logo,
		'full',
		false,
		[
			'class' => 'custom-logo default-logo',
		]
	);

	// Cover logo markup, if image is available.
	if ( $cover_logo ) {

		/**
		 * If the Cover Image template is assigned and
		 * the cover image logo is set.
		 */
		if (
			is_singular( $post_type ) &&
			post_type_supports( $post_type, 'thumbnail' ) &&
			has_post_thumbnail( get_the_ID() ) &&
			Front\has_cover_image()
		) {
			$wrap_class[] .= 'has-cover-logo';

			$logo .= wp_get_attachment_image(
				$cover_logo,
				'full',
				false,
				[
					'class' => 'custom-logo cover-logo',
				]
			);

		/**
		 * If the blog page is assigned the cover image and
		 * the cover image logo is set.
		 */
		} elseif (
			! is_singular() &&
			Front\has_cover_image()
		) {
			$wrap_class[] .= 'has-cover-logo';

			$logo .= wp_get_attachment_image(
				$cover_logo,
				'full',
				false,
				[
					'class' => 'custom-logo cover-logo',
				]
			);
		}
	} // if ( $cover_logo )

	// Compile the wrapper classes.
	$wrap_class = implode( ' ', $wrap_class );

	// The markup of the linked logo.
	$html = sprintf(
		'<div class="%1$s"><a href="%2$s" class="custom-logo-link" rel="home" itemprop="url">%3$s</a></div>',
		$wrap_class,
		esc_url( $logo_link  ),
		$logo
	);

	// Return the markup of the logo with a filter applied.
	return apply_filters( 'gf_custom_logo', $html );
}
