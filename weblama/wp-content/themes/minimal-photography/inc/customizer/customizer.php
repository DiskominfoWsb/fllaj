<?php
/**
 * Minimal Photography Theme Customizer
 *
 * @package Minimal Photography
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('minimal_photography_customize_register')) :

function minimal_photography_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/banner.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/animation.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';
	require get_template_directory() . '/inc/customizer/color-scheme.php';
	require get_template_directory() . '/inc/customizer/cat-color.php';

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','minimal-photography');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'minimal_photography_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'minimal_photography_customize_partial_blogdescription',
		) );
	}

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'minimal-photography' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'minimal-photography' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'minimal-photography' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_footer_option_panel',
		array(
			'title'      => esc_html__( 'Footer Setting', 'minimal-photography' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'minimal-photography' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	// Register custom section types.
	$wp_customize->register_section_type( 'Minimal_Photography_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Minimal_Photography_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Minimal Photography Pro', 'minimal-photography' ),
				'pro_text' => esc_html__( 'Purchase', 'minimal-photography' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/minimal-photography-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'minimal_photography_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('minimal_photography_customizer_scripts')) :

    function minimal_photography_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('minimal-photography-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    	wp_enqueue_style('minimal-photography-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('minimal-photography-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);
        wp_enqueue_script('minimal-photography-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

        $minimal_photography_post_category_list = minimal_photography_post_category_list();

	    $cat_option = '';

	    if( $minimal_photography_post_category_list ){
		    foreach( $minimal_photography_post_category_list as $key => $cats ){
		    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
		    }
		}

	    wp_localize_script( 
	        'minimal-photography-repeater', 
	        'minimal_photography_repeater',
	        array(
	           	'categories'   => $cat_option,
	            'upload_image'   =>  esc_html__('Choose Image','minimal-photography'),
	            'use_imahe'   =>  esc_html__('Select','minimal-photography'),
	         )
	    );

        $ajax_nonce = wp_create_nonce('minimal_photography_ajax_nonce');
        wp_localize_script( 
		    'minimal-photography-customizer', 
		    'minimal_photography_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'minimal_photography_customizer_scripts');
add_action('customize_controls_init', 'minimal_photography_customizer_scripts');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('minimal_photography_customize_partial_blogname')) :

	function minimal_photography_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('minimal_photography_customize_partial_blogdescription')) :

	function minimal_photography_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;


add_action('wp_ajax_minimal_photography_customizer_font_weight', 'minimal_photography_customizer_font_weight_callback');
add_action('wp_ajax_nopriv_minimal_photography_customizer_font_weight', 'minimal_photography_customizer_font_weight_callback');

// Recommendec Post Ajax Call Function.
function minimal_photography_customizer_font_weight_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wpnonce'] ), 'minimal_photography_ajax_nonce' ) && isset( $_POST['currentfont'] ) && sanitize_text_field( wp_unslash( $_POST['currentfont'] ) ) ) {

       $currentfont = sanitize_text_field( wp_unslash( $_POST['currentfont'] ) );
       $headings_fonts_property = Minimal_Photography_Fonts::minimal_photography_get_fonts_property( $currentfont );

       foreach( $headings_fonts_property['weight'] as $key => $value ){
       		echo '<option value="'.esc_attr( $key ).'">'.esc_html( $value ).'</option>';
       }
    }
    wp_die();
}