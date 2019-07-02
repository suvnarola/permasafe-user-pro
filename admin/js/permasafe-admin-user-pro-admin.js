jQuery( document ).ready(function() {
 var counter = 2;
    
    // add distributor
	jQuery(document).on("click","#pmsafe_distributors_submit", function(e) {
        // alert('in');
       e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;

        //Name
        if(jQuery('#pmsafe_distributor_name' ).val().trim()=="" ){
            jQuery('#pmsafe_distributor_name' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_distributor_name').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_distributor_name').css({'color':'#333333'});
        }

        //Email     
        if(jQuery('#pmsafe_distributor_email').val().trim() == ''){
            jQuery('#pmsafe_distributor_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_distributor_email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#pmsafe_distributor_email').val()){
                var email=jQuery("#pmsafe_distributor_email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#pmsafe_distributor_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#pmsafe_distributor_email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#pmsafe_distributor_email').css({'color':'#333333'});
                }
            }
        }
        
        //Password 
        if(jQuery('#pmsafe_distributor_password').val().trim()=="" ){
            jQuery('#pmsafe_distributor_password').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_distributor_password' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_distributor_password').css({'color':'#333333'});
        }


        // var msg = '';
        // for(i=1; i<counter; i++){
        //   msg += "\n Textbox #" + i + " : " + jQuery('#pmsafe_distributor_contact_fname' + i).val();
        // }
        //alert(msg);
        if(!validflag){
            return validflag;
        }else{
    		jQuery('.perma-admin-loader').show();
    		var form = jQuery('#perma_register_distributor_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_register_distributor_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                	jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
    	            // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        }
	});  // submit button 
    
    // Focus and blure 
    jQuery('#pmsafe_distributor_name, #pmsafe_distributor_email, #pmsafe_distributor_password, #pmsafe_distributor_store_address, #pmsafe_distributor_phone_number').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_distributor_name, #pmsafe_distributor_email, #pmsafe_distributor_password, #pmsafe_distributor_store_address, #pmsafe_distributor_phone_number').blur(function(){
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

   
    //add textbox
   
    //add new distributor contact
    jQuery('#add_new').click(function() {
        // var counter = 1;
        // counter++;

        if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
        }   
        var newTextBoxDiv = jQuery(document.createElement('div'))
         .attr("id", 'fname_div' + counter);

        newTextBoxDiv.after().html( '<h3>Contact Information:</h3>'+'<div class="nisl-wrap"><label><strong>First Name:</strong></label><input type="text" id="pmsafe_distributor_contact_fname'+ counter +'" name="pmsafe_distributor_contact_fname[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Last Name:</strong></label><input type="text" id="pmsafe_distributor_contact_lname'+ counter +'" name="pmsafe_distributor_contact_lname[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Phone Number:</strong></label><input type="text" id="pmsafe_distributor_contact_phone'+ counter +'" name="pmsafe_distributor_contact_phone[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Email:</strong></label><input type="text" id="pmsafe_distributor_contact_email'+ counter +'" name="pmsafe_distributor_contact_email[]" value="" class="widefat"/></div>');
        newTextBoxDiv.appendTo("#fname_divgroup");
        counter++;
    });
    
    //  jQuery(document).on("click", "#removeButton", function (event) {

    //     var id = jQuery(this).data('id');
    //     // alert('in->'+id);
    //     jQuery(this).parent('#fname_div'+id).remove();
        
    // });
    //remove textbox
    jQuery("#removeButton").click(function () {
    if(counter==2){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        jQuery("#fname_div" + counter).remove();
            
     });


    jQuery('#registered_customer_tbl').paginate({
      limit: 10

    });
   
    jQuery('#view_active_code').paginate({
      limit: 5

    });

    jQuery('#view_used_code').paginate({
      limit: 5

    });

    // update distributor
    jQuery(document).on("click","#pmsafe_distributors_update", function(e) {
        // alert('in');
       e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        //Name
        if(jQuery('#pmsafe_distributor_name' ).val().trim()=="" ){
            jQuery('#pmsafe_distributor_name' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_distributor_name').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_distributor_name').css({'color':'#333333'});
        }

        //Email     
        if(jQuery('#pmsafe_distributor_email').val().trim() == ''){
            jQuery('#pmsafe_distributor_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_distributor_email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#pmsafe_distributor_email').val()){
                var email=jQuery("#pmsafe_distributor_email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#pmsafe_distributor_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#pmsafe_distributor_email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#pmsafe_distributor_email').css({'color':'#333333'});
                }
            }
        }
        
        

        // var msg = '';
        // for(i=1; i<counter; i++){
        //   msg += "\n Textbox #" + i + " : " + jQuery('#pmsafe_distributor_contact_fname' + i).val();
        // }
        //alert(msg);
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_distributor_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_edit_distributor_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        }
    });  // update button 


    // delete distributor
    jQuery(document).on("click","#pmsafe_distributors_delete", function(e) {
        // alert('in');
       e.preventDefault();
        
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_delete_distributor_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_delete_distributor_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        
    });  // delete button 
    

    //add dealer
    jQuery(document).on("click","#pmsafe_dealers_submit", function(e) {
        // alert('in');
       e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        //Name
        if(jQuery('#pmsafe_dealer_name' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_name' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_name').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_name').css({'color':'#333333'});
        }

        //Email     
        if(jQuery('#pmsafe_dealer_email').val().trim() == ''){
            jQuery('#pmsafe_dealer_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#pmsafe_dealer_email').val()){
                var email=jQuery("#pmsafe_dealer_email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#pmsafe_dealer_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#pmsafe_dealer_email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#pmsafe_dealer_email').css({'color':'#333333'});
                }
            }
        }
        
        //Password 
        if(jQuery('#pmsafe_dealer_password').val().trim()=="" ){
            jQuery('#pmsafe_dealer_password').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_password' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_password').css({'color':'#333333'});
        }


        //select 
        if(jQuery('#pmsafe_dealer_distributor').val().trim()=="" ){
            jQuery('#pmsafe_dealer_distributor').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_distributor' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_distributor').css({'color':'#333333'});
        }


        // var msg = '';
        // for(i=1; i<counter; i++){
        //   msg += "\n Textbox #" + i + " : " + jQuery('#pmsafe_distributor_contact_fname' + i).val();
        // }
        //alert(msg);
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_register_dealer_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_register_dealer_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        }
    });  // submit button 
    
     // Focus and blure dealers
    jQuery('#pmsafe_dealer_name,#pmsafe_dealer_email, #pmsafe_dealer_password, #pmsafe_dealer_store_address, #pmsafe_dealer_phone_number,#pmsafe_dealer_distributor').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_dealer_name,#pmsafe_dealer_email, #pmsafe_dealer_password, #pmsafe_dealer_store_address, #pmsafe_dealer_phone_number,#pmsafe_dealer_distributor').blur(function(){
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

  

    //add new contact dealers
    jQuery('#add_new_dealer').click(function() {
        // var counter = 1;
        // counter++;
        if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
        }   
        var newTextBoxDiv = jQuery(document.createElement('div'))
         .attr("id", 'fname_div' + counter);

        newTextBoxDiv.after().html( '<h3>Contact Person Information:<i class="fa fa-trash" id="removeButton_dealer" style="cursor:pointer;color: #fff;float: right;background: #0065a7;padding: 5px;border-radius: 50%;"></i></h3><div class="nisl-wrap"><label><strong>First Name:</strong></label><input type="text" id="pmsafe_dealer_contact_fname'+ counter +'" name="pmsafe_dealer_contact_fname[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Last Name:</strong></label><input type="text" id="pmsafe_dealer_contact_lname'+ counter +'" name="pmsafe_dealer_contact_lname[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Phone Number:</strong></label><input type="text" id="pmsafe_dealer_contact_phone'+ counter +'" name="pmsafe_dealer_contact_phone[]" value="" class="widefat"/></div><div class="nisl-wrap"><label><strong>Email:</strong></label><input type="text" id="pmsafe_dealer_contact_email'+ counter +'" name="pmsafe_dealer_contact_email[]" value="" class="widefat" style="width:35%"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;">Please enter unique email-id.</span></div><div class="nisl-wrap"><label><strong>Password:</strong></label><input type="text" rel="gp" name="pmsafe_dealer_contact_password[]" value="" class="widefat" style="width:35%"/><input type="button" value="Generate Password" class="generate_dealer_contact_password" /></div>');
        newTextBoxDiv.appendTo("#fname_divgroup");
        counter++;
    });
    
    //remove textbox
    jQuery(document).on("click","#removeButton_dealer", function(e) {
    // jQuery("#removeButton_dealer").click(function () {
        
    if(counter==2){
        jQuery("#fname_div" + counter).remove();
       }   
        
    counter--;
            
        jQuery("#fname_div" + counter).remove();
            
     });


    // update dealer
    jQuery(document).on("click","#pmsafe_dealers_update", function(e) {
        // alert('in');
       e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        //Name
        if(jQuery('#pmsafe_dealer_name' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_name' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_name').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_name').css({'color':'#333333'});
        }

        //Email     
        if(jQuery('#pmsafe_dealer_email').val().trim() == ''){
            jQuery('#pmsafe_dealer_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#pmsafe_dealer_email').val()){
                var email=jQuery("#pmsafe_dealer_email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#pmsafe_dealer_email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#pmsafe_dealer_email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#pmsafe_dealer_email').css({'color':'#333333'});
                }
            }
        }
        
        

        // var msg = '';
        // for(i=1; i<counter; i++){
        //   msg += "\n Textbox #" + i + " : " + jQuery('#pmsafe_dealer_contact_fname' + i).val();
        // }
        //alert(msg);
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_dealer_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_edit_dealer_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    console.log(response);
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                    
                }
            });// ajax
          return false;
        }
    });  // update button 

    // delete dealer
    jQuery(document).on("click","#pmsafe_dealers_delete", function(e) {
        // alert('in');
       e.preventDefault();
        
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_delete_dealer_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_delete_dealer_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        
    });  // delete button 

    // delete dealers contact 
    jQuery(document).on("click","#pmsafe_dealers_contact_delete", function(e) {
     
       e.preventDefault();
       var contact_id = jQuery(this).attr("data-id");

         var data ={
            action: 'pmsafe_delete_dealer_contact_form',
            contact_id : contact_id
         }
            
            jQuery('.perma-admin-loader').show();
            
            
            
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        
    });  // delete button 

    /*jQuery(document).on("change","#pmsafe_dealer", function(e) {
       
          e.preventDefault();
        var isDisabled = jQuery("#pmsafe_distributor").prop('disabled');
        if (isDisabled)
        {
            jQuery("#pmsafe_distributor").removeAttr('disabled');
        }
        
        var nisl_dealer_id = jQuery(this).val();
        var nisl_distributor = jQuery('#pmsafe_distributor');
        // alert('dealer_id->' + dealer_id); 
        var data = {
            action: 'get_distributor',
            dealer_id: nisl_dealer_id
            
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                var obj = jQuery.parseJSON(response);
                nisl_distributor.empty();
                nisl_distributor.append(jQuery('<option selected></option>').val(obj.username).html(obj.distributor_name + '(' + obj.username + ')' ));
            },
            dataType: 'html'
        });
        return false;
    });// select */
    jQuery(document).on("change","#pmsafe_distributor", function(e) {
       
        e.preventDefault();
        var isDisabled = jQuery("#pmsafe_dealer").prop('disabled');
        if (isDisabled)
        {
            jQuery("#pmsafe_dealer").removeAttr('disabled');
        }
        
        var nisl_distributor_id = jQuery(this).val();
        var nisl_dealer = jQuery('#pmsafe_dealer');
        // alert('dealer_id->' + dealer_id); 
        var data = {
            action: 'get_dealers',
            distributor_id: nisl_distributor_id
            
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                // console.log(response);
                jQuery('#pmsafe_dealer').html(response);
                // var obj = jQuery.parseJSON(response);
                // nisl_distributor.empty();
                // nisl_distributor.append(jQuery('<option selected></option>').val(obj.username).html(obj.distributor_name + '(' + obj.username + ')' ));
            },
            dataType: 'html'
        });
        return false;
    });// select 

    function randomPassword(length) {
        // alert('test');
        var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }
    // dealer password
    jQuery(document).on("click","#generate_dealer_password", function(e) { 

        jQuery('#pmsafe_dealer_password').css("display","inline-block");
        jQuery('#pmsafe_dealer_password').val(randomPassword(10));
        
        
        jQuery('#cancel_dealer_password').css("display","inline-block");
        jQuery('#hide_dealer_password').css("display","inline-block");
        jQuery('#pmsafe_dealer_password').attr("type","text");
        jQuery('#generate_dealer_password').css("display","none");

    });

    jQuery(document).on("click","#cancel_dealer_password", function(e) {
        jQuery('#pmsafe_dealer_password').css("display","none");
        jQuery('#cancel_dealer_password').css("display","none");
        jQuery('#hide_dealer_password').css("display","none");
        jQuery('#show_dealer_password').css("display","none");
        jQuery('#generate_dealer_password').css("display","inline-block");

    });

    jQuery(document).on("click","#hide_dealer_password", function(e) {
        jQuery('#pmsafe_dealer_password').attr("type","password");
        jQuery('#hide_dealer_password').css("display","none");
        jQuery('#show_dealer_password').css("display","inline-block");
    });

    jQuery(document).on("click","#show_dealer_password", function(e) {
        jQuery('#pmsafe_dealer_password').attr("type","text");
        jQuery('#show_dealer_password').css("display","none");
        jQuery('#hide_dealer_password').css("display","inline-block");
    });

    //dealer contact passowrd
    jQuery(document).on("click",".generate_dealer_contact_password", function(e) { 

        var field = jQuery(this).closest('div').find('input[rel="gp"]');
        // alert(field);
        jQuery('#pmsafe_dealer_contact_password').css("display","inline-block");
        field.val(randomPassword(10));

    });


    //distributor password
    jQuery(document).on("click","#generate_distributor_password", function(e) {
        
        jQuery('#pmsafe_distributor_password').css("display","inline-block");
        jQuery('#pmsafe_distributor_password').val(randomPassword(10));

        jQuery('#cancel_distributor_password').css("display","inline-block");
        jQuery('#hide_distributor_password').css("display","inline-block");
        jQuery('#pmsafe_distributor_password').attr("type","text");
        jQuery('#generate_distributor_password').css("display","none");

    });
    jQuery(document).on("click","#cancel_distributor_password", function(e) {
        jQuery('#pmsafe_distributor_password').css("display","none");
        jQuery('#cancel_distributor_password').css("display","none");
        jQuery('#hide_distributor_password').css("display","none");
        jQuery('#show_distributor_password').css("display","none");
        jQuery('#generate_distributor_password').css("display","inline-block");

    });
    jQuery(document).on("click","#hide_distributor_password", function(e) {
        jQuery('#pmsafe_distributor_password').attr("type","password");
        jQuery('#hide_distributor_password').css("display","none");
        jQuery('#show_distributor_password').css("display","inline-block");
    });
    jQuery(document).on("click","#show_distributor_password", function(e) {
        jQuery('#pmsafe_distributor_password').attr("type","text");
        jQuery('#show_distributor_password').css("display","none");
        jQuery('#hide_distributor_password').css("display","inline-block");
    });

     // customer password
     jQuery(document).on("click","#generate_customer_password", function(e) {
        jQuery('#pmsafe_customer_password').css("display","inline-block");
        jQuery('#pmsafe_customer_password').val(randomPassword(10));
        
        jQuery('#cancel_customer_password').css("display","inline-block");
        jQuery('#hide_customer_password').css("display","inline-block");
        jQuery('#pmsafe_customer_password').attr("type","text");
        jQuery('#generate_customer_password').css("display","none");

    });
    jQuery(document).on("click","#cancel_customer_password", function(e) {
        jQuery('#pmsafe_customer_password').css("display","none");
        jQuery('#cancel_customer_password').css("display","none");
        jQuery('#hide_customer_password').css("display","none");
        jQuery('#hide_customer_password').css("display","none");
        jQuery('#show_customer_password').css("display","inline-block");

    });
    jQuery(document).on("click","#hide_customer_password", function(e) {
        jQuery('#pmsafe_customer_password').attr("type","password");
        jQuery('#hide_customer_password').css("display","none");
        jQuery('#show_customer_password').css("display","inline-block");
    });
    jQuery(document).on("click","#show_customer_password", function(e) {
        jQuery('#pmsafe_customer_password').attr("type","text");
        jQuery('#show_customer_password').css("display","none");
        jQuery('#hide_customer_password').css("display","inline-block");
    });

    // export csv
    jQuery(document).on("click","#export-dealer-csv", function(e) {
          e.preventDefault();
          var hdn_dealer_login = jQuery('#hdn_dealer_login').val();
          var hdn_dealer_name = jQuery('#hdn_dealer_name').val();
          
           var data = {
            action: 'get_csv_data',
            dealer_login : hdn_dealer_login
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {

                jQuery('<a></a>')
                    .attr('id','downloadFile')
                    .attr('href','data:text/csv;charset=utf8,' + encodeURIComponent(response.trim()))
                    .attr('download', hdn_dealer_login +'_'+ hdn_dealer_name + '.csv')
                    .appendTo('body');

                jQuery('#downloadFile').ready(function() {
                    jQuery('#downloadFile').get(0).click();
                });
            },
            dataType: 'html'
        });
        return false;
    });

    // export csv
    jQuery(document).on("click","#export-dealer-customer-csv", function(e) {
          e.preventDefault();
         
          var hdn_dealer_login = jQuery('#hdn_customer_dealer_login').val();

         
           var data = {
            action: 'get_customer_csv_data',
            customer_dealer_login : hdn_dealer_login
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('<a></a>')
                    .attr('id','downloadcustomerFile')
                    .attr('href','data:text/csv;charset=utf8,' + encodeURIComponent(response.trim()))
                    .attr('download', hdn_dealer_login + '.csv')
                    .appendTo('body');

                jQuery('#downloadcustomerFile').ready(function() {
                    jQuery('#downloadcustomerFile').get(0).click();
                });
                
            },
            dataType: 'html'
        });
        return false;
    });

    jQuery("#pmsafe_invitation_code_end, #pmsafe_invitation_code_start").focusout(function(){
        var start = jQuery('#pmsafe_invitation_code_start').val();
        var end = jQuery('#pmsafe_invitation_code_end').val();
        if(start || end ){
            var data = {
                action: 'check_code_exist',
                start : start,
                end : end
            };
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        // console.log(obj);
                        if( obj.status == true ){
                            jQuery(".code-exist").css("display","block");
                            jQuery("#publish").attr("disabled","disabled");   
                            
                            
                        }
                        if( obj.status == false ){
                            if(end == '' || start == ''){
                                jQuery(".code-exist").css("display","none");
                                jQuery("#publish").attr("disabled","disabled");
                            }
                            else{

                                if(start > end || start == end){

                                    jQuery(".code-range").css("display","block");
                                     jQuery("#publish").attr("disabled","disabled");   
                                }
                                else{
                                    jQuery("#publish").removeAttr("disabled","disabled");
                                    jQuery(".code-exist").css("display","none");
                                }
                             }
                        }
                    
                },
                dataType: 'html'
            });
        }
        else{
            jQuery("#publish").attr("disabled","disabled");
        }
        return false;

    });

    jQuery("#pmsafe_invitation_code").focusout(function(){
        var code = jQuery('#pmsafe_invitation_code').val();
        
        if(code ){
            var data = {
                action: 'check_invite_code_exist',
                code : code
                
            };
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        // console.log(obj);
                        if( obj.status == true ){
                            jQuery(".code-exist").css("display","block");
                            jQuery("#publish").attr("disabled","disabled");   
                            
                            
                        }
                        if( obj.status == false ){
                            if(code == ''){
                                jQuery(".code-exist").css("display","none");
                                jQuery("#publish").attr("disabled","disabled");
                            }
                            else{

                                
                                    jQuery("#publish").removeAttr("disabled","disabled");
                                    jQuery(".code-exist").css("display","none");
                                
                             }
                        }
                    
                },
                dataType: 'html'
            });
        }
        else{
            jQuery("#publish").attr("disabled","disabled");
        }
        return false;

    });
    
    jQuery("#pmsafe_invitation_code_start").focus(function(){
        jQuery(".code-exist").css("display","none");
        jQuery(".code-range").css("display","none");
    });
     jQuery("#pmsafe_invitation_code_end").focus(function(){
        jQuery(".code-exist").css("display","none");
        jQuery(".code-range").css("display","none");
    });


     jQuery(document).on("click","#update_code_button", function(e) {
        
        var post_id = jQuery.urlParam('post');
        var code_access_leval =  jQuery('select[name="pmsafe_user_role"]').find(":selected").val();
        var benifit_package =  jQuery('select[name="pmsafe_invitation_prefix"]').find(":selected").val();
        var dealer =  jQuery('select[name="pmsafe_dealer"]').find(":selected").val();
        var distributor =  jQuery('select[name="pmsafe_distributor"]').find(":selected").val();
        var select =  jQuery('#pmsafe_invitation_upgradable_prefix').select2('val');
        // var select =  JSON.stringify(jQuery("#pmsafe_invitation_upgradable_prefix option:selected").text());
        var chk = jQuery('#pmsafe_invitation_code_upgradable'). prop("checked");
        var allow_dealer = jQuery('#pmsafe_code_allow_dealer'). prop("checked");
        if(chk == true){
            chk = 1;
        }
        if(chk == false){
            chk = 0;
        }
        
        if(allow_dealer == true){
            allow_dealer = 1;
        }
        if(allow_dealer == false){
            allow_dealer = 0;
        }
        //  alert(code_access_leval + ' ' + dealer + ' ' + distributor + ' ' + benifit_package + ' ' +select + ' '+chk);

        var data = {
            action: 'update_batch_codes',
            post_id: post_id,
            code_access_leval: code_access_leval,
            benifit_package:benifit_package,
            dealer: dealer,
            distributor: distributor,
            select : select,
            chk : chk,    
            allow_dealer : allow_dealer    
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                if(obj.status == true){
                        window.location.replace(obj.redirect);
                }
            },
            dataType: 'html'
        });
        return false;
     });

     jQuery(document).on("click","#update_invite_code_button", function(e) {
        
        var post_id = jQuery.urlParam('post');
        
        var benifit_package =  jQuery('select[name="pmsafe_invitation_prefix"]').find(":selected").val();
        var dealer =  jQuery('select[name="pmsafe_dealer"]').find(":selected").val();
        var distributor =  jQuery('select[name="pmsafe_distributor"]').find(":selected").val();
        var select =  jQuery('#pmsafe_invitation_upgradable_prefix').select2('val');
        
        var chk = jQuery('#pmsafe_invitation_code_upgradable'). prop("checked");
        var allow_dealer = jQuery('#pmsafe_code_allow_dealer'). prop("checked");
        if(chk == true){
            chk = 1;
        }
        if(chk == false){
            chk = 0;
        }
        
        if(allow_dealer == true){
            allow_dealer = 1;
        }
        if(allow_dealer == false){
            allow_dealer = 0;
        }
        var data = {
            action: 'update_invite_codes',
            post_id: post_id,
            benifit_package:benifit_package,
            dealer: dealer,
            distributor: distributor,
            select : select,
            chk : chk,    
            allow_dealer : allow_dealer    
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                if(obj.status == true){
                      location.reload();
                }
            },
            dataType: 'html'
        });
        return false;
     });

     jQuery(document).on("click","#delete_code_button", function(e) {
        
        
        var post_id = jQuery(this).attr('data-id');

        // alert(code_access_leval + ' ' + dealer + ' ' + distributor + ' ' + benifit_package);

        var data = {
            action: 'delete_batch_codes',
            post_id: post_id,
            
        };
        if (confirm('Are you sure to Delete?')) {
            jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                if(obj.status == true){
                    
                        window.location.replace(obj.redirect);
                }
            },
            dataType: 'html'
        });
        return false;
        }else{
            alert('Batch code is not deleted.');
        }
        
     });

    jQuery.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }


    //reset jquery

     // export csv
    jQuery(document).on("click","#reset-code", function(e) {
          e.preventDefault();
         
        var post_id = jQuery(this).attr("data-id")

        // alert(post_id);
         
        var data = {
            action: 'reset_code',
            post_id : post_id
        };
        if (confirm('Are you sure to Delete?')) {
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                alert(response);
                location.reload(true);
                
            },
            dataType: 'html'
        });
        return false;
        }else{
            alert('Code is not deleted.');
        }
    });

    jQuery(document).on("click","#search-batch-code", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        var validflag = true;
        var search_val = jQuery('#search-input').val();
        
        if(jQuery('#search-input').val().trim()=="" ){
            jQuery('#search-input').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#search-input' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#search-input').css({'color':'#333333'});
        }

        var data = {
            action: 'search_batch_code',
            search_val : search_val
        };
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    // console.log(response);
                    jQuery('#the-list').html('');
                    jQuery('#the-list').html(response);
                },
                dataType: 'html'
            });
        return false;
        }
    });

    jQuery(document).on("click","#search-individual-code", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        var validflag = true;
        var search_val = jQuery('#individual-search-input').val();
        
        if(jQuery('#individual-search-input').val().trim()=="" ){
            jQuery('#individual-search-input').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#individual-search-input' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#individual-search-input').css({'color':'#333333'});
        }

        var data = {
            action: 'search_individual_code',
            search_val : search_val
        };
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    // console.log(response);
                    jQuery('#the-list').html('');
                    jQuery('#the-list').html(response);
                },
                dataType: 'html'
            });
        return false;
        }
    });

    jQuery(document).on("focus","#search-input,#individual-search-input", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("keypress","#search-input", function(e) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            e.preventDefault();
            jQuery('.error').remove();

        var validflag = true;
        var search_val = jQuery('#search-input').val()
        
        if(jQuery('#search-input').val().trim()=="" ){
            jQuery('#search-input').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#search-input' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#search-input').css({'color':'#333333'});
        }

        var data = {
            action: 'search_batch_code',
            search_val : search_val
        };
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    // console.log(response);
                    jQuery('#the-list').html('');
                    jQuery('#the-list').html(response);
                },
                dataType: 'html'
            });
        return false;
        }
        }
    });

    jQuery(document).on("keypress","#individual-search-input", function(e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            e.preventDefault();
            jQuery('.error').remove();
            var validflag = true;
            var search_val = jQuery('#individual-search-input').val();
            
            if(jQuery('#individual-search-input').val().trim()=="" ){
                jQuery('#individual-search-input').css({'border':'1px solid #ff0000','color':'#ff0000'});
                jQuery( '#individual-search-input' ).after( "<span class='error'>This field is required.</span>" );
                validflag = false;
            }else{
                jQuery('#individual-search-input').css({'color':'#333333'});
            }
    
            var data = {
                action: 'search_individual_code',
                search_val : search_val
            };
            if(!validflag){
                return validflag;
            }else{
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        // console.log(response);
                        jQuery('#the-list').html('');
                        jQuery('#the-list').html(response);
                    },
                    dataType: 'html'
                });
            return false;
            }
        }
    });

    var view_customer_table = jQuery('#view_customer_table').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        "order": [[ 17, "desc" ]],
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'csv',
                //Name the CSV
                filename: 'customer_list',
               exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                filename: 'customer_list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                        // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'customer_list',
                 exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                        // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'customer_list',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                 exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13 ]
                        // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '5px');
                    
                }
            }
        ]
        // filename: 'dealer_list',
    } );

     // search fileter for view_customer_table
    jQuery('#view_customer_table_filter input').unbind().bind('keyup', function() {
      var colIndex = document.querySelector('#view-customer-table-select').selectedIndex;
        var val = jQuery.fn.dataTable.util.escapeRegex(
                            jQuery(this).val()
                        );
      view_customer_table.column( colIndex).search( val ? '^'+val+'$' : '', true, false ).draw();
    });
    
    jQuery('#view-customer-table-select').change(function() {
        view_customer_table.columns().search('').draw();
    });





    // update dealer
    jQuery(document).on("click","#pmsafe_customer_update", function(e) {
        // alert('in');
       e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        //Name
        if(jQuery('#pmsafe_customer_fname' ).val().trim()=="" ){
            jQuery('#pmsafe_customer_fname' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_fname').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_fname').css({'color':'#333333'});
        }

        if(jQuery('#pmsafe_customer_lname' ).val().trim()=="" ){
            jQuery('#pmsafe_customer_lname' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_lname').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_lname').css({'color':'#333333'});
        }

        if(jQuery('#pmsafe_customer_address1' ).val().trim()=="" ){
            jQuery('#pmsafe_customer_address1' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_address1').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_address1').css({'color':'#333333'});
        }

        // if(jQuery('#pmsafe_customer_address2' ).val().trim()=="" ){
        //     jQuery('#pmsafe_customer_address2' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
        //     jQuery( '#pmsafe_customer_address2').after( "<span class='error'>This field is required.</span>" );
        //     validflag = false;
        // }else{
        //     jQuery('#pmsafe_customer_address2').css({'color':'#333333'});
        // }
        
        //city
        if(jQuery('#pmsafe_customer_city').val().trim()=="" ){
            jQuery('#pmsafe_customer_city').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_city' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_city').css({'color':'#333333'});
        }

         //state
         if(jQuery('#pmsafe_customer_state').val().trim()=="" ){
            jQuery('#pmsafe_customer_state').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_state' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_state').css({'color':'#333333'});
        }
        //password
        //  if(jQuery('#pmsafe_customer_password').val().trim()=="" ){
        //     jQuery('#pmsafe_customer_password').css({'border':'1px solid #ff0000','color':'#ff0000'});
        //     jQuery( '#pmsafe_customer_password' ).after( "<span class='error'>This field is required.</span>" );
        //     validflag = false;
        // }else{
        //     jQuery('#pmsafe_customer_password').css({'color':'#333333'});
        // }

        
        //zip code
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_customer_zip').val().trim() == ''){            
            jQuery('#pmsafe_customer_zip').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_zip' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#pmsafe_customer_zip').val().match(numbers))){
            jQuery('#pmsafe_customer_zip').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_zip' ).after( "<span class='error'>Please enter valid zip code.</span>" );
            validflag = false;
        }
        else{
            jQuery('#pmsafe_customer_zip').css({'border-color':'#cccccc'});
        }

        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_customer_phone_number').val().trim() == ''){
            jQuery('#pmsafe_customer_phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#pmsafe_customer_phone_number').val().match(numbers))){
            jQuery('#pmsafe_customer_phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_phone_number').css({'border-color':'#cccccc'});
        }
        
        //vehicle year
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_customer_vehicle_year').val().trim() == ''){
            jQuery('#pmsafe_customer_vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#pmsafe_customer_phone_number').val().match(numbers))){
            jQuery('#pmsafe_customer_phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_phone_number').css({'border-color':'#cccccc'});
        }

         //vehicle year
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_customer_vehicle_year').val().trim() == ''){
            jQuery('#pmsafe_customer_vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#pmsafe_customer_phone_number').val().match(numbers))){
            jQuery('#pmsafe_customer_phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_phone_number' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_phone_number').css({'border-color':'#cccccc'});
        }

         //vehicle mileage
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_customer_vehicle_mileage').val().trim() == ''){
             jQuery('#pmsafe_customer_vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
             jQuery( '#pmsafe_customer_vehicle_mileage' ).after( "<span class='error'>This field is required.</span>" );
             validflag = false;
        }else if(!(jQuery('#pmsafe_customer_vehicle_mileage').val().match(numbers))){
             jQuery('#pmsafe_customer_vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
             jQuery( '#pmsafe_customer_vehicle_mileage' ).after( "<span>Please enter valid mileage.</span>" );
             validflag = false;
        }else{
            jQuery('#pmsafe_customer_vehicle_mileage').css({'border-color':'#cccccc'});
        }
        
        //vehicle make
        if(jQuery('#pmsafe_customer_vehicle_make').val().trim()=="" ){
            jQuery('#pmsafe_customer_vehicle_make').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_vehicle_make' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_vehicle_make').css({'color':'#333333'});
        }

        //vehicle model
        if(jQuery('#pmsafe_customer_vehicle_model').val().trim()=="" ){
            jQuery('#pmsafe_customer_vehicle_model').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_vehicle_model' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_vehicle_model').css({'color':'#333333'});
        }

        //vehicle vin
        if(jQuery('#pmsafe_customer_vehicle_vin').val().trim()=="" ){
            jQuery('#pmsafe_customer_vehicle_vin').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_customer_vehicle_vin' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_customer_vehicle_vin').css({'color':'#333333'});
        }

        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_customer_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_edit_customer_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    
                    if( obj.status == true ){
                        // console.log(obj.redirect);
                        window.location.replace(obj.redirect);
                        // location.reload();
                        jQuery('.notice').css('display','block');
                    }
                    if(obj.status == false){
                        
                        jQuery( '#file_upload' ).after( "<span class='error'>"+obj.error+"</span>" );
                    }
                }
            });// ajax
          return false;
        }
    });  // update button 

      // Focus and blure 
      jQuery('#pmsafe_customer_fname, #pmsafe_customer_lname, #pmsafe_customer_address1, #pmsafe_customer_address2, #pmsafe_customer_city, #pmsafe_customer_state, #pmsafe_customer_zip, #pmsafe_customer_phone_number, #pmsafe_customer_vehicle_year, #pmsafe_customer_vehicle_make, #pmsafe_customer_vehicle_model, #pmsafe_customer_vehicle_vin, #pmsafe_customer_vehicle_mileage, #pmsafe_customer_password ').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_customer_fname, #pmsafe_customer_lname, #pmsafe_customer_address1, #pmsafe_customer_address2, #pmsafe_customer_city, #pmsafe_customer_state, #pmsafe_customer_zip, #pmsafe_customer_phone_number, #pmsafe_customer_vehicle_year, #pmsafe_customer_vehicle_make, #pmsafe_customer_vehicle_model, #pmsafe_customer_vehicle_vin, #pmsafe_customer_vehicle_mileage, #pmsafe_customer_password').blur(function(){
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

     // delete dealer customer
     jQuery(document).on("click","#pmsafe_customer_delete", function(e) {
        // alert('in');
       e.preventDefault();
        
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_delete_customer_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_delete_customer_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    // console.log(obj.redirect);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        
    });  // delete button

     // delete customer
     jQuery(document).on("click","#pmsafe_customers_delete", function(e) {
        // alert('in');
       e.preventDefault();
        
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_delete_customers_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_delete_customers_form');
            
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                    }
                }
            });// ajax
          return false;
        
    });  // delete button

    jQuery(document).on("click","#search_submit", function(e) {
        var dealer_login     = jQuery('#dealer_login').val();
        var member_code     = jQuery('#member_code').val();
        var first_name      = jQuery('#first_name').val();
        var last_name       = jQuery('#last_name').val();
        var address         = jQuery('#address').val();
        var phone_number    = jQuery('#phone_number').val();
        var email           = jQuery('#email').val();
        var city            = jQuery('#city').val();
        var state           = jQuery('#state').val();
        var zip_code        = jQuery('#zip_code').val();
        var plan_id         = jQuery('#plan_id').val();
        var dealer_name     = jQuery('#dealer_name').val();
        var vehicle_year    = jQuery('#vehicle_year').val();
        var vehicle_make    = jQuery('#vehicle_make').val();
        var vehicle_model   = jQuery('#vehicle_model').val();
        var vehicle_vin     = jQuery('#vehicle_vin').val();



        var data = {
            action: 'admin_reports',
            dealer_login : dealer_login,
            member_code : member_code,
            first_name : first_name,
            last_name : last_name,
            address : address,
            phone_number : phone_number,
            email : email,
            city : city,
            state : state,
            zip_code : zip_code,
            plan_id : plan_id,
            dealer_name : dealer_name,
            vehicle_year : vehicle_year,
            vehicle_make : vehicle_make,
            vehicle_model : vehicle_model,
            vehicle_vin : vehicle_vin

        };
        jQuery('.perma-admin-loader').show();
 
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('.tbl-result-wrap').html('');
                jQuery('.data-result-wrap').html('');
                jQuery('.tbl-result-wrap').html(response);
                
               jQuery('#search_tbl').DataTable( {
                        dom: 'Bfrtip',
                        orderCellsTop: true,
                        fixedHeader: true,
                        buttons: [
                            {
                                extend: 'csv',
                                //Name the CSV
                                filename: 'reports',
                                exportOptions: {
                                        columns: [0,1,2,3,5]
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                filename: 'reports',
                                exportOptions: {
                                        columns: [0,1,2,3,5]
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'EXCEL',
                                filename: 'reports',
                                exportOptions: {
                                        columns: [0,1,2,3,5]
                                },
                            },
                            {
                                extend: 'print',
                                text: 'PRINT',
                                filename: 'reports',
                                exportOptions: {
                                        columns: [0,1,2,3,5]
                                },
                                customize: function (win) {
                                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');
                                    
                                }
                            }
                        ]
                        // filename: 'dealer_list',
                    } );
                

            },
            
        });

    });


    jQuery(document).on("click",".view-data", function(e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id")

         var data = {
            action: 'admin_view_data_reports',
            id : id,

        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('.data-result-wrap').html('');
                jQuery('.data-result-wrap').append(response);
                
            },
            
        });
        
    });

    jQuery(document).on("click","#search_reset", function(e) {
        location.reload();     
    });

    // search all customers 
    jQuery(document).on("click","#search_all_submit", function(e) {
        
        var member_code     = jQuery('#member_code').val();
        var first_name      = jQuery('#first_name').val();
        var last_name       = jQuery('#last_name').val();
        var address         = jQuery('#address').val();
        var phone_number    = jQuery('#phone_number').val();
        var email           = jQuery('#email').val();
        var city            = jQuery('#city').val();
        var state           = jQuery('#state').val();
        var zip_code        = jQuery('#zip_code').val();
        var plan_id         = jQuery('#plan_id').val();
        var dealer_name     = jQuery('#pmsafe_dealer').val();
        var distributor_name     = jQuery('#pmsafe_distributor').val();
        var vehicle_year    = jQuery('#vehicle_year').val();
        var vehicle_make    = jQuery('#vehicle_make').val();
        var vehicle_model   = jQuery('#vehicle_model').val();
        var vehicle_vin     = jQuery('#vehicle_vin').val();

        


        var data = {
            action: 'admin_all_reports',
            member_code : member_code,
            first_name : first_name,
            dealer_name : dealer_name,
            distributor_name : distributor_name,
            last_name : last_name,
            address : address,
            phone_number : phone_number,
            email : email,
            city : city,
            state : state,
            zip_code : zip_code,
            plan_id : plan_id,
            dealer_name : dealer_name,
            vehicle_year : vehicle_year,
            vehicle_make : vehicle_make,
            vehicle_model : vehicle_model,
            vehicle_vin : vehicle_vin

        };
        jQuery('.perma-admin-loader').show();
 
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('.tbl-result-wrap').html('');
                jQuery('.data-result-wrap').html('');
                jQuery('.tbl-result-wrap').html(response);
                
               jQuery('#search_tbl').DataTable( {
                        dom: 'Bfrtip',
                        orderCellsTop: true,
                        fixedHeader: true,
                        buttons: [
                            {
                                extend: 'csv',
                                //Name the CSV
                                filename: 'reports',
                                exportOptions: {
                                        columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                filename: 'reports',
                                exportOptions: {
                                    columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'EXCEL',
                                filename: 'reports',
                                exportOptions: {
                                    columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                },
                            },
                            {
                                extend: 'print',
                                text: 'PRINT',
                                filename: 'reports',
                                exportOptions: {
                                    columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                },
                                customize: function (win) {
                                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');
                                    
                                }
                            }
                        ]
                        // filename: 'dealer_list',
                    } );
                

            },
            
        });

    });

    //quick filters
    jQuery(document).on("click","#date_submit", function(e) {
        jQuery('.error').remove();
        var validflag = true;
        var datepicker1 = jQuery('#datepicker1').val();
        
        var datepicker2 = jQuery('#datepicker2').val();
        var select = jQuery('#quick_filters').val();
        var select = jQuery('#quick_filters').val();
        var dealer_name     = jQuery('#pmsafe_dealer').val();
        var distributor_name     = jQuery('#pmsafe_distributor').val();
        // alert(select);

        if(jQuery('#datepicker1').val().trim()=="" ){
            jQuery('#datepicker1').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#datepicker1' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#datepicker1').css({'color':'#333333'});
        }

        if(jQuery('#datepicker2').val().trim()=="" ){
            jQuery('#datepicker2').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#datepicker2' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#datepicker2').css({'color':'#333333'});
        }

        if(jQuery('#quick_filters').val().trim()=="0" ){
            jQuery('#quick_filters').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#quick_filters' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#quick_filters').css({'color':'#333333'});
        }

        var data = {
            action: 'admin_quick_filters',
            datepicker1 : datepicker1,
            datepicker2 : datepicker2,
            select : select,
            dealer_name : dealer_name,
            distributor_name : distributor_name

        };
        
        jQuery('.perma-admin-loader').show();
        if(!validflag){
            jQuery('.perma-admin-loader').hide();
            return validflag;
        }else{
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    jQuery('.tbl-result-wrap').html('');
                    jQuery('.data-result-wrap').html('');
                    jQuery('.tbl-result-wrap').html(response);

                    jQuery('#search_tbl').DataTable( {
                            dom: 'Bfrtip',
                            orderCellsTop: true,
                            fixedHeader: true,
                            buttons: [
                                {
                                    extend: 'csv',
                                    //Name the CSV
                                    filename: 'quick_filters',
                                    exportOptions: {
                                            columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                    },
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    orientation : 'landscape',
                                    pageSize : 'LEGAL',
                                    filename: 'quick_filters',
                                    exportOptions: {
                                        columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                    },
                                },
                                {
                                    extend: 'excel',
                                    text: 'EXCEL',
                                    filename: 'quick_filters',
                                    exportOptions: {
                                        columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'PRINT',
                                    filename: 'quick_filters',
                                    exportOptions: {
                                        columns: [0,1,2,3,5,6,7,8,9,10,11,12,13]
                                    },
                                    customize: function (win) {
                                        jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');
                                        
                                    }
                                }
                            ]
                            // filename: 'dealer_list',
                        } );
                    
                },
                
            });
             return false;
        }
         // alert(datepicker1 + ' ' + datepicker2 + ' ' + select);
    });

    jQuery(document).on("change","#quick_filters", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();

        // jQuery('#datepicker1').removeAttr("disabled");
        // jQuery('#datepicker2').removeAttr("disabled");
        jQuery("#datepicker1").remove();
        jQuery("#datepicker2").remove();

        var select = jQuery(this).val();
        
        if( select == 0 ){
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                
            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                
                
            });
        }

        if( select == 1 ){
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: 0
            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: 0
            });
        }
        if( select == 2 ){
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                maxDate: "+6m"
            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: 0,
                maxDate: "+6m"
            });
        }
        if( select == 3 ){
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                
            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',
                
                
            });
        }
    });

    jQuery(document).on("focus","#datepicker1,#membership_datepicker1", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    


    jQuery(document).on("focus","#datepicker2,#membership_datepicker2", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

    jQuery('#pmsafe_invitation_upgradable_prefix').select2({
        placeholder: 'Select Package'
    });	

    
    jQuery('input[name="pmsafe_invitation_code_upgradable"]').click(function () {
        if(jQuery(this). prop("checked") == true){

        
        var select_val = jQuery('#pmsafe_invitation_prefix').val();
            
            var data = {
                action: 'upgradable_dropdown',
                select_val : select_val,
            };

            
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                 
                    jQuery('#pmsafe_invitation_upgradable_prefix').html('');
                    jQuery('#pmsafe_invitation_upgradable_prefix').append(response);
                    
                },
                
            });
            jQuery('#upgrade_tr').removeAttr("style");
        }
        else{
            jQuery('#upgrade_tr').css("display","none");
        }
    });

    jQuery(document).on("change","#pmsafe_invitation_prefix", function(e) {
        var select_val = jQuery('#pmsafe_invitation_prefix').val();
        var data = {
            action: 'upgradable_dropdown',
            select_val : select_val,
        };

        
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
        
                jQuery('#pmsafe_invitation_upgradable_prefix').html('');
                jQuery('#pmsafe_invitation_upgradable_prefix').append(response);
                
            },
            
        });
    });

    var mebership_info_table = jQuery('#mebership_info_table').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                
                extend: 'csv',
                //Name the CSV
                filename: 'mebership_info',
               exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7 ]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                filename: 'mebership_info',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7 ]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'mebership_info',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7 ]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'mebership_info',
                
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7 ]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');
                    
                }
            }


        ]
       
    } );
    jQuery( "#membership_datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    jQuery( "#membership_datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
    jQuery(document).on("click","#membership_date_submit", function(e) {
        jQuery('.error').remove();
        var validflag = true;

        var datepicker1 = jQuery('#membership_datepicker1').val();
        var datepicker2 = jQuery('#membership_datepicker2').val();
        var dealer     = jQuery('#pmsafe_dealer').val();
        var distributor     = jQuery('#pmsafe_distributor').val();
        var policy     = jQuery('#policy').val();
        var package     = jQuery('#benefit_packages').val();
      
        // alert(dealer + distributor);
            var data = {
                action : 'admin_membership_date_filter',
                // membership_login_id : membership_login_id,
                datepicker1 : datepicker1,
                datepicker2 : datepicker2,
                dealer : dealer,
                distributor : distributor,
                policy : policy,
                package : package
            }
        
        if(jQuery('#membership_datepicker1').val().trim()=="" ){
            jQuery('#membership_datepicker1').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#membership_datepicker1' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#membership_datepicker1').css({'color':'#333333'});
        }

        if(jQuery('#membership_datepicker2').val().trim()=="" ){
            jQuery('#membership_datepicker2').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#membership_datepicker2' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#membership_datepicker2').css({'color':'#333333'});
        }
        
        if(policy != '' && package == ''){
                jQuery('#benefit_packages').css({'border':'1px solid #ff0000','color':'#ff0000'});
                jQuery( '#benefit_packages' ).after( "<span class='error'>This field is required.</span>" );
                validflag = false;
        }else{
            jQuery('#benefit_packages').css({'color':'#333333'});
        }

        jQuery('.perma-admin-loader').show();
        if(!validflag){
            jQuery('.perma-admin-loader').hide();
            return validflag;
        }else{
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    jQuery('.membership-result-wrap').html('');
                    jQuery('.membership-result-wrap').html(response);
                    jQuery('#mebership_date_table').DataTable( {
                        dom: 'Bfrtip',
                        responsive: true,
                        orderCellsTop: true,
                        fixedHeader: true,
                        buttons: [
                            {
                                
                                extend: 'csv',
                                //Name the CSV
                                filename: 'mebership_info',
                                exportOptions: {
                                        columns: [0, 1, 2,3, 4, 5, 6, 7 ]
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                filename: 'mebership_info',
                                orientation : 'landscape',
                                pageSize : 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2,3, 4, 5, 6, 7 ]
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'EXCEL',
                                filename: 'mebership_info',
                                exportOptions: {
                                    columns: [0, 1, 2,3, 4, 5, 6, 7 ]
                                },
                            },
                            {
                                extend: 'print',
                                text: 'PRINT',
                                filename: 'mebership_info',
                                
                                exportOptions: {
                                    columns: [0, 1, 2,3, 4, 5, 6, 7 ]
                                },
                                customize: function (win) {
                                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');
                                    
                                }
                            }


                        ]
                        // filename: 'dealer_list',
                    } );
                  
                },
                
            });
        }
        
    });

    jQuery(document).on("click","#add_price", function(e) {
        jQuery("#price-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
    });
    jQuery(document).on("click","#add_package_price", function(e) {
        
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        var selected_package = jQuery('#pmsafe_invitation_prefix' ).val();
        var dealer_cost = jQuery('#dealer_cost' ).val();
        var distributor_cost = jQuery('#distributor_cost' ).val();
        var selling_price = jQuery('#selling_price' ).val();
        var dealer_id = jQuery('#pricing_dealer_id' ).val();

        
        if(jQuery('#pmsafe_invitation_prefix' ).val().trim()=="" ){
            jQuery('#pmsafe_invitation_prefix' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_invitation_prefix').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_invitation_prefix').css({'color':'#333333'});
        }
        
        if(jQuery('#dealer_cost' ).val().trim()=="" ){
            jQuery('#dealer_cost' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#dealer_cost').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#dealer_cost').css({'color':'#333333'});
        }
        
        if(jQuery('#distributor_cost' ).val().trim()=="" ){
            jQuery('#distributor_cost' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#distributor_cost').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#distributor_cost').css({'color':'#333333'});
        }
        
        if(jQuery('#selling_price' ).val().trim()=="" ){
            jQuery('#selling_price' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#selling_price').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#selling_price').css({'color':'#333333'});
        }

        var data = {
            action: 'add_dealer_benefits_package_price',
            selected_package:selected_package,
            dealer_cost:dealer_cost,
            distributor_cost:distributor_cost,
            selling_price:selling_price,
            dealer_id:dealer_id

        };

        if(!validflag){
            return validflag;
        }else{
    		jQuery('.perma-admin-loader').show();
            
             jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                        
                        if(response == 0){
                            jQuery('#exist-package').remove();
                            jQuery('<p id="exist-package" style="color:red;">Already Exist.</p>').insertBefore('#add_package_price');
                        }
                        if(response == 1){
                            location.reload();
                        }
                        
                   
                }
            });// ajax
          return false;
        }
    });

  
   
    jQuery(document).on("change","#pmsafe_invitation_prefix", function(e) {
        jQuery('#exist-package').remove();
    });

    jQuery(document).on("click","#delete_price", function(e) {
        var package = jQuery(this).attr('data-id');
        var dealer_id = jQuery('#pricing_dealer_id' ).val();
        
        var data = {
            action: 'delete_dealer_benefits_package_price',
            package:package,
            dealer_id:dealer_id
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function(response) {
                jQuery('.perma-admin-loader').hide();
                       location.reload();
            }
        });// ajax
    });

    jQuery(document).on("click","#edit_price", function(e) {
        jQuery("#edit-price-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
        var package = jQuery(this).attr('data-id');
        var option = '<option value="'+package+'">'+package+'</option>';
        
        jQuery('#edit_pmsafe_invitation_prefix').html('');
        jQuery('#edit_pmsafe_invitation_prefix').append(option);
    });
    
    jQuery(document).on("click","#update_package_price", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        var selected_package = jQuery('#edit_pmsafe_invitation_prefix' ).val();
        var dealer_cost = jQuery('#edit_dealer_cost' ).val();
        var distributor_cost = jQuery('#edit_distributor_cost' ).val();
        var selling_price = jQuery('#edit_selling_price' ).val();
        var dealer_id = jQuery('#pricing_dealer_id' ).val();
              
        if(jQuery('#edit_dealer_cost' ).val().trim()=="" ){
            jQuery('#edit_dealer_cost' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#edit_dealer_cost').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#edit_dealer_cost').css({'color':'#333333'});
        }
        
        if(jQuery('#edit_distributor_cost' ).val().trim()=="" ){
            jQuery('#edit_distributor_cost' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#edit_distributor_cost').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#edit_distributor_cost').css({'color':'#333333'});
        }
        
        if(jQuery('#edit_selling_price' ).val().trim()=="" ){
            jQuery('#edit_selling_price' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#edit_selling_price').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#edit_selling_price').css({'color':'#333333'});
        }
         var data = {
            action: 'edit_dealer_benefits_package_price',
            selected_package:selected_package,
            dealer_cost:dealer_cost,
            distributor_cost:distributor_cost,
            selling_price:selling_price,
            dealer_id:dealer_id
        };
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                        location.reload();
                }
            });// ajax
        }
    });

    jQuery(document).on("focus","#pmsafe_dealer_contact_fname,#pmsafe_dealer_contact_lname,#pmsafe_dealer_contact_phone,#pmsafe_dealer_contact_email,#pmsafe_dealer_contact_password,#benefit_packages,#distributor_cost,#dealer_cost,#selling_price,#pmsafe_invitation_prefix,#edit_distributor_cost,#edit_dealer_cost,#edit_selling_price", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("change","#policy", function(e) {
        var select_val = jQuery(this).val();
        if(select_val == ''){
            jQuery('.filter-package').css('display','none');
        }else{
            jQuery('.filter-package').removeAttr('style')
        }
    });

    
    jQuery(document).on("click","#add_contact_person", function(e) {
        jQuery("#contact-person-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
    });

    jQuery(document).on("click","#add_new_contact_person", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        var fname = jQuery('#pmsafe_dealer_contact_fname' ).val();
        var lname = jQuery('#pmsafe_dealer_contact_lname' ).val();
        var phone = jQuery('#pmsafe_dealer_contact_phone' ).val();
        var email = jQuery('#pmsafe_dealer_contact_email' ).val();
        var password = jQuery('#pmsafe_dealer_contact_password' ).val();
        var dealer_id = jQuery('#pricing_dealer_id' ).val();
              
        if(jQuery('#pmsafe_dealer_contact_fname' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_contact_fname' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_fname').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_contact_fname').css({'color':'#333333'});
        }
        
        if(jQuery('#pmsafe_dealer_contact_lname' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_contact_lname' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_lname').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_contact_lname').css({'color':'#333333'});
        }
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('#pmsafe_dealer_contact_phone').val().trim() == ''){
            jQuery('#pmsafe_dealer_contact_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_phone' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#pmsafe_dealer_contact_phone').val().match(numbers))){
            jQuery('#pmsafe_dealer_contact_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_phone' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_contact_phone').css({'border-color':'#cccccc'});
        }
        
        if(jQuery('#pmsafe_dealer_contact_email' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_contact_email' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_email').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_contact_email').css({'color':'#333333'});
        }
        
        if(jQuery('#pmsafe_dealer_contact_password' ).val().trim()=="" ){
            jQuery('#pmsafe_dealer_contact_password' ).css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#pmsafe_dealer_contact_password').after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#pmsafe_dealer_contact_password').css({'color':'#333333'});
        }

         var data = {
            action: 'add_dealer_contact_information',
            fname:fname,
            lname:lname,
            phone:phone,
            email:email,
            password:password,
            dealer_id:dealer_id
        };
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function(response) {
                    jQuery('.perma-admin-loader').hide();
                        location.reload();
                }
            });// ajax
        }
    });

});// ready

