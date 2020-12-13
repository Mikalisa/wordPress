<?php
/**
 * The template used for displaying page content in page.php
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'smartlib-page-container' ); ?> >

	<header class="smartlib-page-header">
		<h1>
			<?php the_title() ?>
			<small><?php echo esc_html( blogrock_get_subtitle() ) ?></small>
		</h1>

	</header>
	<div class="smartlib-thumbnail-outer">
		<?php blogrock_post_thumbnail( 'full' );	?>
	</div>

	<div class="smartlib-content-container entry-content">
		<?php the_content(); ?>
		<?php do_action( 'blogrock_custom_single_page_pagination' ); ?>
	</div>

</article>


