<?php
/**
* Body Classes.
*
* @package Minimal Photography
*/
 
 if (!function_exists('minimal_photography_body_classes')) :

    function minimal_photography_body_classes($classes) {

        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $minimal_photography_color_schema = get_theme_mod( 'minimal_photography_color_schema',$minimal_photography_default['minimal_photography_color_schema'] );
        $ed_desktop_menu = get_theme_mod( 'ed_desktop_menu',$minimal_photography_default['ed_desktop_menu'] );
        global $post;
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }
        if( $ed_desktop_menu ){

            $classes[] = 'enabled-desktop-menu';

        }else{

            $classes[] = 'disabled-desktop-menu';

        }

        $classes[] = 'color-scheme-'.esc_attr( $minimal_photography_color_schema );

        return $classes;
    }

endif;

add_filter('body_class', 'minimal_photography_body_classes');