<?php
/**
* Animation Settings.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();


$wp_customize->add_section( 'animation_settings',
    array(
    'title'      => esc_html__( 'Animation Setting', 'minimal-photography' ),
    'priority'   => 200,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting('ed_popup_animation',
    array(
        'default' => $minimal_photography_default['ed_popup_animation'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_popup_animation',
    array(
        'label' => esc_html__('Enable Popup Animation on Archive Page', 'minimal-photography'),
        'section' => 'animation_settings',
        'type' => 'checkbox',
    )
);