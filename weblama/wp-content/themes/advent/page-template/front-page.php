<?php
/*
 * Template Name: Home Page
 */
$advent_options = get_option('advent_theme_options');
get_header(); ?>
<section>
    <!-- features section start -->
    <div class="webpage-container container">
        <?php if(get_theme_mod ( 'advent_titlebar_title',$advent_options['home-title'])!='' || get_theme_mod ( 'advent_titlebar_subtitle',$advent_options['home-content']) !='' ){ ?>
            <div class="pro-features text-center">
                <?php if (get_theme_mod ( 'advent_titlebar_title',$advent_options['home-title'])!='') { ?> <h2> <?php echo esc_html(get_theme_mod ( 'advent_titlebar_title',$advent_options['home-title'])); ?></h2> <?php } ?>
                <?php if (get_theme_mod ( 'advent_titlebar_subtitle',$advent_options['home-content'])!='') { ?> <p> <?php echo esc_textarea(get_theme_mod ( 'advent_titlebar_subtitle',$advent_options['home-content'])); ?></p> <?php } ?>
            </div>        
        <?php } ?>    
        <div class="pro-features-icon row">
            <?php for ($advent_section_i = 1; $advent_section_i <= 6; $advent_section_i++):
                    if(get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_icon',$advent_options['faicon-' . $advent_section_i])!='' || get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_title',$advent_options['section-title-' . $advent_section_i] )!=''){ ?>		
                    <div class="col-md-4 col-sm-6 clear-feature">
                        <div class="bg-color animation text-center">
                            <div class="inner-bg">
                                <span class="fa <?php echo esc_attr(get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_icon',$advent_options['faicon-' . $advent_section_i])); ?> fa-3x fa-icons"></span>
                            </div>
                        </div>
                        <?php if (get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_title',$advent_options['section-title-' . $advent_section_i] )!='') { ?>		
                            <div class="pro-features-info">
                                
                                    <h2><?php echo esc_html(get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_title',$advent_options['section-title-' . $advent_section_i] )); ?></h2>
                                <?php 
                                if (get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_desc',$advent_options['section-content-' . $advent_section_i] )!='') { ?>
                                    <p><?php echo esc_textarea(get_theme_mod ( 'advent_homepage_first_section'.$advent_section_i.'_desc',$advent_options['section-content-' . $advent_section_i] )); ?></p>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } endfor; ?>
        </div>
    </div>
    <!-- features section end -->
    <!-- How it works part start -->
    <?php if(get_theme_mod ( 'advent_get_title',$advent_options['howitwork'])!='' || get_theme_mod ( 'advent_get_subtitle',$advent_options['howitworktitle'])!='' || get_theme_mod ( 'advent_get_info',$advent_options['howitworkdesc'] )!='' ){
            ?>
        <div class="works">
            <div class="webpage-container">
                <div class="how-works">
                    <?php if (get_theme_mod ( 'advent_get_title',$advent_options['howitwork'])!='') { ?><h2> <?php echo esc_html(get_theme_mod ( 'advent_get_title',$advent_options['howitwork'])); ?></h2><?php } ?>
                    <div class="<?php echo (get_theme_mod ( 'advent_youget_image_bg',$advent_options['howitwork-img'])!='') ? 'col-sm-6 col-md-8' : 'col-sm-12 col-md-12' ?> works-left">
                        <?php if (get_theme_mod ( 'advent_get_subtitle',$advent_options['howitworktitle'])!='') { ?><h2><?php echo esc_attr(get_theme_mod ( 'advent_get_subtitle',$advent_options['howitworktitle'])); ?></h2><?php }
                        if (get_theme_mod ( 'advent_get_info',$advent_options['howitworkdesc'])!='') { ?><p><?php echo esc_textarea(get_theme_mod ( 'advent_get_info',$advent_options['howitworkdesc'])); ?></p> <?php } ?>
                    </div>
                    <?php if (get_theme_mod ( 'advent_youget_image_bg',$advent_options['howitwork-img'])!='') { ?>
                        <div class="col-sm-6 col-md-4 chart-img">
                            <img src="<?php echo esc_url(get_theme_mod ( 'advent_youget_image_bg',$advent_options['howitwork-img'])); ?>" class="img-responsive" >
                        </div><?php } ?>
                </div>
            </div>     
        </div>
    <?php }
    if (get_theme_mod ( 'advent_blogcategory',$advent_options['post-category'])!='') { ?>
        <div class="container webpage-container">
            <?php if(get_theme_mod ( 'advent_blog_title',$advent_options['post-title'])!='') { ?>
                <div class="col-md-12 no-padding title text-center">
                    <h2>
                        <?php echo esc_html(get_theme_mod ( 'advent_blog_title',$advent_options['post-title'])); ?>
                    </h2>
                </div>
            <?php }
            $category= get_theme_mod ( 'advent_blogcategory',$advent_options['post-category']);
            $advent_args = array(
                'cat' => $category,
                'meta_query' => array(
                    array(
                        'key' => '_thumbnail_id',
                        'compare' => 'EXISTS'
                    ),
                )
            );
            $advent_query = new $wp_query($advent_args);
            if ($advent_query->have_posts()) { ?>       
                <div class="row home-gallery"> 
                    <?php if ($advent_query->found_posts >= 4) { ?>
                        <div class="slider-button">
                            <a class="btn prev btn_lr">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="btn next btn_lr">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div> 
                    <?php } ?>
                    <div class="home-gallery-image" id="our-brand"> 
                        <?php while ($advent_query->have_posts()) {
                            $advent_query->the_post(); ?>
                            <div class="item home-gallery-box">               
                                <div class="home-gallery-img">
                                    <?php if ( has_post_thumbnail() ) :
                                        the_post_thumbnail( 'advent-home-thumbnail-image');
                                    endif; ?>
                                    <div class="home-gallery-img-hover">
                                        <div class="mask"></div>
                                        <ul>
                                            <li><a href="<?php the_permalink() ?>"><i class="fa fa-arrows"></i></a></li>
                                        </ul>
                                    </div>                    
                                </div>
                            </div>
                        <?php }
                        wp_reset_postdata(); ?>
                    </div>        	
                </div>
            </div> 
        <?php } else { ?>
            <p><?php esc_html_e('No posts found', 'advent'); ?></p> 
        <?php }
    } ?>
</section>
<?php get_footer(); ?>