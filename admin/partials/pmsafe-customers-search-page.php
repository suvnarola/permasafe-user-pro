<?php
$html .= '<h1 class="top-heading">Search Customer Information</h1>'; 
$html .= '<div class="reports-wrap">';	

// member code
$html .= '<div class="reports-wrap-inner">';
    $html .= '<div class="label-input">';	    	
        $html .= '<label>Member Code : </label>';
    $html .= '</div>';	    	
    $html .= '<div class="input-div">';	    	
        $html .= '<input type="text" name="member_code" id="member_code"/>';
        // $html .= '<input type="hidden" name="dealer_login" id="dealer_login" value="'.$login.'"/>';
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


//Distributor name
$args = array(
    'role'         => 'author',
);
$distributor_users = get_users( $args );
foreach ($distributor_users as $key => $value) {
    $distributor_name = get_user_meta($value->ID, 'distributor_name', true);
  $distributor_name_arr[$value->user_login] = $distributor_name;
}
asort($distributor_name_arr);
$html .= '<div class="reports-wrap-inner">';
    $html .= '<div class="label-input">';	    	
        $html .= '<label>Distributor name : </label>';
    $html .= '</div>';	    	
    $html .= '<div class="input-div">';	    	
        $html .= '<select id="pmsafe_distributor">';
        $html .= '<option value="">Select Distributor</option>';
        foreach ($distributor_name_arr as $key => $value) {
            $html .= '<option value="' . $key . '">' . $value . ' (' . $key . ')' . '</option>';
        }
            
        $html .= '</select>';
    $html .= '</div>';     
$html .= '</div>';  

//Dealer name
$args = array(
    'role'         => 'contributor',
);
$dealer_users = get_users( $args );
$html .= '<div class="reports-wrap-inner">';
    $html .= '<div class="label-input">';	    	
        $html .= '<label>Dealer name : </label>';
    $html .= '</div>';	    	
    $html .= '<div class="input-div">';	    	
        $html .= '<select id="pmsafe_dealer">';
        $html .= '<option value="">Select Dealer</option>';
        
        $html .= '</select>';
    $html .= '</div>';     
$html .= '</div>';    

  
// Submit

$html .= '<div class="input-btn">';	    	
    $html .= '<input type="button" name="search_all_submit" id="search_all_submit" value="Search" data-scroll-to="#id1" data-scroll-focus="#id1" data-scroll-speed="700" data-scroll-offset="5"/>';
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

?>