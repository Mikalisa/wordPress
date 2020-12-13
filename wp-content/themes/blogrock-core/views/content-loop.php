<?php
/**
 * The default template for displaying content in loop.
 */
?>

<div class="col-lg-6">
    <article
        id="post-<?php the_ID(); ?>" <?php post_class('smartlib-article-box smartlib-article-column-box smartlib-article-wide-box'); ?>>

        <div class="row">
            <div class="col-xs-3 col-md-1 text-center">
                <?php do_action('blogrock_block_date', 'blog_loop'); ?>
            </div>
            <div class="col-xs-9 col-md-5 smartlib-no-padding-right-md smartlib-no-padding-left-md">
                <?php blogrock_post_thumbnail_block('blogrock-content-wide', 'blog_loop') ?>
            </div>
            <div class="col-xs-12 col-md-6 smartlib-no-padding-left">
                <article class="smartlib-content-container">
                    <h3 class="entry-title">
                        <a href="<?php the_permalink(); ?>"
                           title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'blogrock-core'), the_title_attribute('echo=0'))); ?>"
                           rel="bookmark"><?php the_title(); ?></a>
                    </h3>

                    <?php the_content(); ?>

                    <?php blogrock_box_footer(); ?>
                </article>
            </div>
        </div>

    </article>
</div>
