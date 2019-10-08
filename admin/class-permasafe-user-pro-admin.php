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
class Permasafe_User_Pro_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style('pmsafe-datepicker-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/permasafe-user-pro-admin.css', array(), time(), 'all');
		wp_enqueue_style('jquery-modal', plugin_dir_url(__FILE__) . 'css/jquery.modal.min.css', array(), time(), 'all');
		wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), time(), 'all');
		wp_enqueue_style('pmsafe_dt_css', plugin_dir_url(__FILE__) . 'css/dataTables.jqueryui.min.css', array(), time(), 'all');
		wp_enqueue_style('pmsafe_dt_fixedHeader', plugin_dir_url(__FILE__) . 'css/fixedHeader.dataTables.min.css', array(), time(), 'all');
		wp_enqueue_style('select2-css', plugin_dir_url(__FILE__) . 'css/select2.min.css', array(), time(), 'all');
		wp_enqueue_style('jtoggler-css', plugin_dir_url(__FILE__) . 'css/jtoggler.styles.css', array(), time(), 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script('pmsafe-datepicker',  plugin_dir_url(__FILE__) . 'js/jquery-ui.js', array('jquery'), $this->version, false);
		// wp_enqueue_script( 'jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/permasafe-user-pro-admin.js', array('jquery'), '1.0.6', false);
		wp_enqueue_script('dt_table_js', plugin_dir_url(__FILE__) . 'js/jquery.dataTables.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_js', plugin_dir_url(__FILE__) . 'js/dataTables.jqueryui.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_btn', plugin_dir_url(__FILE__) . 'js/dataTables.buttons.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_flash', plugin_dir_url(__FILE__) . 'js/buttons.flash.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_jszip', plugin_dir_url(__FILE__) . 'js/jszip.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_btnhtml', plugin_dir_url(__FILE__) . 'js/buttons.html5.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_btnpdf', plugin_dir_url(__FILE__) . 'js/pdfmake.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_vfs_fonts', plugin_dir_url(__FILE__) . 'js/vfs_fonts.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_ui_btnprint', plugin_dir_url(__FILE__) . 'js/buttons.print.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_fixedHeader', plugin_dir_url(__FILE__) . 'js/dataTables.fixedHeader.min.js', array('jquery'), time(), false);
		wp_enqueue_script('dt_table_inputjs', plugin_dir_url(__FILE__) . 'js/input.js', array('jquery'), time(), false);
		wp_enqueue_script('sweet_alert', plugin_dir_url(__FILE__) . 'js/sweetalert.min.js', array('jquery'), time(), false);
		wp_enqueue_script('natural-js', plugin_dir_url(__FILE__) . 'js/natural.js', array('jquery'), time(), false);
		wp_enqueue_script('jtoggler-js', plugin_dir_url(__FILE__) . 'js/jtoggler.js', array('jquery'), time(), false);
		


	}

	public function enque_admin_user_js()
	{
		wp_enqueue_script('dealers_distributor_js', plugin_dir_url(__FILE__) . 'js/permasafe-admin-user-pro-admin.js', array('jquery'), time(), false);
		wp_enqueue_script('select2', plugin_dir_url(__FILE__) . 'js/select2.js', array('jquery'), time(), false);
		wp_enqueue_script('tbl_pagination_admin_js', plugin_dir_url(__FILE__) . 'js/jquery-paginate.js', array('jquery'), time(), false);
		wp_enqueue_script('jquery-modal',  plugin_dir_url(__FILE__) . 'js/jquery.modal.min.js', array('jquery'), time(), false);
		wp_localize_script($this->plugin_name, 'pmAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	}



	/**
	 * Add an menu page
	 *
	 * @since  1.0.0
	 */
	public function add_menu_page()
	{

		/**
		 * Create admin side Customers Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Customers', ''),
			__('Customers', ''),
			'manage_options',
			'customers-lists',
			array($this, 'display_permasafe_customers_page'),
			'dashicons-businessman',
			8
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'customers-lists',
			__('Customer Search', ''),
			__('Customer Search', ''),
			'manage_options',
			'customer-search',
			array($this, 'display_permasafe_customer_search_page')
		);




		/**
		 * Create admin side upgraded membership Page
		 * 
		 * @since  1.0.0
		 */

		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Coverage Reports', ''),
			__('Reports', ''),
			'manage_options',
			'customer-filter',
			array($this, 'display_permasafe_customer_filter_page'),
			'dashicons-media-spreadsheet',
			8
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'customer-filter',
			__('Coverage Reports', ''),
			__('Coverage Reports', ''),
			'manage_options',
			'customer-filter',
			array($this, 'display_permasafe_customer_filter_page')
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'customer-filter',
			__('Billing Reports', ''),
			__('Billing Reports', ''),
			'manage_options',
			'billing-reports',
			array($this, 'display_permasafe_billing_reports_page')
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'customer-filter',
			__('Upgraded Reports', ''),
			__('Upgraded Reports', ''),
			'manage_options',
			'permasafe-upgraded-membership',
			array($this, 'permasafe_upgraded_membership_page')
		);


		/**
		 * Create admin side Dealers Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Dealers', ''),
			__('Dealers', ''),
			'manage_options',
			'dealers-lists',
			array($this, 'display_permasafe_dealers_page'),
			'dashicons-groups',
			8
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'dealers-lists',
			__('Dealers', ''),
			__('Dealers', ''),
			'manage_options',
			'dealers-lists',
			array($this, 'display_permasafe_dealers_page')
		);

		/**
		 * Create admin side Add dealer page Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'dealers-lists',
			__('Add New Dealer', ''),
			__('Add New Dealer', ''),
			'manage_options',
			'add-new-dealer',
			array($this, 'add_permasafe_dealers_page')
		);


		// distributors

		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Distributors', ''),
			__('Distributors', ''),
			'manage_options',
			'distributors-lists',
			array($this, 'display_permasafe_distributors_page'),
			'dashicons-admin-users',
			8
		);

		$this->plugin_screen_hook_suffix = add_submenu_page(
			'distributors-lists',
			__('Distributors', ''),
			__('Distributors', ''),
			'manage_options',
			'distributors-lists',
			array($this, 'display_permasafe_distributors_page')
		);


		/**
		 * Create admin side Add dealer page Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'distributors-lists',
			__('Add New Distributor', ''),
			__('Add New Distributor', ''),
			'manage_options',
			'add-new-distributor',
			array($this, 'add_permasafe_distributors_page')
		);




		//==================================================//

		/**
		 * Create admin side Permasafe Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_menu_page(
			__('Member Codes', ''),
			__('Member Codes', ''),
			'manage_options',
			'pmsafe-bulk-invi',
			array($this, 'display_permasafe_invitcode_page'),
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
			__('Individual Member Codes', ''),
			__('Individual Member Codes', ''),
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
			__('Benefits packages', 'permasafe-benefits-package'),
			__('Benefits packages', ''),
			'manage_options',
			//			'permasafe-bulk-invitation',
			'edit.php?post_type=pmsafe_benefits'
		);





		/**
		 * Create admin side Setting Page
		 * 
		 * @since  1.0.0
		 */
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'pmsafe-bulk-invi',
			__('Setting', ''),
			__('Setting', ''),
			'manage_options',
			'permasafe-setting',
			array($this, 'permasafe_setting_page')
		);
	}

	public function pmsafe_register_setting()
	{
		register_setting('pmsafe_setting', 'pmsafe_redirect_url');                                             // save redirect URL
		register_setting('pmsafe_setting', 'pmsafe_demo_benefit_prefix');                                      // save demo registration benefit prefix
	}

	/**
	 * Invitation code page
	 */
	public function display_permasafe_invitcode_page()
	{
		include_once 'partials/permasafe-invitation-code.php';
	}

	/**
	 * Permasafe setting page
	 */
	public function display_permasafe_customers_page()
	{
		include_once 'partials/pmsafe-customers-page.php';
	}

	public function display_permasafe_customer_search_page()
	{
		include_once 'partials/pmsafe-customers-search-page.php';
	}

	public function display_permasafe_customer_filter_page()
	{
		include_once 'partials/pmsafe-customers-filter-page.php';
	}
	
	public function display_permasafe_billing_reports_page()
	{
		include_once 'partials/pmsafe-customers-billing-page.php';
	}

	public function permasafe_setting_page()
	{
		include_once 'partials/permasafe-setting-page.php';
	}
	public function permasafe_upgraded_membership_page()
	{
		include_once 'partials/permasafe-upgraded-membership-page.php';
	}

	public function display_permasafe_dealers_page()
	{
		include_once 'partials/pmsafe-dealers-page.php';
	}

	public function add_permasafe_dealers_page()
	{
		include_once 'partials/pmsafe-add-dealers-page.php';
	}

	public function display_permasafe_distributors_page()
	{
		include_once 'partials/pmsafe-distributors-page.php';
	}

	public function add_permasafe_distributors_page()
	{
		include_once 'partials/pmsafe-add-distributors-page.php';
	}

	public function check_email_exist()
	{
		$email = $_POST['email'];
		global $wpdb;
		$sql = 'SELECT * FROM wp_users WHERE user_email = "' . $email . '"';
		$results = $wpdb->get_results($sql);
		if (!empty($results)) {
			$response = 0;
		} else {
			$response = 1;
		}
		echo $response;
		die;
	}


	public function  perma_admin_footer_load_html()
	{
		echo '<div class="perma-admin-loader" style="display:none">';
		echo '<div class="perma-load-image"><img src="' . plugin_dir_url(__FILE__) . 'images/loader-1.gif" alt=""></div>';
		echo '<div class="perma-black-overlay"></div>';
		echo '</div>';
	}

	// add distributor
	public function pmsafe_register_distributor_form_function()
	{
		
		$user_prefix = 'P';
		$distributors = get_users('role=author&orderby=ID&order=DESC');
		$last_id = $distributors[0]->user_login;

		if (empty($distributors)) {
			$numbers = 1000 + 1;
			$distributor_code = $user_prefix . $numbers;
		} else {
			$first_ltr = substr($last_id, 0, 2);
			$numbers = substr($last_id, 1);
			$numbers = $numbers + 1;
			$distributor_code = $user_prefix . $numbers;
		}
		$distributor_name = $_POST['pmsafe_distributor_name'];
	
			$permitted_chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$random_char = substr(str_shuffle($permitted_chars), 0, 4);

			$distributor_email = $random_char . '@permasafe.com';
	
	
			$distributor_password = wp_generate_password();
	

		$distributor_store_address = $_POST['pmsafe_distributor_store_address'];
		$distributor_phone_number = $_POST['pmsafe_distributor_phone_number'];
		$distributor_fax_number = $_POST['pmsafe_distributor_fax_number'];

		$user_id = wp_create_user($distributor_code, $distributor_password, $distributor_email);
		if ($user_id) {
			$set_user_role = new WP_User($user_id);
			$set_user_role->set_role('author');

			update_user_meta($user_id, 'distributor_name', $distributor_name);
			update_user_meta($user_id, 'distributor_store_address', $distributor_store_address);
			update_user_meta($user_id, 'distributor_phone_number', $distributor_phone_number);
			update_user_meta($user_id, 'distributor_fax_number', $distributor_fax_number);

			$redirect_url = admin_url('admin.php?page=distributors-lists&action=view&distributor=' . $user_id);
			$response = array('status' => true, 'redirect' => $redirect_url);
		} else {
			$response = array('status' => false);
		}
		echo json_encode($response);


		die;
	}



	// edit distributor
	public function pmsafe_edit_distributor_form_function()
	{
		$user_id = $_POST['pmsafe_distributor_id'];

		$edit_name = $_POST['pmsafe_distributor_name'];
		$edit_email = $_POST['pmsafe_distributor_email'];
		$edit_store_address = $_POST['pmsafe_distributor_store_address'];
		$edit_phone_number = $_POST['pmsafe_distributor_phone_number'];
		$edit_fax_number = $_POST['pmsafe_distributor_fax_number'];
		$new_password = $_POST['pmsafe_distributor_password'];


		$user_id = wp_update_user(array('ID' => $user_id, 'user_email' => $edit_email));

		update_user_meta($user_id, 'distributor_name', $edit_name);
		update_user_meta($user_id, 'distributor_store_address', $edit_store_address);
		update_user_meta($user_id, 'distributor_phone_number', $edit_phone_number);
		update_user_meta($user_id, 'distributor_fax_number', $edit_fax_number);
		if ($new_password != '') {
			wp_set_password($new_password, $user_id);
		}

		$redirect_url = admin_url('admin.php?page=distributors-lists&action=view&distributor=' . $user_id);
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}

	// delete distributor
	public function pmsafe_delete_distributor_form_function()
	{
		global $wpdb;
		$user_id = $_POST['pmsafe_distributor_id'];
		wp_delete_user($user_id);
		$contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_distributor_id" AND wum.meta_value =' . $user_id);
		foreach ($contact_info as $key => $value) {
			$contact_id = $value->user_id;

			wp_delete_user($contact_id);
		}
		delete_user_meta($user_id, 'distributor_name');
		delete_user_meta($user_id, 'distributor_store_address');
		delete_user_meta($user_id, 'distributor_phone_number');
		delete_user_meta($user_id, 'distributor_fax_number');
		delete_user_meta($user_id, 'distributor_contact_info');
		$redirect_url = admin_url('admin.php?page=distributors-lists');
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}


	//add distributor contact information
	public function add_distributor_contact_information()
	{

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$distributor_id = $_POST['distributor_id'];

		if (username_exists($uname)) {
			$response = array('status' => false);
		} else {
			if ($uname == '') {
				$contact_increment = get_option('distributor_contact_increment');
				if (empty($contact_increment)) {
					$num = 1;
				} else {
					$num = $contact_increment + 1;
				}

				$distributors_users = get_user_by('ID', $distributor_id);
				$distributors_code = $distributors_users->user_login;

				$string = $distributors_code . '_';
				$user_name = $string . $num;
				update_option('distributor_contact_increment', $num);
			} else {
				$user_name = $uname;
			}

			$contact_id = wp_create_user($user_name, $password, $email);
			$set_user_role = new WP_User($contact_id);
			$set_user_role->set_role('distributor-user');
			update_user_meta($contact_id, 'distributor_contact_fname', $fname);
			update_user_meta($contact_id, 'distributor_contact_lname', $lname);
			update_user_meta($contact_id, 'distributor_contact_phone', $phone);
			update_user_meta($contact_id, 'contact_distributor_id', $distributor_id);

			$to = $email;
			$subject = 'PermaSafe: Your User Account Registration Information';
			$password = $password;
			send_mail_to_users($to, $password, $subject, '', $user_name);
			$response = array('status' => true);
		}
		echo json_encode($response);
		die;
	}

	//fetch distributor contact information
	public function fetch_distributor_contact_info()
	{
		$contact_id = $_POST['contact_id'];
		$users =  get_user_by('id', $contact_id);
		$email = $users->user_email;
		$uname = $users->user_login;
		$fname  = get_user_meta($contact_id, 'distributor_contact_fname', true);
		$lname  = get_user_meta($contact_id, 'distributor_contact_lname', true);
		$phone  = get_user_meta($contact_id, 'distributor_contact_phone', true);
		$response = array('fname' => $fname, 'lname' => $lname, 'phone' => $phone, 'email' => $email, 'uname' => $uname, 'contact_id' => $contact_id);
		echo json_encode($response);
		die;
	}

	// edit distributor contact information
	public function edit_distributor_contact_information()
	{
		global $wpdb;
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$contact_id = $_POST['contact_id'];

		if (username_exists($uname)) {
			$user_id = username_exists($uname);
			if ($user_id != $contact_id) {
				$response = array('status' => false);
			} else {

				$contact_id = wp_update_user(array('ID' => $contact_id, 'user_email' => $email));
				$return = $wpdb->update($wpdb->users, array('user_login' => $uname), array('ID' => $contact_id));
				if ($password != '') {

					wp_set_password($password, $contact_id);
					$to = $email;
					$subject = 'PermaSafe: Your User Account has been updated';
					$password = $password;
					send_mail_to_users($to, $password, $subject, '', $uname);
				}
				update_user_meta($contact_id, 'distributor_contact_fname', $fname);
				update_user_meta($contact_id, 'distributor_contact_lname', $lname);
				update_user_meta($contact_id, 'distributor_contact_phone', $phone);
				$response = array('status' => true);
			}
		} else {
			$contact_id = wp_update_user(array('ID' => $contact_id, 'user_email' => $email));
			$return = $wpdb->update($wpdb->users, array('user_login' => $uname), array('ID' => $contact_id));
			if ($password != '') {

				wp_set_password($password, $contact_id);
				$to = $email;
				$subject = 'PermaSafe: Your User Account has been updated';
				$password = $password;
				send_mail_to_users($to, $password, $subject, '', $uname);
			}
			update_user_meta($contact_id, 'distributor_contact_fname', $fname);
			update_user_meta($contact_id, 'distributor_contact_lname', $lname);
			update_user_meta($contact_id, 'distributor_contact_phone', $phone);
			$response = array('status' => true);
		}
		echo json_encode($response);
		die;
	}

	// delete distributor contact
	public function pmsafe_delete_distributor_contact_form_function()
	{
		$user_id = $_POST['contact_id'];
		wp_delete_user($user_id);

		$redirect_url = admin_url('admin.php?page=distributors-lists');
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}

	// add dealer
	public function pmsafe_register_dealer_form_function()
	{
		$user_prefix = 'S';
		$dealers = get_users('role=contributor&orderby=ID&order=DESC');
		$last_id = $dealers[0]->user_login;

		if (empty($dealers)) {
			$numbers = 1000 + 1;
			$dealers_code = $user_prefix . $numbers;
		} else {
			$first_ltr = substr($last_id, 0, 2);
			$numbers = substr($last_id, 1);
			$numbers = $numbers + 1;
			$dealers_code = $user_prefix . $numbers; // $dealers_code = 'S1001';

		}

		$dealer_name = $_POST['pmsafe_dealer_name'];
		$dealer_email = $_POST['pmsafe_dealer_email'];

			$permitted_chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$random_char = substr(str_shuffle($permitted_chars), 0, 4);
			$dealer_email = $random_char . '@permasafe.com';
			$dealer_password = wp_generate_password();

		$dealer_store_address = $_POST['pmsafe_dealer_store_address'];
		$dealer_phone_number = $_POST['pmsafe_dealer_phone_number'];
		$dealer_fax_number = $_POST['pmsafe_dealer_fax_number'];
		$dealer_distributor = $_POST['pmsafe_dealer_distributor'];

		$user_id = wp_create_user($dealers_code, $dealer_password, $dealer_email);
		if ($user_id) {
			$set_user_role = new WP_User($user_id);
			$set_user_role->set_role('contributor');


			update_user_meta($user_id, 'dealer_name', $dealer_name);
			update_user_meta($user_id, 'dealer_store_address', $dealer_store_address);
			update_user_meta($user_id, 'dealer_phone_number', $dealer_phone_number);
			update_user_meta($user_id, 'dealer_fax_number', $dealer_fax_number);
			update_user_meta($user_id, 'dealer_distributor_name', $dealer_distributor);

			$redirect_url = admin_url('admin.php?page=dealers-lists&action=view&dealer=' . $user_id);
			$response = array('status' => true, 'redirect' => $redirect_url);
		} else {
			$response = array('status' => false);
		}
		echo json_encode($response);


		die;
	}

	// edit dealer
	public function pmsafe_edit_dealer_form_function()
	{
		// pr($_POST);
		global $wpdb;

		$user_id = $_POST['pmsafe_dealer_id'];
		$dealer_code = $_POST['pmsafe_dealer_code'];
		$edit_name = $_POST['pmsafe_dealer_name'];
		$edit_email = $_POST['pmsafe_dealer_email'];
		$edit_store_address = $_POST['pmsafe_dealer_store_address'];
		$edit_phone_number = $_POST['pmsafe_dealer_phone_number'];
		$edit_fax_number = $_POST['pmsafe_dealer_fax_number'];
		$new_password = $_POST['pmsafe_dealer_password'];
		$dealer_distributor = $_POST['pmsafe_dealer_distributor'];
		$user_id = wp_update_user(array('ID' => $user_id, 'user_email' => $edit_email));

		update_user_meta($user_id, 'dealer_name', $edit_name);
		update_user_meta($user_id, 'dealer_store_address', $edit_store_address);
		update_user_meta($user_id, 'dealer_phone_number', $edit_phone_number);
		update_user_meta($user_id, 'dealer_fax_number', $edit_fax_number);
		update_user_meta($user_id, 'dealer_distributor_name', $dealer_distributor);
		if ($new_password != '') {
			wp_set_password($new_password, $user_id);
		}

		$redirect_url = admin_url('admin.php?page=dealers-lists&action=view&dealer=' . $user_id);

		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);

		die;
	}

	// delete dealer
	public function pmsafe_delete_dealer_form_function()
	{
		$user_id = $_POST['pmsafe_dealer_id'];
		wp_delete_user($user_id);
		global $wpdb;
		$contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_dealer_id" AND wum.meta_value =' . $user_id);
		foreach ($contact_info as $key => $value) {
			$contact_id = $value->user_id;
			wp_delete_user($contact_id);
		}
		delete_user_meta($user_id, 'dealer_name');
		delete_user_meta($user_id, 'dealer_store_address');
		delete_user_meta($user_id, 'dealer_phone_number');
		delete_user_meta($user_id, 'dealer_fax_number');
		delete_user_meta($user_id, 'dealer_distributor_name');
		delete_user_meta($user_id, 'dealer_contact_info');
		$redirect_url = admin_url('admin.php?page=dealers-lists');
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}

	//add dealer contact information from modal.
	public function add_dealer_contact_information()
	{

		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$dealer_id = $_POST['dealer_id'];

		if (username_exists($uname)) {
			$response = array('status' => false);
		} else {
			if ($uname == '') {
				$contact_increment = get_option('dealer_contact_increment');
				if (empty($contact_increment)) {
					$num = 1;
				} else {
					$num = $contact_increment + 1;
				}

				$dealer_users = get_user_by('ID', $dealer_id);
				$dealers_code = $dealer_users->user_login;

				$string = $dealers_code . '_';
				$user_name = $string . $num;
				update_option('dealer_contact_increment', $num);
			} else {
				$user_name = $uname;
			}

			$contact_id = wp_create_user($user_name, $password, $email);
			$set_user_role = new WP_User($contact_id);
			$set_user_role->set_role('dealer-user');
			update_user_meta($contact_id, 'contact_fname', $fname);
			update_user_meta($contact_id, 'contact_lname', $lname);
			update_user_meta($contact_id, 'contact_phone', $phone);
			update_user_meta($contact_id, 'contact_dealer_id', $dealer_id);

			$to = $email;
			$password = $password;
			$subject = 'PermaSafe: Your User Account Registration Information';
			send_mail_to_users($to, $password, $subject, '', $user_name);
			$response = array('status' => true);
		}
		echo json_encode($response);
		die;
	}

	//fetch dealer contact information
	public function fetch_dealer_contact_info()
	{
		$contact_id = $_POST['contact_id'];
		$users =  get_user_by('id', $contact_id);
		$email = $users->user_email;
		$uname = $users->user_login;
		$fname  = get_user_meta($contact_id, 'contact_fname', true);
		$lname  = get_user_meta($contact_id, 'contact_lname', true);
		$phone  = get_user_meta($contact_id, 'contact_phone', true);

		$response = array('fname' => $fname, 'lname' => $lname, 'phone' => $phone, 'email' => $email, 'uname' => $uname, 'contact_id' => $contact_id);
		echo json_encode($response);
		die;
	}

	// edit dealer contact information
	public function edit_dealer_contact_information()
	{
		global $wpdb;
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$uname = $_POST['uname'];
		$contact_id = $_POST['contact_id'];
		if (username_exists($uname)) {
			$user_id = username_exists($uname);
			if ($user_id != $contact_id) {
				$response = array('status' => false);
			} else {

				$contact_id = wp_update_user(array('ID' => $contact_id, 'user_email' => $email));
				$return = $wpdb->update($wpdb->users, array('user_login' => $uname), array('ID' => $contact_id));

				if ($password != '') {

					wp_set_password($password, $contact_id);

					$to = $email;
					$password = $password;
					$subject = 'PermaSafe: Your User Account has been updated';
					send_mail_to_users($to, $password, $subject, '', $uname);
				}

				update_user_meta($contact_id, 'contact_fname', $fname);
				update_user_meta($contact_id, 'contact_lname', $lname);
				update_user_meta($contact_id, 'contact_phone', $phone);
				$response = array('status' => true);
			}
		} else {

			$contact_id = wp_update_user(array('ID' => $contact_id, 'user_email' => $email));
			$return = $wpdb->update($wpdb->users, array('user_login' => $uname), array('ID' => $contact_id));

			if ($password != '') {

				wp_set_password($password, $contact_id);

				$to = $email;
				$password = $password;
				$subject = 'PermaSafe: Your User Account has been updated';
				send_mail_to_users($to, $password, $subject, '', $uname);
			}

			update_user_meta($contact_id, 'contact_fname', $fname);
			update_user_meta($contact_id, 'contact_lname', $lname);
			update_user_meta($contact_id, 'contact_phone', $phone);
			$response = array('status' => true);
		}
		echo json_encode($response);
		die;
	}

	//delete dealer contact
	public function pmsafe_delete_dealer_contact_form_function()
	{
		$user_id = $_POST['contact_id'];
		wp_delete_user($user_id);

		// $redirect_url = admin_url('admin.php?page=dealers-lists');
		$response = array('status' => true);
		echo json_encode($response);
		die;
	}


	//edit customer
	public function pmsafe_edit_customer_form_function()
	{
		$user_id = $_POST['pmsafe_customer_id'];

		$file = $_FILES['file_upload'];
		// pr($file);
		if ($_FILES['file_upload']['type'] != 'application/pdf') {
			$error = 'Unsupported filetype uploaded. Please upload PDF file.';
		}


		// Check if the file exists
		if (file_exists(plugin_dir_path(__DIR__) . 'upload-pdf/' . $_FILES['file_upload']['name'])) {
			$error = 'File with that name already exists.';
		}
		if (!move_uploaded_file($_FILES['file_upload']['tmp_name'], plugin_dir_path(__DIR__) . 'upload-pdf/' . $_FILES['file_upload']['name'])) {
			$error = 'Error uploading file - check destination is writeable.';
		}
		if ($file) {
			$new_pdf_link = site_url() . '/wp-content/plugins/permasafe-user-pro/upload-pdf/' . $_FILES['file_upload']['name'];
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

		$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
		$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
		$pdf_link = $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
		$registration_date = $vehicle_info[0][$nickname]['pmsafe_registration_date'];
		$code = $vehicle_info[0][$nickname]['pmsafe_member_number'];
		$login = get_post_meta($post_id, '_pmsafe_dealer', true);
		$users = get_user_by('login', $login);
		$dealer_id = $users->ID;

		$user_id = wp_update_user(array('ID' => $user_id));
		update_user_meta($user_id, 'first_name', $fname);
		update_user_meta($user_id, 'last_name', $lname);
		update_user_meta($user_id, 'pmsafe_address_1', $address1);
		update_user_meta($user_id, 'pmsafe_address_2', $address2);
		update_user_meta($user_id, 'pmsafe_city', $city);
		update_user_meta($user_id, 'pmsafe_state', $state);
		update_user_meta($user_id, 'pmsafe_zipcode', $zip);
		update_user_meta($user_id, 'pmsafe_phone_number', $phone);
		if ($year != '') {
			$customer_vehicle_info = array();
			if (isset($file)) {
				if ($_FILES["file_upload"]["error"] == 4) {
					$customer_vehicle_info[$nickname] = array(
						'pmsafe_vehicle_year' => $year,
						'pmsafe_vehicle_make' => $make,
						'pmsafe_vehicle_model' => $model,
						'pmsafe_vin' => $vin,
						'pmsafe_vehicle_mileage' => $mileage,
						'pmsafe_registration_date' => $registration_date,
						'pmsafe_member_number' => $code,
						'pmsafe_member_code_id' => $post_id,
						'pmsafe_pdf_link' => $pdf_link
					);
					update_user_meta($user_id, 'pmsafe_vehicle_info', $customer_vehicle_info);
				} else {
					$customer_vehicle_info[$nickname] = array(
						'pmsafe_vehicle_year' => $year,
						'pmsafe_vehicle_make' => $make,
						'pmsafe_vehicle_model' => $model,
						'pmsafe_vin' => $vin,
						'pmsafe_vehicle_mileage' => $mileage,
						'pmsafe_registration_date' => $registration_date,
						'pmsafe_member_number' => $code,
						'pmsafe_member_code_id' => $post_id,
						'pmsafe_pdf_link' => $new_pdf_link
					);
					update_user_meta($user_id, 'pmsafe_vehicle_info', $customer_vehicle_info);
					update_post_meta($post_id, 'pmsafe_pdf_link', $new_pdf_link);
				}
			} else {

				$customer_vehicle_info[$nickname] = array(
					'pmsafe_vehicle_year' => $year,
					'pmsafe_vehicle_make' => $make,
					'pmsafe_vehicle_model' => $model,
					'pmsafe_vin' => $vin,
					'pmsafe_vehicle_mileage' => $mileage,
					'pmsafe_registration_date' => $registration_date,
					'pmsafe_member_number' => $code,
					'pmsafe_member_code_id' => $post_id,
					'pmsafe_pdf_link' => $pdf_link
				);
				update_user_meta($user_id, 'pmsafe_vehicle_info', $customer_vehicle_info);
			}
		}
		if ($new_password != '') {
			wp_set_password($new_password, $user_id);
		}

		$redirect_url = admin_url('admin.php?page=customers-lists&action=view_customer_details&id=' . $user_id);
		if ($error != '') {
			if ($_FILES["file_upload"]["error"] == 4) {
				$response = array('status' => true, 'redirect' => $redirect_url);
			} else {
				$response = array('status' => false, 'error' => $error);
			}
		} else {
			$response = array('status' => true, 'redirect' => $redirect_url);
		}
		// $response = array('status' => true);
		echo json_encode($response);
		die;
	}

	//delete dealer customer
	public function pmsafe_delete_customer_form_function()
	{
		$user_id = $_POST['pmsafe_customer_id'];
		$nickname = get_user_meta($user_id, 'nickname', true);

		$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
		// pr($vehicle_info);
		$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
		// echo 'post'.$post_id;

		$login = get_post_meta($post_id, '_pmsafe_dealer', true);
		$users = get_user_by('login', $login);
		$dealer_id = $users->ID;

		update_post_meta($post_id, '_pmsafe_code_status', 'available');

		wp_delete_user($user_id);
		delete_post_meta($post_id, '_pmsafe_used_code_user_name');
		delete_post_meta($post_id, '_pmsafe_used_code_date');
		delete_post_meta($post_id, 'pmsafe_pdf_link');

		$redirect_url = admin_url('admin.php?page=customers-lists&action=view_customer&dealer=' . $dealer_id);
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}

	//delete customers
	public function pmsafe_delete_customers_form_function()
	{
		$user_id = $_POST['pmsafe_customer_id'];
		$nickname = get_user_meta($user_id, 'nickname', true);

		$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
		// pr($vehicle_info);
		$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
		// echo 'post'.$post_id;
		$login = get_post_meta($post_id, '_pmsafe_dealer', true);
		$users = get_user_by('login', $login);
		$dealer_id = $users->ID;
		update_post_meta($post_id, '_pmsafe_code_status', 'available');

		wp_delete_user($user_id);
		delete_post_meta($post_id, '_pmsafe_used_code_user_name');
		delete_post_meta($post_id, '_pmsafe_used_code_date');
		delete_post_meta($post_id, 'pmsafe_pdf_link');

		$redirect_url = admin_url('admin.php?page=customers-lists');
		$response = array('status' => true, 'redirect' => $redirect_url);
		echo json_encode($response);
		die;
	}

	//get customer in csv
	public function get_customer_csv_data()
	{
		$dealer_login = $_POST['customer_dealer_login'];

		$dealer_user = get_user_by('login', $dealer_login);
		$dealer_id = $dealer_user->data->ID;
		$distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);
		$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
		$name = get_user_meta($dealer_id, 'dealer_name', true);

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
			$benefits_package = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
			$invitation_id = explode(',', $invitation_ids);
			$data = pmsafe_unused_code_count($post_id);
			$available = $data['total'] - $data['used'];

			foreach ($invitation_id as $id) {
				$code_status = get_post_meta($id, '_pmsafe_code_status', true);
				if ($code_status == 'used') {
					$code = get_post_meta($id, '_pmsafe_invitation_code', true);

					$pdf_link = get_post_meta($id, 'pmsafe_pdf_link', true);

					$customer_user = get_user_by('login', $code);
					$customer_name = $customer_user->first_name . ' ' . $customer_user->last_name;
					$created_date = get_post_meta($id, '_pmsafe_code_create_date', true);
					$used_date = get_post_meta($id, '_pmsafe_used_code_date', true);


					$response .= $customer_user->user_login . ',' . $benefits_package . ',' . $bulk_member . ',' . $code_status . ',' . $customer_name . ',' . $customer_user->user_email . ',' . $name . ',' . $distributor_name . ',' . $created_date . ',' . $used_date . ',' . "=HYPERLINK(\"" . $pdf_link . "\")" . "\r\n";
				}
			}
		}
		echo $response;
		die;
	}

	/**
	 * ajax function for reset individual member code.
	 */
	public function reset_code_function()
	{
		$post_id = $_POST['post_id'];
		$bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);
		$bulk_prefix = get_post_meta($bulk_id, '_pmsafe_invitation_prefix', true);
		$code_prefix = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
		$member_code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
		$user = get_user_by('login', $member_code);

		$exist_status = get_post_meta($post_id, '_pmsafe_code_status', true);
		if ($bulk_prefix) {
			update_post_meta($post_id, '_pmsafe_code_prefix', $bulk_prefix);
		} else {

			update_post_meta($post_id, '_pmsafe_code_prefix', $code_prefix);
		}
		if ($exist_status == 'used') {
			update_post_meta($post_id, '_pmsafe_code_status', 'available');
			if ($bulk_prefix) {
				update_post_meta($post_id, '_pmsafe_code_prefix', $bulk_prefix);
			} else {
				update_post_meta($post_id, '_pmsafe_code_prefix', $code_prefix);
			}
			if ($user) { // get_user_by can return false, if no such user exists
				wp_delete_user($user->ID);
			}
			delete_post_meta($post_id, '_pmsafe_used_code_user_name');
			delete_post_meta($post_id, '_pmsafe_used_code_date');
			delete_post_meta($post_id, 'pmsafe_pdf_link');
			delete_post_meta($post_id, 'is_upgraded');
			delete_post_meta($post_id, 'upgraded_date');
			delete_post_meta($post_id, 'upgraded_by');
			delete_post_meta($post_id, 'updated_selling_price');
			delete_post_meta($post_id, 'updated_selling_price_by');

			$response = 'Code reset Successfully.';
		} else if ($exist_status == 'available') {

			$response = 'This code is available.You can\'t reset it.';
		}
		echo $response;
		die;
	}

	/**
	 * ajax function for search batch code.
	 */

	public function search_batch_code_function()
	{

		$search_val = $_POST['search_val'];
		global $wpdb;
		$html = '';
		$sql = "SELECT post_id,meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_invitation_code_start' AND post_id = (SELECT meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_bulk_invitation_id' AND post_id = (SELECT post_id FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' AND meta_value = '" . $search_val . "'))";
		$result_start = $wpdb->get_row($sql);
		$post_id = $result_start->post_id;
		$start = $result_start->meta_value;

		$sql_query = "SELECT post_id,meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_invitation_code_end' AND post_id = (SELECT meta_value  FROM `wp_postmeta` WHERE `meta_key` = '_pmsafe_bulk_invitation_id' AND post_id = (SELECT post_id FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' AND meta_value = '" . $search_val . "'))";

		$result_end = $wpdb->get_row($sql_query);
		$end = $result_end->meta_value;
		if ($search_val >= $start &&  $search_val <= $end) {
			$html .= '<tr id="post-' . $post_id . '" class="iedit author-self level-0  type-pmsafe_bulk_invi status-publish hentry">';

			$html .= '<td class="invitation_code column-invitation_code has-row-actions column-primary" data-colname="Member code">';
			$html .= '<a href="' . admin_url() . 'edit.php?post_type=pmsafe_invitecode&bulk-invitation-id=' . $post_id . '" target="_blank" class="button-secondary">' . $start . ' - ' . $end . '</a>';
			$html .= '</td>';

			$html .= '<td class="benefits_package column-benefits_package" data-colname="Benefits Package">';
			$html .= '<code>' . get_post_meta($post_id, '_pmsafe_invitation_prefix', true) . '</code>';
			$html .= '</td>';

			$html .= '<td class="dealer column-dealer" data-colname="Dealer">';
			$dealer_login = get_post_meta($post_id, '_pmsafe_dealer', true);
			$dealers = get_user_by('login', $dealer_login);
			$dealer_id = $dealers->data->ID;
			$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
			$html .= $dealer_name;
			$html .= '</td>';

			$html .= '<td class="distributor column-distributor" data-colname="Distributor">';
			$distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
			$distributors = get_user_by('login', $distributor_login);
			$distributor_id = $distributors->data->ID;
			$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
			$html .= $distributor_name;
			$html .= '</td>';

			$html .= '<td class="date_create column-date_create" data-colname="Date created">';
			$html .= get_post_meta($post_id, '_pmsafe_code_create_date', true);
			$html .= '</td>';

			$html .= '<td class="date_edit column-date_edit" data-colname="Date edited">';
			$html .= get_post_meta($post_id, '_pmsafe_date_updated', true);
			$html .= '</td>';

			$html .= '<td class="count_unused_code column-count_unused_code" data-colname="Count unused">';
			$data = pmsafe_unused_code_count($post_id);
			$html .= '<a href="#" title="' . $data['used'] . ' used out of ' . $data['total'] . '"><b><span style="color:red;">' . $data['used'] . '</span>/<span style="color:green;">' . $data['total'] . '</span></b></a>';
			$html .= '</td>';

			$html .= '<td class="edit_code column-edit_code" data-colname="Edit">';
			$html .= '<a href="' . admin_url('post.php?post=' . $post_id . '&action=edit') . '"><i class="fa fa-edit" style="font-size:18px;"></i></a>';
			$html .= '</td>';

			$html .= '<td class="delete_code column-delete_code" data-colname="Delete">';
			$html .= '<i class="fa fa-trash" id="delete_code_button" style="cursor:pointer;color:#ff0000;font-size:18px;" data-id="' . $post_id . '"></i>';
			$html .= '</td>';

			$html .= '</tr>';
		} else {
			$html .= '<tr class="no-items"><td class="colspanchange" colspan="9">No Batch Member Codes found.</td></tr>';
		}
		echo $html;

		die;
	}

	/**
	 * ajax function for search individual member code.
	 */
	public function search_individual_code_function()
	{

		$search_val = $_POST['search_val'];
		global $wpdb;
		$html = '';

		$sql = "SELECT post_id FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' AND meta_value = '" . $search_val . "'";
		$result = $wpdb->get_row($sql);

		$post_id = $result->post_id;
		$posts = get_post($post_id);

		$bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);
		$start = get_post_meta($bulk_id, '_pmsafe_invitation_code_start', true);
		$end = get_post_meta($bulk_id, '_pmsafe_invitation_code_end', true);

		if ($post_id) {
			$html .= '<tr id="post-' . $post_id . '" class="iedit author-self level-0 post-' . $post_id . ' type-pmsafe_invitecode status-publish hentry">';

			$html .= '<td class="invitation_code column-invitation_code has-row-actions column-primary" data-colname="Member code">';
			$html .= '<code>' . get_post_meta($post_id, '_pmsafe_invitation_code', true) . '</code>';
			$html .= '</td>';

			$html .= '<td class="benefits_package column-benefits_package" data-colname="Benefits Package">';
			$html .= '<code>' . get_post_meta($post_id, '_pmsafe_code_prefix', true) . '</code>';
			$html .= '</td>';

			$html .= '<td class="bulk_invitation column-bulk_invitation" data-colname="Bulk Member">';
			$html .= $start . '-' . $end;
			$html .= '</td>';

			echo $status = get_post_meta($post_id, '_pmsafe_code_status', true);
			$html .= '<td class="code_status column-code_status" data-colname="Code status">';
			if ($status == "available") {
				$html .= '<span style="color:green;"><b>Available</b></span>';
			}
			if ($status == "used") {
				$html .= '<span style="color:red;"><b>Used</b></span>';
			}
			$html .= '</td>';

			$html .= '<td class="member_name column-member_name" data-colname="Member Name">';
			$html .= get_post_meta($post_id, '_pmsafe_used_code_user_name', true);
			$html .= '</td>';

			$html .= '<td class="dealer column-dealer" data-colname="Dealer">';
			$dealer_login = get_post_meta($post_id, '_pmsafe_dealer', true);

			$dealers = get_user_by('login', $dealer_login);
			$dealer_id = $dealers->data->ID;
			$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
			$html .= $dealer_name;
			$html .= '</td>';

			$html .= '<td class="distributor column-distributor" data-colname="Distributor">';
			$distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
			$distributors = get_user_by('login', $distributor_login);
			$distributor_id = $distributors->data->ID;
			$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
			$html .= $distributor_name;
			$html .= '</td>';

			$html .= '<td class="date_create column-date_create" data-colname="Date created">';
			$html .= get_post_meta($post_id, '_pmsafe_code_create_date', true);
			$html .= '</td>';

			$html .= '<td class="date_used column-date_used" data-colname="Date Used">';
			$html .= get_post_meta($post_id, '_pmsafe_used_code_date', true);
			$html .= '</td>';

			$html .= '<td class="pdf column-pdf" data-colname="PDF">';
			$pdf_link = get_post_meta($post_id, 'pmsafe_pdf_link', true);
			if (!empty($pdf_link)) {
				$html .= '<a href="' . $pdf_link . '" target="_blank"><img src="' . includes_url() . 'images/media/document.png" class="attachment-thumbnail" width="20" height="25" /></a>';
			}
			$html .= '</td>';

			$html .= '<td class="reset column-reset" data-colname="Reset Code">';
			$html .= '<i class="fa fa-undo" style="font-size:20px;cursor:pointer;color:#0065a7;" title="reset" id="reset-code" data-id="' . $post_id . '"></i>';
			$html .= '</td>';

			$html .= '</tr>';
		} else {
			$html .= '<tr class="no-items"><td class="colspanchange" colspan="9">No Batch Member Codes found.</td></tr>';
		}
		echo $html;

		die;
	}

	public function add_search_box()
	{
		if (get_post_type(get_the_ID()) == 'pmsafe_bulk_invi') {
			?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#search-submit').css('display', 'none');
		jQuery('#post-search-input').css('display', 'none');
		jQuery(".search-box").append("<input type='search' id='search-input' value=''><input type='button' id='search-batch-code' class='button' value='Search Batch Member Codes'>");
	});
