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
	<link rel='stylesheet' type='text/css' href='style.css'>
	<script type='text/javascrpt' src="jquery-2.1.3.min.js"></script>
	
</head>

<?php

if (!$login)
{
	echo "<body>\n<div class='website_name'><a href='Homepage.php'>$website_name</a></div>\n" .
		 "<div><ul class='menu'>" .
		 "<li><a href='Login.php'>Log In</a></li>" .
		 "<li><a href='Signup.php'>Sign Up</a></li></ul></div>";
}
else
{
	echo "<body>\n<div class='website_name'><a href='SECRET.php'>$website_name</a></div>\n" .
		 "<div><ul class='menu'>" .
		 "<li>Hello! $username</li>" .
		 "<li><a href='showProfile.php'>Profile</a></li>" .
		 "<li><a href='Logout.php'>Log Out</a></li></ul></div>";
}

?>