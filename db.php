<?php
$username = "";//Enter Database Username here
$password = "";//Enter Database Password here
$hostname = "localhost";
$dbname = "";//Enter Database Name here
    $mysqli = mysqli_connect($hostname, $username, $password, $dbname) 
    OR die("Cannot connect to the DATABASE.");
?>