jQuery( document ).ready(function() {
    
   
    console.log( "ready!" );
    jQuery( ".datepicker" ).datepicker();
    
    jQuery('#pmsafe-generate-code').click(function(e) {
        e.preventDefault();
        var input = jQuery(this).siblings('.pmsafe-code-input');
        var code = Math.floor(Math.random()*9007199254740991).toString(26);
        input.val(code);
    });
    
    jQuery('#benefit-pdf-upload').click(function(e) {
        e.preventDefault();
        single_img_upload(this);
    });
    


});

function single_img_upload(this_val){
    
    var media_upload;

    // If the uploader object has already been created, reopen the dialog
    if( media_upload ) {
        media_upload.open();
        return;
    }

    // Extend the wp.media object
    media_upload = wp.media.frames.file_frame = wp.media({
        title: 'Select PDF',
        button: { text: 'Select' },
        multiple: false
    });

    //When a file is selected, grab the URL and set it as the text field's value
    media_upload.on( 'select', function() {
        attachment = media_upload.state().get( 'selection' ).first().toJSON();
        console.log(attachment); //irrelevant to functionality but useful
        //adds the ID to the hidden input
        jQuery(this_val).siblings('#pmsafe_benefit_pdf').val( attachment.id );
        //provides the preview image
        jQuery(this_val).siblings('.pdf-block').empty();
        jQuery(this_val).siblings('.pdf-block').append('<a href="'+ attachment.url +'" target="_blank"><img src="' + attachment.icon + '" class="attachment-thumbnail" width="30" height="40" /></a>');
    });

    //Open the uploader dialog
    media_upload.open();
    
}

