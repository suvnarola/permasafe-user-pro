<?php
 echo '<div class="top-head">';
 echo '<h1>View Upgraded membership</h1>';
 
 echo '</div>';
global $wpdb;


$membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');
echo '<div class="filter-wrap">';
// echo '<input type="hidden" id="membership_login_id" value="'.$login.'">';
    echo '<div class="input-filter-wrap">';
        echo '<label>Date: </label><input type="text" id="membership_datepicker1" style="width:auto;"> <input type="text" id="membership_datepicker2" style="width:auto;">';
    echo '</div>';
   
    $args = array(
        'role'         => 'author',
    );
    $distributor_users = get_users( $args );
    echo '<div class="filter-mid">';
    echo '<div class="select-filter-wrap">';    	   	
            // echo '<label>Distributot name : </label>';
            echo '<select id="pmsafe_distributor">';
            echo '<option value="">- Distributor Name -</option>';
            foreach ($distributor_users as $key => $value) {
                $distributor_name = get_user_meta($value->ID,'distributor_name',true);
                echo '<option value="'.$value->user_login.'">'.$distributor_name.' ('. $value->user_login .')'.'</option>';
            }
            echo '</select>';
    echo '</div>';   
    echo '</div>';   

    //Dealer name
    $args = array(
        'role'         => 'contributor',
    );
    $dealer_users = get_users( $args );
    echo '<div class="filter-down">';
    echo '<div class="select-filter-wrap">';    	
            // echo '<label>Dealer name : </label>';
            echo '<select id="pmsafe_dealer">';
            echo '<option value="">- Dealer Name -</option>';
            // foreach ($dealer_users as $key => $value) {
            //     $dealer_name = get_user_meta($value->ID,'dealer_name',true);
            //     echo '<option value="'.$value->user_login.'">'.$dealer_name.'</option>';
            // }
            echo '</select>';
    echo '</div>';    
    echo '</div>';   
    echo '<div class="btn-filter-wrap">';

        echo '<input type="button" id="membership_date_submit" value="Submit" style="color:#fff;background-color:#0065a7;"/>';
    echo '</div>';    
    echo '<div><input type="button" name="reset" id="search_reset" value="Reset" style="background-color: #f1f1f1;padding: 2px 30px;"/></div>';
echo '</div>';
echo '<div class="membership-result-wrap">';    
               
echo '<table id="mebership_info_table" class="display nowrap" style="width:100%">';
echo '<thead>';
    echo '<tr>';
        echo '<th>';
        echo 'Registration Number';
        echo '</th>';

        echo '<th>';
        echo 'Original Policy';
        echo '</th>';

        echo '<th>';
        echo 'Upgraded Policy';
        echo '</th>';
       
        echo '<th>';
        echo 'Upgraded By';
        echo '</th>';
            
    echo '</tr>';
echo '</thead>';

echo '<tbody id="">';        
foreach ($membership_results as $str) {
    $post_id = $str->post_id;
    $bulk_id = get_post_meta($post_id,'_pmsafe_bulk_invitation_id',true);
    $bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
    $code = get_post_meta($post_id,'_pmsafe_invitation_code',true);
    $upgraded_id = get_post_meta($post_id,'upgraded_by',true);
    $dealer_name = get_user_meta($upgraded_id,'dealer_name',true);
    $distributor_name = get_user_meta($upgraded_id,'distributor_name',true);
    $contact_fname = get_user_meta($upgraded_id,'contact_fname',true);
    $admin_name = get_user_meta($upgraded_id,'first_name',true);
    
    echo '<tr>';
        
        echo '<td>';
            echo get_post_meta($post_id,'_pmsafe_invitation_code',true);
        echo '</td>';
        
        echo '<td>';
            echo $bulk_prefix;
        echo '</td>';
        
        echo '<td>';
            echo get_post_meta($post_id,'_pmsafe_code_prefix',true);
        echo '</td>';
        
        echo '<td>';
        if($dealer_name){
            echo $dealer_name;
        }
        if($distributor_name){
            echo $distributor_name;
        }
        if($contact_fname){
            echo $contact_fname;
        }
        if($admin_name){
            echo $admin_name;
        }
        echo '</td>';

    echo '</tr>';
    
 
}
echo '</tbody>';        
echo '</table>';       
echo '</div>'; 


?>