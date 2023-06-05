<?php

/**
 * Plugin Name: Instagram Button
 * Description: Adds a button to go to instagram in every page
 */

global $wpdb;

require_once("admin_menu.php");
require_once("collect_from_form.php");
require_once("checkUsername.php");



add_filter('show_admin_bar', "__return_false");

function wpb_hook_javascript()
{

    if(!is_admin()){

      wp_enqueue_style('style.css', '/wp-content/plugins/ig_plugin/style/style.css', array(), time(), false);

      $igDataJson = get_option("ig_data");

      if($igDataJson == "") return;

      $igData = json_decode($igDataJson);

      

        ?>
              <a class="ig_border_wrapper" target="_blank" href="<?php echo "https://www.instagram.com/$igData->username" ?>">
                <div class="ig_button">
                  <div class="ig_button_upper">
                    <img src="<?php echo $igData->profile_pic_url ?>">
                    <strong><?php echo $igData->username?></strong>
                  </div>
                  <span class="ig_button_description">
                    <?php echo $igData->biography ?>
                  </span>
                  

                    </div>
              </a>
        <?php

        
      
      
    }
}
add_action('wp_footer', 'wpb_hook_javascript');






##add_action('init', 'wpb_hook_javascript', 2);
#add_action('wp_body', 'wpb_hook_javascript', 3);

#https://play-lh.googleusercontent.com/VRMWkE5p3CkWhJs6nv-9ZsLAs1QOg5ob1_3qg-rckwYW7yp1fMrYZqnEFpk0IoVP4LM
#https://www.instagram.com/danielaspinucci/?__a=1&__d=1