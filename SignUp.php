<?php
include_once 'Header.php';

$username=$password=$confirm=$gender=$birthdate=$phone=$email=$address="";

if (isset($_SESSION['username']))
{
	destroySessionData();
}

if (isset($_POST['username']))
{
	$username=sanitize($_POST['username']);
	$password=sanitize($_POST['password']);
	$confirm=sanitize($_POST['confirm']);
	$gender=sanitize($_POST['gender']);
	$birthdate=sanitize($_POST['birthdate']);
	$phone=sanitize($_POST['phone']);
	$email=sanitize($_POST['email']);
	$address=sanitize($_POST['address']);

	if ($username=="" || $password=="" || $confirm=="" || $phone=="")
	{
		echo "<div class='content'><h2>Sign Up</h2>" .
			 "<span class='error'>Not all required fields were entered</span><br><br>";
	}
	elseif (mysql_num_rows(queryMysql("SELECT * FROM member WHERE username='$username'")))
	{
		echo "<div class='content'><h2>Sign Up</h2>" .
			 "<span class='error'>Sorry, that username already exists</span><br><br>";
	}
	elseif ($confirm!=$password)
	{
		echo "<div class='content'><h2>Sign Up</h2>" .
			 "<span class='error'>Different password</sapn><br><br>";
	}
	else
	{
		$token=addPW($password);

		queryMysql("INSERT INTO member VALUES('$username', '$token')");
		queryMysql("INSERT INTO profile VALUES('$username', '$gender', '$birthdate', '$phone',
			'$email', '$address', NULL, NULL)");

		die("<div class='content'><h2>Account created :)<br>Please log in.</h2></div></body></html>");
	}
}
else
{
	echo "<div class='content'><h2>Sign Up</h2>";
}

?>

<form method='POST' action='SignUp.php'>
<span class='field'>* Username </span>
<input type='text' name='username' value='<?php echo $username ?>' pattern="[a-zA-Z0-9]{1,16}" autofocus><br>
<span class='field'>* Password </span>
<input type='password' name='password' pattern="[a-zA-Z0-9]{6,32}"><br>
<span class='field'>* Password Confirm</span>
<input type='password' name='confirm' pattern="[a-zA-Z0-9]{6,32}"><br>
<span class='field'>Gender </span>
<input type='radio' name='gender' value='male'>Male 
<input type='radio' name='gender' value='female'>Female 
<input type='radio' name='gender' value='' checked='checked'>None<br>
<span class='field'>Birthday </span>
<input type='date' name='birthdate' value='<?php echo $birthdate ?>'><br>
<span class='field'>* Phone Number </span>
<input type='text' name='phone' value='<?php echo $phone ?>' pattern="{9,10}"><br>
<span class='field'>E-mail </span>
<input type='email' name='email' value='<?php echo $email ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br>
<span class='field'>Address </span>
<input type='text' name='address' value='<?php echo $address ?>' maxlength='80'><br><br>

<span class='button'><input type='submit' value='Sign Up'></span>

</form></div></body></html>