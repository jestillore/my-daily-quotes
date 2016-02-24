<?php

require './vendor/autoload.php';

session_start();

$fb = new Facebook\Facebook([
  'app_id' => '1765175180380152',
  'app_secret' => '99c417e86fbc1f2d893d3be92efa203a',
  'default_graph_version' => 'v2.5',
  ]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', 'CAAZAFatZBXxZCgBAN6V3NUIfpfe1pt0blhJMbhzEHVaSDwZCN6tZCZB2cAzPLe5RbPAvHQ0HO5JHD4rwTIidoYPHFFWSU9YAbj1FAUc2kvqz40Gp20SyvbZCNiPieMZCDdZAqXUOYvKDlVh5s0gkWa7CNlvQ25zXkVI2hM4OFswTQFG7dMMVzT7vb7Atfj30vlnuTXZCnWLoA7FQZDZD');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'Name: ' . $user['name'];
// OR
// echo 'Name: ' . $user->getName();
