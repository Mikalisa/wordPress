<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpxon_Blog
 */
get_header(); ?>
 
    <div class="main-content">
        <div class="container">
            <div class="row"> 
                <div class="col-md-8"> 
                    <div class="row"> 
                        <?php 
                            /* Start the Loop */
                            while ( have_posts() ) : the_post(); 
                                get_template_part( 'template-parts/content', get_post_format() );  
                            endwhile; 
                        ?> 
                    </div> 
                    <div class="row mt30 mb20">
                        <?php wpxon_pagination(); ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <aside class="sidebar pdl-35">
                        <?php get_sidebar(); ?>
                    </aside>
                </div> 
            </div>  
        </div>
    </div>
<?php get_footer();
