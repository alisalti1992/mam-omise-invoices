<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/moveaheadmedia/
 * @since             1.0.0
 * @package           Mam_Omise_Invoices
 *
 * @wordpress-plugin
 * Plugin Name:       Move Ahead Media Omise Invoices
 * Plugin URI:        https://github.com/moveaheadmedia/mam-omise-invoices
 * Description:       Use this shortcode <code>[mam-omise-invoices]</code> to add an Omise payment form to your website where people can put in their details and pay.
 * Version:           1.0.0
 * Author:            Move Ahead Media
 * Author URI:        https://github.com/moveaheadmedia/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mam-omise-invoices
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
define( 'MAM_OMISE_INVOICES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mam-omise-invoices-activator.php
 */
function activate_mam_omise_invoices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mam-omise-invoices-activator.php';
	Mam_Omise_Invoices_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mam-omise-invoices-deactivator.php
 */
function deactivate_mam_omise_invoices() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mam-omise-invoices-deactivator.php';
	Mam_Omise_Invoices_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mam_omise_invoices' );
register_deactivation_hook( __FILE__, 'deactivate_mam_omise_invoices' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mam-omise-invoices.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mam_omise_invoices() {

	$plugin = new Mam_Omise_Invoices();
	$plugin->run();

}
run_mam_omise_invoices();
