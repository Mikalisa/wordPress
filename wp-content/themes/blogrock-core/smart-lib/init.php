<?php

/*DEFINITIONS*/
define('BLOGROCK_LIB_DIRECTORY', '/smart-lib/');
define('BLOGROCK_TEMPLATE_DIRECTORY', get_template_directory());
define('BLOGROCK_TEMPLATE_DIRECTORY_URI', get_template_directory_uri());
define('BLOGROCK_STYLESHEET_DIRECTORY', get_stylesheet_directory_uri());
define('BLOGROCK_ADMIN_DIRECTORY_URI', BLOGROCK_TEMPLATE_DIRECTORY_URI . '/admin');
define('BLOGROCK_ADMIN_DIRECTORY', BLOGROCK_TEMPLATE_DIRECTORY . '/admin');

/*Meta-box plugin integration*/
define('RWMB_URL', BLOGROCK_TEMPLATE_DIRECTORY_URI . '/smart-lib/vendor/meta-box/');
define('RWMB_DIR', BLOGROCK_TEMPLATE_DIRECTORY . '/smart-lib/vendor/meta-box/');


class blogrock_Init
{


    public $default_config;

    /*list of widgets from class custom widgets file*/

    public $project_widgets = array(
        'Blogrock_Smart_Widget_Recent_Posts',
        'Blogrock_Smart_Widget_One_Author',
        'Blogrock_Smart_Widget_Social_Icons',
        'Blogrock_Smart_Widget_Video',
        'Blogrock_Smart_Widget_Recent_Videos',
        'Blogrock_Smart_Widget_Search',
        'Blogrock_Smart_Widget_Recent_Galleries',
        'Blogrock_Smart_Extend_Content',
        'Blogrock_Smart_Widget_Section_Header',
        'Blogrock_Smart_Display_Page_Content',
        'Blogrock_Smart_Widget_Last_Articles_Columns',

    );


    function __construct()
    {

        /* load all required php files*/
        $this->requires();

        /*Load Default Config*/

        $this->default_config = blogrock_Config::getInstance();


        $this->customizer_style = blogrock_Custom_Styles::getInstance($this->default_config);

        //initialize smartlib actions & filters

        new blogrock_Filters($this->default_config);
        new blogrock_Actions($this->default_config);

        new blogrock_Features($this->default_config);


        /*Load all scripts*/

        add_action('wp_enqueue_scripts', array($this, 'blogrock_scripts'), 1);

        /*Load admin scripts*/
        add_action('admin_head', array($this, 'admin_print_css_js'));


        add_action('wp_enqueue_scripts', array($this->customizer_style, 'header_css_output'), 1000);


        //add custom code - footer
        add_action('wp_footer', array($this, 'custom_code_footer'));

        /*
         * Register all widgets
         */
        add_action('widgets_init', array($this, 'register_theme_widgets'));


    }

    public function requires()
    {

        $files = array(

            'smart-lib/class-config.php',
            'smart-lib/classes/class-bootstrap-menu-walker.php',
            'smart-lib/classes/class-custom-widgets.php',
            'smart-lib/classes/class-features.php',
            'smart-lib/classes/class-tgm-plugin-activation.php',
            'smart-lib/classes/class-smartlib-actions.php',
            'smart-lib/classes/class-smartlib-filters.php',
            'smart-lib/classes/class-smartlib-layout-helpers.php',
            'smart-lib/classes/class-helpers.php',
            'smart-lib/class-customizer-options.php',
            'smart-lib/vendor/customizer-custom-controls/functions.php',
            'smart-lib/template-tags.php',
            'smart-lib/classes/class-smartlib-custom-styles.php',
            'smart-lib/integrations/builder-integration.php',//page builder integration


        );

        foreach ($files as $file) {

            if (file_exists(get_template_directory() . '/' . $file)) {

                require_once get_template_directory() . '/' . $file;

            }

        }
    }

