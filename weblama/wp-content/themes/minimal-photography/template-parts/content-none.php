<?php
/**
 * The default template for none content
 *
 * Used for both singular and index.
 *
 * @subpackage Minimal Photography
 * @since 1.0.0
 */
?>

<section class="no-results not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'minimal-photography' ); ?></h1>
	</header>

	<div class="page-content">

		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'minimal-photography' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'minimal-photography' ); ?></p>

			<?php
			get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'minimal-photography' ); ?></p>
				
				<?php
				get_search_form();

		endif; ?>

	</div>

</section><!-- .no-results -->