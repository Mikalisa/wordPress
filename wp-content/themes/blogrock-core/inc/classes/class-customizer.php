<?php

if (!class_exists('Blogrock_Customizer')) {

    /**
     * Class for generate customizer options
     */
    class Blogrock_Customizer extends Blogrock_Base
    {

        /**
         * Constructor
         */
        public function __construct($config, $settings)
        {

            parent::__construct($config, $settings);



            add_action('customize_register', array($this, 'add_basic_fields'));






        }




        /**
         * Ads default value from the configuration file into single field configuration
         * @param $field_name
         * @param array $field_configuration
         *
         * @return array
         */

        private function add_default_values_to_field($field_name, array $field_configuration)
        {

            $default_settings = $this->config->default_settings();

            if (!isset ($field_configuration['default'])) {

                if (isset($default_settings[$field_name])) {
                    $field_configuration['default'] = $default_settings[$field_name];
                }

            }


            return $field_configuration;


        }

        /**
         * Add Basic Settings without installing any plugin
         * @param $wp_customize
         */

        public function add_basic_fields($wp_customize)
        {


            // blog rock native

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


            //   Enabling this option will display animation while page loads


            $wp_customize->add_setting('blogrock_show_preloader', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array($this, 'sanitize_checkbox'),
                'default' => false
            ));

            $wp_customize->add_control('blogrock_show_preloader', array(
                'type' => 'checkbox',
                'section' => 'blogrock_section_preloader', // Add a default or your own section
                'label' => esc_html__('Enabling this option will display animation while page loads', 'blogrock-core'),

            ));




            $wp_customize->add_section('section_blogrock_gallery_default', array(
                'title' => esc_attr__('Gallery', 'blogrock-core'),
                'priority' => 31,
                'panel' => 'blogrock_panel_general_settings',
            ));


            //   Enabling this option will display photos using prettyPhoto lightbox


            $wp_customize->add_setting('section_blogrock_gallery_pretty_photo', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array($this, 'sanitize_checkbox'),
                'default' => false
            ));

            $wp_customize->add_control('section_blogrock_gallery_pretty_photo', array(
                'type' => 'checkbox',
                'section' => 'section_blogrock_gallery_default', // Add a default or your own section
                'label' => esc_html__('Enabling this option will display photos using prettyPhoto lightbox', 'blogrock-core'),

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


            //  Show Breadcrumb

            $wp_customize->add_setting('blogrock_pages_breadcrumb_page', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_pages_breadcrumb_page', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Breadcrumb', 'blogrock-core'),
                    'section' => 'blogrock_pages_settings',
                    'choices' =>
                        array(

                            0 => esc_attr__('Off', 'blogrock-core'),
                            1 => esc_attr__('On', 'blogrock-core')


                        ),
                )
            );


            // Breadcrumbs separator

            $wp_customize->add_setting('logrock_breadcrumb_separator_page', array(
                'sanitize_callback' => 'sanitize_text_field',
                'default' => ' / '
            ));

            $wp_customize->add_control('logrock_breadcrumb_separator_page', array(

                'label' => esc_attr__('Breadcrumb separator:', 'blogrock-core'),
                'section' => 'blogrock_pages_settings'

            ));


            // Breadcrumb Home Page Name

            $wp_customize->add_setting('blogrock_breadcrumb_homepage_name', array(
                'sanitize_callback' => 'sanitize_text_field',
                'default' => ' / '
            ));

            $wp_customize->add_control('blogrock_breadcrumb_homepage_name', array(

                'label' => esc_attr__('Breadcrumb Home Page Name:', 'blogrock-core'),
                'section' => 'blogrock_pages_settings'

            ));



            $wp_customize->add_section('blogrock_blog_settings', array(
                'title' => esc_attr__('Blog Settings', 'blogrock-core'),
                'priority' => 80,
            ));


            // Pagination

            $wp_customize->add_setting('blogrock_pagination_posts', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => '1',
                )
            );
            $wp_customize->add_control('blogrock_pagination_posts', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Pagination', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('Hide', 'blogrock-core'),
                            '1' => esc_attr__('Prev/Next', 'blogrock-core'),
                            '2' => esc_attr__('Numbers', 'blogrock-core')


                        ),
                )
            );


            // Show Author

            $wp_customize->add_setting('blogrock_show_author_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_author_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Author', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('OFF', 'blogrock-core'),
                            '1' => esc_attr__('ON', 'blogrock-core')


                        ),
                )
            );


            // Show Date

            $wp_customize->add_setting('blogrock_show_date_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_date_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Date', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('OFF', 'blogrock-core'),
                            '1' => esc_attr__('ON', 'blogrock-core')


                        ),
                )
            );


            // Show Categories

            $wp_customize->add_setting('blogrock_show_category_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_category_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Categories', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('OFF', 'blogrock-core'),
                            '1' => esc_attr__('ON', 'blogrock-core')


                        ),
                )
            );


            // Show Post Format

            $wp_customize->add_setting('blogrock_show_postformat_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_postformat_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Post Format', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('OFF', 'blogrock-core'),
                            '1' => esc_attr__('ON', 'blogrock-core')


                        ),
                )
            );


            // Show Post Format

            $wp_customize->add_setting('blogrock_show_postformat_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_postformat_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Show Post Format', 'blogrock-core'),
                    'section' => 'blogrock_blog_settings',
                    'choices' =>
                        array(

                            '0' => esc_attr__('OFF', 'blogrock-core'),
                            '1' => esc_attr__('ON', 'blogrock-core')


                        ),
                )
            );




            /*ADD PREMIUM SECTIONS*/

            //add section: layout
            $wp_customize->add_section('blogrock_layout', array(
                'title' => esc_attr__('Layout', 'blogrock-core'),
                'priority' => 40,
            ));


            // Page width


            $wp_customize->add_setting( 'blogrock_layout_width',
                array(
                    'default' => 1300,
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'skyrocket_sanitize_integer'
                )
            );
            $wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'blogrock_layout_width',
                array(
                    'label' => esc_html__( 'Page Width',   'blogrock-core'),
                    'section' => 'blogrock_layout',
                    'input_attrs' => array(
                        'min' => 960,
                        'max' => 1500,
                        'step' => 1,
                    ),
                )
            ) );


            // Sidebar Width



            $wp_customize->add_setting( 'blogrock_section_blogrock_sidebar_resize',
                array(
                    'default' => 320,
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'skyrocket_sanitize_integer'
                )
            );
            $wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'blogrock_section_blogrock_sidebar_resize',
                array(
                    'label' => esc_html__( 'Sidebar Width',   'blogrock-core'),
                    'section' => 'blogrock_layout',
                    'input_attrs' => array(
                        'min' => 200,
                        'max' => 400,
                        'step' => 1,
                    ),
                )
            ) );



            //   default layout settings

            $wp_customize->add_setting('blogrock_layout_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => '1',
                )
            );
            $wp_customize->add_control('blogrock_layout_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Display social buttons in footer', 'blogrock-core'),
                    'section' => 'blogrock_layout',
                    'choices' =>
                        array(

                            '0' => esc_attr__('Off', 'blogrock-core'),
                            '1' => esc_attr__('On', 'blogrock-core')


                        ),
                )
            );




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

            //Choose a default font for your site

            $wp_customize->add_setting( 'blogrock_general_font_family_default',
                array(
                    'default' => '{"font":"Merriweather","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"serif"}',
                    'sanitize_callback' => 'skyrocket_google_font_sanitization',
                )

            );

            $wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'blogrock_general_font_family_default',
                array(
                    'label' => esc_attr__('Global Font Family', 'blogrock-core'),
                    'description' =>  esc_attr__('Choose a default font for your site', 'blogrock-core'),
                    'section' => 'blogrock_general_text_styles',
                    'input_attrs' => array(
                        'font_count' => 'all',
                        'orderby' => 'alpha',
                    ),
                )
            ) );



            // Text Color

            $wp_customize->add_setting('blogrock_general_text_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2c3f50'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_general_text_color_default',
                    array(
                        'label' => esc_attr__('Text Color', 'blogrock-core'),
                        'section' => 'blogrock_general_text_styles', // Add a default or your own section
                    )));





            $wp_customize->add_section('blogrock_header1_styles', array(
                'title' => esc_attr__('H1 Style', 'blogrock-core'),
                'priority' => 2,
                'panel'          => 'blogrock_panel_font_and_color',
            ));


            /*
             * Header styles
             */


            $wp_customize->add_setting( 'blogrock_h1_font_family_default',
                array(
                    'default' => '{"font":"Roboto","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
                    'sanitize_callback' => 'skyrocket_google_font_sanitization',
                )

            );

            $wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'blogrock_h1_font_family_default',
                array(
                    'label' => esc_attr__('H1 font family', 'blogrock-core'),
                    'section' => 'blogrock_header1_styles',
                    'input_attrs' => array(
                        'font_count' => 'all',
                        'orderby' => 'alpha',
                    ),
                )
            ) );


            // H1 Background Color


            $wp_customize->add_setting('blogrock_h1_background_header_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#009688'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_h1_background_header_default',
                    array(
                        'label' => esc_attr__('H1 Background Color', 'blogrock-core'),
                        'section' => 'blogrock_header1_styles', // Add a default or your own section
                    )));


            $wp_customize->add_setting( 'blogrock_h1_text_size_default',
                array(
                    'default' => 48,
                    'transport' => 'postMessage',
                    'sanitize_callback' => 'skyrocket_sanitize_integer'
                )
            );
            $wp_customize->add_control( new Skyrocket_Slider_Custom_Control( $wp_customize, 'blogrock_h1_text_size_default',
                array(
                    'label' => esc_html__( 'Slider Control (px)',   'blogrock-core'),
                    'section' => 'blogrock_header1_styles',
                    'input_attrs' => array(
                        'min' => 30, // Required. Minimum value for the slider
                        'max' => 80, // Required. Maximum value for the slider
                        'step' => 1, // Required. The size of each interval or step the slider takes between the minimum and maximum values
                    ),
                )
            ) );

            // H1 Text Transform

            $wp_customize->add_setting('blogrock_h1_text_transform_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'uppercase',
                )
            );
            $wp_customize->add_control('blogrock_h1_text_transform_default', array(
                    'type' => 'select',
                    'description' => esc_attr__('H1 Text Transform', 'blogrock-core'),
                    'section' => 'blogrock_header1_styles',
                    'choices' =>
                        array(
                            'none' => esc_attr__('None', 'blogrock-core'),
                            'uppercase' => esc_attr__('Uppercase', 'blogrock-core')

                        ),
                )
            );

            // H1 Font Weight

            $wp_customize->add_setting('blogrock_h1_text_bolding_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_h1_text_bolding_default', array(
                    'type' => 'select',
                    'description' => esc_attr__('H1 Font Weight', 'blogrock-core'),
                    'section' => 'blogrock_header1_styles',
                    'choices' =>
                        array(
                            'normal' => esc_attr__('Normal', 'blogrock-core'),
                            'bold' => esc_attr__('Bold', 'blogrock-core')

                        ),
                )
            );




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

            //  Sidebar Header Text Transform

            $wp_customize->add_setting('blogrock_h3_text_transform_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'uppercase',
                )
            );
            $wp_customize->add_control('blogrock_h3_text_transform_default', array(
                    'type' => 'select',
                    'label' => esc_attr__('Sidebar Header Text Transform', 'blogrock-core'),
                    'section' => 'blogrock_header3_styles',
                    'choices' =>
                        array(
                            'none' => esc_attr__('None', 'blogrock-core'),
                            'uppercase' => esc_attr__('Uppercase', 'blogrock-core')

                        ),
                )
            );


            //  Sidebar Header Font Weight

            $wp_customize->add_setting('blogrock_h3_text_transform_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_h3_text_transform_default', array(
                    'type' => 'select',
                    'label' => esc_attr__('Sidebar Header Font Weight', 'blogrock-core'),
                    'section' => 'blogrock_header3_styles',
                    'choices' =>
                        array(
                            'normal' => esc_attr__('Normal', 'blogrock-core'),
                            'bold' => esc_attr__('Bold', 'blogrock-core')

                        ),
                )
            );





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


            //    Links Text Color


            $wp_customize->add_setting('blogrock_link_text_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#1bbc9d'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_link_text_color_default',
                    array(
                        'label' => esc_attr__('Links Text Color', 'blogrock-core'),
                        'section' => 'blogrock_link_styles', // Add a default or your own section
                    )));


            //    Links Hover Text Color


            $wp_customize->add_setting('blogrock_link_hover_text_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2c3f52'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_link_hover_text_color_default',
                    array(
                        'label' => esc_attr__('Links Hover Text Color', 'blogrock-core'),
                        'section' => 'blogrock_link_styles', // Add a default or your own section
                    )));


            $wp_customize->add_panel( 'blogrock_panel_default_buttons', array(
                'priority'    => 15,
                'title'       => esc_attr__( 'Buttons Settings', 'blogrock-core' ),

            ) );

            $wp_customize->add_section('blogrock_section_default_button', array(
                'title' => esc_attr__('Default Button', 'blogrock-core'),
                'panel' => 'blogrock_panel_default_buttons',
                'priority' => 1,
            ));


            //    Background Default Button


            $wp_customize->add_setting('blogrock_default_button_background', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_background',
                    array(
                        'label' => esc_attr__('Background Default Button', 'blogrock-core'),
                        'section' => 'blogrock_section_default_button', // Add a default or your own section
                    )));

            // Background Default Button Hover

            $wp_customize->add_setting('blogrock_default_button_hover_background', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_hover_background',
                    array(
                        'label' => esc_attr__('Background Default Button', 'blogrock-core'),
                        'section' => 'blogrock_section_default_button', // Add a default or your own section
                    )));

            // Text Color

            $wp_customize->add_setting('blogrock_default_button_text_color', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_text_color',
                    array(
                        'label' => esc_attr__('Background Default Button', 'blogrock-core'),
                        'section' => 'blogrock_section_default_button', // Add a default or your own section
                    )));

            // Border Color

            $wp_customize->add_setting('blogrock_default_button_border_color', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_border_color',
                    array(
                        'label' => esc_attr__('Border Color', 'blogrock-core'),
                        'section' => 'blogrock_section_default_button', // Add a default or your own section
                    )));


            $wp_customize->add_setting( 'blogrock_default_button_font_family',
                array(
                    'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
                    'sanitize_callback' => 'skyrocket_google_font_sanitization',
                )

            );

            $wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'blogrock_default_button_font_family',
                array(
                    'label' => esc_attr__('Default Button Font Family', 'blogrock-core'),
                    'description' =>  esc_attr__('Choose a default font family for default button', 'blogrock-core'),
                    'section' => 'blogrock_section_default_button',
                    'input_attrs' => array(
                        'font_count' => 'all',
                        'orderby' => 'alpha',
                    ),
                )
            ) );


            $wp_customize->add_setting('blogrock_default_button_text_transform', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'uppercase',
                )
            );
            $wp_customize->add_control('blogrock_default_button_text_transform', array(
                    'type' => 'select',
                    'description' => esc_attr__('Default Button Text Transform', 'blogrock-core'),
                    'section' => 'blogrock_section_default_button',
                    'choices' =>
                        array(
                            'none' => esc_attr__('None', 'blogrock-core'),
                            'uppercase' => esc_attr__('Uppercase', 'blogrock-core')

                        ),
                )
            );










            $wp_customize->add_section('blogrock_section_primary_button', array(
                'title' => esc_attr__('Primary Button', 'blogrock-core'),
                'panel' => 'blogrock_panel_default_buttons',
                'priority' => 2,
            ));


            //    Background Primary Button


            $wp_customize->add_setting('blogrock_primary_button_background', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_primary_button_background',
                    array(
                        'label' => esc_attr__('Background Primary Button', 'blogrock-core'),
                        'section' => 'blogrock_section_primary_button', // Add a default or your own section
                    )));

            // Background Primary Button Hover

            $wp_customize->add_setting('blogrock_primary_button_hover_background', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_primary_button_hover_background',
                    array(
                        'label' => esc_attr__('Background Primary Button', 'blogrock-core'),
                        'section' => 'blogrock_section_primary_button', // Add a default or your own section
                    )));

            // Text Color   Primary Button

            $wp_customize->add_setting('blogrock_default_button_text_color', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_text_color',
                    array(
                        'label' => esc_attr__('Background Primary Button', 'blogrock-core'),
                        'section' => 'blogrock_section_primary_button', // Add a default or your own section
                    )));

            // Border Color         Primary Button

            $wp_customize->add_setting('blogrock_default_button_border_color', array(
                'sanitize_callback' => 'sanitize_hex_color'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_default_button_border_color',
                    array(
                        'label' => esc_attr__('Border Color', 'blogrock-core'),
                        'section' => 'blogrock_section_primary_button', // Add a default or your own section
                    )));


            $wp_customize->add_setting( 'blogrock_default_button_font_family',
                array(
                    'default' => '{"font":"Open Sans","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
                    'sanitize_callback' => 'skyrocket_google_font_sanitization',
                )

            );

            $wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'blogrock_default_button_font_family',
                array(
                    'label' => esc_attr__('Primary Button Font Family', 'blogrock-core'),
                    'description' =>  esc_attr__('Choose a default font family for default button', 'blogrock-core'),
                    'section' => 'blogrock_section_primary_button',
                    'input_attrs' => array(
                        'font_count' => 'all',
                        'orderby' => 'alpha',
                    ),
                )
            ) );


            $wp_customize->add_setting('blogrock_primary_button_text_transform', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'uppercase',
                )
            );
            $wp_customize->add_control('blogrock_primary_button_text_transform', array(
                    'type' => 'select',
                    'description' => esc_attr__('Primary Button Text Transform', 'blogrock-core'),
                    'section' => 'blogrock_section_primary_button',
                    'choices' =>
                        array(
                            'none' => esc_attr__('None', 'blogrock-core'),
                            'uppercase' => esc_attr__('Uppercase', 'blogrock-core')

                        ),
                )
            );





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


            //  Search in navigation area


            $wp_customize->add_setting('blogrock_show_search_in_navbar_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_show_search_in_navbar_default', array(
                    'type' => 'radio',
                    'description' => esc_attr__('Search in navigation area', 'blogrock-core'),
                    'section' => 'blogrock_header_section',
                    'choices' =>
                        array(

                            '1' => esc_attr__('Off', 'blogrock-core'),
                            '2' => esc_attr__('On', 'blogrock-core')


                        ),
                )
            );


            // Search Button Background

            $wp_customize->add_setting('blogrock_search_button_background_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#008c7f'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_search_button_background_default',
                    array(
                        'label' => esc_attr__('Search Button Background', 'blogrock-core'),
                        'section' => 'blogrock_header_section', // Add a default or your own section
                    )));


            // Search Button Background Hover

            $wp_customize->add_setting('blogrock_search_button_background_hover_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#008c7f'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_search_button_background_hover_default',
                    array(
                        'label' => esc_attr__('Search Button Background Hover', 'blogrock-core'),
                        'section' => 'blogrock_header_section', // Add a default or your own section
                    )));


            // Search Button Icon Color

            $wp_customize->add_setting('blogrock_menu_icon_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#ffffff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_menu_icon_color_default',
                    array(
                        'label' => esc_attr__('Search Button Icon Color', 'blogrock-core'),
                        'section' => 'blogrock_header_section', // Add a default or your own section
                    )));

            // Navbar Background

            $wp_customize->add_setting('blogrock_background_navbar_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2C3E51'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_background_navbar_default',
                    array(
                        'label' => esc_attr__('Navbar Background', 'blogrock-core'),
                        'section' => 'blogrock_header_section', // Add a default or your own section
                    )));





            $wp_customize->add_section('blogrock_main_menu_section', array(
                'title' => esc_attr__('Main Menu', 'blogrock-core'),
                'priority' => 20,
                'panel'          => 'blogrock_panel_navbar',
            ));


            $wp_customize->add_setting('blogrock_background_navbar_menu_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#222222'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_background_navbar_menu_default',
                    array(
                        'label' => esc_attr__('Menu Navbar Background', 'blogrock-core'),

                        'section' => 'blogrock_main_menu_section', // Add a default or your own section
                    )));



            //Menu Font Family

            $wp_customize->add_setting( 'blogrock_menu_fonts',
                array(
                    'default' => '{"font":"Roboto","regularweight":"regular","italicweight":"italic","boldweight":"700","category":"sans-serif"}',
                    'sanitize_callback' => 'skyrocket_google_font_sanitization',
                )

            );

            $wp_customize->add_control( new Skyrocket_Google_Font_Select_Custom_Control( $wp_customize, 'blogrock_menu_fonts',
                array(
                    'label' => esc_attr__('Menu Font Family', 'blogrock-core'),
                    'section' => 'blogrock_main_menu_section',
                    'input_attrs' => array(
                        'font_count' => 'all',
                        'orderby' => 'alpha',
                    ),
                )
            ) );


            // Links Color

            $wp_customize->add_setting('blogrock_menu_link_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#ffffff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_menu_link_color_default',
                    array(
                        'label' => esc_attr__('Links Color', 'blogrock-core'),
                        'section' => 'blogrock_main_menu_section', // Add a default or your own section
                    )));


            // Links Hover/Active Color

            $wp_customize->add_setting('blogrock_menu_link_hover_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#ffffff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_menu_link_hover_color_default',
                    array(
                        'label' => esc_attr__('Links Hover/Active Color', 'blogrock-core'),
                        'section' => 'blogrock_main_menu_section', // Add a default or your own section
                    )));


            // Links Hover/Active Background

            $wp_customize->add_setting('blogrock_menu_link_hover_background_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#009688'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_menu_link_hover_background_default',
                    array(
                        'label' => esc_attr__('Links Hover/Active Color', 'blogrock-core'),
                        'section' => 'blogrock_main_menu_section', // Add a default or your own section
                    )));

            $wp_customize->add_setting('blogrock_menu_text_transform_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'uppercase',
                )
            );
            $wp_customize->add_control('blogrock_menu_text_transform_default', array(
                    'type' => 'select',
                    'description' => esc_attr__('Menu Text Transform', 'blogrock-core'),
                    'section' => 'blogrock_main_menu_section',
                    'choices' =>
                        array(
                            'none' => esc_attr__('None', 'blogrock-core'),
                            'uppercase' => esc_attr__('Uppercase', 'blogrock-core')

                        ),
                )
            );


            $wp_customize->add_setting('blogrock_menu_bolding_default', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_menu_bolding_default', array(
                    'type' => 'select',
                    'description' => esc_attr__('Menu Bolding', 'blogrock-core'),
                    'section' => 'blogrock_main_menu_section',
                    'choices' =>
                        array(
                            'normal' => esc_attr__('Normal', 'blogrock-core'),
                            'bold' => esc_attr__('Bold', 'blogrock-core')

                        ),
                )
            );


            // Top border after mouseover

            $wp_customize->add_setting('blogrock_menu_decoration_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#1bb999'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_menu_decoration_color_default',
                    array(
                        'label' => esc_attr__('Top border after mouseover', 'blogrock-core'),
                        'section' => 'blogrock_main_menu_section', // Add a default or your own section
                    )));

            /*Footer*/

            $wp_customize->add_section('blogrock_footer_section', array(
                'title' => esc_attr__('Footer Section', 'blogrock-core'),
                'priority' => 21,
            ));

            $wp_customize->add_setting('blogrock_display_sidebar_footer_default', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array($this, 'sanitize_checkbox'),
                'default' => false
            ));

            $wp_customize->add_control('blogrock_display_sidebar_footer_default', array(
                'type' => 'checkbox',
                'section' => 'blogrock_footer_section', // Add a default or your own section
                'label' => esc_html__('Display sidebar in footer', 'blogrock-core'),

            ));

            // Footer Sidebar Background

            $wp_customize->add_setting('blogrock_sidebar_background_footer_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2c3f52'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_sidebar_background_footer_default',
                    array(
                        'label' => esc_attr__('Footer Sidebar Background', 'blogrock-core'),
                        'section' => 'blogrock_footer_section',
                    )));


            // Footer Headers Color

            $wp_customize->add_setting('blogrock_header_footer_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#2c3f52'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_header_footer_color_default',
                    array(
                        'label' => esc_attr__('Footer Headers Color', 'blogrock-core'),
                        'section' => 'blogrock_footer_section',
                    )));


            // Headers Decorator Color

            $wp_customize->add_setting('blogrock_decorator_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#a3b1ba'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_decorator_color_default',
                    array(
                        'label' => esc_attr__('Headers Decorator Color', 'blogrock-core'),
                        'section' => 'blogrock_footer_section',
                    )));


            // Footer Sidebar Text Color

            $wp_customize->add_setting('blogrock_text_footer_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#fff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_text_footer_color_default',
                    array(
                        'label' => esc_attr__('Footer Sidebar Text Color', 'blogrock-core'),
                        'section' => 'blogrock_footer_section',
                    )));



            // Footer Border Component Color

            $wp_customize->add_setting('blogrock_border_color_default', array(
                'sanitize_callback' => 'sanitize_hex_color',
                'default' => '#fff'
            ));

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, 'blogrock_border_color_default',
                    array(
                        'label' => esc_attr__('Footer Border Component Color', 'blogrock-core'),
                        'section' => 'blogrock_footer_section',
                    )));

            // Display social buttons in footer

            $wp_customize->add_setting('blogrock_display_social_links_footer', array(
                    'sanitize_callback' => array($this, 'sanitize_select'),
                    'default' => 'normal',
                )
            );
            $wp_customize->add_control('blogrock_display_social_links_footer', array(
                    'type' => 'select',
                    'description' => esc_attr__('Display social buttons in footer', 'blogrock-core'),
                    'section' => 'blogrock_footer_section',
                    'choices' =>
                        array(
                            '0' => esc_attr__('Off', 'blogrock-core'),
                            '1' => esc_attr__('On', 'blogrock-core')

                        ),
                )
            );

            // Display social buttons in footer

            $wp_customize->add_setting('blogrock_display_social_links_footer', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array($this, 'sanitize_checkbox'),
                'default' => true
            ));

            $wp_customize->add_control('blogrock_display_social_links_footer', array(
                'type' => 'checkbox',
                'section' => 'blogrock_footer_section', // Add a default or your own section
                'label' => esc_html__('Display social buttons in footer', 'blogrock-core'),

            ));

            // Display go to top button

            $wp_customize->add_setting('blogrock_display_go_top_link_footer', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array($this, 'sanitize_checkbox'),
                'default' => true
            ));

            $wp_customize->add_control('blogrock_display_go_top_link_footer', array(
                'type' => 'checkbox',
                'section' => 'blogrock_footer_section', // Add a default or your own section
                'label' => esc_html__('Display go to top button', 'blogrock-core'),

            ));


            // end blog rock native



        }

        /**
         * TO DO: change sanitize select
         * @param $input
         * @return string
         */

        function sanitize_fonts($input)
        {


            if (array_key_exists($input, $this->config->get_google_fonts_options())) {

                return $input;

            } else {

                return '';

            }

        }

        /**
         * Select Sanitization
         * @param $input
         * @param $setting
         * @return string
         */

        function sanitize_select($input, $setting)
        {

            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);

            //get the list of possible select options
            $choices = $setting->manager->get_control($setting->id)->choices;

            //return input if valid or return default option
            return (array_key_exists($input, $choices) ? $input : $setting->default);

        }

        /**
         * Sanitize Checkbox
         * @param $checked
         * @return bool
         */

        function sanitize_checkbox($checked)
        {
            // Boolean check.
            return ((isset($checked) && true == $checked) ? true : false);
        }


    }


}

