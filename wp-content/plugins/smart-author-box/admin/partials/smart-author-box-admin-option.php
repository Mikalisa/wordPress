<?php

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
class Smart_Author_Box_Admin_Options {

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
 

    public function admin_menu() { 
        add_menu_page( 
            __('Smart Author Box', 'smart-author-box'),  // page title
            __('Smart Author Box', 'smart-author-box' ),  // menu title
            'manage_options', 
            'wpxon_sab', 
            array($this, 'admin_about'),   
            'dashicons-id', // icon
            75 // priority
        ); 

        add_submenu_page(
            'wpxon_sab', 
            __('Settings', 'smart-author-box'),  // page title
            __('Settings', 'smart-author-box' ),  // menu title
            'manage_options',  // page permission
            'wpxon_sab_settings',  // page slug
            array($this, 'admin_settings') 
        );  

    }
    
    public function admin_settings() { 

        include('smart-author-box-admin-settings.php');
    }

    public function admin_about() { 

        include('smart-author-box-admin-about.php');
    }


    public function settings_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    public function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'sab_style_one',
                'title' => __( 'General', 'smart-author-box' )
            ) 
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = array(
            'sab_style_one' => array(  
                array(
                    'name'              => 'sab_box_on',
                    'label'             => __( 'Author Box', 'smart-author-box' ),
                    'desc'              => __( 'Select Enavled if you want to show the author box.', 'smart-author-box' ),
                    'type'              => 'select',
                    'default'           => '1',
                    'options'           => array(
                        '1'                 => __('Enabled','smart-author-box'),
                        '0'                 => __('Disabled','smart-author-box')
                    )
                ),     
                array(
                    'name'    => 'sab_title_clr',
                    'label'   => __( 'Author Name Color', 'smart-author-box' ),
                    'desc'    => __( 'Pick a color for the author name.', 'smart-author-box' ),
                    'type'    => 'color',
                    'default' => ''
                ),     
                array(
                    'name'    => 'sab_icons_clr',
                    'label'   => __( 'Social Icons Color', 'smart-author-box' ),
                    'desc'    => __( 'Pick a color for the social icons.', 'smart-author-box' ),
                    'type'    => 'color',
                    'default' => ''
                ),       
                array(
                    'name'    => 'sab_icons_hvr_clr',
                    'label'   => __( 'Social Icons Hover Color', 'smart-author-box' ),
                    'desc'    => __( 'Pick a hover color for the social icons.', 'smart-author-box' ),
                    'type'    => 'color',
                    'default' => ''
                ),    
            ) 
        );

        return $settings_fields;
    }
  
     
}
