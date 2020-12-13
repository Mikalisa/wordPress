<div class="smartlib-author-info" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
    <div class="smartlib-author-description">
        <?php echo wp_kses_post( get_avatar(get_the_author_meta('user_email'), apply_filters('blogrock_author_bio_avatar_size', 68) )); ?>
        <!-- .author-avatar -->
        <div class="smartlib-author-description">
            <h3><?php  printf( wp_kses_post('About %s', 'blogrock-core'), get_the_author() ); ?></h3>

            <p><?php the_author_meta('description'); ?></p>
        </div>
        <!-- .author-description	-->
        <div class="smartlib-author-link">

            <div class="pull-left"><?php blogrock_ext_user_profile_fields() ?></div>

            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author" class="btn btn-default pull-right">
                <?php  printf(  wp_kses_post('View all posts by %s <span class="icon-chevron-sign-right"></span>', 'blogrock-core'), get_the_author()) ; ?>
            </a>
        </div>
    </div>
</div><!-- .smartlib-author-description -->