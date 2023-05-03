<?php 
function OASB_view_ai_search_bar(){ ?>
    <div class="infinity-ai-search-bar">
        <div class="infinity-wrapper">
            <div class="infinity-boxes infinity-header">
                <div class="infinity-box infinity-page-title">
                    <h1>
                        <?php esc_html_e( 'OpenAI: Search Bar', PAGE_ID ); ?>
                    </h1>
                </div>
                <div class="infinity-box infinity-logo">
                    <a href="https://www.infinitysoftech.co/" target="_blank"><img src="<?php esc_html_e(OASB_ASSETS_URL); ?>uploads/logo-black-text.png" alt="Infinity Softech Logo"></a>
                </div>
            </div>
            <?php 
                global $wpdb;
                $options = $wpdb->get_results( "SELECT option_value FROM {$wpdb->prefix}options WHERE option_name LIKE 'chatgpt-key%'" ); 
                $valueHas = '';
                $active = 'Active';
                if(!empty($options)){
                    $key = $options[0]->option_value;
                    
                    if($key != ''){
                        $valueHas = 'btn-green';
                        $active = 'Activated';
                    }
                }?>
            <div class="infinity form-wrap">
                <div id="infinity-container" class="wp-clearfix">
                    <div class="infinity-sub-title">
                        <h2><span><img src="<?php esc_html_e(OASB_ASSETS_URL); ?>uploads/check-mark.png" alt="Check Mark"></span><?php esc_html_e( 'ChatGPT: AI Search Bar', PAGE_ID ); ?></h2>
                        <p><?php esc_html_e( "- Add the ChatGPT Search Bar into your website pages without having to manually edit your website's source code.", PAGE_ID ); ?></p>
                    </div>
                    <form action="<?php echo OASB_get_ai_search_bar_url(); ?>" method="post" class="ai_search_bar_form" enctype="multipart/form-data">
                        <?php wp_nonce_field( 'add', 'add_ai_search_bar_form', true ); ?>
                        <div id="">
                            <div class="col-wrap">
                                <div class="form-field infinity-description">
                                    <label for="infinity-description"><span>Add ChatGPT API Key</span> (If you don't know how to generate ChatGPT API key then <a href="https://platform.openai.com/account/api-keys" target="_blank">Click Here</a>) .</label>
                                        <input type="password" required ="required" class="form-class" name="chatgpt-key" value="<?php esc_html_e($key); ?>" id="chatgpt-key" aria-describedby="chatgpt-key" placeholder="ChatGPT Key">
                                </div>
                                <div>
                                    <input type="submit" name="submit" id="submit" class="<?php esc_html_e($valueHas);?> button button-primary" value="<?php esc_html_e($active);?>" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="infinity-footer">
                <div class="infinity-box infinity-page-title">
                    <h3>
                        <?php esc_html_e( 'OpenAI: Search Bar', PAGE_ID ); ?>
                    </h3>
                </div>
                <div class="infinity-box infinity-logo">
                    <label>Developed By - <a href="https://www.infinitysoftech.co/" target="_blank">Infinity Softech</a></label>
                </div>
            </div>
        </div>
    </div>
<?php }
