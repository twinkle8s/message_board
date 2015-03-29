<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM member WHERE username='$username'");
$row=mysql_fetch_row($query);

$password=$newPW=$confirm="";

if (isset($_POST['password']))
{
	$password=sanitize($_POST['password']);
	$newPW=sanitize($_POST['newPW']);
	$confirm=sanitize($_POST['confirm']);

	$_password=addPW($password);
	$_newPW=addPW($newPW);

	if ($password=="" || $newPW=="" || $confirm=="")
	{
		echo "<div class='content'><h2>Change Password</h2>" .
			 "<span class='error'>Not all required fields were entered</span><br><br>";
	}
	elseif ($_password!=$row[1])
	{
		echo "<div class='content'><h2>Change Password</h2>" .
			 "<span class='error'>Wrong old password</sapn><br><br>";
	}
	elseif ($confirm!=$newPW)
	{
		echo "<div class='content'><h2>Change Password</h2>" .
			 "<span class='error'>Different password(new)</sapn><br><br>";
	}
	else
	{
		queryMysql("UPDATE member SET password='$_newPW' WHERE password='$row[1]'");

		header("refresh:1 ; url=http://localhost/showProfile.php");

		die("<div class='content'><h2>Change successfully</h2></div></body></html>");
	}
}
else
{
	echo "<div class='content'><h2>Change Password</h2>";
}

?>

<form method='POST' action='changePW.php'>
<span class='field'>Old Password </span>
<input type='password' name='password' pattern="[a-zA-Z0-9]{6,32}"><br>
<span class='field'>New Password </span>
<input type='password' name='newPW' pattern="[a-zA-Z0-9]{6,32}"><br>
<span class='field'>Password Confirm</span>
<input type='password' name='confirm' pattern="[a-zA-Z0-9]{6,32}"><br><br>

<span class='button'><input type='submit' value='Confirm'></span>

</form></div></body></html>