<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'PTG_loader' );
/**
 * Initialize the settings pages
 *
 * @since    1.0.0
 */
function PTG_loader() {

    /**
     * Includes files for use functionalities
     */
    require_once PTG_PATH . 'includes/settings.php';
    require_once PTG_PATH . 'includes/utils.php';
    require_once PTG_PATH . 'includes/views/view-documentation.php';
    require_once PTG_PATH . 'includes/views/view-ai_search_bar.php';
    
}

add_action('admin_enqueue_scripts', 'PTG_init');
function PTG_init(){

    wp_enqueue_style(
        'WRM-admin-style',
        PTG_ASSETS_URL . 'css/admin-style.css',
    );

    wp_enqueue_script( 'PTG-admin-script', PTG_ASSETS_URL . 'js/admin-script.js' );
    wp_localize_script( 'PTG-admin-script', 'request_globals', array( 'request_url' => admin_url('admin-ajax.php') ) );
}


add_action('wp_enqueue_scripts', 'PTG_front_init');
function PTG_front_init(){
    wp_enqueue_style(
        'ai-search-bar-style',
        PTG_ASSETS_URL . 'css/ai-search-bar-style.css',
    );
    
    wp_enqueue_style(' ai-search-bar-style', PTG_ASSETS_URL . 'css/ai-search-bar-style.css',);
    wp_enqueue_style(' codemirror-style', PTG_ASSETS_URL . 'css/codemirror.css', );

    wp_enqueue_script( 'PTG-front-codemirror-script', PTG_ASSETS_URL . 'js/codemirror.js' );
    wp_enqueue_script( 'PTG-front-xml-script', PTG_ASSETS_URL . 'js/xml.js' );
    wp_enqueue_script( 'PTG-css-script', PTG_ASSETS_URL . 'js/css.js' );
    wp_enqueue_script( 'PTG-java-script', PTG_ASSETS_URL . 'js/javascript.js' );
    wp_enqueue_script( 'PTG-htmlmixed-script', PTG_ASSETS_URL . 'js/htmlmixed.js' );
    wp_enqueue_script( 'PTG-jquery-script', PTG_ASSETS_URL . 'js/jquery.js' );
    wp_enqueue_script( 'PTG-front-script', PTG_ASSETS_URL . 'js/front-script.js' );
}

/**
 * Deactivate ai_search_bar plugin
 */
function on_PTG_deactivate() {

    if ( function_exists('register_uninstall_hook') )
        register_uninstall_hook(__FILE__, 'ai_search_bar_uninstall'); 

    delete_option("ai_search_bar_db_version");

}

/**
 * Add documentation link into plugin page
 */
add_filter( 'plugin_row_meta', 'PTG_plugin_row_meta_addi', 10, 2 );
function PTG_plugin_row_meta_addi( $links, $file ) {
    if ( 'chatgpt-ai-search-bar/ai_search_bar.php' == $file ) {
        $row_meta = array(
          'docs'    => '<a href="' . esc_url( 'https://www.infinitysoftech.co/products/chatgpt-ai-search-bar/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Plugin Additional Links', 'ai_search_bar' ) . '" style="color:green;">' . esc_html__( 'Documentation', 'ai_search_bar' ) . '</a>'
        );

        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}


/**
 * Add setting page link into plugin page
 */
add_filter( 'plugin_action_links_chatgpt-ai-search-bar/ai_search_bar.php', 'PTG_settings_link' );
function PTG_settings_link( $links ) {
	
	$url = esc_url( add_query_arg(
		'page',
		'ai_search_bar',
		get_admin_url() . 'admin.php'
	) );
	
	$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
	
	array_push(
		$links,
		$settings_link
	);
	return $links;
}