// A $( document ).ready() block.
jQuery( document ).ready(function() {    
    // console.log( "Ajax "+pmAjax.ajaxurl );
    
    
    var pop_val = jQuery('#reset_pass_popup').val();
    if(pop_val == 1){

        setTimeout(function(){ 
        jQuery('.pum-container').css('display','none');

    }, 700);
            
    }

    jQuery(document).on("click","#pmsafe_next", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        // var is_upgradable = jQuery('#is_upgradable').val();
        
        
        
        var validflag = true;
         //Member Name
        if(jQuery('#member_number').val().trim()=="" ){
            jQuery('#member_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#member_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#member_number').css({'color':'#333333'});
        }

        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_register_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_registration_code_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
//                    console.log(response);
                    jQuery('.perma-loader').hide();
                    
                    var obj = jQuery.parseJSON(response);
                    // console.log('yes'+obj.option);
                    if( obj.status == true ){
                        jQuery('#pmsafe-response').remove();
                        jQuery('#member_code_div').css('display','none');
                        // jQuery('#pmsafe_next').css('display','none');
                        jQuery('#pmsafe_next').remove();
                        jQuery('#member_number').val(obj.code);
                        if(obj.is_upgradable == 1){
                           jQuery('#dialog').removeAttr('style');
                            
                            // jQuery('#upgradable_package_div').removeAttr('style');
                            jQuery('#dialog_upgrade').before('<input type="hidden" value="'+obj.package+'" id="get_package"><input type="hidden" value="'+obj.code_id+'" id="get_code_id">');
                            // jQuery('#select_upgradable_package').append(obj.option);
                           
                        }else{
                            if(obj.html){
                                jQuery('#hidden_form').before(obj.html);
                            }else{
                                jQuery('#hidden_form').html('<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><input type="submit" id="pmsafe_submit" value="Send">');
                            }
                        }
                    }else{
                            
                        jQuery('#pmsafe-response').html(obj.message);
                    }           
                }
            });
            return false;
        }
    });
    jQuery(document).on("click","#dialog_upgrade", function(e) {
        jQuery('.perma-loader').show();
            var form = jQuery('#perma_register_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_registration_code_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                    jQuery('.perma-loader').hide();
                    
                    var obj = jQuery.parseJSON(response);
                    // console.log('yes'+obj.option);
                    if( obj.status == true ){
                        jQuery('#dialog').css('display','none');
                        jQuery('#upgradable_package_div').removeAttr('style');
                        jQuery('#upgradable_package_div').before('<h3>Change Benefit Package for Code : '+ obj.code +'</h3>');
                        jQuery('#select_upgradable_package').append(obj.option);
                    }
                }
            });
        
    });
    
    jQuery(document).on("click","#dialog_upgrade_no", function(e) {
        jQuery('#dialog').css('display','none');
        
        var package = jQuery('#get_package').val();
        var code_id = jQuery('#get_code_id').val();
        var data ={
            action : 'check_no_coverage_policy',
            package : package,
            code_id : code_id
            
        }
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-loader').hide();
                if(response != 1){
                    jQuery('#hidden_form').before(response);
                }
                if(response == 1){
                    jQuery('#hidden_form').html('<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><input type="submit" id="pmsafe_submit" value="Send">');
                }
                
            },
        });
         
    });

    jQuery(document).on("click","#salesperson_update_prefix", function(e) {
        jQuery('#salesperson_benefits_package_div').css('display','none');
        jQuery('#hidden_form').html('<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><input type="submit" id="pmsafe_submit" value="Send">');
                 
    });

    jQuery(document).on("click","#pmsafe_skip_price", function(e) {
        jQuery('#update_package_price').css('display','none');
         jQuery('#hidden_form').html('<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><input type="submit" id="pmsafe_submit" value="Send">');
    });

    jQuery(document).on("change","#select_upgradable_package", function(e) {
        var select = jQuery('#select_upgradable_package').val();
        if(select == 0){
            jQuery('#pmsafe_update_prefix').attr('value','Skip');
        }else{
            jQuery('#pmsafe_update_prefix').attr('value','Update');
        }
    });

    
    jQuery(document).on("click","#pmsafe_update_prefix", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        var select = jQuery('#select_upgradable_package').val();
        var code = jQuery('#member_number').val();
        var login_id = jQuery('#login_id').val();
        var data = {
            action : 'update_benefit_package',
            code : code,
            select : select,
            login_id : login_id
        }
            jQuery('.perma-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    
                    
                    var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        jQuery('#member_code_div').css('display','none');
                        jQuery('#change_benefits_package').css('display','none');
                        jQuery('#change_benefits_package_price').removeAttr('style');
                        if(obj.msg){
                            jQuery('#hidden_form').before('<p style="color: #038503;background-color: #c6f2c6;border-color: #ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">'+obj.msg+'</p>');
                        }
                        var package = obj.package;
                        var code_id = obj.code_id;

                        var data ={
                            action : 'get_benefit_package_price',
                            package : package,
                            code_id : code_id
                        }
                        
                        jQuery.ajax({
                            type: 'POST',
                            url: pmAjax.ajaxurl,
                            data: data,
                            dataType: 'html',
                            success: function (response) {
                                jQuery('.perma-loader').hide();
                                jQuery('#hidden_form').before(response);
                            },
                        });
    
                    }
                },
                
            });
            return false;
    });

    jQuery(document).on("click","#pmsafe_update_price", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        var selling_price = jQuery('#selling_price').val();
        var package = jQuery('#get_package').val();
        var code_id = jQuery('#get_code_id').val();
        var login_id = jQuery('#login_id').val();
        var validflag = true;

        var data ={
            action : 'update_benefit_package_price',
            selling_price : selling_price,
            package : package,
            code_id : code_id,
            login_id : login_id
        }
        //Selling price
       if(jQuery('#selling_price').val().trim()=="" ){
           jQuery('#selling_price').css({'border':'1px solid #ff0000','color':'#ff0000'});
           jQuery( '#selling_price' ).after( "<span class='error'>This field is required.</span>" );
           validflag = false;
       }else{
           jQuery('#selling_price').css({'color':'#333333'});
       }

       if(!validflag){
           return validflag;
       }else{
           
            jQuery('.perma-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    
                    jQuery('.perma-loader').hide();

                    var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        
                        jQuery('#member_code_div').css('display','none');
                        jQuery('#change_benefits_package').css('display','none');
                        jQuery('#change_benefits_package_price').removeAttr('style');
                        jQuery('#update_package_price').css('display','none');
                        if(obj.msg){
                            jQuery('#hidden_form').before('<p style="color: #038503;background-color: #c6f2c6;border-color: #ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">'+obj.msg+'.</p>');
                        }
    
                        jQuery('#hidden_form').html('<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><input type="submit" id="pmsafe_submit" value="Send">');
                    }
                },
                
            });
            return false;
       }
    });

    jQuery(document).on("click","#pmsafe_submit", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        
        //Member Name
        if(jQuery('#member_number').val().trim()=="" ){
            jQuery('#member_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#member_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#member_number').css({'color':'#333333'});
        }
        
        //First Name 
        if(jQuery('#first_name').val().trim()=="" ){
            jQuery('#first_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#first_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#first_name').css({'color':'#333333'});
        }
        
        //Last Name 
        if(jQuery('#last_name').val().trim()=="" ){
            jQuery('#last_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#last_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#last_name').css({'color':'#333333'});
        }
        
        //Address
        if(jQuery('#address1').val().trim()=="" ){
            jQuery('#address1').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#address1' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#address1').css({'color':'#333333'});
        }
        
        //city
        if(jQuery('#city').val().trim()=="" ){
            jQuery('#city').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#city' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#city').css({'color':'#333333'});
        }
        
        //state
        if(jQuery('#state').val().trim()=="" ){
            jQuery('#state').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#state' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#state').css({'color':'#333333'});
        }
        
        //zip code
        var numbers = /^[0-9]+$/;
        if(jQuery('#zip_code').val().trim() == ''){            
            jQuery('#zip_code').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#zip_code' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#zip_code').val().match(numbers))){
            jQuery('#zip_code').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#zip_code' ).after( "<span class='error'>Please enter valid zip code.</span>" );
            validflag = false;
        }
        else{
            jQuery('#zip_code').css({'border-color':'#cccccc'});
        }
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('#phone_number').val().trim() == ''){
            jQuery('#phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#phone_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#phone_number').val().match(numbers))){
            jQuery('#phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#phone_number' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#phone_number').css({'border-color':'#cccccc'});
        }
        
        //Email     
        if(jQuery('#email').val().trim() == ''){
            jQuery('#email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#email').val()){
                var email=jQuery("#email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#email').css({'color':'#333333'});
                }
            }
        }
        
        //vehicle year
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_year').val().trim() == ''){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_year').val().match(numbers))){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>Please enter valid year.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_year').css({'border-color':'#cccccc'});
        }
        
        //vehicle make
        if(jQuery('#vehicle_make').val().trim()=="" ){
            jQuery('#vehicle_make').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_make' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_make').css({'color':'#333333'});
        }
        
        //vehicle model
        if(jQuery('#vehicle_model').val().trim()=="" ){
            jQuery('#vehicle_model').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_model' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_model').css({'color':'#333333'});
        }
        
        //vin
        if(jQuery('#vin').val().trim()=="" ){
            jQuery('#vin').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vin' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vin').css({'color':'#333333'});
        }
        
        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_mileage').val().trim() == ''){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_mileage').val().match(numbers))){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span>Please enter valid mileage.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_mileage').css({'border-color':'#cccccc'});
        }
        
        //vehicle type
        if(jQuery('#vehicle_type').val().trim()=="" ){
            jQuery('#vehicle_type').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_type' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_type').css({'color':'#333333'});
        }
        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_register_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_registration_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
