<?php
echo '<div class="top-head">';
    echo '<h1 class="top-heading">Remittance Report</h1>';
echo '</div>';
echo '<div class="filter-wrap">';
    echo '<div class="filter-inner-wrap">';

        echo '<div class="inner-wrap">';
            echo '<div class="input-filter-wrap">';
                echo '<label>Date: </label><input type="text" id="membership_datepicker1" style="width:auto;"> <input type="text" id="membership_datepicker2" style="width:auto;">';
            echo '</div>';
            
            echo '<div class="filter-dropdown-wrap">';
            
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
            echo '<label>Filter Result By</label>';
            echo '<input type="radio" name="registration_type" id="all_registration" value="all_registration">All Registrations';
            echo '<input type="radio" name="registration_type" id="upgraded_registration" value="upgraded_registration">Upgraded Registrations Only';
            echo '<input type="radio" name="registration_type" id="non_upgraded_registration" value="non_upgraded_registration">Non-Upgraded Registrations Only';
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
            echo '<label>Hide/Show Address Row</label>';
            echo '<input type="radio" name="address_show_hide" id="hide_address" value="hide_address">Hide Remittance Address';
            echo '<input type="radio" name="address_show_hide" id="show_address" value="show_address">Show Remittance Address';
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
            echo '<input type="button" id="remittance_report_submit" value="Submit" style="color:#fff;background-color:#0065a7;width: 100%;margin: 0;"/>';
        echo '</div>';
        echo '<div>';
            echo '<input type="button" name="reset" id="search_reset" value="Reset" style="background-color: #f1f1f1;padding: 2px 30px;"/>';
        echo '</div>';
    echo '</div>';

echo '</div>';
echo '<div class="remittance-result-wrap">';
echo '</div>';

?>