<?php
/**
 * Page templates
 *
 * Make page templates available to select post types and page types.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Setup
 * @since      1.0.0
 */

namespace GoFurther\Classes\Core;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Templates {

	/**
	 * Constructor magic method
	 *
	 * Theme templates filter is dynamic, using a post type name.
	 * @example `add_filter( 'theme_{$post_type}_templates', [ $this, 'post_type_templates' ] );`
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Static front page templates.
		add_filter( 'default_page_template_title', [ $this, 'front_page_default_template_title' ] );
		add_filter( 'theme_page_templates', [ $this, 'front_page_templates' ] );

		// Post templates.
		add_filter( 'theme_post_templates', [ $this, 'post_templates' ] );

		// Sample post type templates.
		add_filter( 'theme_sample_type_templates', [ $this, 'sample_templates' ] );
	}

	/**
	 * Front page templates
	 *
	 * Make select page templates available to the static front page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $post_templates Array of available templates.
	 * @return array Returns an array of templates for the front page.
	 */
	public function front_page_default_template_title( $default_title ) {

		// Get the front page option.
		$front_show = (string) get_option( 'show_on_front' );
		$front_page = (int) get_option( 'page_on_front' );

		if ( 'page' == $front_show && get_the_ID() == $front_page ) {
			$default_title = __( 'Front Page Default', 'go-further' );
		}
		return $default_title;
	}

	/**
	 * Front page templates
	 *
	 * Make select page templates available to the static front page.
	 *
	 * @since  1.0.0
	 * @since  WP 4.7
	 * @access public
	 * @param  array $post_templates Array of available templates.
	 * @return array Returns an array of templates for the front page.
	 */
	public function front_page_templates( $post_templates ) {

		// Stop here if version does not support post type templates.
		if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
			return;
		}

		// Get the front page option.
		$front_show = get_option( 'show_on_front' );
		$front_page = get_option( 'page_on_front' );

		if ( 'page' == $front_show && get_the_ID() == $front_page ) {

			// Unset general templates.
			unset( $post_templates[GFT_TMPL_DIR . '/theme/no-sidebar.php'] );
			unset( $post_templates[GFT_TMPL_DIR . '/theme/no-featured.php'] );
			unset( $post_templates[GFT_TMPL_DIR . '/theme/no-sidebar-no-featured.php'] );

			// Set specific front page templates.
			$post_templates[GFT_TMPL_DIR . '/theme/front-page-content-only.php'] = __( 'Front Page Content Only', 'go-further' );
		}

		return $post_templates;
	}

	/**
	 * Post templates
	 *
	 * Make select page templates available to the `post` post type.
	 *
	 * @since  1.0.0
	 * @since  WP 4.7
	 * @access public
	 * @param  array $post_templates Array of available templates.
	 * @return array Returns an array of templates for the post type.
	 */
	public function post_templates( $post_templates ) {

		// Stop here if version does not support post type templates.
		if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
			return;
		}

		$post_templates[GFT_TMPL_DIR . '/theme/no-sidebar.php']  = __( 'No Sidebar', 'go-further' );
		$post_templates[GFT_TMPL_DIR . '/theme/no-featured.php'] = __( 'No Featured Image', 'go-further' );
		$post_templates[GFT_TMPL_DIR . '/theme/no-sidebar-no-featured.php'] = __( 'No Sidebar, No Featured Image', 'go-further' );

		return $post_templates;
	}

	/**
	 * Sample post type templates
	 *
	 * Make select page templates available to the `sample_type` post type.
	 *
	 * This method is not only for demonstration in itself, it corresponds
	 * with the sample post type in this theme's companion plugin boilerplate.
	 *
	 * @since  1.0.0
	 * @since  WP 4.7
	 * @access public
	 * @param  array $post_templates Array of available templates.
	 * @return array Returns an array of templates for the post type.
	 */
	public function sample_templates( $post_templates ) {

		// Stop here if version does not support post type templates.
		if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
			return;
		}

		$post_templates[GFT_TMPL_DIR . '/theme/no-sidebar.php']  = __( 'No Sidebar', 'go-further' );
		$post_templates[GFT_TMPL_DIR . '/theme/no-featured.php'] = __( 'No Featured Image', 'go-further' );
		$post_templates[GFT_TMPL_DIR . '/theme/no-sidebar-no-featured.php'] = __( 'No Sidebar, No Featured Image', 'go-further' );

		return $post_templates;
	}
}
