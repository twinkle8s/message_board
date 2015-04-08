<?php
include_once "Function.php";

$error="";

if (isset($_POST['userReply']))
{
	$name=sanitize($_POST['username']);
	$title=sanitize($_POST['title']);
	$userReply=sanitize($_POST['userReply']);

	if ($userReply=="")
	{
		$error="*Please reply some words";
	}
	else
	{
		$type="reply";
		$query="INSERT INTO message (name, title, content, type) VALUES(?,?,?,?)";
		$stmt=$connect->prepare($query);
		$stmt->bind_param("ssss", $name, $title, $userReply, $type);
		$stmt->execute();
	}
}

$date=date("Y/m/d", time());

//json
$newReply = array(
	"name" => $name,
	"userReply" => $userReply,
	"time" => $date,
	"error" => $error);

echo json_encode($newReply, JSON_PRETTY_PRINT);
//json
?>