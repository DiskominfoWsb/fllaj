<?php
/**
 *
 * Pagination Functions
 *
 * @package True News
 */

if( !function_exists('minimal_photography_archive_pagination_x') ):

	// Archive Page Navigation
	function minimal_photography_archive_pagination_x(){

		// Global Query
	    if( is_front_page() ){

	    	$posts_per_page = absint( get_option('posts_per_page') );
	        $paged_c = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;
	        $posts_args = array(
	            'posts_per_page'        => $posts_per_page,
	            'paged'                 => $paged_c,
	        );
	        $posts_qry = new WP_Query( $posts_args );
	        $max = $posts_qry->max_num_pages;

	    }else{
	        global $wp_query;
	        $max = $wp_query->max_num_pages;
	        $paged_c = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
	    }

		$minimal_photography_default = minimal_photography_get_default_theme_options();
		$minimal_photography_pagination_layout = esc_html( get_theme_mod( 'minimal_photography_pagination_layout',$minimal_photography_default['minimal_photography_pagination_layout'] ) );
		$minimal_photography_pagination_load_more = esc_html__('Load More Posts','minimal-photography');
		$minimal_photography_pagination_no_more_posts = esc_html__('No More Posts','minimal-photography');

		if( $minimal_photography_pagination_layout == 'next-prev' ){

            the_posts_navigation([
            	'prev_text'=>minimal_photography_the_theme_svg( 'arrow-left',$return = true ).'<span class="nav-link-label">'. __('Older posts','minimal-photography').'</span>',
				'next_text'=> '<span class="nav-link-label">'. __('Newer posts','minimal-photography').'</span>'.minimal_photography_the_theme_svg( 'arrow-right',$return = true ),
            ]);

		}elseif( $minimal_photography_pagination_layout == 'load-more' || $minimal_photography_pagination_layout == 'auto-load' ){ ?>

			<div class="theme-ajax-loadpost hide-no-js">

				<div  style="display: none;" class="theme-loaded-content"></div>
				

				<?php if( $max > 1 ){ ?>

					<button class="theme-loading-button theme-loading-style" href="javascript:void(0)">
						<span style="display: none;" class="theme-loading-status"></span>
						<span class="loading-text"><?php echo esc_html( $minimal_photography_pagination_load_more ); ?></span>
					</button>

				<?php }else{ ?>

					<button class="theme-loading-button theme-loading-style theme-no-posts" href="javascript:void(0)">
						<span style="display: none;" class="theme-loading-status"></span>
						<span class="loading-text"><?php echo esc_html( $minimal_photography_pagination_load_more ); ?></span>
					</button>

				<?php } ?>

			</div>

		<?php }else{

			the_posts_pagination();

		}
			
	}

endif;
add_action('minimal_photography_archive_pagination','minimal_photography_archive_pagination_x',20);


add_action('wp_ajax_minimal_photography_single_infinity', 'minimal_photography_single_infinity_callback');
add_action('wp_ajax_nopriv_minimal_photography_single_infinity', 'minimal_photography_single_infinity_callback');

// Recommendec Post Ajax Call Function.
function minimal_photography_single_infinity_callback() {

    if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( wp_unslash( $_POST['_wpnonce'] ), 'minimal_photography_ajax_nonce' ) ) {

    	$postid = '';
    	if( isset( $_POST['postid'] ) ){
	        $postid = absint( wp_unslash( $_POST['postid'] ) );
	    }
        $minimal_photography_default = minimal_photography_get_default_theme_options();
        $post_single_next_posts = new WP_Query( array( 'post_type' => 'post','post_status' => 'publish','posts_per_page' => 1, 'post__in' => array( absint( $postid ) ) ) );

		minimal_photography_disable_post_views();
		minimal_photography_disable_post_read_time();
		

        if ( $post_single_next_posts->have_posts() ) :
            while ( $post_single_next_posts->have_posts() ) :
                $post_single_next_posts->the_post();

                $minimal_photography_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_feature_image', true ) );
				$minimal_photography_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_views', true ) );
				$minimal_photography_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_read_time', true ) );
				$minimal_photography_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_like_dislike', true ) );
				$minimal_photography_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_author_box', true ) );
				$minimal_photography_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_social_share', true ) );
				$minimal_photography_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'minimal_photography_ed_post_reaction', true ) );

                ob_start(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('after-load-ajax-'.get_the_ID() ); ?>> 

                	<?php
				    if( has_post_thumbnail() ){

				        if( empty( $minimal_photography_ed_feature_image ) ){ ?>

				            <div class="entry-featured-thumbnail">

					            <div class="entry-thumbnail">

					            	<?php

					            	$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' ); ?>
									<img src="<?php echo esc_url( $featured_image[0] ); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">

					            </div>

					            <?php if( class_exists('Booster_Extension_Class') && ( empty( $minimal_photography_ed_post_views ) || empty( $minimal_photography_ed_post_read_time ) ) ){ ?>

						            <div class="theme-page-vitals">

						            	<?php
						            	if( empty( $minimal_photography_ed_post_read_time ) ){ 
						            		echo do_shortcode('[booster-extension-read-time]');
						            	} ?>

				                        <?php
				                        if( empty( $minimal_photography_ed_post_views ) ){
				                            echo do_shortcode('[booster-extension-visit-count container="true"]');
				                        } ?>

									</div>

								<?php } ?>

				            </div>
				        
				        <?php
				        }
				    } ?>

						
			        <div class="entry-meta theme-meta-categories">
			            <?php minimal_photography_entry_footer( $cats = true, $tags = false, $edits = false ); ?>
			        </div>

					<header class="entry-header">

						<h1 class="entry-title entry-title-large">

				            <?php the_title(); ?>

				        </h1>

					</header>

					<div class="entry-meta">

						<?php
						minimal_photography_posted_by();
						minimal_photography_posted_on();
						?>

					</div>

					
					<div class="post-content-wrap">

						<?php if( empty( $minimal_photography_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>

							<div class="post-content-share">
								<?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
							</div>

						<?php } ?>

						<div class="post-content">

							<div class="entry-content">

								<?php

								if( class_exists('Booster_Extension_Class') && empty( $minimal_photography_ed_post_like_dislike ) ){ 
				            		echo do_shortcode('[booster-extension-like-dislike allenable="allenable"]');
				            	}

								the_content( sprintf(
									/* translators: %s: Name of current post. */
									wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'minimal-photography' ), array( 'span' => array( 'class' => array() ) ) ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								) ); ?>

							</div>

							<div class="entry-footer">
			                    <div class="entry-meta">
			                        <?php minimal_photography_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
			                    </div>
							</div>


						</div>

					</div>

				</article>

                <?php
                $next_post_id = '';
                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){ 
                    $next_post_id = $next_post->ID;
                }
                $output['postid'][] = $next_post_id;
                $output['content'][] = ob_get_clean();

            endwhile;

            wp_send_json_success($output);
            wp_reset_postdata();
        endif;
    }
    wp_die();
}
