<?php
$action = $_GET['action'];
$dealer_id = $_GET['dealer'];

$dealer_name = get_user_meta( $dealer_id, 'dealer_name' , true );

class PMSafe_Bulk_Invitation{
    
    public function __construct() {

            add_action( 'init', array( $this, 'pmsafe_create_bulk_invitation_posttype' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_invitecode_metaboxes' ) );
            add_action( 'save_post' , array( $this,'pmsafe_save_invitecode_meta'),10,2 );
            add_action( 'manage_pmsafe_bulk_invi_posts_columns' , array( $this,'set_custom_columns'),10,1 );
            add_action( 'manage_pmsafe_bulk_invi_posts_custom_column' , array( $this,'custom_columns'),10,2 );
            add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 10, 1 );
            
            add_action('restrict_manage_posts', array( $this,'add_dealer_tablenav'));
            add_filter( 'parse_query', array( $this,'prefix_dealer_filter') );
            
            add_action('restrict_manage_posts', array( $this,'add_distributor_tablenav'));
            add_filter( 'parse_query', array( $this,'prefix_distributor_filter') );
            
            add_action('admin_head-post.php', array( $this,'hide_publishing_actions_edit_post'));
            add_action('admin_head-post-new.php', array( $this,'hide_publishing_actions_new_post'));
            add_action('wp_trash_post', array( $this,'pmsafe_wp_trash_post'));

            add_action( 'wp_ajax_get_dealers', array($this, 'get_dealers' ));
            add_action( 'wp_ajax_nopriv_get_dealers', array($this, 'get_dealers' ));

            add_action( 'wp_ajax_update_batch_codes', array($this, 'update_batch_codes' ));
            add_action( 'wp_ajax_nopriv_update_batch_codes', array($this, 'update_batch_codes' ));
            
            add_action( 'wp_ajax_delete_batch_codes', array($this, 'delete_batch_codes' ));
            add_action( 'wp_ajax_nopriv_delete_batch_codes', array($this, 'delete_batch_codes' ));

            add_action( 'wp_ajax_get_csv_data', array($this, 'get_csv_data' ));
            add_action( 'wp_ajax_nopriv_get_csv_data', array($this, 'get_csv_data' ));
            
            add_action( 'wp_ajax_check_code_exist', array($this, 'check_code_exist' ));
            add_action( 'wp_ajax_nopriv_check_code_exist', array($this, 'check_code_exist' ));

            add_action( 'wp_ajax_upgradable_dropdown', array($this, 'upgradable_dropdown' ));
            add_action( 'wp_ajax_nopriv_upgradable_dropdown', array($this, 'upgradable_dropdown' ));

            add_filter( 'post_updated_messages', array( $this,'change_post_updated_messages'), 10, 1 );
            
            add_filter("posts_orderby", array( $this,'change_orderby_filter'), 10, 2);
            
            add_action( 'pre_get_posts', array( $this,'extend_admin_search') );

            add_filter( 'views_edit-pmsafe_bulk_invi', array( $this,'export_dealer_csv_function' ));
            add_filter( 'views_edit-pmsafe_bulk_invi', array( $this,'total_range_codes' ));
            add_action( 'admin_head-edit.php', array ( $this, 'move_export_dealer_csv_function' ));
            add_action('admin_footer',array($this, 'disable_enter_key_event'));
    }

    public function disable_enter_key_event(){
        $post_type = $_GET['post_type']; 
        if($post_type == 'pmsafe_bulk_invi'){
            ?>
                <script type="text/javascript">

                jQuery(document).on("keypress",'[name="post"]', function(event) {
                // jQuery(document).keypress(function(event){
                    var keycode = (event.keyCode ? event.keyCode : event.which);
                    if(keycode == '13'){
                        event.preventDefault();
                        return false;	
                    }
                });
                </script>
            <?php
        }

    }
    public function export_dealer_csv_function( $views )
    {   
            $export = $_GET['export'];
            $dealer_login = $_GET['dealer_list'];
            $dealer_user = get_user_by('login',$dealer_login);
            $dealer_id = $dealer_user->data->ID;
            $dealer_name = get_user_meta( $dealer_id, 'dealer_name' , true );

            if($export == '1'){
                echo '<style type="text/css">.page-title-action { display:none; }</style>';
                $views['my-button'] = '<input type="submit" id="export-dealer-csv" title="CSV" value="Export to CSV"  style="margin:5px" /><input type="hidden" id="hdn_dealer_login" value="'.$dealer_login.'"><input type="hidden" id="hdn_dealer_name" value="'.$dealer_name.'">';
                if(!empty($_GET['row_action'])){
                    $views['btn-code-redirect'] = '<a id="back_link" href="'.admin_url('admin.php?page=dealers-lists&row_action='.$_GET['row_action']).'" data-action="'.$_GET['row_action'].'">Back to Dealer List</a>';
                }else{
                    $views['btn-code-redirect'] = '<a id="back_link" href="'.admin_url('admin.php?page=dealers-lists&action=view&dealer='.$dealer_id).'">Back to Dealer</a>';
                }
                return $views;
            }
            else{
                return $views;
            }
    }

    public function pdfscript(){
        ?>
       <script type="text/javascript">
        var specialElementHandlers = {
          // element with id of "bypass" - jQuery style selector
          '.no-export': function(element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true;
          }
        };
        function pdfExport(){
            var doc = new jsPDF('p', 'pt', 'a4');
            var source = document.getElementById('posts-filter').innerHTML;

              var margins = {
                top: 10,
                bottom: 10,
                left: 10,
                width: 800
              };

              doc.fromHTML(
                source, // HTML string or DOM elem ref.
                margins.left,
                margins.top, {
                  'width': margins.width,
                  'elementHandlers': specialElementHandlers
                },

                function(dispose) {
                  // dispose: object with X, Y of the last line add to the PDF 
                  //          this allow the insertion of new lines after html
                  doc.save('Test.pdf');
                }, margins);
            
        }
        </script>
    <?php

    }


    public function total_range_codes ($views){
        $dealer_login = $_GET['dealer_list'];
        
        if($_GET['filter_action'] == 'Filter' || $_GET['export'] == '1'){
                         $dealer_user = get_user_by('login',$dealer_login);
                        $dealer_id = $dealer_user->data->ID;
                        $dealer_name = get_user_meta( $dealer_id, 'dealer_name' , true );
                        

                            $args = array(
                                'post_type' => 'pmsafe_bulk_invi',
                                'post_status' => 'publish',
                                'posts_per_page' => -1,
                                'meta_query' => array(
                                    array(
                                        'key'     => '_pmsafe_dealer',
                                        'value'   => $dealer_login,
                                        'compare' => '=',
                                    ),
                                   
                                ),
                            );
                            $posts = get_posts($args);
                            if($posts){
                                foreach ($posts as $key => $value) {
                                    $post_id = $value->ID;
                                    
                                    $dealers = get_user_by('login', $dealer_login);
                                    $dealer_id = $dealers->data->ID;
                                    $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);

                                    $data = pmsafe_unused_code_count($post_id);
                                    $used_code = $data['used'];
                                    $available = $data['total'] - $data['used'];
                                    $total += $data['total'];
                                    $total_used += $data['used'];
                                    $total_available += $available;
                                }
                                $views['total-code'] .= 'Total Codes Assigned: <span>'.$total.'</span>';
                                $views['used-code'] = 'Total Registered: <span>'.$total_used.'</span>';
                                $views['unused-code'] = 'Total Unregistered: <span>'.$total_available.'</span>';
                            }
            return $views;
        }
        else
        {
            return $views;
        }
    }
    

