<?php
/**
 * The template for displaying Archive pages.
 */

get_header();
?>
	<section class="smartlib-content-section container">
		<?php do_action('blogrock_breadcrumb'); ?>
		<header class="archive-header smartlib-above-content-header">
			<h1 class="archive-title"><?php
				if (is_day()) :
					printf(esc_html__('Daily Archives: %s', 'blogrock-core'), '<span>' . get_the_date() . '</span>'); elseif (is_month()) :
					printf(esc_html__('Monthly Archives: %s', 'blogrock-core'), '<span>' . get_the_date(esc_html_x('F Y', 'monthly archives date format', 'blogrock-core')) . '</span>');
				elseif (is_year()) :
					printf(esc_html__('Yearly Archives: %s', 'blogrock-core'), '<span>' . get_the_date(esc_html_x('Y', 'yearly archives date format', 'blogrock-core')) . '</span>');
				else :
					esc_html_e('Archives', 'blogrock-core');
				endif;
				?></h1>

			<?php if (category_description()) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo esc_html( category_description() ); ?></div>
			<?php endif; ?>
		</header><!-- .archive-header -->
	</section>
<?php if (have_posts()) : ?>

<section class="smartlib-content-section container">
<div id="page" role="main" class="smartlib-layout-page <?php echo esc_attr(apply_filters('blogrock_content_layout_class', 'col-sm-16 col-md-12', 'blog_loop')) ?>">
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


</div><!-- #page -->

<?php do_action('blogrock_get_layout_sidebar', 'blog_loop'); ?>
</section>

<?php get_footer(); ?>