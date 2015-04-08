<?php
include_once "Function.php";

$error="";

if (isset($_POST['title']))
{
	$name=sanitize($_POST['username']);
	$title=sanitize($_POST['title']);
	$content=sanitize($_POST['content']);

	$select="SELECT * FROM message WHERE title='$title' AND type='main'";
	$result=$connect->query($select);

	if ($title=="" || $content==""){
		$error="*Not all fields were entered";
	}
	elseif ($result->num_rows>0)
	{
		$error="*Sorry, that title name already exists";
	}
	else
	{
		$type="main";
		$query="INSERT INTO message (name, title, content, type) VALUES(?,?,?,?)";
		$stmt=$connect->prepare($query);
		$stmt->bind_param("ssss", $name, $title, $content, $type);
		$stmt->execute();
	}
}

$date=date("Y/m/d", time());

//json
$newMessage = array(
	"name" => $name,
	"title" => $title,
	"time" => $date,
	"error" => $error);

echo json_encode($newMessage,JSON_PRETTY_PRINT);
//json
?>