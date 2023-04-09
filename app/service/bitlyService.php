<?php

class BitlyService
{
    public function shortenURL($url)
    {
        $apiUrl = 'https://api-ssl.bitly.com/v4/shorten';
        $accessToken = '85c0dc1d4cf8146f5c51211d8ab185fedb6aa234';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode(array(
                'long_url' => $url,
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->link;
    }
}