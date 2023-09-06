<?php
/**
 * Woocommerce Compatibility.
 *
 * @link https://woocommerce.com/
 *
 * @package Minimal Photography
 */

if ( class_exists('WooCommerce') ) {

    remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );

}

if( !function_exists('minimal_photography_woocommerce_setup') ):

    /**
     * Woocommerce support.
     */
    function minimal_photography_woocommerce_setup(){

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

    }

endif;

add_action('after_setup_theme', 'minimal_photography_woocommerce_setup');

if( !function_exists('minimal_photography_woocommerce_before_main_content') ):

    // Before Main Content woocommerce hook
    function minimal_photography_woocommerce_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="theme-panelarea">';
        echo '<div class="theme-panelarea-primary">';
        get_template_part( 'template-parts/header/header', 'content' );
        echo '</div>';
        echo '<div id="site-contentarea" class="theme-panelarea-secondary">';
    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_before_main_content', 'minimal_photography_woocommerce_before_main_content', 5);

}

if( !function_exists('minimal_photography_woocommerce_after_main_content') ):

    // After Main Content woocommerce hook
    function minimal_photography_woocommerce_after_main_content(){ ?>

        </div>

        <?php
        if( is_active_sidebar('minimal-photography-footer-widget-2') ){ ?>

            <div class="theme-panelarea-tertiary">
                <aside id="secondary" class="widget-area">

                    <?php dynamic_sidebar('minimal-photography-woocommerce-widget'); ?>
                    
                </aside><!-- #secondary -->
            </div>
            
        <?php } ?>

        </div>
        </div>

    <?php
    }

endif;

if( class_exists('WooCommerce') ){

    add_action('woocommerce_after_main_content', 'minimal_photography_woocommerce_after_main_content', 15);

}