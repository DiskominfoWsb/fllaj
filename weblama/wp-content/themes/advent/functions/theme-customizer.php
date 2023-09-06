<?php

function advent_cats()
{
  $args = array('parent' => 0);
  $categories = get_categories($args);
  $category = array();
  $i = 0;
  foreach($categories as $categorys){
      if($i==0){
          $default = $categorys->slug;
          $i++;
      }
      $category[$categorys->term_id] = $categorys->name;
  }
  return $category;
}
function advent_theme_customizer( $wp_customize ) {
	$advent_options = get_option('advent_theme_options');
	$wp_customize->add_panel(
    'general',
    array(
        'title' => __( 'General', 'advent' ),
        'description' => __('styling options','advent'),
        'priority' => 20, 
    )  );
  $wp_customize->get_section('title_tagline')->panel = 'general';
  $wp_customize->get_section('static_front_page')->panel = 'general';
  $wp_customize->get_section('header_image')->panel = 'general';
  $wp_customize->get_section('title_tagline')->title = __('Header & Logo','advent');

 //All our sections, settings, and controls will be added here
  $wp_customize->add_section(
    'TopHeaderSocialLinks',
    array(
      'title' => __('Site Social Accounts', 'advent'),
      'priority' => 120,
      'description' => __( 'In first input box, you need to add FONT AWESOME shortcode which you can find ' ,  'advent').'<a target="_blank" href="'.esc_url('https://fortawesome.github.io/Font-Awesome/icons/').'">'.__('here' ,  'advent').'</a>'.__(' and in second input box, you need to add your social media profile URL.', 'advent').'<br />'.__(' Enter the URL of your social accounts. Leave it empty to hide the icon.' ,  'advent'),
      'panel' => 'general'
    )
  );
  $TopHeaderSocialIconDefault = array(
  array('url'=>$advent_options['email'],'icon'=>'fa-envelope'),
  array('url'=>$advent_options['facebook'],'icon'=>'fa-facebook'),
  array('url'=>$advent_options['twitter'],'icon'=>'fa-twitter'),
  array('url'=>$advent_options['pinterest'],'icon'=>'fa-pinterest'),
  );

$TopHeaderSocialIcon = array();
  for($i=1;$i <= 4;$i++):  
    $TopHeaderSocialIcon[] =  array( 'slug'=>sprintf('TopHeaderSocialIcon%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['icon'],   
      'label' => esc_html__( 'Social Account ', 'advent') .$i,   
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIcon as $TopHeaderSocialIcons){
    $wp_customize->add_setting(
      $TopHeaderSocialIcons['slug'],
      array( 
       'default' => $TopHeaderSocialIcons['default'],       
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIcons['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'input_attrs' => array( 'placeholder' => esc_attr__('Enter Icon','advent') ),
        'label'      =>   $TopHeaderSocialIcons['label'],
        'priority' => $TopHeaderSocialIcons['priority']
      )
    );
  }
  $TopHeaderSocialIconLink = array();
  for($i=1;$i <= 4;$i++):  
    $TopHeaderSocialIconLink[] =  array( 'slug'=>sprintf('TopHeaderSocialIconLink%d',$i),   
      'default' => $TopHeaderSocialIconDefault[$i-1]['url'],   
      'label' => esc_html__( 'Social Link ', 'advent' ) .$i,
      'priority' => sprintf('%d',$i) );  
  endfor;
  foreach($TopHeaderSocialIconLink as $TopHeaderSocialIconLinks){
    $wp_customize->add_setting(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'default' => $TopHeaderSocialIconLinks['default'],
        'capability'     => 'edit_theme_options',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw',
      )
    );
    $wp_customize->add_control(
      $TopHeaderSocialIconLinks['slug'],
      array(
        'type'  => 'text',
        'section' => 'TopHeaderSocialLinks',
        'priority' => $TopHeaderSocialIconLinks['priority'],
        'input_attrs' => array( 'placeholder' => esc_html__('Enter URL','advent')),
      )
    );
  }

    /* sections */
    $wp_customize->add_section( 'advent_basic_section' , array(
    'title'       => __( 'Basic Settings', 'advent' ),
    'priority'    => 30,
    'panel' => 'general'
	) );
	$wp_customize->add_panel( 'home_id', array(
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Front Page Settings','advent'),
		'description'    => '',
		'priority'    => 30,
	) );
	
	$wp_customize->add_section( 'advent_topsec_section' , array(
		'title'       => __( 'Top Header Section', 'advent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );

	$wp_customize->add_section( 'advent_titlebar_section' , array(
		'title'       => __( 'Title Bar Section', 'advent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );

	$wp_customize->add_section( 'advent_welcome_section' , array(
		'title'       => __( 'Features Section', 'advent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );	
	$wp_customize->add_section( 'advent_whatyouget_section' , array(
		'title'       => __( 'How it work', 'advent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );

	$wp_customize->add_section( 'advent_blog_section' , array(
		'title'       => __( 'Blog Section', 'advent' ),
		'priority'    => 30,
		'panel'  => 'home_id',
	) );
	/* basic section */
	
	// blog title
	$wp_customize->add_setting( 'advent_blogtitle', array(
            'default'        => ' ',
            'sanitize_callback' => 'advent_sanitize_text',
        ) );
   $wp_customize->add_control( 'advent_blogtitle', array(
		'label'   => __('Blog Title','advent'),
		'section' => 'advent_basic_section',
		'type'    => 'text',
        ) );
	// copyright
	$wp_customize->add_setting( 'copyright_url_setting', array(
		'default'        => isset($advent_options['footertext'])?$advent_options['footertext']:'',
		'sanitize_callback' => 'advent_sanitize_html',
	) );
	$wp_customize->add_control( 'copyright_url_setting', array(
		'label'   => __('Copyright text','advent'),
		'section' => 'advent_basic_section',
		'type'    => 'text'
	) );

	//titlebar section	
	
	$wp_customize->add_setting( 'advent_topsec_title', array(
		'default'        => isset($advent_options['topheading'])?$advent_options['topheading']:'',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_topsec_title', array(
		'label'   => __('Title','advent'),
		'section' => 'advent_topsec_section',
		'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'advent_topsec_logo_img',array(
    'sanitize_callback' => 'esc_attr',
    )
  );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'advent_topsec_logo_img', array(
      'label'    => __( 'Top header Logo Image (Recommended size 200 x 200)', 'advent' ),
      'section'  => 'advent_topsec_section',
      'settings' => 'advent_topsec_logo_img',
    ) 
  ) );

    $wp_customize->add_setting( 'advent_topsec_img',array(
		'sanitize_callback' => 'esc_attr',
		)
	);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'advent_topsec_img', array(
			'label'    => __( 'Top header Image (Recommended size 1350 x 6670)', 'advent' ),
			'section'  => 'advent_topsec_section',
			'settings' => 'advent_topsec_img',
		) 
	) );

	// home page - titlebar section	
	
	$wp_customize->add_setting( 'advent_titlebar_title', array(
		'default'        => '',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_titlebar_title', array(
		'label'   => __('Title','advent'),
		'section' => 'advent_titlebar_section',
		'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'advent_titlebar_subtitle', array(
		'default'        => '',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_titlebar_subtitle', array(
		'label'   => __('Sub Title','advent'),
		'section' => 'advent_titlebar_section',
		'type'    => 'text',
    ) );
    // Featured Section  
    for($i=1;$i <= 6;$i++):   

    $wp_customize->add_setting( 'advent_homepage_first_section'.$i.'_icon',
        array(
            'capability'     => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'priority' => 20, 
        )
    );
    $wp_customize->add_control( 'advent_homepage_first_section'.$i.'_icon',
        array(
            'default' => $advent_options['faicon-'.$i],
            'section' => 'advent_welcome_section',                
            'label'   => __('Enter Font Awesome Icon ,Title and Description ','advent').$i,
            'type'    => 'text',
            'input_attrs' => array( 'placeholder' => esc_html__('Enter Font Awesome Icon','advent')),
        )
    ); 
  $wp_customize->add_setting( 'advent_homepage_first_section'.$i.'_title',
      array(
          'default' => $advent_options['section-title-'.$i],
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'sanitize_text_field',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'advent_homepage_first_section'.$i.'_title',
      array(
          'section' => 'advent_welcome_section',
          'type'    => 'text',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter title','advent')),
      )
  );

  $wp_customize->add_setting( 'advent_homepage_first_section'.$i.'_desc',
      array( 
          'default' => $advent_options['section-content-'.$i],     
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'wp_kses_post',
          'priority' => 20, 
      )
  );
  $wp_customize->add_control( 'advent_homepage_first_section'.$i.'_desc',
      array(
          'section' => 'advent_welcome_section',   
          'type'    => 'textarea',
          'input_attrs' => array( 'placeholder' => esc_html__('Enter Description','advent')),
      )
  );
  
endfor;
     
   // What You Get
   $wp_customize->add_setting( 'advent_get_title', array(
		'default'        => '',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_get_title', array(
		'label'   => __('Title','advent'),
		'section' => 'advent_whatyouget_section',
		'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'advent_get_subtitle', array(
		'default'        => '',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_get_subtitle', array(
		'label'   => __('Sub Heading Title','advent'),
		'section' => 'advent_whatyouget_section',
		'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'advent_get_info', array(
		'default'        => '',
		'sanitize_callback' => 'esc_textarea',
	) );
    $wp_customize->add_control( 'advent_get_info', array(
		'label'   => __('What you Get Info','advent'),
        'section' => 'advent_whatyouget_section',
        'type'    => 'textarea',
	) );
	$wp_customize->add_setting( 'advent_youget_image_bg',array(
		'sanitize_callback' => 'esc_attr',
		)
	);
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'advent_youget_image_bg', array(
			'label'    => __( 'Right Side Image (Recommended size 570 x 350)', 'advent' ),
			'section'  => 'advent_whatyouget_section',
			'settings' => 'advent_youget_image_bg',
		) 
	) );     
     //Blog Section
	$wp_customize->add_setting( 'advent_blog_title', array(
		'default'        => '',
		'sanitize_callback' => 'advent_sanitize_text',
	) );
    $wp_customize->add_control( 'advent_blog_title', array(
		'label'   => __('Blog Title','advent'),
        'section' => 'advent_blog_section',
        'type'    => 'text'
    ) );    
	
	$wp_customize->add_setting( 'advent_blogcategory', array(
		'default'        => 'Uncategorized',
		'sanitize_callback' => 'esc_attr',
				
	) );
    $wp_customize->add_control( 'advent_blogcategory', array(
		'label'   => __('Select Category','advent'),
        'section' => 'advent_blog_section',
        'type'    => 'select',
        'choices' => advent_cats(),
    ) );  
	
}
add_action( 'customize_register', 'advent_theme_customizer' );
function advent_sanitize_url( $advent_url ) {
	return esc_url_raw( $advent_url );
}
function advent_sanitize_html( $advent_html ) {
	return wp_filter_post_kses( $advent_html );
}
function advent_sanitize_number_absint( $advent_number ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $advent_number );
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $advent_number ? $advent_number : '' );
}
function advent_sanitize_text( $advent_input ) {
    return wp_kses_post( force_balance_tags( $advent_input ) );
}

function advent_custom_css()
{
	$custom_css = '';
  wp_enqueue_style('advent-style-css', get_stylesheet_uri(), array());
	$advent_breadcrumbs_image_bg=get_theme_mod('advent_breadcrumbs_image_bg');
	if (!empty($advent_breadcrumbs_image_bg) ){
		$advent_breadcrumbs_image_bg = esc_url(get_theme_mod('advent_breadcrumbs_image_bg'));
		$custom_css .=" .background-section { background-image :url('".$advent_breadcrumbs_image_bg."');
		background-position: center;} ";
	}	

	$advent_options = get_option('advent_theme_options');
	//if (get_theme_mod ( 'advent_topsec_img',$advent_options['headertop-bg'])!='') 
	{
		$custom_css .=".header_bg { background :url('".get_theme_mod ( 'advent_topsec_img',$advent_options['headertop-bg'])."'); } ";
	}


	wp_add_inline_style('advent-style-css',$custom_css);
}