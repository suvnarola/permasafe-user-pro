<?php
$action = $_GET['action'];
$dealer_id =  $_GET['dealer'];

$user = get_user_by( 'ID', $dealer_id );
$name = get_user_meta( $dealer_id, 'dealer_name' , true );
$address = get_user_meta( $dealer_id, 'dealer_store_address' , true );
$phone = get_user_meta( $dealer_id, 'dealer_phone_number' , true );
$fax = get_user_meta( $dealer_id, 'dealer_fax_number' , true );
$distributor_id = get_user_meta( $dealer_id, 'dealer_distributor_name' , true );
$distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
$dealer_login = $user->user_login;
// $contact_info = get_the_author_meta('dealer_contact_info' ,$dealer_id);
global $wpdb;
$contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_dealer_id" AND wum.meta_value ='.$dealer_id);

if($action == 'view'){

    $add_code_query_args = array(
        'post_type'   => 'pmsafe_bulk_invi',
        'action' => 'addcode',
        'dealer'  => $dealer_id,
    );

    $actions['addcode'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $add_code_query_args, 'post-new.php' ), 'addcode_' . $dealer_id ) ),
        _x( 'Add Member Codes', 'List table row action', 'wp-list-table-example' )
    );

// Build view registered customer row action.

    $edit_customer_query_args = array(
        'page'   => 'dealers-lists',
        'action' => 'edit',
        'dealer'  => $dealer_id,
    );

    $actions['edit'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $edit_customer_query_args, 'admin.php' ), 'editdealer_' . $dealer_id ) ),
        _x( 'Edit Dealer', 'List table row action', 'wp-list-table-example' )
    );

    $view_customer_query_args = array(
        'page'   => 'customers-lists',
        'action' => 'view_customer',
        'dealer'  => $dealer_id,
    );

    $actions['view_customer'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $view_customer_query_args, 'admin.php' ), 'viewcustomer_' . $dealer_id ) ),
        _x( 'View Customers', 'List table row action', 'wp-list-table-example' )
    );


    $args = array(
        'post_type' => 'pmsafe_bulk_invi',
        'post_status' => 'publish',
        // 'posts_per_page' => 1,
        'meta_query' => array(
            // 'relation' => 'AND',
            array(
                'key'     => '_pmsafe_dealer',
                'value'   => $user->user_login,
                'compare' => '=',
            ),
           
        ),
    );
    $posts = get_posts($args);
    // pr($posts);    
    echo '<div class="top-head">';
    echo '<h1 class="top-heading">View <span style="color:#0065a7">'.$name.' ('.$dealer_login.')</span> Information</h1>';
    echo '<div class="navigation-btn">';
        echo $actions['edit'];
        echo $actions['addcode'];
        
        if($posts){
            $url = admin_url('edit.php?s&post_status=all&post_type=pmsafe_bulk_invi&dealer_list='.$user->user_login.'&export=1');
            echo '<a href="'.$url.'">View Member Codes</a>';
        }
        echo $actions['view_customer'];
        echo '</div>';   
    echo '</div>';   
	

	

	    echo '<table class="view-dealer-tbl">';
	        echo '<tr>';
	            echo '<td><strong>Name</strong></td>';
	            echo '<td>'.$name.'</td>';
	        echo '</tr>';

	        echo '<tr>';
	            echo '<td><strong>Email</strong></td>';
	            echo '<td>'.$user->user_email.'</td>';
	        echo '</tr>';

            if($address){
    	        echo '<tr>';
    	            echo '<td><strong>Store Address</strong></td>';
    	            echo '<td>'.$address.'</td>';
    	        echo '</tr>';
	        }
            if($phone){
    	        echo '<tr>';
    	            echo '<td><strong>Phone</strong></td>';
    	            echo '<td>'.$phone.'</td>';
    	        echo '</tr>';
            }
            if($fax){
    	        echo '<tr>';
    	            echo '<td><strong>Fax</strong></td>';
    	            echo '<td>'.$fax.'</td>';
    	        echo '</tr>';
            }
            // Build view row action.
        $view_query_args = array(
            'page'   => 'distributors-lists',
            'action' => 'view',
            'distributor'  => $distributor_id,
        );

        $actions['view'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url( wp_nonce_url( add_query_arg( $view_query_args, 'admin.php' ), 'viewdistributor_' . $distributor_id ) ),
            _x( $distributor_name, 'List table row action', 'wp-list-table-example' )
        );
	        echo '<tr>';
	            echo '<td><strong>Distributor Name</strong></td>';
	            echo '<td>'.$actions['view'].'</td>';
	        echo '</tr>';
	    echo '</table>'; 
    
    echo '<div class="lr-wrapper">';
        echo '<div class="left-wrapper">';
        echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';   
        if($contact_info){

    	    // echo '<table class="view-distributor-tbl" id="">';
    	    
    	    foreach ($contact_info as $key => $value) {
                $user_id = $value->user_id;
                $fname = get_user_meta($user_id,'contact_fname',true);
                $lname = get_user_meta($user_id,'contact_lname',true);
                $phone = get_user_meta($user_id,'contact_phone',true);
        
    	        echo '<table class="view-dealer-contacts-tbl" id="">';
    	            $number = $key + 1;
    	            echo '<tr>';
                        echo '<td style="font-size:15px;border-right:none;">';
                            echo '<b>Person '.$number.'</b>';
                        echo '</td>';

                        echo '<td style="border-left:none;text-align:right;">';
                            echo '<a href="#edit-contact-person-modal" id="pmsafe_dealers_contact_edit" data-id="'.$user_id.'" title="click here to edit this contact" style="color: #fff;cursor:pointer;background: #0065a7;padding: 5px;border-radius: 50%;margin:0 5px"><i class="fa fa-edit"></i></a><i class="fa fa-trash" id="pmsafe_dealers_contact_delete" data-id="'.$user_id.'" title="click here to delete this contact" style="color: #fff;cursor:pointer;background: #ff0000;padding: 5px;border-radius: 50%;margin:0 5px;"></i>';
                        echo '</td>';
    	            echo '</tr>';
    	            
    	            echo '<tr>';
    	                echo '<td>Name</td>';
    	                echo '<td>'.$fname.' '.$lname.'</td>';
    	            echo '</tr>';

    	            echo '<tr>';
    	                echo '<td>Phone Number</td>';
    	                echo '<td>'.$phone.'</td>';
    	            echo '</tr>';
    	            
    	            echo '<tr>';
    	                echo '<td>Email</td>';
    	                echo '<td>'.$value->user_email.'</td>';
    	            echo '</tr>';

                echo '</table>';  
               
    	       echo '<div class="blank-space"/></div>';
            }
        }else{
            echo '<p>No contact persons are added.</p>';
        }
            echo '<a href="#contact-person-modal" rel="modal:open" id="add_contact_person">Add New Contact Person</a>';
            /*********************** Add Contact Person Modal ******************************************** */
            echo '<div id="contact-person-modal" class="modal">';   
            echo '<h3>Add Contact Person: '.$name.'<h3>';
                    echo '<div class="nisl-wrap">';
                        echo '<label><strong>First Name:</strong></label>';
                        echo '<input type="text" id="pmsafe_dealer_contact_fname" name="pmsafe_dealer_contact_fname" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Last Name:</strong></label>';
                        echo '<input type="text" id="pmsafe_dealer_contact_lname" name="pmsafe_dealer_contact_lname" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Phone Number:</strong></label>';
                        echo '<input type="text" id="pmsafe_dealer_contact_phone" name="pmsafe_dealer_contact_phone" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Email:</strong></label>';
                        echo '<input type="email" id="pmsafe_dealer_contact_email" name="pmsafe_dealer_contact_email" value="" class="widefat check-mail" />';
					echo '</div>';
					
					echo '<div class="nisl-wrap">';
						echo '<label><strong>Password:</strong></label>';
						echo '<input type="text" rel="gp" name="pmsafe_dealer_contact_password" id="pmsafe_dealer_contact_password" value="" class="widefat" style="width:35%"/>';
						echo '<input type="button" value="Generate Password" class="generate_dealer_contact_password" />';
                    echo '</div>';
                    echo '<input type="button" value="Add" id="add_new_contact_person" class="btn-disabled"/>';
			echo '</div>';
			
            /*********************** Edit Contact Person Modal ******************************************** */
            echo '<div id="edit-contact-person-modal" class="modal">';   
            echo '<h3>Edit Contact Person: '.$name.'<h3>';
                    echo '<div class="nisl-wrap">';
                        echo '<label><strong>First Name:</strong></label>';
                        echo '<input type="hidden" id="contact_person_id" value="" />';
                        echo '<input type="text" id="edit_dealer_contact_fname" name="edit_dealer_contact_fname" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Last Name:</strong></label>';
                        echo '<input type="text" id="edit_dealer_contact_lname" name="edit_dealer_contact_lname" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Phone Number:</strong></label>';
                        echo '<input type="text" id="edit_dealer_contact_phone" name="edit_dealer_contact_phone" value="" class="widefat" />';
				    echo '</div>';

				    echo '<div class="nisl-wrap">';
                        echo '<label><strong>Email:</strong></label>';
                        echo '<input type="email" id="edit_dealer_contact_email" name="edit_dealer_contact_email" value="" class="widefat" disabled/>';
					echo '</div>';
					
					echo '<div class="nisl-wrap">';
						echo '<label><strong>Password:</strong></label>';
						echo '<input type="text" rel="gp" name="edit_dealer_contact_password" id="edit_dealer_contact_password" value="" class="widefat" style="width:35%"/>';
						echo '<input type="button" value="Generate Password" class="generate_dealer_contact_password" />';
                    echo '</div>';
                    echo '<input type="button" value="Update" id="edit_new_contact_person" />';
			echo '</div>';
      
       echo '</div>';
       echo '<div class="right-wrapper">';
            echo '<h3 style="color:#0065a7">Benefits Package Pricing:</h3>'; 
            $price_arr = get_user_meta($dealer_id,'pricing_package',true);
            $distributor_id = get_user_meta( $dealer_id, 'dealer_distributor_name' , true );
            $distributor_get_price_arr = get_user_meta($distributor_id,'pricing_package',true);
            
            echo '<table class="view-dealer-price-tbl" id="">';
                echo '<thead>';
                    echo '<th>Benefits Package</th>';
                    echo '<th>Price
                    <p>Distributor Cost</p>
                    </th>';
                    echo '<th> </br> <p>Dealer Cost </p></th>';
                    echo '<th> </br> <p>Selling Price </p></th>';
                    echo '<th></th>';
                echo '</thead>';
                
                echo '<tbody>';
                // ksort($price_arr);
                $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
                foreach ($benefit_prefix as $prefix) {
                    echo '<tr>';
                        echo '<td>'.$prefix.'</td>';
                        echo (($distributor_get_price_arr[$prefix]['distributor_cost'])?'<td>$'.$distributor_get_price_arr[$prefix]['distributor_cost'].'</td>':'<td>-</td>');
                        echo (($price_arr[$prefix]['dealer_cost'])?'<td>$'.$price_arr[$prefix]['dealer_cost'].'</td>':'<td>-</td>');
                        echo (($price_arr[$prefix]['selling_price'])?'<td>$'.$price_arr[$prefix]['selling_price'].'</td>':'<td>-</td>');
                        echo '<td style="text-align:right;">';
                            echo '<a href="#edit-price-modal" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#0065a7;padding:5px;border-radius:50%;" rel="modal:open" id="edit_price"  data-id="'.$prefix.'">';
                                echo '<i class="fa fa-edit"></i>';
                            echo '</a>';
                            echo '<i id="delete_price" class="fa fa-trash" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#ff0000;padding:5px;border-radius:50%;" data-id="'.$prefix.'"></i>';
                        echo '</td>';
                    echo '</tr>';
                }
               
    	        echo '</tbody>';  
                echo '</table>';  
                
                echo '<a href="#price-modal" rel="modal:open" id="add_price">Add New Package Pricing</a>';
       echo '</div>';
    echo '</div>';

    /*********************** Add Price Modal ******************************************** */
    echo '<div id="price-modal" class="modal">';
        echo '<h3>Select Package Pricing:<h3>';
        echo '<input type="hidden" value="'.$dealer_id.'" id="pricing_dealer_id">';
        echo '<hr/>';
        $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
        
        echo '<table>';
            echo '<tr>';
                echo '<td>';
                    echo '<label><strong>Benefits Packages:</strong></label>';
                echo '</td>';
                echo '<td>';
                    if(!empty($benefit_prefix)){
                        echo '<select name="pmsafe_invitation_prefix" id="pmsafe_invitation_prefix">';
                        echo '<option value="">select</option>';
                            foreach ($benefit_prefix as $prefix) {
                                echo '<option value="'.$prefix.'">'.$prefix.'</option>';
                            }
                        echo '</select>';
                    }
                echo '</td>';
            echo '</tr>';
        
        echo '<tr>';
            echo '<td>';
                echo '<label><strong>Distributor Cost($):</strong></label>';
            echo '</td>';
            echo '<td>';
                echo '<input type="number" min="1" id="distributor_cost">';
            echo '</td>';
        echo '</tr>';

        echo '<tr>';
                echo '<td>';
                    echo '<label><strong>Dealer Cost($):</strong></label>';
                echo '</td>';
                echo '<td>';
                    echo '<input type="number" min="1" id="dealer_cost">';
                echo '</td>';
        echo '</tr>';

       

        echo '<tr>';
            echo '<td>';
                echo '<label><strong>Selling Price($):</strong></label>';
            echo '</td>';
            echo '<td>';
                    echo '<input type="number" min="1" id="selling_price">';
            echo '</td>';
        echo '</tr>';

    echo '</table>';
    echo '<hr>';
    echo '<input type="button" value="Add" id="add_package_price">';
    echo '</div>';
    /*********************** Edit Price Modal ******************************************** */
    echo '<div id="edit-price-modal" class="modal">';
        echo '<h3>Edit Package Pricing:<h3>';
        echo '<input type="hidden" value="'.$dealer_id.'" id="pricing_dealer_id">';
        echo '<hr/>';
      
        
        echo '<table>';
        echo '<tr>';
            echo '<td>';
                echo '<label><strong>Benefits Packages:</strong></label>';
            echo '</td>';
            echo '<td>';
                    echo '<select name="edit_pmsafe_invitation_prefix" id="edit_pmsafe_invitation_prefix">';
                    echo '</select>';
            echo '</td>';
        echo '</tr>';

        echo '<tr>';
            echo '<td>';
                echo '<label><strong>Distributor Cost($):</strong></label>';
            echo '</td>';
            echo '<td>';
                echo '<input type="number" min="1" id="edit_distributor_cost">';
            echo '</td>';
        echo '</tr>';

        echo '<tr>';
                echo '<td>';
                    echo '<label><strong>Dealer Cost($):</strong></label>';
                echo '</td>';
                echo '<td>';
                    echo '<input type="number" min="1" id="edit_dealer_cost">';
                echo '</td>';
        echo '</tr>';

        

        echo '<tr>';
            echo '<td>';
                echo '<label><strong>Selling Price($):</strong></label>';
            echo '</td>';
            echo '<td>';
                    echo '<input type="number" min="1" id="edit_selling_price">';
            echo '</td>';
        echo '</tr>';

    echo '</table>';
    echo '<hr>';
    echo '<input type="button" value="Update" id="update_package_price">';
    echo '</div>';
  

}else if($action == 'edit'){
	$distributors = get_users( 'role=author&orderby=ID&order=DESC' );
    echo '<h1>Edit <span style="color:#0065a7">'.$name.' ('.$dealer_login.')</span> Information</h1>'; 
    
    echo '<div class="wrap dealer_add_form_div">';
        echo '<form name="perma_edit_dealer" id="perma_edit_dealer_form" method="POST" class="validate">';

            echo '<input type="hidden" id="pmsafe_dealer_id" name="pmsafe_dealer_id" value="'.$dealer_id.'" class="widefat" />';
            echo '<input type="hidden" id="pmsafe_dealer_code" name="pmsafe_dealer_code" value="'.$user->user_login.'" class="widefat" />';
            echo '<div id="name_div">';
                echo '<label><strong>Dealer Name</strong></label>';
                echo '<input type="text" id="pmsafe_dealer_name" name="pmsafe_dealer_name" value="'.$name.'" class="widefat" />';
            echo '</div>';

            echo '<div id="email_div">';
                echo '<label><strong>Email</strong></label>';
                echo '<input type="email" id="pmsafe_dealer_email" name="pmsafe_dealer_email" value="'.$user->user_email.'" class="widefat" />';
            echo '</div>';
                
            echo '<div id="address_div">';
                echo '<label><strong>Store Address</strong></label>';
                echo '<textarea id="pmsafe_dealer_store_address" name="pmsafe_dealer_store_address" class="widefat">'.$address.'</textarea>';
            echo '</div>'; 

            echo '<div id="phone_div">';
                echo '<label><strong>Phone Number</strong></label>';
                echo '<input type="text" id="pmsafe_dealer_phone_number" name="pmsafe_dealer_phone_number" value="'.$phone.'" class="widefat" />';
            echo '</div>';    

            echo '<div id="fax_div">';
                echo '<label><strong>Fax Number</strong></label>';
                echo '<input type="text" id="pmsafe_dealer_fax_number" name="pmsafe_dealer_fax_number" value="'.$fax.'" class="widefat" />';
            echo '</div>'; 

            // echo '<div id="fax_div">';
            //     echo '<label><strong>Fax Number</strong></label>';
            //     echo '<input type="text" id="pmsafe_dealer_fax_number" name="pmsafe_dealer_fax_number" value="'.$fax.'" class="widefat" />';
            // echo '</div>'; 

            // $dealer_pwd = wp_generate_password();
            
            echo '<div id="password_div">';
                echo '<label><strong>Password</strong></label>';
                echo '<input type="password" id="pmsafe_dealer_password" name="pmsafe_dealer_password" value="" class="widefat" style="display:none;"/>';
                echo '<input type="button" value="Generate New Password" id="generate_dealer_password" />';
                echo '<input type="button" value="Hide" id="hide_dealer_password" style="display:none;"/>';
                echo '<input type="button" value="Show" id="show_dealer_password" style="display:none;"/>';
                echo '<input type="button" value="Cancel" id="cancel_dealer_password" style="display:none;"/>';
            echo '</div>';
            
            echo '<div id="distributor_div">';
			    echo '<label><strong>Distributors</strong></label>';
			    echo '<select name="pmsafe_dealer_distributor">';
			    echo '<option>Select Distributor</option>';
			    foreach ( $distributors as $user ) {
			    	$user_id = $user->ID;
			    	$name = get_user_meta( $user_id, 'distributor_name' , true );
			    	if($user_id == $distributor_id){
				    	echo '<option value="'.$user_id.'" selected>'.$name.'</option>';
					}
					else{
						echo '<option value="'.$user_id.'">'.$name.'</option>';
					}
				}
			    echo '</select>';
			echo '</div>'; 

            $number = 1;
            if($contact_info){
                    echo '<div id="fname_divgroup">';
                foreach ($contact_info as $key => $value) {
                    $user_id = $value->user_id;
                    $fname = get_user_meta($user_id,'contact_fname',true);
                    $lname = get_user_meta($user_id,'contact_lname',true);
                    $phone = get_user_meta($user_id,'contact_phone',true);
                    // $number = $key + 1;
                    if($fname != ''){
                        echo '<div id="fname_div'.$number.'">';
                            echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';
                            echo '<div class="nisl-wrap">';
                            echo '<label><strong>First Name:</strong></label>';
                            echo '<input type="hidden" id="pmsafe_dealer_contact_id'.$number.'" name="pmsafe_dealer_contact_id[]" value="'.$user_id.'" class="widefat" />';
                            echo '<input type="text" id="pmsafe_dealer_contact_fname'.$number.'" name="pmsafe_dealer_contact_fname[]" value="'.$fname.'" class="widefat" />';
                            echo '</div>';

                            echo '<div class="nisl-wrap">';
                            echo '<label><strong>Last Name:</strong></label>';
                            echo '<input type="text" id="pmsafe_dealer_contact_lname'.$number.'" name="pmsafe_dealer_contact_lname[]" value="'.$lname.'" class="widefat" />';
                            echo '</div>';

                            echo '<div class="nisl-wrap">';
                            echo '<label><strong>Phone Number:</strong></label>';
                            echo '<input type="text" id="pmsafe_dealer_contact_phone'.$number.'" name="pmsafe_dealer_contact_phone[]" value="'.$phone.'" class="widefat" />';
                            echo '</div>';

                            echo '<div class="nisl-wrap">';
                            echo '<label><strong>Email:</strong></label>';
                            echo '<input type="email" id="pmsafe_dealer_contact_email'.$number.'" name="pmsafe_dealer_contact_email[]" value="'.$value->user_email.'" class="widefat check-mail" style="width:35%;"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;">Please enter unique email-id.</span>';
                            echo '</div>';

                            echo '<div class="nisl-wrap">';
                                echo '<label><strong>Password:</strong></label>';
                                echo '<input type="text" rel="gp" name="pmsafe_dealer_contact_password[]" value="" class="widefat" style="width:35%"/>';
                                echo '<input type="button" value="Generate Password" class="generate_dealer_contact_password" />';
                              
                            echo '</div>';
                        echo '</div>';
                    }
                    $number++;
                }
                echo '</div>';   
            }else{
                echo '<div id="fname_divgroup">';
                echo '<div id="fname_div1">';
                    echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';
                    echo '<div class="nisl-wrap">';
                    echo '<label><strong>First Name:</strong></label>';
                    echo '<input type="text" id="pmsafe_dealer_contact_fname1" name="pmsafe_dealer_contact_fname[]" value="" class="widefat" />';
                    echo '</div>';

                    echo '<div class="nisl-wrap">';
                    echo '<label><strong>Last Name:</strong></label>';
                    echo '<input type="text" id="pmsafe_dealer_contact_lname1" name="pmsafe_dealer_contact_lname[]" value="" class="widefat" />';
                    echo '</div>';

                    echo '<div class="nisl-wrap">';
                    echo '<label><strong>Phone Number:</strong></label>';
                    echo '<input type="text" id="pmsafe_dealer_contact_phone1" name="pmsafe_dealer_contact_phone[]" value="" class="widefat" />';
                    echo '</div>';

                    echo '<div class="nisl-wrap">';
                    echo '<label><strong>Email:</strong></label>';
                    echo '<input type="email" id="pmsafe_dealer_contact_email1" name="pmsafe_dealer_contact_email[]" value="" class="widefat check-mail" style="width:35%;"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;">Please enter unique email-id.</span>';
                    echo '</div>';
                    
                    echo '<div class="nisl-wrap">';
                    echo '<label><strong>Password</strong></label>';
                    echo '<input type="text" rel="gp" name="pmsafe_dealer_contact_password[]" value="" class="widefat" style="width:35%"/>';
                    echo '<input type="button" value="Change Password" class="generate_dealer_contact_password" />';
                    echo '</div>';
                echo '</div>';
                echo '</div>';   
            }
            echo '<input type="button" value="Add New Contact Information" id="add_new_dealer" />';
            // echo '<input type="button" value="Remove Contact Information" id="removeButton_dealer" />';

            echo '<input type="submit" id="pmsafe_dealers_update" value="Save" class="button button-primary button-large btn-disabled">';
    
        echo '</form>';
    echo '</div>';
}else if($action == 'delete'){
    echo '<h1>Delete Dealer</h1>';
    echo '<form name="perma_delete_dealer" id="perma_delete_dealer_form" method="POST" class="validate">';
    
    echo '<p>You have specified this user for deletion:</p>';
    echo 'ID #'.$dealer_id.': '.$name.' ('.$user->user_login.')';
    echo '<input type="hidden" id="pmsafe_dealer_id" name="pmsafe_dealer_id" value="'.$dealer_id.'" class="widefat" /><br/><br/>';

    echo '<input type="submit" id="pmsafe_dealers_delete" value="Confirm Deletion" class="button button-primary button-large">';
    echo '</form>';
}
else if($action == 'delete_customer_details'){
    $user_id = $_GET['id'];
    $fname = get_user_meta($user_id,'first_name', true);
    $lname = get_user_meta($user_id,'last_name', true);
    $nickname = get_user_meta($user_id,'nickname', true);
    echo '<h1>Delete Customer</h1>';
    echo '<form name="perma_delete_customer_form" id="perma_delete_customer_form" method="POST" class="validate">';
        
        echo '<p>You have specified this user for deletion:</p>';
        echo 'ID #'.$user_id.': '.$fname.' '.$lname.' ('.$nickname.')';
        echo '<input type="hidden" id="pmsafe_customer_id" name="pmsafe_customer_id" value="'.$user_id.'" class="widefat" /><br/><br/>';

        echo '<input type="submit" id="pmsafe_customer_delete" value="Confirm Deletion" class="button button-primary button-large">';
    echo '</form>';
}else if($action == 'search_customer_details'){

    $login = $_GET['dealer_login'];
    
    $html .= '<h1>Search Customer Information</h1>'; 
    $html .= '<div class="reports-wrap">';	
    
    // member code
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Member Code : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="member_code" id="member_code"/>';
            $html .= '<input type="hidden" name="dealer_login" id="dealer_login" value="'.$login.'"/>';
        $html .= '</div>';	
    $html .= '</div>';  

    // First name
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Customer First Name : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="first_name" id="first_name"/>';
        $html .= '</div>';	 
    $html .= '</div>';   

    // Last Name
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Customer last Name : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="last_name" id="last_name"/>';
        $html .= '</div>';	 
    $html .= '</div>';   

    // Address
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Address : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="address" id="address"/>';
        $html .= '</div>';
    $html .= '</div>';

    // phone
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Phone Number : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="phone_number" id="phone_number"/>';
        $html .= '</div>';
    $html .= '</div>';

    // Email
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Email : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="email" id="email"/>';
        $html .= '</div>';
    $html .= '</div>';

    // City
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>City : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="city" id="city"/>';
        $html .= '</div>';
    $html .= '</div>';

    //state
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>State : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="state" id="state"/>';
        $html .= '</div>';
    $html .= '</div>';

    //Zip Code
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Zip Code : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="zip_code" id="zip_code"/>';
        $html .= '</div>';     
    $html .= '</div>';     

    // Vehicle year
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Vehicle year : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="vehicle_year" id="vehicle_year"/>';
        $html .= '</div>';   
    $html .= '</div>';   

    // Vehicle Make
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Vehicle Make : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="vehicle_make" id="vehicle_make"/>';
        $html .= '</div>';   
    $html .= '</div>';   

    // Vehicle Model
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Vehicle Model : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="vehicle_model" id="vehicle_model"/>';
        $html .= '</div>';   
    $html .= '</div>';   

    // Vehicle VIN
    $html .= '<div class="reports-wrap-inner">';
        $html .= '<div class="label-input">';	    	
            $html .= '<label>Vehicle VIN : </label>';
        $html .= '</div>';	    	
        $html .= '<div class="input-div">';	    	
            $html .= '<input type="text" name="vehicle_vin" id="vehicle_vin"/>';
        $html .= '</div>';   
    $html .= '</div>';   

    // Submit

    $html .= '<div class="input-btn">';	    	
        $html .= '<input type="button" name="search_submit" id="search_submit" value="Search" data-scroll-to="#id1" data-scroll-focus="#id1" data-scroll-speed="700" data-scroll-offset="5"/>';
        $html .= '<input type="button" name="reset" id="search_reset" value="Reset"/>';
    $html .= '</div>';          			



    $html .= '</div>';	    	
    $html .= '<section id="id1"></section>';
    $html .= '<div class="search-result-wrap">';	
    $html .= '<div class="tbl-result-wrap">'; 

    $html .= '</div>';	    	
    $html .= '<div class="data-result-wrap">'; 

    $html .= '</div>';          
    $html .= '</div>';       

    echo $html;
}
else{
echo '<div class="top-head">';
echo '<h1 class="top-heading">Dealers</h1>';
$url = admin_url('admin.php?page=add-new-dealer');
echo '<a class="dealer_add" href="'.$url.'">Add New Dealer</a>';
echo '</div>';

$action = $_GET['action'];
$distributor_id = $_GET['distributor'];
if($action == 'viewdealers'){
    
    $dealers =  get_users(
        array(
         'meta_key' => 'dealer_distributor_name',
         'meta_value' => $distributor_id
      ) ) ;
      if($dealers){
        foreach ($dealers as $dealername) {
            $user_id = $dealername->ID;
            $add_code_query_args = array(
                'post_type'   => 'pmsafe_bulk_invi',
                'action' => 'addcode',
                'dealer'  => $user_id,
            );

            $actions['addcode'] = sprintf(
                '<a href="%1$s" title="Add Batch Code"><i class="fa fa-plus"></i></a>',
                esc_url( wp_nonce_url( add_query_arg( $add_code_query_args, 'post-new.php' ), 'addcode_' . $user_id ) ),
                _x( 'Add Batch Code', 'List table row action', 'wp-list-table-example' )
            );

            // Build view registered customer row action.
            $view_customer_query_args = array(
                // 'page'   => 'dealers-lists',
                'page'   => 'customers-lists',
                'action' => 'view_customer',
                'dealer'  => $user_id,
            );

            $actions['view_customer'] = sprintf(
                '<a href="%1$s" title="View Registered Customers"><i class="fa fa-users"></i></a>',
                esc_url( wp_nonce_url( add_query_arg( $view_customer_query_args, 'admin.php' ), 'viewcustomer_' . $user_id ) ),
                _x( 'View Registered Customers', 'List table row action', 'wp-list-table-example' )
            );
            
            $registered_date = date('Y-m-d', strtotime($dealername->user_registered));
            $name = get_user_meta( $user_id, 'dealer_name' , true );
            $address = get_user_meta( $user_id, 'dealer_store_address' , true );
            $phone = get_user_meta( $user_id, 'dealer_phone_number' , true );
            $fax = get_user_meta( $user_id, 'dealer_fax_number' , true );
            $distributor_id = get_user_meta( $user_id, 'dealer_distributor_name' , true );
            $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
            $view_batch_code_url = admin_url('edit.php?s&post_status=all&post_type=pmsafe_bulk_invi&action=-1&m=0&dealer_list='.$dealername->user_login.'&distributor_list&filter_action=Filter&paged=1&action2=-1');

            $dealer_array[] = array(
                'dealer_id' => $user_id,
                'dealer_number' => $dealername->user_login,
                'dealer_name' => $name,
                'distributor_name' => $distributor_name,
                'create_date' => $registered_date,
                'add_code' => $actions['addcode'],
                'view_code' => '<a href="'.$view_batch_code_url.'" title="View Batch Codes"><i class="fa fa-eye"></i></a>',
                'view_customers' => $actions['view_customer']
            ); 
        }
      }
}else{
    $dealers = get_users( 'role=contributor' );
    foreach ( $dealers as $user ) {
        $user_id = $user->ID;
              
        $add_code_query_args = array(
        'post_type'   => 'pmsafe_bulk_invi',
        'action' => 'addcode',
        'dealer'  => $user_id,
        );

        $actions['addcode'] = sprintf(
            '<a href="%1$s" title="Add Batch Code"><i class="fa fa-plus"></i></a>',
            esc_url( wp_nonce_url( add_query_arg( $add_code_query_args, 'post-new.php' ), 'addcode_' . $user_id ) ),
            _x( 'Add Batch Code', 'List table row action', 'wp-list-table-example' )
        );

        // Build view registered customer row action.
        $view_customer_query_args = array(
            // 'page'   => 'dealers-lists',
            'page'   => 'customers-lists',
            'action' => 'view_customer',
            'dealer'  => $user_id,
        );

        $actions['view_customer'] = sprintf(
            '<a href="%1$s" title="View Registered Customers"><i class="fa fa-users"></i></a>',
            esc_url( wp_nonce_url( add_query_arg( $view_customer_query_args, 'admin.php' ), 'viewcustomer_' . $user_id ) ),
            _x( 'View Registered Customers', 'List table row action', 'wp-list-table-example' )
        );
        
        $registered_date = date('Y-m-d', strtotime($user->user_registered));
        $name = get_user_meta( $user_id, 'dealer_name' , true );
        $address = get_user_meta( $user_id, 'dealer_store_address' , true );
        $phone = get_user_meta( $user_id, 'dealer_phone_number' , true );
        $fax = get_user_meta( $user_id, 'dealer_fax_number' , true );
        $distributor_id = get_user_meta( $user_id, 'dealer_distributor_name' , true );
        $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
        $view_code_url = admin_url('edit.php?s&post_status=all&post_type=pmsafe_bulk_invi&dealer_list='.$user->user_login.'&export=1');
        $dealer_array[] = array(
            'dealer_id' => $user_id,
            'dealer_number' => $user->user_login,
            'dealer_name' => $name,
            'distributor_name' => $distributor_name,
            'created_date' => $registered_date,
            'add_code' => $actions['addcode'],
            'view_code' => '<a href="'.$view_code_url.'" title="View Batch Codes"><i class="fa fa-eye"></i></a>',
            'view_customers' => $actions['view_customer']
        ); 
    }
}

echo '<div class="table-responsive">';
echo '<table id="tbl_dealers" class="display nowrap" style="width:100%">';
echo '<thead>';
    echo '<tr>';
    echo '<th>';
    echo 'Dealer Number';
    echo '</th>';

    echo '<th>';
    echo 'Dealer Name';
    echo '</th>';
    
    echo '<th>';
    echo 'Distributor Name';
    echo '</th>';

    echo '<th>';
    echo 'Created Date';
    echo '</th>';

    echo '<th>';
    echo 'Add Batch Code';
    echo '</th>';
   
    echo '<th>';
    echo 'View Codes';
    echo '</th>';

    echo '<th>';
    echo 'View Customers';
    echo '</th>';

    echo '</tr>';
echo '</thead>';

echo '<tbody id="">';  
foreach ($dealer_array as $key => $value) {
    $page = 'dealers-lists';
    $view_query_args = array(
        'page'   => $page,
        'action' => 'view',
        'dealer'  => $value['dealer_id'],
    );

    $actions['view'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $view_query_args, 'admin.php' ), 'viewdealer_' . $value['dealer_id'] ) ),
        _x( 'View', 'List table row action', 'wp-list-table-example' )
    );

    // Build edit row action.
    $edit_query_args = array(
        'page'   => $page,
        'action' => 'edit',
        'dealer'  => $value['dealer_id'],
    );

    $actions['edit'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $edit_query_args, 'admin.php' ), 'editdealer_' . $value['dealer_id'] ) ),
        _x( 'Edit', 'List table row action', 'wp-list-table-example' )
    );

    // Build delete row action.
    $delete_query_args = array(
        'page'   => $page,
        'action' => 'delete',
        'dealer'  => $value['dealer_id'],
    );

    $actions['delete'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $delete_query_args, 'admin.php' ), 'deletedealer_' . $value['dealer_id'] ) ),
        _x( 'Delete', 'List table row action', 'wp-list-table-example' )
    );

    echo '<tr>';
        // echo '<td>'.$value['dealer_number'].'</td>';
        echo '<td>';
        echo $value['dealer_number'];
        echo '<div class="row-actions"><span class="view">'.$actions['view'].' | </span><span class="edit">'.$actions['edit'].' | </span><span class="delete">'.$actions['delete'].'</span></div>';
        echo '</td>';
        echo '<td>'.$value['dealer_name'].'</td>';
        echo '<td>'.$value['distributor_name'].'</td>';
        echo '<td>'.$value['created_date'].'</td>';
        echo '<td style="text-align:center;">'.$value['add_code'].'</td>';
        echo '<td style="text-align:center;">'.$value['view_code'].'</td>';
        echo '<td style="text-align:center;">'.$value['view_customers'].'</td>';
    echo '</tr>';
    
}
echo '</tbody>';    
echo '</table>';  
echo '</div>';
}