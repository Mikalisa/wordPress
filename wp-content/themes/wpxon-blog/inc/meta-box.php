<?php

add_action( 'cmb2_admin_init', 'wpxon_core_meta_box' ); 
function wpxon_core_meta_box() {   
	// meta prefix
	$meta_prefix = '_wpxon_blog_'; 
 
	/**=====================================================================
	 * Page Meta
	 =====================================================================*/ 

	$cmb2_PageOpt = new_cmb2_box( array(
		'id'           => $meta_prefix . 'page_extras',
		'title'        => __( 'Page Settings', 'wpxon-blog' ),
		'object_types' => array( 'page'), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb2_PageOpt->add_field( array(
	    'name'             =>  __( 'Banner Styles', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'banner_style',
	    'type'             => 'select',
	    'default'          => '1',
	    'options'          => array(
	        '1'          	=> __( 'Default', 'wpxon-blog' ), 
	        '2'          	=> __( 'Featured Banner', 'wpxon-blog' ) ,
	        '3'          	=> __( 'Post Slider', 'wpxon-blog' ), 
	    ), 
	    'desc'             => __( 'Go to customizer to upload/change the Default Banner image.','wpxon-blog' ),
	) ); 
	$cmb2_PageOpt->add_field( array(
	    'name'             =>  __( 'Featured Banner', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'banner_img',
	    'desc'             => __( 'Upload banner image from here.','wpxon-blog' ),
	    'type'             => 'file',
		'options' 		   => array(
			'url'			=> false
		),
		'preview_size' 	   => array( 300, 80 ),
	) );
 


	/**=====================================================================
	 * metabox for post formates
	 =====================================================================*/  

	$cmb2_PostFormats = new_cmb2_box( array(
		'id'           => $meta_prefix . 'post_formats',
		'title'        => __( 'Post Format Settings', 'wpxon-blog' ),
		'object_types' => array( 'post'), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		//'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
	) );

	$cmb2_PostFormats->add_field( array(
	    'name'             =>  __( 'Video Type', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'video_type',
	    'type'             => 'select',
	    'default'          => '1',
	    'options'          => array(
	        'youtube'          => __( 'Youtube', 'wpxon-blog' ), 
	        'facebook'         => __( 'Facebook', 'wpxon-blog' ), 
	        'vimeo'            => __( 'Vimeo', 'wpxon-blog' ), 
	        'daily'            => __( 'Dailymotion', 'wpxon-blog' ), 
	    ), 
	) ); 

	$cmb2_PostFormats->add_field( array(
	    'name'             =>  __( 'Video ID', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'post_formate_vdo',
	    'desc'             => __( 'the <b>ID</b> is the bold text eg. http://vimeo.com/<b>27299211</b>, https://www.youtube.com/watch?v=<b>1LzRIhUAilk</b> If data is not set though post format is enabled then featured image will display by default.','wpxon-blog' ),
	    'type'             => 'text',
	) );

	$cmb2_PostFormats->add_field( array(
	    'name'             =>  __( 'Gallery Images', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'post_galery_list',
	    'desc'             => __( 'Upload Gallery Images Here. If gallery image is not avaliable then featured image will be displayed. If data is not set though post format is enabled then featured image will display by default.','wpxon-blog' ),
	    'type'             => 'file_list',
	) );
	$cmb2_PostFormats->add_field( array(
	    'name'             =>  __( 'Audio Url', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'post_audio',
	    'desc'             => __( 'Insert soundcloud trac link here. If data is not set though post format is enabled then featured image will display by default. ','wpxon-blog' ),
	    'type'             => 'text',
	) ); 
	$cmb2_PostFormats->add_field( array(
	    'name'             =>  __( 'Quote Text', 'wpxon-blog' ),
	    'id'               => $meta_prefix.'post_quote',
	    'desc'             => __( 'Write quote here. If data is not set though post format is enabled then featured image will display by default.','wpxon-blog' ),
	    'type'             => 'textarea',
	) );  

 
}

