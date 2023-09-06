<?php
/**
 * Default Values.
 *
 * @package Minimal Photography
 */

if ( ! function_exists( 'minimal_photography_get_default_theme_options' ) ) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function minimal_photography_get_default_theme_options() {

        $minimal_photography_defaults = array();
        $minimal_photography_category_colors = array(
            array(
                'category' => '1',
                'category_color' => '#0027ff',
            ),
        );

        $minimal_photography_category_colors = json_encode($minimal_photography_category_colors);
        $minimal_photography_defaults['minimal_photography_category_colors'] = $minimal_photography_category_colors;
        // Options.
        $minimal_photography_defaults['minimal_photography_pagination_layout']      = 'numeric';
        $minimal_photography_defaults['footer_column_layout']                       = 3;
        $minimal_photography_defaults['footer_copyright_text']                      = esc_html__( 'All rights reserved.', 'minimal-photography' );
        $minimal_photography_defaults['ed_header_search']                           = 1;
        $minimal_photography_defaults['ed_image_content_inverse']                   = 0;
        $minimal_photography_defaults['ed_related_post']                            = 1;
        $minimal_photography_defaults['related_post_title']                         = esc_html__('Related Post','minimal-photography');
        $minimal_photography_defaults['twp_navigation_type']                        = 'norma-navigation';
        $minimal_photography_defaults['ed_post_author']                             = 1;
        $minimal_photography_defaults['ed_post_date']                               = 1;
        $minimal_photography_defaults['ed_post_category']                           = 1;
        $minimal_photography_defaults['ed_post_tags']                               = 1;
        $minimal_photography_defaults['ed_floating_next_previous_nav']               = 1;
        $minimal_photography_defaults['ed_footer_copyright']                        = 1;

        // Default Color
        $minimal_photography_defaults['background_color']          = 'ffffff';
        $minimal_photography_defaults['minimal_photography_primary_color']          = '#000000';
        $minimal_photography_defaults['minimal_photography_secondary_color']        = '#0027ff';
        $minimal_photography_defaults['minimal_photography_general_color']        = '#000000';

        // Simple Color
        $minimal_photography_defaults['minimal_photography_primary_color_dark']          = '#007CED';
        $minimal_photography_defaults['minimal_photography_secondary_color_dark']        = '#fb7268';
        $minimal_photography_defaults['minimal_photography_general_color_dark']        = '#ffffff';

        // Fancy Color
        $minimal_photography_defaults['minimal_photography_primary_color_fancy']          = '#017eff';
        $minimal_photography_defaults['minimal_photography_secondary_color_fancy']        = '#fc9285';
        $minimal_photography_defaults['minimal_photography_general_color_fancy']        = '#455d58';


        $minimal_photography_defaults['ed_open_link_new_tab']                       = 0;
        $minimal_photography_defaults['ed_header_banner']                           = 1;
        $minimal_photography_defaults['minimal_photography_color_schema']           = 'default';
        $minimal_photography_defaults['ed_popup_animation']             = 0;
        $minimal_photography_defaults['ed_desktop_menu']            = 1;
        $minimal_photography_defaults['ed_post_excerpt']            = 1;
        $minimal_photography_defaults['recent_post_title_search']                 = esc_html__('Recent Post','minimal-photography');
        $minimal_photography_defaults['top_category_title_search']                 = esc_html__('Top Category','minimal-photography');
        $minimal_photography_defaults['ed_header_search_recent_posts']             = 1;
        $minimal_photography_defaults['ed_header_search_top_category']             = 1;
        $minimal_photography_defaults['ed_day_night_mode_switch']             = 1;
        
        // Pass through filter.
        $minimal_photography_defaults = apply_filters( 'minimal_photography_filter_default_theme_options', $minimal_photography_defaults );

        return $minimal_photography_defaults;

    }

endif;
