<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://andres.reyes.dev
 * @since      1.0.0
 *
 * @package    Wc_Chilean_Bundle
 * @subpackage Wc_Chilean_Bundle/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wc_Chilean_Bundle
 * @subpackage Wc_Chilean_Bundle/includes
 * @author     AndresReyesDev <andres@reyes.dev>
 */
class Wc_Chilean_Bundle_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-chilean-bundle',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
