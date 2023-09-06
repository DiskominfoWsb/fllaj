<?php

/*
 * advent Enqueue css and js files
 */
function advent_enqueue() {
    
    wp_enqueue_style('advent-google-fonts', '//fonts.googleapis.com/css?family=Cabin|Open+Sans', array());

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array());
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array());
    
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'));

    /* slider js and css only for apply in frontpage */
    if (is_page_template('page-template/front-page.php')) {
        wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/css/owl.carousel.css', array());

        wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'));
        wp_enqueue_script('advent-default-js', get_template_directory_uri() . '/js/default.js', array('jquery'));
    }
    wp_enqueue_script('advent-header-scroll-js', get_template_directory_uri() . '/js/header-scroll.js', array('jquery'));
    advent_custom_css();
    if (is_singular())
        wp_enqueue_script("comment-reply");
}
add_action('wp_enqueue_scripts', 'advent_enqueue'); ?>