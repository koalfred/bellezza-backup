<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bellezza
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php

		
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
			?>
			<article>
			
				<div class="wrapper">
			<?php
			

			// check if the repeater field has rows of data
			if( have_rows('faq') ):

			// loop through the rows of data
			while ( have_rows('faq') ) : the_row();

			// display a sub field value
			?>
			<div class="accordion-container">
				<button class="accordion">
					<?php
						the_sub_field('question');
					?>
				</button>
			<div class="panel">
				<p>
				<?php
					the_sub_field('answer');
				?>
				</p>
			</div>
		</div>
			</article>
<?php
    endwhile;

else :

    // no rows found

endif;



			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
