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
class Smart_Author_Box_User_Options {
  
    public function smart_author_boxprofile_img_fields( $user ) {
        if ( ! current_user_can( 'edit_user' ) ) {
            return;
        }
 
        // vars
        $url             = get_the_author_meta( 'sab_user_meta', $user->ID );
        $upload_url      = get_the_author_meta( 'sab_user_upload_meta', $user->ID );
        $upload_edit_url = get_the_author_meta( 'sab_user_upload_edit_meta', $user->ID );
        $button_text     = $upload_url ? esc_html('Change Current Image','smart-author-box') : esc_html('Upload New Image','smart-author-box');

        if ( $upload_url ) {
            $upload_edit_url = get_site_url() . $upload_edit_url;
        }
        ?>

        <div id="sab_user_container">
            <h3><?php esc_html_e( 'Smart Author Box - User Settings', 'smart-author-box' ); ?></h3>

            <p class="description">
                <?php esc_html_e( 'Update Profile to save your changes.', 'smart-author-box' ); ?>
            </p>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="sab_user_meta"><?php esc_html_e( 'Profile Photo', 'smart-author-box' ); ?></label>
                        <br>
                        <span><?php esc_html_e('If want to use gravatar image then leave this profile photo. Don\'t needed to upload.'); ?></span>
                    </th>
                    <td>
                        <!-- Outputs the image after save -->
                        <div id="current_img">
                            <?php if ( $upload_url ): ?>
                                <img class="sab_user_user_current_img" src="<?php echo esc_url( $upload_url ); ?>"/>

                                <div class="edit_options uploaded">
                                    <a class="remove_img">
                                        <span><?php esc_html_e( 'Remove', 'smart-author-box' ); ?></span>
                                    </a>

                                    <a class="edit_img" href="<?php echo esc_url( $upload_edit_url ); ?>" target="_blank">
                                        <span><?php esc_html_e( 'Edit', 'smart-author-box' ); ?></span>
                                    </a>
                                </div>
                            <?php elseif ( $url ) : ?>
                                <img class="sab_user_user_current_img" src="<?php echo esc_url( $url ); ?>"/>
                                <div class="edit_options single">
                                    <a class="remove_img">
                                        <span><?php esc_html_e( 'Remove', 'smart-author-box' ); ?></span>
                                    </a>
                                </div>
                            <?php else : ?>
                                <img class="sab_user_user_current_img placeholder"
                                     src="<?php echo esc_url( plugins_url( 'smart-author-box/admin/img/placeholder.gif' ) ); ?>"/>
                            <?php endif; ?>
                        </div>
 
                   
 
                        <div id="sab_user_upload">
                            <input class="hidden" type="hidden" name="sab_user_placeholder_meta" id="sab_user_placeholder_meta"
                                   value="<?php echo esc_url( plugins_url( 'smart-author-box/admin/img/placeholder.gif' ) ); ?>"/>
                            <input class="hidden" type="hidden" name="sab_user_upload_meta" id="sab_user_upload_meta"
                                   value="<?php echo esc_url_raw( $upload_url ); ?>"/>
                            <input class="hidden" type="hidden" name="sab_user_upload_edit_meta" id="sab_user_upload_edit_meta"
                                   value="<?php echo esc_url_raw( $upload_edit_url ); ?>"/>
                            <input id="uploadimage" type='button' class="sab_upload_button button-primary"
                                   value="<?php echo esc_attr( $button_text ); ?>"/>
                            <br/>
                        </div>
 
                        <p class="description">
                            <?php esc_html_e( 'Upload a photo for your user profile.', 'smart-author-box' ); ?>
                        </p>
                    </td>
                </tr> 
                <tr class="d-none">
                    <th><label for="facebook"><?php esc_html_e("Facebook","smart-author-box"); ?></label></th>
                    <td>
                        <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php esc_html_e("Please enter your facebook link."); ?></span>
                    </td>
                </tr>
                <tr class="d-none">
                    <th><label for="twitter"><?php esc_html_e("Twitter","smart-author-box"); ?></label></th>
                    <td>
                        <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php esc_html_e("Please enter your twitter link."); ?></span>
                    </td>
                </tr>
                <tr class="d-none">
                    <th><label for="google_plus"><?php esc_html_e("Google Plus","smart-author-box"); ?></label></th>
                    <td>
                        <input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php esc_html_e("Please enter your google plus link."); ?></span>
                    </td>
                </tr>
                <tr class="d-none">
                    <th><label for="linkedin"><?php esc_html_e("Linkedin","smart-author-box"); ?></label></th>
                    <td>
                        <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
                        <span class="description"><?php esc_html_e("Please enter your linkedin link."); ?></span>
                    </td>
                </tr>
            </table><!-- end form-table -->
        </div> <!-- end #sab_user_container -->

        <?php 
    }

    function smart_author_box_save_img_meta( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return;
        }

        $values = array(  
            'sab_user_upload_meta'      => filter_input( INPUT_POST, 'sab_user_upload_meta', FILTER_SANITIZE_URL ), 
            'sab_user_upload_edit_meta' => filter_input( INPUT_POST, 'sab_user_upload_edit_meta', FILTER_SANITIZE_URL ),
            // String value. Empty in this case. 
            'facebook' => filter_input( INPUT_POST, 'facebook', FILTER_SANITIZE_STRING ),
            'twitter' => filter_input( INPUT_POST, 'twitter', FILTER_SANITIZE_STRING ),
            'google_plus' => filter_input( INPUT_POST, 'google_plus', FILTER_SANITIZE_STRING ),
            'linkedin' => filter_input( INPUT_POST, 'linkedin', FILTER_SANITIZE_STRING ),
        );

        foreach ( $values as $key => $value ) {
            update_user_meta( $user_id, $key, $value ); 
        }
    }
     

    public function get_sab_user_meta( $user_id, $size = 'thumbnail' ) {
        global $post;

        if ( ! $user_id || ! is_numeric( $user_id ) ) { 
            $user_id = $post->post_author;
        } 
        $attachment_upload_url = esc_url( get_the_author_meta( 'sab_user_upload_meta', $user_id ) );

        if ( $attachment_upload_url ) { 
            $attachment_id = attachment_url_to_postid( $attachment_upload_url ); 
            $image_thumb = wp_get_attachment_image_src( $attachment_id, $size ); 
            return isset( $image_thumb[0] ) ? $image_thumb[0] : '';
        } 
        $attachment_ext_url = esc_url( get_the_author_meta( 'sab_user_meta', $user_id ) );

        return $attachment_ext_url ? $attachment_ext_url : '';
    }

     
    public function smart_author_boxavatar( $avatar, $identifier, $size, $alt ) {
        if ( $user = $this->smart_author_boxget_user_by_id_or_email( $identifier ) ) {
            if ( $smart_author_boxavatar = $this->get_sab_user_meta( $user->ID, 'full' ) ) {
                return "<img alt='{$alt}' src='{$smart_author_boxavatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            }
        } 
        return $avatar;
    }
     
    public function smart_author_boxget_user_by_id_or_email( $identifier ) {

        if ( is_numeric( $identifier ) ) {
            return get_user_by( 'id', (int) $identifier );
        }
     
        if ( is_object( $identifier ) && property_exists( $identifier, 'ID' ) ) {
            return get_user_by( 'id', (int) $identifier->ID );
        }
     
        if ( is_object( $identifier ) && property_exists( $identifier, 'user_id' ) ) {
            return get_user_by( 'id', (int) $identifier->user_id );
        }

        return get_user_by( 'email', $identifier );
    }

     
}