    public function move_export_dealer_csv_function()
    {
        global $current_screen;
        // Not our post type, exit earlier
        if( 'pmsafe_bulk_invi' != $current_screen->post_type )
            return;
        ?>
        <script type="text/javascript">
            jQuery(document).ready( function(jQuery) 
            {
                jQuery('#export-dealer-csv').prependTo('span.displaying-num');    
                jQuery('#back_link').prependTo('span.displaying-num');    
                jQuery(document).find('.no-pages').removeClass('no-pages').addClass('one-page');
            });     
        </script>
        <?php 
    }

    public function get_csv_data(){
       

        $dealer_login = $_POST['dealer_login'];
        $args = array(
            'post_type' => 'pmsafe_bulk_invi',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'meta_query' => array(
                array(
                    'key'     => '_pmsafe_dealer',
                    'value'   => $dealer_login,
                    'compare' => '=',
                ),
               
            ),
        );
        $posts = get_posts($args);
        $response = '';
        $response .= "Member code,Benefits Package,Dealer,Distributor,Date Created,Used Count,Role\r\n";
        foreach ($posts as $key => $value) {
            $post_id = $value->ID;
            $member_code = $value->post_title;
            $benefits_package = get_post_meta( $post_id, '_pmsafe_invitation_prefix', true );
            $dealers = get_user_by('login', $dealer_login);
            $dealer_id = $dealers->data->ID;
            $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
            $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
            $distributors = get_user_by('login', $distributor_login);
            $distributor_id = $distributors->data->ID;
            $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
            $date_created = get_post_meta( $post_id, '_pmsafe_code_create_date', true );
            $data = pmsafe_unused_code_count($post_id);
            $used_code = $data['used'];
            $role =  get_post_meta( $post_id, '_pmsafe_user_role', true );
            if($role == 'subscriber'){
                $nisl_role = 'Customer';
            }elseif($role == 'editor'){
                $nisl_role = 'Editor';
            }elseif($role == 'contributor'){
                $nisl_role = 'Dealer';
            }elseif($role == 'author'){
                $nisl_role = 'Distributor';
            }elseif($role == 'administrator'){
                $nisl_role = 'Administrator';
            }else{
                $nisl_role = $role;
            }
            $response .= $member_code.','.$benefits_package.','.$dealer_name.','.$distributor_name.','.$date_created.','.$used_code.','.$nisl_role."\r\n";
            
        }
        echo $response;
        die;
    }   

     public function check_code_exist(){
        global $wpdb;
        $start = $_POST['start'];
        $end = $_POST['end'];
        $key = '_pmsafe_bulk_invitation_code';
        $start_post_id = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code',$start);
        $end_post_id = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code',$end);
       
        
        if($start_post_id || $end_post_id){
             $response = array('status' => true);
        }
        else{
          $response = array('status' => false);   
        }
        echo json_encode($response);

        die;

     }

