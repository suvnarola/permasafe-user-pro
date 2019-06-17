<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://permasafe.net/
 * @since      1.0.0
 *
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Permasafe_User_Pro
 * @subpackage Permasafe_User_Pro/includes
 * @author     permasafe <contact@permasafe.net>
 */
class Permasafe_User_Pro_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'permasafe-user-pro',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
