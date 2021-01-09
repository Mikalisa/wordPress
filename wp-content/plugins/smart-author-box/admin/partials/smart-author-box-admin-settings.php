<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link      http://wpxon.com/
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/admin/partials
 */
  
 ?>

<div class="wrap"> 
    <h2><?php esc_html_e('Smart Author Box Settings', 'smart-author-box'); ?></h2>
    <div id="poststuff"> 
        <div id="post-body" class="metabox-holder">  
        	<div id="post-body-content"> 
	            <div class="inside">
	                <?php $this->settings_api->show_navigation();?>
	                <?php $this->settings_api->show_forms();?> 
	            </div>   
	        </div>  
        </div>    
    </div>   
</div>  