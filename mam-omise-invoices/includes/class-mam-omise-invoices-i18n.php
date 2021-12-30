<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/moveaheadmedia/
 * @since      1.0.0
 *
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mam_Omise_Invoices
 * @subpackage Mam_Omise_Invoices/includes
 * @author     Move Ahead Media <ali@moveaheadmedia.co.uk>
 */
class Mam_Omise_Invoices_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mam-omise-invoices',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
