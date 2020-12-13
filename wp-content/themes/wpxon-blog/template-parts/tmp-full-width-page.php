<?php
/**
 * Template Name: Page Full Width 
 *
 * @package Wpxon_Blog
 */
get_header();
?>
    <div class="wpxon-ful"> 	
		<?php 
			/* Start the Loop */
			while ( have_posts() ) : the_post(); 
				the_container();
			endwhile; 
		?>  
	</div> 
<?php get_footer();
