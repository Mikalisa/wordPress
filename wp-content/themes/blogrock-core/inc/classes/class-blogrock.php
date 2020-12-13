<?php



if (!class_exists('Blogrock_Rocksite')) {

    /**
     * Root Class for initialize
     */
    class Blogrock_Rocksite {

        private static $instance;
        private static $theme_mods;
        public static $layout; // zmienna przechowująca obiekt layoutu
        private static $setup;
        private static $customizer;
        public $config;
        public $settings;







        /**
         * Get only one instance
         */
        public static function get_instance() {

            if (!isset( self::$instance )) {

                self::$instance = new self();


            }

            return self::$instance;

        }


        private function __construct() {



            $this->config = Blogrock_Config_Rocksite::get_instance();


            // Create theme classes and inject config & settings


            self::$customizer = Blogrock_Customizer::get_instance($this->config, $this->settings);



        }



        public static function layout() {

            return self::$layout;

        }




    }
}