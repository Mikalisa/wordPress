(function( $ ) {
	'use strict';

   
  // Uploading files
  var file_frame;
  var adminUrl = sab.adminurl;

   
  jQuery('.sab_upload_button').on('click', function( event ){
 
    event.preventDefault();
 
    // If the media frame already exists, reopen it.
    if ( file_frame ) {
      file_frame.open();
      return;
    }
 
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: jQuery( this ).data( 'uploader_title' ),
      button: {
        text: jQuery( this ).data( 'uploader_button_text' ),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });
 
    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // We set multiple to false so only get one image from the uploader
      var attachment = file_frame.state().get('selection').first().toJSON();
  
      jQuery('#sab_user_upload_meta').val(attachment.url);
      jQuery('#sab_user_upload_edit_meta').val(adminUrl+'post.php?post='+attachment.id+'&action=edit&image-editor');
      jQuery('.sab_user_user_current_img').attr('src', attachment.url).removeClass('placeholder');
    });
 
    // Finally, open the modal
    file_frame.open();
  });
 
  // Remove Image Function
  jQuery('.edit_options').hover(function(){
    jQuery(this).stop(true, true).animate({opacity: 1}, 100);
  }, function(){
    jQuery(this).stop(true, true).animate({opacity: 0}, 100);
  });

  jQuery('.remove_img').on('click', function( event ){
    var placeholder = jQuery('#sab_user_placeholder_meta').val();

    jQuery(this).parent().fadeOut('fast', function(){
      jQuery(this).remove();
      jQuery('.sab_user_user_current_img').addClass('placeholder').attr('src', placeholder);
    });
    jQuery('#sab_user_upload_meta, #sab_user_upload_edit_meta').val('');
  });
 
})( jQuery );
