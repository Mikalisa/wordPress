<?php 
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wpxon_blog_recommended_plugins' );
 
function wpxon_blog_recommended_plugins() { 
	$plugins = array( 
		array(
			'name'      => esc_html__('CMB2','wpxon-blog'),
			'slug'      => 'cmb2',
			'required'  => false,
		), 
		array(
			'name'      => __('Smart Author Box','wpxon-blog'),
			'slug'      => 'smart-author-box',
			'required'  => false,
		), 
	);

	$config = array(
		'id'           => 'wpxon_blog',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
