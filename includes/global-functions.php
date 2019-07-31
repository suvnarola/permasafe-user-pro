<?php
require plugin_dir_path(__DIR__) . 'admin/include/class-pmsafe_invitecode.php';
require plugin_dir_path(__DIR__) . 'admin/include/class-pmsafe_bulk_invitation.php';
require plugin_dir_path(__DIR__) . 'admin/include/class-pmsafe_usermeta.php';
require plugin_dir_path(__DIR__) . 'admin/include/class-pmsafe_benefits_package.php';

function pr($post)
{
    echo '<pre>';
    print_r($post);
    echo '</pre>';
}

//add_action('init','test_nisl_function');
function test_nisl_function()
{
    //    echo 'test';
    //    die;
    $prefix = 'RT';
    $no_of_code = 3;
    $rang1 = 1500;
    $rang2 = 1575;

    for ($rang1; $rang1 <= $rang2; $rang1++) {
        echo $prefix . ($rang1);
        echo '<br>';
    }

    die;
}

/**
 * Random code generator
 * 
 * @return type
 */
function pmsafe_random_code()
{
    $bytes = bin2hex(random_bytes(5));
    return $bytes;
}


function pmsafe_redirect_function()
{

    $location = get_site_url() . "/perma-register/";
    wp_redirect($location, 301);
    exit;
}
/**
 * Unused code counter
 * 
 * @param type $post_id
 * @return type
 */
function pmsafe_unused_code_count($post_id)
{
    $data = array();
    $invitation_id = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
    if (!empty($invitation_id)) {
        $invitation_id = explode(',', $invitation_id);
        $data['total'] = count($invitation_id);
        $data['used'] = 0;
        foreach ($invitation_id as $id) {
            $code_status = get_post_meta($id, '_pmsafe_code_status', true);
            if ($code_status == 'used') {
                $data['used'] = $data['used'] + 1;
            }
        }
    }

    return $data;
}

//echo pmsafe_if_code_exist('d3d7b8f471');
//die;
function pmsafe_if_code_exist($code)
{
    if (empty($code))
        return false;

    $args = array(
        'post_type' => 'pmsafe_invitecode',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key'     => '_pmsafe_invitation_code',
                'value'   => $code,
                'compare' => '=',
            ),
            array(
                'key'     => '_pmsafe_code_status',
                'value'   => 'available',
                'compare' => '='
            )
        ),
    );
    $posts = get_posts($args);
    if ($posts) {
        return $posts[0]->ID;
    } else {
        return false;
    }
}

/**
 * Check code status
 * 
 * @param type $code
 * @param type $post_id
 * @return boolean
 */
function pmsafe_check_code_status($code, $post_id)
{
    if (empty($code))
        return false;
}

/**
 * Create user
 * 
 * @param type $email
 * @param type $password
 * @return string
 */
function pmsafe_create_user($email, $password, $member_code)
{
    $explode = explode("@", $email);
    $user_email =  $email;
    $user_password =  $password;
    // $user_name = $explode[0];
    $user_name = $member_code;

    $user_id = username_exists($user_name);
    if (!$user_id and email_exists($user_email) == false) {
        $user_id = wp_create_user($user_name, $user_password, $user_email);

        $response = array(
            'user_type' => 'New',
            'user_id' => $user_id
        );
    } else {
        $response = array(
            'user_type' => 'Exist',
            'user_id' => $user_id
        );
    }

    return $response;
}

/**
 * Get all meta value from meta key
 * 
 * @global type $wpdb
 * @param type $key
 * @param type $type
 * @param type $status
 * @return type
 */
function pmsafe_get_meta_values($key = '', $type = 'post', $status = 'publish')
{
    global $wpdb;
    if (empty($key))
        return;
    $r = $wpdb->get_results($wpdb->prepare("
        SELECT p.ID, pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
    ", $key, $status, $type));

    foreach ($r as $my_r)
        $metas[$my_r->ID] = $my_r->meta_value;

    return $metas;
}

/**
 * Get post id from meta key and value
 * 
 * @param string $key
 * @param mixed $value
 * @return int|bool
 */
function get_post_id_by_meta_key_and_value($key, $value)
{
    global $wpdb;
    $meta = $wpdb->get_results("SELECT * FROM `" . $wpdb->postmeta . "` WHERE meta_key='" . $key . "' AND meta_value='" . $value . "'");
    if (is_array($meta) && !empty($meta) && isset($meta[0])) {
        $meta = $meta[0];
    }

    if (is_object($meta)) {
        return $meta->post_id;
    } else {
        return false;
    }
}

/**
 * Get benefit PDF URL by prefix
 * 
 * @param type $prefix
 * @return boolean
 */
function get_benefit_pdf_url($prefix)
{
    if (empty($prefix))
        return false;

    $benefit_prefix_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $prefix);
    if (!empty($benefit_prefix_id)) {
        $benefit_pdf_id = get_post_meta($benefit_prefix_id, '_pmsafe_benefit_pdf', true);
        $benefit_pdf_url = get_attached_file($benefit_pdf_id);
        return $benefit_pdf_url;
    }
    return false;
}


// add_action('init','test_pmsafe_warranty_card');
function test_pmsafe_warranty_card()
{
    $user_id = 301;
    $membercode = 86;
    $user = get_user_by('ID', $user_id);
    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    $vehicle_info = $vehicle_info[$membercode];

    pr($user);
    pr($vehicle_info);
    die();
    // echo "hi" . $_SESSION['registerd_username'];
    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', 211);
    echo "<pre>";
    print_r($vehicle_info);
    echo "</pre>";
    die();
    $args = array(
        'search'         => 'ka@narola.email',
        'search_columns' => array('user_email')
    );

    // The Query
    $user_query = new WP_User_Query($args);

    // User Loop
    if (!empty($user_query->get_results())) {
        foreach ($user_query->get_results() as $user) {
            echo '<p>' . $user->ID . '</p>';
            $get_vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user->ID);
            foreach ($get_vehicle_info as $key => $val) {
                $member_code = $val['pmsafe_member_number'];
                echo "string=>" . $member_code . "<br/>";
                $member_code_id = $val['pmsafe_member_code_id'];
                echo "string2=>" . $member_code_id . "<br/>";
                $pdf_link = generate_pdf($user_id, $member_code);
                update_post_meta($member_code_id, 'pmsafe_pdf_link', $pdf_link);
                echo $user_id . "<br/>";

                // $vehicle_info_pdf = get_the_author_meta( 'pmsafe_vehicle_info', $user_id );
                $val['pmsafe_pdf_link'] = $pdf_link;
                echo "this is=>" . $val['pmsafe_pdf_link'] . '<br/>';
                update_user_meta($user_id, 'pmsafe_vehicle_info', $get_vehicle_info);
                sleep(1);
            }
        }
    } else {
        echo 'No users found.';
    }
    // $all_users = get_users();
    //  echo '<ol>';
    //  foreach ($all_users as $user) {
    //      echo '<li><span>' . esc_html($user->user_email) . ' : ' . esc_html($user->display_name) . '</span></li>';
    //  }
    //  echo '</ol>';
    // Array of WP_User objects.

    // foreach ( $blogusers as $user ) {
    //     echo '<span>' . esc_html( $user->ID ) . '</span><br/>';
    // }
    // $user_id = 154;
    // $user = get_user_by( 'email', 'ka@narola.email' );
    // echo "<pre>";
    //     print_r($user);
    // echo "</pre>";
    die();
    // $membercode = 122;
    // $member_code_id = pmsafe_if_code_exist(170);
    // echo "string2=>".$member_code_id;
    // die();



    echo "member=>" . $membercode . '<br/>';

    //$vehicle_information = get_the_author_meta('pmsafe_vehicle_info' ,$user_id);
    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    // $vehicle_info = $vehicle_info[$membercode];
    // echo"pdf=>".$vehicle_info['name'];
    echo "<pre>";
    print_r($vehicle_info);
    echo "<pre>";

    $get_vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    foreach ($get_vehicle_info as $key => $val) {
        $member_code = $val['pmsafe_member_number'];
        echo "string=>" . $member_code . "<br/>";
        $member_code_id = $val['pmsafe_member_code_id'];
        echo "string2=>" . $member_code_id . "<br/>";
        $pdf_link = generate_pdf($user_id, $member_code);
        update_post_meta($member_code_id, 'pmsafe_pdf_link', $pdf_link);
        echo $user_id . "<br/>";

        // $vehicle_info_pdf = get_the_author_meta( 'pmsafe_vehicle_info', $user_id );
        $val['pmsafe_pdf_link'] = $pdf_link;
        echo "this is=>" . $val['pmsafe_pdf_link'] . '<br/>';
        update_user_meta($user_id, 'pmsafe_vehicle_info', $get_vehicle_info);
        sleep(1);
    }

    echo "<pre>";
    print_r($get_vehicle_info);
    echo "</pre>";
    die();
    $user = get_user_by('ID', $user_id);
}

