<?php
/**
 * The Header template for our theme
 */
$advent_options = get_option('advent_theme_options'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">	
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">        
        <?php    wp_head(); ?>       
    </head>
    <body <?php body_class(); ?>>
        <?php /* start condition for only home page */
        if (is_page_template('page-template/front-page.php')) { ?> 
		<div class="header_bg">
                <span class="mask-overlay"></span>
                <div class="webpage-container">
                        <?php if(get_theme_mod ( 'advent_topsec_title',$advent_options['topheading'])!='' ){ ?>
                        <div class="col-sm-12 col-md-12 col-xs-12 text-center center-block">                                
                                <div class="logo">
                                    <?php if(get_theme_mod ( 'advent_topsec_logo_img','')!=''){ ?>
                                       <img src="<?php echo esc_url(get_theme_mod ( 'advent_topsec_logo_img')); ?>" >
                                    <?php } else{ ?>
                                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                                            <?php bloginfo( 'name' ); ?>
                                        </a>
                                    <?php } ?>
                                </div>                            
                            <?php if (get_theme_mod ( 'advent_topsec_title',$advent_options['topheading'])!='') { ?>
                                <div class="slogan">
                                    <h1><?php echo esc_html(get_theme_mod ( 'advent_topsec_title',$advent_options['topheading'])); ?></h1>
                                </div>
                        <?php } ?>
                        </div>
                    <?php } ?>                   
                </div>
            </div>
<?php } /* end condition for only home page */ ?>   
        <header>
            <div class="scrolling-header">
                <div class="header-menu" id="stickyheader">
                    <div class="webpage-container">            
                        <div class="col-sm-12 col-md-2">
                            <div  class="menu-logo">
                                <?php 
                                if(has_custom_logo()){
                                        the_custom_logo();            
                                    } 
                                if (display_header_text()) { ?>
									<div class='site-title-text' >
										<a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
											<?php bloginfo( 'name' ); ?>
										</a>		
										<p class="site-description"><?php bloginfo( 'description' ); ?></p>
									  </div>
                                <?php }
                                  ?>
                                <div class="navbar-header res-nav-header toggle-respon">
                                    <?php if (has_nav_menu('primary')) { ?>
                                        <button type="button" class="navbar-toggle menu_toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                            <span class="sr-only"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-10">
                            <?php $advent_defaults = array(
                                'theme_location' => 'primary',
                                'container' => 'div',
                                'container_class' => 'collapse navbar-collapse main_menu no-padding',
                                'container_id' => 'example-navbar-collapse',
                                'echo' => true,                                
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 0,
                            );
                            if (has_nav_menu('primary')) {
                                wp_nav_menu($advent_defaults);
                            } ?>       
                        </div>               
                    </div>
                </div>
            </div>
            <?php if (get_header_image()) { ?>
                <div class="custom-header-img">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <img src="<?php header_image(); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </a>
                </div>
                <?php } ?>
        </header>