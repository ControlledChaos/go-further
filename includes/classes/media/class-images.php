<?php
/**
 * Images and galleries
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Media
 * @since      1.0.0
 */

namespace GoFurther\Classes\Media;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Images {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Stop adding inline styles to figure element.
		add_filter( 'img_caption_shortcode_width', '__return_false' );

		// Add image sizes.
		add_action( 'after_setup_theme', [ $this, 'image_sizes' ] );

		// Add image sizes to insert media UI.
		add_filter( 'image_size_names_choose', [ $this, 'insert_image_sizes' ] );
	}

	/**
	 * Add image sizes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function image_sizes() {

		// Center image crop.
		$center = [
			'center',
			'center'
		];

		// Set the post thumbnail size, 16:9.
		set_post_thumbnail_size( 1280, 720, $center );

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

		// 16:9 for cover image templates.
		add_image_size( 'cover-image-full', 1920, 1080, $center );
		add_image_size( 'cover-image-small', 960, 540, $center );

		// 16:9 HD Video.
		add_image_size( 'large-video', 1280, 720, $center );
		add_image_size( 'medium-video', 960, 540, $center );
		add_image_size( 'small-video', 640, 360, $center );
		add_image_size( 'thumbnail-video', 320, 180, $center );
	}

	/**
	 * Add image sizes to media UI
	 *
	 * Adds custom image sizes to "Insert Media" user interface
	 * and adds custom class to the `<img>` tag.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $sizes Gets the array of image size names.
	 * @global array $_wp_additional_image_sizes Gets the array of custom image size names.
	 * @return array $sizes Returns an array of image size names.
	 */
	public function insert_image_sizes( $sizes ) {

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
}