/**
 * user info tab
 * 
 * @param type $user_id
 * @return string
 */
function pmsafe_warranty_user_info_card($user_id)
{
    $user = get_user_by('ID', $user_id);
    $html = '';

    $html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div id="pmsafe-response"></div>';
    $html .= '<div id="perma-warranty-form">';
    $html .= '<form name="perma_user_info" id="perma_user_info_form" method="POST">';

    $html .= '<div class="perma-customer-info">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Name:</label> <input class="nisl_name" name="nisl_name" type="text" value="' . esc_attr(get_the_author_meta('edit_first_name', $user_id)) . ' ' . esc_attr(get_the_author_meta('edit_last_name', $user_id)) . '" disabled autofocus/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $address1 = get_the_author_meta('edit_pmsafe_address_1', $user_id);
    $address2 = get_the_author_meta('edit_pmsafe_address_2', $user_id);
    if (!empty($address1) || $address2) {
        $address = $address1 . ', ' . $address2;
    }
    $html .= '<label class="pdf-label">Address:</label><input class="nisl_address" name="nisl_address" type="text" value="' . $address . '" disabled/>';
    $html .= '<input type="text" class="nisl_state" name="nisl_state" value="' . esc_attr(get_the_author_meta('edit_pmsafe_city', $user_id)) . ' ' . esc_attr(get_the_author_meta('edit_pmsafe_state', $user_id)) . ' ' . esc_attr(get_the_author_meta('edit_pmsafe_zip_code', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Phone:</label> <input class="nisl_phone" name="nisl_phone" type="text" value="' . esc_attr(get_the_author_meta('edit_pmsafe_phone_number', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Email:</label> <input type="text" value="' . $user->data->user_email . '" disabled/>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '<input type="submit" id="pmsafe_save_user_info" value="Submit" style="display:none">';
    $html .= '</form>';
    $html .= '</div>';


    $html .= '</div>';

    return $html;
}

/**
 * dealer info tab
 * 
 * @param type $user_id
 * @return string
 */
function pmsafe_dealer_info_card($user_id)
{
    // echo $user_id;
    $user = get_user_by('ID', $user_id);
    $html = '';

    $html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div id="pmsafe-response"></div>';
    $html .= '<div id="perma-warranty-form">';
    $html .= '<form name="perma_dealer_info_form" id="perma_dealer_info_form" method="POST">';

    $html .= '<div class="perma-customer-info">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Name:</label> <input class="nisl_name" name="nisl_name" type="text" value="' . esc_attr(get_the_author_meta('dealer_name', $user_id)) . '" disabled autofocus/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $address1 = get_the_author_meta('dealer_store_address', $user_id);
    // $address2 = get_the_author_meta( 'edit_pmsafe_address_2', $user_id );
    if (!empty($address1)) {
        $address = $address1;
    }
    $html .= '<label class="pdf-label">Store Address:</label><input class="nisl_address" name="nisl_address" type="text" value="' . $address . '" disabled/>';

    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Phone:</label> <input class="nisl_phone" name="nisl_phone" type="text" value="' . esc_attr(get_the_author_meta('dealer_phone_number', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Fax:</label> <input class="nisl_fax" name="nisl_fax" type="text" value="' . esc_attr(get_the_author_meta('dealer_fax_number', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Email:</label> <input type="text" value="' . $user->data->user_email . '" disabled/>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '<input type="submit" id="pmsafe_save_dealer_info" value="Submit" style="display:none">';
    $html .= '</form>';
    $html .= '</div>';


    $html .= '</div>';

    return $html;
}

function pmsafe_dealer_user_info_card($user_id)
{
    // echo $user_id;
    $user = get_user_by('ID', $user_id);
    $html = '';

    $html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div id="pmsafe-response"></div>';
    $html .= '<div id="perma-warranty-form">';
    $html .= '<form name="perma_dealer_user_info_form" id="perma_dealer_user_info_form" method="POST">';

    $html .= '<div class="perma-customer-info">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">First Name:</label> <input class="nisl_fname" name="nisl_fname" type="text" value="' . esc_attr(get_the_author_meta('contact_fname', $user_id)) . '" disabled autofocus/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Last Name:</label> <input class="nisl_lname" name="nisl_lname" type="text" value="' . esc_attr(get_the_author_meta('contact_lname', $user_id)) . '" disabled autofocus/>';
    $html .= '</div>';

    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Phone:</label> <input class="nisl_phone" name="nisl_phone" type="text" value="' . esc_attr(get_the_author_meta('contact_phone', $user_id)) . '" disabled/>';
    $html .= '</div>';

    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Email:</label> <input type="text" value="' . $user->data->user_email . '" disabled/>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '<input type="submit" id="pmsafe_save_dealer_user_info" value="Submit" style="display:none">';
    $html .= '</form>';
    $html .= '</div>';


    $html .= '</div>';

    return $html;
}

/**
 * Warranty card
 * 
 * @param type $user_id
 * @return string
 */
function pmsafe_warranty_card($user_id, $membercode)
{

    $user = get_user_by('ID', $user_id);


    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    $vehicle_info = $vehicle_info[$membercode];
    $post_id = $vehicle_info['pmsafe_member_code_id'];
    $benefits_package = get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
    $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);

    $dealer_login = get_post_meta($post_id, '_pmsafe_dealer', true);
    $dealers = get_user_by('login', $dealer_login);
    $dealer_id = $dealers->data->ID;
    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
    $dealer_address = get_user_meta($dealer_id, 'dealer_store_address', true);
    $dealer_phone = get_user_meta($dealer_id, 'dealer_phone_number', true);

    $price_arr = get_user_meta($dealer_id, 'pricing_package', true);
    $selling_price = $price_arr[$benefits_package]['selling_price'];
    $updated_selling_price = get_post_meta($post_id, 'updated_selling_price', true);

    if ($updated_selling_price) {
        $selling_price = $updated_selling_price;
    } else {
        if ($selling_price) {
            $selling_price = $selling_price;
        } else {
            $selling_price = 0;
        }
    }
    // echo '<pre>';
    //     print_r($vehicle_info);
    // echo '</pre>';
    $html = '';
    $html .= '<center><img src="' . plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png" /></center>';
    // foreach ($vehicle_information as $key=>$value) {

    $html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div id="perma-warranty-form">';
    $html .= '<div id="perma-warranty-head" class="pdf-css-head">';

    $html .= '<h2 class="main-heading">PermaSafe Limited Warranty Registration</h2>';

    $html .= '<h3 class="sub-heading pdf-css-head">Customer Information</h3>';
    // $html .= '<a href="'.esc_attr( $vehicle_info['pmsafe_pdf_link'] ).'" class="download-pdf" target="_blank" download>Download as a PDF</a>';
    $html .= '<iframe src="' . $vehicle_info['pmsafe_pdf_link'] . '" id="myFrame" frameborder="0" style="border:0;display:none;" width="300" height="300"></iframe>';
    $html .= '<input type="button" id="print-pdf" onclick="print()" value="Print PDF"  />';
    $html .= '<a href="' . get_site_url() . '/perma-warranty-pdf/?membercode=' . $membercode . '" class="download-pdf">Download as a PDF</a>';
    ?>

    <script>
        function print() {
            var objFra = document.getElementById('myFrame');
            objFra.contentWindow.focus();
            objFra.contentWindow.print();
        }
    </script>
    <?php
    $html .= '</div>';
    $html .= '<div class="perma-customer-info">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Name:</label> <input type="text" value="' . esc_attr(get_the_author_meta('first_name', $user_id)) . ' ' . esc_attr(get_the_author_meta('last_name', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $address1 = get_the_author_meta('pmsafe_address_1', $user_id);
    $address2 = get_the_author_meta('pmsafe_address_2', $user_id);
    if (!empty($address1) || $address2) {
        $address = $address1 . ', ' . $address2;
    }
    $html .= '<label class="pdf-label">Address:</label><input type="text" value="' . $address . '" disabled/>';
    $html .= '<input type="text" value="' . esc_attr(get_the_author_meta('pmsafe_city', $user_id)) . ' ' . esc_attr(get_the_author_meta('pmsafe_state', $user_id)) . ' ' . esc_attr(get_the_author_meta('pmsafe_zip_code', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Phone:</label> <input type="text" value="' . phone_number_format(get_the_author_meta('pmsafe_phone_number', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Email:</label> <input type="text" value="' . $user->data->user_email . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Registration Date:</label> <input type="text" value="' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '" disabled/>';
    $html .= '</div class="pdf-div">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Signature: X</label><input type="text" value="' . esc_attr(get_the_author_meta('pmsafe_signature', $user_id)) . '" disabled/>';
    $html .= '</div>';
    $html .= '<p><b>PERMASAFE PROTECTIVE COATINGS, LLC ("PPC"), offers a Limited Product Warranty ("Warranty") for specific vehicle surfaces treated with PERMASAFE SURFACE PROTECTION PRODUCTS. The Warranty is subject to all terms and conditions set forth in this registration form.</b></p>';
    $html .= '<p>By electronically signing above, I hereby acknowledge that I have read this <b>Warranty</b> registration form completely, understand and consent to the terms and conditions and my obligations under the <b>Warranty</b>, and have received a complete copy of the <b>Warranty</b>. I certify that my electronic signature shall have the same legal effect as an originally signed document under applicable federal or state electronic signature laws.</p>';
    $html .= '</div>';

    $html .= '<h3>Vehicle Information</h3>';
    $html .= '<div class="perma-vehicle-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Year:</label><input type="text" value="' . $vehicle_info['pmsafe_vehicle_year'] . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Make:</label><input type="text" value="' . $vehicle_info['pmsafe_vehicle_make'] . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="second-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Model:</label><input type="text" value="' . $vehicle_info['pmsafe_vehicle_model'] . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Mileage at Application: </label><input type="text" value="' . $vehicle_info['pmsafe_vehicle_mileage'] . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="third-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Applied Date:</label><input type="text" value="' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Product Purchase Price: </label><input type="text" value="$' . $selling_price . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="fourth-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Vehicle Type:</label>';
    if ($vehicle_info['pmsafe_vehicle_type'] == "new") {
        $html .= '<img style="margin-bottom:-5px;" src="https://permasafe.com/wp-content/uploads/2019/06/checked.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-5px;" src="https://permasafe.com/wp-content/uploads/2019/06/check.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    if ($vehicle_info['pmsafe_vehicle_type'] == "preowned") {
        $html .= '<img style="margin-bottom:-5px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/check.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-5px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/checked.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">VIN: </label> <input type="text" value="' . $vehicle_info['pmsafe_vin'] . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    // $html .= '<div class="last-row pdf-div">';
    //     $html .= '<div class="center-row">';
    //         $html .= '<label class="pdf-label">VIN: </label> <input type="text" value="'.$vehicle_info['pmsafe_vin'].'" disabled/>';
    //     $html .= '</div>';
    // $html .= '</div>';
    $html .= '</div>';


    $html .= '<h3>Dealership Information</h3>';
    $html .= '<div class="perma-dealer-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Name:</label><input type="text" value="' . $dealer_name . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Phone:</label><input type="text" value="' . phone_number_format($dealer_phone) . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label add_label">Address: </label> <input type="text" value="' . $dealer_address . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '<h3>Limited Warranty Terms and Conditions</h3>';
    $html .= '<div class="perma-terms-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Warranty Registration #: </label><input type="text" value="' . $vehicle_info['pmsafe_member_number'] . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Plan ID: </label><input type="text" value="' . get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true) . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="second-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Registration Date: </label><input type="text" value="' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Expiration Date: </label><input type="text" value="' . date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info['pmsafe_registration_date']))) . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<h2 class="heading">IF YOU HAVE ANY QUESTIONS REGARDING THIS WARRANTY OR FILING<br/> A CLAIM CONTACT WARRANTOR AT: (866) 372-9622</h2>';
    $html .= '<span class="head-block">I. DEFINITIONS</span>';
    $html .= '<p><b><u>ADMINISTRATOR/WARRANTOR ("WE," "US," "OUR"):</u> PERMASAFE PROTECTIVE COATINGS ("PPC"), 4613 North University Drive #470, Coral Springs, FL 33067, 866-372-9622,</b> who is the <b>Warrantor</b> to this <b>Warranty</b>, or any successor Warrantor designated by <b>PPC</b> from time to time.</p>';
    $html .= '<p><b><u>DEALER:</u></b> the dealership identified above under <b>Dealership Information.</b></p>';
    $html .= '<p><b><u>YOU OR YOUR:</u></b> the customer identified above under <b>Customer Information.</p>';

    $html .= '</div>';

    $prefix = get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    $benefit_prefix_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $prefix);

    if (!empty($benefit_prefix_id)) {
        $html .= get_post_field('post_content', $benefit_prefix_id);
    }


    $html .= '</div>';
    // } //end foreach


    return $html;
}

/**
 * Generate PDF
 * 
 * @param type $user_id
 * @return string
 */
function generate_pdf($user_id, $member_code)
{
    include_once(plugin_dir_path(__DIR__) . 'includes/MPDF/mpdf.php');

    ob_start();  // start output buffering
    $mpdf = new mPDF();

    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/';

    if (is_dir($dir) === false) {
        mkdir($dir);
    }

    $pdf_name = 'perma_warranty_' . $user_id . '_' . time();
    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/' . $pdf_name . '.pdf';

    //    $user_id = get_current_user_id();
    $me_data = "";
    $me_data .= pmsafe_warranty_card_pdf($user_id, $member_code);

    $mpdf->debug = true;
    $mpdf->SetDisplayMode('fullpage');
    //    $stylesheet = file_get_contents('https://permasafe.net/wp-content/plugins/permasafe-user-pro/public/css/permasafe-user-pro-public.css?ver=1528874605');
    //    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($me_data);

    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    $vehicle_info = $vehicle_info[$member_code];

    $prefix = get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    //    $new_pdf = plugin_dir_path( __DIR__ ). 'upload-pdf/example_4.pdf';
    $new_pdf = get_benefit_pdf_url($prefix);

    // Apend another PDF
    if (!empty($new_pdf)) {
        $mpdf->SetImportUse();
        $pagecount = $mpdf->SetSourceFile($new_pdf);

        for ($i = 1; $i <= ($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }
    }

    $mpdf->Output($dir, 'F');
    ob_end_flush();

    $pdf_link = plugins_url('permasafe-user-pro') . '/upload-pdf/' . $pdf_name . '.pdf';
    return $pdf_link;
}

/**
 * Generate Sales person PDF
 * 
 * @param type $user_id
 * @return string
 */
function sales_person_generate_pdf($pdf_array)
{
    include_once(plugin_dir_path(__DIR__) . 'includes/MPDF/mpdf.php');

    ob_start();  // start output buffering
    $mpdf = new mPDF();

    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/';

    if (is_dir($dir) === false) {
        mkdir($dir);
    }

    $pdf_name = 'perma_warranty_sales_person_' . time();
    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/' . $pdf_name . '.pdf';

    $html = '';

    $html .= '<div id="perma-warranty-wrapper">';

    $html .= '<div id="perma-warranty-form">';
    $html .= '<div style="color: #000;font-weight: 600;text-align: center;">';
    $html .= '<img src="' .  plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png" style="width: auto;height: 45px;" />';

    $html .= '<div style="font-family: Libre Franklin;font-size: 17px;line-height: normal;margin-bottom: 0px;color: #000;font-weight: bold;">PermaSafe Limited Warranty Registration</div>';
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 2px;font-size: 15px;">Customer Information</div>';
    $html .= '</div>';

    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="width:80%; margin:0 auto;">';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;font-weight: bold;text-align: right;">Name:</div><div style="font-family: Libre Franklin;display: inline-block; margin-left:10px; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px;  color: #555; padding: 5px;">' . $pdf_array['first_name'] . ' ' . $pdf_array['last_name'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;display: block;width: 100%; margin-bottom: 3px;">';
    $address1 = $pdf_array['pmsafe_address_1'];
    $address2 = $pdf_array['pmsafe_address_2'];
    if (!empty($address1) || $address2) {
        $address = $address1 . ', ' . $address2;
    }
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;font-weight: bold;text-align: right;">Address:</div><div style="margin-left:10px; font-family: Libre Franklin;display: inline-block; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px;  color: #555; padding: 5px;">' . $address . '</div>';
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;">&nbsp;&nbsp;&nbsp;&nbsp;</div><div style="margin-left:10px; font-family: Libre Franklin;display: inline-block; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px; color: #555; padding: 5px;">' . $pdf_array['pmsafe_city'] . ' ' . $pdf_array['pmsafe_state'] . ' ' . $pdf_array['pmsafe_zip_code'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 30%;text-align: right;">Phone:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;">' . phone_number_format($pdf_array['pmsafe_phone_number']) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 30%;text-align: right;">Email:</div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_email'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left;  width: 30%;text-align: right;">Registration Date:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime($pdf_array['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 35%;text-align: right;">Signature: X</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 60%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['signature'] . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;padding-bottom: 0px;margin-bottom: 0px;"><b>PERMASAFE PROTECTIVE COATINGS, LLC ("PPC"), offers a Limited Product Warranty ("Warranty") for specific vehicle surfaces treated with PERMASAFE SURFACE PROTECTION PRODUCTS. The Warranty is subject to all terms and conditions set forth in this registration form.</b></div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;padding-bottom: 0px;margin-bottom: 0px;">By electronically signing above, I hereby acknowledge that I have read this <b>Warranty</b> registration form completely, understand and consent to the terms and conditions and my obligations under the <b>Warranty</b>, and have received a complete copy of the <b>Warranty</b>. I certify that my electronic signature shall have the same legal effect as an originally signed document under applicable federal or state electronic signature laws.</div>';
    $html .= '</div>';

    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Vehicle and Sale Information</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Year:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_vehicle_year'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Make:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_vehicle_make'] . '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%; text-align: right;">Model:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_vehicle_model'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Mileage at Application: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_vehicle_mileage'] . '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Applied Date:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime($pdf_array['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Product Purchase Price: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >$895</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Vehicle Type:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >';
    if ($pdf_array['pmsafe_vehicle_type'] == "new") {
        $html .= '<img style="margin-bottom:-8px;" src="https://permasafe.com/wp-content/uploads/2019/06/checked.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-8px;" src="https://permasafe.com/wp-content/uploads/2019/06/check.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    if ($pdf_array['pmsafe_vehicle_type'] == "preowned") {
        $html .= '<img style="margin-bottom:-8px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/check.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-8px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/checked.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">VIN: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_vin'] . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    // dealership info
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Dealership Information</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';

    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">Name:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >ABC AUTO SALES</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">Phone:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >(000) 000-0000</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 100%;float: left; margin-bottom: 3px;">';

    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left;text-align:right;width:12%;">Address:</div> 
                        <div style="margin-left:10px;font-family: Libre Franklin;float:left;width: 80%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >123 Any Street Address, Anytown, Washington, 12345</div>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '</div>';
    $html .= '</div>';

    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Limited Warranty Terms and Conditions</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 10px;">';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Warranty Registration #:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width:30%;box-shadow:none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_warranty_registration'] . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Plan ID: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_array['pmsafe_plan_id'] . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 15px;">';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Registration Date: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 16px;color: #555;padding: 5px;">' . date('Y-m-d', strtotime($pdf_array['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Expiration Date: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left; width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 16px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime("+42 months", strtotime($pdf_array['pmsafe_registration_date']))) . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-size: 12px;text-align: center;font-weight: bold;">IF YOU HAVE ANY QUESTIONS REGARDING THIS WARRANTY OR FILING<br/>A CLAIM CONTACT WARRANTOR AT: (866) 372-9622</div>';
    $html .= '<div style="font-family: Libre Franklin;background: #000;width: 100%;display: block;text-align: center;color: #fff;font-size: 13px;">I. DEFINITIONS</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">ADMINISTRATOR/WARRANTOR ("WE," "US," "OUR"):</u> PERMASAFE PROTECTIVE COATINGS ("PPC"), 4613 North University Drive #470, Coral Springs, FL 33067, 866-372-9622,</b> who is the <b style="font-size: 12px;color: #000;">Warrantor</b> to this <b style="font-size: 12px;color: #000;">Warranty</b>, or any successor Warrantor designated by <b style="font-size: 12px;color: #000;">PPC</b> from time to time.</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">DEALER:</u></b> the dealership identified above under <b style="font-size: 12px;color: #000;">Dealership Information.</b></div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">YOU OR YOUR:</u></b> the customer identified above under <b style="font-size: 12px;color: #000;">Customer Information.</b></div>';

    $html .= '</div>';


    $html .= '</div>';


    $mpdf->debug = true;
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->WriteHTML($html);

    //    $prefix = get_post_meta(get_the_author_meta( 'pmsafe_member_code_id', $user_id ),'_pmsafe_code_prefix',true);
    //    $new_pdf = plugin_dir_path( __DIR__ ). 'upload-pdf/example_4.pdf';
    $demo_benefit_prefix = esc_attr(get_option('pmsafe_demo_benefit_prefix'));
    if (!empty($demo_benefit_prefix)) {
        $new_pdf = get_benefit_pdf_url($demo_benefit_prefix);

        // Apend another PDF
        if (!empty($new_pdf)) {
            $mpdf->SetImportUse();
            $pagecount = $mpdf->SetSourceFile($new_pdf);
            for ($i = 1; $i <= ($pagecount); $i++) {
                $mpdf->AddPage();
                $import_page = $mpdf->ImportPage($i);
                $mpdf->UseTemplate($import_page);
            }
        }
    }

    $mpdf->Output($dir, 'F');
    ob_end_flush();

    $pdf_link = plugins_url('permasafe-user-pro') . '/upload-pdf/' . $pdf_name . '.pdf';
    return $pdf_link;
}

/**
 * Warranty card
 * 
 * @param type $user_id
 * @return string
 */
function pmsafe_sales_person_warranty_card($array, $pdf_link)
{

    $html = '';
    $html .= '<div id="perma-warranty-wrapper">';
    $html .= '<div id="perma-warranty-form">';
    $html .= '<div id="perma-warranty-head" class="pdf-css-head">';
    $html .= '<img src="' . plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png" />';
    $html .= '<h2 class="main-heading">PermaSafe Limited Warranty Registration</h2>';
    $html .= '<h3 class="sub-heading pdf-css-head">Customer Information</h3>';
    $html .= '<a href="' . $pdf_link . '" class="download-pdf" target="_blank" download>Download as a PDF</a>';
    $html .= '</div>';
    $html .= '<div class="perma-customer-info">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Name:</label> <input type="text" value="' . $array['first_name'] . ' ' . $array['last_name'] . '" />';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $address1 = $array['pmsafe_address_1'];
    $address2 = $array['pmsafe_address_2'];
    if (!empty($address1) || $address2) {
        $address = $address1 . ', ' . $address2;
    }
    $html .= '<label class="pdf-label">Address:</label><input type="text" value="' . $address . '" />';
    $html .= '<input type="text" value="' . $array['pmsafe_city'] . ' ' . $array['pmsafe_state'] . ' ' . $array['pmsafe_zip_code'] . '" />';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Phone:</label> <input type="text" value="' . phone_number_format($array['pmsafe_phone_number']) . '" />';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Email:</label> <input type="text" value="' . $array['pmsafe_email'] . '" />';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Registration Date:</label> <input type="text" value="' . date('Y-m-d', strtotime($array['pmsafe_registration_date'])) . '" />';
    $html .= '</div class="pdf-div">';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label">Signature: X</label><input type="text" value="' . $array['signature'] . ' ' . $array['last_name'] . '" />';
    $html .= '</div>';
    $html .= '<p><b>PERMASAFE PROTECTIVE COATINGS ("PPC"), offers a Product Limited Warranty ("Warranty") for interior surfaces treated with PERMASAFE SURFACE PROTECTION PRODUCTS. The Warranty is subject to all terms and conditions set forth in this registration form.</b></p>';
    $html .= '<p>By electronically signing above, I hereby acknowledge and consent to all of the provisions and terms and conditions included in this registration form. I certify that my electronic signature shall have the same legal effect as an originally signed document under applicable federal or state electronic signature laws.</p>';
    $html .= '</div>';

    $html .= '<h3>Vehicle and Sale Information</h3>';
    $html .= '<div class="perma-vehicle-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Year:</label><input type="text" value="' . $array['pmsafe_vehicle_year'] . '" />';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Make:</label><input type="text" value="' . $array['pmsafe_vehicle_make'] . '" />';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="second-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Model:</label><input type="text" value="' . $array['pmsafe_vehicle_model'] . '" />';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Mileage at Application: </label><input type="text" value="' . $array['pmsafe_vehicle_mileage'] . '" />';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="third-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Applied Date:</label><input type="text" value="' . $array['pmsafe_registration_date'] . '" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Product Purchase Price: </label><input type="text" value="$895" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="fourth-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Vehicle Type:</label>';
    if ($array['pmsafe_vehicle_type'] == "new") {
        $html .= '<img style="margin-bottom:-5px;" src="https://permasafe.com/wp-content/uploads/2019/06/checked.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-5px;" src="https://permasafe.com/wp-content/uploads/2019/06/check.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    if ($array['pmsafe_vehicle_type'] == "preowned") {
        $html .= '<img style="margin-bottom:-5px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/check.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-5px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/checked.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">VIN: </label> <input type="text" value="' . $array['pmsafe_vin'] . '" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    // $html .= '<div class="last-row pdf-div">';
    //     $html .= '<div class="center-row">';
    //         $html .= '<label class="pdf-label" style="width:20% !important;">VIN: </label> <input type="text" value="'.$array['pmsafe_vin'].'" />';
    //     $html .= '</div>';
    // $html .= '</div>';
    $html .= '</div>';
    $html .= '<h3>Dealership Information</h3>';
    $html .= '<div class="perma-dealer-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Name:</label><input type="text" value="ABC AUTO SALES" disabled/>';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Phone:</label><input type="text" value="(000) 000-0000" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="pdf-div">';
    $html .= '<label class="pdf-label add_label">Address: </label> <input type="text" value="123 Any Street Address, Anytown, Washington, 12345" disabled/>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '<h3>Limited Warranty Terms and Conditions</h3>';
    $html .= '<div class="perma-terms-info">';
    $html .= '<div class="first-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Warranty Registration #: </label><input type="text" value="' . $array['pmsafe_warranty_registration'] . '" />';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Plan ID: </label><input type="text" value="' . $array['pmsafe_plan_id'] . '" />';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="second-row pdf-div">';
    $html .= '<div class="left-side">';
    $html .= '<label class="pdf-label">Registration Date: </label><input type="text" value="' . date('Y-m-d', strtotime($array['pmsafe_registration_date'])) . '" />';
    $html .= '</div>';
    $html .= '<div class="right-side">';
    $html .= '<label class="pdf-label">Expiration Date: </label><input type="text" value="' . date('Y-m-d', strtotime("+42 months", strtotime($array['pmsafe_registration_date']))) . '" />';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<h2 class="heading">IF YOU HAVE ANY QUESTIONS REGARDING THIS WARRANTY OR HOW TO FILE A CLAIM CONTACTWARRANTOR: (866) 372-9622</h2>';
    $html .= '<span class="head-block">I. DEFINITIONS</span>';
    $html .= '<p><b><u>WARRANTOR ("WE," "US," "OUR"):</u> PERMASAFE PROTECTIVE COATINGS ("PPC"), 4613 North University Drive #470, Coral Springs, FL 33067, 866-372-9622,</b> who is the <b>Warrantor</b> to this <b>Warranty</b>, or any successor Warrantor designated by <b>PPC</b> from time to time.</p>';
    $html .= '<p><b><u>DEALER:</u></b> the authorized retail seller of PermaSafe Products.</p>';
    $html .= '<p><b><u>YOU OR YOUR:</u></b> the person listed in the Customer Information section on the Limited Warranty Registration.</p>';

    $html .= '<span class="head-block">II. WARRANTY TERM - REGISTRATION - CONDITIONS</span>';
    $html .= '<p><b><u>Warranty Term, Preowned Vehicles (Current Model Year and up to ten (10) prior Model Years):</u></b> Thirty six (36) months, commencing sixty (60) days from the Registration Date.</p>';
    $html .= '<p><b><u>Warranty Term, New Vehicles:</u></b> Thirty six (36) months from the Registration Date.</p>';
    $html .= '<p><b>Registration:</b> In order to receive benefits under the terms of this <b>Warranty, You</b> must register this <b>Warranty</b> at www.PermaSafe.com within thirty (30) days of the date of the PermaSafe product purchase. Should <b>You</b> fail to register this <b>Warranty</b> at www.PermaSafe.com within thirty (30) days of the date of the PermaSafe product purchase, coverage may be denied. This <b>Warranty</b> gives <b>You</b> specific legal rights and <b>You</b> may also have other rights which vary from state to state. <b>PPC</b> does not authorize any person to create for <b>PPC</b> any other obligation or liability in connection with the <b>PERMASAFE</b> products or applications.</p>';
    $html .= '</div>';

    //        $prefix = get_post_meta(get_the_author_meta( 'pmsafe_member_code_id', $user_id ),'_pmsafe_code_prefix',true);
    $demo_benefit_prefix = esc_attr(get_option('pmsafe_demo_benefit_prefix'));
    if (!empty($demo_benefit_prefix)) {
        $myquery = new WP_Query("post_type=pmsafe_benefits&meta_key=_pmsafe_benefit_prefix&meta_value=$demo_benefit_prefix&order=ASC");
        $html .= $myquery->post->post_content;
    }
    //        $benefit_prefix_id = 1078;
    //        
    //        if(!empty($benefit_prefix_id)){        
    //            $html .= get_post_field('post_content',$benefit_prefix_id);
    //        }

    $html .= '</div>';

    //    echo $html;
    //    die;

    //                $html .= '<a href="" id="download-pdf" onclick="PrintElem('.'"'.'#perma-warranty-wrapper'.'"'.')">Download As a PDF</a>';
    //    $html .= '<input type="button" class="button button-primary button-large" value="Download As a PDF" id="pmsafe_pdf_btn"/>';

    return $html;
}

/**
 * 
 * @param type $user_id
 * @return stringWarranty card PDF
 */
function pmsafe_warranty_card_pdf($user_id, $member_code)
{
    $user = get_user_by('ID', $user_id);

    $pdf_email = get_the_author_meta('pmsafe_email', $user_id);

    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    $vehicle_info = $vehicle_info[$member_code];
    $post_id = $vehicle_info['pmsafe_member_code_id'];
    $benefits_package = get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
    $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);

    $dealer_login = get_post_meta($post_id, '_pmsafe_dealer', true);
    $dealers = get_user_by('login', $dealer_login);
    $dealer_id = $dealers->data->ID;
    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
    $dealer_address = get_user_meta($dealer_id, 'dealer_store_address', true);
    $dealer_phone = get_user_meta($dealer_id, 'dealer_phone_number', true);

    $price_arr = get_user_meta($dealer_id, 'pricing_package', true);
    $selling_price = $price_arr[$benefits_package]['selling_price'];
    $updated_selling_price = get_post_meta($post_id, 'updated_selling_price', true);

    if ($updated_selling_price) {
        $selling_price = $updated_selling_price;
    } else {
        if ($selling_price) {
            $selling_price = $selling_price;
        } else {
            $selling_price = 0;
        }
    }

    $html = '';

    $html .= '<div id="perma-warranty-wrapper">';

    $html .= '<div id="perma-warranty-form">';
    $html .= '<div style="color: #000;font-weight: 600;text-align: center;">';
    $html .= '<img src="' .  plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png" style="width: auto;height: 45px;" />';

    $html .= '<div style="font-family: Libre Franklin;font-size: 17px;line-height: normal;margin-bottom: 0px;color: #000;font-weight: bold;">PermaSafe Limited Warranty Registration</div>';
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 2px;font-size: 15px;">Customer Information</div>';
    $html .= '</div>';

    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="width:80%; margin:0 auto;">';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;font-weight: bold;text-align: right;">Name:</div><div style="font-family: Libre Franklin;display: inline-block; margin-left:10px; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px;  color: #555; padding: 5px;">' . esc_attr(get_the_author_meta('first_name', $user_id)) . ' ' . esc_attr(get_the_author_meta('last_name', $user_id)) . '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;display: block;width: 100%; margin-bottom: 3px;">';
    $address1 = get_the_author_meta('pmsafe_address_1', $user_id);
    $address2 = get_the_author_meta('pmsafe_address_2', $user_id);
    if (!empty($address1) || $address2) {
        $address = $address1 . ', ' . $address2;
    }
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;font-weight: bold;text-align: right;">Address:</div><div style="margin-left:10px; font-family: Libre Franklin;display: inline-block; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px;  color: #555; padding: 5px;">' . $address . '</div>';
    $html .= '<div style="font-family: Libre Franklin;float:left; width: 30%;">&nbsp;&nbsp;&nbsp;&nbsp;</div><div style="margin-left:10px; font-family: Libre Franklin;display: inline-block; float:left;width: 65%;box-shadow: none; border: 0; background: #f4f4f4; font-weight: 400; font-size: 12px; line-height: 20px; color: #555; padding: 5px;">' . esc_attr(get_the_author_meta('pmsafe_city', $user_id)) . ' ' . esc_attr(get_the_author_meta('pmsafe_state', $user_id)) . ' ' . esc_attr(get_the_author_meta('pmsafe_zip_code', $user_id)) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 30%;text-align: right;">Phone:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;">' . phone_number_format(get_the_author_meta('pmsafe_phone_number', $user_id)) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 30%;text-align: right;">Email:</div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $pdf_email . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left;  width: 30%;text-align: right;">Registration Date:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 65%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 35%;text-align: right;">Signature: X</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 60%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr(get_the_author_meta('pmsafe_signature', $user_id)) . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;padding-bottom: 0px;margin-bottom: 0px;"><b>PERMASAFE PROTECTIVE COATINGS, LLC ("PPC"), offers a Limited Product Warranty ("Warranty") for specific vehicle surfaces treated with PERMASAFE SURFACE PROTECTION PRODUCTS. The Warranty is subject to all terms and conditions set forth in this registration form.</b></div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;padding-bottom: 0px;margin-bottom: 0px;">By electronically signing above, I hereby acknowledge that I have read this <b>Warranty</b> registration form completely, understand and consent to the terms and conditions and my obligations under the <b>Warranty</b>, and have received a complete copy of the <b>Warranty</b>. I certify that my electronic signature shall have the same legal effect as an originally signed document under applicable federal or state electronic signature laws.</div>';
    $html .= '</div>';

    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Vehicle and Sale Information</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Year:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_vehicle_year']) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Make:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_vehicle_make']) . '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%; text-align: right;">Model:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_vehicle_model']) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Mileage at Application: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_vehicle_mileage']) . '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';

    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Applied Date:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Product Purchase Price: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >$' . $selling_price . '</div>';
    $html .= '</div>';

    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 40%;text-align: right;">Vehicle Type:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 50%;box-shadow: none;border: 0;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >';
    if ($vehicle_info['pmsafe_vehicle_type'] == "new") {
        $html .= '<img style="margin-bottom:-8px;" src="https://permasafe.com/wp-content/uploads/2019/06/checked.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-8px;" src="https://permasafe.com/wp-content/uploads/2019/06/check.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    if ($vehicle_info['pmsafe_vehicle_type'] == "preowned") {
        $html .= '<img style="margin-bottom:-8px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/check.png"><span style="font-size:15px;"> New </span> &nbsp; <img style="margin-bottom:-8px;" src="' . plugins_url() . '/permasafe-user-pro/public/images/checked.png"> <span style="font-size:15px;"> Preowned </span>';
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">VIN: </div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_vin']) . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    // dealership info
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Dealership Information</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';

    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">Name:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $dealer_name . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left; margin-bottom: 3px;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 20%;text-align: right;">Phone:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 70%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . phone_number_format($dealer_phone) . '</div>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '<div style="display: block;width: 100%;">';
    $html .= '<div style="display: block;width: 100%;float: left; margin-bottom: 3px;">';

    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left;text-align:right;width:12%;">Address:</div> 
                        <div style="margin-left:10px;font-family: Libre Franklin;float:left;width: 80%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . $dealer_address . '</div>';
    $html .= '</div>';

    $html .= '</div>';


    $html .= '</div>';
    $html .= '</div>';

    $html .= '<div style="font-family: Libre Franklin;color: #000;font-weight: bold;text-align: center;margin-bottom: 5px;font-size: 15px;">Limited Warranty Terms and Conditions</div>';
    $html .= '<div style="width: 960px;margin-bottom: 5px;padding: 5px;border: 2px solid #1565a9;">';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 10px;">';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Warranty Registration #:</div> <div style="margin-left:10px; font-family: Libre Franklin;float:left;width:30%;box-shadow:none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . esc_attr($vehicle_info['pmsafe_member_number']) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Plan ID: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 20px;color: #555;padding: 5px;" >' . get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true) . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 100%; margin-bottom: 15px;">';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Registration Date: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left;width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 16px;color: #555;padding: 5px;">' . date('Y-m-d', strtotime($vehicle_info['pmsafe_registration_date'])) . '</div>';
    $html .= '</div>';
    $html .= '<div style="display: block;width: 50%;float: left;">';
    $html .= '<div style="font-family: Libre Franklin;font-weight: bold;float:left; width: 60%;text-align: right;">Expiration Date: </div><div style="margin-left:10px; font-family: Libre Franklin;float:left; width: 30%;box-shadow: none;border: 0;background: #f4f4f4;font-weight: 400;font-size: 12px;line-height: 16px;color: #555;padding: 5px;" >' . date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info['pmsafe_registration_date']))) . '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div style="font-family: Libre Franklin;color: #000;font-size: 12px;text-align: center;font-weight: bold;">IF YOU HAVE ANY QUESTIONS REGARDING THIS WARRANTY OR FILING<br/>A CLAIM CONTACT WARRANTOR AT: (866) 372-9622</div>';
    $html .= '<div style="font-family: Libre Franklin;background: #000;width: 100%;display: block;text-align: center;color: #fff;font-size: 13px;">I. DEFINITIONS</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">ADMINISTRATOR/WARRANTOR ("WE," "US," "OUR"):</u> PERMASAFE PROTECTIVE COATINGS ("PPC"), 4613 North University Drive #470, Coral Springs, FL 33067, 866-372-9622,</b> who is the <b style="font-size: 12px;color: #000;">Warrantor</b> to this <b style="font-size: 12px;color: #000;">Warranty</b>, or any successor Warrantor designated by <b style="font-size: 12px;color: #000;">PPC</b> from time to time.</div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">DEALER:</u></b> the dealership identified above under <b style="font-size: 12px;color: #000;">Dealership Information.</b></div>';
    $html .= '<div style="font-family: Libre Franklin;font-size: 12px;color: #000;"><b style="font-size: 12px;color: #000;"><u style="font-size: 12px;color: #000;">YOU OR YOUR:</u></b> the customer identified above under <b style="font-size: 12px;color: #000;">Customer Information.</b></div>';

    $html .= '</div>';


    $html .= '</div>';



    return $html;
}

// add_action('init','test_pdf');
function test_pdf()
{

    include_once(plugin_dir_path(__DIR__) . 'includes/MPDF/mpdf.php');

    ob_start();  // start output buffering
    $mpdf = new mPDF();

    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/';

    if (is_dir($dir) === false) {
        mkdir($dir);
    }

    $pdf_name = 'perma_warranty_' . $user_id . '_' . time();
    $dir = plugin_dir_path(__DIR__) . '/upload-pdf/' . $pdf_name . '.pdf';

    //    $user_id = get_current_user_id();
    $me_data = "";
    $me_data .= pmsafe_warranty_card_pdf(581, 118);

    $mpdf->debug = true;
    $mpdf->SetDisplayMode('fullpage');
    //    $stylesheet = file_get_contents('https://permasafe.net/wp-content/plugins/permasafe-user-pro/public/css/permasafe-user-pro-public.css?ver=1528874605');
    //    $mpdf->WriteHTML($stylesheet,1);
    $mpdf->WriteHTML($me_data);

    $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
    $vehicle_info = $vehicle_info[$member_code];

    $prefix = get_post_meta($vehicle_info['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    //    $new_pdf = plugin_dir_path( __DIR__ ). 'upload-pdf/example_4.pdf';
    $new_pdf = get_benefit_pdf_url($prefix);

    // Apend another PDF
    if (!empty($new_pdf)) {
        $mpdf->SetImportUse();
        $pagecount = $mpdf->SetSourceFile($new_pdf);

        for ($i = 1; $i <= ($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
        }
    }

    $mpdf->Output();
    ob_end_flush();

    $pdf_link = plugins_url('permasafe-user-pro') . '/upload-pdf/' . $pdf_name . '.pdf';
    echo $pdf_link;

    die;
}


// add_action('init','contact_user_mail');
function send_mail_to_users($to, $password, $subject, $fname = '', $member_code = '', $process = '')
{

    $to = $to;
    $subject = $subject;
    $fname = $fname;
    $member_code = $member_code;
    $process = $process;


    $message = '<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">';

    $message .= '<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 2px solid #0065a7;" bgcolor="#fff">';
    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">';

    $message .= '<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;text-align: center;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= '<img src="' . plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png">';
    $message .= '<hr style="border-top:1px solid #0065a7;"/>';
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 20px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= 'Account Details:';
    $message .= '</td>';
    $message .= '</tr>';

    if ($process == 'customer_registration') {

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'Hello <b>' . $fname . '</b>,';
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'Thank you for registering with PermaSafe!';
        $message .= '</td>';
        $message .= '</tr>';
    } else {

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'Here is your <b>Username</b> : <span style="color:#0065a7">' . $member_code . '</span>';
        $message .= '</td>';
        $message .= '</tr>';
    }

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= 'Here is your <b>Password</b> : <span style="color:#0065a7">' . $password . '</span>';
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= 'To access your PermaSafe account click on below button.';
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= '<a href="' . get_site_url() . '/wp-login.php" target="_blank" class="btn-primary" itemprop="url" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #0065a7; margin: 0; border-color: #0065a7; border-style: solid; border-width: 10px 20px;">';
    $message .= 'Login';
    $message .= '</a>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    if ($process == 'customer_registration') {
        $message .= '<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">';
        $message .= '<table width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">';
        $message .= 'Thank you for choosing PermaSafe.';
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</div>';
    }
    $message .= '</div>';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    $mail = wp_mail($to, $subject, $message, $headers);
}


function get_user_by_dealer($dealer)
{

    $user = get_user_by('login', $dealer);
    $dealer_id = $user->ID;

    $args = array(
        'post_type' => 'pmsafe_bulk_invi',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            // 'relation' => 'AND',
            array(
                'key'     => '_pmsafe_dealer',
                'value'   => $dealer,
                'compare' => '=',
            ),

        ),
    );
    $posts = get_posts($args);

    foreach ($posts as $key => $value) {
        $post_id = $value->ID;
        $bulk_member = $value->post_title;
        $invitation_ids = get_post_meta($post_id, '_pmsafe_invitation_ids', true);

        $invitation_id = explode(',', $invitation_ids);
        $data = pmsafe_unused_code_count($post_id);
        $available = $data['total'] - $data['used'];

        if ($data['used'] != 0) {
            foreach ($invitation_id as $id) {

                $code_status = get_post_meta($id, '_pmsafe_code_status', true);

                if ($code_status == 'used') {

                    $benefits_package = get_post_meta($id, '_pmsafe_code_prefix', true);
                    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
                    $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);

                    $code = get_post_meta($id, '_pmsafe_invitation_code', true);

                    $pdf_link = get_post_meta($id, 'pmsafe_pdf_link', true);

                    $user = get_user_by('login', $code);

                    $user_id = $user->ID;

                    $address1 = get_the_author_meta('pmsafe_address_1', $user_id);
                    $address2 = get_the_author_meta('pmsafe_address_2', $user_id);
                    if (!empty($address1) || $address2) {
                        $address = $address1 . ', ' . $address2;
                    }
                    $city = get_the_author_meta('pmsafe_city', $user_id);
                    $state = get_the_author_meta('pmsafe_state', $user_id);
                    $zip_code = get_the_author_meta('pmsafe_zip_code', $user_id);

                    $phone_number = get_user_meta($user_id, 'pmsafe_phone_number', true);
                    $vehicle_information = get_the_author_meta('pmsafe_vehicle_info', $user_id);

                    $dealers = get_user_by('login', $dealer);
                    $dealer_id = $dealers->data->ID;
                    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                    $distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
                    $distributors = get_user_by('login', $distributor_login);
                    $distributor_id = $distributors->data->ID;
                    $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

                    $plan_id = get_post_meta($id, '_pmsafe_code_prefix', true);


                    $customer_name = $user->first_name . ' ' . $user->last_name;


                    $bulk_arr[] = array(
                        'user_id' => $user->ID,
                        'code' => $code,
                        'code_id' => $id,
                        'dealer_id' => $dealer_id,
                        'fname' => $user->first_name,
                        'bulk_member' => $bulk_member,
                        'lname' => $user->last_name,
                        'address' => $address . ' ' . $city . ', ' . $state . ', ' . $zip_code,
                        'pdf_link' => $pdf_link,
                        'email' => $user->user_email,
                        'phone' => $phone_number,
                        'dealer_name' => $dealer_name,
                        'distributor_name' => $distributor_name,
                        'vehicle_information' => $vehicle_information[$user->user_login]['pmsafe_vehicle_year'] . ' ' . $vehicle_information[$user->user_login]['pmsafe_vehicle_make'] . ' ' . $vehicle_information[$user->user_login]['pmsafe_vehicle_model'],
                        'vin' => $vehicle_information[$user->user_login]['pmsafe_vin'],
                        'package' => $plan_id,
                        'registration_date' => date('Y-m-d', strtotime($vehicle_information[$user->user_login]['pmsafe_registration_date'])),
                        'expiration_date' => date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_information[$user->user_login]['pmsafe_registration_date']))),
                        'date_time' => $vehicle_information[$user->user_login]['pmsafe_registration_date']
                    );
                }
            }
        }
    }
    // pr($bulk_arr);
    $invite_args = array(
        'post_type' => 'pmsafe_invitecode',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'meta_query' => array(
            // 'relation' => 'AND',
            array(
                'key'     => '_pmsafe_dealer',
                'value'   => $dealer,
                'compare' => '=',
            ),

        ),
    );
    $invite_posts = get_posts($invite_args);

    foreach ($invite_posts as $key => $value) {
        $id = $value->ID;
        $is_invite_code = get_post_meta($id, '_pmsafe_is_invite_code', true);
        $code_status = get_post_meta($id, '_pmsafe_code_status', true);
        if ($is_invite_code == 1 && $code_status == 'used') {

            $benefits_package = get_post_meta($id, '_pmsafe_code_prefix', true);
            $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
            $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);
            $code = get_post_meta($id, '_pmsafe_invitation_code', true);

            $pdf_link = get_post_meta($id, 'pmsafe_pdf_link', true);

            $user = get_user_by('login', $code);

            $user_id = $user->ID;

            $address1 = get_the_author_meta('pmsafe_address_1', $user_id);
            $address2 = get_the_author_meta('pmsafe_address_2', $user_id);
            if (!empty($address1) || $address2) {
                $address = $address1 . ', ' . $address2;
            }
            $city = get_the_author_meta('pmsafe_city', $user_id);
            $state = get_the_author_meta('pmsafe_state', $user_id);
            $zip_code = get_the_author_meta('pmsafe_zip_code', $user_id);

            $phone_number = get_user_meta($user_id, 'pmsafe_phone_number', true);
            $vehicle_information = get_the_author_meta('pmsafe_vehicle_info', $user_id);


            $plan_id = get_post_meta($id, '_pmsafe_code_prefix', true);

            $dealers = get_user_by('login', $dealer);
            $dealer_id = $dealers->data->ID;
            $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
            $distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
            $distributors = get_user_by('login', $distributor_login);
            $distributor_id = $distributors->data->ID;
            $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

            $customer_name = $user->first_name . ' ' . $user->last_name;
            $url = get_site_url() . '/wp-includes/images/media/document.png';

            $invite_arr[] = array(
                'user_id' => $user->ID,
                'code' => $code,
                'code_id' => $id,
                'dealer_id' => $dealer_id,
                'fname' => $user->first_name,
                'lname' => $user->last_name,
                'address' => $address . ' ' . $city . ', ' . $state . ', ' . $zip_code,
                'pdf_link' => $pdf_link,
                'email' => $user->user_email,
                'phone' => $phone_number,
                'dealer_name' => $dealer_name,
                'distributor_name' => $distributor_name,
                'vehicle_information' => $vehicle_information[$user->user_login]['pmsafe_vehicle_year'] . ' ' . $vehicle_information[$user->user_login]['pmsafe_vehicle_make'] . ' ' . $vehicle_information[$user->user_login]['pmsafe_vehicle_model'],
                'vin' => $vehicle_information[$user->user_login]['pmsafe_vin'],
                'package' => $plan_id,
                'registration_date' => date('Y-m-d', strtotime($vehicle_information[$user->user_login]['pmsafe_registration_date'])),
                'expiration_date' => date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_information[$user->user_login]['pmsafe_registration_date']))),
                'date_time' => $vehicle_information[$user->user_login]['pmsafe_registration_date']
            );
        }
    }
    if (empty($invite_arr)) {
        $customer_arr = $bulk_arr;
    } else if (empty($bulk_arr)) {
        $customer_arr = $invite_arr;
    } else {
        $customer_arr = array_merge($bulk_arr, $invite_arr);
    }

    return $customer_arr;
}



