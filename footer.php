<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bellezza
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div class="belleza">
				<p> Bellezza 2020 - 2020 </p>
			</div>
			<div class="footer-menus">
				<nav id="footer-navigation" class="footer-navigation">
					<?php wp_nav_menu( array( 'theme_Location' => 'footer' ) ); ?>
				</nav>
				<nav id="social-navigation" class="social-navigation">
   					 <?php wp_nav_menu( array( 'theme_location' => 'social') ); ?>
				</nav>
			</div>
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bellezza' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'bellezza' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'bellezza' ), 'bellezza', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
