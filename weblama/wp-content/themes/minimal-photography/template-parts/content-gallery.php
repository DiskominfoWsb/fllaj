<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
$minimal_photography_default = minimal_photography_get_default_theme_options();
$ed_popup_animation = get_theme_mod( 'ed_popup_animation',$minimal_photography_default['ed_popup_animation'] );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
    <div class="entry-wrapper">

        <?php if( $ed_popup_animation ){ ?>

            <div class="anime-bg"></div>

        <?php }
        
        if( ( function_exists('has_block') && has_block('gallery', get_the_content() ) ) || get_post_gallery() ){ ?>

            <div class="entry-content-media">

                <div class="twp-content-gallery">
                    <?php

                    if ( function_exists('has_block') && has_block('gallery', get_the_content()) ) {

                        $post_blocks = parse_blocks( get_the_content() );

                        if( $post_blocks ){

                            foreach( $post_blocks as $post_block ){

                                if( isset( $post_block['blockName'] ) &&
                                    isset( $post_block['innerHTML'] ) &&
                                    $post_block['blockName'] == 'core/gallery' ){

                                    echo '<div class="entry-gallery">';
                                    echo wp_kses_post( $post_block['innerHTML'] );
                                    echo '</div>';
                                    break;

                                }

                            }

                        }

                    }else{

                        if( get_post_gallery() ){
                            echo '<div class="entry-gallery">';
                            echo wp_kses_post( get_post_gallery() );
                            echo '</div>';
                        }
                        
                    } ?>

                </div>

            </div>

        <?php
        }else{

            if( has_post_thumbnail() ){
                $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'medium_large' ); ?>

                <div class="entry-thumbnail">

                    <?php
                    if( $ed_popup_animation ){ ?>

                    <a  class="anime-image-trigger" href="javascript:void(0)">

                    <?php }else{ ?>

                    <a href="<?php the_permalink(); ?>">

                    <?php } ?>
                    <img class="anime-bg-image" src="<?php echo esc_url( $featured_image[0] ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>

                </div>

            <?php
            }

        } ?>

        <div class="post-content">

            <div class="entry-meta theme-meta-categories">

                <?php minimal_photography_entry_footer( $cats = true, $tags = false, $edits = false ); ?>

            </div>

            <header class="entry-header">

                <h2 class="entry-title entry-title-big">

                    <?php
                    if( $ed_popup_animation ){ ?>

                    <a href="javascript:void(0)">

                    <?php }else{ ?>

                    <a href="<?php the_permalink(); ?>">

                    <?php } ?>
                    <?php the_title(); ?>
                    </a>

                </h2>
            </header>

            <div class="entry-meta">

                <?php
                minimal_photography_posted_by();
                minimal_photography_posted_on();
                ?>

            </div>

            <?php minimal_photography_read_more_render(); ?>
            
        </div>
        
        <div class="entry-content-detail">

            <?php echo esc_html( wp_trim_words( get_the_content(), 100, '...' ) ); ?>

        </div>
            
    </div>
</article>