<?php
include ('db.php');
session_start();
if(isset($_POST['submit']))
{
	$value_number =$_SESSION['value_number_yash'];
	$emailid = $_SESSION['username'];
	$get_answer=strtolower(test_input($_POST['answer']));
	$get_answer=preg_replace('/[^A-Za-z0-9\-]/','',$get_answer);
	$get_answer=str_replace(' ','-',$get_answer);
	$get_answer=str_replace('-','',$get_answer);
$result=mysqli_query($mysqli,"SELECT answer FROM quiz WHERE id='$value_number'");
$set_answer = mysqli_fetch_array($result);
if($get_answer==$set_answer['answer']){
	$value_number_new = $value_number + 1;
	$update = "UPDATE users SET number='$value_number_new' WHERE username='$emailid'";
	$result2 = mysqli_query($mysqli, $update);
	 header("Location: questions.php");
}
else{
	echo "<script>alert('Sorry! Incorrect answer') </script>";
	echo "<script> location.replace('questions.php') </script>";
}
}
else{
	echo "<script>alert('Please submit your answer first') </script>";
	echo "<script> location.replace('questions.php') </script>";
}
function test_input($data) {

	$data = trim($data);

	$data = stripslashes($data);

	$data = htmlspecialchars($data);

	return $data;}
?>