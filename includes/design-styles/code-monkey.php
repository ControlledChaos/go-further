<?php
/**
 * Design: Code Monkey
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
function code_monkey() {

	$suffix = Assets\suffix();

	return [ 'code-monkey' =>
		[
			'slug'          => 'code-monkey',
			'label'         => _x( 'Code Monkey', 'design style name', 'go-further' ),
			'url'           => get_theme_file_uri( "assets/css/design-styles/code-monkey/style{$suffix}.css" ),
			'editor_style'  => "assets/css/design-styles/code-monkey/style-editor{$suffix}.css",
			'color_schemes' => [
				'one' => [
					'label'      => _x( 'Monokai', 'color palette name', 'go-further' ),
					'primary'    => '#e87d3e',
					'secondary'  => '#6c99bb',
					'tertiary'   => '#2d2c2d',
					'background' => '#222222',
					'text'       => '#d6d6d6',
					'header_background'    => '#222222',
					'header_text'          => '#e5b567',
					'footer_widgets_background' => '#2d2c2d',
					'footer_background'    => '#222222',
					'footer_heading_color' => '#9e86c8',
					'footer_text_color'    => '#b05279',
					'social_icon_color'    => '#b4d273'
				]
			],
			'fonts' => [
				'Source Code Pro' => [
					'200',
					'200i',
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
