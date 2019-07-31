<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://permasafe.net/
 * @since      1.0.0
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/includes
 * @author     permasafe <contact@permasafe.net>
 */
class Permasafe_User_Pro
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Permasafe_User_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('PLUGIN_NAME_VERSION')) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'permasafe-user-pro';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Permasafe_User_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Permasafe_User_Pro_i18n. Defines internationalization functionality.
	 * - Permasafe_User_Pro_Admin. Defines all hooks for the admin area.
	 * - Permasafe_User_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-permasafe-user-pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-permasafe-user-pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-permasafe-user-pro-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-permasafe-user-pro-public.php';

		$this->loader = new Permasafe_User_Pro_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Permasafe_User_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Permasafe_User_Pro_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Permasafe_User_Pro_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
		$this->loader->add_action('admin_menu', $plugin_admin, 'add_menu_page');
		$this->loader->add_action('admin_init', $plugin_admin, 'pmsafe_register_setting');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin,  'enque_admin_user_js');
		//add distributor
		$this->loader->add_action('wp_ajax_pmsafe_register_distributor_form', $plugin_admin, 'pmsafe_register_distributor_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_register_distributor_form', $plugin_admin, 'pmsafe_register_distributor_form_function');
		//edit distributor
		$this->loader->add_action('wp_ajax_pmsafe_edit_distributor_form', $plugin_admin, 'pmsafe_edit_distributor_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_edit_distributor_form', $plugin_admin, 'pmsafe_edit_distributor_form_function');
		//delete distributor
		$this->loader->add_action('wp_ajax_pmsafe_delete_distributor_form', $plugin_admin, 'pmsafe_delete_distributor_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_delete_distributor_form', $plugin_admin, 'pmsafe_delete_distributor_form_function');

		//delete distributor contacts
		$this->loader->add_action('wp_ajax_pmsafe_delete_distributor_contact_form', $plugin_admin, 'pmsafe_delete_distributor_contact_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_delete_distributor_contact_form', $plugin_admin, 'pmsafe_delete_distributor_contact_form_function');

		//add distributor contact information
		$this->loader->add_action('wp_ajax_add_distributor_contact_information', $plugin_admin, 'add_distributor_contact_information');
		$this->loader->add_action('wp_ajax_nopriv_add_distributor_contact_information', $plugin_admin, 'add_distributor_contact_information');

		//add dealer
		$this->loader->add_action('wp_ajax_pmsafe_register_dealer_form', $plugin_admin, 'pmsafe_register_dealer_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_register_dealer_form', $plugin_admin, 'pmsafe_register_dealer_form_function');
		//add dealer contact information
		$this->loader->add_action('wp_ajax_add_dealer_contact_information', $plugin_admin, 'add_dealer_contact_information');
		$this->loader->add_action('wp_ajax_nopriv_add_dealer_contact_information', $plugin_admin, 'add_dealer_contact_information');
		//edit dealer
		$this->loader->add_action('wp_ajax_pmsafe_edit_dealer_form', $plugin_admin, 'pmsafe_edit_dealer_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_edit_dealer_form', $plugin_admin, 'pmsafe_edit_dealer_form_function');
		//edit customer
		$this->loader->add_action('wp_ajax_pmsafe_edit_customer_form', $plugin_admin, 'pmsafe_edit_customer_form_function');
		$this->loader->add_action('wp_ajax_pmsafe_edit_customer_form', $plugin_admin, 'pmsafe_edit_customer_form_function');

		//delete dealer
		$this->loader->add_action('wp_ajax_pmsafe_delete_dealer_form', $plugin_admin, 'pmsafe_delete_dealer_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_delete_dealer_form', $plugin_admin, 'pmsafe_delete_dealer_form_function');

		//delete dealer contacts
		$this->loader->add_action('wp_ajax_pmsafe_delete_dealer_contact_form', $plugin_admin, 'pmsafe_delete_dealer_contact_form_function');
		$this->loader->add_action('wp_ajax_nopriv_pmsafe_delete_dealer_contact_form', $plugin_admin, 'pmsafe_delete_dealer_contact_form_function');

		//delete dealer customer
		$this->loader->add_action('wp_ajax_pmsafe_delete_customer_form', $plugin_admin, 'pmsafe_delete_customer_form_function');
		$this->loader->add_action('wp_ajax_pmsafe_delete_customer_form', $plugin_admin, 'pmsafe_delete_customer_form_function');

		//delete customers
		$this->loader->add_action('wp_ajax_pmsafe_delete_customers_form', $plugin_admin, 'pmsafe_delete_customers_form_function');
		$this->loader->add_action('wp_ajax_pmsafe_delete_customers_form', $plugin_admin, 'pmsafe_delete_customers_form_function');


		//customer csv data
		$this->loader->add_action('wp_ajax_get_customer_csv_data', $plugin_admin, 'get_customer_csv_data');
		$this->loader->add_action('wp_ajax_nopriv_get_customer_csv_data', $plugin_admin, 'get_customer_csv_data');

		// reset code
		$this->loader->add_action('wp_ajax_reset_code', $plugin_admin, 'reset_code_function');
		$this->loader->add_action('wp_ajax_nopriv_reset_code', $plugin_admin, 'reset_code_function');

		$this->loader->add_action('wp_ajax_search_batch_code', $plugin_admin, 'search_batch_code_function');
		$this->loader->add_action('wp_ajax_nopriv_search_batch_code', $plugin_admin, 'search_batch_code_function');

		$this->loader->add_action('wp_ajax_search_individual_code', $plugin_admin, 'search_individual_code_function');
		$this->loader->add_action('wp_ajax_nopriv_search_individual_code', $plugin_admin, 'search_individual_code_function');

		$this->loader->add_action('admin_footer', $plugin_admin, 'perma_admin_footer_load_html');
		$this->loader->add_action('admin_footer', $plugin_admin, 'add_search_box');

		//reports
		$this->loader->add_action('wp_ajax_admin_reports', $plugin_admin, 'admin_reports');
		$this->loader->add_action('wp_ajax_nopriv_admin_reports', $plugin_admin, 'admin_reports');

		//all customers reports
		$this->loader->add_action('wp_ajax_admin_all_reports', $plugin_admin, 'admin_all_reports');
		$this->loader->add_action('wp_ajax_nopriv_admin_all_reports', $plugin_admin, 'admin_all_reports');

		$this->loader->add_action('wp_ajax_admin_view_data_reports', $plugin_admin, 'admin_view_data_reports');
		$this->loader->add_action('wp_ajax_nopriv_admin_view_data_reports', $plugin_admin, 'admin_view_data_reports');

		// quick filters
		$this->loader->add_action('wp_ajax_admin_quick_filters', $plugin_admin, 'admin_quick_filters');
		$this->loader->add_action('wp_ajax_nopriv_admin_quick_filters', $plugin_admin, 'admin_quick_filters');

		$this->loader->add_action('wp_ajax_admin_membership_date_filter', $plugin_admin, 'admin_membership_date_filter');
		$this->loader->add_action('wp_ajax_nopriv_admin_membership_date_filter', $plugin_admin, 'admin_membership_date_filter');

		$this->loader->add_action('wp_ajax_add_dealer_benefits_package_price', $plugin_admin, 'add_dealer_benefits_package_price_function');
		$this->loader->add_action('wp_ajax_nopriv_add_dealer_benefits_package_price', $plugin_admin, 'add_dealer_benefits_package_price_function');

		$this->loader->add_action('wp_ajax_add_distributor_cost', $plugin_admin, 'add_distributor_cost_function');
		$this->loader->add_action('wp_ajax_nopriv_add_distributor_cost', $plugin_admin, 'add_distributor_cost_function');

		$this->loader->add_action('wp_ajax_delete_dealer_benefits_package_price', $plugin_admin, 'delete_dealer_benefits_package_price_function');
		$this->loader->add_action('wp_ajax_nopriv_delete_dealer_benefits_package_price', $plugin_admin, 'delete_dealer_benefits_package_price_function');

		$this->loader->add_action('wp_ajax_edit_dealer_benefits_package_price', $plugin_admin, 'edit_dealer_benefits_package_price_function');
		$this->loader->add_action('wp_ajax_nopriv_edit_dealer_benefits_package_price', $plugin_admin, 'edit_dealer_benefits_package_price_function');

		$this->loader->add_action('wp_ajax_edit_distributor_cost_package', $plugin_admin, 'edit_distributor_cost_function');
		$this->loader->add_action('wp_ajax_nopriv_edit_distributor_cost_package', $plugin_admin, 'edit_distributor_cost_function');

		$this->loader->add_action('wp_ajax_delete_distributor_cost', $plugin_admin, 'delete_distributor_cost_function');
		$this->loader->add_action('wp_ajax_nopriv_delete_distributor_cost', $plugin_admin, 'delete_distributor_cost_function');

		$this->loader->add_action('wp_ajax_fetch_dealer_package_price', $plugin_admin, 'fetch_dealer_package_price');
		$this->loader->add_action('wp_ajax_nopriv_fetch_dealer_package_price', $plugin_admin, 'fetch_dealer_package_price');

		// check if email is exist or not.
		$this->loader->add_action('wp_ajax_check_email_exist', $plugin_admin, 'check_email_exist');
		$this->loader->add_action('wp_ajax_nopriv_check_email_exist', $plugin_admin, 'check_email_exist');

		$this->loader->add_action('wp_ajax_fetch_dealer_contact_info', $plugin_admin, 'fetch_dealer_contact_info');
		$this->loader->add_action('wp_ajax_nopriv_fetch_dealer_contact_info', $plugin_admin, 'fetch_dealer_contact_info');

		$this->loader->add_action('wp_ajax_fetch_distributor_contact_info', $plugin_admin, 'fetch_distributor_contact_info');
		$this->loader->add_action('wp_ajax_nopriv_fetch_distributor_contact_info', $plugin_admin, 'fetch_distributor_contact_info');

		$this->loader->add_action('wp_ajax_edit_dealer_contact_information', $plugin_admin, 'edit_dealer_contact_information');
		$this->loader->add_action('wp_ajax_nopriv_edit_dealer_contact_information', $plugin_admin, 'edit_dealer_contact_information');

		$this->loader->add_action('wp_ajax_edit_distributor_contact_information', $plugin_admin, 'edit_distributor_contact_information');
		$this->loader->add_action('wp_ajax_nopriv_edit_distributor_contact_information', $plugin_admin, 'edit_distributor_contact_information');

		$this->loader->add_action('wp_ajax_send_reset_mail', $plugin_admin, 'send_reset_mail');
		$this->loader->add_action('wp_ajax_nopriv_send_reset_mail', $plugin_admin, 'send_reset_mail');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Permasafe_User_Pro_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Permasafe_User_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
