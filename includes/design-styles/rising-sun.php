<?php
/**
 * Design: Rising Sun
 *
 * @package    Go_Further
 * @subpackage Includes
 * @category   Styles
 * @since      1.0.0
 */

namespace GoFurther\Styles;

// Alias namespaces.
use GoFurther\Assets as Assets;

/**
 * Styles array
 *
 * Returns the array of styles for this design.
 */
function rising_sun() {

	$suffix = Assets\suffix();
	$rtl    = ! is_rtl() ? '' : '-rtl';

	return [ 'rising-sun' =>
		[
			'slug'          => 'rising-sun',
			'label'         => _x( 'Rising Sun', 'design style name', 'go-further' ),
			'url'           => get_theme_file_uri( "assets/css/design-styles/rising-sun/style{$rtl}{$suffix}.css" ),
			'editor_style'  => "assets/css/design-styles/rising-sun/style-editor{$rtl}{$suffix}.css",
			'color_schemes' => [
				'one' => [
					'label'      => _x( 'Zen Garden', 'color palette name', 'go-further' ),
					'primary'    => '#667133',
					'secondary'  => '#909b31',
					'tertiary'   => '#eeebef',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#667133'
				],
				'two' => [
					'label'      => _x( 'Cherry Blossom', 'color palette name', 'go-further' ),
					'primary'    => '#c43b71',
					'secondary'  => '#4c454e',
					'tertiary'   => '#f9edf1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#c43b71'
				],
				'three' => [
					'label'      => _x( 'Chrysanthemum', 'color palette name', 'go-further' ),
					'primary'    => '#efa700',
					'secondary'  => '#4c454e',
					'tertiary'   => '#fffae0',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#efa700'
				],
				'four' => [
					'label'      => _x( 'Koi Pond', 'color palette name', 'go-further' ),
					'primary'    => '#d46408',
					'secondary'  => '#4c454e',
					'tertiary'   => '#edf2fb',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#d46408'
				],
				'five' => [
					'label'      => _x( 'Wisteria', 'color palette name', 'go-further' ),
					'primary'    => '#6e4aa7',
					'secondary'  => '#4c454e',
					'tertiary'   => '#eee9e2',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'six' => [
					'label'      => _x( 'Maple', 'color palette name', 'go-further' ),
					'primary'    => '#9c2743',
					'secondary'  => '#4c454e',
					'tertiary'   => '#f6f2df',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'seven' => [
					'label'      => _x( 'Tea House', 'color palette name', 'go-further' ),
					'primary'    => '#776355',
					'secondary'  => '#4c454e',
					'tertiary'   => '#f8f3dd',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => ''
				],
				'eight' => [
					'label'      => _x( 'Volcano', 'color palette name', 'go-further' ),
					'primary'    => '#63738d',
					'secondary'  => '#4c454e',
					'tertiary'   => '#eceef1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#393e51'
				],
				'nine' => [
					'label'      => _x( 'Sashimi', 'color palette name', 'go-further' ),
					'primary'    => '#e36116',
					'secondary'  => '#4c454e',
					'tertiary'   => '#eceef1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#393e51'
				],
			],
			'fonts'=> [
				'Crimson Pro' => [
					'300',
					'300i',
					'400',
					'400i',
					'500',
					'500i',
					'600',
					'600i',
					'700',
					'700i'
				],
				'Red Hat Display' => [
					'300',
					'300i',
					'400',
					'400i',
					'500',
					'500i',
					'600',
					'600i',
					'700',
					'700i'
				],
			],
			'font_size'      => '1.125rem',
			'type_ratio'     => '1.275',
			'viewport_basis' => '1600'
		]
	];
}