//                    console.log(response);
                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        if(obj.sales == true){
                            jQuery("#perma_register_form").html(obj.html);
                        }else{
                            window.location.replace(obj.redirect);
                        }
//                        jQuery("#response").html(obj.redirect);
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
    jQuery(document).on("focus","#selling_price,#vehicle_type,#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage", function(e) {
    // Focus and blure 
    // jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
        // jQuery('#pmsafe-response').remove();
    });
    jQuery(document).on("blur","#selling_price,#vehicle_type,#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage", function(e) {
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    
    jQuery(document).on("click","#pmsafe_pdf_btn", function(e) {
        e.preventDefault();
        
        PrintElem('#perma-warranty-wrapper');
    });
    
});

//generate 2nd pdf

jQuery( document ).ready(function() {    
    // console.log( "Ajax "+pmAjax.ajaxurl );
    
    jQuery(document).on("click","#pmsafe_registered_user_submit", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        var validflag = true;
        
        //Member Name
        if(jQuery('#member_number').val().trim()=="" ){
            jQuery('#member_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#member_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#member_number').css({'color':'#333333'});
        }
       
        //vehicle year
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_year').val().trim() == ''){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_year').val().match(numbers))){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>Please enter valid year.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_year').css({'border-color':'#cccccc'});
        }
        
        //vehicle make
        if(jQuery('#vehicle_make').val().trim()=="" ){
            jQuery('#vehicle_make').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_make' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_make').css({'color':'#333333'});
        }
        
        //vehicle model
        if(jQuery('#vehicle_model').val().trim()=="" ){
            jQuery('#vehicle_model').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_model' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_model').css({'color':'#333333'});
        }
        
        //vin
        if(jQuery('#vin').val().trim()=="" ){
            jQuery('#vin').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vin' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vin').css({'color':'#333333'});
        }
        
        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_mileage').val().trim() == ''){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_mileage').val().match(numbers))){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span>Please enter valid mileage.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_mileage').css({'border-color':'#cccccc'});
        }

        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_registered_user_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_registered_user_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
                   console.log(response);
                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        window.location.replace(obj.redirect);
