<?php


function get_image_from_unsplash($search){

    $url = "https://api.unsplash.com/search/photos?client_id=mMxnucd7Eric6KR2AU0D7Anktj4KrRkEUABGn2X_p5M&&query=".$search;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $resp = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($resp)->results[0]->urls->full;

    return $result;

}
