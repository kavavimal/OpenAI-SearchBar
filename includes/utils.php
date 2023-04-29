<?php
add_action("wp_ajax_OASB_Add_AI_Search_Bar_Form", "OASB_Add_AI_Search_Bar_Form");
add_action("wp_ajax_nopriv_OASB_Add_AI_Search_Bar_Form", "OASB_Add_AI_Search_Bar_Form");
function OASB_Add_AI_Search_Bar_Form(){

    $data = array();
    $option_update = false;
    $update = true;
    global $wpdb;
    $key = sanitize_text_field($_REQUEST['chatgpt-key']);
    
    if( $update == true && isset( $key ) ) {
        $option_update = update_option('chatgpt-key', $key);
    }
    if( $option_update == true ){
        $data = array('success' => true);
        add_flash_notice( __("ChatGPT API Key Added!"), "success", true );
    }else{
        $data = array('success' => false, 'msg' => 'Something Went Wrong!');
    }
    echo json_encode( $data );
    exit();
}

function OASB_AI_Search_Bar(){

    global $wpdb;
    $options = $wpdb->get_results( "SELECT option_value FROM {$wpdb->prefix}options WHERE option_name LIKE 'chatgpt-key%'" ); 
    $key = $options[0]->option_value;
    
    $html = '';
    $html .= '<div class="infinity-ai-search-bar-form">';
    $html .= '<form action="" method="post" name="frm_ai_search_bar" id="frm_ai_search_bar">';
    $html .= '<div class="infinity-search">';
    $html .= '<div id="loading"></div>';
    $html .= '<div class="infinity-searech-form"><input type="text" class="form-class" id="input_ai_search_bar" class="frm_ai_search_bar" placeholder="Search Here...">';
    $html .= '<input type="hidden" class="form-class" id="ai_search_bar_key" value="'.$key.'">';
    $html .= '<input type="button" class="form-class" id="submit_ai_search_bar" class="frm_ai_search_bar" value="Search"></div>';
    $html .= '<textarea id="search_result" class="code"></textarea></div>';
    $html .= '</form>';
    $html .= '</div>';
    ?>


    <?php 
    return $html;

}
add_shortcode('ai_search_bar', 'OASB_AI_Search_Bar'); 