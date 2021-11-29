<?php
/**
 * Frontend template tags
 *
 * Call new instance of this class in header files.
 * Use of the `$gft_tags` variable is recommended
 * to instantiate, where the prefix matches the
 * rest of this theme's prefixes.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Frontend
 * @since      1.0.0
 */

namespace GoFurther\Classes\Front;

// Alias namespaces.
use GoFurther\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Template_Tags {

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
	public function __construct() {}

	/**
	 * Page title
	 *
	 * Displays the page title markup
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the markup for the page title
	 */
	public function page_title() {

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

		$html = esc_html( $args['title'] );

		if ( ! empty( $args['wrapper'] ) ) {

			$html = sprintf(
				'<%1$s %2$s>%3$s</%1$s>',
				sanitize_key( $args['wrapper'] ),
				implode( ' ', $args['classes'] ),
				$html
			);
		}

		foreach ( array_keys( $args['atts'] ) as $index => $attribute ) {
			$args['atts'][ $attribute ] = [];
		}

		// Page subtitle/excerpt.
		if (
			is_singular() &&
			post_type_supports( get_post_type( get_the_ID() ), 'excerpt' ) &&
			has_excerpt( get_the_ID() )
		) {
			$subtitle = sprintf(
				' <p class="post__subtitle text-center">%1$s</p>',
				get_the_excerpt( get_the_ID() )
			);
		} else {
			$subtitle = '';
		}

		printf(
			'<header class="page-header entry-header m-auto px %1$s">%2$s%3$s</header>',
			is_customize_preview() ? ( get_theme_mod( 'page_titles', true ) ? '' : 'display-none' ) : '',
			wp_kses(
				$html,
				[
					$args['wrapper'] => $args['atts'],
				]
			),
			$subtitle
		);
	}

	/**
	 * Featured image class
	 *
	 * Adds a `contained` class to the featured image figure element
	 * if the post option is enabled.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
	 */
	public function featured_class() {

		// Get the author section display setting from the Customizer.
		$contain_featured = Customize\mods()->contain_featured( get_theme_mod( 'gft_contain_featured' ) );

		$class   = '';
		$options = get_post_meta( get_the_ID(), 'gft_post_options', true );
		$enable  = $options ? in_array( 'enable_contain_featured', $options, true ) : false;
		$disable = $options ? in_array( 'disable_contain_featured', $options, true ) : false;

		if ( 'never' != $contain_featured ) {
			if (
				'always' == $contain_featured ||
				( 'enable_per'  == $contain_featured && true  == $enable ) ||
				( 'disable_per' == $contain_featured && false == $disable )
			) {
				$class = 'contained';
			}
		}
		return $class;
	}
}

/**
 * Instance of the class
 *
 * @since  1.0.0
 * @access public
 * @return object Template_Tags Returns an instance of the class.
 */
function tags() {
	return Template_Tags :: instance();
}
