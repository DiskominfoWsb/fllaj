<?php
/**
 * Minimal Photography functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Minimal Photography
 */

if ( ! function_exists( 'minimal_photography_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function minimal_photography_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => '#FFFFFF',
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'minimal_photography_content_width', 970 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Formate.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Minimal Photography, use a find and replace
		 * to change 'minimal-photography' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'minimal-photography', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

	}

endif;

add_action( 'after_setup_theme', 'minimal_photography_after_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function minimal_photography_register_styles() {

	$minimal_photography_default = minimal_photography_get_default_theme_options();
	$ed_popup_animation = get_theme_mod( 'ed_popup_animation',$minimal_photography_default['ed_popup_animation'] );
	
	$fonts_url = minimal_photography_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('minimal-photography-google-fonts', $fonts_url, array(), null);
    }

	$theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');

    if( class_exists('WooCommerce') ){

	    wp_enqueue_style( 'minimal-photography-woocommerce', get_template_directory_uri() . '/assets/lib/custom/css/woocommerce.css' );

	}
	wp_enqueue_style( 'minimal-photography-style', get_stylesheet_uri(), array(), $theme_version );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );

    wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/lib/anime/anime.min.js', array('jquery'), '', 1);
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/lib/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', 1);

	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'minimal-photography-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'minimal-photography-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);
	if( $ed_popup_animation ){
		wp_enqueue_script( 'minimal-photography-animation', get_template_directory_uri() . '/assets/lib/custom/js/animation.js', array('jquery'), '', true );
	}
    $ajax_nonce = wp_create_nonce('minimal_photography_ajax_nonce');

    wp_localize_script( 
        'minimal-photography-animation', 
        'minimal_photography_animation',
        array(
            'read_more' => esc_html__( 'Load More', 'minimal-photography' ),
         )
    );

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $paged,
        );

        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{

        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

    }

    $minimal_photography_default = minimal_photography_get_default_theme_options();
    $minimal_photography_pagination_layout = get_theme_mod( 'minimal_photography_pagination_layout',$minimal_photography_default['minimal_photography_pagination_layout'] );

    // Pagination Data
    wp_localize_script( 
	    'minimal-photography-pagination', 
	    'minimal_photography_pagination',
	    array(
	        'paged'  => absint( $paged ),
	        'maxpage'   => absint( $max ),
	        'nextLink'   => next_posts( $max, false ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'minimal-photography' ),
	        'nomore'     => esc_html__( 'No More Posts', 'minimal-photography' ),
	        'loading'    => esc_html__( 'Loading...', 'minimal-photography' ),
	        'pagination_layout'   => esc_html( $minimal_photography_pagination_layout ),
	        'ajax_nonce' => $ajax_nonce,
	        'ed_popup_animation' => $ed_popup_animation,
	     )
	);

    global $post;
    $single_post = 0;
    $minimal_photography_ed_post_reaction = '';

    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$minimal_photography_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_reaction', true ) );
    	$single_post = 1;

    }
    
	wp_localize_script(
	    'minimal-photography-custom', 
	    'minimal_photography_custom',
	    array(
	    	'single_post'	=> absint( $single_post ),
	        'minimal_photography_ed_post_reaction'  		=> esc_html( $minimal_photography_ed_post_reaction ),
	        'play' => minimal_photography_the_theme_svg( 'play', $return = true ),
            'pause' => minimal_photography_the_theme_svg( 'pause', $return = true ),
            'mute' => minimal_photography_the_theme_svg( 'mute', $return = true ),
            'unmute' => minimal_photography_the_theme_svg( 'unmute', $return = true ),
            'play_text' => esc_html__('Play','minimal-photography'),
            'pause_text' => esc_html__('Pause','minimal-photography'),
            'mute_text' => esc_html__('Mute','minimal-photography'),
            'unmute_text' => esc_html__('Unmute','minimal-photography'),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'minimal_photography_register_styles' );

/**
 * Admin enqueue script
 */
function minimal_photography_admin_scripts($hook){

	wp_enqueue_media();
    wp_enqueue_style('minimal-photography-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('minimal-photography-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery'), '', 1);
    
    $ajax_nonce = wp_create_nonce('minimal_photography_ajax_nonce');

    wp_localize_script( 
        'minimal-photography-admin', 
        'minimal_photography_admin',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'active' => esc_html__('Active','minimal-photography'),
	        'deactivate' => esc_html__('Deactivate','minimal-photography'),
	        'upload_image'   =>  esc_html__('Choose Image','minimal-photography'),
            'use_imahe'   =>  esc_html__('Select','minimal-photography'),
         )
    );
}

add_action('admin_enqueue_scripts', 'minimal_photography_admin_scripts');

if( !function_exists( 'minimal_photography_js_no_js_class' ) ) :

	// js no-js class toggle
	function minimal_photography_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'minimal_photography_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function minimal_photography_menus() {

	$locations = array(
		'minimal-photography-primary-menu'  => esc_html__( 'Primary Menu', 'minimal-photography' ),
		'minimal-photography-social-menu'  => esc_html__( 'Social Menu', 'minimal-photography' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'minimal_photography_menus' );

add_filter('themeinwp_enable_demo_import_compatiblity','minimal_photography_demo_import_filter_apply');

if( !function_exists('minimal_photography_demo_import_filter_apply') ):

	function minimal_photography_demo_import_filter_apply(){

		return true;

	}

endif;

require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/classes/about.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/woocommerce/woocommerce-functions.php';