function objectsIntoArray($arrObjData, $arrSkipIndices = array())
{
    $arrData = array();

    // if input is object, convert into array
    if (is_object($arrObjData)) {
        $arrObjData = get_object_vars($arrObjData);
    }

    if (is_array($arrObjData)) {
        foreach ($arrObjData as $index => $value) {
            if (is_object($value) || is_array($value)) {
                $value = objectsIntoArray($value, $arrSkipIndices); // recursive call
            }
            if (in_array($index, $arrSkipIndices)) {
                continue;
            }
            $arrData[$index] = $value;
        }
    }
    return $arrData;
}

function phone_number_format($number)
{

    $number = preg_replace("/[^\d]/", "", $number);

    // get number length.
    $length = strlen($number);

    // if number = 10
    if ($length == 10) {
        $number = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "($1) $2-$3", $number);
    }

    return $number;
}

function reset_mail_format($user_id)
{
    $user = get_user_by('id', $user_id);


    $email = $user->user_email;
    $adt_rp_key = get_password_reset_key($user);
    $user_login = $user->user_login;
    // $rp_link = '<a href="' . wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user_login) . '">' . wp_login_url()."?action=rp&key=$adt_rp_key&login=" . rawurlencode($user_login) . '</a>';



    $message = '<div class="content" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">';
    $message .= '<table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 2px solid #0065a7;" bgcolor="#fff">';
    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-wrap" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">';

    $message .= '<table width="100%" cellpadding="0" cellspacing="0" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;text-align: center;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= '<img src="' . plugins_url() . '/permasafe-user-pro/public/images/PermaSafe-Logo-small.png">';
    $message .= '<hr style="border-top:1px solid #0065a7;"/>';
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 20px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= 'Hello!';
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= sprintf(__('You asked us to reset your password for your account using the <b>Username</b> %s.', 'personalize-login'), '<span style="color:#0065a7">' . $user_login . '</span>');
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= __("If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'personalize-login');
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .=  __('To reset your password, click the following button:', 'personalize-login');
    $message .= '</td>';
    $message .= '</tr>';

    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
    $message .= '<a href="' . wp_login_url() . "?action=rp&key=$adt_rp_key&login=" . rawurlencode($user_login) . '" class="btn-primary" itemprop="url" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #0065a7; margin: 0; border-color: #0065a7; border-style: solid; border-width: 10px 20px;">';
    $message .= 'Reset Password';
    $message .= '</a>';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';

    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '<div class="footer" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">';
    $message .= '<table width="100%" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
    $message .= '<td class="aligncenter content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">';
    $message .= 'Thank you for choosing PermaSafe.';
    $message .= '</td>';
    $message .= '</tr>';
    $message .= '</table>';
    $message .= '</div>';
    $message .= '</div>';

    //deze functie moet je zelf nog toevoegen. 
    $subject = __("Password Reset ");
    $headers = array();

    add_filter('wp_mail_content_type', function ($content_type) {
        return 'text/html';
    });

    wp_mail($email, $subject, $message);


    // Reset content-type to avoid conflicts -- http://core.trac.wordpress.org/ticket/23578
    remove_filter('wp_mail_content_type', 'set_html_content_type');
}

function view_data_reports($id)
{
    $user_id = $id;
    $nickname = get_user_meta($user_id, 'nickname', true);
    $vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
    // pr($vehicle_info);
    $post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
    $benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
    $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);

    $login = get_post_meta($post_id, '_pmsafe_dealer', true);
    $users = get_user_by('login', $login);
    $dealer_id = $users->ID;
    $dealername = get_user_meta($dealer_id, 'dealer_name', true);
    $expiration_date = date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
    // $expiration_date = '2019-04-07';
    $current_date = date('Y-m-d');


    echo '<div class="view-data-wrap">';
    echo '<h3>Customer Details</h3>';
    echo '<p class="expired">EXPIRED ON ' . $expiration_date . '</p>';
    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Member Code : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'nickname', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>First Name : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'first_name', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Last Name : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'last_name', true) . '</p>';
    echo '</div>';
    echo '</div>';

    $address1 = get_user_meta($user_id, 'pmsafe_address_1', true);
    $address2 = get_user_meta($user_id, 'pmsafe_address_2', true);

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Address : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $address1 . ' ' . $address2 . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>City : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'pmsafe_city', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>State : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'pmsafe_state', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Zip Code : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'pmsafe_zip_code', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Phone : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . phone_number_format(get_user_meta($user_id, 'pmsafe_phone_number', true)) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Email : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_user_meta($user_id, 'pmsafe_email', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Dealer </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $dealername . ' ( ' . $login . ' )' . '</p>';
    echo '</div>';
    echo '</div>';


    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Vehicle Year : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Vehicle Make : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Vehicle Model : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'] . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Vehicle VIN : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . $vehicle_info[0][$nickname]['pmsafe_vin'] . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Registration Date : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Plan ID : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    echo '<p>' . get_post_meta($post_id, '_pmsafe_code_prefix', true) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '<div class="view-data-wrap-inner">';
    echo '<div class="label-input">';
    echo '<label>Status : </label>';
    echo '</div>';
    echo '<div class="input-div">';
    if ($current_date > $expiration_date) {

        echo '<p class="expired">Expired</p>';
    } else {
        echo '<p class="active">Active</p>';
    }
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
