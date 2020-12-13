<?php
/**
Prev Next Nav Template
 */
		?>
<nav class="nav-single">
<h3 class="sr-only"><?php esc_html_e( 'Post navigation', 'blogrock-core' ); ?></h3>

<div class="smartlib-single-next-prev">
	<?php previous_post_link( '%link', _x( '&larr; Previous post link', 'Previous post link', 'blogrock-core' ) ); ?>
	<?php next_post_link( '%link', _x( 'Next post link &rarr;', 'Next post link', 'blogrock-core' ) ); ?>
</div>
</nav><!-- .nav-single --