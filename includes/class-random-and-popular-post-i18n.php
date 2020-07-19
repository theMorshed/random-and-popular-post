<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.themorshed.com
 * @since      1.0.0
 *
 * @package    Random_And_Popular_Post
 * @subpackage Random_And_Popular_Post/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Random_And_Popular_Post
 * @subpackage Random_And_Popular_Post/includes
 * @author     Morshed <themorshedctg@gmail.com>
 */
class Random_And_Popular_Post_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'random-and-popular-post',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
