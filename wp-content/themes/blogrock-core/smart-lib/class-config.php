<?php

/**
 * PROJECT CONFIG CLASS
 * Includes layout settings
 */
class blogrock_Config
{

    private static $instance;
    public  $customizer_control;
    public $project_sidebars;
    public $project_menus;

    private function __construct()
    {


        /*define project sidebars*/
        $this->project_sidebars = array(
        'main_sidebar' => array(

            'name' => esc_attr__('Main Sidebar', 'blogrock-core'),
            'description' => esc_attr__('Appears on  Front Page', 'blogrock-core'),
            'before_widget' => '<li><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>',
        ),
        'frontpage_content_sidebar' => array(
            'name' => esc_attr__('Frontpage Content', 'blogrock-core'),
            'description' => esc_attr__('Appears on Category page', 'blogrock-core'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title"><span>',
            'after_title' => '</span></h3>'
        ),
        'page_sidebar' => array(
            'name' => esc_attr__('Default Page Sidebar', 'blogrock-core'),
            'description' => esc_attr__('Default sidebar on the page', 'blogrock-core'),
            'before_widget' => '<li id="%1$s" class="widget %2$s"><div id="%1$s" class="panel widget smartlib-widget %2$s">',
            'after_widget' => '</div></li>',
            'before_title' => '<header class="panel-heading smartlib-widget-header"><h3 class="panel-title">',
            'after_title' => '</h3></header>'
        ),
        'sidebar-footer' => array(
            'name' => esc_attr__('Sidebar Footer', 'blogrock-core'),
            'description' => esc_attr__('Appears in footer', 'blogrock-core'),
            'before_widget' => '<div class="col-lg-3 col-sm-6"><div id="%1$s" class="smartlib-inside-box panel widget-no-padding smartlib-widget %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<header class="panel-heading"><h3 class="widget-title smartlib-header-with-decorator">',
            'after_title' => '</h3></header>'
        ),


    );

        /*define project menu*/

        $this->project_menus = array(
        'top_pages' => esc_attr__('Top Pages Menu', 'blogrock-core'),
        'main_menu' => esc_attr__('Main Menu', 'blogrock-core'),
        'footer_pages' =>  esc_attr__('Bottom Menu', 'blogrock-core')
    );

    }

    public $excerpt_length = 20;
    public $theme_prefix = 'blogrock-core';
    public static $theme_key = 'bstarter';







    public $assign_context_sidebar = array(
        'default' => array('<ul class="smartlib-layout-list">', 'main_sidebar', '</ul>'),

        'frontpage_content' => array('<ul class="smartlib-layout-list">', 'main_sidebar', '</ul>'),
        'page' => array('<ul class="smartlib-layout-list">', 'page_sidebar', '</ul>'),
    );

    //contains all customizer settings which goes to css header output
    public $css_propeties_array = array(
        'main_font_color' => array(
            'property' => 'color',
            'selectors' => 'body,p,h1,h2,h3,h4,h5,h6'
        ),
        'header_color' => array(
            'property' => 'color',
            'selectors' => 'h1,h2,h3,h4,h5,h6, .entry-title a'
        ),
        'sidebar_color' => array(
            'property' => 'background',
            'selectors' => '.widget-title'
        ),
        'link_color' => array(
            'property' => 'color',
            'selectors' => 'a, p a'
        ),



        'blogrock_general_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => '.smartlib-layout-page, .smartlib-layout-page p, .smartlib-article-box, .smartlib-article-box p'
        ),

        'blogrock_menu_fonts'=> array(
            'property' => 'font-family',
            'selectors' => '.smartlib-default-top-navbar .smartlib-navbar-menu a'
        ),

        'blogrock_menu_link_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smrtlib-navigation-bar-bottom .smartlib-navbar-menu > li > a'
        ),
        'blogrock_menu_link_hover_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smrtlib-navigation-bar-bottom .smartlib-navbar-menu > li > a:hover'
        ),

        'blogrock_menu_text_transform_default'=> array(
            'property' => 'text-transform',
            'selectors' => '.smrtlib-navigation-bar-bottom .smartlib-navbar-menu a'
        ),

        'blogrock_menu_bolding_default'=> array(
            'property' => 'font-weight',
            'selectors' => '.smrtlib-navigation-bar-bottom .smartlib-navbar-menu a'
        ),

        'blogrock_menu_decoration_color_default'=> array(
            'property' => 'background',
            'selectors' => '.smartlib-navbar-menu li a:before'
        ),

        'blogrock_menu_icon_color_default'=> array(
            'property' => 'color',
            'selectors' => '.btn-primary.smartlib-square-btn'
        ),

        'blogrock_menu_link_hover_background_default'=> array(
            'property' => 'background',
            'selectors' => '.smrtlib-navigation-bar-bottom .smartlib-navbar-menu li a:hover,.smrtlib-navigation-bar-bottom .smartlib-navbar-menu li.active a'
        ),

        'blogrock_background_navbar_default'=> array(
            'property' => 'background',
            'selectors' => '.smrtlib-navigation-bar-top'
        ),
        'blogrock_search_button_background_default'=> array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary.smartlib-square-btn, .btn.btn-primary.smartlib-square-btn:before'
        ),

        'blogrock_search_button_background_hover_default'=> array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary.smartlib-square-btn:after '
        ),

        'blogrock_background_navbar_menu_default'=> array(
            'property' => 'background',
            'selectors' => '.smrtlib-navigation-bar-bottom'
        ),


        /*footer*/

        'blogrock_sidebar_background_footer_default'=> array(
            'property' => 'background',
            'selectors' => '.smartlib-footer-area .smartlib-dark-section'
        ),
        'blogrock_header_footer_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smartlib-footer-area .smartlib-widget h3'
        ),
        'blogrock_decorator_color_default'=> array(
            'property' => 'background',
            'selectors' => '.smartlib-footer-area h3.smartlib-header-with-decorator:after'
        ),
        'blogrock_text_footer_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smartlib-footer-area .smartlib-widget, .smartlib-footer-area .smartlib-dark-section *,.smartlib-footer-area .smartlib-widget a, .smartlib-footer-area .smartlib-widget li, .smartlib-footer-area .smartlib-widget p'
        ),
        'blogrock_border_color_default'=> array(
            'property' => 'border-color',
            'selectors' => '.smartlib-footer-sidebar .smartlib-widget'
        ),

        /*heading*/

        //h1
        'blogrock_h1_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => 'h1'
        ),
        'blogrock_h1_text_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smartlib-layout-page .smartlib-page-header h1.entry-title'
        ),

        'blogrock_h1_background_header_default'=> array(
            'property' => 'background',
            'selectors' => '.smartlib-layout-page header.smartlib-page-header'
        ),

        'blogrock_h1_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => 'h1'
        ),

        'blogrock_h1_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h1'
        ),
        'blogrock_h1_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h1'
        ),


        //h2
        'blogrock_h2_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => 'h2'
        ),
        'blogrock_h2_text_color_default'=> array(
            'property' => 'color',
            'selectors' => 'h2'
        ),
        'blogrock_h2_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => 'h2'
        ),

        'blogrock_h2_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h2'
        ),
        'blogrock_h2_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h2'
        ),

        //h3
        'blogrock_h3_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => '.smartlib-widget-header h3'
        ),
        'blogrock_h3_text_color_default'=> array(
            'property' => 'color',
            'selectors' => '.smartlib-widget-header h3'
        ),
        'blogrock_h3_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => '.smartlib-widget-header h3'
        ),

        'blogrock_h3_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => '.smartlib-widget-header h3'
        ),
        'blogrock_h3_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => '.smartlib-widget-header h3'
        ),

        'blogrock_h3_background_header_default' => array(
            'property' => 'background',
            'selectors' => '.smartlib-layout-sidebar .panel-heading'
        ),

        //h4
        'blogrock_h4_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => 'h4'
        ),
        'blogrock_h4_text_color_default'=> array(
            'property' => 'color',
            'selectors' => 'h4'
        ),
        'blogrock_h4_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => 'h4'
        ),

        'blogrock_h4_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h4'
        ),
        'blogrock_h4_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h4'
        ),

        //h5
        'blogrock_h5_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => 'h5'
        ),
        'blogrock_h5_text_color_default'=> array(
            'property' => 'color',
            'selectors' => 'h5'
        ),
        'blogrock_h5_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => 'h5'
        ),

        'blogrock_h5_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h5'
        ),
        'blogrock_h5_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h5'
        ),


        //h6
        'blogrock_h6_font_family_default'=> array(
            'property' => 'font-family',
            'selectors' => 'h6'
        ),
        'blogrock_h6_text_color_default'=> array(
            'property' => 'color',
            'selectors' => 'h6'
        ),
        'blogrock_h6_text_size_default'=> array(
            'property' => 'font-size',
            'unit'=> 'px',
            'selectors' => 'h6'
        ),

        'blogrock_h6_text_transform_default' => array(
            'property' => 'text-transform',
            'selectors' => 'h6'
        ),
        'blogrock_h6_text_bolding_default' => array(
            'property' => 'font-weight',
            'selectors' => 'h6'
        ),

        /*links*/
        'blogrock_link_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'a'
        ),
        'blogrock_link_hover_text_color_default' => array(
            'property' => 'color',
            'selectors' => 'a:hover, a:focus'
        ),

        /*BUTTONS*/

        /*default*/

        'blogrock_default_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-default:before'
        ),

        'blogrock_default_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-default:hover:after'
        ),

        'blogrock_default_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-default'
        ),

        'blogrock_default_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-default'
        ),

        'blogrock_default_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-default'
        ),

        'blogrock_default_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-default'
        ),

        /*primary*/

        'blogrock_primary_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary:before'
        ),

        'blogrock_primary_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-primary:hover:after'
        ),

        'blogrock_primary_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-primary'
        ),

        'blogrock_primary_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-primary'
        ),

        'blogrock_primary_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-primary'
        ),

        'blogrock_primary_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-primary'
        ),

        /*success*/

        'blogrock_success_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-success:before'
        ),

        'blogrock_success_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-success:hover:after'
        ),

        'blogrock_success_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-success'
        ),

        'blogrock_success_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-success'
        ),

        'blogrock_success_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-success'
        ),

        'blogrock_success_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-success'
        ),

        /*info*/

        'blogrock_info_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-info:before'
        ),

        'blogrock_info_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-info:hover:after'
        ),

        'blogrock_info_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-info'
        ),

        'blogrock_info_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-info'
        ),

        'blogrock_info_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-info'
        ),

        'blogrock_info_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-info'
        ),

        /*warning*/

        'blogrock_warning_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-warning:before'
        ),

        'blogrock_warning_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-warning:hover:after'
        ),

        'blogrock_warning_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-warning'
        ),

        'blogrock_warning_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-warning'
        ),

        'blogrock_warning_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-warning'
        ),

        'blogrock_warning_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-warning'
        ),

        /*danger*/

        'blogrock_danger_button_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-danger:before'
        ),

        'blogrock_danger_button_hover_background' => array(
            'property' => 'background',
            'selectors' => '.btn.btn-danger:hover:after'
        ),

        'blogrock_danger_button_text_color' => array(
            'property' => 'color',
            'selectors' => '.btn.btn-danger'
        ),

        'blogrock_danger_button_border_color' => array(
            'property' => 'border-color',
            'selectors' => '.btn.btn-danger'
        ),

        'blogrock_danger_button_font_family' => array(
            'property' => 'font-family',
            'selectors' => '.btn.btn-danger'
        ),

        'blogrock_danger_button_text_transform' => array(
            'property' => 'text-transform',
            'selectors' => '.btn.btn-danger'
        ),



    );

    public $blogrock_safe_fonts = array(
        'Verdana' => array(
            'label' => 'Verdana'
        ),
        'Arial' => array(
            'label' => 'Arial'
        )
    );

    public $blogrock_fonts = array(
        'blogrock_general_font_family_default' => '{"font":"Merriweather","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"serif"}',
        'blogrock_menu_fonts' => '{"font":"Roboto","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
        'blogrock_h1_font_family_default' => '{"font":"Roboto","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',


    );

    public static $promoted_formats = array(
        'video', 'gallery'
    );

    public $layout_class_array = array(
        0 => array(

            'sidebar' => '',

            'content' => 'smartlib-no-sidebar'
        ),
        1 => array(

            'sidebar' => 'smartlib-right-sidebar',

            'content' => 'smartlib-left-content'
        ),
        2 => array(

            'sidebar' => 'smartlib-left-sidebar',

            'content' => 'smartlib-right-content'
        ),


    );


    public $layout_sizes = array(
        'layout' => array(
            'size' => 1300,
            'container' => '.container, .smartlib-content-section,.smartlib-full-strech-section .panel-row-style',
            'customizer_key' => 'blogrock_layout_width'
        ),
        'sidebar' => array(
            'size' => 420,
            'container' => '#sidebar',
            'customizer_key' => 'blogrock_section_blogrock_sidebar_resize'
        ),
        'content' => array(
            'size' => array('layout', 'sidebar'),//first  param: minuend ; second param: subtrahend
            'container' => '#page',
            'customizer_key' => ''
        ),
    );
    /*
         * Array maping awesome class
         */
    public $icon_awesome_translate_class = array(
        'gallery' => 'fas fa-photo-video',
        'video' => 'fas fa-video',
        'default_icon' => 'fas fa-tags',
        'tag_icon' => 'fas fa-tags',
        'twitter' => 'fab fa-twitter',
        'facebook' => 'fab fa-facebook-f',
        'gplus' => 'fab fa-google-plus-g',
        'pinterest' => 'fab fa-pinterest',
        'linkedin' => 'fab fa-linkedin-in',
        'youtube' => 'fa fa-youtube',
        'twitter_large' => 'fab fa-twitter',
        'facebook_large' => 'fab fa-facebook-f',
        'gplus_large' => 'fab fa-google-plus-g',
        'pinterest_large' => 'fab fa-pinterest',
        'linkedin_large' => 'fab fa-linkedin-in',
        'youtube_large' => 'fab fa-youtube',
        'comments' => 'fab fa-comments',
        'more-link' => 'fas fa-angle-right',
        'rss' => 'fas fa-rss',
        'email' => 'fas fa-envelope'
    );

    public $supported_social_media = array(
        'facebook' => 'Facebook', 'gplus' => 'Google Plus', 'pinterest' => 'Pinterest', 'twitter' => 'Twitter', 'rss' => 'RSS'
    );

    /* Meta keys array*/

    public $blogrock_meta_keys = array(
        'author_meta_image' => 'blogrock_profile_image'
    );


    public function get_promoted_formats()
    {
        return self::$promoted_formats;
    }

    public function get_theme_key()
    {
        return self::$theme_key;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new blogrock_Config();

        }
        return self::$instance;
    }
}