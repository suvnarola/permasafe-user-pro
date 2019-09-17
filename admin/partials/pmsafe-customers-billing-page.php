<?php
echo '<div class="top-head">';
    echo '<h1 class="top-heading">Billing Report</h1>';
echo '</div>';

echo '<div class="b-report-wrap">';
// echo '<input type="hidden" id="membership_login_id" value="'.$login.'">';
    echo '<div class="input-filter-wrap form-group">';
        echo '<div class="label-wrap"><label>Date: </label><span class="sub-label"></span></div>';
        echo '<input type="text" id="billing_datepicker1" placeholder="Start Date" style="width:auto;"> <input type="text" id="billing_datepicker2" placeholder="End Date" style="width:auto;">';
    echo '</div>';
    echo '<div class="select-filter-wrap form-group">';
        echo '<div class="label-wrap"><label>Dealers : </label><span class="sub-label">You can select multiple Dealers.</span></div>';
        
           $args = array(
                'role'         => 'contributor',
            );
            $dealer_users = get_users($args);
            foreach ($dealer_users as $key => $value) {
                $dealer_name = get_user_meta($value->ID, 'dealer_name', true);
                $dealer_name_arr[$value->user_login] = $dealer_name;
            }
            asort($dealer_name_arr);
            echo '<div class="select-btn-wrap">';
            echo '<select id="pmsafe_dealers" name="dealers[]" multiple="multiple">';
                
                foreach ($dealer_name_arr as $key => $value) {
                    echo  '<option value="' . $key . '">' . $value . ' (' . $key . ')' . '</option>';
                }
            echo '</select>';
            echo '<input type="button" id="billing_report_submit" value="Run Report" style="color:#fff;background-color:#0065a7;"/>';
            echo '</div>';  
    echo '</div>';

echo '</div>';

echo '<div id="billing_report_result">';
echo '</div>';
?>