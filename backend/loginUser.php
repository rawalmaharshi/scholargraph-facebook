<?php
error_reporting(E_ALL);
include_once('functions.php');

session_start();

if (isset($_POST['email']) && isset($_POST['password'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $db = getConnection();

  $fetch = qExecute("SELECT * FROM users WHERE email = '$email'");
	if($fetch->rowCount() == 0) {
		echo json_encode(array(
			"status" => "failed",
			"message" => "Email doesn't exist."
		));
    die();
	} else{
      $object = $fetch->fetchObject();
      $userid = $object->id;
      $username = $object->user_name;
      $useremail = $object->email;
      $userpass = $object->password;

      $userpass = base64_decode($userpass);
      if (password_verify($password, $userpass)) {
				//password match..Log in
				$_SESSION['userid'] = $userid;
				$_SESSION['username'] = $username;
				$_SESSION['useremail'] = $useremail;

				echo json_encode(array(
					"status" => "success",
					"message" => "Logged in Successfully."
				));
				die();
			} else{
				//password wrong
				echo json_encode(array(
					"status" => "failed",
					"message" => "Wrong Password."
				));
				die();
			}
    }
} else {
    echo json_encode(array(
  		"status" => "failed",
  		"message" => "Missing parameters"
  	));
	   die();
}

?>
