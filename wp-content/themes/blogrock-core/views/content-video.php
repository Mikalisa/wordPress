<?php
/**
 * The default template for displaying single content.

 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('smartlib-article-box'); ?>>

	<div class="smartlib-single-content-container">

		<?php blogrock_post_thumbnail_block('blogrock-content-wide', 'blog_single'); ?>
		<?php blogrock_meta_post('blog_single') ?>

		<div class="smartlib-content-container entry-content">
			<?php the_content(); ?>
		</div>
		<?php do_action('blogrock_custom_single_page_pagination'); ?>


		<?php do_action('blogrock_entry_tags', '') ?>
	</div>



	<footer class="smrtlib-post-footer">
		<?php blogrock_display_author_box() ?>
	</footer>


</article>

