<?php
$action = $_GET['action'];
$dealer_login = $_GET['dealer'];
$dealers = get_user_by('login', $dealer_login);
$dealer_id = $dealers->ID;
$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);

$distributor_login = $_GET['distributor'];
$distributors = get_user_by('login', $distributor_login);
$distributor_id = $distributors->ID;
$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

global $wpdb;

if ($action == 'view_upgraded_policy') {
    if ($dealer_login) {
        $dealer_users = get_user_by('login',$dealer_login);
        $dealer_id = $dealer_users->ID;
        echo '<div class="top-head">';
        echo '<h1 class="top-heading">View <span style="color:#0065a7">' . $dealer_name . ' (' . $dealer_login . ')</span> Upgrade Report</h1>';
        echo '<a id="back_link" href="'.admin_url('admin.php?page=dealers-lists&action=view&dealer='.$dealer_id).'">Back to Dealer</a>';
        echo '</div>';

        $users_array = get_code_by_dealer_login($dealer_login);
    }
    if ($distributor_login) {
        $users = get_user_by('login', $distributor_login);
        $distributor_id = $users->ID;
        $users_array = get_code_by_distributor_login($distributor_id);
        echo '<div class="top-head">';
        echo '<h1 class="top-heading">View <span style="color:#0065a7">' . $distributor_name . ' (' . $distributor_login . ')</span> Upgrade Report</h1>';
        echo '<a id="back_link" href="'.admin_url('admin.php?page=distributors-lists&action=view&distributor='.$distributor_id).'">Back to Distributor</a>';
        echo '</div>';

        
    }
} else {
    echo '<div class="top-head">';
    echo '<h1 class="top-heading">Upgrade Report</h1>';
    echo '</div>';
}


$membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');

echo '<div class="filter-wrap">';
    echo '<div class="filter-inner-wrap">';
