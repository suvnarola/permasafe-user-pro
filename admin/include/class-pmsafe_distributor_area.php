<?php
class PMSafe_distributor_area{
	 public function __construct() {
            add_action( 'init', array( $this, 'pmsafe_create_distributor_posttype' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_distributor_metaboxes' ) );
            add_action( 'save_post' , array( $this,'pmsafe_save_distributor_meta'),10,2 );

            
    }
   public function pmsafe_create_distributor_posttype() {
 
    // Set UI labels for Custom Post Type
         $labels = array(
            'name'                => _x( 'Distributors', 'Post Type General Name', '' ),
            'singular_name'       => _x( 'Distributor', 'Post Type Singular Name', '' ),
            'menu_name'           => __( 'Distributors', 'admin menu' ),
            'name_admin_bar'     => _x( 'Distributors', 'add new on admin bar', '' ),
            'add_new'             => __( 'Add New', 'Distributor' ),
            'add_new_item'        => __( 'Add New Distributor', '' ),
            'new_item'           => __( 'New Distributor', '' ),
            'edit_item'           => __( 'Edit Distributor', '' ),
            'view_item'           => __( 'View Distributor', '' ),
            'all_items'           => __( 'All Distributors', '' ),
            'update_item'         => __( 'Update Distributor', '' ),
            'search_items'        => __( 'Search Distributor', '' ),
            'parent_item_colon'   => __( 'Parent Distributor', '' ),
            'not_found'           => __( 'No Distributors Found', '' ),
            'not_found_in_trash'  => __( 'No Distributors found in Trash', '' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'distributors', '' ),
            'description'         => __( 'Description', '' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title' ),
            // You can associate this CPT with a taxonomy or custom taxonomy. 
            
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */ 
            'hierarchical'        => false,
            'public'              => true,
            'rewrite'            => array( 'slug' => 'pmsafe_distributor' ),
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 6,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
         
        // Registering your Custom Post Type
        register_post_type( 'distributors_list', $args );
 
    }

    public function add_distributor_metaboxes() {
            add_meta_box('pmsafe_distributor_information', 'Distributor Information', array($this,'pmsafe_distributor_information'), 'distributors_list', 'normal', 'high');
    }

    public function pmsafe_distributor_information(){
         global $post;
            $post_id = $post->ID;

            wp_nonce_field( basename( __FILE__ ), 'pmsafe_post_class_nonce' );

            echo '<table class="form-table pmsafe-metabox-table">';
                $create_date = get_post_meta($post_id, '_pmsafe_distributor_create_date', true);
                if(empty($create_date)){
                    $create_date = current_time( 'mysql' );
                }
                echo '<input type="hidden" name="pmsafe_distributor_create_date" value="'.$create_date.'" />';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Distributor Code</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="text" name="pmsafe_distributor_code" value="'.get_post_meta($post_id,'pmsafe_distributor_code',true).'" class="widefat" />';
                    echo '</td>';
                echo '</tr>';
                
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Password</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="password" name="pmsafe_distributor_password" value="'.get_post_meta($post_id,'pmsafe_distributor_password',true).'" class="widefat" />';
                    echo '</td>';
                echo '</tr>';
                
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Store Address</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<textarea name="pmsafe_distributor_store_address">'.get_post_meta($post_id,'pmsafe_distributor_store_address',true).'</textarea>';
                    echo '</td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Phone Number</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="number" name="pmsafe_distributor_phone_number" value="'.get_post_meta($post_id,'pmsafe_distributor_phone_number',true).'" class="widefat" />';
                    echo '</td>';
                echo '</tr>';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Fax Number</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="text" name="pmsafe_distributor_fax_number" value="'.get_post_meta($post_id,'pmsafe_distributor_fax_number',true).'" class="widefat" />';
                    echo '</td>';
                echo '</tr>';

            echo '</table>';
    }

    public function pmsafe_save_distributor_meta($post_id, $post){
         if($post->post_type != "distributors_list")
                return;

            /* Verify the nonce before proceeding. */
            if ( !isset( $_POST['pmsafe_post_class_nonce'] ) || !wp_verify_nonce( $_POST['pmsafe_post_class_nonce'], basename( __FILE__ ) ) )
              return $post_id;


            // Is the user allowed to edit the post or page?
            if ( !current_user_can( 'edit_post', $post->ID ))
                    return $post->ID;

            $post_title = $post['pmsafe_distributor_code'];

            if(isset($_POST['pmsafe_distributor_code'])){
                $distributor_code = "P1001";
                update_post_meta( $post_id, 'pmsafe_distributor_code', $distributor_code );
            }
            if(isset($_POST['pmsafe_distributor_password'])){
                $distributor_password = $_POST['pmsafe_distributor_password'];
                update_post_meta( $post_id, 'pmsafe_distributor_password', $distributor_password );
            }
            if(isset($_POST['pmsafe_distributor_store_address'])){
                $distributor_store_address = $_POST['pmsafe_distributor_store_address'];
                update_post_meta( $post_id, 'pmsafe_distributor_store_address', $distributor_store_address );
            }
            if(isset($_POST['pmsafe_distributor_phone_number'])){
                $distributor_phone_number = $_POST['pmsafe_distributor_phone_number'];
                update_post_meta( $post_id, 'pmsafe_distributor_phone_number', $distributor_phone_number );
            }
            if(isset($_POST['pmsafe_distributor_fax_number'])){
                $distributor_fax_number = $_POST['pmsafe_distributor_fax_number'];
                update_post_meta( $post_id, 'pmsafe_distributor_fax_number', $distributor_fax_number );
            }

    }


}
$PMSafe_distributor_area = new PMSafe_distributor_area; 