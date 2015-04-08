<?php
include_once "Header.php";

$error=$username=$password=$confirm=$gender=$birthdate=$phone=$email=$address="";

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

	$select="SELECT * FROM member WHERE username='$username'";
	$result=$connect->query($select);

	if ($username=="" || $password=="" || $confirm=="")
	{
		$error="*Not all required fields were entered";
	}
	elseif ($result->num_rows>0)
	{
		$error="*Sorry, that username already exists";
	}
	elseif ($confirm!=$password)
	{
		$error="*Different password";
	}
	else
	{
		$token=addPW($password);

		$query="INSERT INTO member(username, password) VALUES (?,?)";
		$stmt=$connect->prepare($query);
		$stmt->bind_param("ss", $username, $token);
		$stmt->execute();

		$query="INSERT INTO profile(username, gender, birthdate, phone, email, address) VALUES (?,?,?,?,?,?)";
		$stmt=$connect->prepare($query);
		$stmt->bind_param("ssssss", $username, $gender, $birthdate, $phone, $email, $address);
		$stmt->execute();

		$connect->query("INSERT INTO profile() VALUES ($gender, $birthdate, NULL, NULL");

		die("<div class='container' style='text-align: center'><h2>Account created :)<br>Please log in.</h2></div></body></html>");
	}
}
?>