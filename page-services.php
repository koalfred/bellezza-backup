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
			
$images = get_field('slider');
if( $images ): ?>
    <div id="slider" class="flexslider">
    <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
        <ul class="slides">
            <?php foreach( $images as $image ): ?>
                <li>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="mySlides" />
                    <p><?php echo esc_html($image['caption']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
        
  <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
    <div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
  <span class="dot" onclick="currentSlide(4)"></span> 
  <span class="dot" onclick="currentSlide(5)"></span> 
  <span class="dot" onclick="currentSlide(6)"></span>
  <span class="dot" onclick="currentSlide(7)"></span> 
</div>
            <?php endif; 
?>
<h2 class="services-header">Our Services</h2>

<?php
    the_field('styles');
    ?>
    <h2 class="services-header">Gallery</h2>
    <div id="lightgallery" class="lightgallery">
<?php
$images = get_field('gallery');
if( $images ): ?>
         <ul class="gallery-link lightgallery" id="lightgallery">
            <?php foreach( $images as $image ): if ( 'gif' == $filetype['ext'] ) {
		$url = $image['url'];
	} else {
		$url = $image['sizes'][$size];
	} ?>
                <li>
                   <a href="<?php echo $image['url']; ?>" data-lightbox="mygallery"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" title="<?php echo $image['caption']; ?>" /></a>
                </li>
            <?php endforeach; ?>
        </ul>
            </div>
        <?php endif;
            ?>
            <h2 class="services-header">Testimonials</h2>                
                    <div class="blockquote"> 
                        <?php
			                the_field('testimonials');
                        ?> 
            </div> 
            <?php
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

