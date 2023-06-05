<?php

/*function urlBuilder(string $username): string
{
    return "https://www.instagram.com/$username/?__a=1&__d=1";
}


function checkUsername(string $username)
{
    $url = urlBuilder($username);

    $response = wp_remote_get($url);

    $statusCode = wp_remote_retrieve_response_code($response);

    if ($statusCode == 404)
        return false;

    $body = json_decode(wp_remote_retrieve_body($response));
    var_dump($body);

    $ret = (object) [
        "biography" => $body->biography,
        "external_url" => $body->external_url,
        "profile_pic_url" => $body->profile_pic_url,
        "username" => $body->username
    ];

    return $ret;

}*/