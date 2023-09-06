<?php
/**
* Layouts Settings.
*
* @package Minimal Photography
*/


$base_url = home_url();

$minimal_photography_panels_sections = array(

	'theme_general_settings' => array(

		'title' => esc_html__('General Settings','minimal-photography'),
		'sections' => array(

			array(
				'title' => esc_html__('Logo & Site Identity','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bcontrol%5D=custom_logo'),
				'icon'	=> 'dashicons-format-image',
			),
			array(
				'title' => esc_html__('Background Image','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=background_image'),
                'icon'	=> 'dashicons-desktop',
			),
			array(
				'title' => esc_html__('Menu Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bpanel%5D=nav_menus'),
				'icon'	=> 'dashicons-menu',
			),

		),

	),
	'theme_colors_panel' => array(

		'title' => esc_html__('Color Settings','minimal-photography'),
		'sections' => array(

			array(
				'title' => esc_html__('Color Options','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=colors'),
                'icon'	=> 'dashicons-admin-customizer',
			),
			array(
				'title' => esc_html__('Color Scheme','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=color_scheme'),
                'icon'	=> 'dashicons-art',
			),
			array(
				'title' => esc_html__('Category Scheme','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=minimal_photography_category_color_section'),
                'icon'	=> 'dashicons-art',
			),

		),

	),
	'theme_option_panel' => array(

		'title' => esc_html__('Theme Options','minimal-photography'),
		'sections' => array(

			array(
				'title' => esc_html__('Header Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=main_header_setting'),
                'icon'	=> 'dashicons-align-center',
			),
			array(
				'title' => esc_html__('Pagination Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=minimal_photography_pagination_section'),
                'icon'	=> 'dashicons-ellipsis',
            ),
			array(
				'title' => esc_html__('Post Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=posts_settings'),
                'icon'	=> 'dashicons-admin-settings',
			),
			array(
				'title' => esc_html__('Single Post Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=single_post_setting'),
                'icon'	=> 'dashicons-welcome-write-blog',
			),
			array(
				'title' => esc_html__('Animation Settings','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=animation_settings'),
                'icon'	=> 'dashicons-layout',
			),
			array(
				'title' => esc_html__('Footer Setting','minimal-photography'),
				'url'	=> esc_url( $base_url.'/wp-admin/customize.php?autofocus%5Bsection%5D=footer_widget_area'),
                'icon'	=> 'dashicons-admin-generic',
			),

		),

	),

);

include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
$rec_plugins = Minimal_Photography_Getting_started::minimal_photography_recommended_plugins();