if ($action == 'view_upgraded_policy') {
    $upgraded_class = 'upgraded-class';
}
        echo '<div class="inner-wrap '.(($upgraded_class)?$upgraded_class:"").'">';
            echo '<div class="input-filter-wrap">';
                echo '<label>Date: </label><input type="text" id="membership_datepicker1" style="width:auto;"> <input type="text" id="membership_datepicker2" style="width:auto;">';
            echo '</div>';
            if ($action == 'view_upgraded_policy') {
                if ($dealer_login) {
                    echo '<input type="hidden" id="membership_login" value="' . $dealer_login . '">';
                }
                if ($distributor_login) {
                    echo '<input type="hidden" id="membership_login" value="' . $distributor_login . '">';
                }
            }
            echo '<div class="filter-dropdown-wrap">';
            if ($action != 'view_upgraded_policy') {
                $args = array(
                    'role'         => 'author',
                );
                $distributor_users = get_users($args);
                foreach ($distributor_users as $key => $value) {
                    $distributor_name = get_user_meta($value->ID, 'distributor_name', true);
                    $distributor_name_arr[$value->user_login] = $distributor_name;
                }
                asort($distributor_name_arr);
                
                    echo '<div class="filter-mid">';
                        echo '<div class="select-filter-wrap">';
                            echo '<select id="filter_distributors" name="filter_distributors[]" multiple="multiple">';
                                echo '<option value="">Distributor Name</option>';
                                foreach ($distributor_name_arr as $key => $value) {
                                    echo  '<option value="' . $key . '">' . $value . ' (' . $key . ')' . '</option>';
                                }
                            echo '</select>';
                        echo '</div>';
                    echo '</div>';

                    //Dealer name
                    $args = array(
                        'role'         => 'contributor',
                    );
                    $dealer_users = get_users($args);
                    foreach ($dealer_users as $key => $value) {
                        $dealer_name = get_user_meta($value->ID, 'dealer_name', true);
                        $dealer_name_arr[$value->user_login] = $dealer_name;
                    }
                    asort($dealer_name_arr);
                    echo '<div class="filter-down">';
                        echo '<div class="select-filter-wrap">';
                            echo '<select id="filter_dealers" name="filter_dealers[]" multiple="multiple">';
                            foreach ($dealer_name_arr as $key => $value) {
                                    echo  '<option value="' . $key . '">' . $value . ' (' . $key . ')' . '</option>';
                             }
                            echo '</select>';
                        echo '</div>';
                    echo '</div>';
            }
                echo '<div class="filter-policy">';
                    echo '<div class="select-filter-wrap">';
                        echo '<select id="policy">';
                            echo '<option value="">Select Policy</option>';
                            echo '<option value="upgraded">Upgraded Policy</option>';
                            echo '<option value="original">Original Policy</option>';
                        echo '</select>';
                    echo '</div>';
                echo '</div>';

                echo '<div class="filter-package" style="display:none;">';
                        echo '<div class="select-filter-wrap">';
                        $benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
                            echo '<select id="benefit_packages">';
                            echo '<option value="">Select Package</option>';
                            foreach ($benefit_prefix as $prefix) {
                                echo '<option value="' . $prefix . '">' . $prefix . '</option>';
                            }
                            echo '</select>';
                        echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        

        echo '<div class="radio-wrap">';
            echo '<div class="">';
            echo '<label>Hide/Show Cost Column</label>';
            echo '<input type="radio" name="show_hide" id="distributor_cost_show" value="hide_dealer">Show Distributor Cost Only';
            echo '<input type="radio" name="show_hide" id="dealer_cost_show" value="hide_distributor">Show Dealer Cost Only';
            echo '<input type="radio" name="show_hide" id="cost_show" value="show_cost">Show Distributor & Dealer Cost';
            echo '<input type="radio" name="show_hide" id="cost_hide" value="no_cost">No Pricing';
            echo '</div>';
        echo '</div>';

        echo '<div class="radio-wrap">';
            echo '<div class="">';
            echo '<label>Active/Inactive Members</label>';
            echo '<input type="radio" name="active_inactive" id="all_active_inactive" value="all_active_inactive">All Members (Active & Inactive Members)';
            echo '<input type="radio" name="active_inactive" id="only_active" value="only_active">Active Members Only';
            echo '<input type="radio" name="active_inactive" id="only_inactive" value="only_inactive">Inactive Members Only';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    echo '<div class="reports-btn-wrap">';
        echo '<div class="btn-filter-wrap">';
            echo '<input type="button" id="membership_date_submit" value="Submit" style="color:#fff;background-color:#0065a7;"/>';
        echo '</div>';
        echo '<div>';
            echo '<input type="button" name="reset" id="search_reset" value="Reset" style="background-color: #f1f1f1;padding: 2px 30px;"/>';
        echo '</div>';
    echo '</div>';

echo '</div>';


