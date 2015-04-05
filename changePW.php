<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM member WHERE username='$username'");
$row=mysql_fetch_row($query);

$error=$password=$newPW=$confirm="";

if (isset($_POST['password']))
{
	$password=sanitize($_POST['password']);
	$newPW=sanitize($_POST['newPW']);
	$confirm=sanitize($_POST['confirm']);

	$_password=addPW($password);
	$_newPW=addPW($newPW);

	if ($password=="" || $newPW=="" || $confirm=="")
	{
		$error="*Not all required fields were entered";
	}
	elseif ($_password!=$row[1])
	{
		$error="*Wrong old password";
	}
	elseif ($confirm!=$newPW)
	{
		$error="*Different password(new)";
	}
	else
	{
		queryMysql("UPDATE member SET password='$_newPW' WHERE password='$row[1]'");

		header("refresh:1 ; url=showProfile.php");

		die("<div class='container' style='text-align: center'><h2>Change successfully</h2></div></body></html>");
	}
}
?>

<div class='container' style="margin: 0% 30%; width: 40%"><h2>Change Password</h2></div>
<form class="form-horizontal" style="margin: 0% 34%; width: 32%" method='POST' action='changePW.php'>
	<div class="form-group">
		<label class="control-label col-sm-4" for="password">Old Password</label>
		<div class="col-sm-8">
			<input type='password' class="form-control" name='password' pattern="[a-zA-Z0-9]{6,32}" autofocus>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="newPW">New Password</label>
		<div class="col-sm-8">
			<input type='password' class="form-control" name='newPW' pattern="[a-zA-Z0-9]{6,32}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="confirm">Password Confirm</label>
		<div class="col-sm-8">
			<input type='password' class="form-control" name='confirm' pattern="[a-zA-Z0-9]{6,32}">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type='submit' class="btn btn-default" value='Confirm'>
			<span id="error"><?php echo $error ?></span>
		</div>
	</div>
</form>
</body></html>