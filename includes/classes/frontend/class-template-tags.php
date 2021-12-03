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
	public function __construct() {

		// Body classes for templates.
		add_filter( 'body_class', [ $this, 'body_classes' ] );

		// Conditional logos.
		add_filter( 'get_custom_logo',  [ $this, 'custom_logo' ] );
	}

	/**
	 * Body classes for templates
	 *
	 * Adds classes frontend body element.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array Returns a modified array of body classes.
	 */
	public function body_classes( $classes ) {

		$add_classes = [];

		if ( tags()->has_cover_image() ) {
			$add_classes[] .= 'template-cover-image';
		}
		return array_merge( $classes, $add_classes );
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
		$logo_img   = null;
		$logo_link  = site_url( '/' );
		$cover_logo = get_theme_mod( 'gft_cover_logo' );
		$default    = get_theme_mod( 'custom_logo' );
		$post_type  = get_post_type( get_the_ID() );

		// Get blog data.
		$blog  = (int) get_option( 'page_for_posts' );
		$paged = get_query_var( 'paged' );

		// Get settings from the customizer.
		$blog_image = Customize\mods()->blog_image_display( get_theme_mod( 'gft_blog_image_display' ) );

		/**
		 * If the Cover Image template is assigned and
		 * the cover image logo is set.
		 */
		if (
			is_singular( $post_type ) &&
			post_type_supports( $post_type, 'thumbnail' ) &&
			has_post_thumbnail( get_the_ID() ) &&
			tags()->has_cover_image() &&
			$cover_logo
		) {
			$logo_img = $cover_logo;

		/**
		 * If the blog page is assigned the cover image and
		 * the cover image logo is set.
		 */
		} elseif (
			! is_singular() &&
			tags()->has_cover_image() &&
			$cover_logo
		) {
			$logo_img = $cover_logo;

		/**
		 * If the Cover Image template is assigned and
		 * no cover image logo is set.
		 */
		} elseif ( tags()->has_cover_image() && ! $cover ) {
			$logo_img = $default;

		/**
		 * If the Default template is assigned and
		 * the default logo is set.
		 */
		} elseif ( $default ) {
			$logo_img = $default;
		}

		// Stop here if no logo is found.
		if ( is_null( $logo_img ) ) {
			return;
		}

		// The markup of the linked logo.
		$html = sprintf(
			'<div class="custom-logo-wrap"><a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a></div>',
			esc_url( $logo_link  ),
			wp_get_attachment_image(
				$logo_img,
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

	/**
	 * Blog first page
	 *
	 * Determines whether on the first page of the blog,
	 * paged or not.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if on the first page.
	 */
	public function blog_first_page() {

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
	 * Blog has image
	 *
	 * Determines whether the blog has a featured
	 * image available. This is crucial for the
	 * cover image options and header display.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if an image is available.
	 */
	public function blog_has_image() {

		// Get blog display settings.
		$blog  = (int) get_option( 'page_for_posts' );

		// Get blog settings from the customizer.
		$blog_image    = get_theme_mod( 'gft_blog_image' );
		$display_image = tags()->display_blog_image();

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
		return apply_filters( 'gft_blog_has_image', $image );
	}

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

		$blog_title = $this->get_blog_title();
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
			$this->page_subtitle( '<p class="post__subtitle m-0 text-center">', '</p>', false )
		);
	}

	/**
	 * Get blog title
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the text of the title or null.
	 */
	public function get_blog_title() {

		$title      = __( 'Latest Blog Posts', 'go-further' );
		$blog_page  = (int) get_option( 'page_for_posts' );
		$blog_title = get_theme_mod( 'gft_blog_title' );

		if ( ! empty( $blog_page ) ) {
			$title = get_the_title( $blog_page );
		} elseif ( $blog_title ) {
			$title = $blog_title;
		}

		return apply_filters( 'gft_get_blog_title', $title );
	}

	/**
	 * Get the subtitle
	 *
	 * @since  1.0.0
	 * @access public
	 * @return mixed Returns the text of the subtitle or null.
	 */
	public function get_page_subtitle() {

		$subtitle      = '';
		$blog_page     = (int) get_option( 'page_for_posts' );
		$blog_subtitle = get_theme_mod( 'gft_blog_subtitle' );

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

		return apply_filters( 'gft_get_page_subtitle', $subtitle );
	}

	/**
	 * The subtitle
	 *
	 * Display or retrieve the current post subtitle with optional markup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $before Optional. Markup to prepend to the title. Default empty.
	 * @param  string $after Optional. Markup to append to the title. Default empty.
	 * @param  bool $echo Optional. Whether to echo or return the title. Default true for echo.
	 * @return void|string Void if `$echo` argument is true, current post title if `$echo` is false.
	 */
	public function page_subtitle( $before = '', $after = '', $echo = true ) {

		$subtitle = $this->get_page_subtitle();

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
	 * Has cover image
	 *
	 * Determines whether the page should display
	 * the full, cover-image intro.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean Returns true if the cover image should be used.
	 */
	public function has_cover_image() {

		// Default to false.
		$cover = false;

		// Get blog data.
		$blog  = (int) get_option( 'page_for_posts' );

		// Get blog settings from the customizer.
		$blog_image = Customize\mods()->blog_image_display( get_theme_mod( 'gft_blog_image_display' ) );

		// If the blog is set to use the cover image on the first page.
		if (
			$this->blog_first_page() &&
			$this->blog_has_image() &&
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

		return apply_filters( 'gft_has_cover_image', $cover );
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

		$classes   = [];
		$options = get_post_meta( get_the_ID(), 'gft_post_options', true );
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

		if ( $this->has_cover_image() ) {
			// $classes[] .= 'cover-image';
		}

		return implode( $classes, ' ' );
	}

	/**
	 * Display the blog image
	 *
	 * Whether and when to display the blog image.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return boolean
	 */
	public function display_blog_image() {

		// Get blog data.
		$blog  = (int) get_option( 'page_for_posts' );
		$paged = get_query_var( 'paged' );

		// Get blog settings from the customizer.
		$image_display = Customize\mods()->blog_image_display( get_theme_mod( 'gft_blog_image_display' ) );

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
