<?php
include_once("config.php");
if(array_key_exists('logout',$_GET))
{
	session_start();
	unset($_SESSION['user_data']);
	session_destroy();
	header("Location:index.php");
}
?>