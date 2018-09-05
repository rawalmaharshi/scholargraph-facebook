<?php
error_reporting(E_ALL);
include_once('functions.php');
session_start();
// $username = $_POST['username'] = 'naasdf';
// $email = $_POST['email'] = 'asdjk';
// $password = $_POST['password'] = 'ABC123';
// //
// $password_hashed = $_POST['password_hashed'] = password_hash($password,PASSWORD_DEFAULT);
// $password_hashed2 = $_POST['password_hashed2'] = base64_encode(password_hash($password,PASSWORD_DEFAULT));
// print_r($_POST);
// die();

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  //encoding password
	$password = base64_encode(password_hash($password, PASSWORD_DEFAULT));

  $db = getConnection();

  $check = qExecute("SELECT * FROM users WHERE email = '$email'");
	if($check->rowCount() > 0) {
		echo json_encode(array(
			"status" => "failed",
			"message" => "Email already exists"
		));
	} else{
      $res = qExecute("INSERT INTO users (email, user_name, password) VALUES('$email', '$username', '$password');");
  		if($res){
        $fetch = qExecute("SELECT * FROM users WHERE email = '$email'");
        $object = $fetch->fetchObject();
        //set session variables for auto-login
        $_SESSION['userid'] = $object->id;
        $_SESSION['username'] = $object->user_name;
        $_SESSION['useremail'] =  $object->email;

  			echo json_encode(array(
  			"status" => "success",
  			"message" => "Successfully registered with ScholarGraph. Login to Continue."
  			));
  			die();
  		}
		  else{
  			echo json_encode(array(
  			"status" => "failed",
  			"message" => "Error signing up. Please try again later."
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
