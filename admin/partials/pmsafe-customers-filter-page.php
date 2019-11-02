<?php
echo '<h1 class="top-heading">Coverage Report</h1>';
echo '<div class="filter-wrap coverage-main">';

    echo '<div class="coverage-inner-one">'; 
        echo '<div class="filter-up">';
            echo '<div class="select-filter-wrap">';
                echo '<select id="quick_filters">';
                echo '<option value="0">Quick Filters</option>';
                echo '<option value="1">Expired Members</option>';
                echo '<option value="2">Expiring Members</option>';
                echo '<option value="3">Current Members</option>';
                echo '<option value="4">New Members</option>';
                echo '</select>';
            echo '</div>';
        echo '</div>';

        echo '<div class="input-filter-wrap">';
            echo '<label>Date: </label><input type="text" id="datepicker1" style="width:auto;" disabled> <input type="text" id="datepicker2" style="width:auto;" disabled>';
        echo '</div>';
    echo '</div>';

    echo '<div class="coverage-inner-two">'; 
      //Distributor name
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

                foreach ($distributor_name_arr as $key => $value) {
                    echo '<option value="' . $key . '">' . $value . ' (' . $key . ')' . '</option>';
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
    echo '</div>';


// Submit

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

    echo '<div class="btn-filter-wrap">';
    echo '<input type="button" id="date_submit" value="Submit" style="cursor:pointer;"/>';
    echo '<input type="button" name="reset" id="search_reset" value="Reset" style="background-color: #f1f1f1;width:200px;cursor:pointer;">';
    echo '</div>';
echo '</div>';

echo '<div class="search-result-wrap coverage-report-wrap">';
echo '<div class="tbl-result-wrap">';

echo '</div>';
echo '<div class="data-result-wrap">';

echo '</div>';
echo '</div>';

