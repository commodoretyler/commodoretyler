<?php
/**
 * The Footer Sidebar
 *
 * @package WordPress
 * @subpackage Commodore_Tyler
 * @since Commodore Tyler 1.0
 */

if ( ! is_active_sidebar( 'footer' ) ) {
	return;
}
?>

<div id="home-page-footer">
	<div id="footer-sidebar" class="footer-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'footer' ); ?>
	</div><!-- #footer-sidebar -->
</div><!-- #supplementary -->
