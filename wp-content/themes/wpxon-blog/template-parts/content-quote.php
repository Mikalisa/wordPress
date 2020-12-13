<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Wpxon_Blog
 */
?>
<div id="post-<?php the_ID(); ?>" class="col-md-12 col-sm-12 col-xs-12 col-xxs-12 cb "> 
    <div class="blog-post"> 
      <?php $post_quote = get_post_meta(get_the_ID(), '_wpxon_blog_post_quote', true); ?>
      <?php if(!empty($post_quote)): ?>
        <div class="blog-post__image-wrap wpx-quote">
          <blockquote class="dark-bg post-quote quote-card"> <?php echo sprintf( __('<p>%s</p>','wpxon-blog'),$post_quote ); ?></blockquote> 
        </div>
      <?php else: ?> 
        <?php if(has_post_thumbnail()): ?>
            <div class="blog-post__image-wrap">
                <?php $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'wpxon-blog'); 
                    $image_url = $image_src[0];
                    $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
                ?>
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">  
            </div>
        <?php endif; ?>
      <?php endif; ?> 
        <div class="blog-post__text-content">
            <div class="blog-meta">
                <span class="blog-meta__date"><?php wpxon_posted_on(); ?></span>
                <span class="blog-meta__separator">|</span>
                <span class="blog-meta__post-by"><?php esc_html_e('by','wpxon-blog'); ?> <?php the_author(); ?></span>
                <span class="blog-meta__separator">|</span>
                <a href="#" class="blog-meta__comments"><?php comments_number( 
                    __('No comments','wpxon-blog'), 
                    __('1 comment','wpxon-blog'), 
                    __('% comments','wpxon-blog') 
                    ); ?>
                </a>
            </div> 
            <h3 class="blog-post__title">
	            <?php if(is_sticky()): ?>
	                <i class="dashicons dashicons-admin-post"></i>
	            <?php endif; ?> 
	            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>" class="blog-post__read-more"><?php esc_html_e('Read More','wpxon-blog'); ?></a>
        </div>
    </div><!--/.blog-post-->
</div>