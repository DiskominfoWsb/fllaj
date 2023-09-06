<?php
/**
 * Minimal Photography Dynamic Styles
 *
 * @package Minimal Photography
 */

function minimal_photography_dynamic_css()
{

    $minimal_photography_default = minimal_photography_get_default_theme_options();
    $background_color = get_theme_mod('background_color', $minimal_photography_default['background_color']);

    $background_color = '#'.str_replace("#","",$background_color);

    $minimal_photography_primary_color = get_theme_mod('minimal_photography_primary_color', $minimal_photography_default['minimal_photography_primary_color']);
    $minimal_photography_secondary_color = get_theme_mod('minimal_photography_secondary_color', $minimal_photography_default['minimal_photography_secondary_color']);
    $minimal_photography_general_color = get_theme_mod('minimal_photography_general_color', $minimal_photography_default['minimal_photography_general_color']);


    $minimal_photography_category_colors = get_theme_mod('minimal_photography_category_colors', $minimal_photography_default['minimal_photography_category_colors']);

    echo "<style type='text/css' media='all'>"; ?>

    <?php
    if ($minimal_photography_category_colors) {
        $minimal_photography_category_colors = json_decode($minimal_photography_category_colors);
        foreach ($minimal_photography_category_colors as $minimal_photography_category_color) {
            if (isset($minimal_photography_category_color->category) && $minimal_photography_category_color->category && isset($minimal_photography_category_color->category_color) && $minimal_photography_category_color->category_color) { ?>

                .minimal-photography-cat-color-<?php echo esc_attr($minimal_photography_category_color->category); ?>:hover,
                .minimal-photography-cat-color-<?php echo esc_attr($minimal_photography_category_color->category); ?>:focus{
                    background-color: <?php echo esc_attr($minimal_photography_category_color->category_color); ?> !important;
                }
                
                <?php
            }
        }
    } ?>

    body.theme-color-schema,
    .preloader,
    .floating-post-navigation .floating-navigation-label,
    .header-searchbar-inner,
    .offcanvas-wraper{
    background-color: <?php echo esc_attr($background_color); ?>;
    }
    body.theme-color-schema,
    body, button, input, select, optgroup, textarea,
    .floating-post-navigation .floating-navigation-label,
    .header-searchbar-inner,
    .offcanvas-wraper{
        color: <?php echo esc_attr($minimal_photography_general_color); ?>;
    }

    .preloader .loader span{
        background: <?php echo esc_attr($minimal_photography_general_color); ?>;
    }
    a{
        color: <?php echo esc_attr($minimal_photography_primary_color); ?>;
    }
  
    body .scroll-up-line,
    body .theme-page-vitals,
    body .site-navigation .primary-menu > li > a:before,
    body .site-navigation .primary-menu > li > a:after,
    body .site-navigation .primary-menu > li > a:after,
    body .site-navigation .primary-menu > li > a:hover:before,
    body .entry-thumbnail .trend-item,
    body .category-widget-header .post-count,
    body .theme-meta-categories a:hover,
    body .theme-meta-categories a:focus{
        background: <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    
    body a:hover,
    body a:focus,
    .scroll-up-arrow,
    body .footer-credits a:hover,
    body .footer-credits a:focus,
    body .widget a:hover,
    body .widget a:focus {
        color: <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    body input[type="text"]:hover,
    body input[type="text"]:focus,
    body input[type="password"]:hover,
    body input[type="password"]:focus,
    body input[type="email"]:hover,
    body input[type="email"]:focus,
    body input[type="url"]:hover,
    body input[type="url"]:focus,
    body input[type="date"]:hover,
    body input[type="date"]:focus,
    body input[type="month"]:hover,
    body input[type="month"]:focus,
    body input[type="time"]:hover,
    body input[type="time"]:focus,
    body input[type="datetime"]:hover,
    body input[type="datetime"]:focus,
    body input[type="datetime-local"]:hover,
    body input[type="datetime-local"]:focus,
    body input[type="week"]:hover,
    body input[type="week"]:focus,
    body input[type="number"]:hover,
    body input[type="number"]:focus,
    body input[type="search"]:hover,
    body input[type="search"]:focus,
    body input[type="tel"]:hover,
    body input[type="tel"]:focus,
    body input[type="color"]:hover,
    body input[type="color"]:focus,
    body textarea:hover,
    body textarea:focus,
    button:focus,
    body .button:focus,
    body .wp-block-button__link:focus,
    body .wp-block-file__button:focus,
    body input[type="button"]:focus,
    body input[type="reset"]:focus,
    body input[type="submit"]:focus,
    body .theme-meta-categories a:hover,
    body .theme-meta-categories a:focus{
        border-color:  <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    body .theme-page-vitals:after,
    body .theme-meta-categories a:hover:after {
        border-right-color:  <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    .scroll-up .svg-icon path{
        stroke: <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    body a:focus,
    body .theme-action-control:focus > .action-control-trigger,
    body .submenu-toggle:focus > .btn__content{
        outline-color:  <?php echo esc_attr($minimal_photography_secondary_color); ?>;
    }
    <?php echo "</style>";
}

add_action('wp_head', 'minimal_photography_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function minimal_photography_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}