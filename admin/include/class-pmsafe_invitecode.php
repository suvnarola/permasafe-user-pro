<?php
class PMSafe_Invitation_Code {
    
    public function __construct() {
            add_action( 'init', array( $this, 'pmsafe_create_invitecode_posttype' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_invitecode_metaboxes' ) );
            add_action( 'save_post' , array( $this,'pmsafe_save_invitecode_meta' ), 10, 2 );
            add_action( 'manage_pmsafe_invitecode_posts_columns' , array( $this,'set_custom_columns'), 10, 1 );
            add_action( 'manage_pmsafe_invitecode_posts_custom_column' , array( $this,'custom_columns'), 10, 2 );
            
            add_action( 'restrict_manage_posts', array( $this,'add_bulk_invitation_tablenav' ) );
            add_filter( 'parse_query', array( $this,'prefix_bulk_invitation_filter') );
            
            add_action( 'restrict_manage_posts', array( $this,'add_code_status_tablenav' ) );
            add_filter( 'parse_query', array( $this,'prefix_code_status_filter') );            
            
            add_action( 'restrict_manage_posts', array( $this,'add_dealer_tablenav' ) );
            add_filter( 'parse_query', array( $this,'prefix_dealer_filter') );
            
            add_action( 'restrict_manage_posts', array( $this,'add_distributor_tablenav' ) );
            add_filter( 'parse_query', array( $this,'prefix_distributor_filter') );
        
            add_action('admin_head-post.php', array( $this,'hide_publishing_actions_edit_post'));
            add_action('admin_head-post-new.php', array( $this,'hide_publishing_actions_new_post'));
            add_action('wp_trash_post', array( $this,'pmsafe_wp_trash_post'));
            
            add_filter( 'gettext', array( $this,'change_publish_button' ), 10, 2 );
            add_filter( 'post_updated_messages', array( $this,'change_post_updated_messages' ), 10, 1 );
            
            add_filter( 'posts_orderby', array( $this,'change_orderby_filter' ), 10, 2 );
            
            add_action( 'pre_get_posts', array( $this,'extend_admin_search') );
    }
    
    public function pmsafe_create_invitecode_posttype(){
            $labels = array(
                'name'               => _x( 'Member Codes', 'post type general name', '' ),
                'singular_name'      => _x( 'Member code', 'post type singular name', '' ),
                'menu_name'          => _x( 'Member codes', 'admin menu', '' ),
                'name_admin_bar'     => _x( 'Member code', 'add new on admin bar', '' ),
                'add_new'            => _x( 'Add New', 'member code', '' ),
                'add_new_item'       => __( 'Add New Member code', '' ),
                'new_item'           => __( 'New Member code', '' ),
                'edit_item'          => __( 'Edit Member code', '' ),
                'view_item'          => __( 'View Member code', '' ),
                'all_items'          => __( 'Individual Member Codes', '' ),
                'search_items'       => __( 'Search Member codes', '' ),
                'parent_item_colon'  => __( 'Parent Member codes:', '' ),
                'not_found'          => __( 'No Member codes found.', '' ),
                'not_found_in_trash' => __( 'No Member codes found in Trash.', '' )
            );

            $args = array(
                'labels'             => $labels,
                'description'        => __( 'Description.', '' ),
                'public'             => false,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => false,
                'query_var'          => true,
                'rewrite'            => array( 'slug' => 'pmsafe_invitecode' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'supports'           => array( 'title' )
            );

            register_post_type( 'pmsafe_invitecode', $args );
    }

    public function add_invitecode_metaboxes() {
            add_meta_box('pmsafe_invitation_code_information', 'Member Code Information', array($this,'pmsafe_invitation_code_information'), 'pmsafe_invitecode', 'normal', 'high');
    }

    public function pmsafe_invitation_code_information(){
            global $post;
            $post_id = $post->ID;

            wp_nonce_field( basename( __FILE__ ), 'pmsafe_post_class_nonce' );

            echo '<table class="form-table pmsafe-metabox-table">';
                $code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
                if(empty($code_status)){
                    $code_status = 'available';
                }
                echo '<input type="hidden" name="pmsafe_code_status" value="'.$code_status.'" />';
                
                $create_date = get_post_meta($post_id, '_pmsafe_code_create_date', true);
                if(empty($create_date)){
                    $create_date = current_time( 'mysql' );
                }
                echo '<input type="hidden" name="pmsafe_code_create_date" value="'.$create_date.'" />';
        
//                if($_GET['action'] != 'edit'){
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Member Code to Create</strong></label>';
                    echo '</th>';
                    echo '<td>';
//                        echo '<input type="text" name="pmsafe_invitation_code" value="' . get_post_meta($post_id, '_pmsafe_invitation_code', true)  . '" class="widefat pmsafe-code-input" /><a href="" id="pmsafe-generate-code">Generate new</a>';
                        echo '<input type="text" name="pmsafe_invitation_code" value="' . get_post_meta($post_id, '_pmsafe_invitation_code', true)  . '" class="widefat pmsafe-code-input" />';
                    echo '</td>';
                echo '</tr>';
//                } else {
//                    echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>Editing Member Code</strong></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<code>'.get_post_meta( $post_id, '_pmsafe_invitation_code', true ).'</code>';
//                    echo '</td>';
//                    echo '</tr>';
//                }
                
//                echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>Expiration date</strong><span>code will be valid until midnight</span></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<input type="text" name="pmsafe_expiration_date" value="' . get_post_meta($post_id, '_pmsafe_expiration_date', true)  . '" class="widefat datepicker" />';
//                    echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>User Limit</strong></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<input type="number" name="pmsafe_user_limit" value="' . get_post_meta($post_id, '_pmsafe_user_limit', true)  . '" class="widefat" />';
//                    echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>Require email verification</strong></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<input type="radio" name="pmsafe_email_verification" value="no" '. checked( get_post_meta($post_id,'_pmsafe_email_verification',true), 'no', false ) .'> No';
//                        echo '<input type="radio" name="pmsafe_email_verification" value="yes" '. checked( get_post_meta($post_id,'_pmsafe_email_verification',true), 'yes', false ) .' > Yes';
//                    echo '</td>';
//                echo '</tr>';
//                echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>Require to use the following email address during the registration</strong><span>Using this option makes the invitation code disposable. Leave empty to disable.</span></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<input type="text" name="pmsafe_email_address" value="' . get_post_meta($post_id, '_pmsafe_email_address', true)  . '" class="widefat" />';
//                    echo '</td>';
//                echo '</tr>';
        
                // Start of Benefits Package on Individual Code 
                $benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
                
//                if($_GET['action'] != 'edit'){
                    echo '<tr>';
                        echo '<th>';
                            echo '<label><strong>Benefits Package</strong><span>Select the benefits package these member codes will assign to the customer.</span></label>';
                        echo '</th>';
                        echo '<td>';
//                            echo '<input type="text" name="pmsafe_invitation_prefix" value="' . get_post_meta($post_id, '_pmsafe_invitation_prefix', true)  . '" class="widefat" />';
                            if(!empty($benefit_prefix)){
                                echo '<select name="pmsafe_invitation_prefix">';
                                    foreach ($benefit_prefix as $prefix) {
                                        echo '<option value="'.$prefix.'" '. selected( get_post_meta($post_id,'_pmsafe_invitation_prefix',true), $prefix, false ) .'>'.$prefix.'</option>';
                                    }
                                echo '</select>';
                            }
                        echo '</td>';
                    echo '</tr>';
//                }

        
                echo '<tr>';
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
                
        
                // Start of Individual Code Dist & Dealer Management
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
                    }/*elseif ($edit_action == 'edit') {
                      
                         echo '<td>';
                            $distributor_users = get_users( array('role' => 'author','fields' => array( 'ID','user_login' )));
                            echo '<select name="pmsafe_distributor" id="pmsafe_distributor" disabled>';
                                echo '<option value="" disabled selected>Select distributor</option>';
                                foreach ( $distributor_users as $user ) {
                                    $distributor_id = $user->ID;
                                    $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
                                    echo '<option value="'.$user->user_login.'" '. selected( get_post_meta($post_id,'_pmsafe_distributor',true), $user->user_login, false ) .'>'.$distributor_name .' ('. $user->user_login .')</option>';
                                }
                            echo '</select>';
                        echo '</td>';
                    }*/
                    else{
                       
                        echo '<td>';
                            $distributor_users = get_users( array('role' => 'author','fields' => array( 'ID','user_login' )));
                            echo '<select name="pmsafe_distributor" id="pmsafe_distributor">';
                                echo '<option value="" disabled selected>Select distributor</option>';
                                foreach ( $distributor_users as $user ) {
                                    $distributor_id = $user->ID;
                                    $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
                                    echo '<option value="'.$user->user_login.'" '. selected( get_post_meta($post_id,'_pmsafe_distributor',true), $user->user_login, false ) .'>'.$distributor_name .' ('. $user->user_login .')</option>';
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
                            echo '<select name="pmsafe_dealer" id="pmsafe_dealer" >';
                                echo '<option value="">Select dealer</option>';
                                foreach ( $dealers as $user ) {
                                    $contributor_id = $user->user_id;
                                    $contributor_name = get_user_meta( $contributor_id, 'dealer_name' , true );
                                    $dealer_user = get_user_by( 'ID', $contributor_id );
                                    $username = $dealer_user->data->user_login;
                                    echo '<option value="'.$username.'" '. selected( get_post_meta($post_id,'_pmsafe_dealer',true), $username, false ) .'>'.$contributor_name .' ('. $username .')</option>';
                                }
                            echo '</select>';
                        
                    }
                    else
                    {
                        echo '<td>';
                            $contributor_users = get_users( array('role' => 'contributor','fields' => array( 'ID','user_login' )));

                            echo '<select name="pmsafe_dealer" id="pmsafe_dealer" disabled>';
                                echo '<option value="">Select dealer</option>';
                                // foreach ( $contributor_users as $user ) {
                                //     $contributor_id = $user->ID;
                                //     $contributor_name = get_user_meta( $contributor_id, 'dealer_name' , true );
                                //     echo '<option value="'.$user->user_login.'" '. selected( get_post_meta($post_id,'_pmsafe_dealer',true), $user->user_login, false ) .'>'.$contributor_name .' ('. $user->user_login .')</option>';
                                // }
                            echo '</select>';
                        echo '</td>';
                    }
                   
        
        
//                Only shows on edit - this is the current original code
//
//                if($_GET['action'] == 'edit'){                    
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>Dealer</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            $dealer_login = get_post_meta( $post_id, '_pmsafe_dealer', true ); 
//                            $dealers = get_user_by('login', $dealer_login);
//                            $dealer_id = $dealers->data->ID;
//                            $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
//                            echo $dealer_name;
//                        echo '</td>';
//                    echo '</tr>';
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>Distributor</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            $distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
//                            $distributors = get_user_by('login', $distributor_login);
//                            $distributor_id = $distributors->data->ID;
//                            $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
//                            echo $distributor_name;
//                        echo '</td>';
//                    echo '</tr>';
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>Code Date Created</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            echo get_post_meta($post_id, '_pmsafe_code_create_date', true);
//                        echo '</td>';
//                    echo '</tr>';
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>Code Used Date</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            echo get_post_meta($post_id, '_pmsafe_used_code_date', true);
//                        echo '</td>';
//                    echo '</tr>';
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>Customer Name</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            echo get_post_meta($post_id, '_pmsafe_used_code_user_name', true);
//                        echo '</td>';
//                    echo '</tr>';
//                    echo '<tr>';
//                        echo '<th>';
//                            echo '<label><strong>PDF</strong></label>';
//                        echo '</th>';
//                        echo '<td>';
//                            echo '<a href="'.get_post_meta($post_id, 'pmsafe_pdf_link', true).'" target="_blank">View PDF</a>';
//                        echo '</td>';
//                    echo '</tr>';
//                }
//        
//              Custom Redirection URL for Code User
//                echo '<tr>';
//                    echo '<th>';
//                        echo '<label><strong>Custom Redirection URL after login for users that used this code</strong><span>Leave empty to use the global options: redirection by role or the default login redirection URL.</span></label>';
//                    echo '</th>';
//                    echo '<td>';
//                        echo '<input type="text" name="pmsafe_custom_redirect_url" value="' . get_post_meta($post_id, '_pmsafe_custom_redirect_url', true)  . '" class="widefat" />';
//                    echo '</td>';
//                echo '</tr>';
            echo '</table>';                

    }

    public function pmsafe_save_invitecode_meta($post_id, $post){

            if($post->post_type != "pmsafe_invitecode")
                return;

            /* Verify the nonce before proceeding. */
            if ( !isset( $_POST['pmsafe_post_class_nonce'] ) || !wp_verify_nonce( $_POST['pmsafe_post_class_nonce'], basename( __FILE__ ) ) )
              return $post_id;


            // Is the user allowed to edit the post or page?
            if ( !current_user_can( 'edit_post', $post->ID ))
                    return $post->ID;


            $invitation_meta['_pmsafe_invitation_code'] = $_POST['pmsafe_invitation_code'];
            $invitation_meta['_pmsafe_distributor'] = $_POST['pmsafe_distributor'];
            $invitation_meta['_pmsafe_dealer'] = $_POST['pmsafe_dealer'];
            $invitation_meta['_pmsafe_code_prefix'] = $_POST['pmsafe_invitation_prefix'];
            $invitation_meta['_pmsafe_invitation_prefix'] = $_POST['pmsafe_invitation_prefix'];
//            $invitation_meta['_pmsafe_expiration_date'] = $_POST['pmsafe_expiration_date'];
//            $invitation_meta['_pmsafe_user_limit'] = $_POST['pmsafe_user_limit'];

//            $invitation_meta['_pmsafe_email_verification'] = $_POST['pmsafe_email_verification'];
//            $invitation_meta['_pmsafe_email_address'] = $_POST['pmsafe_email_address'];
            $invitation_meta['_pmsafe_user_role'] = $_POST['pmsafe_user_role'];
            $invitation_meta['_pmsafe_code_status'] = $_POST['pmsafe_code_status'];
            $invitation_meta['_pmsafe_code_create_date'] = $_POST['pmsafe_code_create_date'];
//            $invitation_meta['_pmsafe_custom_redirect_url'] = $_POST['pmsafe_custom_redirect_url'];
            
//            pr($invitation_meta);
//            die;

            // Add values of $invitation_meta as custom fields

            foreach ($invitation_meta as $key => $value) { // Cycle through the $invitation_meta array!
                if( $post->post_type == 'revision' ) return; // Don't store custom data twice
                $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
                if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
                        update_post_meta($post->ID, $key, $value);
                } else { // If the custom field doesn't have a value
                        add_post_meta($post->ID, $key, $value);
                }
//                if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
            }
    }

    public function set_custom_columns($columns){
        unset( $columns['title'] );
        unset( $columns['author'] );
        unset( $columns['date'] );
        $columns['invitation_code']         = __( 'Member code', '' );
        $columns['benefits_package']        = __( 'Benefits Package', '' );
        $columns['bulk_invitation']         = __( 'Bulk Member', '' );
        $columns['code_status']             = __( 'Code status', '' );
//        $columns['user_limit']            = __( 'User limit', '' );
        $columns['member_name']             = __( 'Member Name', '' );
        // $columns['member_email_address']    = __( 'Email Address', '' );
        $columns['dealer']                  = __( 'Dealer', '' );
        $columns['distributor']             = __( 'Distributor', '' );
        $columns['date_create']             = __( 'Date Created', '' );
        $columns['date_used']               = __( 'Date Used', '' );
        $columns['pdf']                     = __( 'PDF', '' );
        $columns['reset']                   = __( 'Reset Code', '' );

        return $columns;
    }

    public function custom_columns( $column, $post_id ) {
            switch ( $column ) {

                case 'bulk_invitation':
                        if(!empty(get_post_meta( $post_id, '_pmsafe_bulk_invitation_id', true ))){
                            echo get_the_title(get_post_meta( $post_id, '_pmsafe_bulk_invitation_id', true )); 
                        }else{
                            echo '';
                        }
                        break;
                case 'code_status':
                        if(get_post_meta( $post_id, '_pmsafe_code_status', true ) == 'available'){
                            echo '<span style="color:green;"><b>Available</b></span>';
                        }elseif(get_post_meta( $post_id, '_pmsafe_code_status', true ) == 'used'){
                            echo '<span style="color:red;"><b>Used</b></span>';
                        }else{
                            echo '';
                        }
                        break;
//                case 'user_limit':
//                        if(!empty(get_post_meta( $post_id, '_pmsafe_available_limit', true ))){
//                            echo get_post_meta( $post_id, '_pmsafe_available_limit', true ).'/';
//                        }else{
//                            echo '0/';
//                        }
//                        echo get_post_meta( $post_id, '_pmsafe_user_limit', true );
//                        break;
                case 'member_name':
                        echo get_post_meta( $post_id, '_pmsafe_used_code_user_name', true );
                        break;
                // case 'member_email_address':
                //         $user_id = get_post_meta( $post_id, '_pmsafe_used_code_user_id', true );
                //         if(!empty($user_id)){
                //             $user_info = get_userdata($user_id);
                //             echo $user_info->user_email;
                //         }else{
                //             echo '';
                //         }
                //         break;
                case 'invitation_code':
                        echo '<code>'.get_post_meta( $post_id, '_pmsafe_invitation_code', true ).'</code>';
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
                case 'date_create':
                        echo get_post_meta( $post_id, '_pmsafe_code_create_date', true );
                        break;
                case 'date_used':
                        echo get_post_meta( $post_id, '_pmsafe_used_code_date', true );
                        break;
                case 'benefits_package':
                        echo '<code>'.get_post_meta( $post_id, '_pmsafe_code_prefix', true ).'</code>';
                        break;
                case 'pdf':
                        $pdf_link = get_post_meta($post_id, 'pmsafe_pdf_link', true);
                        if(!empty($pdf_link)){
                            echo '<a href="'. $pdf_link .'" target="_blank"><img src="'. includes_url() .'images/media/document.png" class="attachment-thumbnail" width="20" height="25" /></a>';
                        }
                        break;
                case 'reset':
                        echo '<i class="fa fa-undo" style="font-size:20px;cursor:pointer" title="reset" id="reset-code" data-id="'.$post_id.'"></i>';
                    break;
            }
    }
    
    public function add_bulk_invitation_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_invitecode')
                return;

            /** Grab the results from the DB */
            $query = $wpdb->prepare('
                SELECT DISTINCT pm.meta_value FROM %1$s pm
                LEFT JOIN %2$s p ON p.ID = pm.post_id
                WHERE pm.meta_key = "%3$s" 
                AND p.post_status = "%4$s" 
                AND p.post_type = "%5$s"
                ORDER BY "%3$s"',
                $wpdb->postmeta,
                $wpdb->posts,
                '_pmsafe_bulk_invitation_id', // Your meta key - change as required
                'publish',          // Post status - change as required
                $post_type
            );
            $results = $wpdb->get_col($query);

            /** Ensure there are options to show */
            if(empty($results))
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="">%1$s</option>', __('Bulk member name', ''));
            foreach($results as $result) :
                $options[] = sprintf('<option value="%1$s">%2$s</option>', esc_attr($result), get_the_title($result));
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="bulk-invitation-id" name="bulk-invitation-id">';
            echo join("\n", $options);
            echo '</select>';

    }
    
    public function  prefix_bulk_invitation_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_invitecode' == $current_page && 'edit.php' == $pagenow && isset( $_GET['bulk-invitation-id'] ) && $_GET['bulk-invitation-id'] != '') {

                $bulk_invitation_id = $_GET['bulk-invitation-id'];
                $query->query_vars['meta_key'] = '_pmsafe_bulk_invitation_id';
                $query->query_vars['meta_value'] = $bulk_invitation_id;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    public function add_code_status_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_invitecode')
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="-1">%1$s</option>', __('Bulk invitation name', ''));
            foreach($results as $result) :
                $options[] = sprintf('<option value="%1$s">%2$s</option>', esc_attr($result), get_the_title($result));
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="code-status" name="code-status">';
                echo '<option value="">Code status</option>';
                echo '<option value="available">Available</option>';
                echo '<option value="used">Used</option>';
            echo '</select>';

    }
    
