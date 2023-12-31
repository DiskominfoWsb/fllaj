<?php
/**
* Single Post Options.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();

$wp_customize->add_section( 'single_post_setting',
	array(
	'title'      => esc_html__( 'Single Post Settings', 'minimal-photography' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_related_post',
    array(
        'default' => $minimal_photography_default['ed_related_post'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_related_post',
    array(
        'label' => esc_html__('Enable Related Posts', 'minimal-photography'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'related_post_title',
    array(
    'default'           => $minimal_photography_default['related_post_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'related_post_title',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'minimal-photography' ),
    'section'  => 'single_post_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting('twp_navigation_type',
    array(
        'default' => $minimal_photography_default['twp_navigation_type'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_single_pagination_layout',
    )
);
$wp_customize->add_control('twp_navigation_type',
    array(
        'label' => esc_html__('Single Post Navigation Type', 'minimal-photography'),
        'section' => 'single_post_setting',
        'type' => 'select',
        'choices' => array(
                'no-navigation' => esc_html__('Disable Navigation','minimal-photography' ),
                'norma-navigation' => esc_html__('Next Previous Navigation','minimal-photography' ),
                'ajax-next-post-load' => esc_html__('Ajax Load Next 3 Posts Contents','minimal-photography' )
            ),
    )
);

$wp_customize->add_setting('ed_floating_next_previous_nav',
    array(
        'default' => $minimal_photography_default['ed_floating_next_previous_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_floating_next_previous_nav',
    array(
        'label' => esc_html__('Enable Floating Next/Previous Post Nav', 'minimal-photography'),
        'section' => 'single_post_setting',
        'type' => 'checkbox',
    )
);