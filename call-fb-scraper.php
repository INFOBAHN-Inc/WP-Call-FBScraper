<?php
/*
Plugin Name: Call FB Scraper
Description: 記事公開時に、Facebook のクローラーを呼ぶ
Version: 0.1
Author: s.ashikawa
*/
add_action('publish_post', function ($id) {

    $url = 'https://graph.facebook.com/';

    $params = array(
        'scrape' => 'true',
        'id'     => 'http://www.infobahn.co.jp',
    );

    $url .= '?' . http_build_query($params);
    $curl = curl_init($url);

    $options = array(
        CURLOPT_POST           => TRUE,
        CURLOPT_POSTFIELDS     => array(),
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_FOLLOWLOCATION => TRUE, // Locationヘッダを追跡
    );

    curl_setopt_array($curl, $options);

    $output = curl_exec($curl);
    // var_dump($output);

    curl_close($curl);
});