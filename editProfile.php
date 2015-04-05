<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM profile WHERE username='$username'");
$row=mysql_fetch_row($query);
$error="";

if (isset($_POST['username']))
{
	$username=sanitize($_POST['username']);
	$gender=sanitize($_POST['gender']);
	$birthdate=sanitize($_POST['birthdate']);
	$phone=sanitize($_POST['phone']);
	$email=sanitize($_POST['email']);
	$address=sanitize($_POST['address']);

	if ($username=="")
	{
		$error="*Not all required fields were entered";
	}
	else
	{
		if ($username!=$row[0])
		{
			queryMysql("UPDATE member SET username='$username' WHERE username='$row[0]'");
			changeProfile('username', $username, $row[0]);
			$_SESSION['username']=$username;
		}

		if ($gender!=$row[1])
		{
			changeProfile('gender', $gender, $row[1]);
		}

		if ($birthdate!=$row[2])
		{
			changeProfile('birthdate', $birthdate, $row[2]);
		}

		if ($phone!=$row[3])
		{
			changeProfile('phone', $phone, $row[3]);
		}

		if ($email!=$row[4])
		{
			changeProfile('email', $email, $row[4]);
		}

		if ($address!=$row[5])
		{
			changeProfile('address', $address, $row[5]);
		}

		header("refresh:1 ; url=showProfile.php");

		die("<div class='container' style='text-align: center'><h2>Edit successfully</h2></div></body></html>");
		
	}
}
?>

<div class='container' style="margin: 0% 32%; width: 36%"><h2>Edit profile</h2></div>
<form class="form-horizontal" style="margin: 0% 30%; width: 40%" method='POST' action='editProfile.php'>
	<div class="form-group">
		<label class="control-label col-sm-4" for="username">* Username</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='username' value='<?php echo $row[0] ?>' pattern="[a-zA-Z0-9]{1,16}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="gender">Gender</label>
		<div class="radio col-sm-8">
			<label><input type='radio' name='gender' value='male'>Male</label>
			<label><input type='radio' name='gender' value='female'>Femal</label>
			<label><input type='radio' name='gender' value='' checked='checked'>None</label>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="birthdate">Birthday</label>
		<div class="col-sm-4">
			<input type='date' class="form-control" name='birthdate' value='<?php echo $row[2] ?>'>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="phone">Phone Number</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='phone' value='<?php echo $row[3] ?>' pattern="[0-9]{9,10}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="email">E-mail</label>
		<div class="col-sm-8">
			<input type='email' class="form-control" name='email' value='<?php echo $row[4] ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-4" for="address">Address</label>
		<div class="col-sm-8">
			<input type='text' class="form-control" name='address' value='<?php echo $row[5] ?>' maxlength='80'>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<input type='submit' class="btn btn-default" value='Confirm'>
			<span id="error"><?php echo $error ?></span>
</form>
</body></html>