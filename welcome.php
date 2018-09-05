<?php
error_reporting(E_ALL);
include_once('backend/functions.php');

session_start();

if(!isset($_SESSION['userid']) && !isset($_SESSION['fb_userid'])){
  header('Location: loginIndex.php');
  die();
}

if(isset($_SESSION['userid'])){
  $name = $_SESSION['username'];
  $email = $_SESSION['useremail'];
} else if(isset($_SESSION['fb_userid'])){
  $name = $_SESSION['fb_name'];
  $email = $_SESSION['fb_email'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ScholarGraph</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/web-fonts-with-css/css/fontawesome-all.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Scholar<span style="color:#009688">Graph</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <span class="nav-link"><?php echo $email; ?></span>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="backend/logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-xs-12">
        <h1>Login Sucessful</h1>
        <h2>Welcome, <?php echo $name; ?></h2>
      </div>
    </div>
  </div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
