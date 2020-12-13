<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Wpxon_Blog
 */
 global $wpxon;
get_header();
?>
    <div class="main-content">
        <div class="container">  
            <div class="row"> 
                <div class="col-md-8">
                    <div class="row">
                        <?php 
                        if ( have_posts() ) : 
                            /* Start the Loop */
                            while ( have_posts() ) : the_post(); 
                                get_template_part( 'template-parts/content', get_post_format() ); 
                            endwhile; 
                        else :
                            echo '<div class="col-md-12">';
                            get_template_part( 'template-parts/content', 'none' );
                            echo '</div>';
                        endif;
                        ?>  
                    </div>
                    <div class="row mt30">
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
