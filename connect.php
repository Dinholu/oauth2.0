<?php
require 'vendor/autoload.php';
require 'config.php';

use GuzzleHttp\Client;

$client = new Client(
    [
        'timeout' => 2.0,
    ]
);
try {
    $response = $client->request('GET', 'https://accounts.google.com/.well-known/openid-configuration');
    $discovery = json_decode($response->getBody());
    $tokenEndpoint = $discovery->token_endpoint;
    $userinfoEndpoint = $discovery->userinfo_endpoint;
    $response = $client->request('post', $tokenEndpoint, [
        'form_params' => [
            'code' => $_GET['code'],
            'client_id' => GOOGLE_ID,
            'client_secret' => GOOGLE_SECRET,
            'redirect_uri' => 'http://localhost/googleConnect/connect.php',
            'grant_type' => 'authorization_code',
        ],
    ]);
    $accessToken = json_decode($response->getBody())->access_token;
    $response = $client->request('GET', $userinfoEndpoint, [
        'headers' => [
            'Authorization' => 'Bearer ' . $accessToken,
        ],
    ]);
    $response = json_decode($response->getBody());
    if (isset($response->email)) {
        session_start();
        $_SESSION['email'] = $response->email;
        header('Location: secret.php');
        exit();
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$_GET['code'];
