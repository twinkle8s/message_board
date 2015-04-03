<?php
session_start();

echo "<!DOCTYPE html>\n<html>\n<head>\n";

include 'Function.php';

if (isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
	$login=TRUE;
}
else
{
	$login=FALSE;
}

?>
	<title><?php echo $website_name ?></title>
	<meta charset='UTF-8'>
	<link href="bootstrap.min.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<script src="jquery-2.1.3.min.js"></script>
	
</head>

<?php

if (!$login)
{
	echo "<body>\n<div class='container'><h1><a href='Homepage.php'>$website_name</h1></a></div>\n" .
		 "<div><ul class='pager'>" .
		 "<li><a href='Login.php'>Log In</a></li>" .
		 "<li><a href='Signup.php'>Sign Up</a></li></ul></div>";
}
else
{
	echo "<body>\n<div class='container'><h1><a href='SECRET.php'>$website_name</h1></a></div>\n" .
		 "<div><ul class='pager'>" .
		 "<li>Hello! $username </li>" .
		 "<li><a href='showProfile.php'>Profile</a></li>" .
		 "<li><a href='Logout.php'>Log Out</a></li></ul></div>";
}

?>