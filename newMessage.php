<?php
include_once "Function.php";

$error="";

if (isset($_POST['title']))
{
	$name=sanitize($_POST['username']);
	$title=sanitize($_POST['title']);
	$content=sanitize($_POST['content']);

	if ($title=="" || $content==""){
		$error="*Not all fields were entered";
	}
	elseif (mysql_num_rows(queryMysql("SELECT * FROM message WHERE title='$title' AND type='main'")))
	{
		$error="*Sorry, that title name already exists";
	}
	else
	{
		queryMysql("INSERT INTO message (name, title, content, type, time) 
			VALUES('$name', '$title', '$content', 'main', NULL)");
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