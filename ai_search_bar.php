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

define( 'OASB__FILE__', __FILE__ );
define( 'OASB_PLUGIN_BASE', plugin_basename( OASB__FILE__ ) );
define( 'OASB_PATH', plugin_dir_path( OASB__FILE__ ) );

define( 'OASB_URL', plugins_url( '/', OASB__FILE__ ) );

define( 'OASB_ASSETS_PATH', OASB_PATH . 'assets/' );
define( 'OASB_ASSETS_URL', OASB_URL . 'assets/' );

add_action( 'plugins_loaded', 'OASB_Load_Plugin' );

/**
 * Load ChatGPT : AI Search Bar textdomain.
 *
 * Load gettext translate for ChatGPT : AI Search Bar text domain.
 *
 * @since 1.0.0
 *
 * @return void
 */

function OASB_Load_Plugin() {
	load_plugin_textdomain( 'ai_search_bar' );
}

register_deactivation_hook( __FILE__, 'on_OASB_deactivate' );

require OASB_PATH . 'includes/plugin.php';