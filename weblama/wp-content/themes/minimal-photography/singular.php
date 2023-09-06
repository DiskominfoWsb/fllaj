<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
get_header();
    global $post;
    $minimal_photography_ed_post_rating = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_rating', true ) ); ?>

    <div class="wrapper">
        <div class="theme-panelarea">

            <div class="theme-panelarea-primary">

                <?php get_template_part( 'template-parts/header/header', 'content' ); ?>

            </div>

            <div id="site-contentarea" class="theme-panelarea-secondary">
                <main id="main" class="site-main <?php if( $minimal_photography_ed_post_rating ){ echo 'minimal-photography-no-comment'; } ?>" role="main">

                    <?php
                    if( have_posts() ): ?>

                        <div class="article-wraper">


                            <?php while (have_posts()) :
                                the_post();

                                get_template_part('template-parts/content', 'single');

                                /**
                                 *  Output comments wrapper if it's a post, or if comments are open,
                                 * or if there's a comment number – and check for password.
                                **/

                                if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div><!-- .comments-wrapper -->

                                <?php
                                }

                            endwhile; ?>

                        </div>

                    <?php
                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;

                    /**
                     * Navigation
                     *
                     * @hooked minimal_photography_post_floating_nav - 10
                     * @hooked minimal_photography_related_posts - 20
                     * @hooked minimal_photography_single_post_navigation - 30
                    */

                    do_action('minimal_photography_navigation_action'); ?>

                </main>
            </div>

            <div class="theme-panelarea-tertiary">
                <?php get_sidebar(); ?>
            </div>

        </div>
    </div>

<?php
get_footer();
