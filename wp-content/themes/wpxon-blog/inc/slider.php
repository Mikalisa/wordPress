<?php 
// slider 
?>

 
<div class="blog-post__image-wrap">
    <div id="blog-carousel" class="owl-carousel blog-carousel item2-carousel nf-carousel-theme">
 
	    <?php 
	        /* Start the Loop */ 
	        $wpxon_post_query = new WP_Query(array( 'post_type'=> 'post','posts_per_page'=>'-1' ));
	        while ( $wpxon_post_query->have_posts() ) : $wpxon_post_query->the_post();
	        	$image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'wpxon-blog-slider'); 
	            $image_url = $image_src[0];
	            if(empty($image_url)){
					$image_url = WPXON_BLOG_URI.'assets/img/slider.png';
	            }
	            $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);  ?>  
				<div class="item">
					<div class="slide-text"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
				</div>
	        <?php endwhile; 
	    ?>  
    </div>  
</div>  