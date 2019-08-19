<?php
$html .= '<h1 class="top-heading">Quick Filters</h1>';
$html .= '<div class="filter-wrap">';

$html .= '<div class="filter-up">';
$html .= '<div class="select-filter-wrap">';
$html .= '<select id="quick_filters">';
$html .= '<option value="0">Quick Filters</option>';
$html .= '<option value="1">Expired Members</option>';
$html .= '<option value="2">Expiring Members</option>';
$html .= '<option value="3">Current Members</option>';
$html .= '<option value="4">New Members</option>';
$html .= '</select>';
$html .= '</div>';
$html .= '</div>';

$html .= '<div class="input-filter-wrap">';
$html .= '<label>Date: </label><input type="text" id="datepicker1" style="width:auto;" disabled> <input type="text" id="datepicker2" style="width:auto;" disabled>';
$html .= '</div>';

//Distributor name
$args = array(
    'role'         => 'author',
);
$distributor_users = get_users($args);
$html .= '<div class="filter-mid">';
$html .= '<div class="select-filter-wrap">';
// $html .= '<label>Distributot name : </label>';
$html .= '<select id="pmsafe_distributor">';
$html .= '<option value="">Select Distributor</option>';
foreach ($distributor_users as $key => $value) {
    $distributor_name = get_user_meta($value->ID, 'distributor_name', true);
    $html .= '<option value="' . $value->user_login . '">' . $distributor_name . ' (' . $value->user_login . ')' . '</option>';
}
$html .= '</select>';
$html .= '</div>';
$html .= '</div>';

//Dealer name
$args = array(
    'role'         => 'contributor',
);
$dealer_users = get_users($args);
$html .= '<div class="filter-down">';
$html .= '<div class="select-filter-wrap">';
// $html .= '<label>Dealer name : </label>';
$html .= '<select id="pmsafe_dealer">';
$html .= '<option value="">Select Dealer</option>';
// foreach ($dealer_users as $key => $value) {
//     $dealer_name = get_user_meta($value->ID,'dealer_name',true);
//     $html .= '<option value="'.$value->user_login.'">'.$dealer_name.'</option>';
// }
$html .= '</select>';
$html .= '</div>';
$html .= '</div>';


// Submit

$html .= '<div class="btn-filter-wrap">';
$html .= '<input type="button" id="date_submit" value="submit"/>';
$html .= '</div>';
$html .= '</div>';
$html .= '<div class="search-result-wrap">';
$html .= '<div class="tbl-result-wrap">';

$html .= '</div>';
$html .= '<div class="data-result-wrap">';

$html .= '</div>';
$html .= '</div>';
echo $html;
