<?Php

$action = $_GET['action'];


if($action == 'view_customer_details'){
    $user_id = $_GET['id'];

    $edit_customer_details_query_args = array(
        'page'   => 'customers-lists',
        'action' => 'edit_customer_details',
        'id'  => $user_id,
    );

    $actions['edit_customer_details'] = sprintf(
        '<a href="%1$s" title="Edit Details">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $customer_user->ID ) ),
        _x( 'Edit details', 'List table row action', 'wp-list-table-example' )
    );

    $nickname = get_user_meta($user_id,'nickname', true);
    $vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);

    $post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
    $benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'],'_pmsafe_code_prefix',true);
    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
    $term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );

    $login = get_post_meta($post_id,'_pmsafe_dealer', true);
    $users = get_user_by('login',$login);
    $dealer_id = $users->ID;
    $dealername = get_user_meta($dealer_id,'dealer_name', true);

    $distributor_login = get_post_meta($post_id,'_pmsafe_distributor', true);
    $distributor_users = get_user_by('login',$distributor_login);
    $distributor_id = $distributor_users->ID;
    $distributorname = get_user_meta($distributor_id,'distributor_name', true);

    $expiration_date = date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
    // $expiration_date = '2019-04-07';
    $current_date = date('Y-m-d');
    $name = get_user_meta($user_id,'first_name', true).' '.get_user_meta($user_id,'last_name', true);
    $address1 = get_user_meta($user_id,'pmsafe_address_1',true);
    $address2 = get_user_meta($user_id,'pmsafe_address_2',true);

    echo '<div class="top-head">';
        echo '<h1>Customer Details</h1>';
        echo $actions['edit_customer_details'];
        echo '<p class="expired">EXPIRED ON '.$expiration_date.'</p>';
    echo '</div>';
    echo '<div class="notice notice-success is-dismissible" style="display:none;">';
        echo '<p>Customer updated.</p>';
    echo '</div>';
    echo '<table class="view-customer-details-tbl">';
        echo '<tr>';
            echo '<td>Member Code</td>';
            echo '<td>'.get_user_meta($user_id,'nickname', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Name</td>';
            echo '<td>'.$name.'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Address</td>';
            echo '<td>'.$address1.' '.$address2.'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>City</td>';
            echo '<td>'.get_user_meta($user_id,'pmsafe_city', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>State</td>';
            echo '<td>'.get_user_meta($user_id,'pmsafe_state', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Zip Code</td>';
            echo '<td>'.get_user_meta($user_id,'pmsafe_zip_code', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Phone</td>';
            echo '<td>'.get_user_meta($user_id,'pmsafe_phone_number', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Email</td>';
            echo '<td>'.get_user_meta($user_id,'pmsafe_email', true).'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Dealer</td>';
            echo '<td>'.$dealername.' ( '.$login.' )'.'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Distributor</td>';
            echo '<td>'.$distributorname.' ( '.$distributor_login.' )'.'</td>';
        echo '</tr>';
    echo '</table>';

    echo '<h3>Vehicle Information:</h3>';
    echo '<table class="view-customer-details-tbl">';
        echo '<tr>';
            echo '<td>Vehicle Year</td>';
            echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_year'].'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Vehicle Make</td>';
            echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_make'].'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Vehicle Model</td>';
            echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_model'].'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Vehicle Mileage</td>';
            echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_mileage'].'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Vehicle VIN</td>';
            echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vin'].'</td>';
        echo '</tr>';
        echo '<tr>';
            echo '<td>Registration Date</td>';
            echo '<td>'.date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])).'</td>';
        echo '</tr>';
        
        echo '<tr>';
            echo '<td>Status</td>';
            if($current_date > $expiration_date){
                echo '<td class="expired">Expired</td>';
            }else{
                echo '<td class="active">Active</td>';
            }
        echo '</tr>';        
       
        $url = get_site_url().'/wp-includes/images/media/document.png';
        echo '<tr>';
            echo '<td>PDF</td>';
            echo '<td>';
                echo '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" title="click here to view" target="_blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"></a>';
            echo '</td>';
            // echo '<td><a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="_blank"><img src="'.get_site_url().'/wp-includes/images/media/document.png'" class='attachment-thumbnail' style='width:20px !important'></a></td>';
        echo '</tr>';


    echo '</table>';
}else if($action == 'view_customer'){
    $dealer_id =  $_GET['dealer'];

$user = get_user_by( 'ID', $dealer_id );
$dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
    $search_customer_details_query_args = array(
        'page'   => 'dealers-lists',
        'action' => 'search_customer_details',
        'dealer_login'  => $user->user_login,
    );

    $actions['search_customer_details'] = sprintf(
        '<a href="%1$s" title="Advanced Search">%2$s</a>',
        esc_url( wp_nonce_url( add_query_arg( $search_customer_details_query_args, 'admin.php' ), 'searchcustomerdetails_' . $customer_user->ID ) ),
        _x( 'Advanced Search', 'List table row action', 'wp-list-table-example' )
    );
    
    echo '<div class="top-head">';
    echo '<h1>'.$dealer_name.' ( '.$user->user_login.' )\'s '.'Registered Customers</h1>';
    echo $actions["search_customer_details"];
    echo '</div>';
    $args = array(
        'post_type' => 'pmsafe_bulk_invi',
        'post_status' => 'publish',
        'order'            => 'ASC',
        'posts_per_page' => -1,
        'meta_query' => array(
            // 'relation' => 'AND',
            array(
                'key'     => '_pmsafe_dealer',
                'value'   => $user->user_login,
                'compare' => '=',
            ),
        ),
    );
    $dealer_login = $user->user_login;
    $posts = get_posts($args);   
    // pr($posts);
    $html = '';  
    $html .= '<div id="perma-warranty-wrapper">';
     $html .= '<div class="filter-main-wrapper">';
        $html .= '<div class="filter-wrapper">';             
        
         $html .= '<select id="view-customer-table-select">';
            $html .= '<option>Member Code</option>';
            // $html .= '<option>Benefits Package</option>';
            // $html .= '<option>Product Code Range</option>';
            // // $html .= '<option>Code Status</option>';
            // $html .= '<option>Member Name</option>';
            // $html .= '<option>Email</option>';
            // $html .= '<option>Address</option>';
            // $html .= '<option>Vehicle Information</option>';
            // $html .= '<option>VIN</option>';
            // $html .= '<option>Registration Date</option>';
            // $html .= '<option>Expiration Date</option>';
        $html .= '</select>';
        $html .= '</div>';
         $html .= '<div class="table-responsive">';        
         $html .= '<table id="view_customer_table" class="display nowrap" style="width:100%">';

                           $html .= '<thead>';
                                $html .= '<tr>';
                                    $html .= '<th>';
                                    $html .= 'Member<br/> Code';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                    $html .= 'Member <br/> Name';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                    $html .= 'Email';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                    $html .= 'Address';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                    $html .= 'PDF';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'PDF';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Benefits<br/> Package';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Product Code <br/> Range';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Dealer Name';
                                    $html .= '</th>';
            
                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Distributor name';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Vehicle <br/> Information';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'VIN';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Registration <br/> Date';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'Expiration <br/> Date';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                    $html .= 'View Detail';
                                    $html .= '</th>';
                                    
                                    $html .= '<th>';
                                    $html .= 'Edit Detail';
                                    $html .= '</th>';
                                    
                                    $html .= '<th>';
                                    $html .= 'Delete Detail';
                                    $html .= '</th>';

                                    
                                $html .= '</tr>';
                            $html .= '</thead>';

                            $html .= '<tbody id="">';
                            if($posts){
                            foreach ($posts as $key => $value) {
                                $post_id = $value->ID;
                                $bulk_member = $value->post_title;
                                $invitation_ids = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
                                $benefits_package = get_post_meta( $post_id, '_pmsafe_invitation_prefix', true );
                                $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
                                $term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );
                                $invitation_id = explode(',',$invitation_ids);
                                $data = pmsafe_unused_code_count($post_id);
                                $available = $data['total'] - $data['used'];

                            if($data['used'] != 0){
                                    // $html .= '<input type="button" id="export-dealer-customer-csv" title="Export to CSV" value="Export to CSV" style="float:right;margin: 10px 5px;"/><input type="hidden" id="hdn_customer_dealer_login" value="'.$dealer_login.'">';
                                foreach ($invitation_id as $id) {
                                $code_status = get_post_meta($id, '_pmsafe_code_status', true);
                                if($code_status == 'used'){
                                    
                                    $code = get_post_meta( $id, '_pmsafe_invitation_code', true );
                                    
                                    $pdf_link = get_post_meta( $id, 'pmsafe_pdf_link', true );
                                    
                                    $customer_user = get_user_by('login',$code);
                                    $customer_name = $customer_user->first_name.' '.$customer_user->last_name;
                                    $created_date = get_post_meta($id, '_pmsafe_code_create_date', true);
                                    $used_date = get_post_meta($id, '_pmsafe_used_code_date', true);

                                    $dealers = get_user_by('login', $dealer_login);
                                    $dealer_id = $dealers->data->ID;
                                    $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
                                    $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
                                    $distributors = get_user_by('login', $distributor_login);
                                    $distributor_id = $distributors->data->ID;
                                    $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);

                                    $address1 = get_the_author_meta( 'pmsafe_address_1', $customer_user->ID );
                                    $address2 = get_the_author_meta( 'pmsafe_address_2', $customer_user->ID );
                                    if(!empty($address1) || $address2){
                                        $address = $address1.', '.$address2;
                                    }
                                    $city = get_the_author_meta( 'pmsafe_city', $customer_user->ID );
                                    $state = get_the_author_meta( 'pmsafe_state', $customer_user->ID );
                                    $zip_code = get_the_author_meta( 'pmsafe_zip_code', $customer_user->ID );
                                    // echo $user_id;
                                    // $phone_number = get_user_meta( $user_id, 'pmsafe_phone_number',true );
                                    $vehicle_information = get_the_author_meta('pmsafe_vehicle_info' ,$customer_user->ID);
                                    
                                     $html .= '<tr>';
                                        $html .= '<td>';
                                            $html .= $customer_user->user_login;
                                        $html .= '</td>';


                                        $html .= '<td>';
                                            $html .= $customer_name;
                                        $html .= '</td>';

                                        $html .= '<td>';
                                            $html .= $customer_user->user_email;
                                        $html .= '</td>';

                                         $html .= '<td>';
                                            $html .= $address.'<br/>'.$city.', '.$state.', '.$zip_code;
                                        $html .= '</td>';

                                        $html .= '<td class="text-center">';
                                        $document_url = get_site_url().'/wp-includes/images/media/document.png';
                                            $html .= '<a href="'.$pdf_link.'" target="_blank"><img src="'.$document_url.'" class="attachment-thumbnail" style="width:20px !important"></a>';
                                        $html .= '</td>';
                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= $pdf_link;
                                        $html .= '</td>';

                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= $benefits_package;
                                        $html .= '</td>';

                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= $bulk_member;
                                        $html .= '</td>';

                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= $dealer_name;
                                        $html .= '</td>';
                                        
                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= $distributor_name;
                                        $html .= '</td>';

                                        $html .= '<td class="nisl-pdf-link">';
                                         $html .= $vehicle_information[$customer_user->user_login]['pmsafe_vehicle_year'] . ' ' . $vehicle_information[$customer_user->user_login]['pmsafe_vehicle_make'] . ' ' . $vehicle_information[$customer_user->user_login]['pmsafe_vehicle_model'];
                                        $html .= '</td>';

                                         $html .= '<td class="nisl-pdf-link">';
                                            $html .= $vehicle_information[$customer_user->user_login]['pmsafe_vin'];
                                        $html .= '</td>';

                                        $html .= '<td class="nisl-pdf-link">';
                                            $html .= date('Y-m-d', strtotime($vehicle_information[$customer_user->user_login]['pmsafe_registration_date']));
                                        $html .= '</td>';

                                         $html .= '<td class="nisl-pdf-link">';
                                            $html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_information[$customer_user->user_login]['pmsafe_registration_date'])));
                                        $html .= '</td>';

                                        $view_customer_details_query_args = array(
                                            'page'   => 'customers-lists',
                                            'action' => 'view_customer_details',
                                            'id'  => $customer_user->ID,
                                        );

                                        $actions['view_customer_details'] = sprintf(
                                            '<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
                                            esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $customer_user->ID ) ),
                                            _x( 'view details', 'List table row action', 'wp-list-table-example' )
                                        );


                                        $html .= '<td class="text-center">';
                                            $html .= $actions["view_customer_details"];
                                        $html .= '</td>';


                                        $edit_customer_details_query_args = array(
                                            'page'   => 'customers-lists',
                                            'action' => 'edit_customer_details',
                                            'id'  => $customer_user->ID,
                                        );

                                        $actions['edit_customer_details'] = sprintf(
                                            '<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
                                            esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $customer_user->ID ) ),
                                            _x( 'edit details', 'List table row action', 'wp-list-table-example' )
                                        );
                                        
                                        $html .= '<td class="text-center">';
                                            $html .= $actions["edit_customer_details"];
                                        $html .= '</td>';

                                         $delete_customer_details_query_args = array(
                                            'page'   => 'dealers-lists',
                                            'action' => 'delete_customer_details',
                                            'id'  => $customer_user->ID,
                                        );

                                        $actions['delete_customer_details'] = sprintf(
                                            '<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
                                            esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $customer_user->ID ) ),
                                            _x( 'delete details', 'List table row action', 'wp-list-table-example' )
                                        );
                                        
                                        $html .= '<td class="text-center">';
                                            $html .= $actions["delete_customer_details"];
                                        $html .= '</td>';

                                        
                                    $html .= '</tr>';
                                }
                                

                                
                                }
                            }
                            
                                
                            }
                                
                        }
                            $html .= '</tbody>';
                    $html .= '</table>';
                    $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
    echo $html;            
            
            
}else if($action == 'edit_customer_details'){
    $user_id = $_GET['id'];
    // $customer = get_user_by( 'ID', $user_id );
    $nickname = get_user_meta($user_id,'nickname', true);
    $fname = get_user_meta($user_id,'first_name', true);
    $lname = get_user_meta($user_id,'last_name', true);
    $address1 = get_user_meta($user_id,'pmsafe_address_1',true);
    $address2 = get_user_meta($user_id,'pmsafe_address_2',true);
    $vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);
    $post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];


    echo '<h1>Edit Customer Information</h1>';
   
    echo '<div class="wrap dealer_add_form_div">';
        echo '<form name="perma_edit_customer" id="perma_edit_customer_form" method="POST" class="validate">';

            echo '<input type="hidden" id="pmsafe_customer_id" name="pmsafe_customer_id" value="'.$user_id.'" class="widefat" />';
            echo '<input type="hidden" id="pmsafe_customer_code" name="pmsafe_customer_code" value="'.$nickname.'" class="widefat" />';


            echo '<div id="fname_div">';
                echo '<label><strong>First Name</strong></label>';
                echo '<input type="text" id="pmsafe_customer_fname" name="pmsafe_customer_fname" value="'.$fname.'" class="widefat" />';
            echo '</div>';

            echo '<div id="lname_div">';
                echo '<label><strong>Last Name</strong></label>';
                echo '<input type="text" id="pmsafe_customer_lname" name="pmsafe_customer_lname" value="'.$lname.'" class="widefat" />';
            echo '</div>';

            // $customer_pwd = wp_generate_password();

            echo '<div id="password_div">';
                echo '<label><strong>Password</strong></label>';
                echo '<input type="password" id="pmsafe_customer_password" name="pmsafe_customer_password" value="" class="widefat" style="display:none;"/>';
                echo '<input type="button" value="Generate New Password" id="generate_customer_password" />';
                echo '<input type="button" value="Hide" id="hide_customer_password" style="display:none;"/>';
                echo '<input type="button" value="Show" id="show_customer_password" style="display:none;"/>';
                echo '<input type="button" value="Cancel" id="cancel_customer_password" style="display:none;"/>';
            echo '</div>';

            echo '<div id="address1_div">';
                echo '<label><strong>Address1</strong></label>';
                echo '<textarea id="pmsafe_customer_address1" name="pmsafe_customer_address1" class="widefat">'.$address1.'</textarea>';
            echo '</div>';

            echo '<div id="address2_div">';
                echo '<label><strong>Address2</strong></label>';
                echo '<textarea id="pmsafe_customer_address2" name="pmsafe_customer_address2" class="widefat">'.$address2.'</textarea>';
            echo '</div>';

            echo '<div id="city_div">';
                echo '<label><strong>City</strong></label>';
                echo '<input type="text" id="pmsafe_customer_city" name="pmsafe_customer_city" value="'.get_user_meta($user_id,'pmsafe_city', true).'" class="widefat" />';
            echo '</div>';

            echo '<div id="state_div">';
                echo '<label><strong>State</strong></label>';
                echo '<input type="text" id="pmsafe_customer_state" name="pmsafe_customer_state" value="'.get_user_meta($user_id,'pmsafe_state', true).'" class="widefat" />';
            echo '</div>';

            echo '<div id="zip_div">';
                echo '<label><strong>Zip Code</strong></label>';
                echo '<input type="text" id="pmsafe_customer_zip" name="pmsafe_customer_zip" value="'.get_user_meta($user_id,'pmsafe_zip_code', true).'" class="widefat" />';
            echo '</div>';

            echo '<div id="phone_div">';
                echo '<label><strong>Phone Number</strong></label>';
                echo '<input type="text" id="pmsafe_customer_phone_number" name="pmsafe_customer_phone_number" value="'.get_user_meta($user_id,'pmsafe_phone_number', true).'" class="widefat" />';
            echo '</div>';


            echo '<h3>Vehicle Information:</h3>';

            echo '<div id="vehicle_year_div">';
                echo '<label><strong>Vehicle Year</strong></label>';
                echo '<input type="text" id="pmsafe_customer_vehicle_year" name="pmsafe_customer_vehicle_year" value="'.$vehicle_info[0][$nickname]['pmsafe_vehicle_year'].'" class="widefat" />';
            echo '</div>';

            echo '<div id="vehicle_make_div">';
                echo '<label><strong>Vehicle Make</strong></label>';
                echo '<input type="text" id="pmsafe_customer_vehicle_make" name="pmsafe_customer_vehicle_make" value="'.$vehicle_info[0][$nickname]['pmsafe_vehicle_make'].'" class="widefat" />';
            echo '</div>';

            echo '<div id="vehicle_model_div">';
                echo '<label><strong>Vehicle Model</strong></label>';
                echo '<input type="text" id="pmsafe_customer_vehicle_model" name="pmsafe_customer_vehicle_model" value="'.$vehicle_info[0][$nickname]['pmsafe_vehicle_model'].'" class="widefat" />';
            echo '</div>';

            echo '<div id="vehicle_vin_div">';
                echo '<label><strong>Vehicle VIN</strong></label>';
                echo '<input type="text" id="pmsafe_customer_vehicle_vin" name="pmsafe_customer_vehicle_vin" value="'.$vehicle_info[0][$nickname]['pmsafe_vin'].'" class="widefat" />';
            echo '</div>';

            echo '<div id="vehicle_mileage_div">';
                echo '<label><strong>Vehicle Mileage</strong></label>';
                echo '<input type="text" id="pmsafe_customer_vehicle_mileage" name="pmsafe_customer_vehicle_mileage" value="'.$vehicle_info[0][$nickname]['pmsafe_vehicle_mileage'].'" class="widefat" />';
            echo '</div>';

            echo '<div id="upload_pdf_div">';
                echo '<form method="post" enctype="multipart/form-data">';
                    echo '<label><strong>File</strong></label>';
                    echo '<input type="file" id="file_upload" name="file_upload" class="widefat" />';
                echo '</form>';
            echo '</div>';
            
            echo '<input type="submit" id="pmsafe_customer_update" value="Update" class="button button-primary button-large">';

        echo '</form>';
    echo '</div>';
}else if($action == 'delete_customer_details'){
    $user_id = $_GET['id'];
    $fname = get_user_meta($user_id,'first_name', true);
    $lname = get_user_meta($user_id,'last_name', true);
    $nickname = get_user_meta($user_id,'nickname', true);
    echo '<h1>Delete Customer</h1>';
    echo '<form name="perma_delete_customer_form" id="perma_delete_customers_form" method="POST" class="validate">';

        echo '<p>You have specified this user for deletion:</p>';
        echo 'ID #'.$user_id.': '.$fname.' '.$lname.' ('.$nickname.')';
        echo '<input type="hidden" id="pmsafe_customer_id" name="pmsafe_customer_id" value="'.$user_id.'" class="widefat" /><br/><br/>';

        echo '<input type="submit" id="pmsafe_customers_delete" value="Confirm Deletion" class="button button-primary button-large">';
    echo '</form>';
}
else{
echo '<div class="top-head">';
echo '<h1 class="customer-head">Customers</h1>';
echo '<a href="'.admin_url().'admin.php?page=customer-search" title="Advanced Search">Advanced Search</a>';
echo '<a href="'.admin_url().'admin.php?page=customer-filter" title="Quick filter">Quick Filters</a>';
echo '</div>';
$args = array(
    'role'         => 'subscriber',
);
$users = get_users( $args );

$html = '';
$html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div class="filter-main-wrapper">';
        $html .= '<div class="filter-wrapper">';
            $html .= '<select id="view-customer-table-select">';
                $html .= '<option>Member Code</option>';
            $html .= '</select>';
        $html .= '</div>';
        $html .= '<div class="table-responsive">';
            $html .= '<table id="view_customer_table" class="display nowrap" style="width:100%">';
                $html .= '<thead>';
                    $html .= '<tr>';
                        $html .= '<th>';
                        $html .= 'Member<br/> Code';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Member <br/> Name';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Email';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Address';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'PDF';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'PDF';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Benefits<br/> Package';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Product Code <br/> Range';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Dealer Name';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Distributor Name';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Vehicle <br/> Information';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'VIN';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Registration <br/> Date';
                        $html .= '</th>';

                        $html .= '<th class="nisl-pdf-link">';
                        $html .= 'Expiration <br/> Date';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'View Detail';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Edit Detail';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Delete Detail';
                        $html .= '</th>';


                    $html .= '</tr>';
                $html .= '</thead>';

                $html .= '<tbody id="">';
                if($users){
                    foreach ($users as $key => $value) {
                        $user_id = $value->ID;
                        $login = $value->user_login;
                        $customer_user = get_user_by('login',$login);
                        $customer_name = $customer_user->first_name.' '.$customer_user->last_name;
                        $created_date = get_post_meta($id, '_pmsafe_code_create_date', true);
                        $used_date = get_post_meta($id, '_pmsafe_used_code_date', true);



                        $address1 = get_the_author_meta( 'pmsafe_address_1', $customer_user->ID );
                        $address2 = get_the_author_meta( 'pmsafe_address_2', $customer_user->ID );
                        if(!empty($address1) || $address2){
                            $address = $address1.', '.$address2;
                        }
                        $city = get_the_author_meta( 'pmsafe_city', $customer_user->ID );
                        $state = get_the_author_meta( 'pmsafe_state', $customer_user->ID );
                        $zip_code = get_the_author_meta( 'pmsafe_zip_code', $customer_user->ID );
                        // echo $user_id;
                        // $phone_number = get_user_meta( $user_id, 'pmsafe_phone_number',true );
                        $vehicle_information = get_the_author_meta('pmsafe_vehicle_info' ,$customer_user->ID);
                        // pr($vehicle_information);
                        $pdf_link = $vehicle_information[$login]['pmsafe_pdf_link'];
                        $post_id = $vehicle_information[$login]['pmsafe_member_code_id'];
                        $benefits_package = get_post_meta($vehicle_information[$login]['pmsafe_member_code_id'],'_pmsafe_code_prefix',true);
                        $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
                        $term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );

                        $dealer_login = get_post_meta($post_id,'_pmsafe_dealer', true);
                        $dealers = get_user_by('login', $dealer_login);
                        $dealer_id = $dealers->data->ID;
                        $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);

                        $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true );
                        $distributors = get_user_by('login', $distributor_login);
                        $distributor_id = $distributors->data->ID;
                        $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
                        
                        $posts = get_post($post_id);
                        $post_title = $posts->post_title;
                        $post_title = substr($post_title, 0, strpos($post_title, ' '));
                        // $code_start = get_post_meta($post_id, '_pmsafe_invitation_code_start', true);

                        // $code_end = get_post_meta($post_id,'_pmsafe_invitation_code_end',true);

                        // $post_title =  $code_start.'-'.$code_end;


                        // pr($vehicle_information);
                            $html .= '<tr>';
                            $html .= '<td>';
                                $html .= $customer_user->user_login;
                            $html .= '</td>';


                            $html .= '<td>';
                                $html .= $customer_name;
                            $html .= '</td>';

                            $html .= '<td>';
                                $html .= $customer_user->user_email;
                            $html .= '</td>';

                                $html .= '<td>';
                                $html .= $address.'<br/>'.$city.', '.$state.', '.$zip_code;
                            $html .= '</td>';

                            $html .= '<td class="text-center">';
                            $document_url = get_site_url().'/wp-includes/images/media/document.png';
                                $html .= '<a href="'.$pdf_link.'" target="_blank"><img src="'.$document_url.'" class="attachment-thumbnail" style="width:20px !important"></a>';
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $pdf_link;
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $benefits_package;
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $post_title;
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $dealer_name;
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $distributor_name;
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= $vehicle_information[$login]['pmsafe_vehicle_year'] . ' ' . $vehicle_information[$login]['pmsafe_vehicle_make'] . ' ' . $vehicle_information[$login]['pmsafe_vehicle_model'];
                            $html .= '</td>';

                                $html .= '<td class="nisl-pdf-link">';
                                $html .= $vehicle_information[$login]['pmsafe_vin'];
                            $html .= '</td>';

                            $html .= '<td class="nisl-pdf-link">';
                                $html .= date('Y-m-d', strtotime($vehicle_information[$login]['pmsafe_registration_date']));
                            $html .= '</td>';


                            $html .= '<td class="nisl-pdf-link">';
                                $html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_information[$login]['pmsafe_registration_date'])));
                            $html .= '</td>';

                            $view_customer_details_query_args = array(
                                'page'   => 'customers-lists',
                                'action' => 'view_customer_details',
                                'id'  => $customer_user->ID,
                            );

                            $actions['view_customer_details'] = sprintf(
                                '<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
                                esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $customer_user->ID ) ),
                                _x( 'view details', 'List table row action', 'wp-list-table-example' )
                            );

                            $html .= '<td class="text-center">';
                                $html .= $actions["view_customer_details"];
                            $html .= '</td>';


                            $edit_customer_details_query_args = array(
                                'page'   => 'customers-lists',
                                'action' => 'edit_customer_details',
                                'id'  => $customer_user->ID,
                            );

                            $actions['edit_customer_details'] = sprintf(
                                '<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
                                esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $customer_user->ID ) ),
                                _x( 'edit details', 'List table row action', 'wp-list-table-example' )
                            );

                            $html .= '<td class="text-center">';
                                $html .= $actions["edit_customer_details"];
                            $html .= '</td>';

                            $delete_customer_details_query_args = array(
                                'page'   => 'customers-lists',
                                'action' => 'delete_customer_details',
                                'id'  => $customer_user->ID,
                            );

                            $actions['delete_customer_details'] = sprintf(
                                '<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
                                esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $customer_user->ID ) ),
                                _x( 'delete details', 'List table row action', 'wp-list-table-example' )
                            );

                            $html .= '<td class="text-center">';
                                $html .= $actions["delete_customer_details"];
                            $html .= '</td>';


                            $html .= '</tr>';
                    }
                }
                $html .= '</tbody>';
            $html .= '</table>';
        $html .= '</div>';
    $html .= '</div>';
$html .= '</div>';
echo $html;
}
?>
