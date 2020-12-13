<?php

/**
 * Class for genearating custom styles
 */
class blogrock_Custom_Styles
{

    static $default_config;
    static $theme_info;
    static $instance;

    function __construct($config)
    {

        self::$default_config = $config;

        add_action('wp_enqueue_scripts', array($this, 'register_fonts'));


    }

    function header_css_output()
    {

        $ouput_css = '';
        $css_propeties_array = self::$default_config->css_propeties_array;
        if (count($css_propeties_array) > 0) {
            foreach ($css_propeties_array as $property_key => $property_values) {

                $css_property = get_theme_mod($property_key);
                if (strlen($css_property) > 0) {

                    $unit = isset($property_values['unit']) ? $property_values['unit'] : '';//add px support from slider


                    if( $property_values['property'] == 'font-family' ) {



                        $css_property = json_decode( $css_property, true );


                        if( isset($css_property)) {
                            $ouput_css .= $property_values['selectors'] . '{' . $property_values['property'] . ':' . $css_property['font'] .', '. $css_property ['category'].'}';
                        }


                    } else if(isset($css_property)) {

                        $ouput_css .= $property_values['selectors'] . '{' . $property_values['property'] . ':' . $css_property . $unit . '}';

                    }

                }

            }
        }
        //first register and enqueue the actual 'blogrock_main' stylesheet.

        /*add layout settings*/
        $ouput_css .= $this->layout_width_css();
        $output_header_style = $this->navbar_styles();

        wp_add_inline_style('blogrock_main', $ouput_css . $output_header_style);


    }

    public static function getInstance($config)
    {
        if (self::$instance === null) {
            self::$instance = new blogrock_Custom_Styles($config);
        }
        return self::$instance;
    }


    /*
     * Prepare CSS with sizes of containers
     */
    private function layout_width_css()
    {

        //get default layout sizes with keys
        $layout_sizes = self::$default_config->layout_sizes;
        $layout_settings = array();
        $layout_values = array();


        if (count($layout_sizes) > 0) {

            /*
             * prepare first array of set and default sizes
             */

            foreach ($layout_sizes as $key_value => $container_array) {

                $size = '';

                if (strlen($container_array['customizer_key']) > 0)
                    $size = esc_attr( get_theme_mod($container_array['customizer_key']) );

                if (strlen($size) > 0) {
                    $layout_settings[$key_value] = $size;//get size from get_theme_mod
                } else {
                    $layout_settings[$key_value] = $container_array['size'];//get default value
                }

            }

            /*
             * prepare array with all calculated values
             * based on layout_sizes config array
             * if size should be calculated just do it
             */
            foreach ($layout_settings as $key => $size) {
                if (is_array($size)) {
                    $returned_size = 0;
                    $i = 0;
                    foreach ($size as $value) {
                        if ($i == 0) {
                            $returned_size = (int)$layout_settings[$value]; //first  param: minuend
                        } else {
                            $returned_size = (int)$returned_size - (int)$layout_settings[$value];//second param: subtrahend
                        }
                        $i++;

                    }
                    $layout_values[$key] = $returned_size;
                } else {
                    $layout_values[$key] = $size;
                }
            }
            $ouput_css = '@media (min-width:' . $layout_sizes['layout']['size'] . 'px) {';

            foreach ($layout_sizes as $key_value => $container_array) {

                $ouput_css .= $container_array['container'] . '{width:' . $layout_values[$key_value] . 'px}';

            }

            $ouput_css .= '}';

            return $ouput_css;
        }
    }

    /*
     * Display Man Navbar CSS
     */
    private function navbar_styles($type = 'default')
    {
        $navbar_background = esc_attr( get_theme_mod('blogrock_background_navbar_' . $type));
        $background_opacity = esc_attr( get_theme_mod('blogrock_background_navbar_opacity_' . $type, '1'));

        $output_css = '';
        if (strlen($navbar_background) > 0) {
            $output_css .= '.smartlib-bottom-navbar{background:' . $this->background_rgba($navbar_background, $background_opacity) . '}';
        }

        return $output_css;
    }


    /*
     * returns rgba bacground string from hex color and opacity
     */
    private function background_rgba($colour, $opacity = '1')
    {
        if ($colour[0] == '#') {
            $colour = substr($colour, 1);
        }
        if (strlen($colour) == 6) {
            list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
        } elseif (strlen($colour) == 3) {
            list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
        } else {
            return false;
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';

    }


    public function register_fonts()
    {

        $fonts = self::$default_config->blogrock_fonts;



        self::$theme_info = wp_get_theme();


        if (is_array($fonts)) {

            $custom_font_string = '';

            foreach ($fonts as $handle => $font) {

                $custom_font = wp_kses_post( get_theme_mod($handle) );


                if ($custom_font !== false) {

                    $font_array = json_decode($custom_font, true);


                } else {

                    $font_array = json_decode($font, true);

                }

                if (isset($font_array['font']) && ( substr_count($custom_font_string, $font_array['font'])==0)) {



                    $custom_font_string .= str_replace(' ', '+', $font_array['font']) . '|';

                }


            }


            wp_register_style('blogrock-custom-fonts', html_entity_decode(esc_url('https://fonts.googleapis.com/css?family=' . substr($custom_font_string, 0, -1)) . '&display=swap&subset=latin-ext'), array(), self::$theme_info->Version, 'all');

        }


    }


}