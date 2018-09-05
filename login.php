<?php
/*
 * This is the facebook login using PHP SDK
 * I have used JavaScript SDK instead
 */

if(!session_id()) {
    session_start();
}
require_once __DIR__ . '/vendor/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '516048172177583',
  'app_secret' => '920c2f27a749749dc7aad0f8e690fedc',
  'default_graph_version' => 'v2.10',
  ]);
//
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost:4000/fb-callback.php', $permissions);
echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';


// echo '<div class="fb-login-button" data-width="338" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"><a href="' . $loginUrl . '"></a></div>';
// after the login script search for the record in the database ( fb_user )... if it is there, go to welcome.php, else make a new record.
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=516048172177583&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
