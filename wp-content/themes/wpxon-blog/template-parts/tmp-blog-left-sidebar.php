<?php
/**
 * Template Name: Blog Left Sidebar
 *
 * @package Wpxon_Blog
 */
get_header(); ?>
  
    <div class="main-content">
        <div class="container">
            <div class="row"> 
                <div class="col-md-4">
                    <aside class="sidebar pdr-35">
                        <?php get_sidebar(); ?>
                    </aside>
                </div> 
                <div class="col-md-8"> 
                    <div class="row"> 
                        <?php 
                            /* Start the Loop */
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                            $wpxon_post_query = new WP_Query(array( 'post_type'=> 'post','paged' => $paged ));
                            while ( $wpxon_post_query->have_posts() ) : $wpxon_post_query->the_post();  
                                get_template_part( 'template-parts/content' );  
                            endwhile; 
                        ?> 
                    </div> 
                    <div class="row mt30 mb20">
                        <?php wpxon_pagination($wpxon_post_query->max_num_pages,"",$paged); ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>
<?php get_footer();
