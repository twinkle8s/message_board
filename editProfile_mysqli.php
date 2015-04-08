<?php
include_once 'Header.php';

$query="SELECT * FROM profile WHERE username='$username'";
$result=$connect->query($query);
$row=$result->fetch_row();
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
			$update="UPDATE member SET username=? WHERE username=?";
			$stmt=$connect->prepare($query);
			$stmt->bind_param("ss", $username, $row[0]);
			$stmt->execute();
			
			$query="UPDATE profile SET username=? WHERE username=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $username, $row[0]);
			$stmt->execute();

			$_SESSION['username']=$username;
		}

		if ($gender!=$row[1])
		{
			$update="UPDATE profile SET gender=? WHERE gender=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $gender, $row[1]);
			$stmt->execute();
		}

		if ($birthdate!=$row[2])
		{
			$update="UPDATE profile SET birthdate=? WHERE birthdate=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $birthdate, $row[2]);
			$stmt->execute();
		}

		if ($phone!=$row[3])
		{
			$update="UPDATE profile SET phone=? WHERE phone=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $phone, $row[3]);
			$stmt->execute();
		}

		if ($email!=$row[4])
		{
			$update="UPDATE profile SET email=? WHERE email=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $email, $row[4]);
			$stmt->execute();
		}

		if ($address!=$row[5])
		{
			$update="UPDATE profile SET email=? WHERE email=?";
			$stmt=$connect->prepare($update);
			$stmt->bind_param("ss", $email, $row[5]);
			$stmt->execute();
		}

		header("refresh:1 ; url=showProfile.php");

		die("<div class='container' style='text-align: center'><h2>Edit successfully</h2></div></body></html>");
		
	}
}
?>