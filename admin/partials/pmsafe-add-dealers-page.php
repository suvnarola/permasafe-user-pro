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

echo '<div id="email_div">';
echo '<label><strong>Email</strong></label>';
echo '<input type="email" id="pmsafe_dealer_email" name="pmsafe_dealer_email" value="" class="widefat" />';

echo '</div>';
// $dealer_pwd = wp_generate_password();

echo '<div id="password_div">';
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
		echo '<option value="' . $user_id . '">' . $name . '</option>';
	}
	echo '</select>';
}
echo '</div>';

echo '<div id="fname_divgroup">';
echo '<div id="fname_div1" class="is-validate">';
echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';
echo '<div class="nisl-wrap">';
echo '<label><strong>First Name:</strong></label>';
echo '<input type="text" id="pmsafe_dealer_contact_fname1" name="pmsafe_dealer_contact_fname[]" value="" class="widefat check-fname" />';
echo '</div>';

echo '<div class="nisl-wrap">';
echo '<label><strong>Last Name:</strong></label>';
echo '<input type="text" id="pmsafe_dealer_contact_lname1" name="pmsafe_dealer_contact_lname[]" value="" class="widefat check-lname" />';
echo '</div>';

echo '<div class="nisl-wrap">';
echo '<label><strong>Phone Number:</strong></label>';
echo '<input type="text" id="pmsafe_dealer_contact_phone1" name="pmsafe_dealer_contact_phone[]" value="" class="widefat check-phone" />';
echo '</div>';

echo '<div class="nisl-wrap">';
echo '<label><strong>Email:</strong></label>';
echo '<input type="email" id="pmsafe_dealer_contact_email1" name="pmsafe_dealer_contact_email[]" value="" class="widefat check-mail " style="width:35%;"/><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;"> (This will be the Username for this person to Login)</span>';
echo '</div>';

echo '<div class="nisl-wrap">';
echo '<label><strong>Password:</strong></label>';
echo '<input type="text" rel="gp" name="pmsafe_dealer_contact_password[]" value="" class="widefat check-password" style="width:35%"/>';
echo '<input type="button" value="Generate Password" class="generate_dealer_contact_password" />';

echo '</div>';
echo '</div>';
echo '</div>';

echo '<input type="button" value="Add New Contact Information" id="add_new_dealer" />';
// echo '<input type="button" value="Remove Contact Information" id="removeButton_dealer" />';

echo '<input type="submit" id="pmsafe_dealers_submit" value="Save" class="button button-primary button-large btn-disabled">';

echo '</form>';
echo '</div>';
