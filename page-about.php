<?php
/**
 * 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package TWD_Starter_Theme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<h1> <?php the_title(); ?> </h1>

		<?php

		if (function_exists('get_field') ) {

			if ( get_field('gallery_title') ) {

				echo '<h2>';
				the_field('gallery_title');
				echo '</h2>';

				}
			} 
		
		
		?>

		<?php

			if (function_exists('get_field') ) {

				$images = get_field('gallery_collection');				
				$size = 'full';

					if ($images) {
					echo	"<ul>";
						
						foreach ($images as $image) {

						echo	"<li>";
							echo '<img src="' . ($image['sizes']['medium']) . '"' . " " . 'alt="' . 'Gallery Images' . '"' . '/>';   
						echo	"</li>";
						}
						
						
					echo 	"</ul>";

					}
						
				

			}


			// check if the functions exists,
			// it means we check if the plugin is activated...
			// with a function which was set only in this plugin (get_field())
			if (function_exists ('get_field')){

				// check if the field exists, and has value
				if(get_field('about_post')){

					// check if the repeater field has rows of data
				if( have_rows('about_post') ):

					// loop through the rows of data
				while ( have_rows('about_post') ) : the_row();

					// display a sub field value

					echo '<div class="about-para-wrap">';

					echo '<div class="about-para-title">';
					echo '<h2>';
					the_sub_field('about_title');
					echo '</h2>';
					echo '</div>';

					echo '<div class="about-para-text">';
					echo '<p>';
					the_sub_field('about_text');
					echo '</p>';
					echo '</div>';

					echo '</div>';

				endwhile;

				else :

				// no rows found

				endif;


				}
			}

		?>

		<?php

		$args = array(
			'post_type' => 'ms-staff',
			'post_per_page' => 4,
                'order'          => 'ASC',
                'orderby'        => 'title'
				
			);
			$query = new WP_Query( $args );
			
			echo '<h2>The Team</h2>';

			echo '<div class="team-main">';

			if ( $query->have_posts() ) {
				while( $query->have_posts() ) {
				$query->the_post();
				echo '<article>';

				// Insert the post ID into the code
				// to create the anchor navigation
				echo '<div class="staff-team">';
				the_post_thumbnail('thumbnail');
					echo '<div class="team-text">';
						echo '<h3 id="'. get_the_ID() .'">';
						the_title();
						echo '</h3>';
						the_content();
					echo '</div>';
				echo '</div>';

				echo '</article>';
				}
				wp_reset_postdata();
			} 


		?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();