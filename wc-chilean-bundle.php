<?php

/**
 *
 * @link              https://andres.reyes.dev
 * @since             1.0.0
 * @package           Wc_Chilean_Bundle
 *
 * @wordpress-plugin
 * Plugin Name:       Rut Chileno con validación para WooCommerce
 * Description:       Agrega el campo Rut a Finalizar Compra de WooCommerce y valida que sea válida su sintaxis
 * Version:           1.1.0
 * Author:            AndresReyesDev
 * Author URI:        https://andres.reyes.dev
 * Requires at least: 3.0
 * Tested up to: 5.5
 * Requires PHP: 5.6
 * WC requires at least: 2.2
 * WC tested up to: 4.4.1
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-chilean-bundle
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
define( 'WC_CHILEAN_BUNDLE_VERSION', '1.1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-chilean-bundle-activator.php
 */
function activate_wc_chilean_bundle() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-chilean-bundle-activator.php';
	Wc_Chilean_Bundle_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-chilean-bundle-deactivator.php
 */
function deactivate_wc_chilean_bundle() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-chilean-bundle-deactivator.php';
	Wc_Chilean_Bundle_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_chilean_bundle' );
register_deactivation_hook( __FILE__, 'deactivate_wc_chilean_bundle' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-chilean-bundle.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_chilean_bundle() {

	$plugin = new Wc_Chilean_Bundle();
	$plugin->run();

}
run_wc_chilean_bundle();
