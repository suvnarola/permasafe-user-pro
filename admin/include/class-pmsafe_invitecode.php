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

            add_action( 'wp_ajax_check_invite_code_exist', array($this, 'check_invite_code_exist' ));
            add_action( 'wp_ajax_nopriv_check_invite_code_exist', array($this, 'check_invite_code_exist' ));
            
            add_action( 'wp_ajax_update_invite_codes', array($this, 'update_invite_codes' ));
            add_action( 'wp_ajax_nopriv_update_invite_codes', array($this, 'update_invite_codes' ));
            
            add_action( 'wp_ajax_delete_invite_codes', array($this, 'delete_invite_codes' ));
            add_action( 'wp_ajax_nopriv_delete_invite_codes', array($this, 'delete_invite_codes' ));

            add_action('admin_footer',array($this, 'disable_enter_key_event_function'));

            add_filter( 'post_row_actions', array($this,'custom_post_action_links'), 10, 2 );
    }
    

    public function custom_post_action_links( $actions, $post ) {
        $post_type = $_GET['post_type']; 
        $bulk_id = get_post_meta($post->ID,'_pmsafe_bulk_invitation_id',true);
        
        if($post_type == 'pmsafe_invitecode'){
            unset($actions['edit']);
            unset($actions['trash']);
            unset( $actions['inline hide-if-no-js'] );
            if($bulk_id == $post->ID){
                $url = admin_url('post.php?post='.$post->ID.'&action=edit');
                $actions['custom-edit'] = '<a href="'.$url.'">Edit</a>';
                $actions['custom-delete'] ='<span id="delete_invitation_code" style="color:#ff0000;cursor:pointer;" data-id="'.$post->ID.'">Delete</span>';
            }
        }
        return $actions;
    }


    
    public function disable_enter_key_event_function(){
        $post_type = $_GET['post_type']; 
        if($post_type == 'pmsafe_invitecode'){
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
            $edit_action = $_GET['action'];

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
        

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Member Code to Create</strong></label>';
                    echo '</th>';
                    echo '<td>';
                   
                        echo '<input type="text" name="pmsafe_invitation_code" id="pmsafe_invitation_code" value="' . get_post_meta($post_id, '_pmsafe_invitation_code', true)  . '" class="widefat pmsafe-code-input" '.(($edit_action == 'edit')?'disabled':'').'/><span class="code-exist" style="display:none;">This member code already exists. Please enter valid codes.</span>';
                    echo '</td>';
                echo '</tr>';
                // Start of Benefits Package on Individual Code 
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
                                // echo '<div name="pmsafe_invitation_upgradable_prefix[]" id="pmsafe_invitation_upgradable_prefix" multiple="multiple" style="width: 300px">';
                                 echo '<div id="upgradable_chklist">';
                                  echo '<ul class="chklist-wrap">';
                                foreach ($benefit_prefix as $prefix) {
                                     $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                    $post = get_post($pid);
                                    $post_title = $post->post_title;
                                if($prefix != $get_benifit_package){
                                        // echo '<option value="'.$prefix.'" '.( (in_array($prefix,$upgradable_prefix_arr)) ? "selected"   : "").'>'.$prefix.'</option>';
                                        
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
                                    // $distributor_id = $user->ID;
                                    // $distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
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
                                foreach ( $dealer_name_arr as $key => $value ) {
                                    echo '<option value="'.$key.'" '. selected( get_post_meta($post_id,'_pmsafe_dealer',true), $key, false ) .'>'.$value .' ('. $key .')</option>';
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

                    echo '</tr>';
                    echo '</table>';

                    if($edit_action == 'edit'){
                    echo '<input type="button" class="button button-primary button-large" id="update_invite_code_button" value="Update"/>';
                    }
        
        

            echo '</table>';                

    }

    public function check_invite_code_exist(){
        $code = $_POST['code'];
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
                
            ),
        );
        $posts = get_posts($args);
        if($posts){
            $response = array('status' => true);
        }else{
            $response = array('status' => false);
        }
        echo json_encode($response);
        die;
    }

    public function update_invite_codes(){
        global $wpdb;
    
        $invitation_id = $_POST['post_id'];
        
        $benifit_package = $_POST['benifit_package'];
        $dealer = $_POST['dealer'];
        $distributor = $_POST['distributor'];
        $select = $_POST['prefix_arr'];
        $chk = $_POST['chk'];
        $allow_dealer = $_POST['allow_dealer'];
        $upgradable_prefix_str = implode(",",$select);
        
        $key = '_pmsafe_invitation_code';
        $updated_date = current_time( 'mysql' );
        $code_status = get_post_meta($invitation_id,'_pmsafe_code_status',true);
       
            
        update_post_meta( $invitation_id, '_pmsafe_dealer', $dealer );
        update_post_meta( $invitation_id, '_pmsafe_distributor', $distributor ); 
        update_post_meta( $invitation_id, '_pmsafe_date_updated', $updated_date ); 
        if($code_status == 'available'){
            update_post_meta($invitation_id, '_pmsafe_code_prefix', $benifit_package );
            update_post_meta($invitation_id, '_pmsafe_invitation_prefix', $benifit_package );
        }
        if($chk == 1)
        {
            update_post_meta($invitation_id, 'pmsafe_invitation_code_upgradable', 1 );
            update_post_meta($invitation_id, 'upgradable_prefix', $upgradable_prefix_str );
        }
        if($chk == 0)
        {
            delete_post_meta($invitation_id,'upgradable_prefix');
            update_post_meta($invitation_id, 'pmsafe_invitation_code_upgradable', 0 );
        }

        if($allow_dealer == 1)
        {
            update_post_meta($invitation_id, 'pmsafe_code_allow_dealer', 1 );
        }
        if($allow_dealer == 0)
        {
            update_post_meta($invitation_id, 'pmsafe_code_allow_dealer', 0 );
        }
        
        update_post_meta($invitation_id, '_pmsafe_invitation_prefix', $benifit_package );
        

        // $url = admin_url('edit.php?post_type=pmsafe_bulk_invi');
        $response = array('status'=>true);
        echo json_encode($response);
        die;
    }

    public function delete_invite_codes(){
        $post_id = $_POST['post_id'];
        $user_login = get_post_meta($post_id,'_pmsafe_invitation_code',true);
        $users = get_user_by('login',$user_login);
        $user_id = $users->ID;
        $result = wp_delete_user( $user_id );
        wp_delete_post($post_id,true);
        global $wpdb;
        $delete_post_meta = $wpdb->delete( $wpdb->postmeta , array( 'post_id' => $post_id ) );
        
        die;
    }

    public function pmsafe_save_invitecode_meta($post_id, $post){
        global $wpdb;
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

            $invitation_meta['_pmsafe_user_role'] = $_POST['pmsafe_user_role'];
            $invitation_meta['_pmsafe_code_status'] = $_POST['pmsafe_code_status'];
            $invitation_meta['_pmsafe_code_create_date'] = $_POST['pmsafe_code_create_date'];
            $invitation_meta['_pmsafe_dealer'] = $_POST['pmsafe_dealer'];
            $invitation_meta['_pmsafe_distributor'] = $_POST['pmsafe_distributor'];
            $invitation_meta['_pmsafe_bulk_invitation_id'] = $post_id;
            $invitation_meta['_pmsafe_is_invite_code'] = 1;
            if(isset($_POST['pmsafe_invitation_code_upgradable'])){
                $invitation_meta['pmsafe_invitation_code_upgradable'] = 1;
            }
            if(isset($_POST['pmsafe_code_allow_dealer'])){
                $invitation_meta['pmsafe_code_allow_dealer'] = 1;
            }
            $upgradable_prefix = $_POST['pmsafe_invitation_upgradable_prefix'];
            $upgradable_prefix_str = implode(",",$upgradable_prefix);
            $invitation_meta['upgradable_prefix'] = $upgradable_prefix_str;

            // Add values of $invitation_meta as custom fields
            $title = $_POST['pmsafe_invitation_code'];
            $where = array( 'ID' => $post_id );
            $wpdb->update( $wpdb->posts, array( 'post_title' => $title ), $where );

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
        unset($columns['cb']);
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

                case 'member_name':
                        echo get_post_meta( $post_id, '_pmsafe_used_code_user_name', true );
                        break;
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
                        echo '<i class="fa fa-undo" style="font-size:20px;cursor:pointer;color:#0065a7;" title="reset" id="reset-code" data-id="'.$post_id.'"></i>';
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