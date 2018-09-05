<?php
session_start();

if(isset($_SESSION['fb_userid'])){
echo " <script> (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = \"https://connect.facebook.net/en_US/sdk.js\";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  FB.logout(function(response) {
          // Person is now logged out
  });
  </script> ";
}

session_unset();
session_destroy();
header('Location: ../index.php');
?>
