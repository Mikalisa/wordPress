<?php
/**
 * The template for displaying posts in the Status post format
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'smartlib-content-area smartlib-status-area' ); ?>>
	<header class="smartlib-post-header entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php do_action( 'blogrock_display_meta_post', 'blog_single' ); ?>
	</header>
	<?php blogrock_post_thumbnail( 'blogrock-content-wide' ); ?>
	<div class="smartlib-single-content entry-content">
		<?php the_content(); ?>
	</div>
	<?php do_action( 'blogrock_custom_single_page_pagination' ); ?>
	<footer class="smartlib-footer-meta entry-meta">
		<?php
		do_action( 'blogrock_social_links_area' );
		?>
	</footer>
</article>