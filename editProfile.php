<?php
include_once 'Header.php';

$query=queryMysql("SELECT * FROM profile WHERE username='$username'");
$row=mysql_fetch_row($query);

if (isset($_POST['username']))
{
	$username=sanitize($_POST['username']);
	$gender=sanitize($_POST['gender']);
	$birthdate=sanitize($_POST['birthdate']);
	$phone=sanitize($_POST['phone']);
	$email=sanitize($_POST['email']);
	$address=sanitize($_POST['address']);

	if ($username=="" || $phone=="")
	{
		echo "<div class='content'><h2>Edit profile</h2>" .
			 "<span class='error'>Not all required fields were entered</span><br><br>";
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

		die("<div class='content'><h2>Edit successfully</h2></div></body></html>");
		
	}
}
else
{
	echo "<div class='content'><h2>Edit profile</h2>";
}

?>

<form method='POST' action='editProfile.php'>
<span class='field'>* Username </span>
<input type='text' name='username' value='<?php echo $row[0] ?>' pattern="[a-zA-Z0-9]{1,16}" autofocus><br>
<span class='field'>Gender </span>
<input type='radio' name='gender' value='male'>Male 
<input type='radio' name='gender' value='female'>Female 
<input type='radio' name='gender' value='' checked='checked'>None<br>
<span class='field'>Birthday </span>
<input type='date' name='birthdate' value='<?php echo $row[2] ?>'><br>
<span class='field'>* Phone Number </span>
<input type='text' name='phone' value='<?php echo $row[3] ?>' pattern="{9,10}"><br>
<span class='field'>E-mail </span>
<input type='email' name='email' value='<?php echo $row[4] ?>' pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"><br>
<span class='field'>Address </span>
<input type='text' name='address' value='<?php echo $row[5] ?>' maxlength='80'><br><br>

<span class='button'><input type='submit' value='Confirm'></span>

</form></div></body></html>