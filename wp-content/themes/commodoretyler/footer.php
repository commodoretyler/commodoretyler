<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Commodore_Tyler
 * @since Commodore Tyler 1.0
 */
?>

		</div><!-- #main -->

		<footer id="contact" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
			  <ul class="contact-icons">
			    <li class="contact-icon"><a href="mailto:me@commodoretyler.com" title="Email" target="_blank"><span class="entypo-mail"></span></a></li>
			    <li class="contact-icon"><a href="http://github.com/tylermoore" title="Github"><span class="entypo-github" target="_blank"></span></a></li>
			    <li class="contact-icon"><a href="http://twitter.com/commodoretyler" title="Twitter"><span class="entypo-twitter" target="_blank"></span></a></li>
			  </ul>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>