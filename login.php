<?php
if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '516048172177583',
  'app_secret' => '920c2f27a749749dc7aad0f8e690fedc',
  'default_graph_version' => 'v2.10',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost:4000/fb-callback.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
?>
