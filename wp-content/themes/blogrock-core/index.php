<?php
/**
 * BlogRock Core home template file.
 *
 *
 *
 * @since      BlogRock Core 1.0
 */

get_header(); ?>

<?php

blogrock_get_header(); //display header info or header image

?>
<section class="smartlib-content-section container">

	<div id="page" role="main" class="smartlib-layout-page <?php echo esc_attr( blogrock__f('blogrock_content_layout_class', 'col-sm-16 col-md-12', 'frontpage' ) ) ?>">


		<div class="row">
		<?php
		while(have_posts()):the_post();
			get_template_part('views/content-loop', 'sidebar');
		endwhile;
		?>

		</div>
		<?php
		blogrock_list_pagination('nav-below');
		?>

	</div><!-- #page -->
	<?php do_action('blogrock_get_layout_sidebar', 'frontpage_content');//display homepage sidebar ?>
</section>
<?php get_footer(); ?>
