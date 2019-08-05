jQuery(document).ready(function () {

    jQuery('.message').toggleClass('comein');
    jQuery('.check').toggleClass('scaledown');
    jQuery(document).on("click", "#ok", function (e) {
        jQuery('.message').css('display', 'none');
        location.reload();
    });

    var pop_val = jQuery('#reset_pass_popup').val();
    if (pop_val == 1) {

        setTimeout(function () {
            jQuery('.pum-container').css('display', 'none');

        }, 700);

    }

    var registration_form = '<h3>Customer Contact Information</h3><div class="content-column one_half"><label>First Name<input type="text" name="first_name" id="first_name" /></label></div><div class="content-column one_half last_column"><label>Last Name<input type="text" name="last_name" id="last_name" /></label></div><div class="clear_column"></div><div class="content-column"><label>Address<input type="text" name="address1" id="address1" placeholder="Address line 1" /></label></div><div class="content-column"><input type="text" name="address2" id="address2" placeholder="Address line 2" /></div><div class="content-column one_third"><label>City<input type="text" name="city" id="city" /></label></div><div class="content-column one_third"><label>State<input type="text" name="state" id="state" /></label></div><div class="content-column one_third last_column"><label>Zip Code<input type="text" name="zip_code" id="zip_code" /></label></div><div class="clear_column"></div><div class="content-column one_half"><label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span><input type="text" name="phone_number" id="phone_number" /></label></div><div class="content-column one_half last_column"><label>Email<input type="text" name="email" id="email" /><p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p></label></div><div class="clear_column"></div><hr><h3>Vehicle Information</h3><div class="content-column one_third"><label>Vehicle Year<input type="text" name="vehicle_year" id="vehicle_year" /></label></div><div class="content-column one_third"><label>Vehicle Make<input type="text" name="vehicle_make" id="vehicle_make" /></label></div><div class="content-column one_third last_column"><label>Vehicle Model<input type="text" name="vehicle_model" id="vehicle_model" /></label></div><div class="content-column one_third"><label>VIN<input type="text" name="vin" id="vin" /></label></div><div class="content-column one_third"><label>Vehicle Mileage<input type="text" name="vehicle_mileage" id="vehicle_mileage" /></label></div><div class="content-column one_third last_column"><label>Vehicle Type<select name="vehicle_type" id="vehicle_type" style="background:#efefef;"><option value="">Select Type</option><option value="new">New</option><option value="preowned">Preowned</option></select></label></div><div class="clear_column"></div><hr><h3>Electronic Consent</h3><p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p><p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p><div class="content-column"><label>Signature<input type="text" name="signature" id="signature" placeholder="Signature" style="margin-bottom:10px;"/></label></div><input type="submit" id="pmsafe_submit" value="Submit">';

    // for states
    var availableStates = [
        { label: "ALABAMA", value: "AL" },
        { label: "ALASKA", value: "AK" },
        { label: "AMERICAN SAMOA", value: "AS" },
        { label: "ARIZONA", value: "AZ" },
        { label: "ARKANSAS", value: "AR" },
        { label: "CALIFORNIA", value: "CA" },
        { label: "COLORADO", value: "CO" },
        { label: "CONNECTICUT", value: "CT" },
        { label: "DELAWARE", value: "DE" },
        { label: "DISTRICT OF COLUMBIA", value: "DC" },
        { label: "FEDERATED STATES OF MICRONESIA", value: "FM" },
        { label: "FLORIDA", value: "FL" },
        { label: "GEORGIA", value: "GA" },
        { label: "GUAM GU", value: "GU" },
        { label: "HAWAII", value: "HI" },
        { label: "IDAHO", value: "ID" },
        { label: "ILLINOIS", value: "IL" },
        { label: "INDIANA", value: "IN" },
        { label: "IOWA", value: "IA" },
        { label: "KANSAS", value: "KS" },
        { label: "KENTUCKY", value: "KY" },
        { label: "LOUISIANA", value: "LA" },
        { label: "MAINE", value: "ME" },
        { label: "MARSHALL ISLANDS", value: "MH" },
        { label: "MARYLAND", value: "MD" },
        { label: "MASSACHUSETTS", value: "MA" },
        { label: "MICHIGAN", value: "MI" },
        { label: "MINNESOTA", value: "MN" },
        { label: "MISSISSIPPI", value: "MS" },
        { label: "MISSOURI", value: "MO" },
        { label: "MONTANA", value: "MT" },
        { label: "NEBRASKA", value: "NE" },
        { label: "NEVADA", value: "NV" },
        { label: "NEW HAMPSHIRE", value: "NH" },
        { label: "NEW JERSEY", value: "NJ" },
        { label: "NEW MEXICO", value: "NM" },
        { label: "NEW YORK", value: "NY" },
        { label: "NORTH CAROLINA", value: "NC" },
        { label: "NORTH DAKOTA", value: "ND" },
        { label: "NORTHERN MARIANA ISLANDS", value: "MP" },
        { label: "OHIO", value: "OH" },
        { label: "OKLAHOMA", value: "OK" },
        { label: "OREGON", value: "OR" },
        { label: "PALAU", value: "PW" },
        { label: "PENNSYLVANIA", value: "PA" },
        { label: "PUERTO RICO", value: "PR" },
        { label: "RHODE ISLAND", value: "RI" },
        { label: "SOUTH CAROLINA", value: "SC" },
        { label: "SOUTH DAKOTA", value: "SD" },
        { label: "TENNESSEE", value: "TN" },
        { label: "TEXAS", value: "TX" },
        { label: "UTAH", value: "UT" },
        { label: "VERMONT", value: "VT" },
        { label: "VIRGIN ISLANDS", value: "VI" },
        { label: "VIRGINIA", value: "VA" },
        { label: "WASHINGTON", value: "WA" },
        { label: "WEST VIRGINIA", value: "WV" },
        { label: "WISCONSIN", value: "WI" },
        { label: "WYOMING", value: "WY" },
        { label: "ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST", value: "AE" },
        { label: "ARMED FORCES AMERICA (EXCEPT CANADA)", value: "AA" },
        { label: "ARMED FORCES PACIFIC", value: "AP" }
    ];



    var state_options = {
        source: availableStates
    };

    jQuery(document).on('keydown.autocomplete', '#state', function () {
        jQuery(this).autocomplete(state_options);
    })

    // for vehicle make
    var manufacurers_list = [
        "Abarth",
        "Alfa Romeo",
        "Aston Martin",
        "Audi",
        "Bentley",
        "BMW",
        "Bugatti",
        "Cadillac",
        "Chevrolet",
        "Chrysler",
        "Citroën",
        "Dacia",
        "Daewoo",
        "Daihatsu",
        "Dodge",
        "Donkervoort",
        "DS",
        "Ferrari",
        "Fiat",
        "Fisker",
        "Ford",
        "Honda",
        "Hummer",
        "Hyundai",
        "Infiniti",
        "Iveco",
        "Jaguar",
        "Jeep",
        "Kia",
        "KTM",
        "Lada",
        "Lamborghini",
        "Lancia",
        "Land Rover",
        "Landwind",
        "Lexus",
        "Lotus",
        "Maserati",
        "Maybach",
        "Mazda",
        "McLaren",
        "Mercedes-Benz",
        "MG",
        "Mini",
        "Mitsubishi",
        "Morgan",
        "Nissan",
        "Opel",
        "Peugeot",
        "Porsche",
        "Renault",
        "Rolls-Royce",
        "Rover",
        "Saab",
        "Seat",
        "Skoda",
        "Smart",
        "SsangYong",
        "Subaru",
        "Suzuki",
        "Tesla",
        "Toyota",
        "Volkswagen",
        "Volvo"
    ];

    var manufacurers_options = {
        source: manufacurers_list
    };

    jQuery(document).on('keydown.autocomplete', '#vehicle_make', function () {
        jQuery(this).autocomplete(manufacurers_options);
    })

    jQuery(document).on("click", "#pmsafe_next", function (e) {
        e.preventDefault();
        jQuery('.error').remove();
        // var is_upgradable = jQuery('#is_upgradable').val();



        var validflag = true;
        //Member Name
        if (jQuery('#member_number').val().trim() == "") {
            jQuery('#member_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#member_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#member_number').css({ 'color': '#333333' });
        }

        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_register_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_registration_code_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    //                    console.log(response);


                    var obj = jQuery.parseJSON(response);
                    // console.log('yes'+obj.option);
                    if (obj.status == true) {
                        jQuery('#pmsafe-response').remove();
                        jQuery('#member_code_div').css('display', 'none');
                        // jQuery('#pmsafe_next').css('display','none');
                        jQuery('#pmsafe_next').remove();
                        jQuery('#member_number').val(obj.code);
                        if (obj.is_upgradable == 1) {
                            jQuery('.perma-loader').hide();
                            jQuery('#dialog').removeAttr('style');

                            // jQuery('#upgradable_package_div').removeAttr('style');
                            jQuery('#dialog_upgrade').before('<input type="hidden" value="' + obj.package + '" id="get_package"><input type="hidden" value="' + obj.code_id + '" id="get_code_id">');
                            // jQuery('#select_upgradable_package').append(obj.option);

                        } else {
                            if (obj.html) {
                                jQuery('.perma-loader').hide();
                                jQuery('#hidden_form').before(obj.html);
                            } else {
                                if (obj.package && obj.code_id) {
                                    var package = obj.package;
                                    var code_id = obj.code_id

                                    var data = {
                                        action: 'check_no_coverage_policy',
                                        package: package,
                                        code_id: code_id

                                    }
                                    jQuery('.perma-loader').show();
                                    jQuery.ajax({
                                        type: 'POST',
                                        url: pmAjax.ajaxurl,
                                        data: data,
                                        dataType: 'html',
                                        success: function (response) {
                                            jQuery('.perma-loader').hide();
                                            if (response != 1) {
                                                jQuery('#hidden_form').before(response);
                                            }
                                            if (response == 1) {
                                                var data = {
                                                    action: 'get_benefit_package_price',
                                                    package: package,
                                                    code_id: code_id
                                                }
                                                jQuery('.perma-loader').show();
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
                                }
                                else {
                                    jQuery('.perma-loader').hide();
                                    jQuery('#hidden_form').html(registration_form);
                                }
                            }

                        }
                    } else {
                        jQuery('.perma-loader').hide();
                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
    jQuery(document).on("click", "#dialog_upgrade", function (e) {
        jQuery('.perma-loader').show();
        var form = jQuery('#perma_register_form')[0];
        var fd = new FormData(form);
        fd.append('action', 'pmsafe_registration_code_form');
        jQuery.ajax({
            type: 'post',
            url: pmAjax.ajaxurl,
            processData: false,
            contentType: false,
            data: fd,
            success: function (response) {
                jQuery('.perma-loader').hide();

                var obj = jQuery.parseJSON(response);
                // console.log('yes'+obj.option);
                if (obj.status == true) {
                    jQuery('#dialog').css('display', 'none');
                    jQuery('#upgradable_package_div').removeAttr('style');
                    jQuery('#upgradable_package_div').before('<h3>Change Benefit Package for Code : ' + obj.code + '</h3>');
                    jQuery('#select_upgradable_package').append(obj.option);
                }
            }
        });

    });

    jQuery(document).on("click", "#dialog_upgrade_no", function (e) {
        jQuery('#dialog').css('display', 'none');

        var package = jQuery('#get_package').val();
        var code_id = jQuery('#get_code_id').val();
        var data = {
            action: 'check_no_coverage_policy',
            package: package,
            code_id: code_id

        }
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                if (response != 1) {
                    jQuery('.perma-loader').hide();
                    jQuery('#hidden_form').before(response);
                }
                if (response == 1) {

                    var data = {
                        action: 'get_benefit_package_price',
                        package: package,
                        code_id: code_id
                    }
                    // jQuery('.perma-loader').show();
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

    });

    jQuery(document).on("click", "#salesperson_update_prefix", function (e) {
        jQuery('#salesperson_benefits_package_div').css('display', 'none');
        var package = jQuery('#salesperson_benefits_package').val();
        jQuery('#hidden_form').before('<div id="salesperson_price_div"><h3>Please Enter The Retail Selling Price (Cost to Customer):</h3><div class="content-column one_half"><label>Selling Price($) : <input type="number" name="selling_price" id="selling_price" min="1" value="20"/></label></div><input type="button" id="salesperson_update_price" value="Update" style="margin-top:10px;clear:both;float:left;"></div>');

    });

    jQuery(document).on("click", "#salesperson_update_price", function (e) {
        jQuery('#salesperson_price_div').css('display', 'none');
        jQuery('#hidden_form').html(registration_form);
    });

    jQuery(document).on("click", "#pmsafe_skip_price", function (e) {
        jQuery('#update_package_price').css('display', 'none');
        jQuery('#hidden_form').html(registration_form);
    });

    jQuery(document).on("change", "#select_upgradable_package", function (e) {
        var select = jQuery('#select_upgradable_package').val();
        if (select == 0) {
            jQuery('#pmsafe_update_prefix').attr('value', 'Skip');
        } else {
            jQuery('#pmsafe_update_prefix').attr('value', 'Update');
        }
    });


    jQuery(document).on("click", "#pmsafe_update_prefix", function (e) {
        e.preventDefault();
        jQuery('.error').remove();
        var select = jQuery('#select_upgradable_package').val();
        var code = jQuery('#member_number').val();
        var login_id = jQuery('#login_id').val();
        var data = {
            action: 'update_benefit_package',
            code: code,
            select: select,
            login_id: login_id
        }
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {


                var obj = jQuery.parseJSON(response);
                if (obj.status == true) {

                    jQuery('#member_code_div').css('display', 'none');
                    jQuery('#change_benefits_package').css('display', 'none');
                    jQuery('#change_benefits_package_price').removeAttr('style');
                    if (obj.msg) {
                        jQuery('#hidden_form').before('<p style="color: #038503;background-color: #c6f2c6;border-color: #ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">' + obj.msg + '</p>');
                    }
                    var package = obj.package;
                    var code_id = obj.code_id;

                    var data = {
                        action: 'get_benefit_package_price',
                        package: package,
                        code_id: code_id
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

    jQuery(document).on("click", "#pmsafe_update_price", function (e) {
        e.preventDefault();
        jQuery('.error').remove();
        var selling_price = jQuery('#selling_price').val();
        var package = jQuery('#get_package').val();
        var code_id = jQuery('#get_code_id').val();
        var login_id = jQuery('#login_id').val();
        var validflag = true;

        var data = {
            action: 'update_benefit_package_price',
            selling_price: selling_price,
            package: package,
            code_id: code_id,
            login_id: login_id
        }
        //Selling price
        if (jQuery('#selling_price').val().trim() == "") {
            jQuery('#selling_price').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#selling_price').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#selling_price').css({ 'color': '#333333' });
        }

        if (!validflag) {
            return validflag;
        } else {

            jQuery('.perma-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {

                    jQuery('.perma-loader').hide();

                    var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {

                        jQuery('#member_code_div').css('display', 'none');
                        jQuery('#change_benefits_package').css('display', 'none');
                        jQuery('#change_benefits_package_price').removeAttr('style');
                        jQuery('#update_package_price').css('display', 'none');
                        if (obj.msg) {
                            jQuery('#hidden_form').before('<p style="color: #038503;background-color: #c6f2c6;border-color: #ebccd1;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;">' + obj.msg + '.</p>');
                        }

                        jQuery('#hidden_form').html(registration_form);
                    }
                },

            });
            return false;
        }
    });



    jQuery(document).on("click", "#pmsafe_submit", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;

        //Member Name
        if (jQuery('#member_number').val().trim() == "") {
            jQuery('#member_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#member_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#member_number').css({ 'color': '#333333' });
        }

        //First Name 
        if (jQuery('#first_name').val().trim() == "") {
            jQuery('#first_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#first_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#first_name').css({ 'color': '#333333' });
        }

        //Last Name 
        if (jQuery('#last_name').val().trim() == "") {
            jQuery('#last_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#last_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#last_name').css({ 'color': '#333333' });
        }

        //Address
        if (jQuery('#address1').val().trim() == "") {
            jQuery('#address1').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#address1').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#address1').css({ 'color': '#333333' });
        }

        //city
        if (jQuery('#city').val().trim() == "") {
            jQuery('#city').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#city').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#city').css({ 'color': '#333333' });
        }

        //state
        if (jQuery('#state').val().trim() == "") {
            jQuery('#state').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#state').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#state').css({ 'color': '#333333' });
        }

        //zip code
        var numbers = /^[0-9\-]+$/;
        if (jQuery('#zip_code').val().trim() == '') {
            jQuery('#zip_code').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#zip_code').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#zip_code').val().match(numbers))) {
            jQuery('#zip_code').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#zip_code').after("<span class='error'>Please enter valid zip code.</span>");
            validflag = false;
        }
        else {
            jQuery('#zip_code').css({ 'border-color': '#cccccc' });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#phone_number').val().trim() == '') {
            jQuery('#phone_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#phone_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#phone_number').val().match(numbers))) {
            jQuery('#phone_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#phone_number').after("<span class='error'>Please enter valid phone number.</span>");
            validflag = false;
        } else {
            jQuery('#phone_number').css({ 'border-color': '#cccccc' });
        }

        //Email     
        if (jQuery('#email').val().trim() == '') {
            jQuery('#email').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#email').val()) {
                var email = jQuery("#email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#email').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
                    jQuery('#email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#email').css({ 'color': '#333333' });
                }
            }
        }

        //vehicle year
        var numbers = /^[0-9]+$/;
        if (jQuery('#vehicle_year').val().trim() == '') {
            jQuery('#vehicle_year').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_year').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vehicle_year').val().match(numbers))) {
            jQuery('#vehicle_year').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_year').after("<span class='error'>Please enter valid year.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_year').css({ 'border-color': '#cccccc' });
        }

        //vehicle make
        if (jQuery('#vehicle_make').val().trim() == "") {
            jQuery('#vehicle_make').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_make').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_make').css({ 'color': '#333333' });
        }

        //vehicle model
        if (jQuery('#vehicle_model').val().trim() == "") {
            jQuery('#vehicle_model').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_model').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_model').css({ 'color': '#333333' });
        }

        //vin
        var numbers = /^[0-9A-Z]+$/;
        if (jQuery('#vin').val().trim() == '') {
            jQuery('#vin').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vin').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vin').val().match(numbers))) {
            jQuery('#vin').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vin').after("<span class='error'>Please enter valid vin.</span>");
            validflag = false;
        } else {
            jQuery('#vin').css({ 'border-color': '#cccccc' });
        }

        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if (jQuery('#vehicle_mileage').val().trim() == '') {
            jQuery('#vehicle_mileage').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_mileage').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vehicle_mileage').val().match(numbers))) {
            jQuery('#vehicle_mileage').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_mileage').after("<span class='error'>Please enter valid mileage.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_mileage').css({ 'border-color': '#cccccc' });
        }

        //vehicle type
        if (jQuery('#vehicle_type').val().trim() == "") {
            jQuery('#vehicle_type').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_type').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_type').css({ 'color': '#333333' });
        }

        //signature
        if (jQuery('#signature').val().trim() == "") {
            jQuery('#signature').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#signature').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#signature').css({ 'color': '#333333' });
        }

        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_register_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_registration_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    //                    console.log(response);
                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        if (obj.sales == true) {
                            jQuery("#perma_register_form").html(obj.html);
                        } else {
                            if (obj.redirect.indexOf('/perma-warranty/') > -1) {
                                window.location = obj.redirect;
                            }
                            else {
                                window.location = obj.redirect + '?success=true&code=' + obj.code;
                            }

                        }
                        //                        jQuery("#response").html(obj.redirect);
                    } else {

                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });
    jQuery(document).on("focus", "#signature,#selling_price,#vehicle_type,#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage", function (e) {
        // Focus and blure 
        // jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').focus(function(){
        jQuery(this).css({ 'border-color': '#cccccc' });
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();
        // jQuery('#pmsafe-response').remove();
    });
    jQuery(document).on("blur", "#signature,#selling_price,#vehicle_type,#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage", function (e) {
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("click", "#pmsafe_pdf_btn", function (e) {
        e.preventDefault();

        PrintElem('#perma-warranty-wrapper');
    });


    jQuery(document).on("click", "#pmsafe_sales_person_submit", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;

        //Member Name
        if (jQuery('#member_number').val().trim() == "") {
            jQuery('#member_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#member_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#member_number').css({ 'color': '#333333' });
        }

        //First Name 
        if (jQuery('#first_name').val().trim() == "") {
            jQuery('#first_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#first_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#first_name').css({ 'color': '#333333' });
        }

        //Last Name 
        if (jQuery('#last_name').val().trim() == "") {
            jQuery('#last_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#last_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#last_name').css({ 'color': '#333333' });
        }

        //Address
        if (jQuery('#address1').val().trim() == "") {
            jQuery('#address1').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#address1').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#address1').css({ 'color': '#333333' });
        }

        //city
        if (jQuery('#city').val().trim() == "") {
            jQuery('#city').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#city').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#city').css({ 'color': '#333333' });
        }

        //state
        if (jQuery('#state').val().trim() == "") {
            jQuery('#state').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#state').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#state').css({ 'color': '#333333' });
        }

        //zip code
        var numbers = /^[0-9\-]+$/;
        if (jQuery('#zip_code').val().trim() == '') {
            jQuery('#zip_code').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#zip_code').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#zip_code').val().match(numbers))) {
            jQuery('#zip_code').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#zip_code').after("<span class='error'>Please enter valid zip code.</span>");
            validflag = false;
        }
        else {
            jQuery('#zip_code').css({ 'border-color': '#cccccc' });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#phone_number').val().trim() == '') {
            jQuery('#phone_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#phone_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#phone_number').val().match(numbers))) {
            jQuery('#phone_number').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#phone_number').after("<span class='error'>Please enter valid phone number.</span>");
            validflag = false;
        } else {
            jQuery('#phone_number').css({ 'border-color': '#cccccc' });
        }

        //Email     
        if (jQuery('#email').val().trim() == '') {
            jQuery('#email').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#email').val()) {
                var email = jQuery("#email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#email').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
                    jQuery('#email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#email').css({ 'color': '#333333' });
                }
            }
        }

        //vehicle year
        var numbers = /^[0-9]+$/;
        if (jQuery('#vehicle_year').val().trim() == '') {
            jQuery('#vehicle_year').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_year').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vehicle_year').val().match(numbers))) {
            jQuery('#vehicle_year').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_year').after("<span class='error'>Please enter valid year.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_year').css({ 'border-color': '#cccccc' });
        }

        //vehicle make
        if (jQuery('#vehicle_make').val().trim() == "") {
            jQuery('#vehicle_make').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_make').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_make').css({ 'color': '#333333' });
        }

        //vehicle model
        if (jQuery('#vehicle_model').val().trim() == "") {
            jQuery('#vehicle_model').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_model').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_model').css({ 'color': '#333333' });
        }

        //vin
        var numbers = /^[0-9A-Z]+$/;
        if (jQuery('#vin').val().trim() == '') {
            jQuery('#vin').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vin').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vin').val().match(numbers))) {
            jQuery('#vin').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vin').after("<span class='error'>Please enter valid vin.</span>");
            validflag = false;
        } else {
            jQuery('#vin').css({ 'border-color': '#cccccc' });
        }

        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if (jQuery('#vehicle_mileage').val().trim() == '') {
            jQuery('#vehicle_mileage').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_mileage').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#vehicle_mileage').val().match(numbers))) {
            jQuery('#vehicle_mileage').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#vehicle_mileage').after("<span class='error'>Please enter valid mileage.</span>");
            validflag = false;
        } else {
            jQuery('#vehicle_mileage').css({ 'border-color': '#cccccc' });
        }


        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_salesperson_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'perma_salesperson_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    //                    console.log(response);
                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        jQuery("#perma_salesperson_form").html(obj.html);
                        jQuery('#pmsafe-response').hide();
                    } else {

                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });

    // Focus and blure 
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').focus(function () {
        jQuery(this).css({ 'border-color': '#cccccc' });
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#member_number, #first_name, #last_name, #address1, #city, #state, #zip_code, #phone_number, #email, #vehicle_year, #vehicle_make, #vehicle_model, #vin, #vehicle_mileage').blur(function () {
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();
    });



    function PrintElem(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data) {
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




    jQuery(".btn_nisl_edit").click(function () {
        jQuery('.nisl_name').prop("disabled", false);
        jQuery('.nisl_name').focus();
        jQuery('.nisl_address').prop("disabled", false);
        jQuery('.nisl_state').prop("disabled", false);
        jQuery('.nisl_phone').prop("disabled", false);
        jQuery(".btn_nisl_edit").css("display", "none");
        jQuery("#pmsafe_save_user_info").css("display", "block");

    });

    jQuery(".btn_nisl_dealer_edit").click(function () {
        jQuery('.nisl_name').prop("disabled", false);
        jQuery('.nisl_name').focus();

        jQuery('.nisl_fname').prop("disabled", false);
        jQuery('.nisl_fname').focus();

        jQuery('.nisl_lname').prop("disabled", false);

        jQuery('.nisl_address').prop("disabled", false);
        jQuery('.nisl_fax').prop("disabled", false);
        jQuery('.nisl_phone').prop("disabled", false);
        jQuery(".btn_nisl_dealer_edit").css("display", "none");


    });


    jQuery(document).on("click", "#pmsafe_save_user_info", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;



        //First Name 
        if (jQuery('.nisl_name').val().trim() == "") {
            jQuery('.nisl_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_name').css({ 'color': '#333333' });
        }



        //Address
        if (jQuery('.nisl_address').val().trim() == "") {
            jQuery('.nisl_address').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_address').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_address').css({ 'color': '#333333' });
        }

        //city
        if (jQuery('.nisl_state').val().trim() == "") {
            jQuery('.nisl_state').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_state').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_state').css({ 'color': '#333333' });
        }




        //Phone
        var numbers = /^[0-9]+$/;
        if (jQuery('.nisl_phone').val().trim() == '') {
            jQuery('.nisl_phone').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_phone').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('.nisl_phone').val().match(numbers))) {
            jQuery('.nisl_phone').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_phone').after("<span class='error'>Please enter valid phone number.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_phone').css({ 'border-color': '#cccccc' });
        }




        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_user_info_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_user_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    console.log(obj);
                    if (obj.status == true) {

                        window.location.replace(obj.redirect);
                        jQuery('#pmsafe-response').hide();
                    } else {

                        jQuery('#pmsafe-response').html(obj.message);
                    }
                }
            });
            return false;
        }
    });


    /*dealer edit information*/
    jQuery(document).on("click", "#pmsafe_save_dealer_distributor_info", function (e) {


        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;



        //First Name 
        if (jQuery('.nisl_name').val().trim() == "") {
            jQuery('.nisl_name').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_name').css({ 'color': '#333333' });
        }


        //Phone
        var numbers = /^[0-9]+$/;
        if (jQuery('#pmsafe_distributor_phone_number').val() != '') {
            if (!(jQuery('.nisl_phone').val().match(numbers))) {
                jQuery('.nisl_phone').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
                jQuery('.nisl_phone').after("<span class='error'>Please enter valid phone number.</span>");
                validflag = false;
            } else {
                jQuery('.nisl_phone').css({ 'border-color': '#cccccc' });
            }
        }


        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_dealer_distributor_info_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'perma_dealer_distributor_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        if (obj.change_password == 1) {
                            var text = 'You have changed password. So, You need to login again. Press OK button.'
                        }
                        if (obj.change_password == 0) {
                            var text = 'Press OK button.'
                        }
                        swal({
                            title: "Successfully Updated!",
                            text: text,
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })
                    }
                }
            });
            return false;
        }
    });

    /*dealer edit information*/
    jQuery(document).on("click", "#pmsafe_save_contact_user_info", function (e) {


        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;



        //First Name 
        if (jQuery('.nisl_fname').val().trim() == "") {
            jQuery('.nisl_fname').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_fname').css({ 'color': '#333333' });
        }

        //First Name 
        if (jQuery('.nisl_lname').val().trim() == "") {
            jQuery('.nisl_lname').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_lname').css({ 'color': '#333333' });
        }


        //Phone
        var numbers = /^[0-9]+$/;
        if (jQuery('.nisl_phone').val().trim() == '') {
            jQuery('.nisl_phone').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_phone').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('.nisl_phone').val().match(numbers))) {
            jQuery('.nisl_phone').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('.nisl_phone').after("<span class='error'>Please enter valid phone number.</span>");
            validflag = false;
        } else {
            jQuery('.nisl_phone').css({ 'border-color': '#cccccc' });
        }

        //Email     
        if (jQuery('#nisl_mail').val().trim() == '') {
            jQuery('#nisl_mail').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#nisl_mail').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#nisl_mail').val()) {
                var email = jQuery("#nisl_mail").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#nisl_mail').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
                    jQuery('#nisl_mail').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#nisl_mail').css({ 'color': '#333333' });
                }
            }
        }



        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-loader').show();
            var form = jQuery('#perma_contact_user_info_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'perma_contact_user_info_form');
            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {

                    jQuery('.perma-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {

                        if (obj.change_password == 1) {
                            var text = 'You have changed password. So, You need to login again. Press OK button.'
                        }
                        if (obj.change_password == 0) {
                            var text = 'Press OK button.'
                        }
                        swal({
                            title: "Successfully Updated!",
                            text: text,
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })
                    }
                }
            });
            return false;
        }
    });


    var dealertable = jQuery('#dealertable').DataTable({
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
                orientation: 'landscape',
                pageSize: 'LEGAL',
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
    });

    // search fileter for dealertable
    jQuery('#dealertable_filter input').unbind().bind('keyup', function () {
        var colIndex = document.querySelector('#dealertable-select').selectedIndex;
        dealertable.column(colIndex).search(this.value).draw();
    });

    jQuery('#dealertable-select').change(function () {
        dealertable.columns().search('').draw();
    });


    var view_code_table = jQuery('#view_code_table').DataTable({
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
                orientation: 'landscape',
                pageSize: 'LEGAL',
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
    });

    // search fileter for view_code_table
    jQuery('#view_code_table_filter input').unbind().bind('keyup', function () {
        var colIndex = document.querySelector('#view-code-table-select').selectedIndex;
        view_code_table.column(colIndex).search(this.value).draw();
    });

    jQuery('#view-code-table-select').change(function () {
        view_code_table.columns().search('').draw();
    });

    // individual code table
    var view_invi_code_table = jQuery('#view_invi_code_table').DataTable({
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
                orientation: 'landscape',
                pageSize: 'LEGAL',
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
    });

    // search fileter for view_code_table
    jQuery('#view_invi_code_table_filter input').unbind().bind('keyup', function () {
        var colIndex = document.querySelector('#view-invi-code-table-select').selectedIndex;
        view_invi_code_table.column(colIndex).search(this.value).draw();
    });

    jQuery('#view-invi-code-table-select').change(function () {
        view_invi_code_table.columns().search('').draw();
    });

    var customertable = jQuery('#customertable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        orderCellsTop: true,
        "order": [[13, "desc"]],
        fixedHeader: true,
        buttons: [
            {

                extend: 'csv',
                //Name the CSV
                filename: 'dealer_customer_list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                filename: 'dealer_customer_list',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'dealer_customer_list',
                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'dealer_customer_list',

                exportOptions: {
                    columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');

                }
            }


        ]

    });

    // search fileter for customertable
    jQuery('#customertable_filter input').unbind().bind('keyup', function () {
        var colIndex = document.querySelector('#customertable-select').selectedIndex;
        customertable.column(colIndex).search(this.value).draw();
    });

    jQuery('#customertable-select').change(function () {
        customertable.columns().search('').draw();
    });


    jQuery.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }




    //Search submit
    jQuery(document).on("click", "#search_submit", function (e) {
        var member_code = jQuery('#member_code').val();
        var first_name = jQuery('#first_name').val();
        var last_name = jQuery('#last_name').val();
        var address = jQuery('#address').val();
        var phone_number = jQuery('#phone_number').val();
        var email = jQuery('#email').val();
        var city = jQuery('#city').val();
        var state = jQuery('#state').val();
        var zip_code = jQuery('#zip_code').val();
        var plan_id = jQuery('#plan_id').val();
        var dealer_name = jQuery('#dealer_name').val();
        var vehicle_year = jQuery('#vehicle_year').val();
        var vehicle_make = jQuery('#vehicle_make').val();
        var vehicle_model = jQuery('#vehicle_model').val();
        var vehicle_vin = jQuery('#vehicle_vin').val();



        var data = {
            action: 'dealer_distributor_reports',
            member_code: member_code,
            first_name: first_name,
            last_name: last_name,
            address: address,
            phone_number: phone_number,
            email: email,
            city: city,
            state: state,
            zip_code: zip_code,
            plan_id: plan_id,
            dealer_name: dealer_name,
            vehicle_year: vehicle_year,
            vehicle_make: vehicle_make,
            vehicle_model: vehicle_model,
            vehicle_vin: vehicle_vin

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

                jQuery('#search_tbl').DataTable({
                    dom: 'Bfrtip',
                    orderCellsTop: true,
                    fixedHeader: true,
                    buttons: [
                        {
                            extend: 'csv',
                            //Name the CSV
                            filename: 'reports',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            filename: 'reports',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                        },
                        {
                            extend: 'excel',
                            text: 'EXCEL',
                            filename: 'reports',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                        },
                        {
                            extend: 'print',
                            text: 'PRINT',
                            filename: 'reports',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 5]
                            },
                            customize: function (win) {
                                jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');

                            }
                        }
                    ]
                    // filename: 'dealer_list',
                });


            },

        });

    });

    jQuery(document).on("click", "#search_reset", function (e) {
        location.reload();
    });

    jQuery(document).on("click", ".view-data", function (e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id")

        var data = {
            action: 'dealer_distributor_view_data_reports',
            id: id,

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

    jQuery("[data-scroll-to]").click(function () {
        var $this = jQuery(this),
            $toElement = $this.attr('data-scroll-to'),
            $focusElement = $this.attr('data-scroll-focus'),
            $offset = $this.attr('data-scroll-offset') * 1 || 0,
            $speed = $this.attr('data-scroll-speed') * 1 || 500;

        jQuery('html, body').animate({
            scrollTop: jQuery($toElement).offset().top + $offset
        }, $speed);

        if ($focusElement) jQuery($focusElement).focus();
    });

    // jQuery( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    // jQuery( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd' });


    jQuery(document).on("click", "#date_submit", function (e) {
        jQuery('.error').remove();
        var validflag = true;
        var datepicker1 = jQuery('#datepicker1').val();

        var datepicker2 = jQuery('#datepicker2').val();
        var select = jQuery('#quick_filters').val();


        if (jQuery('#quick_filters').val().trim() == "0") {
            jQuery('#quick_filters').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#quick_filters').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#quick_filters').css({ 'color': '#333333' });
        }

        var data = {
            action: 'dealer_distributor_quick_filters',
            datepicker1: datepicker1,
            datepicker2: datepicker2,
            select: select,

        };

        jQuery('.perma-loader').show();
        if (!validflag) {
            jQuery('.perma-loader').hide();
            return validflag;
        } else {
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

                    jQuery('#search_tbl').DataTable({
                        dom: 'Bfrtip',
                        orderCellsTop: true,
                        fixedHeader: true,
                        buttons: [
                            {
                                extend: 'csv',
                                //Name the CSV
                                filename: 'quick_filters',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 5]
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                filename: 'quick_filters',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 5]
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'EXCEL',
                                filename: 'quick_filters',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 5]
                                },
                            },
                            {
                                extend: 'print',
                                text: 'PRINT',
                                filename: 'quick_filters',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 5]
                                },
                                customize: function (win) {
                                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '15px');

                                }
                            }
                        ]
                        // filename: 'dealer_list',
                    });

                },

            });
            return false;
        }
        // alert(datepicker1 + ' ' + datepicker2 + ' ' + select);
    });


    jQuery(document).on("change", "#quick_filters", function (e) {
        jQuery(this).css({ 'border-color': '#cccccc' });
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();

        // jQuery('#datepicker1').removeAttr("disabled");
        // jQuery('#datepicker2').removeAttr("disabled");
        jQuery("#datepicker1").remove();
        jQuery("#datepicker2").remove();

        var select = jQuery(this).val();

        if (select == 0) {
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',

            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',


            });
        }

        if (select == 1) {
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
        if (select == 2) {
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
        if (select == 3) {
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',

            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',


            });
        }
    });

    jQuery(document).on("focus", "#datepicker1,#datepicker2,#membership_datepicker1, #membership_datepicker2", function (e) {
        jQuery(this).css({ 'border-color': '#cccccc' });
        jQuery(this).css({ 'color': '#555' });
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("focus", ".filter-package", function (e) {
        jQuery(this).find('.error').remove();
    });


    var mebership_info_table = jQuery('#mebership_info_table').DataTable({
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
                    columns: [0, 1, 2, 3, 4, 5]
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                filename: 'mebership_info',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
            },
            {
                extend: 'excel',
                text: 'EXCEL',
                filename: 'mebership_info',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
            },
            {
                extend: 'print',
                text: 'PRINT',
                filename: 'mebership_info',

                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                customize: function (win) {
                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');

                }
            }


        ]

    });

    jQuery("#membership_datepicker1").datepicker({ dateFormat: 'yy-mm-dd' });
    jQuery("#membership_datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });

    jQuery(document).on("click", "#membership_date_submit", function (e) {
        jQuery('.error').remove();
        var validflag = true;

        var datepicker1 = jQuery('#membership_datepicker1').val();
        var datepicker2 = jQuery('#membership_datepicker2').val();
        var view_membership = jQuery('#view_membership').val();
        var policy = jQuery('#policy').val();
        var package = jQuery('#benefit_packages').val();

        if (view_membership != undefined) {
            var data = {
                action: 'membership_date_filter',
                view_membership: view_membership,
                datepicker1: datepicker1,
                datepicker2: datepicker2,
                policy: policy,
                package: package
            }
        } else {
            var data = {
                action: 'membership_date_filter',
                // membership_login_id : membership_login_id,
                datepicker1: datepicker1,
                datepicker2: datepicker2,
                policy: policy,
                package: package
            }
        }

        if (policy != '' && package == '') {
            jQuery('#benefit_packages').css({ 'border': '1px solid #ff0000', 'color': '#ff0000' });
            jQuery('#benefit_packages').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#benefit_packages').css({ 'color': '#333333' });
        }
        if (!validflag) {
            jQuery('.perma-admin-loader').hide();
            return validflag;
        } else {
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
                    jQuery('#mebership_date_table').DataTable({
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
                                    columns: [0, 1, 2, 3, 4, 5]
                                },
                            },
                            {
                                extend: 'pdfHtml5',
                                text: 'PDF',
                                filename: 'mebership_info',
                                orientation: 'landscape',
                                pageSize: 'LEGAL',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                },
                            },
                            {
                                extend: 'excel',
                                text: 'EXCEL',
                                filename: 'mebership_info',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                },
                            },
                            {
                                extend: 'print',
                                text: 'PRINT',
                                filename: 'mebership_info',

                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                },
                                customize: function (win) {
                                    jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');

                                }
                            }


                        ]
                        // filename: 'dealer_list',
                    });

                },

            });
        }
    });

    jQuery(document).on("change", "#policy", function (e) {
        var select_val = jQuery(this).val();
        if (select_val == '') {
            jQuery('.filter-package').css('display', 'none');
        } else {
            jQuery('.filter-package').removeAttr('style')
        }
    });

    jQuery(document).on("click", "#pmsafe_contact_info_mail", function (e) {
        var contact_id = jQuery(this).attr('data-id');

        var data = {
            action: 'send_reset_mail',
            contact_id: contact_id
        };

        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-loader').hide();
                // location.reload();
            }
        });// ajax

    });

    jQuery('.card-main-wrapper').paginate({
        scope: jQuery('div'), // targets all div elements
        perPage: 3,
    });
    jQuery('.contact-card-main-wrapper').paginate({
        scope: jQuery('div'), // targets all div elements
        perPage: 3,
    });

    jQuery(document).on("click", "#pmsafe_dealers_contact_edit", function (e) {
        jQuery("#edit-contact-person-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
        var contact_id = jQuery(this).attr('data-id');
        var data = {
            action: 'fetch_dealer_contact_information',
            contact_id: contact_id
        }
        jQuery('.perma-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('.perma-loader').hide();
                var obj = jQuery.parseJSON(response);
                jQuery('#edit_dealer_contact_fname').val(obj.fname);
                jQuery('#edit_dealer_contact_lname').val(obj.lname);
                jQuery('#edit_dealer_contact_phone').val(obj.phone);
                jQuery('#edit_dealer_contact_email').val(obj.email);
                jQuery('#contact_person_id').val(obj.contact_id);

            }
        });// ajax
    });

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

    jQuery(document).on("click", ".generate_dealer_contact_password", function (e) {

        var field = jQuery(this).closest('div').find('input[rel="gp"]');
        // alert(field);
        jQuery('#edit_dealer_contact_password').css("display", "inline-block");
        field.val(randomPassword(10));

    });

    jQuery(document).on("click", "#edit_new_contact_person", function (e) {


        jQuery('.error').remove();

        var validflag = true;
        var fname = jQuery('#edit_dealer_contact_fname').val();
        var lname = jQuery('#edit_dealer_contact_lname').val();
        var phone = jQuery('#edit_dealer_contact_phone').val();
        var email = jQuery('#edit_dealer_contact_email').val();
        var password = jQuery('#edit_dealer_contact_password').val();

        var contact_id = jQuery('#contact_person_id').val();


        var name = /^[A-Za-z]+$/;
        if (jQuery('#edit_dealer_contact_fname').val().trim() == "") {
            jQuery('#edit_dealer_contact_fname').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#edit_dealer_contact_fname').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_fname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_fname').css({ 'color': '#333333' });
        }

        if (jQuery('#edit_dealer_contact_lname').val().trim() == "") {
            jQuery('#edit_dealer_contact_lname').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(lname.match(name))) {

            jQuery('#edit_dealer_contact_lname').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_lname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_lname').css({ 'color': '#333333' });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#edit_dealer_contact_phone').val().trim() == '') {
            jQuery('#edit_dealer_contact_phone').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_phone').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#edit_dealer_contact_phone').val().match(numbers))) {
            jQuery('#edit_dealer_contact_phone').css({ 'border': '1px solid #ff0000' });
            jQuery('#edit_dealer_contact_phone').after("<span class='error'>Please enter 10 digit phone number.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_phone').css({ 'border-color': '#cccccc' });
        }

        var data = {
            action: 'edit_dealer_contact_info',
            fname: fname,
            lname: lname,
            phone: phone,
            email: email,
            password: password,
            contact_id: contact_id
        };

        if (!validflag) {

            return validflag;
        } else {

            jQuery('.perma-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-loader').hide();
                    location.reload();
                }
            });// ajax
        }
    });

    jQuery(document).on("click", "#customer_report", function (e) {

        var id = jQuery(this).attr('data-id');

        var data = {
            action: 'add_login_session',
            id: id
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {


            }
        });// ajax

    });

    jQuery(document).on('click', '#contact-popup-close', function () {
        jQuery('#contact-user-popup').css('display', 'none');

    });

});