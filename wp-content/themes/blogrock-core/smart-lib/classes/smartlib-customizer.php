<?php

/**
 * Project Customizer Class
 *
 * Contains methods for customizing the theme customization screen.
 *
 *
 * @subpackage project
 * @since      project 1.0
 */
class blogrock_Customizer
{


    public static $theme_key;
    public static $default_config;
    public static $controls_array;


    public function __construct()
    {

        self::$default_config = blogrock_Config::getInstance();
        self::$theme_key = self::$default_config->get_theme_key();
        self::$controls_array = self::$default_config->customizer_control->controls_array();


        add_filter('kirki/controls', array($this, 'blogrock_kirki_controls'));

    }


    /**
     * Implement theme options into Theme Customizer on Frontend
     *
     * @see   examples for different input fields https://gist.github.com/2968549
     * @since 08/09/2012
     *
     * @param $wp_customize Theme Customizer object
     *
     * @return void
     */
    public function  register($wp_customize)
    {
        //add customizer sections
        $this->add_sections($wp_customize);
        $this->add_settings_controls($wp_customize);
        $this->wp_customize = $wp_customize;
    }

    /*
     * Add Customizer Sections
     */

    private function add_sections($wp_customize)
    {


        $wp_customize->add_panel( 'blogrock_panel_general_settings', array(
            'priority'    => 1,
            'title'       => esc_attr__( 'General', 'blogrock-core' ),

        ) );

//add section: logo
        $wp_customize->add_section('blogrock_section_logo', array(
            'title' => esc_attr__('Logo', 'blogrock-core'),
            'panel' => 'blogrock_panel_general_settings',
            'priority' => 20,
        ));



        $wp_customize->add_section('blogrock_section_preloader', array(
            'title' => esc_attr__('Loading Animation', 'blogrock-core'),
            'panel' => 'blogrock_panel_general_settings',
            'priority' => 30,
        ));

        $wp_customize->add_section('section_blogrock_gallery_default', array(
            'title' => esc_attr__('Gallery', 'blogrock-core'),
            'priority' => 31,
            'panel' => 'blogrock_panel_general_settings',
        ));
      



        /*Put default sections in general panel*/
        $wp_customize->get_section('colors')->panel = 'blogrock_panel_general_settings';
        $wp_customize->get_section('title_tagline')->panel = 'blogrock_panel_general_settings';
        $wp_customize->get_section('header_image')->panel = 'blogrock_panel_general_settings';
        $wp_customize->get_section('background_image')->panel = 'blogrock_panel_general_settings';


        //add section: home page
        $wp_customize->add_section('blogrock_section_homepage', array(
            'title' => esc_attr__('Home Page', 'blogrock-core'),

            'priority' => 20,
        ));


        //add section: pagination
        $wp_customize->add_section('section_pagination_posts', array(
            'title' => esc_attr__('Pagination', 'blogrock-core'),
            'priority' => 90,
        ));




        $wp_customize->add_section('blogrock_pages_settings', array(
            'title' => esc_attr__('Pages Settings', 'blogrock-core'),
            'priority' => 80,
        ));

        $wp_customize->add_section('blogrock_blog_settings', array(
            'title' => esc_attr__('Blog Settings', 'blogrock-core'),
            'priority' => 80,
        ));

        /*ADD PREMIUM SECTIONS*/

        //add section: layout
        $wp_customize->add_section('blogrock_layout', array(
            'title' => esc_attr__('Layout', 'blogrock-core'),
            'priority' => 40,
        ));



        /*Fonts & Text Colors*/

        $wp_customize->add_panel( 'blogrock_panel_font_and_color', array(
            'priority'    => 10,
            'title'       => esc_attr__( 'Fonts & Text Colors', 'blogrock-core' ),

        ) );

        $wp_customize->add_section('blogrock_general_text_styles', array(
            'title' => esc_attr__('General Text Settings', 'blogrock-core'),
            'priority' => 2,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_header1_styles', array(
            'title' => esc_attr__('H1 Style', 'blogrock-core'),
            'priority' => 2,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_header2_styles', array(
            'title' => esc_attr__('H2 Style', 'blogrock-core'),
            'priority' => 2,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_header3_styles', array(
            'title' => esc_attr__('Sidebar Header Style', 'blogrock-core'),
            'priority' => 3,
            'panel'          => 'blogrock_panel_font_and_color',
        ));
        $wp_customize->add_section('blogrock_header4_styles', array(
            'title' => esc_attr__('H4 Style', 'blogrock-core'),
            'priority' => 4,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_header5_styles', array(
            'title' => esc_attr__('H5 Style', 'blogrock-core'),
            'priority' => 5,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_header6_styles', array(
            'title' => esc_attr__('H6 Style', 'blogrock-core'),
            'priority' => 6,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_section('blogrock_link_styles', array(
            'title' => esc_attr__('Links Style', 'blogrock-core'),
            'priority' => 7,
            'panel'          => 'blogrock_panel_font_and_color',
        ));

        $wp_customize->add_panel( 'blogrock_panel_default_buttons', array(
            'priority'    => 15,
            'title'       => esc_attr__( 'Buttons Settings', 'blogrock-core' ),

        ) );

        $wp_customize->add_section('blogrock_section_default_button', array(
            'title' => esc_attr__('Default Button', 'blogrock-core'),
            'panel' => 'blogrock_panel_default_buttons',
            'priority' => 1,
        ));

        $wp_customize->add_section('blogrock_section_primary_button', array(
            'title' => esc_attr__('Primary Button', 'blogrock-core'),
            'panel' => 'blogrock_panel_default_buttons',
            'priority' => 2,
        ));




        /*Navbar Panels and Sections*/

            $wp_customize->add_panel( 'blogrock_panel_navbar', array(
                'priority'    => 20,
                'title'       => esc_attr__( 'Navbar Area', 'blogrock-core' ),

            ) );



        $wp_customize->add_section('blogrock_header_section', array(
            'title' => esc_attr__('Main Navbar Style', 'blogrock-core'),
            'priority' => 20,
            'panel'          => 'blogrock_panel_navbar',
        ));

        $wp_customize->add_section('blogrock_main_menu_section', array(
            'title' => esc_attr__('Main Menu', 'blogrock-core'),
            'priority' => 20,
            'panel'          => 'blogrock_panel_navbar',
        ));

        /*Footer*/

        $wp_customize->add_section('blogrock_footer_section', array(
            'title' => esc_attr__('Footer Section', 'blogrock-core'),
            'priority' => 21,
        ));
    }

    /*
     * Add native settings and controls
     */
    private function add_settings_controls($wp_customize)
    {



        $wp_customize->add_setting('blogrock_text_header', array(

            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',

        ));




        /*footer copyright info*/

        $wp_customize->add_setting('blogrock_text_footer', array(

            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('blogrock_text_footer', array(
            'label' => esc_attr__('Copyright text', 'blogrock-core'),
            'section' => 'blogrock_footer_section',
            'settings' => 'blogrock_text_footer',
            'type' => 'text',

        ));




        //add setting breadcrumb_separator

        $wp_customize->add_setting('breadcrumb_separator', array(

            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control('breadcrumb_separator', array(
            'label' => esc_attr__('Separator', 'blogrock-core'),
            'section' => 'section_blogrock_breadcrumb',
            'settings' => 'breadcrumb_separator',
            'type' => 'text',

        ));

        /*Primary theme color*/









        /*LOGO*/
        $wp_customize->add_setting('blogrock_logo', array(


            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        ));


        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'blogrock_logo', array(
            'label' => esc_attr__('Upload', 'blogrock-core'),
            'section' => 'blogrock_section_logo',
            'settings' => 'blogrock_logo',
        )));

        /* Favicon */









    }

    /*
     * Add Custom controls to the sections
     */
    function blogrock_kirki_controls($controls)
    {


            foreach(self::$controls_array as $row){

                $controls[] = $row;

            }


        return $controls;
    }






    /**
     * Adds smartlib safe fonts to array
     *
     * @param $merged_array - kirki fonts array
     *
     * @return array
     */
    function blogrock_safe_fonts($merged_array)
    {

        $all_fonts = array_merge(self::$default_config->blogrock_safe_fonts, $merged_array);

        return $all_fonts;
    }

    /**
     * Live preview javascript
     *
     * @since  project 1.0
     * @return void
     */
    public function customize_preview_js()
    {

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '.dev' : '';

        wp_register_script(
            self::$theme_key . '-customizer',
            get_template_directory_uri() . '/js/theme-customizer' . $suffix . '.js',
            array('customize-preview'),
            FALSE,
            TRUE
        );

        wp_enqueue_script(self::$theme_key . '-customizer');
    }

    /**
     *
     * Context method for slider option
     *
     * @param $control
     *
     * @return bool
     */
    public function conditional_slider_shortcode($control)
    {

        $option = $control->manager->get_setting('blogrock_homepage_slider');
        return $option->value() == '2';

    }

    public function conditional_homepage_slider($control)
    {

        $option = $control->manager->get_setting('blogrock_homepage_version');

        if ($option->value() == '2' && is_home()) {
            return true;
        } else {
            return false;
        }


    }



    /**
     * Generate social links controls
     *
     * @param $controls
     * @return array
     */
    protected function generate_social_options($controls)
    {

        $config_media_options = self::$default_config->supported_social_media;
        $i = 1;
        foreach ($config_media_options as $key => $row) {
            $i++;
            $controls[] = array(
                'type' => 'text',
                'setting' => 'blogrock_socialmedia_link_' . $key,
                'label' => $row,
                'section' => 'blogrock_social_links',

                'priority' => $i);

        };

       return $controls;
    }





}









