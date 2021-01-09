<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link      	http://wpxon.com/
 * @since      1.0.4
 *
 * @package    Smart_Author_Box
 * @subpackage Smart_Author_Box/public/partials
 */
?>  
<?php $author_desc = get_the_author_meta( 'description' ); ?>
  
<?php  
$sab_box_switch = isset($sett_val['sab_box_on']) ? $sett_val['sab_box_on'] : '1';
if($sab_box_switch=='1'): ?>
    <div class="blog-authors">
        <?php $avatar = get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
        <?php if($avatar): ?> 
            <div class="blog-authors-image">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 90 ); ?>
            </div>
        <?php endif; ?> 
        <div class="blog-authors-text">
          <div class="author"> 
            <h5><?php the_author(); ?></h5>
            <ul class="blog-details-share">
                <?php if($facebook = get_the_author_meta('facebook')): ?>
                    <li><a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook-f"></i></a></li>
                <?php endif; ?>
                <?php if($twitter = get_the_author_meta('twitter')): ?>
                <li><a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>
                <?php if($google_plus = get_the_author_meta('google_plus')): ?>
                <li><a href="<?php echo esc_url($google_plus); ?>"><i class="fa fa-google-plus"></i></a></li>
                <?php endif; ?>
                <?php if($linkedin = get_the_author_meta('linkedin')): ?>
                <li><a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php endif; ?> 
            </ul>
          </div>
          <?php $desc = get_the_author_meta( 'description' ); ?>
            <p><?php echo ($desc) ? esc_html($desc) : esc_html_e('Please enter the biographical info from the user profile screen.','smart-author-box'); ?></p>
        </div>
    </div> 
<?php endif; ?>
  