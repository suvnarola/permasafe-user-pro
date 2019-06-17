<?php
class PMSafe_dealer_area{
	 public function __construct() {
            add_action( 'init', array( $this, 'pmsafe_create_dealer_posttype' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_dealer_metaboxes' ) );

            
    }
    public function pmsafe_create_dealer_posttype() {
 
    // Set UI labels for Custom Post Type
        $labels = array(
            'name'                => _x( 'Dealers', 'Post Type General Name', '' ),
            'singular_name'       => _x( 'Dealer', 'Post Type Singular Name', '' ),
            'menu_name'           => __( 'Dealers', 'admin menu' ),
            'name_admin_bar'     => _x( 'Dealers', 'add new on admin bar', '' ),
            'add_new'             => __( 'Add New', 'Dealer' ),
            'add_new_item'        => __( 'Add New Dealer', '' ),
            'new_item'           => __( 'New Dealer', '' ),
            'edit_item'           => __( 'Edit Dealer', '' ),
            'view_item'           => __( 'View Dealer', '' ),
            'all_items'           => __( 'All Dealers', '' ),
            'update_item'         => __( 'Update Dealer', '' ),
            'search_items'        => __( 'Search Dealer', '' ),
            'parent_item_colon'   => __( 'Parent Dealer', '' ),
            'not_found'           => __( 'No Dealers Found', '' ),
            'not_found_in_trash'  => __( 'No Dealers found in Trash', '' ),
        );
         
    // Set other options for Custom Post Type
         
        $args = array(
            'label'               => __( 'dealers', '' ),
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
            'rewrite'            => array( 'slug' => 'pmsafe_dealer' ),
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 5,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );
         
        // Registering your Custom Post Type
        register_post_type( 'dealers_list', $args );
 
    }


    public function add_dealer_metaboxes() {
            add_meta_box('pmsafe_dealer_information', 'Dealer Information', array($this,'pmsafe_dealer_information'), 'dealers_list', 'normal', 'high');
    }

    public function pmsafe_dealer_information(){
         global $post;
            $post_id = $post->ID;

            wp_nonce_field( basename( __FILE__ ), 'pmsafe_post_class_nonce' );

            echo '<table class="form-table pmsafe-metabox-table">';
                $create_date = get_post_meta($post_id, '_pmsafe_dealer_create_date', true);
                if(empty($create_date)){
                    $create_date = current_time( 'mysql' );
                }
                echo '<input type="hidden" name="pmsafe_dealer_create_date" value="'.$create_date.'" />';

                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Dealer Code</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="text" name="pmsafe_dealer_code" value="" class="widefat" />';
                    echo '</td>';
                echo '</tr>';

            echo '</table>';
    }

}
$PMSafe_dealer_area = new PMSafe_dealer_area; 