    public function pmsafe_create_bulk_invitation_posttype(){
            $labels = array(
                'name'               => _x( 'Batch Member Code', 'post type general name', '' ),
                'singular_name'      => _x( 'Batch Member Code', 'post type singular name', '' ),
                'menu_name'          => _x( 'Batch Member Codes', 'admin menu', '' ),
                'name_admin_bar'     => _x( 'Batch Member Codes', 'add new on admin bar', '' ),
                'add_new'            => _x( 'Add New', 'Batch Member Code', '' ),
                'add_new_item'       => __( 'Add New Batch Member Code', '' ),
                'new_item'           => __( 'New Batch Member Code', '' ),
                'edit_item'          => __( 'Edit Batch Member Code', '' ),
                'view_item'          => __( 'View Batch Member Code', '' ),
                'all_items'          => __( 'Batch Member Codes', '' ),
                'search_items'       => __( 'Search Batch Member Codes', '' ),
                'parent_item_colon'  => __( 'Parent Batch Member Code:', '' ),
                'not_found'          => __( 'No Batch Member Codes found.', '' ),
                'not_found_in_trash' => __( 'No Batch Member Codes found in Trash.', '' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', '' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => 'pmsafe-bulk-invi',
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'pmsafe_bulk_invi' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title' )
            );

            register_post_type( 'pmsafe_bulk_invi', $args );
    }

    public function add_invitecode_metaboxes() {
            add_meta_box('pmsafe_invitation_code_information', 'Member Code Information', array($this,'pmsafe_invitation_code_information'), 'pmsafe_bulk_invi', 'normal', 'high');
    }

    public function pmsafe_invitation_code_information(){
        $edit_action = $_GET['action'];

        // echo 'testing'.$edit_action;die;
            global $post;
           $post_id = $post->ID;

            wp_nonce_field( basename( __FILE__ ), 'pmsafe_post_class_nonce' );

            echo '<table class="form-table pmsafe-metabox-table">';
                $create_date = get_post_meta($post_id, '_pmsafe_code_create_date', true);
                if(empty($create_date)){
                    $create_date = current_time( 'mysql' );
                }
                echo '<input type="hidden" name="pmsafe_code_create_date" value="'.$create_date.'" />';
                echo '<input type="hidden" name="row_action" value="'.$_GET['row_action'].'" />';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>First Code in Range</strong></label>';
                    echo '</th>';
                    echo '<td>';
                    if($edit_action == 'edit'){
                        echo '<input type="number" name="pmsafe_invitation_code_start" id="pmsafe_invitation_code_start" value="' . get_post_meta($post_id, '_pmsafe_invitation_code_start', true)  . '" class="widefat" disabled/>';
                    }
                    else{
                     echo '<input type="number" name="pmsafe_invitation_code_start" id="pmsafe_invitation_code_start" value="' . get_post_meta($post_id, '_pmsafe_invitation_code_start', true)  . '" class="widefat" />';   
                    }
                    echo '</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Last Code in Range</strong></label>';
                    echo '</th>';
                    echo '<td>';
                    if($edit_action == 'edit'){
                        echo '<input type="number" name="pmsafe_invitation_code_end" id="pmsafe_invitation_code_end" value="' . get_post_meta($post_id, '_pmsafe_invitation_code_end', true)  . '" class="widefat" disabled/>';
                    }
                    else{
                        echo '<input type="number" name="pmsafe_invitation_code_end" id="pmsafe_invitation_code_end" value="' . get_post_meta($post_id, '_pmsafe_invitation_code_end', true)  . '" class="widefat" /><span class="code-exist" style="display:none;">This member code already exists. Please enter valid codes.</span><span class="code-range" style="display:none;">First code in the range should smaller than the last code in the range.</span>';
                    }
                    echo '</td>';
                echo '</tr>';

                $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
                
              

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Benefits Package</strong><span>Select the benefits package these member codes will assign to the customer.</span></label>';
                    echo '</th>';
                    
                    echo '<td>';
                    
                        if(!empty($benefit_prefix)){
                            echo '<select name="pmsafe_invitation_prefix" id="pmsafe_invitation_prefix">';
                                foreach ($benefit_prefix as $prefix) {
                                    echo '<option value="'.$prefix.'" '. selected( get_post_meta($post_id,'_pmsafe_invitation_prefix',true), $prefix, false ) .'>'.$prefix.'</option>';
                                }
                            echo '</select>';
                        }
                    echo '</td>';
                echo '</tr>';
                
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Only Allow Dealers to Register</strong></label>';
                    echo '</th>';
                    echo '<td>';
                    $checked = get_post_meta($post_id,'pmsafe_code_allow_dealer',true);
                    if($edit_action == 'edit'){
                        if($checked == 1 ){
                            echo '<input type="checkbox" name="pmsafe_code_allow_dealer" id="pmsafe_code_allow_dealer" class="widefat" checked="true"/>';
                        }else{
                            echo '<input type="checkbox" name="pmsafe_code_allow_dealer" id="pmsafe_code_allow_dealer" class="widefat" />';
                        }
                    }else{
                        
                            echo '<input type="checkbox" name="pmsafe_code_allow_dealer" id="pmsafe_code_allow_dealer" class="widefat" />';
                        
                    }
                    echo '</td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Upgradable</strong></label>';
                    echo '</th>';
                    echo '<td>';
                    $checked = get_post_meta($post_id,'pmsafe_invitation_code_upgradable',true);
                    if($edit_action == 'edit'){
                        if($checked == 1 ){
                            echo '<input type="checkbox" name="pmsafe_invitation_code_upgradable" id="pmsafe_invitation_code_upgradable" class="widefat" checked="true"/>';
                        }else{
                            echo '<input type="checkbox" name="pmsafe_invitation_code_upgradable" id="pmsafe_invitation_code_upgradable" class="widefat" />';
                        }
                    }else{
                        
                            echo '<input type="checkbox" name="pmsafe_invitation_code_upgradable" id="pmsafe_invitation_code_upgradable" class="widefat" />';
                        
                    }
                    echo '</td>';
                echo '</tr>';

                if($edit_action == 'edit'){
                    if($checked == 1){
                        echo '<tr id="upgrade_tr">';
                            echo '<th>';
                                echo '<label><strong>Upgradable Benefits Package</strong></label>';
                            echo '</th>';
                            
                            echo '<td>';
                            
                            $upgradable_prefix_str = get_post_meta($post_id,'upgradable_prefix',true);
                            $upgradable_prefix_arr = explode(",",$upgradable_prefix_str);
                            $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
                            
                            $get_benifit_package = get_post_meta($post_id,'_pmsafe_invitation_prefix',true);
                            $i=1;
                            echo '<div id="upgradable_chklist">';
                                echo '<ul class="chklist-wrap">';
                                foreach ($benefit_prefix as $prefix) {
                                    $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                    $post = get_post($pid);
                                    $post_title = $post->post_title;
                                    if($prefix != $get_benifit_package){
                                        echo '<li>';
                                        
                                        echo '<input type="checkbox" id="chk-'.$i.'" name="pmsafe_invitation_upgradable_prefix" value="'.$prefix.'" '.( (in_array($prefix,$upgradable_prefix_arr)) ? "checked"   : "").'>';
                                        echo '<label for="chk-'.$i.'">'.$post_title.'</label>';
                                        echo '</li>';
                                        $i++;
                                    }
                                }
                                echo '</ul>';
                                
                            echo '</div>';
                                
                            echo '</td>';
                        echo '</tr>';
                        }else{
                            echo '<tr id="upgrade_tr" style="display:none;">';
                            echo '<th>';
                                echo '<label><strong>Upgradable Benefits Package</strong></label>';
                            echo '</th>';
                            
                            echo '<td>';
                            
                            echo '<div id="upgradable_chklist">';
                            echo '</div>';
                            
                                
                            echo '</td>';
                        echo '</tr>';
                        }
                }
                else{
                echo '<tr id="upgrade_tr" style="display:none;">';
                    echo '<th>';
                        echo '<label><strong>Upgradable Benefits Package</strong></label>';
                    echo '</th>';
                    
                    echo '<td>';
                             echo '<div id="upgradable_chklist">';
                            echo '</div>';
                    echo '</td>';
                echo '</tr>';
                }
                //  }

                echo '<tr style="display:none;">';
                    echo '<th>';
                        echo '<label><strong>Code Access Level</strong><span>This determines the website access for the new user. If you are unsure, leave this set to Customer.</span></label>';
                    echo '</th>';
                    echo '<td>';
                        global $wp_roles;
                        $all_roles = $wp_roles->roles;
                        
                        $filter_roles = array();
                        foreach ($all_roles as $key => $value) {
                            $filter_roles[$key] = $value["name"];
                        }
                        krsort($filter_roles);
                        echo '<select name="pmsafe_user_role">';
                            foreach ($filter_roles as $key => $value) {
                                echo '<option value="'.$key.'" '. selected( get_post_meta($post_id,'_pmsafe_user_role',true), $key, false ) .'>'.$value.'</option>';
                            }
                        echo '</select>';
                    echo '</td>';
                echo '</tr>';
                
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Distributor</strong></label>';
                    echo '</th>';
                    if($edit_action == 'addcode'){
                       
                        echo '<td>';
                            
                            echo '<select name="pmsafe_distributor">';
                                $dealer_login = $_GET['dealer'];
                                $dealer_user = get_user_by('ID',$dealer_login);
                                $dealer_id = $dealer_user->data->ID;
                                $distributor_id = get_user_meta( $dealer_id, 'dealer_distributor_name' , true );
                                    $user = get_user_by( 'ID', $distributor_id );
                                    $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
                                    echo '<option value="'.$user->data->user_login.'" '. selected( get_post_meta($post_id,'_pmsafe_distributor',true), $user->data->user_login, false ) .'>'.$distributor_name .' ('. $user->data->user_login .')</option>';
                            
                            echo '</select>';
                        echo '</td>';
                    }
                    else{
                       
                        echo '<td>';
                            $distributor_users = get_users( array('role' => 'author','fields' => array( 'ID','user_login' )));
                                foreach ( $distributor_users as $user ) {
                                    $distributor_id = $user->ID;
                                    $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
                                    $distributor_name_arr[$user->user_login] = $distributor_name;
                                }   
                                
                                asort($distributor_name_arr); 
                                
                            echo '<select name="pmsafe_distributor" id="pmsafe_distributor">';
                                echo '<option value="" disabled selected>Select distributor</option>';
                                foreach ( $distributor_name_arr as $key => $value ) {
                                    echo '<option value="'.$key.'" '. selected( get_post_meta($post_id,'_pmsafe_distributor',true), $key, false ) .'>'.$value .' ('. $key .')</option>';
                                }
                            echo '</select>';
                        echo '</td>';
                    }
                echo '</tr>';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Dealer</strong></label>';
                    echo '</th>';
                    $action = $_GET['action'];
                    $dealer_id = $_GET['dealer'];
                    $dealer_name = get_user_meta( $dealer_id, 'dealer_name' , true );
                    $distributor_id = get_user_meta( $dealer_id, 'dealer_distributor_name' , true );
                    if($edit_action == 'addcode'){
                        
                        echo '<td>';
                            echo '<select name="pmsafe_dealer">';
                                
                                    $user = get_user_by( 'ID', $dealer_id );
                                    
                                    echo '<option value="'.$user->data->user_login.'" '. selected( get_post_meta($post_id,'_pmsafe_dealer',true), $user->data->user_login, false ) .'>'.$dealer_name .' ('. $user->data->user_login.')</option>';
                                
                            echo '</select>';
                        
                    }else if($edit_action == 'edit'){
                        
                        echo '<td>';
                            $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
                            $distributors = get_user_by('login', $distributor_login);
                            $distributor_id = $distributors->data->ID;
                            $key = 'dealer_distributor_name';
        
                            global $wpdb;
                            $dealers = $wpdb->get_results("SELECT * FROM `".$wpdb->usermeta."` WHERE meta_key='".$key."' AND meta_value='".$distributor_id."'");
                             foreach ( $dealers as $user ) {
                                $contributor_id = $user->user_id;
                                $contributor_name = get_user_meta( $contributor_id, 'dealer_name' , true );
                                $dealer_user = get_user_by( 'ID', $contributor_id );
                                $username = $dealer_user->data->user_login;
                             $dealer_name_arr[$username] = $contributor_name;
                            }
                           
                            asort($dealer_name_arr);
                           
                            echo '<select name="pmsafe_dealer" id="pmsafe_dealer" >';
                                echo '<option value="">Select dealer</option>';
                                foreach ( $dealer_name_arr as $dealer_key => $dealer_value) {
                                    echo '<option value="'.$dealer_key.'" '. selected( get_post_meta($post_id,'_pmsafe_dealer',true), $dealer_key, false ) .'>'.$dealer_value .' ('. $dealer_key .')</option>';
                                }
                            echo '</select>';
                        
                    }
                    else
                    {
                        echo '<td>';
                            $contributor_users = get_users( array('role' => 'contributor','fields' => array( 'ID','user_login' )));

                            echo '<select name="pmsafe_dealer" id="pmsafe_dealer" disabled>';
                                echo '<option value="">Select dealer</option>';
                            echo '</select>';
                        echo '</td>';
                    }
                    
                echo '</tr>';
            echo '</table>';

            if($edit_action == 'edit'){
                echo '<input type="button" class="button button-primary button-large" id="update_code_button" value="Update"/>';
            }

    }

    public function get_dealers(){
        $distributor_login = $_POST['distributor_id'];
        $distributor_user = get_user_by('login',$distributor_login);
        $distributor_id = $distributor_user->data->ID;
        $key = 'dealer_distributor_name';
        // echo 'dis id is->'.$distributor_id;
        global $wpdb;
        $dealers = $wpdb->get_results("SELECT * FROM `".$wpdb->usermeta."` WHERE meta_key='".$key."' AND meta_value='".$distributor_id."'");
        foreach ($dealers as $key => $dealer) {
            $dealer_id = $dealer->user_id;
            $dealer_name = get_user_meta( $dealer_id, 'dealer_name' , true );
            $user = get_user_by( 'ID', $dealer_id );
            $username = $user->data->user_login;
            // echo $dealer_name.''.$username;
            $dealer_name_arr[$username] = $dealer_name;
        }
         
        asort($dealer_name_arr);
        
        if($dealers){
            echo '<option value="">Select Dealers</option>';
            foreach ($dealer_name_arr as $key => $value) {
                
                // echo $dealer_name.''.$username;
                echo '<option value="'.$key.'">'.$value.' ('. $key .')'.'</option>';
            }
        }else{
            echo '<option value="">- Dealer Name -</option>';
        }
      
        die;
    }

    public function update_batch_codes(){
    global $wpdb;
    
        $post_id = $_POST['post_id'];
        $code_access_level = $_POST['code_access_leval'];
        $benifit_package = $_POST['benifit_package'];
        $dealer = $_POST['dealer'];
        $distributor = $_POST['distributor'];
        $select = $_POST['prefix_arr'];
        
        $chk = $_POST['chk'];
        $allow_dealer = $_POST['allow_dealer'];
        $upgradable_prefix_str = implode(",",$select);
        
        $key = '_pmsafe_bulk_invitation_id';
        $updated_date = current_time( 'mysql' );
      
        $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$key."' AND meta_value='".$post_id."'");
        
        foreach ($meta as $key => $value) {
            $invitation_id = $value->post_id;
            $code_status = get_post_meta($invitation_id,'_pmsafe_code_status',true);
            update_post_meta( $invitation_id, '_pmsafe_dealer', $dealer );
            update_post_meta( $invitation_id, '_pmsafe_distributor', $distributor ); 
            update_post_meta( $invitation_id, '_pmsafe_date_updated', $updated_date ); 
            $invite_prefix = get_post_meta($invitation_id,'_pmsafe_invitation_prefix',true);
            if(empty($invite_prefix)){
                update_post_meta( $invitation_id, '_pmsafe_invitation_prefix', $benifit_package ); 
            }
            if($code_status == 'available'){
                update_post_meta( $invitation_id, '_pmsafe_code_prefix', $benifit_package ); 
                update_post_meta( $invitation_id, '_pmsafe_invitation_prefix', $benifit_package ); 
            }
            
        }
        
        update_post_meta( $post_id, '_pmsafe_user_role', $code_access_level );
        update_post_meta( $post_id, '_pmsafe_dealer', $dealer ); 
        update_post_meta( $post_id, '_pmsafe_distributor', $distributor ); 
        update_post_meta($post_id, '_pmsafe_date_updated', $updated_date );
        update_post_meta($post_id, '_pmsafe_invitation_prefix', $benifit_package );
        if($chk == 1)
        {
            update_post_meta($post_id, 'pmsafe_invitation_code_upgradable', 1 );
            update_post_meta($post_id, 'upgradable_prefix', $upgradable_prefix_str );
        }
        if($chk == 0)
        {
            delete_post_meta($post_id,'upgradable_prefix');
            update_post_meta($post_id, 'pmsafe_invitation_code_upgradable', 0 );
        }

        if($allow_dealer == 1)
        {
            update_post_meta($post_id, 'pmsafe_code_allow_dealer', 1 );
        }
        if($allow_dealer == 0)
        {
            update_post_meta($post_id, 'pmsafe_code_allow_dealer', 0 );
        }
        
        update_post_meta($post_id, '_pmsafe_invitation_prefix', $benifit_package );
        

        // $url = admin_url('edit.php?post_type=pmsafe_bulk_invi');
        $response = array('status'=>true);
        echo json_encode($response);
        die;
    }

