<?php
/**
 * Post options
 *
 * Adds metaboxes with fields, saves meta data.
 *
 * @package    Go_Further
 * @subpackage Classes
 * @category   Admin
 * @since      1.0.0
 */

namespace GoFurther\Classes\Admin;

// Alias namespaces.
use GoFurther\Classes\Front     as Front,
	GoFurther\Classes\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post_Options {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Load metaboxes.
		add_action( 'load-post.php', [ $this, 'metabox_setup' ] );
		add_action( 'load-post-new.php', [ $this, 'metabox_setup' ] );

		// Save post metedata.
		add_action( 'save_post', [ $this, 'save_metadata' ], 10, 3 );
	}

	/**
	 * Load metaboxes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function metabox_setup() {
		add_action( 'add_meta_boxes', [ $this, 'metaboxes' ], 10, 1 );
	}

	/**
	 * Add metaboxes
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function metaboxes() {

		// Get public post types.
		$post_types = get_post_types( [ 'public' => true ] );

		// Remove page builder post types from `$post_types` array.
		unset( $post_types['elementor_library'], $post_types['fl-builder-template'] );

		// Display Options metabox.
		add_meta_box( 'gft_post_display', __( 'Display Options', 'go-further' ), [ $this, 'display_metabox' ], $post_types, 'side', 'default' );
	}

	/**
	 * Author metabox
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $post The post object.
	 * @global string $typenow The post type.
	 * @return void
	 */
	public function display_metabox( $post ) {

		// Access post type of edit screen.
		global $typenow;

		// Get post type display name.
		$get_post  = get_post_type_object( get_post_type() );
		$post_name = $get_post->labels->singular_name;

		// Get featured image setting from the Customizer.
		$contain_featured = Customize\mods()->featured_image( get_theme_mod( 'gft_featured_image' ) );

		wp_nonce_field( "gft_post_{$post->ID}_options_nonce", 'gft_post_options_nonce' );

		$stored_meta = get_post_meta( $post->ID, 'gft_post_options', true );
		if ( empty( $stored_meta ) ) {
			$stored_meta = [];
		} else {
			$stored_meta = $stored_meta;
		}

		if ( in_array( 'enable_contain_featured', $stored_meta, true ) ) {
			$enable_contain_featured = 'enable_contain_featured';
		} else {
			$enable_contain_featured = false;
		}

		if ( in_array( 'disable_contain_featured', $stored_meta, true ) ) {
			$disable_contain_featured = 'disable_contain_featured';
		} else {
			$disable_contain_featured = false;
		}

	?>
		<fieldset>
			<legend class="screen-reader-text"><?php _e( 'Display Options Form', 'go-further' ); ?></legend>

			<?php if ( 'enable_per' == $contain_featured ) :
			?>
			<p>
				<label for="enable_contain_featured">
					<input id="enable_contain_featured" type="checkbox" name="gft_post_options[]" value="enable_contain_featured" <?php checked( $enable_contain_featured, 'enable_contain_featured' ); ?> />
					<?php printf(
						__( 'Contain the featured image for this %s.', 'go-further' ),
						strtolower( $post_name )
				); ?>
				</label>
			</p>
			<?php elseif ( 'disable_per' == $contain_featured ) :
			?>
			<p>
				<label for="disable_contain_featured">
					<input id="disable_contain_featured" type="checkbox" name="gft_post_options[]" value="disable_contain_featured" <?php checked( $disable_contain_featured, 'disable_contain_featured' ); ?> />
					<?php printf(
						__( 'Do not contain the featured image for this %s.', 'go-further' ),
						strtolower( $post_name )
				); ?>
				</label>
			</p>
			<?php endif; ?>
		</fieldset>
	<?php
	}

	/**
	 * Save post options metadata
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  integer $post_id The post ID.
	 * @param  WP_Post $post The Instance of WP_Post object.
	 * @param  bool    $update Whether this is an existing post being updated.
	 * @return void
	 */
	public function save_metadata( $post_id, $post, $update ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );

		$is_valid_nonce = ( isset( $_POST['gft_post_options_nonce'] ) && wp_verify_nonce( $_POST['gft_post_options_nonce'], "gft_post_{$post_id}_options_nonce" ) ) ? true : false;

		// Stop here if autosave, revision or nonce is invalid.
		if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
			return;
		}

		// Stop if current user can't edit posts.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		// Save options metadata.
		$checked = [];

		if ( isset( $_POST['gft_post_options'] ) ) {

			if ( in_array( 'enable_contain_featured', $_POST['gft_post_options'], true ) ) {
				$checked[] .= 'enable_contain_featured';
			}

			if ( in_array( 'disable_contain_featured', $_POST['gft_post_options'], true ) ) {
				$checked[] .= 'disable_contain_featured';
			}
		}

		update_post_meta( $post_id, 'gft_post_options', $checked );
	}
}