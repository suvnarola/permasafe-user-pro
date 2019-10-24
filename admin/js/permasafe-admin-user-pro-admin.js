jQuery(document).ready(function () {
    var counter = 2;

    // for states

    var availableStates = [{
        label: "ALABAMA",
        value: "AL"
    },
    {
        label: "ALASKA",
        value: "AK"
    },
    {
        label: "AMERICAN SAMOA",
        value: "AS"
    },
    {
        label: "ARIZONA",
        value: "AZ"
    },
    {
        label: "ARKANSAS",
        value: "AR"
    },
    {
        label: "CALIFORNIA",
        value: "CA"
    },
    {
        label: "COLORADO",
        value: "CO"
    },
    {
        label: "CONNECTICUT",
        value: "CT"
    },
    {
        label: "DELAWARE",
        value: "DE"
    },
    {
        label: "DISTRICT OF COLUMBIA",
        value: "DC"
    },
    {
        label: "FEDERATED STATES OF MICRONESIA",
        value: "FM"
    },
    {
        label: "FLORIDA",
        value: "FL"
    },
    {
        label: "GEORGIA",
        value: "GA"
    },
    {
        label: "GUAM GU",
        value: "GU"
    },
    {
        label: "HAWAII",
        value: "HI"
    },
    {
        label: "IDAHO",
        value: "ID"
    },
    {
        label: "ILLINOIS",
        value: "IL"
    },
    {
        label: "INDIANA",
        value: "IN"
    },
    {
        label: "IOWA",
        value: "IA"
    },
    {
        label: "KANSAS",
        value: "KS"
    },
    {
        label: "KENTUCKY",
        value: "KY"
    },
    {
        label: "LOUISIANA",
        value: "LA"
    },
    {
        label: "MAINE",
        value: "ME"
    },
    {
        label: "MARSHALL ISLANDS",
        value: "MH"
    },
    {
        label: "MARYLAND",
        value: "MD"
    },
    {
        label: "MASSACHUSETTS",
        value: "MA"
    },
    {
        label: "MICHIGAN",
        value: "MI"
    },
    {
        label: "MINNESOTA",
        value: "MN"
    },
    {
        label: "MISSISSIPPI",
        value: "MS"
    },
    {
        label: "MISSOURI",
        value: "MO"
    },
    {
        label: "MONTANA",
        value: "MT"
    },
    {
        label: "NEBRASKA",
        value: "NE"
    },
    {
        label: "NEVADA",
        value: "NV"
    },
    {
        label: "NEW HAMPSHIRE",
        value: "NH"
    },
    {
        label: "NEW JERSEY",
        value: "NJ"
    },
    {
        label: "NEW MEXICO",
        value: "NM"
    },
    {
        label: "NEW YORK",
        value: "NY"
    },
    {
        label: "NORTH CAROLINA",
        value: "NC"
    },
    {
        label: "NORTH DAKOTA",
        value: "ND"
    },
    {
        label: "NORTHERN MARIANA ISLANDS",
        value: "MP"
    },
    {
        label: "OHIO",
        value: "OH"
    },
    {
        label: "OKLAHOMA",
        value: "OK"
    },
    {
        label: "OREGON",
        value: "OR"
    },
    {
        label: "PALAU",
        value: "PW"
    },
    {
        label: "PENNSYLVANIA",
        value: "PA"
    },
    {
        label: "PUERTO RICO",
        value: "PR"
    },
    {
        label: "RHODE ISLAND",
        value: "RI"
    },
    {
        label: "SOUTH CAROLINA",
        value: "SC"
    },
    {
        label: "SOUTH DAKOTA",
        value: "SD"
    },
    {
        label: "TENNESSEE",
        value: "TN"
    },
    {
        label: "TEXAS",
        value: "TX"
    },
    {
        label: "UTAH",
        value: "UT"
    },
    {
        label: "VERMONT",
        value: "VT"
    },
    {
        label: "VIRGIN ISLANDS",
        value: "VI"
    },
    {
        label: "VIRGINIA",
        value: "VA"
    },
    {
        label: "WASHINGTON",
        value: "WA"
    },
    {
        label: "WEST VIRGINIA",
        value: "WV"
    },
    {
        label: "WISCONSIN",
        value: "WI"
    },
    {
        label: "WYOMING",
        value: "WY"
    },
    {
        label: "ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST",
        value: "AE"
    },
    {
        label: "ARMED FORCES AMERICA (EXCEPT CANADA)",
        value: "AA"
    },
    {
        label: "ARMED FORCES PACIFIC",
        value: "AP"
    }
    ];

    var state_options = {
        source: availableStates
    };

    jQuery(document).on('keydown.autocomplete', '#pmsafe_customer_state', function () {
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

    jQuery(document).on('keydown.autocomplete', '#pmsafe_customer_vehicle_make', function () {
        jQuery(this).autocomplete(manufacurers_options);
    })

    // add distributor
    jQuery(document).on("click", "#pmsafe_distributors_submit", function (e) {

        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;

        //Name
        if (jQuery('#pmsafe_distributor_name').val().trim() == "") {
            jQuery('#pmsafe_distributor_name').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_distributor_name').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;

        if (jQuery('#pmsafe_distributor_phone_number').val() != '') {
            if (!(jQuery('#pmsafe_distributor_phone_number').val().match(numbers))) {

                jQuery('#pmsafe_distributor_phone_number').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_distributor_phone_number').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_distributor_phone_number').css({
                    'border-color': '#cccccc'
                });
            }
        }



        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_register_distributor_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_register_distributor_form');

            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        window.location.replace(obj.redirect);
                    }
                    if (obj.status == false) {
                        swal("Error", "", "warning");
                    }
                }
            }); // ajax
            return false;
        }
    }); // submit button 


    // Focus and blure 
    jQuery('#pmsafe_distributor_name, #pmsafe_distributor_email, #pmsafe_distributor_password, #pmsafe_distributor_store_address, #pmsafe_distributor_phone_number').focus(function () {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_distributor_name, #pmsafe_distributor_email, #pmsafe_distributor_password, #pmsafe_distributor_store_address, #pmsafe_distributor_phone_number').blur(function () {
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });


    //add textbox

    //add new distributor contact
    jQuery('#add_new').click(function () {
        // var counter = 1;
        // counter++;

        if (counter > 10) {
            alert("Only 10 textboxes allow");
            return false;
        }
        var newTextBoxDiv = jQuery(document.createElement('div')).attr("id", 'fname_div' + counter).addClass('is-validate');


        newTextBoxDiv.after().html('<h3 style="color:#0065a7">Contact Person\'s Information:<i class="fa fa-trash" id="removeButton_distributor" style="cursor:pointer;color: #fff;float: right;background: #ff0000;padding: 5px;border-radius: 50%;"></i></h3>' + '<div class="nisl-wrap"><label><strong>First Name:</strong></label><input type="text" id="pmsafe_distributor_contact_fname' + counter + '" name="pmsafe_distributor_contact_fname[]" value="" class="widefat check-fname"/></div><div class="nisl-wrap"><label><strong>Last Name:</strong></label><input type="text" id="pmsafe_distributor_contact_lname' + counter + '" name="pmsafe_distributor_contact_lname[]" value="" class="widefat check-lname"/></div><div class="nisl-wrap"><label><strong>Phone Number:</strong></label><input type="text" id="pmsafe_distributor_contact_phone' + counter + '" name="pmsafe_distributor_contact_phone[]" value="" class="widefat check-phone"/></div><div class="nisl-wrap"><label><strong>Email:</strong></label><input type="text" id="pmsafe_distributor_contact_email' + counter + '" name="pmsafe_distributor_contact_email[]" value="" class="widefat check-mail"style="width:35%"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;"> (This will be the Username for this person to Login)</span></div><div class="nisl-wrap"><label><strong>Password:</strong></label><input type="text" rel="gp" name="pmsafe_distributor_contact_password[]" value="" class="widefat check-password" style="width:35%"/><input type="button" value="Generate Password" class="generate_distributor_contact_password" /></div>');
        newTextBoxDiv.appendTo("#fname_divgroup");
        counter++;
    });

    //remove textbox
    jQuery(document).on("click", "#removeButton_distributor", function (e) {

        if (counter == 2) {
            jQuery("#fname_div" + counter).remove();
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
    jQuery(document).on("click", "#pmsafe_distributors_update", function (e) {
        // alert('in');
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        //Name
        if (jQuery('#pmsafe_distributor_name').val().trim() == "") {
            jQuery('#pmsafe_distributor_name').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_distributor_name').css({
                'color': '#333333'
            });
        }

        //Email     
        if (jQuery('#pmsafe_distributor_email').val().trim() == '') {
            jQuery('#pmsafe_distributor_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#pmsafe_distributor_email').val()) {
                var email = jQuery("#pmsafe_distributor_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#pmsafe_distributor_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#pmsafe_distributor_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#pmsafe_distributor_email').css({
                        'color': '#333333'
                    });
                }
            }
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_distributor_phone_number').val() != '') {
            if (!(jQuery('#pmsafe_distributor_phone_number').val().match(numbers))) {

                jQuery('#pmsafe_distributor_phone_number').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_distributor_phone_number').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_distributor_phone_number').css({
                    'border-color': '#cccccc'
                });
            }
        }


        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_distributor_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_edit_distributor_form');

            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        window.location.replace(obj.redirect);
                    }
                }
            }); // ajax
            return false;
        }
    }); // update button 


    // delete distributor
    jQuery(document).on("click", "#pmsafe_distributors_delete", function (e) {
        // alert('in');
        e.preventDefault();

        var pmsafe_distributor_id = jQuery(this).attr('data-id');

        var data = {
            action: 'pmsafe_delete_distributor_form',
            pmsafe_distributor_id: pmsafe_distributor_id

        }

        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'post',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {

                            swal({
                                title: "Deleted!",
                                text: "Distributor has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                window.location.replace(obj.redirect);
                            })
                        }
                    }
                }); // ajax
            } else {
                swal("Distributor is not deleted !");
            }
        });
        return false;

    }); // delete button 


    //add dealer
    jQuery(document).on("click", "#pmsafe_dealers_submit", function (e) {

        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        //Name
        if (jQuery('#pmsafe_dealer_name').val().trim() == "") {
            jQuery('#pmsafe_dealer_name').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_name').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_dealer_phone_number').val() != '') {
            if (!(jQuery('#pmsafe_dealer_phone_number').val().match(numbers))) {

                jQuery('#pmsafe_dealer_phone_number').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_dealer_phone_number').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_dealer_phone_number').css({
                    'border-color': '#cccccc'
                });
            }
        }

        //select 
        if (jQuery('#pmsafe_dealer_distributor').val().trim() == "") {
            jQuery('#pmsafe_dealer_distributor').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_distributor').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_distributor').css({
                'color': '#333333'
            });
        }

        if (jQuery('#select_rem_address').val().trim() == "") {
            jQuery('#select_rem_address').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#select_rem_address').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#select_rem_address').css({
                'color': '#333333'
            });
        }


        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_register_dealer_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_register_dealer_form');

            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        window.location.replace(obj.redirect);
                    }
                    if (obj.status == false) {
                        swal("Error", "", "warning");
                    }
                }
            }); // ajax
            return false;
        }
    }); // submit button 

    // Focus and blure dealers
    jQuery('#pmsafe_dealer_name,#pmsafe_dealer_email, #pmsafe_dealer_password, #pmsafe_dealer_store_address, #pmsafe_dealer_phone_number,#pmsafe_dealer_distributor,#select_rem_address').focus(function () {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_dealer_name,#pmsafe_dealer_email, #pmsafe_dealer_password, #pmsafe_dealer_store_address, #pmsafe_dealer_phone_number,#pmsafe_dealer_distributor,#select_rem_address').blur(function () {
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });




    // update dealer
    jQuery(document).on("click", "#pmsafe_dealers_update", function (e) {
        // alert('in');
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        //Name
        if (jQuery('#pmsafe_dealer_name').val().trim() == "") {
            jQuery('#pmsafe_dealer_name').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_name').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_name').css({
                'color': '#333333'
            });
        }

        //Email     
        if (jQuery('#pmsafe_dealer_email').val().trim() == '') {
            jQuery('#pmsafe_dealer_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#pmsafe_dealer_email').val()) {
                var email = jQuery("#pmsafe_dealer_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#pmsafe_dealer_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#pmsafe_dealer_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#pmsafe_dealer_email').css({
                        'color': '#333333'
                    });
                }
            }
        }
        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_dealer_phone_number').val() != '') {
            if (!(jQuery('#pmsafe_dealer_phone_number').val().match(numbers))) {

                jQuery('#pmsafe_dealer_phone_number').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_dealer_phone_number').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_dealer_phone_number').css({
                    'border-color': '#cccccc'
                });
            }
        }


        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_dealer_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_edit_dealer_form');

            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    console.log(response);
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        window.location.replace(obj.redirect);
                    }

                }
            }); // ajax
            return false;
        }
    }); // update button 

    // delete dealer
    jQuery(document).on("click", "#pmsafe_dealers_delete", function (e) {

        e.preventDefault();

        var pmsafe_dealer_id = jQuery(this).attr('data-id');

        var data = {
            action: 'pmsafe_delete_dealer_form',
            pmsafe_dealer_id: pmsafe_dealer_id

        }

        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {
                            swal({
                                title: "Deleted!",
                                text: "Dealer has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                window.location.replace(obj.redirect);
                            })
                        }
                    }
                }); // ajax

            } else {
                swal("Dealer is not deleted !");
            }
        });
        return false;

    }); // delete button 

    // delete dealers contact 
    jQuery(document).on("click", "#pmsafe_dealers_contact_delete", function (e) {

        e.preventDefault();
        var contact_id = jQuery(this).attr("data-id");

        var data = {
            action: 'pmsafe_delete_dealer_contact_form',
            contact_id: contact_id
        }




        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {
                            swal({
                                title: "Deleted!",
                                text: "Contact user has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                location.reload();
                            })

                            // window.location.replace(obj.redirect);
                        }
                    }
                }); // ajax
            } else {
                swal("Contact user is not deleted !");
            }
        });
        return false;

    }); // delete button 

    jQuery(document).on("click", "#pmsafe_distributors_contact_delete", function (e) {

        e.preventDefault();
        var contact_id = jQuery(this).attr("data-id");

        var data = {
            action: 'pmsafe_delete_distributor_contact_form',
            contact_id: contact_id
        }




        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {
                            swal({
                                title: "Deleted!",
                                text: "Contact user has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                location.reload();
                            })
                        }
                    }
                }); // ajax
            } else {
                swal("Contact user is not deleted !");
            }
        });
        return false;

    }); // delete button 


    jQuery(document).on("change", "#pmsafe_distributor", function (e) {

        e.preventDefault();
        var isDisabled = jQuery("#pmsafe_dealer").prop('disabled');
        if (isDisabled) {
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
    }); // select 

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
    jQuery(document).on("click", "#generate_dealer_password", function (e) {

        jQuery('#pmsafe_dealer_password').css("display", "inline-block");
        jQuery('#pmsafe_dealer_password').val(randomPassword(10));


        jQuery('#cancel_dealer_password').css("display", "inline-block");
        jQuery('#hide_dealer_password').css("display", "inline-block");
        jQuery('#pmsafe_dealer_password').attr("type", "text");
        jQuery('#generate_dealer_password').css("display", "none");

    });

    jQuery(document).on("click", "#cancel_dealer_password", function (e) {
        jQuery('#pmsafe_dealer_password').css("display", "none");
        jQuery('#cancel_dealer_password').css("display", "none");
        jQuery('#hide_dealer_password').css("display", "none");
        jQuery('#show_dealer_password').css("display", "none");
        jQuery('#generate_dealer_password').css("display", "inline-block");

    });

    jQuery(document).on("click", "#hide_dealer_password", function (e) {
        jQuery('#pmsafe_dealer_password').attr("type", "password");
        jQuery('#hide_dealer_password').css("display", "none");
        jQuery('#show_dealer_password').css("display", "inline-block");
    });

    jQuery(document).on("click", "#show_dealer_password", function (e) {
        jQuery('#pmsafe_dealer_password').attr("type", "text");
        jQuery('#show_dealer_password').css("display", "none");
        jQuery('#hide_dealer_password').css("display", "inline-block");
    });

    //dealer contact passowrd
    jQuery(document).on("click", ".generate_dealer_contact_password", function (e) {

        var field = jQuery(this).closest('div').find('input[rel="gp"]');
        // alert(field);
        jQuery('#pmsafe_dealer_contact_password').css("display", "inline-block");
        field.val(randomPassword(10));

    });

    //diistributor contact passowrd
    jQuery(document).on("click", ".generate_distributor_contact_password", function (e) {

        var field = jQuery(this).closest('div').find('input[rel="gp"]');
        // alert(field);
        jQuery('#pmsafe_distributor_contact_password').css("display", "inline-block");
        field.val(randomPassword(10));

    });


    //distributor password
    jQuery(document).on("click", "#generate_distributor_password", function (e) {

        jQuery('#pmsafe_distributor_password').css("display", "inline-block");
        jQuery('#pmsafe_distributor_password').val(randomPassword(10));

        jQuery('#cancel_distributor_password').css("display", "inline-block");
        jQuery('#hide_distributor_password').css("display", "inline-block");
        jQuery('#pmsafe_distributor_password').attr("type", "text");
        jQuery('#generate_distributor_password').css("display", "none");

    });
    jQuery(document).on("click", "#cancel_distributor_password", function (e) {
        jQuery('#pmsafe_distributor_password').css("display", "none");
        jQuery('#cancel_distributor_password').css("display", "none");
        jQuery('#hide_distributor_password').css("display", "none");
        jQuery('#show_distributor_password').css("display", "none");
        jQuery('#generate_distributor_password').css("display", "inline-block");

    });
    jQuery(document).on("click", "#hide_distributor_password", function (e) {
        jQuery('#pmsafe_distributor_password').attr("type", "password");
        jQuery('#hide_distributor_password').css("display", "none");
        jQuery('#show_distributor_password').css("display", "inline-block");
    });
    jQuery(document).on("click", "#show_distributor_password", function (e) {
        jQuery('#pmsafe_distributor_password').attr("type", "text");
        jQuery('#show_distributor_password').css("display", "none");
        jQuery('#hide_distributor_password').css("display", "inline-block");
    });

    // customer password
    jQuery(document).on("click", "#generate_customer_password", function (e) {
        jQuery('#pmsafe_customer_password').css("display", "inline-block");
        jQuery('#pmsafe_customer_password').val(randomPassword(10));

        jQuery('#cancel_customer_password').css("display", "inline-block");
        jQuery('#hide_customer_password').css("display", "inline-block");
        jQuery('#pmsafe_customer_password').attr("type", "text");
        jQuery('#generate_customer_password').css("display", "none");

    });
    jQuery(document).on("click", "#cancel_customer_password", function (e) {
        jQuery('#pmsafe_customer_password').css("display", "none");
        jQuery('#cancel_customer_password').css("display", "none");
        jQuery('#hide_customer_password').css("display", "none");
        jQuery('#hide_customer_password').css("display", "none");
        jQuery('#show_customer_password').css("display", "inline-block");

    });
    jQuery(document).on("click", "#hide_customer_password", function (e) {
        jQuery('#pmsafe_customer_password').attr("type", "password");
        jQuery('#hide_customer_password').css("display", "none");
        jQuery('#show_customer_password').css("display", "inline-block");
    });
    jQuery(document).on("click", "#show_customer_password", function (e) {
        jQuery('#pmsafe_customer_password').attr("type", "text");
        jQuery('#show_customer_password').css("display", "none");
        jQuery('#hide_customer_password').css("display", "inline-block");
    });

    // export csv
    jQuery(document).on("click", "#export-dealer-csv", function (e) {
        e.preventDefault();
        var hdn_dealer_login = jQuery('#hdn_dealer_login').val();
        var hdn_dealer_name = jQuery('#hdn_dealer_name').val();

        var data = {
            action: 'get_csv_data',
            dealer_login: hdn_dealer_login
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {

                jQuery('<a></a>')
                    .attr('id', 'downloadFile')
                    .attr('href', 'data:text/csv;charset=utf8,' + encodeURIComponent(response.trim()))
                    .attr('download', hdn_dealer_login + '_' + hdn_dealer_name + '.csv')
                    .appendTo('body');

                jQuery('#downloadFile').ready(function () {
                    jQuery('#downloadFile').get(0).click();
                });
            },
            dataType: 'html'
        });
        return false;
    });

    // export csv
    jQuery(document).on("click", "#export-dealer-customer-csv", function (e) {
        e.preventDefault();

        var hdn_dealer_login = jQuery('#hdn_customer_dealer_login').val();


        var data = {
            action: 'get_customer_csv_data',
            customer_dealer_login: hdn_dealer_login
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('<a></a>')
                    .attr('id', 'downloadcustomerFile')
                    .attr('href', 'data:text/csv;charset=utf8,' + encodeURIComponent(response.trim()))
                    .attr('download', hdn_dealer_login + '.csv')
                    .appendTo('body');

                jQuery('#downloadcustomerFile').ready(function () {
                    jQuery('#downloadcustomerFile').get(0).click();
                });

            },
            dataType: 'html'
        });
        return false;
    });

    jQuery("#pmsafe_invitation_code_end, #pmsafe_invitation_code_start").focusout(function () {
        var start = jQuery('#pmsafe_invitation_code_start').val();
        var end = jQuery('#pmsafe_invitation_code_end').val();
        if (start || end) {
            var data = {
                action: 'check_code_exist',
                start: start,
                end: end
            };
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    // console.log(obj);
                    if (obj.status == true) {
                        jQuery(".code-exist").css("display", "block");
                        jQuery("#publish").attr("disabled", "disabled");


                    }
                    if (obj.status == false) {
                        if (end == '' || start == '') {
                            jQuery(".code-exist").css("display", "none");
                            jQuery("#publish").attr("disabled", "disabled");
                        } else {

                            if (start > end || start == end) {

                                jQuery(".code-range").css("display", "block");
                                jQuery("#publish").attr("disabled", "disabled");
                            } else {
                                jQuery("#publish").removeAttr("disabled", "disabled");
                                jQuery(".code-exist").css("display", "none");
                            }
                        }
                    }

                },
                dataType: 'html'
            });
        } else {
            jQuery("#publish").attr("disabled", "disabled");
        }
        return false;

    });

    jQuery("#pmsafe_invitation_code").focusout(function () {
        var code = jQuery('#pmsafe_invitation_code').val();

        if (code) {
            var data = {
                action: 'check_invite_code_exist',
                code: code

            };
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {
                    var obj = jQuery.parseJSON(response);
                    // var obj = jQuery.parseJSON(response);
                    // console.log(obj);
                    if (obj.status == true) {
                        jQuery(".code-exist").css("display", "block");
                        jQuery("#publish").attr("disabled", "disabled");


                    }
                    if (obj.status == false) {
                        if (code == '') {
                            jQuery(".code-exist").css("display", "none");
                            jQuery("#publish").attr("disabled", "disabled");
                        } else {


                            jQuery("#publish").removeAttr("disabled", "disabled");
                            jQuery(".code-exist").css("display", "none");

                        }
                    }

                },
                dataType: 'html'
            });
        } else {
            jQuery("#publish").attr("disabled", "disabled");
        }
        return false;

    });

    jQuery("#pmsafe_invitation_code_start").focus(function () {
        jQuery(".code-exist").css("display", "none");
        jQuery(".code-range").css("display", "none");
    });
    jQuery("#pmsafe_invitation_code_end").focus(function () {
        jQuery(".code-exist").css("display", "none");
        jQuery(".code-range").css("display", "none");
    });


    jQuery(document).on("click", "#update_code_button", function (e) {

        var post_id = jQuery.urlParam('post');

        var code_access_leval = jQuery('select[name="pmsafe_user_role"]').find(":selected").val();
        var benifit_package = jQuery('select[name="pmsafe_invitation_prefix"]').find(":selected").val();
        var dealer = jQuery('select[name="pmsafe_dealer"]').find(":selected").val();
        var distributor = jQuery('select[name="pmsafe_distributor"]').find(":selected").val();

        var selectedprefix = new Array();
        jQuery('input[name="pmsafe_invitation_upgradable_prefix"]:checked').each(function () {
            selectedprefix.push(this.value);
        });


        var chk = jQuery('#pmsafe_invitation_code_upgradable').prop("checked");
        var allow_dealer = jQuery('#pmsafe_code_allow_dealer').prop("checked");
        if (chk == true) {
            chk = 1;
        }
        if (chk == false) {
            chk = 0;
        }

        if (allow_dealer == true) {
            allow_dealer = 1;
        }
        if (allow_dealer == false) {
            allow_dealer = 0;
        }


        var data = {
            action: 'update_batch_codes',
            post_id: post_id,
            code_access_leval: code_access_leval,
            benifit_package: benifit_package,
            dealer: dealer,
            distributor: distributor,
            prefix_arr: selectedprefix,
            chk: chk,
            allow_dealer: allow_dealer
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                if (obj.status == true) {
                    location.reload();
                }
            },
            dataType: 'html'
        });
        return false;
    });

    jQuery(document).on("click", "#update_invite_code_button", function (e) {

        var post_id = jQuery.urlParam('post');

        var benifit_package = jQuery('select[name="pmsafe_invitation_prefix"]').find(":selected").val();
        var dealer = jQuery('select[name="pmsafe_dealer"]').find(":selected").val();
        var distributor = jQuery('select[name="pmsafe_distributor"]').find(":selected").val();

        var selectedprefix = new Array();
        jQuery('input[name="pmsafe_invitation_upgradable_prefix"]:checked').each(function () {
            selectedprefix.push(this.value);
        });

        var chk = jQuery('#pmsafe_invitation_code_upgradable').prop("checked");
        var allow_dealer = jQuery('#pmsafe_code_allow_dealer').prop("checked");
        if (chk == true) {
            chk = 1;
        }
        if (chk == false) {
            chk = 0;
        }

        if (allow_dealer == true) {
            allow_dealer = 1;
        }
        if (allow_dealer == false) {
            allow_dealer = 0;
        }
        var data = {
            action: 'update_invite_codes',
            post_id: post_id,
            benifit_package: benifit_package,
            dealer: dealer,
            distributor: distributor,
            chk: chk,
            allow_dealer: allow_dealer,
            prefix_arr: selectedprefix
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                if (obj.status == true) {
                    location.reload();
                }
            },
            dataType: 'html'
        });
        return false;
    });


    jQuery(document).on("click", "#delete_invitation_code", function (e) {

        var post_id = jQuery(this).attr('data-id');

        var data = {
            action: 'delete_invite_codes',
            post_id: post_id,
        };
        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        swal({
                            title: "Deleted!",
                            text: "Invitation Code has been deleted. Press OK button.",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })
                    },
                    dataType: 'html'
                });
                return false;
            } else {
                swal("Invitation Code is not deleted !");
            }
        });
    });

    jQuery(document).on("click", "#delete_code_button", function (e) {


        var post_id = jQuery(this).attr('data-id');

        // alert(code_access_leval + ' ' + dealer + ' ' + distributor + ' ' + benifit_package);

        var data = {
            action: 'delete_batch_codes',
            post_id: post_id,

        };

        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {
                            swal({
                                title: "Deleted!",
                                text: "Batch Code has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                window.location.replace(obj.redirect);
                            })
                        }
                    },
                    dataType: 'html'
                });


            } else {
                swal("Batch Code is not deleted !");
            }
        });
        return false;



    });

    jQuery.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results) {
            return results[1] || 0;
        } else {
            return '';
        }
    }


    //reset jquery

    // export csv
    jQuery(document).on("click", "#reset-code", function (e) {
        e.preventDefault();

        var post_id = jQuery(this).attr("data-id")

        // alert(post_id);

        var data = {
            action: 'reset_code',
            post_id: post_id
        };
        swal({
            title: "Are you sure?",
            text: "It will reset code!",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        swal({
                            title: "Reset Successfully!",
                            text: "Invitation Code has been Reseted. Press OK button.",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })

                    },
                    dataType: 'html'
                });
                return false;
            } else {
                swal("Invitaion Code is not reseted !");
            }
        });
    });

    jQuery(document).on("click", "#search-batch-code", function (e) {
        e.preventDefault();
        jQuery('.error').remove();
        var validflag = true;
        var search_val = jQuery('#search-input').val();

        if (jQuery('#search-input').val().trim() == "") {
            jQuery('#search-input').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#search-input').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#search-input').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'search_batch_code',
            search_val: search_val
        };
        if (!validflag) {
            return validflag;
        } else {
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

    jQuery(document).on("click", "#search-individual-code", function (e) {
        e.preventDefault();
        jQuery('.error').remove();
        var validflag = true;
        var search_val = jQuery('#individual-search-input').val();

        if (jQuery('#individual-search-input').val().trim() == "") {
            jQuery('#individual-search-input').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#individual-search-input').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#individual-search-input').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'search_individual_code',
            search_val: search_val
        };
        if (!validflag) {
            return validflag;
        } else {
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

    jQuery(document).on("focus", "#search-input,#individual-search-input", function (e) {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("keypress", "#search-input", function (e) {

        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            e.preventDefault();
            jQuery('.error').remove();

            var validflag = true;
            var search_val = jQuery('#search-input').val()

            if (jQuery('#search-input').val().trim() == "") {
                jQuery('#search-input').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#search-input').after("<span class='error'>This field is required.</span>");
                validflag = false;
            } else {
                jQuery('#search-input').css({
                    'color': '#333333'
                });
            }

            var data = {
                action: 'search_batch_code',
                search_val: search_val
            };
            if (!validflag) {
                return validflag;
            } else {
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

    jQuery(document).on("keypress", "#individual-search-input", function (e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            e.preventDefault();
            jQuery('.error').remove();
            var validflag = true;
            var search_val = jQuery('#individual-search-input').val();

            if (jQuery('#individual-search-input').val().trim() == "") {
                jQuery('#individual-search-input').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#individual-search-input').after("<span class='error'>This field is required.</span>");
                validflag = false;
            } else {
                jQuery('#individual-search-input').css({
                    'color': '#333333'
                });
            }

            var data = {
                action: 'search_individual_code',
                search_val: search_val
            };
            if (!validflag) {
                return validflag;
            } else {
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

    var view_customer_table = jQuery('#view_customer_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pagingType": "input",
        "order": [
            [17, "desc"]
        ],
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [{
            type: 'natural-nohtml',
            targets: 0
        }],
        buttons: [{
            extend: 'csv',
            //Name the CSV
            filename: 'customer_list',
            exportOptions: {
                columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
            },
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            filename: 'customer_list',
            exportOptions: {
                columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
            },
        },
        {
            extend: 'excel',
            text: 'EXCEL',
            filename: 'customer_list',
            exportOptions: {
                columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
            },
        },
        {
            extend: 'print',
            text: 'PRINT',
            filename: 'customer_list',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            exportOptions: {
                columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                // columns: [0, 1, 2, 3, 4, 5, 6, 8, 9, 11 ]
            },
            customize: function (win) {
                jQuery(win.document.body).find('table').addClass('display').css('font-size', '5px');

            }
        }
        ]
        // filename: 'dealer_list',
    });
    jQuery("#view_customer_table_paginate .paginate_input").on('keyup', function () {
        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);
    });

    jQuery('#view_customer_table').on('page.dt', function () {

        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);

    });


    // search fileter for view_customer_table
    jQuery('#view_customer_table_filter input').unbind().bind('keyup', function () {
        var colIndex = document.querySelector('#view-customer-table-select').selectedIndex;
        var val = jQuery.fn.dataTable.util.escapeRegex(
            jQuery(this).val()
        );
        view_customer_table.column(colIndex).search(val ? '^' + val + '$' : '', true, false).draw();
    });

    jQuery('#view-customer-table-select').change(function () {
        view_customer_table.columns().search('').draw();
    });





    // update customer
    jQuery(document).on("click", "#pmsafe_customer_update", function (e) {
        // alert('in');
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        //Name
        if (jQuery('#pmsafe_customer_fname').val().trim() == "") {
            jQuery('#pmsafe_customer_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_fname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#pmsafe_customer_lname').val().trim() == "") {
            jQuery('#pmsafe_customer_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_lname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#pmsafe_customer_address1').val().trim() == "") {
            jQuery('#pmsafe_customer_address1').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_address1').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_address1').css({
                'color': '#333333'
            });
        }


        //city
        if (jQuery('#pmsafe_customer_city').val().trim() == "") {
            jQuery('#pmsafe_customer_city').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_city').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_city').css({
                'color': '#333333'
            });
        }

        //state
        if (jQuery('#pmsafe_customer_state').val().trim() == "") {
            jQuery('#pmsafe_customer_state').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_state').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_state').css({
                'color': '#333333'
            });
        }


        //zip code
        var numbers = /^[0-9\-]+$/;
        if (jQuery('#pmsafe_customer_zip').val().trim() == '') {
            jQuery('#pmsafe_customer_zip').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_zip').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#pmsafe_customer_zip').val().match(numbers))) {
            jQuery('#pmsafe_customer_zip').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_zip').after("<span class='error'>Please enter valid zip code.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_zip').css({
                'border-color': '#cccccc'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_customer_phone_number').val().trim() == '') {
            ``
            jQuery('#pmsafe_customer_phone_number').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_phone_number').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#pmsafe_customer_phone_number').val().match(numbers))) {

            jQuery('#pmsafe_customer_phone_number').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_phone_number').after("<span class='error'>Please enter 10 digit phone number.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_phone_number').css({
                'border-color': '#cccccc'
            });
        }



        //vehicle year
        var numbers = /^[0-9]+$/;
        if (jQuery('#pmsafe_customer_vehicle_year').val().trim() == '') {
            jQuery('#pmsafe_customer_vehicle_year').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_year').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#pmsafe_customer_vehicle_year').val().match(numbers))) {
            jQuery('#pmsafe_customer_vehicle_year').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_year').after("<span class='error'>Please enter valid Year.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_vehicle_year').css({
                'border-color': '#cccccc'
            });
        }

        //vehicle mileage
        var numbers = /^[0-9]+$/;
        if (jQuery('#pmsafe_customer_vehicle_mileage').val().trim() == '') {
            jQuery('#pmsafe_customer_vehicle_mileage').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_mileage').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#pmsafe_customer_vehicle_mileage').val().match(numbers))) {
            jQuery('#pmsafe_customer_vehicle_mileage').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_mileage').after("<span>Please enter valid mileage.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_vehicle_mileage').css({
                'border-color': '#cccccc'
            });
        }

        //vehicle make
        if (jQuery('#pmsafe_customer_vehicle_make').val().trim() == "") {
            jQuery('#pmsafe_customer_vehicle_make').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_make').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_vehicle_make').css({
                'color': '#333333'
            });
        }

        //vehicle model
        if (jQuery('#pmsafe_customer_vehicle_model').val().trim() == "") {
            jQuery('#pmsafe_customer_vehicle_model').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_model').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_vehicle_model').css({
                'color': '#333333'
            });
        }

        //vehicle vin
        var numbers = /^[0-9A-Z]+$/;
        if (jQuery('#pmsafe_customer_vehicle_vin').val().trim() == '') {
            jQuery('#pmsafe_customer_vehicle_vin').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_vin').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(jQuery('#pmsafe_customer_vehicle_vin').val().match(numbers))) {
            jQuery('#pmsafe_customer_vehicle_vin').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_customer_vehicle_vin').after("<span class='error'>Please enter valid VIN number.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_customer_vehicle_vin').css({
                'border-color': '#cccccc'
            });
        }

        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            var form = jQuery('#perma_edit_customer_form')[0];
            var fd = new FormData(form);
            fd.append('action', 'pmsafe_edit_customer_form');

            jQuery.ajax({
                type: 'post',
                url: pmAjax.ajaxurl,
                processData: false,
                contentType: false,
                data: fd,
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        window.location.replace(obj.redirect);
                        jQuery('.notice').css('display', 'block');
                    }
                    if (obj.status == false) {

                        jQuery('#file_upload').after("<span class='error'>" + obj.error + "</span>");
                    }
                }
            }); // ajax
            return false;
        }
    }); // update button 

    // Focus and blure 
    jQuery('#pmsafe_customer_fname, #pmsafe_customer_lname, #pmsafe_customer_address1, #pmsafe_customer_address2, #pmsafe_customer_city, #pmsafe_customer_state, #pmsafe_customer_zip, #pmsafe_customer_phone_number, #pmsafe_customer_vehicle_year, #pmsafe_customer_vehicle_make, #pmsafe_customer_vehicle_model, #pmsafe_customer_vehicle_vin, #pmsafe_customer_vehicle_mileage, #pmsafe_customer_password ').focus(function () {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });
    jQuery('#pmsafe_customer_fname, #pmsafe_customer_lname, #pmsafe_customer_address1, #pmsafe_customer_address2, #pmsafe_customer_city, #pmsafe_customer_state, #pmsafe_customer_zip, #pmsafe_customer_phone_number, #pmsafe_customer_vehicle_year, #pmsafe_customer_vehicle_make, #pmsafe_customer_vehicle_model, #pmsafe_customer_vehicle_vin, #pmsafe_customer_vehicle_mileage, #pmsafe_customer_password').blur(function () {
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });

    // delete dealer customer
    jQuery(document).on("click", "#pmsafe_customer_delete", function (e) {
        // alert('in');
        e.preventDefault();

        jQuery('.perma-admin-loader').show();
        var form = jQuery('#perma_delete_customer_form')[0];
        var fd = new FormData(form);
        fd.append('action', 'pmsafe_delete_customer_form');

        jQuery.ajax({
            type: 'post',
            url: pmAjax.ajaxurl,
            processData: false,
            contentType: false,
            data: fd,
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                // var obj = jQuery.parseJSON(response);
                // console.log(obj.redirect);
                if (obj.status == true) {

                    window.location.replace(obj.redirect);
                }
            }
        }); // ajax
        return false;

    }); // delete button

    // delete customer
    jQuery(document).on("click", "#pmsafe_customers_delete", function (e) {
        // alert('in');
        e.preventDefault();
        var pmsafe_customer_id = jQuery(this).attr('data-id');
        var data = {
            action: 'pmsafe_delete_customers_form',
            pmsafe_customer_id: pmsafe_customer_id
        }

        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'post',
                    url: pmAjax.ajaxurl,
                    data: data,
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        var obj = jQuery.parseJSON(response);
                        // var obj = jQuery.parseJSON(response);
                        if (obj.status == true) {

                            swal({
                                title: "Deleted!",
                                text: "Customer has been deleted. Press OK button.",
                                icon: "success",
                                closeOnClickOutside: false,
                                closeOnEsc: false,
                            }).then(function () {
                                window.location.replace(obj.redirect);
                            })
                        }
                    }
                }); // ajax
            } else {
                swal("Customer is not deleted !");
            }
        });
        return false;

    }); // delete button

    jQuery(document).on("click", "#search_submit", function (e) {
        var dealer_login = jQuery('#dealer_login').val();
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
            action: 'admin_reports',
            dealer_login: dealer_login,
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

                jQuery('#search_tbl').DataTable({
                    dom: 'Bfrtip',
                    "pagingType": "input",
                    orderCellsTop: true,
                    fixedHeader: true,
                    buttons: [{
                        extend: 'csv',
                        //Name the CSV
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
                        },
                    },
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5]
                        },
                    },
                    {
                        extend: 'print',
                        text: 'PRINT',
                        filename: 'Search Report',
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


    jQuery(document).on("click", ".view-data", function (e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id")

        var data = {
            action: 'admin_view_data_reports',
            id: id,

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

    jQuery(document).on("click", "#search_reset", function (e) {
        location.reload();
    });

    // search all customers 
    jQuery(document).on("click", "#search_all_submit", function (e) {

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
        var dealer_name = jQuery('#pmsafe_dealer').val();
        var distributor_name = jQuery('#pmsafe_distributor').val();
        var vehicle_year = jQuery('#vehicle_year').val();
        var vehicle_make = jQuery('#vehicle_make').val();
        var vehicle_model = jQuery('#vehicle_model').val();
        var vehicle_vin = jQuery('#vehicle_vin').val();




        var data = {
            action: 'admin_all_reports',
            member_code: member_code,
            first_name: first_name,
            dealer_name: dealer_name,
            distributor_name: distributor_name,
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

                jQuery('#search_tbl').DataTable({
                    dom: 'Bfrtip',
                    "pagingType": "input",
                    orderCellsTop: true,
                    fixedHeader: true,
                    buttons: [{
                        extend: 'csv',
                        //Name the CSV
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'print',
                        text: 'PRINT',
                        filename: 'Search Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13]
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

    //quick filters
    jQuery(document).on("click", "#date_submit", function (e) {
        jQuery('.error').remove();
        var validflag = true;
        var datepicker1 = jQuery('#datepicker1').val();

        var datepicker2 = jQuery('#datepicker2').val();
        var select = jQuery('#quick_filters').val();
        var select = jQuery('#quick_filters').val();
        var dealer_name = jQuery('#filter_dealers').val();
        var distributor_name = jQuery('#filter_distributors').val();


        if (jQuery('#quick_filters').val().trim() == "0") {
            jQuery('#quick_filters').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#quick_filters').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#quick_filters').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'admin_quick_filters',
            datepicker1: datepicker1,
            datepicker2: datepicker2,
            select: select,
            dealer_name: dealer_name,
            distributor_name: distributor_name

        };

        jQuery('.perma-admin-loader').show();
        if (!validflag) {
            jQuery('.perma-admin-loader').hide();
            return validflag;
        } else {
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                // dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    jQuery('.tbl-result-wrap').html('');
                    jQuery('.data-result-wrap').html('');
                    jQuery('.tbl-result-wrap').html('<h3 style="text-align:center;">' + obj.toptitle + '</h3>' + obj.dttable);

                    var radioValue = jQuery("input[name='show_hide']:checked").val();
                    if (jQuery("input:radio").is(":checked")) {
                        if (radioValue == 'hide_dealer') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 6';
                        }
                        if (radioValue == 'hide_distributor') {
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5';
                        }
                        if (radioValue == 'no_cost') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4';
                        }
                        if (radioValue == 'show_cost') {
                            jQuery('.dealer-hide').removeClass('nisl-pdf-link');
                            jQuery('.distributor-hide').removeClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6';
                        }
                    } else {
                        var columntarget = '0, 1, 2, 3, 4, 5, 6';
                    }

                    // jQuery('.tbl-result-wrap').html(response);

                    jQuery('#search_tbl').DataTable({
                        dom: 'Bfrtip',
                        "pagingType": "input",
                        "pageLength": 20,
                        "ordering": false,
                        'columnDefs': [{
                            'targets': [0, 1, 2, 3, 4, 5, 6],
                            /* column index */
                            'orderable': false,
                            /* true or false */
                        }],
                        orderCellsTop: true,
                        fixedHeader: true,
                        buttons: [{
                            extend: 'csv',
                            //Name the CSV
                            filename: obj.toptitle,
                            title: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            filename: obj.toptitle,
                            title: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                        },
                        {
                            extend: 'excel',
                            text: 'EXCEL',
                            filename: obj.toptitle,
                            title: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                        },
                        {
                            extend: 'print',
                            text: 'PRINT',
                            filename: obj.toptitle,
                            title: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
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

    // jQuery('.coverage-report-wrap .view-data').click(function () {
    jQuery(document).on("click", ".coverage-report-wrap .view-data", function (e) {
        jQuery('html, body').animate({
            scrollTop: jQuery(".coverage-report-wrap .data-result-wrap").offset().top
        }, 1000)
    });

    jQuery(document).on("change", "#quick_filters", function (e) {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
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
                onSelect: function (date) {
                    var date2 = jQuery('#datepicker1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    jQuery('#datepicker2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    jQuery('#datepicker2').datepicker('option', 'minDate', date2);
                }

            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',


            });
        }

        if (select == 1) {
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                maxDate: 0,
                onSelect: function (date) {
                    var date2 = jQuery('#datepicker1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    jQuery('#datepicker2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    jQuery('#datepicker2').datepicker('option', 'minDate', date2);
                }
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
                maxDate: "+6m",
                onSelect: function (date) {
                    var date2 = jQuery('#datepicker1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    jQuery('#datepicker2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    jQuery('#datepicker2').datepicker('option', 'minDate', date2);
                }
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
                onSelect: function (date) {
                    var date2 = jQuery('#datepicker1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    jQuery('#datepicker2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    jQuery('#datepicker2').datepicker('option', 'minDate', date2);
                }

            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',


            });
        }
        if (select == 4) {
            jQuery('.input-filter-wrap').html('<label>Date: </label><input type="text" id="datepicker1" style="width:auto;"> <input type="text" id="datepicker2" style="width:auto;">');
            jQuery("#datepicker1").datepicker({
                dateFormat: 'yy-mm-dd',
                onSelect: function (date) {
                    var date2 = jQuery('#datepicker1').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    jQuery('#datepicker2').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    jQuery('#datepicker2').datepicker('option', 'minDate', date2);
                }

            });
            jQuery("#datepicker2").datepicker({
                dateFormat: 'yy-mm-dd',


            });
        }
    });

    jQuery(document).on("focus", "#datepicker1,#membership_datepicker1", function (e) {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });



    jQuery(document).on("focus", "#datepicker2,#membership_datepicker2", function (e) {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });

    jQuery('#pmsafe_invitation_upgradable_prefix').select2({
        placeholder: 'Select Package'
    });


    jQuery('input[name="pmsafe_invitation_code_upgradable"]').click(function () {
        if (jQuery(this).prop("checked") == true) {


            var select_val = jQuery('#pmsafe_invitation_prefix').val();
            var edit_action = jQuery.urlParam('action');

            if (edit_action != '') {
                var data = {
                    action: 'upgradable_dropdown',
                    select_val: select_val,
                    edit_action: edit_action
                };
            } else {
                var data = {
                    action: 'upgradable_dropdown',
                    select_val: select_val,
                };
            }


            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {

                    // jQuery('#pmsafe_invitation_upgradable_prefix').html('');
                    // jQuery('#pmsafe_invitation_upgradable_prefix').append(response);
                    jQuery('#upgradable_chklist').html('');
                    jQuery('#upgradable_chklist').append(response);


                },

            });
            jQuery('#upgrade_tr').removeAttr("style");
        } else {
            jQuery('#upgrade_tr').css("display", "none");
        }
    });

    jQuery(document).on("change", "#pmsafe_invitation_prefix", function (e) {
        var select_val = jQuery('#pmsafe_invitation_prefix').val();
        var edit_action = jQuery.urlParam('action');

        if (edit_action != '') {
            var data = {
                action: 'upgradable_dropdown',
                select_val: select_val,
                edit_action: edit_action
            };
        } else {
            var data = {
                action: 'upgradable_dropdown',
                select_val: select_val,
            };
        }


        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {

                jQuery('#upgradable_chklist').html('');
                jQuery('#upgradable_chklist').append(response);

            },

        });
    });

    var mebership_info_table = jQuery('#membership_info_table').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pagingType": "input",
        "pageLength": 20,
        orderCellsTop: true,
        fixedHeader: true,
        "ordering": false,
        'columnDefs': [{
            'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8],
            /* column index */
            'orderable': false,
            /* true or false */
        }],
        buttons: [{

            extend: 'csv',
            //Name the CSV
            filename: 'Upgrade Report',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            },

        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            filename: 'Upgrade Report',
            orientation: 'landscape',
            pageSize: 'LEGAL',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            },
            title: 'UPGRADE REPORT'
        },
        {
            extend: 'excel',
            text: 'EXCEL',
            filename: 'Upgrade Report',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            },
            title: 'UPGRADE REPORT'

        },
        {
            extend: 'print',
            text: 'PRINT',
            filename: 'Upgrade Report',

            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
            },
            title: 'UPGRADE REPORT',
            customize: function (win) {
                jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');

            }
        }


        ]

    });
    jQuery("#membership_datepicker1").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (date) {
            var date2 = jQuery('#membership_datepicker1').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            // jQuery('#membership_datepicker2').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            jQuery('#membership_datepicker2').datepicker('option', 'minDate', date2);
        }
    });
    jQuery("#membership_datepicker2").datepicker({
        dateFormat: 'yy-mm-dd'
    });

    jQuery(document).on("click", "#membership_date_submit", function (e) {
        jQuery('.error').remove();
        var validflag = true;

        var datepicker1 = jQuery('#membership_datepicker1').val();
        var datepicker2 = jQuery('#membership_datepicker2').val();
        var dealer = jQuery('#filter_dealers').val();
        var distributor = jQuery('#filter_distributors').val();
        var policy = jQuery('#policy').val();
        var package = jQuery('#benefit_packages').val();
        var login = jQuery('#membership_login').val();




        if (login === undefined) {

            var data = {
                action: 'admin_membership_date_filter',
                datepicker1: datepicker1,
                datepicker2: datepicker2,
                dealer: dealer,
                distributor: distributor,
                policy: policy,
                package: package
            }
        } else {

            var data = {
                action: 'admin_membership_date_filter',
                datepicker1: datepicker1,
                datepicker2: datepicker2,
                policy: policy,
                package: package,
                login: login
            }

        }


        if (policy != '' && package == '') {
            jQuery('#benefit_packages').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#benefit_packages').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#benefit_packages').css({
                'color': '#333333'
            });
        }

        jQuery('.perma-admin-loader').show();
        if (!validflag) {
            jQuery('.perma-admin-loader').hide();
            return validflag;
        } else {
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                // dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    jQuery('.membership-result-wrap').html('');

                    jQuery('.membership-result-wrap').html('<h3 style="text-align:center;">' + obj.toptitle + '</h3>' + obj.dttable);
                    var radioValue = jQuery("input[name='show_hide']:checked").val();
                    if (jQuery("input:radio").is(":checked")) {
                        if (radioValue == 'hide_dealer') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 8';
                        }
                        if (radioValue == 'hide_distributor') {
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7';
                        }
                        if (radioValue == 'no_cost') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6';
                        }
                        if (radioValue == 'show_cost') {
                            jQuery('.dealer-hide').removeClass('nisl-pdf-link');
                            jQuery('.distributor-hide').removeClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 8';
                        }
                    } else {
                        var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 8';
                    }
                    jQuery('#membership_date_table').DataTable({
                        dom: 'Bfrtip',
                        "pagingType": "input",
                        responsive: true,
                        "pageLength": 20,
                        orderCellsTop: true,
                        fixedHeader: true,
                        "ordering": false,
                        'columnDefs': [{
                            'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8],
                            /* column index */
                            'orderable': false,
                            /* true or false */
                        }],
                        buttons: [{

                            extend: 'csv',
                            //Name the CSV
                            filename: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            filename: obj.toptitle,
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle
                        },
                        {
                            extend: 'excel',
                            text: 'EXCEL',
                            filename: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle
                        },
                        {
                            extend: 'print',
                            text: 'PRINT',
                            filename: 'Upgrade Report',
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle,
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

    jQuery('#filter_dealers').select2({
        closeOnSelect: false,
        placeholder: 'Select Dealers'
    });
    jQuery('#filter_distributors').select2({
        closeOnSelect: false,
        placeholder: 'Select Distributors'
    });

    jQuery(document).on("change", "#filter_distributors", function (e) {
        var distributor_login = jQuery(this).val();


        var data = {
            action: 'get_dealers_from_distributors',
            distributor_login: distributor_login

        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            success: function (response) {
                jQuery('#filter_dealers').html('');
                jQuery('#filter_dealers').html(response);

            },
            dataType: 'html'
        });
        return false;
    }); // select 

    jQuery(document).on("click", "#add_price", function (e) {
        jQuery("#price-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
    });

    //add dealer package price
    jQuery(document).on("click", "#add_package_price", function (e) {

        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        var selected_package = jQuery('#pmsafe_invitation_prefix').val();
        var dealer_cost = jQuery('#dealer_cost').val();
        var distributor_cost = jQuery('#distributor_cost').val();
        var selling_price = jQuery('#selling_price').val();
        var dealer_id = jQuery('#pricing_dealer_id').val();


        if (jQuery('#pmsafe_invitation_prefix').val().trim() == "") {
            jQuery('#pmsafe_invitation_prefix').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_invitation_prefix').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_invitation_prefix').css({
                'color': '#333333'
            });
        }

        if (jQuery('#dealer_cost').val().trim() == "") {
            jQuery('#dealer_cost').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#dealer_cost').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#dealer_cost').css({
                'color': '#333333'
            });
        }



        var data = {
            action: 'add_dealer_benefits_package_price',
            selected_package: selected_package,
            dealer_cost: dealer_cost,
            distributor_cost: distributor_cost,
            selling_price: selling_price,
            dealer_id: dealer_id

        };

        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();

            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();

                    if (response == 0) {
                        jQuery('#exist-package').remove();
                        jQuery('<p id="exist-package" style="color:red;">Already Exist.</p>').insertBefore('#add_package_price');
                    }
                    if (response == 1) {
                        location.reload();
                    }
                }
            }); // ajax
            return false;
        }
    });

    // add distributor package price
    jQuery(document).on("click", "#add_distributor_cost", function (e) {

        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        var selected_package = jQuery('#pmsafe_invitation_prefix').val();
        var distributor_cost = jQuery('#distributor_cost').val();
        var distributor_id = jQuery('#distributor_id').val();


        if (jQuery('#pmsafe_invitation_prefix').val().trim() == "") {
            jQuery('#pmsafe_invitation_prefix').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_invitation_prefix').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_invitation_prefix').css({
                'color': '#333333'
            });
        }


        if (jQuery('#distributor_cost').val().trim() == "") {
            jQuery('#distributor_cost').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#distributor_cost').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#distributor_cost').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'add_distributor_cost',
            selected_package: selected_package,
            distributor_cost: distributor_cost,
            distributor_id: distributor_id
        };

        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();

            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();

                    if (response == 0) {
                        jQuery('#exist-package').remove();
                        jQuery('<p id="exist-package" style="color:red;">Already Exist.</p>').insertBefore('#add_distributor_cost');
                    }
                    if (response == 1) {
                        location.reload();
                    }
                }
            }); // ajax
            return false;
        }
    });



    jQuery(document).on("change", "#pmsafe_invitation_prefix", function (e) {
        jQuery('#exist-package').remove();
    });

    jQuery(document).on("click", "#delete_price", function (e) {
        var package = jQuery(this).attr('data-id');
        var dealer_id = jQuery('#pricing_dealer_id').val();

        var data = {
            action: 'delete_dealer_benefits_package_price',
            package: package,
            dealer_id: dealer_id
        };

        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    dataType: 'html',
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        swal({
                            title: "Deleted!",
                            text: "Pricing package has been deleted. Press OK button.",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })

                    }
                }); // ajax
            } else {
                swal("Pricing package is not deleted !");
            }
        });
    });

    // edit dealer package price
    jQuery(document).on("click", "#edit_price", function (e) {
        jQuery("#edit-price-modal").modal({
            escapeClose: false,
            clickClose: false,
        });
        var package = jQuery(this).attr('data-id');
        var dealer_id = jQuery('#pricing_dealer_id').val();
        var option = '<option value="' + package + '">' + package + '</option>';

        var data = {
            action: 'fetch_dealer_package_price',
            package: package,
            dealer_id: dealer_id
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('#edit_pmsafe_invitation_prefix').html('');
                jQuery('#edit_pmsafe_invitation_prefix').append(option);
                var obj = jQuery.parseJSON(response);
                jQuery('#edit_distributor_cost').val(obj.distributor_cost);
                jQuery('#edit_dealer_cost').val(obj.dealer_cost);
                jQuery('#edit_selling_price').val(obj.selling_price);


            }
        }); // ajax


    });

    // edit distributor package price
    jQuery(document).on("click", "#edit_distributor_price", function (e) {
        jQuery("#edit-price-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
        var package = jQuery(this).attr('data-id');
        var distributor_id = jQuery('#distributor_id').val();
        var option = '<option value="' + package + '">' + package + '</option>';

        var data = {
            action: 'fetch_dealer_package_price',
            package: package,
            distributor_id: distributor_id
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('#edit_pmsafe_invitation_prefix').html('');
                jQuery('#edit_pmsafe_invitation_prefix').append(option);
                var obj = jQuery.parseJSON(response);
                jQuery('#edit_distributor_cost').val(obj.distributor_cost);

            }
        });
    });

    // update dealer package price
    jQuery(document).on("click", "#update_package_price", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        if (jQuery('#edit_dealer_cost').val().trim() == "") {
            jQuery('#edit_dealer_cost').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_cost').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_cost').css({
                'color': '#333333'
            });
        }


        var selected_package = jQuery('#edit_pmsafe_invitation_prefix').val();
        var dealer_cost = jQuery('#edit_dealer_cost').val();
        var distributor_cost = jQuery('#edit_distributor_cost').val();
        var selling_price = jQuery('#edit_selling_price').val();
        var dealer_id = jQuery('#pricing_dealer_id').val();

        var data = {
            action: 'edit_dealer_benefits_package_price',
            selected_package: selected_package,
            dealer_cost: dealer_cost,
            distributor_cost: distributor_cost,
            selling_price: selling_price,
            dealer_id: dealer_id
        };
        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    location.reload();
                }
            }); // ajax
        }
    });

    // update distributor pacakge price
    jQuery(document).on("click", "#update_distributor_cost", function (e) {
        e.preventDefault();
        jQuery('.error').remove();


        var selected_package = jQuery('#edit_pmsafe_invitation_prefix').val();

        var distributor_cost = jQuery('#edit_distributor_cost').val();
        var distributor_id = jQuery('#distributor_id').val();

        var validflag = true;
        if (jQuery('#edit_distributor_cost').val().trim() == "") {
            jQuery('#edit_distributor_cost').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_cost').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#edit_distributor_cost').css({
                'color': '#333333'
            });
        }



        var data = {
            action: 'edit_distributor_cost_package',
            selected_package: selected_package,
            distributor_cost: distributor_cost,
            distributor_id: distributor_id
        };
        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    location.reload();
                }
            }); // ajax
        }
    });

    jQuery(document).on("click", "#delete_distributor_price", function (e) {
        var package = jQuery(this).attr('data-id');
        var distributor_id = jQuery('#distributor_id').val();

        var data = {
            action: 'delete_distributor_cost',
            package: package,
            distributor_id: distributor_id
        };
        swal({
            title: "Are you sure?",
            text: "It will permanently deleted !",
            icon: "warning",
            buttons: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                jQuery('.perma-admin-loader').show();
                jQuery.ajax({
                    type: 'POST',
                    url: pmAjax.ajaxurl,
                    data: data,
                    dataType: 'html',
                    success: function (response) {
                        jQuery('.perma-admin-loader').hide();
                        swal({
                            title: "Deleted!",
                            text: "Pricing package has been deleted. Press OK button.",
                            icon: "success",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        }).then(function () {
                            location.reload();
                        })
                    }
                }); // ajax
            } else {
                swal("Pricing package is not deleted !");
            }
        });

    });

    jQuery(document).on("focus", "#pmsafe_distributor_contact_fname,#pmsafe_distributor_contact_lname,#pmsafe_distributor_contact_phone,#pmsafe_distributor_contact_email,#pmsafe_distributor_contact_password,#pmsafe_dealer_contact_fname,#pmsafe_dealer_contact_lname,#pmsafe_dealer_contact_phone,#pmsafe_dealer_contact_email,#pmsafe_dealer_contact_password,#benefit_packages,#distributor_cost,#dealer_cost,#selling_price,#pmsafe_invitation_prefix,#edit_distributor_cost,#edit_dealer_cost,#edit_selling_price,#edit_dealer_contact_fname,#edit_dealer_contact_lname,#edit_dealer_contact_phone,#edit_distributor_contact_fname,#edit_distributor_contact_lname,#edit_distributor_contact_phone,#edit_dealer_contact_email,#edit_dealer_contact_uname,#edit_distributor_contact_uname", function (e) {
        jQuery(this).css({
            'border-color': '#cccccc'
        });
        jQuery(this).css({
            'color': '#555'
        });
        jQuery(this).siblings('.error').remove();
    });

    jQuery(document).on("change", "#policy", function (e) {
        var select_val = jQuery(this).val();
        if (select_val == '') {
            jQuery('.filter-package').css('display', 'none');
        } else {
            jQuery('.filter-package').removeAttr('style')
        }
    });


    jQuery(document).on("click", "#add_contact_person", function (e) {
        jQuery("#contact-person-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
    });

    jQuery(document).on("click", "#pmsafe_dealers_contact_edit", function (e) {
        jQuery("#edit-contact-person-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
        var contact_id = jQuery(this).attr('data-id');
        var data = {
            action: 'fetch_dealer_contact_info',
            contact_id: contact_id
        }
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                jQuery('#edit_dealer_contact_fname').val(obj.fname);
                jQuery('#edit_dealer_contact_lname').val(obj.lname);
                jQuery('#edit_dealer_contact_phone').val(obj.phone);
                jQuery('#edit_dealer_contact_email').val(obj.email);
                jQuery('#edit_dealer_contact_uname').val(obj.uname);
                jQuery('#contact_person_id').val(obj.contact_id);

            }
        }); // ajax
    });

    jQuery(document).on("click", "#pmsafe_distributors_contact_edit", function (e) {
        jQuery("#edit-contact-person-modal").modal({
            escapeClose: false,
            clickClose: false,
            // showClose: false
        });
        var contact_id = jQuery(this).attr('data-id');
        var data = {
            action: 'fetch_distributor_contact_info',
            contact_id: contact_id
        }
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                var obj = jQuery.parseJSON(response);
                jQuery('#edit_distributor_contact_fname').val(obj.fname);
                jQuery('#edit_distributor_contact_lname').val(obj.lname);
                jQuery('#edit_distributor_contact_phone').val(obj.phone);
                jQuery('#edit_distributor_contact_email').val(obj.email);
                jQuery('#edit_distributor_contact_uname').val(obj.uname);
                jQuery('#contact_person_id').val(obj.contact_id);

            }
        }); // ajax
    });

    jQuery(document).on("click", "#add_new_contact_person", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        var fname = jQuery('#pmsafe_dealer_contact_fname').val();
        var lname = jQuery('#pmsafe_dealer_contact_lname').val();
        var phone = jQuery('#pmsafe_dealer_contact_phone').val();
        var email = jQuery('#pmsafe_dealer_contact_email').val();
        var uname = jQuery('#pmsafe_dealer_contact_uname').val();
        var password = jQuery('#pmsafe_dealer_contact_password').val();
        var dealer_id = jQuery('#pricing_dealer_id').val();

        var name = /^[A-Za-z]+$/;
        if (jQuery('#pmsafe_dealer_contact_fname').val().trim() == "") {
            jQuery('#pmsafe_dealer_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#pmsafe_dealer_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_fname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_contact_fname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#pmsafe_dealer_contact_lname').val().trim() == "") {
            jQuery('#pmsafe_dealer_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(lname.match(name))) {

            jQuery('#pmsafe_dealer_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_lname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_contact_lname').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_dealer_contact_phone').val().trim() != '') {
            if (!(jQuery('#pmsafe_dealer_contact_phone').val().match(numbers))) {
                jQuery('#pmsafe_dealer_contact_phone').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_dealer_contact_phone').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_dealer_contact_phone').css({
                    'border-color': '#cccccc'
                });
            }
        }

        //Email     
        if (jQuery('#pmsafe_dealer_contact_email').val().trim() == '') {
            jQuery('#pmsafe_dealer_contact_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#pmsafe_dealer_contact_email').val()) {
                var email = jQuery("#pmsafe_dealer_contact_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#pmsafe_dealer_contact_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#pmsafe_dealer_contact_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#pmsafe_dealer_contact_email').css({
                        'color': '#333333'
                    });
                }
            }
        }

        if (jQuery('#pmsafe_dealer_contact_password').val().trim() == "") {
            jQuery('#pmsafe_dealer_contact_password').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_dealer_contact_password').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_dealer_contact_password').css({
                'color': '#333333'
            });
        }


        var data = {
            action: 'add_dealer_contact_information',
            fname: fname,
            lname: lname,
            phone: phone,
            email: email,
            password: password,
            uname: uname,
            dealer_id: dealer_id
        };
        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                success: function (response) {

                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        location.reload();
                    }
                    if (obj.status == false) {
                        swal("Username is already exists.", "Please enter another Username.", "warning");
                    }
                }
            }); // ajax
        }
    });

    jQuery(document).on("click", "#edit_new_contact_person", function (e) {


        jQuery('.error').remove();

        var validflag = true;
        var fname = jQuery('#edit_dealer_contact_fname').val();
        var lname = jQuery('#edit_dealer_contact_lname').val();
        var phone = jQuery('#edit_dealer_contact_phone').val();
        var email = jQuery('#edit_dealer_contact_email').val();
        var password = jQuery('#edit_dealer_contact_password').val();
        var uname = jQuery('#edit_dealer_contact_uname').val();

        var contact_id = jQuery('#contact_person_id').val();


        var name = /^[A-Za-z]+$/;
        if (jQuery('#edit_dealer_contact_fname').val().trim() == "") {
            jQuery('#edit_dealer_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#edit_dealer_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_fname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_fname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#edit_dealer_contact_lname').val().trim() == "") {
            jQuery('#edit_dealer_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(lname.match(name))) {

            jQuery('#edit_dealer_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_lname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_lname').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#edit_dealer_contact_phone').val().trim() != '') {
            if (!(jQuery('#edit_dealer_contact_phone').val().match(numbers))) {
                jQuery('#edit_dealer_contact_phone').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#edit_dealer_contact_phone').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#edit_dealer_contact_phone').css({
                    'border-color': '#cccccc'
                });
            }
        }


        //Email     
        if (jQuery('#edit_dealer_contact_email').val().trim() == '') {
            jQuery('#edit_dealer_contact_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#edit_dealer_contact_email').val()) {
                var email = jQuery("#edit_dealer_contact_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#edit_dealer_contact_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#edit_dealer_contact_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#edit_dealer_contact_email').css({
                        'color': '#333333'
                    });
                }
            }
        }

        if (jQuery('#edit_dealer_contact_uname').val().trim() == "") {
            jQuery('#edit_dealer_contact_uname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_dealer_contact_uname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#edit_dealer_contact_uname').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'edit_dealer_contact_information',
            fname: fname,
            lname: lname,
            phone: phone,
            email: email,
            password: password,
            uname: uname,
            contact_id: contact_id
        };

        if (!validflag) {

            return validflag;
        } else {

            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        location.reload();
                    }
                    if (obj.status == false) {
                        swal("Username is already exists.", "Please enter another Username.", "warning");
                    }

                }
            }); // ajax
        }
    });

    jQuery(document).on("click", "#distributor_edit_new_contact_person", function (e) {


        jQuery('.error').remove();

        var validflag = true;
        var fname = jQuery('#edit_distributor_contact_fname').val();
        var lname = jQuery('#edit_distributor_contact_lname').val();
        var phone = jQuery('#edit_distributor_contact_phone').val();
        var email = jQuery('#edit_distributor_contact_email').val();
        var uname = jQuery('#edit_distributor_contact_uname').val();
        var password = jQuery('#edit_distributor_contact_password').val();

        var contact_id = jQuery('#contact_person_id').val();

        var name = /^[A-Za-z]+$/;
        if (jQuery('#edit_distributor_contact_fname').val().trim() == "") {
            jQuery('#edit_distributor_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#edit_distributor_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_fname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_distributor_contact_fname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#edit_distributor_contact_lname').val().trim() == "") {
            jQuery('#edit_distributor_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#edit_distributor_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_lname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#edit_distributor_contact_lname').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#edit_distributor_contact_phone').val().trim() != '') {
            if (!(jQuery('#edit_distributor_contact_phone').val().match(numbers))) {
                jQuery('#edit_distributor_contact_phone').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#edit_distributor_contact_phone').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#edit_distributor_contact_phone').css({
                    'border-color': '#cccccc'
                });
            }
        }

        //Email     
        if (jQuery('#edit_distributor_contact_email').val().trim() == '') {
            jQuery('#edit_distributor_contact_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#edit_distributor_contact_email').val()) {
                var email = jQuery("#edit_distributor_contact_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#edit_distributor_contact_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#edit_distributor_contact_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#edit_distributor_contact_email').css({
                        'color': '#333333'
                    });
                }
            }
        }

        if (jQuery('#edit_distributor_contact_uname').val().trim() == "") {
            jQuery('#edit_distributor_contact_uname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#edit_distributor_contact_uname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#edit_distributor_contact_uname').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'edit_distributor_contact_information',
            fname: fname,
            lname: lname,
            uname: uname,
            phone: phone,
            email: email,
            password: password,
            contact_id: contact_id
        };

        if (!validflag) {

            return validflag;
        } else {

            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);

                    if (obj.status == true) {
                        location.reload();
                    }
                    if (obj.status == false) {
                        swal("Username is already exists.", "Please enter another Username.", "warning");
                    }
                }
            }); // ajax
        }
    });


    jQuery(document).on("click", "#distributor_add_new_contact_person", function (e) {
        e.preventDefault();
        jQuery('.error').remove();

        var validflag = true;
        var fname = jQuery('#pmsafe_distributor_contact_fname').val();
        var lname = jQuery('#pmsafe_distributor_contact_lname').val();
        var phone = jQuery('#pmsafe_distributor_contact_phone').val();
        var email = jQuery('#pmsafe_distributor_contact_email').val();
        var uname = jQuery('#pmsafe_distributor_contact_uname').val();
        var password = jQuery('#pmsafe_distributor_contact_password').val();
        var distributor_id = jQuery('#distributor_id').val();

        var name = /^[A-Za-z]+$/;
        if (jQuery('#pmsafe_distributor_contact_fname').val().trim() == "") {
            jQuery('#pmsafe_distributor_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_fname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(fname.match(name))) {

            jQuery('#pmsafe_distributor_contact_fname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_fname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_distributor_contact_fname').css({
                'color': '#333333'
            });
        }

        if (jQuery('#pmsafe_distributor_contact_lname').val().trim() == "") {
            jQuery('#pmsafe_distributor_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_lname').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else if (!(lname.match(name))) {

            jQuery('#pmsafe_distributor_contact_lname').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_lname').after("<span class='error'>Please enter valid name.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_distributor_contact_lname').css({
                'color': '#333333'
            });
        }

        //Phone
        var numbers = /^[0-9]{10}$/;
        if (jQuery('#pmsafe_distributor_contact_phone').val().trim() != '') {
            if (!(jQuery('#pmsafe_distributor_contact_phone').val().match(numbers))) {
                jQuery('#pmsafe_distributor_contact_phone').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_distributor_contact_phone').after("<span class='error'>Please enter 10 digit phone number.</span>");
                validflag = false;
            } else {
                jQuery('#pmsafe_distributor_contact_phone').css({
                    'border-color': '#cccccc'
                });
            }
        }
        //Email     
        if (jQuery('#pmsafe_distributor_contact_email').val().trim() == '') {
            jQuery('#pmsafe_distributor_contact_email').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_email').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            if (jQuery('#pmsafe_distributor_contact_email').val()) {
                var email = jQuery("#pmsafe_distributor_contact_email").val();
                if (!(email.match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i))) {
                    jQuery('#pmsafe_distributor_contact_email').css({
                        'border': '1px solid #ff0000'
                    });
                    jQuery('#pmsafe_distributor_contact_email').after("<span class='error'>Please enter valid email address.</span>");
                    validflag = false;
                } else {
                    jQuery('#pmsafe_distributor_contact_email').css({
                        'color': '#333333'
                    });
                }
            }
        }


        if (jQuery('#pmsafe_distributor_contact_password').val().trim() == "") {
            jQuery('#pmsafe_distributor_contact_password').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#pmsafe_distributor_contact_password').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#pmsafe_distributor_contact_password').css({
                'color': '#333333'
            });
        }

        var data = {
            action: 'add_distributor_contact_information',
            fname: fname,
            lname: lname,
            phone: phone,
            email: email,
            uname: uname,
            password: password,
            distributor_id: distributor_id
        };
        if (!validflag) {
            return validflag;
        } else {
            jQuery('.perma-admin-loader').show();
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    if (obj.status == true) {
                        location.reload();
                    }
                    if (obj.status == false) {
                        swal("Username is already exists.", "Please enter another Username.", "warning");
                    }
                }
            }); // ajax
        }
    });


    var tbl_distributor = jQuery('#tbl_distributors').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        "pagingType": "input",
        orderCellsTop: true,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        'columnDefs': [{
            'targets': [0, 1, 2, 3, 4, 5],
            /* column index */
            'orderable': false,
            /* true or false */
        }],
        stateSave: true

    });

    jQuery("#tbl_distributors_paginate .paginate_input").on('keyup', function () {
        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);
    });

    jQuery("#tbl_distributors_filter input[type='search']").on('keyup', function () {
        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);
    });

    jQuery('#tbl_distributors').on('page.dt', function () {

        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);

    });

    var tbl_dealers = jQuery('#tbl_dealers').DataTable({
        dom: 'Bfrtip',
        "pagingType": "input",
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        "order": [
            [1, "asc"]
        ],
        'columnDefs': [{
            'targets': [0, 1, 2, 3, 4, 5, 6, 7],
            /* column index */
            'orderable': false,
            /* true or false */
        }],
        stateSave: true

    });

    jQuery("#tbl_dealers_paginate .paginate_input").on('keyup', function () {
        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);
    });

    jQuery("#tbl_dealers_filter input[type='search']").on('keyup', function () {
        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);
    });

    jQuery('#tbl_dealers').on('page.dt', function () {

        setTimeout(function () {
            jQuery('.jtoggler').jtoggler();
            jQuery('.jtoggler-wrapper').each(function () {
                jQuery(this).find('span').css('display', 'none');
                if (jQuery(this).find('.jtoggler').data('val') == 0) {
                    jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
                }
                if (jQuery(this).find('.jtoggler').data('val') == 1) {
                    jQuery(this).append('<span style="color:#008000">Active</span>');
                }
            });
        }, 100);

    });

    jQuery(document).on("click", "#pmsafe_contact_info_mail", function (e) {
        var contact_id = jQuery(this).attr('data-id');

        var data = {
            action: 'send_reset_mail',
            contact_id: contact_id
        };

        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                swal("Good job!", "Password Reset Email Succussfully Sent!", "success");
            }
        }); // ajax

    });


    jQuery("#billing_datepicker1").datepicker({
        dateFormat: 'yy-mm-dd',
        onSelect: function (date) {
            var date2 = jQuery('#billing_datepicker1').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            // jQuery('#billing_datepicker2').datepicker('setDate', date2);
            //sets minDate to dt1 date + 1
            jQuery('#billing_datepicker2').datepicker('option', 'minDate', date2);
        }
    });
    jQuery("#billing_datepicker2").datepicker({
        dateFormat: 'yy-mm-dd'
    });

    jQuery('#pmsafe_dealers').select2({
        closeOnSelect: false
    });

    jQuery(document).on("click", "#billing_report_submit", function (e) {
        var billing_date1 = jQuery('#billing_datepicker1').val();
        var billing_date2 = jQuery('#billing_datepicker2').val();
        var dealers = jQuery('#pmsafe_dealers').val();

        var data = {
            action: 'billing_report_function',
            billing_date1: billing_date1,
            billing_date2: billing_date2,
            dealers: dealers
        };
        jQuery('.perma-admin-loader').show();
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,
            dataType: 'html',
            success: function (response) {
                jQuery('.perma-admin-loader').hide();
                jQuery('#billing_report_result').html(response);
                jQuery('#billing_info_table').DataTable({
                    dom: 'Bfrtip',
                    responsive: true,
                    "pagingType": "input",
                    "pageLength": 20,
                    orderCellsTop: true,
                    fixedHeader: true,
                    "ordering": false,
                    'columnDefs': [{
                        'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                        /* column index */
                        'orderable': false,
                        /* true or false */
                    }],
                    buttons: [{

                        extend: 'csv',
                        //Name the CSV
                        filename: 'Billing Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        filename: 'Billing Report',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'excel',
                        text: 'EXCEL',
                        filename: 'Billing Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                    },
                    {
                        extend: 'print',
                        text: 'PRINT',
                        filename: 'Billing Report',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13]
                        },
                        customize: function (win) {
                            jQuery(win.document.body).find('table').addClass('display').css('font-size', '10px');

                        }
                    }
                    ]

                });

            }
        }); // ajax
    });

    jQuery('.jtoggler').jtoggler();

    jQuery(document).on('jt:toggled:multi', function (event, target) {

        var post_id = jQuery(target).parents('.jtoggler-wrapper-multistate').find('.jtoggler').data('id');

        var is_checked = jQuery(target).parent().index();
        if (is_checked == 1) {
            jQuery(target).parents('.jtoggler-control').addClass('mixed-state');
            // jQuery('.jtoggler-wrapper').append('<span style="color:#ffa500">Mixed</span>');
        } else {
            jQuery(target).parents('.jtoggler-control').removeClass('mixed-state');
        }
        var data = {
            action: 'active_inactive_code_function',
            post_id: post_id,
            is_checked: is_checked
        };

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery(target).parents('.jtoggler-wrapper-multistate').find('span').css('display', 'none');
                if (is_checked == 0) {
                    jQuery(target).parents('.jtoggler-wrapper-multistate').append('<span style="color:#ff0000">Inactive</span>');
                }
                if (is_checked == 1) {
                    jQuery(target).parents('.jtoggler-wrapper-multistate').append('<span style="color:#ffa500">Mixed</span>');
                }
                if (is_checked == 2) {
                    jQuery(target).parents('.jtoggler-wrapper-multistate').append('<span style="color:#008000">Active</span>');
                }
            }
        })
    });

    jQuery('.jtoggler-wrapper').each(function () {

        var post_type = jQuery.urlParam('post_type');
        var page_param = jQuery.urlParam('page');
        if (post_type == 'pmsafe_bulk_invi') {
            if (jQuery(this).find('.jtoggler').data('val') == 0) {
                jQuery(this).append('<span style="color:#ff0000">Inactive</span>');

                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(1)').addClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(2)').removeClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(3)').removeClass('is-active');
            }
            if (jQuery(this).find('.jtoggler').data('val') == 1) {
                jQuery(this).append('<span style="color:#ffa500">Mixed</span>');

                jQuery(this).find('.jtoggler-control').addClass('mixed-state');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(1)').removeClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(2)').addClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(3)').removeClass('is-active');
            }
            if (jQuery(this).find('.jtoggler').data('val') == 2) {
                jQuery(this).append('<span style="color:#008000">Active</span>');

                jQuery(this).find('.jtoggler-control').addClass('is-fully-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(1)').removeClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(2)').removeClass('is-active');
                jQuery(this).find('.jtoggler-btn-wrapper:nth-child(3)').addClass('is-active');
            }
        }
        if (post_type == 'pmsafe_invitecode' || page_param == 'customers-lists' || page_param == 'dealers-lists' || page_param == 'distributors-lists') {
            if (jQuery(this).find('.jtoggler').data('val') == 0) {
                jQuery(this).append('<span style="color:#ff0000">Inactive</span>');
            }
            if (jQuery(this).find('.jtoggler').data('val') == 1) {
                jQuery(this).append('<span style="color:#008000">Active</span>');
            }
        }

    });
    jQuery(document).on('jt:toggled', function (event, target) {

        var target_id = jQuery(target).attr('data-id');
        var is_checked = jQuery(target).prop('checked');
        var post_type = jQuery.urlParam('post_type');
        var page_param = jQuery.urlParam('page');

        if (post_type) {
            var data = {
                action: 'active_inactive_code_function',
                post_id: target_id,
                is_checked: is_checked,
                param: post_type
            };
        } else {
            if (page_param == 'customers-lists') {
                var data = {
                    action: 'active_inactive_code_function',
                    user_id: target_id,
                    is_checked: is_checked,
                    param: page_param
                };
            }
            if (page_param == 'dealers-lists' || page_param == 'distributors-lists') {
                var data = {
                    action: 'active_inactive_code_function',
                    user_id: target_id,
                    is_checked: is_checked,
                    param: page_param
                };
            }
        }

        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery(target).parent('.jtoggler-wrapper').find('span').css('display', 'none');
                if (is_checked == 0) {
                    jQuery(target).data('val', 0);
                    jQuery(target).parent('.jtoggler-wrapper').append('<span style="color:#ff0000">Inactive</span>');
                }

                if (is_checked == 1) {
                    jQuery(target).data('val', 1);
                    jQuery(target).parent('.jtoggler-wrapper').append('<span style="color:#008000">Active</span>');
                }
            }
        })
    });


    jQuery(document).on("click", "#select_rem_address", function (e) {
        e.preventDefault();
        jQuery('#pmsafe_dealer_distributor').siblings('.error').remove();
        var address_option = jQuery('#select_rem_address').val();
        var distributor = jQuery('#pmsafe_dealer_distributor').val();

        if (address_option == 'distributor') {
            //select 
            if (jQuery('#pmsafe_dealer_distributor').val().trim() == "") {
                jQuery('#pmsafe_dealer_distributor').css({
                    'border': '1px solid #ff0000'
                });
                jQuery('#pmsafe_dealer_distributor').after("<span class='error'>This field is required.</span>");

            } else {
                jQuery('#pmsafe_dealer_distributor').css({
                    'color': '#333333'
                });
            }
        }

        if (distributor == '') {
            var data = {
                action: 'set_remittance_address_function',
                address_option: address_option
            };
        } else {
            var data = {
                action: 'set_remittance_address_function',
                address_option: address_option,
                distributor: distributor
            };
        }
        jQuery.ajax({
            type: 'POST',
            url: pmAjax.ajaxurl,
            data: data,

            success: function (response) {
                jQuery('#pmsafe_remittance_address').val(response);
                if (address_option != '') {
                    jQuery('#rem_div').removeAttr('style');
                }

            }
        });
    });

    jQuery(document).on("click", "#remittance_report_submit", function (e) {
        jQuery('.error').remove();
        var validflag = true;

        var datepicker1 = jQuery('#membership_datepicker1').val();
        var datepicker2 = jQuery('#membership_datepicker2').val();
        var dealer = jQuery('#filter_dealers').val();
        var distributor = jQuery('#filter_distributors').val();
        var policy = jQuery('#policy').val();
        var package = jQuery('#benefit_packages').val();
        var registration_type = jQuery("input[name='registration_type']:checked").val();
        var data = {
            action: 'admin_remittance_report_filter',
            datepicker1: datepicker1,
            datepicker2: datepicker2,
            dealer: dealer,
            distributor: distributor,
            policy: policy,
            package: package,
            registration_type: registration_type
        }
        if (policy != '' && package == '') {
            jQuery('#benefit_packages').css({
                'border': '1px solid #ff0000'
            });
            jQuery('#benefit_packages').after("<span class='error'>This field is required.</span>");
            validflag = false;
        } else {
            jQuery('#benefit_packages').css({
                'color': '#333333'
            });
        }
        jQuery('.perma-admin-loader').show();
        if (!validflag) {
            jQuery('.perma-admin-loader').hide();
            return validflag;
        } else {
            jQuery.ajax({
                type: 'POST',
                url: pmAjax.ajaxurl,
                data: data,
                // dataType: 'html',
                success: function (response) {
                    jQuery('.perma-admin-loader').hide();
                    var obj = jQuery.parseJSON(response);
                    jQuery('.remittance-result-wrap').html('');

                    jQuery('.remittance-result-wrap').html('<h3 style="text-align:center;">' + obj.toptitle + '</h3>' + obj.dttable);
                    var radioValue = jQuery("input[name='show_hide']:checked").val();

                    if (jQuery("input[name='show_hide']:radio").is(":checked")) {
                        if (radioValue == 'hide_dealer') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 11, 12, 13';
                        }
                        if (radioValue == 'hide_distributor') {
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10';
                        }
                        if (radioValue == 'no_cost') {
                            jQuery('.dealer-hide').addClass('nisl-pdf-link');
                            jQuery('.distributor-hide').addClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7';
                        }
                        if (radioValue == 'show_cost') {
                            jQuery('.dealer-hide').removeClass('nisl-pdf-link');
                            jQuery('.distributor-hide').removeClass('nisl-pdf-link');
                            var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13';
                        }
                    } else {

                        var columntarget = '0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13';
                    }
                    var address_show_hide = jQuery("input[name='address_show_hide']:checked").val();
                    if (jQuery("input[name='address_show_hide']:radio").is(":checked")) {
                        if (address_show_hide == 'hide_address') {
                            jQuery('.address-row').remove();
                        }

                    }

                    jQuery('#remittance_report_table').DataTable({
                        dom: 'Bfrtip',
                        "pagingType": "input",
                        responsive: true,
                        "pageLength": 20,
                        orderCellsTop: true,
                        fixedHeader: true,
                        "ordering": false,
                        'columnDefs': [{
                            'targets': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                            /* column index */
                            'orderable': false,
                            /* true or false */
                        }],
                        createdRow: function (row, data, dataIndex) {
                            if (data[0] === 'Address') {

                                var me = jQuery(row).closest('tr').attr('class');
                                jQuery('.' + me + ' td:not(.saveme)').css('display', 'none');
                                jQuery('td:eq(1)', row).attr('colspan', 13);
                                jQuery('.' + me + ' .adr_rmv').css('color', 'rgb(188, 188, 188)');
                            }
                        },
                        buttons: [{

                            extend: 'csv',
                            //Name the CSV
                            filename: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                        },
                        {
                            extend: 'pdfHtml5',
                            text: 'PDF',
                            filename: obj.toptitle,
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle
                        },
                        {
                            extend: 'excel',
                            text: 'EXCEL',
                            filename: obj.toptitle,
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle
                        },
                        {
                            extend: 'print',
                            text: 'PRINT',
                            filename: 'Upgrade Report',
                            exportOptions: {
                                columns: [columntarget]
                            },
                            title: obj.toptitle,
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

}); // ready