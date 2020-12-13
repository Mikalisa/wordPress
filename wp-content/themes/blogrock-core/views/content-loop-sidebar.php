<?php
/**
 * The default template for displaying content in loop - template with sidebar.
 */
?>
<div class="col-lg-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class('smartlib-article-box smartlib-article-wide-box'); ?>>

        <?php blogrock_post_thumbnail_block('blogrock-content-wide', 'blog_loop') ?>

        <div class="smartlib-content-container">
            <header class="entry-header">
                <h3 class="entry-title">
                    <a href="<?php the_permalink(); ?>"
                       title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'blogrock-core'), the_title_attribute('echo=0'))); ?>"
                       rel="bookmark"><?php the_title(); ?></a>
                </h3>


            </header>

            <div class="smartlib-entry-content entry-content">
                <?php the_excerpt(); ?>
            </div>
            <!-- .entry-content -->
            <?php blogrock_box_footer(); ?>
        </div>
        <!-- END smartlib-content-container -->
    </article>
</div>

