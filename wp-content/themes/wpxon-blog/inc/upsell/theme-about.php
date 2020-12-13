<?php
/**
 * Theme about page
 *
 * @package WPxon Blog
 */

//Add the theme page
add_action('admin_menu', 'wpxon_blog_add_theme_about');
function wpxon_blog_add_theme_about(){

	if ( !current_user_can('install_plugins') ) {
		return;
	}


	$theme_about = add_theme_page( __('About WPxon','wpxon-blog'), __('About WPxon','wpxon-blog'), 'manage_options', 'wpxon-blog-about', 'wpxon_blog_about_page','', 2 );
	add_action( 'load-' . $theme_about, 'wpxon_blog_about_hook_styles' );
}

//Callback
function wpxon_blog_about_page() {
	$user = wp_get_current_user();
?>
	<div class="about-container"> 
		<h1 class="about-title"><?php echo sprintf( __( 'Welcome to WPxon Blog version %s', 'wpxon-blog' ), esc_html( wp_get_theme()->version ) ); ?></h1>
		<div class="welcome">
			<p class="welcome-desc"><?php esc_html_e( 'Wpxon Blog is a clean and creative responsive blog theme for writers, bloggers, travelers & photographers who wish to share their incredible stories on different niche like lifestyle, travel, food, technology, fashion, business, marketing etc. The theme is responsive, it is fully compatible with mobile phones, desktop computers and tablets. You can create a beautiful website with this theme. For more information, visit our website: ', 'wpxon-blog' ); ?> <a target="_blank" href="<?php echo esc_url('https://www.wpxon.com'); ?>"><?php esc_html_e('https://wpxon.com/','wpxon-blog'); ?></a></p>
			<a class="welcome-img" href="<?php echo esc_url('https://wpxon.com/'); ?>"  target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="<?php echo esc_attr('WPxon Blog','wpxon-blog'); ?>"></a>
		
		</div>

		<div class="wpxon-theme-tabs">

			<div class="wpxon-tab-nav nav-tab-wrapper">
				<a href="#begin" data-target="begin" class="nav-button nav-tab begin active"><?php esc_html_e( 'Getting started', 'wpxon-blog' ); ?></a>
				<a href="#actions" data-target="actions" class="nav-button actions nav-tab"><?php esc_html_e( 'Recommended Actions', 'wpxon-blog' ); ?></a>
				<a href="#support" data-target="support" class="nav-button support nav-tab"><?php esc_html_e( 'Support', 'wpxon-blog' ); ?></a> 
				<a href="#changelog" data-target="changelog" class="nav-button changelog nav-tab"><?php esc_html_e( 'Changelog', 'wpxon-blog' ); ?></a>
			</div>

			<div class="wpxon-tab-wrapper">

				<div id="#begin" class="wpxon-tab begin show">
					<h3><?php esc_html_e( 'Step 1 - Implement recommended actions', 'wpxon-blog' ); ?></h3>
					<p><?php esc_html_e( 'We\'ve made a list of steps for you to follow to get the most of WPxon Blog.', 'wpxon-blog' ); ?></p>
					<p><a class="actions" href="#actions"><?php esc_html_e( 'Check recommended actions', 'wpxon-blog' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Step 2 - Read documentation', 'wpxon-blog' ); ?></h3>
					<p><?php esc_html_e( 'Our documentation (including video tutorials) will have you up and running in no time.', 'wpxon-blog' ); ?></p>
					<p><a href="http://wpxon.com" target="_blank"><?php esc_html_e( 'Documentation', 'wpxon-blog' ); ?></a></p>
					<hr>
					<h3><?php esc_html_e( 'Step 3 - Customize', 'wpxon-blog' ); ?></h3>
					<p><?php esc_html_e( 'Use the Customizer to make WPxon Blog your own.', 'wpxon-blog' ); ?></p>
					<p><a class="button button-primary button-large" href="<?php echo admin_url( 'customize.php' ); ?>"><?php esc_html_e( 'Go to Customizer', 'wpxon-blog' ); ?></a></p>
				</div>

				<div id="#actions" class="wpxon-tab actions">
					<h3><?php esc_html_e( 'Install: CMB2', 'wpxon-blog' ); ?></h3>
					<p><?php esc_html_e( 'It is highly recommended that you install CMB2 (metabox plugin). It will enable the post format functionality of this theme.', 'wpxon-blog' ); ?></p>
					
					<?php if ( ! class_exists( 'CMB2_Bootstrap_260' ) ): ?>
					<?php // $so_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=cm'), 'install-plugin_redux-framework'); ?>
					<?php $so_url = self_admin_url('themes.php?page=tgmpa-install-plugins'); ?>
					<p>
						<a target="_blank" class="install-now button" href="<?php echo esc_url( $so_url ); ?>"><?php esc_html_e( 'Install and Activate', 'wpxon-blog' ); ?></a>
					</p>
					<?php else : ?>
						<p style="color:#23d423;font-style:italic;font-size:14px;"><?php esc_html_e( 'Plugin installed and active!', 'wpxon-blog' ); ?></p>
					<?php endif; ?>
 
				</div>

				<div id="#support" class="wpxon-tab support">
					<div class="column-wrapper"> 
						<span class="dashicons dashicons-sos"></span>
						<h3><?php esc_html_e( 'Visit our forums', 'wpxon-blog' ); ?></h3>
						<p><?php esc_html_e( 'Need help? Go ahead and visit our support forums and we\'ll be happy to assist you with any theme related questions you might have', 'wpxon-blog' ); ?></p>
						<a href="http://wpxon.com/support/" target="_blank"><?php esc_html_e( 'Visit the forums', 'wpxon-blog' ); ?></a>				 
					</div>
				</div> 
				<div id="#changelog" class="wpxon-tab changelog">
					 
					<h3><?php esc_html_e('Changelog','wpxon-blog'); ?>:</h3>
					
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.1.2 - Jan 30, 2020','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Comment date format bug fixed.','wpxon-blog'); ?>
						</li>  
						<li class="list">
							<?php esc_html_e('Single post navigation added.','wpxon-blog'); ?>
						</li>  
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.1.1 - Aug 1, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Smart Author Box Plugin recommended.','wpxon-blog'); ?>
						</li>  
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.1.0 - July 22, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Post Slider Added.','wpxon-blog'); ?>
						</li>  
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.9 - July 20, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Banner Section Added.','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('CSS issue fixed.','wpxon-blog'); ?>
						</li> 
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.8 - May 24, 2019 ','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Link Color & Link Hover color settings added to the customizer panel.','wpxon-blog'); ?>
						</li> 
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.7 - Apr 13, 2019 ','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Breadcrumb responsive issue fixed. ','wpxon-blog'); ?>
						</li> 
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.6 - March 29, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Post format feature added.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('css style issues improved.','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Theme about page added.','wpxon-blog'); ?>
						</li> 
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.5 - March 7, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Pagination style improved.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Blog Left Sideabr Added.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Blog 2 Column Tempalte Added.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Blog 3 Column Tempalte Added.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Masonry added to the post grid.','wpxon-blog'); ?>
						</li>
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.4 - March 1, 2019','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Header Text static to changebale. Input field added to the customizer under Header Image.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('pot file updated.','wpxon-blog'); ?>
						</li>
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.2 - February 1, 2019','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Non minified files included.','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('Image license issue fixed.','wpxon-blog'); ?>
						</li> 
						<li class="list">
							<?php esc_html_e('Translate function added to the comment number.','wpxon-blog'); ?>
						</li> 
					</ul> 
					<ul class="single-update">
						<li class="head">
							<?php esc_html_e('1.0.1 - January 1, 2019','wpxon-blog'); ?>
						</li>
						<li class="list">
							<?php esc_html_e('pot file updated.','wpxon-blog'); ?>
						</li>
					</ul> 
				</div>		
			</div>
		</div>
	</div>
<?php
}

//Styles
function wpxon_blog_about_hook_styles(){
	add_action( 'admin_enqueue_scripts', 'wpxon_blog_about_page_styles' );
}
function wpxon_blog_about_page_styles() {
	wp_enqueue_style( 'wpxon-blog-about-style', get_template_directory_uri() . '/inc/upsell/css/about-page.css', array(), true );

	wp_enqueue_script( 'wpxon-blog-about-script', get_template_directory_uri() . '/inc/upsell/js/about-page.js', array('jquery'),'', true );

}