//                        jQuery("#response").html(obj.redirect);
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
    
    // Focus and blure 
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').blur(function(){
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    
    jQuery(document).on("click","#pmsafe_pdf_btn", function(e) {
        e.preventDefault();
        
        PrintElem('#perma-warranty-wrapper');
    });
    
});


//end generate 2nd pdf 

jQuery( document ).ready(function() {
    
    jQuery(document).on("click","#pmsafe_sales_person_submit", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        
        //Member Name
        if(jQuery('#member_number').val().trim()=="" ){
            jQuery('#member_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#member_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#member_number').css({'color':'#333333'});
        }
        
        //First Name 
        if(jQuery('#first_name').val().trim()=="" ){
            jQuery('#first_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#first_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#first_name').css({'color':'#333333'});
        }
        
        //Last Name 
        if(jQuery('#last_name').val().trim()=="" ){
            jQuery('#last_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#last_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#last_name').css({'color':'#333333'});
        }
        
        //Address
        if(jQuery('#address1').val().trim()=="" ){
            jQuery('#address1').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#address1' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#address1').css({'color':'#333333'});
        }
        
        //city
        if(jQuery('#city').val().trim()=="" ){
            jQuery('#city').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#city' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#city').css({'color':'#333333'});
        }
        
        //state
        if(jQuery('#state').val().trim()=="" ){
            jQuery('#state').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#state' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#state').css({'color':'#333333'});
        }
        
        //zip code
        var numbers = /^[0-9]+$/;
        if(jQuery('#zip_code').val().trim() == ''){            
            jQuery('#zip_code').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#zip_code' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#zip_code').val().match(numbers))){
            jQuery('#zip_code').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#zip_code' ).after( "<span class='error'>Please enter valid zip code.</span>" );
            validflag = false;
        }
        else{
            jQuery('#zip_code').css({'border-color':'#cccccc'});
        }
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('#phone_number').val().trim() == ''){
            jQuery('#phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#phone_number' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#phone_number').val().match(numbers))){
            jQuery('#phone_number').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#phone_number' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('#phone_number').css({'border-color':'#cccccc'});
        }
        
        //Email     
        if(jQuery('#email').val().trim() == ''){
            jQuery('#email').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#email' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            if(jQuery('#email').val()){
                var email=jQuery("#email").val();
                if(!(email.match( /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) )){
                    jQuery('#email').css({'border':'1px solid #ff0000','color':'#ff0000'});
                    jQuery( '#email' ).after( "<span class='error'>Please enter valid email address.</span>" );
                    validflag = false;
                }else{
                    jQuery('#email').css({'color':'#333333'});
                }
            }
        }
        
        //vehicle year
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_year').val().trim() == ''){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_year').val().match(numbers))){
            jQuery('#vehicle_year').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_year' ).after( "<span class='error'>Please enter valid year.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_year').css({'border-color':'#cccccc'});
        }
        
        //vehicle make
        if(jQuery('#vehicle_make').val().trim()=="" ){
            jQuery('#vehicle_make').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_make' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_make').css({'color':'#333333'});
        }
        
        //vehicle model
        if(jQuery('#vehicle_model').val().trim()=="" ){
            jQuery('#vehicle_model').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_model' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_model').css({'color':'#333333'});
        }
        
        //vin
        if(jQuery('#vin').val().trim()=="" ){
            jQuery('#vin').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vin' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('#vin').css({'color':'#333333'});
        }
        
        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if(jQuery('#vehicle_mileage').val().trim() == ''){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('#vehicle_mileage').val().match(numbers))){
            jQuery('#vehicle_mileage').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '#vehicle_mileage' ).after( "<span>Please enter valid mileage.</span>" );
            validflag = false;
        }else{
            jQuery('#vehicle_mileage').css({'border-color':'#cccccc'});
        }
        
        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_salesperson_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'perma_salesperson_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {
