<?php
/**
 * The Template for displaying all single posts.
 */

get_header();

?>
    <section class="smartlib-content-section container">
        <?php while (have_posts()) : the_post(); ?>

            <?php do_action('blogrock_breadcrumb'); ?>


            <div id="page" role="main"
                 class="smartlib-layout-page <?php echo esc_attr( blogrock__f('blogrock_content_layout_class', 'smartlib-left-content', 'blog_single') ) ?>">
                <header class="smartlib-page-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <?php blogrock_meta_post('blog_single') ?>
                </header>
                <?php

                get_template_part('views/content', 'single');

                ?>
                <?php do_action('blogrock_prev_next_post_navigation'); ?>

                <?php blogrock_get_related_post_box(8, 4); ?>

                <?php comments_template('', true); ?>


            </div><!-- END #page -->
        <?php endwhile; // end of the loop. ?>
        <?php do_action('blogrock_get_layout_sidebar', 'blog_single');//display homepage sidebar ?>

    </section>
<?php get_footer(); ?>