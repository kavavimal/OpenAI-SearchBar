<?php if (!defined('ABSPATH')) {
    exit;
}

add_action('plugins_loaded', 'OASB_loader');
/**
 * Initialize the settings pages
 *
 * @since    1.0.0
 */
function OASB_loader()
{

    /**
     * Includes files for use functionalities
     */
    require_once OASB_PATH . 'includes/settings.php';
    require_once OASB_PATH . 'includes/utils.php';
    require_once OASB_PATH . 'includes/views/view-documentation.php';
    require_once OASB_PATH . 'includes/views/view-ai_search_bar.php';
}

add_action('admin_enqueue_scripts', 'OASB_init');
function OASB_init()
{

    wp_enqueue_style(
        'WRM-admin-style',
        OASB_ASSETS_URL . 'css/admin-style.css',
    );

    wp_enqueue_script('OASB-admin-script', OASB_ASSETS_URL . 'js/admin-script.js');
    wp_localize_script('OASB-admin-script', 'request_globals', array('request_url' => admin_url('admin-ajax.php')));
}


add_action('wp_enqueue_scripts', 'OASB_front_init');
function OASB_front_init()
{
    wp_enqueue_style('ai-search-bar-style', OASB_ASSETS_URL . 'css/ai-search-bar-style.css',);
    wp_enqueue_style(' ai-search-bar-style', OASB_ASSETS_URL . 'css/ai-search-bar-style.css',);
    wp_enqueue_style(' codemirror-style', OASB_ASSETS_URL . 'css/codemirror.css',);

    wp_enqueue_script('wp-codemirror');
    wp_enqueue_script('OASB-front-codemirror-script', OASB_ASSETS_URL . 'js/codemirror.js');
    wp_enqueue_script('OASB-front-xml-script', OASB_ASSETS_URL . 'js/xml.js');
    wp_enqueue_script('OASB-css-script', OASB_ASSETS_URL . 'js/css.js');
    wp_enqueue_script('OASB-java-script', OASB_ASSETS_URL . 'js/javascript.js');
    wp_enqueue_script('OASB-htmlmixed-script', OASB_ASSETS_URL . 'js/htmlmixed.js');
    wp_enqueue_script('jquery');
    wp_enqueue_script('OASB-front-script', OASB_ASSETS_URL . 'js/front-script.js');
}

/**
 * Deactivate ai_search_bar plugin
 */
function on_OASB_deactivate()
{

    if (function_exists('register_uninstall_hook'))
        register_uninstall_hook(__FILE__, 'ai_search_bar_uninstall');

    delete_option("ai_search_bar_db_version");
}

/**
 * Add documentation link into plugin page
 */
add_filter('plugin_row_meta', 'OASB_plugin_row_meta_addi', 10, 2);
function OASB_plugin_row_meta_addi($links, $file)
{
    if ('chatgpt-ai-search-bar/ai_search_bar.php' == $file) {
        $row_meta = array(
            'docs'    => '<a href="' . esc_url('https://www.infinitysoftech.co/products/chatgpt-ai-search-bar/') . '" target="_blank" aria-label="' . esc_attr__('Plugin Additional Links', 'ai_search_bar') . '" style="color:green;">' . esc_html__('Documentation', 'ai_search_bar') . '</a>'
        );

        return array_merge($links, $row_meta);
    }
    return (array) $links;
}


/**
 * Add setting page link into plugin page
 */
add_filter('plugin_action_links_chatgpt-ai-search-bar/ai_search_bar.php', 'OASB_settings_link');
function OASB_settings_link($links)
{

    $url = esc_url(add_query_arg(
        'page',
        'ai_search_bar',
        get_admin_url() . 'admin.php'
    ));

    $settings_link = "<a href='$url'>" . __('Settings') . '</a>';

    array_push(
        $links,
        $settings_link
    );
    return $links;
}
