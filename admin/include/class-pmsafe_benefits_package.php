<?php
class PMSafe_Benefits_Package{
    
    public function __construct() {
            add_action( 'init', array( $this, 'pmsafe_create_benefits_package_posttype' ) );
            add_action( 'add_meta_boxes', array( $this, 'add_benefits_metaboxes' ) );
            add_action( 'save_post' , array( $this,'pmsafe_save_benefits_meta'),10,2 );
            add_action( 'manage_pmsafe_benefits_posts_columns' , array( $this,'set_custom_columns'),10,1 );
            add_action( 'manage_pmsafe_benefits_posts_custom_column' , array( $this,'custom_columns'),10,2 );
          
    }
    
    public function pmsafe_create_benefits_package_posttype(){
            $labels = array(
                    'name'               => _x( 'Benefits Packages', 'post type general name', '' ),
                    'singular_name'      => _x( 'Benefits Package', 'post type singular name', '' ),
                    'menu_name'          => _x( 'Benefits Packages', 'admin menu', '' ),
                    'name_admin_bar'     => _x( 'Benefits Package', 'add new on admin bar', '' ),
                    'add_new'            => _x( 'Add New', 'book', '' ),
                    'add_new_item'       => __( 'Add New Benefits Package', '' ),
                    'new_item'           => __( 'New Benefits Package', '' ),
                    'edit_item'          => __( 'Edit Benefits Package', '' ),
                    'view_item'          => __( 'View Benefits Package', '' ),
                    'all_items'          => __( 'All Benefits Packages', '' ),
                    'search_items'       => __( 'Search Benefits Packages', '' ),
                    'parent_item_colon'  => __( 'Parent Benefits Packages:', '' ),
                    'not_found'          => __( 'No benefits packages found.', '' ),
                    'not_found_in_trash' => __( 'No benefits packages found in Trash.', '' )
            );

            $args = array(
                    'labels'             => $labels,
                    'description'        => __( 'Description.', '' ),
                    'public'             => false,
                    'publicly_queryable' => false,
                    'show_ui'            => true,
                    'show_in_menu'       => false,
                    'query_var'          => true,
                    'rewrite'            => array( 'slug' => 'pmsafe_benefits' ),
                    'capability_type'    => 'post',
                    'has_archive'        => false,
                    'hierarchical'       => false,
                    'menu_position'      => null,
                    'supports'           => array( 'title', 'editor' )
            );

            register_post_type( 'pmsafe_benefits', $args );
    }
    
    public function add_benefits_metaboxes() {
            add_meta_box('pmsafe_benefits_package_information', 'Parent Benefits Information', array($this,'pmsafe_benefits_package_information'), 'pmsafe_benefits', 'normal', 'high');
    }
    
    public function pmsafe_benefits_package_information(){
            global $post;
            $post_id = $post->ID;

            wp_nonce_field( basename( __FILE__ ), 'pmsafe_post_class_nonce' );

            echo '<table class="form-table pmsafe-metabox-table">';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Short description</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<textarea name="pmsafe_benefit_description">'.get_post_meta($post_id, '_pmsafe_benefit_description', true).'</textarea>';
                    echo '</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Prefix</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="text" name="pmsafe_benefit_prefix" value="' . get_post_meta($post_id, '_pmsafe_benefit_prefix', true)  . '" class="widefat" />';
                    echo '</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>PDF</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        $pdf_id = get_post_meta($post_id, '_pmsafe_benefit_pdf', true);
                        echo '<input type="hidden" name="pmsafe_benefit_pdf" id="pmsafe_benefit_pdf" value="' . $pdf_id  . '" class="widefat" />';                        
                        echo '<div class="pdf-block">';
                            if(!empty($pdf_id)){
                                echo '<a href="'. wp_get_attachment_url($pdf_id) .'" target="_blank"><img src="'. includes_url() .'images/media/document.png" class="attachment-thumbnail" width="30" height="40" /></a>';
                            }
                        echo '</div>';
                        echo '<a href="" id="benefit-pdf-upload">Upload</a>';
                    echo '</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<th>';
                        echo '<label><strong>Term Length(In month)</strong></label>';
                    echo '</th>';
                    echo '<td>';
                        echo '<input type="number" name="pmsafe_benefit_term_length" value="' . get_post_meta($post_id, '_pmsafe_benefit_term_length', true)  . '" class="widefat" min="1"/>';
                    echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<th>';
                    echo '<label><strong>Is this a "No Coverage" Policy?</strong></label>';
                echo '</th>';
                echo '<td>';
                $no_coverage = get_post_meta($post_id, '_pmsafe_no_coverage_benefit', true);
                echo '<input type="checkbox" name="pmsafe_no_coverage_benefit" id="pmsafe_no_coverage_benefit" '.(($no_coverage==1)?'checked="checked"':"").'>';
                echo '</td>';
            echo '</tr>';
            echo '</table>';                

    }
    
    public function pmsafe_save_benefits_meta($post_id, $post){

            if($post->post_type != "pmsafe_benefits")
                return;

            /* Verify the nonce before proceeding. */
            if ( !isset( $_POST['pmsafe_post_class_nonce'] ) || !wp_verify_nonce( $_POST['pmsafe_post_class_nonce'], basename( __FILE__ ) ) )
              return $post_id;


            // Is the user allowed to edit the post or page?
            if ( !current_user_can( 'edit_post', $post->ID ))
                    return $post->ID;


            $benefit_meta['_pmsafe_benefit_description'] = $_POST['pmsafe_benefit_description'];
            $benefit_meta['_pmsafe_benefit_prefix'] = $_POST['pmsafe_benefit_prefix'];
            $benefit_meta['_pmsafe_benefit_pdf'] = $_POST['pmsafe_benefit_pdf'];
            $benefit_meta['_pmsafe_benefit_term_length'] = $_POST['pmsafe_benefit_term_length'];
            if(isset($_POST['pmsafe_no_coverage_benefit'])){
                $benefit_meta['_pmsafe_no_coverage_benefit'] = 1;
            }
            if(!isset($_POST['pmsafe_no_coverage_benefit'])){
                $benefit_meta['_pmsafe_no_coverage_benefit'] = 0;
            }
            // Add values of $benefit_meta as custom fields

            foreach ($benefit_meta as $key => $value) { // Cycle through the $invitation_meta array!
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
        unset( $columns['date'] );
        $columns['prefix']                      = __( 'Prefix', '' );
        $columns['pdf']                         = __( 'PDF', '' );
        $columns['term_length']                 = __( 'Term Length', '' );

        return $columns;
    }

    public function custom_columns( $column, $post_id ) {
            switch ( $column ) {

                case 'prefix':
                        echo '<code>'.get_post_meta( $post_id, '_pmsafe_benefit_prefix', true ).'</code>'; 
                        break;
                case 'pdf':
                        $pdf_id = get_post_meta($post_id, '_pmsafe_benefit_pdf', true);
                        if(!empty($pdf_id)){
                            echo '<a href="'. wp_get_attachment_url($pdf_id) .'" target="_blank"><img src="'. includes_url() .'images/media/document.png" class="attachment-thumbnail" width="20" height="25" /></a>';
                        }
                        break;
                case 'term_length':
                        $term_length = get_post_meta( $post_id, '_pmsafe_benefit_term_length', true );
                        if($term_length){
                            echo $term_length.' month';
                        } 
                        break;
               
            }
    }
    
}


$PMSafe_Benefits_Package = new PMSafe_Benefits_Package; 