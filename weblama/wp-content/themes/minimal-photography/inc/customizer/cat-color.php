<?php
/**
* Category Color
*
* @package Minimal Photography
*/

$minimal_photography_defaults = minimal_photography_get_default_theme_options();
$minimal_photography_post_category_list = minimal_photography_post_category_list();

// Slider Section.
$wp_customize->add_section( 'minimal_photography_category_color_section',
	array(
	'title'      => esc_html__( 'Category Color', 'minimal-photography' ),
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'minimal_photography_category_colors', array(
    'sanitize_callback' => 'minimal_photography_sanitize_repeater',
    'default' => $minimal_photography_defaults['minimal_photography_category_colors'],
));

$wp_customize->add_control(  new Minimal_Photography_Repeater_Controler( $wp_customize, 'minimal_photography_category_colors', 
    array(
        'section' => 'minimal_photography_category_color_section',
        'settings' => 'minimal_photography_category_colors',
        'minimal_photography_box_label' => esc_html__('New Category','minimal-photography'),
        'minimal_photography_box_add_control' => esc_html__('Add New Category Color','minimal-photography'),
        'minimal_photography_box_add_button' => true,
    ),
        array(
            'category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Select Category', 'minimal-photography' ),
                'options'     => $minimal_photography_post_category_list,
                'class'       => 'minimal-photography-custom-cat-color'
            ),
            'category_color' => array(
                'type'        => 'colorpicker',
                'label'       => esc_html__( 'Category Color', 'minimal-photography' ),
                'class'       => ''
            ),
            
    )
));
