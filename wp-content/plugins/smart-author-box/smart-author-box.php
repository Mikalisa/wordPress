<?php
/** 
 * Plugin Name:       Smart Author Box
 * Plugin URI:        http://wpxon.com/smart-author-box
 * Description:       Smart Author Box will show the author's biography below articles.
 * Version:           1.0.4
 * Author:            WPxon
 * Author URI:        http://wpxon.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-author-box
 * Domain Path:       /languages
 *
 * @link              http://wpxon.com/
 * @since             1.0.4
 * @package           Smart_Author_Box
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.  
 */
define( 'SMART_AUTHOR_BOX_VERSION', '1.0.4' ); 
define( 'SMART_AUTHOR_BOX_PLUGIN', plugin_basename( __FILE__ ) );  
define( 'SMART_AUTHOR_BOX', dirname( SMART_AUTHOR_BOX_PLUGIN ) );           
define( 'SMART_AUTHOR_BOX_DIR', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );      
define( 'SMART_AUTHOR_BOX_STORE_URL', 'http://wpxon.com/' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smart-author-box-activator.php
 */
function activate_smart_author_box() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-author-box-activator.php';
	Smart_Author_Box_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smart-author-box-deactivator.php
 */
function deactivate_smart_author_box() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-author-box-deactivator.php';
	Smart_Author_Box_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smart_author_box' );
register_deactivation_hook( __FILE__, 'deactivate_smart_author_box' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smart-author-box.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.4
 */
function run_smart_author_box() {

	$plugin = new Smart_Author_Box();
	$plugin->run();

}
run_smart_author_box();

 