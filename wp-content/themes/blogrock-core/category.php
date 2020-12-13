<?php
/**
 * The template for displaying Category pages.
 */

get_header();
?>
    <section class="smartlib-content-section container">
        <?php do_action('blogrock_breadcrumb'); ?>
        <header class="archive-header smartlib-above-content-header">
            <h1 class="archive-title"><small><?php printf(esc_attr__('Category Archives: %s', 'blogrock-core'), '</small><span>' . esc_html(single_cat_title('', false)) . '</span>'); ?></h1>

            <?php if (category_description()) : // Show an optional category description ?>
                <div class="archive-meta"><?php echo esc_html(category_description()); ?></div>
            <?php endif; ?>
        </header>
        <!-- .archive-header -->
    </section>
<section class="smartlib-content-section container">

    <div id="page" role="main"
         class="smartlib-layout-page <?php echo esc_attr(apply_filters('blogrock_content_layout_class', 'col-sm-16 col-md-12', 'blog_loop')) ?>">

        <?php if (have_posts()) : ?>
            <div class="row">
            <?php

            /* Start the Loop */
            while (have_posts()) : the_post();
                get_template_part('views/content-loop', blogrock_get_loop_variant());
            endwhile;
            ?>
            </div>
            <?php
            blogrock_list_pagination('nav-below');
            ?>

        <?php else : ?>
            <?php get_template_part('views/content', 'none'); ?>
        <?php endif; ?>


    </div>
    <!-- END #page -->

<?php
do_action('blogrock_get_layout_sidebar', 'blog_loop');
?>
</section>
<?php get_footer(); ?>