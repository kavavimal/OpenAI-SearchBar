<?php 
const PAGE_ID = 'ai_search_bar';
add_action( 'admin_init', 'OASB_ai_search_bar_setting' );
function OASB_ai_search_bar_setting(){
    if( class_exists( 'Synergyzed' ) ){
        add_action( 'admin_print_footer_scripts', 'ai_search_bar_setting' );
    }
}

/**
 * Create/Register Menu at admin dashboard
 */
add_action( 'admin_menu', 'OASB_ai_search_bar_register_admin_menu' );
function OASB_ai_search_bar_register_admin_menu(){
    add_menu_page( __( 'ai_search_bar', 'ai_search_bar' ), 'AI Search Bar', 'manage_options', PAGE_ID, 'OASB_ai_search_bar_actions', 'dashicons-search', 6 );
    add_submenu_page( 'ai_search_bar', 'Documentation', 'Documentation', 'manage_options', 'documentation', 'OASB_ai_search_bar_import_classname_actions', );
}

/**
 * Action of Class Names post
 */
function OASB_ai_search_bar_import_classname_actions(){
    if( isset( $_GET['page'] ) && 'documentation' == $_GET['page'] ){
       echo OASB_view_documentation();
    }
}

/**
 * Action of Albums
 */
function OASB_ai_search_bar_actions(){ 
    if( isset( $_GET['page'] ) && 'ai_search_bar' == $_GET['page'] ){
        echo OASB_view_ai_search_bar();
    }
}

function OASB_get_ai_search_bar_url() {
    return admin_url('admin.php?page=ai_search_bar');
}

/**
 * Add a flash notice to {prefix}options table until a full page refresh is done
 *
 * @param string $notice our notice message
 * @param string $type This can be "info", "warning", "error" or "success", "warning" as default
 * @param boolean $dismissible set this to TRUE to add is-dismissible functionality to your notice
 * @return void
 */
 
 function add_flash_notice( $notice = "", $type = "warning", $dismissible = true ) {
    
    $notices = get_option( "OASB_flash_notices", array() );
 
    $dismissible_text = ( $dismissible ) ? "is-dismissible" : "";
 
    // We add our new notice.
    array_push( $notices, array( 
        "notice" => $notice, 
        "type" => $type, 
        "dismissible" => $dismissible_text
    ) );
 
    update_option("OASB_flash_notices", $notices );
    
}
 
/**
 * Function executed when the 'admin_notices' action is called, here we check if there are notices on
 * our database and display them, after that, we remove the option to prevent notices being displayed forever.
 * @return void
 */
 
function OASB_ai_search_bar_display_flash_notices() {
    $notices = get_option( "OASB_flash_notices", array() );

    // Iterate through our notices to be displayed and print them.
    foreach ( $notices as $notice ) {
        
        printf('<div class="notice notice-%1$s %2$s"><p>%3$s</p></div>',
            $notice['type'],
            $notice['dismissible'],
            $notice['notice']
        );
    }
 
    // Now we reset our options to prevent notices being displayed forever.
    if( ! empty( $notices ) ) {
        delete_option( "OASB_flash_notices", array() );
    }
}
add_action( 'admin_notices', 'OASB_ai_search_bar_display_flash_notices', 12 );