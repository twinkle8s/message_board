<?php
include_once 'Header.php';

$error=$username=$password='';

if (isset($_POST['username']))
{
	$username=sanitize($_POST['username']);
	$password=sanitize($_POST['password']);

	if ($username=="" || $password=="")
	{
		$error="*Not all fields were entered";
	}
	else
	{
		$query="SELECT username, password FROM member WHERE username='$username'";

		if (!mysql_num_rows(queryMysql($query)))
		{
			$error="*Username/Password Invalid";
		}
		else
		{
			$row=mysql_fetch_row(queryMysql($query));

			$token=addPW($password);

			if ($token!=$row[1])
			{
				$error="Username/Password Invalid";
			}
			else
			{
				$_SESSION['username']=$username;
				$_SESSION['password']=$password;

				header("refresh:1 ; url=SECRET.php");

				die("<div class='container' style='text-align: center'><h2>$username, you are logged in successfully.</div></body></html>");
			}
		}
	}
}
?>

<div class='container' style="margin: 0% 35%; width: 30%"><h2>Login</h2>
<form class="form-horizontal"method='POST' action='LogIn.php'>
	<div class="form-group">
		<label class="control-label col-sm-4" for="username">Username</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" maxlength='16' name='username' value='<?php echo $username ?>' autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="password">Password</label>
		<div class="col-sm-8">
			<input type='password' class="form-control" maxlength='32' name='password'>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type='submit' class="btn btn-default" value='Login'>
			<span id='error'><?php echo $error ?></span>
		</div>
	</div>
</form>
</div>
</body></html>