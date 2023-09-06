<?php
/**
* Header Options.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'minimal-photography' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $minimal_photography_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'minimal-photography'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_desktop_menu',
    array(
        'default' => $minimal_photography_default['ed_desktop_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_desktop_menu',
    array(
        'label' => esc_html__('Enable Primary Desktop Menu', 'minimal-photography'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_search_recent_posts',
    array(
        'default' => $minimal_photography_default['ed_header_search_recent_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_recent_posts',
    array(
        'label' => esc_html__('Enable Recent Posts on Search Area', 'minimal-photography'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'recent_post_title_search',
    array(
    'default'           => $minimal_photography_default['recent_post_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recent_post_title_search',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'minimal-photography' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);
$wp_customize->add_setting('ed_header_search_top_category',
    array(
        'default' => $minimal_photography_default['ed_header_search_top_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_top_category',
    array(
        'label' => esc_html__('Enable Top Category on Search Area', 'minimal-photography'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'top_category_title_search',
    array(
    'default'           => $minimal_photography_default['top_category_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'top_category_title_search',
    array(
    'label'    => esc_html__( 'Top Category Section Title', 'minimal-photography' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);