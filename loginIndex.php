<?php
error_reporting(E_ALL);
include_once('backend/functions.php');

$db = getConnection();
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
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
      </ul>

    </div>
  </nav>

    <!-- Signup area -->
  <div class="container">
	  <div class="row">
		  <div class="col-md-4"></div>
		    <div class="col-md-4 col-sm-12 forms">
			   <form novalidate>
				 <h4 class="page-header" style="text-align:center;font-size: 18px !important">Login @Scholar<span style="color:#009688">Graph</span></h4>

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
        <p>New User? <a href="index.php">Sign Up</a></p>
				<button type="submit" class="btn btn-lg btn-block submitButton" id="submit">Sign Up</button>
			</form>
        <h5 style="margin-top:10px">
          <hr>
          <span class="divider">OR</span>
        </h5>
		</div>
		<div class="col-md-4"></div>
	  </div>
 </div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
$("#submit").on("click", function(e){
	e.preventDefault();

	var email = $("#email").val();
	var password = $("#password").val();
  var email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var pass_pattern = new RegExp("^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

   if (email == '') {
		$('#error').text("Please Fill Out Your Email ID");
		$("#email").addClass("input-error");
		$('#email').focus();
		return false;
	} else if (!(email.match(email_pattern))) {
		$('#error').text("Invalid Email Pattern, Please Check Out Your Email");
		$("#email").addClass("input-error");
		$('#email').focus();
		return false;
	} else if (password == '') {
		$('#error').text("Please Fill Out Your Password");
		$("#password").addClass("input-error");
		$('#password').focus();
		return false;
	} else {
		$('#error').text("");
		$.ajax({
		method  : "POST",
		url     : "backend/loginUser.php",
		data    : {
					email: email,
					password: password
				  },
		dataType: "json"
		}).done(function(res){
			if(res.status == "success"){
				$("#submit").addClass("disabled");
				$('#error').text(res.message);
				//redirect to main dashboard after 2 seconds.
				// window.location.href = "index.php";
			} else {
				$('#error').text(res.message);
			}
		  });
	}
});
</script>
</body>
</html>
