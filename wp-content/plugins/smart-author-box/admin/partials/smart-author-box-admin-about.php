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
    <h2><?php esc_html_e('Smart Author Box Info:', 'smart-author-box'); ?></h2>
    <div id="poststuff"> 
        <div id="post-body" class="metabox-holder  columns-2"> 
            <p><?php esc_html_e('Smart Author Box will show the author\'s biography below articles.','smart-author-box'); ?> </p> 
             <hr> 
        	<div id="post-body-content">  
                <div class="inside"> 
                    <p><?php esc_html_e('This is a responsive and clean designed author box at the end of your posts, which will display the author name, author gravatar and author description. It also allow to show the author social icon which values can be input from the wordpress user profile screen. ','smart-author-box'); ?> </p> 
                    <br> <br>
                    <h3><?php esc_html_e('Go to','smart-author-box'); ?> <a href="<?php echo esc_url(admin_url('/profile.php#sab_user_container')); ?>"><?php esc_html_e('User Profile','smart-author-box'); ?></a> <?php esc_html_e('page','smart-author-box'); ?>.</h3>
                    <h3><?php esc_html_e('Go to','smart-author-box'); ?> <a href="<?php echo esc_url(admin_url('/admin.php?page=wpxon_sab_settings')); ?>"><?php esc_html_e('Settings','smart-author-box'); ?></a> <?php esc_html_e('page','smart-author-box'); ?>.</h3>
                </div>  
	        </div>  
            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h3><?php esc_html_e('Support','smart-author-box'); ?> </h3> 
                        <hr>
                        <div class="inside">
                            <p><?php esc_html_e('Plugin','smart-author-box'); ?> : <b><?php esc_html_e('Smart Author Box','smart-author-box'); ?></b> - v<?php echo $this->version; ?> </p>
                            <p><?php esc_html_e('Author','smart-author-box'); ?> : <?php esc_html_e('wpxon','smart-author-box'); ?></p>
                            <p><?php esc_html_e('Email','smart-author-box'); ?> : <a href="mailto:wpxon7@gmail.com" target="_blank"><?php esc_html_e('wpxon7@gmail.com','smart-author-box'); ?></a></p> 
                            <p><?php esc_html_e('Website','smart-author-box'); ?> : <a href="http://wpxon.com" target="_blank"><?php esc_html_e('http://wpxon.com','smart-author-box'); ?></a></p>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div>    
    </div>   
</div>  