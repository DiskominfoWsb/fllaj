<?php

/**
 * Minimal Photography About Page
 * @package Minimal_Photography
 *
*/

if( !class_exists('Minimal_Photography_About_page') ):

	class Minimal_Photography_About_page{

		function __construct(){

			add_action('admin_menu', array($this, 'minimal_photography_backend_menu'),999);

		}

		// Add Backend Menu
        function minimal_photography_backend_menu(){

            add_theme_page(esc_html__( 'Minimal Photography Options','minimal-photography' ), esc_html__( 'Minimal Photography Options','minimal-photography' ), 'activate_plugins', 'minimal-photography-about', array($this, 'minimal_photography_main_page'));

        }

        // Settings Form
        function minimal_photography_main_page(){

            require get_template_directory() . '/classes/about-render.php';

        }

	}

	new Minimal_Photography_About_page();

endif;