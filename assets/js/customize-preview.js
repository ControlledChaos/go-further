/**
 * Customizer preview functions
 *
 * @package    Go_Further
 * @subpackage Assets
 * @category   Customizer
 */

// Display social icons if a URL is provided.
(function($) {

	wp.customize( 'social_icon_codepen', value => {
		value.bind(to => {
			if (to) {
				$( '.social-icon-codepen' ).removeClass( 'display-none' );
			} else {
				$( '.social-icon-codepen' ).addClass( 'display-none' );
			}
		});
	});

	wp.customize( 'gf_display_social', value => {
		value.bind(to => {
			if (to) {
				$( '.site-footer .social-icons' ).removeClass( 'display-none' );
			} else {
				$( '.site-footer .social-icons' ).addClass( 'display-none' );
			}
		});
	});
})( jQuery );
