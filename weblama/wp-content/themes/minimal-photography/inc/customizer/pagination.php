<?php
/**
 * Pagination Settings
 *
 * @package Minimal Photography
 */

$minimal_photography_default = minimal_photography_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'minimal_photography_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'minimal-photography' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'minimal_photography_pagination_layout',
	array(
	'default'           => $minimal_photography_default['minimal_photography_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'minimal_photography_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'minimal-photography' ),
	'section'     => 'minimal_photography_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','minimal-photography'),
		'numeric' => esc_html__('Numeric Method','minimal-photography'),
		'load-more' => esc_html__('Ajax Load More Button','minimal-photography'),
		'auto-load' => esc_html__('Ajax Auto Load','minimal-photography'),
	),
	)
);