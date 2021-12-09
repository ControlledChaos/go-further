<?php
/**
 * Post options
 *
 * Adds metaboxes with fields, saves meta data.
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Post Options
 * @since      1.0.0
 */

namespace GoFurther\Post_Options;

// Alias namespaces.
use GoFurther\Classes\Front     as Front,
	GoFurther\Customize as Customize;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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

	add_action( 'load-post.php', $n( 'metabox_setup' ) );
	add_action( 'load-post-new.php', $n( 'metabox_setup' ) );
	add_action( 'save_post', $n( 'save_metadata' ), 10, 3 );
}

/**
 * Load metaboxes
 *
 * @since  1.0.0
 * @return void
 */
function metabox_setup() {
	add_action( 'add_meta_boxes', __NAMESPACE__ . '\metaboxes' );
}

/**
 * Add metaboxes
 *
 * @since  1.0.0
 * @return void
 */
function metaboxes() {

	// Get public post types.
	$post_types = get_post_types( [ 'public' => true ] );

	// Remove page builder post types from `$post_types` array.
	unset( $post_types['elementor_library'], $post_types['fl-builder-template'] );

	// Display Options metabox.
	add_meta_box( 'gft_post_display', __( 'Display Options', 'go-further' ), __NAMESPACE__ . '\display_metabox', $post_types, 'side', 'default' );
}

/**
 * Options available
 *
 * Whether there are any options available for the metabox.
 *
 * @since  1.0.0
 * @return boolean Returns true if at least one option is available.
 *                 Returns false by default.
 */
function options_available() {

	// Get featured image setting from the Customizer.
	$contain_featured = Customize\contain_featured( get_theme_mod( 'gft_contain_featured' ) );

	// If there are featured image options.
	if (
		'enable_per' == $contain_featured ||
		'disable_per' == $contain_featured
	) {
		return true;
	}
	return false;
}

/**
 * Author metabox
 *
 * @since  1.0.0
 * @param  object $post The post object.
 * @global string $typenow The post type.
 * @return void
 */
function display_metabox( $post ) {

	// Access post type of edit screen.
	global $typenow;

	// Get post type display name.
	$get_post  = get_post_type_object( get_post_type() );
	$post_name = $get_post->labels->singular_name;

	// Get featured image setting from the Customizer.
	$contain_featured = Customize\contain_featured( get_theme_mod( 'gft_contain_featured' ) );

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

	// Message for no available options.
	if ( options_available() ) :

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

	else :
		printf(
			'<p>%s</p>',
			__( 'No options available.', 'go-further' )
		);
	endif;
}

/**
 * Save post options metadata
 *
 * @since  1.0.0
 * @param  integer $post_id The post ID.
 * @param  WP_Post $post The Instance of WP_Post object.
 * @param  bool    $update Whether this is an existing post being updated.
 * @return void
 */
function save_metadata( $post_id, $post, $update ) {

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
