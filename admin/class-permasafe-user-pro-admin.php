<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://permasafe.net/
 * @since      1.0.0
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/admin
 * @author     permasafe <contact@permasafe.net>
 */
class Permasafe_User_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Permasafe_User_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Permasafe_User_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'pmsafe-datepicker-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/permasafe-user-pro-admin.css', array(), time(), 'all' );
		wp_enqueue_style( 'jquery-modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css', array(), time(), 'all' );
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), time(), 'all' );
		  wp_enqueue_style( 'pmsafe_dt_css', 'https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css', array(), time(), 'all' );
		wp_enqueue_style( 'pmsafe_dt_fixedHeader', 'https://cdn.datatables.net/fixedheader/3.1.5/css/fixedHeader.dataTables.min.css', array(), time(), 'all' );
		wp_enqueue_style( 'select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), time(), 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Permasafe_User_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Permasafe_User_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'pmsafe-datepicker', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/permasafe-user-pro-admin.js', array( 'jquery' ), '1.0.6', false );
		wp_enqueue_script( 'dt_table_js', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_js', 'https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_btn', 'https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_flash', 'https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_jszip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_btnhtml', 'https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_btnpdf', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_vfs_fonts', 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js', array( 'jquery' ), time(), false );
        wp_enqueue_script( 'dt_table_ui_btnprint', 'https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( 'dt_table_fixedHeader', 'https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js', array( 'jquery' ), time(), false );
		

	}

	public function enque_admin_user_js(){
		wp_enqueue_script('dealers_distributor_js', plugin_dir_url( __FILE__ ) .'js/permasafe-admin-user-pro-admin.js', array( 'jquery' ), time(), false);
		wp_enqueue_script('select2', plugin_dir_url( __FILE__ ) .'js/select2.js', array( 'jquery' ), time(), false);
		wp_enqueue_script( 'tbl_pagination_admin_js', plugin_dir_url( __FILE__ ) . 'js/jquery-paginate.js', array( 'jquery' ), time(), false );
		wp_enqueue_script( 'jquery-modal', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js', array( 'jquery' ), time(), false );
		wp_localize_script( $this->plugin_name, 'pmAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
        
        
        
     /**
	 * Add an menu page
	 *
	 * @since  1.0.0
	 */
	public function add_menu_page() {

		/**
         * Create admin side Customers Page
         * 
         * @since  1.0.0
         */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Customers', '' ),
			__( 'Customers', '' ),
			'manage_options',
			'customers-lists',
			array( $this, 'display_permasafe_customers_page' ),
                        'dashicons-businessman',
                        8
		);

		/**
         * Create admin side Dealers Page
         * 
         * @since  1.0.0
         */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Dealers', '' ),
			__( 'Dealers', '' ),
			'manage_options',
			'dealers-lists',
			array( $this, 'display_permasafe_dealers_page' ),
                        'dashicons-groups',
                        8
		);
		
		$this->plugin_screen_hook_suffix = add_submenu_page(
        	'dealers-lists',
			__( 'Dealers', '' ),
			__( 'Dealers', '' ),
			'manage_options',
			'dealers-lists',
			array( $this, 'display_permasafe_dealers_page' )
		);
		
		/**
         * Create admin side Add dealer page Page
         * 
         * @since  1.0.0
         */                
		$this->plugin_screen_hook_suffix = add_submenu_page(
        	'dealers-lists',
			__( 'Add New Dealer', '' ),
			__( 'Add New Dealer', '' ),
			'manage_options',
			'add-new-dealer',
			array( $this, 'add_permasafe_dealers_page' )
		);
		

		// distributors

		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Distributors', '' ),
			__( 'Distributors', '' ),
			'manage_options',
			'distributors-lists',
			array( $this, 'display_permasafe_distributors_page' ),
                        'dashicons-admin-users',
                        8
		);
		
		$this->plugin_screen_hook_suffix = add_submenu_page(
        	'distributors-lists',
			__( 'Distributors', '' ),
			__( 'Distributors', '' ),
			'manage_options',
			'distributors-lists',
			array( $this, 'display_permasafe_distributors_page' )
		);

		
		/**
         * Create admin side Add dealer page Page
         * 
         * @since  1.0.0
         */                
		$this->plugin_screen_hook_suffix = add_submenu_page(
        	'distributors-lists',
			__( 'Add New Distributor', '' ),
			__( 'Add New Distributor', '' ),
			'manage_options',
			'add-new-distributor',
			array( $this, 'add_permasafe_distributors_page' )
		);




		//==================================================//

        /**
         * Create admin side Permasafe Page
         * 
         * @since  1.0.0
         */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Member Codes', '' ),
			__( 'Member Codes', '' ),
			'manage_options',
			'pmsafe-bulk-invi',
			array( $this, 'display_permasafe_invitcode_page' ),
                        '',
                        8
		);


                /**
                 * Create admin side invite code Page
                 * 
                 * @since  1.0.0
                 */                
		$this->plugin_screen_hook_suffix = add_submenu_page(
                        'pmsafe-bulk-invi',
			__( 'Individual Member Codes', '' ),
			__( 'Individual Member Codes', '' ),
			'manage_options',
//			'permasafe-bulk-invitation',
			'edit.php?post_type=pmsafe_invitecode'
		);
                
                /**
                 * Create admin side invite code Page
                 * 
                 * @since  1.0.0
                 */                
		$this->plugin_screen_hook_suffix = add_submenu_page(
                        'pmsafe-bulk-invi',
			__( 'Benefits packages', 'permasafe-benefits-package' ),
			__( 'Benefits packages', '' ),
			'manage_options',
//			'permasafe-bulk-invitation',
			'edit.php?post_type=pmsafe_benefits'
		);
		  
		/**
		 * Create admin side upgraded membership Page
		 * 
		 * @since  1.0.0
		 */                
	

		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Reports', '' ),
			__( 'Reports', '' ),
			'manage_options',
			'permasafe-upgraded-membership',
			array( $this, 'permasafe_upgraded_membership_page' ),
			'dashicons-filter',
						8
		);


		
                /**
                 * Create admin side Setting Page
                 * 
                 * @since  1.0.0
                 */                
		$this->plugin_screen_hook_suffix = add_submenu_page(
                        'pmsafe-bulk-invi',
			__( 'Setting', '' ),
			__( 'Setting', '' ),
			'manage_options',
			'permasafe-setting',
			array( $this, 'permasafe_setting_page' )
		);
	
	}        
        
        public function pmsafe_register_setting(){
                register_setting('pmsafe_setting', 'pmsafe_redirect_url');                                             // save redirect URL
                register_setting('pmsafe_setting', 'pmsafe_demo_benefit_prefix');                                      // save demo registration benefit prefix
        }
        
        /**
         * Invitation code page
         */
        public function display_permasafe_invitcode_page(){
                include_once 'partials/permasafe-invitation-code.php';
        }
        
        /**
         * Permasafe setting page
         */
		public function display_permasafe_customers_page(){
			include_once 'partials/pmsafe-customers-page.php';
		}
        public function permasafe_setting_page(){
                include_once 'partials/permasafe-setting-page.php';
		}
		public function permasafe_upgraded_membership_page(){
			include_once 'partials/permasafe-upgraded-membership-page.php';
		}

        public function display_permasafe_dealers_page(){
        	include_once 'partials/pmsafe-dealers-page.php';	
        }

        public function add_permasafe_dealers_page(){
        	include_once 'partials/pmsafe-add-dealers-page.php';	
        }

         public function display_permasafe_distributors_page(){
        	include_once 'partials/pmsafe-distributors-page.php';	
        }

        public function add_permasafe_distributors_page(){
        	include_once 'partials/pmsafe-add-distributors-page.php';	
        }

        // add distributor
       public function pmsafe_register_distributor_form_function(){
       		// session_start();
       		// echo "session val->".$_SESSION['pmsafe_last_id'];
       		$user_prefix = 'P';
	       	$distributors = get_users( 'role=author&orderby=ID&order=DESC' );
	    	$last_id = $distributors[0]->user_login;
			
			if( empty($distributors)){	
				$numbers = 1000 + 1;
				$distributor_code = $user_prefix . $numbers;	
				
			}
			else{				
				$first_ltr = substr($last_id, 0, 2);
				$numbers = substr($last_id, 1);
				$numbers = $numbers + 1;
				$distributor_code = $user_prefix . $numbers;
				// $distributor_code = 'P1001';
					
			}
			$distributor_name = $_POST['pmsafe_distributor_name'];
			$distributor_email = $_POST['pmsafe_distributor_email'];
			$distributor_password = $_POST['pmsafe_distributor_password'];
			
			$distributor_store_address = $_POST['pmsafe_distributor_store_address'];
			$distributor_phone_number = $_POST['pmsafe_distributor_phone_number'];
			$distributor_fax_number = $_POST['pmsafe_distributor_fax_number'];

			$distributor_contact_fname = $_POST['pmsafe_distributor_contact_fname'];
			$distributor_contact_lname = $_POST['pmsafe_distributor_contact_lname'];
			$distributor_contact_phone = $_POST['pmsafe_distributor_contact_phone'];
			$distributor_contact_email = $_POST['pmsafe_distributor_contact_email'];

			

			$user_id = wp_create_user($distributor_code,$distributor_password,$distributor_email);
			$set_user_role = new WP_User( $user_id );
			$set_user_role->set_role( 'author' );
			if($distributor_contact_fname != ''){
				$contact_info = array();
				foreach ( $distributor_contact_fname as $key=>$name ) {
					$contact_info[] = array( 'fname' => $name, 'lname' => $distributor_contact_lname[ $key ], 'phone' => $distributor_contact_phone[ $key ], 'email' => $distributor_contact_email[ $key ] );	
				}
				update_user_meta( $user_id, 'distributor_contact_info', $contact_info );
			}
			// $user_role[] = 'author';
			// update_user_meta( $user_id, 'wp_capabilities', $user_role );
			update_user_meta( $user_id, 'distributor_name', $distributor_name );
			update_user_meta( $user_id, 'distributor_store_address', $distributor_store_address );
			update_user_meta( $user_id, 'distributor_phone_number', $distributor_phone_number );
			update_user_meta( $user_id, 'distributor_fax_number', $distributor_fax_number );
			
			

			$redirect_url = admin_url('admin.php?page=distributors-lists');
			$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);

			die;
       }

	        
	    public function  perma_admin_footer_load_html(){
	        echo '<div class="perma-admin-loader" style="display:none">';
	            echo '<div class="perma-load-image"><img src="'.plugin_dir_url( __FILE__ ).'images/loader-1.gif" alt=""></div>';
	            echo '<div class="perma-black-overlay"></div>';
	        echo '</div>';
        }

        //edit distributor
        public function pmsafe_edit_distributor_form_function(){
        	$user_id = $_POST['pmsafe_distributor_id'];

			$edit_name = $_POST['pmsafe_distributor_name'];
			$edit_email = $_POST['pmsafe_distributor_email'];
			$edit_store_address = $_POST['pmsafe_distributor_store_address'];
			$edit_phone_number = $_POST['pmsafe_distributor_phone_number'];
			$edit_fax_number = $_POST['pmsafe_distributor_fax_number'];
			$new_password = $_POST['pmsafe_distributor_password'];
			
			$distributor_contact_fname = $_POST['pmsafe_distributor_contact_fname'];
			$distributor_contact_lname = $_POST['pmsafe_distributor_contact_lname'];
			$distributor_contact_phone = $_POST['pmsafe_distributor_contact_phone'];
			$distributor_contact_email = $_POST['pmsafe_distributor_contact_email'];
			
			if($distributor_contact_fname != ''){
				$contact_info = array();
				foreach ( $distributor_contact_fname as $key=>$name ) {
					$contact_info[] = array( 'fname' => $name, 'lname' => $distributor_contact_lname[ $key ], 'phone' => $distributor_contact_phone[ $key ], 'email' => $distributor_contact_email[ $key ] );	
				}
				update_user_meta( $user_id, 'distributor_contact_info', $contact_info );
			}

			$user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $edit_email ) );
			update_user_meta( $user_id, 'distributor_name', $edit_name );
			update_user_meta( $user_id, 'distributor_store_address', $edit_store_address );
			update_user_meta( $user_id, 'distributor_phone_number', $edit_phone_number );
			update_user_meta( $user_id, 'distributor_fax_number', $edit_fax_number );
			if($new_password != ''){
				wp_set_password( $new_password, $user_id );
			}

			$redirect_url = admin_url('admin.php?page=distributors-lists');
			$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
        }

        //delete distributor
        public function pmsafe_delete_distributor_form_function(){
        	$user_id = $_POST['pmsafe_distributor_id'];
        	wp_delete_user( $user_id );
        	delete_user_meta($user_id, 'distributor_name');
        	delete_user_meta($user_id, 'distributor_store_address');
        	delete_user_meta($user_id, 'distributor_phone_number');
        	delete_user_meta($user_id, 'distributor_fax_number');
        	delete_user_meta($user_id, 'distributor_contact_info');
        	$redirect_url = admin_url('admin.php?page=distributors-lists');
        	$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
        }

        //add dealer
        public function pmsafe_register_dealer_form_function(){
        	$user_prefix = 'S';
	       	$dealers = get_users( 'role=contributor&orderby=ID&order=DESC' );
	    	$last_id = $dealers[0]->user_login;
			
			if( empty($dealers)){	
				$numbers = 1000 + 1;
				$dealers_code = $user_prefix . $numbers;	
				
			}
			else{				
				$first_ltr = substr($last_id, 0, 2);
				$numbers = substr($last_id, 1);
				$numbers = $numbers + 1;
				$dealers_code = $user_prefix . $numbers;
				// $dealers_code = 'S1001';
					
			}
			$dealer_name = $_POST['pmsafe_dealer_name'];
			$dealer_email = $_POST['pmsafe_dealer_email'];
			$dealer_password = $_POST['pmsafe_dealer_password'];


			$dealer_store_address = $_POST['pmsafe_dealer_store_address'];
			$dealer_phone_number = $_POST['pmsafe_dealer_phone_number'];
			$dealer_fax_number = $_POST['pmsafe_dealer_fax_number'];
			$dealer_distributor = $_POST['pmsafe_dealer_distributor'];

			$dealer_contact_fname = $_POST['pmsafe_dealer_contact_fname'];
			$dealer_contact_lname = $_POST['pmsafe_dealer_contact_lname'];
			$dealer_contact_phone = $_POST['pmsafe_dealer_contact_phone'];
			$dealer_contact_email = $_POST['pmsafe_dealer_contact_email'];
			$dealer_contact_password = $_POST['pmsafe_dealer_contact_password'];

			
			// echo 'test'.$user_id;die;
			$user_id = wp_create_user($dealers_code,$dealer_password,$dealer_email);
			$set_user_role = new WP_User( $user_id );
			$set_user_role->set_role( 'contributor' );
			if($dealer_contact_fname != ''){
				
				foreach ( $dealer_contact_fname as $key=>$name ) {
					
					$contact_id = wp_create_user( $dealer_contact_email[ $key ], $dealer_contact_password[ $key ], $dealer_contact_email[ $key ] );
					$set_user_role = new WP_User( $contact_id );
					$set_user_role->set_role( 'dealer-user' );
					update_user_meta( $contact_id, 'contact_fname', $name );	
					update_user_meta( $contact_id, 'contact_lname', $dealer_contact_lname[ $key ] );	
					update_user_meta( $contact_id, 'contact_phone', $dealer_contact_phone[ $key ] );	
					update_user_meta( $contact_id, 'contact_dealer_id', $user_id );	
					// $dealer_contact_info[] = array( 'fname' => $name, 'lname' => $dealer_contact_lname[ $key ], 'phone' => $dealer_contact_phone[ $key ], 'email' => $dealer_contact_email[ $key ] );	
				}
				
			}
			// die;
			// $user_role[] = 'contributor';
			// update_user_meta( $user_id, 'wp_capabilities', serialize($user_role) );
			update_user_meta( $user_id, 'dealer_name', $dealer_name );
			update_user_meta( $user_id, 'dealer_store_address', $dealer_store_address );
			update_user_meta( $user_id, 'dealer_phone_number', $dealer_phone_number );
			update_user_meta( $user_id, 'dealer_fax_number', $dealer_fax_number );
			update_user_meta( $user_id, 'dealer_distributor_name', $dealer_distributor );
			
			$redirect_url = admin_url('admin.php?page=dealers-lists');
			$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
        }	
        
        //edit dealer
        public function pmsafe_edit_dealer_form_function(){
			// pr($_POST);
			// die;
        	$user_id = $_POST['pmsafe_dealer_id'];
        	$dealer_code = $_POST['pmsafe_dealer_code'];
			$edit_name = $_POST['pmsafe_dealer_name'];
			$edit_email = $_POST['pmsafe_dealer_email'];
			$edit_store_address = $_POST['pmsafe_dealer_store_address'];
			$edit_phone_number = $_POST['pmsafe_dealer_phone_number'];
			$edit_fax_number = $_POST['pmsafe_dealer_fax_number'];
			$new_password = $_POST['pmsafe_dealer_password'];
			
			$dealer_contact_id = $_POST['pmsafe_dealer_contact_id'];
			$dealer_contact_fname = $_POST['pmsafe_dealer_contact_fname'];
			$dealer_contact_lname = $_POST['pmsafe_dealer_contact_lname'];
			$dealer_contact_phone = $_POST['pmsafe_dealer_contact_phone'];
			$dealer_contact_email = $_POST['pmsafe_dealer_contact_email'];
			$dealer_distributor = $_POST['pmsafe_dealer_distributor'];
			$dealer_contact_password = $_POST['pmsafe_dealer_contact_password'];

			
			
			$user_id = wp_update_user( array( 'ID' => $user_id, 'user_email' => $edit_email ) );
			// pr($dealer_contact_password);
			if($dealer_contact_fname != ''){
				
				foreach ( $dealer_contact_fname as $key=>$name ) {
					
					$contact_id = $dealer_contact_id[ $key ];

					
					// $contact_id = wp_update_user( array( 'ID' => $contact_id, 'user_email' => $dealer_contact_email[ $key ] ) );
					
						if($dealer_contact_password[$key] != ''){
							$pass = $dealer_contact_password[$key];
							wp_set_password( $pass, $contact_id );
							
						}
						
							$userdata = array(
								'ID' => $contact_id, // ID of existing user
								'user_login' =>  $dealer_contact_email[$key],
								'user_email' =>  $dealer_contact_email[$key],
								// 'user_pass'  =>  $pass // no plain password here!
							); 
						
						$contact_id = wp_insert_user( $userdata ) ;
						$set_user_role = new WP_User( $contact_id );
						$set_user_role->set_role( 'dealer-user' );
						
						update_user_meta( $contact_id, 'contact_fname', $name );	
						update_user_meta( $contact_id, 'contact_lname', $dealer_contact_lname[ $key ] );	
						update_user_meta( $contact_id, 'contact_phone', $dealer_contact_phone[ $key ] );	
						update_user_meta( $contact_id, 'contact_dealer_id', $user_id );
					

					// $dealer_contact_info[] = array( 'fname' => $name, 'lname' => $dealer_contact_lname[ $key ], 'phone' => $dealer_contact_phone[ $key ], 'email' => $dealer_contact_email[ $key ] );	
				}
			}
			

			update_user_meta( $user_id, 'dealer_name', $edit_name );
			update_user_meta( $user_id, 'dealer_store_address', $edit_store_address );
			update_user_meta( $user_id, 'dealer_phone_number', $edit_phone_number );
			update_user_meta( $user_id, 'dealer_fax_number', $edit_fax_number );
			update_user_meta( $user_id, 'dealer_distributor_name', $dealer_distributor );
			if($new_password != ''){
				wp_set_password( $new_password, $user_id );
			}

			$redirect_url = admin_url('admin.php?page=dealers-lists');
			
				$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
		}
		

		
        //delete dealer
        public function pmsafe_delete_dealer_form_function(){
        	$user_id = $_POST['pmsafe_dealer_id'];
			wp_delete_user( $user_id );
			global $wpdb;
			$contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_dealer_id" AND wum.meta_value ='.$user_id);
        	foreach ($contact_info as $key => $value) {
				$contact_id = $value->user_id;
				wp_delete_user( $contact_id );
			}
        	delete_user_meta($user_id, 'dealer_name');
        	delete_user_meta($user_id, 'dealer_store_address');
        	delete_user_meta($user_id, 'dealer_phone_number');
        	delete_user_meta($user_id, 'dealer_fax_number');
        	delete_user_meta($user_id, 'dealer_distributor_name');
        	delete_user_meta($user_id, 'dealer_contact_info');
        	$redirect_url = admin_url('admin.php?page=dealers-lists');
        	$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
		}

		//delete dealer contact
		public function pmsafe_delete_dealer_contact_form_function(){
        	$user_id = $_POST['contact_id'];
			wp_delete_user( $user_id );
			
        	$redirect_url = admin_url('admin.php?page=dealers-lists');
        	$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
		}
		
		//edit customer
        public function pmsafe_edit_customer_form_function(){
			$user_id = $_POST['pmsafe_customer_id'];

			$file = $_FILES['file_upload'];
			// pr($file);
			if($_FILES['file_upload']['type'] != 'application/pdf'){
				$error = 'Unsupported filetype uploaded. Please upload PDF file.';
			}
			
			
			// Check if the file exists
			if(file_exists(plugin_dir_path( __DIR__ ).'upload-pdf/' . $_FILES['file_upload']['name'])){
				$error = 'File with that name already exists.';
			}
			if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], plugin_dir_path( __DIR__ ).'upload-pdf/' . $_FILES['file_upload']['name'])){
				$error = 'Error uploading file - check destination is writeable.';
			}
			if($file){
				$new_pdf_link = site_url().'/wp-content/plugins/permasafe-user-pro/upload-pdf/'.$_FILES['file_upload']['name'];
			}
			
			$nickname = $_POST['pmsafe_customer_code'];
			$fname = $_POST['pmsafe_customer_fname'];
			$lname = $_POST['pmsafe_customer_lname'];
			$address1 = $_POST['pmsafe_customer_address1'];
			$address2 = $_POST['pmsafe_customer_address2'];
			$city = $_POST['pmsafe_customer_city'];
			$state = $_POST['pmsafe_customer_state'];
			$zip = $_POST['pmsafe_customer_zip'];
			$phone = $_POST['pmsafe_customer_phone_number'];
			$new_password = $_POST['pmsafe_customer_password'];
			
			$year = $_POST['pmsafe_customer_vehicle_year'];
			$make = $_POST['pmsafe_customer_vehicle_make'];
			$model = $_POST['pmsafe_customer_vehicle_model'];
			$mileage = $_POST['pmsafe_customer_vehicle_mileage'];
			$vin = $_POST['pmsafe_customer_vehicle_vin'];
			
			$vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);
    		$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
    		$pdf_link = $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
    		$registration_date = $vehicle_info[0][$nickname]['pmsafe_registration_date'];
			$code = $vehicle_info[0][$nickname]['pmsafe_member_number'];
			$login = get_post_meta($post_id,'_pmsafe_dealer', true);
        	$users = get_user_by('login',$login);
			$dealer_id = $users->ID;
			
			$user_id = wp_update_user( array( 'ID' => $user_id ) );
			update_user_meta( $user_id, 'first_name', $fname );
			update_user_meta( $user_id, 'last_name', $lname );
			update_user_meta( $user_id, 'pmsafe_address_1', $address1 );
			update_user_meta( $user_id, 'pmsafe_address_2', $address2 );
			update_user_meta( $user_id, 'pmsafe_city', $city );
			update_user_meta( $user_id, 'pmsafe_state', $state );
			update_user_meta( $user_id, 'pmsafe_zipcode', $zip );
			update_user_meta( $user_id, 'pmsafe_phone_number', $phone );
			if($year != ''){
				$customer_vehicle_info = array();
				if(isset($file)){
					if($_FILES["file_upload"]["error"] == 4){
						$customer_vehicle_info[$nickname] = array( 'pmsafe_vehicle_year' => $year,
						'pmsafe_vehicle_make' => $make,
						'pmsafe_vehicle_model' => $model,
						'pmsafe_vin' => $vin,
						'pmsafe_vehicle_mileage' => $mileage,
						'pmsafe_registration_date' => $registration_date,
						'pmsafe_member_number' => $code,
						'pmsafe_member_code_id' => $post_id,
						'pmsafe_pdf_link' => $pdf_link );	
						update_user_meta( $user_id, 'pmsafe_vehicle_info', $customer_vehicle_info );	
					}else{
						$customer_vehicle_info[$nickname] = array( 'pmsafe_vehicle_year' => $year,
						'pmsafe_vehicle_make' => $make,
						'pmsafe_vehicle_model' => $model,
						'pmsafe_vin' => $vin,
						'pmsafe_vehicle_mileage' => $mileage,
						'pmsafe_registration_date' => $registration_date,
						'pmsafe_member_number' => $code,
						'pmsafe_member_code_id' => $post_id,
						'pmsafe_pdf_link' => $new_pdf_link );	
						update_user_meta( $user_id, 'pmsafe_vehicle_info', $customer_vehicle_info );
						update_post_meta($post_id,'pmsafe_pdf_link',$new_pdf_link);
					}
				}else{

					$customer_vehicle_info[$nickname] = array( 'pmsafe_vehicle_year' => $year,
					'pmsafe_vehicle_make' => $make,
					'pmsafe_vehicle_model' => $model,
					'pmsafe_vin' => $vin,
					'pmsafe_vehicle_mileage' => $mileage,
					'pmsafe_registration_date' => $registration_date,
					'pmsafe_member_number' => $code,
					'pmsafe_member_code_id' => $post_id,
					'pmsafe_pdf_link' => $pdf_link );	
					update_user_meta( $user_id, 'pmsafe_vehicle_info', $customer_vehicle_info );
				}
			}
			if($new_password != ''){
				wp_set_password( $new_password, $user_id );
			}

			$redirect_url = admin_url('admin.php?page=customers-lists&action=view_customer_details&id='.$user_id);
			if($error != ''){
				if($_FILES["file_upload"]["error"] == 4){
					$response = array('status' => true,'redirect'=>$redirect_url);
				}else{
					$response = array('status' => false,'error'=>$error);
				}
			}
			else{
				$response = array('status' => true,'redirect'=>$redirect_url);
			}
			// $response = array('status' => true);
            echo json_encode($response);
        	die;
		}
		
		//delete dealer customer
		public function pmsafe_delete_customer_form_function(){
			$user_id = $_POST['pmsafe_customer_id'];
			$nickname = get_user_meta($user_id,'nickname', true);
			
			$vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);
			// pr($vehicle_info);
			$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
			// echo 'post'.$post_id;
			// die;
			$login = get_post_meta($post_id,'_pmsafe_dealer', true);
        	$users = get_user_by('login',$login);
			$dealer_id = $users->ID;
			
			update_post_meta($post_id,'_pmsafe_code_status','available');
			
        	wp_delete_user( $user_id );
        	delete_post_meta( $post_id, '_pmsafe_used_code_user_name' );
			delete_post_meta( $post_id, '_pmsafe_used_code_date' );
			delete_post_meta( $post_id, 'pmsafe_pdf_link' );

        	$redirect_url = admin_url('admin.php?page=customers-lists&action=view_customer&dealer='.$dealer_id);
        	$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
		}
		
		//delete customers
		public function pmsafe_delete_customers_form_function(){
			$user_id = $_POST['pmsafe_customer_id'];
			$nickname = get_user_meta($user_id,'nickname', true);
			
			$vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);
			// pr($vehicle_info);
			$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
    		// echo 'post'.$post_id;
			$login = get_post_meta($post_id,'_pmsafe_dealer', true);
        	$users = get_user_by('login',$login);
			$dealer_id = $users->ID;
			update_post_meta($post_id,'_pmsafe_code_status','available');
			
        	wp_delete_user( $user_id );
        	delete_post_meta( $post_id, '_pmsafe_used_code_user_name' );
			delete_post_meta( $post_id, '_pmsafe_used_code_date' );
			delete_post_meta( $post_id, 'pmsafe_pdf_link' );

        	$redirect_url = admin_url('admin.php?page=customers-lists');
        	$response = array('status' => true,'redirect'=>$redirect_url);
            echo json_encode($response);
        	die;
        }

        //get customer in csv
        public function get_customer_csv_data(){
        	$dealer_login = $_POST['customer_dealer_login'];
        	
        	$dealer_user = get_user_by('login',$dealer_login);
        	$dealer_id = $dealer_user->data->ID;
        	$distributor_id = get_user_meta( $dealer_id, 'dealer_distributor_name' , true );
        	$distributor_name = get_user_meta( $distributor_id, 'distributor_name' , true );
        	$name = get_user_meta( $dealer_id, 'dealer_name' , true );
        	
        	$args = array(
		        'post_type' => 'pmsafe_bulk_invi',
		        'post_status' => 'publish',
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
    	$response .= "Member code,Benefits Package,Bulk Member,Code status,Member Name,Email Address,Dealer,Distributor,Date Created,Date Used,PDF\r\n";
	    	foreach ($posts as $key => $value) {
	    		$post_id = $value->ID;
	            $bulk_member = $value->post_title;
	            $invitation_ids = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
	            $benefits_package = get_post_meta( $post_id, '_pmsafe_invitation_prefix', true );
	            $invitation_id = explode(',',$invitation_ids);
	            $data = pmsafe_unused_code_count($post_id);
	            $available = $data['total'] - $data['used'];

	            foreach ($invitation_id as $id) {
	            	$code_status = get_post_meta($id, '_pmsafe_code_status', true);
	                if($code_status == 'used'){
	                	$code = get_post_meta( $id, '_pmsafe_invitation_code', true );
	                    
	                    $pdf_link = get_post_meta( $id, 'pmsafe_pdf_link', true );
	                    
	                    $customer_user = get_user_by('login',$code);
	                    $customer_name = $customer_user->first_name.' '.$customer_user->last_name;
	                    $created_date = get_post_meta($id, '_pmsafe_code_create_date', true);
	                    $used_date = get_post_meta($id, '_pmsafe_used_code_date', true);
	                

	                $response .= $customer_user->user_login.','.$benefits_package.','.$bulk_member.','.$code_status.','.$customer_name.','.$customer_user->user_email.','.$name.','.$distributor_name.','.$created_date.','.$used_date.','."=HYPERLINK(\"".$pdf_link."\")"."\r\n";


	            	}
	            }
	        }
        	echo $response;
        	die;
        }

        public function reset_code_function(){
			$post_id = $_POST['post_id'];
			$bulk_id = get_post_meta($post_id,'_pmsafe_bulk_invitation_id',true);
			$bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
			
        	$member_code = get_post_meta( $post_id, '_pmsafe_invitation_code', true );
        	$user = get_user_by( 'login', $member_code );
        	
			$exist_status = get_post_meta( $post_id, '_pmsafe_code_status', true );
			update_post_meta($post_id,'_pmsafe_code_prefix',$bulk_prefix);
        	if($exist_status == 'used'){
				update_post_meta($post_id,'_pmsafe_code_status','available');
				update_post_meta($post_id,'_pmsafe_code_prefix',$bulk_prefix);
        		if ( $user ) { // get_user_by can return false, if no such user exists
			    	wp_delete_user( $user->ID );
				}
				delete_post_meta( $post_id, '_pmsafe_used_code_user_name' );
				delete_post_meta( $post_id, '_pmsafe_used_code_date' );
				delete_post_meta( $post_id, 'pmsafe_pdf_link' );
				delete_post_meta( $post_id, 'is_upgraded' );
				delete_post_meta( $post_id, 'upgraded_date' );
				delete_post_meta( $post_id, 'upgraded_by' );
				delete_post_meta( $post_id, 'updated_selling_price' );
				delete_post_meta( $post_id, 'updated_selling_price_by' );

        		$response = 'Code reset Successfully.';
        	}else if($exist_status == 'available'){
				
        		$response = 'This code is available.You can\'t reset it.';
        	}
        	echo $response;
        	die;
        }

        public function search_batch_code_function(){
        	
	        	$search_val = $_POST['search_val'];
	        	global $wpdb;
	        	$html = '';
	        	$sql = "SELECT post_id,meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_invitation_code_start' AND post_id = (SELECT meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_bulk_invitation_id' AND post_id = (SELECT post_id FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' AND meta_value = '".$search_val."'))";
	        	$result_start = $wpdb->get_row($sql);
	        	$post_id = $result_start->post_id;
	        	$start = $result_start->meta_value;

	        	$sql_query = "SELECT post_id,meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_invitation_code_end' AND post_id = (SELECT meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_bulk_invitation_id' AND post_id = (SELECT post_id FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' AND meta_value = '".$search_val."'))";

	        	$result_end = $wpdb->get_row($sql_query);
	        	$end = $result_end->meta_value;
	        	if( $search_val >= $start &&  $search_val <= $end){
	        		$html .= '<tr id="post-'.$post_id.'" class="iedit author-self level-0  type-pmsafe_bulk_invi status-publish hentry">';
	        			$html .= '<th scope="row" class="check-column">';
	        			$html .= '<label class="screen-reader-text" for="cb-select-'.$post_id.'">Select '.$start.'-'.$end.'</label>';
	        			$html .= '<input id="cb-select-'.$post_id.'" type="checkbox" name="post[]" value="'.$post_id.'">';
	        			$html .= '<div class="locked-indicator"><span class="locked-indicator-icon" aria-hidden="true"></span>
					<span class="screen-reader-text">\"'.$start.'-'.$end.'\" is locked</span></div>';
	        			$html .= '</th>';
		
		        		$html .= '<td class="invitation_code column-invitation_code has-row-actions column-primary" data-colname="Member code">';
		        			$html .= '<a href="'.admin_url().'edit.php?post_type=pmsafe_invitecode&bulk-invitation-id='.$post_id.'" target="_blank" class="button-secondary">'.$start .' - '. $end.'</a>';
		        		$html .= '</td>';

		        		$html .= '<td class="benefits_package column-benefits_package" data-colname="Benefits Package">';
		        			$html .= '<code>'.get_post_meta( $post_id, '_pmsafe_invitation_prefix', true ).'</code>'; 
		        		$html .= '</td>';

		        		$html .= '<td class="dealer column-dealer" data-colname="Dealer">';
			        		$dealer_login = get_post_meta( $post_id, '_pmsafe_dealer', true ); 
	                        $dealers = get_user_by('login', $dealer_login);
	                        $dealer_id = $dealers->data->ID;
	                        $dealer_name = get_user_meta( $dealer_id, 'dealer_name', true);
		        			$html .= $dealer_name; 
		        		$html .= '</td>';

		        		$html .= '<td class="distributor column-distributor" data-colname="Distributor">';
			        		$distributor_login = get_post_meta( $post_id, '_pmsafe_distributor', true ); 
	                        $distributors = get_user_by('login', $distributor_login);
	                        $distributor_id = $distributors->data->ID;
	                        $distributor_name = get_user_meta( $distributor_id, 'distributor_name', true);
		        			$html .= $distributor_name; 
		        		$html .= '</td>';

		        		$html .= '<td class="date_create column-date_create" data-colname="Date created">';
		        			$html .= get_post_meta( $post_id, '_pmsafe_code_create_date', true ); 
		        		$html .= '</td>';

		        		$html .= '<td class="date_edit column-date_edit" data-colname="Date edited">';
		        			$html .= get_post_meta( $post_id, '_pmsafe_date_updated', true ); 
		        		$html .= '</td>';

		        		$html .= '<td class="count_unused_code column-count_unused_code" data-colname="Count unused">';
		        			$data = pmsafe_unused_code_count($post_id);
                        	$html .= '<a href="#" title="'.$data['used'].' used out of '.$data['total'].'"><b><span style="color:red;">'.$data['used'].'</span>/<span style="color:green;">'.$data['total'].'</span></b></a>';
		        		$html .= '</td>';

		        		$html .= '<td class="edit_code column-edit_code" data-colname="Edit">';
							$html .= '<a href="'.admin_url('post.php?post='.$post_id.'&action=edit').'"><i class="fa fa-edit"></i></a>';
						$html .= '</td>';
						
						$html .= '<td class="delete_code column-delete_code" data-colname="Delete">';
							$html .= '<i class="fa fa-trash" id="delete_code_button" style="cursor:pointer;color:#ff3800" data-id="'.$post_id.'"></i>';
		        		$html .= '</td>';
	    
	        		$html .= '</tr>';
	        		
	        	}else{
	        		$html .= '<tr class="no-items"><td class="colspanchange" colspan="9">No Batch Member Codes found.</td></tr>';
	        	}
	        	echo $html;
        	
        	die;
        }

        public function add_search_box(){
        	if(get_post_type( get_the_ID() ) == 'pmsafe_bulk_invi'){
        	?>
        	<script type="text/javascript">
        		jQuery(document).ready(function(){
        			jQuery('#search-submit').css('display','none');
        			jQuery('#post-search-input').css('display','none');
        			jQuery(".search-box").append("<input type='search' id='search-input' value=''><input type='button' id='search-batch-code' class='button' value='Search Batch Member Codes'>");
        		});
        	</script>
        	<?php
        	}
        }

		public function admin_reports(){
			global $wpdb;
        		$current_user = wp_get_current_user();
        		$role = (array) $current_user->caps;
        		// if($role['author'] == 1) 
          //   	{	
                    $member_code = $_POST['member_code'];
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $address = $_POST['address'];
                    $phone_number = $_POST['phone_number'];
                    $email = $_POST['email'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip_code = $_POST['zip_code'];
                    $vehicle_year = $_POST['vehicle_year'];
                    $vehicle_make = $_POST['vehicle_make'];
                    $vehicle_model = $_POST['vehicle_model'];
                    $vehicle_vin = $_POST['vehicle_vin'];

					$login =$_POST['dealer_login'];
					
                    // if($role['author'] == 1) 
                    // {   
                    //     $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "'.$login.'"))))');
                    // }
                    // if($role['contributor'] == 1) {
                        
                    
					// }
					$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "'.$login.'")');
                    $str = '';
                    foreach ($user_query as $value_query) {
                        $str = $value_query->meta_value.','.$str;
                    }

                    $str = rtrim($str,",");
                    // echo $str;
                    $str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.') ');
                    // pr($str_results);
                    $check_array = array();
                    foreach ($str_results as $str_result) {
                        $check_array[] = $str_result->meta_value;
                    }
                    
                            
                        $mysql = 'SELECT distinct(user_id) FROM wp_usermeta';
                        $where = '';
                        if($member_code != ''){
                            $where .= " AND meta_key = 'nickname' AND meta_value = '".$member_code."'"; 
                        }
                        if($first_name != ''){
                         $first_name = trim($first_name, ' '); 
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'first_name' AND meta_value LIKE '".$first_name."%' )"; 
                        }
                        if($last_name != ''){
                          $last_name = trim($last_name, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'last_name' AND meta_value LIKE '".$last_name."%' )"; 
                        }
                        if($address != ''){
                        $address = trim($address, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_address_1' AND meta_value LIKE '%".$address."%' )"; 
                        }
                        if($phone_number != ''){
                         $phone_number = trim($phone_number, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_phone_number' AND meta_value LIKE '%".$phone_number."%' )"; 
                        }
                        if($email != ''){
                        $email = trim($email, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_email' AND meta_value = '".$email."' )"; 
                        }
                        if($city != ''){
                        $city = trim($city, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_city' AND meta_value = '".$city."' )"; 
                        }
                        if($state != ''){
                        $state = trim($state, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_state' AND meta_value = '".$state."' )"; 
                        }
                        if($zip_code != ''){
                        $zip_code = trim($zip_code, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_zip_code' AND meta_value = '".$zip_code."' )"; 
                        }
                        if($vehicle_year != ''){
                         $vehicle_year = trim($vehicle_year, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_year\";s:[0-9]+:\"".$vehicle_year."\".*')"; 
                        }
                        if($vehicle_make != ''){
                         $vehicle_make = trim($vehicle_make, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_make\";s:[0-9]+:\"".$vehicle_make."\".*')"; 
                        }
                        if($vehicle_model != ''){
                         $vehicle_model = trim($vehicle_model, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_model\";s:[0-9]+:\"".$vehicle_model."\".*')"; 
                        }
                        if($vehicle_vin != ''){
                         $vehicle_vin = trim($vehicle_vin, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vin\";s:[0-9]+:\"".$vehicle_vin."\".*')"; 
                        }
                        if(!empty($where))
                            $where = ' where 1=1 '.$where;

                        $sql = $mysql.$where;
                        

                            $query = $wpdb->get_results($sql);
                            // pr($query);
                            $html .= '<table id="search_tbl">';
                             $html .= '<thead>';
                                $html .= '<tr>';
                                    
                                    $html .= '<th>';
                                        $html .= 'MemberCode';
                                    $html .= '</th>';

                                     $html .= '<th>';
                                        $html .= 'First Name';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'Last Name';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'Address';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'PDF';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'PDF';
                                    $html .= '</th>';

                                $html .= '</tr>';
                             $html .= '</thead>';
                              $html .= '<tbody>';
                             
                                
                                foreach ($query as $key => $value) {
                                    // echo $value->user_id.'<br/>';
									$nickname = get_user_meta($value->user_id,'nickname', true);
									
                                    if(in_array($nickname,$check_array)){
                                        // echo $nickname.'<br/>';
                                    
                                        $html .= '<tr>';
                                        
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
                                            $html .= '</td>';
                                            
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
                                            $html .= '</td>';
                                            
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
                                            $html .= '</td>';
                                            
                                            $address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
                                            $address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
                                            $city = get_user_meta($value->user_id,'pmsafe_city',true);
                                            $state = get_user_meta($value->user_id,'pmsafe_state',true);
                                            $zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
                                            $html .= '</td>';

                                            $vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
                                          
                                                $url = get_site_url().'/wp-includes/images/media/document.png';
                                                $html .= '<td>';
                                                    $html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
                                                $html .= '</td>';
                                                
                                                $html .= '<td class="nisl-pdf-link">';
                                                            $html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
                                                $html .= '</td>';
                                            //}
                                        $html .= '</tr>';
                                    }
                                }
                            //}
                            $html .= '</tbody>';
                            $html .= '</table>';


                        
                        
                       
                        echo $html;   
            	
			

       		die;
		}

		public function admin_all_reports(){

			global $wpdb;
				$current_user = wp_get_current_user();
				// pr($current_user);
				// die;
        		$role = (array) $current_user->caps;
        		// if($role['author'] == 1) 
          //   	{	
                    $member_code = $_POST['member_code'];
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $address = $_POST['address'];
                    $phone_number = $_POST['phone_number'];
                    $email = $_POST['email'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip_code = $_POST['zip_code'];
                    $vehicle_year = $_POST['vehicle_year'];
                    $vehicle_make = $_POST['vehicle_make'];
                    $vehicle_model = $_POST['vehicle_model'];
					$vehicle_vin = $_POST['vehicle_vin'];
					$dealer_name = $_POST['dealer_name'];
					$distributor_name = $_POST['distributor_name'];
					// $login =$_POST['dealer_login'];

					$var = 0;
					// if($dealer_name != ''){
					// 	$var = 1;
					// }
                    // if($role['author'] == 1) 
                    // {   
                    //     $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "'.$login.'"))))');
                    // }
                    // if($role['contributor'] == 1) {
                        
                    
					// }
					$args = array(
						'role'         => 'subscriber',
					);
					$user_query = get_users( $args );
                    $str = '';
                    foreach ($user_query as $value_query) {
						// $str = $value_query->ID.','.$str;
						$check_array[] = $value_query->ID;
                    }
					
                    
                    // pr($check_array);
                            
                        $mysql = 'SELECT distinct(user_id) FROM wp_usermeta';
                        $where = '';
                        if($member_code != ''){
                            $where .= " AND meta_key = 'nickname' AND meta_value = '".$member_code."'"; 
                        }
                        if($first_name != ''){
                         $first_name = trim($first_name, ' '); 
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'first_name' AND meta_value LIKE '".$first_name."%' )"; 
                        }
                        if($last_name != ''){
                          $last_name = trim($last_name, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'last_name' AND meta_value LIKE '".$last_name."%' )"; 
                        }
                        if($address != ''){
                        $address = trim($address, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_address_1' AND meta_value LIKE '%".$address."%' )"; 
                        }
                        if($phone_number != ''){
                         $phone_number = trim($phone_number, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_phone_number' AND meta_value LIKE '%".$phone_number."%' )"; 
                        }
                        if($email != ''){
                        $email = trim($email, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_email' AND meta_value = '".$email."' )"; 
                        }
                        if($city != ''){
                        $city = trim($city, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_city' AND meta_value = '".$city."' )"; 
                        }
                        if($state != ''){
                        $state = trim($state, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_state' AND meta_value = '".$state."' )"; 
                        }
                        if($zip_code != ''){
                        $zip_code = trim($zip_code, ' ');
                            $where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_zip_code' AND meta_value = '".$zip_code."' )"; 
                        }
                        if($vehicle_year != ''){
                         $vehicle_year = trim($vehicle_year, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_year\";s:[0-9]+:\"".$vehicle_year."\".*')"; 
                        }
                        if($vehicle_make != ''){
                         $vehicle_make = trim($vehicle_make, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_make\";s:[0-9]+:\"".$vehicle_make."\".*')"; 
                        }
                        if($vehicle_model != ''){
                         $vehicle_model = trim($vehicle_model, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_model\";s:[0-9]+:\"".$vehicle_model."\".*')"; 
                        }
                        if($vehicle_vin != ''){
                         $vehicle_vin = trim($vehicle_vin, ' ');
                            $where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vin\";s:[0-9]+:\"".$vehicle_vin."\".*')"; 
						}
						if($dealer_name != ''){
							$dealer_name = trim($dealer_name, ' ');
							$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "'.$dealer_name.'")'); 
							$str = '';
							foreach ($user_query as $value_query) {
								$str = $value_query->meta_value.','.$str;
							}
							$str = rtrim($str,",");
							// echo $str;
							// $str_results = $wpdb->get_results(' SELECT ID FROM wp_users WHERE user_login in (SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.')) ');

							$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key = 'nickname' AND meta_value in (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' and post_id in (".$str.")))";
							// pr($str_results);
						}

						if($distributor_name != ''){
							$distributor_name = trim($distributor_name, ' ');

							$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "'.$distributor_name.'"))))'); 
							$str = '';
							foreach ($user_query as $value_query) {
								$str = $value_query->meta_value.','.$str;
							}
							$str = rtrim($str,",");
							// echo $str;
							// $str_results = $wpdb->get_results(' SELECT ID FROM wp_users WHERE user_login in (SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.')) ');

							$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key = 'nickname' AND meta_value in (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' and post_id in (".$str.")))";
							// pr($str_results);
						}

                        if(!empty($where))
                            $where = ' where 1=1 '.$where;

                        $sql = $mysql.$where;
                        // echo $sql;

                            $query = $wpdb->get_results($sql);
                            // pr($query);
                            $html .= '<table id="search_tbl">';
                             $html .= '<thead>';
                                $html .= '<tr>';
                                    
                                    $html .= '<th>';
                                        $html .= 'Member<br/>Code';
                                    $html .= '</th>';

                                     $html .= '<th>';
                                        $html .= 'First<br/>Name';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'Last<br/>Name';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'Address';
                                    $html .= '</th>';

                                    $html .= '<th>';
                                        $html .= 'PDF ';
                                    $html .= '</th>';

                                    $html .= '<th class="nisl-pdf-link">';
                                    $html .= 'PDF';
									$html .= '</th>';

									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Benefits<br/> Package';
									$html .= '</th>';

									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Product Code <br/> Range';
									$html .= '</th>';

									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Dealer Name';
									$html .= '</th>';

									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Distributor Name';
									$html .= '</th>';
									
									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Vehicle <br/> Information';
									$html .= '</th>';
			
									$html .= '<th class="nisl-pdf-link">';
									$html .= 'VIN';
									$html .= '</th>';
			
									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Registration <br/> Date';
									$html .= '</th>';
			
									$html .= '<th class="nisl-pdf-link">';
									$html .= 'Expiration <br/> Date';
									$html .= '</th>';

									$html .= '<th>';
									$html .= 'View Detail';
									$html .= '</th>';

									$html .= '<th>';
									$html .= 'Edit Detail';
									$html .= '</th>';

									$html .= '<th>';
									$html .= 'Delete Detail';
									$html .= '</th>';
									

                                $html .= '</tr>';
                             $html .= '</thead>';
                              $html .= '<tbody>';
                             
                                
                                foreach ($query as $key => $value) {
                                    $user_id = $value->user_id;
									$nickname = get_user_meta($value->user_id,'nickname', true);

									$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
									
									$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
									$benefits_package = get_post_meta($post_id,'_pmsafe_code_prefix',true);
									$term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
                        			$term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );
									
									$posts = get_post($post_id);
									$post_title = $posts->post_title;
									$post_title = substr($post_title, 0, strpos($post_title, ' '));

									$login = get_post_meta($post_id,'_pmsafe_dealer', true);
									$users = get_user_by('login',$login);
									$dealer_id = $users->ID;
									$dealername = get_user_meta($dealer_id,'dealer_name', true);

									$distributor_login = get_post_meta($post_id,'_pmsafe_distributor', true);
									$dis_users = get_user_by('login',$distributor_login);
									$distributor_id = $dis_users->ID;
									$distributorname = get_user_meta($distributor_id,'distributor_name', true);
									
                                    if(in_array($user_id,$check_array)){
                                        // echo $nickname.'<br/>';
                                    
                                        $html .= '<tr>';
                                        
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
                                            $html .= '</td>';
                                            
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
                                            $html .= '</td>';
                                            
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
                                            $html .= '</td>';
                                            
                                            $address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
                                            $address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
                                            $city = get_user_meta($value->user_id,'pmsafe_city',true);
                                            $state = get_user_meta($value->user_id,'pmsafe_state',true);
                                            $zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
                                            $html .= '<td>';
                                                $html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
                                            $html .= '</td>';

                                            
                                          
                                                $url = get_site_url().'/wp-includes/images/media/document.png';
                                                $html .= '<td>';
                                                    $html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
                                                $html .= '</td>';
                                                
                                                $html .= '<td class="nisl-pdf-link">';
                                                        $html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
												$html .= '</td>';

												$html .= '<td class="nisl-pdf-link">';
													$html .= $benefits_package;
												$html .= '</td>';
												
												$html .= '<td class="nisl-pdf-link">';
													$html .= $post_title;
												$html .= '</td>';

												$html .= '<td class="nisl-pdf-link">';
													$html .= $dealername;
												$html .= '</td>';

												$html .= '<td class="nisl-pdf-link">';
													$html .= $distributorname;
												$html .= '</td>';

												$html .= '<td class="nisl-pdf-link">';
													$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
												$html .= '</td>';

													$html .= '<td class="nisl-pdf-link">';
													$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
												$html .= '</td>';

												$html .= '<td class="nisl-pdf-link">';
													$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
												$html .= '</td>';


												$html .= '<td class="nisl-pdf-link">';
													$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
												$html .= '</td>';
												
												$view_customer_details_query_args = array(
													'page'   => 'customers-lists',
													'action' => 'view_customer_details',
													'id'  => $user_id,
												);
					
												$actions['view_customer_details'] = sprintf(
													'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
													esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
													_x( 'view details', 'List table row action', 'wp-list-table-example' )
												);
					
												$html .= '<td class="text-center">';
													$html .= $actions["view_customer_details"];
												$html .= '</td>';
					
					
												$edit_customer_details_query_args = array(
													'page'   => 'customers-lists',
													'action' => 'edit_customer_details',
													'id'  => $user_id,
												);
					
												$actions['edit_customer_details'] = sprintf(
													'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
													esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
													_x( 'edit details', 'List table row action', 'wp-list-table-example' )
												);
					
												$html .= '<td class="text-center">';
													$html .= $actions["edit_customer_details"];
												$html .= '</td>';
					
												$delete_customer_details_query_args = array(
													'page'   => 'customers-lists',
													'action' => 'delete_customer_details',
													'id'  => $user_id,
												);
					
												$actions['delete_customer_details'] = sprintf(
													'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
													esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
													_x( 'delete details', 'List table row action', 'wp-list-table-example' )
												);
					
												$html .= '<td class="text-center">';
													$html .= $actions["delete_customer_details"];
												$html .= '</td>';
												
												
                                            //}
                                        $html .= '</tr>';
                                     }
                                }
                            //}
                            $html .= '</tbody>';
                            $html .= '</table>';


                        
                        
                       
                        echo $html;   
            	
			

       		die;
		}
		
		public function admin_view_data_reports(){
            $user_id = $_POST['id'];
            $nickname = get_user_meta($user_id,'nickname', true);
            $vehicle_info = get_user_meta($user_id,'pmsafe_vehicle_info',false);
            // pr($vehicle_info);
            $post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
            $benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'],'_pmsafe_code_prefix',true);
            $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
			$term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );
			
			$login = get_post_meta($post_id,'_pmsafe_dealer', true);
            $users = get_user_by('login',$login);
            $dealer_id = $users->ID;
			$dealername = get_user_meta($dealer_id,'dealer_name', true);

			$distributor_login = get_post_meta($post_id,'_pmsafe_distributor', true);
			$dis_users = get_user_by('login',$distributor_login);
			$distributor_id = $dis_users->ID;
			$distributorname = get_user_meta($distributor_id,'distributor_name', true);

            $expiration_date = date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
            // $expiration_date = '2019-04-07';
            $current_date = date('Y-m-d');

        	$html .= '<div class="view-data-wrap">';    	
                $html .= '<h3>Customer Details</h3>';
                 $html .= '<p class="expired">EXPIRED ON '.$expiration_date.'</p>';
                 $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Member Code : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'nickname', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';   

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>First Name : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'first_name', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';   
                
                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Last Name : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'last_name', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';   

                $address1 = get_user_meta($user_id,'pmsafe_address_1',true);
                $address2 = get_user_meta($user_id,'pmsafe_address_2',true);

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Address : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$address1.' '.$address2.'</p>';
                    $html .= '</div>';   
                $html .= '</div>';  

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>City : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'pmsafe_city', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';  

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>State : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'pmsafe_state', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';  

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Zip Code : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'pmsafe_zip_code', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';  

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Phone : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'pmsafe_phone_number', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Email : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.get_user_meta($user_id,'pmsafe_email', true).'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Dealer </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$dealername.' ( '.$login.' )'.'</p>';
                    $html .= '</div>';   
				$html .= '</div>';
				
				$html .= '<div class="view-data-wrap-inner">';
					$html .= '<div class="label-input">';           
						$html .= '<label>Dealer </label>';
					$html .= '</div>';          
					$html .= '<div class="input-div">';         
						$html .= '<p>'.$distributorname.' ( '.$distributor_login.' )'.'</p>';
					$html .= '</div>';   
				$html .= '</div>';

                
                $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Vehicle Year : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_year'].'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                 $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Vehicle Make : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_make'].'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                 $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Vehicle Model : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$vehicle_info[0][$nickname]['pmsafe_vehicle_model'].'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                 $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Vehicle VIN : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                        $html .= '<p>'.$vehicle_info[0][$nickname]['pmsafe_vin'].'</p>';
                    $html .= '</div>';   
                $html .= '</div>';

                 $html .= '<div class="view-data-wrap-inner">';
                    $html .= '<div class="label-input">';           
                        $html .= '<label>Status : </label>';
                    $html .= '</div>';          
                    $html .= '<div class="input-div">';         
                    if($current_date > $expiration_date){

                        $html .= '<p class="expired">Expired</p>';
                    }
                    else{
                        $html .= '<p class="active">Active</p>';   
                    }
                    $html .= '</div>';   
                $html .= '</div>';


				
			$html .= '</div>';	    	
        	echo $html;    		
        	exit;
		}
		
		public function admin_quick_filters(){
			global $wpdb;
			$current_user = wp_get_current_user();
			$role = (array) $current_user->caps;
			 $datepicker1 = $_POST['datepicker1'];
			$datepicker2 = $_POST['datepicker2'];
			$select = $_POST['select'];
			$dealer_name = $_POST['dealer_name'];
			$distributor_name = $_POST['distributor_name'];
			if($dealer_name != ''){
				$dealer_name = trim($dealer_name, ' ');
				$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "'.$dealer_name.'")'); 
				$str = '';
				foreach ($user_query as $value_query) {
					$str = $value_query->meta_value.','.$str;
				}
				$str = rtrim($str,",");

				$str_results = $wpdb->get_results(' SELECT ID FROM wp_users WHERE user_login in (SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.')) ');

				foreach ($str_results as $key => $value) {
					$dealer_array[] = $value->ID;
				}
			}

			if($distributor_name != ''){
				$distributor_name = trim($distributor_name, ' ');

				$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "'.$distributor_name.'"))))'); 
				$str = '';
				foreach ($user_query as $value_query) {
					$str = $value_query->meta_value.','.$str;
				}
				$str = rtrim($str,",");

				$str_results = $wpdb->get_results(' SELECT ID FROM wp_users WHERE user_login in (SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.')) ');
				foreach ($str_results as $key => $value) {
					$dis_array[] = $value->ID;
				}
				
			}
			$args = array(
				'role'         => 'subscriber',
			);
			$user_query = get_users( $args );
			$str = '';
			foreach ($user_query as $value_query) {
				// $str = $value_query->ID.','.$str;
				$check_array[] = $value_query->ID;
			}

			$sql .= "SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info'"; 
            $query = $wpdb->get_results($sql);
                            // pr($query);
					$html .= '<table id="search_tbl">';
						$html .= '<thead>';
						$html .= '<tr>';
							
							$html .= '<th>';
								$html .= 'MemberCode';
							$html .= '</th>';

								$html .= '<th>';
								$html .= 'First Name';
							$html .= '</th>';

							$html .= '<th>';
								$html .= 'Last Name';
							$html .= '</th>';

							$html .= '<th>';
								$html .= 'Address';
							$html .= '</th>';

							$html .= '<th>';
								$html .= 'PDF';
							$html .= '</th>';

							$html .= '<th class="nisl-pdf-link">';
							$html .= 'PDF';
							$html .= '</th>';

							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Benefits<br/> Package';
							$html .= '</th>';

							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Product Code <br/> Range';
							$html .= '</th>';

							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Dealer Name';
							$html .= '</th>';

							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Distributor Name';
							$html .= '</th>';
							
							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Vehicle <br/> Information';
							$html .= '</th>';
	
							$html .= '<th class="nisl-pdf-link">';
							$html .= 'VIN';
							$html .= '</th>';
	
							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Registration <br/> Date';
							$html .= '</th>';
	
							$html .= '<th class="nisl-pdf-link">';
							$html .= 'Expiration <br/> Date';
							$html .= '</th>';

							$html .= '<th>';
							$html .= 'View Detail';
							$html .= '</th>';

							$html .= '<th>';
							$html .= 'Edit Detail';
							$html .= '</th>';

							$html .= '<th>';
							$html .= 'Delete Detail';
							$html .= '</th>';

						$html .= '</tr>';
						$html .= '</thead>';
						$html .= '<tbody>';
						
						
						foreach ($query as $key => $value) {
							$user_id = $value->user_id;
							
							if(in_array($user_id,$check_array)){
							
									$nickname = get_user_meta($value->user_id,'nickname', true);
									$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
									$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
									$benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'],'_pmsafe_code_prefix',true);
									$term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$benefits_package);
									$term_length = get_post_meta( $term_length_id, '_pmsafe_benefit_term_length', true );
									$vehicle_registration_date = date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
									$expiration_date = date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
									$current_date = date('Y-m-d');

									$posts = get_post($post_id);
									$post_title = $posts->post_title;
									$post_title = substr($post_title, 0, strpos($post_title, ' '));

									$login = get_post_meta($post_id,'_pmsafe_dealer', true);
									$users = get_user_by('login',$login);
									$dealer_id = $users->ID;
									$dealername = get_user_meta($dealer_id,'dealer_name', true);

									$distributor_login = get_post_meta($post_id,'_pmsafe_distributor', true);
									$dis_users = get_user_by('login',$distributor_login);
									$distributor_id = $dis_users->ID;
									$distributorname = get_user_meta($distributor_id,'distributor_name', true);

									//expired
									if($select == 1){
										if($current_date > $expiration_date){
											// echo $expiration_date.'->'.$value->user_id.'<br/>';
											if (($expiration_date > $datepicker1) && ($expiration_date < $datepicker2)){
												if($distributor_name != ''){
													if($dealer_name != ''){
														if(in_array($user_id,$dealer_array)){
														$html .= '<tr>';
														
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
															$html .= '</td>';
															
															$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
															$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
															$city = get_user_meta($value->user_id,'pmsafe_city',true);
															$state = get_user_meta($value->user_id,'pmsafe_state',true);
															$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
															$html .= '</td>';

															$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
															
															// pr($vehicle_info);
																$url = get_site_url().'/wp-includes/images/media/document.png';
																$html .= '<td>';
																	$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $benefits_package;
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																	$html .= $post_title;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $dealername;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $distributorname;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																$html .= '</td>';


																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																$html .= '</td>';
																
																$view_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'view_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['view_customer_details'] = sprintf(
																	'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																	_x( 'view details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["view_customer_details"];
																$html .= '</td>';
									
									
																$edit_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'edit_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['edit_customer_details'] = sprintf(
																	'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																	_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["edit_customer_details"];
																$html .= '</td>';
									
																$delete_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'delete_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['delete_customer_details'] = sprintf(
																	'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																	_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["delete_customer_details"];
																$html .= '</td>';
															
														$html .= '</tr>';
														}
													}else{
														if(in_array($user_id,$dis_array)){
															$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';
	
																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';
	
																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';
	
	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																//}
															$html .= '</tr>';
																}
													}
												}else if($dealer_name != ''){
													if(in_array($user_id,$dealer_array)){
														$html .= '<tr>';
														
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
															$html .= '</td>';
															
															$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
															$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
															$city = get_user_meta($value->user_id,'pmsafe_city',true);
															$state = get_user_meta($value->user_id,'pmsafe_state',true);
															$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
															$html .= '</td>';

															$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
															
															// pr($vehicle_info);
																$url = get_site_url().'/wp-includes/images/media/document.png';
																$html .= '<td>';
																	$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $benefits_package;
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																	$html .= $post_title;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $dealername;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $distributorname;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																$html .= '</td>';


																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																$html .= '</td>';
																
																$view_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'view_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['view_customer_details'] = sprintf(
																	'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																	_x( 'view details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["view_customer_details"];
																$html .= '</td>';
									
									
																$edit_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'edit_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['edit_customer_details'] = sprintf(
																	'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																	_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["edit_customer_details"];
																$html .= '</td>';
									
																$delete_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'delete_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['delete_customer_details'] = sprintf(
																	'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																	_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["delete_customer_details"];
																$html .= '</td>';
															//}
														$html .= '</tr>';
														}
												}else{
													
														$html .= '<tr>';
														
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
															$html .= '</td>';
															
															$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
															$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
															$city = get_user_meta($value->user_id,'pmsafe_city',true);
															$state = get_user_meta($value->user_id,'pmsafe_state',true);
															$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
															$html .= '</td>';

															$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
															
															// pr($vehicle_info);
																$url = get_site_url().'/wp-includes/images/media/document.png';
																$html .= '<td>';
																	$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $benefits_package;
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																	$html .= $post_title;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $dealername;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $distributorname;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																$html .= '</td>';


																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																$html .= '</td>';
																
																$view_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'view_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['view_customer_details'] = sprintf(
																	'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																	_x( 'view details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["view_customer_details"];
																$html .= '</td>';
									
									
																$edit_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'edit_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['edit_customer_details'] = sprintf(
																	'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																	_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["edit_customer_details"];
																$html .= '</td>';
									
																$delete_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'delete_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['delete_customer_details'] = sprintf(
																	'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																	_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["delete_customer_details"];
																$html .= '</td>';
															//}
														$html .= '</tr>';
														
												}
												
											}
										}
									}else if($select == 2){ //expiring
										$date1 = $current_date;
										$date2 = $expiration_date;

										$ts1 = strtotime($date1);
										$ts2 = strtotime($date2);

										$year1 = date('Y', $ts1);
										$year2 = date('Y', $ts2);

										$month1 = date('m', $ts1);
										$month2 = date('m', $ts2);

										$diff = (($year2 - $year1) * 12) + ($month2 - $month1);  
										// echo $expiration_date.'->'.$diff.'->'.$value->user_id.'<br/>';
										if($diff >= 1 && $diff <= 6 ){
											// echo 'id'.$value->user_id.'<br/>';
											if (($expiration_date > $datepicker1) && ($expiration_date < $datepicker2)){
												if($distributor_name != ''){
													if($dealer_name != ''){
														if(in_array($user_id,$dealer_array)){
																$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';

																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';

																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';


																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																//}
															$html .= '</tr>';   
														}
													}else{
														if(in_array($user_id,$dis_array)){
																$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';

																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';

																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';


																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																//}
															$html .= '</tr>';   
														}
													}
												}else if($dealer_name != ''){
													if(in_array($user_id,$dealer_array)){
															$html .= '<tr>';
														
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
															$html .= '</td>';
															
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
															$html .= '</td>';
															
															$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
															$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
															$city = get_user_meta($value->user_id,'pmsafe_city',true);
															$state = get_user_meta($value->user_id,'pmsafe_state',true);
															$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
															$html .= '<td>';
																$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
															$html .= '</td>';

															$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
															
															// pr($vehicle_info);
																$url = get_site_url().'/wp-includes/images/media/document.png';
																$html .= '<td>';
																	$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $benefits_package;
																$html .= '</td>';
																
																$html .= '<td class="nisl-pdf-link">';
																	$html .= $post_title;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $dealername;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $distributorname;
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																	$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																$html .= '</td>';


																$html .= '<td class="nisl-pdf-link">';
																	$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																$html .= '</td>';
																
																$view_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'view_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['view_customer_details'] = sprintf(
																	'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																	_x( 'view details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["view_customer_details"];
																$html .= '</td>';
									
									
																$edit_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'edit_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['edit_customer_details'] = sprintf(
																	'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																	_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["edit_customer_details"];
																$html .= '</td>';
									
																$delete_customer_details_query_args = array(
																	'page'   => 'customers-lists',
																	'action' => 'delete_customer_details',
																	'id'  => $user_id,
																);
									
																$actions['delete_customer_details'] = sprintf(
																	'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																	esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																	_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																);
									
																$html .= '<td class="text-center">';
																	$html .= $actions["delete_customer_details"];
																$html .= '</td>';
															//}
														$html .= '</tr>';   
													}
												}else{
													
														$html .= '<tr>';
													
														$html .= '<td>';
															$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
														$html .= '</td>';
														
														$html .= '<td>';
															$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
														$html .= '</td>';
														
														$html .= '<td>';
															$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
														$html .= '</td>';
														
														$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
														$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
														$city = get_user_meta($value->user_id,'pmsafe_city',true);
														$state = get_user_meta($value->user_id,'pmsafe_state',true);
														$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
														$html .= '<td>';
															$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
														$html .= '</td>';

														$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
														
														// pr($vehicle_info);
															$url = get_site_url().'/wp-includes/images/media/document.png';
															$html .= '<td>';
																$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
															$html .= '</td>';
															
															$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
															$html .= '</td>';

															$html .= '<td class="nisl-pdf-link">';
																$html .= $benefits_package;
															$html .= '</td>';
															
															$html .= '<td class="nisl-pdf-link">';
																$html .= $post_title;
															$html .= '</td>';

															$html .= '<td class="nisl-pdf-link">';
																$html .= $dealername;
															$html .= '</td>';

															$html .= '<td class="nisl-pdf-link">';
																$html .= $distributorname;
															$html .= '</td>';

															$html .= '<td class="nisl-pdf-link">';
																$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
															$html .= '</td>';

																$html .= '<td class="nisl-pdf-link">';
																$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
															$html .= '</td>';

															$html .= '<td class="nisl-pdf-link">';
																$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
															$html .= '</td>';


															$html .= '<td class="nisl-pdf-link">';
																$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
															$html .= '</td>';
															
															$view_customer_details_query_args = array(
																'page'   => 'customers-lists',
																'action' => 'view_customer_details',
																'id'  => $user_id,
															);
								
															$actions['view_customer_details'] = sprintf(
																'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																_x( 'view details', 'List table row action', 'wp-list-table-example' )
															);
								
															$html .= '<td class="text-center">';
																$html .= $actions["view_customer_details"];
															$html .= '</td>';
								
								
															$edit_customer_details_query_args = array(
																'page'   => 'customers-lists',
																'action' => 'edit_customer_details',
																'id'  => $user_id,
															);
								
															$actions['edit_customer_details'] = sprintf(
																'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																_x( 'edit details', 'List table row action', 'wp-list-table-example' )
															);
								
															$html .= '<td class="text-center">';
																$html .= $actions["edit_customer_details"];
															$html .= '</td>';
								
															$delete_customer_details_query_args = array(
																'page'   => 'customers-lists',
																'action' => 'delete_customer_details',
																'id'  => $user_id,
															);
								
															$actions['delete_customer_details'] = sprintf(
																'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																_x( 'delete details', 'List table row action', 'wp-list-table-example' )
															);
								
															$html .= '<td class="text-center">';
																$html .= $actions["delete_customer_details"];
															$html .= '</td>';
														//}
													$html .= '</tr>';   
												
												}
											}
										}
									}else if($select == 3){  // current   
										if($current_date < $expiration_date){
											if (($vehicle_registration_date > $datepicker1) && ($vehicle_registration_date < $datepicker2)){
												if($distributor_name != ''){
													if($dealer_name != ''){
														if(in_array($user_id,$dealer_array)){
															$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';

																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';

																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';


																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																//}
															$html .= '</tr>';
															}
														}else{
															if(in_array($user_id,$dis_array)){
																$html .= '<tr>';
																
																	$html .= '<td>';
																		$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																	$html .= '</td>';
																	
																	$html .= '<td>';
																		$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																	$html .= '</td>';
																	
																	$html .= '<td>';
																		$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																	$html .= '</td>';
																	
																	$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																	$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																	$city = get_user_meta($value->user_id,'pmsafe_city',true);
																	$state = get_user_meta($value->user_id,'pmsafe_state',true);
																	$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																	$html .= '<td>';
																		$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																	$html .= '</td>';
	
																	$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																	
																	// pr($vehicle_info);
																		$url = get_site_url().'/wp-includes/images/media/document.png';
																		$html .= '<td>';
																			$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																		$html .= '</td>';
																		
																		$html .= '<td class="nisl-pdf-link">';
																					$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																		$html .= '</td>';
																		
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= $benefits_package;
																		$html .= '</td>';
																		
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= $post_title;
																		$html .= '</td>';
	
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= $dealername;
																		$html .= '</td>';
	
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= $distributorname;
																		$html .= '</td>';
	
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																		$html .= '</td>';
	
																			$html .= '<td class="nisl-pdf-link">';
																			$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																		$html .= '</td>';
	
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																		$html .= '</td>';
	
	
																		$html .= '<td class="nisl-pdf-link">';
																			$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																		$html .= '</td>';
																		
																		$view_customer_details_query_args = array(
																			'page'   => 'customers-lists',
																			'action' => 'view_customer_details',
																			'id'  => $user_id,
																		);
											
																		$actions['view_customer_details'] = sprintf(
																			'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																			esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																			_x( 'view details', 'List table row action', 'wp-list-table-example' )
																		);
											
																		$html .= '<td class="text-center">';
																			$html .= $actions["view_customer_details"];
																		$html .= '</td>';
											
											
																		$edit_customer_details_query_args = array(
																			'page'   => 'customers-lists',
																			'action' => 'edit_customer_details',
																			'id'  => $user_id,
																		);
											
																		$actions['edit_customer_details'] = sprintf(
																			'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																			esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																			_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																		);
											
																		$html .= '<td class="text-center">';
																			$html .= $actions["edit_customer_details"];
																		$html .= '</td>';
											
																		$delete_customer_details_query_args = array(
																			'page'   => 'customers-lists',
																			'action' => 'delete_customer_details',
																			'id'  => $user_id,
																		);
											
																		$actions['delete_customer_details'] = sprintf(
																			'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																			esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																			_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																		);
											
																		$html .= '<td class="text-center">';
																			$html .= $actions["delete_customer_details"];
																		$html .= '</td>';
																	//}
																$html .= '</tr>';
																}
														}
													}else if($dealer_name != ''){
														if(in_array($user_id,$dealer_array)){
															$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';

																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';

																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';


																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																//}
															$html .= '</tr>';
															}
													}else{
														
															$html .= '<tr>';
															
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'nickname', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'first_name', true).'</a>';
																$html .= '</td>';
																
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.get_user_meta($value->user_id,'last_name',true).'</a>';
																$html .= '</td>';
																
																$address1 = get_user_meta($value->user_id,'pmsafe_address_1',true);
																$address2 = get_user_meta($value->user_id,'pmsafe_address_2',true);
																$city = get_user_meta($value->user_id,'pmsafe_city',true);
																$state = get_user_meta($value->user_id,'pmsafe_state',true);
																$zip_code = get_user_meta($value->user_id,'pmsafe_zip_code',true);
																$html .= '<td>';
																	$html .= '<a href="" class="view-data" data-id="'.$value->user_id.'">'.$address1.', '.$address2.', '.$city.', '.$state.', '.$zip_code.'</a>';
																$html .= '</td>';

																$vehicle_info = get_user_meta($value->user_id,'pmsafe_vehicle_info',false);
																
																// pr($vehicle_info);
																	$url = get_site_url().'/wp-includes/images/media/document.png';
																	$html .= '<td>';
																		$html .= '<a href="'.$vehicle_info[0][$nickname]['pmsafe_pdf_link'].'" target="blank"><img src="'.$url.'" class="attachment-thumbnail" style="width:20px !important"/></a>';
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $benefits_package;
																	$html .= '</td>';
																	
																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $post_title;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $dealername;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $distributorname;
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vehicle_year'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_make'] . ' ' . $vehicle_info[0][$nickname]['pmsafe_vehicle_model'];
																	$html .= '</td>';

																		$html .= '<td class="nisl-pdf-link">';
																		$html .= $vehicle_info[0][$nickname]['pmsafe_vin'];
																	$html .= '</td>';

																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
																	$html .= '</td>';


																	$html .= '<td class="nisl-pdf-link">';
																		$html .= date('Y-m-d', strtotime("+".$term_length." months",strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
																	$html .= '</td>';
																	
																	$view_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'view_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['view_customer_details'] = sprintf(
																		'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $view_customer_details_query_args, 'admin.php' ), 'viewcustomerdetails_' . $user_id ) ),
																		_x( 'view details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["view_customer_details"];
																	$html .= '</td>';
										
										
																	$edit_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'edit_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['edit_customer_details'] = sprintf(
																		'<a href="%1$s" title="Edit Details"><i class="fa fa-edit"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $edit_customer_details_query_args, 'admin.php' ), 'editcustomerdetails_' . $user_id ) ),
																		_x( 'edit details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["edit_customer_details"];
																	$html .= '</td>';
										
																	$delete_customer_details_query_args = array(
																		'page'   => 'customers-lists',
																		'action' => 'delete_customer_details',
																		'id'  => $user_id,
																	);
										
																	$actions['delete_customer_details'] = sprintf(
																		'<a href="%1$s" title="Delete"><i class="fa fa-trash"></i></a>',
																		esc_url( wp_nonce_url( add_query_arg( $delete_customer_details_query_args, 'admin.php' ), 'deletecustomerdetails_' . $user_id ) ),
																		_x( 'delete details', 'List table row action', 'wp-list-table-example' )
																	);
										
																	$html .= '<td class="text-center">';
																		$html .= $actions["delete_customer_details"];
																	$html .= '</td>';
																
															$html .= '</tr>';
															
													}
											}
										}
									}
							}
						}

					$html .= '</tbody>';
					$html .= '</table>';
				
		
				echo $html;   

			die;
		}

		public function admin_membership_date_filter(){
			global $wpdb;
            $datepicker1 = $_POST['datepicker1'];
			$datepicker2 = $_POST['datepicker2'];
			$dealer = $_POST['dealer'];
			$distributor = $_POST['distributor'];
			if($distributor != '' && $dealer == ''){
				$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "'.$distributor.'"))))');
			}
			if($dealer != '' && $distributor != ''){
				$user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "'.$dealer.'")');
			}
			
			$str = '';
			foreach ($user_query as $value_query) {
				$str = $value_query->meta_value.','.$str;
			}

			$str = rtrim($str,",");
			// echo $str;
			$str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in ('.$str.') ');
			// pr($str_results);
			$check_array = array();
			foreach ($str_results as $str_result) {
				$check_array[] = $str_result->meta_value;
			}
			$membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');
			foreach ($membership_results as $key=>$value) {
				$post_id = $value->post_id;
				 $upgraded_date = get_post_meta($post_id,'upgraded_date',true);
				 $code = get_post_meta($post_id,'_pmsafe_invitation_code',true);
				 if($distributor != '' && $dealer == ''){
					 if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
						 if(in_array($code,$check_array)){
							 $invite_post_id[] = $post_id;
						 }
					 }
				 }else if($dealer != '' && $distributor != ''){
					 if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
						 if(in_array($code,$check_array)){
							 $invite_post_id[] = $post_id;
						 }
					 }
				 }else{
					 if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
					 	$invite_post_id[] = $post_id;
					 }
				 }
			 
			 }

			$benefit_prefix = pmsafe_get_meta_values( '_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish' );
			foreach ($benefit_prefix as $prefix) {
				
				$original_prefix[] = $prefix;
			}
			
			$count = 0;
			foreach ($original_prefix  as $prefix1) {// PC3,BP1,BP2
				foreach ($original_prefix  as $prefix2) { //PC3,BP1,BP2
					if($prefix1 != $prefix2){
						
					$results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE 
					meta_key = "_pmsafe_bulk_invitation_id" AND 
					meta_value IN( SELECT post_id FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_prefix" and meta_value ="'.$prefix1.'" ) ');
					$post_id = array();
					foreach ($results as $key => $value) {
						if(in_array($value->post_id,$invite_post_id)){
							$post_id[] = $value->post_id;
						}
					}
					
					if(!empty($post_id)){
						$args = array(
							'post_type' => 'pmsafe_invitecode',
							'post_status' => 'publish',
							'posts_per_page' => -1,
							'post__in' => $post_id,
							'meta_query' => array(
								'relation' => 'AND',
								array(
									'key' => '_pmsafe_code_prefix',
									'value' => $prefix2,
									'compare' => '=',
								),
								array(
									'key' => 'is_upgraded',
									'value' => '1',
									'compare' => '=',
								)
							),
						);
						
							
							$posts = get_posts($args);
							if($posts){
							
							$prefix_arr[$prefix1.'-'.$prefix2]= array();
							$count_arr = array();
							foreach ($posts as $key => $value) {
								$pid = $value->ID;
								$code = get_post_meta($pid,'_pmsafe_invitation_code',true); 
								array_push($count_arr, $code);
							
							}
							array_push($prefix_arr[$prefix1.'-'.$prefix2], count($count_arr));
							
							}
						}

					}
					
					// echo '<br>';
						
				}
				
			}	
			// pr($prefix_arr);
			$html .= '<div class="membership-count">';
			foreach ($prefix_arr as $key => $value) {
				$html .= '<p>';
				$html .= $key . '=' .'<span>'.$value[0].'</span>';
				$html .= '</p>';
			}	
			$html .= '</div>';
            $html .= '<table id="mebership_date_table" class="display nowrap" style="width:100%">';
            $html .= '<thead>';
                $html .= '<tr>';
                $html .= '<th>';
                $html .= 'Registration Number';
                $html .= '</th>';

                $html .= '<th>';
                $html .= 'Original Policy';
                $html .= '</th>';

                $html .= '<th>';
                $html .= 'Upgraded Policy';
                $html .= '</th>';
               
                $html .= '<th>';
                $html .= 'Upgraded By';
                $html .= '</th>';
                    
                $html .= '</tr>';
            $html .= '</thead>';

			$html .= '<tbody id="">';        
			$count = 1;
            foreach ($membership_results as $str) {
                $post_id = $str->post_id;
				$upgraded_date = get_post_meta($post_id,'upgraded_date',true);
				if($distributor != '' && $dealer == ''){
					if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
						
						$bulk_id = get_post_meta($post_id,'_pmsafe_bulk_invitation_id',true);
						$bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
						$code = get_post_meta($post_id,'_pmsafe_invitation_code',true);
						$upgraded_id = get_post_meta($post_id,'upgraded_by',true);
						$dealer_name = get_user_meta($upgraded_id,'dealer_name',true);
						$distributor_name = get_user_meta($upgraded_id,'distributor_name',true);
						$contact_fname = get_user_meta($upgraded_id,'contact_fname',true);
						$admin_name = get_user_meta($upgraded_id,'first_name',true);
						if(in_array($code,$check_array)){
						
							$html .= '<tr>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_invitation_code',true);
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= $bulk_prefix;
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_code_prefix',true);
								$html .= '</td>';
								
								$html .= '<td>';
								if($dealer_name){
									$html .= $dealer_name;
								}
								if($distributor_name){
									$html .= $distributor_name;
								}
								if($contact_fname){
									$html .= $contact_fname;
								}
								if($admin_name){
									$html .= $admin_name;
								}
								$html .= '</td>';
			
							$html .= '</tr>';
							
						}
						
						
					}
				}else if($dealer != '' && $distributor != ''){
					if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
						
						$bulk_id = get_post_meta($post_id,'_pmsafe_bulk_invitation_id',true);
						$bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
						$code = get_post_meta($post_id,'_pmsafe_invitation_code',true);
						$upgraded_id = get_post_meta($post_id,'upgraded_by',true);
						$dealer_name = get_user_meta($upgraded_id,'dealer_name',true);
						$distributor_name = get_user_meta($upgraded_id,'distributor_name',true);
						$contact_fname = get_user_meta($upgraded_id,'contact_fname',true);
						$admin_name = get_user_meta($upgraded_id,'first_name',true);
						if(in_array($code,$check_array)){
						
							$html .= '<tr>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_invitation_code',true);
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= $bulk_prefix;
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_code_prefix',true);
								$html .= '</td>';
								
								$html .= '<td>';
								if($dealer_name){
									$html .= $dealer_name;
								}
								if($distributor_name){
									$html .= $distributor_name;
								}
								if($contact_fname){
									$html .= $contact_fname;
								}
								if($admin_name){
									$html .= $admin_name;
								}
								$html .= '</td>';
			
							$html .= '</tr>';
						}
							
					}
				}
                else{
					if($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2){
						
						$bulk_id = get_post_meta($post_id,'_pmsafe_bulk_invitation_id',true);
						$bulk_prefix = get_post_meta($bulk_id,'_pmsafe_invitation_prefix',true);
						$code = get_post_meta($post_id,'_pmsafe_invitation_code',true);
						$upgraded_id = get_post_meta($post_id,'upgraded_by',true);
						$dealer_name = get_user_meta($upgraded_id,'dealer_name',true);
						$distributor_name = get_user_meta($upgraded_id,'distributor_name',true);
						$contact_fname = get_user_meta($upgraded_id,'contact_fname',true);
						$admin_name = get_user_meta($upgraded_id,'first_name',true);
					
						
							$html .= '<tr>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_invitation_code',true);
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= $bulk_prefix;
								$html .= '</td>';
								
								$html .= '<td>';
									$html .= get_post_meta($post_id,'_pmsafe_code_prefix',true);
								$html .= '</td>';
								
								$html .= '<td>';
								if($dealer_name){
									$html .= $dealer_name;
								}
								if($distributor_name){
									$html .= $distributor_name;
								}
								if($contact_fname){
									$html .= $contact_fname;
								}
								if($admin_name){
									$html .= $admin_name;
								}
								$html .= '</td>';
			
							$html .= '</tr>';
							
					}
				}
			}
			
            $html .= '</tbody>';        
            $html .= '</table>';  

            echo $html;
            die;
		}

	public function add_dealer_benifits_package_price_function(){
		$dealer_id = $_POST['dealer_id'];
		$selected_package = $_POST['selected_package'];
		$dealer_cost = $_POST['dealer_cost'];
		$selling_price = $_POST['selling_price'];
		
		$get_price_arr = get_user_meta($dealer_id,'pricing_pacakge',true);
		

		$price_arr[$selected_package] = array(
		'dealer_cost' => $dealer_cost,
		'selling_price' => $selling_price
		);
		
		if($get_price_arr){
			if(array_key_exists($selected_package,$get_price_arr)){
				$response = 0;
			}
			else{
				$nisl_price_arr = $get_price_arr + $price_arr;
				update_user_meta($dealer_id,'pricing_pacakge',$nisl_price_arr);
				$response = 1;
			}
		}else{
			update_user_meta($dealer_id,'pricing_pacakge',$price_arr);
			$response = 1;
		}

		echo $response;
		die;
	}		

	public function delete_dealer_benifits_package_price_function(){
		$dealer_id = $_POST['dealer_id'];
		$package = $_POST['package'];
		$get_price_arr = get_user_meta($dealer_id,'pricing_pacakge',true);
		unset($get_price_arr[$package]);
		update_user_meta($dealer_id,'pricing_pacakge',$get_price_arr);
		die;
	}
	
	public function edit_dealer_benifits_package_price_function(){
		$dealer_id = $_POST['dealer_id'];
		$selected_package = $_POST['selected_package'];
		$dealer_cost = $_POST['dealer_cost'];
		$selling_price = $_POST['selling_price'];
		$get_price_arr = get_user_meta($dealer_id,'pricing_pacakge',true);
		unset($get_price_arr[$selected_package]);
		$price_arr[$selected_package] = array(
			'dealer_cost' => $dealer_cost,
			'selling_price' => $selling_price
		);
		
		$new_price_arr = $get_price_arr + $price_arr;
		
		update_user_meta($dealer_id,'pricing_pacakge',$new_price_arr);
		die;
	}
}

