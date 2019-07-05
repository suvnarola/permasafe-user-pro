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
        _x( 'Add New Batch Member Code', 'List table row action', 'wp-list-table-example' )
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
        _x( 'View Registered Customers', 'List table row action', 'wp-list-table-example' )
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
    echo '<br/>';
    echo '<br/>';
    echo $actions['edit'];
    echo $actions['addcode'];
    echo $actions['view_customer'];
    if($posts){
        $url = admin_url('edit.php?s&post_status=all&post_type=pmsafe_bulk_invi&dealer_list='.$user->user_login.'&export=1');
        echo '<a href="'.$url.'">View Active and Used Batch Member Codes</a>';
    }
    echo '</div>';   
	echo '<br/>';    

	

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
    	                echo '<td colspan="2" style="font-size:15px"><b>Person '.$number.'</b><i class="fa fa-trash" id="pmsafe_dealers_contact_delete" data-id="'.$user_id.'" title="click here to delete this contact" style="color: #fff;cursor:pointer;float:right;background: #0065a7;padding: 8px;border-radius: 50%;"></td>';
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
			
            
      
       echo '</div>';
       echo '<div class="right-wrapper">';
            echo '<h3 style="color:#0065a7">Benefits Package Pricing:</h3>'; 
            $price_arr = get_user_meta($dealer_id,'pricing_pacakge',true);
            echo '<table class="view-dealer-price-tbl" id="">';
                echo '<thead>';
                    echo '<th>Benefits Package</th>';
                    echo '<th>Price
                    <p>Dealer Cost</p>
                    </th>';
                    echo '<th> </br> <p>Distributor Cost </p></th>';
                    echo '<th> </br> <p>Selling Price </p></th>';
                    echo '<th></th>';
                echo '</thead>';
                
                echo '<tbody>';
                ksort($price_arr);
                if($price_arr){
                foreach ($price_arr as $key => $value) {
    	            echo '<tr>';
                        echo '<td>'.$key.'</td>';
                        foreach ($value as $k => $v) {
        	                echo '<td>$'.$v.'</td>';
                        }
                        echo '<td style="text-align:right;">';
                            echo '<a href="#edit-price-modal" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#0065a7;padding:5px;border-radius:50%;" rel="modal:open" id="edit_price"  data-id="'.$key.'">';
                                echo '<i class="fa fa-edit"></i>';
                            echo '</a>';
                            echo '<i id="delete_price" class="fa fa-trash" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#ff0000;padding:5px;border-radius:50%;" data-id="'.$key.'"></i>';
                        echo '</td>';
    	            echo '</tr>';
                }
                }else{
                    echo '<tr>';
                        echo '<td colspan="5">No package is added.</td>';
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
                    echo '<label><strong>Dealer Cost($):</strong></label>';
                echo '</td>';
                echo '<td>';
                    echo '<input type="number" min="1" id="dealer_cost">';
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
                    echo '<label><strong>Dealer Cost($):</strong></label>';
                echo '</td>';
                echo '<td>';
                    echo '<input type="number" min="1" id="edit_dealer_cost">';
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
echo '<h1>Dealers</h1>';
$url = admin_url('admin.php?page=add-new-dealer');
echo '<a class="dealer_add" href="'.$url.'">Add New Dealer</a>';
echo '</div>';
class User_List_Table extends WP_List_Table
{
   

    /**
     * ***********************************************************************
     * Normally we would be querying data from a database and manipulating that
     * for use in your list table. For this example, we're going to simplify it
     * slightly and create a pre-built array. Think of this as the data that might
     * be returned by $wpdb->query()
     *
     * In a real-world scenario, you would run your own custom query inside
     * the prepare_items() method in this class.
     *
     * @var array
     * ************************************************************************
     */

    protected function table_data()
    {

        $data = array();
        $action = $_GET['action'];
        $distributor_id = $_GET['distributor'];
        if($action == 'viewdealers'){
             $dealer_distributor_name =  get_users(
              array(
               'meta_key' => 'dealer_distributor_name',
               'meta_value' => $distributor_id
            ) ) ;

            if($dealer_distributor_name){
                $dealers_name = '';
                foreach ($dealer_distributor_name as $dealername) {
                    $user_id = $dealername->ID;
                    $add_code_query_args = array(
                        'post_type'   => 'pmsafe_bulk_invi',
                        'action' => 'addcode',
                        'dealer'  => $user_id,
                    );

                    $actions['addcode'] = sprintf(
                        '<a href="%1$s">%2$s</a>',
                        esc_url( wp_nonce_url( add_query_arg( $add_code_query_args, 'post-new.php' ), 'addcode_' . $user_id ) ),
                        _x( 'Add Batch Member Codes', 'List table row action', 'wp-list-table-example' )
                    );

                    // Build view registered customer row action.
                    $view_customer_query_args = array(
                        // 'page'   => 'dealers-lists',
                        'page'   => 'customers-lists',
                        'action' => 'view_customer',
                        'dealer'  => $user_id,
                    );

                    $actions['view_customer'] = sprintf(
                        '<a href="%1$s">%2$s</a>',
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
                    $data[] = array(
                        'ID'  =>  $user_id,
                        'title' => $dealername->user_login,
                        'name' => $name,
                        'email' => $dealername->user_email,
                        'distributor_name' => $distributor_name,
                        'storeaddress' => $address,
                        'phone' => $phone,
                        'fax' => $fax,
                        'createdate' => $registered_date,
                        'createcode' => $actions['addcode'],
                        'viewcode' => '<a href="'.$view_batch_code_url.'">View Batch Member Codes</a>',
                        'viewcustomers' => $actions['view_customer'],
                    );
                }
            }

        }
        else{
            $dealers = get_users( 'role=contributor' );

            

            foreach ( $dealers as $user ) {
                // echo '<span>' . esc_html( $user->user_login ) . '</span>';
                $user_id = $user->ID;
              
                $add_code_query_args = array(
                'post_type'   => 'pmsafe_bulk_invi',
                'action' => 'addcode',
                'dealer'  => $user_id,
                );

                $actions['addcode'] = sprintf(
                    '<a href="%1$s">%2$s</a>',
                    esc_url( wp_nonce_url( add_query_arg( $add_code_query_args, 'post-new.php' ), 'addcode_' . $user_id ) ),
                    _x( 'Add Codes', 'List table row action', 'wp-list-table-example' )
                );

                // Build view registered customer row action.
                $view_customer_query_args = array(
                    // 'page'   => 'dealers-lists',
                    'page'   => 'customers-lists',
                    'action' => 'view_customer',
                    'dealer'  => $user_id,
                );

                $actions['view_customer'] = sprintf(
                    '<a href="%1$s">%2$s</a>',
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
                $data[] = array(
                    'ID'  =>  $user_id,
                    'title' => $user->user_login,
                    'name' => $name,
                    'email' => $user->user_email,
                    'distributor_name' => $distributor_name,
                    'storeaddress' => $address,
                    'phone' => $phone,
                    'fax' => $fax,
                    'createdate' => $registered_date,
                    'createcode' => $actions['addcode'],
                    'viewcode' => '<a href="'.$view_code_url.'">View Codes</a>',
                    'viewcustomers' => $actions['view_customer'],
                );
            }
        }
        return $data;
    }
    

    /**
     * TT_Example_List_Table constructor.
     *
     * REQUIRED. Set up a constructor that references the parent constructor. We
     * use the parent reference to set some default configs.
     */
    public function __construct() {
        // Set parent defaults.
        parent::__construct( array(
            'singular' => 'dealer',     // Singular name of the listed records.
            'plural'   => 'dealers',    // Plural name of the listed records.
            'ajax'     => false,       // Does this table support ajax?
        ) );
    }

    /**
     * Get a list of columns. The format is:
     * 'internal-name' => 'Title'
     *
     * REQUIRED! This method dictates the table's columns and titles. This should
     * return an array where the key is the column slug (and class) and the value
     * is the column's title text. If you need a checkbox for bulk actions, refer
     * to the $columns array below.
     *
     * The 'cb' column is treated differently than the rest. If including a checkbox
     * column in your table you must create a `column_cb()` method. If you don't need
     * bulk actions or checkboxes, simply leave the 'cb' entry out of your array.
     *
     * @see WP_List_Table::::single_row_columns()
     * @return array An associative array containing column information.
     */
    public function get_columns() {
        $columns = array(
            // 'cb'       => '<input type="checkbox" />', // Render a checkbox instead of text.
            'title'    => _x( 'Dealer Number', 'Column label', 'wp-list-table-example' ),
            'name'    => _x( 'Dealer Name', 'Column label', 'wp-list-table-example' ),
            //'email'    => _x( 'Email', 'Column label', 'wp-list-table-example' ),
            'distributor_name'    => _x( 'Distributor Name', 'Column label', 'wp-list-table-example' ),
            // 'storeaddress'   => _x( 'Store Address', 'Column label', 'wp-list-table-example' ),
            // 'phone' => _x( 'Phone Number', 'Column label', 'wp-list-table-example' ),
            // 'fax' => _x( 'Fax Number', 'Column label', 'wp-list-table-example' ),
            'createdate' => _x( 'Created Date', 'Column label', 'wp-list-table-example' ),
            'createcode' => _x( 'Member Codes', 'Column label', 'wp-list-table-example' ),
            'viewcode' => _x( ' ', 'Column label', 'wp-list-table-example' ),
            'viewcustomers' => _x( 'View Customers', 'Column label', 'wp-list-table-example' ),
        );

        return $columns;
    }

    /**
     * Get a list of sortable columns. The format is:
     * 'internal-name' => 'orderby'
     * or
     * 'internal-name' => array( 'orderby', true )
     *
     * The second format will make the initial sorting order be descending
     *
     * Optional. If you want one or more columns to be sortable (ASC/DESC toggle),
     * you will need to register it here. This should return an array where the
     * key is the column that needs to be sortable, and the value is db column to
     * sort by. Often, the key and value will be the same, but this is not always
     * the case (as the value is a column name from the database, not the list table).
     *
     * This method merely defines which columns should be sortable and makes them
     * clickable - it does not handle the actual sorting. You still need to detect
     * the ORDERBY and ORDER querystring variables within `prepare_items()` and sort
     * your data accordingly (usually by modifying your query).
     *
     * @return array An associative array containing all the columns that should be sortable.
     */
    protected function get_sortable_columns() {
        $sortable_columns = array(
            'title'    => array( 'title', false ),
            'name'   => array( 'name', false ),
            'distributor_name'   => array( 'distributor_name', false ),
            // 'email'   => array( 'email', false ),
            // 'storeaddress'   => array( 'storeaddress', false ),
            // 'phone' => array( 'phone', false ),
            // 'fax' => array( 'fax', false ),
            'createdate' => array( 'createdate', false ),
        );

        return $sortable_columns;
    }

    /**
     * Get default column value.
     *
     * Recommended. This method is called when the parent class can't find a method
     * specifically build for a given column. Generally, it's recommended to include
     * one method for each column you want to render, keeping your package class
     * neat and organized. For example, if the class needs to process a column
     * named 'title', it would first see if a method named $this->column_title()
     * exists - if it does, that method will be used. If it doesn't, this one will
     * be used. Generally, you should try to use custom column methods as much as
     * possible.
     *
     * Since we have defined a column_title() method later on, this method doesn't
     * need to concern itself with any column with a name of 'title'. Instead, it
     * needs to handle everything else.
     *
     * For more detailed insight into how columns are handled, take a look at
     * WP_List_Table::single_row_columns()
     *
     * @param object $item        A singular item (one full row's worth of data).
     * @param string $column_name The name/slug of the column to be processed.
     * @return string Text or HTML to be placed inside the column <td>.
     */
    protected function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'name':
            case 'email':
            case 'distributor_name':
            // case 'storeaddress':
            // case 'phone':
            // case 'fax':
            case 'createdate':
            case 'createcode':
            case 'viewcode':
            case 'viewcustomers':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ); // Show the whole array for troubleshooting purposes.
        }
    }

    /**
     * Get value for checkbox column.
     *
     * REQUIRED if displaying checkboxes or using bulk actions! The 'cb' column
     * is given special treatment when columns are processed. It ALWAYS needs to
     * have it's own method.
     *
     * @param object $item A singular item (one full row's worth of data).
     * @return string Text to be placed inside the column <td>.
     */
    protected function column_cb( $item ) {

        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],  // Let's simply repurpose the table's singular label ("dealer").
            $item['ID']                // The value of the checkbox should be the record's ID.
        );
    }

    /**
     * Get title column value.
     *
     * Recommended. This is a custom column method and is responsible for what
     * is rendered in any column with a name/slug of 'title'. Every time the class
     * needs to render a column, it first looks for a method named
     * column_{$column_title} - if it exists, that method is run. If it doesn't
     * exist, column_default() is called instead.
     *
     * This example also illustrates how to implement rollover actions. Actions
     * should be an associative array formatted as 'slug'=>'link html' - and you
     * will need to generate the URLs yourself. You could even ensure the links are
     * secured with wp_nonce_url(), as an expected security measure.
     *
     * @param object $item A singular item (one full row's worth of data).
     * @return string Text to be placed inside the column <td>.
     */
    protected function column_title( $item ) {
        $page = wp_unslash( $_REQUEST['page'] ); // WPCS: Input var ok.

        // Build view row action.
        $view_query_args = array(
            'page'   => $page,
            'action' => 'view',
            'dealer'  => $item['ID'],
        );

        $actions['view'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url( wp_nonce_url( add_query_arg( $view_query_args, 'admin.php' ), 'viewdealer_' . $item['ID'] ) ),
            _x( 'View', 'List table row action', 'wp-list-table-example' )
        );

        // Build edit row action.
        $edit_query_args = array(
            'page'   => $page,
            'action' => 'edit',
            'dealer'  => $item['ID'],
        );

        $actions['edit'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url( wp_nonce_url( add_query_arg( $edit_query_args, 'admin.php' ), 'editdealer_' . $item['ID'] ) ),
            _x( 'Edit', 'List table row action', 'wp-list-table-example' )
        );

        // Build delete row action.
        $delete_query_args = array(
            'page'   => $page,
            'action' => 'delete',
            'dealer'  => $item['ID'],
        );

        $actions['delete'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url( wp_nonce_url( add_query_arg( $delete_query_args, 'admin.php' ), 'deletedealer_' . $item['ID'] ) ),
            _x( 'Delete', 'List table row action', 'wp-list-table-example' )
        );

        // Return the title contents.
        return sprintf( '%1$s <span style="color:silver;"></span>%3$s',
            $item['title'],
            $item['ID'],
            $this->row_actions( $actions )
        );
    }

    /**
     * Get an associative array ( option_name => option_title ) with the list
     * of bulk actions available on this table.
     *
     * Optional. If you need to include bulk actions in your list table, this is
     * the place to define them. Bulk actions are an associative array in the format
     * 'slug'=>'Visible Title'
     *
     * If this method returns an empty value, no bulk action will be rendered. If
     * you specify any bulk actions, the bulk actions box will be rendered with
     * the table automatically on display().
     *
     * Also note that list tables are not automatically wrapped in <form> elements,
     * so you will need to create those manually in order for bulk actions to function.
     *
     * @return array An associative array containing all the bulk actions.
     */
    // protected function get_bulk_actions() {
    //     $actions = array(
    //         'delete' => _x( 'Delete', 'List table bulk action', 'wp-list-table-example' ),
    //     );

    //     return $actions;
    // }

    /**
     * Handle bulk actions.
     *
     * Optional. You can handle your bulk actions anywhere or anyhow you prefer.
     * For this example package, we will handle it in the class to keep things
     * clean and organized.
     *
     * @see $this->prepare_items()
     */
    protected function process_bulk_action() {
        // Detect when a bulk action is being triggered.
        // if ( 'delete' === $this->current_action() ) {
        //     wp_die( 'Items deleted (or they would be if we had items to delete)!' );
        // }
    }

    /**
     * Prepares the list of items for displaying.
     *
     * REQUIRED! This is where you prepare your data for display. This method will
     * usually be used to query the database, sort and filter the data, and generally
     * get it ready to be displayed. At a minimum, we should set $this->items and
     * $this->set_pagination_args(), although the following properties and methods
     * are frequently interacted with here.
     *
     * @global wpdb $wpdb
     * @uses $this->_column_headers
     * @uses $this->items
     * @uses $this->get_columns()
     * @uses $this->get_sortable_columns()
     * @uses $this->get_pagenum()
     * @uses $this->set_pagination_args()
     */
    function prepare_items() {
        global $wpdb; //This is used only if making any database queries

        /*
         * First, lets decide how many records per page to show
         */
        $per_page = 10;

        /*
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();

        /*
         * REQUIRED. Finally, we build an array to be used by the class for column
         * headers. The $this->_column_headers property takes an array which contains
         * three other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array( $columns, $hidden, $sortable );

        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();

        /*
         * GET THE DATA!
         * 
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example
         * package slightly different than one you might build on your own. In
         * this example, we'll be using array manipulation to sort and paginate
         * our dummy data.
         * 
         * In a real-world situation, this is probably where you would want to 
         * make your actual database query. Likewise, you will probably want to
         * use any posted sort or pagination data to build a custom query instead, 
         * as you'll then be able to use the returned query data immediately.
         *
         * For information on making queries in WordPress, see this Codex entry:
         * http://codex.wordpress.org/Class_Reference/wpdb
         */
        $data = $this->table_data();

        /*
         * This checks for sorting input and sorts the data in our array of dummy
         * data accordingly (using a custom usort_reorder() function). It's for 
         * example purposes only.
         *
         * In a real-world situation involving a database, you would probably want
         * to handle sorting by passing the 'orderby' and 'order' values directly
         * to a custom query. The returned data will be pre-sorted, and this array
         * sorting technique would be unnecessary. In other words: remove this when
         * you implement your own query.
         */
        usort( $data, array( $this, 'usort_reorder' ) );

        /*
         * REQUIRED for pagination. Let's figure out what page the user is currently
         * looking at. We'll need this later, so you should always include it in
         * your own package classes.
         */
        $current_page = $this->get_pagenum();

        /*
         * REQUIRED for pagination. Let's check how many items are in our data array.
         * In real-world use, this would be the total number of items in your database,
         * without filtering. We'll need this later, so you should always include it
         * in your own package classes.
         */
        $total_items = count( $data );

        /*
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to do that.
         */
        $data = array_slice( $data, ( ( $current_page - 1 ) * $per_page ), $per_page );

        /*
         * REQUIRED. Now we can add our *sorted* data to the items property, where
         * it can be used by the rest of the class.
         */
        $this->items = $data;

        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args( array(
            'total_items' => $total_items,                     // WE have to calculate the total number of items.
            'per_page'    => $per_page,                        // WE have to determine how many items to show on a page.
            'total_pages' => ceil( $total_items / $per_page ), // WE have to calculate the total number of pages.
        ) );
    }

    /**
     * Callback to allow sorting of example data.
     *
     * @param string $a First value.
     * @param string $b Second value.
     *
     * @return int
     */
    protected function usort_reorder( $a, $b ) {
        // If no sort, default to title.
        $orderby = ! empty( $_REQUEST['orderby'] ) ? wp_unslash( $_REQUEST['orderby'] ) : 'title'; // WPCS: Input var ok.

        // If no order, default to asc.
        $order = ! empty( $_REQUEST['order'] ) ? wp_unslash( $_REQUEST['order'] ) : 'asc'; // WPCS: Input var ok.

        // Determine sort order.
        $result = strcmp( $a[ $orderby ], $b[ $orderby ] );

        return ( 'asc' === $order ) ? $result : - $result;
    }
}// class end

$userListTable = new User_List_Table();
$userListTable->prepare_items();
$userListTable->display(); 
}