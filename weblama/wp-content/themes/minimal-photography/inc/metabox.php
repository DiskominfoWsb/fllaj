<?php
/**
* Sidebar Metabox.
*
* @package Minimal Photography
*/
 
add_action( 'add_meta_boxes', 'minimal_photography_metabox' );

if( ! function_exists( 'minimal_photography_metabox' ) ):


    function  minimal_photography_metabox() {
        
        add_meta_box(
            'minimal-photography-custom-metabox',
            esc_html__( 'Layout Settings', 'minimal-photography' ),
            'minimal_photography_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'minimal-photography-custom-metabox',
            esc_html__( 'Layout Settings', 'minimal-photography' ),
            'minimal_photography_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;


/**
 * Callback function for post option.
*/
if( ! function_exists( 'minimal_photography_post_metafield_callback' ) ):
    
	function minimal_photography_post_metafield_callback() {
		global $post;
        $post_type = get_post_type($post->ID);
		wp_nonce_field( basename( __FILE__ ), 'minimal_photography_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'minimal-photography'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' ): ?>
                        <li>
                            <a id="metabox-navbar-appearance" href="javascript:void(0)">

                                <?php esc_html_e('Appearance Settings', 'minimal-photography'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'minimal-photography'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','minimal-photography'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','minimal-photography' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','minimal-photography'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','minimal-photography'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','minimal-photography'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','minimal-photography'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' ): ?>

                    <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','minimal-photography'); ?></h3>

                                <?php
                                $minimal_photography_ed_feature_image = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_feature_image', true ) ); ?>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-feature-image" name="minimal_photography_ed_feature_image" value="1" <?php if( $minimal_photography_ed_feature_image ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','minimal-photography' ); ?></label>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Video Aspect Ration Setting','minimal-photography'); ?></h3>

                            <?php $twp_aspect_ratio = esc_attr( get_post_meta($post->ID, 'twp_aspect_ratio', true) ); ?>
                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <label><b><?php esc_html_e( 'Video Aspect Ratio','minimal-photography' ); ?></b></label>

                                <select name="twp_aspect_ratio">

                                    <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'default' ){ echo 'selected'; } ?> value="default"><?php esc_html_e('Default','minimal-photography'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'square' ){ echo 'selected'; } ?> value="square"><?php esc_html_e('Square','minimal-photography'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'portrait' ){ echo 'selected'; } ?> value="portrait"><?php esc_html_e('  Portrait','minimal-photography'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'landscape' ){ echo 'selected'; } ?> value="landscape"><?php esc_html_e('Landscape','minimal-photography'); ?></option>

                                </select>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $minimal_photography_ed_post_views = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_views', true ) );
                    $minimal_photography_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_read_time', true ) );
                    $minimal_photography_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_like_dislike', true ) );
                    $minimal_photography_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_author_box', true ) );
                    $minimal_photography_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_social_share', true ) );
                    $minimal_photography_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_reaction', true ) );
                    $minimal_photography_ed_post_rating = esc_html( get_post_meta( $post->ID, 'minimal_photography_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','minimal-photography'); ?></h3>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-views" name="minimal_photography_ed_post_views" value="1" <?php if( $minimal_photography_ed_post_views ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-views"><?php esc_html_e( 'Disable Post Views','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-read-time" name="minimal_photography_ed_post_read_time" value="1" <?php if( $minimal_photography_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-like-dislike" name="minimal_photography_ed_post_like_dislike" value="1" <?php if( $minimal_photography_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-author-box" name="minimal_photography_ed_post_author_box" value="1" <?php if( $minimal_photography_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-social-share" name="minimal_photography_ed_post_social_share" value="1" <?php if( $minimal_photography_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-reaction" name="minimal_photography_ed_post_reaction" value="1" <?php if( $minimal_photography_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','minimal-photography' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="minimal-photography-ed-post-rating" name="minimal_photography_ed_post_rating" value="1" <?php if( $minimal_photography_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                <label for="minimal-photography-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','minimal-photography' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'minimal_photography_save_post_meta' );

if( ! function_exists( 'minimal_photography_save_post_meta' ) ):

    function minimal_photography_save_post_meta( $post_id ) {

        global $post;

        if( !isset( $_POST[ 'minimal_photography_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['minimal_photography_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if( isset(  $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        $twp_disable_ajax_load_next_post_old = sanitize_text_field( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 

        $twp_disable_ajax_load_next_post_new = '';

        if( isset( $_POST['twp_disable_ajax_load_next_post'] ) ){
            $twp_disable_ajax_load_next_post_new = minimal_photography_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) );
        }

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }

        $minimal_photography_ed_feature_image_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_feature_image', true ) );

        $minimal_photography_ed_feature_image_new = '';
        if( isset( $_POST['minimal_photography_ed_feature_image'] ) ){
            $minimal_photography_ed_feature_image_new = absint( wp_unslash( $_POST['minimal_photography_ed_feature_image'] ) );
        }

        if ( $minimal_photography_ed_feature_image_new && $minimal_photography_ed_feature_image_new != $minimal_photography_ed_feature_image_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_feature_image', $minimal_photography_ed_feature_image_new );

        }elseif( '' == $minimal_photography_ed_feature_image_new && $minimal_photography_ed_feature_image_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_feature_image', $minimal_photography_ed_feature_image_old );

        }

        $minimal_photography_ed_post_views_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_views', true ) );

        $minimal_photography_ed_post_views_new = '';
        if( isset( $_POST['minimal_photography_ed_post_views'] ) ){

            $minimal_photography_ed_post_views_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_views'] ) );

        }

        if( $minimal_photography_ed_post_views_new && $minimal_photography_ed_post_views_new != $minimal_photography_ed_post_views_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_views', $minimal_photography_ed_post_views_new );

        }elseif( '' == $minimal_photography_ed_post_views_new && $minimal_photography_ed_post_views_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_views', $minimal_photography_ed_post_views_old );

        }

        $minimal_photography_ed_post_read_time_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_read_time', true ) );

        $minimal_photography_ed_post_read_time_new = '';
        if( isset( $_POST['minimal_photography_ed_post_read_time'] ) ){

            $minimal_photography_ed_post_read_time_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_read_time'] ) );

        }

        if( $minimal_photography_ed_post_read_time_new && $minimal_photography_ed_post_read_time_new != $minimal_photography_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_read_time', $minimal_photography_ed_post_read_time_new );

        }elseif( '' == $minimal_photography_ed_post_read_time_new && $minimal_photography_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_read_time', $minimal_photography_ed_post_read_time_old );

        }

        $minimal_photography_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_like_dislike', true ) );

        $minimal_photography_ed_post_like_dislike_new = '';
        if( isset( $_POST['minimal_photography_ed_post_like_dislike'] ) ){

            $minimal_photography_ed_post_like_dislike_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_like_dislike'] ) );

        }

        if( $minimal_photography_ed_post_like_dislike_new && $minimal_photography_ed_post_like_dislike_new != $minimal_photography_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_like_dislike', $minimal_photography_ed_post_like_dislike_new );

        }elseif( '' == $minimal_photography_ed_post_like_dislike_new && $minimal_photography_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_like_dislike', $minimal_photography_ed_post_like_dislike_old );

        }

        $minimal_photography_ed_post_author_box_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_author_box', true ) );

        $minimal_photography_ed_post_author_box_new = '';
        if( isset( $_POST['minimal_photography_ed_post_like_dislike'] ) ){

            $minimal_photography_ed_post_author_box_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_like_dislike'] ) );

        }

        if( $minimal_photography_ed_post_author_box_new && $minimal_photography_ed_post_author_box_new != $minimal_photography_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_author_box', $minimal_photography_ed_post_author_box_new );

        }elseif( '' == $minimal_photography_ed_post_author_box_new && $minimal_photography_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_author_box', $minimal_photography_ed_post_author_box_old );

        }

        $minimal_photography_ed_post_social_share_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_social_share', true ) );

        $minimal_photography_ed_post_social_share_new = '';
        if( isset( $_POST['minimal_photography_ed_post_social_share'] ) ){

            $minimal_photography_ed_post_social_share_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_social_share'] ) );

        }

        if( $minimal_photography_ed_post_social_share_new && $minimal_photography_ed_post_social_share_new != $minimal_photography_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_social_share', $minimal_photography_ed_post_social_share_new );

        }elseif( '' == $minimal_photography_ed_post_social_share_new && $minimal_photography_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_social_share', $minimal_photography_ed_post_social_share_old );

        }

        $minimal_photography_ed_post_reaction_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_reaction', true ) );

        $minimal_photography_ed_post_reaction_new = '';
        if( isset( $_POST['minimal_photography_ed_post_reaction'] ) ){

            $minimal_photography_ed_post_reaction_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_reaction'] ) );

        }

        if( $minimal_photography_ed_post_reaction_new && $minimal_photography_ed_post_reaction_new != $minimal_photography_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_reaction', $minimal_photography_ed_post_reaction_new );

        }elseif( '' == $minimal_photography_ed_post_reaction_new && $minimal_photography_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_reaction', $minimal_photography_ed_post_reaction_old );

        }

        $minimal_photography_ed_post_rating_old = absint( get_post_meta( $post_id, 'minimal_photography_ed_post_rating', true ) );

        $minimal_photography_ed_post_rating_new = '';
        if( isset( $_POST['minimal_photography_ed_post_rating'] ) ){

            $minimal_photography_ed_post_rating_new = absint( wp_unslash( $_POST['minimal_photography_ed_post_rating'] ) );

        }

        if ( $minimal_photography_ed_post_rating_new && $minimal_photography_ed_post_rating_new != $minimal_photography_ed_post_rating_old ){

            update_post_meta ( $post_id, 'minimal_photography_ed_post_rating', $minimal_photography_ed_post_rating_new );

        }elseif( '' == $minimal_photography_ed_post_rating_new && $minimal_photography_ed_post_rating_old ) {

            delete_post_meta( $post_id,'minimal_photography_ed_post_rating', $minimal_photography_ed_post_rating_old );

        }

        $twp_aspect_ratio_old = esc_attr( get_post_meta( $post_id, 'twp_aspect_ratio', true ) );

        $twp_aspect_ratio_new = '';
        if( isset( $_POST['twp_aspect_ratio'] ) ){

            $twp_aspect_ratio_new = esc_attr( wp_unslash( $_POST['twp_aspect_ratio'] ) );

        }

        if( $twp_aspect_ratio_new && $twp_aspect_ratio_new != $twp_aspect_ratio_old ){

            update_post_meta ( $post_id, 'twp_aspect_ratio', $twp_aspect_ratio_new );

        }elseif( '' == $twp_aspect_ratio_new && $twp_aspect_ratio_old ) {

            delete_post_meta( $post_id,'twp_aspect_ratio', $twp_aspect_ratio_old );

        }


    }

endif;   