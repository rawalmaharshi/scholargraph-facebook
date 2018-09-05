<?php
error_reporting(E_ALL);
include_once('functions.php');

session_start();

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['fb_userid'])) {
  $fb_email = $_POST['email'];
  $fb_name = $_POST['name'];
  $fb_userid = $_POST['fb_userid'];

  $db = getConnection();

  $fetch = qExecute("SELECT * FROM fb_users WHERE fb_email = '$fb_email'");
	if($fetch->rowCount() == 0) {
    //make a entry in db
    $res = qExecute("INSERT INTO fb_users (fb_email, fb_name, fb_userid) VALUES('$fb_email', '$fb_name', '$fb_userid');");
    if($res){
      //setup session variables
      $_SESSION['fb_email'] = $fb_email;
      $_SESSION['fb_name'] = $fb_name;
      $_SESSION['fb_userid'] = $fb_userid;

      echo json_encode(array(
      "status" => "success",
      "message" => "Successfully registered with ScholarGraph using Facebook"
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
	} else{
      $object = $fetch->fetchObject();
      $fb_email = $object->fb_email;
      $fb_name = $object->fb_name;
      $fb_userid = $object->fb_userid;

      //Set session variables to log in user
      $_SESSION['fb_email'] = $fb_email;
      $_SESSION['fb_name'] = $fb_name;
      $_SESSION['fb_userid'] = $fb_userid;

      echo json_encode(array(
      "status" => "success",
      "message" => "Successfully logged in with ScholarGraph using Facebook"
      ));

      die();
    }
} else {
    echo json_encode(array(
  		"status" => "failed",
  		"message" => "Missing parameters"
  	));
	   die();
}

?>
