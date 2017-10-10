<?php
session_start();
include('db.php');
if(isset($_POST['submit']) && !empty($_POST['username']) && strlen($_POST['username'])>2 && strlen($_POST['username'])<16)
{
$username = test_input($_POST['username']);
$fbid = $_SESSION['fb_id'];
$qr2 = mysqli_query($mysqli, "SELECT username FROM users WHERE username=$username");
	if(!$qr2 || mysqli_num_rows($qr2) == 0){
		$qr1 = mysqli_query($mysqli,"UPDATE users SET username = '$username' WHERE oauth_uid = '$fbid'") or die("MySQL Error." . mysqli_error($mysqli));
		if($qr1 || mysqli_num_rows($qr1)){
			$_SESSION['username'] = $username;
		header('Location: questions.php' );
		}
	}
	else{
		echo "The username is already taken. Please try a different username.";
	}
	}
else{
	echo "Please check the username you have entered...Either your username is too long or too short or you have forgot to enter the username.";
	echo "<script> location.replace('index.php') </script>";
}
	function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;}
?>
