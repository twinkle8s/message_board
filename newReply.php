<?php
include_once "Function.php";

$error="";

if (isset($_POST['userReply']))
{
	$name=sanitize($_POST['$username']);
	$title=sanitize($_POST['title'])
	$userReply=sanitize($_POST['userReply']);

	if ($userReply=="")
	{
		$error="*Please reply some words";
	}
	else
	{
		queryMysql("INSERT INTO message (name, title, content, type, time)
		 VALUES('$name', '$title', '$userReply', 'reply', NULL)");
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