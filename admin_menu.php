<?php
function page_callback_function()
{

    $igDataJson = get_option("ig_data");

    

    $igData = $igDataJson != "" ? json_decode($igDataJson, false) : (object) [
        "username" => "",
        "biography" => "",
        "profile_pic_url" => ""
    ];

    ?>

        <div class="ig_container">
            <section>
                <h1>Instagram button</h1>
                <form id="ig_data">
                    <h2>Username</h2>
                    <input required value="<?php echo $igData->username ?>" type="text" id="ig_username" placeholder="Insert your username">
                    <h2>Description</h2>
                    <textarea required id="ig_description" placeholder="Insert your description"> <?php echo $igData->biography ?></textarea>    
                    <h2>Profile Image</h2>
                    <img id="image_preview" src="<?php echo $igData->profile_pic_url ?>" />        
                    <input value="" <?php echo $igData->profile_pic_url == "" ? "required" : "" ?> type="file" id="ig_profile_picture" accept="image/png, image/gif, image/jpeg">
                    <button type="submit" class="button button-primary">Submit</button>
                </form>
            </section>
            <section>
                <h1>Preview</h1>
                <div class="ig_border_wrapper" preview>
                <div open preview class="ig_button">
                  <div class="ig_button_upper">
                    <img id="image_preview_preview" src="<?php echo $igData->profile_pic_url ?>" >
                    <strong id="ig_username_preview"><?php echo $igData->username?></strong>
                  </div>
                  <span id="ig_description_preview" class="ig_button_description">
                    <?php echo $igData->biography ?>
                  </span>
                  

                    </div>
                </div>
            </section>

        </div>
    <?php

    wp_enqueue_script('formCollection', '/wp-content/plugins/ig_plugin/script/script.js');
    wp_enqueue_style('ig_plugin_admin', '/wp-content/plugins/ig_plugin/style/admin_page.css');
    wp_enqueue_style('style.css', '/wp-content/plugins/ig_plugin/style/style.css', array(), time(), false);


}

function custom_menu()
{

    add_menu_page(
        'Instagram Plugin',
        'Instagram Button',
        'edit_posts',
        'ig_button',
        'page_callback_function',
        'dashicons-media-spreadsheet'

    );

    
}


add_action('admin_menu', 'custom_menu');

