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
$ed_popup_animation = get_theme_mod( 'ed_popup_animation',$minimal_photography_default['ed_popup_animation'] ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>

	<div class="entry-wrapper">

        <?php if( $ed_popup_animation ){ ?>

            <div class="anime-bg"></div>

        <?php }
        
    	add_filter('booster_extension_filter_like_ed', function ( ) {
            return false;
        });

        $content = apply_filters( 'the_content', get_the_content() );
        $video = false;

        // Only get video from the content if a playlist isn't present.
        if ( false === strpos( $content, 'wp-playlist-script' ) ) {

            $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );

        }

        if ( ! empty( $video ) ) { 

            $twp_aspect_ratio = get_post_meta( get_the_ID(), 'twp_aspect_ratio', true );
            if( $twp_aspect_ratio == '' ){ $twp_aspect_ratio = 'default'; } ?>

        	<div class="entry-content-media">
                
	            <div class="twp-content-video">

            		<?php
                    foreach ( $video as $video_html ) { ?>

                        <div class="entry-video theme-ratio-<?php echo esc_attr( $twp_aspect_ratio ); ?>">
                            <div class="twp-video-control-buttons hide-no-js">
                                <button attr-id="video-id-<?php echo absint( get_the_ID() ); ?>" class="theme-video-control theme-action-control twp-pause-play pause">
                                    <span class="action-control-trigger">
                                        <span class="twp-video-control-action">
                                            <?php minimal_photography_the_theme_svg('pause'); ?>
                                        </span>

                                        <span class="screen-reader-text">
                                            <?php esc_html_e('Pause','minimal-photography'); ?>
                                        </span>
                                    </span>
                                </button>

                                <button attr-id="video-id-<?php echo absint( get_the_ID() ); ?>" class="theme-video-control theme-action-control twp-mute-unmute unmute">
                                    <span class="action-control-trigger">
                                        <span class="twp-video-control-action">
                                            <?php minimal_photography_the_theme_svg('mute'); ?>
                                        </span>

                                        <span class="screen-reader-text">
                                            <?php esc_html_e('Unmute','minimal-photography'); ?>
                                        </span>
                                    </span>
                                </button>

                            </div>
                            <div class="theme-video-panel video-main-wraper" data-id="video-id-<?php echo absint( get_the_ID() ); ?>">
                                <?php echo minimal_photography_iframe_escape( $video_html ); ?>
                            </div>
                        </div>

                        <?php
                        break;

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

                        <a class="anime-image-trigger" href="javascript:void(0)">

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