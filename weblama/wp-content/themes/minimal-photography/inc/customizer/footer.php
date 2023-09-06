<?php
/**
* Footer Settings.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();


$wp_customize->add_section( 'footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Setting', 'minimal-photography' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $minimal_photography_default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'minimal_photography_sanitize_select',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Top Footer Column Layout', 'minimal-photography' ),
	'section'     => 'footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'minimal-photography' ),
		'2' => esc_html__( 'Two Column', 'minimal-photography' ),
		'3' => esc_html__( 'Three Column', 'minimal-photography' ),
	    ),
	)
);

$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $minimal_photography_default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'minimal-photography' ),
	'section'  => 'footer_widget_area',
	'type'     => 'text',
	)
);