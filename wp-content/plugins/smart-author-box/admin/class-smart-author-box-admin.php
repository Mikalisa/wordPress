<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link      http://wpxon.com/
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/admin
 * @author     Wpxon <wpxon7@gmail.com>
 */
class Smart_Author_Box_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.4
	 * @access   private
	 * @var      string    $smart_author_box    The ID of this plugin.
	 */
	private $smart_author_box;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.4
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;


	/**
	 * The settings api of this plugin.
	 *
	 * @since    1.0.4
	 * @access   private
	 * @var 	$settings_api	The settings api of this plugin
	 */
	private $settings_api;

	/**
	 * The plugin plugin_base_file of the plugin.
	 *
	 * @since    1.0.4
	 * @access   protected
	 * @var      string plugin_base_file The plugin plugin_base_file of this plugin.
	 */
	protected $plugin_base_file;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.4
	 * @param      string    $smart_author_box       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $smart_author_box, $version ) {

		$this->smart_author_box = $smart_author_box;
		$this->version = $version;

        $this->settings_api = new Smart_Author_Box_Settings_API($this->smart_author_box, $this->version); 

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.4
	 */
	public function enqueue_styles() { 

		wp_enqueue_style( 'smart-author-box-admin-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.4
	 */
	public function enqueue_scripts() {
 
		wp_enqueue_script( 'smart-author-box-admin-main', plugin_dir_url( __FILE__ ) . 'js/main.js', array( 'jquery' ), $this->version, true );
		// Localize the script with new data
		$args = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'adminurl' => admin_url('/')
		);
		wp_localize_script( 'smart-author-box-admin-main', 'sab', $args );

	}

   

}
