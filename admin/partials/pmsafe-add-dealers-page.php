<h1 class="top-heading">Add Dealer</h1>
<?php
$distributor_id = $_GET['distributor'];
$action = $_GET['action'];
$distributors = get_users('role=author&orderby=ID&order=DESC');
echo '<div class="wrap dealer_add_form_div">';
echo '<form name="perma_register_dealer" id="perma_register_dealer_form" method="POST" class="validate">';

$create_date = current_time('mysql');
echo '<input type="hidden" name="pmsafe_dealer_create_date" value="' . $create_date . '" />';

echo '<div id="name_div">';
echo '<label><strong>Dealer Name</strong></label>';
echo '<input type="text" id="pmsafe_dealer_name" name="pmsafe_dealer_name" value="" class="widefat" />';
echo '</div>';

echo '<div id="email_div" style="display:none;">';
echo '<label><strong>Email</strong></label>';
echo '<input type="email" id="pmsafe_dealer_email" name="pmsafe_dealer_email" value="" class="widefat" />';

echo '</div>';


echo '<div id="password_div" style="display:none;">';
echo '<label><strong>Password</strong></label>';
echo '<input type="password" id="pmsafe_dealer_password" name="pmsafe_dealer_password" value="" class="widefat" style="display:none;"/>';
echo '<input type="button" value="Generate Password" id="generate_dealer_password" />';
echo '<input type="button" value="Hide" id="hide_dealer_password" style="display:none;"/>';
echo '<input type="button" value="Show" id="show_dealer_password" style="display:none;"/>';
echo '<input type="button" value="Cancel" id="cancel_dealer_password" style="display:none;"/>';
echo '</div>';

echo '<div id="address_div">';
echo '<label><strong>Store Address</strong></label>';
echo '<textarea id="pmsafe_dealer_store_address" name="pmsafe_dealer_store_address" class="widefat"></textarea>';
echo '</div>';

echo '<div id="phone_div">';
echo '<label><strong>Phone Number</strong></label>';
echo '<input type="text" id="pmsafe_dealer_phone_number" name="pmsafe_dealer_phone_number" value="" class="widefat" />';
echo '</div>';

echo '<div id="fax_div">';
echo '<label><strong>Fax Number</strong></label>';
echo '<input type="text" id="pmsafe_dealer_fax_number" name="pmsafe_dealer_fax_number" value="" class="widefat" />';
echo '</div>';

echo '<div id="distributor_div">';
echo '<label><strong>Distributors</strong></label>';
if ($action == 'add') {
	echo '<select name="pmsafe_dealer_distributor" id="pmsafe_dealer_distributor">';

	$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
	echo '<option value="' . $distributor_id . '" selected>' . $distributor_name . '</option>';
	echo '</select>';
} else {
	echo '<select name="pmsafe_dealer_distributor" id="pmsafe_dealer_distributor">';
	echo '<option value="">Select Distributor</option>';
	foreach ($distributors as $user) {
		$user_id = $user->ID;
		$name = get_user_meta($user_id, 'distributor_name', true);
		$distributor_name_arr[$user_id] = $name;
	}
	asort($distributor_name_arr);
	foreach ($distributor_name_arr as $key => $value) {
		echo '<option value="' . $key . '">' . $value . '</option>';
	}
	echo '</select>';
}
echo '</div>';

echo '<input type="submit" id="pmsafe_dealers_submit" value="Save" class="button button-primary button-large btn-disabled">';

echo '</form>';
echo '</div>';
