<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://permasafe.net/
 * @since             1.0.0
 * @package           Permasafe_User_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Permasafe Registration Manager
 * Plugin URI:        https://permasafe.net/
 * Description:       This system creates and manages the registration codes for PermaSafe's Registration Cards
 * Version:           1.0.0
 * Author:            permasafe
 * Author URI:        https://permasafe.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       permasafe-user-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-permasafe-user-pro-activator.php
 */
function activate_permasafe_user_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-permasafe-user-pro-activator.php';
	Permasafe_User_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-permasafe-user-pro-deactivator.php
 */
function deactivate_permasafe_user_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-permasafe-user-pro-deactivator.php';
	Permasafe_User_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_permasafe_user_pro' );
register_deactivation_hook( __FILE__, 'deactivate_permasafe_user_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-permasafe-user-pro.php';
require plugin_dir_path( __FILE__ ) . 'includes/global-functions.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_permasafe_user_pro() {

	$plugin = new Permasafe_User_Pro();
	$plugin->run();

}
run_permasafe_user_pro();
