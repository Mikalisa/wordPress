<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wpxon_Blog
 */ 
get_header();
	?>
	 
	    <div class="main-content main-content--small-gap">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-8">
	                	<?php while ( have_posts() ) : the_post(); 
	                		get_template_part( 'template-parts/content-single', get_post_format() );
	                	endwhile; ?> 
	                </div>
	                <div class="col-md-4">
	                    <aside class="sidebar pdl-35">
	                        <?php get_sidebar(); ?>
	                    </aside>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="pdt50"></div>
	 
	<?php  
get_footer();
