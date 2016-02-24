<?php

require './vendor/autoload.php';

session_start();

$fb = new Facebook\Facebook([
  'app_id' => '1765175180380152',
  'app_secret' => '99c417e86fbc1f2d893d3be92efa203a',
  'default_graph_version' => 'v2.5',
  ]);

$accessToken = 'CAAZAFatZBXxZCgBAN6V3NUIfpfe1pt0blhJMbhzEHVaSDwZCN6tZCZB2cAzPLe5RbPAvHQ0HO5JHD4rwTIidoYPHFFWSU9YAbj1FAUc2kvqz40Gp20SyvbZCNiPieMZCDdZAqXUOYvKDlVh5s0gkWa7CNlvQ25zXkVI2hM4OFswTQFG7dMMVzT7vb7Atfj30vlnuTXZCnWLoA7FQZDZD';

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,first_name,last_name', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

$curl = new anlutro\cURL\cURL;

$url = $curl->buildUrl('http://api.icndb.com/jokes/random', [
  'firstName' => $user['first_name'],
  'lastName' => $user['last_name']
  ]);

$response = $curl->get($url);

$quote = json_decode($response->body);

if ($quote->type === 'success') {

  $message = $quote->value->joke . '\n\nhttp://quotes.ejillberth.xyz';

  $linkData = [
    'message' => $quote->value->joke,
    ];

  try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post('/me/feed', $linkData, $accessToken);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  $graphNode = $response->getGraphNode();

  echo 'Posted with id: ' . $graphNode['id'];

}
