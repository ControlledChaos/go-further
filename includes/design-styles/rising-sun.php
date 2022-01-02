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

use GoFurther\Assets as Assets;

/**
 * Styles array
 *
 * Returns the array of styles for this design.
 */
function rising_sun() {

	$suffix = Assets\suffix();

	return [ 'rising-sun' =>
		[
			'slug'          => 'rising-sun',
			'label'         => _x( 'Rising Sun', 'design style name', 'go-further' ),
			'url'           => get_theme_file_uri( "assets/css/design-styles/rising-sun/style{$suffix}.css" ),
			'editor_style'  => "assets/css/design-styles/rising-sun/style-editor{$suffix}.css",
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
					'footer_widgets_background' => '#eeebef',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#667133'
				],
				'two' => [
					'label'      => _x( 'Cherry Blossom', 'color palette name', 'go-further' ),
					'primary'    => '#cd6691',
					'secondary'  => '#65334b',
					'tertiary'   => '#f9edf1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#f9edf1',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#c43b71'
				],
				'three' => [
					'label'      => _x( 'Chrysanthemum', 'color palette name', 'go-further' ),
					'primary'    => '#efa700',
					'secondary'  => '#d27112',
					'tertiary'   => '#fffae0',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#fffae0',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#efa700'
				],
				'four' => [
					'label'      => _x( 'Koi Pond', 'color palette name', 'go-further' ),
					'primary'    => '#d46408',
					'secondary'  => '#364c78',
					'tertiary'   => '#edf2fb',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#edf2fb',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#d46408'
				],
				'five' => [
					'label'      => _x( 'Wisteria', 'color palette name', 'go-further' ),
					'primary'    => '#7f67a4',
					'secondary'  => '#44355c',
					'tertiary'   => '#eee9e2',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#eee9e2',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#7f67a4'
				],
				'six' => [
					'label'      => _x( 'Maple', 'color palette name', 'go-further' ),
					'primary'    => '#9b2928',
					'secondary'  => '#5b202e',
					'tertiary'   => '#f6f2df',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#f6f2df',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#9b2928'
				],
				'seven' => [
					'label'      => _x( 'Tea House', 'color palette name', 'go-further' ),
					'primary'    => '#734c33',
					'secondary'  => '#493628',
					'tertiary'   => '#f8f3dd',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#f8f3dd',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#734c33'
				],
				'eight' => [
					'label'      => _x( 'Volcano', 'color palette name', 'go-further' ),
					'primary'    => '#6c778b',
					'secondary'  => '#4d535f',
					'tertiary'   => '#eceef1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#eceef1',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#6c778b'
				],
				'nine' => [
					'label'      => _x( 'Sashimi', 'color palette name', 'go-further' ),
					'primary'    => '#e36116',
					'secondary'  => '#7b262a',
					'tertiary'   => '#eceef1',
					'background' => '#ffffff',
					'text'       => '#333333',
					'header_background'    => '',
					'header_text'          => '',
					'footer_widgets_background' => '#eceef1',
					'footer_background'    => '',
					'footer_heading_color' => '',
					'footer_text_color'    => '',
					'social_icon_color'    => '#e36116'
				],
			],
			'fonts' => [
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
			'viewport_basis' => '1000'
		]
	];
}
