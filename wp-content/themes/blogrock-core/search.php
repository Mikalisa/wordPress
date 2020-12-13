<?php
/**
 * Template for displaying Search Results pages.
 */

get_header(); ?>


<section class="smartlib-content-section container">
    <header class="page-header smartlib-above-content-header">
        <h1 class="archive-title"><?php printf(esc_attr__('Search Results for: %s', 'blogrock-core'), '<span>' . get_search_query() . '</span>'); ?></h1>
    </header>
</section>

<section class="smartlib-content-section container">

    <div id="page" role="main"
         class="<?php echo esc_attr( blogrock__f('blogrock_content_layout_class', 'col-sm-16 col-md-12', 'blog_loop') ) ?>">

        <?php if (have_posts()) : ?>
            <div class="row">
            <?php
            /* Start the Loop */
            while (have_posts()) : the_post();
                get_template_part('views/content-search');
            endwhile;
            ?>
            </div>
            <?php
            blogrock_list_pagination('nav-below');
            ?>

        <?php else : ?>
        <article <?php post_class( 'smartlib-page-container' ); ?> >
            <div class="entry-content">
                <p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'blogrock-core'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </article>
        <?php endif; ?>


    </div>
    <!-- END #page -->

    <?php
    do_action('blogrock_get_layout_sidebar', 'blog_loop');
    ?>
</section>
<?php get_footer(); ?>
