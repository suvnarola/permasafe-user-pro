<?php
echo '<div class="top-head">';
    echo '<h1 class="top-heading">Billing Report</h1>';
echo '</div>';

echo '<div class="b-report-wrap">';
// echo '<input type="hidden" id="membership_login_id" value="'.$login.'">';
    echo '<div class="input-filter-wrap form-group">';
        echo '<div class="label-wrap"><label>Date : </label><span class="sub-label"></span></div>';
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
            
           
            echo '</div>';  
    echo '</div>';

    echo '<div class="input-filter-wrap form-group radio-wrap">';
        echo '<div class="label-wrap"><label>Active/Inactive Members : </label><span class="sub-label"></span></div>';
        echo '<div class="">';
        echo '<input type="radio" style="margin-left:0px;" name="active_inactive" id="all_active_inactive" value="all_active_inactive">All Members (Active & Inactive Members)';
        echo '<input type="radio" name="active_inactive" id="only_active" value="only_active">Active Members Only';
        echo '<input type="radio" name="active_inactive" id="only_inactive" value="only_inactive">Inactive Members Only';    
        echo '</div>';
    echo '</div>';
    
 echo '<input type="button" id="billing_report_submit" value="Run Report" style="color:#fff;background-color:#0065a7;"/>';
echo '</div>';

echo '<div id="billing_report_result">';
echo '</div>';
?>