<?php
/**
* Posts Settings.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Posts Settings', 'minimal-photography' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_author',
    array(
        'default' => $minimal_photography_default['ed_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'minimal-photography'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $minimal_photography_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'minimal-photography'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $minimal_photography_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'minimal-photography'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $minimal_photography_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'minimal-photography'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_post_excerpt',
    array(
        'default' => $minimal_photography_default['ed_post_excerpt'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_excerpt',
    array(
        'label' => esc_html__('Enable Posts Excerpt', 'minimal-photography'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);