//                    console.log(response);
                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if( obj.status == true ){
                        jQuery("#perma_salesperson_form").html(obj.html);
                        jQuery('#pmsafe-response').hide();
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
    
    // Focus and blure 
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').focus(function(){
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').blur(function(){
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });    
    
});

function PrintElem(elem){
    Popup(jQuery(elem).html());
}

function Popup(data){
    var mywindow = window.open('', 'my div', 'height=800,width=900,scrollbars=yes');
    mywindow.document.write('<html><head><title>my div</title>');
    /*optional stylesheet*/ 
    mywindow.document.write('<link rel="stylesheet" href="https://permasafe.net/wp-content/plugins/permasafe-user-pro/public/css/permasafe-user-pro-public.css" type="text/css" />');

    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10

    mywindow.print();
    //mywindow.close();

    return true;
}

//user profile page
jQuery(document).ready(function(){
    // jQuery('form input[type="submit"]').prop("disabled", true);
    jQuery(".btn_nisl_edit").click(function(){
        jQuery('.nisl_name').prop("disabled", false);
        jQuery('.nisl_name').focus();
        jQuery('.nisl_address').prop("disabled", false);
        jQuery('.nisl_state').prop("disabled", false);
        jQuery('.nisl_phone').prop("disabled", false);
        jQuery(".btn_nisl_edit").css("display", "none");
        jQuery("#pmsafe_save_user_info").css("display", "block");

    });

    jQuery(".btn_nisl_dealer_edit").click(function(){
        jQuery('.nisl_name').prop("disabled", false);
        jQuery('.nisl_name').focus();
        
        jQuery('.nisl_fname').prop("disabled", false);
        jQuery('.nisl_fname').focus();
        
        jQuery('.nisl_lname').prop("disabled", false);
        
        jQuery('.nisl_address').prop("disabled", false);
        jQuery('.nisl_fax').prop("disabled", false);
        jQuery('.nisl_phone').prop("disabled", false);
        jQuery(".btn_nisl_dealer_edit").css("display", "none");
        jQuery("#pmsafe_save_dealer_info").css("display", "block");
        jQuery("#pmsafe_save_dealer_user_info").css("display", "block");

    });
 });