echo '<div class="membership-result-wrap">';
/*echo '<div class="table-responsive">';
echo '<table id="membership_info_table" class="display nowrap" style="width:100%">';
echo '<thead>';
echo '<tr>';
echo '<th>';
echo 'Registration Number';
echo '</th>';

echo '<th>';
echo 'Customer Name';
echo '</th>';

echo '<th>';
echo 'VIN';
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

echo '<th>';
echo 'Date';
echo '</th>';

echo '<th>';
echo 'Dealer Cost';
echo '</th>';

echo '<th>';
echo 'Distributor Cost';
echo '</th>';

echo '<th>';
echo 'Active/Inactive';
echo '</th>';

echo '</tr>';
echo '</thead>';

echo '<tbody id="">';
if ($action == 'view_upgraded_policy') {
    if ($_GET['distributor']) {
        $distributors = get_users(array('search' => $distributor_login));
    }
    if ($_GET['dealer']) {

        $dealers = get_user_by('login', $dealer_login);
        $dealer_id = $dealers->ID;
        $distributor_login = get_user_meta($dealer_id, 'dealer_distributor_name', true);
        $distributors = get_users(array('search' => $distributor_login));
    }
} else {
    $distributors = get_users('role=author');
}
foreach ($distributors as $distributor) {
    $distributor_id = $distributor->ID;
    $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
    echo '<tr style="background-color: #A0CEEF;font-weight: 700;color: #000000;">';
    echo '<td>' . $distributor_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
    if ($action == 'view_upgraded_policy' && isset($_GET['dealer'])) {
        $dealers = get_users(array('search' => $_GET['dealer']));
    } else {
        $dealers =  get_users(
            array(
                'meta_key' => 'dealer_distributor_name',
                'meta_value' => $distributor_id
            )
        );
    }

    foreach ($dealers as $dealer) {

        $dealer_id = $dealer->ID;
        $dealer_login = $dealer->user_login;

        $dealer_arr = get_code_by_dealer_login($dealer_login);
        $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
        echo '<tr style="background-color: #B5D777;font-weight: 700;color: #000000;">';
        echo '<td>' . $dealer_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
        echo '</tr>';
        $membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');
        foreach ($membership_results as $str) {
            $post_id = $str->post_id;
            $code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
            if ($code_status == 'used') {
                $bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);

                $bulk_prefix = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);

                // $bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
                $code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
                $upgraded_id = get_post_meta($post_id, 'upgraded_by', true);
                $dealer_name = get_user_meta($upgraded_id, 'dealer_name', true);
                $distributor_name = get_user_meta($upgraded_id, 'distributor_name', true);
                $dealer_contact_fname = get_user_meta($upgraded_id, 'contact_fname', true);
                $dealer_contact_lname = get_user_meta($upgraded_id, 'contact_lname', true);
                $distributor_contact_fname = get_user_meta($upgraded_id, 'distributor_contact_fname', true);
                $distributor_contact_lname = get_user_meta($upgraded_id, 'distributor_contact_lname', true);
                $admin_fname = get_user_meta($upgraded_id, 'first_name', true);
                $admin_lname = get_user_meta($upgraded_id, 'last_name', true);
                $users = get_user_by('login', $code);
                $user_id = $users->ID;
                $fname = get_user_meta($user_id, 'first_name', true);
                $lname = get_user_meta($user_id, 'last_name', true);

                $code_prefix = get_post_meta($post_id, '_pmsafe_code_prefix', true);

                $code_dealer_login =  get_post_meta($post_id, '_pmsafe_dealer', true);
                $dealer_users = get_user_by('login', $code_dealer_login);
                $dealer_id = $dealer_users->ID;
                $distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);

                $dealer_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
                $distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
                $dealer_cost = $dealer_price_arr[$code_prefix]['dealer_cost'];
                $distributor_cost = $distributor_price_arr[$code_prefix]['distributor_cost'];

                // $users = get_user_by('login', $code);
                // $user_id = $users->ID;
                $vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', true);
                $vin = $vehicle_info[$code]['pmsafe_vin'];

                if (in_array($code, $dealer_arr)) {
                    echo '<tr class="code-row">';
                    echo '<td style="text-align:center;">';
                    echo $code;
                    echo '</td>';

                    echo '<td>';
                    echo $fname . ' ' . $lname;
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo $vin;
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo $bulk_prefix;
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo $code_prefix;
                    echo '</td>';


                    echo '<td>';
                    if ($dealer_name) {
                        echo $dealer_name;
                    }
                    if ($distributor_name) {
                        echo $distributor_name;
                    }
                    if ($dealer_contact_fname) {
                        echo $dealer_contact_fname.' '.$dealer_contact_lname;
                    }
                    if ($distributor_contact_fname) {
                        echo $distributor_contact_fname.' '.$distributor_contact_lname;
                    }
                    if ($admin_name) {
                        echo $admin_fame.' '.$admin_lame;
                    }
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo  date('m-d-Y', strtotime(get_post_meta($post_id, 'upgraded_date', true)));
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo (($dealer_cost) ? '$' . $dealer_cost : '-');
                    echo '</td>';

                    echo '<td style="text-align:center;">';
                    echo (($distributor_cost) ? '$' . $distributor_cost : '-');
                    echo '</td>';

                    echo '<td class="text-center">';
                    echo  ((get_user_meta($user_id,'user_active_inactive',true)==1)?'<span style="color:#008000;">Active</span>':'<span style="color:#ff0000;">Inactive</span>');
                    echo '</td>';

                    echo '</tr>';
                }
            }
        }
    }
}

echo '</tbody>';
echo '</table>';
echo '</div>';*/
echo '</div>';
