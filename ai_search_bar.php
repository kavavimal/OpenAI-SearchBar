<?php
/**
* Plugin Name: Open AI Search Bar
* Plugin URI:        https://www.infinitysoftech.co/products/chatgpt-ai-search-bar/
* Description:       Add a ChatGPT AI Search Bar to your site using just a shortcode.
* Version:           0.1
* Author:            Infinity Softech
* Author URI:        https://www.infinitysoftech.co/
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
*/
defined( 'ABSPATH' ) || exit;

define( 'PTG__FILE__', __FILE__ );
define( 'PTG_PLUGIN_BASE', plugin_basename( PTG__FILE__ ) );
define( 'PTG_PATH', plugin_dir_path( PTG__FILE__ ) );

define( 'PTG_URL', plugins_url( '/', PTG__FILE__ ) );

define( 'PTG_ASSETS_PATH', PTG_PATH . 'assets/' );
define( 'PTG_ASSETS_URL', PTG_URL . 'assets/' );

add_action( 'plugins_loaded', 'ptg_load_plugin_textdomain' );

/**
 * Load ChatGPT : AI Search Bar textdomain.
 *
 * Load gettext translate for ChatGPT : AI Search Bar text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */

function ptg_load_plugin_textdomain() {
	load_plugin_textdomain( 'ai_search_bar' );
}

register_deactivation_hook( __FILE__, 'on_PTG_deactivate' );

require PTG_PATH . 'includes/plugin.php';