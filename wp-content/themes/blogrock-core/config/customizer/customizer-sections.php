<?php
return array(

    // Panel: Genearl Settings

    'section_logo' => array(
        'title' => esc_attr__('Logo & favicon', 'blogrock-core'),
        'panel' => 'panel_general_settings',
        'priority' => 20,
    ),

    'section_typography' => array(
        'title' => esc_attr__('Page Typography', 'blogrock-core'),
        'panel' => 'panel_general_settings',
        'priority' => 30,
    ),

    // Blog settings

    'section_blog_layout' => array(
        'title' => esc_attr__('Blog layout', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_blog_settings',
    ),

    'section_archive_header' => array(
        'title' => esc_attr__('Archives header', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_blog_settings',
    ),
    'section_posts_list' => array(
        'title' => esc_attr__('Posts list', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_blog_settings',
    ),

    'section_articles_header' => array(
        'title' => esc_attr__('Articles Header', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_blog_settings',
    ),

    'section_articles_content' => array(
        'title' => esc_attr__('Articles Content', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_blog_settings',
    ),

    // Pages settings

    'section_page_header' => array(
        'title' => esc_attr__('Page Header', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_pages_settings',
    ),



    // Navigation Settings

    'section_breadcrumbs' => array(
        'title' => esc_attr__('Breadcrumbs', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_navigation_settings',
    ),

    // Top Bar

    'section_topbar' => array(
        'title' => esc_attr__('Top Bar', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_layout_sections'
    ),

    // Main Navigation Bar

    'section_main_navbar' => array(
        'title' => esc_attr__('Main Navigation Bar', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_layout_sections'
    ),

    // Main Menu

    'section_main_menu' => array(
        'title' => esc_attr__('Main Menu', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_layout_sections'
    ),

    // Footer

    'section_footer' => array(
        'title' => esc_attr__('Footer', 'blogrock-core'),
        'priority' => 31,
        'panel' => 'panel_layout_sections'
    ),

    'section_smartlib_custom_code' => array(
        'title' => esc_attr__('Custom Code', 'blogrock-core'),
        'priority' => 80,
        'panel' => 'smartlib_panel_general_settings',
    ),

    'smartlib_layout' => array(
        'title' => esc_attr__('Layout', 'blogrock-core'),
        'priority' => 40,
        'panel'          => 'smartlib_panel_general_settings',
    ),

    'smartlib_pages_settings' => array(
        'title' => esc_attr__('Pages Settings', 'blogrock-core'),
        'priority' => 80,
        'panel'          => 'smartlib_panel_general_settings',
    ),

    'smartlib_blog_settings' => array(
        'title' => esc_attr__('Blog Settings', 'blogrock-core'),
        'priority' => 80,
        'panel'          => 'smartlib_panel_general_settings',
    )
);