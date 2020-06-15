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

			// Generating the opening statment of the site
			?>
			<p><?php the_field('opening_statement'); ?></p>
			<?php

			// Generating images on the gallary
			$images = get_field('opening_screenshots');
			$size = 'large';

			if( $images ): ?>
			<div class="opening-screens">
				<?php foreach( $images as $image_id ){
					echo wp_get_attachment_image( $image_id, $size );
				}
				?>
			</div>
			<?php endif; ?>
			
			<article class="navi-box"> <?php
			// check if the repeater field has rows of data
			if( have_rows('front_page_repeater') ):

				// loop through the rows of data
				while ( have_rows('front_page_repeater') ) : the_row();

					// display a sub field value
					?>
					<section class="desc-wrapper <?php the_sub_field('title'); ?>-desc ">
						<h2 class="<?php the_sub_field('title'); ?>-title"><?php the_sub_field('title'); ?> </h2>
						<p><?php the_sub_field('description'); ?></p>
						<a href="<?php echo the_sub_field('button'); ?>" class="main-button" >More Info</a>
					</section><!--end of description-->
					<section class="img-wrapper <?php the_sub_field('title'); ?>-img">
						<?php echo wp_get_attachment_image( get_sub_field('image'), 'large' ) ?>
					</section><!--end of image wrapper-->
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
		</article>
	</main><!-- #main -->

<?php
get_footer();