<?php
include_once 'Header.php';

$username=$password='';

if (isset($_POST['username']))
{
	$username=sanitize($_POST['username']);
	$password=sanitize($_POST['password']);

	if ($username=="" || $password=="")
	{
		echo "<div class='content'><h2>Login</h2>" .
			 "<span class='error'>Not all fields were entered</span><br><br>";
	}
	else
	{
		$query="SELECT username, password FROM member WHERE username='$username'";

		if (!mysql_num_rows(queryMysql($query)))
		{
			echo "<div class='content'><h2>Login</h2>" .
			 	 "<span class='error'>Username/Password Invalid</span><br><br>";
		}
		else
		{
			$row=mysql_fetch_row(queryMysql($query));

			$token=addPW($password);

			if ($token!=$row[1])
			{
				echo "<div class='content'><h2>Login</h2>" .
			 	 	 "<span class='error'>Username/Password Invalid</span><br><br>";
			}
			else
			{
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;

				header("refresh:1 ; url=http://localhost/SECRET.php");

				die("<div class='content'><h2>$username, you are logged in successfully.</div></body></html>");
			}
		}
	}
}
else
{
	echo "<div class='content'><h2>Login</h2>";
}

?>

<form method='POST' action='LogIn.php'>
<span class='field'>Username </span>
<input type='text' maxlength='16' name='username' value='<?php echo $username ?>'><br>
<span class='field'>Password </span>
<input type='password' maxlength='32' name='password'><br><br>

<span class='button'><input type='submit' value='Login'></span>

</form></div></body></html>