<?php
/**
* Color Settings.
*
* @package Minimal Photography
*/

$minimal_photography_default = minimal_photography_get_default_theme_options();

$wp_customize->add_section( 'color_scheme',
    array(
    'title'      => esc_html__( 'Color Scheme', 'minimal-photography' ),
    'priority'   => 60,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
    )
);

// Color Scheme.
$wp_customize->add_setting(
    'minimal_photography_color_schema',
    array(
        'default' 			=> $minimal_photography_default['minimal_photography_color_schema'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'minimal_photography_sanitize_select'
    )
);
$wp_customize->add_control(
    new Minimal_Photography_Custom_Radio_Color_Schema( 
        $wp_customize,
        'minimal_photography_color_schema',
        array(
            'settings'      => 'minimal_photography_color_schema',
            'section'       => 'color_scheme',
            'label'         => esc_html__( 'Color Scheme', 'minimal-photography' ),
            'choices'       => array(
                'default'  => array(
                	'color' => array('#ffffff','#000','#0027ff','#000'),
                	'title' => esc_html__('Default','minimal-photography'),
                ),
                'fancy'  => array(
                	'color' => array('#faf7f2','#017eff','#fc9285','#455d58'),
                	'title' => esc_html__('Fancy','minimal-photography'),
                ),
                'dark'  => array(
                    'color' => array('#222222','#007CED','#fb7268','#ffffff'),
                    'title' => esc_html__('Dark','minimal-photography'),
                ),
            )
        )
    )
);

$wp_customize->add_setting( 'minimal_photography_primary_color',
    array(
    'default'           => $minimal_photography_default['minimal_photography_primary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'minimal_photography_primary_color', 
    array(
        'label'      => esc_html__( 'Primary Color', 'minimal-photography' ),
        'section'    => 'colors',
        'settings'   => 'minimal_photography_primary_color',
    ) ) 
);

$wp_customize->add_setting( 'minimal_photography_secondary_color',
    array(
    'default'           => $minimal_photography_default['minimal_photography_secondary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'minimal_photography_secondary_color', 
    array(
        'label'      => esc_html__( 'Secondary Color', 'minimal-photography' ),
        'section'    => 'colors',
        'settings'   => 'minimal_photography_secondary_color',
    ) ) 
);

$wp_customize->add_setting( 'minimal_photography_general_color',
    array(
    'default'           => $minimal_photography_default['minimal_photography_general_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'minimal_photography_general_color', 
    array(
        'label'      => esc_html__( 'General Color', 'minimal-photography' ),
        'section'    => 'colors',
        'settings'   => 'minimal_photography_general_color',
    ) ) 
);

$wp_customize->add_setting(
    'minimal_photography_premium_notiece_color_schema',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Minimal_Photography_Premium_Notiece_Control( 
        $wp_customize,
        'minimal_photography_premium_notiece_color_schema',
        array(
            'label'      => esc_html__( 'Color Schemes', 'minimal-photography' ),
            'settings' => 'minimal_photography_premium_notiece_color_schema',
            'section'       => 'color_scheme',
        )
    )
);


$wp_customize->add_setting(
    'minimal_photography_premium_notiece_color',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Minimal_Photography_Premium_Notiece_Control( 
        $wp_customize,
        'minimal_photography_premium_notiece_color',
        array(
            'label'      => esc_html__( 'Color Options', 'minimal-photography' ),
            'settings' => 'minimal_photography_premium_notiece_color',
            'section'       => 'colors',
        )
    )
);