<?php
return array(

    // tests

    'font-primary' => array(
        'type'        => 'typography',
        'label' => esc_attr__('Font Family', 'blogrock-core'),
        'section' => 'section_typography',
        'settings' => 'font-primary',
        'description' => esc_attr__('Choose a default font for your site', 'blogrock-core'),
        'priority'    => 10,
        'output'      => [
            [
                'element' => 'body',
            ],
        ],

    ),

    // Blog settings

    'blog_sidebar' => array(
        'type' => 'radio-image',
        'settings' => 'blog_sidebar',
        'label' => esc_attr__('Blog Layout Settings:', 'blogrock-core'),
        'section' => 'section_blog_layout',
        'description' => 'Note: this change has impact on archive pages and single post',
        'priority' => 1,
        'default' => '1',
        'choices' => array(
            '0' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/1c.png',
            '1' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/2cr.png',
            '2' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/2cl.png',
        )
    ),

    // articles content
    'single_show_entry_tags' => array(
        'type' => 'toggle',
        'settings' => 'single_show_entry_tags',
        'label' => esc_attr__('Display Entry Tags Below the Content', 'blogrock-core'),
        'section' => 'section_articles_content',
        'priority' => 1,
        'default' => 1,

    ),



    'article_meta' => array(
        'type' => 'multicheck',
        'settings' => 'article_meta',
        'label' => esc_attr__('Article Meta Settings:', 'blogrock-core'),
        'section' => 'section_articles_content',
        'choices'     => array(
            'show_date' => esc_html__( 'Show Date', 'blogrock-core'),
            'show_update_date' => esc_html__( 'Show Update Date', 'blogrock-core'),
            'show_author' => esc_html__( 'Show Author', 'blogrock-core'),
            'show_comments_count' => esc_html__( 'Show Comments Count', 'blogrock-core'),
            'show_category_line' => esc_html__( 'Show Category Line', 'blogrock-core'),
        ),
    ),

    //Displays the navigation to next/previous post

    'show_related_posts' => array(
        'type' => 'toggle',
        'settings' => 'show_related_posts',
        'label' => esc_attr__('Display related posts box', 'blogrock-core'),
        'section' => 'section_articles_content',
        'default' => true,
        'priority' => 1,
    ),

    //Displays the navigation to next/previous post

    'navigation_prev_next' => array(
        'type' => 'toggle',
        'settings' => 'navigation_prev_next',
        'label' => esc_attr__('Display the navigation to next/previous post', 'blogrock-core'),
        'description'=> esc_attr__('User can navigate to previous or next post below the article', 'blogrock-core'),
        'section' => 'section_articles_content',
        'default' => false,
        'priority' => 1,
    ),

    // Archives settings

    'archive_header_layout' => array(
        'type' => 'radio-image',
        'settings' => 'archive_header_layout',
        'label' => esc_attr__('Archive Header Layout', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'default' => '1',
        'choices' => array(
            '0' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-no-header.png',
            '1' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-header.png',
        )
    ),

    'archive_show_category_name' => array(
        'type' => 'toggle',
        'settings' => 'archive_show_category_name',
        'label' => esc_attr__('Display Category Name', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'default' => 1,

    ),

    'archive_category_prefix' => array(
        'type' => 'text',
        'settings' => 'archive_category_prefix',
        'label' => esc_attr__('Text before category', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'default' => '',

    ),

    'archive_breadcrumbs_show' => array(
        'type' => 'toggle',
        'settings' => 'archive_breadcrumbs_show',
        'label' => esc_attr__('Display breadcrumbs', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'default' => 1,

    ),

    'archive_breadcrumbs_color' => array(
        'type' => 'color',
        'settings' => 'archive_breadcrumbs_color',
        'label' => esc_attr__('Breadcrumbs Color', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.archive .rocksite-m-breadcrumbs__item a, .archive .rocksite-m-breadcrumbs__item span',
            'property' => 'color'
        )
    ),

    'archive_breadcrumbs_color_hover' => array(
        'type' => 'color',
        'settings' => 'archive_breadcrumbs_color_hover',
        'label' => esc_attr__('Breadcrumbs Hover Color', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.archive .rocksite-m-breadcrumbs__item a:hover',
            'property' => 'color'
        )
    ),





    'archive_header_background' => array(
        'type' => 'image',
        'settings' => 'archive_header_background',
        'label' => esc_attr__('Archive Header Background Image', 'blogrock-core'),
        'description' => esc_html__( 'Default background image for all pages', 'blogrock-core'),
        'section' => 'section_archive_header',
        'transport' => 'auto',
        'priority' => 1,
        'choices'     => array(
            'save_as' => 'id',
        ),

    ),


    'archive_header_background_paralax' => array(
        'type' => 'toggle',
        'settings' => 'archive_header_background_paralax',
        'label' => esc_attr__('Paralax Background', 'blogrock-core'),
        'description'=> esc_attr__('Enabling this option will animate background image while Archive is scrolling', 'blogrock-core'),
        'section' => 'section_archive_header',
        'default' => false,
        'priority' => 1,
    ),


    'archive_header_background_overlay' => array(
        'type' => 'color',
        'settings' => 'archive_header_background_overlay',
        'label' => esc_attr__('Background Overlay', 'blogrock-core'),
        'section' => 'section_archive_header',

        'priority' => 2,
        'choices'     => [
            'alpha' => true,
        ],
    ),

    'archive_header_invert_section' => array(
        'type' => 'toggle',
        'settings' => 'archive_header_invert_section',
        'label' => esc_attr__('Invert section: white text and dark background', 'blogrock-core'),
        'section' => 'section_archive_header',
        'default' => false,
        'priority' => 1,
    ),

    'archive_header_text_alignment' => array(
        'type' => 'radio-buttonset',
        'settings' => 'archive_header_text_alignment',
        'label' => esc_attr__('Text alignment', 'blogrock-core'),
        'description'=> esc_attr__('Enabling this option will animate background image while Archive is scrolling', 'blogrock-core'),
        'section' => 'section_archive_header',
        'default' => 'left',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.rocksite-o-content-header__title',
            'property' => 'text-align'
        ),
        'choices'     => array(
            'left'   => esc_html__( 'Left', 'blogrock-core'),
            'center' => esc_html__( 'Center', 'blogrock-core'),
            'right' => esc_html__( 'Right', 'blogrock-core'),
        ),
    ),


    'archive_header_title_color' => array(
        'type' => 'color',
        'settings' => 'archive_header_title_color',
        'label' => esc_attr__('Category Name & Description Text Color', 'blogrock-core'),
        'section' => 'section_archive_header',
        'priority' => 4,
        'transport' => 'auto',
        'choices'     => array(
            'alpha' => true,
        ),
        'output'      => array(
            'element' => '.rocksite-o-content-header .rocksite-o-content-header__title',
            'property' => 'color'
        )
    ),



    // Posts list Section

    'archive_list_type' => array(
        'type' => 'select',
        'settings' => 'archive_list_type',
        'label' => esc_attr__('Articles List Type', 'blogrock-core'),
        'section' => 'section_posts_list',
        'default' => 1,
        'priority' => 1,
        'transport' => 'auto',
        'choices'     => array(
            1   => esc_html__( 'One Column', 'blogrock-core'),
            2 => esc_html__( 'Two Columns', 'blogrock-core'),
            3 => esc_html__( 'Three Columns', 'blogrock-core'),
            4 => esc_html__( 'Four Columns', 'blogrock-core'),
        ),
    ),

    'archive_pagination_type' => array(
        'type' => 'radio-buttonset',
        'settings' => 'archive_pagination_type',
        'label' => esc_attr__('Archives Pagination Type', 'blogrock-core'),
        'section' => 'section_posts_list',
        'default' => 'prev-next',
        'priority' => 1,
        'transport' => 'auto',
        'choices'     => array(
            'prev-next'   => esc_html__( 'Older and Newer pagination links', 'blogrock-core'),
            'numeric' => esc_html__( 'Numeric Pagination', 'blogrock-core'),
        ),
    ),


    // Articles header

    'single_header_layout' => array(
        'type' => 'radio-image',
        'settings' => 'single_header_layout',
        'label' => esc_attr__('Archive Header Layout', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 1,
        'default' => '1',
        'choices' => array(
            '0' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-no-header.png',
            '1' => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-header.png',
        )
    ),

    'single_breadcrumbs_show' => array(
        'type' => 'toggle',
        'settings' => 'single_breadcrumbs_show',
        'label' => esc_attr__('Display breadcrumbs', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 1,
        'default' => true,

    ),

    'single_breadcrumbs_color' => array(
        'type' => 'color',
        'settings' => 'single_breadcrumbs_color',
        'label' => esc_attr__('Breadcrumbs Color', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.single .rocksite-m-breadcrumbs__item, .single .rocksite-m-breadcrumbs__item a, .single .rocksite-m-breadcrumbs__item span',
            'property' => 'color'
        )
    ),

    'single_breadcrumbs_color_hover' => array(
        'type' => 'color',
        'settings' => 'single_breadcrumbs_color_hover',
        'label' => esc_attr__('Breadcrumbs Hover Color', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.single .rocksite-m-breadcrumbs__item a:hover',
            'property' => 'color'
        )
    ),

    'single_header_text_alignment' => array(
        'type' => 'radio-buttonset',
        'settings' => 'single_header_text_alignment',
        'label' => esc_attr__('Text alignment', 'blogrock-core'),
        'description'=> esc_attr__('Enabling this option will animate background image while Archive is scrolling', 'blogrock-core'),
        'section' => 'section_articles_header',
        'default' => 'left',
        'priority' => 1,
        'transport' => 'auto',
        'output'      => array(

            array(
                'element' => '.rocksite-o-content-header__title',
                'property' =>'text-align'
            ),

            array(
                'element' => '.rocksite-o-content-header .rocksite-o-content__meta',
                'property' => 'justify-content'

            )

        ),
        'choices'     => array(
            'left'   => esc_html__( 'Left', 'blogrock-core'),
            'center' => esc_html__( 'Center', 'blogrock-core'),
            'right' => esc_html__( 'Right', 'blogrock-core'),
        ),
    ),

    'single_header_title_color' => array(
        'type' => 'color',
        'settings' => 'single_header_title_color',
        'label' => esc_attr__('Title Text Color in the large header', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 4,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.single .rocksite-o-content-header .rocksite-o-content-header__title',
            'property' => 'color'
        )
    ),

    'single_header_meta_color' => array(
        'type' => 'color',
        'settings' => 'single_header_meta_color',
        'label' => esc_attr__('Meta Color in the large header', 'blogrock-core'),
        'section' => 'section_articles_header',
        'priority' => 4,
        'transport' => 'auto',
        'output'      => array(
            'element' => '.single .rocksite-o-content-header .rocksite-o-content__meta span, .single .rocksite-o-content-header .rocksite-o-content__meta a, .single .rocksite-o-content-header .rocksite-o-content__meta i',
            'property' => 'color'
        )
    ),



    // pages settings

    'page_header_layout' => array(
        'type' => 'radio-image',
        'settings' => 'page_header_layout',
        'label' => esc_attr__('Page Header Layout', 'blogrock-core'),
        'section' => 'section_page_header',
        'priority' => 1,
        'default' => 1,
        'choices' => array(
            0 => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-no-header.png',
            1 => ROCKSITE_THEME_ADMIN_ASSETS . 'images/page-header.png',
        )
    ),

    'page_header_background' => array(
        'type' => 'image',
        'settings' => 'page_header_background',
        'label' => esc_attr__('Page Header Background Image', 'blogrock-core'),
        'description' => esc_html__( 'Default background image for all pages', 'blogrock-core'),
        'section' => 'section_page_header',
        'priority' => 1,
        'choices'     => array(
            'save_as' => 'id',
        ),

    ),


    'page_header_background_paralax' => array(
        'type' => 'toggle',
        'settings' => 'page_header_background_paralax',
        'label' => esc_attr__('Paralax Background', 'blogrock-core'),
        'description'=> esc_attr__('Enabling this option will animate background image while page is scrolling', 'blogrock-core'),
        'section' => 'section_page_header',
        'default' => false,
        'priority' => 1,
    ),


    'page_header_background_overlay' => array(
        'type' => 'color',
        'settings' => 'page_header_background_overlay',
        'label' => esc_attr__('Background Overlay', 'blogrock-core'),
        'section' => 'section_page_header',
        'default' => '#0088CC',
        'priority' => 2,
        'choices'     => [
            'alpha' => true,
        ],
    ),

    'page_header_invert_section' => array(
        'type' => 'toggle',
        'settings' => 'page_header_invert_section',
        'label' => esc_attr__('Invert section: white text and dark background', 'blogrock-core'),
        'section' => 'section_page_header',
        'default' => false,
        'priority' => 1,
    ),


    'page_header_title_color' => array(
        'type' => 'color',
        'settings' => 'page_header_title_color',
        'label' => esc_attr__('Title & Subtitle Text Color', 'blogrock-core'),
        'section' => 'section_page_header',

        'priority' => 4,
        'choices'     => [
            'alpha' => true,
        ],
    ),

    // navigation

    'breadcrumbs_show' => array(
        'type' => 'toggle',
        'settings' => 'breadcrumbs_show',
        'label' => esc_attr__('Enabling this option will display breadcrumbs block', 'blogrock-core'),
        'section' => 'section_breadcrumbs',
        'transport' => 'auto',
        'default' => true,
        'priority' => 1,
    ),

    'breadcrumbs_homepage_name' => array(
        'type' => 'text',
        'settings' => 'breadcrumbs_homepage_name',
        'section' => 'section_breadcrumbs',
        'default' => esc_attr__('Home', 'blogrock-core'),

        'priority' => 1,
        /*
        'active_callback' => [
            [
                'setting'  => 'breadcrumbs_show',
                'operator' => '==',
                'value'    => true,
            ],

        ]
        */

    ),

    // Top Bar

    'topbar_display' => array(
        'type' => 'toggle',
        'settings' => 'topbar_display',
        'label'    => esc_html__( 'Display Top Bar', 'blogrock-core'),
        'section' => 'section_topbar',
        'default' => true,
        'priority' => 1,
    ),

    'topbar_social_menu' => array(
        'type' => 'toggle',
        'settings' => 'topbar_social_menu',
        'label'    => esc_html__( 'Display Social Menu', 'blogrock-core'),
        'section' => 'section_topbar',
        'default' => true,
        'priority' => 2,
    ),


    'topbar_info' => array(
        'type' => 'textarea',
        'settings' => 'topbar_info',
        'label'    => esc_html__( 'Top Bar Info', 'blogrock-core'),
        'section' => 'section_topbar',
        'default' => '',
        'priority' => 3,
    ),

    // Main Navbar



    'navbar_background' => array(
        'type' => 'color',
        'settings' => 'navbar_background',
        'label' => esc_attr__('Navbar Background', 'blogrock-core'),
        'section' => 'section_main_navbar',
        'priority' => 2,
        'transport'   => 'auto',
        'output'      => array(
            'element' => '.rocksite-s-main-header, .rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu',
            'property' => 'background-color'
        )

    ),

    'navbar_fixed' => array(
        'type' => 'toggle',
        'settings' => 'navbar_fixed',
        'label'    => esc_html__( 'Fixed navbar', 'blogrock-core'),
        'section' => 'section_main_navbar',
        'default' => true,
        'priority' => 2,
    ),



    // Main Menu

    'main_menu_search_display' => array(
        'type' => 'toggle',
        'settings' => 'main_menu_search_display',
        'label'    => esc_html__( 'Display Search Button In Navbar', 'blogrock-core'),
        'section' => 'section_main_menu',
        'default' => true,
        'priority' => 1,
    ),

    'main_menu_typography' => array(
        'type' => 'typography',
        'settings' => 'main_menu_typography',
        'label'    => esc_html__( 'Main Menu Typography', 'blogrock-core'),
        'section' => 'section_main_menu',
        'default'     => [
            'font-family'    => 'Roboto',
            'variant'        => '600',
            'font-size'      => '14px',
            'letter-spacing' => '0',
            'text-transform' => 'uppercase',
        ],
        'priority' => 2,
        'transport'   => 'auto',
        'output'      => [
            [
                'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu > .rocksite-o-navbar-main__main-menu__item > .rocksite-o-navbar-main__main-menu__link',
            ],
        ],
    ),

    'main_menu_link_color' => array(
        'type' => 'color',
        'settings' => 'main_menu_link_color',
        'label' => esc_attr__('Link Color', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'transport'   => 'auto',
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu > .rocksite-o-navbar-main__main-menu__item > a.rocksite-o-navbar-main__main-menu__link',
            'property' => 'color'
        )

    ),

    'main_menu_link_color_hover' => array(
        'type' => 'color',
        'settings' => 'main_menu_link_color_hover',
        'label' => esc_attr__('Link Color on Hover', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'transport'   => 'auto',
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu > .rocksite-o-navbar-main__main-menu__item > a.rocksite-o-navbar-main__main-menu__link:hover',
            'property' => 'color'
        )

    ),

    'main_menu_decoration_color' => array(
        'type' => 'color',
        'settings' => 'main_menu_decoration_color',
        'label' => esc_attr__('Link Decoration Color', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'transport'   => 'auto',
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu > .rocksite-o-navbar-main__main-menu__item:not(.-icon-item) > a:before',
            'property' => 'background-color'
        )

    ),

    'main_menu_submenu_background' => array(
        'type' => 'color',
        'settings' => 'main_menu_submenu_background',
        'label' => esc_attr__('Submenu background color', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu .rocksite-o-navbar-main__main-menu__item .rocksite-o-navbar-main__main-menu__sub-nav .rocksite-o-navbar-main__main-menu__sub-nav__item .rocksite-o-navbar-main__main-menu__sub-nav__link:before',
            'property' => 'background-color'
        )

    ),

    'main_menu_submenu_color' => array(
        'type' => 'color',
        'settings' => 'main_menu_submenu_color',
        'label' => esc_attr__('Submenu text color', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu .rocksite-o-navbar-main__main-menu__item .rocksite-o-navbar-main__main-menu__sub-nav .rocksite-o-navbar-main__main-menu__sub-nav__item .rocksite-o-navbar-main__main-menu__sub-nav__link',
            'property' => 'color'
        )

    ),

    'main_menu_submenu_color_hover' => array(
        'type' => 'color',
        'settings' => 'main_menu_submenu_color_hover',
        'label' => esc_attr__('Submenu text color: hover', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu .rocksite-o-navbar-main__main-menu__item .rocksite-o-navbar-main__main-menu__sub-nav .rocksite-o-navbar-main__main-menu__sub-nav__item .rocksite-o-navbar-main__main-menu__sub-nav__link:hover',
            'property' => 'color'
        )

    ),

    'main_menu_submenu_background_hover' => array(
        'type' => 'color',
        'settings' => 'main_menu_submenu_background_hover',
        'label' => esc_attr__('Submenu link hover background', 'blogrock-core'),
        'section' => 'section_main_menu',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-o-navbar-main .rocksite-o-navbar-main__main-menu .rocksite-o-navbar-main__main-menu__item .rocksite-o-navbar-main__main-menu__sub-nav .rocksite-o-navbar-main__main-menu__sub-nav__item .rocksite-o-navbar-main__main-menu__sub-nav__link:hover:after',
            'property' => 'background-color'
        )

    ),




    // Brand logo

    'brand_logo' => array(
        'type' => 'image',
        'settings' => 'brand_logo',
        'label' => esc_attr__('Brand Logo', 'blogrock-core'),
        'section' => 'title_tagline',
        'priority' => 1,
        'default' => false,

    ),

    // Footer


    'footer_sidebar_background' => array(
        'type' => 'color',
        'settings' => 'footer_sidebar_background',
        'label' => esc_attr__('Footer Sidebar Background', 'blogrock-core'),
        'section' => 'section_footer',
        'transport' => 'auto',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-s-footer__top',
            'property' => 'background-color'
            ),
    ),


    'footer_sidebar_header_color' => array(
        'type' => 'color',
        'settings' => 'footer_sidebar_header_color',
        'label' => esc_attr__('Footer Sidebar Header Color', 'blogrock-core'),
        'section' => 'section_footer',
        'transport' => 'auto',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-s-footer__top .rocksite-o-widget__header .rocksite-o-widget__header__title',
            'property' => 'color'
        ),
    ),

    'footer_sidebar_link_color' => array(
        'type' => 'color',
        'settings' => 'footer_sidebar_link_color',
        'label' => esc_attr__('Footer Sidebar Link Color', 'blogrock-core'),
        'section' => 'section_footer',
        'transport' => 'auto',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-s-footer__top .rocksite-o-widget a',
            'property' => 'color'
        ),
    ),

    'footer_sidebar_link_color_hover' => array(
        'type' => 'color',
        'settings' => 'footer_sidebar_link_color_hover',
        'label' => esc_attr__('Footer Sidebar Link Color Hover', 'blogrock-core'),
        'section' => 'section_footer',
        'transport' => 'auto',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-s-footer__top .rocksite-o-widget a:hover',
            'property' => 'color'
        ),
    ),

    'footer_sidebar_text_color' => array(
        'type' => 'color',
        'settings' => 'footer_sidebar_text_color',
        'label' => esc_attr__('Footer Sidebar Text Color', 'blogrock-core'),
        'section' => 'section_footer',
        'transport' => 'auto',
        'priority' => 2,
        'output'      => array(
            'element' => '.rocksite-s-footer__top .rocksite-o-widget p, .rocksite-s-footer__top .rocksite-o-widget ul, .rocksite-s-footer__top .rocksite-o-widget div',
            'property' => 'color'
        ),
    )








);

