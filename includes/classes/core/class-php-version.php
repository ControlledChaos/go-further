<?php
/**
 * Check PHP version
 *
 * Operations contingent on the version of PHP used
 * on the theme's server, notably disable functionality
 * if the minimum version is not met.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Core
 * @since      1.0.0
 */

namespace GoFurther\Classes\Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

final class PHP_Version {

	/**
	 * The class object
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected static $class_object;

	/**
	 * Minimum PHP version
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string The version number.
	 */
	protected $minimum = '7.4';

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
	 * Minimum PHP version
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function minimum() {
		return $this->minimum;
	}

	/**
	 * Version compare
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if the minimum is met.
	 */
	public function version() {

		// Compare versions.
		if ( version_compare( phpversion(), $this->minimum(), '<' ) ) {

			// Return false if the minimum is not met.
			return false;
		}

		// Return true by default.
		return true;
	}

	/**
	 * Frontend message
	 *
	 * Conditional message displayed on the front end if
	 * the minimum PHP version is not met.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string Returns the markup of the message.
	 */
	public function frontend_message() {

		/**
		 * Constant: Templates directory
		 *
		 * @since 1.0.0
		 * @var   string File path without trailing slash.
		 */
		$templates_dir = 'templates';
		if ( ! defined( 'GFT_TMPL_DIR' ) ) {
			define( 'GFT_TMPL_DIR', $templates_dir );
		}

		/**
		 * Constant: Template partials directory
		 *
		 * @since 1.0.0
		 * @var   string File path without trailing slash.
		 */
		$parts_dir = GFT_TMPL_DIR . '/template-parts';
		if ( ! defined( 'GFT_PARTS_DIR' ) ) {
			define( 'GFT_PARTS_DIR', $parts_dir );
		}

		// Look first for a message template file.
		$template = get_theme_file_path( GFT_PARTS_DIR . '/partials/frontend-php-message.php' );
		if ( file_exists( $template ) ) {
			$html = get_template_part( GFT_PARTS_DIR . '/partials/frontend-php-message' );
		}

		// Message if the user is logged in and can switch themes.
		elseif ( is_user_logged_in() && current_user_can( 'switch_themes' ) ) {

			$html = sprintf(
				'<h1>%s</h1>',
				__( 'Theme Disabled', 'go-further' )
			);

			$html .= sprintf(
				__( '<p>The active theme has been disabled because the minimum PHP version of <strong>%s</strong> has not been met. Go to the <a href="%s">%s</a> to activate another theme.</p>', 'go-further' ),
				$this->minimum(),
				esc_attr( esc_url( self_admin_url( 'themes.php' ) ) ),
				__( 'themes page', 'go-further' )
			);

		// Message for users who do not meet the conditions above.
		} else {

			$html = sprintf(
				'<h1>%s</h1>',
				__( 'Down for Maintenance', 'go-further' )
			);

			$html .= sprintf(
				__( '<p>The %s website is down for maintenance. Please check back soon!.</p>', 'go-further' ),
				get_bloginfo( 'name' )
			);
		}

		// Return the message output.
		return $html;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object PHP_Version Returns an instance of the class.
 */
function php() {
	return PHP_Version :: instance();
}
