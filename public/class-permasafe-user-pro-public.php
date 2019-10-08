<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://permasafe.net/
 * @since      1.0.0
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/public
 * @author     permasafe <contact@permasafe.net>
 */
class Permasafe_User_Pro_Public
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
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('wp_footer', array($this, 'perma_wp_footer_load_html'));
        add_shortcode('perma_register', array($this, 'perma_register_function'));

        add_action('wp_ajax_pmsafe_registration_code_form', array($this, 'pmsafe_registration_code_form_function'));
        add_action('wp_ajax_nopriv_pmsafe_registration_code_form', array($this, 'pmsafe_registration_code_form_function'));

        add_action('wp_ajax_update_benefit_package', array($this, 'update_benefit_package'));
        add_action('wp_ajax_nopriv_update_benefit_package', array($this, 'update_benefit_package'));

        add_action('wp_ajax_get_benefit_package_price', array($this, 'get_benefit_package_price'));
        add_action('wp_ajax_nopriv_get_benefit_package_price', array($this, 'get_benefit_package_price'));

        add_action('wp_ajax_check_no_coverage_policy', array($this, 'check_no_coverage_policy'));
        add_action('wp_ajax_nopriv_check_no_coverage_policy', array($this, 'check_no_coverage_policy'));

        add_action('wp_ajax_update_benefit_package_price', array($this, 'update_benefit_package_price'));
        add_action('wp_ajax_nopriv_update_benefit_package_price', array($this, 'update_benefit_package_price'));

        add_action('wp_ajax_pmsafe_registration_form', array($this, 'pmsafe_registration_form_function'));
        add_action('wp_ajax_nopriv_pmsafe_registration_form', array($this, 'pmsafe_registration_form_function'));

        add_shortcode('perma_registered_user', array($this, 'perma_registered_user_function'));
        add_action('wp_ajax_pmsafe_registered_user_form', array($this, 'pmsafe_registered_user_form_function'));
        add_action('wp_ajax_nopriv_pmsafe_registered_user_form', array($this, 'pmsafe_registered_user_form_function'));

        add_shortcode('perma_salesperson', array($this, 'perma_salesperson_function'));
        add_action('wp_ajax_perma_salesperson_form', array($this, 'perma_salesperson_form_function'));
        add_action('wp_ajax_nopriv_perma_salesperson_form', array($this, 'perma_salesperson_form_function'));

        add_shortcode('perma_warranty', array($this, 'perma_warranty_function'));

        add_shortcode('perma_warranty_cardview', array($this, 'perma_warranty_cardview_function'));

        add_shortcode('user_info', array($this, 'user_info_function'));

        // add_filter('login_redirect', array($this,'pmsafe_login_redirect'), 10, 3);

        add_filter('wp_nav_menu_args', array($this, 'my_wp_nav_menu_args'));

        add_shortcode('perma_change_password', array($this, 'perma_reset_password_form'));
        add_action('init', array($this, 'perma_reset_password'));

        add_filter('login_redirect', array($this, 'my_login_redirect'), 10, 3);

        add_action('wp_ajax_pmsafe_user_info_form', array($this, 'pmsafe_user_info_form_function'));
        add_action('wp_ajax_nopriv_pmsafe_user_info_form', array($this, 'pmsafe_user_info_form_function'));

        add_action('wp_ajax_perma_dealer_distributor_info_form', array($this, 'perma_dealer_distributor_info_form_function'));
        add_action('wp_ajax_nopriv_perma_dealer_distributor_info_form', array($this, 'perma_dealer_distributor_info_form_function'));

        add_action('wp_ajax_perma_contact_user_info_form', array($this, 'perma_contact_user_info_form_function'));
        add_action('wp_ajax_nopriv_perma_contact_user_info_form', array($this, 'perma_contact_user_info_form_function'));

        add_action('wp_ajax_send_reset_mail', array($this, 'send_reset_mail_function'));
        add_action('wp_ajax_nopriv_send_reset_mail', array($this, 'send_reset_mail_function'));

        //dealer
        add_shortcode('view_registered_user', array($this, 'view_registered_user_function'));
        add_shortcode('view_available_membercodes', array($this, 'view_available_membercodes_function'));

        add_shortcode('perma_user_name', array($this, 'perma_user_name_function'));
        add_shortcode('dealer_total_information', array($this, 'dealer_total_information_function'));

        add_shortcode('distributor_total_information', array($this, 'distributor_total_information_function'));

        //distributor
        add_shortcode('view_reg_user_dist', array($this, 'view_reg_user_dist_function'));

        //login page
        add_filter('gettext', array($this, 'register_text'));
        add_filter('ngettext', array($this, 'register_text'));

        add_shortcode('total_range_codes', array($this, 'total_range_codes'));
        add_shortcode('perma_waranty_pdf', array($this, 'perma_waranty_pdf_function'));

        //reports
        add_shortcode('reports', array($this, 'reports_function'));

        add_action('wp_ajax_dealer_distributor_reports', array($this, 'dealer_distributor_reports'));
        add_action('wp_ajax_nopriv_dealer_distributor_reports', array($this, 'dealer_distributor_reports'));

        add_action('wp_ajax_dealer_distributor_view_data_reports', array($this, 'dealer_distributor_view_data_reports'));
        add_action('wp_ajax_nopriv_dealer_distributor_view_data_reports', array($this, 'dealer_distributor_view_data_reports'));


        //quick filters
        add_shortcode('quick_filters', array($this, 'quick_filters_function'));
        add_action('wp_ajax_dealer_distributor_quick_filters', array($this, 'dealer_distributor_quick_filters'));
        add_action('wp_ajax_nopriv_dealer_distributor_quick_filters', array($this, 'dealer_distributor_quick_filters'));

        add_shortcode('profile_name', array($this, 'give_profile_name'));
        add_filter('wp_nav_menu_objects', array($this, 'my_dynamic_menu_items'));
        add_action('after_setup_theme', array($this, 'remove_admin_bar'));

        add_shortcode('upgradable_membership_info', array($this, 'upgradable_membership_info_function'));

        add_action('wp_ajax_membership_date_filter', array($this, 'membership_date_filter'));
        add_action('wp_ajax_nopriv_membership_date_filter', array($this, 'membership_date_filter'));

        add_filter('wp_mail_from_name', array($this, 'my_mail_from_name'));

        add_filter('retrieve_password_title', array($this, 'change_reset_password_subject'));
        add_filter('retrieve_password_message', array($this, 'replace_retrieve_password_message'), 10, 4);
        add_filter('wp_mail_content_type', array($this, 'wp_set_html_mail_content_type'));

        add_filter('password_change_email', array($this, 'change_password_mail_message'), 10, 3);

        add_action('wp_ajax_fetch_dealer_contact_information', array($this, 'fetch_dealer_contact_information'));
        add_action('wp_ajax_nopriv_fetch_dealer_contact_information', array($this, 'fetch_dealer_contact_information'));

        add_action('wp_ajax_edit_dealer_contact_info', array($this, 'edit_dealer_contact_info_function'));
        add_action('wp_ajax_nopriv_edit_dealer_contact_info', array($this, 'edit_dealer_contact_info_function'));

        add_action('wp_ajax_add_login_session', array($this, 'add_login_session'));
        add_action('wp_ajax_nopriv_add_login_session', array($this, 'add_login_session'));

        add_filter('email_change_email', array($this, 'change_email_mail_message'), 10, 3);

        add_action('wp_footer', array($this, 'contact_user_popup_function'));
    }


    /* Filter Email Change Email Text */

    public function change_email_mail_message($email_change, $user, $userdata)
    {

        $new_message_txt = __('ABCD Change the text here, use ###USERNAME###, ###ADMIN_EMAIL###, ###EMAIL###, ###SITENAME###, ###SITEURL### tags.');

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
        $message .= __('This notice confirms that your email was changed on PermaSafe of <b>Username: </b> ###USERNAME###');
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'If you did not change your password, please contact the Site Administrator at <a href="mailto:info@permasafe.com">info@permasafe.com</a>';
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= __('This email has been sent to ###EMAIL###');
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'Regards,<br/>All at ';
        $message .= '<a href="' . get_site_url() . '">';
        $message .= 'PermaSafe';
        $message .= '</a>';
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</div>';

        $email_change['message'] = $message;
        $email_change['subject'] = 'Notice of Email Change';

        return $email_change;
    }


    // add the filter

    /**
     *  @return string
     * This function is used to change from name in all sending mail.
     */

    public function my_mail_from_name($name)
    {
        return "Permasafe";
    }

    /**
     *  @return string
     * This function is used to change subject of reset password mail.
     */
    public function change_reset_password_subject()
    {
        return 'Password Reset';
    }

    /**
     *  @return string
     * This function is used to replace content of reset password mail.
     */
    public function replace_retrieve_password_message($message, $key, $user_login, $user_data)
    {

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
        $message .= '<a href="' . site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . '" class="btn-primary" itemprop="url" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #0065a7; margin: 0; border-color: #0065a7; border-style: solid; border-width: 10px 20px;">';
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

        return $message;
    }

    /**
     *  @return string
     * This function is used to set content type of all mails.
     */
    public function wp_set_html_mail_content_type()
    {
        return 'text/html';
    }

    /**
     *  @return string
     *  This function is used to replace content of change password mail.
     */

    public function change_password_mail_message($pass_change_mail, $user, $userdata)
    {
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
        $message .= __('This notice confirms that your password was changed on PermaSafe of <b>Username: </b> ###USERNAME###');
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'If you did not change your password, please contact the Site Administrator at <a href="mailto:info@permasafe.com">info@permasafe.com</a>';
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= __('This email has been sent to ###EMAIL###');
        $message .= '</td>';
        $message .= '</tr>';

        $message .= '<tr style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">';
        $message .= '<td class="content-block" style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">';
        $message .= 'Regards,<br/>All at ';
        $message .= '<a href="' . get_site_url() . '">';
        $message .= 'PermaSafe';
        $message .= '</a>';
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</div>';

        $pass_change_mail['message'] = $message;
        $pass_change_mail['subject'] = 'Notice of Password Change';
        return $pass_change_mail;
    }


    /**
     *  @return string
     *  This function is used to remove admin bar for all users except administrator.
     */

    public function remove_admin_bar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }


    public function give_profile_name($atts)
    {
        $user = wp_get_current_user();
        $name = 'user test';
        return $name;
    }

    /**
     *  @return string
     *  This function is used to display customer user name on their account after login.
     */
    public function my_dynamic_menu_items($menu_items)
    {
        foreach ($menu_items as $menu_item) {
            if ('#profile_name#' == $menu_item->title) {
                global $shortcode_tags;
                if (isset($shortcode_tags['profile_name'])) {
                    // Or do_shortcode(), if you must.
                    $user_id = get_current_user_id();
                    $fname = get_user_meta($user_id, 'first_name', true);
                    $lname = get_user_meta($user_id, 'last_name', true);
                    $menu_item->title = str_replace("#profile_name#",  $fname . ' ' . $lname, $menu_item->title);
                }
            }
        }

        return $menu_items;
    }



    /**
     * change label on login page.
     *
     *
     * Adjusted this to be conditional based on URL parameters.
     * This lets use create links for Dealer Login and Distributor Login
     * Commented out the original below
     * - Curtis
     *
     */


    public function register_text($translating)
    {
        $para_log = $_GET['param'];
        $s14 = 's14';
        $p32 = 'p32';
        $r56 = 'r56';
        if ($para_log == $s14) {
            $translated = str_ireplace('Username or Email Address',  'Dealer Number',  $translating);
            return $translated;
        } elseif ($para_log == $p32) {
            $translated = str_ireplace('Username or Email Address',  'Distributor Number',  $translating);
            return $translated;
        } elseif ($para_log == $r56) {
            $translated = str_ireplace('Username or Email Address',  'Username',  $translating);
            return $translated;
        } else {
            $translated = str_ireplace('Username or Email Address',  'Warrranty Registration Number',  $translating);
            return $translated;
        }
    }


    /**
     * change menu after login.
     *
     */
    public function my_wp_nav_menu_args($args = '')
    {

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;

            if ($role['subscriber'] == 1 || $role['administrator'] == 1) {
                $args['menu'] = 'logged-in';
            } else if ($role['contributor'] == 1) {
                $args['menu'] = 'dealer-menu';
            } else if ($role['author'] == 1) {
                $args['menu'] = 'distributor-menu';
            } else if ($role['dealer-user'] == 1) {
                $args['menu'] = 'dealer-menu';
            } else if ($role['distributor-user'] == 1) {
                $args['menu'] = 'distributor-menu';
            }
        } else {
            $args['menu'] = 'Top Menu';
        }
        return $args;
    }

    /**
     * check user role after login.
     * Based on role it will return URL for redirect.
     *
     */
    function my_login_redirect($url, $request, $user)
    {

        if ($user && is_object($user) && is_a($user, 'WP_User')) {

            if ($user->has_cap('administrator') or $user->has_cap('editor')) {
                $url = admin_url();
            } elseif ($user->has_cap('subscriber')) {

                $url = get_site_url() . '/perma-warranty/';
            } elseif ($user->has_cap('contributor')) {
                $url = get_site_url() . '/dealer-account/';
            } elseif ($user->has_cap('author')) {
                $url = get_site_url() . '/distributor-account/';
            } elseif ($user->has_cap('dealer-user')) {
                $url = get_site_url() . '/dealer-account/';
            } elseif ($user->has_cap('distributor-user')) {
                $url = get_site_url() . '/distributor-account/';
            }
        }
        return $url;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
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


        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/permasafe-user-pro-public.css', array(), time(), 'all');
        wp_enqueue_style('pmsafe_ui_css', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), time(), 'all');
        wp_enqueue_style('pmsafe_dt_css', plugin_dir_url(__FILE__) . 'css/dataTables.jqueryui.min.css', array(), time(), 'all');
        wp_enqueue_style('pmsafe_dt_fixedHeader', plugin_dir_url(__FILE__) . 'css/fixedHeader.dataTables.min.css', array(), time(), 'all');
        wp_enqueue_style('jquery-modal', plugin_dir_url(__FILE__) . 'css/jquery.modal.min.css', array(), time(), 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
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

        wp_enqueue_script('pagination_js', plugin_dir_url(__FILE__) . 'js/jquery.easyPaginate.js', array('jquery'), time(), false);
        wp_enqueue_script('content_pagination_js', plugin_dir_url(__FILE__) . 'js/jquery.paginate.js', array('jquery'), time(), false);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/permasafe-user-pro-public.js', array('jquery'), time(), false);
        // wp_enqueue_script( 'csv_file_js', plugin_dir_url( __FILE__ ) . 'js/table2csv.js', array( 'jquery' ), time(), false );
        wp_enqueue_script('jquery_ui_js', plugin_dir_url(__FILE__) . 'js/jquery-ui.js', array('jquery'), time(), false);
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
        wp_enqueue_script('jquery-modal',  plugin_dir_url(__FILE__) . 'js/jquery.modal.min.js', array('jquery'), time(), false);
        wp_enqueue_script('sweet_alert', plugin_dir_url(__FILE__) . 'js/sweetalert.min.js', array('jquery'), time(), false);
        wp_localize_script($this->plugin_name, 'pmAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

    /**
     * Create Jquery ajax loader.
     *
     */

    public function  perma_wp_footer_load_html()
    {
        echo '<div class="perma-loader" style="display:none">';
        echo '<div class="perma-load-image"><img src="' . plugin_dir_url(__FILE__) . '/images/loader-1.gif" alt=""></div>';
        echo '<div class="perma-black-overlay"></div>';
        echo '</div>';
    }

    /**
     * view_available_membercodes shortcode
     * Display available member codes on dealer account page.
     *
     */
    public function view_available_membercodes_function()
    {
        $current_user = wp_get_current_user();
        $role = (array) $current_user->caps;
        if ($role['contributor'] == 1) {
            $dealer_username = $current_user->user_login;
            $args = array(
                'post_type' => 'pmsafe_bulk_invi',
                'post_status' => 'publish',
                'posts_per_page'   => -1,
                'meta_query' => array(
                    array(
                        'key'     => '_pmsafe_dealer',
                        'value'   => $dealer_username,
                        'compare' => '=',
                    ),
                ),
            );

            $posts = get_posts($args);

            $post_id = $posts[0]->ID;
            $code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
            $invitation_id = get_post_meta($post_id, '_pmsafe_invitation_ids', true);
            $invitation_id = explode(',', $invitation_id);
            $data = pmsafe_unused_code_count($post_id);
            $available = $data['total'] - $data['used'];

            $html = '';
            $html .= '<div id="perma-warranty-wrapper">';
            $html .= '<p><strong>Total codes: </strong>' . $data['total'] . '</p>';
            $html .= '<p><strong>Available codes: </strong>' . $available . '</p>';

            $html .= '<table id="codetable">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>';
            $html .= 'List Of Available Codes';
            $html .= '</th>';
            $html .= '</tr>';
            $html .= '</thead>';

            $html .= '<tbody>';
            foreach ($invitation_id as $id) {
                $code_status = get_post_meta($id, '_pmsafe_code_status', true);
                if ($code_status == 'available') {
                    $code = get_post_meta($id, '_pmsafe_invitation_code', true);

                    $html .= '<tr>';
                    $html .= '<td>';
                    $html .= $code;
                    $html .= '</td>';

                    $html .= '</tr>';
                }
            }

            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
            return $html;
        }
    }



    /**
     * view_registered_user shortcode
     * This function is used to display all registered customers of logged-in  dealer.
     */
    public function view_registered_user_function($atts)
    {

        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();

            $dealer_id = get_current_user_id();
            $role = (array) $current_user->caps;
            $success = $_GET['success'];
            $code = $_GET['code'];

            $a = extract(shortcode_atts(array(
                'dealer' => $dealer,
            ), $atts));

            $users = get_user_by('login', $dealer);
            $dealer_role = $users->roles;
            // echo 'role->'.$role[0];
            // pr($role);
            if ($dealer_role[0] == 'contributor' || $role['contributor'] == 1 || $role['dealer-user'] == 1) {

                if ($role['dealer-user'] == 1) {
                    $dealer_user_login = $current_user->user_login;
                    $user = get_user_by('login', $dealer_user_login);
                    $contact_id = $user->ID;
                    $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                    $dealer_user = get_user_by('id', $dealer_id);
                    $dealer_username = $dealer_user->user_login;
                } else if ($dealer_role[0] == 'contributor') {
                    $dealer_username = $dealer;
                } else {
                    $dealer_username = $current_user->user_login;
                }


                $html = '';
                if ($success == "true") {
                    $code_id = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $code);
                    $pdf_link = get_post_meta($code_id, 'pmsafe_pdf_link', true);

                    ?>
<div class='message'>
    <div class='check'>
        &#10003;
    </div>
    <p>
        Success
    </p>
    <p>
        <?php echo 'Registration of Code <span style="color:#357aba">' . $code . '</span> was Successful.' ?>
    </p>
    <p>
        <a href="<?php echo $pdf_link; ?>" target="_blank" id="view-pdf">View PDF</a>
        <iframe src="<?php echo $pdf_link; ?>" id="myFrame" frameborder="0" style="border:0;display:none;" width="300" height="300"></iframe>
        <input type="button" id="print-pdf" onclick="print()" value="Print PDF" />
        <script>
            function print() {
                var objFra = document.getElementById('myFrame');
                objFra.contentWindow.focus();
                objFra.contentWindow.print();
            }
        </script>
    </p>
    <a href="<?php echo get_site_url(); ?>/dealer-account/" id='ok'>
        OK
    </a>
</div>
<?php
                }
                $customer_arr = get_user_by_dealer($dealer_username);


                $html .= '<div id="perma-warranty-wrapper">';
                if ($customer_arr) {
                    $html .= '<div class="filter-wrapper" style="right: 55%;">';


                    $html .= '<select id="customertable-select">';
                    $html .= '<option>Member Code</option>';
                    $html .= '</select>';



                    $html .= '</div>';

                    $html .= '<div class="search-result-wrap">';

                    $html .= '<div class="tbl-result-wrap">';
                    $html .= '<table id="customertable" class="display nowrap" style="width:100%">';
                    $html .= '<thead>';
                    $html .= '<tr>';
                    $html .= '<th>';
                    $html .= 'Member Code';
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
                    $html .= 'Email';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'Phone<br/> Number';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'Vehicle<br/> Information';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'VIN';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'Plan<br/> ID';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'Registration<br/> Date';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'Expiration<br/> Date';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'View Benefits Page';
                    $html .= '</th>';

                    $html .= '<th class="nisl-pdf-link">';
                    $html .= 'date time';
                    $html .= '</th>';


                    $html .= '</tr>';
                    $html .= '</thead>';

                    $html .= '<tbody id="">';
                    foreach ($customer_arr as $key => $value) {

                        $html .= '<tr>';
                        $html .= '<td>';
                        $html .= '<a href="" class="view-data" data-id="' . $value['user_id'] . '">' . $value['code'] . '</a>';
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= '<a href="" class="view-data" data-id="' . $value['user_id'] . '">' . $value['fname'] . '</a>';
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= '<a href="" class="view-data" data-id="' . $value['user_id'] . '">' . $value['lname'] . '</a>';
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= '<a href="" class="view-data" data-id="' . $value['user_id'] . '">' . $value['address'] . '</a>';
                        $html .= '</td>';
                        $url = get_site_url() . '/wp-includes/images/media/document.png';
                        $html .= '<td>';
                        $html .= '<a href="' . get_site_url() . '/perma-warranty-pdf/?id=' . $value['code_id'] . '&dealer=' . $value['dealer_id'] . '" target="_blank"><img src="' . $url . '" class="attachment-thumbnail" style="width:20px !important"></a>';
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['email'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= phone_number_format($value['phone']);
                        $html .= '</td>';


                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['vehicle_information'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['vin'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['package'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['registration_date'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['expiration_date'];
                        $html .= '</td>';


                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['pdf_link'];
                        $html .= '</td>';

                        $html .= '<td class="nisl-pdf-link">';
                        $html .= $value['date_time'];
                        $html .= '</td>';

                        $html .= '</tr>';
                    }
                    $html .= '</tbody>';
                    $html .= '</table>';

                    // pr($bulk_arr);
                    $html .= '</div>';

                    $html .= '<div class="data-result-wrap">';

                    $html .= '</div>';
                    $html .= '</div>';

                    $html .= '</div>';
                } else {
                    $html .= 'No customer is registered.';
                }
                return $html;
            } else {
                $location = get_site_url() . "/perma-register/";
                wp_redirect($location, 301);
                exit;
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
    }

    /**
     * view_reg_user_dist shortcode
     *
     * This function is used to display Batch codes, registered customers, upgraded membership of logged in distributor.
     *
     */
    public function view_reg_user_dist_function()
    {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();

            $role = (array) $current_user->caps;

            if ($role['author'] == 1 || $role['distributor-user'] == 1) {
                $dealer_login = $_GET['dealer'];
                $dealer_user = get_user_by('login', $dealer_login);
                $dealer_id = $dealer_user->data->ID;
                $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                if ($role['distributor-user'] == 1) {
                    $distributor_user_login = $current_user->user_login;
                    $user = get_user_by('login', $distributor_user_login);
                    $contact_id = $user->ID;
                    $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                    $distributor_user = get_user_by('id', $distributor_id);
                    $distributor_username = $distributor_user->user_login;
                } else {
                    $distributor_username = $current_user->user_login;
                    $user = get_user_by('login', $distributor_username);
                    $distributor_id = $user->ID;
                }

                $dealers =  get_users(
                    array(
                        'meta_key' => 'dealer_distributor_name',
                        'meta_value' => $distributor_id
                    )
                );
                foreach ($dealers as $key => $value) {
                    $dealer_logins[] = $value->user_login;
                }
                if ($_GET['action'] == 'view_codes') {

                    if (in_array($dealer_login, $dealer_logins)) {

                        $args = array(
                            'post_type' => 'pmsafe_bulk_invi',
                            'post_status' => 'publish',
                            'posts_per_page'   => -1,
                            'meta_query' => array(
                                array(
                                    'key'     => '_pmsafe_dealer',
                                    'value'   => $dealer_login,
                                    'compare' => '='
                                ),

                            ),
                        );
                        // pr($args);
                        $posts = get_posts($args);

                        $html = '';
                        $html .= '<div id="perma-warranty-wrapper">';

                        $back_link = get_site_url() . '/distributor-account/';
                        $html .= '<h2>' . $dealer_name . '\'s Product Codes List</h2>';
                        $html .= '<a href="' . $back_link . '" class="back_link"><input type="button" title="Back to Dealer List" value="Back to Dealer List" style="float:left;margin: 10px 5px;"/></a>';
                        $html .= do_shortcode('[total_range_codes]');

                        $html .= '<h3 style="color:#4778b5;">Batch Codes:</h3>';

                        $html .= '<div class="filter-main-wrapper">';
                        $html .= '<div class="filter-wrapper">';
                        $html .= '<select id="view-code-table-select">';
                        $html .= '<option>Member Codes</option>';
                        $html .= '<option>Benefits Package</option>';
                        $html .= '<option>Dealer</option>';
                        $html .= '<option>Distributor</option>';
                        $html .= '<option>Date Created</option>';
                        $html .= '<option>Number Used</option>';
                        $html .= '</select>';
                        $html .= '</div>';

                        $html .= '<table id="view_code_table" class="display nowrap" style="width:100%">';
                        $html .= '<thead>';
                        $html .= '<tr>';
                        $html .= '<th>';
                        $html .= 'Member Codes';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Benefits Package';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Dealer';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Distributor';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Date Created';
                        $html .= '</th>';

                        $html .= '<th>';
                        $html .= 'Number Used';
                        $html .= '</th>';

                        $html .= '</tr>';
                        $html .= '</thead>';

                        $html .= '<tbody id="">';
                        if ($posts) {
                            foreach ($posts as $key => $value) {
                                $post_id = $value->ID;
                                $member_code = $value->post_title;
                                $benefits_package = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
                                $dealers = get_user_by('login', $dealer_login);
                                $dealer_id = $dealers->data->ID;
                                $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                                $distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
                                $distributors = get_user_by('login', $distributor_login);
                                $distributor_id = $distributors->data->ID;
                                $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

                                $date_created = date('Y-m-d', strtotime(get_post_meta($post_id, '_pmsafe_code_create_date', true)));
                                $data = pmsafe_unused_code_count($post_id);
                                $used_code = $data['used'];
                                $available = $data['total'] - $data['used'];
                                $html .= '<tr>';
                                $html .= '<td>';
                                $html .=  $member_code;
                                $html .= '</td>';
                                $html .= '<td>';
                                $html .= $benefits_package;
                                $html .= '</td>';
                                $html .= '<td>';
                                $html .= $dealer_name;
                                $html .= '</td>';
                                $html .= '<td>';
                                $html .= $distributor_name;
                                $html .= '</td>';
                                $html .= '<td>';
                                $html .= $date_created;
                                $html .= '</td>';
                                $html .= '<td>';
                                $html .= $used_code;
                                $html .= '</td>';

                                $html .= '</tr>';
                            }
                        }
                        $html .= '</tbody>';
                        $html .= '</table>';
                        $html .= '</div>';

                        $invite_args = array(
                            'post_type' => 'pmsafe_invitecode',
                            'post_status' => 'publish',
                            'posts_per_page'   => -1,
                            'meta_query' => array(
                                array(
                                    'key'     => '_pmsafe_dealer',
                                    'value'   => $dealer_login,
                                    'compare' => '='
                                ),

                            ),
                        );
                        $invite_posts = get_posts($invite_args);
                        if ($invite_posts) {
                            // pr($invite_posts);
                            $html .= '<h3 style="color:#4778b5;">Individual Codes:</h3>';
                            $html .= '<div class="filter-main-wrapper">';
                            $html .= '<div class="filter-wrapper">';
                            $html .= '<select id="view-invi-code-table-select">';
                            $html .= '<option>Member Codes</option>';
                            $html .= '<option>Benefits Package</option>';
                            $html .= '<option>Dealer</option>';
                            $html .= '<option>Distributor</option>';
                            $html .= '<option>Date Created</option>';
                            $html .= '<option>Number Used</option>';
                            $html .= '</select>';
                            $html .= '</div>';

                            $html .= '<table id="view_invi_code_table" class="display nowrap" style="width:100%">';
                            $html .= '<thead>';
                            $html .= '<tr>';
                            $html .= '<th>';
                            $html .= 'Member Codes';
                            $html .= '</th>';

                            $html .= '<th>';
                            $html .= 'Benefits Package';
                            $html .= '</th>';

                            $html .= '<th>';
                            $html .= 'Dealer';
                            $html .= '</th>';

                            $html .= '<th>';
                            $html .= 'Distributor';
                            $html .= '</th>';

                            $html .= '<th>';
                            $html .= 'Date Created';
                            $html .= '</th>';

                            $html .= '<th>';
                            $html .= 'Number Used';
                            $html .= '</th>';

                            $html .= '</tr>';
                            $html .= '</thead>';
                            $html .= '<tbody id="">';

                            foreach ($invite_posts as $key => $value) {
                                $post_id = $value->ID;
                                $is_invite_code = get_post_meta($post_id, '_pmsafe_is_invite_code', true);
                                if ($is_invite_code == 1) {
                                    $member_code = $value->post_title;
                                    $benefits_package = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
                                    $dealers = get_user_by('login', $dealer_login);
                                    $dealer_id = $dealers->data->ID;
                                    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                                    $distributor_login = get_post_meta($post_id, '_pmsafe_distributor', true);
                                    $distributors = get_user_by('login', $distributor_login);
                                    $distributor_id = $distributors->data->ID;
                                    $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

                                    $date_created = date('Y-m-d', strtotime(get_post_meta($post_id, '_pmsafe_code_create_date', true)));

                                    $code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
                                    if ($code_status == 'used') {
                                        $used_code = '1';
                                    } else {
                                        $used_code = '0';
                                    }
                                    $html .= '<tr>';
                                    $html .= '<td>';
                                    $html .=  $member_code;
                                    $html .= '</td>';
                                    $html .= '<td>';
                                    $html .= $benefits_package;
                                    $html .= '</td>';
                                    $html .= '<td>';
                                    $html .= $dealer_name;
                                    $html .= '</td>';
                                    $html .= '<td>';
                                    $html .= $distributor_name;
                                    $html .= '</td>';
                                    $html .= '<td>';
                                    $html .= $date_created;
                                    $html .= '</td>';
                                    $html .= '<td>';
                                    $html .= $used_code;
                                    $html .= '</td>';

                                    $html .= '</tr>';
                                }
                            }

                            $html .= '</tbody>';
                            $html .= '</table>';
                            $html .= '</div>';
                            $html .= '</div>';
                        }
                        return $html;
                    } else {
                        echo $dealer_login . ' is registered in another distributor.';
                    }
                } else if ($_GET['action'] == 'view_customer') {
                    if (in_array($dealer_login, $dealer_logins)) {
                        $back_link = get_site_url() . '/distributor-account/';
                        echo '<a href="' . $back_link . '" class="back_link"><input type="button" title="Back to Dealer List" value="Back to Dealer List" style="float:right;margin: 10px 5px;"/></a>';
                        echo '<h2>' . $dealer_name . '\'s Customer List</h2>';
                        echo do_shortcode('[view_registered_user dealer=' . $dealer_login . ']');
                    } else {
                        echo $dealer_login . ' is registered in another distributor.';
                    }
                } else if ($_GET['action'] == 'view_dealer_info') {
                    if (in_array($dealer_login, $dealer_logins)) {
                        global $wpdb;
                        $address = get_user_meta($dealer_id, 'dealer_store_address', true);
                        $phone = get_user_meta($dealer_id, 'dealer_phone_number', true);
                        $contact_info = $wpdb->get_results('SELECT wum.user_id,wu.user_email FROM wp_users wu, wp_usermeta wum WHERE wu.ID = wum.user_id AND wum.meta_key = "contact_dealer_id" AND wum.meta_value =' . $dealer_id);

                        echo '<div id="perma-warranty-wrapper">';
                        echo '<h2>' . $dealer_name . '\'s Info:</h2>';

                        echo '<table class="tbl-dealer-info">';
                        echo '<tr>';
                        echo '<td><strong>Dealership Name: </strong></td>';
                        echo '<td>' . $dealer_name . '</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td><strong>Dealership Number: </strong></td>';
                        echo '<td>' . $dealer_login . '</td>';
                        echo '</tr>';


                        echo '<tr>';
                        echo '<td><strong>Store Address</strong></td>';
                        echo '<td>' . (($address) ? $address : '-') . '</td>';
                        echo '</tr>';

                        echo '<tr>';
                        echo '<td><strong>Phone</strong></td>';
                        echo '<td>' . (($phone) ? phone_number_format($phone) : '-') . '</td>';
                        echo '</tr>';

                        echo '</table>';
                        echo '<h2>Dealer Contacts:</h2>';
                        echo '<div class="contact-card-main-wrapper">';
                        if ($contact_info) {
                            foreach ($contact_info as $key => $value) {
                                $user_id = $value->user_id;
                                $fname = get_user_meta($user_id, 'contact_fname', true);
                                $lname = get_user_meta($user_id, 'contact_lname', true);
                                $phone = get_user_meta($user_id, 'contact_phone', true);
                                echo '<div class="contact-card-inner-wrapper">';
                                echo '<h3>' . $fname . ' ' . $lname . '<a href="#edit-contact-person-modal" id="pmsafe_dealers_contact_edit" data-id="' . $user_id . '" title="click here to edit this contact"><i class="fa fa-edit"></i></a></h3>';
                                echo '<p><i class="fa fa-envelope"></i>' . $value->user_email . '</p>';
                                echo '<p><i class="fa fa-phone"></i>' . phone_number_format($phone) . '</p>';
                                echo '<input type="button" value="Send Password Reset" id="pmsafe_contact_info_mail" data-id="' . $user_id . '">';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No contact persons are added.</p>';
                        }
                        echo '</div>';
                        echo '</div>';

                        echo '<div id="edit-contact-person-modal" class="modal">';
                        echo '<h3>Edit Contact Person Information:<h3>';
                        echo '<div class="nisl-wrap">';
                        echo '<label><strong>First Name:</strong></label>';
                        echo '<input type="hidden" id="contact_person_id" value="" />';
                        echo '<input type="text" id="edit_dealer_contact_fname" name="edit_dealer_contact_fname" value="" class="widefat" />';
                        echo '</div>';

                        echo '<div class="nisl-wrap">';
                        echo '<label><strong>Last Name:</strong></label>';
                        echo '<input type="text" id="edit_dealer_contact_lname" name="edit_dealer_contact_lname" value="" class="widefat" />';
                        echo '</div>';

                        echo '<div class="nisl-wrap">';
                        echo '<label><strong>Phone Number:</strong></label>';
                        echo '<input type="text" id="edit_dealer_contact_phone" name="edit_dealer_contact_phone" value="" class="widefat" />';
                        echo '</div>';

                        echo '<div class="nisl-wrap">';
                        echo '<label><strong>Email:</strong></label>';
                        echo '<input type="email" id="edit_dealer_contact_email" name="edit_dealer_contact_email" value="" class="widefat" readonly="readonly"/>';
                        echo '</div>';

                        echo '<div class="nisl-wrap">';
                        echo '<label><strong>Password:</strong></label>';
                        echo '<input type="text" rel="gp" name="edit_dealer_contact_password" id="edit_dealer_contact_password" value="" class="widefat" style="width:35%;margin: 10px;"/>';
                        echo '<input type="button" value="Generate Password" class="generate_dealer_contact_password" style="padding: 12px 10px;"/>';
                        echo '</div>';
                        echo '<input type="button" value="Save" id="edit_new_contact_person" />';
                        echo '</div>';
                    } else {
                        echo $dealer_login . ' is registered in another distributor.';
                    }
                } else {
                    $success = $_GET['success'];
                    $code = $_GET['code'];
                    if ($success == "true") {
                        $code_id = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $code);
                        $pdf_link = get_post_meta($code_id, 'pmsafe_pdf_link', true);

                        ?>
<div class='message'>
    <div class='check'>
        &#10004;
    </div>
    <p>
        Success
    </p>
    <p>
        <?php echo 'Registration of Code <span style="color:#71c341">' . $code . '</span> was Successful.' ?>
    </p>
    <p>
        <a href="<?php echo $pdf_link; ?>" target="_blank" id="view-pdf">View PDF</a>
        <iframe src="<?php echo $pdf_link; ?>" id="myFrame" frameborder="0" style="border:0;display:none;" width="300" height="300"></iframe>
        <input type="button" id="print-pdf" onclick="print()" value="Print PDF" />
        <script>
            function print() {
                var objFra = document.getElementById('myFrame');
                objFra.contentWindow.focus();
                objFra.contentWindow.print();
            }
        </script>
    </p>
    <a href="<?php echo get_site_url(); ?>/distributor-account/" id='ok'>
        OK
    </a>
</div>
<?php
                    }
                    if ($role['distributor-user'] == 1) {
                        $distributor_user_login = $current_user->user_login;
                        $user = get_user_by('login', $distributor_user_login);
                        $contact_id = $user->ID;
                        $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                        $distributor_user = get_user_by('id', $distributor_id);
                        $distributor_username = $distributor_user->user_login;
                    } else {
                        $distributor_username = $current_user->user_login;
                        $user = get_user_by('login', $distributor_username);
                        $distributor_id = $user->ID;
                    }

                    $dealers =  get_users(
                        array(
                            'meta_key' => 'dealer_distributor_name',
                            'meta_value' => $distributor_id
                        )
                    );
                    if ($dealers) {
                        $html = '';
                        $html .= '<h2 class="text-center">Dealers:</h2>';
                        $html .= '<div class="card-main-wrapper">';

                        foreach ($dealers as $dealer) {
                            $dealer_id = $dealer->ID;
                            $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                            $address = get_user_meta($dealer_id, 'dealer_store_address', true);
                            $html .= '<div class="card-inner-wrapper">';
                            $html .= '<p>' . $dealer->user_login . '</p>';
                            $html .= '<h3>' . $dealer_name . '</h3>';
                            $html .= '<p class="address">' . $address . '</p>';
                            $html .= '<div class="card-link-wrapper">';
                            $view_dealer_info_url = get_site_url() . '/distributor-account/?dealer=' . $dealer->user_login . '&action=view_dealer_info';
                            $view_range_code_url = get_site_url() . '/distributor-account/?dealer=' . $dealer->user_login . '&action=view_codes';
                            $view_customer_code_url = get_site_url() . '/distributor-account/?dealer=' . $dealer->user_login . '&action=view_customer';
                            $view_membership_url = get_site_url() . '/upgraded-policies/?dealer=' . $dealer->user_login . '&action=view_membership';
                            $html .= '<p><a href="' . $view_dealer_info_url . '" target="_blank" title="click here"><i class="fa fa-user"></i>Dealer Info</a></p>';
                            $html .= '<p><a href="' . $view_range_code_url . '" target="_blank" title="click here"><i class="fa fa-th"></i>Products</a></p>';
                            $html .= '<p><a href="' . $view_customer_code_url . '" target="_blank" title="click here"><i class="fa fa-users"></i>Customers</a></p>';
                            $html .= '<p><a href="' . get_site_url() . '/customer-reports" target="_blank" title="click here" data-id="' . $dealer->user_login . '" id="customer_report"><i class="fa fa-bar-chart"></i>Reports</a></p>';

                            $html .= '</div>';
                            $html .= '</div>';
                        }

                        $html .= '</div>';
                        return $html;
                    } else {
                        echo 'No dealers registered.';
                    }
                }
            } else {
                $location = get_site_url() . "/perma-register/";
                wp_redirect($location, 301);
                exit;
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
    }

    public function send_reset_mail_function()
    {
        $user_id = $_POST['contact_id'];
        reset_mail_format($user_id);
        die;
    }

    //fetch dealer contact information
    public function fetch_dealer_contact_information()
    {
        $contact_id = $_POST['contact_id'];
        $users =  get_user_by('id', $contact_id);
        $email = $users->user_email;
        $fname  = get_user_meta($contact_id, 'contact_fname', true);
        $lname  = get_user_meta($contact_id, 'contact_lname', true);
        $phone  = get_user_meta($contact_id, 'contact_phone', true);
        $response = array('fname' => $fname, 'lname' => $lname, 'phone' => $phone, 'email' => $email, 'contact_id' => $contact_id);
        echo json_encode($response);
        die;
    }

    public function edit_dealer_contact_info_function()
    {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $contact_id = $_POST['contact_id'];

        $contact_id = wp_update_user(array('ID' => $contact_id, 'user_email' => $email));

        if ($password != '') {

            wp_set_password($password, $contact_id);

            $to = $email;
            $password = $password;
            $subject = 'PermaSafe: Your User Account has been updated';
            send_mail_to_users($to, $password, $subject);
        }

        update_user_meta($contact_id, 'contact_fname', $fname);
        update_user_meta($contact_id, 'contact_lname', $lname);
        update_user_meta($contact_id, 'contact_phone', $phone);

        die;
    }

    /**
     * dealer_total_information shortcode
     *
     * This function is used to total information card at dealer login area.
     * For example: current month total membership, total active membeship and total membrship.
     */
    public function dealer_total_information_function()
    {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            // echo '<pre>';
            // print_r($current_user);
            // echo '</pre>';
            $current_month = date('m');

            $last_month = date('m', strtotime("last day of -1 month"));
            $last_month_name = date('F', strtotime("last day of -1 month"));
            // echo $current_month;
            $role = (array) $current_user->caps;
            if ($role['contributor'] == 1 || $role['dealer-user'] == 1) {
                if ($role['dealer-user'] == 1) {
                    $dealer_user_login = $current_user->user_login;
                    $user = get_user_by('login', $dealer_user_login);
                    $contact_id = $user->ID;
                    $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                    $dealer_user = get_user_by('id', $dealer_id);
                    $dealer_username = $dealer_user->user_login;
                } else {
                    $dealer_username = $current_user->user_login;
                }

                $customer_arr = get_user_by_dealer($dealer_username);
                foreach ($customer_arr as $key => $value) {

                    $registration_date = $value['registration_date'];
                    $vehicle_expiration_date = $value['expiration_date'];
                    $registered_date = $value['registration_date'];
                    $time = strtotime($registered_date);
                    $date_month = date("m", $time);
                    $current_date = date('Y-m-d');

                    if ($date_month == $current_month) {
                        $total_current_month += count($registered_date);
                    }
                    if ($date_month == $last_month) {
                        $total_last_month += count($registered_date);
                    }
                    if ($current_date <= $vehicle_expiration_date) {

                        $active_member += count($registration_date);
                    }
                    $total_count += count($registration_date);
                }

                $html = '';
                $html .= '<div id="easyPaginate">';

                $html .= '<div class="card-wrap">';
                $html .= '<div class="contents">';
                $html .= '<h3>' . date('F') . '\'s</h3>';
                $html .= '<h4>New Members:</h4>';
                $html .= '</div>';
                if ($total_current_month == '') {
                    $current_month = 0;
                } else {
                    $current_month = $total_current_month;
                }
                $html .= '<p class="member_number">' . $current_month . '</p>';
                $html .= '</div>';


                $html .= '<div class="card-wrap">';
                $html .= '<div class="contents">';
                $html .= '<h3>Current Active</h3>';
                $html .= '<h4>Memberships:</h4>';
                $html .= '</div>';
                if ($active_member == '') {
                    $active_member = 0;
                } else {
                    $active_member = $active_member;
                }
                $html .= '<p class="member_number">' . $active_member . '</p>';
                $html .= '</div>';

                $html .= '<div class="card-wrap-2">';
                $html .= '<div class="contents">';
                $html .= '<h3>Total</h3>';
                $html .= '<h4>Memberships<br />To Date:</h4>';
                $html .= '</div>';
                if ($total_count == '') {
                    $total_count = 0;
                } else {
                    $total_count = $total_count;
                }
                $html .= '<p class="member_number-2">' . $total_count . '</p>';
                $html .= '</div>';

                $html .= '</div>';
                return $html;
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
    }

    /**
     * dealer_total_information shortcode
     *
     * This function is used to total information card at distributor login area.
     * For example: current month total membership, total active membeship and total membrship.
     */
    public function distributor_total_information_function()
    {
        if (is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $current_month = date('m');

            $last_month = date('m', strtotime("last day of -1 month"));
            $last_month_name = date('F', strtotime("last day of -1 month"));

            $role = (array) $current_user->caps;
            if ($role['author'] == 1 || $role['distributor-user'] == 1) {

                if ($role['distributor-user'] == 1) {

                    $distributor_user_login = $current_user->user_login;
                    $user = get_user_by('login', $distributor_user_login);
                    $contact_id = $user->ID;
                    $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                    $distributor_user = get_user_by('id', $distributor_id);
                    $distributor_username = $distributor_user->user_login;
                } else {
                    $distributor_username = $current_user->user_login;
                    $user = get_user_by('login', $distributor_username);
                    $distributor_id =  $user->ID;
                }



                $distributor_name =  get_users(
                    array(
                        'meta_key' => 'dealer_distributor_name',
                        'meta_value' => $distributor_id
                    )
                );
                // echo '<pre>';
                if ($distributor_name) {
                    // $dealers_name = '';
                    foreach ($distributor_name as $dealername) {
                        $dealer_login = $dealername->user_login;

                        $customer_arr = get_user_by_dealer($dealer_login);

                        foreach ($customer_arr as $key => $value) {

                            $registration_date = $value['registration_date'];
                            $vehicle_expiration_date = $value['expiration_date'];
                            $registered_date = $value['registration_date'];
                            $time = strtotime($registered_date);
                            $date_month = date("m", $time);
                            $current_date = date('Y-m-d');

                            if ($date_month == $current_month) {
                                $total_current_month += count($registered_date);
                            }
                            if ($date_month == $last_month) {
                                $total_last_month += count($registered_date);
                            }
                            if ($current_date <= $vehicle_expiration_date) {
                                // echo $value['code'].'<br/>';
                                $active_member += count($registration_date);
                            }
                            $total_count += count($registration_date);
                        }
                    }
                }

                $html = '';
                $html .= '<div id="easyPaginate">';

                $html .= '<div class="card-wrap">';
                $html .= '<div class="contents">';
                $html .= '<h3>' . date('F') . '\'s</h3>';
                $html .= '<h4>New Members:</h4>';
                $html .= '</div>';
                if ($total_current_month == '') {
                    $current_month = 0;
                } else {
                    $current_month = $total_current_month;
                }
                $html .= '<p class="member_number">' . $current_month . '</p>';
                $html .= '</div>';

                $html .= '<div class="card-wrap">';
                $html .= '<div class="contents">';
                $html .= '<h3>Current Active</h3>';
                $html .= '<h4>Memberships:</h4>';
                $html .= '</div>';
                if ($active_member == '') {
                    $active_member = 0;
                } else {
                    $active_member = $active_member;
                }
                $html .= '<p class="member_number">' . $active_member . '</p>';
                $html .= '</div>';

                $html .= '<div class="card-wrap-2">';
                $html .= '<div class="contents">';
                $html .= '<h3>Total</h3>';
                $html .= '<h4>Memberships<br />To Date:</h4>';
                $html .= '</div>';
                if ($total_count == '') {
                    $total_count = 0;
                } else {
                    $total_count = $total_count;
                }
                $html .= '<p class="member_number-2">' . $total_count . '</p>';
                $html .= '</div>';

                $html .= '</div>';
                return $html;
            }
        }
    }


    /**
     * quick_filters shortcode
     * This function is used to display quick filter layout.
     */
    public function quick_filters_function()
    {
        if (is_user_logged_in()) {
            $html = '';
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;

            if ($role['author'] == 1 || $role['contributor'] == 1 || $role['dealer-user'] == 1 || $role['distributor-user'] == 1) {
                $html .= '<div class="filter-wrap">';
                $html .= '<div class="select-filter-wrap">';
                $html .= '<select id="quick_filters">';
                $html .= '<option value="0">Quick Filters</option>';
                $html .= '<option value="1">Expired Members</option>';
                $html .= '<option value="2">Expiring Members</option>';
                $html .= '<option value="3">Current Members</option>';
                $html .= '</select>';
                $html .= '</div>';

                $html .= '<div class="input-filter-wrap">';
                $html .= '<label>Date: </label><input type="text" id="datepicker1" style="width:auto;" disabled> <input type="text" id="datepicker2" style="width:auto;" disabled>';
                $html .= '</div>';

                $html .= '<div class="btn-filter-wrap">';
                $html .= '<input type="button" id="date_submit" value="submit"/>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="search-result-wrap">';
                $html .= '<div class="tbl-result-wrap">';

                $html .= '</div>';
                $html .= '<div class="data-result-wrap">';

                $html .= '</div>';
                $html .= '</div>';
                return $html;
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
    }

    /**
     * ajax function for quick filters
     *
     */
    public function dealer_distributor_quick_filters()
    {
        if (is_user_logged_in()) {
            global $wpdb;
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            $datepicker1 = $_POST['datepicker1'];
            $datepicker2 = $_POST['datepicker2'];
            $select = $_POST['select'];
            $login = $current_user->user_login;

            if ($role['author'] == 1) {

                $users = get_user_by('login', $login);
                $distributor_id = $users->ID;
                $check_array =  get_code_by_distributor_login($distributor_id);
            }
            if ($role['distributor-user'] == 1) {
                $distributor_user_login = $current_user->user_login;
                $user = get_user_by('login', $distributor_user_login);
                $contact_id = $user->ID;
                $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                $distributor_user = get_user_by('id', $distributor_id);
                $distributor_username = $distributor_user->user_login;


                $check_array =  get_code_by_distributor_login($distributor_id);
            }
            if ($role['contributor'] == 1) {

                $check_array = get_code_by_dealer_login($login);
            }
            if ($role['dealer-user'] == 1) {
                $dealer_user_login = $current_user->user_login;
                $user = get_user_by('login', $dealer_user_login);
                $contact_id = $user->ID;
                $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $dealer_user = get_user_by('id', $dealer_id);
                $dealer_username = $dealer_user->user_login;


                $check_array = get_code_by_dealer_login($dealer_username);
            }


            $setStart = ($datepicker1 == '' || !isset($datepicker1)) ? false : true;
            $setExpire = ($datepicker2 == '' || !isset($datepicker2)) ? false : true;

            $sql = "SELECT user_id FROM wp_usermeta WHERE meta_key='pmsafe_vehicle_info'";
            $query = $wpdb->get_results($sql);
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

                    $vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);
                    $benefits_package = get_post_meta($vehicle_info[0][$nickname]['pmsafe_member_code_id'], '_pmsafe_code_prefix', true);
                    $term_length_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $benefits_package);
                    $term_length = get_post_meta($term_length_id, '_pmsafe_benefit_term_length', true);
                    $vehicle_registration_date = date('Y-m-d', strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date']));
                    $expiration_date = date('Y-m-d', strtotime("+" . $term_length . " months", strtotime($vehicle_info[0][$nickname]['pmsafe_registration_date'])));
                    $current_date = date('Y-m-d');
                    //expired
                    if ($select == 1) {
                        if ($current_date > $expiration_date) {
                            if (!$setStart)
                                $datepicker1 = $expiration_date;

                            if (!$setExpire)
                                $datepicker2 = $expiration_date;

                            if (($expiration_date >= $datepicker1) && ($expiration_date <= $datepicker2)) {
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

                                // pr($vehicle_info);
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
                    } else if ($select == 2) { //expiring
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
                            if (!$setStart)
                                $datepicker1 = $expiration_date;

                            if (!$setExpire)
                                $datepicker2 = $expiration_date;

                            if (($expiration_date >= $datepicker1) && ($expiration_date <= $datepicker2)) {
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

                                // pr($vehicle_info);
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
                    } else if ($select == 3) {  // current
                        if ($current_date <= $expiration_date) {

                            if (!$setStart)
                                $datepicker1 = $vehicle_registration_date;

                            if (!$setExpire)
                                $datepicker2 = $vehicle_registration_date;

                            if (($vehicle_registration_date >= $datepicker1) && ($vehicle_registration_date <= $datepicker2)) {
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

                                // pr($vehicle_info);
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
                    }
                }
            }
            //}
            $html .= '</tbody>';
            $html .= '</table>';


            echo $html;
        }
        die;
    }

    /**
     * reports shortcode
     *
     */
    public function reports_function()
    {
        if (is_user_logged_in()) {
            $html = '';
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;


            $html .= '<div class="reports-wrap">';

            // member code
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Member Code : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="member_code" id="member_code"/>';
            $html .= '</div>';
            $html .= '</div>';

            // First name
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Customer First Name : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="first_name" id="first_name"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Last Name
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Customer Last Name : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="last_name" id="last_name"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Address
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Address : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="address" id="address"/>';
            $html .= '</div>';
            $html .= '</div>';

            // phone
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Phone Number : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="phone_number" id="phone_number"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Email
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Email : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="email" id="email"/>';
            $html .= '</div>';
            $html .= '</div>';

            // City
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>City : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="city" id="city"/>';
            $html .= '</div>';
            $html .= '</div>';

            //state
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>State : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="state" id="state"/>';
            $html .= '</div>';
            $html .= '</div>';

            //Zip Code
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Zip Code : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="zip_code" id="zip_code"/>';
            $html .= '</div>';
            $html .= '</div>';




            // Vehicle year
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Vehicle Year : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="vehicle_year" id="vehicle_year"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Vehicle Make
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Vehicle Make : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="vehicle_make" id="vehicle_make"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Vehicle Model
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Vehicle Model : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="vehicle_model" id="vehicle_model"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Vehicle VIN
            $html .= '<div class="reports-wrap-inner">';
            $html .= '<div class="label-input">';
            $html .= '<label>Vehicle VIN : </label>';
            $html .= '</div>';
            $html .= '<div class="input-div">';
            $html .= '<input type="text" name="vehicle_vin" id="vehicle_vin"/>';
            $html .= '</div>';
            $html .= '</div>';

            // Submit

            $html .= '<div class="input-btn">';
            $html .= '<input type="button" name="search_submit" id="search_submit" value="Search" data-scroll-to="#id1" data-scroll-focus="#id1" data-scroll-speed="700" data-scroll-offset="5"/>';
            $html .= '<input type="reset" name="reset" id="search_reset" value="Reset"/>';
            $html .= '</div>';



            $html .= '</div>';
            $html .= '<section id="id1"></section>';
            $html .= '<div class="search-result-wrap">';
            $html .= '<div class="tbl-result-wrap">';

            $html .= '</div>';
            $html .= '<div class="data-result-wrap">';

            $html .= '</div>';
            $html .= '</div>';

            return $html;
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
    }

    /*
* ajax function for distributor_view_data_reports
*
*/
    public function dealer_distributor_view_data_reports()
    {
        $user_id = $_POST['id'];
        view_data_reports($user_id);
        exit;
    }

    /*
* ajax function for distributor reports
*
*/
    public function dealer_distributor_reports()
    {
        if (is_user_logged_in()) {
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

            $login = $current_user->user_login;
            if ($role['author'] == 1) {
                $users = get_user_by('login', $login);
                $distributor_id = $users->ID;
                $check_array = get_code_by_distributor_login($distributor_id);
            }
            if ($role['distributor-user'] == 1) {
                $distributor_user_login = $login;
                $user = get_user_by('login', $distributor_user_login);
                $contact_id = $user->ID;
                $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                $distributor_user = get_user_by('id', $distributor_id);
                $distributor_username = $distributor_user->user_login;



                $check_array = get_code_by_distributor_login($distributor_id);
            }
            if ($role['contributor'] == 1) {


                $check_array = get_code_by_dealer_login($login);
            }
            if ($role['dealer-user'] == 1) {
                $dealer_user_login = $login;
                $user = get_user_by('login', $dealer_user_login);
                $contact_id = $user->ID;
                $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $dealer_user = get_user_by('id', $dealer_id);
                $dealer_username = $dealer_user->user_login;



                $check_array = get_code_by_dealer_login($dealer_username);
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

            if (!empty($where))
                $where = ' where 1=1 ' . $where;

            $sql = $mysql . $where;
            // echo $sql;

            $query = $wpdb->get_results($sql);

            echo '<table id="search_tbl">';
            echo '<thead>';
            echo '<tr>';

            echo '<th>';
            echo 'MemberCode';
            echo '</th>';

            echo '<th>';
            echo 'First Name';
            echo '</th>';

            echo '<th>';
            echo 'Last Name';
            echo '</th>';

            echo '<th>';
            echo 'Address';
            echo '</th>';

            echo '<th>';
            echo 'PDF';
            echo '</th>';

            echo '<th class="nisl-pdf-link">';
            echo 'PDF';
            echo '</th>';

            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';


            foreach ($query as $key => $value) {
                // echo $value->user_id.'<br/>';
                $nickname = get_user_meta($value->user_id, 'nickname', true);
                if (in_array($nickname, $check_array)) {
                    // echo $nickname.'<br/>';

                    echo '<tr>';

                    echo '<td>';
                    echo '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'nickname', true) . '</a>';
                    echo '</td>';

                    echo '<td>';
                    echo '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'first_name', true) . '</a>';
                    echo '</td>';

                    echo '<td>';
                    echo '<a href="" class="view-data" data-id="' . $value->user_id . '">' . get_user_meta($value->user_id, 'last_name', true) . '</a>';
                    echo '</td>';

                    $address1 = get_user_meta($value->user_id, 'pmsafe_address_1', true);
                    $address2 = get_user_meta($value->user_id, 'pmsafe_address_2', true);
                    $city = get_user_meta($value->user_id, 'pmsafe_city', true);
                    $state = get_user_meta($value->user_id, 'pmsafe_state', true);
                    $zip_code = get_user_meta($value->user_id, 'pmsafe_zip_code', true);
                    echo '<td>';
                    echo '<a href="" class="view-data" data-id="' . $value->user_id . '">' . $address1 . ', ' . $address2 . ', ' . $city . ', ' . $state . ', ' . $zip_code . '</a>';
                    echo '</td>';

                    $vehicle_info = get_user_meta($value->user_id, 'pmsafe_vehicle_info', false);

                    $url = get_site_url() . '/wp-includes/images/media/document.png';
                    echo '<td>';
                    echo '<a href="' . $vehicle_info[0][$nickname]['pmsafe_pdf_link'] . '" target="blank"><img src="' . $url . '" class="attachment-thumbnail" style="width:20px !important"/></a>';
                    echo '</td>';

                    echo '<td class="nisl-pdf-link">';
                    echo $vehicle_info[0][$nickname]['pmsafe_pdf_link'];
                    echo '</td>';
                    //}
                    echo '</tr>';
                }
            }
            //}
            echo '</tbody>';
            echo '</table>';

            // customer_search_reports($role, $login, $member_code, $first_name, $last_name, $address, $phone_number, $email, $city, $state, $zip_code, $vehicle_year, $vehicle_make, $vehicle_model, $vehicle_vin);
        }

        die;
    }

    /**
     * total_range_codes shortcode
     *
     */
    public function total_range_codes()
    {
        $html = '';
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            if ($role['author'] == 1 || $role['distributor-user'] == 1) {
                if ($_GET['dealer']) {

                    $dealer_login = $_GET['dealer'];
                    $dealer_user = get_user_by('login', $dealer_login);
                    $dealer_id = $dealer_user->data->ID;
                    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);

                    if ($_GET['action'] == 'view_codes') {

                        $args = array(
                            'post_type' => 'pmsafe_bulk_invi',
                            'post_status' => 'publish',
                            'posts_per_page'   => -1,
                            'meta_query' => array(
                                array(
                                    'key'     => '_pmsafe_dealer',
                                    'value'   => $dealer_login,
                                    'compare' => '=',
                                ),

                            ),
                        );
                        $posts = get_posts($args);
                        if ($posts) {
                            foreach ($posts as $key => $value) {
                                $post_id = $value->ID;

                                $dealers = get_user_by('login', $dealer_login);
                                $dealer_id = $dealers->data->ID;
                                $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);

                                $data = pmsafe_unused_code_count($post_id);
                                $used_code = $data['used'];
                                $available = $data['total'] - $data['used'];
                                $bulk_total += $data['total'];
                                $bulk_used += $data['used'];
                            }
                        }

                        $invite_args = array(
                            'post_type' => 'pmsafe_invitecode',
                            'post_status' => 'publish',
                            'posts_per_page'   => -1,
                            'meta_query' => array(
                                array(
                                    'key'     => '_pmsafe_dealer',
                                    'value'   => $dealer_login,
                                    'compare' => '='
                                ),

                            ),
                        );
                        $invite_posts = get_posts($invite_args);
                        if ($invite_posts) {
                            foreach ($invite_posts as $key => $value) {
                                $post_id = $value->ID;
                                $is_invite_code = get_post_meta($post_id, '_pmsafe_is_invite_code', true);
                                if ($is_invite_code == 1) {
                                    $dealers = get_user_by('login', $dealer_login);
                                    $dealer_id = $dealers->data->ID;
                                    $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                                    $code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
                                    if ($code_status == 'used') {
                                        $invite_used += 1;
                                    } else {
                                        $invite_used = 0;
                                    }

                                    // $data = pmsafe_unused_code_count($post_id);
                                    // $used_code = $data['used'];
                                    // $available = $data['total'] - $data['used'];
                                    $invi_total += count($post_id);
                                    // $total_used += $data['used'];
                                }
                            }
                        }
                        // echo 'invi_total'.$invite_used;
                        $total_used =  $invite_used + $bulk_used;
                        $total = $bulk_total + $invi_total;
                        $html .= '<p class="range-count">Total Used code <span>' . $total_used . '</span>';
                        $html .= 'Total Used & Unused code <span>' . $total . '</span></p>';
                    }
                }
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }

        return $html;
    }

    /**
     * perma_user_name shortcode
     *
     * @return string
     *
     * Just a quick function to return the user name on login.
     * Would also like to display Dealer Name & Distributor Name on their pages
     * Need help on pulling that meta info
     *
     * - Curtis
     */
    public function perma_user_name_function()
    {
        if (is_user_logged_in()) {

            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            $html = '';
            if ($role['contributor'] == 1) {
                $perma_user_id = $current_user->user_login;

                // $perma_name = get_user_meta( $perma_user_id, 'dealer_name' , true );

                $dealer_user = get_user_by('login', $perma_user_id);
                $dealer_id = $dealer_user->data->ID;
                $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);

                //      $html .= '<div id="perma-user-name">';
                $html .= '<h1><strong>Welcome</strong> ' . $dealer_name . '</h1>';
                $html .= '<h3><strong>' . $dealer_name . '\'s Account Information</strong></h3>';
                //      $html .= '</div>';
                return $html;
            } else if ($role['dealer-user'] == 1) {
                $perma_user_id = $current_user->user_login;
                $user = get_user_by('login', $perma_user_id);
                $contact_id = $user->ID;
                $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $contact_fname = get_user_meta($contact_id, 'contact_fname', true);
                $dealer_name = get_user_meta($dealer_id, 'dealer_name', true);
                $html .= '<h1><strong>Welcome</strong> ' . $contact_fname . '</h1>';
                $html .= '<h3><strong>' . $dealer_name . '\'s Account Information</strong></h3>';
                //      $html .= '</div>';
                return $html;
            } else if ($role['author'] == 1) {
                $perma_user_id = $current_user->user_login;


                // $perma_name = get_user_meta( $perma_user_id, 'dealer_name' , true );

                $distributor_user = get_user_by('login', $perma_user_id);
                $distributor_id = $distributor_user->data->ID;
                $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);

                //      $html .= '<div id="perma-user-name">';
                $html .= '<h1><strong>Welcome</strong> ' . $distributor_name . '</h1>';
                $html .= '<h3><strong>' . $distributor_name . '\'s Account Information</strong></h3>';
                //      $html .= '</div>';
                return $html;
            } else if ($role['distributor-user'] == 1) {
                $perma_user_id = $current_user->user_login;
                $user = get_user_by('login', $perma_user_id);
                $contact_id = $user->ID;
                $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                $contact_fname = get_user_meta($contact_id, 'distributor_contact_fname', true);
                $distributor_name = get_user_meta($distributor_id, 'distributor_name', true);
                $html .= '<h1><strong>Welcome</strong> ' . $contact_fname . '</h1>';
                $html .= '<h3><strong>' . $distributor_name . '\'s Account Information</strong></h3>';
                //      $html .= '</div>';
                return $html;
            }
        }
    }



    /*
* perma_waranty_pdf shortcode
*/
    public function perma_waranty_pdf_function()
    {
        if (is_user_logged_in()) {
            global $wpdb;
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            $id = $_GET['id'];
            $dealer_id = $_GET['dealer'];
            // $dealer_login = $_GET['dealer_login'];

            $user_id = get_current_user_id();
            if ($role['author'] == 1 || $role['distributor-user'] == 1) {

                if ($role['distributor-user'] == 1) {
                    $distributor_user_login = $current_user->user_login;
                    $user = get_user_by('login', $distributor_user_login);
                    $contact_id = $user->ID;
                    $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                    $distributor_user = get_user_by('id', $distributor_id);
                    $distributor_username = $distributor_user->user_login;
                } else {
                    $distributor_username = $current_user->user_login;
                    $user = get_user_by('login', $distributor_username);
                    $distributor_id = $user->ID;
                }


                $results = $wpdb->get_results('SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value="' . $distributor_id . '"');

                foreach ($results as $result) {

                    if ($result->user_id == $dealer_id) {

                        $query = $wpdb->get_row('SELECT user_login FROM `wp_users` WHERE ID="' . $dealer_id . '"');
                        $dealer_login = $query->user_login;
                        $query_pdf_ids = $wpdb->get_results('SELECT post_id FROM `wp_postmeta` WHERE meta_key="_pmsafe_dealer" AND meta_value="' . $dealer_login . '"');

                        foreach ($query_pdf_ids as $query_pdf_id) {
                            $pdf_id = $query_pdf_id->post_id;

                            if ($pdf_id == $id) {

                                $pdf_link = get_post_meta($pdf_id, 'pmsafe_pdf_link', true);
                                echo '<embed src="' . $pdf_link . '" type="application/pdf" width="100%" height="600px"">';
                            }
                        }


                        break;
                    }
                }
            } else if ($role['contributor'] == 1) {

                if ($user_id == $dealer_id) {

                    $query = $wpdb->get_row('SELECT user_login FROM `wp_users` WHERE ID="' . $dealer_id . '"');

                    $dealer_login = $query->user_login;
                    $query_pdf_ids = $wpdb->get_results('SELECT post_id FROM `wp_postmeta` WHERE meta_key="_pmsafe_dealer" AND meta_value="' . $dealer_login . '"');
                    // print_r($query_pdf_ids);
                    foreach ($query_pdf_ids as $query_pdf_id) {
                        $pdf_id = $query_pdf_id->post_id;

                        if ($pdf_id == $id) {

                            $pdf_link = get_post_meta($pdf_id, 'pmsafe_pdf_link', true);

                            echo '<embed src="' . $pdf_link . '" type="application/pdf" width="100%" height="600px">';
                        }
                    }
                }
            } else if ($role['dealer-user'] == 1) {
                $dealer_user_login = $current_user->user_login;
                $user = get_user_by('login', $dealer_user_login);
                $contact_id = $user->ID;
                $user_dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $dealer_user = get_user_by('id', $dealer_id);
                $login = $dealer_user->user_login;
                if ($user_dealer_id == $dealer_id) {


                    $query = $wpdb->get_row('SELECT user_login FROM `wp_users` WHERE ID="' . $dealer_id . '"');


                    $query_pdf_ids = $wpdb->get_results('SELECT post_id FROM `wp_postmeta` WHERE meta_key="_pmsafe_dealer" AND meta_value="' . $login . '"');
                    // print_r($query_pdf_ids);
                    foreach ($query_pdf_ids as $query_pdf_id) {
                        $pdf_id = $query_pdf_id->post_id;

                        if ($pdf_id == $id) {

                            $pdf_link = get_post_meta($pdf_id, 'pmsafe_pdf_link', true);

                            echo '<embed src="' . $pdf_link . '" type="application/pdf" width="100%" height="600px">';
                        }
                    }
                }
            } else if ($role['subscriber'] == 1) {
                $membercode = $_GET['membercode'];
                $vehicle_info = get_the_author_meta('pmsafe_vehicle_info', $user_id);
                $vehicle_info = $vehicle_info[$membercode];
                echo '<a href="' . esc_attr($vehicle_info['pmsafe_pdf_link']) . '" id="download-pdf" target="_blank" download style="display:none;">Download as a PDF</a>';

                ?>
<script type="text/javascript">
    jQuery(window).load(function() {
        jQuery("#download-pdf")[0].click()
        window.location = "<?php echo get_site_url() . '/perma-warranty/' ?>";
    });
</script>
<?php
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }

        ?>
<script type="text/javascript">
    jQuery(document).bind("contextmenu", function(e) {
        e.preventDefault();
    });

    document.onkeydown = function(e) {
        if (event.keyCode == 123) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
            return false;
        }
        if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
            return false;
        }
    }
</script>
<?php

    }


    /**
     * perma_register shortcode
     *
     * @return string
     */
    public function perma_register_function()
    {
        $current_user = wp_get_current_user();
        $role = (array) $current_user->caps;
        // echo 'testing';
        //     pr($role);


        $html = '';
        $html .= '<div class="perma-register" id="perma-register">';
        $html .= '<div id="pmsafe-response"></div>';
        $html .= '<form name="perma_register" id="perma_register_form" method="POST">';
        $html .= '<div id="member_code_div">';
        $html .= '<label>Warranty Registration Number';
        $html .= '<input type="text" name="member_number" id="member_number" value=""/>';
        $html .= '</label>';
        $html .= '</div>';

        if ($role['dealer-user'] == 1 || $role['contributor'] == 1 || $role['author'] == 1 || $role['administrator'] == 1 || $role['distributor-user'] == 1) {
            $login_id = get_current_user_id();
            $html .= '<div id="change_benefits_package">';
            $html .= '<input type="hidden" name="is_upgradable" id="is_upgradable" value="1"/>';
            $html .= '<input type="hidden" name="login_id" id="login_id" value="' . $login_id . '"/>';
            $html .= '<div class="content-column one_half" id="upgradable_package_div" style="display:none;">';
            $html .= '<label>Upgradable Packages: ';
            $html .= '<select id="select_upgradable_package">';
            $html .= '<option value="0">Select Package</option>';

            $html .= '</select>';
            $html .= '</label>';
            $html .= '<input type="button" id="pmsafe_update_prefix" value="Skip" style="margin-top:10px;">';
            $html .= '</div>';
            $html .= '</div>';
        }
        // $html .= '<hr>';
        $html .= '<div id="hidden_form">';

        $html .= '</div>';
        $html .= '<input type="submit" id="pmsafe_next" value="Next">';
        $html .= '</form>';
        $html .= '<div id="dialog" style="display:none;">';
        $html .= '<h2>Upgrade Membership ?<h2>';
        $html .= '<input type="button" value="Yes" id="dialog_upgrade"/>';
        $html .= '<input type="button" value="No" id="dialog_upgrade_no" style="margin-left:10px;"/>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }


    /**
     * perma_warranty_cardview shortcode
     *
     * @return string
     */
    public function perma_warranty_cardview_function()
    {


        $user_id = get_current_user_id();

        $vehicle_information = get_the_author_meta('pmsafe_vehicle_info', $user_id);

        $html = '';
        $html .= '<div id="easyPaginate">';
        foreach ($vehicle_information as $key => $value) {

            $html .= '<div class="card-wrap">';

            $html .= '<h4>Member Numbmer</h4>';
            $html .= '<p class="member_number">' . $value['pmsafe_member_number'] . '</p>';
            $html .= '<span>' . $value['pmsafe_vehicle_year'] . '</span>';
            $html .= '<span>' . $value['pmsafe_vehicle_make'] . '</span>';
            $html .= '<span>' . $value['pmsafe_vehicle_model'] . '</span>';
            $html .= '<a target="_blank" href="' . get_site_url() . '/perma-warranty/?membercode=' . $value['pmsafe_member_number'] . '" class="more-btn"><img src="' . get_site_url() . '/wp-content/uploads/2018/07/right-arrow.png" alt="arrow"/></a>';


            $html .= '</div>';
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * perma_salesperson shortcode
     *
     * @return string
     */
    public function perma_salesperson_function()
    {
        $html = '';
        $html .= '<div class="perma-salesperson" id="perma-salesperson">';
        $html .= '<div id="pmsafe-response"></div>';
        $html .= '<form name="perma_salesperson" id="perma_salesperson_form" method="POST">';
        $html .= '<div>';
        $html .= '<label>Warranty Registration Number';
        $html .= '<input type="text" name="member_number" id="member_number" />';
        $html .= '</label>';
        $html .= '</div>';

        $html .= '<hr>';

        $html .= '<h3>Customer Contact Information</h3>';
        $html .= '<div class="content-column one_half">';
        $html .= '<label>First Name';
        $html .= '<input type="text" name="first_name" id="first_name" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_half last_column">';
        $html .= '<label>Last Name';
        $html .= '<input type="text" name="last_name" id="last_name" />';
        $html .= '</label>';
        $html .= '</div>';

        $html .= '<div class="clear_column"></div>';

        $html .= '<div class="content-column">';
        $html .= '<label>Address';
        $html .= '<input type="text" name="address1" id="address1" placeholder="Address line 1" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column">';
        $html .= '<input type="text" name="address2" id="address2" placeholder="Address line 2" />';
        $html .= '</div>';
        $html .= '<div class="content-column one_third">';
        $html .= '<label>City';
        $html .= '<input type="text" name="city" id="city" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_third">';
        $html .= '<label>State';
        $html .= '<input type="text" name="state" id="state" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_third last_column">';
        $html .= '<label>Zip Code';
        $html .= '<input type="text" name="zip_code" id="zip_code" />';
        $html .= '</label>';
        $html .= '</div>';

        $html .= '<div class="clear_column"></div>';

        $html .= '<div class="content-column one_half">';
        $html .= '<label>Phone Number <span style="font-size:small; color: #676767!important">(No "Dashes." Example: 3334445555)</span>';
        $html .= '<input type="text" name="phone_number" id="phone_number" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_half last_column">';
        $html .= '<label>Email';
        $html .= '<input type="text" name="email" id="email" />';
        $html .= '<p style="font-size:x-small; color: #676767">Note: An accurate email address is required to deliver and receive benefit information.</p>';
        $html .= '</label>';
        $html .= '</div>';

        $html .= '<div class="clear_column"></div>';
        $html .= '<hr>';

        $html .= '<h3>Vehicle Information</h3>';
        $html .= '<div class="content-column one_third">';
        $html .= '<label>Vehicle Year';
        $html .= '<input type="text" name="vehicle_year" id="vehicle_year" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_third">';
        $html .= '<label>Vehicle Make';
        $html .= '<input type="text" name="vehicle_make" id="vehicle_make" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_third last_column">';
        $html .= '<label>Vehicle Model';
        $html .= '<input type="text" name="vehicle_model" id="vehicle_model" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_half">';
        $html .= '<label>VIN';
        $html .= '<input type="text" name="vin" id="vin" />';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '<div class="content-column one_half last_column">';
        $html .= '<label>Vehicle Mileage';
        $html .= '<input type="text" name="vehicle_mileage" id="vehicle_mileage" />';
        $html .= '</label>';
        $html .= '</div>';

        $html .= '<div class="clear_column"></div>';
        $html .= '<hr>';

        $html .= '<h3>Electronic Consent</h3>';
        $html .= '<p>By electronically signing below, I hereby certify the above information to be true and correct to the best of my knowledge. I further certify that my electronic signature shall have the same legal effect as an originally signed document under applicable Federal and Florida electronic signature laws. </p>';
        $html .= '<p>Any person who knowingly files a statement of claim containing any false or misleading information is subject to criminal and civil penalties. </p>';

        $html .= '<input type="submit" id="pmsafe_sales_person_submit" value="Send">';
        $html .= '</form>';
        $html .= '</div>';
        return $html;
    }

    /**
     * edit user register ajax funcion
     */
    public function pmsafe_user_info_form_function()
    {
        session_start();
        $user_id = get_current_user_id();
        $new_password = $_POST['nisl_password'];
        if ($new_password != '') {
            wp_set_password($new_password, $user_id);
            $is_pass_set = get_user_meta($user_id, 'is_pass_reset', true);
            if ($is_pass_set != 1) {
                update_user_meta($user_id, 'is_pass_reset', 1);
            }
            $change_password = 1;
            $url = get_site_url();
            $response = array('status' => true, 'change_password' => $change_password, 'redirect' => $url);
        } else {
            $change_password = 0;
            $response = array('status' => true, 'change_password' => $change_password);
        }


        $name = $_POST['nisl_name'];


        $names = explode(" ", $name);

        update_user_meta($user_id, 'edit_first_name', $names[0]);
        update_user_meta($user_id, 'edit_last_name', $names[1]);

        $address = $_POST['nisl_address'];
        $addresses = explode(",", $address);

        update_user_meta($user_id, 'edit_pmsafe_address_1', $addresses[0]);
        update_user_meta($user_id, 'edit_pmsafe_address_2', $addresses[1]);

        $state = $_POST['nisl_state'];
        $states = explode(" ", $state);
        update_user_meta($user_id, 'edit_pmsafe_city', $states[0]);
        update_user_meta($user_id, 'edit_pmsafe_state', $states[1]);
        update_user_meta($user_id, 'edit_pmsafe_zip_code', $states[2]);

        $phone = $_POST['nisl_phone'];
        update_user_meta($user_id, 'edit_pmsafe_phone_number', $phone);

        // $url = get_site_url() . '/my-account/';
        // $response = array('status' => true, 'redirect' => $url);
        echo json_encode($response);
        die;
    }

    /**
     * edit dealer info ajax funcion
     */
    public function perma_dealer_distributor_info_form_function()
    {
        session_start();
        $user_id = get_current_user_id();
        $role = $_POST['user_role'];
        $new_password = $_POST['nisl_password'];
        $email = $_POST['nisl_mail'];
        if ($new_password != '') {
            wp_set_password($new_password, $user_id);
            $change_password = 1;
            $url = get_site_url();
            $response = array('status' => true, 'change_password' => $change_password, 'redirect' => $url);
        } else {
            $change_password = 0;
            $response = array('status' => true, 'change_password' => $change_password);
        }

        wp_update_user(array('ID' => $user_id, 'user_email' => $email));

        if ($role == 'contributor') {
            update_user_meta($user_id, 'dealer_name', $_POST['nisl_name']);
            update_user_meta($user_id, 'dealer_store_address', $_POST['nisl_address']);
            update_user_meta($user_id, 'dealer_phone_number', $_POST['nisl_phone']);
            update_user_meta($user_id, 'dealer_fax_number', $_POST['nisl_fax']);
        }
        if ($role == 'author') {
            update_user_meta($user_id, 'distributor_name', $_POST['nisl_name']);
            update_user_meta($user_id, 'distributor_store_address', $_POST['nisl_address']);
            update_user_meta($user_id, 'distributor_phone_number', $_POST['nisl_phone']);
            update_user_meta($user_id, 'distributor_fax_number', $_POST['nisl_fax']);
        }



        echo json_encode($response);
        die;
    }

    /**
     * edit dealer user info ajax funcion
     */
    public function perma_contact_user_info_form_function()
    {
        session_start();
        $user_id = get_current_user_id();
        $role = $_POST['user_role'];
        $new_password = $_POST['nisl_password'];
        $email = $_POST['nisl_mail'];
        if ($new_password != '') {
            wp_set_password($new_password, $user_id);
            $get_is_popup = get_user_meta($user_id, 'is_popup', true);
            if ($get_is_popup != 1) {
                update_user_meta($user_id, 'is_popup', 1);
            }
            $change_password = 1;
            $url = get_site_url();
            $response = array('status' => true, 'change_password' => $change_password, 'redirect' => $url);
        } else {
            $change_password = 0;
            $response = array('status' => true, 'change_password' => $change_password);
        }

        wp_update_user(array('ID' => $user_id, 'user_email' => $email));
        if ($role == 'dealer-user') {
            update_user_meta($user_id, 'contact_fname', $_POST['nisl_fname']);
            update_user_meta($user_id, 'contact_lname', $_POST['nisl_lname']);
            update_user_meta($user_id, 'contact_phone', $_POST['nisl_phone']);
        }
        if ($role == 'distributor-user') {
            update_user_meta($user_id, 'distributor_contact_fname', $_POST['nisl_fname']);
            update_user_meta($user_id, 'distributor_contact_lname', $_POST['nisl_lname']);
            update_user_meta($user_id, 'distributor_contact_phone', $_POST['nisl_phone']);
        }


        echo json_encode($response);

        die;
    }
    /**
     * ajax function - sent response on button next click during registration.
     *
     */
    public function pmsafe_registration_code_form_function()
    {
        $member_code = $_POST['member_number'];
        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
        $is_active = get_post_meta($member_code_postid,'code_active_inactive',true);
        if($is_active == 1){
            global $wpdb;
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;

            if ($role['dealer-user'] == 1) {
                $dealer_user_login = $current_user->user_login;
                $user = get_user_by('login', $dealer_user_login);
                $contact_id = $user->ID;
                $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $dealer_user = get_user_by('id', $dealer_id);
                $login = $dealer_user->user_login;
            } else if ($role['distributor-user'] == 1) {
                $distributor_user_login = $current_user->user_login;
                $user = get_user_by('login', $distributor_user_login);
                $contact_id = $user->ID;
                $distributor_id = get_user_meta($contact_id, 'contact_distributor_id', true);
                $distributor_user = get_user_by('id', $distributor_id);
                $login = $distributor_user->user_login;
            } else {
                $login = $current_user->user_login;
            }
            if ($member_code === '00000' || $member_code === '0000' || $member_code === '000' || $member_code === '00' || $member_code === '0') {

                if ($role['contributor'] == 1 || $role['author'] == 1 || $role['dealer-user'] == 1  || $role['distributor-user'] == 1) {

                    $benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
                    array_splice($benefit_prefix, 12, 1);
                    sort($benefit_prefix);
                    $html .= '<div id="salesperson_benefits_package_div">';
                    $html .= '<div class="content-column one_half">';
                    $html .= '<label>Upgradable Packages: ';
                    $html .= '<select id="salesperson_benefits_package">';
                    foreach ($benefit_prefix as $prefix) {
                        $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                        $post = get_post($pid);
                        $post_title = $post->post_title;
                        $html .= '<option value="' . $prefix . '">' . $post_title . '</option>';
                    }
                    $html .= '</select>';
                    $html .= '</label>';
                    $html .= '<input type="button" id="salesperson_update_prefix" value="Update" style="margin-top:10px;">';
                    $html .= '</div>';
                    $html .= '</div>';
                }

                $response = array('status' => true, 'code' => $member_code, 'html' => $html);
                echo json_encode($response);
            } else {
                if ($role['author'] == 1) {
                    $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "' . $login . '"))))');
                    $str = '';
                    foreach ($user_query as $value_query) {
                        $str = $value_query->meta_value . ',' . $str;
                    }

                    $str = rtrim($str, ",");
                    // echo $str;
                    $str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in (' . $str . ') ');
                    // pr($str_results);
                    $check_array = array();
                    foreach ($str_results as $str_result) {
                        $check_array[] = $str_result->meta_value;
                    }
                    // pr($check_array);
                    // die;
                    if (in_array($member_code, $check_array)) {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
                        $bulk_id = get_post_meta($member_code_postid, '_pmsafe_bulk_invitation_id', true);
                        $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
                        $upgradable_prefix_str = get_post_meta($bulk_id, 'upgradable_prefix', true);
                        $upgradable_prefix = explode(",", $upgradable_prefix_str);
                        $is_upgradable = get_post_meta($bulk_id, 'pmsafe_invitation_code_upgradable', true);
                        sort($upgradable_prefix);
                        foreach ($upgradable_prefix as $prefix) {
                            $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                            $post = get_post($pid);
                            $post_title = $post->post_title;
                            $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                        }
                        if ($member_code_id) {
                            // $response = array('status' => true,'code'=>$member_code);
                            $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_postid);
                            echo json_encode($response);
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    } else {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        // $invite_code_dealer = get_post_meta($member_code_id,'_pmsafe_dealer',true);
                        $invite_code_distributor = get_post_meta($member_code_id, '_pmsafe_distributor', true);
                        if ($invite_code_distributor == $login) {
                            $package = get_post_meta($member_code_id, '_pmsafe_code_prefix', true);
                            $upgradable_prefix_str = get_post_meta($member_code_id, 'upgradable_prefix', true);
                            $upgradable_prefix = explode(",", $upgradable_prefix_str);
                            $is_upgradable = get_post_meta($member_code_id, 'pmsafe_invitation_code_upgradable', true);
                            sort($upgradable_prefix);
                            foreach ($upgradable_prefix as $prefix) {
                                $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                $post = get_post($pid);
                                $post_title = $post->post_title;
                                $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                            }
                            if ($member_code_id) {

                                $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_id);

                                echo json_encode($response);
                            } else {
                                $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                                echo json_encode($response);
                            }
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is other distributor\'s code. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    }
                } else if ($role['distributor-user'] == 1) {
                    $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value in ( SELECT user_login FROM `wp_users` WHERE ID in (SELECT user_id FROM `wp_usermeta` WHERE meta_key="dealer_distributor_name" AND meta_value = (SELECT ID FROM `wp_users` WHERE user_login = "' . $login . '"))))');
                    $str = '';
                    foreach ($user_query as $value_query) {
                        $str = $value_query->meta_value . ',' . $str;
                    }

                    $str = rtrim($str, ",");
                    // echo $str;
                    $str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in (' . $str . ') ');
                    // pr($str_results);
                    $check_array = array();
                    foreach ($str_results as $str_result) {
                        $check_array[] = $str_result->meta_value;
                    }
                    // pr($check_array);
                    // die;
                    if (in_array($member_code, $check_array)) {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
                        $bulk_id = get_post_meta($member_code_postid, '_pmsafe_bulk_invitation_id', true);
                        $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
                        $upgradable_prefix_str = get_post_meta($bulk_id, 'upgradable_prefix', true);
                        $upgradable_prefix = explode(",", $upgradable_prefix_str);
                        $is_upgradable = get_post_meta($bulk_id, 'pmsafe_invitation_code_upgradable', true);
                        sort($upgradable_prefix);
                        foreach ($upgradable_prefix as $prefix) {
                            $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                            $post = get_post($pid);
                            $post_title = $post->post_title;
                            $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                        }
                        if ($member_code_id) {
                            // $response = array('status' => true,'code'=>$member_code);
                            $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_postid);
                            echo json_encode($response);
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    } else {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        // $invite_code_dealer = get_post_meta($member_code_id,'_pmsafe_dealer',true);
                        $invite_code_distributor = get_post_meta($member_code_id, '_pmsafe_distributor', true);
                        if ($invite_code_distributor == $login) {
                            $package = get_post_meta($member_code_id, '_pmsafe_code_prefix', true);
                            $upgradable_prefix_str = get_post_meta($member_code_id, 'upgradable_prefix', true);
                            $upgradable_prefix = explode(",", $upgradable_prefix_str);
                            $is_upgradable = get_post_meta($member_code_id, 'pmsafe_invitation_code_upgradable', true);
                            sort($upgradable_prefix);
                            foreach ($upgradable_prefix as $prefix) {
                                $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                $post = get_post($pid);
                                $post_title = $post->post_title;
                                $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                            }
                            if ($member_code_id) {

                                $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_id);

                                echo json_encode($response);
                            } else {
                                $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                                echo json_encode($response);
                            }
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is other distributor\'s code. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    }
                } else if ($role['contributor'] == 1) {
                    $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "' . $login . '")');
                    $str = '';
                    foreach ($user_query as $value_query) {
                        $str = $value_query->meta_value . ',' . $str;
                    }

                    $str = rtrim($str, ",");
                    // echo $str;
                    $str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in (' . $str . ') ');
                    // pr($str_results);
                    $check_array = array();
                    foreach ($str_results as $str_result) {
                        $check_array[] = $str_result->meta_value;
                    }
                    // pr($check_array);
                    // die;
                    if (in_array($member_code, $check_array)) {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
                        $bulk_id = get_post_meta($member_code_postid, '_pmsafe_bulk_invitation_id', true);
                        $package = get_post_meta($member_code_id, '_pmsafe_code_prefix', true);
                        $upgradable_prefix_str = get_post_meta($bulk_id, 'upgradable_prefix', true);
                        $upgradable_prefix = explode(",", $upgradable_prefix_str);
                        $is_upgradable = get_post_meta($bulk_id, 'pmsafe_invitation_code_upgradable', true);
                        sort($upgradable_prefix);
                        foreach ($upgradable_prefix as $prefix) {
                            $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                            $post = get_post($pid);
                            $post_title = $post->post_title;
                            $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                        }
                        if ($member_code_id) {

                            $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_postid);

                            echo json_encode($response);
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    } else {

                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $invite_code_dealer = get_post_meta($member_code_id, '_pmsafe_dealer', true);
                        if ($invite_code_dealer == $login) {
                            $package = get_post_meta($member_code_id, '_pmsafe_code_prefix', true);
                            $upgradable_prefix_str = get_post_meta($member_code_id, 'upgradable_prefix', true);
                            $upgradable_prefix = explode(",", $upgradable_prefix_str);
                            $is_upgradable = get_post_meta($member_code_id, 'pmsafe_invitation_code_upgradable', true);
                            sort($upgradable_prefix);
                            foreach ($upgradable_prefix as $prefix) {
                                $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                $post = get_post($pid);
                                $post_title = $post->post_title;
                                $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                            }
                            if ($member_code_id) {

                                $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_id);

                                echo json_encode($response);
                            } else {
                                $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                                echo json_encode($response);
                            }
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is other dealer\'s code. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    }
                } else if ($role['dealer-user'] == 1) {
                    $user_query = $wpdb->get_results('SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_ids" and post_id in( SELECT wp.ID FROM wp_posts wp , wp_postmeta wm WHERE wp.ID = wm.post_id and wp.post_status = "publish" and wm.meta_key = "_pmsafe_dealer" and wm.meta_value = "' . $login . '")');
                    $str = '';
                    foreach ($user_query as $value_query) {
                        $str = $value_query->meta_value . ',' . $str;
                    }

                    $str = rtrim($str, ",");
                    // echo $str;
                    $str_results = $wpdb->get_results(' SELECT meta_value FROM wp_postmeta WHERE meta_key = "_pmsafe_invitation_code" and post_id in (' . $str . ') ');
                    // pr($str_results);
                    $check_array = array();
                    foreach ($str_results as $str_result) {
                        $check_array[] = $str_result->meta_value;
                    }
                    // pr($check_array);
                    // die;
                    if (in_array($member_code, $check_array)) {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
                        $bulk_id = get_post_meta($member_code_postid, '_pmsafe_bulk_invitation_id', true);
                        $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
                        $upgradable_prefix_str = get_post_meta($bulk_id, 'upgradable_prefix', true);
                        $upgradable_prefix = explode(",", $upgradable_prefix_str);
                        $is_upgradable = get_post_meta($bulk_id, 'pmsafe_invitation_code_upgradable', true);
                        sort($upgradable_prefix);
                        foreach ($upgradable_prefix as $prefix) {
                            $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                            $post = get_post($pid);
                            $post_title = $post->post_title;
                            $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                        }
                        if ($member_code_id) {
                            $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_postid);
                            echo json_encode($response);
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    } else {
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $invite_code_dealer = get_post_meta($member_code_id, '_pmsafe_dealer', true);
                        if ($invite_code_dealer == $login) {
                            $package = get_post_meta($member_code_id, '_pmsafe_code_prefix', true);
                            $upgradable_prefix_str = get_post_meta($member_code_id, 'upgradable_prefix', true);
                            $upgradable_prefix = explode(",", $upgradable_prefix_str);
                            $is_upgradable = get_post_meta($member_code_id, 'pmsafe_invitation_code_upgradable', true);
                            sort($upgradable_prefix);
                            foreach ($upgradable_prefix as $prefix) {
                                $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                                $post = get_post($pid);
                                $post_title = $post->post_title;
                                $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                            }
                            if ($member_code_id) {

                                $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_id);

                                echo json_encode($response);
                            } else {
                                $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                                echo json_encode($response);
                            }
                        } else {
                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is other dealer\'s code. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    }
                } else if ($role['administrator'] == 1) {
                    $member_code_id = pmsafe_if_code_exist($member_code);
                    $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $member_code);
                    $bulk_id = get_post_meta($member_code_postid, '_pmsafe_bulk_invitation_id', true);
                    $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
                    $upgradable_prefix_str = get_post_meta($bulk_id, 'upgradable_prefix', true);
                    $upgradable_prefix = explode(",", $upgradable_prefix_str);
                    $is_upgradable = get_post_meta($bulk_id, 'pmsafe_invitation_code_upgradable', true);
                    sort($upgradable_prefix);
                    foreach ($upgradable_prefix as $prefix) {
                        $pid = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix',$prefix);
                        $post = get_post($pid);
                        $post_title = $post->post_title;
                        $option[] = '<option value="' . $prefix . '">' . $post_title . '</option>';
                    }
                    if ($member_code_id) {
                        $response = array('status' => true, 'code' => $member_code, 'option' => $option, 'is_upgradable' => $is_upgradable, 'package' => $package, 'code_id' => $member_code_postid);
                        echo json_encode($response);
                    } else {

                        $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                        echo json_encode($response);
                    }
                } else {

                    $member_code_id = pmsafe_if_code_exist($member_code);
                    $bulk_id =  get_post_meta($member_code_id, '_pmsafe_bulk_invitation_id', true);
                    $is_allow_dealer = get_post_meta($bulk_id, 'pmsafe_code_allow_dealer', true);
                    $invitation_prefix = get_post_meta($bulk_id, '_pmsafe_invitation_prefix', true);
                    $package_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $invitation_prefix);
                    $no_coverage = get_post_meta($package_id, '_pmsafe_no_coverage_benefit', true);
                    if ($no_coverage == 1) {
                        $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong> This Registration Number does not come with a Warranty and does not require registration. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                        echo json_encode($response);
                    } else if ($is_allow_dealer == 1) {
                        $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong> You do not have permission to register this code. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                        echo json_encode($response);
                    } else {
                        if ($member_code_id) {
                            $response = array('status' => true, 'code' => $member_code);
                            echo json_encode($response);
                        } else {

                            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                            echo json_encode($response);
                        }
                    }
                }
            }
        }else{
            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not Active. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
            echo json_encode($response);
        }
        die;
    }

    public function add_login_session()
    {
        $id = $_POST['id'];
        session_start();
        $_SESSION['dealer_login'] = $id;;

        die;
    }
    /**
     * shortcode upgradable_membership_info
     */
    public function upgradable_membership_info_function()
    {

        if (is_user_logged_in()) {

            global $wpdb;
            session_start();
            $id = get_current_user_id();
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            $login = $current_user->user_login;
            $dealer = $_SESSION['dealer_login'];


            if ($dealer) {
                $dealer_array = get_code_by_dealer_login($dealer);
            } else {

                if ($role['contributor'] == 1) {

                    $dealer_array = get_code_by_dealer_login($login);
                }
                if ($role['dealer-user'] == 1) {
                    $dealer_user_login = $current_user->user_login;
                    $user = get_user_by('login', $dealer_user_login);
                    $contact_id = $user->ID;
                    $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                    $dealer_user = get_user_by('id', $dealer_id);
                    $dealer_username = $dealer_user->user_login;

                    $dealer_array = get_code_by_dealer_login($dealer_username);
                }
            }

            $html = '';
            $membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');

            $html .= '<div class="filter-wrap">';
            // $html .= '<input type="hidden" id="membership_login_id" value="'.$login.'">';
            $html .= '<div class="input-filter-wrap">';
            $html .= '<label>Date: </label><input type="text" id="membership_datepicker1" style="width:auto;"> <input type="text" id="membership_datepicker2" style="width:auto;">';
            $html .= '</div>';
            $html .= '<div class="select-filter-wrap" style="margin-right: 10px;">';
            $html .= '<select id="policy">';
            $html .= '<option value="">Select Policy</option>';
            $html .= '<option value="upgraded">Upgraded Policy</option>';
            $html .= '<option value="original">Original Policy</option>';
            $html .= '</select>';
            $html .= '</div>';

            $html .= '<div class="select-filter-wrap filter-package" style="display:none;">';
            $benefit_prefix = pmsafe_get_meta_values('_pmsafe_benefit_prefix', 'pmsafe_benefits', 'publish');
            $html .= '<select id="benefit_packages">';
            $html .= '<option value="">Select Package</option>';
            foreach ($benefit_prefix as $prefix) {
                $html .= '<option value="' . $prefix . '">' . $prefix . '</option>';
            }
            $html .= '</select>';
            $html .= '</div>';

            if ($dealer) {
                $html .= '<input type="hidden" value="' . $dealer . '" id="view_membership">';
            }

            $html .= '<div class="btn-filter-wrap" style="margin-left: 10px;">';
            $html .= '<input type="button" id="membership_date_submit" value="Submit"/>';
            $html .= '</div>';
            $html .= '<div><input type="button" name="reset" id="search_reset" value="Reset" style="padding: 10px 70px;background: #ddd;border: 0;color: #333;cursor: pointer;margin-left: 10px;"/></div>';
            $html .= '</div>';
            $html .= '<div class="membership-result-wrap">';

            $html .= '<table id="mebership_info_table" class="display nowrap" style="width:100%">';
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

            $html .= '<th>';
            $html .= 'Date';
            $html .= '</th>';

            $html .= '<th>';
            $html .= 'Customer Name';
            $html .= '</th>';


            $html .= '</tr>';
            $html .= '</thead>';

            $html .= '<tbody id="">';
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
                    $contact_fname = get_user_meta($upgraded_id, 'contact_fname', true);
                    $distributor_contact_fname = get_user_meta($upgraded_id, 'distributor_contact_fname', true);
                    $admin_name = get_user_meta($upgraded_id, 'first_name', true);
                    $users = get_user_by('login', $code);
                    $user_id = $users->ID;
                    $fname = get_user_meta($user_id, 'first_name', true);
                    $lname = get_user_meta($user_id, 'last_name', true);
                    if (in_array($code, $dealer_array)) {
                        $html .= '<tr>';

                        $html .= '<td>';
                        $html .= get_post_meta($post_id, '_pmsafe_invitation_code', true);
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= $bulk_prefix;
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= get_post_meta($post_id, '_pmsafe_code_prefix', true);
                        $html .= '</td>';

                        $html .= '<td>';
                        if ($dealer_name) {
                            $html .= $dealer_name;
                        }
                        if ($distributor_name) {
                            $html .= $distributor_name;
                        }
                        if ($contact_fname) {
                            $html .= $contact_fname;
                        }
                        if ($distributor_contact_fname) {
                            $html .= $distributor_contact_fname;
                        }
                        if ($admin_name) {
                            $html .= $admin_name;
                        }
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= get_post_meta($post_id, 'upgraded_date', true);
                        $html .= '</td>';

                        $html .= '<td>';
                        $html .= $fname . ' ' . $lname;
                        $html .= '</td>';

                        $html .= '</tr>';
                    }
                }
            }
            $html .= '</tbody>';
            $html .= '</table>';
            $html .= '</div>';
        } else {

            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }

        return $html;
    }

    /**
     * ajax function for upgrade membership date filtering.
     */
    public function membership_date_filter()
    {
        global $wpdb;
        $datepicker1 = $_POST['datepicker1'];
        $datepicker2 = $_POST['datepicker2'];
        $policy = $_POST['policy'];
        $package = $_POST['package'];

        $view_membership = $_POST['view_membership'];
        if (isset($view_membership)) {

            $dealer_array = get_code_by_dealer_login($view_membership);
        } else {
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            $login = $current_user->user_login;

            if ($role['contributor'] == 1) {

                $dealer_array = get_code_by_dealer_login($login);
            }
            if ($role['dealer-user'] == 1) {
                $dealer_user_login = $current_user->user_login;
                $user = get_user_by('login', $dealer_user_login);
                $contact_id = $user->ID;
                $dealer_id = get_user_meta($contact_id, 'contact_dealer_id', true);
                $dealer_user = get_user_by('id', $dealer_id);
                $dealer_username = $dealer_user->user_login;

                $dealer_array = get_code_by_dealer_login($dealer_username);
            }
        }

        $setStart = ($datepicker1 == '' || !isset($datepicker1)) ? false : true;
        $setExpire = ($datepicker2 == '' || !isset($datepicker2)) ? false : true;

        $membership_results = $wpdb->get_results('SELECT post_id FROM wp_postmeta WHERE meta_key = "is_upgraded" and meta_value ="1"');

        foreach ($membership_results as $str) {
            $post_id = $str->post_id;
            $code_status = get_post_meta($post_id, '_pmsafe_code_status', true);
            if ($code_status == 'used') {
                $upgraded_date = get_post_meta($post_id, 'upgraded_date', true);
                $bulk_id = get_post_meta($post_id, '_pmsafe_bulk_invitation_id', true);

                $bulk_prefix = get_post_meta($post_id, '_pmsafe_invitation_prefix', true);
                $code = get_post_meta($post_id, '_pmsafe_invitation_code', true);
                $upgraded_id = get_post_meta($post_id, 'upgraded_by', true);
                $dealer_name = get_user_meta($upgraded_id, 'dealer_name', true);
                $distributor_name = get_user_meta($upgraded_id, 'distributor_name', true);
                $contact_fname = get_user_meta($upgraded_id, 'contact_fname', true);
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
                if ($dealer_name) {
                    $upgraded_by = $dealer_name;
                }
                if ($distributor_name) {
                    $upgraded_by = $distributor_name;
                }
                if ($contact_fname) {
                    $upgraded_by = $contact_fname;
                }
                if ($distributor_contact_fname) {
                    $upgraded_by = $distributor_contact_fname;
                }
                if ($admin_name) {
                    $upgraded_by = $admin_name;
                }
                $name = $fname . ' ' . $lname;
                if (!$setStart)
                    $datepicker1 = $upgraded_date;

                if (!$setExpire)
                    $datepicker2 = $upgraded_date;

                if ($upgraded_date >= $datepicker1 && $upgraded_date <= $datepicker2) {

                    if (in_array($code, $dealer_array)) {

                        if ($policy == "upgraded") {

                            if ($code_prefix == $package) {
                                $data[] = array(
                                    'registration_number' => $code,
                                    'original_policy' => $bulk_prefix,
                                    'upgraded_policy' => $code_prefix,
                                    'upgraded_by' => $upgraded_by,
                                    'upgraded_date' => $upgraded_date,
                                    'customer_name' => $name,
                                    'dealer_cost' => $dealer_cost,
                                    'distributor_cost' => $distributor_cost
                                );
                            }
                        } else if ($policy == "original") {
                            if ($bulk_prefix == $package) {
                                $data[] = array(
                                    'registration_number' => $code,
                                    'original_policy' => $bulk_prefix,
                                    'upgraded_policy' => $code_prefix,
                                    'upgraded_by' => $upgraded_by,
                                    'upgraded_date' => $upgraded_date,
                                    'customer_name' => $name,
                                    'dealer_cost' => $dealer_cost,
                                    'distributor_cost' => $distributor_cost
                                );
                            }
                        } else {

                            $data[] = array(
                                'registration_number' => $code,
                                'original_policy' => $bulk_prefix,
                                'upgraded_policy' => $code_prefix,
                                'upgraded_by' => $upgraded_by,
                                'upgraded_date' => $upgraded_date,
                                'customer_name' => $name,
                                'dealer_cost' => $dealer_cost,
                                'distributor_cost' => $distributor_cost
                            );
                        }
                    }
                }
            }
        }
        echo '<table id="mebership_date_table" class="display nowrap" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>';
        echo 'Registration Number';
        echo '</th>';

        echo '<th>';
        echo 'Original Policy';
        echo '</th>';

        echo '<th>';
        echo 'Upgraded Policy';
        echo '</th>';

        echo '<th>';
        echo 'Upgraded By';
        echo '</th>';

        echo '<th>';
        echo 'Date';
        echo '</th>';

        echo '<th>';
        echo 'Customer Name';
        echo '</th>';

        echo '</tr>';
        echo '</thead>';

        echo '<tbody id="">';
        foreach ($data as $result) {
            echo '<tr>';

            echo '<td>';
            echo $result['registration_number'];
            echo '</td>';

            echo '<td>';
            echo $result['original_policy'];
            echo '</td>';

            echo '<td>';
            echo $result['upgraded_policy'];
            echo '</td>';

            echo '<td>';
            echo $result['upgraded_by'];
            echo '</td>';

            echo '<td>';
            echo $result['upgraded_date'];
            echo '</td>';

            echo '<td>';
            echo $result['customer_name'];
            echo '</td>';

            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';


        die;
    }

    /**
     * Ajax function for get price for upgradable package.
     *
     */
    public function get_benefit_package_price()
    {
        $package = $_POST['package'];
        $code_id = $_POST['code_id'];
        $dealer_login = get_post_meta($code_id, '_pmsafe_dealer', true);
        $user = get_user_by('login', $dealer_login);
        $dealer_id = $user->ID;

        $price_arr = get_user_meta($dealer_id, 'pricing_package', true);
        $selling_price = $price_arr[$package]['selling_price'];
        $html = '';
        $html .= '<div id="update_package_price">';
        if ($selling_price != '') {
            $value = "Update";
        } else {
            $value = "Add";
        }
        $html .= '<h3>Please Enter The Retail Selling Price (Cost to Customer):</h3>';
        $html .= '<input type="hidden" value="' . $package . '" id="get_package">';
        $html .= '<input type="hidden" value="' . $code_id . '" id="get_code_id">';
        $html .= '<div class="content-column one_half">';
        $html .= '<label>Selling Price($) : <input type="number" name="selling_price" id="selling_price" min="1" value="' . $selling_price . '"/></label>';
        $html .= '</div>';
        $html .= '<input type="button" id="pmsafe_update_price" value="' . $value . '" style="margin-top:10px;clear:both;float:left;">';
        $html .= '<input type="button" id="pmsafe_skip_price" value="Skip" style="margin-top:10px;margin-left:10px;float:left;">';
        /* }else{
            $html .= '<h3>Admin hasn\'t assigned selling price yet for benefit package: '.$package.'</h3>';
            $html .= '<input type="button" id="pmsafe_skip_price" value="Skip" style="margin-top:10px;float:left;">';
        } */
        $html .= '</div>';
        echo $html;
        die;
    }

    public function check_no_coverage_policy()
    {
        $package = $_POST['package'];
        $code_id = $_POST['code_id'];
        $bulk_id = get_post_meta($code_id, '_pmsafe_bulk_invitation_id', true);
        $html = '';
        if ($bulk_id) {
            $invitation_prefix = get_post_meta($bulk_id, '_pmsafe_invitation_prefix', true);
            $package_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $invitation_prefix);
            $no_coverage = get_post_meta($package_id, '_pmsafe_no_coverage_benefit', true);
        } else {
            $invitation_prefix = get_post_meta($code_id, '_pmsafe_code_prefix', true);
            $package_id = get_post_id_by_meta_key_and_value('_pmsafe_benefit_prefix', $invitation_prefix);
            $no_coverage = get_post_meta($package_id, '_pmsafe_no_coverage_benefit', true);
        }
        if ($no_coverage == 1) {
            $html .= '<span style="color: #a94442;background-color: #f2dede;border-color: #f2dede;padding: 15px;margin-bottom: 20px;border: 1px solid transparent;border-radius: 4px;"><strong>Error!</strong>  No Product Warranty has been selected; Registration for your selection is not required. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>';
        } else {
            $html .= 1;
        }
        echo $html;
        die;
    }

    public function update_benefit_package_price()
    {
        $package = $_POST['package'];
        $code_id = $_POST['code_id'];
        $login_id = $_POST['login_id'];
        $dealer_login = get_post_meta($code_id, '_pmsafe_dealer', true);
        $user = get_user_by('login', $dealer_login);
        $dealer_id = $user->ID;
        $input_selling_price = $_POST['selling_price'];

        $get_price_arr = get_user_meta($dealer_id, 'pricing_package', true);
        $selling_price = $get_price_arr[$package]['selling_price'];
        if ($selling_price != $input_selling_price) {
            update_post_meta($code_id, 'updated_selling_price', $input_selling_price);
            update_post_meta($code_id, 'updated_selling_price_by', $login_id);
            $response = array('status' => true, 'msg' => 'Selling price is successfully updated for package ' . $package);
        } else {
            $response = array('status' => true);
        }

        echo json_encode($response);
        die;
    }

    public function update_benefit_package()
    {

        $select = $_POST['select'];
        $code = $_POST['code'];
        $login_id = $_POST['login_id'];
        $member_code_postid = get_post_id_by_meta_key_and_value('_pmsafe_invitation_code', $code);
        if ($select != '0') {
            $is_upgrade = 1;
            $update = update_post_meta($member_code_postid, '_pmsafe_code_prefix', $select);
            $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
            update_post_meta($member_code_postid, 'is_upgraded', $is_upgrade);
            update_post_meta($member_code_postid, 'upgraded_date', date('Y-m-d'));
            update_post_meta($member_code_postid, 'upgraded_by', $login_id);
            if (isset($update)) {
                $response = array('status' => true, 'msg' => 'package is successfully updated for code ' . $code, 'package' => $package, 'code_id' => $member_code_postid);
            }
        } else {
            $package = get_post_meta($member_code_postid, '_pmsafe_code_prefix', true);
            $response = array('status' => true, 'package' => $package, 'code_id' => $member_code_postid);
        }
        echo json_encode($response);
        die;
    }
    /**
     * Perma register ajax funcion
     */
    public function pmsafe_registration_form_function()
    {
        // session_start();

        global $wpdb;
        $current_user = wp_get_current_user();
        $role = (array) $current_user->caps;
        $login = $current_user->user_login;


        $member_code = $_POST['member_number'];
        if ($member_code === '00000' || $member_code === '0000' || $member_code === '000' || $member_code === '00' || $member_code === '0') {
            // echo 'in';die;
            $sales_person = array(
                'first_name'                        => $_POST['first_name'],
                'last_name'                         => $_POST['last_name'],
                'signature'                         => $_POST['signature'],
                'pmsafe_address_1'                  => $_POST['address1'],
                'pmsafe_address_2'                  => $_POST['address2'],
                'pmsafe_city'                       => $_POST['city'],
                'pmsafe_state'                      => $_POST['state'],
                'pmsafe_zip_code'                   => $_POST['zip_code'],
                'pmsafe_phone_number'               => $_POST['phone_number'],
                'pmsafe_email'                      => $_POST['email'],
                'pmsafe_registration_date'          => current_time('mysql'),
                'pmsafe_vehicle_year'               => $_POST['vehicle_year'],
                'pmsafe_vehicle_make'               => $_POST['vehicle_make'],
                'pmsafe_vehicle_model'              => $_POST['vehicle_model'],
                'pmsafe_vehicle_mileage'            => $_POST['vehicle_mileage'],
                'pmsafe_vin'                        => $_POST['vin'],
                'pmsafe_vehicle_type'               => $_POST['vehicle_type'],
                'pmsafe_warranty_registration'      => $member_code,
                'pmsafe_plan_id'                    => 'sales-person',
            );

            $pdf_link = sales_person_generate_pdf($sales_person);
            $warranty_card = pmsafe_sales_person_warranty_card($sales_person, $pdf_link);

            $to = $_POST['email'];
            $subject = 'PermaSafe: Your Registration Information';
            $password = $_POST['zip_code'];
            $fname = $_POST["first_name"];
            $member_code = $member_code;
            $process = 'customer_registration';
            send_mail_to_users($to, $password, $subject, $fname, $member_code, $process);

            $response = array('status' => true, 'sales' => true, 'html' => $warranty_card);
            echo json_encode($response);
        } else {

            $member_code_id = pmsafe_if_code_exist($member_code);
            // $password = wp_generate_password();
            $password = $_POST['zip_code'];

            if ($member_code_id) {


                $user_data = pmsafe_create_user($_POST['email'], $password, $member_code);
                if ($user_data) {
                    if ($user_data['user_type'] == "New") {
                        $_SESSION['first_userpwd'] = $password;
                        $user_id = $user_data['user_id'];
                        // $_SESSION['first_userid'] = $user_id;
                        update_post_meta($member_code_id, '_pmsafe_code_status', 'used');
                        update_post_meta($member_code_id, '_pmsafe_used_code_user_id', $user_id);
                        $name = $_POST['first_name'] . ' ' . $_POST['last_name'];
                        $_SESSION['registerd_username'] = $name;
                        update_post_meta($member_code_id, '_pmsafe_used_code_user_name', $name);
                        update_post_meta($member_code_id, '_pmsafe_used_code_date', current_time('mysql'));

                        update_user_meta($user_id, 'first_name', $_POST['first_name']);
                        update_user_meta($user_id, 'edit_first_name', $_POST['first_name']);
                        update_user_meta($user_id, 'last_name', $_POST['last_name']);
                        update_user_meta($user_id, 'edit_last_name', $_POST['last_name']);
                        //update_user_meta( $user_id, 'pmsafe_member_number', $_POST['member_number'] );
                        update_user_meta($user_id, 'pmsafe_phone_number', $_POST['phone_number']);
                        update_user_meta($user_id, 'edit_pmsafe_phone_number', $_POST['phone_number']);

                        update_user_meta($user_id, 'pmsafe_address_1', $_POST['address1']);
                        update_user_meta($user_id, 'edit_pmsafe_address_1', $_POST['address1']);

                        update_user_meta($user_id, 'pmsafe_address_2', $_POST['address2']);
                        update_user_meta($user_id, 'edit_pmsafe_address_2', $_POST['address2']);

                        update_user_meta($user_id, 'pmsafe_city', $_POST['city']);
                        update_user_meta($user_id, 'edit_pmsafe_city', $_POST['city']);

                        update_user_meta($user_id, 'pmsafe_state', $_POST['state']);
                        update_user_meta($user_id, 'edit_pmsafe_state', $_POST['state']);

                        update_user_meta($user_id, 'pmsafe_zip_code', $_POST['zip_code']);
                        update_user_meta($user_id, 'edit_pmsafe_zip_code', $_POST['zip_code']);
                        update_user_meta($user_id, 'pmsafe_email', $_POST['email']);
                        update_user_meta($user_id, 'pmsafe_signature', $_POST['signature']);

                        $vehicle_info = array();

                        $vehicle_info[$member_code] = array(
                            'pmsafe_vehicle_year' => $_POST['vehicle_year'],
                            'pmsafe_vehicle_make' => $_POST['vehicle_make'],
                            'pmsafe_vehicle_model' => $_POST['vehicle_model'],
                            'pmsafe_vin' => $_POST['vin'],
                            'pmsafe_vehicle_mileage' => $_POST['vehicle_mileage'],
                            'pmsafe_vehicle_type' => $_POST['vehicle_type'],
                            'pmsafe_registration_date' => current_time('mysql'),
                            'pmsafe_member_number' => $member_code,
                            'pmsafe_member_code_id' => $member_code_id

                        );
                        update_user_meta($user_id, 'pmsafe_vehicle_info', $vehicle_info);

                        $pdf_link = generate_pdf($user_id, $member_code);
                        update_post_meta($member_code_id, 'pmsafe_pdf_link', $pdf_link);

                        $vehicle_info_pdf = get_the_author_meta('pmsafe_vehicle_info', $user_id);
                        $vehicle_info_pdf[$member_code]['pmsafe_pdf_link'] = $pdf_link;
                        update_user_meta($user_id, 'pmsafe_vehicle_info', $vehicle_info_pdf);

                        if($login){
                            update_post_meta($member_code_id,'registered_by',$login);
                        }else{
                            update_post_meta($member_code_id,'registered_by',$member_code);
                        }
                        

                        $to = $_POST['email'];
                        $subject = 'PermaSafe: Your Registration Information';
                        $password = $password;
                        $fname = $_POST["first_name"];
                        $member_code = $member_code;
                        $process = 'customer_registration';
                        send_mail_to_users($to, $password, $subject, $fname, $member_code, $process);

                        if ($role['author'] == 1) {
                            $url = get_site_url() . '/distributor-account/';
                        } else if ($role['distributor-user'] == 1) {
                            $url = get_site_url() . '/distributor-account/';
                        } else if ($role['contributor'] == 1) {
                            $url = get_site_url() . '/dealer-account/';
                        } else if ($role['dealer-user'] == 1) {
                            $url = get_site_url() . '/dealer-account/';
                        } else if ($role['administrator'] == 1) {
                            $url = get_site_url() . '/perma-register/';
                        } else {

                            $creds = array();
                            $creds['user_login'] = $_POST['email'];
                            $creds['user_password'] = $password;
                            $creds['remember'] = true;
                            $user = wp_signon($creds, false);

                            wp_clear_auth_cookie();
                            do_action('wp_login', $user->ID);
                            wp_set_current_user($user->ID);
                            wp_set_auth_cookie($user->ID, true);
                            $url = get_site_url() . '/perma-warranty/';
                        }
                        $response = array('status' => true, 'redirect' => $url, 'code' => $member_code);
                        echo json_encode($response);
                    } elseif ($user_data['user_type'] == "Exist") {
                        $member_code = $_POST['member_number'];
                        $member_code_id = pmsafe_if_code_exist($member_code);
                        $password = $_POST['zip_code'];
                        if ($member_code_id) {

                            $email = $_POST['email'];
                            $old_email = $_POST['email'];

                            for ($i = 0; email_exists($email); $i++) {
                                $email = str_replace('@', "+ama{$i}@", $old_email);
                            }

                            if ($email !== $old_email) {
                                $hack_remapped_emails[$email] = $old_email;
                            }
                            $user_data = pmsafe_create_user($email, $password, $member_code);
                            if ($user_data) {
                                $user_id = $user_data['user_id'];
                                global $wpdb;
                                $wpdb->update(
                                    $wpdb->users,
                                    array('user_email' => $hack_remapped_emails[$email]),
                                    array('ID' => $user_id)
                                );
                                unset($hack_remapped_emails[$email]);
                                update_post_meta($member_code_id, '_pmsafe_code_status', 'used');
                                update_post_meta($member_code_id, '_pmsafe_used_code_user_id', $user_id);
                                $name = $_POST['first_name'] . ' ' . $_POST['last_name'];

                                update_post_meta($member_code_id, '_pmsafe_used_code_user_name', $name);
                                update_post_meta($member_code_id, '_pmsafe_used_code_date', current_time('mysql'));
                                update_user_meta($user_id, 'first_name', $_POST['first_name']);

                                update_user_meta($user_id, 'edit_first_name', $_POST['first_name']);
                                update_user_meta($user_id, 'last_name', $_POST['last_name']);
                                update_user_meta($user_id, 'edit_last_name', $_POST['last_name']);
                                //update_user_meta( $user_id, 'pmsafe_member_number', $_POST['member_number'] );
                                update_user_meta($user_id, 'pmsafe_phone_number', $_POST['phone_number']);
                                update_user_meta($user_id, 'edit_pmsafe_phone_number', $_POST['phone_number']);

                                update_user_meta($user_id, 'pmsafe_address_1', $_POST['address1']);
                                update_user_meta($user_id, 'edit_pmsafe_address_1', $_POST['address1']);

                                update_user_meta($user_id, 'pmsafe_address_2', $_POST['address2']);
                                update_user_meta($user_id, 'edit_pmsafe_address_2', $_POST['address2']);

                                update_user_meta($user_id, 'pmsafe_city', $_POST['city']);
                                update_user_meta($user_id, 'edit_pmsafe_city', $_POST['city']);

                                update_user_meta($user_id, 'pmsafe_state', $_POST['state']);
                                update_user_meta($user_id, 'edit_pmsafe_state', $_POST['state']);

                                update_user_meta($user_id, 'pmsafe_zip_code', $_POST['zip_code']);
                                update_user_meta($user_id, 'edit_pmsafe_zip_code', $_POST['zip_code']);

                                update_user_meta($user_id, 'pmsafe_email', $_POST['email']);
                                update_user_meta($user_id, 'pmsafe_signature', $_POST['signature']);


                                $vehicle_info = array();

                                $vehicle_info[$member_code] = array(
                                    'pmsafe_vehicle_year' => $_POST['vehicle_year'],
                                    'pmsafe_vehicle_make' => $_POST['vehicle_make'],
                                    'pmsafe_vehicle_model' => $_POST['vehicle_model'],
                                    'pmsafe_vin' => $_POST['vin'],
                                    'pmsafe_vehicle_mileage' => $_POST['vehicle_mileage'],
                                    'pmsafe_vehicle_type' => $_POST['vehicle_type'],
                                    'pmsafe_registration_date' => current_time('mysql'),
                                    'pmsafe_member_number' => $member_code,
                                    'pmsafe_member_code_id' => $member_code_id

                                );
                                update_user_meta($user_id, 'pmsafe_vehicle_info', $vehicle_info);

                                $pdf_link = generate_pdf($user_id, $member_code);
                                update_post_meta($member_code_id, 'pmsafe_pdf_link', $pdf_link);

                                $vehicle_info_pdf = get_the_author_meta('pmsafe_vehicle_info', $user_id);
                                $vehicle_info_pdf[$member_code]['pmsafe_pdf_link'] = $pdf_link;
                                update_user_meta($user_id, 'pmsafe_vehicle_info', $vehicle_info_pdf);


                                $to = $_POST['email'];
                                $subject = 'PermaSafe: Your Registration Information';
                                $password = $password;
                                $fname = $_POST["first_name"];
                                $member_code = $member_code;
                                $process = 'customer_registration';
                                send_mail_to_users($to, $password, $subject, $fname, $member_code, $process);

                                 if($login){
                                    update_post_meta($member_code_id,'registered_by',$login);
                                }else{
                                    update_post_meta($member_code_id,'registered_by',$member_code);
                                }

                                if ($role['author'] == 1) {
                                    $url = get_site_url() . '/distributor-account/';
                                } else if ($role['distributor-user'] == 1) {
                                    $url = get_site_url() . '/distributor-account/';
                                } else if ($role['contributor'] == 1) {
                                    $url = get_site_url() . '/dealer-account/';
                                } else if ($role['dealer-user'] == 1) {
                                    $url = get_site_url() . '/dealer-account/';
                                } else if ($role['administrator'] == 1) {
                                    $url = get_site_url() . '/perma-register/';
                                } else {
                                    $creds = array();
                                    $creds['user_login'] = $member_code;
                                    $creds['user_password'] = $password;
                                    $creds['remember'] = true;
                                    $user = wp_signon($creds, false);

                                    wp_clear_auth_cookie();
                                    do_action('wp_login', $user->ID);
                                    wp_set_current_user($user->ID);
                                    wp_set_auth_cookie($user->ID, true);
                                    $url = get_site_url() . '/perma-warranty/';
                                }
                                $response = array('status' => true, 'redirect' => $url, 'code' => $member_code);
                                echo json_encode($response);
                            } //if userdata
                        } // if member code id

                    } //else exist
                } // if $user_data
            } // if member code
            else {

                $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
                echo json_encode($response);
            }
        }
        die;
    }

    /**
     * Perma sales person register ajax funcion
     */
    public function perma_salesperson_form_function()
    {

        $member_code = $_POST['member_number'];
        // echo $member_code;

        if ($member_code === '00000' || $member_code === '0000' || $member_code === '000' || $member_code === '00' || $member_code === '0') {
            // echo 'in';die;
            $sales_person = array(
                'first_name'                        => $_POST['first_name'],
                'last_name'                         => $_POST['last_name'],
                'pmsafe_address_1'                  => $_POST['address1'],
                'pmsafe_address_2'                  => $_POST['address2'],
                'pmsafe_city'                       => $_POST['city'],
                'pmsafe_state'                      => $_POST['state'],
                'pmsafe_zip_code'                   => $_POST['zip_code'],
                'pmsafe_phone_number'               => $_POST['phone_number'],
                'pmsafe_email'                      => $_POST['email'],
                'pmsafe_registration_date'          => current_time('mysql'),
                'pmsafe_vehicle_year'               => $_POST['vehicle_year'],
                'pmsafe_vehicle_make'               => $_POST['vehicle_make'],
                'pmsafe_vehicle_model'              => $_POST['vehicle_model'],
                'pmsafe_vehicle_mileage'            => $_POST['vehicle_mileage'],
                'pmsafe_vin'                        => $_POST['vin'],
                'pmsafe_warranty_registration'      => $member_code,
                'pmsafe_plan_id'                    => 'sales-person',
            );

            $pdf_link = sales_person_generate_pdf($sales_person);
            $warranty_card = pmsafe_sales_person_warranty_card($sales_person, $pdf_link);

            $response = array('status' => true, 'html' => $warranty_card);
            echo json_encode($response);
        } else {
            $response = array('status' => false, 'message' => '<span class="perma-error"><strong>Error!</strong>  The member code you have provided is not valid. Please check your code and try again. If you believe this is an error, please contact us <a href="' . get_site_url() . '/contact">here</a>.</span>');
            echo json_encode($response);
        }
        die;
    }

    /**
     * Login redirect
     *
     * @param type $url
     * @param type $request
     * @param type $user
     * @return type
     */
    public function pmsafe_login_redirect($url, $request, $user)
    {
        if ($user && is_object($user) && is_a($user, 'WP_User')) {
            if ($user->has_cap('administrator')) {
                $url = admin_url();
            } else {
                $url = get_option('pmsafe_redirect_url');
                $url = $url;
            }
        }
        return $url;
    }


    /**
     * user info function
     *
     * @return type
     */
    public function user_info_function()
    {

        $html = '';
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $current_user = wp_get_current_user();
            $role = (array) $current_user->caps;
            if ($role['subscriber'] == 1) {
                $html .= pmsafe_warranty_user_info_card($user_id);
            } else if ($role['contributor'] == 1 || $role['author'] == 1) {
                $html .= pmsafe_dealer_distributor_info_card($user_id);
            } else if ($role['dealer-user'] == 1 || $role['distributor-user'] == 1) {
                $html .= pmsafe_contact_user_info_card($user_id);
            }
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }
        return $html;
    }

    public function contact_user_popup_function()
    {
        if (is_user_logged_in()) {
            $current_user = wp_get_current_user();
            $user_id = get_current_user_id();
            $is_popup = get_user_meta($user_id, 'is_popup', true);
            $role = (array) $current_user->caps;

            if ($role['dealer-user'] == 1 || $role['distributor-user'] == 1) {
                if (is_page('distributor-account') || is_page('dealer-account')) {
                    if ($is_popup != 1) {
                        echo '<div id="contact-user-popup">';
                        echo '<div>';
                        echo '<i class="fa fa-close" id="contact-popup-close"></i>';
                        echo '<h2>Reset Password</h2>';
                        echo '<p>You are currently using a temporary password. Please set a stronger password. click <a href="' . get_site_url() . '/perma-account-info">here</a></p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
        }
    }

    /**
     * Warranty function
     *
     * @return type
     */
    public function perma_warranty_function()
    {

        $user_id = get_current_user_id();

        $current_user = wp_get_current_user();
        $membercode = $current_user->user_login;


        $html = '';
        if (is_user_logged_in()) {
            $is_pass_set = get_user_meta($user_id, 'is_pass_reset', true);

            echo '<input type="hidden" id="reset_pass_popup" value="' . $is_pass_set . '">';


            $html .= pmsafe_warranty_card($user_id, $membercode);
        } else {
            $location = get_site_url() . "/perma-register/";
            wp_redirect($location, 301);
            exit;
        }


        return $html;
    }

    /**
     * password reset form
     *
     * @return type
     */
    public function perma_reset_password_form()
    {
        if (is_user_logged_in()) {
            return $this->perma_change_password_form();
        } else {
            $location = get_site_url() . "/wp-login.php";
            wp_redirect($location, 301);
            exit;
        }
    }

    /**
     * Change password form
     *
     * @global type $post
     * @return type
     */
    public function perma_change_password_form()
    {
        global $post;

        if (is_singular()) :
            $current_url = get_permalink($post->ID);
        else :
            $pageURL = 'http';
            if ($_SERVER["HTTPS"] == "on") $pageURL .= "s";
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            else $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            $current_url = $pageURL;
        endif;
        $redirect = $current_url;

        ob_start();

        // show any error messages after form submission
        $this->perma_show_error_messages(); ?>

<?php if (isset($_GET['password-reset']) && $_GET['password-reset'] == 'true') { ?>
<div class="perma_message success" id="pmsafe-response">
    <span class="perma-success"><?php _e('Password changed successfully', 'rcp'); ?></span>
</div>
<?php } ?>
<form id="perma_password_form" method="POST" action="<?php echo $current_url; ?>">
    <fieldset>
        <p>
            <label for="perma_user_pass"><?php _e('New Password', 'rcp'); ?></label>
            <input name="perma_user_pass" id="perma_user_pass" class="required" type="password" />
        </p>
        <p>
            <label for="perma_user_pass_confirm"><?php _e('Password Confirm', 'rcp'); ?></label>
            <input name="perma_user_pass_confirm" id="perma_user_pass_confirm" class="required" type="password" />
        </p>
        <p>
            <input type="hidden" name="perma_action" value="reset-password" />
            <input type="hidden" name="perma_redirect" value="<?php echo $redirect; ?>" />
            <input type="hidden" name="perma_password_nonce" value="<?php echo wp_create_nonce('rcp-password-nonce'); ?>" />
            <input id="perma_password_submit" type="submit" value="<?php _e('Change Password', 'pippin'); ?>" />
        </p>
    </fieldset>
</form>
<?php
        return ob_get_clean();
    }

    /**
     * Reset password
     *
     * @global type $user_ID
     * @return type
     */
    public function perma_reset_password()
    {
        // reset a users password
        if (isset($_POST['perma_action']) && $_POST['perma_action'] == 'reset-password') {

            global $user_ID;

            if (!is_user_logged_in())
                return;

            if (wp_verify_nonce($_POST['perma_password_nonce'], 'rcp-password-nonce')) {

                if ($_POST['perma_user_pass'] == '' || $_POST['perma_user_pass_confirm'] == '') {
                    // password(s) field empty
                    $this->perma_errors()->add('password_empty', __('Please enter a password, and confirm it', 'pippin'));
                }
                if ($_POST['perma_user_pass'] != $_POST['perma_user_pass_confirm']) {
                    // passwords do not match
                    $this->perma_errors()->add('password_mismatch', __('Passwords do not match', 'pippin'));
                }

                // retrieve all error messages, if any
                $errors = $this->perma_errors()->get_error_messages();

                if (empty($errors)) {
                    // change the password here
                    $user_data = array(
                        'ID' => $user_ID,
                        'user_pass' => $_POST['perma_user_pass']
                    );
                    wp_update_user($user_data);
                    update_user_meta($user_ID, 'is_pass_reset', '1');
                    // send password change email here (if WP doesn't)
                    wp_redirect(add_query_arg('password-reset', 'true', $_POST['perma_redirect']));
                    exit;
                }
            }
        }
    }


    /**
     * displays error messages from form submissions
     */
    public function perma_show_error_messages()
    {
        if ($codes = $this->perma_errors()->get_error_codes()) {
            echo '<div class="perma_message error" id="pmsafe-response">';
            // Loop error codes and display errors
            foreach ($codes as $code) {
                $message = $this->perma_errors()->get_error_message($code);
                echo '<span class="perma-error"><strong>' . __('Error', 'rcp') . '</strong>: ' . $message . '</span>';
            }
            echo '</div>';
        }
    }


    /**
     * used for tracking error messages
     *
     * @staticvar WP_Error $wp_error
     * @return type
     */
    public function perma_errors()
    {
        static $wp_error; // Will hold global variable safely
        return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
    }
}