</script>
<?php
		}
		if (get_post_type(get_the_ID()) == 'pmsafe_invitecode') {
			?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#search-submit').css('display', 'none');
		jQuery('#post-search-input').css('display', 'none');
		jQuery(".search-box").append("<input type='search' id='individual-search-input' value=''><input type='button' id='search-individual-code' class='button' value='Search Member Codes'>");
	});
</script>
<?php
		}
	}


	/**
	 * 
	 *  ajax function for customer search by dealer.
	 * 
	 */
	public function admin_reports()
	{
		global $wpdb;
		$current_user = wp_get_current_user();
		$role = (array) $current_user->caps;

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

		$login = $_POST['dealer_login'];

		$check_array = get_code_by_dealer_login($login);

		$mysql = 'SELECT distinct(user_id) FROM wp_usermeta';
		$where = '';
		if ($member_code != '') {
			$where .= " AND meta_key = 'nickname' AND meta_value = '" . $member_code . "'";
		}
		if ($first_name != '') {
			$first_name = trim($first_name, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'first_name' AND meta_value LIKE '" . $first_name . "%' )";
		}
		if ($last_name != '') {
			$last_name = trim($last_name, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'last_name' AND meta_value LIKE '" . $last_name . "%' )";
		}
		if ($address != '') {
			$address = trim($address, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_address_1' AND meta_value LIKE '%" . $address . "%' )";
		}
		if ($phone_number != '') {
			$phone_number = trim($phone_number, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_phone_number' AND meta_value LIKE '%" . $phone_number . "%' )";
		}
		if ($email != '') {
			$email = trim($email, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_email' AND meta_value = '" . $email . "' )";
		}
		if ($city != '') {
			$city = trim($city, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_city' AND meta_value = '" . $city . "' )";
		}
		if ($state != '') {
			$state = trim($state, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_state' AND meta_value = '" . $state . "' )";
		}
		if ($zip_code != '') {
			$zip_code = trim($zip_code, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_zip_code' AND meta_value = '" . $zip_code . "' )";
		}
		if ($vehicle_year != '') {
			$vehicle_year = trim($vehicle_year, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_year\";s:[0-9]+:\"" . $vehicle_year . "\".*')";
		}
		if ($vehicle_make != '') {
			$vehicle_make = trim($vehicle_make, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_make\";s:[0-9]+:\"" . $vehicle_make . "\".*')";
		}
		if ($vehicle_model != '') {
			$vehicle_model = trim($vehicle_model, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_model\";s:[0-9]+:\"" . $vehicle_model . "\".*')";
		}
		if ($vehicle_vin != '') {
			$vehicle_vin = trim($vehicle_vin, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vin\";s:[0-9]+:\"" . $vehicle_vin . "\".*')";
		}
		if (!empty($where))
			$where = ' where 1=1 ' . $where;

		$sql = $mysql . $where;


		$query = $wpdb->get_results($sql);
		$html = '';
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
			$nickname = get_user_meta($value->user_id, 'nickname', true);

			if (in_array($nickname, $check_array)) {
				// echo $nickname.'<br/>';

				$html .= '<tr>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'nickname', true) . '</a>';
				$html .= '</td>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'first_name', true) . '</a>';
				$html .= '</td>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'last_name', true) . '</a>';
				$html .= '</td>';

				$address1 = get_user_meta($value->user_id, 'pmsafe_address_1', true);
				$address2 = get_user_meta($value->user_id, 'pmsafe_address_2', true);
				$city = get_user_meta($value->user_id, 'pmsafe_city', true);
				$state = get_user_meta($value->user_id, 'pmsafe_state', true);
				$zip_code = get_user_meta($value->user_id, 'pmsafe_zip_code', true);
				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . $address1 . ', ' . $address2 . ', ' . $city . ', ' . $state . ', ' . $zip_code . '</a>';
				$html .= '</td>';

				$vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);

				$url = get_site_url() . '/wp-includes/images/media/document.png';
				$html .= '<td>';
				$html .= '<a href="' . $vehicle_info[0][$nickname]['pmsafe_pdf_link'] . '" target="blank"><img src="' . $url . '" class="attachment-thumbnail" style="width:20px !important"/></a>';
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

	/**
	 * ajax function for customer search.
	 */

	public function admin_all_reports()
	{

		global $wpdb;
		$current_user = wp_get_current_user();

		$role = (array) $current_user->caps;

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

		$role = 'customer';
		// $var = 0;

		$args = array(
			'role'         => 'subscriber',
		);
		$user_query = get_users($args);
		$str = '';
		foreach ($user_query as $value_query) {
			// $str = $value_query->ID.','.$str;
			$check_array[] = $value_query->ID;
		}




		$mysql = 'SELECT distinct(user_id) FROM wp_usermeta';
		$where = '';
		if ($member_code != '') {
			$where .= " AND meta_key = 'nickname' AND meta_value = '" . $member_code . "'";
		}
		if ($first_name != '') {
			$first_name = trim($first_name, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'first_name' AND meta_value LIKE '" . $first_name . "%' )";
		}
		if ($last_name != '') {
			$last_name = trim($last_name, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'last_name' AND meta_value LIKE '" . $last_name . "%' )";
		}
		if ($address != '') {
			$address = trim($address, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_address_1' AND meta_value LIKE '%" . $address . "%' )";
		}
		if ($phone_number != '') {
			$phone_number = trim($phone_number, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_phone_number' AND meta_value LIKE '%" . $phone_number . "%' )";
		}
		if ($email != '') {
			$email = trim($email, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_email' AND meta_value = '" . $email . "' )";
		}
		if ($city != '') {
			$city = trim($city, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_city' AND meta_value = '" . $city . "' )";
		}
		if ($state != '') {
			$state = trim($state, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_state' AND meta_value = '" . $state . "' )";
		}
		if ($zip_code != '') {
			$zip_code = trim($zip_code, ' ');
			$where .= " AND user_id IN (SELECT user_id from wp_usermeta where meta_key = 'pmsafe_zip_code' AND meta_value = '" . $zip_code . "' )";
		}
		if ($vehicle_year != '') {
			$vehicle_year = trim($vehicle_year, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_year\";s:[0-9]+:\"" . $vehicle_year . "\".*')";
		}
		if ($vehicle_make != '') {
			$vehicle_make = trim($vehicle_make, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_make\";s:[0-9]+:\"" . $vehicle_make . "\".*')";
		}
		if ($vehicle_model != '') {
			$vehicle_model = trim($vehicle_model, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vehicle_model\";s:[0-9]+:\"" . $vehicle_model . "\".*')";
		}
		if ($vehicle_vin != '') {
			$vehicle_vin = trim($vehicle_vin, ' ');
			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info' AND `meta_value` REGEXP '.*\"pmsafe_vin\";s:[0-9]+:\"" . $vehicle_vin . "\".*')";
		}
		if ($dealer_name != '') {
			$dealer_name = trim($dealer_name, ' ');

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
						'value'   => $dealer_name,
						'compare' => '=',
					),

				),
			);
			$invite_results = get_posts($invite_args);
			foreach ($invite_results as $invite_result) {
				$post_id = $invite_result->ID;
				$str = $post_id . ',' . $str;
			}
			$str = rtrim($str, ",");



			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key = 'nickname' AND meta_value in (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' and post_id in (" . $str . ")))";
		}

		if ($distributor_name != '') {
			$distributor_name = trim($distributor_name, ' ');
			$users = get_user_by('login', $distributor_name);
			$distributor_id = $users->ID;
			$dealers =  get_users(
				array(
					'meta_key' => 'dealer_distributor_name',
					'meta_value' => $distributor_id
				)
			);
			foreach ($dealers as $key => $value) {
				$dealer_login_arr[] = $value->user_login;
			}

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
						'value'   => $dealer_login_arr,
						'compare' => 'IN',
					),

				),
			);
			$invite_results = get_posts($invite_args);
			foreach ($invite_results as $invite_result) {
				$post_id = $invite_result->ID;
				$str = $post_id . ',' . $str;
			}
			$str = rtrim($str, ",");

			$where .= " AND user_id IN (SELECT user_id FROM wp_usermeta WHERE meta_key = 'nickname' AND meta_value in (SELECT meta_value FROM wp_postmeta WHERE meta_key = '_pmsafe_invitation_code' and post_id in (" . $str . ")))";
		}

		if (!empty($where))
			$where = ' where 1=1 ' . $where;

		$sql = $mysql . $where;


		$query = $wpdb->get_results($sql);
		$html = '';
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
		$html .= 'Edit';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Delete';
		$html .= '</th>';


		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';


		foreach ($query as $key => $value) {
			$user_id = $value->user_id;
			$nickname = get_user_meta($value->user_id, 'nickname', true);

			$vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);

			$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
			$benefits_package = get_post_meta($post_id, '_pmsafe_code_prefix', true);
			$term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
			$term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);

			$posts = get_post($post_id);
			$post_title = $posts->post_title;
			$post_title = substr($post_title, 0, strpos($post_title, ' '));

			$login = get_post_meta($post_id, '_pmsafe_dealer', true);
			$users = get_user_by('login', $login);
			$dealer_id = $users->ID;
			$dealername = get_user_meta($dealer_id, 'dealer_name', true);

			$distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
			$dis_users = get_user_by('login', $distributor_login);
			$distributor_id = $dis_users->ID;
			$distributorname = get_user_meta($distributor_id, 'distributor_name', true);

			if (in_array($user_id, $check_array)) {
				// echo $nickname.'<br/>';

				$html .= '<tr>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'nickname', true) . '</a>';
				$html .= '</td>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'first_name', true) . '</a>';
				$html .= '</td>';

				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'last_name', true) . '</a>';
				$html .= '</td>';

				$address1 = get_user_meta($value->user_id, 'pmsafe_address_1', true);
				$address2 = get_user_meta($value->user_id, 'pmsafe_address_2', true);
				$city = get_user_meta($value->user_id, 'pmsafe_city', true);
				$state = get_user_meta($value->user_id, 'pmsafe_state', true);
				$zip_code = get_user_meta($value->user_id, 'pmsafe_zip_code', true);
				$html .= '<td>';
				$html .= '<a href="" class="view-data" data-id="' . $value->user_id . '">' . $address1 . ', ' . $address2 . ', ' . $city . ', ' . $state . ', ' . $zip_code . '</a>';
				$html .= '</td>';



				$url = get_site_url() . '/wp-includes/images/media/document.png';
				$html .= '<td>';
				$html .= '<a href="' . $vehicle_info[0][$nickname]['pmsafe_pdf_link'] . '" target="blank"><img src="' . $url . '" class="attachment-thumbnail" style="width:20px !important"/></a>';
				$html .= '</td>';

				$html .= '<td class="nisl-pdf-link">';
				$html .= $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
				$html .= '</td>';

				$html .= '<td class="nisl-pdf-link">';
				$html .= $benefits_package;
				$html .= '</td>';

				$html .= '<td class="nisl-pdf-link">';
				$html .= (($post_title) ? $post_title : '-');
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
				$html .= date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
				$html .= '</td>';

				$view_customer_details_query_args = array(
					'page'   => 'customers-lists',
					'action' => 'view_customer_details',
					'id'  => $user_id,
				);

				$actions['view_customer_details'] = sprintf(
					'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
					esc_url(wp_nonce_url(add_query_arg($view_customer_details_query_args, 'admin.php'), 'viewcustomerdetails_' . $user_id)),
					_x('view details', 'List table row action', 'wp-list-table-example')
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
					esc_url(wp_nonce_url(add_query_arg($edit_customer_details_query_args, 'admin.php'), 'editcustomerdetails_' . $user_id)),
					_x('edit details', 'List table row action', 'wp-list-table-example')
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
					esc_url(wp_nonce_url(add_query_arg($delete_customer_details_query_args, 'admin.php'), 'deletecustomerdetails_' . $user_id)),
					_x('delete details', 'List table row action', 'wp-list-table-example')
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

	/**
	 * ajax function for ger customer(user) info by user_id.
	 * 
	 */
	public function admin_view_data_reports()
	{
		$user_id = $_POST['id'];
		view_data_reports($user_id);
		exit;
	}

	/**
	 * ajax function for customer coverage report (customer-filter)
	 */
	public function admin_quick_filters()
	{
		global $wpdb;
		$current_user = wp_get_current_user();
		$role = (array) $current_user->caps;
		$datepicker1 = $_POST['datepicker1'];
		$datepicker2 = $_POST['datepicker2'];
		$select = $_POST['select'];
		$dealer_login = $_POST['dealer_name'];
		$distributor_login = $_POST['distributor_name'];


		$args = array(
			'role'         => 'subscriber',
		);
		$user_query = get_users($args);
		$str = '';
		foreach ($user_query as $value_query) {
			$check_array[] = $value_query->ID;
		};

		$sql = "SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info'";
		$query = $wpdb->get_results($sql);


		$setStart = ($datepicker1 == '' || !isset($datepicker1)) ? false : true;
		$setExpire = ($datepicker2 == '' || !isset($datepicker2)) ? false : true;



		$html = '';
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
		$html .= 'Benefits<br/> Package';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Registration <br/> Date';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Registration By';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Last Name';
		$html .= '</th>';

		$html .= '<th class="dealer-hide">';
		$html .= 'Dealer Cost';
		$html .= '</th>';

		$html .= '<th class="distributor-hide">';
		$html .= 'Distributor Cost';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'View Detail';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Edit';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Delete';
		$html .= '</th>';

		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';

		$sql = "SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info'";
		$query = $wpdb->get_results($sql);

		$title = '';
		$title .= 'Coverage Report';

		if($select == 1){
			$title .= ' | Expired Members';
		}
		if($select == 2){
			$title .= ' | Expiring Members';
		}
		if($select == 3){
			$title .= ' | Current Members';
		}
		if($select == 4){
			$title .= ' | New Members';
		}

		if(!empty($datepicker1)){
			$title .= ' | '.$datepicker1;
		}
		if(!empty($datepicker2)){
			$title .= ' | '.$datepicker2;
		}

		if(!empty($dealer_login) && empty($distributor_login) || !empty($distributor_login) && !empty($dealer_login)){
			
			$input_dealers = $dealer_login;
			foreach ($input_dealers as $loop_dealer) {
				$dealer_users = get_user_by('login', $loop_dealer);
				$dealer_arr[] = get_code_by_dealer_login($loop_dealer);
				$dealer_id = $dealer_users->ID;
				$get_dealer_name[] = get_user_meta($dealer_id,'dealer_name',true);
				$distributor_login = get_user_meta($dealer_id, 'dealer_distributor_name', true);
				$distributors = get_users(array('search' => $distributor_login));
				foreach ($distributors as $distributor) {
					if($distributor->user_login != $distributor_login){
						$distributor_name = get_user_meta($distributor->ID, 'distributor_name', true);
						$dis_arr[$distributor->user_login] = array('id'=>$distributor->ID,'name'=>$distributor_name);
					}
				}
			}
			$get_dealer_name = implode(' | ',$get_dealer_name);
			$title .= ' | '.$get_dealer_name;
			$check_array = array_flatten($dealer_arr);
		}
		if(!empty($distributor_login) && empty($dealer_login)){
			foreach ($distributor_login as $key => $value) {
				$users = get_user_by('login', $value);
				$distributor_id = $users->ID;
				$distributor_arr[] =  get_code_by_distributor_login($distributor_id);
				$get_distributor_name[] = get_user_meta($distributor_id,'distributor_name',true);
				$dealers =  get_users(
					array(
						'meta_key' => 'dealer_distributor_name',
						'meta_value' => $distributor_id
					)
				);
				foreach ($dealers as $user) {
					$input_dealers[] = $user->user_login;
				}
				$distributor_name = get_user_meta($distributor_id,'distributor_name',true);
				$dis_arr[$value] = array('id'=>$distributor_id,'name'=>$distributor_name);
			}
			$get_distributor_name = implode(' | ',$get_distributor_name);
			$title .= ' | '.$get_distributor_name;
			$check_array = array_flatten($distributor_arr);
		}

		if(empty($distributor_login) && empty($dealer_login)){
				
			$distributors = get_users('role=author');
			foreach ($distributors as $key => $value) {
				$distributor_login = $value->user_login;
				$users = get_user_by('login', $distributor_login);
				$distributor_id = $users->ID;
				$distributor_arr[] =  get_code_by_distributor_login($distributor_id);
				$get_distributor_name[] = get_user_meta($distributor_id,'distributor_name',true);
				$dealers =  get_users(
					array(
						'meta_key' => 'dealer_distributor_name',
						'meta_value' => $distributor_id
					)
				);
				foreach ($dealers as $user) {
					$input_dealers[] = $user->user_login;
				}
				$distributor_name = get_user_meta($distributor_id,'distributor_name',true);
				$dis_arr[$distributor_login] = array('id'=>$distributor_id,'name'=>$distributor_name);
			}
		}
	

		// foreach ($distributors as $distributor) {
		foreach ($dis_arr as $key => $value) {

			$distributor_id = $value['id'];
			$dis_name = get_user_meta($distributor_id, 'distributor_name', true);
			$html .= '<tr style="background-color: #0065a7;font-weight: 700;color: #fff;">';
			$html .= '<td>' . $dis_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="dealer-hide"></td><td class="distributor-hide"></td><td></td><td></td><td></td>';

			$dealers =  get_users(
				array(
					'meta_key' => 'dealer_distributor_name',
					'meta_value' => $distributor_id
				)
			);

			foreach ($dealers as $dealer) {

				$dealer_id = $dealer->ID;
				$deal_login = $dealer->user_login;
				$packTotal = array();
				$total_dealer_cost = 0;
				$total_distributor_cost = 0;
				$total_members = 0;
				
				if(in_array($deal_login,$input_dealers)){
					$dealer_arr = get_code_by_dealer_login($deal_login);
					$deal_name = get_user_meta($dealer_id, 'dealer_name', true);
					$html .= '<tr style="background-color: #008000;font-weight: 700;color: #fff;">';
					$html .= '<td>' . $deal_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
					$html .= '</tr>';
					
					foreach ($query as $key => $value) {
						$user_id = $value->user_id;
						$nickname = get_user_meta($value->user_id, 'nickname', true);
						if (in_array($nickname, $dealer_arr)) {
							$nickname = get_user_meta($value->user_id, 'nickname', true);
							$vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);
							$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
							$benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
							$term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
							$term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);
							$vehicle_registration_date = date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
							$expiration_date = date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
							$current_date = date('Y-m-d');
														
							$dealer_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
							// $dealer_cost_original_policy = $dealer_price_arr[$original_policy]['dealer_cost'];
							$dealer_cost_final_policy = $dealer_price_arr[$benefits_package]['dealer_cost'];
														
							$distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
							// $distributor_cost_original_policy = $distributor_price_arr[$original_policy]['distributor_cost'];
							$distributor_cost_final_policy = $distributor_price_arr[$benefits_package]['distributor_cost'];
							

							$address1 = get_user_meta($value->user_id, 'pmsafe_address_1', true);
							$address2 = get_user_meta($value->user_id, 'pmsafe_address_2', true);
							$city = get_user_meta($value->user_id, 'pmsafe_city', true);
							$state = get_user_meta($value->user_id, 'pmsafe_state', true);
							$zip_code = get_user_meta($value->user_id, 'pmsafe_zip_code', true);
							$vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);
							
							$registered_by = get_post_meta($post_id, 'registered_by', true);
							$get_users = get_user_by('login',$registered_by);
							$uid =  $get_users->ID;
							// $upgraded_id = get_post_meta($post_id, 'upgraded_by', true);
							$registered_by_dealer = get_user_meta($uid, 'dealer_name', true);
							$registered_by_distributor = get_user_meta($uid, 'distributor_name', true);
							$dealer_contact_fname = get_user_meta($uid, 'contact_fname', true);
							$dealer_contact_lname = get_user_meta($uid, 'contact_lname', true);
							$distributor_contact_fname = get_user_meta($uid, 'distributor_contact_fname', true);
							$distributor_contact_lname = get_user_meta($uid, 'distributor_contact_lname', true);
							$customer_fname = get_user_meta($uid, 'first_name', true);
							$customer_lname = get_user_meta($uid, 'last_name', true);
							
							
							$fname = get_user_meta($user_id, 'first_name', true);
							$lname = get_user_meta($user_id, 'last_name', true);


							if ($select == 1) {
								$select_option = "Expired Members";
 								if ($current_date > $expiration_date) {
									if (!$setStart)
										$datepicker1 = $expiration_date;

									if (!$setExpire)
										$datepicker2 = $expiration_date;

									if (($expiration_date >= $datepicker1) && ($expiration_date <= $datepicker2)) {
										if(isset($packTotal[$benefits_package])){
											$packTotal[$benefits_package] = $packTotal[$benefits_package] + 1;
										}
										else{
											$packTotal[$benefits_package] = 1;
										}
										$html .= '<tr>';

										$html .= '<td class="text-center">';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $nickname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $fname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $lname . '</a>';
										$html .= '</td>';


										$html .= '<td class="text-center">';
										$html .= $benefits_package;
										$html .= '</td>';

											$html .= '<td class="text-center">';
										$html .=  date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
										$html .= '</td>';

										$html .= '<td class="text-center">';
									
											if ($registered_by_dealer) {
												$html .= $registered_by_dealer;
											}
											if ($registered_by_distributor) {
												$html .= $registered_by_distributor;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($customer_fname) {
												$html .= $customer_fname;
											}
											if($registered_by == ''){
												$html .= $fname;
											}
										$html .= '</td>';

										$html .= '<td>';
									
											if ($registered_by_dealer) {
												$html .= '-';
											}
											if ($registered_by_distributor) {
												$html .= '-';
											}
											if ($dealer_contact_lname) {
												$html .= $dealer_contact_lname;
											}
											if ($distributor_contact_lname) {
												$html .= $distributor_contact_lname;
											}
											if ($customer_lname) {
												$html .= $customer_lname;
											}
											if($registered_by == ''){
												$html .= $lname;
											}
										$html .= '</td>';

										$html .= '<td class="dealer-hide text-center">';
										$html .=  (($dealer_cost_final_policy)?'$'.$dealer_cost_final_policy:'-');
										$html .= '</td>';

										$html .= '<td class="distributor-hide text-center">';
										$html .=  (($distributor_cost_final_policy)?'$'.$distributor_cost_final_policy:'-');
										$html .= '</td>';


										$view_customer_details_query_args = array(
											'page'   => 'customers-lists',
											'action' => 'view_customer_details',
											'id'  => $user_id,
										);

										$actions['view_customer_details'] = sprintf(
											'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
											esc_url(wp_nonce_url(add_query_arg($view_customer_details_query_args, 'admin.php'), 'viewcustomerdetails_' . $user_id)),
											_x('view details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($edit_customer_details_query_args, 'admin.php'), 'editcustomerdetails_' . $user_id)),
											_x('edit details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($delete_customer_details_query_args, 'admin.php'), 'deletecustomerdetails_' . $user_id)),
											_x('delete details', 'List table row action', 'wp-list-table-example')
										);

										$html .= '<td class="text-center">';
										$html .= $actions["delete_customer_details"];
										$html .= '</td>';

										$html .= '</tr>';
										$total_members += count($nickname);
										$total_dealer_cost += $dealer_cost_final_policy;
										$total_distributor_cost += $distributor_cost_final_policy;
									}
								}
							} else if ($select == 2) {
								$select_option = "Expiring Members";
								$date1 = $current_date;
								$date2 = $expiration_date;

								$ts1 = strtotime($date1);
								$ts2 = strtotime($date2);

								$year1 = date('Y', $ts1);
								$year2 = date('Y', $ts2);

								$month1 = date('m', $ts1);
								$month2 = date('m', $ts2);

								$diff = (($year2 - $year1) * 12) + ($month2 - $month1);

								if ($diff >= 1 && $diff <= 6) {

									if(isset($packTotal[$benefits_package])){
										$packTotal[$benefits_package] = $packTotal[$benefits_package] + 1;
									}
									else{
										$packTotal[$benefits_package] = 1;
									}
									if (!$setStart)
										$datepicker1 = $expiration_date;

									if (!$setExpire)
										$datepicker2 = $expiration_date;

									if (($expiration_date >= $datepicker1) && ($expiration_date <= $datepicker2)) {
										$html .= '<tr>';

										$html .= '<td class="text-center">';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $nickname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $fname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $lname . '</a>';
										$html .= '</td>';


										$html .= '<td class="text-center">';
										$html .= $benefits_package;
										$html .= '</td>';

											$html .= '<td class="text-center">';
										$html .=  date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
										$html .= '</td>';

										$html .= '<td class="text-center">';
									
											if ($registered_by_dealer) {
												$html .= $registered_by_dealer;
											}
											if ($registered_by_distributor) {
												$html .= $registered_by_distributor;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($customer_fname) {
												$html .= $customer_fname;
											}
											if($registered_by == ''){
												$html .= $fname;
											}
										$html .= '</td>';

										$html .= '<td>';
									
											if ($registered_by_dealer) {
												$html .= '-';
											}
											if ($registered_by_distributor) {
												$html .= '-';
											}
											if ($dealer_contact_lname) {
												$html .= $dealer_contact_lname;
											}
											if ($distributor_contact_lname) {
												$html .= $distributor_contact_lname;
											}
											if ($customer_lname) {
												$html .= $customer_lname;
											}
											if($registered_by == ''){
												$html .= $lname;
											}
										$html .= '</td>';

										$html .= '<td class="dealer-hide text-center">';
										$html .=  (($dealer_cost_final_policy)?'$'.$dealer_cost_final_policy:'-');
										$html .= '</td>';

										$html .= '<td class="distributor-hide text-center">';
										$html .=  '$'.(($distributor_cost_final_policy)?'$'.$distributor_cost_final_policy:'-');
										$html .= '</td>';


										$view_customer_details_query_args = array(
											'page'   => 'customers-lists',
											'action' => 'view_customer_details',
											'id'  => $user_id,
										);

										$actions['view_customer_details'] = sprintf(
											'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
											esc_url(wp_nonce_url(add_query_arg($view_customer_details_query_args, 'admin.php'), 'viewcustomerdetails_' . $user_id)),
											_x('view details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($edit_customer_details_query_args, 'admin.php'), 'editcustomerdetails_' . $user_id)),
											_x('edit details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($delete_customer_details_query_args, 'admin.php'), 'deletecustomerdetails_' . $user_id)),
											_x('delete details', 'List table row action', 'wp-list-table-example')
										);

										$html .= '<td class="text-center">';
										$html .= $actions["delete_customer_details"];
										$html .= '</td>';

										$html .= '</tr>';

										$total_members += count($nickname);
										$total_dealer_cost += $dealer_cost_final_policy;
										$total_distributor_cost += $distributor_cost_final_policy;
									}
								}
							} else if ($select == 3) {
								$select_option = "Current Members";
								if ($current_date < $expiration_date) {
									if (!$setStart)
										$datepicker1 = $vehicle_registration_date;

									if (!$setExpire)
										$datepicker2 = $vehicle_registration_date;

									if (($vehicle_registration_date >= $datepicker1 && $vehicle_registration_date <= $datepicker2)) {
										if(isset($packTotal[$benefits_package])){
											$packTotal[$benefits_package] = $packTotal[$benefits_package] + 1;
										}
										else{
											$packTotal[$benefits_package] = 1;
										}
										$html .= '<tr>';

										$html .= '<td class="text-center">';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $nickname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $fname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $lname . '</a>';
										$html .= '</td>';


										$html .= '<td class="text-center">';
										$html .= $benefits_package;
										$html .= '</td>';

											$html .= '<td class="text-center">';
										$html .=  date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
										$html .= '</td>';

										$html .= '<td class="text-center">';
									
											if ($registered_by_dealer) {
												$html .= $registered_by_dealer;
											}
											if ($registered_by_distributor) {
												$html .= $registered_by_distributor;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($customer_fname) {
												$html .= $customer_fname;
											}
											if($registered_by == ''){
												$html .= $fname;
											}
										$html .= '</td>';

										$html .= '<td>';
									
											if ($registered_by_dealer) {
												$html .= '-';
											}
											if ($registered_by_distributor) {
												$html .= '-';
											}
											if ($dealer_contact_lname) {
												$html .= $dealer_contact_lname;
											}
											if ($distributor_contact_lname) {
												$html .= $distributor_contact_lname;
											}
											if ($customer_lname) {
												$html .= $customer_lname;
											}
											if($registered_by == ''){
												$html .= $lname;
											}
										$html .= '</td>';

										$html .= '<td class="dealer-hide text-center">';
										$html .=  (($dealer_cost_final_policy)?'$'.$dealer_cost_final_policy:'-');
										$html .= '</td>';

										$html .= '<td class="distributor-hide text-center">';
										$html .=  (($distributor_cost_final_policy)?'$'.$distributor_cost_final_policy:'-');
										$html .= '</td>';


										$view_customer_details_query_args = array(
											'page'   => 'customers-lists',
											'action' => 'view_customer_details',
											'id'  => $user_id,
										);

										$actions['view_customer_details'] = sprintf(
											'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
											esc_url(wp_nonce_url(add_query_arg($view_customer_details_query_args, 'admin.php'), 'viewcustomerdetails_' . $user_id)),
											_x('view details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($edit_customer_details_query_args, 'admin.php'), 'editcustomerdetails_' . $user_id)),
											_x('edit details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($delete_customer_details_query_args, 'admin.php'), 'deletecustomerdetails_' . $user_id)),
											_x('delete details', 'List table row action', 'wp-list-table-example')
										);

										$html .= '<td class="text-center">';
										$html .= $actions["delete_customer_details"];
										$html .= '</td>';

										$html .= '</tr>';

										$total_members += count($nickname);
										$total_dealer_cost += $dealer_cost_final_policy;
										$total_distributor_cost += $distributor_cost_final_policy;
									}
								}
							} else if ($select == 4) {
							$select_option = "New Members";

								if (!$setStart)
									$datepicker1 = $vehicle_registration_date;

								if (!$setExpire)
									$datepicker2 = $vehicle_registration_date;

								if (($vehicle_registration_date >= $datepicker1 && $vehicle_registration_date <= $datepicker2)) {

										if(isset($packTotal[$benefits_package])){
											$packTotal[$benefits_package] = $packTotal[$benefits_package] + 1;
										}
										else{
											$packTotal[$benefits_package] = 1;
										}
										$html .= '<tr>';

										$html .= '<td class="text-center">';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $nickname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $fname . '</a>';
										$html .= '</td>';

										$html .= '<td>';
										$html .= '<a href="" class="view-data" data-id="' . $user_id . '">' . $lname . '</a>';
										$html .= '</td>';


										$html .= '<td class="text-center">';
										$html .= $benefits_package;
										$html .= '</td>';

											$html .= '<td class="text-center">';
										$html .=  date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
										$html .= '</td>';

										$html .= '<td class="text-center">';
									
											if ($registered_by_dealer) {
												$html .= $registered_by_dealer;
											}
											if ($registered_by_distributor) {
												$html .= $registered_by_distributor;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($customer_fname) {
												$html .= $customer_fname;
											}
											if($registered_by == ''){
												$html .= $fname;
											}
										$html .= '</td>';

										$html .= '<td>';
									
											if ($registered_by_dealer) {
												$html .= '-';
											}
											if ($registered_by_distributor) {
												$html .= '-';
											}
											if ($dealer_contact_lname) {
												$html .= $dealer_contact_lname;
											}
											if ($distributor_contact_lname) {
												$html .= $distributor_contact_lname;
											}
											if ($customer_lname) {
												$html .= $customer_lname;
											}
											if($registered_by == ''){
												$html .= $lname;
											}
										$html .= '</td>';

										$html .= '<td class="dealer-hide text-center">';
										$html .=  (($dealer_cost_final_policy)?'$'.$dealer_cost_final_policy:'-');
										$html .= '</td>';

										$html .= '<td class="distributor-hide text-center">';
										$html .=  (($distributor_cost_final_policy)?'$'.$distributor_cost_final_policy:'-');
										$html .= '</td>';


										$view_customer_details_query_args = array(
											'page'   => 'customers-lists',
											'action' => 'view_customer_details',
											'id'  => $user_id,
										);

										$actions['view_customer_details'] = sprintf(
											'<a href="%1$s" title="View Details"><i class="fa fa-eye"></i></a>',
											esc_url(wp_nonce_url(add_query_arg($view_customer_details_query_args, 'admin.php'), 'viewcustomerdetails_' . $user_id)),
											_x('view details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($edit_customer_details_query_args, 'admin.php'), 'editcustomerdetails_' . $user_id)),
											_x('edit details', 'List table row action', 'wp-list-table-example')
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
											esc_url(wp_nonce_url(add_query_arg($delete_customer_details_query_args, 'admin.php'), 'deletecustomerdetails_' . $user_id)),
											_x('delete details', 'List table row action', 'wp-list-table-example')
										);

										$html .= '<td class="text-center">';
										$html .= $actions["delete_customer_details"];
										$html .= '</td>';

										$html .= '</tr>';

										$total_members += count($nickname);
										$total_dealer_cost += $dealer_cost_final_policy;
										$total_distributor_cost += $distributor_cost_final_policy;
								}
							}
						}
						
					} // query
					
					if($packTotal){
					foreach ($packTotal as $key => $value) {
				
							$html .= '<tr style="background-color: #ffff00;font-weight: 700;color: #000000;">';
								$html .= '<td>Total '.$key.'</td><td></td><td></td><td class="text-center">'.$value.'</td><td></td><td></td><td></td><td class="dealer-hide"></td><td class="distributor-hide"></td><td></td><td></td><td></td>';
							$html .= '</tr>'; 
							
						}
					}

					$html .= '<tr style="background-color: #ffff00;font-weight: 700;color: #000000;">';
							$html .= '<td>Total '.$select_option.' - '.$deal_login.'</td><td></td><td></td><td class="text-center">'.$total_members.'</td><td></td><td></td><td></td><td class="dealer-hide text-center">$'.$total_dealer_cost.'</td><td class="distributor-hide text-center"> $'.$total_distributor_cost.'</td><td></td><td></td><td></td>';
					$html .= '</tr>'; 
				}
				} // dealers
				$html .= '</tr/>';
		} //distributors


		$html .= '</tbody>';
		$html .= '</table>';

		$response = array('dttable'=>$html,'toptitle'=>$title);
		echo json_encode($response);
		die;
	}

	/**
	 * ajax function for filtering date vise upgraded membership.
	 */
	public function admin_membership_date_filter()
	{
		global $wpdb;
		$datepicker1 = $_POST['datepicker1'];
		$datepicker2 = $_POST['datepicker2'];
		$dealer = $_POST['dealer'];
		$distributor = $_POST['distributor'];
		$policy = $_POST['policy'];
		$package = $_POST['package'];
		$login = $_POST['login'];
		$users = get_user_by('login', $login);
		$role = $users->roles;

		$title = '';
		$title .= 'Upgrade Report';
		if ($login != '') {
			if (in_array('contributor', $role)) {

				$check_array = get_code_by_dealer_login($login);
				$get_dealers = get_user_by('login',$login);
				$get_dealer_id = $get_dealers->ID;
				$get_dealer_name = get_user_meta($get_dealer_id,'dealer_name',true);
				$title .= ' | '.$get_dealer_name;

				$input_dealers[] = $login;
				$dealer_id = $get_dealer_id;
				$distributor_login = get_user_meta($dealer_id, 'dealer_distributor_name', true);
				$distributors = get_users(array('search' => $distributor_login));
				$distributor_id = $distributors->ID;
				$distributor_name = get_user_meta($distributor_id,'distributor_name',true);	
				$dis_arr[$login] = array('id'=>$distributor_id,'name'=>$distributor_name);
			}
			if (in_array('author', $role)) {

				$users = get_user_by('login', $login);
				$distributor_id = $users->ID;
				$check_array =  get_code_by_distributor_login($distributor_id);
				$get_distributor_name = get_user_meta($distributor_id,'distributor_name',true);
				$title .= ' | '.$get_distributor_name;

                $distributors = get_users(array('search' => $login));
			
				$dis_arr[$login] = array('id'=>$distributor_id,'name'=>$get_distributor_name);

					$login_dealers =  get_users(
						array(
							'meta_key' => 'dealer_distributor_name',
							'meta_value' => $distributor_id
						)
					);
					foreach ($login_dealers as $login_dealer) {
							$input_dealers[] = $login_dealer->user_login;
				
					}
			}
		} else {
			if(!empty($dealer) && empty($distributor) || !empty($distributor) && !empty($dealer)){
				
                $input_dealers = $dealer;
				foreach ($input_dealers as $loop_dealer) {
					$dealer_users = get_user_by('login', $loop_dealer);
					$dealer_arr[] = get_code_by_dealer_login($loop_dealer);
					$dealer_id = $dealer_users->ID;
					$get_dealer_name[] = get_user_meta($dealer_id,'dealer_name',true);
					$distributor_login = get_user_meta($dealer_id, 'dealer_distributor_name', true);
					$distributors = get_users(array('search' => $distributor_login));
					foreach ($distributors as $distributor) {
						if($distributor->user_login != $distributor_login){
							$distributor_name = get_user_meta($distributor->ID, 'distributor_name', true);
							$dis_arr[$distributor->user_login] = array('id'=>$distributor->ID,'name'=>$distributor_name);
						}
					}
				}
				

				$get_dealer_name = implode(' | ',$get_dealer_name);
				$title .= ' | '.$get_dealer_name;
				$check_array = array_flatten($dealer_arr);
                
			}
			
			if(!empty($distributor) && empty($dealer)){
				foreach ($distributor as $key => $value) {
					$users = get_user_by('login', $value);
					$distributor_id = $users->ID;
					$distributor_arr[] =  get_code_by_distributor_login($distributor_id);
					$get_distributor_name[] = get_user_meta($distributor_id,'distributor_name',true);
                    $dealers =  get_users(
						array(
							'meta_key' => 'dealer_distributor_name',
							'meta_value' => $distributor_id
						)
					);
					foreach ($dealers as $user) {
						$input_dealers[] = $user->user_login;
					}
                    $distributor_name = get_user_meta($distributor_id,'distributor_name',true);
                    $dis_arr[$value] = array('id'=>$distributor_id,'name'=>$distributor_name);
				}
				$get_distributor_name = implode(' | ',$get_distributor_name);
				$title .= ' | '.$get_distributor_name;
				$check_array = array_flatten($distributor_arr);
			}

			if(empty($distributor) && empty($dealer)){
				
				$distributors = get_users('role=author');
				foreach ($distributors as $key => $value) {
					$distributor_login = $value->user_login;
					$users = get_user_by('login', $distributor_login);
				 	$distributor_id = $users->ID;
					$distributor_arr[] =  get_code_by_distributor_login($distributor_id);
					$get_distributor_name[] = get_user_meta($distributor_id,'distributor_name',true);
                    $dealers =  get_users(
						array(
							'meta_key' => 'dealer_distributor_name',
							'meta_value' => $distributor_id
						)
					);
					foreach ($dealers as $user) {
						$input_dealers[] = $user->user_login;
					}
                    $distributor_name = get_user_meta($distributor_id,'distributor_name',true);
                    $dis_arr[$distributor_login] = array('id'=>$distributor_id,'name'=>$distributor_name);
				}
			}
		}
		

		if(!empty($datepicker1)){
			$title .= ' | '.$datepicker1;
		}
		if(!empty($datepicker2)){
			$title .= ' | '.$datepicker2;
		}

		if ($policy == "upgraded") {
			$title .= ' | Upgraded Policy- '.$package;
		}
		
		if ($policy == "original") {
			$title .= ' | Original Policy- '.$package;
		}

		$setStart = ($datepicker1 == '' || !isset($datepicker1)) ? false : true;
		$setExpire = ($datepicker2 == '' || !isset($datepicker2)) ? false : true;
		


		$membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');
		foreach ($membership_results as $key => $value) {
			$post_id = $value->post_id;
			$upgraded_date = get_post_meta($post_id, 'upgraded_date', true);
			$code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
			$code_prefix = get_post_meta($post_id, '_pmsafe_code_prefix', true);
			$bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);
		
			$bulk_prefix = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
		

			if ($login != '') {
				if (!$setStart)
					$datepicker1 = $upgraded_date;

				if (!$setExpire)
					$datepicker2 = $upgraded_date;

				if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {
					if (in_array($code, $check_array)) {
						if ($policy == "upgraded") {
							if ($code_prefix == $package) {
								$invite_post_id[] = $post_id;
							}
						} else if ($policy == "original") {
							if ($bulk_prefix == $package) {
								$invite_post_id[] = $post_id;
							}
						} else {
							$invite_post_id[] = $post_id;
						}
					}
				}
			} else {
				if(!empty($distributor) && empty($dealer) || !empty($distributor) && !empty($dealer)){
					if (!$setStart)
						$datepicker1 = $upgraded_date;

					if (!$setExpire)
						$datepicker2 = $upgraded_date;
					if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {
						if (in_array($code, $check_array)) {
							if ($policy == "upgraded") {
								if ($code_prefix == $package) {
									$invite_post_id[] = $post_id;
								}
							} else if ($policy == "original") {
								if ($bulk_prefix == $package) {
									$invite_post_id[] = $post_id;
								}
							} else {
								$invite_post_id[] = $post_id;
							}
						}
					}
				} else if(!empty($dealer) && empty($distributor)){
					if (!$setStart)
						$datepicker1 = $upgraded_date;

					if (!$setExpire)
						$datepicker2 = $upgraded_date;
					if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {
						if (in_array($code, $check_array)) {
							if ($policy == "upgraded") {
								if ($code_prefix == $package) {
									$invite_post_id[] = $post_id;
								}
							} else if ($policy == "original") {
								if ($bulk_prefix == $package) {
									$invite_post_id[] = $post_id;
								}
							} else {
								$invite_post_id[] = $post_id;
							}
						}
					}
				} else {
					if (!$setStart)
						$datepicker1 = $upgraded_date;

					if (!$setExpire)
						$datepicker2 = $upgraded_date;
					if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {
						if ($policy == "upgraded") {
							if ($code_prefix == $package) {
								$invite_post_id[] = $post_id;
							}
						} else if ($policy == "original") {
							if ($bulk_prefix == $package) {
								$invite_post_id[] = $post_id;
							}
						} else {

							$invite_post_id[] = $post_id;
						}
					}
				}
			}
		}

		$benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
		foreach ($benefit_prefix as $prefix) {

			$original_prefix[] = $prefix;
		}

		$count = 0;
		foreach ($original_prefix  as $prefix1) { // PC3,BP1,BP2
			foreach ($original_prefix  as $prefix2) { //PC3,BP1,BP2
				if ($prefix1 != $prefix2) {

					$results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_prefix" and meta_value ="' . $prefix1 . '"');
					$post_id = array();
					foreach ($results as $key => $value) {
						if (in_array($value->post_id, $invite_post_id)) {
							$post_id[] = $value->post_id;
						}
					}

					if (!empty($post_id)) {
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

						if ($posts) {

							$prefix_arr[$prefix1 . '-' . $prefix2] = array();
							$count_arr = array();
							foreach ($posts as $key => $value) {
								$pid = $value->ID;
								$code_status = get_post_meta($pid, '_pmsafe_code_status', true);
								if ($code_status == 'used') {
									$code = get_post_meta($pid, '_pmsafe_invitation_code', true);
									array_push($count_arr, $code);
								}
							}
							array_push($prefix_arr[$prefix1 . '-' . $prefix2], count($count_arr));
						}
					}
				}
			}
		}
		// pr($count_arr);
		$html = '';
		$html .= '<div class="membership-count">';
		foreach ($prefix_arr as $key => $value) {

			$html .= '<p>';
			$html .= $key . '=' . '<span>' . $value[0] . '</span>';
			$html .= '</p>';
		}
		$html .= '</div>';

		$html .= '<div class="table-responsive">';

		$html .= '<table id="membership_date_table" class="display nowrap" style="width:100%">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th>';
		$html .= 'Registration Number';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'Customer Name';
		$html .= '</th>';

		$html .= '<th>';
		$html .= 'VIN';
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

		$html .= '<th>';
		$html .= 'Date';
		$html .= '</th>';

		$html .= '<th class="dealer-hide">';
		$html .= 'Dealer Cost';
		$html .= '</th>';

		$html .= '<th class="distributor-hide">';
		$html .= 'Distributor Cost';
		$html .= '</th>';

		$html .= '</tr>';
		$html .= '</thead>';

		$html .= '<tbody id="">';
		
		foreach ($dis_arr as $key => $value) {
			
			$distributor_id = $value['id'];
			$distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
			$html .= '<tr style="background-color: #0065a7;font-weight: 700;color: #fff;">';
			$html .= '<td>' . $distributor_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="dealer-hide"></td><td class="distributor-hide"></td>';
			if ($login != '') {
			

				if (in_array('contributor', $role)) {
					
					$dealers = get_users(array('search' => $login));
					
				}
				if (in_array('author', $role)) {
					
					$dealers =  get_users(
						array(
							'meta_key' => 'dealer_distributor_name',
							'meta_value' => $distributor_id
						)
					);
					
				}
				 
			} else{
					
					$dealers =  get_users(
						array(
							'meta_key' => 'dealer_distributor_name',
							'meta_value' => $distributor_id
						)
					);
			}
			
			foreach ($dealers as $in_dealer) {
			
				
				$total_upgrades = 0;
				$total_dealer_cost = 0;
				$total_distributor_cost = 0;
				
				$dealer_id = $in_dealer->ID;
				$dealer_login = $in_dealer->user_login;
				$prefix_arr1 = array();
				$invite_post_id1 = array();
				$dealer_arr = get_code_by_dealer_login($dealer_login);
				if(in_array($dealer_login,$input_dealers)){
					
					$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
					$html .= '<tr style="background-color: #008000;font-weight: 700;color: #fff;">';
					$html .= '<td>' . $dealer_name . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td class="dealer-hide"></td><td class="distributor-hide"></td>';
					$html .= '</tr>';
					$membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');
					$packTotal = array();
					foreach ($membership_results as $str) {
						$post_id = $str->post_id;
						$code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
						if ($code_status == 'used') {
							$bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);

							$bulk_prefix = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);

							
							$code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
							$upgraded_id = get_post_meta($post_id, 'upgraded_by', true);
							$dealer_name = get_user_meta($upgraded_id, 'dealer_name', true);
							$distributor_name = get_user_meta($upgraded_id, 'distributor_name', true);
							$dealer_contact_fname = get_user_meta($upgraded_id, 'contact_fname', true);
							$distributor_contact_fname = get_user_meta($upgraded_id, 'distributor_contact_fname', true);
							$admin_name = get_user_meta($upgraded_id, 'first_name', true);
							$users = get_user_by('login', $code);
							$user_id = $users->ID;
							$fname = get_user_meta($user_id, 'first_name', true);
							$lname = get_user_meta($user_id, 'last_name', true);

							$code_prefix = get_post_meta($post_id, '_pmsafe_code_prefix', true);
							
							$code_dealer_login =  get_post_meta($post_id, '_pmsafe_dealer', true);
							$dealer_users = get_user_by('login', $code_dealer_login);
							$dealer_id = $dealer_users->ID;
							$distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);

							$dealer_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
							$distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
							$dealer_cost = $dealer_price_arr[$code_prefix]['dealer_cost'];
							$distributor_cost = $distributor_price_arr[$code_prefix]['distributor_cost'];

							$users = get_user_by('login', $code);
							$user_id = $users->ID;
							$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', true);
							$vin = $vehicle_info[$code]['pmsafe_vin'];

							$upgraded_date = get_post_meta($post_id, 'upgraded_date', true);
							
							if (in_array($code, $dealer_arr)) {

								if (!$setStart){
									$datepicker1 = $upgraded_date;
								}

								if (!$setExpire){
									$datepicker2 = $upgraded_date;
								}
									
								
								if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {

									if ($policy == "upgraded") {
										if ($code_prefix == $package) {
											if(isset($packTotal[$code_prefix])){
												$packTotal[$code_prefix] = $packTotal[$code_prefix]	+ 1;
											}
											else{
												$packTotal[$code_prefix] = 1;
											}
											$html .= '<tr>';
											$html .= '<td style="text-align:center;">';
											$html .= $code;
											$html .= '</td>';

											$html .= '<td>';
											$html .= $fname . ' ' . $lname;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $vin;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $bulk_prefix;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $code_prefix;
											$html .= '</td>';


											$html .= '<td>';
											if ($dealer_name) {
												$html .= $dealer_name;
											}
											if ($distributor_name) {
												$html .= $distributor_name;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($admin_name) {
												$html .= $admin_name;
											}
											$html .= '</td>';

											$html .= '<td class="text-center">';
											$html .= get_post_meta($post_id, 'upgraded_date', true);
											$html .= '</td>';

											$html .= '<td class="dealer-hide text-center">';
											$html .= (($dealer_cost) ? '$' . $dealer_cost : '-');
											$html .= '</td>';

											$html .= '<td class="distributor-hide text-center">';
											$html .= (($distributor_cost) ? '$' . $distributor_cost : '-');
											$html .= '</td>';

											$html .= '</tr>';
												$total_upgrades += count($code);
											$total_dealer_cost += $dealer_cost;
											$total_distributor_cost += $distributor_cost;
										}
									} else if ($policy == "original") {
										if ($bulk_prefix == $package) {
											if(isset($packTotal[$code_prefix])){
												$packTotal[$code_prefix] = $packTotal[$code_prefix]	+ 1;
											}
											else{
												$packTotal[$code_prefix] = 1;
											}
											$html .= '<tr>';
											$html .= '<td style="text-align:center;">';
											$html .= $code;
											$html .= '</td>';

											$html .= '<td>';
											$html .= $fname . ' ' . $lname;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $vin;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $bulk_prefix;
											$html .= '</td>';

											$html .= '<td style="text-align:center;">';
											$html .= $code_prefix;
											$html .= '</td>';


											$html .= '<td>';
											if ($dealer_name) {
												$html .= $dealer_name;
											}
											if ($distributor_name) {
												$html .= $distributor_name;
											}
											if ($dealer_contact_fname) {
												$html .= $dealer_contact_fname;
											}
											if ($distributor_contact_fname) {
												$html .= $distributor_contact_fname;
											}
											if ($admin_name) {
												$html .= $admin_name;
											}
											$html .= '</td>';

											$html .= '<td class="text-center">';
											$html .= get_post_meta($post_id, 'upgraded_date', true);
											$html .= '</td>';

											$html .= '<td class="dealer-hide text-center">';
											$html .= (($dealer_cost) ? '$' . $dealer_cost : '-');
											$html .= '</td>';

											$html .= '<td class="distributor-hide text-center">';
											$html .= (($distributor_cost) ? '$' . $distributor_cost : '-');
											$html .= '</td>';

											$html .= '</tr>';
												$total_upgrades += count($code);
												$total_dealer_cost += $dealer_cost;
												$total_distributor_cost += $distributor_cost;
										}
									} else {
										if(isset($packTotal[$code_prefix])){
											$packTotal[$code_prefix] = $packTotal[$code_prefix]	+ 1;
										}
										else{
											$packTotal[$code_prefix] = 1;
										}
										$html .= '<tr>';
										$html .= '<td class="text-center">';
										$html .= $code;
										$html .= '</td>';

										$html .= '<td>';
										$html .= $fname . ' ' . $lname;
										$html .= '</td>';

										$html .= '<td class="text-center">';
										$html .= $vin;
										$html .= '</td>';

										$html .= '<td class="text-center">';
										$html .= $bulk_prefix;
										$html .= '</td>';

										$html .= '<td class="text-center">';
										$html .= $code_prefix;
										$html .= '</td>';


										$html .= '<td>';
										if ($dealer_name) {
											$html .= $dealer_name;
										}
										if ($distributor_name) {
											$html .= $distributor_name;
										}
										if ($dealer_contact_fname) {
											$html .= $dealer_contact_fname;
										}
										if ($distributor_contact_fname) {
											$html .= $distributor_contact_fname;
										}
										if ($admin_name) {
											$html .= $admin_name;
										}
										$html .= '</td>';

										$html .= '<td class="text-center">';
										$html .= get_post_meta($post_id, 'upgraded_date', true);
										$html .= '</td>';

										$html .= '<td class="text-center dealer-hide">';
										$html .= (($dealer_cost) ? '$' . $dealer_cost : '-');
										$html .= '</td>';

										$html .= '<td class="text-center distributor-hide">';
										$html .= (($distributor_cost) ? '$' . $distributor_cost : '-');
										$html .= '</td>';

										$html .= '</tr>';
											$total_upgrades += count($code);
										$total_dealer_cost += $dealer_cost;
										$total_distributor_cost += $distributor_cost;
									}
								
								}
								
							}
						}
					}	

					
					if($packTotal){
						foreach ($packTotal as $key => $value) {
					
							$html .= '<tr style="background-color: #ffff00;font-weight: 700;color: #000000;">';
								$html .= '<td>Total '.$key.'</td><td></td><td></td><td></td><td class="text-center">'. $value.'</td><td></td><td></td><td class="dealer-hide"></td><td class="distributor-hide"></td>';
							$html .= '</tr>'; 
							
						}
					}
				
					$html .= '<tr style="background-color: #ffff00;font-weight: 700;color: #000000;">';
					$html .= '<td>Total Upgrades '.$dealer_login.'</td><td></td><td></td><td></td><td class="text-center">'.$total_upgrades.'</td><td></td><td></td><td class="text-center dealer-hide">$'.$total_dealer_cost.'</td><td class="text-center distributor-hide">$'.$total_distributor_cost.'</td>';
					$html .= '</tr>'; 
				
				}
			}
		}
		$html .= '</tbody>';
		$html .= '</table>';


		$html .= '<div>';
		$response = array('dttable'=>$html,'toptitle'=>$title);
		echo json_encode($response);
		
		die;
	}

	/**
	 * ajax function for add benefits package price for dealers.
	 */
	public function add_dealer_benefits_package_price_function()
	{
		$dealer_id = $_POST['dealer_id'];
		$selected_package = $_POST['selected_package'];
		$dealer_cost = $_POST['dealer_cost'];
		$distributor_cost = $_POST['distributor_cost'];
		$selling_price = $_POST['selling_price'];

		$distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);
		$distributor_get_price_arr = get_user_meta($distributor_id, 'pricing_package', true);

		$get_price_arr = get_user_meta($dealer_id, 'pricing_package', true);


		$price_arr[$selected_package] = array(
			'dealer_cost' => $dealer_cost,
			'selling_price' => $selling_price
		);
		$distributor_price_arr[$selected_package] = array(
			'distributor_cost' => $distributor_cost
		);

		if ($get_price_arr) {
			if (array_key_exists($selected_package, $get_price_arr)) {
				$response = 0;
			} else {
				if ($distributor_cost != '') {
					if ($distributor_get_price_arr) {
						if (array_key_exists($selected_package, $distributor_get_price_arr)) {
							unset($distributor_get_price_arr[$selected_package]);
							$nisl_distributor_price_arr = $distributor_get_price_arr + $distributor_price_arr;
							update_user_meta($distributor_id, 'pricing_package', $nisl_distributor_price_arr);
						} else {
							$nisl_distributor_price_arr = $distributor_get_price_arr + $distributor_price_arr;
							update_user_meta($distributor_id, 'pricing_package', $nisl_distributor_price_arr);
						}
					} else {
						$nisl_distributor_price_arr = $distributor_price_arr;
						update_user_meta($distributor_id, 'pricing_package', $nisl_distributor_price_arr);
					}
				}
				$nisl_price_arr = $get_price_arr + $price_arr;
				update_user_meta($dealer_id, 'pricing_package', $nisl_price_arr);
				$response = 1;
			}
		} else {
			update_user_meta($dealer_id, 'pricing_package', $price_arr);
			if ($distributor_cost != '') {
				update_user_meta($distributor_id, 'pricing_package', $distributor_price_arr);
			}
			$response = 1;
		}

		echo $response;
		die;
	}

	/**
	 * ajax function for edit benefits package price for dealers.
	 */
	public function edit_dealer_benefits_package_price_function()
	{
		$dealer_id = $_POST['dealer_id'];
		$selected_package = $_POST['selected_package'];
		$dealer_cost = $_POST['dealer_cost'];
		$distributor_cost = $_POST['distributor_cost'];
		$selling_price = $_POST['selling_price'];
		$get_price_arr = get_user_meta($dealer_id, 'pricing_package', true);

		$distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);
		$get_distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);

		if ($dealer_cost == '') {
			$dealer_cost = $get_price_arr[$selected_package]['dealer_cost'];
		} else {
			$dealer_cost = $dealer_cost;
		}

		if ($distributor_cost == '') {
			$distributor_cost = $get_distributor_price_arr[$selected_package]['distributor_cost'];
		} else {
			$distributor_cost = $distributor_cost;
		}

		if ($selling_price == '') {
			$selling_price = $get_price_arr[$selected_package]['selling_price'];
		} else {
			$selling_price = $selling_price;
		}

		$price_arr[$selected_package] = array(
			'dealer_cost' => $dealer_cost,
			'selling_price' => $selling_price
		);

		$distributor_price_arr[$selected_package] = array(
			'distributor_cost' => $distributor_cost
		);

		if ($get_price_arr) {
			if (array_key_exists($selected_package, $get_price_arr)) {
				unset($get_price_arr[$selected_package]);
				$new_price_arr = $get_price_arr + $price_arr;
			} else {
				$new_price_arr = $get_price_arr + $price_arr;
			}
		} else {
			$new_price_arr = $price_arr;
		}
		update_user_meta($dealer_id, 'pricing_package', $new_price_arr);

		if ($distributor_cost != '') {
			if ($get_distributor_price_arr) {
				if (array_key_exists($selected_package, $get_distributor_price_arr)) {
					unset($get_distributor_price_arr[$selected_package]);
					$new_distributor_price_arr = $get_distributor_price_arr + $distributor_price_arr;
				} else {
					$new_distributor_price_arr = $get_distributor_price_arr + $distributor_price_arr;
				}
			} else {
				$new_distributor_price_arr = $distributor_price_arr;
			}
			update_user_meta($distributor_id, 'pricing_package', $new_distributor_price_arr);
		}
		die;
	}

	/**
	 * ajax function for fetching benefits package price for dealers during edit functionality.
	 */
	public function fetch_dealer_package_price()
	{
		$dealer_id = $_POST['dealer_id'];
		$post_distributor_id = $_POST['distributor_id'];
		$selected_package = $_POST['package'];
		$get_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
		$selling_price = $get_price_arr[$selected_package]['selling_price'];
		$dealer_cost = $get_price_arr[$selected_package]['dealer_cost'];
		$distributor_id = get_user_meta($dealer_id, 'dealer_distributor_name', true);
		if ($post_distributor_id != '') {
			$distributor_id = $post_distributor_id;
		} else {
			$distributor_id = $distributor_id;
		}

		$distributor_get_price_arr = get_user_meta($distributor_id, 'pricing_package', true);

		$distributor_cost = $distributor_get_price_arr[$selected_package]['distributor_cost'];
		$response = array('distributor_cost' => $distributor_cost, 'dealer_cost' => $dealer_cost, 'selling_price' => $selling_price);
		echo json_encode($response);
		die;
	}

	/**
	 * ajax function for delete benefits package price for dealers.
	 */

	public function delete_dealer_benefits_package_price_function()
	{
		$dealer_id = $_POST['dealer_id'];
		$package = $_POST['package'];
		$get_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
		unset($get_price_arr[$package]);
		update_user_meta($dealer_id, 'pricing_package', $get_price_arr);
		die;
	}

	/**
	 * ajax function for add distributor cost for dealers.
	 */
	public function add_distributor_cost_function()
	{
		$distributor_id = $_POST['distributor_id'];
		$selected_package = $_POST['selected_package'];
		$distributor_cost = $_POST['distributor_cost'];

		$get_price_arr = get_user_meta($distributor_id, 'pricing_package', true);

		$price_arr[$selected_package] = array(
			'distributor_cost' => $distributor_cost,
		);

		$dealers =  get_users(
			array(
				'meta_key' => 'dealer_distributor_name',
				'meta_value' => $distributor_id
			)
		);


		if ($get_price_arr) {

			if (array_key_exists($selected_package, $get_price_arr)) {
				$response = 0;
			} else {
				$nisl_price_arr = $get_price_arr + $price_arr;
				update_user_meta($distributor_id, 'pricing_package', $nisl_price_arr);
				$response = 1;
			}
		} else {

			update_user_meta($distributor_id, 'pricing_package', $price_arr);
			$response = 1;
		}

		echo $response;

		die;
	}

	/**
	 * ajax function for edit distributor cost for dealers.
	 */
	public function edit_distributor_cost_function()
	{
		$distributor_id = $_POST['distributor_id'];
		$selected_package = $_POST['selected_package'];
		$distributor_cost = $_POST['distributor_cost'];

		$get_distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);



		$distributor_price_arr[$selected_package] = array(
			'distributor_cost' => $distributor_cost
		);


		if ($get_distributor_price_arr) {
			if (array_key_exists($selected_package, $get_distributor_price_arr)) {
				unset($get_distributor_price_arr[$selected_package]);
				$new_price_arr = $get_distributor_price_arr + $distributor_price_arr;
			} else {
				$new_price_arr = $get_distributor_price_arr + $distributor_price_arr;
			}
		} else {
			$new_price_arr = $distributor_price_arr;
		}

		update_user_meta($distributor_id, 'pricing_package', $new_price_arr);
		die;
	}

	/**
	 * ajax function for delete distributor cost for dealers.
	 */

	public function delete_distributor_cost_function()
	{
		$distributor_id = $_POST['distributor_id'];
		$package = $_POST['package'];
		$get_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
		unset($get_price_arr[$package]);
		update_user_meta($distributor_id, 'pricing_package', $get_price_arr);
		die;
	}

	/**
	 * ajax function for sending password reset link to contact users.
	 */
	public function send_reset_mail()
	{
		$user_id = $_POST['contact_id'];
		reset_mail_format($user_id);
		die;
	}

	public function billing_report_function(){
		$billing_date1 = $_POST['billing_date1'];
		$billing_date2 = $_POST['billing_date2'];
		$dealers = $_POST['dealers'];

		$setStart = ($billing_date1 == '' || !isset($billing_date1)) ? false : true;
		$setExpire = ($billing_date2 == '' || !isset($billing_date2)) ? false : true;

		if(empty($dealers)){
			$dealer_all_users = get_users('role=contributor');
			foreach ($dealer_all_users as $user) {
				 $input_dealers[] = $user->user_login;
			}
			
		}else{
			$input_dealers = $_POST['dealers'];
		}
		// pr($input_dealers);
		foreach ($input_dealers as $dealer) {
			$dealer_users = get_user_by('login', $dealer);
			$dealer_id = $dealer_users->ID;
			$distributor_login = get_user_meta($dealer_id, 'dealer_distributor_name', true);
			$distributors = get_users(array('search' => $distributor_login));
			foreach ($distributors as $distributor) {
				if($distributor->user_login != $distributor_login){
				 	$distributor_name = get_user_meta($distributor->ID, 'distributor_name', true);
					$dis_arr[$distributor->user_login] = array('id'=>$distributor->ID,'name'=>$distributor_name);
				}
			}
		}
		// pr($dis_arr);
		echo '<div class="table-responsive">';
		echo '<table id="billing_info_table" style="width:100%">';

		echo '<thead>';

		echo '<tr>';
		echo '<th>';
		echo 'Registration Number';
		echo '</th>';

		echo '<th>';
		echo 'Customer Name';
		echo '</th>';

		echo '<th>';
		echo 'VIN';
		echo '</th>';

		echo '<th>';
		echo 'Upgraded';
		echo '</th>';

		echo '<th>';
		echo 'Original Policy';
		echo '</th>';

		echo '<th>';
		echo 'Final Policy';
		echo '</th>';

		echo '<th>';
		echo 'Registered By';
		echo '</th>';

		echo '<th class="billing-date">';
		echo 'Date';
		echo '</th>';

		echo '<th>';
		echo 'Dealer Cost Original Policy';
		echo '</th>';

		echo '<th>';
		echo 'Dealer Cost Final Policy';
		echo '</th>';
		
		echo '<th>';
		echo 'Dealer Cost Price to Upgrade';
		echo '</th>';
		
		echo '<th>';
		echo 'Distributor Cost Original Policy';
		echo '</th>';
	
		echo '<th>';
		echo 'Distributor Cost Final Policy';
		echo '</th>';
	
		echo '<th>';
		echo 'Distributor Cost Price to Upgrade';
		echo '</th>';

		echo '</tr>';

		echo '</thead>';

		echo '<tbody>';

		global $wpdb;
		$sql = "SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info'";
		$query = $wpdb->get_results($sql);
		
		$dealer_original_policy_sum = 0;
		$dealer_final_policy_sum = 0;
		$dealer_price_to_upgrade_sum = 0;
		
		$distributor_original_policy_sum = 0;
		$distributor_final_policy_sum = 0;
		$distributor_price_to_upgrade_sum = 0;
		
		

		foreach ($dis_arr as $key => $value) {
			
			$distributor_id = $value['id'];
			 $dealer_users =  get_users(
				array(
					'meta_key' => 'dealer_distributor_name',
					'meta_value' => $distributor_id
				)
			);

			

			// pr($dealer_users);

			foreach ($dealer_users as $dealer) {
				
				$dealer_original_policy_sum = 0;
				
				$dealer_final_policy_sum = 0;
				$dealer_price_to_upgrade_sum = 0;

				$distributor_original_policy_sum = 0;
				$distributor_final_policy_sum = 0;
				$distributor_price_to_upgrade_sum = 0;
				

				$dealer_id = $dealer->ID;
				$dealer_login = $dealer->user_login;
				$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
				$dealer_arr = get_code_by_dealer_login($dealer_login);
				if(in_array($dealer_login,$input_dealers)){
					
					foreach ($query as $key_up => $value_up) {
						$user_id = $value_up->user_id;
						$nickname = get_user_meta($user_id, 'nickname', true);
						$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
						$registration_date = date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
						if (!$setStart)
							$billing_date1 = $registration_date;

						if (!$setExpire)
							$billing_date2 = $registration_date;
						if (($registration_date >= $billing_date1 && $registration_date <= $billing_date2)) {
							if (in_array($nickname, $dealer_arr)) {
								
							$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
							$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
							$original_policy = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
							$final_policy = get_post_meta($post_id, '_pmsafe_code_prefix', true);

							$dealer_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
							$dealer_cost_original_policy = $dealer_price_arr[$original_policy]['dealer_cost'];
							$dealer_cost_final_policy = $dealer_price_arr[$final_policy]['dealer_cost'];
							$dealer_cost_price_to_upgrade = $dealer_cost_original_policy - $dealer_cost_final_policy;

							$distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
							$distributor_cost_original_policy = $distributor_price_arr[$original_policy]['distributor_cost'];
							$distributor_cost_final_policy = $distributor_price_arr[$final_policy]['distributor_cost'];
							$distributor_cost_price_to_upgrade = $distributor_cost_original_policy - $distributor_cost_final_policy;
							
								
								$dealer_original_policy_sum += $dealer_cost_original_policy; 
								$dealer_final_policy_sum += $dealer_cost_final_policy; 
								$dealer_price_to_upgrade_sum += abs($dealer_cost_price_to_upgrade); 

								$distributor_original_policy_sum += $distributor_cost_original_policy; 
								$distributor_final_policy_sum += $distributor_cost_final_policy; 
								$distributor_price_to_upgrade_sum += abs($distributor_cost_price_to_upgrade); 
							}
						}
					}
				
					$dealer_original_policy_total_sum += $dealer_original_policy_sum;
				
					$dealer_final_policy_total_sum += $dealer_final_policy_sum;
					$dealer_price_to_upgrade_total_sum += $dealer_price_to_upgrade_sum;

					$distributor_original_policy_total_sum += $distributor_original_policy_sum; 
					$distributor_final_policy_total_sum += $distributor_final_policy_sum; 
					$distributor_price_to_upgrade_total_sum += $distributor_price_to_upgrade_sum; 
				}
			}
			
			echo '<tr style="background-color: #0065a7;font-weight: 700;color: #fff;">';
				// echo '<td>'.$value['name'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
				echo '<td>' . $value['name'] . '</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="text-center">$'.$dealer_original_policy_total_sum.'</td><td class="text-center">$'.$dealer_final_policy_total_sum.'</td><td class="text-center">$'.$dealer_price_to_upgrade_total_sum.'</td><td class="text-center">$'.$distributor_original_policy_total_sum.'</td><td class="text-center">$'.$distributor_final_policy_total_sum.'</td><td class="text-center">$'.$distributor_price_to_upgrade_total_sum.'</td>';
			echo '</tr>';
			$dealer_original_policy_total_sum = 0;
			$dealer_final_policy_total_sum = 0;
			$dealer_price_to_upgrade_total_sum = 0;
			$distributor_original_policy_total_sum = 0;
			$distributor_final_policy_total_sum = 0;
			$distributor_price_to_upgrade_total_sum = 0;

			foreach ($dealer_users as $dealer) {
				$dealer_original_policy_sum = 0;
				$dealer_final_policy_sum = 0;
				$dealer_price_to_upgrade_sum = 0;

				$distributor_original_policy_sum = 0;
				$distributor_final_policy_sum = 0;
				$distributor_price_to_upgrade_sum = 0;


				$dealer_id = $dealer->ID;
				$dealer_login = $dealer->user_login;
				$dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
				$dealer_arr = get_code_by_dealer_login($dealer_login);
				// $is_upgraded_count = 0;
				// $no_upgraded_count = 0;
				if(in_array($dealer_login,$input_dealers)){
					
					ob_start();
					foreach ($query as $key => $value) {
						$user_id = $value->user_id;
						$nickname = get_user_meta($user_id, 'nickname', true);
						$vehicle_info = get_user_meta($user_id, 'pmsafe_vehicle_info', false);
						$registration_date = date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
						
						if (!$setStart)
							$billing_date1 = $registration_date;

						if (!$setExpire)
							$billing_date2 = $registration_date;

						if (($registration_date >= $billing_date1 && $registration_date <= $billing_date2)) {
							// echo 'in';
							if (in_array($nickname, $dealer_arr)) {
							$fname = get_user_meta($user_id, 'first_name', true);
							$lname = get_user_meta($user_id, 'last_name', true);
							
							$post_id = $vehicle_info[0][$nickname]['pmsafe_member_code_id'];
							$invite_post_id[] = $post_id;
							$is_upgraded = get_post_meta($post_id,'is_upgraded',true);
							$original_policy = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
							$final_policy = get_post_meta($post_id, '_pmsafe_code_prefix', true);

							$registered_by = get_post_meta($post_id, 'registered_by', true);
							$get_users = get_user_by('login',$registered_by);
							$uid =  $get_users->ID;
							// $upgraded_id = get_post_meta($post_id, 'upgraded_by', true);
							$registered_by_dealer = get_user_meta($uid, 'dealer_name', true);
							$registered_by_distributor = get_user_meta($uid, 'distributor_name', true);
							$registered_by_dealer_contact = get_user_meta($uid, 'contact_fname', true);
							$registered_by_distributor_contact = get_user_meta($uid, 'distributor_contact_fname', true);
							$customer_fname = get_user_meta($uid, 'first_name', true);
							$customer_lname = get_user_meta($uid, 'last_name', true);
							$registered_by_customer = $customer_fname.' '.$customer_lname;
						
							
							$dealer_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
							$dealer_cost_original_policy = $dealer_price_arr[$original_policy]['dealer_cost'];
							$dealer_cost_final_policy = $dealer_price_arr[$final_policy]['dealer_cost'];
							$dealer_cost_price_to_upgrade = $dealer_cost_original_policy - $dealer_cost_final_policy;

							

							$distributor_price_arr = get_user_meta($distributor_id, 'pricing_package', true);
							$distributor_cost_original_policy = $distributor_price_arr[$original_policy]['distributor_cost'];
							$distributor_cost_final_policy = $distributor_price_arr[$final_policy]['distributor_cost'];
							$distributor_cost_price_to_upgrade = $distributor_cost_original_policy - $distributor_cost_final_policy;
							
							
								
							$dealer_original_policy_sum += $dealer_cost_original_policy; 
							$dealer_final_policy_sum += $dealer_cost_final_policy; 
							$dealer_price_to_upgrade_sum += abs($dealer_cost_price_to_upgrade); 

							$distributor_original_policy_sum += $distributor_cost_original_policy; 
							$distributor_final_policy_sum += $distributor_cost_final_policy; 
							$distributor_price_to_upgrade_sum += abs($distributor_cost_price_to_upgrade); 

							if($is_upgraded == 1){
								$is_upgraded_count++;
							}else{
								$no_upgraded_count++;
							}
								echo '<tr>';
									echo '<td>'.$nickname.'</td>';
									echo '<td>'.$fname.' '.$lname.'</td>';
									echo '<td>'.$vehicle_info[0][$nickname]['pmsafe_vin'].'</td>';
									echo '<td class="text-center">'.(($is_upgraded == 1)?'<span style="color:#008000;">Yes</span>':'<span style="color:#ff0000;">No</span>').'</td>';
									echo '<td class="text-center">'.$original_policy.'</td>';
									echo '<td class="text-center">'.$final_policy.'</td>';
									echo '<td>';
									
										if ($registered_by_dealer) {
											echo $registered_by_dealer;
										}
										if ($registered_by_distributor) {
											echo $registered_by_distributor;
										}
										if ($registered_by_dealer_contact) {
											echo $registered_by_dealer_contact;
										}
										if ($registered_by_distributor_contact) {
											echo $registered_by_distributor_contact;
										}
										if ($registered_by_customer) {
											echo $registered_by_customer;
										}
										if($registered_by == ''){
											echo $fname.' '.$lname;
										}
									echo '</td>';
									echo '<td>'.$registration_date.'</td>';;
									echo '<td class="text-center">$'.(($dealer_cost_original_policy)?$dealer_cost_original_policy:'0').'</td>';
									echo '<td class="text-center">$'.(($dealer_cost_final_policy)?$dealer_cost_final_policy:'0').'</td>';
									echo '<td class="text-center">$'.abs($dealer_cost_price_to_upgrade).'</td>';
									echo '<td class="text-center">$'.(($distributor_cost_original_policy)?$distributor_cost_original_policy:'0').'</td>';
									echo '<td class="text-center">$'.(($distributor_cost_final_policy)?$distributor_cost_final_policy:'0').'</td>';
									echo '<td class="text-center">$'.abs($distributor_cost_price_to_upgrade).'</td>';
								echo '</tr>';
							}
						}
					}

					$table_output = ob_get_clean();
					echo '<tr style="background-color: #008000;font-weight: 700;color: #fff;">';
						echo '<td>' . $dealer_name .'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td class="text-center">$'.$dealer_original_policy_sum.'</td><td class="text-center">$'.$dealer_final_policy_sum.'</td><td class="text-center">$'.$dealer_price_to_upgrade_sum.'</td><td class="text-center">$'.$distributor_original_policy_sum.'</td><td class="text-center">$'.$distributor_final_policy_sum.'</td><td class="text-center">$'.$distributor_price_to_upgrade_sum.'</td>';
					echo '</tr>';
					echo $table_output;
				}   
				$total_dealer_original_policy += $dealer_original_policy_sum;
				$total_dealer_final_policy += $dealer_final_policy_sum;
				$total_dealer_price_to_upgrade += $dealer_price_to_upgrade_sum;

				$total_distributor_original_policy += $distributor_original_policy_sum;
				$total_distributor_final_policy += $distributor_final_policy_sum;
				$total_distributor_price_to_upgrade += $distributor_price_to_upgrade_sum;
			 }
			}
			
		
 		echo '</tbody>';
		echo '</table>';
		echo '</div>';

		
		$benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
		foreach ($benefit_prefix as $prefix) {

			$original_prefix[] = $prefix;
		}

		// pr($original_prefix);

		$count = 0;
		foreach ($original_prefix  as $prefix1) { // PC3,BP1,BP2
			
			foreach ($original_prefix  as $prefix2) { //PC3,BP1,BP2
				
				if ($prefix1 != $prefix2) {
				
					$results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_prefix" and meta_value ="' . $prefix1 . '"');
					$post_id = array();
					foreach ($results as $key => $value) {
						if (in_array($value->post_id, $invite_post_id)) {
							$post_id[] = $value->post_id;
						}
					}
					
					
					if (!empty($post_id)) {
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

						if ($posts) {

							$prefix_arr[$prefix2] = array();
							$count_arr = array();
							foreach ($posts as $key => $value) {
								$pid = $value->ID;
								$code_status = get_post_meta($pid, '_pmsafe_code_status', true);
								if ($code_status == 'used') {
									$code = get_post_meta($pid, '_pmsafe_invitation_code', true);
									array_push($count_arr, $code);
								}
							}
							array_push($prefix_arr[$prefix2], count($count_arr));
						}
					}
				}
			}
		}

		echo '<div class="billing-summary-wrap">';
			echo '<h1>Summary Totals:</h1>';
			echo '<div class="summary-inner-wrap">';
			echo '<div class="summary-col">';
				echo '<h4>Total Policies Registered:</h4>';
				echo $is_upgraded_count + $no_upgraded_count;
				echo '<h5>Number of Upgraded Policies:</h5>'.(($is_upgraded_count)?$is_upgraded_count:'0');
				echo '<h5>Number of Non-Upgraded Policies:</h5>'.$no_upgraded_count;
			echo '</div>';
			echo '<div class="summary-col">';
				echo '<h4>Totals of Final Policies Registered per Benefits Package:</h4>';
				if($prefix_arr){
					foreach ($prefix_arr as $key => $value) {

						echo '<p>';
						echo $key . '=' . '<span>' . $value[0] . '</span>';
						echo '</p>';
					}
				}else{
						echo '-';
				}
			echo '</div>';
			
			echo '<div class="summary-col">';
				echo '<h4>Total of All Dealer Original Policies:</h4>$'.$total_dealer_original_policy;
			echo '</div>';
			
			echo '<div class="summary-col">';
				echo '<h4>Total of All Dealer Final Policies:</h4>$'.$total_dealer_final_policy;
			echo '</div>';

			echo '<div class="summary-col">';
				echo '<h4>Total of All Dealer Cost Price to Upgrade:</h4>$'.$total_dealer_price_to_upgrade;
			echo '</div>';

			echo '<div class="summary-col">';
				echo '<h4>Total of All Distributor Original Policies:</h4>$'.$total_distributor_original_policy;
			echo '</div>';

			echo '<div class="summary-col">';
				echo '<h4>Total of All Distributor Final Policies:</h4>$'.$total_distributor_final_policy;
			echo '</div>';

			echo '<div class="summary-col">';
				echo '<h4>Total of All Distributor Cost to Upgrade:</h4>$'.$total_distributor_price_to_upgrade;
			echo '</div>';
		echo '</div>';
		echo '</div>';
		die;
	}

	public function get_dealers_from_distributors(){
		$distributors_login = $_POST['distributor_login'];
		
		if(!empty($distributors_login)){
			foreach($distributors_login as $distributor_login){
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
				
					$dealer_name_arr[$username] = $dealer_name;
				}
				
			}
		}else{
			$args = array(
				'role'         => 'contributor',
			);
			$dealer_users = get_users($args);
			foreach ($dealer_users as $key => $value) {
				$dealer_name = get_user_meta($value->ID, 'dealer_name', true);
				$dealer_name_arr[$value->user_login] = $dealer_name;
			}
		}
	
		foreach ($dealer_name_arr as $key => $value) {
			echo '<option value="'.$key.'">'.$value.' ('. $key .')'.'</option>';
		}
		die;
	}

	public function active_inactive_code_function(){
		$post_id = $_POST['post_id'];
		$is_checked = $_POST['is_checked'];
		
		$post_type = $_POST['post_type']; 
		$invitation_ids = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
		$invitation_id = explode(',', $invitation_ids);
		if(!empty($post_type)){
			if($is_checked == 'true'){
				update_post_meta($post_id,'code_active_inactive',1);		
			}
			if($is_checked == 'false'){
				update_post_meta($post_id,'code_active_inactive',0);
			}
			$chk_post_type = $post_type;
		}else{
			// if($is_checked == 'true'){

			if($is_checked == 0){
				echo 'ischeck';
				update_post_meta($post_id,'code_active_inactive',0);
				foreach ($invitation_id as $id) {
					update_post_meta($id,'code_active_inactive',0);
				}
			
			}
			if($is_checked == 1){
				update_post_meta($post_id,'code_active_inactive',1);
				// foreach ($invitation_id as $id) {
				// 	update_post_meta($id,'code_active_inactive',1);		
				// }
				// $data = 'disabled';
			}
			if($is_checked == 2){
				update_post_meta($post_id,'code_active_inactive',2);
				foreach ($invitation_id as $id) {
					update_post_meta($id,'code_active_inactive',1);		
				}
			
			}
			// if($is_checked == 'false'){
			
			$chk_post_type = 'bulk';
		}
		
		die;
	}
}