jQuery( document ).ready(function() {
    jQuery(document).on("click","#pmsafe_save_user_info", function(e) {
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        
        
        
        //First Name 
        if(jQuery('.nisl_name').val().trim()=="" ){
            jQuery('.nisl_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_name').css({'color':'#333333'});
        }
        
       
        
        //Address
        if(jQuery('.nisl_address').val().trim()=="" ){
            jQuery('.nisl_address').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_address' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_address').css({'color':'#333333'});
        }
        
        //city
        if(jQuery('.nisl_state').val().trim()=="" ){
            jQuery('.nisl_state').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_state' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_state').css({'color':'#333333'});
        }
        
        
        
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('.nisl_phone').val().trim() == ''){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('.nisl_phone').val().match(numbers))){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_phone').css({'border-color':'#cccccc'});
        }
        
        
        
        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_user_info_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_user_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    console.log(obj);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                        jQuery('#pmsafe-response').hide();
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });


    /*dealer edit information*/
    jQuery(document).on("click","#pmsafe_save_dealer_info", function(e) {

        
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        
        
        
        //First Name 
        if(jQuery('.nisl_name').val().trim()=="" ){
            jQuery('.nisl_name').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_name' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_name').css({'color':'#333333'});
        }
        
       
        
        //Address
        if(jQuery('.nisl_address').val().trim()=="" ){
            jQuery('.nisl_address').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_address' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_address').css({'color':'#333333'});
        }

        //Address
        if(jQuery('.nisl_fax').val().trim()=="" ){
            jQuery('.nisl_fax').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_fax' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_fax').css({'color':'#333333'});
        }
        
         
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('.nisl_phone').val().trim() == ''){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('.nisl_phone').val().match(numbers))){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_phone').css({'border-color':'#cccccc'});
        }
        
        
        
        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_dealer_info_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'pmsafe_dealer_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    console.log(obj);
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                        jQuery('#pmsafe-response').hide();
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
   
    /*dealer edit information*/
    jQuery(document).on("click","#pmsafe_save_dealer_user_info", function(e) {

        
        e.preventDefault();
        jQuery('.error').remove();
        
        var validflag = true;
        
        
        
        //First Name 
        if(jQuery('.nisl_fname').val().trim()=="" ){
            jQuery('.nisl_fname').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_fname' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_fname').css({'color':'#333333'});
        }
        
        //First Name 
        if(jQuery('.nisl_lname').val().trim()=="" ){
            jQuery('.nisl_lname').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_lname' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_lname').css({'color':'#333333'});
        }
         
        
        //Phone
        var numbers = /^[0-9]+$/;
        if(jQuery('.nisl_phone').val().trim() == ''){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>This field is required.</span>" );
            validflag = false;
        }else if(!(jQuery('.nisl_phone').val().match(numbers))){
            jQuery('.nisl_phone').css({'border':'1px solid #ff0000','color':'#ff0000'});
            jQuery( '.nisl_phone' ).after( "<span class='error'>Please enter valid phone number.</span>" );
            validflag = false;
        }else{
            jQuery('.nisl_phone').css({'border-color':'#cccccc'});
        }
        
        
        
        
        if(!validflag){
            return validflag;
        }else{
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_dealer_user_info_form')[0];
            var fd = new FormData(form);
            fd.append( 'action', 'perma_dealer_user_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function(response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    
                    if( obj.status == true ){
                        
                        window.location.replace(obj.redirect);
                        jQuery('#pmsafe-response').hide();
                    }else{
                        
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });

});

