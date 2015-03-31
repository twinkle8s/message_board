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