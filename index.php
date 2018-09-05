<?php
error_reporting(E_ALL);
include_once('backend/functions.php');

$db = getConnection();
session_start();

//go to welcome page if the user has already logged in.
if(isset($_SESSION['userid']) || isset($_SESSION['fb_userid'])){
  header("Location: welcome.php");
  die();
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
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1&appId=516048172177583&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Scholar<span style="color:#009688">Graph</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">


    </div> -->
  </nav>

    <!-- Signup area -->
  <div class="container">
	  <div class="row">
		  <div class="col-md-4"></div>
		    <div class="col-md-4 col-sm-12 forms">
			   <form novalidate>
				 <h4 class="page-header" style="text-align:center;font-size: 18px !important">Register @Scholar<span style="color:#009688">Graph</span></h4>

         <div class="form-group">
           <label for="username">Name<span class="req">*</span></label>
           <div class="input-group mb-2">
             <div class="input-group-prepend">
               <div class="input-group-text"><i class="fas fa-user"></i></div>
             </div>
             <input type="text" class="form-control" id="username" placeholder="Enter your name">
           </div>
         </div>

         <div class="form-group">
           <label for="email">Email Address<span class="req">*</span></label>
           <div class="input-group mb-2">
             <div class="input-group-prepend">
               <div class="input-group-text"><i class="far fa-envelope"></i></div>
             </div>
            <input type="text" class="form-control" id="email" placeholder="e.g. rawalmaharshi@gmail.com">
           </div>
        </div>

        <div class="form-group">
          <label for="password">Password<span class="req">*</span></label>
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-lock"></i></div>
            </div>
            <input type="password" class="form-control" id="password" placeholder="Enter your Password">
          </div>
        </div>
				<p id=error class="error"></p>
        <p>Already a user? <a href="loginIndex.php">Sign In</a> </p>
				<button type="submit" class="btn btn-lg btn-block submitButton" id="submit">Sign Up</button>
			</form>
        <h5 style="margin-top:10px">
          <hr>
          <span class="divider">OR</span>
        </h5>
        <div class="fb-login-button" data-width="338" data-onlogin="checkLoginState();" data-scope="public_profile,email" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true"></div>
		</div>
		<div class="col-md-4"></div>
	  </div>
 </div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
$("#submit").on("click", function(e){
	e.preventDefault();

  var username = $("#username").val();
	var email = $("#email").val();
	var password = $("#password").val();
  var email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var pass_pattern = new RegExp("^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

  if (username == '') {
		$('#error').text("Please Fill Out Your Name");
		$("#username").addClass("input-error");
		$('#username').focus();
		return false;
	} else if (email == '') {
		$('#error').text("Please Fill Out Your Email ID");
		$("#email").addClass("input-error");
		$('#email').focus();
		return false;
	}else if (!(email.match(email_pattern))) {
		$('#error').text("Invalid Email Pattern, Please Check Out Your Email");
		$("#email").addClass("input-error");
		$('#email').focus();
		return false;
	} else if (password == '') {
		$('#error').text("Please Fill Out Your Password");
		$("#password").addClass("input-error");
		$('#password').focus();
		return false;
	} else if (!(password.match(pass_pattern))) {
		$('#error').text("Password should be a combination of an Uppercase alphabet, a number, a special character and must be of minimum 8 characters");
		$("#password").addClass("input-error");
		$('#password').focus();
		return false;
	} else {
		$('#error').text("");
		$.ajax({
		method  : "POST",
		url     : "backend/registerUser.php",
		data    : {
          username: username,
					email: email,
					password: password
				  },
		dataType: "json"
		}).done(function(res){
			if(res.status == "success"){
				$("#submit").addClass("disabled");
				$('#error').text(res.message);
				//redirect to main dashboard after 2 seconds.
				window.location.href = "welcome.php";
			} else {
				$('#error').text(res.message);
			}
		  });
	}
});
</script>
<script>

  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);

    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      loginFunction();
    } else {
      // The person is not logged into your app or we are unable to tell.
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId            : '516048172177583',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.1'
    });
  };



  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

   function loginFunction() {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', {fields: 'name,email'}, function(response) {
       console.log(response);
       var name = response.name;
       var email = response.email;
       var fb_userid = response.id;
       console.log('Successful login for: ' + response.name);

         $.ajax({
     		method  : "POST",
     		url     : "backend/loginFB.php",
     		data    : {
     					 email: email,
               name: name,
               fb_userid: fb_userid
     				  },
     		dataType: "json"
     		}).done(function(res){
     			if(res.status == "success"){
     				$("#submit").addClass("disabled");
     				$('#error').text(res.message);
     				//redirect to main dashboard after 2 seconds.
     				window.location.href = "welcome.php";
     			} else {
     				$('#error').text(res.message);
     			}
     		  });
     });
   }
</script>
</body>
</html>
