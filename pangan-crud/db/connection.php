<?php

//For connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "kitdb";

//COMBINE ALL VARIABLES FOR CONNECTION

$conn = new mysqli($host, $user, $pass, $dbname);

//CONNECTION CHECKER

if ($conn->connect_error) {
	die("Connection Failed:" . $conn->connect_error);
}

?>