<?php
/**
 * Theme templates
 *
 * For post type templates for custom display.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace GoFurther\Classes\Front;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Theme_Templates {

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Conditional logos.
		add_filter( 'get_custom_logo',  [ $this, 'custom_logo' ] );
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
	public function custom_logo ( $html ) {

		// Get logos & logo link URL.
		$logo    = null;
		$url     = site_url( '/' );
		$cover   = get_theme_mod( 'gft_cover_logo' );
		$default = get_theme_mod( 'custom_logo' );

		/**
		 * If the Cover Image template is assigned and
		 * the cover image logo is set.
		 */
		if ( is_page_template( 'templates/cover-image.php' ) && $cover ) {
			$logo = $cover;

		/**
		 * If the Cover Image template is assigned and
		 * no cover image logo is set.
		 */
		} elseif ( is_page_template( 'templates/cover-image.php' ) && ! $cover ) {
			$logo = $default;

		/**
		 * If the Default template is assigned and
		 * the default logo is set.
		 */
		} elseif ( $default ) {
			$logo = $default;
		}

		// Stop here if no logo is found.
		if ( is_null( $logo ) ) {
			return;
		}

		// The markup of the linked logo.
		$html = sprintf(
			'<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
			esc_url( $url  ),
			wp_get_attachment_image(
				$logo,
				'full',
				false,
				[
					'class' => 'custom-logo',
				]
			)
		);

		// Return the markup of the logo with a filter applied.
		return apply_filters( 'gft_custom_logo', $html );
	}
}