// jQuery( document ).ready(function() {
//     jQuery('#easyPaginate').easyPaginate({
//     paginateElement: 'div',
//     elementsPerPage: 3,
//     effect: 'climb',
//     prevButtonText : 'Previous',
//     nextButtonText : 'Next'
//     });
// });

jQuery( document ).ready(function() {
    // jQuery('#customertable').paginate({
    //   limit: 5

    // });
    jQuery('#codetable').paginate({
      limit: 5
    });
});



jQuery(document).ready(function() {
    
    /*jQuery('#dealertable thead tr').clone(true).appendTo( '#dealertable thead' );
    jQuery('#dealertable thead tr:eq(1) th').each( function (i) {
        var title = jQuery(this).text();
        jQuery(this).html( '<input type="text" title="Search '+ title +'"/>' );
 
        jQuery( 'input', this ).on( 'keyup change', function () {
            if ( dealertable.column(i).search() !== this.value ) {
                dealertable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/

   var  dealertable = jQuery('#dealertable').DataTable( {
        dom: 'Bfrtip',
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'csv',
                //Name the CSV
                filename: 'dealer_list',
                exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                filename: 'dealer_list',
                exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'dealer_list',
                exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'dealer_list',
                exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');
                    
                }
            }
        ]
        // filename: 'dealer_list',
    } );

   // search fileter for dealertable
   jQuery('#dealertable_filter input').unbind().bind('keyup', function() {
      var colIndex = document.querySelector('#dealertable-select').selectedIndex;
      dealertable.column( colIndex).search( this.value ).draw();
    });

    jQuery('#dealertable-select').change(function() {
        dealertable.columns().search('').draw();
    }); 

    /*jQuery('#view_code_table thead tr').clone(true).appendTo( '#view_code_table thead' );
    jQuery('#view_code_table thead tr:eq(1) th').each( function (i) {
        var title = jQuery(this).text();
        jQuery(this).html( '<input type="text" title="Search '+ title +'"/>' );
 
        jQuery( 'input', this ).on( 'keyup change', function () {
            if ( view_code_table.column(i).search() !== this.value ) {
                view_code_table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/

    var view_code_table = jQuery('#view_code_table').DataTable( {
        dom: 'Bfrtip',
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'csv',
                //Name the CSV
                filename: 'dealer_product_code_list',
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                filename: 'dealer_product_code_list',
                exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'dealer_product_code_list',
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'dealer_product_code_list',
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '12px');
                    
                }
            }
        ]
        // filename: 'dealer_list',
    } );

    // search fileter for view_code_table
    jQuery('#view_code_table_filter input').unbind().bind('keyup', function() {
      var colIndex = document.querySelector('#view-code-table-select').selectedIndex;
      view_code_table.column( colIndex).search( this.value ).draw();
    });

    jQuery('#view-code-table-select').change(function() {
        view_code_table.columns().search('').draw();
    }); 

    /*jQuery('#view_customer_table thead tr').clone(true).appendTo( '#view_customer_table thead' );
    jQuery('#view_customer_table thead tr:eq(1) th').each( function (i) {
        var title = jQuery(this).text();
        jQuery(this).html( '<input type="text" title="Search '+ title +'"/>' );
 
        jQuery( 'input', this ).on( 'keyup change', function () {
            if ( view_customer_table.column(i).search() !== this.value ) {
                view_customer_table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/

   

    var view_customer_table = jQuery('#view_customer_table').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                extend: 'csv',
                //Name the CSV
                filename: 'dealer_customer_list',
               exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                filename: 'dealer_customer_list',
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'dealer_customer_list',
                 exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'dealer_customer_list',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                 exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
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
      view_customer_table.column( colIndex).search( this.value ).draw();
    });
    
    jQuery('#view-customer-table-select').change(function() {
        view_customer_table.columns().search('').draw();
    }); 

 /*jQuery('#customertable thead tr').clone(true).appendTo( '#customertable thead' );
    jQuery('#customertable thead tr:eq(1) th').each( function (i) {
        var title = jQuery(this).text();
        jQuery(this).html( '<input type="text" title="Search '+ title +'"/>' );
 
        jQuery( 'input', this ).on( 'keyup change', function () {
            if ( customertable.column(i).search() !== this.value ) {
                customertable
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );*/
    
    var customertable = jQuery('#customertable').DataTable( {
        dom: 'Bfrtip',
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        buttons: [
            {
                
                extend: 'csv',
                //Name the CSV
                filename: 'dealer_customer_list',
               exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7,8, 9, 11 ]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                filename: 'dealer_customer_list',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                exportOptions: {
                     columns: [0, 1, 2, 4, 5, 6, 7,8, 9, 11 ]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'dealer_customer_list',
                exportOptions: {
                     columns: [0, 1, 2, 4, 5, 6, 7,8, 9, 11 ]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'dealer_customer_list',
                
                exportOptions: {
                     columns: [0, 1, 2, 4, 5, 6, 7,8, 9, 11 ]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');
                    
                }
            }


        ]
       
    } );

     // search fileter for view_customer_table
    jQuery('#customertable_filter input').unbind().bind('keyup', function() {
      var colIndex = document.querySelector('#customertable-select').selectedIndex;
      customertable.column( colIndex).search( this.value ).draw();
    });

    jQuery('#customertable-select').change(function() {
        customertable.columns().search('').draw();
    }); 

    
    jQuery.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }


    

    //Search submit
    jQuery(document).on("click","#search_submit", function(e) {
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
            action: 'dealer_distributor_reports',
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
       jQuery('.perma-loader').show();
 
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
               jQuery('.perma-loader').hide();
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

    jQuery(document).on("click","#search_reset", function(e) {
        location.reload();     
    });

    jQuery(document).on("click",".view-data", function(e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id")

         var data = {
            action: 'dealer_distributor_view_data_reports',
            id : id,

        };
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
               jQuery('.perma-loader').hide();
                jQuery('.data-result-wrap').html('');
                jQuery('.data-result-wrap').append(response);
                
            },
            
        });
        
    });

    jQuery("[data-scroll-to]").click(function() {
      var $this = jQuery(this),
          $toElement      = $this.attr('data-scroll-to'),
          $focusElement   = $this.attr('data-scroll-focus'),
          $offset         = $this.attr('data-scroll-offset') * 1 || 0,
          $speed          = $this.attr('data-scroll-speed') * 1 || 500;

      jQuery('html, body').animate({
        scrollTop: jQuery($toElement).offset().top + $offset
      }, $speed);
      
      if ($focusElement) jQuery($focusElement).focus();
    });

    // jQuery( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    // jQuery( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });

    
    jQuery(document).on("click","#date_submit", function(e) {
        jQuery('.error').remove();
        var validflag = true;
        var datepicker1 = jQuery('#datepicker1').val();
        
        var datepicker2 = jQuery('#datepicker2').val();
        var select = jQuery('#quick_filters').val();
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
            action: 'dealer_distributor_quick_filters',
            datepicker1 : datepicker1,
            datepicker2 : datepicker2,
            select : select,

        };
        
        jQuery('.perma-loader').show();
        if(!validflag){
            jQuery('.perma-loader').hide();
            return validflag;
        }else{
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                   jQuery('.perma-loader').hide();
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
                                            columns: [0,1,2,3,5]
                                    },
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    orientation : 'landscape',
                                    pageSize : 'LEGAL',
                                    filename: 'quick_filters',
                                    exportOptions: {
                                            columns: [0,1,2,3,5]
                                    },
                                },
                                {
                                    extend: 'excel',
                                    text: 'EXCEL',
                                    filename: 'quick_filters',
                                    exportOptions: {
                                            columns: [0,1,2,3,5]
                                    },
                                },
                                {
                                    extend: 'print',
                                    text: 'PRINT',
                                    filename: 'quick_filters',
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

    jQuery(document).on("focus","#datepicker1", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
    });
    jQuery(document).on("focus","#datepicker2", function(e) {
        jQuery(this).css({'border-color':'#cccccc'});
        jQuery(this).css({'color':'#555'});
        jQuery(this).siblings('.error').remove();
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
                columns: [0, 1, 2, 3 ]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                filename: 'mebership_info',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                exportOptions: {
                     columns: [0, 1, 2, 3 ]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'mebership_info',
                exportOptions: {
                    columns: [0, 1, 2, 3 ]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'mebership_info',
                
                exportOptions: {
                    columns: [0, 1, 2, 3 ]
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

        var datepicker1 = jQuery('#membership_datepicker1').val();
        var datepicker2 = jQuery('#membership_datepicker2').val();
        var view_membership = jQuery('#view_membership').val();
        if(view_membership != undefined){
            var data = {
                action : 'membership_date_filter',
                view_membership : view_membership,
                datepicker1 : datepicker1,
                datepicker2 : datepicker2
            }
        }else{
            var data = {
                action : 'membership_date_filter',
                // membership_login_id : membership_login_id,
                datepicker1 : datepicker1,
                datepicker2 : datepicker2
            }
        }
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-loader').hide();
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
                                    columns: [0, 1, 2,3]
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            filename: 'mebership_info',
                            orientation : 'landscape',
                            pageSize : 'LEGAL',
                            exportOptions: {
                                columns: [0, 1, 2,3]
                            },
                        },
                        {
                            extend: 'excel',
                            text: 'EXCEL',
                            filename: 'mebership_info',
                            exportOptions: {
                                columns: [0, 1, 2,3]
                            },
                        },
                        {
                            extend: 'print',
                            text: 'PRINT',
                            filename: 'mebership_info',
                            
                            exportOptions: {
                                columns: [0, 1, 2,3]
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
        
    });

   
});