?>
<div class="twp-about-main">

	<div class="about-page-header">
		<div class="about-wrapper">
            <div class="about-wrapper-inner">
                <div class="about-header-left">
                    <h1 class="about-theme-title">
                        <a href="<?php echo esc_url( 'https://www.themeinwp.com/theme/minimal-photography' ); ?>">
                            <img src="<?php echo esc_url( get_template_directory_uri().'/assets/images/minimal-photography-logo.png' ); ?>" class="about-theme-logo"> <span class="theme-version">1.0.0</span>
                        </a>
                    </h1>
                </div>
                <div class="about-header-right">
                    <p><?php esc_html_e('Eye-catching, Lightweight, and Highly Customizable WordPress Theme','minimal-photography'); ?></p>
                </div>
            </div>
		</div>
	</div>

    <div class="about-page-content">
	    <div class="about-wrapper">
            <div class="about-wrapper-inner">

                <div class="about-content-left">

                    <?php
                    foreach( $minimal_photography_panels_sections as $panels ){ ?>

                        <div class="about-content-panel">

                            <?php if( isset( $panels['title'] ) && $panels['title'] ){ ?>

                                <h2 class="about-panel-title"><?php echo esc_html( $panels['title'] );  ?></h2>

                            <?php } ?>
                            <div class="about-panel-items about-panel-2-columns">
                            <?php

                            if( isset( $panels['sections'] ) && $panels['sections'] ){

                                foreach( $panels['sections'] as $section ){ ?>


                                    <div class="about-items-wrap">
                                        <?php if( isset( $section['icon'] ) && $section['icon'] ){ ?>
                                            <span class="about-items-icon dashicons <?php echo esc_attr( $section['icon'] ); ?>"></span>
                                        <?php } ?>

                                        <?php if( isset( $section['title'] ) && $section['title'] && isset( $section['url'] ) && $section['url'] ){ ?>
                                            <span class="about-items-title">
                                                <a href="<?php echo esc_url( $section['url'] ); ?>"><?php echo esc_html( $section['title'] ); ?></a>
                                            </span>
                                        <?php } ?>
                                    </div>


                            <?php }

                            } ?>
                            </div>
                        </div>

                    <?php } ?>

                    <div class="about-content-panel">

                        <h2 class="about-panel-title"><?php esc_html_e('Recommended Plugins','minimal-photography'); ?></h2>

                        <div class="about-panel-items about-panel-1-columns">

                            <?php foreach ($rec_plugins as $key => $plugin) {

                                $plugin_info = plugins_api(
                                    'plugin_information',
                                    array(
                                        'slug' => sanitize_key(wp_unslash($key)),
                                        'fields' => array(
                                            'sections' => false,
                                        ),
                                    )
                                );

                                $plugin_status = Minimal_Photography_Getting_started::minimal_photography_plugin_status($plugin['class'], $key, $plugin['PluginFile']); ?>

                                <div id="<?php echo 'minimal-photography-' . esc_attr($key); ?>" class="about-items-wrap">
                                    <div class="theme-recommended-plugin <?php if ($plugin_status['status'] == 'active') { echo 'recommended-plugin-active'; } ?>">

                                        <?php if (isset($plugin_info->name)) { ?>
                                            <a href="javascript:void(0)"><?php echo esc_html($plugin_info->name); ?></a>
                                        <?php } ?>

                                        <?php if (isset($plugin_status['status']) && isset($plugin_status['string'])) { ?>

                                            <a class="recommended-plugin-status <?php echo 'twp-plugin-' . esc_attr($plugin_status['status']); ?>"
                                               plugin-status="<?php echo esc_attr($plugin_status['status']); ?>"
                                               plugin-file="<?php echo esc_attr($plugin['PluginFile']); ?>"
                                               plugin-folder="<?php echo esc_attr($key); ?>"
                                               plugin-slug="<?php echo esc_attr($key); ?>"
                                               plugin-class="<?php echo esc_attr($plugin['class']); ?>"
                                               href="javascript:void(0)"><?php echo esc_html($plugin_status['string']); ?></a>

                                        <?php } ?>

                                    </div>

                                </div>

                            <?php } ?>

                        </div>

                    </div>

                </div>

                <div class="about-content-right">

                    <div class="about-content-panel">
                        <h2 class="about-panel-title"><span class="dashicons dashicons-sos"></span> <?php esc_html_e('Looking for help?','minimal-photography'); ?></h2>
                        <div class="about-content-info">
                            <p><?php esc_html_e('We have some resources available to help you in the right direction.','minimal-photography'); ?></p>
                            <ul>
                                <li>
                                    <a href="https://www.themeinwp.com/support/" target="_blank" rel="noopener"><?php esc_html_e('Create a Ticket','minimal-photography'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="https://www.themeinwp.com/knowledgebase/" target="_blank" rel="noopener"><?php esc_html_e('Knowledge Base','minimal-photography'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="https://docs.themeinwp.com/docs/minimal-photography" target="_blank" rel="noopener"><?php esc_html_e('Theme Documentation','minimal-photography'); ?> &#187;</a>
                                </li>
                            </ul>
                            <p><?php esc_html_e('Behind every single customer support question stands a real person ready to fix the problem in real-time and guide you through.','minimal-photography'); ?></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>