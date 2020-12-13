<?php
return array(

    'panel_general_settings' => array(
        'priority' => 1,
        'title' =>  esc_attr__( 'General Settings', 'blogrock-core'),

    ),
    'panel_blog_settings' => array(
        'priority' => 1,
        'title' =>  esc_attr__( 'Blog settings', 'blogrock-core'),

    ),

    'panel_pages_settings' => array(
        'priority' => 1,
        'title' =>  esc_attr__( 'Pages settings', 'blogrock-core'),

    ),

    'panel_navigation_settings' => array(
        'priority' => 1,
        'title' =>  esc_attr__( 'Navigation', 'blogrock-core'),

    ),

    'panel_layout_sections' => array(
        'priority' => 1,
        'title' =>  esc_attr__( 'Layout Sections', 'blogrock-core'),

    ),


    'smartlib_panel_navbar' => array(
        'priority'    => 20,
        'title'       => esc_attr__( 'Navbar Section', 'blogrock-core'),

    ),
    'homepage_theme_panel' => array(
        'priority' => 10,
        'title' => esc_attr__('Home Page', 'blogrock-core'),
        'description' => esc_attr__('All sections form Home Page', 'blogrock-core'),
    )
);