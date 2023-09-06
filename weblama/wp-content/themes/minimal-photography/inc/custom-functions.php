<?php
/**
 * Custom Functions.
 *
 * @package Minimal Photography
 */

if( !function_exists( 'minimal_photography_fonts_url' ) ) :

    //Google Fonts URL
    function minimal_photography_fonts_url(){

        $fonts_url = '';
        $fonts = array();

        $minimal_photography_font_1 = 'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900';
        $minimal_photography_font_2 = 'Oswald:wght@200;300;400;500;600;700&display=swap';
        
        $minimal_photography_fonts = array();
        $minimal_photography_fonts[] = $minimal_photography_font_1;
        $minimal_photography_fonts[] = $minimal_photography_font_2;

        $minimal_photography_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

        $i = 0;
        for( $i = 0; $i < count( $minimal_photography_fonts ); $i++ ){

            if ( 'off' !== sprintf( _x( 'on', '%s font: on or off', 'minimal-photography' ), $minimal_photography_fonts[$i] ) ) {
                $fonts[] = $minimal_photography_fonts[$i];
            }

        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urldecode( implode( '|', $fonts ) ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw($fonts_url);
    }

endif;

if( !function_exists('minimal_photography_read_more_render') ):

    function minimal_photography_read_more_render(){ ?>

        <div class="mp-read-more">
            <a class="mp-read-more-src" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','minimal-photography'); ?></a>
        </div>

    <?php
    }

endif;

if( !function_exists( 'minimal_photography_social_menu_icon' ) ) :

    function minimal_photography_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( 'minimal-photography-social-menu' === $args->theme_location ) {

            $svg = Minimal_Photography_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = minimal_photography_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'minimal_photography_social_menu_icon', 10, 4 );

if( !function_exists( 'minimal_photography_add_sub_toggles_to_main_menu' ) ) :

    function minimal_photography_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

        // Add sub menu toggles to the Expanded Menu with toggles.
        if( isset( $args->show_toggles ) && $args->show_toggles ){

            // Wrap the menu item link contents in a div, used for positioning.
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children.
            if( in_array( 'menu-item-has-children', $item->classes, true ) ){

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle.
                $args->after .= '<button class="toggle submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'minimal-photography' ) . '</span>' . minimal_photography_the_theme_svg( 'chevron-down',$return = true ) . '</span></button>';

            }

            // Close the wrapper.
            $args->after .= '</div><!-- .submenu-wrapper -->';

            // Add sub menu icons to the primary menu without toggles.
        }elseif( 'minimal-photography-primary-menu' === $args->theme_location ){

            if( in_array( 'menu-item-has-children', $item->classes, true ) ){

                $args->after = '<span class="icon">'.minimal_photography_the_theme_svg('chevron-down',true).'</span>';

            }else{

                $args->after = '';

            }
        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'minimal_photography_add_sub_toggles_to_main_menu', 10, 3 );

if( !function_exists( 'minimal_photography_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'minimal_photography_page_lists' ) ) :

    // Page List.
    function minimal_photography_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','minimal-photography' );
        $pages = get_pages();
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'minimal_photography_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'minimal_photography_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * Minimal Photography SVG Icon helper functions
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
if ( ! function_exists( 'minimal_photography_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Minimal_Photography_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function minimal_photography_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return minimal_photography_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in minimal_photography_get_theme_svg();.

        }else{

            echo minimal_photography_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in minimal_photography_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'minimal_photography_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function minimal_photography_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Minimal_Photography_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;


if( !function_exists( 'minimal_photography_post_category_list' ) ) :

    // Post Category List.
    function minimal_photography_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','minimal-photography' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('minimal_photography_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function minimal_photography_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('minimal_photography_disable_post_views') ):

    /** Disable Post Views **/
    function minimal_photography_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('minimal_photography_disable_post_read_time') ):

    /** Disable Read Time **/
    function minimal_photography_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('minimal_photography_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function minimal_photography_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('minimal_photography_disable_post_author_box') ):

    /** Disable Author Box **/
    function minimal_photography_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed', function ( ) {
            return false;
        });

    }

endif;


add_filter('booster_extension_filter_ss_ed', function ( ) {
    return false;
});

if( !function_exists('minimal_photography_disable_post_reaction') ):

    /** Disable Reaction **/
    function minimal_photography_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('minimal_photography_post_floating_nav') ):

    function minimal_photography_post_floating_nav(){

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$minimal_photography_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'minimal-photography'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'minimal-photography'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'minimal_photography_navigation_action','minimal_photography_post_floating_nav',10 );

if( !function_exists('minimal_photography_single_post_navigation') ):

    function minimal_photography_single_post_navigation(){

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $minimal_photography_default['twp_navigation_type']);
        }


        if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $twp_navigation_type == 'norma-navigation' ){ ?>

                <div class="theme-block navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . minimal_photography_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'minimal-photography') . '</span><h4 class="entry-title entry-title-medium">%title</h4>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . minimal_photography_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'minimal-photography') . '</span><h4 class="entry-title entry-title-medium">%title</h4>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'minimal_photography_navigation_action','minimal_photography_single_post_navigation',30 );

if ( ! function_exists( 'minimal_photography_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function minimal_photography_header_toggle_search() {

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_header_search = get_theme_mod( 'ed_header_search', $minimal_photography_default['ed_header_search'] );
        $ed_header_search_top_category = get_theme_mod( 'ed_header_search_top_category', $minimal_photography_default['ed_header_search_top_category'] );
        $ed_header_search_recent_posts = absint( get_theme_mod( 'ed_header_search_recent_posts',$minimal_photography_default['ed_header_search_recent_posts'] ) );
        
        if( $ed_header_search ){ ?>

            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">

                        <div class="header-searchbar-area">

                            <a href="javascript:void(0)" class="skip-link-search-start"></a>
                            
                            <?php get_search_form(); ?>

                        </div>

                        <?php if( $ed_header_search_recent_posts || $ed_header_search_top_category ){ ?>

                            <div class="search-content-area">
                                  
                                <?php if( $ed_header_search_recent_posts ){ ?>

                                    <div class="search-recent-posts">
                                        <?php minimal_photography_recent_posts_search(); ?>
                                    </div>

                                <?php } ?>

                                <?php if( $ed_header_search_top_category ){ ?>

                                    <div class="search-popular-categories">
                                        <?php minimal_photography_header_search_top_cat_content(); ?>
                                    </div>

                                <?php } ?>

                            </div>

                        <?php } ?>

                        <button type="button" id="search-closer" class="exit-search">
                            <?php minimal_photography_the_theme_svg('cross'); ?>
                        </button>

                        <a href="javascript:void(0)" class="skip-link-search-end"></a>

                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;

if( !function_exists('minimal_photography_recent_posts_search') ):

    // Single Posts Related Posts.
    function minimal_photography_recent_posts_search(){

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $related_posts_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts") ) );

        if( $related_posts_query->have_posts() ): ?>

            <div class="related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html( get_theme_mod( 'recent_post_title_search',$minimal_photography_default['recent_post_title_search'] ) );

                    if( $recent_post_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $recent_post_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while( $related_posts_query->have_posts() ):
                        $related_posts_query->the_post();

                        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium' ); ?>

                        <div class="search-recent-article-list">
                            <header class="entry-header">
                                <h3 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </div>

                    <?php 
                    endwhile; ?>

                </div>

            </div>

            <?php
            wp_reset_postdata();

        endif;

    }

endif;

if( !function_exists('minimal_photography_header_search_top_cat_content') ):

    function minimal_photography_header_search_top_cat_content(){

        $top_category = 3;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach( $post_cat_lists as $post_cat_list ){

            if( $post_cat_list->count >= 1 ){

                $slug_counts[] = array( 
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description, 
                );

            }

        }

        if( $slug_counts ){?>

            <div class="popular-search-categories">
                
                <div class="theme-block-heading">
                    <?php
                    $minimal_photography_default = minimal_photography_get_default_theme_options();
                    $top_category_title_search = esc_html( get_theme_mod( 'top_category_title_search',$minimal_photography_default['top_category_title_search'] ) );

                    if( $top_category_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $top_category_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort( $slug_counts ); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="wrapper-inner">

                        <?php
                        $i = 1;
                        foreach( $slug_counts as $key => $slug_count ){

                            if( $i > $top_category){ break; }
                            
                            $cat_link           = get_category_link( $slug_count['cat_ID'] );
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $twp_term_image = get_term_meta( $slug_count['cat_ID'], 'twp-term-featured-image', true ); ?>

                            <div class="column column-4 column-sm-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-grid-article'); ?>>
                                        <div class="entry-wrapper">
                                            <?php if ($twp_term_image) { ?>
                                                <div class="entry-thumbnail">
                                                    <a href="<?php echo esc_url($cat_link); ?>" class="data-bg data-bg-medium" data-background="<?php echo esc_url($twp_term_image); ?>"></a>
                                                </div>
                                            <?php } ?>

                                            <div class="post-content">
                                                <header class="entry-header">
                                                    <h3 class="entry-title">
                                                        <a href="<?php echo esc_url($cat_link); ?>">
                                                            <?php echo esc_html($cat_name); ?>
                                                        </a>
                                                    </h3>
                                                </header>
                                            </div>
                                        </div>
                                </article>
                            </div>

                            <?php
                            $i++;

                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }

    }

endif;

add_action( 'minimal_photography_before_footer_content_action','minimal_photography_header_toggle_search',10 );

if( !function_exists('minimal_photography_content_offcanvas') ):

    // Offcanvas Contents
    function minimal_photography_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">

                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>

                        <button type="button" class="button-offcanvas-close">
                            <?php minimal_photography_the_theme_svg('close'); ?>
                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'minimal-photography'); ?>" role="navigation">
                        <ul class="primary-menu">

                            <?php
                            if( has_nav_menu('minimal-photography-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'minimal-photography-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            }else{
                                
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => false,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Minimal_Photography_Walker_Page(),
                                    )
                                );
                            } ?>

                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>

                <?php if( has_nav_menu('minimal-photography-social-menu') ){ ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'minimal-photography-social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>

                    </div>

                <?php } ?>

                <a href="javascript:void(0)" class="skip-link-menu-end"></a>

            </div>
        </div>

    <?php
    }

endif;

add_action( 'minimal_photography_before_footer_content_action','minimal_photography_content_offcanvas',30 );

if( !function_exists('minimal_photography_footer_content_widget') ):

    function minimal_photography_footer_content_widget(){

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        if( is_active_sidebar('minimal-photography-footer-widget-0') || 
            is_active_sidebar('minimal-photography-footer-widget-1') || 
            is_active_sidebar('minimal-photography-footer-widget-2') ):

            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('minimal-photography-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('minimal-photography-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('minimal-photography-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $minimal_photography_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="wrapper-inner">

                        <?php if (is_active_sidebar('minimal-photography-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('minimal-photography-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('minimal-photography-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('minimal-photography-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('minimal-photography-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('minimal-photography-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        endif;

    }

endif;

add_action( 'minimal_photography_footer_content_action','minimal_photography_footer_content_widget',10 );


if( !function_exists('minimal_photography_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function minimal_photography_footer_content_info(){

        $minimal_photography_default = minimal_photography_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="wrapper-inner">

                    <div class="column column-8">
                        <div class="footer-credits">

                            <div class="footer-copyright">

                                <?php
                                $ed_footer_copyright = wp_kses_post( get_theme_mod( 'ed_footer_copyright', $minimal_photography_default['ed_footer_copyright'] ) );
                                $footer_copyright_text = wp_kses_post( get_theme_mod( 'footer_copyright_text', $minimal_photography_default['footer_copyright_text'] ) );

                                echo esc_html__('Copyright ', 'minimal-photography') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html( get_bloginfo( 'name', 'display' ) ) . '. </span></a> ' . esc_html( $footer_copyright_text );

                                if( $ed_footer_copyright ){

                                    echo '<br>';
                                    echo esc_html__('Theme: ', 'minimal-photography') . 'Minimal Photography ' . esc_html__('By ', 'minimal-photography') . '<a href="' . esc_url('https://www.themeinwp.com/theme/minimal-photography') . '"  title="' . esc_attr__('Themeinwp', 'minimal-photography') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'minimal-photography') . '</span></a>';

                                    echo esc_html__('Powered by ', 'minimal-photography') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'minimal-photography') . '" target="_blank"><span>' . esc_html__('WordPress.', 'minimal-photography') . '</span></a>';

                                } ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'minimal_photography_footer_content_action','minimal_photography_footer_content_info',20 );


if( !function_exists('minimal_photography_footer_go_to_top') ):

    // Scroll to Top render content
    function minimal_photography_footer_go_to_top(){ ?>

        <button type="button" class="scroll-up">

            <div class="scroll-up-icon scroll-up-arrow"></div>
            <div class="scroll-up-icon scroll-up-line"></div>

            <?php minimal_photography_the_theme_svg('scroll-progress-circle'); ?>

        </button>
    
    <?php
    }

endif;

add_action( 'minimal_photography_footer_content_action','minimal_photography_footer_go_to_top',30 );

if( !function_exists('minimal_photography_color_schema_color') ):

    function minimal_photography_color_schema_color( $current_color ){

        $minimal_photography_default = minimal_photography_get_default_theme_options();

        $colors_schema = array(

            'default' => array(

                'background_color' => '#FFFFFF',
                'minimal_photography_primary_color' => $minimal_photography_default['minimal_photography_primary_color'],
                'minimal_photography_secondary_color' => $minimal_photography_default['minimal_photography_secondary_color'],
                'minimal_photography_general_color' => $minimal_photography_default['minimal_photography_general_color'],

            ),

            'dark' => array(

                'background_color' => '#222222',
                'minimal_photography_primary_color' => $minimal_photography_default['minimal_photography_primary_color_dark'],
                'minimal_photography_secondary_color' => $minimal_photography_default['minimal_photography_secondary_color_dark'],
                'minimal_photography_general_color' => $minimal_photography_default['minimal_photography_general_color_dark'],

            ),

            'fancy' => array(

                'background_color' => '#faf7f2',
                'minimal_photography_primary_color' => $minimal_photography_default['minimal_photography_primary_color_fancy'],
                'minimal_photography_secondary_color' => $minimal_photography_default['minimal_photography_secondary_color_fancy'],
                'minimal_photography_general_color' => $minimal_photography_default['minimal_photography_general_color_fancy'],

            ),

        );

        if( isset( $colors_schema[$current_color] ) ){
            
            return $colors_schema[$current_color];

        }

        return;

    }

endif;



if ( ! function_exists( 'minimal_photography_color_schema_color_action' ) ) :
    
    function minimal_photography_color_schema_color_action() {

        if( isset( $_POST['currentColor'] ) && sanitize_text_field( wp_unslash( $_POST['currentColor'] ) ) ){
         
            $current_color = sanitize_text_field( wp_unslash( $_POST['currentColor'] ) );

            $color_schemes = minimal_photography_color_schema_color( $current_color );

            if ( $color_schemes ) {
                echo json_encode( $color_schemes );
            }
        }
    
        wp_die();

    }

endif;

add_action( 'wp_ajax_nopriv_minimal_photography_color_schema_color', 'minimal_photography_color_schema_color_action' );
add_action( 'wp_ajax_minimal_photography_color_schema_color', 'minimal_photography_color_schema_color_action' );

if( ! function_exists( 'minimal_photography_iframe_escape' ) ):
    
    /** Escape Iframe **/
    function minimal_photography_iframe_escape( $input ){

        $all_tags = array(
            'iframe'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'frameborder'=>array(),
                'allow'=>array(),
                'allowfullscreen'=>array(),
            ),
            'video'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'style'=>array(),
                'controls'=>array(),
            )
        );

        return wp_kses($input,$all_tags);
        
    }

endif;

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','minimal_photography_after_content_pagination');

}

if( !function_exists('minimal_photography_after_content_pagination') ):

    function minimal_photography_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'minimal-photography' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;

if( !function_exists('minimal_photography_excerpt_content') ):

    function minimal_photography_excerpt_content(){ 

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $ed_post_excerpt = get_theme_mod( 'ed_post_excerpt',$minimal_photography_default['ed_post_excerpt'] );

        if( $ed_post_excerpt ){ ?>
                    
            <div class="entry-content">

                <?php
                if( has_excerpt() ){

                    the_excerpt();

                }else{

                    echo esc_html( wp_trim_words( get_the_content(), 25, '...' ) );

                } ?>

            </div>

        <?php }
    }

endif;