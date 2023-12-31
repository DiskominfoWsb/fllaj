<?php

$wp_customize->add_setting( 'ed_header_banner',
    array(
    'default'           => $minimal_photography_default['ed_header_banner'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);
$wp_customize->add_control( 'ed_header_banner',
    array(
    'label'       => esc_html__( 'Enable Banner', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'checkbox',
    'priority'   => 0,
    )
);

$wp_customize->add_setting( 'header_banner_title',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_title',
    array(
    'label'       => esc_html__( 'Banner Title', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_sub_title',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_sub_title',
    array(
    'label'       => esc_html__( 'Banner Sub Title', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_description',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_description',
    array(
    'label'       => esc_html__( 'Banner Description', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'textarea',
    )
);

$wp_customize->add_setting( 'header_banner_button_label',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'header_banner_button_label',
    array(
    'label'       => esc_html__( 'Banner Button Text', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting( 'header_banner_button_link',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control( 'header_banner_button_link',
    array(
    'label'       => esc_html__( 'Banner Button Link', 'minimal-photography' ),
    'section'     => 'header_image',
    'type'        => 'text',
    )
);

$wp_customize->add_setting('ed_open_link_new_tab',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_checkbox',
    )
);

$wp_customize->add_control('ed_open_link_new_tab',
    array(
        'label' => esc_html__('Open In New Tab', 'minimal-photography'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
 );