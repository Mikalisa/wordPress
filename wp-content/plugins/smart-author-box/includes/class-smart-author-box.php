<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link      http://wpxon.com/
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.4
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/includes
 * @author     Wpxon <wpxon7@gmail.com>
 */
class Smart_Author_Box {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.4
	 * @access   protected
	 * @var      Smart_Author_Box_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.4
	 * @access   protected
	 * @var      string    $smart_author_box    The string used to uniquely identify this plugin.
	 */
	protected $smart_author_box;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.4
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.4
	 */
	public function __construct() {
		if ( defined( 'SMART_AUTHOR_BOX_VERSION' ) ) {
			$this->version = SMART_AUTHOR_BOX_VERSION;
		} else {
			$this->version = '1.0.4';
		}
		$this->smart_author_box = 'smart-author-box';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Smart_Author_Box_Loader. Orchestrates the hooks of the plugin.
	 * - Smart_Author_Box_i18n. Defines internationalization functionality.
	 * - Smart_Author_Box_Admin. Defines all hooks for the admin area.
	 * - Smart_Author_Box_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.4
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-smart-author-box-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-smart-author-box-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-smart-author-box-admin-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-smart-author-box-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smart-author-box-admin-option.php';
 
		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/smart-author-box-user-option.php';
 
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-smart-author-box-public.php'; 

		$this->loader = new Smart_Author_Box_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Smart_Author_Box_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.4
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Smart_Author_Box_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.4
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Smart_Author_Box_Admin( $this->get_smart_author_box(), $this->get_version() );
		$plugin_admin_options = new Smart_Author_Box_Admin_Options( $this->get_smart_author_box(), $this->get_version() );
		$plugin_user_options = new Smart_Author_Box_User_Options( $this->get_smart_author_box(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );     
        $this->loader->add_action('admin_init', $plugin_admin_options, 'settings_init');
        $this->loader->add_action('admin_menu', $plugin_admin_options, 'admin_menu');
		$this->loader->add_action( 'show_user_profile', $plugin_user_options,'smart_author_boxprofile_img_fields' );
		$this->loader->add_action( 'edit_user_profile', $plugin_user_options,'smart_author_boxprofile_img_fields' );
		$this->loader->add_action( 'personal_options_update', $plugin_user_options,'smart_author_box_save_img_meta' );
		$this->loader->add_action( 'edit_user_profile_update', $plugin_user_options,'smart_author_box_save_img_meta' );
		$this->loader->add_filter( 'get_avatar', $plugin_user_options,'smart_author_boxavatar', 1, 5 );

 

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.4
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Smart_Author_Box_Public( $this->get_smart_author_box(), $this->get_version() );

		 
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' ); 
		add_filter('the_content', array($plugin_public, 'smart_author_box_frontend' ));  
		add_filter('wp_head', array($plugin_public, 'smart_author_box_frontend_style' ));  

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.4
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.4
	 * @return    string    The name of the plugin.
	 */
	public function get_smart_author_box() {
		return $this->smart_author_box;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.4
	 * @return    Smart_Author_Box_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.4
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