    public function  prefix_code_status_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_invitecode' == $current_page && 'edit.php' == $pagenow && isset( $_GET['code-status'] ) && $_GET['code-status'] != '') {

                $code_status = $_GET['code-status'];
                $query->query_vars['meta_key'] = '_pmsafe_code_status';
                $query->query_vars['meta_value'] = $code_status;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    
    public function add_dealer_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_invitecode')
                return;

            $results = get_users( array('role' => 'contributor','fields' => array( 'user_login', 'display_name' )));

            /** Ensure there are options to show */
            if(empty($results))
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="">%1$s</option>', __('Dealer list', ''));
            foreach($results as $result) :
                $options[] = sprintf('<option value="%1$s">%2$s</option>', $result->user_login, $result->user_login);
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="dealer-list" name="dealer_list">';
            echo join("\n", $options);
            echo '</select>';

    }
    
    public function  prefix_dealer_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_invitecode' == $current_page && 'edit.php' == $pagenow && isset( $_GET['dealer_list'] ) && $_GET['dealer_list'] != '') {

                $dealer_list = $_GET['dealer_list'];
                $query->query_vars['meta_key'] = '_pmsafe_dealer';
                $query->query_vars['meta_value'] = $dealer_list;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    public function add_distributor_tablenav($post_type){

            global $wpdb;

            /** Ensure this is the correct Post Type*/
            if($post_type !== 'pmsafe_invitecode')
                return;

            $results = get_users( array('role' => 'author','fields' => array( 'user_login', 'display_name' )));

            /** Ensure there are options to show */
            if(empty($results))
                return;

            /** Grab all of the options that should be shown */
            $options[] = sprintf('<option value="">%1$s</option>', __('Distributor list', ''));
            foreach($results as $result) :
                $options[] = sprintf('<option value="%1$s">%2$s</option>', $result->user_login, $result->user_login);
            endforeach;

            /** Output the dropdown menu */
            echo '<select class="" id="distributor-list" name="distributor_list">';
            echo join("\n", $options);
            echo '</select>';

    }
    
    public function  prefix_distributor_filter($query) {
            global $pagenow;
            $current_page = isset( $_GET['post_type'] ) ? $_GET['post_type'] : '';

            if ( is_admin() && 'pmsafe_invitecode' == $current_page && 'edit.php' == $pagenow && isset( $_GET['distributor_list'] ) && $_GET['distributor_list'] != '') {

                $distributor_list = $_GET['distributor_list'];
                $query->query_vars['meta_key'] = '_pmsafe_distributor';
                $query->query_vars['meta_value'] = $distributor_list;
                $query->query_vars['meta_compare'] = '=';
           }
    }
    
    
    public function hide_publishing_actions_edit_post(){
            $post_type = 'pmsafe_invitecode';
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
            $post_type = 'pmsafe_invitecode';
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
            if( $post_type == 'pmsafe_invitecode' && in_array($post_status, array('publish')) ) {
                $invitation_id = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
                if(!empty($invitation_id)){
                    $invitation_id = explode(',',$invitation_id);
                    foreach ($invitation_id as $id) {
                        wp_delete_post($id);
                    }
                }
            }
    }
    
    
    public function extend_admin_search( $query ) {
            
            // Extend search for document post type
            $post_type = 'pmsafe_invitecode';
            // Custom fields to search for
            $custom_fields = array(
                "_pmsafe_invitation_code",
                "_pmsafe_used_code_user_name",
                "_pmsafe_code_status",
                "_pmsafe_code_create_date",
                "_pmsafe_used_code_date",
                "_pmsafe_dealer",
                "_pmsafe_distributor",
            );

            if( ! is_admin() )
                return;

            if ( $query->query['post_type'] != $post_type )
                return;

            $search_term = $query->query_vars['s'];
//            if($search_term == 'used'){
//                $search_term = '1';
//            }elseif($search_term == 'available'){
//                $search_term = '0';
//            }else{
//                $search_term = $search_term;
//            }

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
//            pr($query);
//            die;
    }
    
    public function change_publish_button( $translation, $text ) {

//            global $post_type;
            
            if ( $text == 'Publish' )
                return 'Create';

            return $translation;
    }
    
    public function change_post_updated_messages( $messages ){
            $messages['pmsafe_invitecode'] = array(
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
            if (get_query_var("post_type") == "pmsafe_invitecode") {
                 return "$wpdb->posts.ID DESC";
            }
            return $orderby;
    }
}

$PMSafe_Invitation_Code = new PMSafe_Invitation_Code; 