    public function delete_batch_codes(){
        $post_id = $_POST['post_id'];
        wp_delete_post($post_id,true);
        global $wpdb;
        $key = '_pmsafe_bulk_invitation_id';
        $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$key."' AND meta_value='".$post_id."'");
        foreach ($meta as $key => $value) {
            $invitation_id = $value->post_id;
            $user_login = get_post_meta($invitation_id,'_pmsafe_invitation_code',true);
            $users = get_user_by('login',$user_login);
            $user_id = $users->ID;
        
            wp_delete_user( $user_id );
        
            wp_delete_post($invitation_id,true);
            delete_post_meta( $invitation_id, '_pmsafe_used_code_user_name' );
            delete_post_meta( $invitation_id, '_pmsafe_used_code_date' );
            delete_post_meta( $invitation_id, 'pmsafe_pdf_link' );
            delete_post_meta( $invitation_id, 'is_upgraded' );
            delete_post_meta( $invitation_id, 'upgraded_date' );
            delete_post_meta( $invitation_id, 'upgraded_by' );
            delete_post_meta( $invitation_id, 'updated_selling_price' );
            delete_post_meta( $invitation_id, 'updated_selling_price_by' );

        }
        
        $url = admin_url('edit.php?post_type=pmsafe_bulk_invi');
        $response = array('status'=>true,'redirect'=>$url);
        echo json_encode($response);
        die;
    }

    public function upgradable_dropdown(){
        $select = $_POST['select_val'];
        $edit_action = $_POST['edit_action'];
        $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
        echo '<ul class="chklist-wrap">';
        $i = 1;
        foreach ($benefit_prefix as $prefix) {
            $post_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
            $post = get_post($post_id);
            $post_title = $post->post_title;
            
            if($prefix != $select){
                // echo '<option value="'.$prefix.'">'.$post_title.'</option>';
                echo '<li>';
                if($edit_action){
                    echo '<input type="checkbox" name="pmsafe_invitation_upgradable_prefix" id="chk-'.$i.'" value="'.$prefix.'">';
                    echo '<label for="chk-'.$i.'">'.$post_title.'</label>';
                }else{
                   echo '<input type="checkbox" name="pmsafe_invitation_upgradable_prefix[]" id="chk-'.$i.'" value="'.$prefix.'">';
                   echo '<label for="chk-'.$i.'">'.$post_title.'</label>';
                }
                echo '</li>';
                $i++;
            }
        }
        echo '</ul>';
        die;
    }

    public function my_error_notice() {
        ?>
        <div class="error notice">
            <p><?php _e( 'There has been an error. Bummer!', 'my_plugin_textdomain' ); ?></p>
        </div>
        <?php
    }
    public function pmsafe_save_invitecode_meta($post_id, $post){

            global $wpdb;

            if($post->post_type != "pmsafe_bulk_invi")
                return;

            /* Verify the nonce before proceeding. */
            if ( !isset( $_POST['pmsafe_post_class_nonce'] ) || !wp_verify_nonce( $_POST['pmsafe_post_class_nonce'], basename( __FILE__ ) ) )
              return $post_id;


            // Is the user allowed to edit the post or page?
            if ( !current_user_can( 'edit_post', $post->ID ))
                    return $post->ID;


            $post_title = $_POST['pmsafe_invitation_code_start'].'-'.$_POST['pmsafe_invitation_code_end'];
           
            $prefix = $_POST['pmsafe_invitation_prefix'];
         
            $upgradable_prefix = $_POST['pmsafe_invitation_upgradable_prefix'];
            $upgradable_prefix_str = implode(",",$upgradable_prefix);
            
            

            if(!empty($prefix)){
                $post_title = $prefix.' : '.$post_title;
            }

            
            $timestamp = time();

            if(!empty($_POST['pmsafe_invitation_code_start']) && !empty($_POST['pmsafe_invitation_code_end']) ){
                

                $invitation_code_start = $_POST['pmsafe_invitation_code_start'];
                $invitation_code_end = $_POST['pmsafe_invitation_code_end'];
                $invitation_id = array();
                for ($invitation_code_start; $invitation_code_start<=$invitation_code_end; $invitation_code_start++) {
                    $name = sprintf('%s #%d', $post_title, ($invitation_code_start));
                    $invitecode_id = wp_insert_post(array (
                        'post_type' => 'pmsafe_invitecode',
                        'post_title' => $name,
                        'post_status' => 'publish',
                    ));
                    if($invitecode_id){
                        
                        
                        add_post_meta($invitecode_id, '_pmsafe_invitation_code',$invitation_code_start );
                        

                        if(!empty($_POST['pmsafe_user_role'])){
                            add_post_meta($invitecode_id, '_pmsafe_user_role', $_POST['pmsafe_user_role']);
                        }
                        add_post_meta($invitecode_id, '_pmsafe_code_status', 'available');
                        add_post_meta($invitecode_id, '_pmsafe_bulk_invitation_id', $post_id);
                        add_post_meta($invitecode_id, '_pmsafe_dealer', $_POST['pmsafe_dealer']);
                        add_post_meta($invitecode_id, '_pmsafe_distributor', $_POST['pmsafe_distributor']);
                        add_post_meta($invitecode_id, '_pmsafe_code_create_date', $_POST['pmsafe_code_create_date']);
                        add_post_meta($invitecode_id, '_pmsafe_code_prefix', $prefix);
                        add_post_meta($invitecode_id, '_pmsafe_invitation_prefix', $prefix);
                        add_post_meta($invitecode_id,'code_active_inactive',1);
                    }
                    
                    $updated_name = $_POST['pmsafe_invitation_code_start'].'-'.$_POST['pmsafe_invitation_code_end'].' #'.($i + 1).': '.get_post_meta($invitecode_id, '_pmsafe_invitation_code',true );
                    $update_post = array(
                        'ID'           => $invitecode_id,
                        'post_title'   => $updated_name,
                    );
                    wp_update_post( $update_post );
                     
                    $invitation_id[] = $invitecode_id;
                    
                }
                
                
                $title = $_POST['pmsafe_invitation_code_start'].'-'.$_POST['pmsafe_invitation_code_end'];
                $where = array( 'ID' => $post_id );
                $wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );
                
            }
            

            $invitation_meta['_pmsafe_invitation_code_start'] = $_POST['pmsafe_invitation_code_start'];
            $invitation_meta['_pmsafe_invitation_code_end'] = $_POST['pmsafe_invitation_code_end'];
            $invitation_meta['_pmsafe_dealer'] = $_POST['pmsafe_dealer'];
            $invitation_meta['_pmsafe_distributor'] = $_POST['pmsafe_distributor'];
            $invitation_meta['_pmsafe_invitation_prefix'] = $_POST['pmsafe_invitation_prefix'];
            $invitation_meta['code_active_inactive'] = 2;
            if(isset($_POST['pmsafe_invitation_code_upgradable'])){
                $invitation_meta['pmsafe_invitation_code_upgradable'] = 1;
            }
            if(isset($_POST['pmsafe_code_allow_dealer'])){
                $invitation_meta['pmsafe_code_allow_dealer'] = 1;
            }
            $invitation_meta['_pmsafe_code_create_date'] = $_POST['pmsafe_code_create_date'];
            $invitation_meta['upgradable_prefix'] = $upgradable_prefix_str;

            $invitation_meta['_pmsafe_user_role'] = $_POST['pmsafe_user_role'];
            $invitation_meta['_pmsafe_invitation_ids'] = $invitation_id;

            // Add values of $invitation_meta as custom fields

            foreach ($invitation_meta as $key => $value) { // Cycle through the $invitation_meta array!
                if( $post->post_type == 'revision' ) return; // Don't store custom data twice
                $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
                if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                    update_post_meta($post->ID, $key, $value);
                } else { // If the custom field doesn't have a value
                    add_post_meta($post->ID, $key, $value);
                }
                if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
            }

            $dealer_users = get_user_by('login',$_POST['pmsafe_dealer']);
            $dealer_id = $dealer_users->ID;

            
            if(!empty($_POST['row_action'])){
                $url = 'admin.php?page=dealers-lists&row_action='.$dealer_id;
            }else{
                $url = 'admin.php?page=dealers-lists&action=view&dealer='.$dealer_id;
            }
            wp_redirect($url);
            exit;
     
    }

    public function set_custom_columns($columns){        
        unset($columns['cb']);
        unset( $columns['title'] );
        unset( $columns['author'] );
        unset( $columns['date'] );
        $columns['inactive_batch']         = __( 'Inactive Batch', '' );
        $columns['invitation_code']         = __( 'Member code', '' );
        $columns['benefits_package']        = __( 'Benefits Package', '' );
        $columns['dealer']                  = __( 'Dealer', '' );
        $columns['distributor']             = __( 'Distributor', '' );
        $columns['date_create']             = __( 'Date created', '' );
        $columns['date_edit']             = __( 'Date edited', '' );
        $columns['count_unused_code']       = __( 'Count unused', '' );
        $columns['edit_code']       = __( 'Edit', '' );
        $columns['delete_code']       = __( 'Delete', '' );
        $columns['active_inactive']       = __( 'Active/Inactive', '' );

        return $columns;
    }

    public function custom_columns( $column, $post_id ) {
            switch ( $column ) {

                case 'inactive_batch':
                echo '<div class="chk_div">';
                 $batch_is_active = get_post_meta($post_id,'code_active_inactive',true);
                 if($batch_is_active == 0){
                    echo '<input type="checkbox" checked id="'.$post_id.'" value="'.$post_id.'" class="batch_cb"><label for="'.$post_id.'"></label>';
                 }
                 if($batch_is_active == 1 || $batch_is_active == 2){
                    echo '<input type="checkbox" id="'.$post_id.'" value="'.$post_id.'" class="batch_cb"><label for="'.$post_id.'"></label>'; 
                 }
                    
                echo '</div>';
                break;

                case 'count_unused_code':
                        $data = pmsafe_unused_code_count($post_id);
                        echo '<a href="#" title="'.$data['used'].' used out of '.$data['total'].'"><b><span style="color:red;">'.$data['used'].'</span>/<span style="color:green;">'.$data['total'].'</span></b></a>';
                        break;
                case 'dealer':
                        $dealer_login = get_post_meta( $post_id, '_pmsafe_dealer', true ); 
                        $dealers = get_user_by('login', $dealer_login);
                        $dealer_id = $dealers->data->ID;
                        $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
                        echo $dealer_name;
                        break;
                case 'distributor':
                        $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
                        $distributors = get_user_by('login', $distributor_login);
                        $distributor_id = $distributors->data->ID;
                        $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
                        echo $distributor_name;
                        break;
                case 'invitation_code':
                        $start_code = get_post_meta( $post_id, '_pmsafe_invitation_code_start', true ); 
                        $end_code = get_post_meta( $post_id, '_pmsafe_invitation_code_end', true );     
                        echo '<a href="'.admin_url().'edit.php?post_type=pmsafe_invitecode&bulk-invitation-id='.$post_id.'" target="_blank" class="button-secondary">'.$start_code .' - '. $end_code.'</a>'; 
                        break;
                case 'date_create':
                        echo get_post_meta( $post_id, '_pmsafe_code_create_date', true ); 
                        break;
                case 'date_edit':
                        echo get_post_meta( $post_id, '_pmsafe_date_updated', true ); 
                        break;
                case 'benefits_package':
                        echo '<code>'.get_post_meta( $post_id, '_pmsafe_invitation_prefix', true ).'</code>'; 
                        break;
                case 'edit_code':
                        echo '<a href="'.admin_url('post.php?post='.$post_id.'&action=edit').'"><i class="fa fa-edit" style="font-size:18px;"></i></a>'; 
                break;
                case 'delete_code':
                        echo '<i class="fa fa-trash" id="delete_code_button" style="cursor:pointer;color:#ff0000;font-size:18px;" data-id="'.$post_id.'"></i>';
                break;
                case 'active_inactive':// 0 = Inactive 1 = Mixed 2 = Active
                        $is_active = get_post_meta($post_id,'code_active_inactive',true);
                        echo '<input type="checkbox" class="jtoggler" disabled data-id="'.$post_id.'" data-val="'.$is_active.'" data-jtmulti-state>';
                break;
               
            }
    }
    
    public function remove_row_actions( $actions ){
        if( get_post_type() === 'pmsafe_bulk_invi' ){
            unset( $actions['edit'] );
            unset( $actions['trash'] );
        }
        return $actions;
    }
    
    public function hide_publishing_actions_edit_post(){
            $post_type = 'pmsafe_bulk_invi';
            global $post;
            if($post->post_type == $post_type){
                echo '
                    <style type="text/css">
                        #misc-publishing-actions,
                        #publishing-action,
                        #minor-publishing-actions{
                            display:none;
                        }
                    </style>
                ';
            }
    }
    
    public function hide_publishing_actions_new_post(){
            $post_type = 'pmsafe_bulk_invi';
            global $post;
            if($post->post_type == $post_type){
                echo '
                    <style type="text/css">
                        #misc-publishing-actions,
                        #minor-publishing-actions{
                            display:none;
                        }
                    </style>
                ';
            }
    }
    
    public function pmsafe_wp_trash_post($post_id){
            $post_type = get_post_type( $post_id );
            $post_status = get_post_status( $post_id );
            if( $post_type == 'pmsafe_bulk_invi' && in_array($post_status, array('publish')) ) {
                $invitation_id = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
                if(!empty($invitation_id)){
                    $invitation_id = explode(',',$invitation_id);
                    foreach ($invitation_id as $id) {
                        wp_delete_post($id);
                    }
                }
            }
    }
    
    public function change_post_updated_messages( $messages ){
            $messages['pmsafe_bulk_invi'] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __('Member Code updated.'),
                2 => __('Custom field updated.'),
                3 => __('Custom field deleted.'),
                4 => __('Member Code updated.'),
                /* translators: %s: date and time of the revision */
                5 => isset($_GET['revision']) ? sprintf( __('Member Code restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
                6 => __('Member Code Created.'),
                7 => __('Member Code saved.'),
                8 => __('Member Code submitted.'),
                9 => __('Member Code scheduled for:'),
                10 => __('Member Code draft updated.'),
            );
            return $messages;
    }
    
    public function change_orderby_filter($orderby, &$query){
            global $wpdb;
            //figure out whether you want to change the order
            if (get_query_var("post_type") == "pmsafe_bulk_invi") {
                 return "$wpdb->posts.ID DESC";
            }
            return $orderby;
    }
    
    
    public function add_dealer_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_bulk_invi')
                return;

            $results = get_users( array('role' => 'contributor','fields' => array( 'user_login', 'display_name' )));

            /** Ensure there are options to show */
            if(empty($results))
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="">%1$s</option>', __('Dealer list', ''));
            foreach($results as $result) :
                $dealers = get_user_by('login', $result->user_login);
                $dealer_id = $dealers->data->ID;
                $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
                
                $options[] = sprintf('<option value="%1$s">%2$s</option>', $result->user_login, $dealer_name);
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="pmsafe_dealer" name="dealer_list">';
            echo join("\n", $options);
            echo '</select>';

    }
    
    public function  prefix_dealer_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_bulk_invi' == $current_page && 'edit.php' == $pagenow && isset( $_GET['dealer_list'] ) && $_GET['dealer_list'] != '') {

                $dealer_list = $_GET['dealer_list'];
                $query->query_vars['meta_key'] = '_pmsafe_dealer';
                $query->query_vars['meta_value'] = $dealer_list;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    public function add_distributor_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_bulk_invi')
                return;

            $results = get_users( array('role' => 'author','fields' => array( 'user_login', 'display_name' )));

            /** Ensure there are options to show */
            if(empty($results))
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="">%1$s</option>', __('Distributor list', ''));
            foreach($results as $result) :
                
                $distributors = get_user_by('login', $result->user_login);
                $distributor_id = $distributors->data->ID;
                $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
                $options[] = sprintf('<option value="%1$s">%2$s</option>', $result->user_login, $distributor_name);
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="distributor-list" name="distributor_list">';
            // echo '<option value="" disabled selected>Distributor list</option>';
            echo join("\n", $options);
            echo '</select>';

    }
    
    public function  prefix_distributor_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_bulk_invi' == $current_page && 'edit.php' == $pagenow && isset( $_GET['distributor_list'] ) && $_GET['distributor_list'] != '') {

                $distributor_list = $_GET['distributor_list'];
                $query->query_vars['meta_key'] = '_pmsafe_distributor';
                $query->query_vars['meta_value'] = $distributor_list;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    public function extend_admin_search( $query ) {
            
            // Extend search for document post type
            $post_type = 'pmsafe_bulk_invi';
            // Custom fields to search for
            $custom_fields = array(
                "_pmsafe_dealer",
                "_pmsafe_distributor",
            );

            if( ! is_admin() )
                return;

            if ( $query->query['post_type'] != $post_type )
                return;

            $search_term = $query->query_vars['s'];

            // Set to empty, otherwise it won't find anything
            $query->query_vars['s'] = '';

            if ( $search_term != '' ) {
                $meta_query = array( 'relation' => 'OR' );

                foreach( $custom_fields as $custom_field ) {
                    array_push( $meta_query, array(
                        'key' => $custom_field,
                        'value' => $search_term,
                        'compare' => 'LIKE'
                    ));
                }

                $query->set( 'meta_query', $meta_query );
            };

    }
}

$PMSafe_Bulk_Invitation = new PMSafe_Bulk_Invitation; 