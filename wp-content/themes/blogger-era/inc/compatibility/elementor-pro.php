<?php
/**
 * Elementor Compatibility File.
 *
 * @package Blogger_Era
 */
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}
namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

/**
 * Elementor Compatibility
 */
if ( ! class_exists( 'Blogger_Era_Elementor_Pro' ) ) :

	/**
	 * Elementor Compatibility
	 *
	 * @since 1.0.0
	 */
	class Blogger_Era_Elementor_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );
			// Override Header  templates.
			add_action( 'political_era_action_header', array( $this, 'do_header' ), 0 );

			// Override Footer Templates.
			add_action( 'political_era_action_footer', array( $this, 'do_footer' ), 0 );


		}
		/**
		 * Register Locations
		 *
		 * @since 1.0.0
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}		
		
		/**
		 * Header Support
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'blogger_era_action_header', 'blogger_era_top_header', 10 );
				remove_action( 'blogger_era_action_header', 'blogger_era_site_header', 15 );
			}
		}

		/**
		 * Footer Support
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function do_footer() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $did_location ) {
				remove_action( 'blogger_era_action_footer', 'blogger_era_footer_instagram', 10 );
				remove_action( 'blogger_era_action_footer', 'blogger_era_footer_menu', 15 );
				remove_action( 'blogger_era_action_footer', 'blogger_era_footer_widget', 20 );
				remove_action( 'blogger_era_action_footer', 'blogger_era_footer_info', 25 );

			}
		}			
		
	}

endif;
Blogger_Era_Elementor_Pro::get_instance();	