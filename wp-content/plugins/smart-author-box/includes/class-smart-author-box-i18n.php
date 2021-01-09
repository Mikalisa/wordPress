<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link      http://wpxon.com/
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.4
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/includes
 * @author     Wpxon <wpxon7@gmail.com>
 */
class Smart_Author_Box_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.4
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'smart-author-box',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
