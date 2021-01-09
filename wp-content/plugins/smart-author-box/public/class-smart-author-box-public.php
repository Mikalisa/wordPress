<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link      
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/public
 * @author     Wpxon <wpxon7@gmail.com>
 */
class Smart_Author_Box_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.4
	 * @param      string    $smart_author_box       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $smart_author_box, $version ) {

		$this->smart_author_box = $smart_author_box;
		$this->version = $version;

		$this->settings_api = new Smart_Author_Box_Settings_API($this->smart_author_box, $this->version); 

	}
 
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.4
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'smart-author-box-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );  
		wp_enqueue_style( 'smart-author-box-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.4
	 */
	public function enqueue_scripts() {
  
		wp_enqueue_script( 'smart-author-box-main', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'), $this->version, true );
	}
 
	/**
	 * Frontend Shortcode
	 *
	 * @since    1.0.4
	 */
	public function smart_author_box_frontend($content) {
		$sett_val = $this->settings_value();
		ob_start(); 

		include('partials/smart-author-box-public-display.php');
		$smart_author_box = ob_get_clean();
		?> 
		<?php 
		return $content. $smart_author_box;
	}

	/**
	 * Frontend Style
	 *
	 * @since    1.0.4
	 */
	public function smart_author_box_frontend_style() {
		$sett_val = $this->settings_value();
		?>
		<style>
			<?php if(!empty($sett_val['sab_title_clr'])):; ?>
				.blog-authors-text h5{
					color: <?php echo esc_attr($sett_val['sab_title_clr']); ?> !important;
				}
			<?php endif; ?>
			<?php if(!empty($sett_val['sab_icons_clr'])):; ?>
				.blog-details-share li a{
					color: <?php echo esc_attr($sett_val['sab_icons_clr']); ?>;
					transition: .1s;
				}
			<?php endif; ?>
			<?php if(!empty($sett_val['sab_icons_hvr_clr'])):; ?>
				.blog-details-share li a:hover{
					color: <?php echo esc_attr($sett_val['sab_icons_hvr_clr']); ?> !important;
				}
			<?php endif; ?> 
		</style>
		<?php
	}

	/**
	 * Settings value
	 *
	 * @since    1.0.4
	 */
    public function settings_value(){  
		$sab_box_on = $this->settings_api->get_option('sab_box_on','sab_style_one','');  
		$sab_title_clr = $this->settings_api->get_option('sab_title_clr','sab_style_one','');  
		$sab_icons_clr = $this->settings_api->get_option('sab_icons_clr','sab_style_one','');  
		$sab_icons_hvr_clr = $this->settings_api->get_option('sab_icons_hvr_clr','sab_style_one','');  
 
		$val =  array(
			'sab_box_on'=>$sab_box_on,
			'sab_title_clr'=>$sab_title_clr,
			'sab_icons_clr'=>$sab_icons_clr,
			'sab_icons_hvr_clr'=>$sab_icons_hvr_clr
		); 
		return $val;
    } 
}
