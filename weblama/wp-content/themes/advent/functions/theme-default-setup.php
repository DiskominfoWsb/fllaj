<?php

/*
 * advent Main Sidebar
 */
function advent_widgets_init() {

    register_sidebar(array(
        'name' => __('Main Sidebar', 'advent'),
        'id' => 'sidebar-1',
        'description' => __('Main sidebar that appears on the right.', 'advent'),
        'before_widget' => '<aside id="%1$s" class="sidebar-widget widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<div class="sidebar-widget"><h3>',
        'after_title' => '</h3></div>',
    ));
}
add_action('widgets_init', 'advent_widgets_init');
/**
 * Set up post entry meta.
 * Meta information for current post: categories, tags, permalink, author, and date.    
 * */

function advent_entry_meta() {
    
    $advent_category_list = get_the_category_list( ', ',' ');
    
    $advent_tag_list = get_the_tag_list('',', ',' ');
    $advent_date = sprintf( '<time datetime="%1$s">%2$s</time>',
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );

    $advent_author = sprintf( '<a href="%1$s" title="%2$s" >%3$s</a>',
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf(/* translators: %s is author name*/ __( 'View all posts by %s', 'advent' ), get_the_author() ) ),
        get_the_author()
    );   
  
    $post_in = '<li><i class="fa fa-folder-open"></i> %1$s </li>';
    $post_on = '<li><i class="fa fa-calendar"></i> %3$s </li>';  
    $post_by = '<li><i class="fa fa-user"></i> %4$s </li>';
    $post_tag = '<li> <i class="fa fa-link"></i> %2$s </li>';
    $post_comment= '<li> <i class="fa fa-comments"></i>'. advent_comment_number_custom() .'</li>';   

    if ($advent_tag_list) {
        $advent_utility_text = '<div class="post-meta"><ul>'. $post_in . $post_on . $post_by . $post_tag . $post_comment.'</ul></div>';
        
    } elseif ( $advent_category_list ) {
        $advent_utility_text = '<div class="post-meta"><ul>'. $post_in . $post_on . $post_by . $post_tag . $post_comment.'</ul></div>';
    } else {
        $advent_utility_text = '<div class="post-meta"><ul>'. $post_on . $post_by . $post_tag . $post_comment .'</ul></div>';
    }
    
    
    printf(
        $advent_utility_text,
        $advent_category_list,
        $advent_tag_list,
        $advent_date,
        $advent_author
    );
}

function advent_comment_number_custom(){
$adventpro_num_comments = get_comments_number(); // get_comments_number returns only a numeric value
$adventpro_comments=__('No Comments','advent');
if ( comments_open() ) {
    if ( $adventpro_num_comments == 0 ) {
        $adventpro_comments = __('No Comments','advent');
    } elseif ( $adventpro_num_comments > 1 ) {
        $adventpro_comments = $adventpro_num_comments . __(' Comments','advent');
    } else {
        $adventpro_comments = __('1 Comment','advent');
    }
}
return $adventpro_comments;
}