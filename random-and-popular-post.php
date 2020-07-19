<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.themorshed.com
 * @since             1.0.0
 * @package           Random_And_Popular_Post
 *
 * @wordpress-plugin
 * Plugin Name:       Random AND Popular Post
 * Plugin URI:        https://www.plugin.themorshed.com
 * Description:       This is WordPress Lightweight Plugin for display Random Posts, Popular Posts and Recent posts.
 * Version:           1.0.0
 * Author:            Morshed
 * Author URI:        https://www.themorshed.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       random-and-popular-post
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'RANDOM_AND_POPULAR_POST_VERSION', '1.0.0' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-random-and-popular-post.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_random_and_popular_post() {

	$plugin = new Random_And_Popular_Post();
	$plugin->run();

}
run_random_and_popular_post();
