<?php
/*
 * Advent  Breadcrumbs
 */
global $advent_options;
function advent_custom_breadcrumbs() {
  $advent_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show  
  $advent_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show

  global $post;
  if (is_home() || is_front_page()) {
    if ($advent_showonhome == 1) echo '<ol class="breadcrumb"><li class="active"><a href="' . esc_url ( home_url('/') ). '">' . esc_html__('Home','advent') . '</a></li></ol>';
    
  }  else {

    echo '<ol class="breadcrumb"><li class="active"><a href="' . esc_url ( home_url('/') ) . '">' . esc_html__('Home','advent') . '</a> ';
    
   if ( is_category() ) {
      $advent_thisCat = get_category(get_query_var('cat'), false);
      if ($advent_thisCat->parent != 0) echo get_category_parents($advent_thisCat->parent, TRUE, ' ');      
          esc_html_e('category','advent'); echo ' "'.single_cat_title('', false) . '"' ;
    } 
    elseif ( is_search() ) {
       esc_html_e('Search Results For','advent'); echo ' "'. get_search_query() . '"';

    } elseif ( is_day() ) {
      echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
      echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a>  ';
      echo  esc_html(get_the_time('d')) ;

    } elseif ( is_month() ) {
      echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ';
      echo  esc_html(get_the_time('F')) ;

    } elseif ( is_year() ) {
      echo  esc_html(get_the_time('Y')) ;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $advent_post_type = get_post_type_object(get_post_type());
        $advent_slug = $advent_post_type->rewrite;
        echo '<a href="' . esc_url ( home_url('/'. $advent_slug['slug']) ) . '/' . $advent_slug['slug'] . '/">' . esc_html($advent_post_type->labels->singular_name) . '</a>';
        if ($advent_showcurrent == 1) echo  esc_attr(get_the_title()) ;
      } else {
        $advent_cat = get_the_category(); $advent_cat = $advent_cat[0];
        $advent_cats = get_category_parents($advent_cat, TRUE, ' ');
        if ($advent_showcurrent == 0) $advent_cats = preg_replace("#^(.+)\s \s$#", "$1", $advent_cats);
        echo $advent_cats;
        if ($advent_showcurrent == 1) echo  esc_attr(get_the_title()) ;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $advent_post_type = get_post_type_object(get_post_type());
      echo  esc_html($advent_post_type->labels->singular_name) ;

    } elseif ( is_attachment() ) {
      $advent_parent = get_post($post->post_parent);
      $advent_cat = get_the_category($advent_parent->ID); $advent_cat = $advent_cat[0];
      echo get_category_parents($advent_cat, TRUE, '  ');
      echo '<a href="' . esc_url(get_permalink($advent_parent)) . '">' . $advent_parent->post_title . '</a>';
      if ($advent_showcurrent == 1) echo  esc_attr(get_the_title()) ;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($advent_showcurrent == 1) echo  esc_attr(get_the_title()) ;

    } elseif ( is_page() && $post->post_parent ) {
      $advent_parent_id  = $post->post_parent;
      $advent_breadcrumbs = array();
      while ($advent_parent_id) {
        $advent_page = get_page($advent_parent_id);
        $advent_breadcrumbs[] = '<a href="' . get_permalink($advent_page->ID) . '">' . esc_attr(get_the_title($advent_page->ID)) . '</a>';
        $advent_parent_id  = $advent_page->post_parent;
      }
      $advent_breadcrumbs = array_reverse($advent_breadcrumbs);
      for ($advent_i = 0; $advent_i < count($advent_breadcrumbs); $advent_i++) {
        echo $advent_breadcrumbs[$advent_i];
        if ($advent_i != count($advent_breadcrumbs)-1) echo ' ';
      }
      if ($advent_showcurrent == 1) echo esc_attr(get_the_title()) ;

    } elseif ( is_tag() ) {
       esc_html_e('Posts tagged','advent'); echo ' "'.  single_tag_title('', false) . '"' ;

    } elseif ( is_author() ) {
       global $author;
      $advent_userdata = get_userdata($author);
       esc_html_e('Articles posted by ','advent'); echo esc_html($advent_userdata->display_name) ;

    } elseif ( is_404() ) {
       esc_html_e('Error 404','advent'); 
    }
    
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo esc_html__('Page','advent') . ' ' . esc_html(get_query_var('paged'));
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</li></ol>';
  }
} 