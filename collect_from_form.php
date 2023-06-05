<?php

require_once("checkUsername.php");

function collectUsername(WP_REST_Request $request): WP_REST_Response | WP_Error
{


    $body = $request->get_body();

    $body = json_decode($body, true);

    if(validateBody($body)){

        if(isset($body["profile_picture"])){
            $png = implode(array_map('chr', json_decode($body["profile_picture"], true)));

            file_put_contents(dirname(__FILE__) . "/assets/profile_picture.png", $png);

            $body["profile_pic_url"] = "/wp-content/plugins/ig_plugin/assets/profile_picture.png";
        }
        
        

        $body = json_encode($body);
        update_option("ig_data", $body);
        return rest_ensure_response(new WP_REST_Response("updated", 200));
    }

    return new WP_Error(400, "Invalid_body", "The body sent was invalid");


}


function validateBody($body):bool{

    //if(!isset($body["profile_picture"])) return false;
    if(!isset($body["username"])) return false;
    if(!isset($body["biography"])) return false;

    return true;

}


add_action("rest_api_init", function () {
    register_rest_route("ig", "/saveUsername", [
        "methods" => "POST",
        "callback" => "collectUsername"
    ]);
});