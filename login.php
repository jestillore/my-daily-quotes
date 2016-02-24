<?php

require './vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1765175180380152', // Replace {app-id} with your app id
  'app_secret' => '99c417e86fbc1f2d893d3be92efa203a',
  'default_graph_version' => 'v2.5',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['public_profile', 'publish_actions']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost:8003/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
