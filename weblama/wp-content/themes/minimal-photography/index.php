<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
get_header(); ?>

    <div class="wrapper">

        <div class="theme-panelarea theme-panelarea-blocks theme-panelarea-anime">

            <div class="theme-panel-blocks theme-header-panel">

                <?php get_template_part('template-parts/header/header', 'content'); ?>

            </div>
            
            <?php
            if (!is_front_page()) { ?>

                <div id="site-contentarea" class="theme-panel-blocks theme-header-panel archive-breadcrumb-panel">
                    <div class="theme-panel-header">

                        <?php minimal_photography_breadcrumb(); ?>
                        <?php minimal_photography_archive_title(); ?>

                    </div>
                </div>
            
            <?php }

            
            
            if (have_posts()):

                $i = 1;
                while (have_posts()) :
                    the_post();

                    ?>
                    <div class="theme-panel-blocks article-panel-blocks twp-archive-items-main">

                    <?php

                    if( is_front_page() ){

                        if( $i == 1 ){

                            ?><div id="site-contentarea"></div><?php

                        }

                    }
                    
                    get_template_part('template-parts/content', get_post_format());

                    ?></div><?php

                    $i++;
                endwhile;

            else :

                get_template_part('template-parts/content', 'none');

            endif; ?>

        </div>

        <?php do_action('minimal_photography_archive_pagination'); ?>

    </div>

<?php get_footer();
