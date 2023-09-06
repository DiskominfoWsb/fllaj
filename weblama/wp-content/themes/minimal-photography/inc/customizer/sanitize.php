<?php
/**
* Custom Functions.
*
* @package Minimal Photography
*/

if( !function_exists( 'minimal_photography_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_sidebar_option( $minimal_photography_input ){

        $minimal_photography_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $minimal_photography_input,$minimal_photography_metabox_options ) ){

            return $minimal_photography_input;

        }

        return;

    }

endif;

if( !function_exists( 'minimal_photography_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_single_pagination_layout( $minimal_photography_input ){

        $minimal_photography_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $minimal_photography_input,$minimal_photography_single_pagination ) ){

            return $minimal_photography_input;

        }

        return;

    }

endif;

if( !function_exists( 'minimal_photography_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_archive_layout( $minimal_photography_input ){

        $minimal_photography_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $minimal_photography_input,$minimal_photography_archive_option ) ){

            return $minimal_photography_input;

        }

        return;

    }

endif;

if( !function_exists( 'minimal_photography_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function minimal_photography_sanitize_header_layout( $minimal_photography_input ){

        $minimal_photography_header_options = array( 'layout-1','layout-2','layout-3' );
        if( in_array( $minimal_photography_input,$minimal_photography_header_options ) ){

            return $minimal_photography_input;

        }

        return;

    }

endif;

if( !function_exists( 'minimal_photography_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function minimal_photography_sanitize_single_post_layout( $minimal_photography_input ){

        $minimal_photography_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $minimal_photography_input,$minimal_photography_single_layout ) ){

            return $minimal_photography_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'minimal_photography_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function minimal_photography_sanitize_checkbox( $minimal_photography_checked ) {

		return ( ( isset( $minimal_photography_checked ) && true === $minimal_photography_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'minimal_photography_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function minimal_photography_sanitize_select( $minimal_photography_input, $minimal_photography_setting ) {

        // Ensure input is a slug.
        $minimal_photography_input = sanitize_text_field( $minimal_photography_input );

        // Get list of choices from the control associated with the setting.
        $choices = $minimal_photography_setting->manager->get_control( $minimal_photography_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $minimal_photography_input, $choices ) ? $minimal_photography_input : $minimal_photography_setting->default );

    }

endif;

if ( ! function_exists( 'minimal_photography_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function minimal_photography_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;