    function blogrock_scripts()
    {

        /*register bootstrap*/

        wp_register_style('blogrock_bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css', false);
        wp_enqueue_style('blogrock_bootstrap');


        /*register awesome css*/
        wp_register_style('blogrock_font_awesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/fontawesome-all.css', false);
        wp_enqueue_style('blogrock_font_awesome');

        wp_register_style('blogrock_prettyphoto', get_template_directory_uri() . '/assets/vendor/prettyPhoto/css/prettyPhoto.css', false);
        wp_enqueue_style('blogrock_prettyphoto');

        /*ad main stylesheet*/
        wp_register_style('blogrock_main', get_stylesheet_uri(), array('blogrock-custom-fonts'));
        wp_enqueue_style('blogrock_main');


        /*flexislider*/
        wp_register_style('blogrock_flexislider', get_template_directory_uri() . '/assets/vendor/flexslider/flexslider.css', false);
        wp_enqueue_style('blogrock_flexislider');

        /*animate css*/
        wp_register_style('blogrock_animate', get_template_directory_uri() . '/assets/css/animate.css', false);
        wp_enqueue_style('blogrock_animate');

        if (is_single() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        /*flexislider scripts*/
        wp_register_script('blogrock-flexislider', get_template_directory_uri() . '/assets/vendor/flexslider/jquery.flexslider-min.js', array('jquery'), null, false);
        wp_enqueue_script('blogrock-flexislider');

        /*prettyPhoto scripts*/
        wp_register_script('blogrock-prettyphoto', get_template_directory_uri() . '/assets/vendor/prettyPhoto/js/jquery.prettyPhoto.js', array('jquery'), null, false);
        wp_enqueue_script('blogrock-prettyphoto');

        /*bootstrap*/
        wp_register_script('blogrock-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), null, true);
        wp_enqueue_script('blogrock-bootstrap');

        /*animated header*/


        wp_register_script('blogrock-classie-header', get_template_directory_uri() . '/assets/js/classie.js', array('jquery'), null, true);
        wp_enqueue_script('blogrock-classie-header');

        wp_register_script('blogrock-animated-header', get_template_directory_uri() . '/assets/js/cbpAnimatedHeader.min.js', array('jquery', 'blogrock-classie-header'), null, true);
        wp_enqueue_script('blogrock-animated-header');

        /*modernizr*/
        wp_register_script('blogrock-modernizr', get_template_directory_uri() . '/assets/vendor/modernizr.custom.09812.js', array('jquery'), null, true);
        wp_enqueue_script('blogrock-modernizr');

        /*jquery.waypoints.min.js*/

        wp_register_script('blogrock-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array('jquery'), null, true);
        wp_enqueue_script('blogrock-waypoints');

        /*counter */

        wp_register_script('blogrock-counter', get_template_directory_uri() . '/assets/js/jquery.countTo.js', array('jquery'), null, true);
        wp_enqueue_script('blogrock-counter');


        wp_register_script('blogrock-main', get_template_directory_uri() . '/assets/js/main.js', array(), null, true);

        wp_enqueue_script('blogrock-main');

    }

    function get_default_config()
    {
        return $this->default_config;
    }


    /*
     * External admin scripts
     */
    function admin_print_css_js()
    {
        wp_enqueue_media();
        wp_enqueue_script('blogrock-admin-js', get_template_directory_uri() . '/admin/js/admin-scripts.js', array('jquery', 'plupload-all'), '1', true);
        wp_enqueue_style('blogrock-admin-css', get_template_directory_uri() . '/admin/css/css-admin-mod.css');
    }

    /*
     * Register widgets
     */
    public function register_theme_widgets()
    {

        if (count($this->project_widgets) > 0) {
            foreach ($this->project_widgets as $widget_class) {
                if (class_exists($widget_class)) {
                    register_widget($widget_class);
                }
            }
        }
    }


    /**
     * Custom code footer action
     */

    public function custom_code_footer()
    {

        $code = esc_html(get_theme_mod('custom_code_footer', ''));

        if (strlen($code) > 0) {

            echo esc_html("\n" . $code . "\n");

        }

    }

}