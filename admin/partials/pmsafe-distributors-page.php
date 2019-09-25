
<?php
$action = $_GET['action'];
$distributor_id =  $_GET['distributor'];

$user = get_user_by('ID', $distributor_id);
$name = get_user_meta($distributor_id, 'distributor_name', true);
$address = get_user_meta($distributor_id, 'distributor_store_address', true);
$distributor_login = $user->user_login;

// echo "test->".$address;
// die;
$phone = get_user_meta($distributor_id, 'distributor_phone_number', true);
$fax = get_user_meta($distributor_id, 'distributor_fax_number', true);
// $contact_info = get_the_author_meta('distributor_contact_info' ,$distributo_id);
global $wpdb;
$contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email,wu.user_login FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_distributor_id" AND wum.meta_value =' . $distributor_id);
// pr($contact_info);

if ($action == 'view') {

    // Build add dealer row action.
    $add_query_args = array(
        'page'   => 'distributors-lists',
        'action' => 'edit',
        'distributor'  => $distributor_id,
    );

    $actions['edit'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url(add_query_arg($add_query_args, 'admin.php'), 'editdealer_' . $distributor_id),
        _x('Edit Distributor', 'List table row action', 'wp-list-table-example')
    );

    $add_query_args = array(
        'page'   => 'add-new-dealer',
        'action' => 'add',
        'distributor'  => $distributor_id,
    );


    $actions['add'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url(add_query_arg($add_query_args, 'admin.php'), 'adddealer_' . $distributor_id),
        _x('Add New Dealer', 'List table row action', 'wp-list-table-example')
    );

    $add_query_args = array(
        'page'   => 'dealers-lists',
        'action' => 'viewdealers',
        'distributor'  => $distributor_id,
    );

    $actions['viewdealers'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url(add_query_arg($add_query_args, 'admin.php'), 'viewdealers_' . $distributor_id),
        _x('View Dealers', 'List table row action', 'wp-list-table-example')
    );

    $view_customer_query_args = array(
        'page'   => 'permasafe-upgraded-membership',
        'action' => 'view_upgraded_policy',
        'distributor'  => $distributor_login,
    );

    $actions['view_upgraded_policies'] = sprintf(
        '<a href="%1$s">%2$s</a>',
        esc_url(add_query_arg($view_customer_query_args, 'admin.php'), 'view_upgraded_policy_' . $distributor_id),
        _x('View Upgraded Policies', 'List table row action', 'wp-list-table-example')
    );

    echo '<div class="top-head">';
    echo '<h1 class="top-heading">View <span style="color:#0065a7">' . $name . ' (' . $distributor_login . ')</span> Information</h1>';
    echo $actions['edit'];
    echo $actions['add'];
    $dealer_distributor_name =  get_users(
        array(
            'meta_key' => 'dealer_distributor_name',
            'meta_value' => $distributor_id
        )
    );
    if ($dealer_distributor_name) {
        echo $actions['viewdealers'];
        echo $actions['view_upgraded_policies'];
    }
    echo '</div>';
    echo '<br/>';

    $dealer_distributor_name =  get_users(
        array(
            'meta_key' => 'dealer_distributor_name',
            'meta_value' => $distributor_id
        )
    );
    if ($dealer_distributor_name) {
        $dealers_name = '';
        foreach ($dealer_distributor_name as $dealername) {
            $dealer_id = $dealername->ID;
            $view_query_args = array(
                'page'   => 'dealers-lists',
                'action' => 'view',
                'dealer'  => $dealer_id,
            );
            $d_name = get_user_meta($dealer_id, 'dealer_name', true);
            $dealers_name .= '<a href="' . esc_url(add_query_arg($view_query_args, 'admin.php'), 'viewdealer_' . $dealer_id) . '">' . $d_name . "</a>, ";
        }


        $dealer_name = rtrim($dealers_name, ", ");
    } else {
        $dealer_name = 'No Dealers Assigned to this Distributor.';
    }

    echo '<table class="view-distributor-tbl">';
    echo '<tr>';
    echo '<td><strong>Name</strong></td>';
    echo '<td>' . $name . '</td>';
    echo '</tr>';

    /* echo '<tr>';
    echo '<td><strong>Email</strong></td>';
    echo '<td>' . $user->user_email . '</td>';
    echo '</tr>'; */

    if ($address) {
        echo '<tr>';
        echo '<td><strong>Store Address</strong></td>';
        echo '<td>' . $address . '</td>';
        echo '</tr>';
    }
    if ($phone) {
        echo '<tr>';
        echo '<td><strong>Phone</strong></td>';
        echo '<td>' . phone_number_format($phone) . '</td>';
        echo '</tr>';
    }

    if ($fax) {
        echo '<tr>';
        echo '<td><strong>Fax</strong></td>';
        echo '<td>' . $fax . '</td>';
        echo '</tr>';
    }

    echo '</table>';

    echo '<div class="lr-wrapper">';
    echo '<div class="left-wrapper">';
    echo '<h3 style="color:#0065a7">Contact Person\'s Information:</h3>';

    if ($contact_info) {
        foreach ($contact_info as $key => $value) {
            $user_id = $value->user_id;
            $fname = get_user_meta($user_id, 'distributor_contact_fname', true);
            $lname = get_user_meta($user_id, 'distributor_contact_lname', true);
            $phone = get_user_meta($user_id, 'distributor_contact_phone', true);

            echo '<table class="view-distributor-contacts-tbl" id="">';
            $number = $key + 1;
            echo '<tr>';

            echo '<td style="font-size:15px;border-right:none;">';
            echo '<b>Person ' . $number . '</b>';
            echo '</td>';

            echo '<td style="border-left:none;text-align:right;">';
            echo '<a href="#edit-contact-person-modal" id="pmsafe_contact_info_mail" data-id="' . $user_id . '" title="Send password reset link" style="color: #fff;cursor:pointer;background: #0065a7;padding: 5px;border-radius: 50%;margin:0 5px"><i class="fa fa-envelope"></i></a><a href="#edit-contact-person-modal" id="pmsafe_distributors_contact_edit" data-id="' . $user_id . '" title="click here to edit this contact" style="color: #fff;cursor:pointer;background: #0065a7;padding: 5px;border-radius: 50%;margin:0 5px"><i class="fa fa-edit"></i></a><i class="fa fa-trash" id="pmsafe_distributors_contact_delete" data-id="' . $user_id . '" title="click here to delete this contact" style="color: #fff;cursor:pointer;background: #ff0000;padding: 5px;border-radius: 50%;margin:0 5px;"></i>';
            echo '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Username</td>';
            echo '<td>' . $value->user_login . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Name</td>';
            echo '<td>' . $fname . ' ' . $lname . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Phone Number</td>';
            echo '<td>' . (($phone)?phone_number_format($phone):'-') . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>Email</td>';
            echo '<td>' . $value->user_email . '</td>';
            echo '</tr>';

            echo '</table>';
            echo '<div class="blank-space"/></div>';
        }
    } else {
        echo '<p>No contact persons are added.</p>';
    }
    echo '<a href="#contact-person-modal" rel="modal:open" id="add_contact_person">Add New Contact Person</a>';
    /*********************** Add Contact Person Modal ******************************************** */
    echo '<input type="hidden" value="' . $distributor_id . '" id="distributor_id">';
    echo '<div id="contact-person-modal" class="modal">';
    echo '<h3>Add Contact Person Information:<h3>';
    echo '<hr/>';
    echo '<div class="nisl-wrap">';
    echo '<label><strong>First Name:</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_contact_fname" name="pmsafe_distributor_contact_fname" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Last Name:</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_contact_lname" name="pmsafe_distributor_contact_lname" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Phone Number:</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_contact_phone" name="pmsafe_distributor_contact_phone" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Email:</strong></label>';
    echo '<input type="email" id="pmsafe_distributor_contact_email" name="pmsafe_distributor_contact_email" value="" class="widefat check-mail" />';
    echo '</div>';

    echo '<hr/>';
    echo '<div class="nisl-wrap">';
    echo '<label><strong>Username:</strong><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;font-size: 10px;">(This person will use this as the first field on the Login screen)</span></label>';
    echo '<input type="text" id="pmsafe_distributor_contact_uname" name="pmsafe_distributor_contact_uname" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Password</strong></label>';
    echo '<input type="text" rel="gp" name="pmsafe_distributor_contact_password" id="pmsafe_distributor_contact_password" value="" class="widefat" style="width:35%"/>';
    echo '<input type="button" value="Change Password" class="generate_distributor_contact_password" />';
    echo '</div>';
    echo '<hr/>';
    echo '<input type="button" value="Add" id="distributor_add_new_contact_person" class="btn-disabled" style="padding:10px 30px;"/>';
    echo '</div>';
    /*********************** Edit Contact Person Modal ******************************************** */

    echo '<div id="edit-contact-person-modal" class="modal">';
    echo '<h3>Edit Contact Person Information:<h3>';
    echo '<hr/>';
    echo '<div class="nisl-wrap">';
    echo '<input type="hidden" id="contact_person_id" value=""/>';
    echo '<label><strong>First Name:</strong></label>';
    echo '<input type="text" id="edit_distributor_contact_fname" name="edit_distributor_contact_fname" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Last Name:</strong></label>';
    echo '<input type="text" id="edit_distributor_contact_lname" name="edit_distributor_contact_lname" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Phone Number:</strong></label>';
    echo '<input type="text" id="edit_distributor_contact_phone" name="edit_distributor_contact_phone" value="" class="widefat" />';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Email:</strong></label>';
    echo '<input type="email" id="edit_distributor_contact_email" name="edit_distributor_contact_email" value="" class="widefat"/>';
    echo '</div>';

    echo '<hr/>';
    echo '<div class="nisl-wrap">';
    echo '<label><strong>Username:</strong><span style="color: #b8b0b0;font-style: italic;padding-left: 5px;font-size: 10px;">(This person will use this as the first field on the Login screen)</span></label>';
    echo '<input type="text" id="edit_distributor_contact_uname" name="edit_distributor_contact_uname" value="" class="widefat"/>';
    echo '</div>';

    echo '<div class="nisl-wrap">';
    echo '<label><strong>Password</strong></label>';
    echo '<input type="text" rel="gp" name="edit_distributor_contact_password" id="edit_distributor_contact_password" value="" class="widefat" style="width:35%"/>';
    echo '<input type="button" value="Change Password" class="generate_distributor_contact_password" />';
    echo '</div>';
    echo '<hr/>';
    echo '<input type="button" value="Save" id="distributor_edit_new_contact_person" class="" style="padding:10px 30px;"/>';
    echo '</div>';

    echo '</div>'; //left wrapper end
    echo '<div class="right-wrapper">';
    echo '<h3 style="color:#0065a7">Benefits Package Pricing:</h3>';
    $distributor_get_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
    echo '<table class="view-distributor-price-tbl" id="">';
    echo '<thead>';
    echo '<th>Benefits Package</th>';
    echo '<th>Price<p>Distributor Cost </p></th>';
    echo '<th></th>';
    echo '</thead>';

    echo '<tbody>';
    $benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
    foreach ($benefit_prefix as $prefix) {
        echo '<tr>';
        echo '<td>' . $prefix . '</td>';
        echo (($distributor_get_price_arr[$prefix]['distributor_cost']) ? '<td>$' . $distributor_get_price_arr[$prefix]['distributor_cost'] . '</td>' : '<td>-</td>');
        echo '<td style="text-align:right;">';
        echo '<a href="#edit-price-modal" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#0065a7;padding:5px;border-radius:50%;" rel="modal:open" id="edit_distributor_price"  data-id="' . $prefix . '">';
        echo '<i class="fa fa-edit"></i>';
        echo '</a>';
        echo '<i id="delete_distributor_price" class="fa fa-trash" style="margin: 0 5px;color: #ffffff;cursor: pointer;background:#ff0000;padding:5px;border-radius:50%;" data-id="' . $prefix . '"></i>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<a href="#price-modal" rel="modal:open" id="add_price">Add New Package Pricing</a>';
    /*********************** Add Price Modal ******************************************** */
    echo '<div id="price-modal" class="modal">';
    echo '<h3>Select Package Pricing:<h3>';
    echo '<hr/>';
    $benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');

    echo '<table>';
    echo '<tr>';
    echo '<td>';
    echo '<label><strong>Benefits Packages:</strong></label>';
    echo '</td>';
    echo '<td>';
    if (!empty($benefit_prefix)) {
        echo '<select name="pmsafe_invitation_prefix" id="pmsafe_invitation_prefix">';
        echo '<option value="">select</option>';
        foreach ($benefit_prefix as $prefix) {
            echo '<option value="' . $prefix . '">' . $prefix . '</option>';
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

    echo '</table>';
    echo '<hr>';
    echo '<input type="button" value="Add" id="add_distributor_cost">';
    echo '</div>';

    echo '</div>'; //right wrapper end
    echo '</div>';
    /*********************** Edit Price Modal ******************************************** */
    echo '<div id="edit-price-modal" class="modal">';
    echo '<h3>Edit Package Pricing:<h3>';
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

    echo '</table>';
    echo '<hr>';
    echo '<input type="button" value="Save" id="update_distributor_cost">';
    echo '</div>';
} else if ($action == 'edit') {
    echo '<h1 class="top-heading">Edit <span style="color:#0065a7">' . $name . ' (' . $distributor_login . ')</span> Information</h1>';
    echo '<div class="wrap distributor_add_form_div">';
    echo '<form name="perma_edit_distributor" id="perma_edit_distributor_form" method="POST" class="validate">';

    echo '<input type="hidden" id="pmsafe_distributor_id" name="pmsafe_distributor_id" value="' . $distributor_id . '" class="widefat" />';

    echo '<div id="name_div">';
    echo '<label><strong>Distributor Name</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_name" name="pmsafe_distributor_name" value="' . $name . '" class="widefat" />';
    echo '</div>';

    echo '<div id="email_div" style="display:none;">';
    echo '<label><strong>Email</strong></label>';
    echo '<input type="email" id="pmsafe_distributor_email" name="pmsafe_distributor_email" value="' . $user->user_email . '" class="widefat" />';
    echo '</div>';

    echo '<div id="address_div">';
    echo '<label><strong>Store Address</strong></label>';
    echo '<textarea id="pmsafe_distributor_store_address" name="pmsafe_distributor_store_address" class="widefat">' . $address . '</textarea>';
    echo '</div>';

    echo '<div id="phone_div">';
    echo '<label><strong>Phone Number</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_phone_number" name="pmsafe_distributor_phone_number" value="' . $phone . '" class="widefat" />';
    echo '</div>';

    echo '<div id="fax_div">';
    echo '<label><strong>Fax Number</strong></label>';
    echo '<input type="text" id="pmsafe_distributor_fax_number" name="pmsafe_distributor_fax_number" value="' . $fax . '" class="widefat" />';
    echo '</div>';


    echo '<div id="password_div" style="display:none;">';
    echo '<label><strong>Password</strong></label>';
    echo '<input type="password" id="pmsafe_distributor_password" name="pmsafe_distributor_password" value="" class="widefat" style="display:none;"/>';
    echo '<input type="button" value="Generate New Password" id="generate_distributor_password" />';
    echo '<input type="button" value="Hide" id="hide_distributor_password" style="display:none;"/>';
    echo '<input type="button" value="Show" id="show_distributor_password" style="display:none;"/>';
    echo '<input type="button" value="Cancel" id="cancel_distributor_password" style="display:none;"/>';
    echo '</div>';

    echo '<input type="submit" id="pmsafe_distributors_update" value="Save" class="button button-primary button-large btn-disabled">';

    echo '</form>';
    echo '</div>';
} else {
    echo '<div class="top-head">';
    echo '<h1 class="top-heading">Distributors</h1>';
    $url = admin_url('admin.php?page=add-new-distributor');
    echo '<a class="distributor_add" href="' . $url . '">Add New Distributor</a>';
    echo '</div>';

    $distributors = get_users('role=author');

    echo '<div class="table-responsive">';
    echo '<table id="tbl_distributors" class="display nowrap" style="width:100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>';
    echo 'Distributor Number';
    echo '</th>';

    echo '<th>';
    echo 'Distributor Name';
    echo '</th>';

    echo '<th>';
    echo 'Email';
    echo '</th>';

    echo '<th>';
    echo 'View Dealers';
    echo '</th>';

    echo '<th>';
    echo 'Created Date';
    echo '</th>';

    echo '</tr>';
    echo '</thead>';

    echo '<tbody id="">';
    foreach ($distributors as $user) {
        $user_id = $user->ID;

        $registered_date = date('Y-m-d', strtotime($user->user_registered));
        $name = get_user_meta($user_id, 'distributor_name', true);
        $address = get_user_meta($user_id, 'distributor_store_address', true);
        $phone = get_user_meta($user_id, 'distributor_phone_number', true);
        $fax = get_user_meta($user_id, 'distributor_fax_number', true);

        $dealer_distributor_name =  get_users(
            array(
                'meta_key' => 'dealer_distributor_name',
                'meta_value' => $user_id
            )
        );
        if ($dealer_distributor_name) {
            $add_query_args = array(
                'page'   => 'dealers-lists',
                'action' => 'viewdealers',
                'distributor'  => $user_id,
            );

            $actions['viewdealers'] = sprintf(
                '<a href="%1$s" title="View Dealers" target="_blank"><i class="fa fa-users"></i></a>',
                esc_url(add_query_arg($add_query_args, 'admin.php'), 'viewdealers_' . $user_id),
                _x('View Dealers', 'List table row action', 'wp-list-table-example')
            );


            $dealer_name = $actions['viewdealers'];
        } else {
            $dealer_name = 'No Dealers Assigned to this Distributor.';
        }
        // Build add dealer row action.
        $add_query_args = array(
            'page'   => 'add-new-dealer',
            'action' => 'add',
            'distributor'  => $user_id,
        );

        $actions['add'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url(add_query_arg($add_query_args, 'admin.php'), 'adddealer_' . $user_id),
            _x('Add Dealer', 'List table row action', 'wp-list-table-example')
        );
        $page = 'distributors-lists';
        // Build view row action.
        $view_query_args = array(
            'page'   => $page,
            'action' => 'view',
            'distributor'  => $user_id,
        );

        $actions['view'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url(add_query_arg($view_query_args, 'admin.php'), 'viewdistributor_' . $user_id),
            _x('View', 'List table row action', 'wp-list-table-example')
        );

        // Build edit row action.
        $edit_query_args = array(
            'page'   => $page,
            'action' => 'edit',
            'distributor'  => $user_id,
        );

        $actions['edit'] = sprintf(
            '<a href="%1$s">%2$s</a>',
            esc_url(add_query_arg($edit_query_args, 'admin.php'), 'editdistributor_' . $user_id),
            _x('Edit', 'List table row action', 'wp-list-table-example')
        );
        // Build delete row action.
        $delete_query_args = array(
            'page'   => $page,
            'action' => 'delete',
            'distributor'  => $user_id,
        );

        $actions['delete'] = sprintf(
            '<a href="%1$s" id="pmsafe_distributors_delete" data-id="' . $user_id . '">%2$s</a>',
            esc_url(add_query_arg($delete_query_args, 'admin.php'), 'deletedistributor_' . $user_id),
            _x('Delete', 'List table row action', 'wp-list-table-example')
        );
        echo '<tr>';
        echo '<td>';
        echo $user->user_login;
        echo '<div class="row-actions"><span class="add">' . $actions['add'] . ' | </span><span class="view">' . $actions['view'] . ' | </span><span class="edit">' . $actions['edit'] . ' | </span><span class="delete">' . $actions['delete'] . '</span></div>';
        echo '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $user->user_email . '</td>';
        echo '<td style="text-align:center;">' . $dealer_name . '</td>';
        echo '<td style="text-align:center;">' . $registered_date . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
