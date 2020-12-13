<?php


if (!class_exists('Blogrock_Base')) {

    /**
     * Root Class for initialize
     */
    abstract class Blogrock_Base {


        public $config;
        public $settings;
        public $actions;
        public $filters;
        protected static $instance;


        /**
         * Get only one instance
         */
        public static function get_instance( $config, $settings ) {

            if (!static::$instance instanceof static) {

                static::$instance = new static($config, $settings);

            }
            return static::$instance;
        }

        public function __construct( $config, $settings ) {

            $this->config = $config;
            $this->settigs = $settings;

            $this->actions = [];
            $this->filters = [];

        }

        /**
         * A utility function that is used to register the actions and hooks into a single
         *
         * @param $hooks
         * @param $hook
         * @param $component
         * @param $callback
         * @param $priority
         * @param $accepted_args
         *
         * @return array
         */


        public function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

            $hooks[] = [ 'hook' => $hook, 'component' => $component, 'callback' => $callback, 'priority' => $priority, 'accepted_args' => $accepted_args ];

            return $hooks;

        }

        /**
         * Add action to the global collection to be registered with WordPress
         * @param $hook
         * @param $component
         * @param $callback
         * @param int $priority
         * @param int $accepted_args
         */

        protected function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

            $this->actions = $this->add($this->actions, $hook, $component, $callback, $priority, $accepted_args);

        }

        /**
         * Add filter to the global collection to be registered with WordPress
         * @param $hook
         * @param $component
         * @param $callback
         * @param int $priority
         * @param int $accepted_args
         */

        protected function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {

            $this->filters = $this->add($this->filters, $hook, $component, $callback, $priority, $accepted_args);

        }


        /**
         * Register the filters and actions with WordPress.
         *
         */
        public function run_adds() {

            foreach ( $this->actions as $hook ) {

                add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );

            }

            foreach ( $this->filters as $hook ) {

                add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ), $hook['priority'], $hook['accepted_args'] );

            }

        }

    }
}