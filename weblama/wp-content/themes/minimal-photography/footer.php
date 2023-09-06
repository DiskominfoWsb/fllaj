<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Minimal Photography
 * @since 1.0.0
 */ ?>

</div>
	
	<?php
	/**
	 * Toogle Contents
	 * @hooked minimal_photography_header_toggle_search - 10
	 * @hooked minimal_photography_content_offcanvas - 30
	*/

	do_action('minimal_photography_before_footer_content_action'); ?>

    <footer id="site-footer" role="contentinfo">

        <?php
        /**
         * Footer Content
         * @hooked minimal_photography_footer_content_widget - 10
         * @hooked minimal_photography_footer_content_info - 20
        */

        do_action('minimal_photography_footer_content_action'); ?>

    </footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
